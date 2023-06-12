-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Agu 2022 pada 16.28
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nn`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `album`
--

CREATE TABLE `album` (
  `idalbum` int(11) NOT NULL,
  `nama_album` varchar(225) NOT NULL,
  `gambar_album` varchar(100) NOT NULL,
  `deskripsi_album` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `album`
--

INSERT INTO `album` (`idalbum`, `nama_album`, `gambar_album`, `deskripsi_album`) VALUES
(62, 'Rias Busana00', '62c6732a3a7d7.jpg', 'Style 03'),
(65, 'Rias Busana0000', '62e233531c56b.jpg', 'yaa'),
(67, 'coba1', '62c7dbed89f9a.jpg', 'tes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`idbarang`, `namabarang`, `deskripsi`, `stok`, `harga`) VALUES
(20, 'Kripik Jamur', 'isi 2', 10, 12000),
(21, 'Carica', 'isi 2', 20, 12000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detpesanan`
--

CREATE TABLE `detpesanan` (
  `iddetailpes` int(11) NOT NULL,
  `orderid` varchar(50) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detpesanan`
--

INSERT INTO `detpesanan` (`iddetailpes`, `orderid`, `idbarang`, `qty`) VALUES
(38, '96Fm5etoW2KWQ', 20, 3),
(40, '24d.tNAoyzfZY', 20, 3),
(46, '98ASV1DkT4Kz2', 21, 1),
(47, '352DeJsgtxG.6', 20, 1),
(48, '18RghcXpp.goI', 20, 1),
(49, '64ghUN0lZPOOc', 20, 2),
(51, '91WkgWm69x4t6', 21, 3),
(52, '563lCyFW04knI', 20, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keluar`
--

CREATE TABLE `keluar` (
  `id_keluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal_keluar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `jumlah` int(11) NOT NULL,
  `penerima` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `keluar`
--

INSERT INTO `keluar` (`id_keluar`, `idbarang`, `tanggal_keluar`, `jumlah`, `penerima`) VALUES
(61, 21, '2022-07-08 07:40:02', 3, '91WkgWm69x4t6'),
(62, 20, '2022-07-26 07:22:39', 2, '563lCyFW04knI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk`
--

CREATE TABLE `masuk` (
  `id_masuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal_masuk` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `qty_masuk` int(11) NOT NULL,
  `Input` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `masuk`
--

INSERT INTO `masuk` (`id_masuk`, `idbarang`, `tanggal_masuk`, `qty_masuk`, `Input`) VALUES
(45, 16, '2022-06-21 06:44:57', 4, 'untuk pesanan'),
(46, 17, '2022-06-21 06:38:43', 5, 'untuk pesanan'),
(47, 16, '2022-06-29 08:46:21', 3, 'Sisanya besok'),
(48, 19, '2022-06-29 09:23:03', 5, 'ghofur'),
(49, 20, '2022-07-05 15:06:57', 12, 'Sisanya besok'),
(51, 21, '2022-07-30 05:30:37', 15, 'menambah stok');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `idorder` int(11) NOT NULL,
  `orderid` varchar(50) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_admin` int(11) NOT NULL,
  `keperluan` text NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`idorder`, `orderid`, `tanggal`, `id_admin`, `keperluan`, `status`) VALUES
(38, '12Ef.VXJMJ1e2', '2022-07-08 06:19:31', 14, 'Pembeli eceran', 'Diproses'),
(39, '91WkgWm69x4t6', '2022-07-08 07:37:51', 13, 'pesanan wonosobo', 'Selesai'),
(40, '563lCyFW04knI', '2022-07-26 07:22:15', 13, 'Pembeli eceran', 'Diproses');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `gambar_produk` varchar(50) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `deskripsi_produk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `gambar_produk`, `harga_produk`, `deskripsi_produk`) VALUES
(8, 'carica', '62c53849c49b3.jpg', 15000, 'Manisan botol'),
(9, 'carica mini', '62c6843b2ed6b.jpg', 15000, 'Manisan botol'),
(11, 'Kripik kentang', '62c7f2a82756b.png', 15000, '100 gr');

-- --------------------------------------------------------

--
-- Struktur dari tabel `staf`
--

CREATE TABLE `staf` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `staf`
--

INSERT INTO `staf` (`id_admin`, `nama_admin`, `email`, `password`) VALUES
(19, 'Rizqi', 'hari@gmail.com', '$2y$10$YgbWbWjnTaLPbgZfkWiaX.6aCEW9UiBHJ2CHJNa/O6SbxqJUexs2u'),
(21, 'Dafid', 'dafid@gmail.com', '$2y$10$CsoEVOXMm3DhbCOeoEnMcOXlCoUmmw6gFuN6SdaOTAJk9FFGYd/cC'),
(22, 'Misbah', 'misbah@gmail.com', '$2y$10$3yjzR75cCRf3nWWZ5PLvl.RkfoFGj/VfqGaEElxN1Uq1nMZohoAX2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`idalbum`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indeks untuk tabel `detpesanan`
--
ALTER TABLE `detpesanan`
  ADD PRIMARY KEY (`iddetailpes`);

--
-- Indeks untuk tabel `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indeks untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`idorder`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `staf`
--
ALTER TABLE `staf`
  ADD PRIMARY KEY (`id_admin`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `album`
--
ALTER TABLE `album`
  MODIFY `idalbum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `detpesanan`
--
ALTER TABLE `detpesanan`
  MODIFY `iddetailpes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `keluar`
--
ALTER TABLE `keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `masuk`
--
ALTER TABLE `masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `idorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `staf`
--
ALTER TABLE `staf`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
