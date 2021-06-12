<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diagnosa extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Diagnosa_model', 'diagnosa');
    if (!$this->session->userdata('username')) {
      redirect('home');
    }
  }
  public function hasil()
  {
    //kosongkan temporary sebelum dimulainya diagnosa
    $this->diagnosa->kosongkanTemp();
    $this->diagnosa->kosongkanTempFinal();
    //tangkap checkbox gejala
    $gejala = $this->input->post('gejala');
    foreach ($gejala as $g) {
      $data = [
        'id_gejala' => $g
      ];
      //insert checked checkbox ke temporary
      $this->db->insert('temporary', $data);
    }
    //dari id_gejala yg ada ditemporary, insert ke temporary final with id_penyakit & probabiliasnya
    $temp = $this->diagnosa->insertTempFinal();
    // var_dump($temp);die;
    $this->db->insert_batch('temporary_final', $temp);

    //ambil bobot probabilitas utk setiap penyakit
    $Branchyomichosis = $this->diagnosa->getProbBranchyomichosis();
    $Whitespot = $this->diagnosa->getProbWhitespot();
    $Dactylograsis = $this->diagnosa->getProbDactylograsis();
    $Colomuniaris = $this->diagnosa->getProbColomuniaris();
    $Saprolegniasi = $this->diagnosa->getProbSaprolegniasi();
    $Lerneasi = $this->diagnosa->getProbLerneasi();
    $Gyrodactyliasis = $this->diagnosa->getProbGyrodactyliasis();
    $Sterptoccociasis = $this->diagnosa->getProbSterptoccociasis();
    //siapkan datanya kedalam array untuk dijumlahkan
    $data = [
      'branchyomichosis' => $Branchyomichosis,
      'whitespot' => $Whitespot,
      'dactylograsis' => $Dactylograsis,
      'colomuniaris' => $Colomuniaris,
      'saprolegniasi' => $Saprolegniasi,
      'lerneasi' => $Lerneasi,
      'gyrodactyliasis' => $Gyrodactyliasis,
      'sterptoccociasis' => $Sterptoccociasis
    ];
    //jumlah probabilitas setiap penyakit atas gejala yang dipilih
    //∑P(F|Hk)xP(Hk)
    $jmlProb = array_sum($data);
    //pembagian ini sebagai pembanding antara bobot probabilitas dgn jml probabilitas
    //untuk mendapatkan nilai/hasil diagnosa terbesarnya
    $branchyomichosis = @($Branchyomichosis / $jmlProb) . '<br>';
    $whitespot = @($Whitespot / $jmlProb) . '<br>';
    $dactylograsis = @($Dactylograsis / $jmlProb) . '<br>';
    $colomuniaris = @($Colomuniaris / $jmlProb) . '<br>';
    $saprolegniasi = @($Saprolegniasi / $jmlProb) . '<br>';
    $lerneasi = @($Lerneasi / $jmlProb) . '<br>';
    $gyrodactyliasis = @($Gyrodactyliasis / $jmlProb) . '<br>';
    $sterptoccociasis = @($Sterptoccociasis / $jmlProb) . '<br>';

    //passing data utk di query ke field hasil_probabilitas
    $this->diagnosa->hasilProbBranchyomichosis($branchyomichosis);
    $this->diagnosa->hasilProbWhitespot($whitespot);
    $this->diagnosa->hasilProbDactylograsis($dactylograsis);
    $this->diagnosa->hasilProbColomuniaris($colomuniaris);
    $this->diagnosa->hasilProbSaprolegniasi($saprolegniasi);
    $this->diagnosa->hasilProbLerneasi($lerneasi);
    $this->diagnosa->hasilProbGyrodactyliasis($gyrodactyliasis);
    $this->diagnosa->hasilProbSterptoccociasis($sterptoccociasis);

    //query utk passing data penyakit ke halaman Hasil Diagnosa User
    $data['hasil'] = $this->diagnosa->diagnosis();
    $data['hasilMax'] = $this->diagnosa->diagnosisMax();
    $data['penyakit'] = $this->db->get('penyakit')->result_array();
    //insert user yg melakukan diagnosa
    $this->diagnosa->insertDaftarKonsult();
    $this->load->view('home/hasil_diagnosa', $data);
  }
}
