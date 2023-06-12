<?php

	// mulai session
	// session_start();
	require "components/session_start.php";

	// hapus semua session yang ada
	session_destroy();

	// hilangkan cookienya
	setcookie("idC", "", time()-2592000);
	setcookie("keyC", "", time()-2592000);

	// alihkan ke halaman login
	echo "<script>location='login.php';</script>";
	exit;

?>