-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2019 at 10:46 AM
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
-- Database: `pisma`
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun_pengguna`
--

INSERT INTO `akun_pengguna` (`id_akun`, `nm_lengkap`, `nm_pengguna`, `kata_sandi`, `kelamin`, `no_telp`, `alamat`, `id_jab`) VALUES
('A001', 'Santang Argagiri', 'pengelola', '3c7913bc17671596a43dcb4581992bdf', 'Laki-laki', '088239101244', 'Pamulang, Tangerang Selatan, Banten', 1),
('A002', 'Andrie Rizki', 'manajemen', '19b51f1cbb6146adcacbce46d5bdc3f2', 'Laki-laki', '08212293580', 'Setu, Tangerang Selatan', 2),
('A003', 'Rizkya Rubby', 'anggota', 'dfb9e85bc0da607ff76e0559c62537e8', 'Laki-laki', '081122779032', 'Pamulang 2, Tangerang selatan', 3),
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_brg`, `nm_brg`, `harga_beli`, `kondisi`, `sumber_dana`, `tgl_beli`, `id_jenis`, `id_dist`, `gambar`) VALUES
('B002', 'Kenmaster Kabel Roll 12 M', 250000, 'Baik', 'Mandiri', '2019-02-13', 'J007', 'D003', '1554168140.png'),
('B003', ' 				 				Kenmaster Kabel Roll 5M		', 150000, 'Baik', 'Mandiri', '2019-01-23', 'J007', 'D002', '1554167750.png'),
('B004', 'Kenmaster Kabel Roll 50M', 100000, 'Baik', 'BOS', '2019-02-01', 'J007', 'D003', '1554167789.png'),
('B005', 'Kenmaster Kabel Roll 6M', 70000, 'Baik', 'Mandiri', '2019-02-04', 'J007', 'D003', '1554167854.png'),
('B006', 'Samsung LED 24Inc', 2000000, 'Baik', 'BOS', '2019-02-03', 'J005', 'D002', '1554167917.png'),
('B007', 'Samsung LED 32Inc', 2500000, 'Baik', 'BOS', '2019-02-02', 'J005', 'D002', '1554167956.png'),
('B009', 'INFOCUS 3200 Lumens', 6000000, 'Baik', 'BOS', '2019-02-11', 'J006', 'D003', '1554167991.png'),
('B010', 'INFOCUS 3500 Lumens', 4000000, 'Baik', 'BOS', '2019-02-03', 'J006', 'D002', '1554168051.png'),
('B011', 'INFOCUS 3600 Lumens', 8000000, 'Baik', 'BOS', '2019-02-05', 'J006', 'D003', '1554168075.png'),
('B035', 'MOLTEN GR3', 520000, 'Baik', 'BOS', '2019-03-29', 'J003', 'D004', '1554169364.png'),
('B013', 'FIBA 3X3', 470000, 'Baik', 'BOS', '2019-02-03', 'J003', 'D004', '1554168109.png'),
('B014', 'ALLSTAR MAXMUM', 0, 'Baik', 'Mandiri', '2019-02-02', 'J003', 'D001', '1554085955.png'),
('B015', 'Nike MENOR X RED', 850000, 'Baik', 'BOS', '2019-02-04', 'J002', 'D004', '1554085650.png'),
('B016', 'Nike MENOR X BLUE', 0, 'Baik', 'Mandiri', '2019-02-03', 'J002', 'D001', '1554085430.png'),
('B017', 'Beach BV 5000', 600000, 'Baik', 'Mandiri', '2019-02-01', 'J004', 'D004', '1554085288.png'),
('B019', 'V5M5000', 440000, 'Baik', 'BOS', '2019-02-02', 'J004', 'D004', '1554083936.png'),
('B020', 'HP ProBook 430', 6000000, 'Baik', 'BOS', '2019-02-04', 'J001', 'D003', '1554083624.png'),
('B021', 'HP EliteBook 840 G5', 3500000, 'Baik', 'Mandiri', '2019-02-04', 'J001', 'D002', '1554083556.png'),
('B022', 'ASUS X441BA', 6700000, 'Baik', 'BOS', '2019-02-03', 'J001', 'D002', '1552890416.png'),
('B023', 'ASUS X55QA', 7500000, 'Rusak', 'BOS', '2019-02-05', 'J001', 'D002', '1554083584.png'),
('B046', 'LENOVO THINKPAD', 4200000, 'Baik', 'bos', '2019-04-17', 'J001', 'D005', '1554384050.png'),
('B025', 'XIAOMI Mi Notebook Ruby', 13000000, 'Hilang', 'Mandiri', '2019-02-08', 'J001', 'D002', '1552890449.png'),
('B026', 'APPLE MacBook Air MD711ZA', 24000000, 'Baik', 'BOS', '2019-02-05', 'J001', 'D002', '1552890386.png'),
('B027', 'ASUS X441BA', 5300000, 'Baik', 'Mandiri', '2019-01-02', 'J001', 'D003', '1552890281.png'),
('B028', 'MOLTEN FUTSAL YELLOW', 500000, 'Baik', 'Mandiri', '2019-03-14', 'J002', 'D004', '1554168685.png'),
('B029', 'MITRE RESPOND', 370000, 'Baik', 'BOS', '2019-03-14', 'J002', 'D004', '1554168758.png'),
('B030', 'DELL 20Inc', 2400000, 'Baik', 'BOS', '2019-03-27', 'J005', 'D005', '1554168885.png'),
('B031', 'ACER 24Inc', 3200000, 'Baik', 'Mandiri', '2019-03-28', 'J005', 'D003', '1554168930.png'),
('B032', 'LENOVO 25Inc', 3700000, 'Baik', 'Mandiri', '2019-03-23', 'J005', 'D003', '1554169004.png'),
('B033', 'EPSON 3000 Lumens', 4500000, 'Baik', 'Mandiri', '2019-03-26', 'J006', 'D002', '1554169117.png'),
('B034', 'VIEWSONIC 2400 Lumens', 2300000, 'Baik', 'BOS', '2019-03-31', 'J006', 'D005', '1554169183.png'),
('B036', 'MOTLEN GR5', 670000, 'Baik', 'Mandiri', '2019-03-31', 'J003', 'D004', '1554169409.png'),
('B037', 'ELITE BASKET', 480000, 'Baik', 'BOS', '2019-03-20', 'J003', 'D004', '1554169513.png'),
('B038', 'UTICON Kabel Roll 10M', 89000, 'Baik', 'Mandiri', '2019-03-20', 'J007', 'D005', '1554169756.png'),
('B039', 'Kenmaster Kabel Roll 10M', 93000, 'Baik', 'Mandiri', '2019-03-22', 'J007', 'D003', '1554169845.png'),
('B040', 'MIKASA MV Gold', 120000, 'Baik', 'BOS', '2019-03-15', 'J004', 'D004', '1554169952.png'),
('B041', 'PROTEAM GREEN', 170000, 'Baik', 'BOS', '2019-03-21', 'J004', 'D004', '1554170305.png'),
('B042', 'PROTEAM YELLOW', 150000, 'Baik', 'Mandiri', '2019-03-27', 'J004', 'D004', '1554170358.png'),
('B043', 'MIKASA MVA', 130000, 'Baik', 'Mandiri', '2019-03-11', 'J004', 'D004', '1554170440.png'),
('B044', 'MOLTEN FG1500', 186000, 'Baik', 'BOS', '2019-03-13', 'J002', 'D004', '1554170538.png'),
('B045', 'MOLTEN FG2650', 178000, 'Baik', 'Mandiri', '2019-03-20', 'J002', 'D004', '1554170607.png'),
('B047', 'ACER 3000 Lumen', 3100000, 'Baik', 'BOS', '2019-03-23', 'J006', 'D005', '1554170755.png'),
('B048', 'SONY MINI 2000 Lumen', 2100000, 'Baik', 'BOS', '2019-04-18', 'J006', 'D002', '1554170810.png'),
('B049', 'AOC LED E2270', 3200000, 'Baik', 'Mandiri', '2019-03-20', 'J005', 'D003', '1554170907.png'),
('B050', 'ASUS LED VN247H', 4000000, 'Baik', 'BOS', '2019-03-26', 'J005', 'D005', '1554170974.png'),
('B051', 'AOC LCD 24Inc', 3400000, 'Baik', 'Mandiri', '2019-03-11', 'J005', 'D003', '1554171053.png'),
('B052', 'Kenmaster Kabel Roll 12M', 70000, 'Baik', 'BOS', '2019-03-20', 'J007', 'D003', '1554171383.png'),
('B053', 'KRISBOW Kabel Roll 10M', 150000, 'Baik', 'Mandiri', '2019-03-21', 'J007', 'D002', '1554171467.png'),
('B054', 'MOLTEN DARK GOLD', 87000, 'Baik', 'BOS', '2019-03-15', 'J002', 'D004', '1554171575.png'),
('B055', 'MOLTEN 4500', 92000, 'Baik', 'Mandiri', '2019-03-20', 'J002', 'D004', '1554171662.png'),
('B012', 'MV 2000', 76000, 'Baik', 'BOS', '2019-02-20', 'J007', 'D002', '1554179532.png'),
('B001', 'BEACH VOLI', 100000, 'Baik', 'BOS', '2019-02-10', 'J004', 'D004', '1554179884.png');

--
-- Triggers `barang`
--
DELIMITER $$
CREATE TRIGGER `hapus_brg` BEFORE DELETE ON `barang` FOR EACH ROW INSERT INTO riwayat VALUES(NULL, "Barang baru dihapuskan", now(), old.id_brg)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_brg` AFTER INSERT ON `barang` FOR EACH ROW INSERT INTO riwayat VALUES(NULL, "Barang baru ditambahkan", now(), new.id_brg)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ubah_brg` AFTER UPDATE ON `barang` FOR EACH ROW INSERT INTO riwayat VALUES(null, "Barang baru diubah", now(), new.id_brg)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

CREATE TABLE `distributor` (
  `id_dist` char(4) NOT NULL,
  `nm_dist` varchar(100) NOT NULL,
  `telp_dist` char(15) NOT NULL,
  `almt_dist` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distributor`
--

INSERT INTO `distributor` (`id_dist`, `nm_dist`, `telp_dist`, `almt_dist`) VALUES
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
('P017', 'A004', 'B017', '2019-03-30', '2019-03-31', '2'),
('P015', 'A004', 'B023', '2019-03-29', '2019-04-01', '2'),
('P016', 'A003', 'B025', '2019-03-29', '2019-03-30', '2'),
('P018', 'A003', 'B025', '2019-04-01', '2019-04-01', '2'),
('P019', 'A004', 'B006', '2019-04-01', '2019-04-01', '2'),
('P020', 'A003', 'B015', '2019-04-01', '2019-04-01', '2'),
('P021', 'A003', 'B007', '2019-04-02', '2019-04-02', '2'),
('P022', 'A003', 'B042', '2019-04-02', '2019-04-02', '2'),
('P023', 'A003', 'B046', '2019-04-02', '2019-04-02', '4'),
('P024', 'A004', 'B025', '2019-04-03', '2019-04-03', '2'),
('P025', 'A004', 'B006', '2019-04-04', '2019-04-04', '2');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_brg` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`id_riwayat`, `keterangan`, `tanggal`, `id_brg`) VALUES
(4, 'Barang baru dihapus', '2019-03-29 17:50:44', 'B028'),
(3, 'Barang baru ditambahkan', '2019-03-29 17:33:26', 'B030'),
(5, 'Barang baru diubah', '2019-03-29 17:54:17', 'B030'),
(6, 'Barang baru diubah', '2019-03-29 23:11:43', 'B030'),
(7, 'Barang baru diubah', '2019-03-29 23:11:53', 'B030'),
(8, 'Barang baru diubah', '2019-03-30 11:01:56', 'B025'),
(9, 'Barang baru diubah', '2019-03-31 22:30:04', 'B017'),
(10, 'Barang baru diubah', '2019-04-01 07:19:57', 'B023'),
(11, 'Barang baru diubah', '2019-04-01 08:30:14', 'B006'),
(12, 'Barang baru diubah', '2019-04-01 08:45:34', 'B025'),
(13, 'Barang baru dihapuskan', '2019-04-01 08:29:18', 'B030'),
(14, 'Barang baru diubah', '2019-04-01 08:30:39', 'B025'),
(15, 'Barang baru diubah', '2019-04-01 08:52:37', 'B021'),
(16, 'Barang baru diubah', '2019-04-01 08:53:06', 'B023'),
(17, 'Barang baru diubah', '2019-04-01 08:53:46', 'B020'),
(18, 'Barang baru diubah', '2019-04-01 08:59:06', 'B019'),
(19, 'Barang baru diubah', '2019-04-01 09:20:20', 'B018'),
(20, 'Barang baru diubah', '2019-04-01 09:21:29', 'B017'),
(21, 'Barang baru diubah', '2019-04-01 09:23:51', 'B016'),
(22, 'Barang baru diubah', '2019-04-01 09:27:32', 'B015'),
(23, 'Barang baru diubah', '2019-04-01 09:32:37', 'B014'),
(24, 'Barang baru diubah', '2019-04-01 11:42:48', 'B015'),
(25, 'Barang baru ditambahkan', '2019-04-01 13:38:28', 'B028'),
(26, 'Barang baru dihapuskan', '2019-04-01 13:47:16', 'B028'),
(27, 'Barang baru diubah', '2019-04-01 18:45:02', 'B012'),
(28, 'Barang baru diubah', '2019-04-01 18:45:03', 'B006'),
(29, 'Barang baru diubah', '2019-04-01 18:46:26', 'B022'),
(30, 'Barang baru diubah', '2019-04-01 18:46:37', 'B021'),
(31, 'Barang baru diubah', '2019-04-01 18:50:14', 'B012'),
(32, 'Barang baru diubah', '2019-04-01 18:50:28', 'B012'),
(33, 'Barang baru diubah', '2019-04-01 18:50:28', 'B012'),
(34, 'Barang baru diubah', '2019-04-01 18:50:29', 'B012'),
(35, 'Barang baru diubah', '2019-04-01 18:50:53', 'B012'),
(36, 'Barang baru diubah', '2019-04-01 18:50:54', 'B006'),
(37, 'Barang baru diubah', '2019-04-01 18:50:55', 'B006'),
(38, 'Barang baru diubah', '2019-04-01 18:51:54', 'B006'),
(39, 'Barang baru diubah', '2019-04-01 18:52:00', 'B017'),
(40, 'Barang baru diubah', '2019-04-01 18:53:09', 'B017'),
(41, 'Barang baru diubah', '2019-04-01 18:53:11', 'B006'),
(42, 'Barang baru diubah', '2019-04-01 18:54:25', 'B006'),
(43, 'Barang baru diubah', '2019-04-01 18:54:27', 'B006'),
(44, 'Barang baru diubah', '2019-04-01 18:54:28', 'B006'),
(45, 'Barang baru diubah', '2019-04-01 18:55:39', 'B017'),
(46, 'Barang baru diubah', '2019-04-01 18:55:49', 'B017'),
(47, 'Barang baru diubah', '2019-04-01 18:55:50', 'B006'),
(48, 'Barang baru diubah', '2019-04-01 18:57:13', 'B006'),
(49, 'Barang baru diubah', '2019-04-01 18:57:34', 'B006'),
(50, 'Barang baru diubah', '2019-04-01 18:57:35', 'B006'),
(51, 'Barang baru diubah', '2019-04-01 18:57:43', 'B006'),
(52, 'Barang baru diubah', '2019-04-01 18:58:37', 'B006'),
(53, 'Barang baru diubah', '2019-04-01 18:58:40', 'B006'),
(54, 'Barang baru diubah', '2019-04-01 18:58:43', 'B006'),
(55, 'Barang baru diubah', '2019-04-01 18:58:44', 'B006'),
(56, 'Barang baru diubah', '2019-04-01 19:00:42', 'B006'),
(57, 'Barang baru diubah', '2019-04-01 19:01:04', 'B006'),
(58, 'Barang baru diubah', '2019-04-01 19:01:14', 'B006'),
(59, 'Barang baru diubah', '2019-04-01 19:02:11', 'B006'),
(60, 'Barang baru diubah', '2019-04-01 19:02:33', 'B012'),
(61, 'Barang baru diubah', '2019-04-01 19:02:36', 'B017'),
(62, 'Barang baru diubah', '2019-04-01 19:02:51', 'B017'),
(63, 'Barang baru diubah', '2019-04-01 19:02:59', 'B017'),
(64, 'Barang baru diubah', '2019-04-01 19:03:04', 'B017'),
(65, 'Barang baru diubah', '2019-04-01 19:03:17', 'B017'),
(66, 'Barang baru dihapuskan', '2019-04-02 03:05:16', 'B018'),
(67, 'Barang baru diubah', '2019-04-02 03:24:41', 'B026'),
(68, 'Barang baru diubah', '2019-04-02 08:16:02', 'B003'),
(69, 'Barang baru diubah', '2019-04-02 08:16:31', 'B004'),
(70, 'Barang baru diubah', '2019-04-02 08:16:44', 'B004'),
(71, 'Barang baru diubah', '2019-04-02 08:17:36', 'B005'),
(72, 'Barang baru diubah', '2019-04-02 08:18:55', 'B006'),
(73, 'Barang baru diubah', '2019-04-02 08:19:27', 'B007'),
(74, 'Barang baru diubah', '2019-04-02 08:19:58', 'B009'),
(75, 'Barang baru diubah', '2019-04-02 08:20:56', 'B010'),
(76, 'Barang baru diubah', '2019-04-02 08:21:17', 'B011'),
(77, 'Barang baru diubah', '2019-04-02 08:21:50', 'B013'),
(78, 'Barang baru diubah', '2019-04-02 08:22:32', 'B002'),
(79, 'Barang baru diubah', '2019-04-02 08:22:46', 'B005'),
(80, 'Barang baru diubah', '2019-04-02 08:22:56', 'B017'),
(81, 'Barang baru diubah', '2019-04-02 08:23:04', 'B020'),
(82, 'Barang baru diubah', '2019-04-02 08:23:12', 'B021'),
(83, 'Barang baru diubah', '2019-04-02 08:23:21', 'B023'),
(84, 'Barang baru diubah', '2019-04-02 08:23:54', 'B022'),
(85, 'Barang baru diubah', '2019-04-02 08:24:12', 'B011'),
(86, 'Barang baru diubah', '2019-04-02 08:24:24', 'B013'),
(87, 'Barang baru diubah', '2019-04-02 08:24:41', 'B015'),
(88, 'Barang baru diubah', '2019-04-02 08:26:17', 'B015'),
(89, 'Barang baru ditambahkan', '2019-04-02 08:32:12', 'B028'),
(90, 'Barang baru ditambahkan', '2019-04-02 08:33:10', 'B029'),
(91, 'Barang baru diubah', '2019-04-02 08:33:47', 'B029'),
(92, 'Barang baru ditambahkan', '2019-04-02 08:35:17', 'B030'),
(93, 'Barang baru ditambahkan', '2019-04-02 08:36:00', 'B031'),
(94, 'Barang baru ditambahkan', '2019-04-02 08:37:28', 'B032'),
(95, 'Barang baru ditambahkan', '2019-04-02 08:39:19', 'B033'),
(96, 'Barang baru ditambahkan', '2019-04-02 08:40:24', 'B034'),
(97, 'Barang baru dihapuskan', '2019-04-02 08:42:26', 'B001'),
(98, 'Barang baru dihapuskan', '2019-04-02 08:42:26', 'B012'),
(99, 'Barang baru ditambahkan', '2019-04-02 08:43:14', 'B035'),
(100, 'Barang baru ditambahkan', '2019-04-02 08:43:58', 'B036'),
(101, 'Barang baru ditambahkan', '2019-04-02 08:45:46', 'B037'),
(102, 'Barang baru diubah', '2019-04-02 08:46:21', 'B036'),
(103, 'Barang baru ditambahkan', '2019-04-02 08:50:32', 'B038'),
(104, 'Barang baru ditambahkan', '2019-04-02 08:51:27', 'B039'),
(105, 'Barang baru ditambahkan', '2019-04-02 08:53:02', 'B040'),
(106, 'Barang baru ditambahkan', '2019-04-02 08:59:00', 'B041'),
(107, 'Barang baru ditambahkan', '2019-04-02 08:59:51', 'B042'),
(108, 'Barang baru ditambahkan', '2019-04-02 09:01:34', 'B043'),
(109, 'Barang baru ditambahkan', '2019-04-02 09:02:49', 'B044'),
(110, 'Barang baru ditambahkan', '2019-04-02 09:04:08', 'B045'),
(111, 'Barang baru ditambahkan', '2019-04-02 09:05:40', 'B046'),
(112, 'Barang baru ditambahkan', '2019-04-02 09:06:33', 'B047'),
(113, 'Barang baru ditambahkan', '2019-04-02 09:07:32', 'B048'),
(114, 'Barang baru ditambahkan', '2019-04-02 09:09:00', 'B049'),
(115, 'Barang baru ditambahkan', '2019-04-02 09:10:11', 'B050'),
(116, 'Barang baru ditambahkan', '2019-04-02 09:11:23', 'B051'),
(117, 'Barang baru ditambahkan', '2019-04-02 09:17:25', 'B052'),
(118, 'Barang baru ditambahkan', '2019-04-02 09:18:35', 'B053'),
(119, 'Barang baru ditambahkan', '2019-04-02 09:20:27', 'B054'),
(120, 'Barang baru ditambahkan', '2019-04-02 09:21:46', 'B055'),
(121, 'Barang baru diubah', '2019-04-02 09:47:04', 'B025'),
(122, 'Barang baru ditambahkan', '2019-04-02 11:29:25', 'B012'),
(123, 'Barang baru diubah', '2019-04-02 11:32:31', 'B012'),
(124, 'Barang baru ditambahkan', '2019-04-02 11:37:20', 'B001'),
(125, 'Barang baru diubah', '2019-04-02 11:39:34', 'B001'),
(126, 'Barang baru diubah', '2019-04-02 11:50:08', 'B007'),
(127, 'Barang baru diubah', '2019-04-02 14:15:22', 'B025'),
(128, 'Barang baru diubah', '2019-04-02 14:18:30', 'B042'),
(129, 'Barang baru diubah', '2019-04-02 14:18:56', 'B042'),
(130, 'Barang baru diubah', '2019-04-02 14:19:04', 'B012'),
(131, 'Barang baru diubah', '2019-04-02 14:21:41', 'B012'),
(132, 'Barang baru diubah', '2019-04-02 14:24:58', 'B025'),
(133, 'Barang baru diubah', '2019-04-02 14:25:12', 'B012'),
(134, 'Barang baru diubah', '2019-04-02 14:26:00', 'B046'),
(135, 'Barang baru ditambahkan', '2019-04-02 15:13:50', 'B056'),
(136, 'Barang baru dihapuskan', '2019-04-02 15:14:05', 'B056'),
(137, 'Barang baru diubah', '2019-04-03 09:50:30', 'B043'),
(138, 'Barang baru diubah', '2019-04-03 09:54:13', 'B043'),
(139, 'Barang baru diubah', '2019-04-03 10:23:00', 'B043'),
(140, 'Barang baru diubah', '2019-04-03 10:25:23', 'B036'),
(141, 'Barang baru ditambahkan', '2019-04-03 11:14:38', 'B056'),
(142, 'Barang baru diubah', '2019-04-03 11:14:56', 'B056'),
(143, 'Barang baru diubah', '2019-04-03 11:15:14', 'B056'),
(144, 'Barang baru dihapuskan', '2019-04-03 11:15:18', 'B056'),
(145, 'Barang baru diubah', '2019-04-03 11:57:34', 'B025'),
(146, 'Barang baru diubah', '2019-04-03 11:59:02', 'B020'),
(147, 'Barang baru ditambahkan', '2019-04-04 15:53:23', 'B056'),
(148, 'Barang baru dihapuskan', '2019-04-04 15:53:28', 'B056'),
(149, 'Barang baru ditambahkan', '2019-04-04 16:34:38', 'B056'),
(150, 'Barang baru dihapuskan', '2019-04-04 16:34:42', 'B056'),
(151, 'Barang baru dihapuskan', '2019-04-04 16:38:12', 'B046'),
(152, 'Barang baru ditambahkan', '2019-04-04 16:38:45', 'B056'),
(153, 'Barang baru dihapuskan', '2019-04-04 17:06:48', 'B056'),
(154, 'Barang baru dihapuskan', '2019-04-04 17:07:12', 'B024'),
(155, 'Barang baru ditambahkan', '2019-04-04 20:11:25', 'B046'),
(156, 'Barang baru diubah', '2019-04-04 20:20:12', 'B046'),
(157, 'Barang baru diubah', '2019-04-04 20:21:18', 'B046'),
(158, 'Barang baru diubah', '2019-04-04 20:49:27', 'B006'),
(159, 'Barang baru diubah', '2019-04-04 20:51:06', 'B006'),
(160, 'Barang baru diubah', '2019-04-04 21:17:02', 'B006');

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
  ADD PRIMARY KEY (`id_riwayat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
