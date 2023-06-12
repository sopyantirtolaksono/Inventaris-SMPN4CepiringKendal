<?php

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
            <h1 class="h3 mb-0 text-gray-800">Laporan Aset Keluar</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Laporan Penghapusan</h6>
            </div>
            <div class="card-body">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="hapus-aset-tab" data-toggle="tab" href="#hapus-aset" role="tab" aria-controls="hapus-aset" aria-selected="true">Penghapusan Aset</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="hapus-stok-tab" data-toggle="tab" href="#hapus-stok" role="tab" aria-controls="hapus-stok" aria-selected="false">Penghapusan Stok</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="hapus-aset" role="tabpanel" aria-labelledby="hapus-aset-tab">

                        <div class="btn-download-print mt-3">
                            <a href="components/export_pages/print_lap_hapus_aset.php" class="d-block d-sm-inline-block btn btn-sm btn-default shadow-sm" target="_blank"><i
                                    class="fas fa-print fa-sm text-black-50"></i> Print</a>
                            <a href="components/export_pages/excel_lap_hapus_aset.php" class="d-block d-sm-inline-block btn btn-sm btn-success shadow-sm" target="_blank"><i
                                    class="fas fa-download fa-sm text-white-50"></i> Export Excel</a>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-bordered display" width="100%" cellspacing="0">
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
                                <tfoot>
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

                        <div class="btn-download-print mt-3">
                            <a href="components/export_pages/print_lap_hapus_stok.php" class="d-block d-sm-inline-block btn btn-sm btn-default shadow-sm" target="_blank"><i
                                    class="fas fa-print fa-sm text-black-50"></i> Print</a>
                            <a href="components/export_pages/excel_lap_hapus_stok.php" class="d-block d-sm-inline-block btn btn-sm btn-success shadow-sm" target="_blank"><i
                                    class="fas fa-download fa-sm text-white-50"></i> Export Excel</a>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-bordered display" width="100%" cellspacing="0">
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
                                        <th>Keterangan Aset</th>
                                        <th>Tanggal Hapus</th>
                                        <th>Keterangan Hapus</th>
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