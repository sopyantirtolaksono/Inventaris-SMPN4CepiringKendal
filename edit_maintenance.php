<!-- PHP Script -->
<?php

    // ambil id maintenance yang ada di url
    $idMaintenance = $_GET["id"];
    // ambil data aset yang dimaintenance pada tabel maintenance sesuai id maintenancenya
    $ambilMaintenance = $conn->query("SELECT * FROM tbl_maintenance JOIN tbl_aset_masuk ON tbl_maintenance.id_aset_masuk = tbl_aset_masuk.id_aset_masuk WHERE id_maintenance = '$idMaintenance' ");
    $pecahMaintenance = $ambilMaintenance->fetch_assoc();
    // ambil id aset masuk
    $idAsetMasuk = $pecahMaintenance["id_aset_masuk"];
    // ambil jumlah aset yg normal pada tabel aset masuk
    $jmlAsetNormal = $pecahMaintenance["jumlah_aset"];

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
            <h1 class="h3 mb-0 text-gray-800">Edit Maintenance</h1>
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
                              <input type="number" class="form-control" id="jumlah" name="jumlah_maintenance" value="<?=$pecahMaintenance['jumlah_maintenance']; ?>" required>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="biaya">Biaya</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validatedInputGroupPrepend">Rp.</span>
                                </div>
                                <input type="number" class="form-control" id="biaya" aria-describedby="validatedInputGroupPrepend" name="biaya_maintenance" value="<?=$pecahMaintenance['biaya_maintenance']; ?>" required>
                              </div>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="tanggal-maintenance">Tanggal</label>
                              <input type="date" class="form-control" id="tanggal-maintenance" name="tanggal_maintenance" value="<?=$pecahMaintenance['tanggal_maintenance']; ?>" required>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" rows="3" name="keterangan_maintenance" required><?=$pecahMaintenance["keterangan_maintenance"]; ?></textarea>
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
        
        // ambil semua data pada form edit maintenance
        $jmlMaintenance   = htmlspecialchars($_POST["jumlah_maintenance"]);
        $biayaMaintenance = htmlspecialchars($_POST["biaya_maintenance"]);
        $tglMaintenance   = htmlspecialchars($_POST["tanggal_maintenance"]);
        $ketMaintenance   = htmlspecialchars(strtolower($_POST["keterangan_maintenance"]));

        // ambil jumlah aset maintenance pada tabel maintenance
        $ambilJmlMaintenance = $conn->query("SELECT jumlah_maintenance FROM tbl_maintenance WHERE id_maintenance = '$idMaintenance' ");
        $pecahJmlMaintenance = $ambilJmlMaintenance->fetch_assoc();
        $jmlAsetMaintenance = $pecahJmlMaintenance["jumlah_maintenance"];

        // total semua aset dgn menjumlahkan jml aset normal & jml aset maintenance
        $totalSemuaAset = $jmlAsetNormal + $jmlAsetMaintenance;

        // lakukan pengecekan pada jumlah aset maintenance ditabel maintenance, ada perubahan atau tidak
        if($jmlMaintenance < 0) {
    		// tampilkan pesan gagal
            // echo "<script>alert('Gagal update! Periksa jumlah aset yang anda inputkan')</script>";
            echo "<script>

                Swal.fire({
                    icon: 'error',
                    title: 'Data gagal diupdate',
                    text: 'Gagal mengupdate. Periksa jumlah aset yang anda inputkan!',
                    showConfirmButton: true
                })

            </script>";

            exit();
    	}
    	else if($jmlMaintenance > $totalSemuaAset) {
    		// tampilkan pesan gagal
            // echo "<script>alert('Gagal update! Periksa jumlah aset yang anda inputkan')</script>";
            echo "<script>

                Swal.fire({
                    icon: 'error',
                    title: 'Data gagal diupdate',
                    text: 'Gagal mengupdate. Periksa jumlah aset yang anda inputkan!',
                    showConfirmButton: true
                })

            </script>";

            exit();
    	}
        else if($jmlMaintenance < $jmlAsetMaintenance) {
        	$totalAset = $jmlAsetMaintenance - $jmlMaintenance;
        	$jmlAset = $pecahMaintenance["jumlah_aset"];
        	$jmlAset = $jmlAset + $totalAset;
        	$status = $conn->query("UPDATE tbl_aset_masuk SET jumlah_aset = '$jmlAset' WHERE id_aset_masuk = '$idAsetMasuk' ");
        	if($status == 1) {
        		// update data pada database/tabel maintenance sesuai data diform & id maintenancenya
		        $updateMaintenance = $conn->query("UPDATE tbl_maintenance SET jumlah_maintenance = '$jmlMaintenance', biaya_maintenance = '$biayaMaintenance', tanggal_maintenance = '$tglMaintenance', keterangan_maintenance = '$ketMaintenance' WHERE id_maintenance = '$idMaintenance' ");

		        // cek data maintenance berhasil diupdate/gagal
		        if($updateMaintenance == 1) {
		        	// hapus jumlah maintenance pada tabel maintenance yg bernilai 0
		        	$conn->query("DELETE FROM tbl_maintenance WHERE jumlah_maintenance = 0");
		            // tampilkan pesan berhasil & alihkan ke halaman maintenance
		            // echo "<script>alert('Berhasil update!')</script>";
		            // echo "<script>location='index.php?halaman=maintenance';</script>";
                    echo "<script>

                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil diupdate',
                            showConfirmButton: true
                        }).then(() => {
                            document.location.href = 'index.php?halaman=maintenance';
                        })

                    </script>";

		            exit();
		        }
		        else {
		            // tampilkan pesan gagal
		            // echo "<script>alert('Gagal update!')</script>";
                    echo "<script>

                        Swal.fire({
                            icon: 'error',
                            title: 'Data gagal diupdate',
                            showConfirmButton: true
                        })

                    </script>";

		            exit();
		        }
        	}
        	else {
        		// tampilkan pesan gagal
	            // echo "<script>alert('Gagal update!')</script>";
                echo "<script>

                        Swal.fire({
                            icon: 'error',
                            title: 'Data gagal diupdate',
                            showConfirmButton: true
                        })

                </script>";

	            exit();
        	}
        }
        else if($jmlMaintenance > $jmlAsetMaintenance) {
        	$totalAset = $jmlMaintenance - $jmlAsetMaintenance;
        	$jmlAset = $pecahMaintenance["jumlah_aset"];
        	$jmlAset = $jmlAset - $totalAset;
        	$status = $conn->query("UPDATE tbl_aset_masuk SET jumlah_aset = '$jmlAset' WHERE id_aset_masuk = '$idAsetMasuk' ");
        	if($status == 1) {
        		// update data pada database/tabel maintenance sesuai data diform & id maintenancenya
		        $updateMaintenance = $conn->query("UPDATE tbl_maintenance SET jumlah_maintenance = '$jmlMaintenance', biaya_maintenance = '$biayaMaintenance', tanggal_maintenance = '$tglMaintenance', keterangan_maintenance = '$ketMaintenance' WHERE id_maintenance = '$idMaintenance' ");

		        // cek data maintenance berhasil diupdate/gagal
		        if($updateMaintenance == 1) {
		            // tampilkan pesan berhasil & alihkan ke halaman maintenance
		            // echo "<script>alert('Berhasil update!')</script>";
		            // echo "<script>location='index.php?halaman=maintenance';</script>";
                    echo "<script>

                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil diupdate',
                            showConfirmButton: true
                        }).then(() => {
                            document.location.href = 'index.php?halaman=maintenance';
                        })

                    </script>";

		            exit();
		        }
		        else {
		            // tampilkan pesan gagal
		            // echo "<script>alert('Gagal update!')</script>";
                    echo "<script>

                        Swal.fire({
                            icon: 'error',
                            title: 'Data gagal diupdate',
                            showConfirmButton: true
                        })

                    </script>";

		            exit();
		        }
        	}
        	else {
        		// tampilkan pesan gagal
	            // echo "<script>alert('Gagal update!')</script>";
                echo "<script>

                        Swal.fire({
                            icon: 'error',
                            title: 'Data gagal diupdate',
                            showConfirmButton: true
                        })

                </script>";

	            exit();
        	}
        }
        else {
        	// update data pada database/tabel maintenance sesuai data diform & id maintenancenya
	        $updateMaintenance = $conn->query("UPDATE tbl_maintenance SET jumlah_maintenance = '$jmlMaintenance', biaya_maintenance = '$biayaMaintenance', tanggal_maintenance = '$tglMaintenance', keterangan_maintenance = '$ketMaintenance' WHERE id_maintenance = '$idMaintenance' ");

	        // cek data maintenance berhasil diupdate/gagal
	        if($updateMaintenance == 1) {
	            // tampilkan pesan berhasil & alihkan ke halaman maintenance
	            // echo "<script>alert('Berhasil update!')</script>";
	            // echo "<script>location='index.php?halaman=maintenance';</script>";
                echo "<script>

                    Swal.fire({
                        icon: 'success',
                        title: 'Data berhasil diupdate',
                        showConfirmButton: true
                    }).then(() => {
                        document.location.href = 'index.php?halaman=maintenance';
                    })

                </script>";

	            exit();
	        }
	        else {
	            // tampilkan pesan gagal
	            // echo "<script>alert('Gagal update!')</script>";
                echo "<script>

                        Swal.fire({
                            icon: 'error',
                            title: 'Data gagal diupdate',
                            showConfirmButton: true
                        })

                </script>";
                
	            exit();
	        }
        }

    }

?>