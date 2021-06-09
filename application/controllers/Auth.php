<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('Auth_model', 'auth');
  }
  public function index()
  {
    //cek jika sudah ada login session pada user
    if ($this->session->userdata('email')) {
      redirect('user');
    }
    //form validasi
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    //jika validasi gagal kembalikn ke halaman login
    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Login Page';
      $this->load->view('auth/login', $data);
      //jika validasi sukses menuju ke method _login
    } else {
      $this->_login();
    }
  }
  private function _login()
  {
    //mendapatkan inputan user dari form login
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    //query ke tbl user utk mendapatkn semua data hanya satu user
    $auth = $this->auth->getUser($email);
    // cek jika user dgn email yg diinputkn ada apa tdk di tbl user
    if ($auth) {
      // cek jika usernya aktif atau sudah verifikasi apa belum
      if ($auth['is_active'] == 1) {
        // cek password yang di inputkan user dgn tbl user
        if (password_verify($password, $auth['password'])) {
          $data = [
            'email' => $auth['email'],
            'role_id' => $auth['role_id']
          ];
          //membuat session
          $this->session->set_userdata($data);
          //login berhasil alihkan ke halaman masing-masing rolenya
          if ($auth['role_id'] == 1) {
            redirect('admin');
          } else {
            redirect('home');
          }
          //password salah
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
          redirect('auth');
        }
        //Email belum diverifikasi
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum diverifiaksi!</div>');
        redirect('auth');
      }
      //email tidak terdaftar
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar!</div>');
      redirect('auth');
    }
  }
  public function registrasi()
  {
    if ($this->session->userdata('email')) {
      redirect('user');
    }
    //form validasi
    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
      'matches' => 'Password tidak cocok!',
      'min_length' => 'Password kurang panjang!'
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
    //jika form validasi gagal kembalikn ke halaman registrasi
    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Register Page';
      $this->load->view('auth/registrasi', $data);
      //jika validasi sukses, tampung data inputan utk di insert ke tbl user
    } else {
      $this->auth->daftar();
      //pesan flashdata sukses registrasi
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Kamu sudah terdaftar. Silahkan cek email kamu untuk aktivasi akun.</div>');
      redirect('auth');
    }
  }

  public function verify()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');

    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    if ($user) {
      $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

      if ($user_token) {
        if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
          $this->db->set('is_active', 1);
          $this->db->where('email', $email);
          $this->db->update('user');

          $this->db->delete('user_token', ['email' => $email]);

          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' telah berhasil diaktivasi! Silahkan login.</div>');
          redirect('auth');
        } else {
          $this->db->delete('user', ['email' => $email]);
          $this->db->delete('user_token', ['email' => $email]);

          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Verifikasi email gagal! Token Kadaluwarsa.</div>');
          redirect('auth');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal! Token Salah.</div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal! Email salah.</div>');
      redirect('auth');
    }
  }

  public function lupaPassword()
  {
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Lupa Password';
      $this->load->view('auth/lupa-password', $data);
    } else {
      $email = $this->input->post('email');
      $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

      if ($user) {
        $token = base64_encode(random_bytes(32));
        $user_token = [
          'email' => $email,
          'token' => $token,
          'date_created' => time()
        ];

        $this->db->insert('user_token', $user_token);
        $this->_sendEmail($token, 'forgot');

        $this->session->set_flashdata('message', '<div style="color: #fff;" class="alert alert-success" role="alert"><u>Silahkan cek email anda untuk reset Password!</u></div>');
        redirect('auth/lupaPassword');
      } else {
        $this->session->set_flashdata('message', '<div style="color: #fff;" class="alert alert-danger" role="alert"><u>Email tidak terdaftar atau belum diaktivasi!</u></div>');
        redirect('auth/lupaPassword');
      }
    }
  }
  public function resetPassword()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');

    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    if ($user) {
      $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

      if ($user_token) {
        $this->session->set_userdata('reset_email', $email);
        $this->ubahPassword();
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password gagal! Token salah.</div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password gagal! Email salah.</div>');
      redirect('auth');
    }
  }
  public function ubahPassword()
  {
    if (!$this->session->userdata('reset_email')) {
      redirect('auth');
    }

    $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
    $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Ubah Password';
      $this->load->view('auth/ubah-password', $data);
    } else {
      $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
      $email = $this->session->userdata('reset_email');

      $this->db->set('password', $password);
      $this->db->where('email', $email);
      $this->db->update('user');

      $this->session->unset_userdata('reset_email');

      $this->db->delete('user_token', ['email' => $email]);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password sudah terubah! Silahkan login.</div>');
      redirect('auth');
    }
  }
  private function _sendEmail($token, $type)
  {
    $config = [
      'protocol'  => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => 'jrcomp.info@gmail.com',
      'smtp_pass' => 'Jr-Comp.info',
      'smtp_port' => 465,
      'mailtype'  => 'html',
      'charset'   => 'utf-8',
      'newline'   => "\r\n"
    ];

    $this->email->initialize($config);

    $this->email->from('jrcomp.info@gmail.com', 'Sistem Pakar Penyakit Pencernaan');
    $this->email->to($this->input->post('email'));

    if ($type == 'verify') {
      $this->email->subject('Verifikasi Akun dari SP Pencernaan');
      $this->email->message('Klik disini untuk verifikasi pendaftaran Anda : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Verfikasi Sekarang</a>');
    } else if ($type == 'forgot') {
      $this->email->subject('Reset Password dari SP Pencernaan');
      $this->email->message('Klik disini untuk reset password Anda : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
    }

    if ($this->email->send()) {
      return true;
    } else {
      echo $this->email->print_debugger();
      die;
    }
  }
  public function logout()
  {
    //hapus session email
    $this->session->unset_userdata('email');
    //hapus session role_id
    $this->session->unset_userdata('role_id');
    //pesan flashdata telah berhasil logout
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kamu berhasil logout!</div>');
    redirect('auth');
  }
  public function block()
  {
    $data['judul'] = 'Akses Tidak Diizinkan!';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('templates/header', $data);
    $this->load->view('auth/blocked', $data);
  }
}
