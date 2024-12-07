<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form <?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <?php 
        echo form_open_multipart('Pengaturan/UpdateWeb');
        ?>
            <div class="card-body">
            <?php 
            //notifikasi
            $errors = session()->getFlashdata('errors');
            if (!empty($errors)) { ?>
                <div class="alert alert-danger" role="alert"> 
                    <h4>Periksa Entry Form</h4>
                    <ul>
                        <?php foreach ($errors as $key => $error) { ?>
                            <li> <?= esc($error) ?></li>
                    <?php } ?>
                    </ul>
                </div>
            <?php }?>

            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('pesan');
                echo '</h5></div>';
            }
            ?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Logo Fakultas</label>
                                    <img src="<?= base_url('logo/' . $web['logo'])?>" width="150px" height="150px">
                                </div>
                                <div class="form-group">
                                    <label>Ganti Logo</label>
                                    <input type="file" name="logo" class="form-control" accept="image/*">
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama Fakultas</label>
                                    <input class="form-control" name="nama_fakultas" value="<?= $web['nama_fakultas'] ?>" placeholder="Nama Fakultas">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input class="form-control" name="alamat" value="<?= $web['alamat'] ?>"placeholder="Alamat">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input class="form-control" name="kecamatan" value="<?= $web['kecamatan'] ?>"placeholder="Alamat">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Kabupaten / Kota</label>
                                    <input class="form-control" name="kab_kota" value="<?= $web['kab_kota'] ?>" placeholder="Kabupaten / Kota">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Kode Pos</label>
                                    <input class="form-control" name="kode_pos" value="<?= $web['kode_pos'] ?>" placeholder="Kode Pos">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Kontak</label>
                                    <input class="form-control" name="kontak" value="<?= $web['kontak'] ?>" placeholder="Kontak">
                                </div>
                            </div>

                        </div>
                            
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Sejarah</label>
                            <textarea rows="5" cols="" class="form-control" name="sejarah"><?= $web['sejarah'] ?></textarea>
                        </div>

                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Visi</label>
                            <textarea rows="5" cols="" class="form-control" name="visi"><?= $web['visi'] ?></textarea>
                        </div>

                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Misi</label>
                            <textarea rows="5" cols="" class="form-control" name="misi"><?= $web['misi'] ?></textarea>
                        </div>

                    </div>
                </div>
                
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="<?= base_url('User')?>" class="btn btn-warning"><i class="fas fa-share"></i> Kembali</a>
            </div>
        <?php echo form_close() ?>
    </div>
</div>
            <!-- /.card -->