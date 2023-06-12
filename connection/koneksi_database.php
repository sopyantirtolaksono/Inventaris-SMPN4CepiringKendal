<?php

	// variabel koneksi

	// versi offline
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db	  = "db_inventaris";

	$conn = mysqli_connect($host, $user, $pass, $db);

	
	// versi online
	// $host = "ftp.inventarissmp4cepiring.web.id";
	// $user = "inventa1_smp4cepiring";
	// $pass = "123.alexa.stekom";
	// $db	  = "inventa1_inventaris";

	// $conn = mysqli_connect($host, $user, $pass, $db);

?>