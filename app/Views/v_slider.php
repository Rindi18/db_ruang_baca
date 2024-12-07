<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>

        </div>
              <!-- /.card-header -->
        <div class="card-body">

            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('pesan');
                echo '</h5></div>';
            }
            ?>

            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th width='50px'>No</th>
                        <th>Gambar Slider</th>
                        <th width='100px'>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; 
                    foreach ($slider as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td class="text-center"><img class="img-fluid" src="<?= base_url('slider/' . $value['slider']) ?>" width="500px"></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-flat btn-sm" data-toggle="modal" data-target="#modal-edit<?= $value['id_slider']?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                  <?php } ?>
                </tbody>
            </table>     
        </div>
    </div>
              
</div>

<!-- Modal Edit -->
<?php $no = 1;
 foreach ($slider as $key => $value) { ?>
  <div class="modal fade" id="modal-edit<?= $value['id_slider']?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit<?= $judul?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart(base_url('Pengaturan/EditSlider/' . $value['id_slider']))  ?>
                    <div class="form-group"> 
                        <img class="img-fluid" src="<?= base_url('slider/' . $value['slider']) ?>" width="800px">
                        <input type="file" class="form-control" name="slider" required>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning btn-flat">Simpan</button>
                </div>
                <?php echo form_close() ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div> 
<?php } ?>