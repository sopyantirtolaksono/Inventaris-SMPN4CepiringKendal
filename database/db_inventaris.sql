-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Sep 2021 pada 06.30
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventaris`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_aset_masuk`
--

CREATE TABLE `tbl_aset_masuk` (
  `id_aset_masuk` int(11) NOT NULL,
  `kode_inventaris` varchar(255) NOT NULL,
  `nama_aset` varchar(255) NOT NULL,
  `merek_aset` varchar(255) NOT NULL,
  `seri_aset` varchar(255) NOT NULL,
  `jumlah_aset` int(255) NOT NULL,
  `harga_satuan_aset` int(255) NOT NULL,
  `kondisi_aset` varchar(255) NOT NULL,
  `sumber_aset` varchar(255) NOT NULL,
  `tanggal_masuk_aset` varchar(255) NOT NULL,
  `keterangan_aset` text NOT NULL,
  `gambar_aset` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_aset_masuk`
--

INSERT INTO `tbl_aset_masuk` (`id_aset_masuk`, `kode_inventaris`, `nama_aset`, `merek_aset`, `seri_aset`, `jumlah_aset`, `harga_satuan_aset`, `kondisi_aset`, `sumber_aset`, `tanggal_masuk_aset`, `keterangan_aset`, `gambar_aset`) VALUES
(1, 'KI001', 'Laptop', 'Lenovo', 'T550', 10, 7000000, 'baru layak pakai', 'CV. Al Bumi Comp', '2021-08-25', 'Untuk ujian.', '6125b37d1f006_l_lenovo.jpg'),
(2, 'KI002', 'Laptop', 'Lenovo', 'T550', 10, 7000000, 'baru layak pakai', 'CV. Al Bumi Comp', '2021-08-25', 'Untuk ujian.', '6125b3aec150e_l_lenovo.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hapus_aset`
--

CREATE TABLE `tbl_hapus_aset` (
  `id_hapus_aset` int(11) NOT NULL,
  `kode_inventaris` varchar(255) NOT NULL,
  `nama_aset` varchar(255) NOT NULL,
  `merek_aset` varchar(255) NOT NULL,
  `seri_aset` varchar(255) NOT NULL,
  `jumlah_aset` int(255) NOT NULL,
  `jumlah_maintenance` int(255) NOT NULL,
  `harga_satuan_aset` int(255) NOT NULL,
  `kondisi_aset` varchar(255) NOT NULL,
  `sumber_aset` varchar(255) NOT NULL,
  `tanggal_masuk_aset` date NOT NULL,
  `keterangan_aset` varchar(255) NOT NULL,
  `gambar_aset` varchar(255) NOT NULL,
  `tanggal_hapus_aset` date NOT NULL,
  `keterangan_hapus_aset` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hapus_stok`
--

CREATE TABLE `tbl_hapus_stok` (
  `id_hapus_stok` int(11) NOT NULL,
  `kode_inventaris` varchar(255) NOT NULL,
  `nama_aset` varchar(255) NOT NULL,
  `merek_aset` varchar(255) NOT NULL,
  `seri_aset` varchar(255) NOT NULL,
  `jumlah_stok` int(255) NOT NULL,
  `harga_satuan_aset` int(255) NOT NULL,
  `kondisi_aset` varchar(255) NOT NULL,
  `sumber_aset` varchar(255) NOT NULL,
  `tanggal_masuk_aset` date NOT NULL,
  `keterangan_aset` varchar(255) NOT NULL,
  `gambar_aset` varchar(255) NOT NULL,
  `tanggal_hapus_stok` date NOT NULL,
  `keterangan_hapus_stok` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_maintenance`
--

CREATE TABLE `tbl_maintenance` (
  `id_maintenance` int(11) NOT NULL,
  `id_aset_masuk` int(255) NOT NULL,
  `jumlah_maintenance` int(255) NOT NULL,
  `biaya_maintenance` int(255) NOT NULL,
  `tanggal_maintenance` date NOT NULL,
  `keterangan_maintenance` text NOT NULL,
  `status_maintenance` varchar(255) NOT NULL DEFAULT 'maintenance'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `gambar_profil` varchar(255) NOT NULL DEFAULT 'default.svg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`id_pengguna`, `username`, `password`, `nama_lengkap`, `jabatan`, `jenis_kelamin`, `gambar_profil`) VALUES
(1, 'alexa', 'alexa', 'asep saifudin', 'admin', 'pria', 'default.svg'),
(2, 'agus', 'agus', 'agus purnomo', 'kepala sekolah', 'pria', 'default.svg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_selesai_maintenance`
--

CREATE TABLE `tbl_selesai_maintenance` (
  `id_selesai_maintenance` int(11) NOT NULL,
  `kode_inventaris` varchar(255) NOT NULL,
  `nama_aset` varchar(255) NOT NULL,
  `merek_aset` varchar(255) NOT NULL,
  `seri_aset` varchar(255) NOT NULL,
  `jumlah_maintenance` int(255) NOT NULL,
  `biaya_maintenance` int(255) NOT NULL,
  `tanggal_maintenance` date NOT NULL,
  `tanggal_selesai_maintenance` date NOT NULL,
  `keterangan_maintenance` varchar(255) NOT NULL,
  `status_maintenance` varchar(255) NOT NULL DEFAULT 'finish',
  `gambar_aset` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_selesai_maintenance`
--

INSERT INTO `tbl_selesai_maintenance` (`id_selesai_maintenance`, `kode_inventaris`, `nama_aset`, `merek_aset`, `seri_aset`, `jumlah_maintenance`, `biaya_maintenance`, `tanggal_maintenance`, `tanggal_selesai_maintenance`, `keterangan_maintenance`, `status_maintenance`, `gambar_aset`) VALUES
(1, 'KI002', 'Laptop', 'Lenovo', 'T550', 1, 500000, '2021-08-27', '2021-08-27', '-', 'finish', '6125b3aec150e_l_lenovo.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_aset_masuk`
--
ALTER TABLE `tbl_aset_masuk`
  ADD PRIMARY KEY (`id_aset_masuk`);

--
-- Indeks untuk tabel `tbl_hapus_aset`
--
ALTER TABLE `tbl_hapus_aset`
  ADD PRIMARY KEY (`id_hapus_aset`);

--
-- Indeks untuk tabel `tbl_hapus_stok`
--
ALTER TABLE `tbl_hapus_stok`
  ADD PRIMARY KEY (`id_hapus_stok`);

--
-- Indeks untuk tabel `tbl_maintenance`
--
ALTER TABLE `tbl_maintenance`
  ADD PRIMARY KEY (`id_maintenance`);

--
-- Indeks untuk tabel `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `tbl_selesai_maintenance`
--
ALTER TABLE `tbl_selesai_maintenance`
  ADD PRIMARY KEY (`id_selesai_maintenance`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_aset_masuk`
--
ALTER TABLE `tbl_aset_masuk`
  MODIFY `id_aset_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_hapus_aset`
--
ALTER TABLE `tbl_hapus_aset`
  MODIFY `id_hapus_aset` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_hapus_stok`
--
ALTER TABLE `tbl_hapus_stok`
  MODIFY `id_hapus_stok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_maintenance`
--
ALTER TABLE `tbl_maintenance`
  MODIFY `id_maintenance` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_selesai_maintenance`
--
ALTER TABLE `tbl_selesai_maintenance`
  MODIFY `id_selesai_maintenance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
