-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 03, 2021 at 01:18 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_data_barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barangkeluar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `kategori` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jumlah_barang` int(11) NOT NULL,
  `harga_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barangkeluar`, `id_barang`, `kategori`, `harga`, `tanggal`, `jumlah_barang`, `harga_total`) VALUES
(96, 43, 6, 4000, '2021-04-24 10:24:04', 8, 20000),
(97, 44, 5, 2000, '2021-04-24 10:32:49', 4, 8000),
(98, 43, 6, 4000, '2021-04-24 10:32:49', 4, 16000),
(99, 45, 6, 2000, '2021-04-24 10:32:49', 4, 8000),
(101, 44, 5, 2000, '2021-04-24 10:37:43', 3, 6000),
(102, 44, 5, 2000, '2021-04-24 10:37:53', 3, 6000),
(103, 44, 5, 2000, '2021-04-25 09:34:29', 2, 4000),
(104, 44, 5, 2000, '2021-05-14 14:51:41', 2, 4000),
(105, 45, 6, 3000, '2021-05-14 14:51:41', 2, 6000),
(106, 45, 6, 3000, '2021-05-26 15:22:44', 2, 6000),
(107, 49, 24, 2000, '2021-05-26 15:22:45', 2, 4000),
(108, 50, 25, 4000, '2021-05-29 06:57:36', 30, 120000),
(109, 49, 24, 2000, '2021-05-29 06:57:36', 2, 4000),
(110, 51, 24, 1000, '2021-05-29 07:13:03', 5, 5000),
(111, 46, 24, 3000, '2021-05-29 07:13:03', 2, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_databarang`
--

CREATE TABLE `tbl_databarang` (
  `id` int(11) NOT NULL,
  `ktbarang` int(11) NOT NULL,
  `nama_barang` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `hargabeli` int(11) NOT NULL,
  `hargajual` int(11) NOT NULL,
  `total_hbeli` int(11) NOT NULL,
  `tanggal_ditambahkan` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_databarang`
--

INSERT INTO `tbl_databarang` (`id`, `ktbarang`, `nama_barang`, `jumlah`, `hargabeli`, `hargajual`, `total_hbeli`, `tanggal_ditambahkan`) VALUES
(43, 6, 'saus', 7, 2000, 4500, 14000, '2021-03-22 07:47:12'),
(44, 5, 'kopi luwak', 5, 1000, 2000, 5000, '2021-03-22 09:10:52'),
(45, 6, 'indomie', 5, 2000, 3000, 14000, '2021-03-22 09:55:40'),
(46, 24, 'chitos', 9, 2000, 3000, 18000, '2021-03-22 10:39:02'),
(47, 5, 'kopi hitam', 6, 1500, 2000, 9000, '2021-03-28 09:56:48'),
(48, 5, 'bembeng', 6, 1000, 1500, 6000, '2021-03-30 06:49:43'),
(49, 24, 'komo', 6, 1600, 2000, 16000, '2021-05-26 15:22:13'),
(51, 24, 'tic tac', 16, 500, 1000, 10500, '2021-05-29 07:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_barang`
--

CREATE TABLE `tbl_kategori_barang` (
  `id` int(11) NOT NULL,
  `kategori_barang` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kategori_barang`
--

INSERT INTO `tbl_kategori_barang` (`id`, `kategori_barang`) VALUES
(5, 'Minuman'),
(6, 'Makanan'),
(24, 'Snack');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sementara`
--

CREATE TABLE `tbl_sementara` (
  `id_simpan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `kategori_produk` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlahbarang` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `image` varchar(35) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(1) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(7, 'admin', 'admin@gmail.com', 'default.jpg', '$2y$10$h4IYSiHK5lCMsjvfCtSMj./qwSN90FAEWF5vyVbFexVgwY72h0squ', 1, 1, '2021-06-03 13:08:36'),
(8, 'kumbang', 'kumbang@gmail.com', 'default.jpg', '$2y$10$cAv3B6d78QYCJp2mVNRrGOq.9T5l9hRFIyDGYYJfCm5kmqk4W8brS', 2, 0, '2021-04-24 11:14:10'),
(12, 'admin2', 'admin2@gmail.com', 'default.jpg', '$2y$10$V.5vfzAz8aQg/YV/UJzPr.cU3Kb8RNunkWkIoa0g8t5lf/EsmyYOW', 1, 1, '2021-04-24 14:43:27'),
(14, 'coba', 'coba@gmail.com', 'default.jpg', '$2y$10$9hRFcmRKkdAacldUrxMvBeUfrziUVyPoCdUKtFKF6xjJh7cbAa8e2', 2, 1, '2021-04-25 09:32:14'),
(15, 'user', 'user@gmail.com', 'default.jpg', '$2y$10$j4g5UokgleDIVB9gjzIj3uO7KSKOWsZNM.Eq/YiZ1Q0ockZYCEu22', 2, 1, '2021-05-29 07:11:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barangkeluar`);

--
-- Indexes for table `tbl_databarang`
--
ALTER TABLE `tbl_databarang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kategori_barang`
--
ALTER TABLE `tbl_kategori_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sementara`
--
ALTER TABLE `tbl_sementara`
  ADD PRIMARY KEY (`id_simpan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_barangkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `tbl_databarang`
--
ALTER TABLE `tbl_databarang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_kategori_barang`
--
ALTER TABLE `tbl_kategori_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_sementara`
--
ALTER TABLE `tbl_sementara`
  MODIFY `id_simpan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
