<?php
	// mulai session
	require "components/session_start.php";
	
    // require file header
	require "header.php";
?>

	<!-- Content Wrapper -->
	<div id="content-wrapper" class="d-flex flex-column">
		<?php 
			if(isset($_GET["halaman"])) {
				if($_GET["halaman"] == "dashboard") {
					require "dashboard.php";
				}
				else if($_GET["halaman"] == "aset_masuk") {
					require "aset_masuk.php";
				}
				else if($_GET["halaman"] == "edit_aset") {
					require "edit_aset.php";
				}
				else if($_GET["halaman"] == "maintenance") {
					require "maintenance.php";
				}
				else if($_GET["halaman"] == "input_maintenance") {
					require "input_maintenance.php";
				}
				else if($_GET["halaman"] == "selesai_maintenance") {
					require "selesai_maintenance.php";
				}
				else if($_GET["halaman"] == "edit_maintenance") {
					require "edit_maintenance.php";
				}
				else if($_GET["halaman"] == "penghapusan") {
					require "penghapusan.php";
				}
				else if($_GET["halaman"] == "hapus_aset") {
					require "hapus_aset.php";
				}
				else if($_GET["halaman"] == "hapus_stok") {
					require "hapus_stok.php";
				}
				else if($_GET["halaman"] == "lap_aset_masuk") {
					require "lap_aset_masuk.php";
				}
				else if($_GET["halaman"] == "lap_maintenance") {
					require "lap_maintenance.php";
				}
				else if($_GET["halaman"] == "lap_penghapusan") {
					require "lap_penghapusan.php";
				}
				else {
					require "404.php";
				}
			}
			else {
				echo "<script>location='index.php?halaman=dashboard';</script>";
			}
		?>

<!-- require file footer -->
<?php require "footer.php"; ?>