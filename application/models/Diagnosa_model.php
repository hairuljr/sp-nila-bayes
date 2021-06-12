<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diagnosa_model extends CI_Model
{
  public function kosongkanTemp()
  {
    return $this->db->truncate('temporary');
  }
  public function kosongkanTempFinal()
  {
    return $this->db->truncate('temporary_final');
  }
  public function getProbBranchyomichosis()
  {
    $this->db->select('*');
    $this->db->from('temporary_final');
    $this->db->where('id_penyakit', BRANCHYOMICHOSIS);
    $data = $this->db->get()->result();
    //inisialisasi untuk total probabilitas
    $jumlah = 1;
    foreach ($data as $row) {
      //perkalian antar setiap id_gejala x probabilitasnya
      $jumlah = $jumlah * $row->probabilitas;
    }
    $this->db->select('*');
    $this->db->from('penyakit');
    $this->db->where('id_penyakit', BRANCHYOMICHOSIS);
    $data = $this->db->get()->result();
    foreach ($data as $rowku) {
      //P(H1|F)
      $hasil = $jumlah * $rowku->probabilitas;
    }
    return $hasil;
  }
  public function getProbWhitespot()
  {
    $this->db->select('*');
    $this->db->from('temporary_final');
    $this->db->where('id_penyakit', WHITESPOT);
    $data = $this->db->get()->result();
    //inisialisasi untuk total probabilitas
    $jumlah = 1;
    foreach ($data as $row) {
      //perkalian antar setiap id_gejala x probabilitasnya
      $jumlah = $jumlah * $row->probabilitas;
    }
    $this->db->select('*');
    $this->db->from('penyakit');
    $this->db->where('id_penyakit', WHITESPOT);
    $data = $this->db->get()->result();
    foreach ($data as $rowku) {
      //P(H2|F)
      $hasil = $jumlah * $rowku->probabilitas;
    }
    return $hasil;
  }
  public function getProbDactylograsis()
  {
    $this->db->select('*');
    $this->db->from('temporary_final');
    $this->db->where('id_penyakit', DACTYLOGRASIS);
    $data = $this->db->get()->result();
    //inisialisasi untuk total probabilitas
    $jumlah = 1;
    foreach ($data as $row) {
      $jumlah = $jumlah * $row->probabilitas;
    }
    $this->db->select('*');
    $this->db->from('penyakit');
    $this->db->where('id_penyakit', DACTYLOGRASIS);
    $data = $this->db->get()->result();
    foreach ($data as $rowku) {
      //P(H4|F)
      $hasil = $jumlah * $rowku->probabilitas;
    }
    return $hasil;
  }
  public function getProbColomuniaris()
  {
    $this->db->select('*');
    $this->db->from('temporary_final');
    $this->db->where('id_penyakit', COLOMUNIARIS);
    $data = $this->db->get()->result();
    //inisialisasi untuk total probabilitas
    $jumlah = 1;
    foreach ($data as $row) {
      $jumlah = $jumlah * $row->probabilitas;
    }
    $this->db->select('*');
    $this->db->from('penyakit');
    $this->db->where('id_penyakit', COLOMUNIARIS);
    $data = $this->db->get()->result();
    foreach ($data as $rowku) {
      ////P(H5F)
      $hasil = $jumlah * $rowku->probabilitas;
    }
    return $hasil;
  }
  public function getProbSaprolegniasi()
  {
    $this->db->select('*');
    $this->db->from('temporary_final');
    $this->db->where('id_penyakit', SAPROLEGNIASI);
    $data = $this->db->get()->result();
    //inisialisasi untuk total probabilitas
    $jumlah = 1;
    foreach ($data as $row) {
      $jumlah = $jumlah * $row->probabilitas;
    }
    $this->db->select('*');
    $this->db->from('penyakit');
    $this->db->where('id_penyakit', SAPROLEGNIASI);
    $data = $this->db->get()->result();
    foreach ($data as $rowku) {
      ////P(H5F)
      $hasil = $jumlah * $rowku->probabilitas;
    }
    return $hasil;
  }
  public function getProbLerneasi()
  {
    $this->db->select('*');
    $this->db->from('temporary_final');
    $this->db->where('id_penyakit', LERNEASI);
    $data = $this->db->get()->result();
    //inisialisasi untuk total probabilitas
    $jumlah = 1;
    foreach ($data as $row) {
      $jumlah = $jumlah * $row->probabilitas;
    }
    $this->db->select('*');
    $this->db->from('penyakit');
    $this->db->where('id_penyakit', LERNEASI);
    $data = $this->db->get()->result();
    foreach ($data as $rowku) {
      ////P(H5F)
      $hasil = $jumlah * $rowku->probabilitas;
    }
    return $hasil;
  }
  public function getProbGyrodactyliasis()
  {
    $this->db->select('*');
    $this->db->from('temporary_final');
    $this->db->where('id_penyakit', GYRODACTYLIASIS);
    $data = $this->db->get()->result();
    //inisialisasi untuk total probabilitas
    $jumlah = 1;
    foreach ($data as $row) {
      $jumlah = $jumlah * $row->probabilitas;
    }
    $this->db->select('*');
    $this->db->from('penyakit');
    $this->db->where('id_penyakit', GYRODACTYLIASIS);
    $data = $this->db->get()->result();
    foreach ($data as $rowku) {
      ////P(H5F)
      $hasil = $jumlah * $rowku->probabilitas;
    }
    return $hasil;
  }
  public function getProbSterptoccociasis()
  {
    $this->db->select('*');
    $this->db->from('temporary_final');
    $this->db->where('id_penyakit', STERPTOCCOCIASIS);
    $data = $this->db->get()->result();
    //inisialisasi untuk total probabilitas
    $jumlah = 1;
    foreach ($data as $row) {
      $jumlah = $jumlah * $row->probabilitas;
    }
    $this->db->select('*');
    $this->db->from('penyakit');
    $this->db->where('id_penyakit', STERPTOCCOCIASIS);
    $data = $this->db->get()->result();
    foreach ($data as $rowku) {
      ////P(H5F)
      $hasil = $jumlah * $rowku->probabilitas;
    }
    return $hasil;
  }

  public function insertTempFinal()
  {
    $query = "SELECT `rule`.`id_penyakit`,`rule`.`id_gejala`, `rule`.`probabilitas` from `rule` JOIN `temporary` ON `rule`.`id_gejala` = `temporary`.`id_gejala` ORDER BY `rule`.`id_penyakit` ASC";
    return $this->db->query($query)->result_array();
  }

  //fungsi hasilProb adalah untuk mengubah field hasil_probabilitas sebagai tempat
  //untuk menampung hasil/nilai perhitungan akhir daripada Metode Bayes
  //yang mana field hasil_probabilitas inilah yg akan diquery utk mengetahui penyakit apa
  public function hasilProbBranchyomichosis($Branchyomichosis)
  {
    $dataBranchyomichosis = [
      'hasil_probabilitas' => $Branchyomichosis
    ];
    $this->db->where('id_penyakit', BRANCHYOMICHOSIS);
    $this->db->update('temporary_final', $dataBranchyomichosis);
  }
  public function hasilProbWhitespot($Whitespot)
  {
    $dataWhitespot = [
      'hasil_probabilitas' => $Whitespot
    ];
    $this->db->where('id_penyakit', WHITESPOT);
    $this->db->update('temporary_final', $dataWhitespot);
  }
  public function hasilProbDactylograsis($Dactylograsis)
  {
    $dataDactylograsis = [
      'hasil_probabilitas' => $Dactylograsis
    ];
    $this->db->where('id_penyakit', DACTYLOGRASIS);
    $this->db->update('temporary_final', $dataDactylograsis);
  }
  public function hasilProbColomuniaris($Colomuniaris)
  {
    $dataColomuniaris = [
      'hasil_probabilitas' => $Colomuniaris
    ];
    $this->db->where('id_penyakit', COLOMUNIARIS);
    $this->db->update('temporary_final', $dataColomuniaris);
  }
  public function hasilProbSaprolegniasi($Saprolegniasi)
  {
    $dataSaprolegniasi = [
      'hasil_probabilitas' => $Saprolegniasi
    ];
    $this->db->where('id_penyakit', SAPROLEGNIASI);
    $this->db->update('temporary_final', $dataSaprolegniasi);
  }
  public function hasilProbLerneasi($Lerneasi)
  {
    $dataLerneasi = [
      'hasil_probabilitas' => $Lerneasi
    ];
    $this->db->where('id_penyakit', LERNEASI);
    $this->db->update('temporary_final', $dataLerneasi);
  }
  public function hasilProbGyrodactyliasis($Gyrodactyliasis)
  {
    $dataGyrodactyliasis = [
      'hasil_probabilitas' => $Gyrodactyliasis
    ];
    $this->db->where('id_penyakit', GYRODACTYLIASIS);
    $this->db->update('temporary_final', $dataGyrodactyliasis);
  }
  public function hasilProbSterptoccociasis($Sterptoccociasis)
  {
    $dataSterptoccociasis = [
      'hasil_probabilitas' => $Sterptoccociasis
    ];
    $this->db->where('id_penyakit', STERPTOCCOCIASIS);
    $this->db->update('temporary_final', $dataSterptoccociasis);
  }
  //query ambil 3 penyakit tertinggi hasil_probabilitasnya
  public function diagnosis()
  {
    $query = "SELECT DISTINCT `temporary_final`.`id_penyakit`, `temporary_final`.`hasil_probabilitas`, `penyakit`.* FROM `temporary_final` JOIN `penyakit` ON `temporary_final`.`id_penyakit` = `penyakit`.`id_penyakit` ORDER BY `temporary_final`.`hasil_probabilitas` DESC LIMIT 3";
    return $this->db->query($query)->result_array();
  }

  //query ambil penyakit tertinggi yg menjadi penyakit utama daripada hasil diagnosa
  public function diagnosisMax()
  {
    $query = "SELECT `temporary_final`.`id`, MAX(hasil_probabilitas) as `hasil_probabilitas`, `penyakit`.* FROM temporary_final JOIN `penyakit` ON `temporary_final`.`id_penyakit` = `penyakit`.`id_penyakit` GROUP BY id_penyakit ORDER BY `hasil_probabilitas` DESC LIMIT 1";
    return $this->db->query($query)->result_array();
  }

  public function insertDaftarKonsult()
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('username', $this->session->userdata('username'));
    $data = $this->db->get()->result();
    foreach ($data as $row) {
      $idUser = $row->id;
      $nama = $row->name;
    }
    $penyakit = $this->diagnosisMax();
    foreach ($penyakit as $p) {
      $penyakitnya = $p['nama_penyakit'];
      $nilai = floor($p['hasil_probabilitas'] * 100);
    }
    $data = [
      'tanggal' => date('Y-m-d'),
      'id_user' => $idUser,
      'name' => $nama,
      'nama_penyakit' => $penyakitnya,
      'nilai' => $nilai
    ];
    return $this->db->insert('daftar_konsultasi', $data);
  }
}
