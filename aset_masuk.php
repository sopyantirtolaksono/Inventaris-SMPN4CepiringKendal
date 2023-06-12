<!-- PHP Script -->
<?php

    // cek jika ada session kepala sekolah
    $kepSek = $_SESSION["pengguna"]["jabatan"];
    if($kepSek === "kepala sekolah") {
        // alihkan ke halaman dashboard kepala sekolah
        echo "<script>location='index.php';</script>";
        exit();
    }

    // query SQL untuk ambil semua data pada tabel aset masuk didatabase
    $ambilSemuaData = $conn->query("SELECT * FROM tbl_aset_masuk ORDER BY id_aset_masuk DESC");

    // setting auto increment pada field kode_inventaris ditabel aset_masuk
    $ambilMaxKode = $conn->query("SELECT max(kode_inventaris) as maxKode FROM tbl_aset_masuk");
    $pecahMaxKode = $ambilMaxKode->fetch_assoc();
    $maxKode = $pecahMaxKode["maxKode"];
    // lanjut menggabungkan char dan nomor menjadi kode inventaris yang benar.
    $kodeUrut = (int) substr($maxKode, 2, 3);
    $kodeUrut++;
    $char = "KI";
    $kodeJadi = $char . sprintf("%03s", $kodeUrut);

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
            <h1 class="h3 mb-0 text-gray-800">Aset Masuk</h1>
        </div>

        <!-- Content Row & ajax page (edit aset) -->
        <div class="row" id="edit-page">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Input Aset Masuk</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="input-data-tab" data-toggle="tab" href="#input-data" role="tab" aria-controls="input-data" aria-selected="true">Input Data</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="daftar-data-tab" data-toggle="tab" href="#daftar-data" role="tab" aria-controls="daftar-data" aria-selected="false">Daftar Data</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="input-data" role="tabpanel" aria-labelledby="input-data-tab">
                                <form method="post" enctype="multipart/form-data">
                                  <div class="form-row mt-3">
                                    <div class="form-group col-md-4">
                                        
                                        <label for="kodeInventaris">Kode Inventaris</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="kodeInventaris" name="kode_inventaris" value="<?=$kodeJadi; ?>" required disabled>
                                        </div>

                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="nama">Nama</label>
                                      <input type="text" class="form-control" id="nama" name="nama_aset" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="merek">Merek</label>
                                      <input type="text" class="form-control" id="merek" name="merek_aset" required>
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="form-group col-md-4">
                                      <label for="seri">Seri</label>
                                      <input type="text" class="form-control" id="seri" name="seri_aset" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="jumlah">Jumlah</label>
                                      <input type="number" class="form-control" id="jumlah" name="jumlah_aset" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="harga-satuan">Harga Satuan</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="validatedInputGroupPrepend">Rp.</span>
                                        </div>
                                        <input type="number" class="form-control" id="harga-satuan" aria-describedby="validatedInputGroupPrepend" name="harga_satuan_aset" required>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="form-group col-md-4">
                                      <label for="kondisi">Kondisi</label>
                                      <select id="kondisi" class="form-control" name="kondisi_aset" required>
                                        <option value="baru layak pakai">Baru layak pakai</option>
                                        <option value="baru tidak layak pakai">Baru tidak layak pakai</option>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="sumber">Sumber</label>
                                      <input type="text" class="form-control" id="sumber" name="sumber_aset" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="tanggal-masuk">Tanggal Masuk</label>
                                      <input type="date" class="form-control" id="tanggal-masuk" name="tanggal_masuk_aset" required>
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" rows="3" name="keterangan_aset" required></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <span>&nbsp;</span>
                                        <div class="custom-file mt-2">
                                            <input type="file" class="form-control custom-file-input" id="gambar" name="gambar_aset" required>
                                            <label class="custom-file-label" for="gambar">Pilih gambar..</label>
                                        </div>
                                    </div>
                                  </div>

                                  <button type="submit" class="btn btn-primary" name="btn_simpan">Simpan</button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="daftar-data" role="tabpanel" aria-labelledby="daftar-data-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Aksi</th>
                                                <th>Kode Inventaris</th>
                                                <th>Nama</th>
                                                <th>Merek</th>
                                                <th>Seri</th>
                                                <th>Jumlah</th>
                                                <th>Harga Satuan(Rp.)</th>
                                                <th>Kondisi</th>
                                                <th>Sumber</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Keterangan</th>
                                                <th>Total Harga(Rp.)</th>
                                                <th>Gambar</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Aksi</th>
                                                <th>Kode Inventaris</th>
                                                <th>Nama</th>
                                                <th>Merek</th>
                                                <th>Seri</th>
                                                <th>Jumlah</th>
                                                <th>Harga Satuan(Rp.)</th>
                                                <th>Kondisi</th>
                                                <th>Sumber</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Keterangan</th>
                                                <th>Total Harga(Rp.)</th>
                                                <th>Gambar</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <!-- Script PHP query data aset masuk -->
                                            <?php 
                                                $no = 1;
                                                $totalHarga = 0;
                                                while($pecahSemuaData = $ambilSemuaData->fetch_assoc()) { 

                                                    // script total harga
                                                    $hargaSatuan = $pecahSemuaData["harga_satuan_aset"];
                                                    $jumlahAset = $pecahSemuaData["jumlah_aset"];
                                                    $totalHarga = $hargaSatuan * $jumlahAset;
                                            ?>
                                            <tr>
                                                <td><?=$no;  ?></td>
                                                <td class="text-center">
                                                    <a href="index.php?halaman=edit_aset&id=<?=$pecahSemuaData['id_aset_masuk']; ?>" class="btn btn-secondary">Edit</a>
                                                </td>
                                                <td><?=$pecahSemuaData["kode_inventaris"];  ?></td>
                                                <td class="text-capitalize"><?=$pecahSemuaData["nama_aset"];  ?></td>
                                                <td class="text-capitalize"><?=$pecahSemuaData["merek_aset"];  ?></td>
                                                <td class="text-capitalize"><?=$pecahSemuaData["seri_aset"];  ?></td>
                                                <td><?=$pecahSemuaData["jumlah_aset"];  ?></td>
                                                <td><?=number_format($pecahSemuaData["harga_satuan_aset"]); ?></td>
                                                <td class="text-capitalize"><?=$pecahSemuaData["kondisi_aset"];  ?></td>
                                                <td><?=$pecahSemuaData["sumber_aset"];  ?></td>
                                                <td><?=$pecahSemuaData["tanggal_masuk_aset"];  ?></td>
                                                <td class="text-capitalize"><?=$pecahSemuaData["keterangan_aset"];  ?></td>
                                                <td><?=number_format($totalHarga); ?></td>
                                                <td>
                                                    <img src="dist/imgs/img_asset/<?=$pecahSemuaData['gambar_aset']; ?>" alt="Gambar aset" class="img-thumbnail">
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                            <?php } ?>
                                            <!-- End script -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

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

    // cek jika tombol simpan ditekan
    if(isset($_POST["btn_simpan"])) {

        // ambil gambar dari form(nama gambar dan lokasi gambar)
        $namaGambar   = $_FILES["gambar_aset"]["name"];
        $lokasiGambar = $_FILES["gambar_aset"]["tmp_name"];
        // ambil nama ekstensinya(gambar wisata)
        $namaEkstensi = pathinfo($namaGambar, PATHINFO_EXTENSION);

        // cek apakah format gambar valid / invalid
        if( $namaEkstensi == "jpg" || 
            $namaEkstensi == "JPG" || 
            $namaEkstensi == "png" || 
            $namaEkstensi == "PNG" ||
            $namaEkstensi == "jpeg" ||
            $namaEkstensi == "JPEG" ) {
            
            // aktifkan uniqid
            $uniqId = uniqid();
            // buat nama gambar baru
            $namaGambarBaru = $uniqId."_".$namaGambar;
            // pindahkan gambar dari lokasi sementara ke folder
            move_uploaded_file($lokasiGambar, "dist/imgs/img_asset/" .$namaGambarBaru);

            // ambil semua data pada form aset masuk
            // $kodeInventaris    = $_POST["kode_inventaris"];
            $namaAset          = htmlspecialchars($_POST["nama_aset"]);
            $merekAset         = htmlspecialchars($_POST["merek_aset"]);
            $seriAset          = htmlspecialchars($_POST["seri_aset"]);
            $jmlAset           = htmlspecialchars($_POST["jumlah_aset"]);
            $hargaSatuanAset   = htmlspecialchars($_POST["harga_satuan_aset"]);
            $kondisiAset       = htmlspecialchars($_POST["kondisi_aset"]);
            $sumberAset        = htmlspecialchars($_POST["sumber_aset"]);
            $tglMasukAset      = htmlspecialchars($_POST["tanggal_masuk_aset"]);
            $ketAset           = htmlspecialchars($_POST["keterangan_aset"]);
            $namaGambarBaru;

            // masukkan data aset masuk ke dalam tabel aset masuk
            $tambahData = $conn->query("INSERT INTO tbl_aset_masuk (kode_inventaris, nama_aset, merek_aset, seri_aset, jumlah_aset, harga_satuan_aset, kondisi_aset, sumber_aset, tanggal_masuk_aset, keterangan_aset, gambar_aset) VALUES ('$kodeJadi', '$namaAset', '$merekAset', '$seriAset', '$jmlAset', '$hargaSatuanAset', '$kondisiAset', '$sumberAset', '$tglMasukAset', '$ketAset', '$namaGambarBaru') ");

            // cek data berhasil masuk ke database/tabel aset masuk atau tidak
            if($tambahData == 1) {
                // tampilkan pesan berhasil & alihkan ke halaman aset masuk
                // echo "<script>alert('Berhasil update!')</script>";
                // echo "<script>location='index.php';</script>";

                echo "<script>

                    Swal.fire({
                        icon: 'success',
                        title: 'Data berhasil ditambahkan',
                        showConfirmButton: true
                    }).then(() => {
                        document.location.href = 'index.php?halaman=aset_masuk';
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
                        title: 'Data gagal ditambahkan',
                        showConfirmButton: true
                    }).then(() => {
                        document.location.href = 'index.php?halaman=aset_masuk';
                    })

                </script>";

                exit();

            }

        }
        else {

            // jika gambar invalid/format gambar salah/bukan gambar
            // pesan gagal menyimpan data
            // echo "<script>

            //         alert('Format gambar salah!')

            // </script>";

            echo "<script>

                Swal.fire({
                    icon: 'error',
                    title: 'Data gagal ditambahkan',
                    text: 'Coba periksa kembali format gambar anda!',
                    showConfirmButton: true
                }).then(() => {
                    document.location.href = 'index.php?halaman=aset_masuk';
                })

            </script>";

            exit();

        }

    }

?>