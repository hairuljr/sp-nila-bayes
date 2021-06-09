<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
  public function getUser($email)
  {
    return $this->db->get_where('user', ['email' => $email])->row_array();
  }

  public function daftar()
  {
    $email = $this->input->post('email', true);
    $data = [
      'name' => htmlspecialchars($this->input->post('name', true)),
      'email' => htmlspecialchars($email),
      'image' => 'user.png',
      'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
      'role_id' => 2,
      'is_active' => 0,
      'date_created' => date('Y-m-d')
    ];
    // siapkan token
    $token = base64_encode(random_bytes(32));
    $user_token = [
      'email' => $email,
      'token' => $token,
      'date_created' => time()
    ];

    $this->db->insert('user', $data);
    $this->db->insert('user_token', $user_token);

    $this->_sendEmail($token, 'verify');
  }
  private function _sendEmail($token, $type)
  {
    $config = [
      'protocol'  => 'mail',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => 'jrcomp.info@gmail.com',
      'smtp_pass' => 'Jr-Comp.info',
      'smtp_port' => 587,
      'mailtype'  => 'html',
      'charset'   => 'utf-8',
      'newline'   => "\r\n"
    ];

    $this->email->initialize($config);
    $this->email->set_newline("\r\n");

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
}
