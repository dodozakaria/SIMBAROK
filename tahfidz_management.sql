-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2024 at 01:31 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tahfidz_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2024_04_29_072108_create_tahfidz', 1),
(4, '2024_04_29_072117_create_nilai', 1),
(5, '2024_05_24_010909_create_password_reset_tokens', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_ayat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `juz` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahfidz_id` bigint UNSIGNED NOT NULL,
  `users_id` bigint UNSIGNED NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `nama_surat`, `total_ayat`, `juz`, `tahfidz_id`, `users_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'At-Tawbah', '1', '23', 26, 7, '0', '2024-02-11 21:54:51', '2024-07-21 08:44:13'),
(2, 'Yunus', '213', '7', 17, 5, '0', '2024-01-11 01:39:48', '2024-06-30 02:44:53'),
(3, 'Al-Anfal', '186', '16', 22, 2, '0', '2023-10-14 10:23:43', '2024-07-08 17:02:29'),
(4, 'Al-Fatihah', '4', '30', 25, 2, '0', '2023-11-04 16:51:31', '2024-07-13 16:36:28'),
(5, 'Al-Maidah', '32', '11', 20, 2, '0', '2024-05-06 16:42:09', '2024-07-20 19:54:50'),
(6, 'Al-Maidah', '220', '14', 1, 3, '0', '2023-07-31 17:22:37', '2024-07-09 07:36:32'),
(7, 'Al-Anam', '225', '6', 2, 1, '0', '2024-01-13 02:59:02', '2024-07-17 03:41:24'),
(8, 'Al-Imran', '266', '13', 12, 4, '0', '2023-10-02 11:47:03', '2024-07-12 12:15:25'),
(9, 'Al-Anam', '109', '6', 25, 9, '0', '2023-12-16 23:45:08', '2024-07-15 11:05:46'),
(10, 'Al-Baqarah', '122', '19', 3, 10, '0', '2023-12-26 23:22:30', '2024-07-01 18:51:04'),
(11, 'Al-Baqarah', '108', '30', 9, 7, '0', '2024-01-21 07:00:44', '2024-07-21 08:33:36'),
(12, 'Al-Maidah', '93', '26', 22, 10, '0', '2023-12-17 11:56:42', '2024-07-06 07:48:51'),
(13, 'Al-Anfal', '38', '9', 22, 10, '0', '2024-05-08 04:34:15', '2024-07-22 22:18:37'),
(14, 'Al-Baqarah', '30', '12', 4, 5, '0', '2024-04-12 22:48:34', '2024-07-14 21:10:05'),
(15, 'Al-Maidah', '283', '14', 1, 9, '0', '2024-04-27 17:35:25', '2024-07-16 06:14:55'),
(16, 'Al-Fatihah', '113', '10', 16, 3, '0', '2023-12-12 19:47:34', '2024-07-27 00:10:12'),
(17, 'Al-Anam', '283', '8', 15, 7, '0', '2023-09-30 06:14:59', '2024-07-19 12:34:43'),
(18, 'Al-Anam', '181', '17', 4, 1, '0', '2024-05-09 11:09:05', '2024-07-16 21:12:00'),
(19, 'An-Nisa', '185', '12', 1, 7, '0', '2023-11-13 19:22:35', '2024-07-06 13:29:59'),
(20, 'At-Tawbah', '143', '5', 24, 4, '0', '2024-05-08 18:19:09', '2024-07-03 11:44:35'),
(21, 'An-Nisa', '68', '18', 19, 3, '0', '2024-06-09 22:16:43', '2024-07-22 16:34:18'),
(22, 'Al-Maidah', '54', '30', 16, 4, '0', '2024-01-22 10:54:58', '2024-07-09 22:18:22'),
(23, 'At-Tawbah', '8', '21', 25, 9, '0', '2023-07-07 15:56:41', '2024-07-22 04:40:59'),
(24, 'Al-Imran', '88', '5', 25, 1, '0', '2024-06-12 11:30:42', '2024-07-06 17:33:20'),
(25, 'Al-Fatihah', '121', '21', 1, 4, '0', '2023-12-01 05:37:28', '2024-07-08 07:48:01'),
(26, 'Al-Araf', '41', '21', 19, 1, '0', '2024-01-10 00:50:32', '2024-07-23 11:51:05'),
(27, 'Al-Fatihah', '199', '19', 2, 3, '0', '2023-12-01 20:08:26', '2024-07-09 18:44:32'),
(28, 'Al-Araf', '40', '22', 16, 6, '0', '2023-10-11 03:02:37', '2024-07-01 01:05:35'),
(29, 'Al-Anam', '28', '7', 16, 3, '0', '2023-12-06 22:39:43', '2024-07-09 23:04:09'),
(31, 'An Naba', '40', '30', 29, 12, '0', '2024-08-01 23:31:01', '2024-08-01 23:31:01'),
(32, 'An Naziat', '45', '30', 29, 12, '0', '2024-08-01 23:31:22', '2024-08-01 23:31:22'),
(33, 'Abasa', '30', '30', 29, 12, '0', '2024-08-01 23:31:45', '2024-08-01 23:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tahfidz`
--

CREATE TABLE `tahfidz` (
  `id` bigint UNSIGNED NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('ANAK_PONDOK','TPQ') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Aktif','Lulus') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `nama_ayah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ibu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tahfidz`
--

INSERT INTO `tahfidz` (`id`, `nis`, `nama`, `alamat`, `jenis_kelamin`, `kategori`, `status`, `tgl_lahir`, `nama_ayah`, `nama_ibu`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, NULL, 'DIKA HERIYANTO', 'RT 003 RW 003 KELURAHAN CENGKARENG BARAT KEC CENGKARENG', 'L', 'ANAK_PONDOK', 'Aktif', '2009-12-18', 'SUHERMAN', 'DIRAH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(2, NULL, 'ALFARIDHO NUZULUL QUR AN', 'DK. COCOK RT 017 RW03 DESA LUWIJAWA KEC. JATINEGARA', 'L', 'ANAK_PONDOK', 'Aktif', '2006-09-17', 'CRISNA ARIES SURATNO', 'KIA KARNITI', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(3, NULL, 'REDIKA ARDI SALAM', 'DK. KRAJAN RT 005 RW 002 DESA LEMBASARI KEC. JATINEGARA', 'L', 'ANAK_PONDOK', 'Aktif', '2007-10-13', 'ZAENAL ARIFIN', 'DAROZATUN', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(4, NULL, 'ARIS SETIAWAN SAPUTRA', 'DK. LEMAH GUGUR RT 001 RW 001 DESA LEMBASARI KEC. JATINEGARA', 'L', 'ANAK_PONDOK', 'Aktif', '2006-12-17', 'SARYO', 'FATMAWATI', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(5, NULL, 'MUCH. BAHTIAR', 'KP. BABAKAN POCIS RT 001 RW 001 KELURAHAN BAKTI JAYA TANGSEL', 'L', 'ANAK_PONDOK', 'Aktif', '2007-01-01', 'ANDIAWAN', 'SITI ANITAH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(6, NULL, 'FAIZUN ADITIA SAPUTRA', 'RT 007 RW 001 DESA KREMAN KEC. WARUREJA', 'L', 'ANAK_PONDOK', 'Aktif', '2011-05-14', 'PURWANTO', 'TOANAH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(7, NULL, 'MEIDY FACHRIL AL NEZAM', 'RT 003 RW 002 DESA KREMAN KEC. WARUREJA', 'L', 'ANAK_PONDOK', 'Aktif', '2010-05-27', 'KASMU', 'BAROKAH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(8, NULL, 'AHMAD MAULID ASSOLEH', 'RT 004 RW 001 DESA KREMAN KEC. WARUREJA', 'L', 'ANAK_PONDOK', 'Aktif', '2012-02-13', 'AHMAD SOLIHIN', 'ELI ERNAWATI', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(9, NULL, 'RIZQI SYAHRU RAMADHANI', 'RT 003 RW 002 DESA KREMAN KEC. WARUREJA', 'L', 'ANAK_PONDOK', 'Aktif', '2011-08-09', 'SUPRIYANTO', 'MURINAH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(10, NULL, 'ISNAENI HIDAYATI', 'DUKUH TENGAH RT 010 RW 002 DESA GANTUNGAN KEC. JATINEGARA', 'P', 'ANAK_PONDOK', 'Aktif', '2002-11-25', 'NUR ASKURI', 'MUTOLAAH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(11, NULL, 'MAULA ZIMATUL ULYA', 'DUSUN KRAJAN RT 026 RW 006 DESA MERENG KEC. WARUNGPRING', 'P', 'ANAK_PONDOK', 'Aktif', '2007-05-31', 'NURIDIN', 'SYAFAAH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(12, NULL, 'FATIMAH RO IKHATUZZAHRO', 'RT 006 RW 003 DESA LEMBASARI  KEC. JATINEGARA', 'P', 'ANAK_PONDOK', 'Aktif', '2010-04-04', 'SUHARJO', 'SITI KHOFIYAH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(13, NULL, 'NAELATUL HIDAYAH', 'KELURAHAN GONDRONG RT 008 RW 004 KEC. CIPONDOH', 'P', 'ANAK_PONDOK', 'Aktif', '2010-05-27', 'ALI SOBIRIN', 'SITI MINHAH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(14, NULL, 'AISYA QORIHAFIDZAH', 'TR 001 RW 001 TRIDAYASAKTI KEC. TAMBUN SELATAN', 'P', 'ANAK_PONDOK', 'Aktif', '2011-11-07', 'MOCH. KHAFID', 'SIRI NURMANIH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(15, NULL, 'QONITA AZZARIA', 'RT 006 RW 003 DESA LEMBASARI KEC. JATINEGARA', 'P', 'ANAK_PONDOK', 'Aktif', '2011-12-14', 'KARMO', 'SITI MASTUROH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(16, NULL, 'NUR OCTAVIANI', 'RT 007 RW 001 DESA KREMAN KEC. WARUREJA', 'P', 'ANAK_PONDOK', 'Aktif', '2010-10-27', 'SUJAK', 'CHOTIJAH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(17, NULL, 'NAJMI ZAENURANI', 'DK. KRAJAN RT 010 RW 002 DESA GANTUNGAN KEC. JATINEGARA', 'P', 'ANAK_PONDOK', 'Aktif', '2010-06-18', 'ARIF ZAENURANI', 'SLAMET SABAROH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(18, NULL, 'LUTFI HILMA AL IJAD', 'RT 006 RW 002 DESA LEMBASARI KEC. JATINEGARA', 'P', 'ANAK_PONDOK', 'Aktif', '2010-11-20', 'NASIRUN', 'SAETUL KHOPIYAH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(19, NULL, 'LULU SYIFA MAULIDA', 'RT 001 RW 004 DESA BANTAR BOLANG KEC. BANTAR BOLANG', 'P', 'ANAK_PONDOK', 'Aktif', '2011-03-06', 'SUHADI', 'WANISAH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(20, NULL, 'ADISTINA ROSADI ', 'PERUM ORCHID GREEN PARK BLOK K/9A TANGGERANG', 'P', 'ANAK_PONDOK', 'Aktif', '2010-09-30', 'ROSAD QOMARUDIN', 'KHOLIDAH SUCI SAFITRI', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(21, NULL, 'ISNAENI KHORUNNISA', 'JL. WIJAYA KUSUMA RT 01 RW 04 DESA BANTAR BOLANG PEMALANG', 'P', 'ANAK_PONDOK', 'Aktif', '2011-04-06', 'SANURI', 'SRIYATUN', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(22, NULL, 'NUR MAULIDA INDRIYANI ', 'RT 012 RW 003 DESA LUWIJAWA KEC. JATINEGARA', 'P', 'ANAK_PONDOK', 'Aktif', '2011-03-03', 'SUKHIP ISYANTO', 'SITI ROKHANAH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(23, NULL, 'DINDA LESTARI', 'DK. COCOK RT 017 RW 003 DESA LUWIJAWA KEC. JATINEGARA', 'P', 'ANAK_PONDOK', 'Aktif', '2007-11-26', 'SUMARNO', 'ITA PURNAMASARI', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(24, NULL, 'ANGGI PUTRI SOLEHA', 'DUKUH KRAJAN RT 06 RW 02 JATINEGARA TEGAL', 'P', 'ANAK_PONDOK', 'Aktif', '2013-04-18', 'SUNARTO', 'SUMAROH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(25, NULL, 'YURIKO QIARA KURNIAWAN', 'DESA JATINEGARA KEC. JATINEGARA KAB. TEGAL', 'P', 'ANAK_PONDOK', 'Aktif', '2012-08-20', 'HADI MAS KURNIAWAN', 'ALFITRI PRIYATIN', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(26, NULL, 'ZAETUN FATMAH', 'DUKUH COCOK RT 017 RW O3 DESA LUWIJAWA KEC. JATINEGARA', 'P', 'ANAK_PONDOK', 'Aktif', '2010-10-04', '-', 'HERNI SAPUROH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(27, NULL, 'AYU EMILIANA', 'DUKUH KRAJAN RT 003 RW 002 DESA LEMBASARI KEC. JATINEGARA', 'P', 'ANAK_PONDOK', 'Aktif', '2010-09-13', 'AGUS SUSANTO', 'WASRIYAH', NULL, '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(28, '124200728', 'WIDODO ZAKARIA SUMARDI', 'Desa Luwijawa RT 10/02 Kec. Jatinegara', 'L', 'ANAK_PONDOK', 'Aktif', '2003-03-28', '-', 'Sumirah', '2454554545', '2024-07-30 19:00:56', '2024-08-01 23:15:55'),
(29, '124200829', 'AGUS SISWANTORO', 'Desa Lembasri Rt 003 Rw 02', 'L', 'ANAK_PONDOK', 'Aktif', '2003-05-18', 'Yanto', 'Patimah', '08534688272', '2024-08-01 23:20:05', '2024-08-01 23:20:05'),
(30, '124200830', 'AHMAD MAULID ASSOLEH', 'RT 004 RW 001 DESA KREMAN KEC. WARUREJA', 'L', 'ANAK_PONDOK', 'Lulus', '2011-03-12', 'Ahmad Solihin', 'Wasriyah', '088905471444', '2024-08-01 23:23:57', '2024-08-01 23:23:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` enum('ADMIN','GURU','OPERATOR') COLLATE utf8mb4_unicode_ci NOT NULL,
  `gelar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nip`, `nama`, `email`, `status`, `roles`, `gelar`, `password`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Administrator', 'admin@gmail.com', '1', 'ADMIN', NULL, '$2y$10$ouKWK5uFNhiZiCuNKaUWx.07YBcDoKMw7rh8jg4.TAgwUhbhvRLaO', '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(2, NULL, 'Operator', 'operator@gmail.com', '1', 'OPERATOR', NULL, '$2y$10$CuowRtHBDz5Pd8e7jtE6ZOY1Y8rOQSH2cmcQRze3VeaYI/kKtFsgG', '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(3, NULL, 'SAEKHUDIN', 'saekhudin@gmail.com', '1', 'GURU', NULL, '$2y$10$CiNjykhI1oOYsxDPBaHEDuHqX/DMjDr8IL/.MgwT0ZPdhT/YdxgaK', '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(4, NULL, 'AHMAD AGUS SALIM', 'ahmad@gmail.com', '1', 'GURU', NULL, '$2y$10$dghqRvtwUHkQV1MmMp0/n.sTCltddeljgsgmEcGdbQwnTIR4jVhIa', '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(5, NULL, 'NURFATHI', 'nurfathi@gmail.com', '1', 'GURU', NULL, '$2y$10$xjT1JdopwDblbq4JtaaHA.51yDXYcjq0NyUfkzCYy79MwaT71ghRO', '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(6, NULL, 'MUHAMAD RIFAI', 'rifai@gmail.com', '1', 'GURU', NULL, '$2y$10$E4uDm4fOYDeqQMoBMsEOp.e7rTVWOzntTuT92Iq51iHWREQZi.FY6', '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(7, NULL, 'MUHAMAD HOLIL', 'holil@gmail.com', '1', 'GURU', NULL, '$2y$10$VPbpuXPt4tnixzJtNsCBoeMieidM5RKewkG6hgJDjL.x6oc0sU4vC', '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(9, NULL, 'NUR INDAH RAHMAWATI', 'indah@gmail.com', '1', 'GURU', NULL, '$2y$10$lvi2xhUUY8/AbBNIQjRAf.66Noci6EEOLPesLcKEenhVwJo.M9pz.', '2024-07-30 18:55:30', '2024-07-30 18:55:30'),
(10, NULL, 'NUR HIDAYATUN', 'hidayatun@gmail.com', '1', 'GURU', NULL, '$2y$10$gogD.dUpq82rhPvLl0GslOdD8iC7dheupN5.PMqTEImazy/TBlNpm', '2024-07-30 18:55:30', '2024-08-01 23:09:59'),
(11, '024200709', 'WIDODO ZAKARIA', 'widodozakaria3@gmail.com', '1', 'GURU', 'Hafidz', '$2y$10$qeZuOowKZN7zV9YZuexTmu.fAurlmS6BRCngAciStZQFHzrvvouka', '2024-07-30 18:58:15', '2024-07-30 18:58:15'),
(12, '024200809', 'MUSDALIFAH', 'musdalifah@gmail.com', '1', 'GURU', 'Hafidzoh', '$2y$10$q/J2XdlNM.I0zpDyhrAOkeL2IwYDiPOH7p73LJmF23a.ggdTv3Vt2', '2024-08-01 23:29:03', '2024-08-01 23:29:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_tahfidz_id_foreign` (`tahfidz_id`),
  ADD KEY `nilai_users_id_foreign` (`users_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tahfidz`
--
ALTER TABLE `tahfidz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahfidz`
--
ALTER TABLE `tahfidz`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_tahfidz_id_foreign` FOREIGN KEY (`tahfidz_id`) REFERENCES `tahfidz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
