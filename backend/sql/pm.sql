-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2025 at 11:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pm`
--

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `ID` bigint(20) NOT NULL,
  `UserID` varchar(32) NOT NULL,
  `LoginDate` date DEFAULT NULL,
  `LoginTime` time DEFAULT NULL,
  `State` tinyint(1) DEFAULT NULL,
  `Ip` varchar(32) DEFAULT NULL,
  `Mac` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='InnoDB free: 3072 kB; InnoDB free: 3072 kB; InnoDB free: 112';

--
-- Table structure for table `lv_lv0007`
--

CREATE TABLE `lv_lv0007` (
  `lv001` char(32) NOT NULL,
  `lv002` varchar(4096) DEFAULT NULL,
  `lv003` varchar(50) DEFAULT NULL,
  `lv004` varchar(30) DEFAULT NULL,
  `lv005` varchar(50) DEFAULT NULL,
  `lv006` varchar(32) DEFAULT NULL,
  `lv007` tinyint(1) NOT NULL DEFAULT 0,
  `lv008` char(40) NOT NULL,
  `lv009` datetime NOT NULL,
  `lv094` char(32) NOT NULL,
  `lv095` varchar(100) NOT NULL,
  `lv099` varchar(100) NOT NULL,
  `lv100` char(32) NOT NULL,
  `lv097` varchar(255) NOT NULL,
  `lv096` varchar(255) NOT NULL,
  `lv098` varchar(255) NOT NULL,
  `lv900` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='InnoDB free: 11264 kB; InnoDB free: 11264 kB; InnoDB free: 1';

--
-- Dumping data for table `lv_lv0007`
--

INSERT INTO `lv_lv0007` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`, `lv008`, `lv009`, `lv094`, `lv095`, `lv099`, `lv100`, `lv097`, `lv096`, `lv098`, `lv900`) VALUES
('admin', '', 'admin1', 'Administrator', 'c4ca4238a0b923820dcc509a6f75849b', 'S.P.ANH', 0, 'admin-833', '2025-05-29 10:37:58', '', '', 'themes4', '', 'EDNIad63K7c2T5W5', '', '2025-07-16 10:24:15', 0),
('bao', NULL, 'admin', '', 'c4ca4238a0b923820dcc509a6f75849b', 'kebao', 0, '', '2025-07-11 00:00:00', '', '', '', '', '', '', '', 1),
('nv01', NULL, 'admin', '0', 'c4ca4238a0b923820dcc509a6f75849b', 'N.K.Bao', 127, '', '0000-00-00 00:00:00', '', '', '', '', 'b0sRaCvSMi9TopJN', '', '2025-07-16 11:40:45', 0),
('nv02', NULL, 'admin', 'NV', 'c4ca4238a0b923820dcc509a6f75849b', 'N.N.Chung', 0, '', '2025-07-07 00:00:00', '', '', '', '', 'A4braKGWj2kyEq7z', '', '2025-07-16 11:40:28', 2),
('nv03', NULL, 'admin', 'Nhan vien xe ra', 'c4ca4238a0b923820dcc509a6f75849b', 'Hieu Nhan', 0, '', '2025-07-07 00:00:00', '', '', '', '', 'H0XmC06GvlTA1Rys', '', '2025-07-16 10:14:05', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0001`
--

CREATE TABLE `pm_nc0001` (
  `lv001` varchar(10) NOT NULL COMMENT 'Mã loại phương tiện',
  `lv002` varchar(50) NOT NULL COMMENT 'Tên loại phương tiện',
  `lv003` varchar(200) DEFAULT NULL COMMENT 'Mô tả loại phương tiện',
  `lv004` int(11) NOT NULL DEFAULT 0 COMMENT '0 : Xe loai 2 banh ||\r\n1: Xe lon (Nhieu banh)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Loại phương tiện';

--
-- Dumping data for table `pm_nc0001`
--

INSERT INTO `pm_nc0001` (`lv001`, `lv002`, `lv003`, `lv004`) VALUES
('OT', 'Ô tô 4 chỗ', 'Mô tả ô tô', 1),
('XE_12CHO', 'Xe 12 chỗ', 'Xe ô tô 12 chỗ ngồi%%%', 1),
('XE_16CHO', 'Xe 16 chỗ', 'Xe ô tô 16 chỗ ngồi', 1),
('Xe_17CHO', 'Xe 17 chỗ', 'xe 17 chỗ test', 1),
('XE_32CHO', 'Xe 32 chỗ', 'Xe bus 32 chỗ ngồi', 1),
('XE_50CHO', 'Xe 50 chỗ', 'Xe bus 50 chỗ ngồi', 1),
('XE_69CHO', 'Xe 69 chỗ', 'Xe 69 chỗ', 1),
('XE_6CHO', 'Xe 6 chỗ', 'Xe ô tô 6 chỗ ngồi', 1),
('XE_BUS', 'Xe bus', 'Xe bus đưa đón nhân viên', 1),
('XE_MAY', 'Xe máy', 'Mô tả xe máy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0002`
--

CREATE TABLE `pm_nc0002` (
  `lv001` varchar(20) NOT NULL COMMENT 'Biển số (khóa chính)',
  `lv002` varchar(10) NOT NULL COMMENT 'Mã loại phương tiện (FK → pm_nc0001.lv001)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Danh sách phương tiện';

--
-- Dumping data for table `pm_nc0002`
--

INSERT INTO `pm_nc0002` (`lv001`, `lv002`) VALUES
('28BB23328', 'OT'),
('66B821322', 'OT'),
('82B433333', 'OT'),
('86B82133', 'OT'),
('86B821332', 'OT'),
('86B871322', 'OT'),
('86B888888', 'OT'),
('86B921324', 'OT'),
('86B921922', 'OT'),
('88B132320', 'OT'),
('28KW32930', 'XE_BUS'),
('17AD88888', 'XE_MAY'),
('228CJ', 'XE_MAY'),
('282D37328', 'XE_MAY'),
('29A99999', 'XE_MAY'),
('60L126328', 'XE_MAY'),
('70B164729', 'XE_MAY'),
('77B134343', 'XE_MAY'),
('81B164729', 'XE_MAY'),
('86B399999', 'XE_MAY'),
('86B721322', 'XE_MAY'),
('86B821122', 'XE_MAY'),
('86B821311', 'XE_MAY'),
('86B821322', 'XE_MAY'),
('86B821323', 'XE_MAY'),
('86B821328', 'XE_MAY'),
('86B821329', 'XE_MAY'),
('86B921322', 'XE_MAY'),
('86BB21321', 'XE_MAY'),
('86BB21322', 'XE_MAY'),
('86BB21333', 'XE_MAY'),
('86BB876768', 'XE_MAY'),
('86BD21321', 'XE_MAY'),
('86BD21322', 'XE_MAY'),
('86BD21328', 'XE_MAY'),
('882732928', 'XE_MAY'),
('OA8C705', 'XE_MAY');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0003`
--

CREATE TABLE `pm_nc0003` (
  `lv001` varchar(100) NOT NULL COMMENT 'UID thẻ RFID',
  `lv002` enum('VIP','KHACH') NOT NULL DEFAULT 'KHACH' COMMENT 'Loại thẻ',
  `lv003` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Trạng thái thẻ (active)',
  `lv004` date NOT NULL COMMENT 'Ngày phát hành thẻ',
  `lv005` varchar(20) NOT NULL COMMENT 'Bien so xe',
  `lv006` varchar(255) NOT NULL COMMENT 'Ma chinh sach',
  `lv007` date NOT NULL COMMENT 'Ngay ket thuc cs'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Thông tin thẻ RFID';

--
-- Dumping data for table `pm_nc0003`
--

INSERT INTO `pm_nc0003` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`) VALUES
('00000000', 'KHACH', 1, '2025-07-08', '', '', '0000-00-00'),
('0002468477', 'VIP', 1, '2025-07-04', '70B164729', 'CS_XE_MAY_3T', '2025-07-25'),
('0007486586', 'KHACH', 1, '2025-07-08', '', 'CS_XE_69CHO_BASE', '0000-00-00'),
('0007502234', 'KHACH', 1, '2025-07-04', '', '', '0000-00-00'),
('0008441096', 'KHACH', 1, '2025-07-04', '', 'CS_OTO_4H', '0000-00-00'),
('000844589', 'KHACH', 1, '2025-07-04', '', '', '0000-00-00'),
('0008445898', 'KHACH', 1, '2025-07-04', '', '', '0000-00-00'),
('0008477914', '', 1, '2025-07-08', '', '', '0000-00-00'),
('0008530271', '', 1, '2025-07-07', '', '', '0000-00-00'),
('0008532663', 'VIP', 1, '2025-07-08', '86B821322', 'CS_XE_BUS_16Th', '2026-12-12'),
('0008611132', 'KHACH', 1, '2025-07-10', '', '', '0000-00-00'),
('0008619047', 'KHACH', 1, '2025-07-09', '', 'CS_XEMAY_4H', '0000-00-00'),
('007486586', '', 1, '2025-07-15', '', '', '0000-00-00'),
('0293840923', 'KHACH', 1, '2025-07-09', '', '', '0000-00-00'),
('040450A64F6180', 'KHACH', 1, '2025-07-14', '', '', '0000-00-00'),
('043507A34F6180', 'KHACH', 1, '2025-07-15', '', '', '0000-00-00'),
('0476E8A34F6180', 'KHACH', 1, '2025-07-14', '', '', '0000-00-00'),
('048582A34F6180', 'KHACH', 1, '2025-07-14', '', '', '0000-00-00'),
('04E454A34F6180', 'KHACH', 1, '2025-07-14', '', '', '0000-00-00'),
('090909090', 'KHACH', 1, '2025-07-07', '', '', '0000-00-00'),
('111111111', 'KHACH', 1, '2025-07-09', '', '', '0000-00-00'),
('12121212', 'KHACH', 1, '2025-07-08', '', '', '0000-00-00'),
('121212121', 'KHACH', 1, '2025-07-09', '', '', '0000-00-00'),
('1212121212', 'KHACH', 1, '2025-07-09', '', '', '0000-00-00'),
('123', '', 1, '2025-07-08', '', '', '0000-00-00'),
('123456789', 'KHACH', 1, '2025-07-07', '', '', '0000-00-00'),
('12345678900', 'KHACH', 1, '2025-07-07', '', '', '0000-00-00'),
('23232323', 'KHACH', 1, '2025-07-09', '', '', '0000-00-00'),
('30112003', 'KHACH', 1, '2025-07-08', '', '', '0000-00-00'),
('301120033', 'KHACH', 1, '2025-07-15', '', '', '0000-00-00'),
('30112003Bao', 'VIP', 1, '2025-07-09', '81B164729', 'CS_XE_MAY_3T', '2025-07-30'),
('33355555', 'KHACH', 1, '2025-07-11', '', '', '0000-00-00'),
('348628734', 'KHACH', 1, '2025-07-09', '', '', '0000-00-00'),
('456', 'VIP', 1, '2025-07-10', '81B2000000', 'CS_XE_BUS_16Th', '2026-11-02'),
('55555555', 'KHACH', 1, '2025-07-10', '', '', '0000-00-00'),
('77777777', 'KHACH', 1, '2025-07-10', '', '', '0000-00-00'),
('88888888', 'KHACH', 1, '2025-07-08', '', '', '0000-00-00'),
('888888888', 'KHACH', 1, '2025-07-08', '', '', '0000-00-00'),
('9090909090', 'KHACH', 1, '2025-07-07', '', '', '0000-00-00'),
('999999999', 'VIP', 1, '2025-07-04', '81B164729', 'CS_XE_MAY_30N', '2025-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0004`
--

CREATE TABLE `pm_nc0004` (
  `lv001` varchar(20) NOT NULL COMMENT 'Mã khu vực',
  `lv002` varchar(100) NOT NULL COMMENT 'Tên khu vực',
  `lv003` varchar(200) DEFAULT NULL COMMENT 'Vị trí mô tả'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Các khu vực giữ xe';

--
-- Dumping data for table `pm_nc0004`
--

INSERT INTO `pm_nc0004` (`lv001`, `lv002`, `lv003`) VALUES
('K0001', 'Khu A', 'Tầng trệt'),
('K0002', 'Khu B', 'Tầng hầm');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0005`
--

CREATE TABLE `pm_nc0005` (
  `lv001` varchar(20) NOT NULL COMMENT 'Mã vị trí gửi xe',
  `lv002` varchar(20) NOT NULL COMMENT 'Mã khu vực (FK → pm_nc0004.lv001)',
  `lv003` int(11) NOT NULL DEFAULT 0 COMMENT 'Trạng thái chỗ đỗ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Vị trí gửi xe cụ thể';

--
-- Dumping data for table `pm_nc0005`
--

INSERT INTO `pm_nc0005` (`lv001`, `lv002`, `lv003`) VALUES
('P0001', 'K0001', 0),
('P0002', 'K0001', 0),
('P0003', 'K0002', 0),
('P0004', 'K0002', 1),
('P0005', 'K0001', 0),
('P0006', 'K0001', 0),
('P0007', 'K0002', 0),
('P0008', 'K0002', 0),
('P0009', 'K0001', 0),
('P0010', 'K0001', 0),
('P0011', 'K0002', 0),
('P0012', 'K0002', 0),
('P0013', 'K0001', 0),
('P0014', 'K0001', 0),
('P0015', 'K0002', 0),
('P0016', 'K0002', 0),
('P0017', 'K0001', 0),
('P0018', 'K0001', 0),
('P0019', 'K0002', 0),
('P0020', 'K0002', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0006`
--

CREATE TABLE `pm_nc0006` (
  `lv001` varchar(20) NOT NULL COMMENT 'Mã camera',
  `lv002` varchar(100) NOT NULL COMMENT 'Tên camera',
  `lv003` varchar(50) NOT NULL COMMENT 'Loại camera',
  `lv004` varchar(200) DEFAULT NULL COMMENT 'Chuc nang',
  `lv005` varchar(20) DEFAULT NULL COMMENT 'Mã khu - FK đến pm_nc0004',
  `lv006` varchar(255) DEFAULT NULL COMMENT 'link rtsp camera'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Thông tin camera ANPR';

--
-- Dumping data for table `pm_nc0006`
--

INSERT INTO `pm_nc0006` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`) VALUES
('CAM1', 'Camera 1', 'VAO', 'BIENSO', 'K0001', 'rtsp://admin:BXPSZJ@192.168.1.44/h264/ch1/main/av_stream'),
('CAM2', 'Camera 2', 'RA', 'BIENSO', 'K0001', 'rtsp://admin:BXPSZJ@192.168.1.44/h264/ch1/main/av_stream'),
('CAM3', 'Camera 3', 'VAO', 'BIENSO', 'K0002', 'rtsp://admin:BXPSZJ@192.168.1.44/h264/ch1/main/av_stream'),
('CAM4', 'Camera 4', 'VAO', 'KHUONMAT', 'K0001', 'rtsp://admin:VLRLXT@192.168.1.89/h264/ch1/main/av_stream'),
('CAM5', 'Camera 5', 'RA', 'KHUONMAT', 'K0001', ''),
('CAM6', 'a', 'RA', 'BIENSO', 'K0002', 'rtsp://admin:BXPSZJ@192.168.1.44/h264/ch1/main/av_stream');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0007`
--

CREATE TABLE `pm_nc0007` (
  `lv001` varchar(20) NOT NULL COMMENT 'Mã cổng',
  `lv002` varchar(100) NOT NULL COMMENT 'Tên cổng',
  `lv003` enum('VAO','RA') NOT NULL COMMENT 'Loại cổng (vào/ra)',
  `lv004` varchar(200) DEFAULT NULL COMMENT 'Vị trí lắp đặt',
  `lv005` varchar(20) DEFAULT NULL COMMENT 'Mã khu - FK đến pm_nc0004'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Thông tin cổng barrier';

--
-- Dumping data for table `pm_nc0007`
--

INSERT INTO `pm_nc0007` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`) VALUES
('GATE_IN1', 'Cổng vào A', 'VAO', 'Lối chính A', 'K0001'),
('GATE_IN2', 'Cổng vào B', 'VAO', 'Lối chính B', 'K0002'),
('GATE_OUT1', 'Cổng ra A', 'RA', 'Lối chính A', 'K0001'),
('GATE_OUT2', 'Cổng ra B', 'RA', 'Lối chính B', 'K0002');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0008`
--

CREATE TABLE `pm_nc0008` (
  `lv001` varchar(255) NOT NULL COMMENT 'Mã chính sách giá',
  `lv002` varchar(10) NOT NULL COMMENT 'Mã loại phương tiện (FK → pm_nc0001.lv001)',
  `lv003` int(11) NOT NULL COMMENT 'Thời gian quy định (phút)',
  `lv004` decimal(12,2) NOT NULL COMMENT 'Đơn giá gói (VNĐ)',
  `lv005` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Có tính phí quá giờ không',
  `lv006` decimal(12,2) DEFAULT NULL COMMENT 'Đơn giá quá giờ (VNĐ)',
  `lv007` varchar(255) NOT NULL COMMENT 'Loai chinh sach',
  `lv008` int(11) NOT NULL COMMENT 'Tong ngay '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Chính sách giá theo loại xe';

--
-- Dumping data for table `pm_nc0008`
--

INSERT INTO `pm_nc0008` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`, `lv008`) VALUES
('CS_OTO_4H', 'OT', 240, 15000.00, 1, 5000.00, '', 0),
('CS_XE_69CHO_BASE', 'XE_69CHO', 240, 55000.00, 0, 2000.00, 'N', 0),
('CS_XE_BUS_16Th', 'XE_BUS', 240, 7000000.00, 0, 2000.00, '16 Tháng', 480),
('CS_XE_MAY_30N', 'XE_MAY', 0, 500000.00, 0, 0.00, '30 Ngày', 30),
('CS_XE_MAY_3T', 'XE_MAY', 0, 400000.00, 0, 0.00, '3 Tuần', 21),
('CS_XEMAY_4H', 'XE_MAY', 240, 5000.00, 1, 5000.00, '', 0),
('CS_XEMAY_8H', 'XE_MAY', 240, 240.00, 1, 12.00, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009`
--

CREATE TABLE `pm_nc0009` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(255) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

--
-- Dumping data for table `pm_nc0009`
--

INSERT INTO `pm_nc0009` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`, `lv008`, `lv009`, `lv010`, `lv011`, `lv012`, `lv013`, `lv014`, `lv015`, `lv016`) VALUES
(487, '048582A34F6180', '86B821322', 'P0004', 'CS_OTO_4H', 'GATE_IN1', NULL, '2025-07-15 15:07:18', NULL, NULL, 'license_plate_2025-07-15T08-07-18-133Z.jpg', NULL, NULL, 'DANG_GUI', 'khuon_mat_2025-07-15T08-07-20-334Z.jpg', NULL),
(488, '0476E8A34F6180', '86B821311', NULL, 'CS_XEMAY_4H', 'GATE_IN1', NULL, '2025-07-15 16:23:35', NULL, NULL, 'license_plate_2025-07-15T09-23-35-129Z.jpg', NULL, NULL, 'DANG_GUI', 'khuon_mat_2025-07-15T09-23-37-035Z.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_01072025`
--

CREATE TABLE `pm_nc0009_01072025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(255) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_02072025`
--

CREATE TABLE `pm_nc0009_02072025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(255) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

--
-- Dumping data for table `pm_nc0009_02072025`
--

INSERT INTO `pm_nc0009_02072025` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`, `lv008`, `lv009`, `lv010`, `lv011`, `lv012`, `lv013`, `lv014`, `lv015`, `lv016`) VALUES
(298, '123456789', '86B921922', 'P0001', 'CS_OT_3Th', 'GATE_IN1', 'GATE_OUT1', '2025-07-01 16:08:03', '2025-07-02 09:31:53', 1044, 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image3790223706103039317.jpg', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image8952693578109774343.jpg', 500000.00, 'DA_RA', '', '0'),
(300, '3333333', '86B921324', 'P0013', 'CS_OT_3Th', 'GATE_IN1', 'GATE_OUT1', '2025-07-01 16:38:29', '2025-07-02 09:42:56', 1024, 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image5249993093414809019.jpg', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image84220777264978660.jpg', 50000000.00, 'DA_RA', '', '0'),
(301, '0000000', '66B821322', 'P0005', 'CS_OT_3Th', 'GATE_IN1', 'GATE_OUT1', '2025-07-01 16:40:20', '2025-07-02 10:49:23', 1089, 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image437374337319353135.jpg', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image4419925570559278651.jpg', 500000.00, 'DA_RA', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_03072025`
--

CREATE TABLE `pm_nc0009_03072025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(255) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_06072025`
--

CREATE TABLE `pm_nc0009_06072025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(255) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_07072025`
--

CREATE TABLE `pm_nc0009_07072025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(255) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

--
-- Dumping data for table `pm_nc0009_07072025`
--

INSERT INTO `pm_nc0009_07072025` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`, `lv008`, `lv009`, `lv010`, `lv011`, `lv012`, `lv013`, `lv014`, `lv015`, `lv016`) VALUES
(364, '090909090', '86B821322', NULL, 'CS_XE_MAY_30N', 'GATE_IN1', 'GATE_OUT1', '2025-07-07 16:20:58', '2025-07-07 16:22:43', 60, 'license_plate_2025-07-07T09-20-05-899Z.jpg', 'license_plate_2025-07-07T09-21-43-267Z.jpg', 0.00, 'DA_RA', 'khuon_mat_2025-07-07T09-20-25-289Z.jpg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_08072025`
--

CREATE TABLE `pm_nc0009_08072025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(255) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

--
-- Dumping data for table `pm_nc0009_08072025`
--

INSERT INTO `pm_nc0009_08072025` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`, `lv008`, `lv009`, `lv010`, `lv011`, `lv012`, `lv013`, `lv014`, `lv015`, `lv016`) VALUES
(365, '123', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 09:09:49', '2025-07-08 09:17:13', 60, 'blob:file:///d8cae387-6e7a-43b8-9e10-fa3aa59b686f', 'blob:file:///555e67db-407d-40f6-a237-cc2a3d8023ae', NULL, 'DA_RA', 'blob:file:///962d9649-dcea-4c92-87ba-28498b8e768c', '0'),
(366, '123', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 09:19:20', '2025-07-08 09:19:50', 60, 'blob:file:///a94dd2b8-4d13-4f56-b08b-b66a49be573b', 'blob:file:///aa1ca259-4e3a-4a17-b5e5-90ba8c4dacf6', NULL, 'DA_RA', 'blob:file:///b2eb93cc-f042-4f49-9e5c-9a0a1d69df7a', '0'),
(367, '123', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 09:35:08', '2025-07-08 09:35:18', 60, 'blob:file:///b4331e6a-5de7-4ad5-b0c6-6c4e6d32ba59', 'blob:file:///2b101df0-c456-4f98-9be8-3c33d955afc7', 5000.00, 'DA_RA', 'blob:file:///e8cf464a-311b-4687-b2c5-292cf01a69dc', '0'),
(368, '123', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 23:36:03', '2025-07-08 09:37:34', 60, 'blob:file:///ce80b15a-3eb2-4706-84a1-7058c7fb2b68', 'blob:file:///68dd8aa5-e242-48ec-ad5a-3de0a65bb264', 5000.00, 'DA_RA', 'blob:file:///25d0a302-416c-4313-8874-02f30925d756', '0'),
(369, '123', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 02:37:47', '2025-07-08 09:38:08', 420, 'blob:file:///f8e4b84d-4b62-4bbe-95b6-e409548f8377', 'blob:file:///79b7302a-1076-48f0-8bdd-5579965f6890', 10000.00, 'DA_RA', 'blob:file:///55e5314e-3920-4355-a7e3-f6961c94d1a8', '0'),
(370, '123', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-01 09:43:17', '2025-07-08 09:43:50', 10081, 'blob:file:///126c6799-ac7f-4879-9234-f58451413803', 'blob:file:///c00bb903-25f9-4f24-9684-2cea0cfc4a02', 215000.00, 'DA_RA', 'blob:file:///83c7c22c-ff04-465e-9442-ebbf141ccd05', '0'),
(371, '0008532663', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-01 09:47:17', '2025-07-08 09:47:58', 10081, 'blob:file:///8e3f2525-f897-4658-90a5-d8922ace1203', 'blob:file:///6521a166-a008-4195-9b53-0b1209ce4373', 215000.00, 'DA_RA', 'blob:file:///c38707d3-9e5a-4bfa-8c5c-4f819e81a172', '0'),
(372, '0008532663', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 09:48:23', '2025-07-08 09:48:32', 60, 'blob:file:///f1e297b2-6570-4e12-9afb-b43f2c94292b', 'blob:file:///56e84e47-6c90-4528-81df-3644942acc33', 5000.00, 'DA_RA', 'blob:file:///753faa08-c039-45fe-8f72-2edd55a6306d', '0'),
(373, '0008532663', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 11:05:52', '2025-07-08 11:07:48', 60, 'blob:file:///e4714544-cdbc-46f5-9bd3-47e2bcf97ac9', 'blob:file:///11cebe54-db65-496f-ac55-3e6876e230f4', 5000.00, 'DA_RA', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', '0'),
(374, '0008477914', '86BB21322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2007-07-08 11:08:27', '2025-07-08 11:09:15', 9468061, 'blob:file:///7a2ffdbf-8b21-4eea-921e-d508c282b80b', 'blob:file:///1f58f905-9eed-4eb6-8dcd-e97f476b4ca8', 197255000.00, 'DA_RA', 'blob:file:///93497b8d-8829-4830-9092-14388a1da6f9', '0'),
(375, '0007486586', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 11:47:44', '2025-07-08 11:48:50', 60, 'blob:file:///6aca9322-0125-469a-80e9-4477ab466179', 'blob:file:///462cdd2f-6cef-4839-a18f-51995cba3a0b', 5000.00, 'DA_RA', 'blob:file:///369ccbcc-8b86-46ed-90b8-a9ba60378837', '0'),
(376, '30112003', '86B821322', NULL, 'CS_XE_MAY_30N', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 14:27:50', '2025-07-08 14:45:56', 60, 'license_plate_2025-07-08T07-27-50-459Z.jpg', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image6328183578025764428.jpg', 0.00, 'DA_RA', 'khuon_mat_2025-07-08T07-27-53-405Z.jpg', '0'),
(377, '0008532663', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 14:38:35', '2025-07-08 14:40:22', 60, 'blob:file:///eaaed3a7-4cb7-4ea8-99c7-3cbf9d70955a', 'blob:file:///99e3c2ad-ceb2-4cdb-ba41-e5643f1e02cd', 5000.00, 'DA_RA', 'blob:file:///d5dc8e7e-02b2-473e-b755-1d9a133096d7', '0'),
(378, '0008532663', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 14:44:45', '2025-07-08 14:44:58', 60, 'blob:file:///4870ca18-713b-440a-bca1-76a4a3889dfe', 'blob:file:///8af0f554-0d30-4db1-97c1-33084159b0ee', 5000.00, 'DA_RA', 'blob:file:///b7ebc949-f465-477f-84fb-08cfd954a040', '0'),
(379, '0008532663', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 14:48:41', '2025-07-08 14:48:46', 60, 'blob:file:///4b8a8491-83c5-4cd9-8acb-22888bda3b72', 'blob:file:///e840abef-9f51-4a8b-a0bb-db2b6ed41166', 5000.00, 'DA_RA', 'blob:file:///73fe257d-6811-4e6a-8283-fef5fd3bbf31', '0'),
(380, '12121212', '86B821328', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 15:07:05', '2025-07-08 15:09:29', 60, 'license_plate_2025-07-08T08-07-05-577Z.jpg', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image55034575532172294.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-08T08-07-09-772Z.jpg', '0'),
(381, '00000000', '86B821328', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 15:15:26', '2025-07-08 15:16:39', 60, 'license_plate_2025-07-08T08-15-26-621Z.jpg', 'license_plate_out_2025-07-08T08-16-39-730Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-08T08-15-34-739Z.jpg', '0'),
(382, '0008532663', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 15:21:58', '2025-07-08 15:22:03', 60, 'blob:file:///f395d0c3-5c0b-4ac1-af2d-a27d0cbb1e6a', 'blob:file:///13e228a6-5ccc-4484-b703-3de19b9dc921', 5000.00, 'DA_RA', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', '0'),
(383, '0007486586', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 15:22:16', '2025-07-08 15:22:20', 60, 'blob:file:///6d35485e-5feb-43dc-9187-1d36b161fc79', 'blob:file:///33d67e0c-e34e-474f-83d0-feddb9e19198', 5000.00, 'DA_RA', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', '0'),
(384, '0008532663', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 15:27:19', '2025-07-08 15:27:23', 60, 'blob:file:///9d5ad86c-b26b-48ac-b432-9b4fb37c5b5e', 'blob:file:///7315607f-5706-450d-b613-4838782ac5a0', 5000.00, 'DA_RA', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', '0'),
(385, '0007486586', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 15:27:32', '2025-07-08 15:27:49', 60, 'blob:file:///f48fe544-0f2c-4180-a137-8dd8904001d5', 'blob:file:///ffa08bd7-3353-44f9-8c6a-7c3b34c3c4e9', 5000.00, 'DA_RA', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', '0'),
(386, '00000000', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 15:38:18', '2025-07-08 16:29:30', 60, 'license_plate_2025-07-08T08-38-18-406Z.jpg', 'blob:file:///115999d8-aa7e-4f18-bf25-5d257408aee6', 5000.00, 'DA_RA', 'khuon_mat_2025-07-08T08-38-22-840Z.jpg', '0'),
(387, '888888888', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 16:22:53', '2025-07-08 16:24:59', 60, 'license_plate_2025-07-08T09-22-53-885Z.jpg', 'license_plate_out_2025-07-08T09-24-59-629Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-08T09-22-59-592Z.jpg', '0'),
(388, '88888888', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 16:31:01', '2025-07-08 16:31:50', 60, 'license_plate_2025-07-08T09-31-01-561Z.jpg', 'license_plate_out_2025-07-08T09-31-50-452Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-08T09-31-08-288Z.jpg', '0'),
(389, '0008532663', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 16:30:21', '2025-07-08 16:30:25', 60, 'blob:file:///ce7144bb-56ab-4931-8472-9406e8520903', 'blob:file:///6f4e652b-2310-47ae-8625-7f65e8bf52d0', 5000.00, 'DA_RA', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', '0'),
(390, '0008445898', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 16:30:34', '2025-07-08 16:30:48', 60, 'blob:file:///7e33fd95-90c0-402b-9b07-0b077d8479bf', 'blob:file:///ac06b325-982e-415b-ab1b-430a2d5c6d12', 5000.00, 'DA_RA', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', '0'),
(391, '123', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 16:31:11', '2025-07-08 16:31:23', 60, 'blob:file:///6d5cb159-978b-44ee-b0d1-6b52bc3f9d65', 'blob:file:///bb3a3513-7591-40a1-970d-f63ae9b1b413', 5000.00, 'DA_RA', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', '0'),
(392, '0008445898', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 16:31:41', '2025-07-08 16:31:46', 60, 'blob:file:///9ea48b6b-a33f-42ce-8347-460660e6143a', 'blob:file:///4cb5423a-796d-405c-b90a-eff1ca845418', 5000.00, 'DA_RA', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', '0'),
(393, '0008532663', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 16:32:07', '2025-07-08 16:32:18', 60, 'blob:file:///541bde3c-e036-4a42-bb49-cc870e3b0a5e', 'blob:file:///b67065d4-7bb3-4ea3-a247-656a4c12da6c', 5000.00, 'DA_RA', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', '0'),
(394, '0008445898', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 16:32:41', '2025-07-08 16:32:49', 60, 'blob:file:///f5689142-9710-4f22-9c09-df9266fb63a7', 'blob:file:///ea494f7b-60c7-414e-b078-7f19905812bc', 5000.00, 'DA_RA', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', '0'),
(395, '0008532663', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 16:40:07', '2025-07-08 16:40:14', 60, 'blob:file:///05a6f7bc-892e-40a1-a0af-c06e6fb056b8', 'blob:file:///30e38764-e592-4671-a229-dddb43f72634', 5000.00, 'DA_RA', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', '0'),
(396, '0008445898', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-08 16:40:20', '2025-07-08 16:40:24', 60, 'blob:file:///f0c77b81-afb0-4f0b-9859-3f71a577c263', 'blob:file:///aeb2a146-11d6-45f8-a862-de33d0bcb4bd', 5000.00, 'DA_RA', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_09072025`
--

CREATE TABLE `pm_nc0009_09072025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(255) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

--
-- Dumping data for table `pm_nc0009_09072025`
--

INSERT INTO `pm_nc0009_09072025` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`, `lv008`, `lv009`, `lv010`, `lv011`, `lv012`, `lv013`, `lv014`, `lv015`, `lv016`) VALUES
(397, '0008530271', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 10:22:21', '2025-07-09 10:22:45', 60, 'blob:file:///1ef326eb-cc2b-4c27-85c3-bf5a3feea019', 'blob:file:///09465ec9-54ce-42b5-a87c-7a49311d2dce', NULL, 'DA_RA', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', '0'),
(398, '0008530271', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 10:23:01', '2025-07-09 10:23:31', 60, 'blob:file:///7dacb3fc-5741-4d08-b496-e223f4c26994', 'blob:file:///496a3b53-629e-4da8-b4e1-d61e49f1c681', NULL, 'DA_RA', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', '0'),
(399, '23232323', '86BB21322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 10:29:06', '2025-07-09 13:20:13', 171, 'license_plate_2025-07-09T03-29-06-505Z.jpg', 'blob:file:///9d969879-3cf0-4edb-a27f-96108d946d5f', 5000.00, 'DA_RA', 'khuon_mat_2025-07-09T03-29-11-230Z.jpg', '0'),
(400, '0008445898', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 10:27:48', '2025-07-09 10:27:52', 60, 'blob:file:///7ae94e4a-45ef-4072-9b46-3340f42bae97', 'blob:file:///9afb9e19-af4f-4083-ac68-2c1c39c48388', 5000.00, 'DA_RA', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', '0'),
(401, '111111111', '86BB21321', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 10:31:30', '2025-07-09 10:49:29', 60, 'license_plate_2025-07-09T03-31-30-958Z.jpg', 'license_plate_out_2025-07-09T03-49-29-158Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-09T03-31-35-478Z.jpg', '0'),
(403, '348628734', '86B821329', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 10:45:18', '2025-07-09 13:19:14', 154, 'license_plate_2025-07-09T03-45-18-925Z.jpg', 'blob:file:///e436d005-4c0a-4e8e-b2d4-a9016b4d0af0', 5000.00, 'DA_RA', 'khuon_mat_2025-07-09T03-45-23-946Z.jpg', '0'),
(404, '0008445898', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 11:02:04', '2025-07-09 11:02:11', 60, 'blob:file:///f4466ff4-4128-4857-a092-9cf237b451c9', 'blob:file:///4ce7681d-2b0b-4167-8db4-a36105b13790', 5000.00, 'DA_RA', 'blob:file:///b7bad453-6e22-4c5d-b2db-58e2114463e7', '0'),
(405, '0008445898', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 11:09:58', '2025-07-09 11:10:08', 60, 'blob:file:///e4b731cc-124d-4912-b745-46f7b47feb25', 'blob:file:///9cbc8a2f-668b-4408-9f33-cd6ea7ccfb56', 5000.00, 'DA_RA', 'blob:file:///1ebe24ff-df69-4a58-a847-bcc55a285ea5', '0'),
(406, '0008445898', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 11:15:47', '2025-07-09 11:15:53', 60, 'blob:file:///b0cd40ea-1b75-4914-bb5c-14b9e7e0148a', 'blob:file:///22a447cc-581c-405d-a457-d5034b9cc8ad', 5000.00, 'DA_RA', 'blob:file:///75e534c4-2860-4c4c-9a88-7aa210389826', '0'),
(407, '0008445898', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 11:16:11', '2025-07-09 11:16:21', 60, 'blob:file:///8546b79f-9188-42f5-82ec-93dd9bc06c90', 'blob:file:///428aedf2-d76c-4aae-b7ed-0c3d9133d14f', 5000.00, 'DA_RA', 'blob:file:///7797cb74-3981-4405-a083-e64eab14aef1', '0'),
(408, '0008445898', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 11:16:42', '2025-07-09 11:16:47', 60, 'blob:file:///d918d2c8-b98a-4523-9412-16e7bfd11fa9', 'blob:file:///940e73d3-a575-4ebe-b08e-221bf1f02696', 5000.00, 'DA_RA', 'blob:file:///7c10b48c-52fa-4745-ba0b-0661cfd42086', '0'),
(409, '0008445898', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 11:29:26', '2025-07-09 11:29:31', 60, 'blob:file:///25945a0d-bc09-40ee-8de4-5a39dc43425b', 'blob:file:///1766e210-5aa5-4c14-bbbf-fd6bcaebc40d', 5000.00, 'DA_RA', 'blob:file:///0c6d4c65-6889-42ab-9ce5-e2ec2b2a721b', '0'),
(410, '0008445898', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 11:30:05', '2025-07-09 11:30:15', 60, 'blob:file:///55cad20f-7336-4c2d-a413-140669f5219f', 'blob:file:///41c8b656-ad8e-4bcb-a923-6dbcac3fe5d3', 5000.00, 'DA_RA', 'blob:file:///020837f9-6f8a-4b92-ab2e-66d686f9f6aa', '0'),
(411, '0008445898', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 11:59:18', '2025-07-09 11:59:24', 60, 'blob:file:///af014349-e252-4027-82b2-9d0afeb197ba', 'blob:file:///524ddeeb-5092-4185-9885-a56f05d1f46a', 5000.00, 'DA_RA', 'blob:file:///c05260ca-0caf-48db-971d-d5ee8fbfa5ef', '0'),
(412, '0008532663', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 12:01:28', '2025-07-09 12:01:33', 60, 'blob:file:///59a251e3-2c35-41b5-bf63-81bf6c5fb476', 'blob:file:///38415f22-9bc1-48eb-9a10-ba6f5f655614', NULL, 'DA_RA', 'blob:file:///d2895790-b3e4-4de5-9be6-7d71659cf10e', '0'),
(413, '0008445898', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 13:20:21', '2025-07-09 13:32:21', 60, 'blob:file:///fe99aeb0-b0ed-480a-a32d-f588df413922', 'blob:file:///62fbde30-586b-4111-b99d-0b93a607e610', 5000.00, 'DA_RA', 'blob:file:///76c0073c-2e31-4756-8c47-30ad945ec092', '0'),
(414, '0008530271', '86BB21322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 13:28:34', '2025-07-09 13:30:02', 60, 'blob:file:///cec9bbeb-bbfa-4442-b897-b87590e97f1a', 'blob:file:///ac699705-59c1-4324-857f-8bda4cea4d2f', NULL, 'DA_RA', 'blob:file:///296c12d1-6903-4530-b854-6683df62d46a', '0'),
(415, '0008532663', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 13:32:33', '2025-07-09 13:32:38', 60, 'blob:file:///dd590f4c-52f2-4cd4-a75c-ebeeb3857261', 'blob:file:///23e4c596-e2ea-48ff-b8fa-e1fb3442a3b6', NULL, 'DA_RA', 'blob:file:///98fa7a0b-b10f-4fba-b204-7dadd9e1cd36', '0'),
(416, '0008532663', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 13:32:55', '2025-07-09 13:33:00', 60, 'blob:file:///efce832d-f123-4823-ae37-15c37977a580', 'blob:file:///f3aec17f-2dec-42a7-abfd-e0a269b9d7d2', NULL, 'DA_RA', 'blob:file:///03d60efa-9876-4a12-b922-6cc9f920c3ce', '0'),
(417, '0008532663', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 13:33:27', '2025-07-09 13:33:41', 60, 'blob:file:///70d6ef09-5c09-49a9-a90e-80875ec5e2d9', 'blob:file:///21f162bf-3795-49fd-82fc-0294fb14fb2f', NULL, 'DA_RA', 'blob:file:///ced871d1-d657-4a07-87b6-dc426abec289', '0'),
(418, '0008530271', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 13:42:17', '2025-07-09 13:43:14', 60, 'blob:file:///b18add74-4ec3-4647-a9e0-a73c044d9abc', 'blob:file:///9fcb45c2-8114-4cff-9dd3-58309899e0bd', NULL, 'DA_RA', 'blob:file:///2254b970-c160-4e36-8b06-aeac31e5e69e', '0'),
(419, '0008532663', '86B821322', NULL, 'CS_XE_BUS_16Th', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 13:44:34', '2025-07-09 13:45:40', 60, 'blob:file:///ab8915b1-7d4f-4cc9-b8ab-700fee312be4', 'blob:file:///8e58fe18-38d6-45b8-b845-de61ea80aac2', NULL, 'DA_RA', 'blob:file:///4dce9319-5fe5-4be8-ace3-54af968981b9', '0'),
(420, '0008532663', '86B821322', NULL, 'CS_XE_BUS_16Th', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 13:49:35', '2025-07-09 13:49:42', 60, 'blob:file:///a6d0177e-3bc2-47b5-b738-df485fae65af', 'blob:file:///66c6c165-c23f-48de-a3ef-d0f584f202f5', NULL, 'DA_RA', 'blob:file:///cddd5ba6-c7d5-4e9b-80c1-2fa55b6fc0d8', '0'),
(421, '0008532663', '86B821322', NULL, 'CS_XE_BUS_16Th', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 13:50:20', '2025-07-09 14:14:41', 60, 'blob:file:///ce3f5457-3174-4e41-88bc-78092fcd0355', 'blob:file:///c42e0c27-bdf9-4432-ba1f-a59bd7ec303e', NULL, 'DA_RA', 'blob:file:///98362105-c6e3-44d9-a2b7-fb952900b0ff', '0'),
(422, '0007486586', '86BB21322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '1997-07-09 14:15:57', '2025-07-09 14:16:59', 14726941, 'blob:file:///fcf83dec-2009-4984-a3da-f6ebb72c157a', 'blob:file:///26710985-d2a7-4728-897d-c5b230b3ad95', NULL, 'DA_RA', 'blob:file:///37ce03f0-77e6-4baf-9590-4e3380a28a32', '0'),
(423, '0007486586', '86BB21322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 14:17:41', '2025-07-09 14:17:48', 60, 'blob:file:///ba2ed460-4147-4ca5-8cc4-30ad278873b9', 'blob:file:///eec371c0-f007-4906-a963-73ac0776c045', NULL, 'DA_RA', 'blob:file:///c11de4a4-b7f3-4897-8bb8-15b0aa9a53e8', '0'),
(424, '0008441096', '86B821322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '1997-07-09 14:18:58', '2025-07-09 14:19:38', 14726941, 'blob:file:///023f8bfc-f3a4-446e-927c-9ac2e905a0e5', 'blob:file:///188db1c1-c27f-41c6-9d73-337a77b36cd9', 306825000.00, 'DA_RA', 'blob:file:///13f49cc6-d32e-450d-8ad6-7b39596e7831', '0'),
(425, '121212121', '86B921322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 14:37:01', '2025-07-09 14:41:32', 60, 'license_plate_2025-07-09T07-37-01-013Z.jpg', 'license_plate_out_2025-07-09T07-41-32-348Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-09T07-37-22-552Z.jpg', '0'),
(426, '0008619047', '86BB21322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 14:38:01', '2025-07-09 14:38:28', 60, 'blob:file:///9de3b203-9a80-4bb3-afea-890b5dec76a9', 'blob:file:///def4f51c-b8e2-4a57-bffa-0b59bbfb990d', NULL, 'DA_RA', 'blob:file:///f4c817fc-8f88-4d01-be0f-791c84df1d19', '0'),
(427, '0008619047', '86BB21322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 14:39:19', '2025-07-09 14:39:24', 60, 'blob:file:///18af1928-124b-4901-810d-a1317b9c112c', 'blob:file:///20fe5460-c691-46e8-8eb7-907d3256de24', 15000.00, 'DA_RA', 'blob:file:///cfaab316-9e83-4de4-903d-63a1e72f64eb', '0'),
(428, '0008619047', '86BB21322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 14:39:47', '2025-07-09 14:40:35', 60, 'blob:file:///ed71188e-037a-436e-a2ed-dfec41eb95fb', 'blob:file:///0bbccb6e-d44d-420e-9d07-c62704f8b7d8', 15000.00, 'DA_RA', 'blob:file:///c043e261-b7e5-4563-81f6-819ab4284ca1', '0'),
(429, '0008619047', '86BB21322', NULL, 'CS_XE_BUS_16Th', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 14:41:17', '2025-07-09 14:41:30', 60, 'blob:file:///c1211a44-d3af-4eee-9b25-1e18009ef4dd', 'blob:file:///19561c98-3876-4907-b840-06b5ba1164ae', 0.00, 'DA_RA', 'blob:file:///ec2c504d-cd79-4112-9f67-8acac924b2dc', '0'),
(430, '0008619047', '86B821322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 14:42:32', '2025-07-09 14:42:47', 60, 'blob:file:///d7230675-aa0d-4c03-8b80-8bebb468e119', 'blob:file:///f7cec8f7-b0e3-475e-bc48-653084c1076b', 15000.00, 'DA_RA', 'blob:file:///df9b1e4b-0575-41e5-a149-5e5b50cbced0', '0'),
(431, '0008619047', '86B821322', NULL, 'CS_XE_BUS_16Th', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 14:43:39', '2025-07-09 14:43:50', 60, 'blob:file:///7648f55f-7db5-42a9-985f-6fc1bd2f6d7f', 'blob:file:///68088f03-589a-4686-82b5-cbb03e6f302c', 0.00, 'DA_RA', 'blob:file:///c2d2dded-7582-4a38-b876-926a86cd50f7', '0'),
(432, '1212121212', '77B134343', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 14:44:46', '2025-07-09 14:47:17', 60, 'license_plate_2025-07-09T07-44-46-076Z.jpg', 'license_plate_out_2025-07-09T07-47-17-579Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-09T07-45-05-319Z.jpg', '0'),
(433, '0008619047', '86BB21322', NULL, 'CS_XE_BUS_16Th', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 14:44:09', '2025-07-09 14:44:39', 60, 'blob:file:///b722a0ae-e68e-400e-bd49-8867a9aac632', 'blob:file:///55ace233-5ce6-4c1b-a493-1bac4dfab458', 0.00, 'DA_RA', 'blob:file:///fc37f434-12b7-4528-bc5f-336a2c27e3cd', '0'),
(434, '0008619047', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 14:45:16', '2025-07-09 14:45:28', 60, 'blob:file:///2da2afe4-34a7-44d0-bc3e-3c9eae70ac2a', 'blob:file:///b6be2ed6-8796-4af7-8fc3-92f909e4d220', NULL, 'DA_RA', 'blob:file:///8a0bdc51-9234-4499-9094-b099b487dac4', '0'),
(435, '0008619047', '86BB21322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 14:46:15', '2025-07-09 14:46:26', 60, 'blob:file:///9c2601a3-5b74-4964-9a26-6a27cfaa9e76', 'blob:file:///b8dfe791-e05d-4d6f-a4d7-0f6b3dd066d2', 15000.00, 'DA_RA', 'blob:file:///beabd233-0f97-48a4-bd92-f8c3bf06539d', '0'),
(436, '0008619047', '86BB21322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 14:47:00', '2025-07-09 14:47:03', 60, 'blob:file:///3da714bc-f151-453f-853e-0089f91b420e', 'blob:file:///8f2bff1a-2fe3-4057-a608-b80ad189fd64', 5000.00, 'DA_RA', 'blob:file:///c38ca376-a6d1-42d2-ae03-42913497d318', '0'),
(438, '0007486586', '86BB21322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 14:59:34', '2025-07-09 14:59:52', 60, 'blob:file:///c9fe1779-9066-401b-aaa4-384acf386ca7', 'blob:file:///2ab34c37-216d-4797-b68b-c1dfe16ce6e8', NULL, 'DA_RA', 'blob:file:///9f7c5170-956b-4c48-bbf0-dbedd51ca4be', '0'),
(439, '0007486586', '86BB21322', NULL, 'CS_XE_69CHO_BASE', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 15:01:50', '2025-07-09 15:03:03', 60, 'blob:file:///35ff8f85-b32d-4a0e-aa09-c720f6e4378d', 'blob:file:///7760f117-238c-4b71-80df-87821c3d8cfc', 0.00, 'DA_RA', 'blob:file:///69294993-752a-43f0-b1ed-df972ae7789e', '0'),
(440, '0007486586', '86BB21322', NULL, 'CS_XE_69CHO_BASE', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 15:36:27', '2025-07-09 15:37:19', 60, 'blob:file:///ab45179a-5d2a-4b99-8050-b6cfbe0e41f6', 'blob:file:///f423e36d-5c21-4170-8704-815d46a3ee16', 0.00, 'DA_RA', 'blob:file:///e378d8fa-dbc3-4c2d-98ae-727968192ec9', '0'),
(441, '0008611132', '86BB21322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 15:41:43', '2025-07-09 15:43:30', 60, 'http://192.168.1.19:9000/parking-lot-images/license_plate_2025-07-09T08-41-41-060Z.jpg', 'http://192.168.1.19:9000/parking-lot-images/license_plate_out_2025-07-09T08-43-29-239Z.jpg', NULL, 'DA_RA', 'http://192.168.1.19:9000/parking-lot-images/khuon_mat_2025-07-09T08-41-41-555Z.jpg', '0'),
(442, '0008611132', '86BB21322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 15:47:05', '2025-07-09 15:47:12', 60, 'http://192.168.1.19:9000/parking-lot-images/license_plate_2025-07-09T08-47-04-056Z.jpg', 'http://192.168.1.19:9000/parking-lot-images/license_plate_out_2025-07-09T08-47-11-593Z.jpg', NULL, 'DA_RA', 'http://192.168.1.19:9000/parking-lot-images/khuon_mat_2025-07-09T08-47-04-499Z.jpg', '0'),
(443, '0008611132', '86BB21322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 16:17:52', '2025-07-09 16:19:00', 60, 'http://192.168.1.19:9000/parking-lot-images/license_plate_2025-07-09T09-17-46-242Z.jpg', 'http://192.168.1.19:9000/parking-lot-images/license_plate_out_2025-07-09T09-18-53-145Z.jpg', NULL, 'DA_RA', 'http://192.168.1.19:9000/parking-lot-images/khuon_mat_2025-07-09T09-17-48-936Z.jpg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_10072025`
--

CREATE TABLE `pm_nc0009_10072025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(255) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

--
-- Dumping data for table `pm_nc0009_10072025`
--

INSERT INTO `pm_nc0009_10072025` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`, `lv008`, `lv009`, `lv010`, `lv011`, `lv012`, `lv013`, `lv014`, `lv015`, `lv016`) VALUES
(437, '30112003Bao', '81B164729', NULL, 'CS_XE_MAY_3T', 'GATE_IN1', 'GATE_OUT1', '2025-07-09 14:52:51', '2025-07-10 09:56:41', 1144, 'license_plate_2025-07-09T07-52-51-626Z.jpg', 'license_plate_out_2025-07-10T02-56-41-880Z.jpg', 0.00, 'DA_RA', 'khuon_mat_2025-07-09T07-53-09-020Z.jpg', '0'),
(444, '0008611132', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 10:04:56', '2025-07-10 10:05:31', 60, 'http://192.168.1.19:9000/parking-lot-images/license_plate_2025-07-10T03-04-54-531Z.jpg', 'http://192.168.1.19:9000/parking-lot-images/license_plate_out_2025-07-10T03-05-30-356Z.jpg', NULL, 'DA_RA', 'http://192.168.1.19:9000/parking-lot-images/khuon_mat_2025-07-10T03-04-55-135Z.jpg', '0'),
(445, '0008611132', '86B821322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 10:06:16', '2025-07-10 10:06:19', 60, 'http://192.168.1.19:9000/parking-lot-images/license_plate_2025-07-10T03-06-14-559Z.jpg', 'http://192.168.1.19:9000/parking-lot-images/license_plate_out_2025-07-10T03-06-18-301Z.jpg', 15000.00, 'DA_RA', 'http://192.168.1.19:9000/parking-lot-images/khuon_mat_2025-07-10T03-06-14-952Z.jpg', '0'),
(446, '77777777', '86BB21322', 'P0014', 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT2', '2025-07-10 10:10:28', '2025-07-10 10:14:12', 60, 'license_plate_2025-07-10T03-10-28-866Z.jpg', 'license_plate_out_2025-07-10T03-14-12-004Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T03-10-30-359Z.jpg', '0'),
(447, '0008611132', '86BB21322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 10:58:44', '2025-07-10 10:59:23', 60, 'license_plate_2025-07-10T03-58-41-984Z.jpg', 'http://192.168.1.19:9000/parking-lot-images/license_plate_out_2025-07-10T03-59-14-642Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T03-58-42-730Z.jpg', '0'),
(448, '0008611132', '86B821322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 10:59:50', '2025-07-10 11:00:15', 60, 'license_plate_2025-07-10T03-59-48-553Z.jpg', 'http://192.168.1.19:9000/parking-lot-images/license_plate_out_2025-07-10T04-00-07-299Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T03-59-48-945Z.jpg', '0'),
(449, '0008611132', '86BB21322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 11:03:17', '2025-07-10 11:25:20', 60, 'license_plate_2025-07-10T04-03-11-991Z.jpg', 'license_plate_out_2025-07-10T04-25-12-312Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T04-03-12-809Z.jpg', '0'),
(450, '0008611132', '86B821322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 11:25:27', '2025-07-10 11:26:12', 60, 'license_plate_2025-07-10T04-25-24-063Z.jpg', 'license_plate_out_2025-07-10T04-26-05-984Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T04-25-25-899Z.jpg', '0'),
(451, '0008611132', '86BB21322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 11:26:19', '2025-07-10 13:23:44', 117, 'license_plate_2025-07-10T04-26-17-829Z.jpg', 'license_plate_out_2025-07-10T06-23-32-366Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T04-26-18-184Z.jpg', '0'),
(452, '55555555', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 13:13:54', '2025-07-10 13:15:53', 60, 'license_plate_2025-07-10T06-13-54-267Z.jpg', 'license_plate_out_2025-07-10T06-15-53-297Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-10T06-14-03-458Z.jpg', '0'),
(453, '0008611132', '86B821322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 13:23:58', '2025-07-10 13:25:16', 60, 'license_plate_2025-07-10T06-23-56-174Z.jpg', 'license_plate_out_2025-07-10T06-25-13-642Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T06-23-56-913Z.jpg', '0'),
(454, '0008611132', '86B821322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 13:26:45', '2025-07-10 13:34:34', 60, 'license_plate_2025-07-10T06-26-39-644Z.jpg', 'license_plate_out_2025-07-10T06-34-30-895Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T06-26-40-080Z.jpg', '0'),
(455, '0008611132', '86B821322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 13:35:11', '2025-07-10 13:40:43', 60, 'license_plate_2025-07-10T06-35-10-110Z.jpg', 'license_plate_out_2025-07-10T06-40-43-816Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T06-35-10-834Z.jpg', '0'),
(457, '0008611132', '86B871322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 13:42:44', '2025-07-10 13:43:42', 60, 'license_plate_2025-07-10T06-42-43-273Z.jpg', 'license_plate_out_2025-07-10T06-43-25-386Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T06-42-43-612Z.jpg', '0'),
(458, '0008611132', '86B821322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 13:44:33', '2025-07-10 13:52:10', 60, 'license_plate_2025-07-10T06-44-32-077Z.jpg', 'license_plate_out_2025-07-10T06-52-09-174Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T06-44-32-484Z.jpg', '0'),
(459, '0008611132', '86B821322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 13:52:15', '2025-07-10 13:53:59', 60, 'license_plate_2025-07-10T06-52-14-113Z.jpg', 'license_plate_out_2025-07-10T06-53-50-307Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T06-52-14-458Z.jpg', '0'),
(460, '0008611132', '86B821322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 13:54:08', '2025-07-10 13:54:22', 60, 'license_plate_2025-07-10T06-54-02-494Z.jpg', 'license_plate_out_2025-07-10T06-54-18-328Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T06-54-04-151Z.jpg', '0'),
(461, '0008611132', '86B871322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 13:56:04', '2025-07-10 13:56:22', 60, 'license_plate_2025-07-10T06-56-03-519Z.jpg', 'license_plate_out_2025-07-10T06-56-13-267Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T06-56-03-884Z.jpg', '0'),
(462, '0008611132', '86B821322', 'P0001', 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 14:04:24', '2025-07-10 14:04:55', 60, 'license_plate_2025-07-10T07-04-23-180Z.jpg', 'license_plate_out_2025-07-10T07-04-53-268Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T07-04-23-606Z.jpg', '0'),
(463, '0008441096', '86B821322', 'P0001', 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 14:05:59', '2025-07-10 14:06:10', 60, 'license_plate_2025-07-10T07-05-58-072Z.jpg', 'license_plate_out_2025-07-10T07-06-08-545Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T07-05-58-429Z.jpg', '0'),
(464, '0008441096', '86B821322', 'P0001', 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 14:06:40', '2025-07-10 14:06:59', 60, 'license_plate_2025-07-10T07-06-38-994Z.jpg', 'license_plate_out_2025-07-10T07-06-57-744Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T07-06-39-613Z.jpg', '0'),
(465, '0008619047', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 14:07:36', '2025-07-10 14:07:45', 60, 'license_plate_2025-07-10T07-07-35-112Z.jpg', 'license_plate_out_2025-07-10T07-07-44-577Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-10T07-07-35-644Z.jpg', '0'),
(466, '0008611132', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 14:34:44', '2025-07-10 14:35:00', 60, 'license_plate_2025-07-10T07-34-43-209Z.jpg', 'license_plate_out_2025-07-10T07-34-59-354Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-10T07-34-43-732Z.jpg', '0'),
(467, '0008611132', '86B821329', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 14:51:58', '2025-07-10 14:52:11', 60, 'license_plate_2025-07-10T07-51-50-631Z.jpg', 'license_plate_out_2025-07-10T07-52-10-267Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-10T07-51-57-346Z.jpg', '0'),
(468, '0008611132', '86B821329', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 14:52:44', '2025-07-10 15:13:07', 60, 'license_plate_2025-07-10T07-52-41-634Z.jpg', 'license_plate_out_2025-07-10T08-12-53-045Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-10T07-52-42-200Z.jpg', '0'),
(469, '0008611132', '86B821122', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 15:13:15', '2025-07-10 15:13:33', 60, 'license_plate_2025-07-10T08-13-13-512Z.jpg', 'license_plate_out_2025-07-10T08-13-32-453Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-10T08-13-14-018Z.jpg', '0'),
(470, '0008611132', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 15:13:43', '2025-07-10 15:44:27', 60, 'license_plate_2025-07-10T08-13-42-389Z.jpg', 'license_plate_out_2025-07-10T08-44-25-885Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-10T08-13-42-696Z.jpg', '0'),
(471, '0008611132', '86B821322', 'P0001', 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 15:44:38', '2025-07-10 15:44:46', 60, 'license_plate_2025-07-10T08-44-36-766Z.jpg', 'license_plate_out_2025-07-10T08-44-45-643Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T08-44-37-053Z.jpg', '0'),
(472, '0008611132', '86B821328', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 15:45:15', '2025-07-10 15:45:28', 60, 'license_plate_2025-07-10T08-45-14-103Z.jpg', 'license_plate_out_2025-07-10T08-45-19-174Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-10T08-45-14-414Z.jpg', '0'),
(473, '0008611132', '86B821322', 'P0001', 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 15:48:41', '2025-07-10 15:48:55', 60, 'license_plate_2025-07-10T08-48-39-811Z.jpg', 'license_plate_out_2025-07-10T08-48-48-012Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-10T08-48-40-117Z.jpg', '0'),
(474, '0008611132', '86B821322', 'P0001', 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 15:49:07', '2025-07-10 15:49:27', 60, 'license_plate_2025-07-10T08-49-05-927Z.jpg', 'license_plate_out_2025-07-10T08-49-25-422Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-10T08-49-06-230Z.jpg', '0'),
(475, '0008611132', '86B821322', 'P0001', 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-10 15:50:04', '2025-07-10 15:50:10', 60, 'license_plate_2025-07-10T08-50-03-278Z.jpg', 'license_plate_out_2025-07-10T08-50-09-643Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-10T08-50-03-586Z.jpg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_11072025`
--

CREATE TABLE `pm_nc0009_11072025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(255) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

--
-- Dumping data for table `pm_nc0009_11072025`
--

INSERT INTO `pm_nc0009_11072025` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`, `lv008`, `lv009`, `lv010`, `lv011`, `lv012`, `lv013`, `lv014`, `lv015`, `lv016`) VALUES
(476, '123456789', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-11 15:10:21', '2025-07-11 15:29:29', 60, 'license_plate_2025-07-11T08-10-21-006Z.jpg', 'license_plate_out_2025-07-11T08-29-29-721Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-11T08-10-22-212Z.jpg', '0'),
(478, '33355555', '86BB21322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-11 15:27:36', '2025-07-11 15:30:23', 60, 'license_plate_2025-07-11T08-27-36-998Z.jpg', 'license_plate_out_2025-07-11T08-30-23-198Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-11T08-27-38-208Z.jpg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_12062025`
--

CREATE TABLE `pm_nc0009_12062025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(20) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

--
-- Dumping data for table `pm_nc0009_12062025`
--

INSERT INTO `pm_nc0009_12062025` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`, `lv008`, `lv009`, `lv010`, `lv011`, `lv012`, `lv013`, `lv014`, `lv015`, `lv016`) VALUES
(196, '0008445898', '86BB21322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-13 14:40:17', '2025-06-13 14:40:34', 60, 'server/images/0008445898_1749800416.jpg', 'server/images\0008445898_1749800430.jpg', NULL, 'DA_RA', '', '0'),
(197, '0002468477', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-13 16:17:31', '2025-06-13 16:17:44', 60, 'server/images/0002468477_1749806251.jpg', 'server/images\0002468477_1749806264.jpg', NULL, 'DA_RA', '', '0'),
(198, '0002468477', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-13 16:18:13', '2025-06-13 16:18:27', 60, 'server/images/0002468477_1749806292.jpg', 'server/images\0002468477_1749806303.jpg', NULL, 'DA_RA', '', '0'),
(199, '0002468477', '86BB21322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-13 16:18:36', '2025-06-13 16:18:45', 60, 'server/images/0002468477_1749806316.jpg', 'server/images\0002468477_1749806325.jpg', NULL, 'DA_RA', '', '0'),
(200, '0002468477', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-13 16:19:49', '2025-06-13 16:44:39', 60, 'server/images/0002468477_1749806389.jpg', 'server/images\0002468477_1749807879.jpg', NULL, 'DA_RA', '', '0'),
(201, '0002468477', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-13 16:44:49', '2025-06-13 16:45:29', 60, 'server/images/0002468477_1749807888.jpg', 'server/images\0002468477_1749807925.jpg', NULL, 'DA_RA', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_13062025`
--

CREATE TABLE `pm_nc0009_13062025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(20) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

--
-- Dumping data for table `pm_nc0009_13062025`
--

INSERT INTO `pm_nc0009_13062025` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`, `lv008`, `lv009`, `lv010`, `lv011`, `lv012`, `lv013`, `lv014`, `lv015`, `lv016`) VALUES
(217, '0002468477', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-14 14:37:57', '2025-06-14 14:45:19', 60, 'server/images/0002468477_1749886677.jpg', 'server/images\0002468477_1749887119.jpg', NULL, 'DA_RA', '', '0'),
(218, '0002468477', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-14 14:45:24', '2025-06-14 14:45:35', 60, 'server/images/0002468477_1749887124.jpg', 'server/images\0002468477_1749887135.jpg', NULL, 'DA_RA', '', '0'),
(219, '0002468477', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-14 14:46:16', '2025-06-14 14:46:20', 60, 'server/images/0002468477_1749887175.jpg', 'server/images\0002468477_1749887179.jpg', NULL, 'DA_RA', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_13072025`
--

CREATE TABLE `pm_nc0009_13072025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(255) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_14072025`
--

CREATE TABLE `pm_nc0009_14072025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(255) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_15062025`
--

CREATE TABLE `pm_nc0009_15062025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(20) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

--
-- Dumping data for table `pm_nc0009_15062025`
--

INSERT INTO `pm_nc0009_15062025` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`, `lv008`, `lv009`, `lv010`, `lv011`, `lv012`, `lv013`, `lv014`, `lv015`, `lv016`) VALUES
(220, '0002468477', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-14 14:46:26', '2025-06-14 15:02:51', 60, 'server/images/0002468477_1749887186.jpg', 'server/images\0002468477_1749888171.jpg', NULL, 'DA_RA', '', '0'),
(221, '0002468477', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-14 15:02:57', '2025-06-14 15:07:06', 60, 'server/images/0002468477_1749888177.jpg', 'server/images\0002468477_1749888425.jpg', NULL, 'DA_RA', '', '0'),
(222, '0002468477', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-14 15:07:45', '2025-06-14 15:07:52', 60, 'server/images/0002468477_1749888465.jpg', 'server/images\0002468477_1749888472.jpg', NULL, 'DA_RA', '', '0'),
(223, '0002468477', '86B821322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-14 15:11:46', '2025-06-14 15:12:09', 60, 'server/images/0002468477_1749888706.jpg', 'server/images\0002468477_1749888729.jpg', NULL, 'DA_RA', '', '0'),
(224, '0002468477', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-14 15:42:39', '2025-06-14 15:42:54', 60, 'server/images/0002468477_1749890558.jpg', 'server/images\0002468477_1749890571.jpg', NULL, 'DA_RA', '', '0'),
(225, '0002468477', '86B821322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-14 15:43:05', '2025-06-14 15:43:13', 60, 'server/images/0002468477_1749890585.jpg', 'server/images\0002468477_1749890590.jpg', NULL, 'DA_RA', '', '0'),
(226, '0002468477', '86B821322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-14 15:43:23', '2025-06-14 15:43:31', 60, 'server/images/0002468477_1749890603.jpg', 'server/images\0002468477_1749890606.jpg', NULL, 'DA_RA', '', '0'),
(227, '30112003', '86B823322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-14 15:52:37', '2025-06-14 16:00:14', 60, 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image3801900010641017969.jpg', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image6508186060787633637.jpg', 5000.00, 'DA_RA', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image6444738811474917233.jpg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_15072025`
--

CREATE TABLE `pm_nc0009_15072025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(255) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

--
-- Dumping data for table `pm_nc0009_15072025`
--

INSERT INTO `pm_nc0009_15072025` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`, `lv008`, `lv009`, `lv010`, `lv011`, `lv012`, `lv013`, `lv014`, `lv015`, `lv016`) VALUES
(484, '043507A34F6180', '17AD88888', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-15 10:31:25', '2025-07-15 10:46:50', 60, 'license_plate_2025-07-15T03-31-25-697Z.jpg', 'license_plate_out_2025-07-15T03-46-50-641Z.jpg', 5000.00, 'DA_RA', 'khuon_mat_2025-07-15T03-31-28-335Z.jpg', '0'),
(485, '043507A34F6180', '86B399999', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-15 10:57:59', '2025-07-15 10:58:41', 60, 'license_plate_2025-07-15T03-57-59-901Z.jpg', 'license_plate_out_2025-07-15T03-58-41-430Z.jpg', NULL, 'DA_RA', 'khuon_mat_2025-07-15T03-58-02-182Z.jpg', 'khuon_mat_out_2025-07-15T03-58-43-771Z.jpg'),
(486, '0008441096', '86B821322', NULL, 'CS_OTO_4H', 'GATE_IN1', 'GATE_OUT1', '2025-07-15 11:21:44', '2025-07-15 11:21:51', 60, 'license_plate_2025-07-15T04-21-42-938Z.jpg', 'license_plate_out_2025-07-15T04-21-50-481Z.jpg', 15000.00, 'DA_RA', 'khuon_mat_2025-07-15T04-21-43-460Z.jpg', 'khuon_mat_2025-07-15T04-21-50-823Z.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_16062025`
--

CREATE TABLE `pm_nc0009_16062025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(20) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

--
-- Dumping data for table `pm_nc0009_16062025`
--

INSERT INTO `pm_nc0009_16062025` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`, `lv008`, `lv009`, `lv010`, `lv011`, `lv012`, `lv013`, `lv014`, `lv015`, `lv016`) VALUES
(262, '0008530271', '86BB21322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-16 13:40:32', '2025-06-16 13:40:53', 60, 'server/images/0008530271_1750056032.jpg', 'server/images\0008530271_1750056049.jpg', 5000.00, 'DA_RA', '', '0'),
(263, '64737478292', '86BB21322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-16 14:04:03', '2025-06-16 14:07:25', 60, 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image5802195392962089814.jpg', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image7180488601162541841.jpg', 5000.00, 'DA_RA', '', '0'),
(264, '0002468477', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-16 14:53:05', '2025-06-16 14:54:16', 60, 'server/images/0002468477_1750060384.jpg', 'server/images\0002468477_1750060452.jpg', 5000.00, 'DA_RA', '', '0'),
(265, '0002468477', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-16 14:54:25', '2025-06-16 14:54:32', 60, 'server/images/0002468477_1750060465.jpg', 'server/images\0002468477_1750060468.jpg', 5000.00, 'DA_RA', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_17062025`
--

CREATE TABLE `pm_nc0009_17062025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(20) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

--
-- Dumping data for table `pm_nc0009_17062025`
--

INSERT INTO `pm_nc0009_17062025` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`, `lv008`, `lv009`, `lv010`, `lv011`, `lv012`, `lv013`, `lv014`, `lv015`, `lv016`) VALUES
(268, '0008441096', '63AN08327', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-17 14:23:27', '2025-06-17 14:27:06', 60, 'server/images/0008441096_1750145006.jpg', 'server/images\0008441096_1750145219.jpg', 5000.00, 'DA_RA', '', '0'),
(269, '0008441096', '63AN08327', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-17 14:27:13', '2025-06-17 14:27:38', 60, 'server/images/0008441096_1750145232.jpg', 'server/images\0008441096_1750145258.jpg', 5000.00, 'DA_RA', '', '0'),
(270, '0008441096', '63AN16327', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-17 14:27:57', '2025-06-17 14:28:05', 60, 'server/images/0008441096_1750145277.jpg', 'server/images\0008441096_1750145280.jpg', 5000.00, 'DA_RA', '', '0'),
(271, '0008441096', '63AN18327', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-17 14:31:53', '2025-06-17 14:32:01', 60, 'server/images/0008441096_1750145513.jpg', 'server/images\0008441096_1750145516.jpg', 5000.00, 'DA_RA', '', '0'),
(272, '0008441096', '63AN18327', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-17 15:09:55', '2025-06-17 15:10:05', 60, 'server/images/0008441096_1750147795.jpg', 'server/images\0008441096_1750147799.jpg', 5000.00, 'DA_RA', '', '0'),
(273, '0008441096', '63AN16327', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-17 15:14:31', '2025-06-17 15:14:39', 60, 'server/images/0008441096_1750148071.jpg', 'server/images\0008441096_1750148075.jpg', 5000.00, 'DA_RA', '', '0'),
(274, '0008441096', '63AN18327', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-17 15:19:23', '2025-06-17 15:19:31', 60, 'server/images/0008441096_1750148363.jpg', 'server/images\0008441096_1750148367.jpg', 5000.00, 'DA_RA', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_18062025`
--

CREATE TABLE `pm_nc0009_18062025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(20) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

--
-- Dumping data for table `pm_nc0009_18062025`
--

INSERT INTO `pm_nc0009_18062025` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`, `lv008`, `lv009`, `lv010`, `lv011`, `lv012`, `lv013`, `lv014`, `lv015`, `lv016`) VALUES
(266, '0008611132', '86BB21322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-16 15:19:32', '2025-06-18 15:03:35', 2864, 'server/images/0008611132_1750061971.jpg', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image7695777403250659190.jpg', 5000.00, 'DA_RA', '', '0'),
(276, '11111111111', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-18 15:53:09', '2025-06-18 15:53:48', 60, 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image8667967014967968714.jpg', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image7550743918311183016.jpg', 5000.00, 'DA_RA', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image5665995808875364278.jpg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_19062025`
--

CREATE TABLE `pm_nc0009_19062025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(20) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_22062025`
--

CREATE TABLE `pm_nc0009_22062025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(20) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

--
-- Dumping data for table `pm_nc0009_22062025`
--

INSERT INTO `pm_nc0009_22062025` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`, `lv008`, `lv009`, `lv010`, `lv011`, `lv012`, `lv013`, `lv014`, `lv015`, `lv016`) VALUES
(281, '1234567890', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-20 16:08:56', '2025-06-20 16:10:15', 60, 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image7597533278511680189.jpg', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image6409335436412798940.jpg', 5000.00, 'DA_RA', '', '0'),
(282, '30112003', '86B821322', NULL, 'CS_XEMAY_4H', 'GATE_IN1', 'GATE_OUT1', '2025-06-20 16:40:06', '2025-06-20 16:52:45', 60, 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image2045904618515092851.jpg', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image6415815867309391316.jpg', 50234500.00, 'DA_RA', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0009_30062025`
--

CREATE TABLE `pm_nc0009_30062025` (
  `lv001` int(11) NOT NULL,
  `lv002` varchar(100) NOT NULL COMMENT 'UID thẻ (FK → pm_nc0003.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Biển số (FK → pm_nc0002.lv001)',
  `lv004` varchar(20) DEFAULT NULL COMMENT 'Mã vị trí gửi (FK → pm_nc0005.lv001)',
  `lv005` varchar(255) DEFAULT NULL COMMENT 'Mã chính sách giá (FK → pm_nc0008.lv001)',
  `lv006` varchar(20) DEFAULT NULL COMMENT 'Mã cổng vào (FK → pm_nc0007.lv001)',
  `lv007` varchar(20) DEFAULT NULL COMMENT 'Mã cổng ra (FK → pm_nc0007.lv001)',
  `lv008` datetime NOT NULL COMMENT 'Thời gian vào',
  `lv009` datetime DEFAULT NULL COMMENT 'Thời gian ra',
  `lv010` int(11) DEFAULT NULL COMMENT 'Tổng phút gửi',
  `lv011` varchar(255) NOT NULL COMMENT 'Ảnh biển số lúc vào',
  `lv012` varchar(255) DEFAULT NULL COMMENT 'Ảnh biển số lúc ra',
  `lv013` decimal(12,2) DEFAULT NULL COMMENT 'Phí tính được',
  `lv014` enum('DANG_GUI','DA_RA','DANG_XU_LY') NOT NULL DEFAULT 'DANG_GUI' COMMENT 'Trạng thái phiên',
  `lv015` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc vào',
  `lv016` varchar(255) DEFAULT NULL COMMENT 'Ảnh khuôn mặt người gửi lúc ra'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu trữ phiên gửi/ra xe';

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0010`
--

CREATE TABLE `pm_nc0010` (
  `lv001` bigint(20) NOT NULL COMMENT 'ID bản ghi',
  `lv002` int(11) NOT NULL COMMENT 'Mã phiên (FK → pm_nc0009.lv001)',
  `lv003` varchar(20) NOT NULL COMMENT 'Mã camera (FK → pm_nc0006.lv001)',
  `lv004` datetime NOT NULL COMMENT 'Thời gian quét',
  `lv005` varchar(255) NOT NULL COMMENT 'Ảnh biển số chụp',
  `lv006` tinyint(1) NOT NULL COMMENT 'Kết quả so khớp biển số',
  `lv007` varchar(200) DEFAULT NULL COMMENT 'Ghi chú thêm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Nhật ký quét thẻ và ANPR';

--
-- Dumping data for table `pm_nc0010`
--

INSERT INTO `pm_nc0010` (`lv001`, `lv002`, `lv003`, `lv004`, `lv005`, `lv006`, `lv007`) VALUES
(489, 333, 'CAM1', '2025-07-04 11:50:52', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image7155505837688678291.jpg', 1, 'entry'),
(490, 334, 'CAM1', '2025-07-04 11:52:13', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image4994385689831740677.jpg', 1, 'entry'),
(491, 335, 'CAM1', '2025-07-04 11:52:49', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image4555064072269053239.jpg', 1, 'entry'),
(492, 336, 'CAM1', '2025-07-04 15:05:44', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image3130459047683088605.jpg', 1, 'entry'),
(493, 334, 'CAM2', '2025-07-07 01:14:36', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', 1, 'exit'),
(494, 337, 'CAM1', '2025-07-07 01:27:50', 'blob:file:///dccd0749-a235-4713-a6c5-ee6250e1376f', 1, 'entry'),
(495, 337, 'CAM2', '2025-07-07 01:27:55', 'blob:file:///52fad98f-22c1-4b08-b58d-bf9e5740313c', 1, 'exit'),
(496, 338, 'CAM1', '2025-07-07 01:34:16', 'blob:file:///e8d4213e-4651-4ae3-9611-02dd8e445c9a', 1, 'entry'),
(497, 338, 'CAM2', '2025-07-07 01:35:02', 'blob:file:///5e88c0ce-cad9-439f-86eb-01c7d02d0b97', 1, 'exit'),
(498, 339, 'CAM1', '2025-07-07 01:35:13', 'blob:file:///bbc3fcb7-91c4-4621-9dce-fef30d788a70', 1, 'entry'),
(499, 339, 'CAM2', '2025-07-07 01:35:23', 'blob:file:///7a77edde-160a-46e0-9460-018995ba23c4', 1, 'exit'),
(500, 340, 'CAM1', '2025-07-07 01:36:30', 'blob:file:///7e2f3121-640a-48df-b31f-8236a31431c4', 1, 'entry'),
(501, 340, 'CAM2', '2025-07-07 01:37:33', 'blob:file:///82c6c70e-ae12-4fc7-9bf5-1d8545b8ed34', 1, 'exit'),
(502, 341, 'CAM1', '2025-07-07 02:20:26', 'blob:file:///1a7af3a9-6984-477a-8248-5aa9e8fc4b0a', 1, 'entry'),
(503, 341, 'CAM2', '2025-07-07 02:20:49', 'blob:file:///30ff5255-8a08-4b1b-959f-4da1d4af39a3', 1, 'exit'),
(504, 342, 'CAM1', '2025-07-07 02:21:21', 'blob:file:///3df20a88-0fcc-4696-b804-bc66579baf49', 1, 'entry'),
(505, 342, 'CAM2', '2025-07-07 02:21:31', 'blob:file:///762ce483-31ca-418f-b9de-718565f98f42', 1, 'exit'),
(506, 343, 'CAM1', '2025-07-07 02:23:30', 'blob:file:///e7126ed6-0528-4e9a-9be7-6d186fec4cf7', 1, 'entry'),
(507, 343, 'CAM2', '2025-07-07 02:23:38', 'blob:file:///8776cdc7-a719-4004-97ce-e7e7d42fcb87', 1, 'exit'),
(508, 344, 'CAM1', '2025-07-07 02:24:54', 'blob:file:///e4db4130-844c-4dca-9eae-74ed25b3d2cd', 1, 'entry'),
(509, 344, 'CAM2', '2025-07-07 02:25:04', 'blob:file:///f5506c13-c639-43a5-9611-75816c3eda0b', 1, 'exit'),
(510, 345, 'CAM1', '2025-07-07 02:55:30', 'blob:file:///4526eaa1-69b5-4973-b747-1aad71a20f19', 1, 'entry'),
(511, 345, 'CAM2', '2025-07-07 02:56:06', 'blob:file:///b30f9e81-1dd8-42c8-b1d2-79d518aa3efe', 1, 'exit'),
(512, 346, 'CAM1', '2025-07-07 03:42:14', 'blob:file:///fece62b3-ba75-4484-af7b-386a1f56c2ad', 1, 'entry'),
(513, 346, 'CAM2', '2025-07-07 03:42:26', 'blob:file:///713731e5-e15f-46cc-8a5e-4af3aa22bff1', 1, 'exit'),
(514, 347, 'CAM1', '2025-07-07 03:42:46', 'blob:file:///1331c24b-a79a-4617-a170-6870a08daec0', 1, 'entry'),
(515, 347, 'CAM2', '2025-07-07 03:42:52', 'blob:file:///4bfb7412-f865-405c-ae58-43a35bf36426', 1, 'exit'),
(516, 348, 'CAM1', '2025-07-07 03:54:10', 'blob:file:///3eda2c0a-50e2-4ee2-bb34-609175557881', 1, 'entry'),
(517, 348, 'CAM2', '2025-07-07 03:54:45', 'blob:file:///1d5b2189-9d25-429c-990c-947c45a9ee6a', 1, 'exit'),
(518, 349, 'CAM1', '2025-07-07 03:56:33', 'blob:file:///1cb6b56e-5760-4c49-98c6-3e4ed29120b9', 1, 'entry'),
(519, 349, 'CAM2', '2025-07-07 03:56:47', 'blob:file:///f52917e5-f94a-4c47-9d9b-5d90d57dad72', 1, 'exit'),
(520, 350, 'CAM1', '2025-07-07 03:56:57', 'blob:file:///33e52737-5eec-47d3-88fe-a031451ec125', 1, 'entry'),
(521, 350, 'CAM2', '2025-07-07 03:57:15', 'blob:file:///a15c5481-db5e-4c07-99ca-8a8ea6ec5648', 1, 'exit'),
(522, 351, 'CAM1', '2025-07-07 04:02:19', 'blob:file:///dff1e34e-132e-479a-b886-2753eaa5ebfa', 1, 'entry'),
(523, 351, 'CAM2', '2025-07-07 04:02:37', 'blob:file:///777d6a78-64bc-4404-a893-400d1f5866b3', 1, 'exit'),
(524, 352, 'CAM1', '2025-07-07 04:02:43', 'blob:file:///82d50f27-0131-4ca7-afdf-feb416d4d657', 1, 'entry'),
(525, 352, 'CAM2', '2025-07-07 04:02:56', 'blob:file:///1098f554-4f73-4470-a8bb-10f4609cb46d', 1, 'exit'),
(526, 353, 'CAM1', '2025-07-07 06:45:17', 'blob:file:///cf87466a-35a3-478a-9fad-ed4846505b2c', 1, 'entry'),
(527, 353, 'CAM2', '2025-07-07 06:46:08', 'blob:file:///7910197c-655e-4bfb-8e6a-28e2a25d26fb', 1, 'exit'),
(528, 354, 'CAM1', '2025-07-07 07:02:04', 'blob:file:///bb24fefe-fbc1-4288-906a-2c23d5044360', 1, 'entry'),
(529, 354, 'CAM2', '2025-07-07 07:04:23', 'blob:file:///bf7b65ca-bc6e-4e6a-b982-af79f1db6d52', 1, 'exit'),
(530, 355, 'CAM1', '2025-07-07 07:36:48', 'blob:file:///9a28a5df-5498-46da-9aba-47a0f36c5056', 1, 'entry'),
(531, 355, 'CAM2', '2025-07-07 07:37:05', 'blob:file:///a92697ef-3561-43a0-bbaf-a371549a37bd', 1, 'exit'),
(532, 356, 'CAM1', '2025-07-07 14:42:54', 'blob:file:///cb147406-56f7-4e9c-a60b-775d7ad58284', 1, 'entry'),
(533, 356, 'CAM2', '2025-07-07 14:43:07', 'blob:file:///3a139e9e-129b-4e5f-9cc5-90dbd4028607', 1, 'exit'),
(534, 357, 'CAM1', '2025-07-07 14:56:22', 'blob:file:///7236d30c-50a8-49ce-814c-67005ca5a02f', 1, 'entry'),
(535, 357, 'CAM2', '2025-07-07 14:56:35', 'blob:file:///7aa84f0e-7fd3-49ee-85a8-230ee551d368', 1, 'exit'),
(536, 358, 'CAM1', '2025-07-07 15:58:25', 'license_plate_2025-07-07T08-56-27-358Z.jpg', 1, 'entry'),
(537, 358, 'CAM2', '2025-07-07 16:01:54', 'license_plate_2025-07-07T08-59-04-047Z.jpg', 1, 'exit'),
(538, 359, 'CAM1', '2025-07-07 16:03:26', 'license_plate_2025-07-07T09-02-38-700Z.jpg', 1, 'entry'),
(539, 359, 'CAM2', '2025-07-07 16:04:55', 'blob:file:///f9e69b9e-deb5-40d5-8a5a-e4317af9c6eb', 1, 'exit'),
(540, 360, 'CAM1', '2025-07-07 16:05:09', 'blob:file:///8f5ed5b8-c8d6-4485-92af-ac6959098aaa', 1, 'entry'),
(541, 360, 'CAM2', '2025-07-07 16:05:15', 'blob:file:///0a149186-0208-49ca-ba29-7e6781359d76', 1, 'exit'),
(542, 361, 'CAM1', '2025-07-07 16:05:49', 'blob:file:///f517a191-aea6-4959-84d6-98ace03addaf', 1, 'entry'),
(543, 361, 'CAM2', '2025-07-07 16:08:20', 'blob:file:///eb06c4c7-1daf-4f54-9aa5-3d1915fe9263', 1, 'exit'),
(544, 362, 'CAM1', '2025-07-07 16:15:23', 'license_plate_2025-07-07T09-14-14-766Z.jpg', 1, 'entry'),
(545, 362, 'CAM2', '2025-07-07 16:17:54', 'license_plate_2025-07-07T09-17-16-280Z.jpg', 1, 'exit'),
(546, 363, 'CAM1', '2025-07-07 16:18:16', 'blob:file:///8daf21fc-97c3-4b8a-8a8d-34dcb931cc84', 1, 'entry'),
(547, 363, 'CAM2', '2025-07-07 16:18:52', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNj', 1, 'exit'),
(548, 364, 'CAM1', '2025-07-07 16:20:58', 'license_plate_2025-07-07T09-20-05-899Z.jpg', 1, 'entry'),
(549, 364, 'CAM2', '2025-07-07 16:22:43', 'license_plate_2025-07-07T09-21-43-267Z.jpg', 1, 'exit'),
(550, 365, 'CAM1', '2025-07-08 09:09:49', 'blob:file:///d8cae387-6e7a-43b8-9e10-fa3aa59b686f', 1, 'entry'),
(551, 365, 'CAM2', '2025-07-08 09:17:13', 'blob:file:///555e67db-407d-40f6-a237-cc2a3d8023ae', 1, 'exit'),
(552, 366, 'CAM1', '2025-07-08 09:19:20', 'blob:file:///a94dd2b8-4d13-4f56-b08b-b66a49be573b', 1, 'entry'),
(553, 366, 'CAM2', '2025-07-08 09:19:50', 'blob:file:///aa1ca259-4e3a-4a17-b5e5-90ba8c4dacf6', 1, 'exit'),
(554, 367, 'CAM1', '2025-07-08 09:35:08', 'blob:file:///b4331e6a-5de7-4ad5-b0c6-6c4e6d32ba59', 1, 'entry'),
(555, 367, 'CAM2', '2025-07-08 09:35:18', 'blob:file:///2b101df0-c456-4f98-9be8-3c33d955afc7', 1, 'exit'),
(556, 368, 'CAM1', '2025-07-08 09:36:03', 'blob:file:///ce80b15a-3eb2-4706-84a1-7058c7fb2b68', 1, 'entry'),
(557, 368, 'CAM2', '2025-07-08 09:37:34', 'blob:file:///68dd8aa5-e242-48ec-ad5a-3de0a65bb264', 1, 'exit'),
(558, 369, 'CAM1', '2025-07-08 09:37:47', 'blob:file:///f8e4b84d-4b62-4bbe-95b6-e409548f8377', 1, 'entry'),
(559, 369, 'CAM2', '2025-07-08 09:38:08', 'blob:file:///79b7302a-1076-48f0-8bdd-5579965f6890', 1, 'exit'),
(560, 370, 'CAM1', '2025-07-08 09:43:17', 'blob:file:///126c6799-ac7f-4879-9234-f58451413803', 1, 'entry'),
(561, 370, 'CAM2', '2025-07-08 09:43:50', 'blob:file:///c00bb903-25f9-4f24-9684-2cea0cfc4a02', 1, 'exit'),
(562, 371, 'CAM1', '2025-07-08 09:47:17', 'blob:file:///8e3f2525-f897-4658-90a5-d8922ace1203', 1, 'entry'),
(563, 371, 'CAM2', '2025-07-08 09:47:58', 'blob:file:///6521a166-a008-4195-9b53-0b1209ce4373', 1, 'exit'),
(564, 372, 'CAM1', '2025-07-08 09:48:23', 'blob:file:///f1e297b2-6570-4e12-9afb-b43f2c94292b', 1, 'entry'),
(565, 372, 'CAM2', '2025-07-08 09:48:32', 'blob:file:///56e84e47-6c90-4528-81df-3644942acc33', 1, 'exit'),
(566, 373, 'CAM1', '2025-07-08 11:05:52', 'blob:file:///e4714544-cdbc-46f5-9bd3-47e2bcf97ac9', 1, 'entry'),
(567, 373, 'CAM2', '2025-07-08 11:07:48', 'blob:file:///11cebe54-db65-496f-ac55-3e6876e230f4', 1, 'exit'),
(568, 374, 'CAM1', '2025-07-08 11:08:27', 'blob:file:///7a2ffdbf-8b21-4eea-921e-d508c282b80b', 1, 'entry'),
(569, 374, 'CAM2', '2025-07-08 11:09:15', 'blob:file:///1f58f905-9eed-4eb6-8dcd-e97f476b4ca8', 1, 'exit'),
(570, 375, 'CAM1', '2025-07-08 11:47:44', 'blob:file:///6aca9322-0125-469a-80e9-4477ab466179', 1, 'entry'),
(571, 375, 'CAM2', '2025-07-08 11:48:50', 'blob:file:///462cdd2f-6cef-4839-a18f-51995cba3a0b', 1, 'exit'),
(572, 376, 'CAM1', '2025-07-08 14:27:50', 'license_plate_2025-07-08T07-27-50-459Z.jpg', 1, 'entry'),
(573, 377, 'CAM1', '2025-07-08 14:38:35', 'blob:file:///eaaed3a7-4cb7-4ea8-99c7-3cbf9d70955a', 1, 'entry'),
(574, 377, 'CAM2', '2025-07-08 14:40:22', 'blob:file:///99e3c2ad-ceb2-4cdb-ba41-e5643f1e02cd', 1, 'exit'),
(575, 376, 'CAM2', '2025-07-08 14:45:56', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image6328183578025764428.jpg', 1, 'exit'),
(576, 378, 'CAM1', '2025-07-08 14:44:45', 'blob:file:///4870ca18-713b-440a-bca1-76a4a3889dfe', 1, 'entry'),
(577, 378, 'CAM2', '2025-07-08 14:44:58', 'blob:file:///8af0f554-0d30-4db1-97c1-33084159b0ee', 1, 'exit'),
(578, 379, 'CAM1', '2025-07-08 14:48:41', 'blob:file:///4b8a8491-83c5-4cd9-8acb-22888bda3b72', 1, 'entry'),
(579, 379, 'CAM2', '2025-07-08 14:48:46', 'blob:file:///e840abef-9f51-4a8b-a0bb-db2b6ed41166', 1, 'exit'),
(580, 380, 'CAM1', '2025-07-08 15:07:05', 'license_plate_2025-07-08T08-07-05-577Z.jpg', 1, 'entry'),
(581, 380, 'CAM2', '2025-07-08 15:09:29', 'file:///data/user/0/com.parkinglot_appmobile/cache/ReactNative-snapshot-image55034575532172294.jpg', 1, 'exit'),
(582, 381, 'CAM1', '2025-07-08 15:15:26', 'license_plate_2025-07-08T08-15-26-621Z.jpg', 1, 'entry'),
(583, 381, 'CAM2', '2025-07-08 15:16:39', 'license_plate_out_2025-07-08T08-16-39-730Z.jpg', 1, 'exit'),
(584, 382, 'CAM1', '2025-07-08 15:21:58', 'blob:file:///f395d0c3-5c0b-4ac1-af2d-a27d0cbb1e6a', 1, 'entry'),
(585, 382, 'CAM2', '2025-07-08 15:22:03', 'blob:file:///13e228a6-5ccc-4484-b703-3de19b9dc921', 1, 'exit'),
(586, 383, 'CAM1', '2025-07-08 15:22:16', 'blob:file:///6d35485e-5feb-43dc-9187-1d36b161fc79', 1, 'entry'),
(587, 383, 'CAM2', '2025-07-08 15:22:20', 'blob:file:///33d67e0c-e34e-474f-83d0-feddb9e19198', 1, 'exit'),
(588, 384, 'CAM1', '2025-07-08 15:27:19', 'blob:file:///9d5ad86c-b26b-48ac-b432-9b4fb37c5b5e', 1, 'entry'),
(589, 384, 'CAM2', '2025-07-08 15:27:23', 'blob:file:///7315607f-5706-450d-b613-4838782ac5a0', 1, 'exit'),
(590, 385, 'CAM1', '2025-07-08 15:27:32', 'blob:file:///f48fe544-0f2c-4180-a137-8dd8904001d5', 1, 'entry'),
(591, 385, 'CAM2', '2025-07-08 15:27:49', 'blob:file:///ffa08bd7-3353-44f9-8c6a-7c3b34c3c4e9', 1, 'exit'),
(592, 386, 'CAM1', '2025-07-08 15:38:18', 'license_plate_2025-07-08T08-38-18-406Z.jpg', 1, 'entry'),
(593, 387, 'CAM1', '2025-07-08 16:22:53', 'license_plate_2025-07-08T09-22-53-885Z.jpg', 1, 'entry'),
(594, 387, 'CAM2', '2025-07-08 16:24:59', 'license_plate_out_2025-07-08T09-24-59-629Z.jpg', 1, 'exit'),
(595, 386, 'CAM2', '2025-07-08 16:29:30', 'blob:file:///115999d8-aa7e-4f18-bf25-5d257408aee6', 1, 'exit'),
(596, 388, 'CAM1', '2025-07-08 16:31:01', 'license_plate_2025-07-08T09-31-01-561Z.jpg', 1, 'entry'),
(597, 388, 'CAM2', '2025-07-08 16:31:50', 'license_plate_out_2025-07-08T09-31-50-452Z.jpg', 1, 'exit'),
(598, 389, 'CAM1', '2025-07-08 16:30:21', 'blob:file:///ce7144bb-56ab-4931-8472-9406e8520903', 1, 'entry'),
(599, 389, 'CAM2', '2025-07-08 16:30:25', 'blob:file:///6f4e652b-2310-47ae-8625-7f65e8bf52d0', 1, 'exit'),
(600, 390, 'CAM1', '2025-07-08 16:30:34', 'blob:file:///7e33fd95-90c0-402b-9b07-0b077d8479bf', 1, 'entry'),
(601, 390, 'CAM2', '2025-07-08 16:30:48', 'blob:file:///ac06b325-982e-415b-ab1b-430a2d5c6d12', 1, 'exit'),
(602, 391, 'CAM1', '2025-07-08 16:31:11', 'blob:file:///6d5cb159-978b-44ee-b0d1-6b52bc3f9d65', 1, 'entry'),
(603, 391, 'CAM2', '2025-07-08 16:31:23', 'blob:file:///bb3a3513-7591-40a1-970d-f63ae9b1b413', 1, 'exit'),
(604, 392, 'CAM1', '2025-07-08 16:31:41', 'blob:file:///9ea48b6b-a33f-42ce-8347-460660e6143a', 1, 'entry'),
(605, 392, 'CAM2', '2025-07-08 16:31:46', 'blob:file:///4cb5423a-796d-405c-b90a-eff1ca845418', 1, 'exit'),
(606, 393, 'CAM1', '2025-07-08 16:32:07', 'blob:file:///541bde3c-e036-4a42-bb49-cc870e3b0a5e', 1, 'entry'),
(607, 393, 'CAM2', '2025-07-08 16:32:18', 'blob:file:///b67065d4-7bb3-4ea3-a247-656a4c12da6c', 1, 'exit'),
(608, 394, 'CAM1', '2025-07-08 16:32:41', 'blob:file:///f5689142-9710-4f22-9c09-df9266fb63a7', 1, 'entry'),
(609, 394, 'CAM2', '2025-07-08 16:32:49', 'blob:file:///ea494f7b-60c7-414e-b078-7f19905812bc', 1, 'exit'),
(610, 395, 'CAM1', '2025-07-08 16:40:07', 'blob:file:///05a6f7bc-892e-40a1-a0af-c06e6fb056b8', 1, 'entry'),
(611, 395, 'CAM2', '2025-07-08 16:40:14', 'blob:file:///30e38764-e592-4671-a229-dddb43f72634', 1, 'exit'),
(612, 396, 'CAM1', '2025-07-08 16:40:20', 'blob:file:///f0c77b81-afb0-4f0b-9859-3f71a577c263', 1, 'entry'),
(613, 396, 'CAM2', '2025-07-08 16:40:24', 'blob:file:///aeb2a146-11d6-45f8-a862-de33d0bcb4bd', 1, 'exit'),
(614, 397, 'CAM1', '2025-07-09 10:22:21', 'blob:file:///1ef326eb-cc2b-4c27-85c3-bf5a3feea019', 1, 'entry'),
(615, 397, 'CAM2', '2025-07-09 10:22:45', 'blob:file:///09465ec9-54ce-42b5-a87c-7a49311d2dce', 1, 'exit'),
(616, 398, 'CAM1', '2025-07-09 10:23:01', 'blob:file:///7dacb3fc-5741-4d08-b496-e223f4c26994', 1, 'entry'),
(617, 398, 'CAM2', '2025-07-09 10:23:31', 'blob:file:///496a3b53-629e-4da8-b4e1-d61e49f1c681', 1, 'exit'),
(618, 399, 'CAM1', '2025-07-09 10:29:06', 'license_plate_2025-07-09T03-29-06-505Z.jpg', 1, 'entry'),
(619, 400, 'CAM1', '2025-07-09 10:27:48', 'blob:file:///7ae94e4a-45ef-4072-9b46-3340f42bae97', 1, 'entry'),
(620, 400, 'CAM2', '2025-07-09 10:27:52', 'blob:file:///9afb9e19-af4f-4083-ac68-2c1c39c48388', 1, 'exit'),
(621, 401, 'CAM1', '2025-07-09 10:31:30', 'license_plate_2025-07-09T03-31-30-958Z.jpg', 1, 'entry'),
(622, 402, 'CAM1', '2025-07-09 10:33:26', 'license_plate_2025-07-09T03-33-26-324Z.jpg', 1, 'entry'),
(623, 403, 'CAM1', '2025-07-09 10:45:18', 'license_plate_2025-07-09T03-45-18-925Z.jpg', 1, 'entry'),
(624, 401, 'CAM2', '2025-07-09 10:49:29', 'license_plate_out_2025-07-09T03-49-29-158Z.jpg', 1, 'exit'),
(625, 404, 'CAM1', '2025-07-09 11:02:04', 'blob:file:///f4466ff4-4128-4857-a092-9cf237b451c9', 1, 'entry'),
(626, 404, 'CAM2', '2025-07-09 11:02:11', 'blob:file:///4ce7681d-2b0b-4167-8db4-a36105b13790', 1, 'exit'),
(627, 405, 'CAM1', '2025-07-09 11:09:58', 'blob:file:///e4b731cc-124d-4912-b745-46f7b47feb25', 1, 'entry'),
(628, 405, 'CAM2', '2025-07-09 11:10:08', 'blob:file:///9cbc8a2f-668b-4408-9f33-cd6ea7ccfb56', 1, 'exit'),
(629, 406, 'CAM1', '2025-07-09 11:15:47', 'blob:file:///b0cd40ea-1b75-4914-bb5c-14b9e7e0148a', 1, 'entry'),
(630, 406, 'CAM2', '2025-07-09 11:15:53', 'blob:file:///22a447cc-581c-405d-a457-d5034b9cc8ad', 1, 'exit'),
(631, 407, 'CAM1', '2025-07-09 11:16:11', 'blob:file:///8546b79f-9188-42f5-82ec-93dd9bc06c90', 1, 'entry'),
(632, 407, 'CAM2', '2025-07-09 11:16:21', 'blob:file:///428aedf2-d76c-4aae-b7ed-0c3d9133d14f', 1, 'exit'),
(633, 408, 'CAM1', '2025-07-09 11:16:42', 'blob:file:///d918d2c8-b98a-4523-9412-16e7bfd11fa9', 1, 'entry'),
(634, 408, 'CAM2', '2025-07-09 11:16:47', 'blob:file:///940e73d3-a575-4ebe-b08e-221bf1f02696', 1, 'exit'),
(635, 409, 'CAM1', '2025-07-09 11:29:26', 'blob:file:///25945a0d-bc09-40ee-8de4-5a39dc43425b', 1, 'entry'),
(636, 409, 'CAM2', '2025-07-09 11:29:31', 'blob:file:///1766e210-5aa5-4c14-bbbf-fd6bcaebc40d', 1, 'exit'),
(637, 410, 'CAM1', '2025-07-09 11:30:05', 'blob:file:///55cad20f-7336-4c2d-a413-140669f5219f', 1, 'entry'),
(638, 410, 'CAM2', '2025-07-09 11:30:15', 'blob:file:///41c8b656-ad8e-4bcb-a923-6dbcac3fe5d3', 1, 'exit'),
(639, 411, 'CAM1', '2025-07-09 11:59:18', 'blob:file:///af014349-e252-4027-82b2-9d0afeb197ba', 1, 'entry'),
(640, 411, 'CAM2', '2025-07-09 11:59:24', 'blob:file:///524ddeeb-5092-4185-9885-a56f05d1f46a', 1, 'exit'),
(641, 412, 'CAM1', '2025-07-09 12:01:28', 'blob:file:///59a251e3-2c35-41b5-bf63-81bf6c5fb476', 1, 'entry'),
(642, 412, 'CAM2', '2025-07-09 12:01:33', 'blob:file:///38415f22-9bc1-48eb-9a10-ba6f5f655614', 1, 'exit'),
(643, 403, 'CAM2', '2025-07-09 13:19:14', 'blob:file:///e436d005-4c0a-4e8e-b2d4-a9016b4d0af0', 1, 'exit'),
(644, 399, 'CAM2', '2025-07-09 13:20:13', 'blob:file:///9d969879-3cf0-4edb-a27f-96108d946d5f', 1, 'exit'),
(645, 413, 'CAM1', '2025-07-09 13:20:21', 'blob:file:///fe99aeb0-b0ed-480a-a32d-f588df413922', 1, 'entry'),
(646, 414, 'CAM1', '2025-07-09 13:28:34', 'blob:file:///cec9bbeb-bbfa-4442-b897-b87590e97f1a', 1, 'entry'),
(647, 414, 'CAM2', '2025-07-09 13:30:02', 'blob:file:///ac699705-59c1-4324-857f-8bda4cea4d2f', 1, 'exit'),
(648, 413, 'CAM2', '2025-07-09 13:32:21', 'blob:file:///62fbde30-586b-4111-b99d-0b93a607e610', 1, 'exit'),
(649, 415, 'CAM1', '2025-07-09 13:32:33', 'blob:file:///dd590f4c-52f2-4cd4-a75c-ebeeb3857261', 1, 'entry'),
(650, 415, 'CAM2', '2025-07-09 13:32:38', 'blob:file:///23e4c596-e2ea-48ff-b8fa-e1fb3442a3b6', 1, 'exit'),
(651, 416, 'CAM1', '2025-07-09 13:32:55', 'blob:file:///efce832d-f123-4823-ae37-15c37977a580', 1, 'entry'),
(652, 416, 'CAM2', '2025-07-09 13:33:00', 'blob:file:///f3aec17f-2dec-42a7-abfd-e0a269b9d7d2', 1, 'exit'),
(653, 417, 'CAM1', '2025-07-09 13:33:27', 'blob:file:///70d6ef09-5c09-49a9-a90e-80875ec5e2d9', 1, 'entry'),
(654, 417, 'CAM2', '2025-07-09 13:33:41', 'blob:file:///21f162bf-3795-49fd-82fc-0294fb14fb2f', 1, 'exit'),
(655, 418, 'CAM1', '2025-07-09 13:42:17', 'blob:file:///b18add74-4ec3-4647-a9e0-a73c044d9abc', 1, 'entry'),
(656, 418, 'CAM2', '2025-07-09 13:43:14', 'blob:file:///9fcb45c2-8114-4cff-9dd3-58309899e0bd', 1, 'exit'),
(657, 419, 'CAM1', '2025-07-09 13:44:34', 'blob:file:///ab8915b1-7d4f-4cc9-b8ab-700fee312be4', 1, 'entry'),
(658, 419, 'CAM2', '2025-07-09 13:45:40', 'blob:file:///8e58fe18-38d6-45b8-b845-de61ea80aac2', 1, 'exit'),
(659, 420, 'CAM1', '2025-07-09 13:49:35', 'blob:file:///a6d0177e-3bc2-47b5-b738-df485fae65af', 1, 'entry'),
(660, 420, 'CAM2', '2025-07-09 13:49:42', 'blob:file:///66c6c165-c23f-48de-a3ef-d0f584f202f5', 1, 'exit'),
(661, 421, 'CAM1', '2025-07-09 13:50:20', 'blob:file:///ce3f5457-3174-4e41-88bc-78092fcd0355', 1, 'entry'),
(662, 421, 'CAM2', '2025-07-09 14:14:41', 'blob:file:///c42e0c27-bdf9-4432-ba1f-a59bd7ec303e', 1, 'exit'),
(663, 422, 'CAM1', '2025-07-09 14:15:57', 'blob:file:///fcf83dec-2009-4984-a3da-f6ebb72c157a', 1, 'entry'),
(664, 422, 'CAM2', '2025-07-09 14:16:59', 'blob:file:///26710985-d2a7-4728-897d-c5b230b3ad95', 1, 'exit'),
(665, 423, 'CAM1', '2025-07-09 14:17:41', 'blob:file:///ba2ed460-4147-4ca5-8cc4-30ad278873b9', 1, 'entry'),
(666, 423, 'CAM2', '2025-07-09 14:17:48', 'blob:file:///eec371c0-f007-4906-a963-73ac0776c045', 1, 'exit'),
(667, 424, 'CAM1', '2025-07-09 14:18:58', 'blob:file:///023f8bfc-f3a4-446e-927c-9ac2e905a0e5', 1, 'entry'),
(668, 424, 'CAM2', '2025-07-09 14:19:38', 'blob:file:///188db1c1-c27f-41c6-9d73-337a77b36cd9', 1, 'exit'),
(669, 425, 'CAM1', '2025-07-09 14:37:01', 'license_plate_2025-07-09T07-37-01-013Z.jpg', 1, 'entry'),
(670, 426, 'CAM1', '2025-07-09 14:38:01', 'blob:file:///9de3b203-9a80-4bb3-afea-890b5dec76a9', 1, 'entry'),
(671, 426, 'CAM2', '2025-07-09 14:38:28', 'blob:file:///def4f51c-b8e2-4a57-bffa-0b59bbfb990d', 1, 'exit'),
(672, 427, 'CAM1', '2025-07-09 14:39:19', 'blob:file:///18af1928-124b-4901-810d-a1317b9c112c', 1, 'entry'),
(673, 427, 'CAM2', '2025-07-09 14:39:24', 'blob:file:///20fe5460-c691-46e8-8eb7-907d3256de24', 1, 'exit'),
(674, 428, 'CAM1', '2025-07-09 14:39:47', 'blob:file:///ed71188e-037a-436e-a2ed-dfec41eb95fb', 1, 'entry'),
(675, 425, 'CAM2', '2025-07-09 14:41:32', 'license_plate_out_2025-07-09T07-41-32-348Z.jpg', 1, 'exit'),
(676, 428, 'CAM2', '2025-07-09 14:40:35', 'blob:file:///0bbccb6e-d44d-420e-9d07-c62704f8b7d8', 1, 'exit'),
(677, 429, 'CAM1', '2025-07-09 14:41:17', 'blob:file:///c1211a44-d3af-4eee-9b25-1e18009ef4dd', 1, 'entry'),
(678, 429, 'CAM2', '2025-07-09 14:41:30', 'blob:file:///19561c98-3876-4907-b840-06b5ba1164ae', 1, 'exit'),
(679, 430, 'CAM1', '2025-07-09 14:42:32', 'blob:file:///d7230675-aa0d-4c03-8b80-8bebb468e119', 1, 'entry'),
(680, 430, 'CAM2', '2025-07-09 14:42:47', 'blob:file:///f7cec8f7-b0e3-475e-bc48-653084c1076b', 1, 'exit'),
(681, 431, 'CAM1', '2025-07-09 14:43:39', 'blob:file:///7648f55f-7db5-42a9-985f-6fc1bd2f6d7f', 1, 'entry'),
(682, 432, 'CAM1', '2025-07-09 14:44:46', 'license_plate_2025-07-09T07-44-46-076Z.jpg', 1, 'entry'),
(683, 431, 'CAM2', '2025-07-09 14:43:50', 'blob:file:///68088f03-589a-4686-82b5-cbb03e6f302c', 1, 'exit'),
(684, 433, 'CAM1', '2025-07-09 14:44:09', 'blob:file:///b722a0ae-e68e-400e-bd49-8867a9aac632', 1, 'entry'),
(685, 433, 'CAM2', '2025-07-09 14:44:39', 'blob:file:///55ace233-5ce6-4c1b-a493-1bac4dfab458', 1, 'exit'),
(686, 434, 'CAM1', '2025-07-09 14:45:16', 'blob:file:///2da2afe4-34a7-44d0-bc3e-3c9eae70ac2a', 1, 'entry'),
(687, 434, 'CAM2', '2025-07-09 14:45:28', 'blob:file:///b6be2ed6-8796-4af7-8fc3-92f909e4d220', 1, 'exit'),
(688, 432, 'CAM2', '2025-07-09 14:47:17', 'license_plate_out_2025-07-09T07-47-17-579Z.jpg', 1, 'exit'),
(689, 435, 'CAM1', '2025-07-09 14:46:15', 'blob:file:///9c2601a3-5b74-4964-9a26-6a27cfaa9e76', 1, 'entry'),
(690, 435, 'CAM2', '2025-07-09 14:46:26', 'blob:file:///b8dfe791-e05d-4d6f-a4d7-0f6b3dd066d2', 1, 'exit'),
(691, 436, 'CAM1', '2025-07-09 14:47:00', 'blob:file:///3da714bc-f151-453f-853e-0089f91b420e', 1, 'entry'),
(692, 436, 'CAM2', '2025-07-09 14:47:03', 'blob:file:///8f2bff1a-2fe3-4057-a608-b80ad189fd64', 1, 'exit'),
(693, 437, 'CAM1', '2025-07-09 14:52:51', 'license_plate_2025-07-09T07-52-51-626Z.jpg', 1, 'entry'),
(694, 438, 'CAM1', '2025-07-09 14:59:34', 'blob:file:///c9fe1779-9066-401b-aaa4-384acf386ca7', 1, 'entry'),
(695, 438, 'CAM2', '2025-07-09 14:59:52', 'blob:file:///2ab34c37-216d-4797-b68b-c1dfe16ce6e8', 1, 'exit'),
(696, 439, 'CAM1', '2025-07-09 15:01:50', 'blob:file:///35ff8f85-b32d-4a0e-aa09-c720f6e4378d', 1, 'entry'),
(697, 439, 'CAM2', '2025-07-09 15:03:03', 'blob:file:///7760f117-238c-4b71-80df-87821c3d8cfc', 1, 'exit'),
(698, 440, 'CAM1', '2025-07-09 15:36:27', 'blob:file:///ab45179a-5d2a-4b99-8050-b6cfbe0e41f6', 1, 'entry'),
(699, 440, 'CAM2', '2025-07-09 15:37:19', 'blob:file:///f423e36d-5c21-4170-8704-815d46a3ee16', 1, 'exit'),
(700, 441, 'CAM1', '2025-07-09 15:41:43', 'http://192.168.1.19:9000/parking-lot-images/license_plate_2025-07-09T08-41-41-060Z.jpg', 1, 'entry'),
(701, 441, 'CAM2', '2025-07-09 15:43:30', 'http://192.168.1.19:9000/parking-lot-images/license_plate_out_2025-07-09T08-43-29-239Z.jpg', 1, 'exit'),
(702, 442, 'CAM1', '2025-07-09 15:47:05', 'http://192.168.1.19:9000/parking-lot-images/license_plate_2025-07-09T08-47-04-056Z.jpg', 1, 'entry'),
(703, 442, 'CAM2', '2025-07-09 15:47:12', 'http://192.168.1.19:9000/parking-lot-images/license_plate_out_2025-07-09T08-47-11-593Z.jpg', 1, 'exit'),
(704, 443, 'CAM1', '2025-07-09 16:17:52', 'http://192.168.1.19:9000/parking-lot-images/license_plate_2025-07-09T09-17-46-242Z.jpg', 1, 'entry'),
(705, 443, 'CAM2', '2025-07-09 16:19:00', 'http://192.168.1.19:9000/parking-lot-images/license_plate_out_2025-07-09T09-18-53-145Z.jpg', 1, 'exit'),
(706, 437, 'CAM2', '2025-07-10 09:56:41', 'license_plate_out_2025-07-10T02-56-41-880Z.jpg', 1, 'exit'),
(707, 444, 'CAM1', '2025-07-10 10:04:56', 'http://192.168.1.19:9000/parking-lot-images/license_plate_2025-07-10T03-04-54-531Z.jpg', 1, 'entry'),
(708, 444, 'CAM2', '2025-07-10 10:05:31', 'http://192.168.1.19:9000/parking-lot-images/license_plate_out_2025-07-10T03-05-30-356Z.jpg', 1, 'exit'),
(709, 445, 'CAM1', '2025-07-10 10:06:16', 'http://192.168.1.19:9000/parking-lot-images/license_plate_2025-07-10T03-06-14-559Z.jpg', 1, 'entry'),
(710, 445, 'CAM2', '2025-07-10 10:06:19', 'http://192.168.1.19:9000/parking-lot-images/license_plate_out_2025-07-10T03-06-18-301Z.jpg', 1, 'exit'),
(711, 446, 'CAM1', '2025-07-10 10:10:28', 'license_plate_2025-07-10T03-10-28-866Z.jpg', 1, 'entry'),
(712, 446, 'CAM6', '2025-07-10 10:14:12', 'license_plate_out_2025-07-10T03-14-12-004Z.jpg', 1, 'exit'),
(713, 447, 'CAM1', '2025-07-10 10:58:44', 'license_plate_2025-07-10T03-58-41-984Z.jpg', 1, 'entry'),
(714, 447, 'CAM2', '2025-07-10 10:59:23', 'http://192.168.1.19:9000/parking-lot-images/license_plate_out_2025-07-10T03-59-14-642Z.jpg', 1, 'exit'),
(715, 448, 'CAM1', '2025-07-10 10:59:50', 'license_plate_2025-07-10T03-59-48-553Z.jpg', 1, 'entry'),
(716, 448, 'CAM2', '2025-07-10 11:00:15', 'http://192.168.1.19:9000/parking-lot-images/license_plate_out_2025-07-10T04-00-07-299Z.jpg', 1, 'exit'),
(717, 449, 'CAM1', '2025-07-10 11:03:17', 'license_plate_2025-07-10T04-03-11-991Z.jpg', 1, 'entry'),
(718, 449, 'CAM2', '2025-07-10 11:25:20', 'license_plate_out_2025-07-10T04-25-12-312Z.jpg', 1, 'exit'),
(719, 450, 'CAM1', '2025-07-10 11:25:27', 'license_plate_2025-07-10T04-25-24-063Z.jpg', 1, 'entry'),
(720, 450, 'CAM2', '2025-07-10 11:26:12', 'license_plate_out_2025-07-10T04-26-05-984Z.jpg', 1, 'exit'),
(721, 451, 'CAM1', '2025-07-10 11:26:19', 'license_plate_2025-07-10T04-26-17-829Z.jpg', 1, 'entry'),
(722, 452, 'CAM1', '2025-07-10 13:13:54', 'license_plate_2025-07-10T06-13-54-267Z.jpg', 1, 'entry'),
(723, 452, 'CAM2', '2025-07-10 13:15:53', 'license_plate_out_2025-07-10T06-15-53-297Z.jpg', 1, 'exit'),
(724, 451, 'CAM2', '2025-07-10 13:23:44', 'license_plate_out_2025-07-10T06-23-32-366Z.jpg', 1, 'exit'),
(725, 453, 'CAM1', '2025-07-10 13:23:58', 'license_plate_2025-07-10T06-23-56-174Z.jpg', 1, 'entry'),
(726, 453, 'CAM2', '2025-07-10 13:25:16', 'license_plate_out_2025-07-10T06-25-13-642Z.jpg', 1, 'exit'),
(727, 454, 'CAM1', '2025-07-10 13:26:45', 'license_plate_2025-07-10T06-26-39-644Z.jpg', 1, 'entry'),
(728, 454, 'CAM2', '2025-07-10 13:34:34', 'license_plate_out_2025-07-10T06-34-30-895Z.jpg', 1, 'exit'),
(729, 455, 'CAM1', '2025-07-10 13:35:11', 'license_plate_2025-07-10T06-35-10-110Z.jpg', 1, 'entry'),
(730, 455, 'CAM2', '2025-07-10 13:40:43', 'license_plate_out_2025-07-10T06-40-43-816Z.jpg', 1, 'exit'),
(731, 456, 'CAM1', '2025-07-10 13:42:10', 'license_plate_2025-07-10T06-42-10-433Z.jpg', 1, 'entry'),
(732, 457, 'CAM1', '2025-07-10 13:42:44', 'license_plate_2025-07-10T06-42-43-273Z.jpg', 1, 'entry'),
(733, 457, 'CAM2', '2025-07-10 13:43:42', 'license_plate_out_2025-07-10T06-43-25-386Z.jpg', 1, 'exit'),
(734, 458, 'CAM1', '2025-07-10 13:44:33', 'license_plate_2025-07-10T06-44-32-077Z.jpg', 1, 'entry'),
(735, 458, 'CAM2', '2025-07-10 13:52:10', 'license_plate_out_2025-07-10T06-52-09-174Z.jpg', 1, 'exit'),
(736, 459, 'CAM1', '2025-07-10 13:52:15', 'license_plate_2025-07-10T06-52-14-113Z.jpg', 1, 'entry'),
(737, 459, 'CAM2', '2025-07-10 13:53:59', 'license_plate_out_2025-07-10T06-53-50-307Z.jpg', 1, 'exit'),
(738, 460, 'CAM1', '2025-07-10 13:54:08', 'license_plate_2025-07-10T06-54-02-494Z.jpg', 1, 'entry'),
(739, 460, 'CAM2', '2025-07-10 13:54:22', 'license_plate_out_2025-07-10T06-54-18-328Z.jpg', 1, 'exit'),
(740, 461, 'CAM1', '2025-07-10 13:56:04', 'license_plate_2025-07-10T06-56-03-519Z.jpg', 1, 'entry'),
(741, 461, 'CAM2', '2025-07-10 13:56:22', 'license_plate_out_2025-07-10T06-56-13-267Z.jpg', 1, 'exit'),
(742, 462, 'CAM1', '2025-07-10 14:04:24', 'license_plate_2025-07-10T07-04-23-180Z.jpg', 1, 'entry'),
(743, 462, 'CAM2', '2025-07-10 14:04:55', 'license_plate_out_2025-07-10T07-04-53-268Z.jpg', 1, 'exit'),
(744, 463, 'CAM1', '2025-07-10 14:05:59', 'license_plate_2025-07-10T07-05-58-072Z.jpg', 1, 'entry'),
(745, 463, 'CAM2', '2025-07-10 14:06:10', 'license_plate_out_2025-07-10T07-06-08-545Z.jpg', 1, 'exit'),
(746, 464, 'CAM1', '2025-07-10 14:06:40', 'license_plate_2025-07-10T07-06-38-994Z.jpg', 1, 'entry'),
(747, 464, 'CAM2', '2025-07-10 14:06:59', 'license_plate_out_2025-07-10T07-06-57-744Z.jpg', 1, 'exit'),
(748, 465, 'CAM1', '2025-07-10 14:07:36', 'license_plate_2025-07-10T07-07-35-112Z.jpg', 1, 'entry'),
(749, 465, 'CAM2', '2025-07-10 14:07:45', 'license_plate_out_2025-07-10T07-07-44-577Z.jpg', 1, 'exit'),
(750, 466, 'CAM1', '2025-07-10 14:34:44', 'license_plate_2025-07-10T07-34-43-209Z.jpg', 1, 'entry'),
(751, 466, 'CAM2', '2025-07-10 14:35:00', 'license_plate_out_2025-07-10T07-34-59-354Z.jpg', 1, 'exit'),
(752, 467, 'CAM1', '2025-07-10 14:51:58', 'license_plate_2025-07-10T07-51-50-631Z.jpg', 1, 'entry'),
(753, 467, 'CAM2', '2025-07-10 14:52:11', 'license_plate_out_2025-07-10T07-52-10-267Z.jpg', 1, 'exit'),
(754, 468, 'CAM1', '2025-07-10 14:52:44', 'license_plate_2025-07-10T07-52-41-634Z.jpg', 1, 'entry'),
(755, 468, 'CAM2', '2025-07-10 15:13:07', 'license_plate_out_2025-07-10T08-12-53-045Z.jpg', 1, 'exit'),
(756, 469, 'CAM1', '2025-07-10 15:13:15', 'license_plate_2025-07-10T08-13-13-512Z.jpg', 1, 'entry'),
(757, 469, 'CAM2', '2025-07-10 15:13:33', 'license_plate_out_2025-07-10T08-13-32-453Z.jpg', 1, 'exit'),
(758, 470, 'CAM1', '2025-07-10 15:13:43', 'license_plate_2025-07-10T08-13-42-389Z.jpg', 1, 'entry'),
(759, 470, 'CAM2', '2025-07-10 15:44:27', 'license_plate_out_2025-07-10T08-44-25-885Z.jpg', 1, 'exit'),
(760, 471, 'CAM1', '2025-07-10 15:44:38', 'license_plate_2025-07-10T08-44-36-766Z.jpg', 1, 'entry'),
(761, 471, 'CAM2', '2025-07-10 15:44:46', 'license_plate_out_2025-07-10T08-44-45-643Z.jpg', 1, 'exit'),
(762, 472, 'CAM1', '2025-07-10 15:45:15', 'license_plate_2025-07-10T08-45-14-103Z.jpg', 1, 'entry'),
(763, 472, 'CAM2', '2025-07-10 15:45:28', 'license_plate_out_2025-07-10T08-45-19-174Z.jpg', 1, 'exit'),
(764, 473, 'CAM1', '2025-07-10 15:48:41', 'license_plate_2025-07-10T08-48-39-811Z.jpg', 1, 'entry'),
(765, 473, 'CAM2', '2025-07-10 15:48:55', 'license_plate_out_2025-07-10T08-48-48-012Z.jpg', 1, 'exit'),
(766, 474, 'CAM1', '2025-07-10 15:49:07', 'license_plate_2025-07-10T08-49-05-927Z.jpg', 1, 'entry'),
(767, 474, 'CAM2', '2025-07-10 15:49:27', 'license_plate_out_2025-07-10T08-49-25-422Z.jpg', 1, 'exit'),
(768, 475, 'CAM1', '2025-07-10 15:50:04', 'license_plate_2025-07-10T08-50-03-278Z.jpg', 1, 'entry'),
(769, 475, 'CAM2', '2025-07-10 15:50:10', 'license_plate_out_2025-07-10T08-50-09-643Z.jpg', 1, 'exit'),
(770, 476, 'CAM1', '2025-07-11 15:10:21', 'license_plate_2025-07-11T08-10-21-006Z.jpg', 1, 'entry'),
(771, 477, 'CAM1', '2025-07-11 15:17:28', 'license_plate_2025-07-11T08-17-28-203Z.jpg', 1, 'entry'),
(772, 478, 'CAM1', '2025-07-11 15:27:36', 'license_plate_2025-07-11T08-27-36-998Z.jpg', 1, 'entry'),
(773, 476, 'CAM2', '2025-07-11 15:29:29', 'license_plate_out_2025-07-11T08-29-29-721Z.jpg', 1, 'exit'),
(774, 478, 'CAM2', '2025-07-11 15:30:23', 'license_plate_out_2025-07-11T08-30-23-198Z.jpg', 1, 'exit'),
(775, 479, 'CAM1', '2025-07-15 09:43:53', 'license_plate_2025-07-15T02-43-50-453Z.jpg', 1, 'entry'),
(776, 479, 'CAM2', '2025-07-15 09:44:51', 'license_plate_out_2025-07-15T02-44-49-842Z.jpg', 1, 'exit'),
(777, 480, 'CAM1', '2025-07-15 09:45:02', 'license_plate_2025-07-15T02-45-00-943Z.jpg', 1, 'entry'),
(778, 481, 'CAM1', '2025-07-15 09:47:42', 'license_plate_2025-07-15T02-47-42-820Z.jpg', 1, 'entry'),
(779, 480, 'CAM2', '2025-07-15 09:46:06', 'license_plate_out_2025-07-15T02-46-04-801Z.jpg', 1, 'exit'),
(780, 482, 'CAM1', '2025-07-15 09:48:19', 'license_plate_2025-07-15T02-48-19-119Z.jpg', 1, 'entry'),
(781, 483, 'CAM1', '2025-07-15 09:46:57', 'license_plate_2025-07-15T02-46-55-982Z.jpg', 1, 'entry'),
(782, 483, 'CAM2', '2025-07-15 09:47:07', 'license_plate_out_2025-07-15T02-47-06-529Z.jpg', 1, 'exit'),
(783, 482, 'CAM2', '2025-07-15 09:54:58', 'license_plate_out_2025-07-15T02-54-58-543Z.jpg', 1, 'exit'),
(784, 484, 'CAM1', '2025-07-15 10:31:25', 'license_plate_2025-07-15T03-31-25-697Z.jpg', 1, 'entry'),
(785, 484, 'CAM2', '2025-07-15 10:46:50', 'license_plate_out_2025-07-15T03-46-50-641Z.jpg', 1, 'exit'),
(786, 485, 'CAM1', '2025-07-15 10:57:59', 'license_plate_2025-07-15T03-57-59-901Z.jpg', 1, 'entry'),
(787, 485, 'CAM2', '2025-07-15 10:58:41', 'license_plate_out_2025-07-15T03-58-41-430Z.jpg', 1, 'exit'),
(788, 485, 'CAM2', '2025-07-15 10:58:41', 'license_plate_out_2025-07-15T03-58-41-430Z.jpg', 1, 'exit'),
(789, 485, 'CAM2', '2025-07-15 10:58:41', 'license_plate_out_2025-07-15T03-58-41-430Z.jpg', 1, 'exit'),
(790, 485, 'CAM2', '2025-07-15 10:58:41', 'license_plate_out_2025-07-15T03-58-41-430Z.jpg', 1, 'exit'),
(791, 485, 'CAM2', '2025-07-15 10:58:41', 'license_plate_out_2025-07-15T03-58-41-430Z.jpg', 1, 'exit'),
(792, 485, 'CAM2', '2025-07-15 10:58:41', 'license_plate_out_2025-07-15T03-58-41-430Z.jpg', 1, 'exit'),
(793, 485, 'CAM2', '2025-07-15 10:58:41', 'license_plate_out_2025-07-15T03-58-41-430Z.jpg', 1, 'exit'),
(794, 485, 'CAM2', '2025-07-15 10:58:41', 'license_plate_out_2025-07-15T03-58-41-430Z.jpg', 1, 'exit'),
(795, 486, 'CAM1', '2025-07-15 11:21:44', 'license_plate_2025-07-15T04-21-42-938Z.jpg', 1, 'entry'),
(796, 486, 'CAM2', '2025-07-15 11:21:51', 'license_plate_out_2025-07-15T04-21-50-481Z.jpg', 1, 'exit'),
(797, 487, 'CAM1', '2025-07-15 15:07:18', 'license_plate_2025-07-15T08-07-18-133Z.jpg', 1, 'entry'),
(798, 488, 'CAM1', '2025-07-15 16:23:35', 'license_plate_2025-07-15T09-23-35-129Z.jpg', 1, 'entry');

-- --------------------------------------------------------

--
-- Table structure for table `pm_nc0011`
--

CREATE TABLE `pm_nc0011` (
  `lv001` varchar(20) NOT NULL COMMENT 'Ma khu vuc',
  `lv002` char(32) NOT NULL COMMENT 'Nhan vien',
  `lv003` text DEFAULT NULL COMMENT 'Ghi chu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pm_nc0011`
--

INSERT INTO `pm_nc0011` (`lv001`, `lv002`, `lv003`) VALUES
('K0001', 'nv01', NULL),
('K0001', 'nv02', ''),
('K0001', 'nv03', NULL),
('K0002', 'nv01', ''),
('K0002', 'nv02', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `lv_lv0007`
--
ALTER TABLE `lv_lv0007`
  ADD PRIMARY KEY (`lv001`);

--
-- Indexes for table `pm_nc0001`
--
ALTER TABLE `pm_nc0001`
  ADD PRIMARY KEY (`lv001`);

--
-- Indexes for table `pm_nc0002`
--
ALTER TABLE `pm_nc0002`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn2_loai` (`lv002`);

--
-- Indexes for table `pm_nc0003`
--
ALTER TABLE `pm_nc0003`
  ADD PRIMARY KEY (`lv001`);

--
-- Indexes for table `pm_nc0004`
--
ALTER TABLE `pm_nc0004`
  ADD PRIMARY KEY (`lv001`);

--
-- Indexes for table `pm_nc0005`
--
ALTER TABLE `pm_nc0005`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn5_khu` (`lv002`);

--
-- Indexes for table `pm_nc0006`
--
ALTER TABLE `pm_nc0006`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pm_nc0006_lv005` (`lv005`);

--
-- Indexes for table `pm_nc0007`
--
ALTER TABLE `pm_nc0007`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pm_nc0007_lv005` (`lv005`);

--
-- Indexes for table `pm_nc0008`
--
ALTER TABLE `pm_nc0008`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn8_loai` (`lv002`);

--
-- Indexes for table `pm_nc0009`
--
ALTER TABLE `pm_nc0009`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_01072025`
--
ALTER TABLE `pm_nc0009_01072025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_02072025`
--
ALTER TABLE `pm_nc0009_02072025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_03072025`
--
ALTER TABLE `pm_nc0009_03072025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_06072025`
--
ALTER TABLE `pm_nc0009_06072025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_07072025`
--
ALTER TABLE `pm_nc0009_07072025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_08072025`
--
ALTER TABLE `pm_nc0009_08072025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_09072025`
--
ALTER TABLE `pm_nc0009_09072025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_10072025`
--
ALTER TABLE `pm_nc0009_10072025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_11072025`
--
ALTER TABLE `pm_nc0009_11072025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_12062025`
--
ALTER TABLE `pm_nc0009_12062025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_13062025`
--
ALTER TABLE `pm_nc0009_13062025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_13072025`
--
ALTER TABLE `pm_nc0009_13072025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_14072025`
--
ALTER TABLE `pm_nc0009_14072025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_15062025`
--
ALTER TABLE `pm_nc0009_15062025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_15072025`
--
ALTER TABLE `pm_nc0009_15072025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_16062025`
--
ALTER TABLE `pm_nc0009_16062025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_17062025`
--
ALTER TABLE `pm_nc0009_17062025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_18062025`
--
ALTER TABLE `pm_nc0009_18062025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_19062025`
--
ALTER TABLE `pm_nc0009_19062025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_22062025`
--
ALTER TABLE `pm_nc0009_22062025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0009_30062025`
--
ALTER TABLE `pm_nc0009_30062025`
  ADD PRIMARY KEY (`lv001`),
  ADD KEY `fk_pn9_the` (`lv002`),
  ADD KEY `fk_pn9_xe` (`lv003`),
  ADD KEY `fk_pn9_vtri` (`lv004`),
  ADD KEY `fk_pn9_cs` (`lv005`),
  ADD KEY `fk_pn9_cong_vao` (`lv006`),
  ADD KEY `fk_pn9_cong_ra` (`lv007`);

--
-- Indexes for table `pm_nc0010`
--
ALTER TABLE `pm_nc0010`
  ADD PRIMARY KEY (`lv001`);

--
-- Indexes for table `pm_nc0011`
--
ALTER TABLE `pm_nc0011`
  ADD PRIMARY KEY (`lv001`,`lv002`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94074;

--
-- AUTO_INCREMENT for table `pm_nc0009`
--
ALTER TABLE `pm_nc0009`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=489;

--
-- AUTO_INCREMENT for table `pm_nc0009_01072025`
--
ALTER TABLE `pm_nc0009_01072025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pm_nc0009_02072025`
--
ALTER TABLE `pm_nc0009_02072025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT for table `pm_nc0009_03072025`
--
ALTER TABLE `pm_nc0009_03072025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pm_nc0009_06072025`
--
ALTER TABLE `pm_nc0009_06072025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pm_nc0009_07072025`
--
ALTER TABLE `pm_nc0009_07072025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=365;

--
-- AUTO_INCREMENT for table `pm_nc0009_08072025`
--
ALTER TABLE `pm_nc0009_08072025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=397;

--
-- AUTO_INCREMENT for table `pm_nc0009_09072025`
--
ALTER TABLE `pm_nc0009_09072025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=444;

--
-- AUTO_INCREMENT for table `pm_nc0009_10072025`
--
ALTER TABLE `pm_nc0009_10072025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=476;

--
-- AUTO_INCREMENT for table `pm_nc0009_11072025`
--
ALTER TABLE `pm_nc0009_11072025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=479;

--
-- AUTO_INCREMENT for table `pm_nc0009_12062025`
--
ALTER TABLE `pm_nc0009_12062025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `pm_nc0009_13062025`
--
ALTER TABLE `pm_nc0009_13062025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `pm_nc0009_13072025`
--
ALTER TABLE `pm_nc0009_13072025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pm_nc0009_14072025`
--
ALTER TABLE `pm_nc0009_14072025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pm_nc0009_15062025`
--
ALTER TABLE `pm_nc0009_15062025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `pm_nc0009_15072025`
--
ALTER TABLE `pm_nc0009_15072025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=487;

--
-- AUTO_INCREMENT for table `pm_nc0009_16062025`
--
ALTER TABLE `pm_nc0009_16062025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT for table `pm_nc0009_17062025`
--
ALTER TABLE `pm_nc0009_17062025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=275;

--
-- AUTO_INCREMENT for table `pm_nc0009_18062025`
--
ALTER TABLE `pm_nc0009_18062025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT for table `pm_nc0009_19062025`
--
ALTER TABLE `pm_nc0009_19062025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pm_nc0009_22062025`
--
ALTER TABLE `pm_nc0009_22062025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;

--
-- AUTO_INCREMENT for table `pm_nc0009_30062025`
--
ALTER TABLE `pm_nc0009_30062025`
  MODIFY `lv001` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pm_nc0010`
--
ALTER TABLE `pm_nc0010`
  MODIFY `lv001` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID bản ghi', AUTO_INCREMENT=799;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pm_nc0002`
--
ALTER TABLE `pm_nc0002`
  ADD CONSTRAINT `fk_pn2_loai` FOREIGN KEY (`lv002`) REFERENCES `pm_nc0001` (`lv001`);

--
-- Constraints for table `pm_nc0005`
--
ALTER TABLE `pm_nc0005`
  ADD CONSTRAINT `fk_pn5_khu` FOREIGN KEY (`lv002`) REFERENCES `pm_nc0004` (`lv001`);

--
-- Constraints for table `pm_nc0006`
--
ALTER TABLE `pm_nc0006`
  ADD CONSTRAINT `fk_pm_nc0006_lv005` FOREIGN KEY (`lv005`) REFERENCES `pm_nc0004` (`lv001`);

--
-- Constraints for table `pm_nc0007`
--
ALTER TABLE `pm_nc0007`
  ADD CONSTRAINT `fk_pm_nc0007_lv005` FOREIGN KEY (`lv005`) REFERENCES `pm_nc0004` (`lv001`);

--
-- Constraints for table `pm_nc0008`
--
ALTER TABLE `pm_nc0008`
  ADD CONSTRAINT `fk_pn8_loai` FOREIGN KEY (`lv002`) REFERENCES `pm_nc0001` (`lv001`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
