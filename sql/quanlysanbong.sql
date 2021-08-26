-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 26, 2021 lúc 10:07 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlysanbong`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dat_san`
--

CREATE TABLE `dat_san` (
  `id` int(11) NOT NULL,
  `ma_kh` int(11) NOT NULL,
  `ma_san` int(11) NOT NULL,
  `bat_dau` datetime NOT NULL,
  `ket_thuc` datetime NOT NULL,
  `da_thanh_toan` tinyint(1) NOT NULL,
  `don_gia` int(11) NOT NULL,
  `note` varchar(500) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `id` int(11) NOT NULL,
  `ten` varchar(40) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `sdt` varchar(11) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `username` varchar(40) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `admin_number` int(1) NOT NULL,
  `soLanHuySan` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `khach_hang`
--

INSERT INTO `khach_hang` (`id`, `ten`, `sdt`, `email`, `username`, `admin_number`, `soLanHuySan`) VALUES
(37, 'Bao Bao Chi', '0703934369', 'baobaochi631999@gmail.com', 'baobaochi', 2, 0),
(58, 'Huỳnh Trịnh Thái Long', '0123456789', 'thailong2015py@gmail.com', 'thailong', 1, 0),
(59, 'baochi', '0909789237', 'huybao631999@gmail.com', 'baochi', 0, 0),
(61, 'Chí Huy Bảo', '0703934582', 'baobaochi123@gmail.com', 'baobaochi123', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_bong`
--

CREATE TABLE `san_bong` (
  `id` int(11) NOT NULL,
  `ten` varchar(40) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `gia` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `san_bong`
--

INSERT INTO `san_bong` (`id`, `ten`, `gia`) VALUES
(20, 'San A', 4000),
(21, 'San B', 3000),
(22, 'San C', 2000),
(23, 'San D', 5000),
(24, 'San E', 3000),
(26, 'San F', 3000),
(27, 'San G', 5000),
(28, 'San H', 2000),
(29, 'San I', 4000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `id` int(11) NOT NULL,
  `username` varchar(40) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `password_id` varchar(40) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `admin_number` int(1) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `sdt` varchar(11) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tai_khoan`
--

INSERT INTO `tai_khoan` (`id`, `username`, `password_id`, `admin_number`, `email`, `sdt`) VALUES
(3, 'thailong', '123456', 1, 'thailong2015py@gmail.com', '0780548215'),
(5, 'baochi', '123456', 0, 'huybao631999@gmail.com', '0254875332'),
(513, 'baobaochi', '123456', 2, 'baobaochi631999@gmail.com', '0703934583'),
(515, 'baobaochi123', '123456', 0, 'baobaochi123@gmail.com', '0703934582');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `dat_san`
--
ALTER TABLE `dat_san`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dat_san_ibfk_1` (`ma_kh`),
  ADD KEY `dat_san_ibfk_2` (`ma_san`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `san_bong`
--
ALTER TABLE `san_bong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dat_san`
--
ALTER TABLE `dat_san`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `san_bong`
--
ALTER TABLE `san_bong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=516;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `dat_san`
--
ALTER TABLE `dat_san`
  ADD CONSTRAINT `dat_san_ibfk_1` FOREIGN KEY (`ma_kh`) REFERENCES `khach_hang` (`id`),
  ADD CONSTRAINT `dat_san_ibfk_2` FOREIGN KEY (`ma_san`) REFERENCES `san_bong` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
