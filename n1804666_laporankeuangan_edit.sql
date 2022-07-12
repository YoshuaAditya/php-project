-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 05:35 PM
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
  `fk_id_category` int(4) NOT NULL,
  `fk_id_menu` int(4) NOT NULL,
  `fk_id_al` int(4) NOT NULL,
  `status_access_menu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_menu`
--

INSERT INTO `access_menu` (`id_access_menu`, `fk_id_category`, `fk_id_menu`, `fk_id_al`, `status_access_menu`) VALUES
(1, 1, 1, 5, 1),
(2, 1, 2, 5, 1),
(3, 1, 3, 5, 1),
(4, 1, 4, 5, 1),
(5, 1, 5, 5, 1),
(6, 1, 6, 5, 1),
(7, 1, 7, 5, 1),
(8, 1, 8, 5, 1),
(9, 1, 9, 5, 1),
(10, 1, 10, 5, 1),
(11, 1, 11, 5, 1),
(12, 2, 12, 1, 1),
(13, 2, 13, 1, 1),
(14, 2, 14, 1, 1),
(15, 2, 15, 1, 1),
(16, 2, 12, 5, 1),
(17, 2, 13, 5, 1),
(18, 2, 14, 5, 1),
(19, 2, 15, 5, 1),
(20, 3, 16, 2, 1),
(21, 3, 17, 2, 1),
(22, 3, 18, 2, 1),
(23, 3, 19, 2, 1),
(24, 3, 16, 5, 1),
(25, 3, 17, 5, 1),
(26, 3, 18, 5, 1),
(27, 3, 19, 5, 1),
(28, 4, 20, 3, 1),
(29, 4, 21, 3, 1),
(30, 4, 22, 3, 1),
(31, 4, 23, 3, 1),
(32, 4, 20, 5, 1),
(33, 4, 21, 5, 1),
(34, 4, 22, 5, 1),
(35, 4, 23, 5, 1),
(36, 5, 24, 4, 1),
(37, 5, 25, 4, 1),
(38, 5, 26, 4, 1),
(39, 5, 27, 4, 1),
(40, 5, 24, 5, 1),
(41, 5, 25, 5, 1),
(42, 5, 26, 5, 1),
(43, 5, 27, 5, 1),
(44, 6, 28, 1, 1),
(45, 6, 29, 1, 1),
(46, 6, 28, 5, 1),
(47, 6, 29, 5, 1),
(48, 7, 30, 2, 1),
(49, 7, 31, 2, 1),
(50, 7, 30, 5, 1),
(51, 7, 31, 5, 1),
(52, 8, 32, 3, 1),
(53, 8, 33, 3, 1),
(54, 8, 32, 5, 1),
(55, 8, 33, 5, 1),
(56, 9, 34, 4, 1),
(57, 9, 35, 4, 1),
(58, 9, 34, 5, 1),
(59, 9, 35, 5, 1),
(60, 6, 10, 1, 1),
(61, 6, 11, 1, 1),
(62, 7, 10, 2, 1),
(63, 7, 11, 2, 1),
(64, 8, 10, 3, 1),
(65, 8, 11, 3, 1),
(66, 9, 10, 4, 1),
(67, 9, 11, 4, 1);

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
  `id_category` int(4) NOT NULL,
  `nama_category` varchar(50) NOT NULL,
  `status_category` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_menu`
--

INSERT INTO `kategori_menu` (`id_category`, `nama_category`, `status_category`) VALUES
(1, 'Konfigurasi', 1),
(2, 'Transaksi PT KCI', 1),
(3, 'Transaksi PT KMP', 1),
(4, 'Transaksi PT KAMI', 1),
(5, 'Transaksi CV KCI', 1),
(6, 'Laporan PT KCI', 1),
(7, 'Laporan PT KMP', 1),
(8, 'Laporan PT KAMI', 1),
(9, 'Laporan CV KCI', 1);

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
(1, 'CV KCI', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(4) NOT NULL,
  `nama_menu` varchar(30) NOT NULL,
  `alamat_menu` varchar(50) NOT NULL,
  `status_menu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `alamat_menu`, `status_menu`) VALUES
(1, 'Halaman Kategori Menu', 'kategori_menu.php', 1),
(2, 'Halaman Menu', 'menu.php', 1),
(3, 'Halaman Akses Menu', 'accessMenu.php', 1),
(4, 'Halaman Akses Level', 'accessLevel.php', 1),
(5, 'Halaman User', 'user.php', 1),
(6, 'Halaman Projek', 'projek.php', 1),
(7, 'Halaman Lokasi', 'lokasi.php', 1),
(8, 'Halaman Stok Barang/BBM', 'stokBarang.php', 1),
(9, 'Halaman Jenis Transaksi', 'jenisTransaksi.php', 1),
(10, 'Data Transaksi', 'dataPengeluaran.php', 1),
(11, 'Data Transaksi Barang/BBM', 'dataTransaksiBarang.php', 1),
(12, 'Transaksi Pengeluaran PT KCI', 'transaksi.php?trx=1&prs=1', 1),
(13, 'Transaksi Pemasukan PT KCI', 'transaksi.php?trx=2&prs=1', 1),
(14, 'Pengeluaran BBM PT KCI', 'transaksiBarang.php?trx=1&prs=1', 1),
(15, 'Pemasukan BBM PT KCI', 'transaksiBarang.php?trx=2&prs=1', 1),
(16, 'Transaksi Pengeluaran PT KMP', 'transaksi.php?trx=1&prs=2', 1),
(17, 'Transaksi Pemasukan PT KMP', 'transaksi.php?trx=2&prs=2', 1),
(18, 'Pengeluaran BBM PT KMP', 'transaksiBarang.php?trx=1&prs=2', 1),
(19, 'Pemasukan BBM PT KMP', 'transaksiBarang.php?trx=2&prs=2', 1),
(20, 'Transaksi Pengeluaran PT KAMI', 'transaksi.php?trx=1&prs=3', 1),
(21, 'Transaksi Pemasukan PT KAMI', 'transaksi.php?trx=2&prs=3', 1),
(22, 'Pengeluaran Barang PT KAMI', 'transaksiBarang.php?trx=1&prs=3', 1),
(23, 'Pemasukan Barang PT KAMI', 'transaksiBarang.php?trx=2&prs=3', 1),
(24, 'Transaksi Pengeluaran CV KCI', 'transaksi.php?trx=1&prs=4', 1),
(25, 'Transaksi Pemasukan CV KCI', 'transaksi.php?trx=2&prs=4', 1),
(26, 'Pengeluaran BBM CV KCI', 'transaksiBarang.php?trx=1&prs=4', 1),
(27, 'Pemasukan BBM CV KCI', 'transaksiBarang.php?trx=2&prs=4', 1),
(28, 'Laporan Transaksi PT KCI', 'laporanPengeluaran.php?prs=1', 1),
(29, 'Laporan BBM PT KCI', 'laporanPengeluaranBarang.php?prs=1', 1),
(30, 'Laporan Transaksi PT KMP', 'laporanPengeluaran.php?prs=2', 1),
(31, 'Laporan BBM PT KMP', 'laporanPengeluaranBarang.php?prs=2', 1),
(32, 'Laporan Transaksi PT KAMI', 'laporanPengeluaran.php?prs=3', 1),
(33, 'Laporan Barang PT KAMI', 'laporanPengeluaranBarang.php?prs=3', 1),
(34, 'Laporan Transaksi CV KCI', 'laporanPengeluaran.php?prs=4', 1),
(35, 'Laporan BBM CV KCI', 'laporanPengeluaranBarang.php?prs=4', 1);

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
(1, 'Non-Projek', 1),
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
(1, 1, 0, '1'),
(2, 2, 0, '1'),
(3, 3, 0, '1'),
(4, 4, 0, '1');

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
(1, 1, 4, 'Bahan Bakar DT', 0, 1),
(2, 1, 4, 'Bahan Bakar AMP', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `alt_id_transaksi` char(20) NOT NULL,
  `fk_id_perusahaan` int(11) NOT NULL,
  `fk_id_saldo` int(11) NOT NULL,
  `fk_id_jenis_transaksi` int(11) NOT NULL,
  `nama_transaksi` varchar(30) NOT NULL,
  `fk_id_projek` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `pemasukan` bigint(20) DEFAULT NULL,
  `pengeluaran` bigint(20) DEFAULT NULL,
  `saldo_before_transaction` bigint(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `keterangan_transaksi` varchar(100) NOT NULL,
  `status_transaksi` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_bbm`
--

CREATE TABLE `transaksi_bbm` (
  `id_transaksi_bbm` int(11) NOT NULL,
  `alt_id_transaksi_bbm` char(20) NOT NULL,
  `fk_id_stock_barang` int(11) NOT NULL,
  `fk_id_lokasi` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `pengeluaran_stock` bigint(20) DEFAULT NULL,
  `pemasukan_stock` bigint(20) DEFAULT NULL,
  `stock_sebelumnya` bigint(20) NOT NULL,
  `status_transaksi` int(1) NOT NULL,
  `keterangan_transaksi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(4, 'adminPTKMP', '202cb962ac59075b964b07152d234b70', 2, 1),
(5, 'adminPTKAMI', '202cb962ac59075b964b07152d234b70', 3, 1);

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
  ADD PRIMARY KEY (`id_access_menu`),
  ADD UNIQUE KEY `fk_id_category` (`fk_id_category`,`fk_id_menu`,`fk_id_al`);

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
  MODIFY `id_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategori_menu`
--
ALTER TABLE `kategori_menu`
  MODIFY `id_category` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
  MODIFY `id_stock_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_bbm`
--
ALTER TABLE `transaksi_bbm`
  MODIFY `id_transaksi_bbm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
