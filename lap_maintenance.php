<?php

    // ambil semua aset yang sedang dimaintenance
    $ambilMaintenance = $conn->query("SELECT * FROM tbl_maintenance JOIN tbl_aset_masuk ON tbl_maintenance.id_aset_masuk = tbl_aset_masuk.id_aset_masuk ORDER BY tbl_maintenance.id_maintenance DESC");
    // ambil semua aset yang selesai dimaintenance
    $ambilSelesaiMain = $conn->query("SELECT * FROM tbl_selesai_maintenance ORDER BY id_selesai_maintenance DESC");

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
                <h6 class="m-0 font-weight-bold text-primary">Laporan Maintenance</h6>
            </div>
            <div class="card-body">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="sedang-maintenance-tab" data-toggle="tab" href="#sedang-maintenance" role="tab" aria-controls="sedang-maintenance" aria-selected="true">Sedang maintenance</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="selesai-maintenance-tab" data-toggle="tab" href="#selesai-maintenance" role="tab" aria-controls="selesai-maintenance" aria-selected="false">Selesai maintenance</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="sedang-maintenance" role="tabpanel" aria-labelledby="sedang-maintenance-tab">

                        <div class="btn-download-print mt-3">
                            <a href="components/export_pages/print_lap_maintenance.php" class="d-block d-sm-inline-block btn btn-sm btn-default shadow-sm" target="_blank"><i
                                    class="fas fa-print fa-sm text-black-50"></i> Print</a>
                            <a href="components/export_pages/excel_lap_maintenance.php" class="d-block d-sm-inline-block btn btn-sm btn-success shadow-sm" target="_blank"><i
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
                                        <th>Tanggal Maintenance</th>
                                        <th>Keterangan</th>
                                        <th>Biaya Maintenance(Rp.)</th>
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
                                        <th>Tanggal Maintenance</th>
                                        <th>Keterangan</th>
                                        <th>Biaya Maintenance(Rp.)</th>
                                    </tr>
                                </tfoot>
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
                                        <td><?=number_format($pecahMaintenance["biaya_maintenance"]); ?></td>
                                    </tr>
                                    <?php
                                        $no++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="selesai-maintenance" role="tabpanel" aria-labelledby="selesai-maintenance-tab">

                        <div class="btn-download-print mt-3">
                            <a href="components/export_pages/print_lap_maintenance_selesai.php" class="d-block d-sm-inline-block btn btn-sm btn-default shadow-sm" target="_blank"><i
                                    class="fas fa-print fa-sm text-black-50"></i> Print</a>
                            <a href="components/export_pages/excel_lap_maintenance_selesai.php" class="d-block d-sm-inline-block btn btn-sm btn-success shadow-sm" target="_blank"><i
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
                                        <th>Tanggal Maintenance</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Biaya Maintenance(Rp.)</th>
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
                                        <th>Tanggal Maintenance</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Biaya Maintenance(Rp.)</th>
                                    </tr>
                                </tfoot>
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