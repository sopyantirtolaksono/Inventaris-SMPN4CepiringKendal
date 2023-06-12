<?php

    // cek jika ada session kepala sekolah
    $kepSek = $_SESSION["pengguna"]["jabatan"];
    if($kepSek === "kepala sekolah") {
        // alihkan ke halaman dashboard kepala sekolah
        echo "<script>location='index.php';</script>";
        exit();
    }

    // ambil semua data aset yang akan dimaintenance dari database/tabel aset masuk
    $ambilPilihAset = $conn->query("SELECT * FROM tbl_aset_masuk ORDER BY id_aset_masuk DESC");

    // ambil semua data aset yang sedang di maintenance pada database/tabel maintenance
    $ambilMaintenance = $conn->query("SELECT * FROM tbl_maintenance JOIN tbl_aset_masuk ON tbl_maintenance.id_aset_masuk = tbl_aset_masuk.id_aset_masuk ORDER BY tbl_maintenance.id_maintenance DESC");

    // ambil semua data aset yang sudah/selesai di maintenance pada database/tabel maintenance
    $ambilRiwayat = $conn->query("SELECT * FROM tbl_selesai_maintenance ORDER BY id_selesai_maintenance DESC");

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
            <h1 class="h3 mb-0 text-gray-800">Maintenance</h1>
        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Input Maintenance</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pilih-aset-tab" data-toggle="tab" href="#pilih-aset" role="tab" aria-controls="pilih-aset" aria-selected="true">Pilih Aset</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="daftar-aset-tab" data-toggle="tab" href="#daftar-aset" role="tab" aria-controls="daftar-aset" aria-selected="false">Daftar Aset</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="riwayat-tab" data-toggle="tab" href="#riwayat" role="tab" aria-controls="riwayat" aria-selected="false">Riwayat</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="pilih-aset" role="tabpanel" aria-labelledby="pilih-aset-tab">
                                
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
                                            <!-- Script PHP query data aset masuk -->
                                            <?php 
                                                $no = 1;
                                                while($pecahPilihAset = $ambilPilihAset->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?=$no;  ?></td>
                                                <td class="text-center">
                                                    <?php if($pecahPilihAset["jumlah_aset"] < 1) { ?>
                                                    <a href="#" class="btn btn-secondary btn-sm disabled">Semua dalam maintenance</a>
                                                    <?php } else { ?>
                                                    <a href="index.php?halaman=input_maintenance&id=<?=$pecahPilihAset['id_aset_masuk']; ?>" class="btn btn-warning">Maintenance</a>
                                                    <?php } ?>
                                                </td>
                                                <td><?=$pecahPilihAset["kode_inventaris"];  ?></td>
                                                <td class="text-capitalize"><?=$pecahPilihAset["nama_aset"];  ?></td>
                                                <td class="text-capitalize"><?=$pecahPilihAset["merek_aset"];  ?></td>
                                                <td class="text-capitalize"><?=$pecahPilihAset["seri_aset"];  ?></td>

                                                <?php if($pecahPilihAset["jumlah_aset"] < 1) { ?>
                                                <td>Kosong</td>
                                                <?php } else { ?>
                                                <td><?=$pecahPilihAset["jumlah_aset"];  ?></td>
                                                <?php } ?>

                                                <td>
                                                    <img src="dist/imgs/img_asset/<?=$pecahPilihAset['gambar_aset']; ?>" alt="Gambar aset" class="img-thumbnail">
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                            <?php } ?>
                                            <!-- End script -->
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="daftar-aset" role="tabpanel" aria-labelledby="daftar-aset-tab">
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
                                                <th>Biaya</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th>Status</th>
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
                                                <th>Biaya</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th>Status</th>
                                                <th>Gambar</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <!-- Script PHP query data aset masuk -->
                                            <?php 
                                                $no = 1;
                                                while($pecahMaintenance = $ambilMaintenance->fetch_assoc()) { 
                                            ?>
                                            <tr>
                                                <td><?=$no;  ?></td>
                                                <td class="text-center">
                                                    <a href="index.php?halaman=selesai_maintenance&id=<?=$pecahMaintenance['id_maintenance']; ?>" class="btn btn-info">Selesai</a>
                                                    <a href="index.php?halaman=edit_maintenance&id=<?=$pecahMaintenance['id_maintenance']; ?>" class="btn btn-secondary">Edit</a>
                                                </td>
                                                <td><?=$pecahMaintenance["kode_inventaris"];  ?></td>
                                                <td class="text-capitalize"><?=$pecahMaintenance["nama_aset"];  ?></td>
                                                <td class="text-capitalize"><?=$pecahMaintenance["merek_aset"];  ?></td>
                                                <td class="text-capitalize"><?=$pecahMaintenance["seri_aset"];  ?></td>
                                                <td><?=$pecahMaintenance["jumlah_maintenance"];  ?></td>
                                                <td><?=number_format($pecahMaintenance["biaya_maintenance"]); ?></td>
                                                <td class="text-capitalize"><?=$pecahMaintenance["tanggal_maintenance"];  ?></td>
                                                <td><?=$pecahMaintenance["keterangan_maintenance"];  ?></td>
                                                <td><?=$pecahMaintenance["status_maintenance"];  ?></td>
                                                <td>
                                                    <img src="dist/imgs/img_asset/<?=$pecahMaintenance['gambar_aset']; ?>" alt="Gambar aset" class="img-thumbnail">
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                            <?php } ?>
                                            <!-- End script -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="riwayat" role="tabpanel" aria-labelledby="riwayat-tab">
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
                                                <th>Biaya</th>
                                                <th>Tanggal</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Keterangan</th>
                                                <th>Status</th>
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
                                                <th>Biaya</th>
                                                <th>Tanggal</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Keterangan</th>
                                                <th>Status</th>
                                                <th>Gambar</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <!-- Script PHP query data aset masuk -->
                                            <?php 
                                                $no = 1;
                                                while($pecahRiwayat = $ambilRiwayat->fetch_assoc()) { 
                                            ?>
                                            <tr>
                                                <td><?=$no;  ?></td>
                                                <td><?=$pecahRiwayat["kode_inventaris"];  ?></td>
                                                <td class="text-capitalize"><?=$pecahRiwayat["nama_aset"];  ?></td>
                                                <td class="text-capitalize"><?=$pecahRiwayat["merek_aset"];  ?></td>
                                                <td class="text-capitalize"><?=$pecahRiwayat["seri_aset"];  ?></td>
                                                <td><?=$pecahRiwayat["jumlah_maintenance"];  ?></td>
                                                <td><?=number_format($pecahRiwayat["biaya_maintenance"]); ?></td>
                                                <td class="text-capitalize"><?=$pecahRiwayat["tanggal_maintenance"];  ?></td>
                                                <td class="text-capitalize"><?=$pecahRiwayat["tanggal_selesai_maintenance"];  ?></td>
                                                <td><?=$pecahRiwayat["keterangan_maintenance"];  ?></td>
                                                <td><?=$pecahRiwayat["status_maintenance"];  ?></td>
                                                <td>
                                                    <img src="dist/imgs/img_asset/<?=$pecahRiwayat['gambar_aset']; ?>" alt="Gambar aset" class="img-thumbnail">
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                            <?php } ?>
                                            <!-- End script -->
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