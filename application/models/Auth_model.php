<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
  public function getUser($username)
  {
    return $this->db->get_where('user', ['username' => $username])->row_array();
  }

  public function daftar()
  {
    $username = $this->input->post('username', true);
    $data = [
      'name' => htmlspecialchars($this->input->post('name', true)),
      'username' => htmlspecialchars($username),
      'image' => 'user.png',
      'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
      'role_id' => 2,
      'is_active' => 1,
      'date_created' => date('Y-m-d')
    ];

    $this->db->insert('user', $data);
  }
}
