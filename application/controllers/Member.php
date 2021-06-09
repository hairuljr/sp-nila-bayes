<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Admin_model', 'admin');
    if (!$this->session->userdata('email')) {
      redirect('auth');
    }
  }
  public function editMember()
  {
    $this->admin->editMember();
    $this->session->set_flashdata('flash', 'Diubah');
    redirect('admin/member');
  }
  public function hapusMember($id)
  {
    $this->admin->hapusMember($id);
    $this->session->set_flashdata('flash', 'Dihapus');
    redirect('admin/member');
  }
}
