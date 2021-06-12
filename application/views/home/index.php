<html>

<head>
  <title>Sistem Pakar Penyakit Ikan Nila</title>
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>style.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
  <div class="container">
    <div class="menu">
      <ul>
        <i class="fa fa-user-md"></i>
        <li class="active"><a class="active" href="<?= base_url('home'); ?>">Beranda</a></li>
        <li><a href="<?= base_url('home/about'); ?>">Tentang</a></li>
        <li><a href="<?= base_url('home/contact'); ?>">Kontak</a></li>
        <?php
        if ($this->session->userdata('username')) {
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
        <li style="margin-top: 5px; !important">
          <a href="<?= base_url("auth/" . $url); ?>" class="signup-btn"><span><?= $log; ?></span></a>
        </li>
      </ul>
    </div>
  </div>
  <div class="banner">
    <div class="app-text" style="margin-top: 100px;">
      <h1>
        Diagnosa Penyakit Ikan Nila<br />
        dengan Metode Bayes
      </h1>
      <p>
        Selamat datang di Sistem Pakar Ikan Nila.
        <br />
        Ayo segera diagnosa gejala penyakit ikan Nila mu.
      </p>
      <div class="play-btn">
        <div class="play-btn-inner">
          <a href="<?= base_url('home/diagnosa'); ?>"><i class="fa fa-play"></i></a>
        </div>
        <small><b><a style="text-decoration: none; color: #19dafa;" href="<?= base_url('home/diagnosa'); ?>">Mulai Diagnosa</a></b></small>
      </div>
    </div>
    <div class="app-picture">
      <img src="<?= base_url('assets/'); ?>ikan.png" style="width: 100%; height: 400px;" />
    </div>
  </div>
</body>

</html>