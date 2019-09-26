-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2019 at 07:00 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris_smk`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id_admin` int(10) NOT NULL,
  `inventarisir` varchar(100) NOT NULL,
  `peminjaman` varchar(100) NOT NULL,
  `pengembalian` varchar(100) NOT NULL,
  `generate_laporan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id_admin`, `inventarisir`, `peminjaman`, `pengembalian`, `generate_laporan`) VALUES
(1, 'bangku', 'peminjaman 2 bangku oleh XI RPL 2', 'belum kembali', 'harus dikembalikan tanggal 12 desember 2019'),
(2, 'spidol', 'peminjaman 1 spidol oleh XII PM 1', 'sudah dikembalikan', 'sudah dikembalikan tanggal 10 november 2019'),
(3, 'sapu dan spidol', 'meminjam 1 sapu dan 2 spidol oleh XII TKJ 1', 'belum dikembalikan', 'harus dikembalikan pada tanggal 07 Agustus 2019'),
(4, '', 'meminjam foto pahlawan ', 'belum dikembalikan', 'harus dikembalikan akhir tahun 2020'),
(5, '', 'meminjam hiasan dinding ', 'belum dikembalikan', 'harus dikembalikan akhir tahun 2020'),
(6, 'Hiasan dinding', 'meminjam hiasan dinding ', 'belum dikembalikan', 'harus dikembalikan akhir tahun 2020'),
(7, 'koran', 'meminjam koran ', 'sudah dikembalikan', '-'),
(8, 'sapu ijuk', 'meminjam sapu ijuk ', 'sudah dikembalikan', '-'),
(9, 'sapu ijuk dan sapu bulu', 'meminjam sapu ijuk ', 'sudah dikembalikan', '-');

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id_operator` int(100) NOT NULL,
  `peminjaman` varchar(100) NOT NULL,
  `pengembalian` varchar(100) NOT NULL,
  `id_administrator` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id_operator`, `peminjaman`, `pengembalian`, `id_administrator`) VALUES
(1, '1 lap kanebo', 'tanggal 2 desember 2019', 0),
(2, '1 meja guru', '-', 0);

-- --------------------------------------------------------

--
-- Table structure for table `peminjam`
--

CREATE TABLE `peminjam` (
  `id_peminjam` int(100) NOT NULL,
  `meminjam` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjam`
--

INSERT INTO `peminjam` (`id_peminjam`, `meminjam`) VALUES
(1, '1 kursi dan 2 bangku'),
(2, '1 vas bunga');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id_operator`);

--
-- Indexes for table `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`id_peminjam`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `id_operator` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `peminjam`
--
ALTER TABLE `peminjam`
  MODIFY `id_peminjam` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
