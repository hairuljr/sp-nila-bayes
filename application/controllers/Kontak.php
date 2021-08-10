<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kontak extends CI_Controller
{
	public function index()
	{
		$prob1 = 0.0099;
		$prob2 = 1;
		$start = 27;
		$end = 34;
		for ($i = $start; $i <= $end; $i++) {
			$data = [
				'id_penyakit' => 9,
				'id_gejala' => $i,
				'probabilitas' => $prob1
			];
			//insert checked checkbox ke temporary
			$this->db->insert('rule', $data);
		}
	}

	public function simpan()
	{
		$data = [
			'nama' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp'),
			'pesan' => $this->input->post('pesan'),
			'tanggal' => date('Y-m-d')
		];
		$this->db->insert('kontak', $data);
		$this->session->set_flashdata('pesan', 'Dikirimkan');
		redirect('home/contact');
	}
}
