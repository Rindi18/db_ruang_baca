<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form <?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
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

        <?php 
        echo form_open_multipart('Anggota/SimpanData');
        ?>
        <div class="row">
        <div class="col-sm-2">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Foto</label>
                        <img src="<?= base_url('foto/foton.jpg') ?>" id="gambar_load" class="img-fluid" width="200px" height="200px">
                    </div>
                </div>
                <div class="col-sm-12">
                        <div class="form-group">
                            <label>File Foto</label>
                            <input type="file" name="foto" class="form-control" id="preview_gambar" accept="image/*">
                        </div>
                </div>
            </div>
        </div>

            <div class="col-sm-10">
                <div class="row">
                <div class="col-sm-6">
                        <div class="form-group">
                            <label>NIM</label>
                            <input class="form-control" name="nim" value="<?= old('nim') ?>" placeholder="NIM">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Mahasiswa</label>
                            <input class="form-control" name="nama_mahasiswa" value="<?= old('nama_mahasiswa') ?>" placeholder="Nama Mahasiswa">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="">--Pilih Jenis Kelamin--</option>
                                <option value="Laki-Laki">--Laki-Laki--</option>
                                <option value="Perempuan">--Perempuan--</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Program Studi</label>
                            <select name="angkatan" class="form-control">
                                <option value="">--Pilih Program Studi--</option>
                                <?php foreach ($angkatan as $key => $value) {?>
                                    <option value="<?= $value['id_angkatan'] ?>"><?= $value['nama_angkatan'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input class="form-control" name="alamat" value="<?= old('alamat') ?>"placeholder="Alamat">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>No Handphone</label>
                            <input class="form-control" name="no_hp" value="<?= old('no_hp') ?>" placeholder="No Handphone">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" name="password" value="<?= old('password') ?>" placeholder="Password">
                        </div>
                    </div>

                    

                </div>
            </div>
    </div>
    </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();"><i class="fas fa-save"></i> Simpan</button>
                <a href="<?= base_url('Anggota')?>" class="btn btn-warning"><i class="fas fa-share"></i> Kembali</a>
            </div>
        <?php echo form_close() ?>
    </div>
</div>
            <!-- /.card -->