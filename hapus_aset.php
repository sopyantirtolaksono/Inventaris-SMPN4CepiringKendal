<!-- PHP Script -->
<?php

    // ambil id aset di url
    $idAset = $_GET["id"];
    // ambil data aset pada tabel aset masuk sesuai id aset yang dikirim(utk data hapus aset)
    $ambilAset = $conn->query("SELECT * FROM tbl_aset_masuk WHERE id_aset_masuk = '$idAset' ");
    $pecahAset = $ambilAset->fetch_assoc();
    // ambil jumlah aset yang sedang dimaintenance
    $ambilJmlMaintenance = $conn->query("SELECT * FROM tbl_maintenance WHERE id_aset_masuk = '$idAset' ");
    $totalAsetMaintenance = 0;
    while($pecahJmlMaintenance = $ambilJmlMaintenance->fetch_assoc()) {

      $totalAsetMaintenance = $totalAsetMaintenance + $pecahJmlMaintenance["jumlah_maintenance"];

    }

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
            <h1 class="h3 mb-0 text-gray-800">Hapus Aset</h1>
        </div>

        <!-- Content Row & ajax page (edit aset) -->
        <div class="row" id="edit-page">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Verifikasi Data</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">

                      <form method="post">
                        <div class="form-row mt-3">
                          <div class="form-group col-md-4">
                            <label for="kode-inventaris">Kode Inventaris</label>
                            <input type="text" class="form-control" id="kode-inventaris" value="<?=$pecahAset['kode_inventaris']; ?>" disabled>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" value="<?=$pecahAset['nama_aset']; ?>" disabled>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="merek">Merek</label>
                            <input type="text" class="form-control" id="merek" value="<?=$pecahAset['merek_aset']; ?>" disabled>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="seri">Seri</label>
                            <input type="text" class="form-control" id="seri" value="<?=$pecahAset['seri_aset']; ?>" disabled>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" value="<?=$pecahAset['jumlah_aset']; ?>" disabled>
                          </div>
                          <div class="form-group col-md-4">
                              <label for="keterangan">Keterangan</label>
                              <textarea class="form-control" id="keterangan" rows="3" placeholder="Ketikkan keterangan disini" name="keterangan_hapus_aset" required></textarea>
                          </div>
                        </div>

                        <button type="submit" class="btn btn-danger" name="btn_hapus">Hapus Permanen ?</button>
                        <a href="index.php?halaman=penghapusan" class="btn btn-light">Batal</a>
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
    if(isset($_POST["btn_hapus"])) {
        
        // ambil semua data aset yang akan dihapus dan data pada form hapus aset
        $kodeInventaris  = $pecahAset["kode_inventaris"];
        $namaAset        = $pecahAset["nama_aset"];
        $merekAset       = $pecahAset["merek_aset"];
        $seriAset        = $pecahAset["seri_aset"];
        $jumlahAset      = $pecahAset["jumlah_aset"];
        $jmlMaintenance  = $totalAsetMaintenance;
        $hargaSatuanAset = $pecahAset["harga_satuan_aset"];
        $kondisiAset     = $pecahAset["kondisi_aset"];
        $sumberAset      = $pecahAset["sumber_aset"];
        $tglMasukAset    = $pecahAset["tanggal_masuk_aset"];
        $keteranganAset  = $pecahAset["keterangan_aset"];
        $gambarAset      = $pecahAset["gambar_aset"];
        $tglHapusAset    = date("Y-m-d");
        $ketHapusAset    = htmlspecialchars($_POST["keterangan_hapus_aset"]);

        // masukkan semua data aset yg akan dihapus kedalam tabel hapus aset
        $statusInsert = $conn->query("INSERT INTO tbl_hapus_aset (kode_inventaris, nama_aset, merek_aset, seri_aset, jumlah_aset, jumlah_maintenance, harga_satuan_aset, kondisi_aset, sumber_aset, tanggal_masuk_aset, keterangan_aset, gambar_aset, tanggal_hapus_aset, keterangan_hapus_aset) VALUES ('$kodeInventaris', '$namaAset', '$merekAset', '$seriAset', '$jumlahAset', '$jmlMaintenance', '$hargaSatuanAset', '$kondisiAset', '$sumberAset', '$tglMasukAset', '$keteranganAset', '$gambarAset', '$tglHapusAset', '$ketHapusAset') ");

        // cek status apakah data berhasil di input pada tabel hapus aset/tidak
        if($statusInsert == 1) {
          // hapus aset pada tabel aset masuk sesuai id aset yang dipilih
          $conn->query("DELETE FROM tbl_aset_masuk WHERE id_aset_masuk = '$idAset' ");
          // hapus aset pada tabel maintenance sesuai id aset yang dipilih yang statusnya maintenance
          $conn->query("DELETE FROM tbl_maintenance WHERE id_aset_masuk = '$idAset' ");
          // tampilkan pesan berhasil & alihkan ke halaman penghapusan
          // echo "<script>alert('Data terhapus.')</script>";
          // echo "<script>location ='index.php?halaman=penghapusan';</script>";
          echo "<script>

              Swal.fire({
                  icon: 'success',
                  title: 'Data terhapus',
                  showConfirmButton: true
              }).then(() => {
                  document.location.href = 'index.php?halaman=penghapusan';
              })

          </script>";

          exit();
        }
        else {
          // tampilkan pesan gagal
          // echo "<script>alert('Data gagal terhapus.')</script>";
          echo "<script>

              Swal.fire({
                  icon: 'error',
                  title: 'Data gagal terhapus',
                  showConfirmButton: true
              })

          </script>";
          
          exit();
        }

    }

?>