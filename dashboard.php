<?php

    // mengambil data dari tabel aset masuk
    $ambilAsetMasuk = $conn->query("SELECT * FROM tbl_aset_masuk");
    // jml data aset masuk
    $jmlAsetMasuk   = $ambilAsetMasuk->num_rows;

    // mengambil data dari tabel maintenance
    $ambilMaintenance = $conn->query("SELECT * FROM tbl_maintenance");
    // jml data maintenance
    $jmlMaintenance   = $ambilMaintenance->num_rows;

    // mengambil data dari tabel hapus aset
    $ambilHapusAset = $conn->query("SELECT * FROM tbl_hapus_aset");
    // jml data aset terhapus
    $jmlHapusAset   = $ambilHapusAset->num_rows;

    // mengambil data dari tabel selesai maintenance
    $ambilSelesaiMaint = $conn->query("SELECT * FROM tbl_selesai_maintenance");
    // jml data aset yang selesai maintenance
    $jmlSelesaiMaint   = $ambilSelesaiMaint->num_rows;

?>

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <?php require "components/navbar.php"; ?>
    <!-- End Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- alert selamat datang -->
        <?php

            if(isset($_GET["p"])) {
                if($_GET["p"] === "1") {

        ?>

        <!-- Page Heading -->
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong class="text-capitalize">Selamat Datang <?=$_SESSION["pengguna"]["nama_lengkap"]; ?>!</strong> di Website Inventaris SMPN 04 Cepiring Kendal.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <?php

                }
            }

        ?>

        <!-- Carausel -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img src="dist/imgs/img_banner_dashboard/4.jpg" class="d-block w-100" height="450" alt="banner-1">
                    </div>
                    <div class="carousel-item">
                      <img src="dist/imgs/img_banner_dashboard/5.jpg" class="d-block w-100" height="450" alt="banner-2">
                    </div>
                    <div class="carousel-item">
                      <img src="dist/imgs/img_banner_dashboard/3.jpg" class="d-block w-100" height="450" alt="banner-3">
                    </div>
                    <div class="carousel-item">
                      <img src="dist/imgs/img_banner_dashboard/2.jpg" class="d-block w-100" height="450" alt="banner-4">
                    </div>
                    <div class="carousel-item">
                      <img src="dist/imgs/img_banner_dashboard/1.jpg" class="d-block w-100" height="450" alt="banner-5">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                </div>
            </div>
        </div>
        <!-- End Carausel -->

        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Aset Masuk</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jmlAsetMasuk; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-download fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Maintenance</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jmlMaintenance; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-upload fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Selesai Maintenance</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jmlSelesaiMaint; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-upload fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Penghapusan Aset</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jmlHapusAset; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-upload fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modals -->
<?php require "components/modals.php"; ?>
<!-- End Modals