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
    if ($this->session->userdata('username')) {
      redirect('user');
    }
    //form validasi
    $this->form_validation->set_rules('username', 'Username', 'trim|required');
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
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    //query ke tbl user utk mendapatkn semua data hanya satu user
    $auth = $this->auth->getUser($username);
    // cek jika user dgn username yg diinputkn ada apa tdk di tbl user
    if ($auth) {
      // jika usernya aktif
      if ($auth['is_active'] == 1) {
        // cek password yang di inputkan user dgn tbl user
        if (password_verify($password, $auth['password'])) {
          $data = [
            'username' => $auth['username'],
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
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Status akun tidak aktif</div>');
        redirect('auth');
      }
      //username tidak terdaftar
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username belum terdaftar!</div>');
      redirect('auth');
    }
  }
  public function registrasi()
  {
    if ($this->session->userdata('username')) {
      redirect('user');
    }
    //form validasi
    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('username', 'Username', 'required|trim');
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
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Kamu sudah terdaftar. Silahkan login untuk memulai diagnosa.</div>');
      redirect('auth');
    }
  }

  public function ubahPassword()
  {
    if (!$this->session->userdata('reset_username')) {
      redirect('auth');
    }

    $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
    $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Ubah Password';
      $this->load->view('auth/ubah-password', $data);
    } else {
      $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
      $username = $this->session->userdata('reset_username');

      $this->db->set('password', $password);
      $this->db->where('username', $username);
      $this->db->update('user');

      $this->session->unset_userdata('reset_username');

      $this->db->delete('user_token', ['username' => $username]);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password sudah terubah! Silahkan login.</div>');
      redirect('auth');
    }
  }

  public function logout()
  {
    //hapus session username
    $this->session->unset_userdata('username');
    //hapus session role_id
    $this->session->unset_userdata('role_id');
    //pesan flashdata telah berhasil logout
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kamu berhasil logout!</div>');
    redirect('auth');
  }

  public function block()
  {
    $data['judul'] = 'Akses Tidak Diizinkan!';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $this->load->view('templates/header', $data);
    $this->load->view('auth/blocked', $data);
  }
}
