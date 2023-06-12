<?php

	// koneksi ke database
    require "../../connection/koneksi_database.php";
    // ambil semua data aset yang dihapus di tabel hapus aset
    $ambilHapusAset = $conn->query("SELECT * FROM tbl_hapus_aset");

    // script export to excel
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Hapus Aset.xls");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Export Hapus Aset to Excel</title>
</head>
<body>

    <div align="center">
        <h3>LAPORAN INVENTARIS HAPUS ASET<br> SMP N 04 CEPIRING KENDAL<br> <span>Jalan Kalirandugedhe Cepiring, Desa kalirandugedhe, Kendal, Jawa Tengah, Indonesia</span></h3>
    </div>

	<table width="100%" cellspacing="0" cellpadding="10" border="2">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Inventaris</th>
                <th>Nama</th>
                <th>Merek</th>
                <th>Seri</th>
                <th>Jumlah Aset</th>
                <th>Jumlah Maintenance</th>
                <th>Harga Satuan(Rp.)</th>
                <th>Kondisi</th>
                <th>Sumber</th>
                <th>Tanggal Masuk</th>
                <th>Keterangan Aset</th>
                <th>Tanggal Hapus</th>
                <th>Keterangan Hapus</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                while($pecahHapusAset = $ambilHapusAset->fetch_assoc()) {
            ?>
            <tr>
                <td><?=$no; ?></td>
                <td><?=$pecahHapusAset["kode_inventaris"]; ?></td>
                <td><?=$pecahHapusAset["nama_aset"]; ?></td>
                <td><?=$pecahHapusAset["merek_aset"]; ?></td>
                <td><?=$pecahHapusAset["seri_aset"]; ?></td>
                <td><?=$pecahHapusAset["jumlah_aset"]; ?></td>
                <?php
                    // jika jml maintenance kosong & tdk kosong
                    if($pecahHapusAset["jumlah_maintenance"] == 0) {
                ?>
                <td>Kosong</td>
                <?php } else { ?>
                <td><?=$pecahHapusAset["jumlah_maintenance"]; ?></td>
                <?php } ?>
                <td><?=number_format($pecahHapusAset["harga_satuan_aset"]); ?></td>
                <td><?=$pecahHapusAset["kondisi_aset"]; ?></td>
                <td><?=$pecahHapusAset["sumber_aset"]; ?></td>
                <td><?=$pecahHapusAset["tanggal_masuk_aset"]; ?></td>
                <td><?=$pecahHapusAset["keterangan_aset"]; ?></td>
                <td><?=$pecahHapusAset["tanggal_hapus_aset"]; ?></td>
                <td><?=$pecahHapusAset["keterangan_hapus_aset"]; ?></td>
            </tr>
            <?php 
                $no++;
                }
            ?>
        </tbody>
    </table>
	
</body>
</html>