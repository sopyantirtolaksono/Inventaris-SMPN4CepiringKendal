<!-- PHP Script -->
<?php 

  // ambil data pengguna dari database/tabel pengguna
  $akunMasuk = $_SESSION["pengguna"]["jabatan"];
  $ambilAkun = $conn->query("SELECT * FROM tbl_pengguna WHERE jabatan = '$akunMasuk' ");
  $pecahAkun = $ambilAkun->fetch_assoc();

?>

<!-- Modal Profil -->
<div class="modal fade" id="profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profil Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <form>
            <div class="form-group">

              <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 text-center">

                  <img src="dist/imgs/img_profile/<?=$pecahAkun['gambar_profil']; ?>" class="img-profile rounded-circle" style="width: 35vh; height: 35vh;" alt="Gambar profil">
                  
                </div>
                
                <div class="col-sm-3"></div>
              </div>

              <label for="nama-lengkap" class="col-form-label">Nama Lengkap</label>
              <input type="text" class="form-control text-capitalize" id="nama-lengkap" disabled value="<?=$pecahAkun["nama_lengkap"]; ?>">
              <label for="jenis-kelamin" class="col-form-label">Jenis Kelamin</label>
              <input type="text" class="form-control text-capitalize" id="jenis-kelamin" disabled value="<?=$pecahAkun["jenis_kelamin"]; ?>">
              <label for="jabatan" class="col-form-label">Status</label>
              <input type="text" class="form-control text-capitalize" id="jabatan" disabled value="<?=$pecahAkun["jabatan"]; ?>">
              <label for="username" class="col-form-label">Username</label>
              <input type="text" class="form-control" id="username" disabled value="<?=$pecahAkun["username"]; ?>">

            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>

<!-- Modals Perbarui Profil -->
<div class="modal fade" id="perbarui-profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Perbarui Profil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <form method="post" enctype="multipart/form-data">
            <div class="form-group">

              <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 text-center">

                  <img src="dist/imgs/img_profile/<?=$pecahAkun['gambar_profil']; ?>" class="img-profile rounded-circle" style="width: 35vh; height: 35vh;" alt="Gambar profil">

                  <div class="row">
                    <div class="col-12">
                      &nbsp;&nbsp;
                      <input type="file" class="form-control" name="gambar_profil">
                      &nbsp;&nbsp;
                    </div>
                  </div>
                  
                </div>
                <div class="col-sm-3"></div>
              </div>

              <label for="nama-lengkap" class="col-form-label">Nama Lengkap</label>
              <input type="text" class="form-control text-capitalize" id="nama-lengkap" value="<?=$pecahAkun["nama_lengkap"]; ?>" name="nama_lengkap" required>

              <label for="jenis-kelamin" class="col-form-label">Jenis Kelamin</label>
              <select id="jenis-kelamin" class="form-control" name="jenis_kelamin" required>
                <option value="<?=$pecahAkun["jenis_kelamin"]; ?>"><?=$pecahAkun["jenis_kelamin"]; ?></option>
                <option value="pria">Pria</option>
                <option value="wanita">Wanita</option>
              </select>

              <label for="username" class="col-form-label">Username</label>
              <input type="text" class="form-control" id="username" value="<?=$pecahAkun["username"]; ?>" name="username" required>

              <label for="password" class="col-form-label">Password</label>
              <input type="text" class="form-control" id="password" value="<?=$pecahAkun["password"]; ?>" name="password" required>

            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="btn_perbarui">Perbarui</button>
      </div>
          </form>
    </div>
  </div>
</div>

<!-- Modal Keluar-->
<!-- <div class="modal fade" id="keluar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Jika sudah yakin, silahkan klik tombol <strong>keluar</strong> untuk melanjutkan!</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="logout.php">Keluar</a>
            </div>
        </div>
    </div>
</div> -->


<!-- PHP Script -->
<?php

  // jika tombol perbarui ditekan
  if(isset($_POST["btn_perbarui"])) {
    // ambil data pengguna dari form perbarui profil
    $namaLengkap  = htmlspecialchars(strtolower($_POST["nama_lengkap"]));
    $jenisKelamin = htmlspecialchars(strtolower($_POST["jenis_kelamin"]));
    $username     = htmlspecialchars(strtolower(trim($_POST["username"])));
    $password     = htmlspecialchars(strtolower($_POST["password"]));

    // menghilangkan karakter spasi/whitespace pada field username
    $username     = str_replace(" ", "", $username);

    // ambil nama gambar dan lokasi sementara penyimpanan gambar
    $namaGambar   = $_FILES["gambar_profil"]["name"];
    $namaLokasi   = $_FILES["gambar_profil"]["tmp_name"];

    // aktifkan uniqid
    $uniqId = uniqid();
    // buat nama gambar baru
    $namaGambarBaru = $uniqId."_".$namaGambar;

    // jika ada gambar profil yang diedit
    if(!empty($namaLokasi)) {

      // ambil nama ekstensinya(gambar profil)
      $namaEkstensi = pathinfo($namaGambar, PATHINFO_EXTENSION);

      // cek apakah format gambar valid / invalid
      if( $namaEkstensi == "jpg" || 
          $namaEkstensi == "JPG" || 
          $namaEkstensi == "png" || 
          $namaEkstensi == "PNG" ||
          $namaEkstensi == "jpeg" ||
          $namaEkstensi == "JPEG" ) {

          // pindahkan gambar dari lokasi sementara ke folder imgs/img_profile
          move_uploaded_file($namaLokasi, "dist/imgs/img_profile/" .$namaGambarBaru);

          // perbarui data pengguna pada tabel pengguna di database
          $perbaruiData = $conn->query("UPDATE tbl_pengguna SET username = '$username', password = '$password', nama_lengkap = '$namaLengkap', jenis_kelamin = '$jenisKelamin', gambar_profil = '$namaGambarBaru' WHERE jabatan = '$akunMasuk' ");

          // jika data berhasil diperbarui & jika tidak
          if($perbaruiData == 1) {
            // tampilkan pesan berhasil & alihkan ke halaman index
            echo "<script>

                    Swal.fire({
                        icon: 'success',
                        title: 'Update sukses',
                        showConfirmButton: true
                    }).then(() => {
                        document.location.href = 'index.php';
                    })

            </script>";

            exit();

          }
          else {
            // tampilkan pesan gagal
            echo "<script>

                    Swal.fire({
                        icon: 'error',
                        title: 'Update gagal',
                        showConfirmButton: true
                    })

            </script>";

            exit();

          }

      }
      else {

          // jika gambar invalid/format gambar salah/bukan gambar
          // pesan gagal menyimpan data
          echo "<script>

                  Swal.fire({
                      icon: 'error',
                      title: 'Format gambar salah!',
                      text: 'Gunakan format gambar yang valid',
                      showConfirmButton: true
                  })

          </script>";

          exit();

      }

    }
    else {

      // perbarui data pengguna pada tabel pengguna di database
      $perbaruiData = $conn->query("UPDATE tbl_pengguna SET username = '$username', password = '$password', nama_lengkap = '$namaLengkap', jenis_kelamin = '$jenisKelamin' WHERE jabatan = '$akunMasuk' ");

      // jika data berhasil diperbarui & jika tidak
      if($perbaruiData == 1) {
        // tampilkan pesan berhasil & alihkan ke halaman index
        echo "<script>

                Swal.fire({
                    icon: 'success',
                    title: 'Update sukses',
                    showConfirmButton: true
                }).then(() => {
                    document.location.href = 'index.php';
                })

        </script>";

        exit();

      }
      else {
        // tampilkan pesan gagal
        echo "<script>

                Swal.fire({
                    icon: 'error',
                    title: 'Update gagal',
                    showConfirmButton: true
                })

        </script>";

        exit();

      }

    }

  }

?>
<!-- End Script -->
