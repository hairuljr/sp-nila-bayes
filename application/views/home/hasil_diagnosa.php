<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Hasil Diagnosa</title>
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>style.css" />
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>style_hasil_diagnosis.css">
  <meta name="viewport" content="width=device-width, initial-sclae=1.0">

</head>

<body>
  <div class="container3">
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
  <div class="about-section">
    <div class="inner-width">
      <h1>Hasil Diagnosa</h1>
      <div class="border"></div>
      <div class="about-section-row">
        <div class="about-section-col">
          <div class="about">
            <?php foreach ($hasilMax as $h) : ?>
              <a><?= $h['nama_penyakit']; ?></a>
            <?php endforeach; ?>
            <p>
              <b>Info Penyakit</b><br>
              <?= $h['informasi']; ?>
            </p>
            <p>
              <b>Saran</b><br>
              <?= $h['saran']; ?>
            </p>
          </div>
        </div>
        <div class="about-section-col" style="margin-top: 55px;">
          <div class="skills">
            <?php foreach ($hasil as $h) : ?>
              <div class="skill" style="margin-bottom: 25px;">
                <div class="title" style="margin-bottom: 3px;"><b><?= $h['nama_penyakit']; ?></b> (<?= $h['hasil_probabilitas'] * 100; ?>)</div>
                <div class="progress">
                  <div class="progress-bar" style="width: <?= floor($h['hasil_probabilitas'] * 100); ?>%"><span><?= floor($h['hasil_probabilitas'] * 100); ?>%</span></div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>