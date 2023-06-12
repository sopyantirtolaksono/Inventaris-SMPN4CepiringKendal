<!-- PHP Script -->
<?php

    // ambil id aset yang aada di url
    $idAset = $_GET["id"];
    // ambil data aset pada database/tabel aset masuk sesuai id aset yang dikirim
    $ambilMaintenance = $conn->query("SELECT * FROM tbl_aset_masuk WHERE id_aset_masuk = '$idAset' ");
    $pecahMaintenance = $ambilMaintenance->fetch_assoc();

    // ambil jumlah aset yang tersedia
    $jmlAset = $pecahMaintenance["jumlah_aset"];

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
            <h1 class="h3 mb-0 text-gray-800">Input Maintenance</h1>
        </div>

        <!-- Content Row & ajax page (edit aset) -->
        <div class="row" id="edit-page">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Input Data</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">

                        <form method="post">
                          <div class="form-row mt-3">
                            <div class="form-group col-md-3">
                              <label for="kode-inventaris">Kode Inventaris</label>
                              <input type="text" class="form-control" name="kode_inventaris" value="<?=$pecahMaintenance['kode_inventaris']; ?>" disabled>
                            </div>
                            <div class="form-group col-md-3">
                              <label for="nama">Nama</label>
                              <input type="text" class="form-control" id="nama" value="<?=$pecahMaintenance['nama_aset']; ?>" name="nama_aset" disabled>
                            </div>
                            <div class="form-group col-md-3">
                              <label for="merek">Merek</label>
                              <input type="text" class="form-control" id="merek" value="<?=$pecahMaintenance['merek_aset']; ?>" name="merek_aset" disabled>
                            </div>
                            <div class="form-group col-md-3">
                              <label for="seri">Seri</label>
                              <input type="text" class="form-control" id="seri" value="<?=$pecahMaintenance['seri_aset']; ?>" name="seri_aset" disabled>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-4">
                              <label for="jumlah">Jumlah</label>
                              <input type="number" class="form-control" id="jumlah" name="jumlah_maintenance" required>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="biaya">Biaya</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validatedInputGroupPrepend">Rp.</span>
                                </div>
                                <input type="number" class="form-control" id="biaya" aria-describedby="validatedInputGroupPrepend" name="biaya_maintenance" required>
                              </div>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="tanggal-maintenance">Tanggal</label>
                              <input type="date" class="form-control" id="tanggal-maintenance" name="tanggal_maintenance" required>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" rows="3" name="keterangan_maintenance" required></textarea>
                            </div>
                          </div>

                          <button type="submit" class="btn btn-primary" name="btn_simpan">Simpan</button>
                          <a href="index.php?halaman=maintenance" class="btn btn-light">Batal</a>
                        </form>

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

<!-- PHP Script -->
<?php

    // jika tombol simpan ditekan
    if(isset($_POST["btn_simpan"])) {
        
        // ambil semua data pada form input maintenance
        $idAsetMasuk      = $idAset;
        $jmlMaintenance   = htmlspecialchars($_POST["jumlah_maintenance"]);
        $biayaMaintenance = htmlspecialchars($_POST["biaya_maintenance"]);
        $tglMaintenance   = htmlspecialchars($_POST["tanggal_maintenance"]);
        $ketMaintenance   = htmlspecialchars(strtolower($_POST["keterangan_maintenance"]));

        if($jmlMaintenance < 1 || $jmlMaintenance > $jmlAset) {
          // tampilkan pesan gagal
          // echo "<script>alert('Gagal menginput. Periksa jumlah aset yang anda inputkan!')</script>";
          echo "<script>

              Swal.fire({
                  icon: 'error',
                  title: 'Data gagal diinputkan',
                  text: 'Gagal menginput. Periksa jumlah aset yang anda inputkan!',
                  showConfirmButton: true
              })

          </script>";

          exit();
        }
        else {
          // masukkan data yg sdh diambil ke dalam database/tabel maintenance
          $tambahData = $conn->query("INSERT INTO tbl_maintenance (id_aset_masuk, jumlah_maintenance, biaya_maintenance, tanggal_maintenance, keterangan_maintenance) VALUES ('$idAsetMasuk', '$jmlMaintenance', '$biayaMaintenance', '$tglMaintenance', '$ketMaintenance') ");

          // cek data maintenance berhasil diinput/gagal
          if($tambahData == 1) {
              // update stok aset pada tabel aset masuk
              $updateJmlAset = $jmlAset - $jmlMaintenance;
              $conn->query("UPDATE tbl_aset_masuk SET jumlah_aset = '$updateJmlAset' WHERE id_aset_masuk = '$idAsetMasuk' ");
              // tampilkan pesan berhasil & alihkan ke halaman maintenance
              // echo "<script>alert('Berhasil menginput.')</script>";
              // echo "<script>location='index.php?halaman=maintenance';</script>";
              echo "<script>

                  Swal.fire({
                      icon: 'success',
                      title: 'Data berhasil diinputkan',
                      showConfirmButton: true
                  }).then(() => {
                      document.location.href = 'index.php?halaman=maintenance';
                  })

              </script>";

              exit();
          }
          else {
              // tampilkan pesan gagal
              // echo "<script>alert('Gagal menginput.')</script>";
            echo "<script>

                Swal.fire({
                    icon: 'error',
                    title: 'Data gagal diinputkan',
                    showConfirmButton: true
                })

            </script>";

            exit();
          }

        }

    }

?>