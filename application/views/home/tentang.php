<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <link href="<?= base_url('assets'); ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>style_about.css">
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>style.css">
  <title>SP Ikan Nila</title>
</head>

<body>
  <div class="container2">
    <div class="menu">
      <ul>
        <i class="fa fa-user-md"></i>
        <li><a href="<?= base_url('home'); ?>">Beranda</a></li>
        <li class="active"><a class="active" href="<?= base_url('home/about'); ?>">Tentang</a></li>
        <li><a href="<?= base_url('home/contact'); ?>">Kontak</a></li>
        <?php
        if ($this->session->userdata('email')) {
          $log = 'Keluar';
          $url = 'logout';
          $link = base_url('user');
          $menu = '<li>' . '<a href="' . $link . '">' . "Profile" . '</a>' . '</li>';
        } else {
          $log = 'Daftar';
          $url = 'registrasi';
          $menu = '';
        }
        ?>
        <?= $menu; ?>
        <li>
          <a href="<?= base_url("auth/" . $url); ?>" class="signup-btn"><span><?= $log; ?></span></a>
        </li>
      </ul>
    </div>
  </div>
  <div class="box">
    <img src="<?= base_url('assets/'); ?>background.png" alt="" class="box-img">
    <h1>
      SP Ikan Nila</h1>
    <h5>
      Sistem Pakar - Diagnosa Penyakit Ikan Nila</h5>
    <p>
      Sistem pakar adalah suatu sistem yang menggunakan pengetahuan manusia dimana pengetahuan manusia tersebut dimasukan kedalam sebuah komputer dan kemudian digunakan untuk menyelesaikan masalah-masalah yang biasanya membutuhkan kepakaran atau keahlian manusia.</p>
  </div>
</body>

</html>