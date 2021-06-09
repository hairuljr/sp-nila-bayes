<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
  public function editProfil()
  {
    $name = htmlspecialchars($this->input->post('name', true));
    $email = htmlspecialchars($this->input->post('email', true));
    //query insert data ke tbl user
    $this->db->set('name', $name);
    $this->db->where('email', $email);
    $this->db->update('user');
  }
  public function ubahPassword($password_hash)
  {
    $this->db->set('password', $password_hash);
    $this->db->where('email', $this->session->userdata('email'));
    $this->db->update('user');
  }

  public function getKonsul()
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('email', $this->session->userdata('email'));
    $data = $this->db->get()->result();
    foreach ($data as $row) {
      $idUser = $row->id;
    }
    $query = "SELECT `daftar_konsultasi`.* FROM `daftar_konsultasi` JOIN `user` ON `daftar_konsultasi`.`id_user` = `user`.`id` WHERE `daftar_konsultasi`.`id_user` = $idUser ORDER BY `daftar_konsultasi`.`id`";
    return $this->db->query($query)->result_array();
  }
  
  public function hapusKonsultasi($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('daftar_konsultasi');
  }
}
