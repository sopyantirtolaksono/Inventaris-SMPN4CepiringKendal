<?php

    // ambil semua data aset pada tabel aset masuk
    $ambilAset = $conn->query("SELECT * FROM tbl_aset_masuk ORDER BY id_aset_masuk DESC");

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
            <h1 class="h3 mb-2 text-gray-800">Laporan Aset Masuk</h1>
            <div class="btn-download-print mb-2">
                <a href="components/export_pages/print_lap_aset_masuk.php" class="d-block d-sm-inline-block btn btn-sm btn-default shadow-sm" target="_blank"><i
                        class="fas fa-print fa-sm text-black-50"></i> Print</a>
                <a href="components/export_pages/excel_lap_aset_masuk.php" class="d-block d-sm-inline-block btn btn-sm btn-success shadow-sm" target="_blank"><i
                        class="fas fa-download fa-sm text-white-50"></i> Export Excel</a>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTabel Aset Masuk</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                        <tfoot>
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
                        </tfoot>
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

