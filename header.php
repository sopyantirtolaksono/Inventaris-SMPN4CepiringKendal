<?php

    // koneksi ke database
    require "connection/koneksi_database.php";

    // cek cookienya
    if(isset($_COOKIE["idC"]) && isset($_COOKIE["keyC"])) {
        // ambil value cookienya
        $idC   = $_COOKIE["idC"];
        $keyC  = $_COOKIE["keyC"];

        // ambil data pengguna dari tabel pengguna
        $ambilPenggunaC = $conn->query("SELECT * FROM tbl_pengguna WHERE id_pengguna = '$idC' ");
        $pecahPenggunaC = $ambilPenggunaC->fetch_assoc();

        // cek/verifikasi value keyC dengan username pengguna pada tabel pengguna
        if($keyC === hash("sha256", $pecahPenggunaC["username"])) {
          // jika cocok/sama, set session pengguna
          $_SESSION["pengguna"] = $pecahPenggunaC;
        }

    }

    // cek jika belum ada session pengguna
    if(!isset($_SESSION["pengguna"])) {
        // alihkan kembali pada halaman login
        echo "<script>location='login.php';</script>";
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="dist/imgs/favicon.png">

    <!-- Title -->
    <title>Web Inventaris SMPN 04 Cepiring</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="dist/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- JS(jQuery) -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- VanillaJS(Sweetalert) -->
    <script src="dist/js/sweetalert/sweetalert-script.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-book"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Inventaris</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <?php if($_GET["halaman"] == "dashboard") { ?>

            <li class="nav-item active">
                <a class="nav-link" href="index.php?halaman=dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <?php } else { ?>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <?php } ?>

            <!-- jika yang login akun admin -->
            <?php if($_SESSION["pengguna"]["jabatan"] === "admin") { ?>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Management Aset
            </div>

            <!-- Nav Item - Aset Masuk -->
            <?php if($_GET["halaman"] == "aset_masuk") { ?>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?halaman=aset_masuk">
                    <i class="fas fa-download"></i>
                    <span>Aset Masuk</span></a>
            </li>
            <?php } else if($_GET["halaman"] == "edit_aset") { ?>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?halaman=aset_masuk">
                    <i class="fas fa-download"></i>
                    <span>Aset Masuk</span></a>
            </li>
            <?php } else { ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=aset_masuk">
                    <i class="fas fa-download"></i>
                    <span>Aset Masuk</span></a>
            </li>
            <?php } ?>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php if($_GET["halaman"] == "maintenance") { ?>

            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-upload"></i>
                    <span>Aset Keluar</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu:</h6>
                        <a class="collapse-item active" href="index.php?halaman=maintenance">Maintenance</a>
                        <a class="collapse-item" href="index.php?halaman=penghapusan">Penghapusan</a>
                    </div>
                </div>
            </li>

            <?php } else if($_GET["halaman"] == "input_maintenance") { ?>

            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-upload"></i>
                    <span>Aset Keluar</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu:</h6>
                        <a class="collapse-item active" href="index.php?halaman=maintenance">Maintenance</a>
                        <a class="collapse-item" href="index.php?halaman=penghapusan">Penghapusan</a>
                    </div>
                </div>
            </li>

            <?php } else if($_GET["halaman"] == "penghapusan") { ?>

            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-upload"></i>
                    <span>Aset Keluar</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu:</h6>
                        <a class="collapse-item" href="index.php?halaman=maintenance">Maintenance</a>
                        <a class="collapse-item active" href="index.php?halaman=penghapusan">Penghapusan</a>
                    </div>
                </div>
            </li>

            <?php } else { ?>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-upload"></i>
                    <span>Aset Keluar</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu:</h6>
                        <a class="collapse-item" href="index.php?halaman=maintenance">Maintenance</a>
                        <a class="collapse-item" href="index.php?halaman=penghapusan">Penghapusan</a>
                    </div>
                </div>
            </li>

            <?php } ?>

            <?php } ?>
            <!-- End menu admin -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Laporan
            </div>

            <!-- Nav Item - Aset Masuk -->
            <?php if($_GET["halaman"] == "lap_aset_masuk") { ?>

            <li class="nav-item active">
                <a class="nav-link" href="index.php?halaman=lap_aset_masuk">
                    <i class="fas fa-file-download"></i>
                    <span>Lap. Aset Masuk</span></a>
            </li>

            <?php } else { ?>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=lap_aset_masuk">
                    <i class="fas fa-file-download"></i>
                    <span>Lap. Aset Masuk</span></a>
            </li>

            <?php } ?>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php if($_GET["halaman"] == "lap_maintenance") { ?>

            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-file-upload"></i>
                    <span>Lap. Aset Keluar</span>
                </a>
                <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu:</h6>
                        <a class="collapse-item active" href="index.php?halaman=lap_maintenance">Maintenance</a>
                        <a class="collapse-item" href="index.php?halaman=lap_penghapusan">Penghapusan</a>
                    </div>
                </div>
            </li>

            <?php } else if($_GET["halaman"] == "lap_penghapusan") { ?>

            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-file-upload"></i>
                    <span>Lap. Aset Keluar</span>
                </a>
                <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu:</h6>
                        <a class="collapse-item" href="index.php?halaman=lap_maintenance">Maintenance</a>
                        <a class="collapse-item active" href="index.php?halaman=lap_penghapusan">Penghapusan</a>
                    </div>
                </div>
            </li>

            <?php } else { ?>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-file-upload"></i>
                    <span>Lap. Aset Keluar</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu:</h6>
                        <a class="collapse-item" href="index.php?halaman=lap_maintenance">Maintenance</a>
                        <a class="collapse-item" href="index.php?halaman=lap_penghapusan">Penghapusan</a>
                    </div>
                </div>
            </li>

            <?php } ?>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Keluar -->
            <li class="nav-item">
                <a href="logout.php" class="nav-link" id="link-logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->