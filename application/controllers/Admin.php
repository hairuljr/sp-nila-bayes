<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    sudah_login();
    $this->load->library('form_validation');
    $this->load->model('Admin_model', 'admin');
    $this->load->helper('Admin_helper');
  }

  public function index() //menu dashboard
  {
    $data['judul'] = 'Admin SP';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['jml_user'] = $this->db->get('user')->num_rows(); //hitung jml user/pengguna
    $data['jml_rule'] = $this->db->get('rule')->num_rows(); //jumlah dataset/rule
    $data['jml_gejala'] = $this->db->get('gejala')->num_rows(); //jml gejala
    $data['jml_dftr_konsul'] = $this->db->get('daftar_konsultasi')->num_rows(); //jml riwyat konsultasi
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/index', $data);
    $this->load->view('templates/footer');
  }

  public function member() // menu data pengguna
  {
    $data['judul'] = 'Admin SP';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['subMenu'] = $this->db->get_where('sub_menu_user', ['id' => 3])->row_array();
    $data['member'] = $this->db->get_where('user', ['role_id' => 2])->result_array(); //data member
    $data['role'] = $this->db->get('role')->result_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/data_member', $data);
    $this->load->view('templates/footer', $data);
    $this->load->view('admin/modals/modal_edit_member', $data);
  }

  public function gejala() //menu data gejala
  {
    $data['judul'] = 'Admin SP';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['subMenu'] = $this->db->get_where('sub_menu_user', ['id' => 4])->row_array();
    $data['gejala'] = $this->db->get('gejala')->result_array(); //data gejala dari tbl gejala
    $data['kode'] = $this->admin->cekKodeGejala();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/data_gejala', $data);
    $this->load->view('templates/footer');
    $this->load->view('admin/modals/modal_tambah_gejala', $data);
    $this->load->view('admin/modals/modal_edit_gejala', $data);
  }

  public function penyakit() //menu data penyakit
  {
    $data['judul'] = 'Admin SP';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['subMenu'] = $this->db->get_where('sub_menu_user', ['id' => 5])->row_array();
    $data['penyakit'] = $this->db->get('penyakit')->result_array();
    $data['kode'] = $this->admin->cekKodePenyakit();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/data_penyakit', $data);
    $this->load->view('templates/footer');
    $this->load->view('admin/modals/modal_tambah_penyakit');
    $this->load->view('admin/modals/modal_edit_penyakit', $data);
  }

  public function rule() //menu data rule
  {
    $data['judul'] = 'Admin SP';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['subMenu'] = $this->db->get_where('sub_menu_user', ['id' => 6])->row_array();
    $data['penyakit'] = $this->db->get('penyakit')->result_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/data_rule', $data);
    $this->load->view('templates/footer');
  }

  public function konsultasi() //menu daftar konsultasi 
  {
    $data['judul'] = 'Admin SP';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['subMenu'] = $this->db->get_where('sub_menu_user', ['id' => 7])->row_array();
    $data['dftr_konsul'] = $this->db->get('daftar_konsultasi')->result_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/daftar_konsultasi', $data);
    $this->load->view('templates/footer');
  }

  public function kontak() //menu daftar pesan/kontak member 
  {
    $data['judul'] = 'Admin SP';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['subMenu'] = $this->db->get_where('sub_menu_user', ['id' => 12])->row_array();
    $data['pesan'] = $this->db->get('kontak')->result_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/pesan', $data);
    $this->load->view('templates/footer');
  }
}
