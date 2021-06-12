<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?= $judul; ?></title>
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>style_btn.css">
  <!-- Bootstrap -->
  <link href="<?= base_url('assets'); ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?= base_url('assets'); ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?= base_url('assets'); ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="<?= base_url('assets'); ?>/vendors/animate.css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="<?= base_url('assets'); ?>/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
  <div>
    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <form method="POST" action="<?= base_url('auth'); ?>">
            <h1>Login Form</h1>
            <?= $this->session->flashdata('message'); ?>
            <div>
              <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
              <input type="text" name="username" class="form-control" placeholder="Username" value="<?= set_value('username'); ?>">
            </div>
            <div>
              <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
              <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div>
              <button style="margin-left: 130px;" class="buttonku buttonku--moema buttonku--text-thick buttonku--text-upper buttonku--size-m" type="submit">Login</button>
              <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
            </div>

            <div class="clearfix"></div>

            <div class="separator">
              <p class="change_link">Belum punya akun?
                <a href="<?= base_url('auth/registrasi'); ?>" class="to_register"> Daftar Sekarang</a>
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