<?php

    // koneksi ke database
    require "../../connection/koneksi_database.php";

    // set default timezone
    date_default_timezone_set("Asia/Jakarta");
    // buat function indo_date
    function indo_date($date) {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $pecahkah = explode("-", $date);

        return $pecahkah[0]." ".$bulan[(int)$pecahkah[1]]." ".$pecahkah[2];
    }

    // ambil semua aset yang sedang dimaintenance
    $ambilMaintenance = $conn->query("SELECT * FROM tbl_maintenance JOIN tbl_aset_masuk ON tbl_maintenance.id_aset_masuk = tbl_aset_masuk.id_aset_masuk");
    // ambil data pengguna(admin & kepsek) ditabel pengguna
    $ambilAdmin = $conn->query("SELECT * FROM tbl_pengguna WHERE jabatan = 'admin' ");
    $pecahAdmin = $ambilAdmin->fetch_assoc();
    $ambilKepsek = $conn->query("SELECT * FROM tbl_pengguna WHERE jabatan = 'kepala sekolah' ");
    $pecahKepsek = $ambilKepsek->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../../dist/imgs/favicon.png">
    <!-- Title -->
    <title>Laporan Aset Maintenance</title>

    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> 
    <!-- Custom styles for this template-->
    <link href="../../dist/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- CSS -->
    <style>
        * {
            color: #000000;
        }
    </style>

</head>
<body onload="window.print()">

    <br>

    <!-- cop/kepala -->
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-2 text-center">
                <img src="../../dist/imgs/img_export/logo_smp4cepiring_kendal.png" alt="Logo SMP4 Cop" width="60%">
            </div>
            <div class="col-md-10 col-sm-10 col-xs-10 text-center">
                <!-- <br> -->
                <h3>LAPORAN INVENTARIS ASET MAINTENANCE</h3>
                <h3>SMP N 04 CEPIRING KENDAL</h3>
                <h5>Jalan Kalirandugedhe Cepiring, Desa kalirandugedhe, Kendal, Jawa Tengah, Indonesia</h5>
            </div>
        </div>
    </div>

    <hr style="border: 3px solid #000;">

    <br>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Inventaris</th>
                    <th>Nama</th>
                    <th>Merek</th>
                    <th>Seri</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Biaya(Rp.)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    while($pecahMaintenance = $ambilMaintenance->fetch_assoc()) {
                ?>
                <tr>
                    <td><?=$no; ?></td>
                    <td><?=$pecahMaintenance["kode_inventaris"]; ?></td>
                    <td><?=$pecahMaintenance["nama_aset"]; ?></td>
                    <td><?=$pecahMaintenance["merek_aset"]; ?></td>
                    <td><?=$pecahMaintenance["seri_aset"]; ?></td>
                    <td><?=$pecahMaintenance["jumlah_maintenance"]; ?></td>
                    <td><?=$pecahMaintenance["tanggal_maintenance"]; ?></td>
                    <td><?=$pecahMaintenance["keterangan_maintenance"]; ?></td>
                    <td><?=$pecahMaintenance["status_maintenance"]; ?></td>
                    <td><?=number_format($pecahMaintenance["biaya_maintenance"]); ?></td>
                </tr>
                <?php
                    $no++;
                    }
                ?>
            </tbody>
        </table>
    </div>

    <br><br><br><br>

    <!-- signature/tanda tangan -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="row">
                    <div class="col-12 text-center">
                        <br>
                        <h6>Admin</h6>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <h6 class="text-capitalize"><?=$pecahAdmin["nama_lengkap"]; ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4"></div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="row">
                    <div class="col-12 text-center">
                        <h6>Kendal, <?=indo_date(date("d-m-Y")); ?></h6>
                        <h6>Kepala Sekolah</h6>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <h6 class="text-capitalize"><?=$pecahKepsek["nama_lengkap"]; ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- JS -->
    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../../dist/js/sb-admin-2.min.js"></script>
    
</body>
</html>