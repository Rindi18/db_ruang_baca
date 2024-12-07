<div class="col-sm-12">
    <?php 
        if ($anggota['verifikasi'] == 1) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Akun Anda Sudah Terverifikasi</h5>
            </div>
            
    <?php }else { ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-times"></i>Akun Anda Belum Terverifikasi</h5>
                Silahkan Menghubungi Petugas Ruang Baca Untuk Verifikasi Data !
            </div>
            
    <?php }?>


</div>

<div class="col-md-3">
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="img-fluid" src="<?= base_url('foto/' . $anggota['foto'])?>" width="250px">
            </div>
        </div>
    </div>
</div>

<div class="col-md-9">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul ?></h3>
            <div class="card-tools">
                <a href="<?= base_url('DashboardAnggota/EditProfil')?>" class="btn btn-primary btn-flat btn-sm">
                    <i class="fas fa-edit"></i>Edit Profile
                </a>
            </div>
        </div>
              <!-- /.card-header -->
        <div class="card-body">

            <table class="table">
                <tr>
                    <th width="150px">Nim</th>
                    <th width="50px">:</th>
                    <td><?= $anggota['nim'] ?></td>
                </tr>

                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>:</th>
                    <td><?= $anggota['nama_mahasiswa'] ?></td>
                </tr>

                <tr>
                    <th>Jenis Kelamin</th>
                    <th>:</th>
                    <td><?= $anggota['jenis_kelamin'] ?></td>
                </tr>

                <tr>
                    <th>Program Studi</th>
                    <th>:</th>
                    <td><?= $anggota['nama_angkatan'] ?></td>
                </tr>

                <tr>
                    <th>No Handphone</th>
                    <th>:</th>
                    <td><?= $anggota['no_hp'] ?></td>
                </tr>

                <tr>
                    <th>Alamat</th>
                    <th>:</th>
                    <td><?= $anggota['alamat'] ?></td>
                </tr>

            </table>

        </div>
    </div>
</div>