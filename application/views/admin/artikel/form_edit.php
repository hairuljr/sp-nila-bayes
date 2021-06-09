   <!-- page content -->
   <div class="right_col" role="main">
     <div class="">
       <div class="page-title">
         <div class="title_left">
           <h3><?= $judul; ?></h3>
         </div>
         <div class="title_right">
         </div>
       </div>
     </div>
     <div class="clearfix"></div>

     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
           <div class="x_content">
             <br />
             <div class="form-horizontal form-label-left">
               <?= form_open_multipart('artikel/editArtikel'); ?>
               <input type="hidden" name="id" value="<?= $artikel['id']; ?>">
               <div class="form-group">
                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Judul Artikel</label>
                 <div class="col-md-6 col-sm-6 col-xs-12">
                   <input type="text" id="judul" name="judul" value="<?= $artikel['judul']; ?>" class="form-control col-md-7 col-xs-12">
                 </div>
               </div>
               <div class="form-group">
                 <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Kategori Artikel</label>
                 <div class="col-md-6 col-sm-6 col-xs-12">
                   <select class="form-control" name="kategori">
                     <option value="<?= $artikel['id_kat_kategori']; ?>">Kategori Sekarang =
                       <?php
                        if ($artikel['id_kat_kategori'] == 1) {
                          $artikel['id_kat_kategori'] = 'Sakit';
                        } elseif ($artikel['id_kat_kategori'] == 2) {
                          $artikel['id_kat_kategori'] = 'Chaos';
                        }
                        ?>
                       <?= $artikel['id_kat_kategori']; ?></option>
                     <?php foreach ($artikel_kat as $kat) : ?>
                       <option value="<?= $kat['id_kat_kategori']; ?>"><?= $kat['nama_kategori']; ?></option>
                     <?php endforeach; ?>
                   </select>
                 </div>
               </div>
               <div class="form-group">
                 <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Terbit </label>
                 <div class="col-md-6 col-sm-6 col-xs-12">
                   <div class='input-group date' id='datetimepicker7'>
                     <input type='text' class="form-control" name="tanggal" value="<?= (new DateTime($artikel['tanggal']))->format('d-m-Y'); ?>" required />
                     <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                   </div>
                 </div>
               </div>
               <div class="form-group">
                 <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto Artikel</label>
                 <div class="col-sm-3">
                   <img style="width: 150px; margin-bottom: 10px;" src="<?= base_url('assets/images/artikel/') . $artikel['image']; ?>" class="img-thumbnail">
                 </div>
                 <div class="col-md-3">
                   <input type="file" class="form-control" id="image" name="image" required><?= $artikel['image']; ?>
                 </div>
               </div>
               <div class="form-group">
                 <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Isi Artikel</label>
                 <div class="col-md-6 col-sm-6 col-xs-12">
                   <script>
                     $(document).ready(function() {
                       $('.content').richText();
                     });
                   </script>
                   <!-----------------pseodo text area-------->
                   <textarea id="php_post_text" name="php_post_text" placeholder="blog Description" class="form-control " style="display:none;"></textarea>
                   <!----------------MAIN TEXT EDITOR-------->
                   <textarea id="y" class="form-control content" name="example"><?= $artikel['isi']; ?></textarea>
                   <!---------------ON SUBMIT ASIGN VALUE OF PSEOUDO TEXT AREA WITH TEXT EDITOR-------->
                 </div>
               </div>
               <div class="form-group">
                 <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                   <a href="<?= base_url('admin/artikel'); ?>" class="btn btn-primary" type="reset">Batal</a>
                   <input type="submit" value="Ubah" class="btn btn-success" name="save_text" onclick="$('#php_post_text').val($('.content').val());">
                 </div>
               </div>
               </form>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
   <!-- /page content -->