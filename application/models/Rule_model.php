<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rule_model extends CI_Model
{
  public function getRule($id_penyakit)
  {
    $queryRule = "SELECT `rule`.`id`,`penyakit`.`nama_penyakit`,`gejala`.`gejala`, SUBSTRING(`rule`.`probabilitas`, 1,4) as `probabilitas` FROM `penyakit` JOIN `rule` ON `penyakit`.`id_penyakit`=`rule`.`id_penyakit` JOIN `gejala` ON `rule`.`id_gejala`=`gejala`.`id_gejala` WHERE `penyakit`.`id_penyakit` = $id_penyakit";
    return $this->db->query($queryRule)->result_array();
  }
}
