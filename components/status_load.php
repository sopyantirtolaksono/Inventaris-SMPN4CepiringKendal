<?php

	// koneksi ke database
	require "../connection/koneksi_database.php";
	// ambil keyword dari url
	$keyword = $_GET["k"];
	// ambil data yang dicari dari tabel pengguna
	$ambilData = $conn->query("SELECT * FROM tbl_pengguna WHERE username = '$keyword' ");
  	// cek ada data yang dicari atau tidak
  	$adaDataTidak = $ambilData->num_rows;

?>

<?php 

	if($adaDataTidak > 0) { 
		$pecahData = $ambilData->fetch_assoc();
		$status = $pecahData["jabatan"];

?>
<input type="text" class="form-control form-control-user text-success text-capitalize" placeholder="Status" name="status" value="<?=$status; ?>" required disabled>
<?php } else { ?>
<input type="text" class="form-control form-control-user text-danger" placeholder="Status" name="status" value="Status tidak dikenali." required disabled>
<?php } ?>