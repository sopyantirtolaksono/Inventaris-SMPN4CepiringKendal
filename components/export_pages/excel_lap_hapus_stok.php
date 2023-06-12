<?php

	// koneksi ke database
    require "../../connection/koneksi_database.php";
    // ambil semua data stok yang dihapus di tabel hapus stok
    $ambilHapusStok = $conn->query("SELECT * FROM tbl_hapus_stok");

    // script export to excel
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Hapus Stok.xls");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Export Hapus Stok to Excel</title>
</head>
<body>

    <div align="center">
        <h3>LAPORAN INVENTARIS HAPUS STOK<br> SMP N 04 CEPIRING KENDAL<br> <span>Jalan Kalirandugedhe Cepiring, Desa kalirandugedhe, Kendal, Jawa Tengah, Indonesia</span></h3>
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
                <th>Keterangan Aset</th>
                <th>Tanggal Hapus</th>
                <th>Keterangan Hapus</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                while($pecahHapusStok = $ambilHapusStok->fetch_assoc()) {
            ?>
            <tr>
                <td><?=$no; ?></td>
                <td><?=$pecahHapusStok["kode_inventaris"]; ?></td>
                <td><?=$pecahHapusStok["nama_aset"]; ?></td>
                <td><?=$pecahHapusStok["merek_aset"]; ?></td>
                <td><?=$pecahHapusStok["seri_aset"]; ?></td>
                <td><?=$pecahHapusStok["jumlah_stok"]; ?></td>
                <td><?=number_format($pecahHapusStok["harga_satuan_aset"]); ?></td>
                <td><?=$pecahHapusStok["kondisi_aset"]; ?></td>
                <td><?=$pecahHapusStok["sumber_aset"]; ?></td>
                <td><?=$pecahHapusStok["tanggal_masuk_aset"]; ?></td>
                <td><?=$pecahHapusStok["keterangan_aset"]; ?></td>
                <td><?=$pecahHapusStok["tanggal_hapus_stok"]; ?></td>
                <td><?=$pecahHapusStok["keterangan_hapus_stok"]; ?></td>
            </tr>
            <?php 
                $no++;
                }
            ?>
        </tbody>
    </table>
	
</body>
</html>