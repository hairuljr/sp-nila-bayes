        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?= $subMenu['judul']; ?></h3>
              </div>
              <a href="" class="buttonku buttonku--moema buttonku--text-thick buttonku--text-upper buttonku--size-s mb-3 pull-right" data-toggle="modal" data-target="#newRuleModal">Tambah Rule</a>
              <div class="title_right">
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tabel Rule <?= $rule_name; ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Penyakit</th>
                          <th>Gejala</th>
                          <th>Probabilitas</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($rule as $r) : ?>
                          <tr>
                            <td><?= $i; ?></td>
                            <td><?= $r['nama_penyakit']; ?></td>
                            <td><?= $r['gejala']; ?></td>
                            <td><?= $r['probabilitas']; ?></td>
                            <td>
                              <a style="padding: 1em 1.8em 1em;" href="" class="buttonku buttonku--moemaedt buttonku--text-thick buttonku--text-upper buttonku--size-s" data-toggle="modal" data-target="#editRuleModal<?= $r['id']; ?>">ubah</a>
                              <script>
                                $(".tombol-hapus").on("click", function(e) {
                                  e.preventDefault();
                                  const href = $(this).attr("href");

                                  Swal({
                                    title: "Apakah anda yakin",
                                    text: "data ini akan dihapus",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Hapus Data!"
                                  }).then(result => {
                                    if (result.value) {
                                      document.location.href = href;
                                    }
                                  });
                                });
                              </script>
                              <a href="<?= base_url('rule/hapusRule/') . $r['id']; ?>" style="padding: 1em 1.2em 1em;" class="tombol-hapus buttonku buttonku--moemadel buttonku--text-thick buttonku--text-upper buttonku--size-s">hapus</a>
                            </td>
                          </tr>
                          <?php $i++; ?>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->