<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?= $judul; ?></title>

  <!-- Bootstrap -->
  <link href="<?= base_url('assets'); ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?= base_url('assets'); ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?= base_url('assets'); ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="<?= base_url('assets'); ?>/vendors/animate.css/animate.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>style_btn.css">
  <!-- Custom Theme Style -->
  <link href="<?= base_url('assets'); ?>/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
  <div>
    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <form method="POST" action="<?= base_url('auth/registrasi'); ?>">
            <h1>Buat Akun</h1>
            <div>
              <small class="text-danger">
                <?= form_error('name'); ?>
              </small>
              <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>">
            </div>
            <div>
              <small class="text-danger">
                <?= form_error('username'); ?>
              </small>
              <input type="text" name="username" class="form-control" placeholder="Username" value="<?= set_value('username'); ?>">
            </div>
            <div>
              <small class="text-danger">
                <?= form_error('password1'); ?>
              </small>
              <input type="password" name="password1" class="form-control" placeholder="Password">
            </div>
            <div>
              <input type="password" name="password2" class="form-control" placeholder="Ulangi Password">
            </div>
            <div>
              <button style="margin-left: 120px;" class="buttonku buttonku--moema buttonku--text-thick buttonku--text-upper buttonku--size-m" type="submit">Daftar</button>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
              <p class="change_link">Sudah jadi member?
                <a href="<?= base_url('auth'); ?>" class="to_register"> Login </a>
              </p>
              <div class="clearfix"></div>
              <br />
            </div>
          </form>
        </section>
      </div>

    </div>
  </div>
</body>

</html>