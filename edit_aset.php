<!-- PHP Script -->
<?php

    // ambil id aset yang aada di url
    $idAset = $_GET["id"];
    // ambil data aset pada database/tabel aset masuk sesuai id aset yang dikirim
    $ambilDataAset = $conn->query("SELECT * FROM tbl_aset_masuk WHERE id_aset_masuk = '$idAset' ");
    $pecahDataAset = $ambilDataAset->fetch_assoc();

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
            <h1 class="h3 mb-0 text-gray-800">Edit Aset</h1>
        </div>

        <!-- Content Row & ajax page (edit aset) -->
        <div class="row" id="edit-page">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">

                        <form method="post" enctype="multipart/form-data">
                          <div class="form-row mt-3">
                            <div class="form-group col-md-4">
                                
                                <label for="kodeInventaris">Kode Inventaris</label>
                                <input type="text" class="form-control" id="kodeInventaris" placeholder="<?=$pecahDataAset['kode_inventaris']; ?>" value="<?=$pecahDataAset['kode_inventaris']; ?>" name="kode_inventaris" required disabled>

                            </div>
                            <div class="form-group col-md-4">
                              <label for="nama">Nama</label>
                              <input type="text" class="form-control" id="nama" name="nama_aset" value="<?=$pecahDataAset['nama_aset']; ?>" required>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="merek">Merek</label>
                              <input type="text" class="form-control" id="merek" name="merek_aset" value="<?=$pecahDataAset['merek_aset']; ?>" required>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-4">
                              <label for="seri">Seri</label>
                              <input type="text" class="form-control" id="seri" name="seri_aset" value="<?=$pecahDataAset['seri_aset']; ?>" required>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="jumlah">Jumlah</label>
                              <input type="number" class="form-control" id="jumlah" name="jumlah_aset" value="<?=$pecahDataAset['jumlah_aset']; ?>" required>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="harga-satuan">Harga Satuan</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validatedInputGroupPrepend">Rp.</span>
                                </div>
                                <input type="number" class="form-control" id="harga-satuan" aria-describedby="validatedInputGroupPrepend" name="harga_satuan_aset" value="<?=$pecahDataAset['harga_satuan_aset']; ?>" required>
                              </div>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-4">
                              <label for="kondisi">Kondisi</label>
                              <select id="kondisi" class="form-control" name="kondisi_aset" required>
                                <option value="<?=$pecahDataAset['kondisi_aset']; ?>"><?=$pecahDataAset["kondisi_aset"]; ?></option>
                                <option value="baru layak pakai">Baru layak pakai</option>
                                <option value="baru tidak layak pakai">Baru tidak layak pakai</option>
                              </select>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="sumber">Sumber</label>
                              <input type="text" class="form-control" id="sumber" name="sumber_aset" value="<?=$pecahDataAset['sumber_aset']; ?>" required>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="tanggal-masuk">Tanggal Masuk</label>
                              <input type="date" class="form-control" id="tanggal-masuk" name="tanggal_masuk_aset" value="<?=$pecahDataAset['tanggal_masuk_aset']; ?>" required>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" rows="3" name="keterangan_aset" required><?=$pecahDataAset["keterangan_aset"]; ?></textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <span>&nbsp;</span>
                                <div class="custom-file mt-2">
                                    <input type="file" class="form-control custom-file-input" id="gambar" name="gambar_aset">
                                    <label class="custom-file-label" for="gambar">Pilih gambar..</label>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Gambar Aset Lama</label>
                                <img src="dist/imgs/img_asset/<?=$pecahDataAset['gambar_aset']; ?>" alt="Gambar Aset Lama" class="img-thumbnail">
                            </div>
                          </div>

                          <button type="submit" class="btn btn-primary" name="btn_edit">Simpan</button>
                          <a href="index.php?halaman=aset_masuk" class="btn btn-light">Batal</a>
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
    if(isset($_POST["btn_edit"])) {
        // ambil gambar aset yang baru, jika ada
        $namaGambar = $_FILES["gambar_aset"]["name"];
        $namaLokasi = $_FILES["gambar_aset"]["tmp_name"];

        // buat nama gambar baru dengan uniqid
        $uniqId = uniqid();
        $namaGambarBaru = $uniqId ."_". $namaGambar;
        // ambil semua data pada form edit aset
        // $kodeInventaris    = htmlspecialchars($_POST["kode_inventaris"]);
        $namaAset          = htmlspecialchars(strtolower($_POST["nama_aset"]));
        $merekAset         = htmlspecialchars(strtolower($_POST["merek_aset"]));
        $seriAset          = htmlspecialchars(strtolower($_POST["seri_aset"]));
        $jmlAset           = htmlspecialchars(strtolower($_POST["jumlah_aset"]));
        $hargaSatuanAset   = htmlspecialchars(strtolower($_POST["harga_satuan_aset"]));
        $kondisiAset       = htmlspecialchars(strtolower($_POST["kondisi_aset"]));
        $sumberAset        = htmlspecialchars(strtolower($_POST["sumber_aset"]));
        $tglMasukAset      = htmlspecialchars(strtolower($_POST["tanggal_masuk_aset"]));
        $ketAset           = htmlspecialchars(strtolower($_POST["keterangan_aset"]));
        $namaGambarBaru;

        // jika tidak ada gambar aset yang diedit
        if(empty($namaLokasi)) {
            // updata data pada tabel aset masuk, sesuai dengan data yang ada diform edit aset
            $editData = $conn->query("UPDATE tbl_aset_masuk SET nama_aset = '$namaAset', merek_aset = '$merekAset', seri_aset = '$seriAset', jumlah_aset = '$jmlAset', harga_satuan_aset = '$hargaSatuanAset', kondisi_aset = '$kondisiAset', sumber_aset = '$sumberAset', tanggal_masuk_aset = '$tglMasukAset', keterangan_aset = '$ketAset' WHERE id_aset_masuk = '$idAset' ");
            // cek status update, berhasil/gagal
            if($editData == 1) {
                // tampilkan pesan berhasil update
                // echo "<script>alert('Berhasil update!')</script>";
                echo "<script>

                    Swal.fire({
                        icon: 'success',
                        title: 'Data berhasil diupdate',
                        showConfirmButton: true
                    }).then(() => {
                        document.location.href = 'index.php?halaman=aset_masuk';
                    })

                </script>";

                exit();
            }
            else {
                // tampilkan pesan gagal update
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
            // ambil nama ekstensi gambar
            $namaEkstensi = pathinfo($namaGambar, PATHINFO_EXTENSION);

            // cek apakah format gambar valid / invalid
            if( $namaEkstensi == "jpg" || 
                $namaEkstensi == "JPG" || 
                $namaEkstensi == "png" || 
                $namaEkstensi == "PNG" ||
                $namaEkstensi == "jpeg" ||
                $namaEkstensi == "JPEG" ) {

                // pindahkan gambar dari lokasi sementara ke folder img_asset
                move_uploaded_file($namaLokasi, "dist/imgs/img_asset/" .$namaGambarBaru);
                // updata data pada tabel aset masuk, sesuai dengan data yang ada diform edit aset
                $editData = $conn->query("UPDATE tbl_aset_masuk SET nama_aset = '$namaAset', merek_aset = '$merekAset', seri_aset = '$seriAset', jumlah_aset = '$jmlAset', harga_satuan_aset = '$hargaSatuanAset', kondisi_aset = '$kondisiAset', sumber_aset = '$sumberAset', tanggal_masuk_aset = '$tglMasukAset', keterangan_aset = '$ketAset', gambar_aset = '$namaGambarBaru' WHERE id_aset_masuk = '$idAset' ");
                // cek status update, berhasil/gagal
                if($editData == 1) {
                    // tampilkan pesan berhasil update
                    // echo "<script>alert('Berhasil update!')</script>";
                    echo "<script>

                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil diupdate',
                            showConfirmButton: true
                        }).then(() => {
                            document.location.href = 'index.php?halaman=aset_masuk';
                        })

                    </script>";

                    exit();
                }
                else {
                    // tampilkan pesan gagal update
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

                // jika gambar invalid/format gambar salah/bukan gambar
                // pesan gagal update data
                // echo "<script>alert('Format gambar salah!')</script>";
                echo "<script>

                    Swal.fire({
                        icon: 'error',
                        title: 'Data gagal ditambahkan',
                        text: 'Coba periksa kembali format gambar anda!',
                        showConfirmButton: true
                    })

                </script>";

                exit();

            }

        }
    }

?>