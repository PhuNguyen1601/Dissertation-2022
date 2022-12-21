-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 20, 2022 at 03:01 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_luanvan`
--

-- --------------------------------------------------------

--
-- Table structure for table `bomon`
--

CREATE TABLE `bomon` (
  `id` int(10) UNSIGNED NOT NULL,
  `mabm` varchar(255) NOT NULL,
  `tenbm` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bomon`
--

INSERT INTO `bomon` (`id`, `mabm`, `tenbm`, `type`, `created_at`, `updated_at`) VALUES
(9, 'HTTT', 'Hệ thống thông tin', 0, '2022-11-20 00:41:23', '2022-11-20 00:41:23'),
(10, 'CNTT', 'Công nghệ thông tin', 0, '2022-11-20 00:41:23', '2022-11-20 00:41:23'),
(11, 'KHMT', 'Khoa học máy tính', 0, '2022-11-20 00:41:23', '2022-11-20 00:41:23'),
(12, 'KTPM', 'Kỹ thuật phần mềm', 0, '2022-11-20 00:41:23', '2022-11-20 00:41:23'),
(13, 'THUD', 'Tin học ứng dụng', 0, '2022-11-20 00:41:23', '2022-11-20 00:41:23'),
(14, 'ATTT', 'An toàn thông tin', 0, '2022-11-20 00:41:23', '2022-11-20 00:41:23'),
(15, 'MMT', 'Mạng máy tính & Truyền thông dữ liệu', 0, '2022-11-20 00:41:23', '2022-11-20 00:41:23'),
(16, 'TTDPT', 'Truyền thông đa phương tiện', 0, '2022-11-20 00:41:23', '2022-11-20 00:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `giangvien`
--

CREATE TABLE `giangvien` (
  `id` int(10) UNSIGNED NOT NULL,
  `tengv` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ngaysinh` date NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `bmid` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `giangvien`
--

INSERT INTO `giangvien` (`id`, `tengv`, `email`, `password`, `ngaysinh`, `type`, `bmid`, `created_at`, `updated_at`) VALUES
(11, 'Nguyễn Giảng viên 1', 'gv1@gmail.com', '202cb962ac59075b964b07152d234b70', '2000-02-11', 0, 9, '2022-11-20 00:41:31', '2022-11-20 00:41:31'),
(12, 'Nguyễn Giảng viên 2', 'gv2@gmail.com', '202cb962ac59075b964b07152d234b70', '2002-12-12', 0, 10, '2022-11-20 00:41:31', '2022-11-20 00:41:31'),
(13, 'Nguyễn Giảng viên 3', 'gv3@gmail.com', '202cb962ac59075b964b07152d234b70', '2000-12-13', 0, 11, '2022-11-20 00:41:31', '2022-11-20 00:41:31'),
(14, 'Nguyễn Giảng viên 4', 'gv4@gmail.com', '202cb962ac59075b964b07152d234b70', '2000-12-14', 0, 12, '2022-11-20 00:41:31', '2022-11-20 00:41:31'),
(15, 'Nguyễn Giảng viên 5', 'gv5@gmail.com', '202cb962ac59075b964b07152d234b70', '2000-12-15', 0, 13, '2022-11-20 00:41:31', '2022-11-20 00:41:31'),
(16, 'Nguyễn Giảng viên 6', 'gv6@gmail.com', '202cb962ac59075b964b07152d234b70', '1999-11-16', 0, 14, '2022-11-20 00:41:31', '2022-11-20 00:41:31'),
(17, 'Nguyễn Giảng viên 7', 'gv7@gmail.com', '202cb962ac59075b964b07152d234b70', '2000-12-17', 0, 15, '2022-11-20 00:41:31', '2022-11-20 00:41:31'),
(18, 'Nguyễn Giảng viên 8', 'gv8@gmail.com', '202cb962ac59075b964b07152d234b70', '2000-01-18', 0, 16, '2022-11-20 00:41:31', '2022-11-20 00:41:31'),
(19, 'Nguyễn Giảng viên 9', 'gv9@gmail.com', '202cb962ac59075b964b07152d234b70', '1989-12-19', 0, 13, '2022-11-20 00:41:31', '2022-11-20 00:41:31'),
(20, 'Nguyễn Giảng viên 10', 'gv10@gmail.com', '202cb962ac59075b964b07152d234b70', '2000-12-20', 0, 9, '2022-11-20 00:41:31', '2022-11-20 00:41:31');

-- --------------------------------------------------------

--
-- Table structure for table `gio`
--

CREATE TABLE `gio` (
  `id` int(10) UNSIGNED NOT NULL,
  `tiet` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gio`
--

INSERT INTO `gio` (`id`, `tiet`, `start_time`, `end_time`, `type`, `created_at`, `updated_at`) VALUES
(10, 'Tiết 1', '7:00 AM', '7:50 AM', 0, '2022-11-20 00:42:45', '2022-11-20 00:42:45'),
(11, 'Tiết 2', '7:50 AM', '8:40 AM', 0, '2022-11-20 00:42:45', '2022-11-20 00:42:45'),
(12, 'Tiết 3', '8:50 AM', '9:40 AM', 0, '2022-11-20 00:42:45', '2022-11-20 00:42:45'),
(13, 'Tiết 4', '9:50 AM', '10:40 AM', 0, '2022-11-20 00:42:45', '2022-11-20 00:42:45'),
(14, 'Tiết 5', '10:40 AM', '11:30 AM', 0, '2022-11-20 00:42:45', '2022-11-20 00:42:45'),
(15, 'Tiết 6', '1:30 PM', '2:20 PM', 0, '2022-11-20 00:42:45', '2022-11-20 00:42:45'),
(16, 'Tiết 7', '2:20 PM', '3:10 PM', 0, '2022-11-20 00:42:45', '2022-11-20 00:42:45'),
(17, 'Tiết 8', '3:20 PM', '4:10 PM', 0, '2022-11-20 00:42:45', '2022-11-20 00:42:45'),
(18, 'Tiết 9', '4:10 AM', '5:00 PM', 0, '2022-11-20 00:42:45', '2022-11-20 00:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `hocki`
--

CREATE TABLE `hocki` (
  `id` int(10) UNSIGNED NOT NULL,
  `hocki` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hocki`
--

INSERT INTO `hocki` (`id`, `hocki`, `type`, `created_at`, `updated_at`) VALUES
(4, 'Học kì 1', 0, '2022-11-20 00:41:50', '2022-11-20 00:41:50'),
(5, 'Học kì 2', 0, '2022-11-20 00:41:55', '2022-11-20 00:41:55'),
(6, 'Học kì hè', 0, '2022-11-20 00:42:03', '2022-11-20 00:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `hocphan`
--

CREATE TABLE `hocphan` (
  `id` int(10) UNSIGNED NOT NULL,
  `mahp` varchar(255) NOT NULL,
  `tenhp` varchar(255) NOT NULL,
  `sotc` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hocphan`
--

INSERT INTO `hocphan` (`id`, `mahp`, `tenhp`, `sotc`, `type`, `created_at`, `updated_at`) VALUES
(10, 'LTDT', 'Lí thuyết đồ thị', 3, 0, '2022-11-20 00:42:22', '2022-11-20 00:42:22'),
(11, 'MTT', 'Mạng máy tính', 4, 0, '2022-11-20 00:42:22', '2022-11-20 00:42:22'),
(12, 'LTCB', 'Lập trình căn bản', 3, 0, '2022-11-20 00:42:22', '2022-11-20 00:42:22'),
(13, 'BMAT', 'Bảo mật an toàn thông tin', 4, 0, '2022-11-20 00:42:22', '2022-11-20 00:42:22'),
(14, 'LTJV', 'Lập trình java', 4, 0, '2022-11-20 00:42:22', '2022-11-20 00:42:22'),
(15, 'LTW', 'Lập trình web', 4, 0, '2022-11-20 00:42:22', '2022-11-20 00:42:22'),
(16, 'TRR', 'Toán rời rạc', 3, 0, '2022-11-20 00:42:22', '2022-11-20 00:42:22'),
(17, 'NMCN', 'Nhập môn công nghệ phần mềm', 3, 0, '2022-11-20 00:42:22', '2022-11-20 00:42:22'),
(18, 'XSTK', 'Xác suất thống kê', 4, 0, '2022-11-20 00:42:22', '2022-11-20 00:42:22');

-- --------------------------------------------------------

--
-- Table structure for table `kehoach`
--

CREATE TABLE `kehoach` (
  `id` int(10) UNSIGNED NOT NULL,
  `tieude` varchar(255) NOT NULL,
  `ngaybd_dk` date NOT NULL,
  `ngaykt_dk` date NOT NULL,
  `ngaybd_thi` date NOT NULL,
  `ngaykt_thi` date NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `nkid` int(10) UNSIGNED DEFAULT NULL,
  `hkid` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kehoach`
--

INSERT INTO `kehoach` (`id`, `tieude`, `ngaybd_dk`, `ngaykt_dk`, `ngaybd_thi`, `ngaykt_thi`, `type`, `nkid`, `hkid`, `created_at`, `updated_at`) VALUES
(1, 'Học kì 1', '2022-11-20', '2022-11-22', '2022-11-23', '2022-11-25', 0, 1, 4, '2022-11-20 00:43:30', '2022-11-20 00:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `lichthi`
--

CREATE TABLE `lichthi` (
  `id` int(10) UNSIGNED NOT NULL,
  `ngayid` int(11) NOT NULL,
  `gioid` int(11) NOT NULL,
  `phongid` int(11) NOT NULL,
  `lhpid` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lophocphan`
--

CREATE TABLE `lophocphan` (
  `id` int(10) UNSIGNED NOT NULL,
  `malhp` varchar(255) NOT NULL,
  `hkid` int(10) UNSIGNED DEFAULT NULL,
  `nkid` int(10) UNSIGNED DEFAULT NULL,
  `hpid` int(10) UNSIGNED DEFAULT NULL,
  `gvid` int(10) UNSIGNED DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `dangki` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lophocphan`
--

INSERT INTO `lophocphan` (`id`, `malhp`, `hkid`, `nkid`, `hpid`, `gvid`, `type`, `dangki`, `created_at`, `updated_at`) VALUES
(1, 'LHP1', 4, 1, 10, 11, 0, 1, '2022-11-20 00:42:33', '2022-11-20 00:42:33'),
(2, 'LHP2', 4, 1, 11, 11, 0, 1, '2022-11-20 00:42:33', '2022-11-20 00:42:33'),
(3, 'LHP3', 4, 1, 12, 11, 0, 1, '2022-11-20 00:42:33', '2022-11-20 00:42:33'),
(4, 'LHP4', 4, 1, 13, 11, 0, 1, '2022-11-20 00:42:33', '2022-11-20 00:42:33'),
(5, 'LHP5', 4, 1, 14, 11, 0, 0, '2022-11-20 00:42:33', '2022-11-20 00:42:33'),
(6, 'LHP6', 4, 1, 15, 11, 0, 0, '2022-11-20 00:42:33', '2022-11-20 00:42:33'),
(7, 'LHP7', 4, 1, 16, 11, 0, 0, '2022-11-20 00:42:33', '2022-11-20 00:42:33'),
(8, 'LHP8', 4, 1, 17, 11, 0, 0, '2022-11-20 00:42:33', '2022-11-20 00:42:33'),
(9, 'LHP9', 4, 1, 18, 11, 0, 0, '2022-11-20 00:42:33', '2022-11-20 00:42:33'),
(10, 'LHP10', 4, 1, 18, 11, 0, 1, '2022-11-20 00:42:33', '2022-11-20 00:42:33'),
(11, 'LHP11', 4, 1, 17, 11, 0, 0, '2022-11-20 00:42:33', '2022-11-20 00:42:33'),
(12, 'LHP12', 4, 1, 16, 11, 0, 0, '2022-11-20 00:42:33', '2022-11-20 00:42:33'),
(13, 'LHP13', 4, 1, 15, 11, 0, 0, '2022-11-20 00:42:33', '2022-11-20 00:42:33'),
(14, 'LHP14', 4, 1, 12, 11, 0, 0, '2022-11-20 00:42:33', '2022-11-20 00:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `lophocphan_sinhvien`
--

CREATE TABLE `lophocphan_sinhvien` (
  `lophocphan_id` int(10) UNSIGNED DEFAULT NULL,
  `sinhvien_id` int(10) UNSIGNED DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `bac` tinyint(1) NOT NULL DEFAULT '0',
  `mau` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lophocphan_sinhvien`
--

INSERT INTO `lophocphan_sinhvien` (`lophocphan_id`, `sinhvien_id`, `type`, `bac`, `mau`, `created_at`, `updated_at`) VALUES
(1, 59, 0, 0, 0, '2022-11-20 01:34:10', '2022-11-20 01:34:10'),
(1, 60, 0, 0, 0, '2022-11-20 01:34:10', '2022-11-20 01:34:10'),
(2, 60, 0, 0, 0, '2022-11-20 01:34:10', '2022-11-20 01:34:10'),
(2, 61, 0, 0, 0, '2022-11-20 01:34:10', '2022-11-20 01:34:10'),
(3, 61, 0, 0, 0, '2022-11-20 01:34:10', '2022-11-20 01:34:10'),
(3, 62, 0, 0, 0, '2022-11-20 01:34:10', '2022-11-20 01:34:10'),
(4, 59, 0, 0, 0, '2022-11-20 01:34:10', '2022-11-20 01:34:10'),
(4, 62, 0, 0, 0, '2022-11-20 01:34:10', '2022-11-20 01:34:10'),
(4, 61, 0, 0, 0, '2022-11-20 01:34:10', '2022-11-20 01:34:10'),
(4, 63, 0, 0, 0, '2022-11-20 01:34:10', '2022-11-20 01:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(122, '2014_10_12_000000_create_users_table', 1),
(123, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(124, '2022_10_15_071934_create_bomon_table', 1),
(125, '2022_10_15_112827_create_hocphan_table', 1),
(126, '2022_10_16_123150_create_sinhvien_table', 1),
(127, '2022_10_19_035755_create_phong_table', 1),
(128, '2022_10_20_091337_create_gio_table', 1),
(129, '2022_10_20_092720_create_hocki_table', 1),
(130, '2022_10_20_092819_create_nienkhoa_table', 1),
(131, '2022_10_21_085653_create_kehoach_table', 1),
(132, '2022_10_28_123026_create_giangvien_table', 1),
(133, '2022_10_29_093536_create_lophocphan_table', 1),
(134, '2022_10_29_095754_create_sv_lhp_table', 1),
(135, '2022_11_07_141629_create_ngay_table', 1),
(136, '2022_11_13_103803_create_lichthi_table', 1),
(137, '2022_11_17_151025_create_video_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ngay`
--

CREATE TABLE `ngay` (
  `id` int(10) UNSIGNED NOT NULL,
  `ngaybd_thi` date DEFAULT NULL,
  `ngaykt_thi` date DEFAULT NULL,
  `ngay_thi` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ngay`
--

INSERT INTO `ngay` (`id`, `ngaybd_thi`, `ngaykt_thi`, `ngay_thi`, `type`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'Thứ 2', 0, NULL, NULL),
(2, NULL, NULL, 'Thứ 3', 0, NULL, NULL),
(3, NULL, NULL, 'Thứ 4', 0, NULL, NULL),
(4, NULL, NULL, 'Thứ 5', 0, NULL, NULL),
(5, NULL, NULL, 'Thứ 6', 0, NULL, NULL),
(6, NULL, NULL, 'Thứ 7', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nienkhoa`
--

CREATE TABLE `nienkhoa` (
  `id` int(10) UNSIGNED NOT NULL,
  `nienkhoa` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nienkhoa`
--

INSERT INTO `nienkhoa` (`id`, `nienkhoa`, `type`, `created_at`, `updated_at`) VALUES
(1, '2022 - 2023', 0, '2022-11-20 00:42:10', '2022-11-20 00:42:10'),
(2, '2023 - 2024', 0, '2022-11-20 00:42:10', '2022-11-20 00:42:10'),
(3, '2024 - 2025', 0, '2022-11-20 00:42:10', '2022-11-20 00:42:10'),
(4, '2025 - 2026', 0, '2022-11-20 00:42:10', '2022-11-20 00:42:10'),
(5, '2026 - 2027', 0, '2022-11-20 00:42:10', '2022-11-20 00:42:10'),
(6, '2027 - 2028', 0, '2022-11-20 00:42:10', '2022-11-20 00:42:10'),
(7, '2028 - 2029', 0, '2022-11-20 00:42:10', '2022-11-20 00:42:10'),
(8, '2029 - 2030', 0, '2022-11-20 00:42:10', '2022-11-20 00:42:10'),
(9, '2030 - 2031', 0, '2022-11-20 00:42:10', '2022-11-20 00:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE `phong` (
  `id` int(10) UNSIGNED NOT NULL,
  `map` varchar(255) NOT NULL,
  `succhua` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phong`
--

INSERT INTO `phong` (`id`, `map`, `succhua`, `type`, `created_at`, `updated_at`) VALUES
(1, 'MP1', 60, 0, '2022-11-20 00:42:51', '2022-11-20 00:42:51'),
(2, 'MP2', 60, 0, '2022-11-20 00:42:51', '2022-11-20 00:42:51'),
(3, 'MP3', 60, 0, '2022-11-20 00:42:51', '2022-11-20 00:42:51'),
(4, 'MP4', 60, 0, '2022-11-20 00:42:51', '2022-11-20 00:42:51'),
(5, 'MP5', 60, 0, '2022-11-20 00:42:51', '2022-11-20 00:42:51'),
(6, 'MP6', 60, 0, '2022-11-20 00:42:51', '2022-11-20 00:42:51'),
(7, 'MP7', 60, 0, '2022-11-20 00:42:51', '2022-11-20 00:42:51'),
(8, 'MP8', 60, 0, '2022-11-20 00:42:51', '2022-11-20 00:42:51'),
(9, 'MP9', 60, 0, '2022-11-20 00:42:51', '2022-11-20 00:42:51'),
(10, 'MP10', 60, 0, '2022-11-20 00:42:51', '2022-11-20 00:42:51'),
(11, 'MP11', 60, 0, '2022-11-20 00:42:52', '2022-11-20 00:42:52'),
(12, 'MP12', 60, 0, '2022-11-20 00:42:52', '2022-11-20 00:42:52'),
(13, 'MP13', 60, 0, '2022-11-20 00:42:52', '2022-11-20 00:42:52'),
(14, 'MP14', 60, 0, '2022-11-20 00:42:52', '2022-11-20 00:42:52'),
(15, 'MP15', 60, 0, '2022-11-20 00:42:52', '2022-11-20 00:42:52'),
(16, 'MP16', 60, 0, '2022-11-20 00:42:52', '2022-11-20 00:42:52'),
(17, 'MP17', 60, 0, '2022-11-20 00:42:52', '2022-11-20 00:42:52'),
(18, 'MP18', 60, 0, '2022-11-20 00:42:52', '2022-11-20 00:42:52'),
(19, 'MP19', 60, 0, '2022-11-20 00:42:52', '2022-11-20 00:42:52'),
(20, 'MP20', 60, 0, '2022-11-20 00:42:52', '2022-11-20 00:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `id` int(10) UNSIGNED NOT NULL,
  `masv` varchar(255) NOT NULL,
  `tensv` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`id`, `masv`, `tensv`, `type`, `created_at`, `updated_at`) VALUES
(59, 'SV1', 'Sinh viên 1', 0, '2022-11-20 01:34:10', '2022-11-20 01:34:10'),
(60, 'SV2', 'Sinh viên 2', 0, '2022-11-20 01:34:10', '2022-11-20 01:34:10'),
(61, 'SV3', 'Sinh viên 3', 0, '2022-11-20 01:34:10', '2022-11-20 01:34:10'),
(62, 'SV4', 'Sinh viên 4', 0, '2022-11-20 01:34:10', '2022-11-20 01:34:10'),
(63, 'SV5', 'Sinh viên 5', 0, '2022-11-20 01:34:10', '2022-11-20 01:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tencb` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `tencb`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bomon`
--
ALTER TABLE `bomon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `giangvien`
--
ALTER TABLE `giangvien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `giangvien_bmid_foreign` (`bmid`);

--
-- Indexes for table `gio`
--
ALTER TABLE `gio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hocki`
--
ALTER TABLE `hocki`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hocphan`
--
ALTER TABLE `hocphan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kehoach`
--
ALTER TABLE `kehoach`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kehoach_nkid_foreign` (`nkid`),
  ADD KEY `kehoach_hkid_foreign` (`hkid`);

--
-- Indexes for table `lichthi`
--
ALTER TABLE `lichthi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lophocphan`
--
ALTER TABLE `lophocphan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lophocphan_hkid_foreign` (`hkid`),
  ADD KEY `lophocphan_gvid_foreign` (`gvid`),
  ADD KEY `lophocphan_nkid_foreign` (`nkid`),
  ADD KEY `lophocphan_hpid_foreign` (`hpid`);

--
-- Indexes for table `lophocphan_sinhvien`
--
ALTER TABLE `lophocphan_sinhvien`
  ADD KEY `lophocphan_sinhvien_sinhvien_id_foreign` (`sinhvien_id`),
  ADD KEY `lophocphan_sinhvien_lophocphan_id_foreign` (`lophocphan_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ngay`
--
ALTER TABLE `ngay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nienkhoa`
--
ALTER TABLE `nienkhoa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bomon`
--
ALTER TABLE `bomon`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `giangvien`
--
ALTER TABLE `giangvien`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `gio`
--
ALTER TABLE `gio`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `hocki`
--
ALTER TABLE `hocki`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hocphan`
--
ALTER TABLE `hocphan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kehoach`
--
ALTER TABLE `kehoach`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lichthi`
--
ALTER TABLE `lichthi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lophocphan`
--
ALTER TABLE `lophocphan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `ngay`
--
ALTER TABLE `ngay`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nienkhoa`
--
ALTER TABLE `nienkhoa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phong`
--
ALTER TABLE `phong`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `giangvien`
--
ALTER TABLE `giangvien`
  ADD CONSTRAINT `giangvien_bmid_foreign` FOREIGN KEY (`bmid`) REFERENCES `bomon` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kehoach`
--
ALTER TABLE `kehoach`
  ADD CONSTRAINT `kehoach_hkid_foreign` FOREIGN KEY (`hkid`) REFERENCES `hocki` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kehoach_nkid_foreign` FOREIGN KEY (`nkid`) REFERENCES `nienkhoa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lophocphan`
--
ALTER TABLE `lophocphan`
  ADD CONSTRAINT `lophocphan_gvid_foreign` FOREIGN KEY (`gvid`) REFERENCES `giangvien` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lophocphan_hkid_foreign` FOREIGN KEY (`hkid`) REFERENCES `hocki` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lophocphan_hpid_foreign` FOREIGN KEY (`hpid`) REFERENCES `hocphan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lophocphan_nkid_foreign` FOREIGN KEY (`nkid`) REFERENCES `nienkhoa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lophocphan_sinhvien`
--
ALTER TABLE `lophocphan_sinhvien`
  ADD CONSTRAINT `lophocphan_sinhvien_lophocphan_id_foreign` FOREIGN KEY (`lophocphan_id`) REFERENCES `lophocphan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lophocphan_sinhvien_sinhvien_id_foreign` FOREIGN KEY (`sinhvien_id`) REFERENCES `sinhvien` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
