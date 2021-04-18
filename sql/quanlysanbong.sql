-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2019 at 02:16 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlysanbong`
--

-- --------------------------------------------------------

--
-- Table structure for table `dat_san`
--

CREATE TABLE `dat_san` (
  `id` int(11) NOT NULL,
  `ma_kh` int(11) NOT NULL,
  `ma_san` int(11) NOT NULL,
  `bat_dau` datetime NOT NULL,
  `ket_thuc` datetime NOT NULL,
  `da_thanh_toan` tinyint(1) NOT NULL,
  `don_gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `dat_san`
--

INSERT INTO `dat_san` (`id`, `ma_kh`, `ma_san`, `bat_dau`, `ket_thuc`, `da_thanh_toan`, `don_gia`) VALUES
(149, 26, 22, '2019-05-13 05:00:00', '2019-05-13 05:15:00', 0, 3000),
(150, 27, 22, '2019-05-13 06:00:00', '2019-05-13 10:15:00', 0, 3200);

-- --------------------------------------------------------

--
-- Table structure for table `khach_hang`
--

CREATE TABLE `khach_hang` (
  `id` int(11) NOT NULL,
  `ten` varchar(40) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `sdt` varchar(11) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `khach_hang`
--

INSERT INTO `khach_hang` (`id`, `ten`, `sdt`) VALUES
(26, 'Chau Nhuan Phat', '0123456789'),
(27, 'Chau Kiet Luan', '0123312892');

-- --------------------------------------------------------

--
-- Table structure for table `san_bong`
--

CREATE TABLE `san_bong` (
  `id` int(11) NOT NULL,
  `ten` varchar(40) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `san_bong`
--

INSERT INTO `san_bong` (`id`, `ten`) VALUES
(20, 'San A'),
(21, 'San B'),
(22, 'San C'),
(23, 'San D'),
(24, 'San E'),
(26, 'San F'),
(27, 'San G'),
(28, 'San H'),
(29, 'San I');

-- --------------------------------------------------------

--
-- Table structure for table `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `id` int(11) NOT NULL,
  `username` varchar(40) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `password` varchar(40) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `tai_khoan`
--

INSERT INTO `tai_khoan` (`id`, `username`, `password`) VALUES
(1, 'quynh', '123456'),
(3, 'songtoigianvn.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dat_san`
--
ALTER TABLE `dat_san`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `san_bong`
--
ALTER TABLE `san_bong`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dat_san`
--
ALTER TABLE `dat_san`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `san_bong`
--
ALTER TABLE `san_bong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dat_san`
--
ALTER TABLE `dat_san`
  ADD CONSTRAINT `dat_san_ibfk_1` FOREIGN KEY (`ma_kh`) REFERENCES `khach_hang` (`id`),
  ADD CONSTRAINT `dat_san_ibfk_2` FOREIGN KEY (`ma_san`) REFERENCES `san_bong` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
