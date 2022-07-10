-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2022 at 09:24 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `n1804666_laporankeuangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_level`
--

CREATE TABLE `access_level` (
  `id_al` int(11) NOT NULL,
  `nama_al` varchar(40) NOT NULL,
  `fk_id_perusahaan` int(11) NOT NULL,
  `status_al` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_level`
--

INSERT INTO `access_level` (`id_al`, `nama_al`, `fk_id_perusahaan`, `status_al`) VALUES
(1, 'Admin PT KCI', 1, 1),
(2, 'Admin PT KMP', 2, 1),
(3, 'Admin PT KAMI', 3, 1),
(4, 'Admin CV KCI', 4, 1),
(5, 'Super Admin', 5, 1),
(6, 'Manager PT KCI', 1, 1),
(7, 'Manager PT KAMI', 3, 1),
(8, 'Manager PT KMP', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `access_menu`
--

CREATE TABLE `access_menu` (
  `id_access_menu` int(11) NOT NULL,
  `fk_id_category` int(2) NOT NULL,
  `fk_id_menu` int(2) NOT NULL,
  `fk_id_al` int(2) NOT NULL,
  `status_access_menu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_menu`
--

INSERT INTO `access_menu` (`id_access_menu`, `fk_id_category`, `fk_id_menu`, `fk_id_al`, `status_access_menu`) VALUES
(17, 6, 15, 5, 1),
(18, 6, 17, 5, 1),
(19, 6, 16, 5, 1),
(20, 7, 18, 5, 1),
(21, 7, 19, 5, 1),
(22, 8, 20, 5, 1),
(23, 8, 21, 5, 1),
(24, 9, 22, 5, 1),
(25, 9, 23, 5, 1),
(26, 10, 24, 5, 1),
(27, 10, 25, 5, 1),
(28, 6, 26, 5, 1),
(29, 11, 27, 5, 1),
(30, 12, 28, 5, 1),
(31, 13, 29, 5, 1),
(32, 14, 30, 5, 1),
(33, 7, 18, 1, 1),
(34, 7, 19, 1, 1),
(35, 8, 20, 2, 1),
(36, 8, 21, 2, 1),
(37, 9, 22, 3, 1),
(38, 9, 23, 3, 1),
(39, 10, 24, 4, 1),
(40, 10, 25, 4, 1),
(41, 11, 27, 1, 1),
(42, 12, 28, 2, 1),
(43, 13, 29, 3, 1),
(44, 14, 30, 4, 1),
(45, 6, 31, 5, 1),
(46, 6, 32, 5, 1),
(47, 7, 26, 1, 1),
(48, 8, 26, 2, 1),
(49, 9, 26, 3, 1),
(50, 10, 26, 4, 1),
(52, 6, 38, 5, 1),
(53, 10, 39, 5, 1),
(54, 10, 40, 5, 1),
(55, 10, 39, 4, 1),
(56, 10, 40, 4, 1),
(57, 7, 45, 1, 1),
(58, 7, 46, 1, 1),
(59, 8, 43, 2, 1),
(60, 8, 44, 2, 1),
(61, 9, 41, 3, 1),
(62, 9, 42, 3, 1),
(63, 7, 45, 5, 1),
(64, 7, 46, 5, 1),
(65, 6, 47, 5, 1),
(66, 11, 48, 5, 1),
(67, 11, 48, 1, 1),
(68, 14, 49, 4, 1),
(69, 14, 49, 5, 1),
(70, 7, 47, 1, 1),
(71, 10, 47, 4, 1),
(72, 6, 50, 5, 1),
(73, 6, 51, 5, 1),
(74, 6, 52, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_transaksi`
--

CREATE TABLE `jenis_transaksi` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(30) NOT NULL,
  `status_jenis` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_transaksi`
--

INSERT INTO `jenis_transaksi` (`id_jenis`, `nama_jenis`, `status_jenis`) VALUES
(1, 'Gaji', 1),
(2, 'Pengeluaran Harian', 1),
(3, 'Perabotan', 1),
(4, 'Pengeluaran Bulanan', 1),
(5, 'Pendapatan Bulanan', 1),
(6, 'Sumbangan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_menu`
--

CREATE TABLE `kategori_menu` (
  `id_category` int(2) NOT NULL,
  `nama_category` varchar(30) NOT NULL,
  `status_category` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_menu`
--

INSERT INTO `kategori_menu` (`id_category`, `nama_category`, `status_category`) VALUES
(6, 'Konfigurasi', 1),
(7, 'Transaksi PT KCI', 1),
(8, 'Transaksi PT KMP', 1),
(9, 'Transaksi PT KAMI', 1),
(10, 'Transaksi CV KCI', 1),
(11, 'Laporan PT KCI', 1),
(12, 'Laporan PT KMP', 1),
(13, 'Laporan PT KAMI', 1),
(14, 'Laporan CV KCI', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `nama_lokasi` varchar(100) NOT NULL,
  `status_lokasi` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `nama_lokasi`, `status_lokasi`) VALUES
(1, 'Bali', 1),
(2, 'Malang', 1),
(3, 'Bandung', 1),
(5, 'CV KCI', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(2) NOT NULL,
  `nama_menu` varchar(30) NOT NULL,
  `alamat_menu` varchar(50) NOT NULL,
  `status_menu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `alamat_menu`, `status_menu`) VALUES
(15, 'Halaman Menu', 'menu.php', 1),
(16, 'Halaman Access Menu', 'accessMenu.php', 1),
(17, 'Halaman Kategori', 'kategori_menu.php', 1),
(18, 'Transaksi Pemasukan PT KCI', 'transaksi.php?trx=2&prs=1', 1),
(19, 'Transaksi Pengeluaran PT KCI', 'transaksi.php?trx=1&prs=1', 1),
(20, 'Transaksi Pemasukan KMP', 'transaksi.php?trx=2&prs=2', 1),
(21, 'Transaksi Pengeluaran KMP', 'transaksi.php?trx=1&prs=2', 1),
(22, 'Transaksi Pemasukan KAMI', 'transaksi.php?trx=2&prs=3', 1),
(23, 'Transaksi Pengeluaran KAMI', 'transaksi.php?trx=1&prs=3', 1),
(24, 'Transaksi Pemasukan CV KCI', 'transaksi.php?trx=2&prs=4', 1),
(25, 'Transaksi Pengeluaran CV KCI', 'transaksi.php?trx=1&prs=4', 1),
(26, 'Data Transaksi', 'dataPengeluaran.php', 1),
(27, 'Laporan Transaksi PT KCI', 'laporanPengeluaran.php?prs=1', 1),
(28, 'Laporan Transaksi KMP', 'laporanPengeluaran.php?prs=2', 1),
(29, 'Laporan Transaksi KAMI', 'laporanPengeluaran.php?prs=3', 1),
(30, 'Laporan Transaksi CV KCI', 'laporanPengeluaran.php?prs=4', 1),
(31, 'Halaman Lokasi', 'lokasi.php', 1),
(32, 'Halaman Stok Barang/BBM', 'stokBarang.php', 1),
(38, 'Halaman User', 'user.php', 1),
(39, 'Pengeluaran BBM CV KCI', 'transaksiBarang.php?trx=1&prs=4', 1),
(40, 'Pemasukan BBM CV KCI', 'transaksiBarang.php?trx=2&prs=4', 1),
(41, 'Pengeluaran Barang PT KAMI', 'transaksiBarang.php?trx=1&prs=3', 1),
(42, 'Pemasukan Barang PT KAMI', 'transaksiBarang.php?trx=2&prs=3', 1),
(43, 'Pengeluaran BBM PT KMP', 'transaksiBarang.php?trx=1&prs=2', 1),
(44, 'Pemasukan BBM PT KMP', 'transaksiBarang.php?trx=2&prs=2', 1),
(45, 'Pengeluaran BBM PT KCI', 'transaksiBarang.php?trx=1&prs=1', 1),
(46, 'Pemasukan BBM PT KCI', 'transaksiBarang.php?trx=2&prs=1', 1),
(47, 'Data Transaksi Barang/BBM', 'dataTransaksiBarang.php', 1),
(48, 'Laporan BBM PT KCI', 'laporanPengeluaranBarang.php?prs=1', 1),
(49, 'Laporan BBM CV KCI', 'laporanPengeluaranBarang.php?prs=4', 1),
(50, 'Halaman Jenis Transaksi', 'jenisTransaksi.php', 1),
(51, 'Halaman Access Level', 'accessLevel.php', 1),
(52, 'Halaman Projek', 'projek.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `status_perusahaan` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nama_perusahaan`, `status_perusahaan`) VALUES
(1, 'PT Kencana Indah Inti Sejahtera', 1),
(2, 'PT Kencana Mitra Perkasa', 1),
(3, 'PT Kencana Anugrah Mitra Indah', 1),
(4, 'CV Kencana Indah', 1),
(5, 'ALL PERUSAHAAN', 1);

-- --------------------------------------------------------

--
-- Table structure for table `projek`
--

CREATE TABLE `projek` (
  `id_projek` int(11) NOT NULL,
  `nama_projek` varchar(100) NOT NULL,
  `status_projek` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projek`
--

INSERT INTO `projek` (`id_projek`, `nama_projek`, `status_projek`) VALUES
(1, 'Non-projek', 1),
(2, 'Projek Penggalian', 1),
(3, 'Projek Sumber Daya BBM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `saldo`
--

CREATE TABLE `saldo` (
  `id_saldo` int(11) NOT NULL,
  `fk_id_perusahaan` int(3) NOT NULL,
  `saldo` bigint(20) NOT NULL,
  `status_saldo` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saldo`
--

INSERT INTO `saldo` (`id_saldo`, `fk_id_perusahaan`, `saldo`, `status_saldo`) VALUES
(1, 1, 4721232, '1'),
(2, 2, 7700000, '1'),
(4, 3, 4800000, '1'),
(5, 4, 11899911, '1');

-- --------------------------------------------------------

--
-- Table structure for table `stock_barang`
--

CREATE TABLE `stock_barang` (
  `id_stock_barang` int(11) NOT NULL,
  `fk_id_lokasi` int(11) NOT NULL,
  `fk_id_perusahaan` int(11) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `stock` int(11) NOT NULL,
  `status_barang` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_barang`
--

INSERT INTO `stock_barang` (`id_stock_barang`, `fk_id_lokasi`, `fk_id_perusahaan`, `nama_barang`, `stock`, `status_barang`) VALUES
(1, 1, 1, 'Bensin', 1029, 1),
(2, 2, 2, 'Bensin', 2000, 1),
(3, 3, 1, 'Bensin', 0, 1),
(6, 1, 3, 'Bensin Extra', 123, 1),
(8, 5, 4, 'Bahan Bakar DT', 1032, 1),
(9, 5, 4, 'Bahan Bakar AMP', 981, 1),
(10, 2, 1, 'Mesin', 200, 1),
(12, 2, 1, 'Bensin', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` char(20) NOT NULL,
  `fk_id_perusahaan` int(11) NOT NULL,
  `fk_id_saldo` int(11) NOT NULL,
  `fk_id_jenis_transaksi` int(11) NOT NULL,
  `nama_transaksi` varchar(30) NOT NULL,
  `fk_id_projek` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `pemasukan` bigint(20) DEFAULT NULL,
  `pengeluaran` bigint(20) DEFAULT NULL,
  `saldo_before_transaction` bigint(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `keterangan_transaksi` varchar(100) NOT NULL,
  `status_transaksi` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `fk_id_perusahaan`, `fk_id_saldo`, `fk_id_jenis_transaksi`, `nama_transaksi`, `fk_id_projek`, `qty`, `satuan`, `pemasukan`, `pengeluaran`, `saldo_before_transaction`, `tanggal_transaksi`, `keterangan_transaksi`, `status_transaksi`) VALUES
('TR01062022212548', 2, 2, 2, 'Rokok', 0, 100, 'dus', 6000000, NULL, 9200000, '2022-06-01', '', 1),
('TR01062022212600', 2, 2, 1, 'Pinjam Uang', 0, 1, 'Lembar', NULL, 500000, 15200000, '2022-06-01', '', 1),
('TR04072022201723', 4, 5, 1, 'gaji', 0, 100, '-', NULL, 10000, 0, '2022-07-04', '', 1),
('TR04072022215230', 4, 5, 1, 'gaji', 0, 100, '-', NULL, 13212, -10000, '2022-07-04', '', 1),
('TR04072022215308', 4, 5, 4, 'Perawatan mesin', 3, 100, 'mesin', 123123123, NULL, -23212, '2022-07-04', 'Me', 1),
('TR05072022055937', 1, 1, 1, '1', 1, 1, '-', 111111, NULL, 6010123, '2022-07-05', '', 1),
('TR05072022194830', 4, 5, 2, 'Snack', 0, 100, 'bungkus', NULL, 200000, 123099911, '2022-07-05', 'test', 1),
('TR05072022202119', 1, 1, 1, 'Minum', 1, 100, 'botol', 500000, NULL, 6121234, '2022-07-05', 'aqua', 1),
('TR05072022202157', 1, 1, 1, 'Gaji', 2, 1, '-', 1000000, NULL, 6621234, '2022-07-05', '', 1),
('TR05072022203922', 2, 2, 2, 'a', 0, 1, 'a', 3000000, NULL, 14700000, '2022-07-05', 'a', 1),
('TR05072022204108', 2, 2, 2, 's', 0, 1, 's', NULL, 10000000, 17700000, '2022-07-05', 's', 1),
('TR05072022204245', 2, 2, 1, 'd', 0, 2, 'd', 1000000, NULL, 7700000, '2022-07-05', 'd', 1),
('TR05072022204354', 4, 5, 2, 'f', 0, 1, 'f', NULL, 1000000, 122899911, '2022-07-05', 'f', 1),
('TR05072022204428', 1, 1, 2, 'q', 0, 3, 'q', NULL, 3000000, 7621234, '2022-07-05', 'q', 1),
('TR05072022204724', 3, 4, 1, 'w', 1, 1, 'w', 5000000, NULL, 0, '2022-07-05', 'w', 1),
('TR06072022142011', 4, 5, 2, 'macem2', 0, 1, '-', NULL, 10000000, 121899911, '2022-07-06', 'foya2', 1),
('TR06072022143735', 4, 5, 2, 'kurang', 0, 1, '-', NULL, 100000000, 111899911, '2022-07-06', 'kurang', 1),
('TR07072022194351', 1, 1, 1, '', 1, -1, '', NULL, 1, 4621234, '2022-07-07', '', 1),
('TR07072022194546', 1, 1, 1, '', 1, -1, '', NULL, 1, 4621233, '2022-07-07', '', 1),
('TR10072022132819', 1, 1, 3, 'Kursi', 3, 10, 'buah', 100000, NULL, 4621232, '2022-07-10', 'rotan', 1),
('TR10072022132912', 2, 2, 3, 'Meja', 1, 10, 'buah', NULL, 1000000, 8700000, '2022-07-10', 'kaca', 1),
('TR10072022133307', 3, 4, 3, 'lemari', 1, 1, 'biji', NULL, 200000, 5000000, '2022-07-10', 'LEMARI', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_bbm`
--

CREATE TABLE `transaksi_bbm` (
  `id_transaksi_bbm` char(20) NOT NULL,
  `fk_id_stock_barang` int(11) NOT NULL,
  `fk_id_lokasi` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `pengeluaran_stock` bigint(20) DEFAULT NULL,
  `pemasukan_stock` bigint(20) DEFAULT NULL,
  `stock_sebelumnya` bigint(20) NOT NULL,
  `status_transaksi` int(1) NOT NULL,
  `keterangan_transaksi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_bbm`
--

INSERT INTO `transaksi_bbm` (`id_transaksi_bbm`, `fk_id_stock_barang`, `fk_id_lokasi`, `tanggal_transaksi`, `pengeluaran_stock`, `pemasukan_stock`, `stock_sebelumnya`, `status_transaksi`, `keterangan_transaksi`) VALUES
('TRB06072022131132', 1, 2, '2022-07-06', NULL, 20, 1000, 1, 'tester'),
('TRB06072022131154', 1, 2, '2022-07-06', NULL, 20, 1020, 1, 'testa'),
('TRB07072022081329', 1, 1, '2022-07-07', 1, NULL, 1040, 1, ''),
('TRB07072022082005', 9, 5, '2022-07-07', 11, NULL, 1000, 1, 'adsf'),
('TRB07072022082134', 8, 5, '2022-07-07', NULL, 20, 1000, 1, ''),
('TRB07072022111226', 1, 1, '2022-07-07', 12, NULL, 1039, 1, ''),
('TRB07072022111852', 8, 5, '2022-07-07', 123, NULL, 1020, 1, ''),
('TRB07072022111906', 8, 5, '2022-07-07', NULL, 123, 897, 1, ''),
('TRB07072022155802', 1, 1, '2022-07-07', NULL, 2, 1027, 1, ''),
('TRB07072022160033', 8, 5, '2022-07-07', NULL, 12, 1020, 1, 'baru'),
('TRB07072022160041', 9, 5, '2022-07-07', NULL, 12, 989, 1, 'baru'),
('TRB07072022160148', 9, 5, '2022-07-07', 20, NULL, 1001, 1, ''),
('TRB07072022211927', 12, 2, '2022-07-07', 111, NULL, 123, 1, ''),
('TRB10072022141107', 3, 3, '2022-07-10', 10000, NULL, 10000, 1, 'banyak');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password_user` varchar(100) NOT NULL,
  `fk_id_al` int(11) NOT NULL,
  `status_user` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password_user`, `fk_id_al`, `status_user`) VALUES
(1, 'super', '202cb962ac59075b964b07152d234b70', 5, 1),
(2, 'adminCVKCI', '202cb962ac59075b964b07152d234b70', 4, 1),
(3, 'adminPTKCI', '202cb962ac59075b964b07152d234b70', 1, 1),
(6, 'adminPTKMP', '202cb962ac59075b964b07152d234b70', 2, 1),
(7, 'adminPTKAMI', '202cb962ac59075b964b07152d234b70', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_level`
--
ALTER TABLE `access_level`
  ADD PRIMARY KEY (`id_al`);

--
-- Indexes for table `access_menu`
--
ALTER TABLE `access_menu`
  ADD PRIMARY KEY (`id_access_menu`);

--
-- Indexes for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kategori_menu`
--
ALTER TABLE `kategori_menu`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `projek`
--
ALTER TABLE `projek`
  ADD PRIMARY KEY (`id_projek`);

--
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`);

--
-- Indexes for table `stock_barang`
--
ALTER TABLE `stock_barang`
  ADD PRIMARY KEY (`id_stock_barang`),
  ADD UNIQUE KEY `fk_id_lokasi` (`fk_id_lokasi`,`fk_id_perusahaan`,`nama_barang`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_bbm`
--
ALTER TABLE `transaksi_bbm`
  ADD PRIMARY KEY (`id_transaksi_bbm`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_level`
--
ALTER TABLE `access_level`
  MODIFY `id_al` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `access_menu`
--
ALTER TABLE `access_menu`
  MODIFY `id_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategori_menu`
--
ALTER TABLE `kategori_menu`
  MODIFY `id_category` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `projek`
--
ALTER TABLE `projek`
  MODIFY `id_projek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock_barang`
--
ALTER TABLE `stock_barang`
  MODIFY `id_stock_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
