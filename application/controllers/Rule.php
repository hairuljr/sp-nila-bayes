<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rule extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Rule_model', 'rule');
    $this->load->model('Admin_model', 'admin');
    if (!$this->session->userdata('email')) {
      redirect('auth');
    }
  }
  public function penyakit($penyakit = '')
  {
    $data['rule_name'] = ucfirst($penyakit);
    $data['judul'] = 'Admin SP';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['subMenu'] = $this->db->get_where('sub_menu_user', ['id' => 6])->row_array();
    $data['penyakit'] = $this->db->get('penyakit')->result_array();
    $data['gejala'] = $this->db->get('gejala')->result_array();

    $penyakitnya = $this->db->get_where('penyakit', ['nama_penyakit' => $penyakit])->row_array();
    $id_penyakit = $penyakitnya['id_penyakit'];
    $data['rule'] = $this->rule->getRule($id_penyakit);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/tbl_rule/rule_penyakit');
    $this->load->view('templates/footer');
    $this->load->view('admin/modals/modal_tambah_rule');
    $this->load->view('admin/modals/modal_edit_rule', $data);
  }


  public function tambahRule()
  {
    $this->admin->tambahRule();
    $this->session->set_flashdata('flash', 'Ditambahkan');
    redirect('admin/rule');
  }

  public function editRule()
  {
    $this->admin->editRule();
    $this->session->set_flashdata('flash', 'Diubah');
    redirect('admin/rule');
  }

  public function hapusRule($id)
  {
    $this->admin->hapusRule($id);
    $this->session->set_flashdata('flash', 'Dihapus');
    redirect('admin/rule');
  }
}
