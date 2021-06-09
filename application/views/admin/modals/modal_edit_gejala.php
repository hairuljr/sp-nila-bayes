<!-- Modal Edit -->
<?php foreach ($gejala as $g) : ?>
  <div class="modal fade" id="editGejalaModal<?= $g['id_gejala']; ?>" tabindex="-1" role="dialog" aria-labelledby="forModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="apasih">Edit Gejala</h5>
          <?= form_open_multipart('gejala/editGejala'); ?>
        </div>
        <input type="hidden" name="id" value="<?= $g['id_gejala']; ?>">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="kode" name="kode" value="<?= $g['kode']; ?>" readonly>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="gejala" name="gejala" value="<?= $g['gejala']; ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-round btn-primary">Edit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>