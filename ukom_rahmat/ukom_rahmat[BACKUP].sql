-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2019 at 02:41 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

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
('A001', 'Santang Argagiri', 'pengelola', '3c7913bc17671596a43dcb4581992bdf', 'Laki-laki', '088239101244', 'Pamulang, Tangerang Selatan, Banten', 1),
('A002', 'Andrie Rizki', 'manajemen', '19b51f1cbb6146adcacbce46d5bdc3f2', 'Laki-laki', '08212293580', 'Setu, Tangerang Selatan', 2),
('A003', 'Anggota Aplikasi', 'anggota', 'dfb9e85bc0da607ff76e0559c62537e8', 'Laki-laki', '081122779032', 'Pamulang 2, Tangerang selatan', 3),
('A004', 'Rahmat Riansyah', 'rahmatrians', '725c3cc85aabc3b083ce5d4de88c8f9a', 'Laki-laki', '08112467789', 'Pamulang, Tangerang Selatan', 3);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_brg` char(4) NOT NULL,
  `nm_brg` varchar(225) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `kondisi` varchar(100) NOT NULL,
  `sumber_dana` varchar(100) NOT NULL,
  `tgl_beli` date NOT NULL,
  `id_jenis` char(4) NOT NULL,
  `id_dist` char(4) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_brg`, `nm_brg`, `harga_beli`, `kondisi`, `sumber_dana`, `tgl_beli`, `id_jenis`, `id_dist`, `gambar`) VALUES
('B001', ' 							 	Wave Phenom	 				', 0, 'Baik', 'BOS', '2019-01-02', 'J003', 'D001', ''),
('B002', ' 				Kenmaster Kabel Roll 12 M	', 0, 'Baik', 'Mandiri', '2019-02-13', 'J007', 'D003', ''),
('B003', ' 				 				Kenmaster Kabel Roll 5M		', 0, 'Baik', 'Mandiri', '2019-01-23', 'J007', 'D002', ''),
('B004', ' 				Kenmaster Kabel Roll 50M	', 0, 'Baik', 'BOS', '2019-02-01', 'J007', 'D003', ''),
('B005', ' 				Kenmaster Kabel Roll 6M	', 0, 'Baik', 'Mandiri', '2019-02-04', 'J007', 'D003', ''),
('B006', 'Samsung LED 24Inc', 0, 'Baik', 'BOS`', '2019-02-03', 'J005', 'D002', ''),
('B007', 'Samsung LED 32Inc', 0, 'Baik', 'BOS', '2019-02-02', 'J005', 'D002', ''),
('B009', 'INFOCUS 3200 Lumens', 0, 'Baik', 'BOS', '2019-02-11', 'J006', 'D003', ''),
('B010', 'INFOCUS 3500 Lumens', 0, 'Baik', 'BOS', '2019-02-03', 'J006', 'D002', ''),
('B011', ' 			INFOCUS 3600 Lumens		', 0, 'Baik', 'BOS', '2019-02-05', 'J006', 'D003', ''),
('B012', 'MVP', 0, 'Rusak', 'Mandiri', '2019-02-03', 'J003', 'D001', ''),
('B013', 'FIBA 3X3', 0, 'Baik', 'BOS', '2019-02-03', 'J003', 'D004', ''),
('B014', ' 			ALLSTAR MAXMUM		', 0, 'Baik', 'Mandiri', '2019-02-02', 'J003', 'D001', ''),
('B015', 'Nike MENOR X RED', 0, 'Baik', 'BOS', '2019-02-04', 'J002', 'D004', ''),
('B016', ' 			Nike MENOR X BLUE		', 0, 'Baik', 'Mandiri', '2019-02-03', 'J002', 'D001', ''),
('B017', 'Beach BV 5000', 0, 'Baik', 'Mandiri', '2019-02-01', 'J004', 'D004', ''),
('B018', 'V5M4500', 0, 'Baik', 'BOS', '2019-02-04', 'J004', 'D001', ''),
('B019', ' 			V5M5000		', 0, 'Baik', 'BOS', '2019-02-02', 'J004', 'D004', ''),
('B020', 'HP ProBook 430', 0, 'Rusak', 'BOS', '2019-02-04', 'J001', 'D003', ''),
('B021', 'HP EliteBook 840 G5', 0, 'Hilang', 'Mandiri', '2019-02-04', 'J001', 'D002', ''),
('B022', 'ASUS X441BA', 0, 'Rusak', 'BOS', '2019-02-03', 'J001', 'D002', '1552890416.png'),
('B023', 'ASUS X55QA', 0, 'Baik', 'BOS', '2019-02-05', 'J001', 'D002', ''),
('B024', 'XIAOMI Mi Notebook Air 13.3Inc', 11500000, 'Rusak', 'BOS', '2019-02-03', 'J001', 'D002', '1552890493.png'),
('B025', 'XIAOMI Mi Notebook Ruby', 0, 'Baik', 'Mandiri', '2019-02-08', 'J001', 'D002', '1552890449.png'),
('B026', 'APPLE MacBook Air MD711ZA				', 24000000, 'Baik', 'BOS', '2019-02-05', 'J001', 'D002', '1552890386.png'),
('B027', 'ASUS X441BA', 5300000, 'Baik', 'Mandiri', '2019-01-02', 'J001', 'D003', '1552890281.png');

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
('P001', 'A004', 'B007', '2019-03-06', '2019-03-06', '2'),
('P002', 'A003', 'B007', '2019-03-09', '2019-03-09', '2'),
('P003', 'A003', 'B006', '2019-03-07', '2019-03-09', '2'),
('P005', 'A003', 'B022', '2019-03-08', '2019-03-09', '2'),
('P006', 'A003', 'B020', '2019-03-08', '2019-03-10', '2'),
('P007', 'A003', 'B012', '2019-03-09', '2019-03-10', '2'),
('P008', 'A003', 'B001', '2019-03-03', '2019-03-10', '2'),
('P009', 'A004', 'B022', '2019-03-20', '2019-03-20', '2'),
('P010', 'A004', 'B021', '2019-03-20', '2019-03-20', '2'),
('P011', 'A004', 'B025', '2019-03-20', '2019-03-23', '2'),
('P012', 'A004', 'B027', '2019-03-23', '2019-03-23', '2'),
('P013', 'A004', 'B025', '2019-03-23', '2019-03-29', '2'),
('P014', 'A004', 'B026', '2019-03-27', '0000-00-00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riw` int(11) NOT NULL,
  `nm_riw` char(4) NOT NULL,
  `akun_riw` char(4) NOT NULL,
  `tgl_riw` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riw`);

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
