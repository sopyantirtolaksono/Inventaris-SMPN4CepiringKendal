<?php

	// koneksi ke database
    require "../../connection/koneksi_database.php";
    // ambil semua aset yang selesai dimaintenance
    $ambilSelesaiMain = $conn->query("SELECT * FROM tbl_selesai_maintenance");

    // script export to excel
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Maintenance Selesai.xls");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Export Aset Maintenance Selesai to Excel</title>
</head>
<body>

    <div align="center">
        <h3>LAPORAN INVENTARIS ASET MAINTENANCE SELESAI<br> SMP N 04 CEPIRING KENDAL<br> <span>Jalan Kalirandugedhe Cepiring, Desa kalirandugedhe, Kendal, Jawa Tengah, Indonesia</span></h3>
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
                <th>Tanggal Maintenance</th>
                <th>Tanggal Selesai</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Biaya Maintenance(Rp.)</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                while($pecahSelesaiMain = $ambilSelesaiMain->fetch_assoc()) {
            ?>
            <tr>
                <td><?=$no; ?></td>
                <td><?=$pecahSelesaiMain["kode_inventaris"]; ?></td>
                <td><?=$pecahSelesaiMain["nama_aset"]; ?></td>
                <td><?=$pecahSelesaiMain["merek_aset"]; ?></td>
                <td><?=$pecahSelesaiMain["seri_aset"]; ?></td>
                <td><?=$pecahSelesaiMain["jumlah_maintenance"]; ?></td>
                <td><?=$pecahSelesaiMain["tanggal_maintenance"]; ?></td>
                <td><?=$pecahSelesaiMain["tanggal_selesai_maintenance"]; ?></td>
                <td><?=$pecahSelesaiMain["keterangan_maintenance"]; ?></td>
                <td><?=$pecahSelesaiMain["status_maintenance"]; ?></td>
                <td><?=number_format($pecahSelesaiMain["biaya_maintenance"]); ?></td>
            </tr>
            <?php
                $no++;
                }
            ?>
        </tbody>
    </table>
	
</body>
</html>