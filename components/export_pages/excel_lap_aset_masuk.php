<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";
	// ambil semua data aset pada tabel aset masuk
    $ambilAset = $conn->query("SELECT * FROM tbl_aset_masuk");

    // script export to excel
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Aset Masuk.xls");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Export Aset Masuk to Excel</title>
</head>
<body>

    <div align="center">
        <h3>LAPORAN INVENTARIS ASET MASUK<br> SMP N 04 CEPIRING KENDAL<br> <span>Jalan Kalirandugedhe Cepiring, Desa kalirandugedhe, Kendal, Jawa Tengah, Indonesia</span></h3>
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
                <th>Harga Satuan(Rp.)</th>
                <th>Kondisi</th>
                <th>Sumber</th>
                <th>Tanggal Masuk</th>
                <th>Keterangan</th>
                <th>Total Harga(Rp.)</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                $totalHarga = 0;
                while($pecahAset = $ambilAset->fetch_assoc()) {
                    // script total harga
                    $hargaSatuan = $pecahAset["harga_satuan_aset"];
                    $jumlahAset = $pecahAset["jumlah_aset"];
                    $totalHarga = $hargaSatuan * $jumlahAset;
            ?>
            <tr>
                <td><?=$no; ?></td>
                <td><?=$pecahAset["kode_inventaris"]; ?></td>
                <td><?=$pecahAset["nama_aset"]; ?></td>
                <td><?=$pecahAset["merek_aset"]; ?></td>
                <td><?=$pecahAset["seri_aset"]; ?></td>
                <td><?=$pecahAset["jumlah_aset"]; ?></td>
                <td><?=number_format($pecahAset["harga_satuan_aset"]); ?></td>
                <td><?=$pecahAset["kondisi_aset"]; ?></td>
                <td><?=$pecahAset["sumber_aset"]; ?></td>
                <td><?=$pecahAset["tanggal_masuk_aset"]; ?></td>
                <td><?=$pecahAset["keterangan_aset"]; ?></td>
                <td><?=number_format($totalHarga); ?></td>
            </tr>
            <?php
                $no++;
                }
            ?>
        </tbody>
    </table>
	
</body>
</html>