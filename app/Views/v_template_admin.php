<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ruang Baca |<?= $judul ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('adminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('adminLTE') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('adminLTE') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('adminLTE') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('adminLTE') ?>/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">

<?php
    $db = \Config\Database::connect();
    $web = $db->table('tbl_web')
            ->where('id_web', '1')
            ->get()->getRowArray();

    $user = $db->table('tbl_user')
            ->where('id_user', session()->get('id_user'))
            ->get()->getRowArray();

   ?>

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <h3><b><?= $web['nama_fakultas'] ?></b></h3>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

    
      <li class="nav-item">
        <a  class="nav-link" href="<?= base_url('Auth/Logout') ?>">
          <i class="fas fa-sign-out-alt"></i>Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('Admin')?>" class="brand-link">
      <img src="<?= base_url('logo/' . $web['logo']) ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Ruang Baca</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('adminLTE') ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $user['nama_user']?></a>
          <?php 
          if ($user['level'] == 0) {
            echo '<a class="text-success"><i class="fa fa-check-circle"></i>Admin</a>';
          }else {
            echo '<a class="text-primary"><i class="fa fa-check-circle"></i>Petugas</a>';
          }
          ?>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= base_url('Admin')?>" class="nav-link <?= $menu == 'dashboard' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item <?= $menu == 'peminjaman' ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?= $menu == 'peminjaman' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-swatchbook"></i>
              <p>Peminjaman<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Admin/PengajuanMasuk')?>" class="nav-link <?= $submenu == 'pengajuanmasuk' ? 'active' : '' ?>">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Pengajuan Masuk</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Admin/PengajuanDiterima')?>" class="nav-link <?= $submenu == 'pengajuanditerima' ? 'active' : '' ?>">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Diterima</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Admin/PengajuanDitolak')?>" class="nav-link <?= $submenu == 'pengajuanditolak' ? 'active' : '' ?>">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Ditolak</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item <?= $menu == 'masterbuku' ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?= $menu == 'masterbuku' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-book"></i>
              <p>Master Buku<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Buku')?>" class="nav-link <?= $submenu == 'buku' ? 'active' : '' ?>">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Buku</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Kategori')?>" class="nav-link <?= $submenu == 'kategori' ? 'active' : '' ?>">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Rak')?>" class="nav-link <?= $submenu == 'rak' ? 'active' : '' ?>">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Rak</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Penerbit')?>" class="nav-link <?= $submenu == 'penerbit' ? 'active' : '' ?>">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Penerbit</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Penulis')?>" class="nav-link <?= $submenu == 'penulis' ? 'active' : '' ?>">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Penulis</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <?= $menu == 'masteranggota' ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?= $menu == 'masteranggota' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>Master Anggota<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Anggota')?>" class="nav-link <?= $submenu == 'anggota' ? 'active' : '' ?>">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Anggota</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Angkatan')?>" class="nav-link <?= $submenu == 'angkatan' ? 'active' : '' ?>">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Program Studi</p>
                </a>
              </li>
            </ul>
          </li>

          <?php if (session()->get('level') == "0") {
            ?>


          <li class="nav-item <?= $menu == 'pengaturan' ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?= $menu == 'pengaturan' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>Pengaturan<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?= base_url('User')?>" class="nav-link <?= $submenu == 'user' ? 'active' : '' ?>">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Pengaturan/web')?>" class="nav-link <?= $submenu == 'web' ? 'active' : '' ?>">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Web</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('Pengaturan/Slider')?>" class="nav-link <?= $submenu == 'slider' ? 'active' : '' ?>">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Slider</p>
                </a>
              </li>
            </ul>
          </li>

          <?php } ?>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $judul?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

            <?php 

            if ($page) {
                echo view($page);
            }
            
            ?>
        
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?= date('Y')?> <a href="<?= base_url()?>">Ruang Baca <?= $web['nama_fakultas']?></a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url('adminLTE') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('adminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('adminLTE') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('adminLTE') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('adminLTE') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('adminLTE') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('adminLTE') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('adminLTE') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('adminLTE') ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('adminLTE') ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('adminLTE') ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('adminLTE') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('adminLTE') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('adminLTE') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('adminLTE') ?>/dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "paging": true,
      "responsive": true, 
      "lengthChange": true, 
      "autoWidth": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>


<script>
  function bacaGambar(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#gambar_load').attr('src',e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $('#preview_gambar').change(function() {
    bacaGambar(this);
  });
</script>

</body>
</html>
