<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Pakar Penyakit Ikan Nila</title>
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>style.css" />
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>style_diagnosa.css" />
  <style>
    * {
      box-sizing: border-box;
    }

    /* Create three equal columns that floats next to each other */
    .column {
      float: left;
      width: 75%;
      padding: 10px;
      height: 300px;
      /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }
  </style>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="menu">
      <ul>
        <i class="fa fa-user-md"></i>
        <li><a href="<?= base_url('home'); ?>">Beranda</a></li>
        <li><a href="<?= base_url('home/about'); ?>">Tentang</a></li>
        <li><a href="<?= base_url('home/contact'); ?>">Kontak</a></li>
        <?php
        if ($this->session->userdata('username')) {
          $log = 'Keluar';
          $url = 'logout';
          $link = base_url('user');
          $menu = '<li>' . '<a href="' . $link . '">' . "Profil Saya" . '</a>' . '</li>';
        } else {
          $log = 'Daftar';
          $url = 'registrasi';
          $menu = '';
        }
        ?>
        <?= $menu; ?>
        <li style="margin-top: 5px; !important">
          <a href="<?= base_url('auth/logout'); ?>" class="signup-btn"><span>Keluar</span></a>
        </li>
      </ul>
    </div>
    <form action="<?= base_url('diagnosa/hasil'); ?>" method="POST">
      <h2 style="color: #b2b1b1; text-align: center;">Pilih Gejala Ikan</h2>
      <div class="row" style="display: flex; justify-content: center; font-size: 18px;">
        <div class="column">
          <?php $no = 1; ?>
          <?php foreach ($gejala as $g) : ?>
            <div class="inputGroup">
              <input id="<?= $g['id_gejala']; ?>" name="gejala[]" value="<?= $g['id_gejala']; ?>" type="checkbox" />
              <label for="<?= $g['id_gejala']; ?>"><?= $no++; ?> - <?= $g['gejala']; ?></label>
            </div>
          <?php endforeach; ?>
          <div class="row" style="display: flex; justify-content: center; font-size: 12px; flex-direction: row;">
            <button class="btn fourth" type="reset">Batal</button>
            <button class="btn third checkBtn" type="submit">Hitung</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <script src="<?= base_url('assets'); ?>/vendors/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.checkBtn').click(function() {
        checked = $("input[type=checkbox]:checked").length;
        if (!checked) {
          alert("Pilih salah satu gejala.");
          return false;
        }

      });
    });
  </script>
</body>

</html>