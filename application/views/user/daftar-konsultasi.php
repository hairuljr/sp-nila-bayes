        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?= $subMenu['judul']; ?></h3>
              </div>

              <div class="title_right">
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tabel <?= $subMenu['judul']; ?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Tanggal</th>
                          <th>Username</th>
                          <th>Penyakit</th>
                          <th>Nilai</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($dftr_konsul as $konsul) : ?>
                          <tr>
                            <td><?= $i; ?></td>
                            <td><?= (new DateTime($konsul['tanggal']))->format('d F Y'); ?></td>
                            <td><?= $konsul['name']; ?></td>
                            <td><?= $konsul['nama_penyakit']; ?></td>
                            <td><?= $konsul['nilai']; ?>%</td>
                            <td>
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
                              <a href="<?= base_url('user/hapusKonsultasi/') . $konsul['id']; ?>" style="padding: 1em 1.2em 1em;" class="tombol-hapus buttonku buttonku--moemadel buttonku--text-thick buttonku--text-upper buttonku--size-s">hapus</a>
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