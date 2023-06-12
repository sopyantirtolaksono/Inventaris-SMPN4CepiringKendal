<?php

	// ambil id maintenance pada url
	$idMaintenance = $_GET["id"];
	// ambil jumlah aset yg dimaintenance pada tabel maintenance
	$ambilMaintenance = $conn->query("SELECT * FROM tbl_maintenance WHERE id_maintenance = '$idMaintenance' ");
	$pecahMaintenance = $ambilMaintenance->fetch_assoc();
	$idAsetMasuk = $pecahMaintenance["id_aset_masuk"];
	$jmlMaintenance = $pecahMaintenance["jumlah_maintenance"];
	
	// update status maintenance pada tabel maintenance dari maintenance => finish
	// $updateStatus = $conn->query("UPDATE tbl_maintenance SET status_maintenance = 'finish' WHERE id_maintenance = '$idMaintenance' ");

	// ambil data aset yang selesai maintenance pada tabel aset masuk
	$ambilAset = $conn->query("SELECT * FROM tbl_aset_masuk WHERE id_aset_masuk = '$idAsetMasuk' ");
	$pecahAset = $ambilAset->fetch_assoc();

	// ambil semua data aset
	$kodeInventaris 		= $pecahAset["kode_inventaris"];
	$namaAset 				= $pecahAset["nama_aset"];
	$merekAset 				= $pecahAset["merek_aset"];
	$seriAset 				= $pecahAset["seri_aset"];
	$biayaMaintenance 		= $pecahMaintenance["biaya_maintenance"];
	$tglMaintenance 		= $pecahMaintenance["tanggal_maintenance"];
	$tglSelesaiMaintenance 	= date("Y-m-d");
	$ketMaintenance 		= $pecahMaintenance["keterangan_maintenance"];
	$gambarAset 			= $pecahAset["gambar_aset"];

	// inputkan data aset yg selesai maintenance pada tabel selesai maintenance
	$insertStatus = $conn->query("INSERT INTO tbl_selesai_maintenance (kode_inventaris, nama_aset, merek_aset, seri_aset, jumlah_maintenance, biaya_maintenance, tanggal_maintenance, tanggal_selesai_maintenance, keterangan_maintenance, gambar_aset) VALUES ('$kodeInventaris', '$namaAset', '$merekAset', '$seriAset', '$jmlMaintenance', '$biayaMaintenance', '$tglMaintenance', '$tglSelesaiMaintenance', '$ketMaintenance', '$gambarAset') ");

	// jika berhasil diupdate & jika gagal diupdate
	if($insertStatus == 1) {
		// ambil jumlah aset pada tabel aset masuk sesuai id aset yang dipilih
		$ambilJmlAset = $conn->query("SELECT jumlah_aset FROM tbl_aset_masuk WHERE id_aset_masuk = '$idAsetMasuk' ");
		$pecahJmlAset = $ambilJmlAset->fetch_assoc();
		$jmlAset = $pecahJmlAset["jumlah_aset"];
		// update jumlah aset pada tabel aset masuk dengan penjumlahan dari jumlah aset pada tabel aset masuk & jumlah aset yg telah selesai di maintenance pada tabel maintenance
		$jmlAset = $jmlAset + $jmlMaintenance;
		$updateJmlAset = $conn->query("UPDATE tbl_aset_masuk SET jumlah_aset = '$jmlAset' WHERE id_aset_masuk = '$idAsetMasuk' ");
		// jika berhasil diupdate & jika gagal diupdate
		if($updateJmlAset == 1) {
			// hapus data aset yg sdh selesai maintenance pada tabel maintenance
			$conn->query("DELETE FROM tbl_maintenance WHERE id_maintenance = '$idMaintenance' ");
			// tampilkan pesan berhasil & alihkan ke halaman maintenance
            // echo "<script>alert('Maintenance selesai.')</script>";
            // echo "<script>location='index.php?halaman=maintenance';</script>";
            echo "<script>

                Swal.fire({
                    icon: 'success',
                    title: 'Maintenance selesai',
                    showConfirmButton: true
                }).then(() => {
                    document.location.href = 'index.php?halaman=maintenance';
                })

            </script>";

            exit();
		}
		else {
			// tampilkan pesan gagal
            // echo "<script>alert('Gagal memproses.')</script>";
            echo "<script>

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal memproses',
                    showConfirmButton: true
                }).then(() => {
                	document.location.href = 'index.php?halaman=maintenance';
            	})

            </script>";

            exit();
		}
	}
	else {
		// tampilkan pesan gagal
        // echo "<script>alert('Gagal memproses.')</script>";
        echo "<script>

            Swal.fire({
                icon: 'error',
                title: 'Gagal memproses',
                showConfirmButton: true
            }).then(() => {
            	document.location.href = 'index.php?halaman=maintenance';
        	})

        </script>";

        exit();
	}

?>