<?php

	// koneksi ke database
    require "../../connection/koneksi_database.php";
    // ambil semua aset yang sedang dimaintenance
    $ambilMaintenance = $conn->query("SELECT * FROM tbl_maintenance JOIN tbl_aset_masuk ON tbl_maintenance.id_aset_masuk = tbl_aset_masuk.id_aset_masuk");

    // script export to excel
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Maintenance.xls");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Export Aset Maintenance to Excel</title>
</head>
<body>

    <div align="center">
        <h3>LAPORAN INVENTARIS ASET MAINTENANCE<br> SMP N 04 CEPIRING KENDAL<br> <span>Jalan Kalirandugedhe Cepiring, Desa kalirandugedhe, Kendal, Jawa Tengah, Indonesia</span></h3>
    </div>

	<table width="100%" cellspacing="0" cellpadding="10" border="2">
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
	
</body>
</html>