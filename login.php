<?php 

    // mulai session
    require "components/session_start.php";

    // cek jika sudah ada session pengguna
    if(isset($_SESSION["pengguna"])) {
        // alihkan agar tetap dihalaman dashboard
        echo "<script>location='index.php';</script>";
    }

    // koneksi ke database
    require "connection/koneksi_database.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="dist/imgs/favicon.png">

    <!-- Title -->
    <title>Login | Admin & Kepsek</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

</head>

<body class="bg-gradient-primary">

    <!-- PHP Script -->
    <?php

        // jika tombol masuk ditekan
        if(isset($_POST["btn_masuk"])) {

            // ambil semua value pada form login
            $username = htmlspecialchars($_POST["username"]);
            $password = htmlspecialchars($_POST["password"]);
            // $status   = htmlspecialchars($_POST["status"]);

            // ambil data akun yg login dari database
            $ambilAkun = $conn->query("SELECT * FROM tbl_pengguna WHERE username = '$username' AND password = '$password' ");
            $dataAkun = $ambilAkun->num_rows;

            // jika ada akun yg cocok
            if($dataAkun == 1) {
                // pecah data akun yg didapatkan
                $pecahAkun = $ambilAkun->fetch_assoc();
                // buat session pengguna & masukkan data user yang masuk
                $_SESSION["pengguna"] = $pecahAkun;

                // cek ada cookie tidak
                if(isset($_POST["remember_me"])) {
                    // set cookie id pengguna
                    setcookie("idC", $pecahAkun["id_pengguna"], time()+2592000 );
                    // set cookie username pengguna
                    setcookie("keyC", hash("sha256", $pecahAkun["username"]), time()+2592000 );
                }
                
                // alihkan ke halaman index.php
                echo "<script>location='index.php?halaman=dashboard&p=1';</script>";
                exit;

            }
            else {
                // tetap tahan di halaman login
                echo "<script>

                    $(document).ready(function() {
                        $('div.alert-danger').removeClass('d-none');
                    })

                </script>";
                
            }
        }

    ?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                    </div>
                                    <form method="post" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="username" aria-describedby=""
                                                placeholder="Username" name="username" required autocomplete="off">
                                        </div>
                                        <div class="form-group" id="status">
                                            <input type="text" class="form-control form-control-user" placeholder="Status" name="status" required disabled>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="" placeholder="Password" name="password" required autocomplete="off">
                                        </div>
                                        
                                        <!-- <div class="form-group mb-3 text-center">
                                            <label for="validationTooltip04">Jabatan</label>
                                            <select class="custom-select form-control form-control-user-select" id="validationTooltip04" name="jabatan" required>
                                                <option selected disabled value="">Pilihlah...</option>
                                                <option value="admin">Admin</option>
                                                <option value="kepala sekolah">Kepala Sekolah</option>
                                            </select>
                                            <div class="invalid-tooltip">
                                                Please select a valid state.
                                            </div>
                                        </div> -->

                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" name="remember_me">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="btn_masuk">Masuk</button>
                                        <br>
                                        <div class="alert alert-danger text-danger d-none" role="alert">
                                            <strong>Login gagal.</strong> Periksa kembali username dan password anda!
                                        </div>

                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="dist/js/sb-admin-2.min.js"></script>

    <!-- Script ajax form login(status) -->
    <script src="dist/js/scriptjs/script.js"></script>

</body>

</html>