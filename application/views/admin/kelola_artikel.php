<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?= $subMenu['judul']; ?></h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Tabel <?= $subMenu['judul']; ?></h2>
            <div class="clearfix"></div>
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
          </div>
          <a href="<?= base_url('artikel/tambah/'); ?>" class="buttonku buttonku--moema buttonku--text-thick buttonku--text-upper buttonku--size-s mb-3 pull-right">Tambah Artikel</a>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Gambar</th>
                  <th>Tanggal</th>
                  <th>Kategori</th>
                  <th>Isi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php
                $queryKategori = "SELECT * FROM `artikel` JOIN `artikel_kategori` ON `artikel`.`id_kat_kategori`=`artikel_kategori`.`id_kat_kategori`";
                $artikel1 = $this->db->query($queryKategori)->result_array();
                ?>
                <?php foreach ($artikel1 as $a) : ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $a['judul']; ?></td>
                    <td><img style="width: 150px;" src="<?= base_url('assets/images/artikel/') . $a['image']; ?>"></td>
                    <td><?= (new DateTime($a['tanggal']))->format('d F Y'); ?></td>
                    <td><?= $a['nama_kategori']; ?></td>
                    <td><?= $a['isi']; ?></td>
                    <td>
                      <a href="<?= base_url('artikel/edit/') . $a['id']; ?>" style="padding: 1em 1.8em 1em;" class="buttonku buttonku--moemaedt buttonku--text-thick buttonku--text-upper buttonku--size-s">ubah</a>
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
                      <a href="<?= base_url('artikel/hapusArtikel/') . $a['id']; ?>" style="padding: 1em 1.2em 1em;" class="tombol-hapus buttonku buttonku--moemadel buttonku--text-thick buttonku--text-upper buttonku--size-s">hapus</a>
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