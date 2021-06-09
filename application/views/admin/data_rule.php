        <!-- page content -->
        <div class="right_col" role="main">
          <style>
            .aku {
              position: relative;
              display: flex;
              justify-content: center;
              align-items: center;
              flex-direction: column;
              background: rgb(76, 161, 175);
              background: linear-gradient(90deg, rgba(76, 161, 175, 1) 35%, rgba(196, 224, 229, 1) 100%);
            }

            .aku span {
              color: white;
              font-weight: 700;
              font-size: 18px;
            }

            @media only screen and (max-width: 600px) {
              .aku {
                display: flex;
                justify-content: center;
                align-items: center;
              }
            }
          </style>
          <div class="row">
            <?php foreach ($penyakit as $p) : ?>
              <div class="col-sm-6 col-md-4 col-xs-6">
                <div class="panel panel-default">
                  <div class="panel-body aku">
                    <span><?= $p['nama_penyakit']; ?></span>
                    <a href="<?= base_url('rule/penyakit/' . strtolower($p['nama_penyakit'])); ?>" style="margin-top: 10px;" class="btn btn-primary" role="button">Detail</a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <!-- /page content -->