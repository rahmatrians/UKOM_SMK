-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2019 at 09:01 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prakom_rahmat`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_pengguna`
--

CREATE TABLE `akun_pengguna` (
  `id_akun` char(4) NOT NULL,
  `nm_lengkap` varchar(100) NOT NULL,
  `nm_pengguna` varchar(30) NOT NULL,
  `kata_sandi` varchar(50) NOT NULL,
  `kelamin` char(50) NOT NULL,
  `no_telp` char(15) NOT NULL,
  `alamat` text NOT NULL,
  `id_jab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun_pengguna`
--

INSERT INTO `akun_pengguna` (`id_akun`, `nm_lengkap`, `nm_pengguna`, `kata_sandi`, `kelamin`, `no_telp`, `alamat`, `id_jab`) VALUES
('', 'Rahmat Riansyah', 'rahmatrians', '725c3cc85aabc3b083ce5d4de88c8f9a', 'Laki-laki', '08112467789', 'Pamulang, Tangerang Selatan', 3),
('A001', 'Pengelola Aplikasi', 'pengelola', '3c7913bc17671596a43dcb4581992bdf', 'Laki-laki', '088239101244', 'Pamulang, Tangerang Selatan, Banten', 1),
('A002', 'Manajemen Aplikasi', 'manajemen', '19b51f1cbb6146adcacbce46d5bdc3f2', 'Perempuan', '08212293580', 'Setu, Tangerang Selatan', 2),
('A003', 'Anggota Aplikasi', 'anggota', 'dfb9e85bc0da607ff76e0559c62537e8', 'Laki-laki', '081122779032', 'Pamulang 2, Tangerang selatan', 3);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_brg` char(4) NOT NULL,
  `nm_brg` varchar(225) NOT NULL,
  `kondisi` varchar(100) NOT NULL,
  `sumber_dana` varchar(100) NOT NULL,
  `tgl_beli` date NOT NULL,
  `id_jenis` char(4) NOT NULL,
  `id_dist` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_brg`, `nm_brg`, `kondisi`, `sumber_dana`, `tgl_beli`, `id_jenis`, `id_dist`) VALUES
('B001', ' 							 	Wave Phenom	 				', 'Baik', 'BOS', '2019-01-02', 'J003', 'D001'),
('B002', ' 				Kenmaster Kabel Roll 12 M	', 'Baik', 'Mandiri', '2019-02-13', 'J007', 'D003'),
('B003', ' 				 				Kenmaster Kabel Roll 5M		', 'Baik', 'Mandiri', '2019-01-23', 'J007', 'D002'),
('B004', ' 				Kenmaster Kabel Roll 50M	', 'Baik', 'BOS', '2019-02-01', 'J007', 'D003'),
('B005', ' 				Kenmaster Kabel Roll 6M	', 'Baik', 'Mandiri', '2019-02-04', 'J007', 'D003'),
('B006', 'Samsung LED 24Inc', 'Baik', 'BOS`', '2019-02-03', 'J005', 'D002'),
('B007', 'Samsung LED 32Inc', 'Baik', 'BOS', '2019-02-02', 'J005', 'D002'),
('B008', 'Samsung LED 32Inc', 'Baik', 'BOS', '2019-02-04', 'J005', 'D003'),
('B009', 'INFOCUS 3200 Lumens', 'Baik', 'BOS', '2019-02-11', 'J006', 'D003'),
('B010', 'INFOCUS 3500 Lumens', 'Baik', 'BOS', '2019-02-03', 'J006', 'D002'),
('B011', ' 			INFOCUS 3600 Lumens		', 'Baik', 'BOS', '2019-02-05', 'J006', 'D003'),
('B012', 'MVP', 'Baik', 'Mandiri', '2019-02-03', 'J003', 'D001'),
('B013', 'FIBA 3X3', 'Baik', 'BOS', '2019-02-03', 'J003', 'D004'),
('B014', ' 			ALLSTAR MAXMUM		', 'Baik', 'Mandiri', '2019-02-02', 'J003', 'D001'),
('B015', 'Nike MENOR X RED', 'Baik', 'BOS', '2019-02-04', 'J002', 'D004'),
('B016', ' 			Nike MENOR X BLUE		', 'Baik', 'Mandiri', '2019-02-03', 'J002', 'D001'),
('B017', 'Beach BV 5000', 'Baik', 'Mandiri', '2019-02-01', 'J004', 'D004'),
('B018', 'V5M4500', 'Baik', 'BOS', '2019-02-04', 'J004', 'D001'),
('B019', ' 			V5M5000		', 'Baik', 'BOS', '2019-02-02', 'J004', 'D004'),
('B020', 'HP ProBook 430', 'Baik', 'BOS', '2019-02-04', 'J001', 'D003'),
('B021', 'HP EliteBook 840 G5', 'Baik', 'Mandiri', '2019-02-04', 'J001', 'D002'),
('B022', ' 		ASUS X441BA			', 'Baik', 'BOS', '2019-02-03', 'J001', 'D002'),
('B023', ' 					ASUS X55QA', 'Baik', 'BOS', '2019-02-05', 'J001', 'D002'),
('B024', 'XIAOMI Mi Notebook Air 13.3Inc', 'Baik', 'BOS', '2019-02-03', 'J001', 'D002'),
('B025', 'XIAOMI Mi Notebook Ruby', 'Baik', 'Mandiri', '2019-02-08', 'J001', 'D002'),
('B026', ' 				 				 				 				 	APPLE MacBook Air MD711ZA								', 'Baik', 'BOS', '2019-02-05', 'J001', 'D002'),
('B027', ' 				 			ASUS X441BA			', 'Baik', 'Mandiri', '2019-01-02', 'J001', 'D003');

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

CREATE TABLE `distributor` (
  `id_dist` char(4) NOT NULL,
  `nm_dist` varchar(100) NOT NULL,
  `telp_dist` char(15) NOT NULL,
  `almt_dist` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distributor`
--

INSERT INTO `distributor` (`id_dist`, `nm_dist`, `telp_dist`, `almt_dist`) VALUES
('D001', 'Azy Sport', '082110281639', 'Viktor, Tangerang Selatan'),
('D002', 'POINT Computer', '02110293348', 'Pamulang, Tangerang Selatan'),
('D003', 'Surya Mas Computer', '088233456877', 'Pamulang, Tangerang Selatan'),
('D004', 'Rians Sport', '088129874490', '			 							 							 				Pamulang, Tangerang Selatan			 				 				\r\n 			 			 			 			'),
('D005', 'Raja Computer', '0219954332', '			 				Jakarta Pusat, DKI Jakart 				 			 			');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jab` int(11) NOT NULL,
  `nm_jab` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jab`, `nm_jab`) VALUES
(1, 'Pengelola'),
(2, 'Manajemen'),
(3, 'Anggota');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` char(4) NOT NULL,
  `nm_jenis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nm_jenis`) VALUES
('J001', 'Laptop'),
('J002', 'Bola Sepak'),
('J003', 'Bola Basket'),
('J004', 'Bola Voli'),
('J005', 'Monitor'),
('J006', 'Proyektor'),
('J007', 'Kabel Roll');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` char(4) NOT NULL,
  `id_akun` char(4) NOT NULL,
  `id_brg` char(4) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `id_akun`, `id_brg`, `tgl_masuk`, `tgl_kembali`, `status`) VALUES
('P001', 'A003', 'B001', '2019-02-06', '2019-02-06', '2'),
('P002', 'A003', 'B001', '2019-02-06', '2019-02-06', '2'),
('P003', 'A003', 'B001', '2019-02-06', '2019-02-07', '2'),
('P004', '', 'B020', '2019-02-07', '2019-02-07', '2'),
('P005', '', 'B002', '2019-02-07', '2019-02-07', '2'),
('P006', '', 'B004', '2019-02-07', '2019-02-07', '2'),
('P007', '', 'B026', '2019-02-07', '0000-00-00', '0'),
('P008', '', 'B022', '2019-02-07', '0000-00-00', '0'),
('P009', 'A003', 'B025', '2019-02-07', '0000-00-00', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_pengguna`
--
ALTER TABLE `akun_pengguna`
  ADD PRIMARY KEY (`id_akun`),
  ADD KEY `id_jab` (`id_jab`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_brg`),
  ADD KEY `id_dist` (`id_dist`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`id_dist`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jab`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_brg` (`id_brg`),
  ADD KEY `id_akun` (`id_akun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun_pengguna`
--
ALTER TABLE `akun_pengguna`
  ADD CONSTRAINT `akun_pengguna_ibfk_1` FOREIGN KEY (`id_jab`) REFERENCES `jabatan` (`id_jab`);

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`),
  ADD CONSTRAINT `barang_ibfk_3` FOREIGN KEY (`id_dist`) REFERENCES `distributor` (`id_dist`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_brg`) REFERENCES `barang` (`id_brg`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_akun`) REFERENCES `akun_pengguna` (`id_akun`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
