        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><a href="<?= base_url('admin/konsultasi'); ?>"><i class="fa fa-user-md"></i></a></div>
                <div class="count"><a href="<?= base_url('admin/konsultasi'); ?>"><?= $jml_dftr_konsul; ?></a></div>
                <h3><a href="<?= base_url('admin/konsultasi'); ?>">Diagnosa</a></h3>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><a href="<?= base_url('admin/konsultasi'); ?>"><i class="fa fa-stethoscope"></i></a></div>
                <div class="count"><a href="<?= base_url('admin/artikel'); ?>"><?= $jml_gejala; ?></a></div>
                <h3><a href="<?= base_url('admin/artikel'); ?>">Gejala</a></h3>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><a href="<?= base_url('admin/member'); ?>"><i class="fa fa-users"></i></a></div>
                <div class="count"><a href="<?= base_url('admin/member'); ?>"><?= $jml_user; ?></a></div>
                <h3><a href="<?= base_url('admin/member'); ?>">User</a></h3>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><a href="<?= base_url('admin/rule'); ?>"><i class="fa fa-medkit"></i></a></div>
                <div class="count"><a href="<?= base_url('admin/rule'); ?>"><?= $jml_rule; ?></a></div>
                <h3><a href="<?= base_url('admin/rule'); ?>">Rule</a></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="x_content">
              <div class="bs-example" data-example-id="simple-jumbotron">
                <div class="jumbotron col-lg-9">
                  <h1>Halo, <?= $user['name']; ?> &#128513;</h1>
                  <p>Selamat datang di dashboard admin. Kamu bisa mengelola <br> data-data aplikasi Sistem Pakar ini.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- page content -->