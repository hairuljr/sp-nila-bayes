<!-- Modal Edit -->
<?php foreach ($rule as $p) : ?>
  <div class="modal fade" id="editRuleModal<?= $p['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="forModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="apasih">Edit Rule</h5>
        </div>
        <form action="<?= base_url('rule/editRule'); ?>" method="post">
          <input type="hidden" name="id" value="<?= $p['id']; ?>">
          <div class="modal-body">
            <div class="form-group">
              <input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit" value="<?= $p['nama_penyakit']; ?>" readonly>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="nama_gejala" name="nama_gejala" value="<?= $p['gejala']; ?>" readonly>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="prob" name="prob" value="<?= $p['probabilitas']; ?>">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-round btn-primary">Edit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>