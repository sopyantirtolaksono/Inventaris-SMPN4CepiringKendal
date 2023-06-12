<?php

    // cek jika ada session kepala sekolah
    $kepSek = $_SESSION["pengguna"]["jabatan"];
    if($kepSek === "kepala sekolah") {
        // alihkan ke halaman dashboard kepala sekolah
        echo "<script>location='index.php';</script>";
        exit();
    }

    // ambil semua data aset yang masuk pada tabel aset masuk (untuk data hapus aset)
    $ambilAset = $conn->query("SELECT * FROM tbl_aset_masuk ORDER BY id_aset_masuk DESC");
    // ambil semua data aset yang masuk pada tabel aset masuk (untuk data hapus stok)
    $ambilStok = $conn->query("SELECT * FROM tbl_aset_masuk ORDER BY id_aset_masuk DESC");
    // ambil semua data aset yang dihapus di tabel hapus aset
    $ambilHapusAset = $conn->query("SELECT * FROM tbl_hapus_aset ORDER BY id_hapus_aset DESC");
    // ambil semua data stok yang dihapus di tabel hapus stok
    $ambilHapusStok = $conn->query("SELECT * FROM tbl_hapus_stok ORDER BY id_hapus_stok DESC");

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
            <h1 class="h3 mb-0 text-gray-800">Penghapusan</h1>
        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Input Penghapusan</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">

                    	<ul class="nav nav-tabs" id="myTab" role="tablist">
						  	<li class="nav-item" role="presentation">
						    	<a class="nav-link active" id="hapus-aset-tab" data-toggle="tab" href="#hapus-aset" role="tab" aria-controls="hapus-aset" aria-selected="true">Hapus Aset</a>
						  	</li>
						  	<li class="nav-item" role="presentation">
						    	<a class="nav-link" id="hapus-stok-tab" data-toggle="tab" href="#hapus-stok" role="tab" aria-controls="hapus-stok" aria-selected="false">Hapus Stok</a>
						  	</li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="riwayat-hapus-aset-tab" data-toggle="tab" href="#riwayat-hapus-aset" role="tab" aria-controls="riwayat-hapus-aset" aria-selected="false">Riwayat Hapus Aset</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="riwayat-hapus-stok-tab" data-toggle="tab" href="#riwayat-hapus-stok" role="tab" aria-controls="riwayat-hapus-stok" aria-selected="false">Riwayat Hapus Stok</a>
                            </li>
						</ul>
						<div class="tab-content" id="myTabContent">
						  	<div class="tab-pane fade show active" id="hapus-aset" role="tabpanel" aria-labelledby="hapus-aset-tab">
						  		
						  		<div class="table-responsive mt-3">
                                    <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Aksi</th>
                                                <th>Kode Inventaris</th>
                                                <th>Nama</th>
                                                <th>Merek</th>
                                                <th>Seri</th>
                                                <th>Jumlah</th>
                                                <th>Gambar</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Aksi</th>
                                                <th>Kode Inventaris</th>
                                                <th>Nama</th>
                                                <th>Merek</th>
                                                <th>Seri</th>
                                                <th>Jumlah</th>
                                                <th>Gambar</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php 
                                                $no = 1;
                                                while($pecahAset = $ambilAset->fetch_assoc()) { 
                                            ?>
                                            <tr>
                                                <td><?=$no; ?></td>
                                                <td>
                                                    <a href="index.php?halaman=hapus_aset&id=<?=$pecahAset['id_aset_masuk']; ?>" class="btn btn-danger btn-sm btn-block">Hapus Aset</a>
                                                </td>
                                                <td><?=$pecahAset["kode_inventaris"]; ?></td>
                                                <td><?=$pecahAset["nama_aset"]; ?></td>
                                                <td><?=$pecahAset["merek_aset"]; ?></td>
                                                <td><?=$pecahAset["seri_aset"]; ?></td>

                                                <?php if($pecahAset["jumlah_aset"] > 0) { ?>
                                                <td><?=$pecahAset["jumlah_aset"]; ?></td>
                                                <?php } else { ?>
                                                <td>Kosong</td>
                                                <?php } ?>
                                                
                                                <td>
                                                    <img src="dist/imgs/img_asset/<?=$pecahAset['gambar_aset']; ?>" class="img-thumbnail" alt="Gambar aset.">
                                                </td>
                                            </tr>
                                            <?php 
                                                $no++;
                                                } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

						  	</div>

						  	<div class="tab-pane fade" id="hapus-stok" role="tabpanel" aria-labelledby="hapus-stok-tab">

						  		<div class="table-responsive mt-3">
                                    <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Aksi</th>
                                                <th>Kode Inventaris</th>
                                                <th>Nama</th>
                                                <th>Merek</th>
                                                <th>Seri</th>
                                                <th>Jumlah</th>
                                                <th>Gambar</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Aksi</th>
                                                <th>Kode Inventaris</th>
                                                <th>Nama</th>
                                                <th>Merek</th>
                                                <th>Seri</th>
                                                <th>Jumlah</th>
                                                <th>Gambar</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php 
                                                $no = 1;
                                                while($pecahStok = $ambilStok->fetch_assoc()) { 
                                            ?>
                                            <tr>
                                                <td><?=$no; ?></td>
                                                <td>
                                                    <a href="index.php?halaman=hapus_stok&id=<?=$pecahStok['id_aset_masuk']; ?>" class="btn btn-danger btn-sm btn-block">Hapus Stok</a>
                                                </td>
                                                <td><?=$pecahStok["kode_inventaris"]; ?></td>
                                                <td><?=$pecahStok["nama_aset"]; ?></td>
                                                <td><?=$pecahStok["merek_aset"]; ?></td>
                                                <td><?=$pecahStok["seri_aset"]; ?></td>

                                                <?php if($pecahStok["jumlah_aset"] > 0) { ?>
                                                <td><?=$pecahStok["jumlah_aset"]; ?></td>
                                                <?php } else { ?>
                                                <td>Kosong</td>
                                                <?php } ?>

                                                <td>
                                                    <img src="dist/imgs/img_asset/<?=$pecahStok['gambar_aset']; ?>" class="img-thumbnail" alt="Gambar aset.">
                                                </td>
                                            </tr>
                                            <?php 
                                                $no++;
                                                } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
						  		
						  	</div>

                            <div class="tab-pane fade" id="riwayat-hapus-aset" role="tabpanel" aria-labelledby="riwayat-hapus-aset-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Inventaris</th>
                                                <th>Nama</th>
                                                <th>Merek</th>
                                                <th>Seri</th>
                                                <th>Jumlah Aset</th>
                                                <th>Jumlah Maintenance</th>
                                                <th>Harga Satuan</th>
                                                <th>Kondisi</th>
                                                <th>Sumber</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Keterangan Aset</th>
                                                <th>Tanggal Hapus</th>
                                                <th>Keterangan Hapus</th>
                                                <th>Gambar</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Inventaris</th>
                                                <th>Nama</th>
                                                <th>Merek</th>
                                                <th>Seri</th>
                                                <th>Jumlah Aset</th>
                                                <th>Jumlah Maintenance</th>
                                                <th>Harga Satuan</th>
                                                <th>Kondisi</th>
                                                <th>Sumber</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Keterangan Aset</th>
                                                <th>Tanggal Hapus</th>
                                                <th>Keterangan Hapus</th>
                                                <th>Gambar</th>
                                            </tr>
                                        </tfoot>
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
                                                <td>
                                                    <img src="dist/imgs/img_asset/<?=$pecahHapusAset['gambar_aset']; ?>" alt="Gambar aset" class="img-thumbnail">
                                                </td>
                                            </tr>
                                            <?php 
                                                $no++;
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="riwayat-hapus-stok" role="tabpanel" aria-labelledby="riwayat-hapus-stok-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Inventaris</th>
                                                <th>Nama</th>
                                                <th>Merek</th>
                                                <th>Seri</th>
                                                <th>Jumlah</th>
                                                <th>Harga Satuan</th>
                                                <th>Kondisi</th>
                                                <th>Sumber</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Keterangan Aset</th>
                                                <th>Tanggal Hapus</th>
                                                <th>Keterangan Hapus</th>
                                                <th>Gambar</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Inventaris</th>
                                                <th>Nama</th>
                                                <th>Merek</th>
                                                <th>Seri</th>
                                                <th>Jumlah</th>
                                                <th>Harga Satuan</th>
                                                <th>Kondisi</th>
                                                <th>Sumber</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Keterangan Aset</th>
                                                <th>Tanggal Hapus</th>
                                                <th>Keterangan Hapus</th>
                                                <th>Gambar</th>
                                            </tr>
                                        </tfoot>
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
                                                <td>
                                                    <img src="dist/imgs/img_asset/<?=$pecahHapusStok['gambar_aset']; ?>" alt="Gambar aset" class="img-thumbnail">
                                                </td>
                                            </tr>
                                            <?php 
                                                $no++;
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
						</div>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modals -->
<?php require "components/modals.php"; ?>
<!-- End Modals -->



<!-- JS(jQuery DataTables) -->
<script>
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $("table.display").DataTable();
    });
</script>