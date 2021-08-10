<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Kontak</title>
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>style.css" />
  <link href="<?= base_url('assets'); ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>style_contact.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <div class="container3">
    <div class="menu">
      <ul>
        <i class="fa fa-user-md"></i>
        <li><a href="<?= base_url('home'); ?>">Beranda</a></li>
        <li><a href="<?= base_url('home/about'); ?>">Tentang</a></li>
        <li class="active"><a class="active" href="<?= base_url('home/contact'); ?>">Kontak</a></li>
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
  <div class="contact-section">
    <div class="flash-pesan" data-flashpesan="<?= $this->session->flashdata('pesan'); ?>"></div>
    <h1>Kontak Kami</h1>
    <div class="border"></div>
    <form class="contact-form" action="<?= base_url('kontak/simpan'); ?>" method="POST">
      <input name="nama" type="text" class="contact-form-text" placeholder="Nama anda">
      <input name="email" type="email" class="contact-form-text" placeholder="Email anda">
      <input name="no_hp" type="text" class="contact-form-text" placeholder="No HP anda">
      <textarea name="pesan" class="contact-form-text" placeholder="Pesan anda"></textarea>
      <input type="submit" class="contact-form-btn" value="Kirim">
    </form>
  </div>


</body>
<!-- jQuery -->
<script src="<?= base_url('assets'); ?>/vendors/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>assets/js/myscript.js"></script>

</html>