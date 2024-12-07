<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul ?></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#modal-sm">
                    <i class="fas fa-plus"></i>Add
                </button>
            </div>
                <!-- /.card-tools -->
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
                        <th>Program Studi </th>
                        <th width='100px'>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; 
                    foreach ($angkatan as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td><?= $value['nama_angkatan'] ?></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-flat btn-sm" data-toggle="modal" data-target="#modal-edit<?= $value['id_angkatan']?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#modal-delete<?= $value['id_angkatan']?>">
                                    <i class="fas fa-trash"></i>
                                 </button>
                            </td>
                        </tr>
                  <?php } ?>
                </tbody>
            </table>     
        </div>
    </div>
              
</div>

 <!-- Modal Add -->  
  <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah <?= $judul?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open(base_url('Angkatan/AddData')) ?>
                    <div class="form-group"> 
                        <label>Program Studi</label>
                        <input class="form-control" name="nama_angkatan" placeholder="Nama Angkatan" required>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
                </div>
                <?php echo form_close() ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>  
    
<!-- Modal Edit -->
<?php foreach ($angkatan as $key => $value) { ?>
  <div class="modal fade" id="modal-edit<?= $value['id_angkatan']?>">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Program Studi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open(base_url('Angkatan/EditData/' . $value['id_angkatan']))  ?>
                    <div class="form-group"> 
                        <label>Program Studi</label>
                        <input class="form-control" value="<?= $value['nama_angkatan']?>" name="nama_angkatan" placeholder="Nama Angkatan" required>
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

<!-- Modal delete -->
<?php foreach ($angkatan as $key => $value) { ?>
  <div class="modal fade" id="modal-delete<?= $value['id_angkatan']?>">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open(base_url('Angkatan/DeleteData/' . $value['id_angkatan']))  ?>
                    <div class="form-group"> 
                        Apakah Yakin Hapus Data <b><?= $value['nama_angkatan'] ?></b>..? 
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger btn-flat">Delete</button>
                </div>
                <?php echo form_close() ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div> 
<?php } ?>