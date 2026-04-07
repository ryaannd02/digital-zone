-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 07, 2026 at 04:05 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital_zone`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamats`
--

CREATE TABLE `alamats` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_lengkap` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` enum('rumah','kantor') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alamats`
--

INSERT INTO `alamats` (`id`, `user_id`, `nama_penerima`, `no_telepon`, `alamat_lengkap`, `label`, `is_primary`, `created_at`, `updated_at`) VALUES
(1, 1, 'Achmad Riyandi', '082110328921', 'Jl. Raya Sawangan No.1, Rangkapan Jaya, Kec. Pancoran Mas, Kota Depok, Jawa Barat 16435', 'rumah', 1, '2026-03-23 13:58:23', '2026-04-05 13:48:09'),
(3, 1, 'Faiz Syawaludin', '082321404971', 'Jalan Raya Tanah Baru RT08 RW09 Kelurahan Beji Depok Jawa Barat 16528', 'rumah', 0, '2026-04-06 02:58:33', '2026-04-06 02:58:33'),
(4, 1, 'Rahmat Tahalu', '0812387618378', 'Jalan Pegangsaan Raya Jakarta Pusat Daerah Khusus Ibukota Jakarta 12652', 'rumah', 0, '2026-04-06 02:59:40', '2026-04-06 02:59:40'),
(5, 7, 'Achmad Riyandi', '082110328921', 'jalan kopi', 'rumah', 1, '2026-04-07 00:55:12', '2026-04-07 00:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Handphone', '2026-03-23 13:57:40', '2026-03-23 13:57:40'),
(2, 'Laptop', '2026-03-23 13:57:40', '2026-03-23 13:57:40'),
(3, 'Smartwatch', '2026-03-23 13:57:40', '2026-03-23 13:57:40'),
(4, 'Aksesoris', '2026-03-23 13:57:40', '2026-03-23 13:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `keranjangs`
--

CREATE TABLE `keranjangs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `produk_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keranjangs`
--

INSERT INTO `keranjangs` (`id`, `user_id`, `produk_id`, `qty`, `created_at`, `updated_at`) VALUES
(22, 1, 14, 3, '2026-04-06 12:28:34', '2026-04-06 13:25:48'),
(24, 1, 7, 3, '2026-04-07 00:10:51', '2026-04-07 00:10:51');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_18_155215_add_role_to_users_table', 1),
(5, '2026_02_18_155216_create_alamats_table', 1),
(6, '2026_02_18_155217_create_kategoris_table', 1),
(7, '2026_02_18_155217_create_produks_table', 1),
(8, '2026_02_18_155218_create_keranjangs_table', 1),
(9, '2026_02_18_155219_create_pesanans_table', 1),
(10, '2026_02_18_155220_create_pesanan_details_table', 1),
(11, '2026_02_20_163724_add_3_gambar_to_produks_table', 1),
(12, '2026_02_20_164743_drop_gambar_from_produks_table', 1),
(13, '2026_02_24_111942_add_is_active_to_produks_table', 1),
(14, '2026_04_01_194713_create_notifications_table', 2),
(16, '2026_04_02_205001_add_expired_at_to_pesanans_table', 3),
(17, '2026_04_03_175141_add_unique_kode_to_pesanans', 4),
(18, '2026_04_04_174905_add_payment_fields_to_pesanans', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `title`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 'status', 'Pesanan Diproses 📦', 'Pesanan #6 sedang diproses.', 1, '2026-04-01 13:24:19', '2026-04-07 04:03:41'),
(2, 1, 'status', 'Pesanan Dikirim 🚚', 'Pesanan #6 sedang dalam pengiriman.', 1, '2026-04-01 13:24:27', '2026-04-07 04:03:41'),
(3, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #7 berhasil dibuat dengan total Rp 59,000. Silakan lakukan pembayaran.', 1, '2026-04-01 13:40:42', '2026-04-07 04:03:41'),
(4, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #8 berhasil dibuat dengan total Rp 713,000. Silakan lakukan pembayaran.', 1, '2026-04-01 13:41:36', '2026-04-07 04:03:41'),
(5, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #9 berhasil dibuat dengan total Rp 1,513,900. Silakan lakukan pembayaran.', 1, '2026-04-02 14:24:47', '2026-04-07 04:03:41'),
(6, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #10 berhasil dibuat dengan total Rp 16,513,000. Silakan lakukan pembayaran.', 1, '2026-04-02 14:36:38', '2026-04-07 04:03:41'),
(7, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #11 berhasil dibuat dengan total Rp 2,513,000. Silakan lakukan pembayaran.', 1, '2026-04-02 14:52:55', '2026-04-07 04:03:41'),
(8, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan #11 dibatalkan karena tidak dibayar dalam 10 menit.', 1, '2026-04-02 15:09:30', '2026-04-07 04:03:41'),
(9, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #12 berhasil dibuat dengan total Rp 3,413,000. Silakan lakukan pembayaran.', 1, '2026-04-02 15:12:58', '2026-04-07 04:03:41'),
(10, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #13 berhasil dibuat dengan total Rp 3,413,000. Silakan lakukan pembayaran.', 1, '2026-04-02 15:14:08', '2026-04-07 04:03:41'),
(11, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan #12 dibatalkan karena tidak dibayar dalam 10 menit.', 1, '2026-04-02 15:40:31', '2026-04-07 04:03:41'),
(12, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan #13 dibatalkan karena tidak dibayar dalam 10 menit.', 1, '2026-04-02 15:40:31', '2026-04-07 04:03:41'),
(13, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #14 berhasil dibuat dengan total Rp 16,513,000. Silakan lakukan pembayaran.', 1, '2026-04-02 15:40:47', '2026-04-07 04:03:41'),
(14, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #15 berhasil dibuat dengan total Rp 3,013,000. Silakan lakukan pembayaran.', 1, '2026-04-03 09:20:52', '2026-04-07 04:03:41'),
(15, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #16 berhasil dibuat dengan total Rp 19,513,000. Silakan lakukan pembayaran.', 1, '2026-04-03 09:27:37', '2026-04-07 04:03:41'),
(16, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #17 berhasil dibuat dengan total Rp 413,000. Silakan lakukan pembayaran.', 1, '2026-04-03 09:39:30', '2026-04-07 04:03:41'),
(17, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #18 berhasil dibuat dengan total Rp 3,013,000. Silakan lakukan pembayaran.', 1, '2026-04-03 09:47:05', '2026-04-07 04:03:41'),
(18, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #19 berhasil dibuat dengan total Rp 28,013,000. Silakan lakukan pembayaran.', 1, '2026-04-03 09:56:01', '2026-04-07 04:03:41'),
(19, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan #14 dibatalkan karena tidak dibayar dalam 10 menit.', 1, '2026-04-03 10:09:16', '2026-04-07 04:03:41'),
(20, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan #15 dibatalkan karena tidak dibayar dalam 10 menit.', 1, '2026-04-03 10:09:16', '2026-04-07 04:03:41'),
(21, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan #16 dibatalkan karena tidak dibayar dalam 10 menit.', 1, '2026-04-03 10:09:16', '2026-04-07 04:03:41'),
(22, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan #17 dibatalkan karena tidak dibayar dalam 10 menit.', 1, '2026-04-03 10:09:16', '2026-04-07 04:03:41'),
(23, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan #18 dibatalkan karena tidak dibayar dalam 10 menit.', 1, '2026-04-03 10:09:16', '2026-04-07 04:03:41'),
(24, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan #19 dibatalkan karena tidak dibayar dalam 10 menit.', 1, '2026-04-03 10:09:16', '2026-04-07 04:03:41'),
(25, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #20 berhasil dibuat dengan total Rp 2,513,000. Silakan lakukan pembayaran.', 1, '2026-04-03 10:09:45', '2026-04-07 04:03:41'),
(26, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #21 berhasil dibuat dengan total Rp 3,513,000. Silakan lakukan pembayaran.', 1, '2026-04-03 10:16:24', '2026-04-07 04:03:41'),
(27, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan #21 dibatalkan karena tidak dibayar dalam 10 menit.', 1, '2026-04-03 10:27:12', '2026-04-07 04:03:41'),
(28, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #22 berhasil dibuat dengan total Rp 25,763,000. Silakan lakukan pembayaran.', 1, '2026-04-03 10:28:55', '2026-04-07 04:03:41'),
(29, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #23 berhasil dibuat dengan total Rp 17,013,000. Silakan lakukan pembayaran.', 1, '2026-04-03 10:29:41', '2026-04-07 04:03:41'),
(30, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-17762221 berhasil dibuat dengan total Rp 15,013,000. Silakan lakukan pembayaran.', 1, '2026-04-03 11:13:13', '2026-04-07 04:03:41'),
(31, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-40209112 berhasil dibuat dengan total Rp 4,313,000. Silakan lakukan pembayaran.', 1, '2026-04-03 11:20:55', '2026-04-07 04:03:41'),
(32, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan DGZ-40209112 sedang diproses oleh penjual.', 1, '2026-04-03 11:20:55', '2026-04-07 04:03:41'),
(33, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan DGZ-53652657 sedang diproses oleh penjual.', 1, '2026-04-03 11:22:34', '2026-04-07 04:03:41'),
(34, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-53652657 berhasil dibuat dengan total Rp 15,013,000. Silakan lakukan pembayaran.', 1, '2026-04-03 11:22:34', '2026-04-07 04:03:41'),
(35, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-3737503 berhasil dibuat dengan total Rp 17,013,000. Silakan lakukan pembayaran.', 1, '2026-04-03 11:34:56', '2026-04-07 04:03:41'),
(36, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-3737503 sedang diproses oleh penjual.', 1, '2026-04-03 11:35:18', '2026-04-07 04:03:41'),
(37, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-20570 berhasil dibuat dengan total Rp 29,612,000. Silakan lakukan pembayaran.', 1, '2026-04-03 11:37:03', '2026-04-07 04:03:41'),
(38, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-20570 sedang diproses oleh penjual.', 1, '2026-04-03 11:37:25', '2026-04-07 04:03:41'),
(39, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-30221199 berhasil dibuat dengan total Rp 28,013,000. Silakan lakukan pembayaran.', 1, '2026-04-03 11:42:27', '2026-04-07 04:03:41'),
(40, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan #DGZ-30221199 dibatalkan karena tidak dibayar dalam 10 menit.', 1, '2026-04-03 11:55:54', '2026-04-07 04:03:41'),
(41, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-20925785 berhasil dibuat dengan total Rp 1,143,000. Silakan lakukan pembayaran.', 1, '2026-04-03 11:56:17', '2026-04-07 04:03:41'),
(42, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan #DGZ-20925785 dibatalkan karena tidak dibayar dalam 10 menit.', 1, '2026-04-03 12:56:22', '2026-04-07 04:03:41'),
(43, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan DGZ-80333822 berhasil dibuat dengan total Rp 413,000. Silakan lakukan pembayaran.', 1, '2026-04-03 14:41:24', '2026-04-07 04:03:41'),
(44, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-80333822 sedang diproses oleh penjual.', 1, '2026-04-03 14:43:42', '2026-04-07 04:03:41'),
(45, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-62655900 berhasil dibuat dengan total Rp 3,013,000. Silakan lakukan pembayaran.', 1, '2026-04-03 15:06:02', '2026-04-07 04:03:41'),
(46, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-62655900 sedang diproses oleh penjual.', 1, '2026-04-03 15:06:31', '2026-04-07 04:03:41'),
(47, 1, 'status', 'Pesanan Dikirim 🚚', 'Pesanan DGZ-62655900 sedang dalam pengiriman.', 1, '2026-04-03 15:14:48', '2026-04-07 04:03:41'),
(48, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-98681749 sedang diproses oleh penjual.', 1, '2026-04-04 09:02:51', '2026-04-07 04:03:41'),
(49, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-17762221 sedang diproses oleh penjual.', 1, '2026-04-04 09:02:51', '2026-04-07 04:03:41'),
(50, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-53652657 sedang diproses oleh penjual.', 1, '2026-04-04 09:02:52', '2026-04-07 04:03:41'),
(51, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-80333822 sedang diproses oleh penjual.', 1, '2026-04-04 09:02:53', '2026-04-07 04:03:41'),
(52, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-3737503 sedang diproses oleh penjual.', 1, '2026-04-04 09:02:53', '2026-04-07 04:03:41'),
(53, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-40209112 sedang diproses oleh penjual.', 1, '2026-04-04 09:02:54', '2026-04-07 04:03:41'),
(54, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-72626965 sedang diproses oleh penjual.', 1, '2026-04-04 09:02:55', '2026-04-07 04:03:41'),
(55, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-62655900 sedang diproses oleh penjual.', 1, '2026-04-04 09:02:55', '2026-04-07 04:03:41'),
(56, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-20570 sedang diproses oleh penjual.', 1, '2026-04-04 09:02:56', '2026-04-07 04:03:41'),
(57, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-10530546 berhasil dibuat dengan total Rp 3,513,000. Silakan lakukan pembayaran.', 1, '2026-04-04 11:01:12', '2026-04-07 04:03:41'),
(58, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-10530546 sedang diproses oleh penjual.', 1, '2026-04-04 11:01:40', '2026-04-07 04:03:41'),
(59, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-91889815 berhasil dibuat dengan total Rp 9,013,000. Silakan lakukan pembayaran.', 1, '2026-04-04 11:03:07', '2026-04-07 04:03:41'),
(60, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-91889815 sedang diproses oleh penjual.', 1, '2026-04-04 11:03:38', '2026-04-07 04:03:41'),
(61, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-68815675 berhasil dibuat dengan total Rp 21,021,000. Silakan lakukan pembayaran.', 1, '2026-04-04 11:13:26', '2026-04-07 04:03:41'),
(62, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan DGZ-68815675 dibatalkan karena tidak dibayar dalam 10 menit.', 1, '2026-04-04 11:27:09', '2026-04-07 04:03:41'),
(63, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-48100705 berhasil dibuat dengan total Rp 2,513,000. Silakan lakukan pembayaran.', 1, '2026-04-04 11:27:25', '2026-04-07 04:03:41'),
(64, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan DGZ-48100705 dibatalkan karena tidak dibayar dalam 10 menit.', 1, '2026-04-04 11:42:14', '2026-04-07 04:03:41'),
(65, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-1014429 berhasil dibuat dengan total Rp 4,013,000. Silakan lakukan pembayaran.', 1, '2026-04-04 11:42:28', '2026-04-07 04:03:41'),
(66, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan DGZ-1014429 dibatalkan karena tidak dibayar dalam 10 menit.', 1, '2026-04-04 12:01:19', '2026-04-07 04:03:41'),
(67, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-63696350 berhasil dibuat dengan total Rp 193,000. Silakan lakukan pembayaran.', 1, '2026-04-04 12:01:50', '2026-04-07 04:03:41'),
(68, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-63696350 sedang diproses oleh penjual.', 1, '2026-04-04 12:02:21', '2026-04-07 04:03:41'),
(69, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-84375544 berhasil dibuat dengan total Rp 14,813,000. Silakan lakukan pembayaran.', 1, '2026-04-04 12:11:27', '2026-04-07 04:03:41'),
(70, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-84375544 sedang diproses oleh penjual.', 1, '2026-04-04 12:11:54', '2026-04-07 04:03:41'),
(71, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-41393591 berhasil dibuat dengan total Rp 1,143,000. Silakan lakukan pembayaran.', 1, '2026-04-04 12:43:52', '2026-04-07 04:03:41'),
(72, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-41393591 sedang diproses oleh penjual.', 1, '2026-04-04 12:44:23', '2026-04-07 04:03:41'),
(73, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-39479190 berhasil dibuat dengan total Rp 27,013,000. Silakan lakukan pembayaran.', 1, '2026-04-04 12:53:41', '2026-04-07 04:03:41'),
(74, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-39479190 sedang diproses oleh penjual.', 1, '2026-04-04 12:54:17', '2026-04-07 04:03:41'),
(75, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-8950827 berhasil dibuat dengan total Rp 14,813,000. Silakan lakukan pembayaran.', 1, '2026-04-05 06:29:35', '2026-04-07 04:03:41'),
(76, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-8950827 sedang diproses oleh penjual.', 1, '2026-04-05 06:30:08', '2026-04-07 04:03:41'),
(77, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan #DGZ-28972933 berhasil dibuat dengan total Rp 15,013,000. Silakan lakukan pembayaran.', 1, '2026-04-05 06:45:51', '2026-04-07 04:03:41'),
(78, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan dengan kode #DGZ-87060397 berhasil dibuat dengan total pembayaran sebesar Rp 17,013,000. Silakan segera melakukan pembayaran sesuai metode yang tersedia agar pesanan dapat segera diproses oleh sistem kami.', 1, '2026-04-05 09:00:31', '2026-04-07 04:03:41'),
(79, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-1014429 sedang diproses oleh penjual.', 1, '2026-04-05 09:02:26', '2026-04-07 04:03:41'),
(80, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-48100705 sedang diproses oleh penjual.', 1, '2026-04-05 09:02:27', '2026-04-07 04:03:41'),
(81, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan dengan kode #DGZ-43310917 berhasil dibuat dengan total pembayaran sebesar Rp 238,000. Silakan segera melakukan pembayaran sesuai metode yang tersedia agar pesanan dapat segera diproses oleh sistem kami.', 1, '2026-04-05 13:23:59', '2026-04-07 04:03:41'),
(82, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-43310917 sedang diproses oleh penjual.', 1, '2026-04-05 13:25:23', '2026-04-07 04:03:41'),
(83, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan dengan kodeDGZ-28972933 telah dibatalkan secara otomatis karena tidak dilakukan pembayaran dalam batas waktu 10 menit. Silakan lakukan pemesanan ulang apabila masih ingin melanjutkan pembelian produk tersebut.', 1, '2026-04-05 15:20:24', '2026-04-07 04:03:41'),
(84, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan dengan kodeDGZ-87060397 telah dibatalkan secara otomatis karena tidak dilakukan pembayaran dalam batas waktu 10 menit. Silakan lakukan pemesanan ulang apabila masih ingin melanjutkan pembelian produk tersebut.', 1, '2026-04-05 15:20:24', '2026-04-07 04:03:41'),
(85, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan dengan kode #DGZ-51320653 berhasil dibuat dengan total pembayaran sebesar Rp 59,000. Silakan segera melakukan pembayaran sesuai metode yang tersedia agar pesanan dapat segera diproses oleh sistem kami.', 1, '2026-04-05 15:20:53', '2026-04-07 04:03:41'),
(86, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan dengan kodeDGZ-51320653 telah dibatalkan secara otomatis karena tidak dilakukan pembayaran dalam batas waktu 10 menit. Silakan lakukan pemesanan ulang apabila masih ingin melanjutkan pembelian produk tersebut.', 1, '2026-04-05 15:31:30', '2026-04-07 04:03:41'),
(87, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan dengan kode #DGZ-35237526 berhasil dibuat dengan total pembayaran sebesar Rp 3,021,000. Silakan segera melakukan pembayaran sesuai metode yang tersedia agar pesanan dapat segera diproses oleh sistem kami.', 1, '2026-04-05 15:48:51', '2026-04-07 04:03:41'),
(88, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan dengan kodeDGZ-35237526 telah dibatalkan secara otomatis karena tidak dilakukan pembayaran dalam batas waktu 10 menit. Silakan lakukan pemesanan ulang apabila masih ingin melanjutkan pembelian produk tersebut.', 1, '2026-04-06 01:09:43', '2026-04-07 04:03:41'),
(89, 1, 'status', 'Pesanan Diproses 📦', 'Status pesanan Anda dengan kode DGZ-43310917 telah diperbarui. Silakan cek detail pesanan untuk informasi lebih lanjut mengenai perubahan yang terjadi.', 1, '2026-04-06 01:19:34', '2026-04-07 04:03:41'),
(90, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan dengan kode #DGZ-85717485 berhasil dibuat dengan total pembayaran sebesar Rp 24,521,000. Silakan segera melakukan pembayaran sesuai metode yang tersedia agar pesanan dapat segera diproses oleh sistem kami.', 1, '2026-04-06 06:00:52', '2026-04-07 04:03:41'),
(91, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan dengan kode #DGZ-82775384 berhasil dibuat dengan total pembayaran sebesar Rp 24,521,000. Silakan segera melakukan pembayaran sesuai metode yang tersedia agar pesanan dapat segera diproses oleh sistem kami.', 1, '2026-04-06 06:01:02', '2026-04-07 04:03:41'),
(92, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan dengan kode #DGZ-45305751 berhasil dibuat dengan total pembayaran sebesar Rp 24,521,000. Silakan segera melakukan pembayaran sesuai metode yang tersedia agar pesanan dapat segera diproses oleh sistem kami.', 1, '2026-04-06 06:01:05', '2026-04-07 04:03:41'),
(93, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan dengan kode #DGZ-10693862 berhasil dibuat dengan total pembayaran sebesar Rp 24,521,000. Silakan segera melakukan pembayaran sesuai metode yang tersedia agar pesanan dapat segera diproses oleh sistem kami.', 1, '2026-04-06 06:02:04', '2026-04-07 04:03:41'),
(94, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-10693862 sedang diproses oleh penjual.', 1, '2026-04-06 06:10:40', '2026-04-07 04:03:41'),
(95, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan dengan kodeDGZ-85717485 telah dibatalkan secara otomatis karena tidak dilakukan pembayaran dalam batas waktu 10 menit. Silakan lakukan pemesanan ulang apabila masih ingin melanjutkan pembelian produk tersebut.', 1, '2026-04-06 06:11:12', '2026-04-07 04:03:41'),
(96, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan dengan kodeDGZ-82775384 telah dibatalkan secara otomatis karena tidak dilakukan pembayaran dalam batas waktu 10 menit. Silakan lakukan pemesanan ulang apabila masih ingin melanjutkan pembelian produk tersebut.', 1, '2026-04-06 06:11:12', '2026-04-07 04:03:41'),
(97, 1, 'payment', 'Pembayaran Gagal ❌', 'Pesanan dengan kodeDGZ-45305751 telah dibatalkan secara otomatis karena tidak dilakukan pembayaran dalam batas waktu 10 menit. Silakan lakukan pemesanan ulang apabila masih ingin melanjutkan pembelian produk tersebut.', 1, '2026-04-06 06:11:12', '2026-04-07 04:03:41'),
(98, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan dengan kode #DGZ-72027651 berhasil dibuat dengan total pembayaran sebesar Rp 25,763,000. Silakan segera melakukan pembayaran sesuai metode yang tersedia agar pesanan dapat segera diproses oleh sistem kami.', 1, '2026-04-06 06:11:54', '2026-04-07 04:03:41'),
(99, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-72027651 sedang diproses oleh penjual.', 1, '2026-04-06 06:12:27', '2026-04-07 04:03:41'),
(100, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan dengan kode #DGZ-7764364 berhasil dibuat dengan total pembayaran sebesar Rp 25,757,000. Silakan segera melakukan pembayaran sesuai metode yang tersedia agar pesanan dapat segera diproses oleh sistem kami.', 1, '2026-04-06 06:12:56', '2026-04-07 04:03:41'),
(101, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-7764364 sedang diproses oleh penjual.', 1, '2026-04-06 06:13:50', '2026-04-07 04:03:41'),
(102, 1, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan dengan kode #DGZ-99664202 berhasil dibuat dengan total pembayaran sebesar Rp 380,000. Silakan segera melakukan pembayaran sesuai metode yang tersedia agar pesanan dapat segera diproses oleh sistem kami.', 1, '2026-04-06 13:27:27', '2026-04-07 04:03:41'),
(103, 1, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-99664202 sedang diproses oleh penjual.', 1, '2026-04-06 13:28:13', '2026-04-07 04:03:41'),
(104, 7, 'checkout', 'Pesanan Berhasil Dibuat 🎉', 'Pesanan dengan kode #DGZ-31887449 berhasil dibuat dengan total pembayaran sebesar Rp 51,520,000. Silakan segera melakukan pembayaran sesuai metode yang tersedia agar pesanan dapat segera diproses oleh sistem kami.', 1, '2026-04-07 01:16:22', '2026-04-07 01:19:34'),
(105, 7, 'order', 'Pesanan Diproses 📦', 'Pesanan #DGZ-31887449 sedang diproses oleh penjual.', 1, '2026-04-07 01:17:01', '2026-04-07 01:19:34'),
(106, 7, 'status', 'Pesanan Diproses 📦', 'Status pesanan Anda dengan kode DGZ-31887449 telah diperbarui. Silakan cek detail pesanan untuk informasi lebih lanjut mengenai perubahan yang terjadi.', 0, '2026-04-07 01:21:12', '2026-04-07 01:21:12'),
(107, 7, 'status', 'Pesanan Diproses 📦', 'Status pesanan Anda dengan kode DGZ-31887449 telah diperbarui. Silakan cek detail pesanan untuk informasi lebih lanjut mengenai perubahan yang terjadi.', 0, '2026-04-07 01:21:33', '2026-04-07 01:21:33'),
(108, 7, 'status', 'Pesanan Diproses 📦', 'Status pesanan Anda dengan kode DGZ-31887449 telah diperbarui. Silakan cek detail pesanan untuk informasi lebih lanjut mengenai perubahan yang terjadi.', 0, '2026-04-07 01:21:38', '2026-04-07 01:21:38'),
(109, 1, 'status', 'Pesanan Diproses 📦', 'Status pesanan Anda dengan kode DGZ-99664202 telah diperbarui. Silakan cek detail pesanan untuk informasi lebih lanjut mengenai perubahan yang terjadi.', 1, '2026-04-07 01:21:52', '2026-04-07 04:03:41'),
(110, 1, 'status', 'Pesanan Diproses 📦', 'Status pesanan Anda dengan kode DGZ-99664202 telah diperbarui. Silakan cek detail pesanan untuk informasi lebih lanjut mengenai perubahan yang terjadi.', 1, '2026-04-07 01:26:57', '2026-04-07 04:03:41'),
(111, 1, 'status', 'Pesanan Diproses 📦', 'Status pesanan Anda dengan kode DGZ-99664202 telah diperbarui. Silakan cek detail pesanan untuk informasi lebih lanjut mengenai perubahan yang terjadi.', 1, '2026-04-07 01:28:23', '2026-04-07 04:03:41'),
(112, 1, 'status', 'Pesanan Dikirim 🚚', 'Pesanan dengan kode DGZ-99664202 saat ini sedang dalam proses pengiriman oleh kurir. Mohon menunggu hingga paket sampai ke alamat tujuan. Pastikan nomor yang Anda cantumkan aktif agar kurir dapat menghubungi jika diperlukan.', 1, '2026-04-07 01:44:37', '2026-04-07 04:03:41'),
(113, 1, 'status', 'Pesanan Selesai ✅', 'Pesanan dengan kode DGZ-99664202 telah berhasil diselesaikan dan diterima. Terima kasih telah berbelanja bersama kami. Semoga produk yang Anda terima sesuai dengan harapan dan memberikan kepuasan.', 1, '2026-04-07 01:44:42', '2026-04-07 04:03:41'),
(114, 7, 'status', 'Pesanan Dikirim 🚚', 'Pesanan dengan kode DGZ-31887449 saat ini sedang dalam proses pengiriman oleh kurir. Mohon menunggu hingga paket sampai ke alamat tujuan. Pastikan nomor yang Anda cantumkan aktif agar kurir dapat menghubungi jika diperlukan.', 0, '2026-04-07 01:44:59', '2026-04-07 01:44:59'),
(115, 7, 'status', 'Pesanan Selesai ✅', 'Pesanan dengan kode DGZ-31887449 telah berhasil diselesaikan dan diterima. Terima kasih telah berbelanja bersama kami. Semoga produk yang Anda terima sesuai dengan harapan dan memberikan kepuasan.', 0, '2026-04-07 01:45:03', '2026-04-07 01:45:03');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanans`
--

CREATE TABLE `pesanans` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `alamat_id` bigint UNSIGNED DEFAULT NULL,
  `layanan_pengiriman` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ongkir` int NOT NULL DEFAULT '0',
  `total_harga` int NOT NULL,
  `total_bayar` int NOT NULL DEFAULT '0',
  `payment_status` enum('pending','paid','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `order_status` enum('tertunda','diproses','dikirim','selesai','gagal') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanans`
--

INSERT INTO `pesanans` (`id`, `kode`, `user_id`, `alamat_id`, `layanan_pengiriman`, `ongkir`, `total_harga`, `total_bayar`, `payment_status`, `order_status`, `created_at`, `expired_at`, `updated_at`, `payment_method`, `payment_detail`) VALUES
(5, 'DGZ-97733567', 1, 1, 'reguler', 14000, 179000, 193000, 'paid', 'diproses', '2026-03-31 15:22:41', '2026-03-31 15:32:41', '2026-04-03 10:54:09', NULL, NULL),
(6, 'DGZ-83672172', 1, 1, 'reguler', 14000, 358000, 372000, 'paid', 'selesai', '2026-03-31 16:13:54', '2026-03-31 16:23:54', '2026-04-07 03:20:06', NULL, NULL),
(7, 'DGZ-82446952', 1, NULL, 'reguler', 14000, 45000, 59000, 'paid', 'diproses', '2026-04-01 13:40:42', '2026-04-01 13:50:42', '2026-04-03 10:54:09', NULL, NULL),
(8, 'DGZ-5391686', 1, NULL, 'reguler', 14000, 699000, 713000, 'paid', 'diproses', '2026-04-01 13:41:36', '2026-04-01 13:51:36', '2026-04-03 10:54:09', NULL, NULL),
(11, 'DGZ-74169524', 1, NULL, 'reguler', 14000, 2499000, 2513000, 'failed', 'gagal', '2026-04-02 14:52:55', '2026-04-02 15:02:55', '2026-04-03 10:54:09', NULL, NULL),
(12, 'DGZ-67350787', 1, NULL, 'reguler', 14000, 3399000, 3413000, 'failed', 'gagal', '2026-04-02 15:12:58', '2026-04-02 15:22:58', '2026-04-03 10:54:09', NULL, NULL),
(13, 'DGZ-89444621', 1, NULL, 'reguler', 14000, 3399000, 3413000, 'failed', 'gagal', '2026-04-02 15:14:08', '2026-04-02 15:24:08', '2026-04-03 10:54:09', NULL, NULL),
(14, 'DGZ-68530498', 1, NULL, 'reguler', 14000, 16499000, 16513000, 'failed', 'gagal', '2026-04-02 15:40:47', '2026-04-02 15:50:47', '2026-04-03 10:54:09', NULL, NULL),
(15, 'DGZ-91341099', 1, NULL, 'reguler', 14000, 2999000, 3013000, 'failed', 'gagal', '2026-04-03 09:20:52', '2026-04-03 09:30:52', '2026-04-03 10:54:09', NULL, NULL),
(16, 'DGZ-82608462', 1, NULL, 'reguler', 14000, 19499000, 19513000, 'failed', 'gagal', '2026-04-03 09:27:37', '2026-04-03 09:37:37', '2026-04-03 10:54:09', NULL, NULL),
(17, 'DGZ-23474309', 1, NULL, 'reguler', 14000, 399000, 413000, 'failed', 'gagal', '2026-04-03 09:39:30', '2026-04-03 09:49:30', '2026-04-03 10:54:09', NULL, NULL),
(18, 'DGZ-102961', 1, NULL, 'reguler', 14000, 2999000, 3013000, 'failed', 'gagal', '2026-04-03 09:47:05', '2026-04-03 09:57:05', '2026-04-03 10:54:09', NULL, NULL),
(19, 'DGZ-30668848', 1, 1, 'reguler', 14000, 27999000, 28013000, 'failed', 'gagal', '2026-04-03 09:56:01', '2026-04-03 10:06:01', '2026-04-03 10:54:09', NULL, NULL),
(21, 'DGZ-14685132', 1, NULL, 'reguler', 14000, 3499000, 3513000, 'failed', 'gagal', '2026-04-03 10:16:24', '2026-04-03 10:26:24', '2026-04-03 10:54:09', NULL, NULL),
(22, 'DGZ-98681749', 1, 1, 'reguler', 14000, 25749000, 25763000, 'paid', 'diproses', '2026-04-03 10:28:55', '2026-04-03 10:38:55', '2026-04-03 10:54:09', NULL, NULL),
(23, 'DGZ-72626965', 1, 1, 'reguler', 14000, 16999000, 17013000, 'paid', 'diproses', '2026-04-03 10:29:41', '2026-04-03 10:39:41', '2026-04-03 10:54:09', NULL, NULL),
(24, 'DGZ-17762221', 1, NULL, 'reguler', 14000, 14999000, 15013000, 'paid', 'diproses', '2026-04-03 11:13:13', '2026-04-03 11:23:37', '2026-04-03 11:14:15', NULL, NULL),
(25, 'DGZ-40209112', 1, NULL, 'reguler', 14000, 4299000, 4313000, 'paid', 'diproses', '2026-04-03 11:20:55', '2026-04-03 11:30:55', '2026-04-03 11:21:18', NULL, NULL),
(26, 'DGZ-53652657', 1, NULL, 'reguler', 14000, 14999000, 15013000, 'paid', 'diproses', '2026-04-03 11:22:34', '2026-04-03 11:32:34', '2026-04-03 11:22:54', NULL, NULL),
(27, 'DGZ-3737503', 1, NULL, 'reguler', 14000, 16999000, 17013000, 'paid', 'diproses', '2026-04-03 11:34:56', '2026-04-03 11:44:56', '2026-04-03 11:35:18', NULL, NULL),
(28, 'DGZ-20570', 1, 1, 'reguler', 14000, 29598000, 29612000, 'paid', 'diproses', '2026-04-03 11:37:03', '2026-04-03 11:47:03', '2026-04-03 11:37:25', NULL, NULL),
(29, 'DGZ-30221199', 1, NULL, 'reguler', 14000, 27999000, 28013000, 'failed', 'gagal', '2026-04-03 11:42:27', '2026-04-03 11:52:27', '2026-04-03 11:55:54', NULL, NULL),
(30, 'DGZ-20925785', 1, NULL, 'reguler', 14000, 1129000, 1143000, 'failed', 'gagal', '2026-04-03 11:56:17', '2026-04-03 12:06:17', '2026-04-03 12:56:22', NULL, NULL),
(31, 'DGZ-80333822', 1, NULL, 'reguler', 14000, 399000, 413000, 'paid', 'diproses', '2026-04-03 14:41:24', '2026-04-03 14:52:18', '2026-04-03 14:43:42', NULL, NULL),
(32, 'DGZ-62655900', 1, NULL, 'reguler', 14000, 2999000, 3013000, 'paid', 'diproses', '2026-04-03 15:06:02', '2026-04-03 15:16:02', '2026-04-04 09:02:55', NULL, NULL),
(33, 'DGZ-10530546', 1, NULL, 'reguler', 14000, 3499000, 3513000, 'paid', 'diproses', '2026-04-04 11:01:12', '2026-04-04 11:11:12', '2026-04-04 11:01:40', NULL, NULL),
(34, 'DGZ-91889815', 1, NULL, 'reguler', 14000, 8999000, 9013000, 'paid', 'diproses', '2026-04-04 11:03:07', '2026-04-04 11:13:07', '2026-04-04 11:03:38', NULL, NULL),
(35, 'DGZ-68815675', 1, 1, 'besok', 22000, 20999000, 21021000, 'failed', 'gagal', '2026-04-04 11:13:26', '2026-04-04 11:23:26', '2026-04-04 11:27:09', NULL, NULL),
(36, 'DGZ-48100705', 1, 1, 'reguler', 14000, 2499000, 2513000, 'paid', 'diproses', '2026-04-04 11:27:25', '2026-04-04 11:37:25', '2026-04-05 09:02:27', 'credit_card', 'MEGA CREDIT'),
(37, 'DGZ-1014429', 1, 1, 'reguler', 14000, 3999000, 4013000, 'paid', 'diproses', '2026-04-04 11:42:28', '2026-04-04 11:52:28', '2026-04-05 09:02:26', 'credit_card', 'MEGA CREDIT'),
(38, 'DGZ-63696350', 1, 1, 'reguler', 14000, 179000, 193000, 'paid', 'diproses', '2026-04-04 12:01:50', '2026-04-04 12:11:50', '2026-04-04 12:02:21', NULL, NULL),
(39, 'DGZ-84375544', 1, 1, 'reguler', 14000, 14799000, 14813000, 'paid', 'diproses', '2026-04-04 12:11:27', '2026-04-04 12:21:27', '2026-04-04 12:11:54', NULL, NULL),
(40, 'DGZ-41393591', 1, 1, 'reguler', 14000, 1129000, 1143000, 'paid', 'diproses', '2026-04-04 12:43:52', '2026-04-04 12:53:52', '2026-04-04 12:44:23', NULL, NULL),
(41, 'DGZ-39479190', 1, 1, 'reguler', 14000, 26999000, 27013000, 'paid', 'selesai', '2026-04-04 12:53:40', '2026-04-04 13:03:40', '2026-04-04 13:42:05', 'credit_card', 'MEGA CREDIT'),
(42, 'DGZ-8950827', 1, 1, 'reguler', 14000, 14799000, 14813000, 'paid', 'diproses', '2026-04-05 06:29:35', '2026-04-05 06:39:35', '2026-04-05 06:30:08', 'credit_card', 'MEGA CREDIT'),
(43, 'DGZ-28972933', 1, 1, 'reguler', 14000, 14999000, 15013000, 'failed', 'gagal', '2026-04-05 06:45:51', '2026-04-05 06:55:51', '2026-04-05 15:20:24', NULL, NULL),
(44, 'DGZ-87060397', 1, 1, 'reguler', 14000, 16999000, 17013000, 'failed', 'gagal', '2026-04-05 09:00:31', '2026-04-05 09:10:31', '2026-04-05 15:20:24', NULL, NULL),
(45, 'DGZ-43310917', 1, 1, 'reguler', 14000, 224000, 238000, 'paid', 'diproses', '2026-04-05 13:23:59', '2026-04-05 13:33:59', '2026-04-05 13:25:23', 'credit_card', 'MEGA CREDIT'),
(46, 'DGZ-51320653', 1, 1, 'reguler', 14000, 45000, 59000, 'failed', 'gagal', '2026-04-05 15:20:53', '2026-04-05 15:30:53', '2026-04-05 15:31:30', NULL, NULL),
(47, 'DGZ-35237526', 1, 1, 'besok', 22000, 2999000, 3021000, 'failed', 'gagal', '2026-04-05 15:48:51', '2026-04-05 16:00:51', '2026-04-06 01:09:43', NULL, NULL),
(48, 'DGZ-85717485', 1, 1, 'besok', 22000, 24499000, 24521000, 'failed', 'gagal', '2026-04-06 06:00:52', '2026-04-06 06:10:52', '2026-04-06 06:11:12', NULL, NULL),
(49, 'DGZ-82775384', 1, 1, 'besok', 22000, 24499000, 24521000, 'failed', 'gagal', '2026-04-06 06:01:02', '2026-04-06 06:11:02', '2026-04-06 06:11:12', NULL, NULL),
(50, 'DGZ-45305751', 1, 1, 'besok', 22000, 24499000, 24521000, 'failed', 'gagal', '2026-04-06 06:01:05', '2026-04-06 06:11:05', '2026-04-06 06:11:12', NULL, NULL),
(51, 'DGZ-10693862', 1, 1, 'besok', 22000, 24499000, 24521000, 'paid', 'diproses', '2026-04-06 06:02:04', '2026-04-06 06:14:02', '2026-04-06 06:10:40', 'echannel', 'Mandiri'),
(52, 'DGZ-72027651', 1, 1, 'reguler', 14000, 25749000, 25763000, 'paid', 'diproses', '2026-04-06 06:11:54', '2026-04-06 06:21:54', '2026-04-06 06:12:27', 'echannel', 'Mandiri'),
(53, 'DGZ-7764364', 1, 1, 'ekonomis', 8000, 25749000, 25757000, 'paid', 'dikirim', '2026-04-06 06:12:56', '2026-04-06 06:23:32', '2026-04-07 03:22:24', 'akulaku', 'Akulaku'),
(54, 'DGZ-99664202', 1, 1, 'besok', 22000, 358000, 380000, 'paid', 'selesai', '2026-04-06 13:27:27', '2026-04-06 13:37:27', '2026-04-07 01:44:42', 'qris', 'QRIS'),
(55, 'DGZ-31887449', 7, 5, 'besok', 22000, 51498000, 51520000, 'paid', 'selesai', '2026-04-07 01:16:22', '2026-04-07 01:26:22', '2026-04-07 01:45:03', 'echannel', 'Mandiri');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_details`
--

CREATE TABLE `pesanan_details` (
  `id` bigint UNSIGNED NOT NULL,
  `pesanan_id` bigint UNSIGNED NOT NULL,
  `produk_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `harga` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan_details`
--

INSERT INTO `pesanan_details` (`id`, `pesanan_id`, `produk_id`, `qty`, `harga`, `created_at`, `updated_at`) VALUES
(5, 5, 46, 1, 179000, '2026-03-31 15:22:41', '2026-03-31 15:22:41'),
(6, 6, 46, 2, 179000, '2026-03-31 16:13:54', '2026-03-31 16:13:54'),
(7, 7, 47, 1, 45000, '2026-04-01 13:40:42', '2026-04-01 13:40:42'),
(8, 8, 42, 1, 699000, '2026-04-01 13:41:36', '2026-04-01 13:41:36'),
(11, 11, 18, 1, 2499000, '2026-04-02 14:52:55', '2026-04-02 14:52:55'),
(12, 12, 21, 1, 3399000, '2026-04-02 15:12:58', '2026-04-02 15:12:58'),
(13, 13, 21, 1, 3399000, '2026-04-02 15:14:08', '2026-04-02 15:14:08'),
(14, 14, 9, 1, 16499000, '2026-04-02 15:40:47', '2026-04-02 15:40:47'),
(15, 15, 36, 1, 2999000, '2026-04-03 09:20:52', '2026-04-03 09:20:52'),
(16, 16, 23, 1, 19499000, '2026-04-03 09:27:37', '2026-04-03 09:27:37'),
(17, 17, 37, 1, 399000, '2026-04-03 09:39:30', '2026-04-03 09:39:30'),
(18, 18, 34, 1, 2999000, '2026-04-03 09:47:05', '2026-04-03 09:47:05'),
(19, 19, 22, 1, 27999000, '2026-04-03 09:56:01', '2026-04-03 09:56:01'),
(21, 21, 44, 1, 3499000, '2026-04-03 10:16:24', '2026-04-03 10:16:24'),
(22, 22, 14, 1, 25749000, '2026-04-03 10:28:55', '2026-04-03 10:28:55'),
(23, 23, 20, 1, 16999000, '2026-04-03 10:29:41', '2026-04-03 10:29:41'),
(24, 24, 28, 1, 14999000, '2026-04-03 11:13:13', '2026-04-03 11:13:13'),
(25, 25, 29, 1, 4299000, '2026-04-03 11:20:55', '2026-04-03 11:20:55'),
(26, 26, 28, 1, 14999000, '2026-04-03 11:22:34', '2026-04-03 11:22:34'),
(27, 27, 20, 1, 16999000, '2026-04-03 11:34:56', '2026-04-03 11:34:56'),
(28, 28, 7, 2, 14799000, '2026-04-03 11:37:03', '2026-04-03 11:37:03'),
(29, 29, 10, 1, 27999000, '2026-04-03 11:42:27', '2026-04-03 11:42:27'),
(30, 30, 40, 1, 1129000, '2026-04-03 11:56:17', '2026-04-03 11:56:17'),
(31, 31, 37, 1, 399000, '2026-04-03 14:41:24', '2026-04-03 14:41:24'),
(32, 32, 34, 1, 2999000, '2026-04-03 15:06:02', '2026-04-03 15:06:02'),
(33, 33, 44, 1, 3499000, '2026-04-04 11:01:12', '2026-04-04 11:01:12'),
(34, 34, 26, 1, 8999000, '2026-04-04 11:03:07', '2026-04-04 11:03:07'),
(35, 35, 16, 1, 20999000, '2026-04-04 11:13:26', '2026-04-04 11:13:26'),
(36, 36, 18, 1, 2499000, '2026-04-04 11:27:25', '2026-04-04 11:27:25'),
(37, 37, 31, 1, 3999000, '2026-04-04 11:42:28', '2026-04-04 11:42:28'),
(38, 38, 46, 1, 179000, '2026-04-04 12:01:50', '2026-04-04 12:01:50'),
(39, 39, 7, 1, 14799000, '2026-04-04 12:11:27', '2026-04-04 12:11:27'),
(40, 40, 38, 1, 1129000, '2026-04-04 12:43:52', '2026-04-04 12:43:52'),
(41, 41, 13, 1, 26999000, '2026-04-04 12:53:41', '2026-04-04 12:53:41'),
(42, 42, 7, 1, 14799000, '2026-04-05 06:29:35', '2026-04-05 06:29:35'),
(43, 43, 28, 1, 14999000, '2026-04-05 06:45:51', '2026-04-05 06:45:51'),
(44, 44, 20, 1, 16999000, '2026-04-05 09:00:31', '2026-04-05 09:00:31'),
(45, 45, 46, 1, 179000, '2026-04-05 13:23:59', '2026-04-05 13:23:59'),
(46, 45, 47, 1, 45000, '2026-04-05 13:23:59', '2026-04-05 13:23:59'),
(47, 46, 47, 1, 45000, '2026-04-05 15:20:53', '2026-04-05 15:20:53'),
(48, 47, 34, 1, 2999000, '2026-04-05 15:48:51', '2026-04-05 15:48:51'),
(49, 48, 11, 1, 24499000, '2026-04-06 06:00:52', '2026-04-06 06:00:52'),
(50, 49, 11, 1, 24499000, '2026-04-06 06:01:02', '2026-04-06 06:01:02'),
(51, 50, 11, 1, 24499000, '2026-04-06 06:01:05', '2026-04-06 06:01:05'),
(52, 51, 11, 1, 24499000, '2026-04-06 06:02:04', '2026-04-06 06:02:04'),
(53, 52, 14, 1, 25749000, '2026-04-06 06:11:54', '2026-04-06 06:11:54'),
(54, 53, 14, 1, 25749000, '2026-04-06 06:12:56', '2026-04-06 06:12:56'),
(55, 54, 46, 2, 179000, '2026-04-06 13:27:27', '2026-04-06 13:27:27'),
(56, 55, 14, 2, 25749000, '2026-04-07 01:16:22', '2026-04-07 01:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gambar_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `kategori_id`, `nama_produk`, `deskripsi`, `harga`, `stok`, `is_active`, `created_at`, `updated_at`, `gambar_1`, `gambar_2`, `gambar_3`) VALUES
(7, 1, 'Xiaomi 17 12/256GB - Venture Green', 'Detail Produk\r\nUkuran layar: 6.3 inci, AMOLED, 1220 x 2656 piksel\r\nMemori: RAM 12 GB, ROM 256 GB\r\nCPU: Snapdragon 8 Elite Gen 5\r\nKamera: Triple 50 MP, f/1.7 + 50 MP, f/2.0 + 50 MP, f/2.4 ; Depan 50 MP, f/2.2\r\nBaterai: 7000 mAh\r\nSIM: Dual SIM\r\nGaransi Resmi', 14799000, 13, 1, '2026-03-29 13:33:41', '2026-04-05 06:29:35', 'produk/ZbIFHYKJ8cN7Iu2Pze88MnHjDH5MxVAyElJVPQTk.webp', 'produk/4E68lEegg8a3pk3nje2COOlRToGqkNJ1QCIt98UO.webp', 'produk/Q2EC7JXTumf3FgnaQOmffkQbvArdVRXecMrGLwea.webp'),
(8, 1, 'Samsung Galaxy S26+ 12/256GB - Black', 'Detail Produk\r\nUkuran layar: 6.7 inch, QHD+ (3120 x 1440 pixels), Dynamic AMOLED 2X\r\nMemori: RAM 12 GB, ROM 256 GB\r\nSistem operasi: Android OS 16.0, One UI 8.5\r\nCPU: Exynos 2600\r\nKamera: Triple 50 MP + 12 MP + 10 MP; depan 12 MP\r\nSIM: Dual SIM\r\nBaterai: 4900 mAh\r\nBerat: 190 gram\r\nGaransi Resmi', 19499000, 15, 1, '2026-03-29 14:38:53', '2026-03-29 14:38:53', 'produk/jTy9uMsY6IUJCP9qTm9UD7xIOMZ41HhJtdySbDfu.webp', 'produk/UW844B6loERT1vAXA9SuESc8MTiJUFGCO6imFsMp.webp', 'produk/RgrTWJo1QiWKsguuBXeBJWcje3nldGjXaCsPJdp8.webp'),
(9, 1, 'Samsung Galaxy S26 12/256GB - Sky Blue', 'Detail Produk\r\nUkuran layar: 6.3 inch, FHD+ (2340 x 1080 pixels), Dynamic AMOLED 2X\r\nMemori: RAM 12 GB, ROM 256 GB\r\nSistem operasi: Android OS 16.0, One UI 8.5\r\nCPU: Exynos 2600\r\nKamera: Triple 50 MP + 12 MP + 10 MP; depan 12 MP\r\nSIM: Dual SIM\r\nBaterai: 4300 mAh\r\nBerat: 167 gram\r\nGaransi Resmi', 16499000, 15, 1, '2026-03-29 14:40:38', '2026-03-29 14:40:38', 'produk/6iXUoojHXiWwgZjwZsV8aWevWhFZq0u5gPfpGivT.webp', 'produk/r4mYwFaRM6HdsBi0FhNQmajZEy7vdcrz3ojzQQZ6.webp', 'produk/Ns9To0ovpXHYqvNPZrak8LkP4F9i5i8BxloNwaby.webp'),
(10, 1, 'Huawei Mate X7 16/512GB - Nebula Red', 'Detail Produk\r\nUkuran layar Utama: 8.0″ OLED LTPO, 2416 × 2210 Piksel, refresh rate 120 Hz\r\nUkuran layar Cover: 6.49″ OLED LTPO, 2444 × 1080 Piksel, refresh rate 120 Hz\r\nMemori: RAM 16GB, ROM 512 GB\r\nSistem Operasi: EMUI 15.0\r\nCPU: Kirin 9030 Pro (6 nm)\r\nKamera Belakang: 50 MP Ultra Lighting HDR Camera, 40 MP Ultra-Wide Angle Camera, 50 MP Telephoto Macro Camera, True-to-Colour Camera\r\nKamera Depan (Folded): 8 MP ( f2.4)\r\nKamera Depan (Unfolded): 8 MP( f2.2)\r\nSIM: Dual SIM (Nano-SIM)\r\nBaterai: 5600 mAh\r\nBerat:  236 gram\r\nGaransi Resmi', 27999000, 15, 1, '2026-03-29 14:42:24', '2026-03-29 14:42:24', 'produk/ECxKNQtSLZlBbytUBfPV36Zq3xtJxAwU2bAJCYWR.webp', 'produk/hzPu8YwKm1D1O23cXpzmBkCy7clRW3zmBJsWIM7G.webp', 'produk/9Lm4ejLkpPrz37q9owIc1htZ9QtOXvGn3AHhxlzI.webp'),
(11, 1, 'Samsung Galaxy S26 Ultra 12/256GB - Cobalt Violet', 'Detail Produk\r\nUkuran layar: 6.9 inch, QHD+ (3120 x 1440 pixels), Dynamic AMOLED 2X, 120Hz\r\nMemori: RAM 12 GB, ROM 256 GB\r\nSIstem Operasi: Android 16, One UI 8.5\r\nCPU: Snapdragon 8 Elite Gen 5 for Galaxy\r\nKamera: Quad 200 MP + 50 MP + 10 MP + 50 MP, depan 12 MP\r\nSIM: Dual SIM\r\nBaterai: 5000 mAh\r\nBerat: 214 gram\r\nGaransi Resmi', 24499000, 14, 1, '2026-03-29 14:44:08', '2026-04-06 06:11:12', 'produk/q3iPy7105dWVoKwIm3lI6yz7YR9pKPmaj8cWpkaF.webp', 'produk/HBJdv2IuHtL7qmSz4oRJje2qKhEM51OMYfaOWmpp.webp', 'produk/wr04Z3gwfhYNfOseJjuVdNAU5jAyDZeHpslq8mmT.webp'),
(12, 1, 'Infinix Smart 20 4/64GB - Black', 'Detail Produk\r\nUkuran layar: 6.78 inci, IPS LCD, 720 x 1600 pixels, 120 Hz\r\nMemori: RAM 4 GB, ROM 64 GB\r\nSistem operasi: Android 16, XOS 16\r\nCPU: Mediatek Helio G81 Ultimate (12 nm), octa-core\r\nGPU: Mali-G52 MC2\r\nKamera: Dual 8MP f/2.0 1/4” sensor 1.12um AF & Auxiliary lens; Depan 8 MP f/2.0 (wide) 1/4.0\' 1.12µm\r\nBaterai: 5200 mAh, 15W\r\nSIM: Dual SIM (Nano-SIM)\r\nGaransi Resmi', 1499900, 15, 1, '2026-03-29 14:45:57', '2026-03-29 14:45:57', 'produk/RWCo9ZRmr68fAzE5rQAnjBQcDfqzNbdqMhh0PhQ0.webp', 'produk/T67ayote2MUfa8whD2ERa52o9e53Jur9R5LKw1V2.webp', 'produk/lAiHWeLSPCHCV3El1gPyzqfQsJ4pIumAWkLoCK7W.webp'),
(13, 1, 'vivo X Fold3 Pro 16/512GB - White', 'Detail Produk\r\nUkuran layar: 6,78 inch AMOLED\r\nMemori: RAM 16 GB, ROM 512 GB\r\nSistem operasi: Android 14, Funtouch OS 14\r\nCPU: Snapdragon 8 Gen 3\r\nKamera Belakang: Triple 50 MP, f/1.7, 23mm (wide), 64 MP, f/2.6, 70mm (periscope telephoto) & 50 MP, f/2.0, 119˚ (ultrawide)\r\nKamera Depan: 32 MP, f/2.4, (wide)\r\nKamera Cover: 32 MP, f/2.4, (wide)\r\nSIM: Dual SIM (Nano-SIM)\r\nBaterai: 5700 mAh\r\nBerat: 236 gram\r\nGaransi Resmi', 26999000, 14, 1, '2026-03-29 14:47:39', '2026-04-04 12:53:40', 'produk/C0qIwCU435YmC0h9C95qlNlGpZ46PGhPCXMhUxVi.jpg', 'produk/9fi1lqBCNzrVl354seCBUHNCxf17gHsNsYEa0zbO.jpg', 'produk/02TLYXipPGWKvM3Rm8QZcgPolR4mpsqP3EOUOYCo.webp'),
(14, 1, 'Apple iPhone 17 Pro Max 256GB, Cosmic Orange', 'Poin-poin fitur utama \r\n·   DESAIN UNIBODY. UNTUK KEANDALAN MENGAGUMKAN. — Desain unibody aluminium, ditempa dalam suhu tinggi, untuk iPhone paling andal yang pernah dibuat.\r\n·   CERAMIC SHIELD TANGGUH. DEPAN DAN BELAKANG. — Ceramic Shield melindungi bagian belakang iPhone 17 Pro Max, membuatnya 4x lipat lebih tahan retak.(2) Dan Ceramic Shield 2 baru di bagian depan 3x lipat lebih tahan gores.(3)\r\n·   SISTEM KAMERA PRO PALING MAKSIMAL — Dengan semua kamera belakang 48 MP dan 8x zoom kualitas optik — rentang zoom terluas yang pernah ada di iPhone. Seperti membawa 8 lensa pro di saku Anda.\r\n·   KAMERA DEPAN 18MP CENTER STAGE — Berbagai cara fleksibel untuk mengatur framing. Selfie grup lebih pintar, video Dual Capture untuk perekaman depan dan belakang secara bersamaan, dan banyak lagi.\r\n·   CHIP A19 PRO. PENDINGINAN UAP. SECEPAT KILAT. — A19 Pro adalah chip iPhone paling andal yang pernah ada, menghadirkan performa berkelanjutan hingga 40 persen lebih baik.\r\n·   KEKUATAN BATERAI TERBAIK YANG PERNAH ADA DI IPHONE — Desain unibody menghasilkan tambahan kapasitas baterai yang besar, untuk pemutaran video hingga 39 jam.(4) Isi daya hingga 50% dalam 20 menit.(5)', 25749000, 11, 1, '2026-03-29 14:49:46', '2026-04-07 01:16:22', 'produk/pDDFiP9vwQJflWQVoXbFTfn2udhtF3wAGYi1rgz1.webp', 'produk/ZGe33YXz2TTaCzPPpZ94AselFx1ONWo4aAWCQC4U.webp', 'produk/3m38CNKy37BEHtZUohHKTcw7vKQVOPR2ZnqH4Khs.webp'),
(15, 1, 'Apple iPhone 16e 128GB, White', 'Poin-poin fitur utama\r\n• CHIP A18. TETAP CEPAT HINGGA MASA DEPAN. — Chip A18 berada di balik kekuatan baterai sepanjang hari, game, dan pembaruan iOS rutin untuk membuat iPhone Anda tetap terasa baru selama bertahun-tahun mendatang.\r\n• KEKUATAN BATERAI SUPER TAHAN LAMA — Berkirim pesan teks, menjelajah, serta menonton film dan acara dengan pemutaran video hingga 26 jam(1) — kekuatan baterai terbaik dalam iPhone 6,1 inci.(2)\r\n• KAMERA — Sistem kamera dua fungsi memiliki kamera Fusion 48 MP untuk foto beresolusi super tinggi dan Telefoto 2x berkualitas optik. Ambil selfie yang memukau dengan kamera depan 12 MP.\r\n• DESAIN KOKOH. LAYAR BRILIAN. — Layar 6,1 inci yang memukau dengan teknologi OLED. Ceramic Shield di bagian depan — lebih tangguh dari kaca ponsel pintar mana pun.\r\n• TOMBOL TINDAKAN — Akses cepat yang bisa disesuaikan ke berbagai aplikasi dan fitur favorit Anda.', 10749000, 15, 1, '2026-03-29 14:51:21', '2026-03-29 14:51:21', 'produk/QdXctqX3uDo6MGlugzHViF4DXAFZKBUMEzp097Sk.jpg', 'produk/eFu1AWXsJHkcLId67VbnIWRTPKxxe67lisjOjEWO.jpg', 'produk/x02s0HeiDBp9NiLCyMBfQpWkKq2SnKD1y1FcJWCd.webp'),
(16, 1, 'Apple iPhone 15 Pro 128GB, Natural Titanium', 'Poin-poin fitur utama\r\nLAHIR DARI TITANIUM — iPhone 15 Pro memiliki desain titanium sekelas industri dirgantara yang kuat dan ringan dengan bagian belakang kaca matte bertekstur. Dilengkapi juga dengan bagian depan Ceramic Shield yang lebih tangguh dibanding kaca ponsel pintar mana pun. Dan tahan cipratan, air, dan debu.(1)\r\n\r\nLAYAR CANGGIH — Layar Super Retina XDR 6,1″ (2) dengan ProMotion meningkatkan refresh rate hingga 120 Hz saat Anda memerlukan performa grafis yang luar biasa. Dynamic Island menampilkan gelembung pemberitahuan dan Aktivitas Langsung. Selain itu, dengan layar yang Selalu Aktif, Layar Terkunci selalu terlihat dalam sekilas, jadi Anda tidak perlu mengetuknya untuk mengetahui informasi.\r\n\r\nCHIP A17 PRO YANG MENGUBAH SEGALANYA — GPU sekelas Pro membuat game seluler terasa begitu menghanyutkan, dengan lingkungan yang beragam dan karakter yang tampak nyata. A17 Pro juga sangat efisien dan membantu menghadirkan kekuatan baterai sepanjang hari yang mengagumkan.(3)\r\n\r\nSISTEM KAMERA PRO YANG ANDAL — Dapatkan fleksibilitas frame menakjubkan dengan tujuh lensa pro. Ambil foto beresolusi super tinggi dengan lebih banyak warna dan detail menggunakan kamera Utama 48 MP. Dan ambil close-up yang tajam dari jauh dengan kamera Telefoto 3x di iPhone 15 Pro.\r\n\r\nTOMBOL TINDAKAN YANG DAPAT DISESUAIKAN — Tombol tindakan adalah jalan pintas ke fitur favorit Anda. Atur sesuai dengan yang Anda inginkan, seperti mode Hening, Kamera, Voice Memo, atau Pintasan, dan banyak lagi. Lalu tekan dan tahan untuk meluncurkan tindakan.', 20999000, 15, 1, '2026-03-29 14:52:56', '2026-04-04 11:27:09', 'produk/POP79awCeaqGDPGTpJELOvUvXO2jGybpZIkpfFso.jpg', 'produk/76DijyyUYqS5E7omQLzy21dgB54o9Q3gj8olJJes.jpg', 'produk/EFDHKctEIgkulPU1GSzVkxwf0xxnqfi38Q1mx5hh.webp'),
(17, 2, 'ADVAN Workmate R5 8/256GB - Blue', 'Detail Produk\r\nUkuran Layar: 14-inch IPS (1920 x 1200), rasio 16:10\r\nProsesor: AMD Ryzen 5 3500U (4 core / 8 thread, hingga 3.8 GHz)\r\nGrafis: AMD Radeon Graphics\r\nMemori: 8GB DDR4, 256GB SSD NVMe\r\nBaterai: 6000mAh / 7.6V\r\nSistem Operasi: Windows 11 Home (Original)', 5099000, 15, 1, '2026-03-29 14:56:58', '2026-03-29 14:56:58', 'produk/5uMieH708ztulwg4zwVAvE1lz9QwJ7w1luHA2BxU.webp', 'produk/grz6UctVvWZDuu91qjfaX8V3eAfnCILLCHI0Y9iB.webp', 'produk/XazLo5BI7iglwVmTdHrqHHQpaqUavTgizMTmI5jf.webp'),
(18, 2, 'ADVAN Soulmate 14 Celeron 4/128GB - Blue', 'Detail Produk\r\nUkuran layar: 14 inci, 1366 × 768 pixels\r\nMemori: RAM 4 GB, ROM 128 GB\r\nProsesor: Intel® Celeron® N4020\r\nGPU: Intel® Integrated Graphics\r\nKonektivitas: WiFi 802.11 b/g/n/ac + Bluetooth 4.2\r\nGaransi Resmi', 2499000, 15, 1, '2026-03-29 14:59:04', '2026-04-04 11:42:14', 'produk/pT53CgdbLsY81aefoz43N0tT2pl7SRW8wbfOrWZW.jpg', 'produk/oOVD4D7zkAKtCV6xdII1DuwtSRcOD8diTNfeQYLJ.jpg', 'produk/DETSciXC46uC6plhUGv2E9OH94A1nfRcT4BKVYUH.webp'),
(19, 2, 'realme Book Prime i5 8/512GB - Gray', 'Detail Produk\r\nUkuran Layar: 14 inci, 2160 × 1440 pixel, IPS, Up to 400 nits\r\nProsesor: Intel® Core™ i5-11320H generasi ke-11\r\nGrafis: Intel® Iris Xe Graphics\r\nMemori: 8 GB LPDDR4x 4266 MHz , 512 GB PCIe SSD\r\nSistem Operasi: Microsoft Windows 11', 11499000, 15, 1, '2026-03-29 15:06:18', '2026-03-29 15:06:18', 'produk/bdCTaMZuskc3n0iC7vIYFRBxkX8ShX5ELpSGUOFO.webp', 'produk/W5Uc8caPAS63KpJvwRxSHAcT1CUgqWv6fczUhFSX.webp', 'produk/3NKrrY4vttbYr6DjWmGcmMh3Eefu6NdyceHh1pw4.webp'),
(20, 2, 'HONOR MagicBook Art 14 Ultra5 16/1TB - Emerald Green', 'Detail Produk\r\nUkuran layar: 14.6 inci, 3120 x 2080 pixels, OLED, Touch screen\r\nMemori: RAM 16 GB, ROM 1 TB\r\nProsesor: Intel® Core™ Ultra 5 125H\r\nGPU: Intel® Arc™\r\nBerat: 1.03 kg\r\nGaransi Resmi', 16999000, 15, 1, '2026-03-29 15:07:30', '2026-04-05 15:20:24', 'produk/LZXu5zNGkVP7V8JrFzAS7fzsyZxqCjy6LYy8mMey.jpg', 'produk/qNEnhlSiDDOWDGnbk4lz83Qabqgu4AYrIYnpYg0o.jpg', 'produk/WYUvzxKsrGPqfOG0EYUNGfxRD8FhbPeIdLDfSXbj.jpg'),
(21, 2, 'ADVAN Soulmate X2 8/128GB - White', 'Detail Produk\r\nUkuran Layar: 14 inci IPS Full HD (1920 x 1080)\r\nProsesor: AMD Athlon Silver 3020e (2 Core, 2 Thread, hingga 2.6GHz)\r\nGrafis: AMD Radeon Vega 3 Graphics terintegrasi\r\nMemori: 8GB DDR4, 128GB SSD SATA\r\nBaterai: 5000mAh\r\nSistem Operasi: Windows 11 Home (Original)', 3399000, 15, 1, '2026-03-29 15:09:13', '2026-03-29 15:09:13', 'produk/uLVTMUfHVFiPhrocID9PsKVA9VX67EmDR8xa6IZG.webp', 'produk/5zWpJUWzRj1PKqXA7AFfTP6L8R95eDa5veTGdQi8.webp', 'produk/4F8vlE6tEIjP2zwn1mmh9tDRHuAPH7SBQ33fPcll.webp'),
(22, 2, 'Apple MacBook Pro (14 inci, M5, 2025) 10 CPU, 10C GPU, 16GB RAM, 512GB, Space Black', 'Poin-poin fitur utama - Macbook Pro M5 :\r\n•   BERTENAGA SUPER BERKAT M5 — Seiring dengan CPU yang lebih cepat dan memori terintegrasi, M5 dilengkapi GPU yang lebih andal dengan Neural Accelerator bawaan di setiap core, menghadirkan performa AI yang lebih cepat. Jadi, Anda dapat menuntaskan pekerjaan berat dengan kecepatan luar biasa.\r\n•   KEKUATAN BATERAI HINGGA 24 JAM — MacBook Pro 14 inci memberikan performa yang sama-sama luar biasa ketika dicolok maupun tidak.(1)\r\n•   APLIKASI BERJALAN MULUS DENGAN APPLE SILICON — Semua aplikasi favorit Anda, termasuk Microsoft 365 dan Adobe Creative Cloud, berjalan secepat kilat di macOS.(2)\r\n•   KALAU SUKA IPHONE, ANDA AKAN SUKA MAC — Mac bekerja serasi dengan perangkat Apple lainnya. Lihat dan kendalikan semua yang ada di iPhone Anda dari Mac Anda dengan Pencerminan iPhone.(3) Salin sesuatu di iPhone dan tempelkan di Mac. Kirim teks dengan Pesan atau gunakan Mac untuk melakukan dan menjawab panggilan FaceTime.(4)\r\n•   LAYAR PRO CEMERLANG — Layar Liquid Retina XDR 14,2 inci(5) dilengkapi kecerahan puncak 1.600 nit(6) dan kecerahan berkelanjutan hingga 1.000 nit, serta rasio kontras 1.000.000:1.\r\n•   KAMERA DAN AUDIO CANGGIH — Tetap menjadi fokus dalam frame dan terdengar menakjubkan dengan kamera 12MP Center Stage, tiga mikrofon kualitas studio, dan enam speaker dengan Audio Spasial yang dilengkapi dukungan untuk Dolby Atmos.', 27999000, 15, 1, '2026-03-29 15:11:11', '2026-03-29 15:11:11', 'produk/duvXWunVQr2aDpoat8qtoT6uqrbG6YYBFGdEpTxT.webp', 'produk/hJF3Q3oYxa9ugHq9xzP3Gpf6flkijdTN7Kt62Gr9.webp', 'produk/K7ZlP114gEE5QPxNUak024wYuJfPKQmKmv251Qys.webp'),
(23, 2, 'Apple MacBook Air (15.3 inci, M4, 2025) 10C CPU, 10C GPU, 16GB, 256GB, Sky Blue', 'Poin-poin fitur utama\r\n·   BERTENAGA SUPER BERKAT M4 — Chip Apple M4 membuat semua yang Anda lakukan menjadi jauh lebih cepat dan lancar, seperti bekerja di berbagai aplikasi, mengedit video, atau bermain game sarat grafis.\r\n·   KEKUATAN BATERAI HINGGA 18 JAM — MacBook Air memberikan performa yang sama-sama luar biasa ketika dicolok maupun tidak.(1)\r\n·   DESAIN PORTABEL — Sangat ringan dan hanya setengah inci tipisnya, MacBook Air pas di tas Anda — dan menyatu dengan mudah dalam gaya hidup Anda.\r\n·   LAYAR CEMERLANG — Layar Liquid Retina 15,3 inci mendukung satu miliar warna.(2) Foto dan video tampil memukau dengan kontras kaya dan detail tajam, dan teks terlihat sangat jelas.\r\n·   TERLIHAT DAN TERDENGAR SEMPURNA — Semuanya terlihat dan terdengar memukau dengan kamera 12MP Center Stage, tiga mikrofon, dan enam speaker dengan Audio Spasial.\r\n·   HUBUNGKAN SEMUANYA — MacBook Air memiliki dua port Thunderbolt 4, port pengisian daya MagSafe, jek headphone, Wi-Fi 6E, dan Bluetooth 5.3.(3) Dan mendukung hingga dua layar eksternal.\r\n·   APLIKASI BEKERJA CEPAT DI MACOS — Semua aplikasi favorit Anda bekerja sangat cepat di macOS, termasuk Microsoft 365, Adobe Creative Cloud, dan Google Workspace.(4)\r\n·   KALAU SUKA IPHONE, ANDA AKAN SUKA MAC — Mac bekerja serasi dengan perangkat Apple lainnya. Lihat dan kendalikan semua yang ada di iPhone Anda dari Mac Anda dengan Pencerminan iPhone.(5) Salin sesuatu di iPhone dan tempelkan di Mac. Kirim teks dengan Pesan atau gunakan Mac untuk melakukan dan menjawab panggilan FaceTime.(6)', 19499000, 15, 1, '2026-03-29 15:13:31', '2026-03-29 15:13:31', 'produk/m3eMtXXKJUoYqp9SEi6PklNom12rBz05jz40Ebez.jpg', 'produk/GKMTs8gT7i94I5xCkLKioybTdVbIKZDTQOrE8KRw.jpg', 'produk/FVOyWPL34avEtnyZzqaBPb860qxnQBYXMINL4zIa.jpg'),
(24, 2, 'Apple MacBook Air (13.6 inci, M2, 2024) 8C CPU, 8C GPU, 16GB, 256GB, Midnight', 'Bertenaga super berkat chip M2 generasi berikutnya, MacBook Air yang didesain ulang menggabungkan performa andal dengan kekuatan baterai hingga 18 jam ke dalam penutup berbahan aluminium yang luar biasa tipis\r\n\r\n\r\nChip M2 dengan performa CPU, GPU, dan pembelajaran mesin generasi berikutnya\r\nCPU 8-core dan GPU hingga 10-core yang lebih cepat untuk menjalankan berbagai tugas kompleks1\r\nNeural Engine 16-core untuk berbagai tugas pembelajaran mesin canggih\r\nMemori terintegrasi lebih cepat hingga 24 GB menjadikan segala yang Anda lakukan terasa lancar\r\nPenerapan filter dan efek gambar hingga 20 persen lebih cepat\r\nPengeditan garis waktu video kompleks hingga 40 persen lebih cepat3\r\nLakukan banyak hal sepanjang hari dengan kekuatan baterai hingga 18 jam2\r\nDesain tanpa kipas untuk pengoperasian yang senyap', 13499000, 15, 1, '2026-03-29 15:15:11', '2026-03-29 15:15:11', 'produk/S5vmfivCohZ7ulgBY4KRyFPPDJHij1EQshEEg6GU.jpg', 'produk/GlxYTGesYHbc3zAgzPPiiQj8s5oCrg5KKTn1lZAC.jpg', 'produk/fGpbSdXGoXmyuVBYhe3v9h336ygQir9sRqEwcMGz.webp'),
(25, 2, 'Apple MacBook Pro (16 inci, M2, 2023) 12 CPU, 19C GPU, 512GB, Space Grey', 'Poin-poin fitur utama :\r\n\r\nLayar Liquid Retina XDR 16 inci yang menakjubkan dengan Extreme Dynamic Range dan rasio kontras (2)\r\nChip M2 Pro atau M2 Max untuk kecepatan dan keandalan luar biasa\r\nCPU hingga 12-core menghadirkan kecepatan hingga 20 persen lebih tinggi untuk menuntaskan berbagai tahapan kerja pro lebih cepat (3)\r\nGPU hingga 38-core dengan kecepatan hingga 30 persen lebih tinggi untuk aplikasi dan game kaya grafis (3)\r\nMemori terintegrasi hingga 96 GB menjadikan segala yang Anda lakukan terasa cepat dan lancar\r\nKekuatan baterai hingga 22 jam (1)\r\nPenyimpanan SSD super cepat hingga 8 TB membuka aplikasi dan file dalam sekejap\r\nKamera FaceTime HD 1080p\r\nSistem suara enam speaker dengan woofer force-cancelling\r\nDeretan tiga mikrofon berkualitas studio menangkap suara Anda dengan lebih jernih\r\nTiga port Thunderbolt 4, port HDMI, slot kartu SDXC, jek headphone, port pengisian daya MagSafe', 44999000, 15, 1, '2026-03-29 15:16:49', '2026-03-29 15:16:49', 'produk/UHc8AgL4FbEL5v5LvzLIV5OkUoibOcTrzEvELcfo.jpg', 'produk/8IbVARSAuSUZsCNvias9KNfpmBM511vGnSHHnFN6.webp', 'produk/i7EOw8qjNvyaiupOTMJKRIZq0NPZh3APGEHIg6SK.webp'),
(26, 2, 'Apple MacBook Air (13 inci, M1 2020) 8GB RAM, 256GB SSD, Space Grey', '• Chip M1 yang didesain Apple untuk lompatan besar dalam performa CPU, GPU, dan pembelajaran mesin\r\n• Lakukan lebih banyak hal dengan kekuatan baterai hingga 18 jam(2)\r\n• CPU 8-core menghadirkan performa hingga 3,5x lebih cepat untuk menangani berbagai proyek lebih cepat(3)\r\n• GPU hingga delapan core dengan grafis hingga 5x lebih cepat untuk aplikasi dan game kaya grafis(3)\r\n• Neural Engine 16-core untuk pembelajaran mesin canggih\r\n• Memori terintegrasi 8 GB menjadikan segala yang Anda lakukan terasa cepat dan lancar\r\n• Penyimpanan SSD super cepat membuka aplikasi dan file dalam sekejap\r\n• Desain tanpa kipas untuk pengoperasian yang senyap\r\n• Layar Retina 13,3 inci dengan warna luas P3 untuk gambar yang cemerlang dan detail luar biasa3\r\n• Kamera FaceTime HD dengan prosesor sinyal gambar canggih untuk panggilan video yang lebih jelas dan tajam', 8999000, 14, 1, '2026-03-29 15:19:37', '2026-04-04 11:03:07', 'produk/qKTYSbUK04i4ZNgCpCkq0FL9AOxgU81N6LJSErm7.jpg', 'produk/YQlPgr88v6wx1D7c5LVI75VgrzNxyNYBKoEfIjTx.jpg', 'produk/x4kxClKxKmziCUORzxF4uLh7vtYZmChiGoz4f166.jpg'),
(27, 3, 'Samsung Galaxy Watch Ultra - Titanium Gray', 'Detail Produk\r\nLayar safir dengan Super AMOLED 1.5 inci\r\nProsesor Exynos W1000\r\nTahan air hingga 10 ATM\r\nKonektivitas Bluetooth 5.3 & Wi-Fi \r\nSensor untuk monitor kesehatan & aktivitas luar ruangan\r\nSistem operasi Wear OS Samsung\r\nPenggunaan hingga 100 jam dengan Mode Hemat Daya', 5999000, 15, 1, '2026-03-30 11:59:56', '2026-03-30 11:59:56', 'produk/oGGiDGGA5asFLnpvARrNmjsZXhncuhz0mHZehT5t.webp', 'produk/oezLnKMbktvzg4yWHTXQz1lZvOoG2RJff0NDLvfe.webp', 'produk/JQafDtDfygkuRJmMIFGnYYPRfpCgNxqf6pR1IQcm.webp'),
(28, 3, 'Apple Watch Ultra 3 GPS + Cellular, 49mm Natural Titanium Case with Light Blue Alpine Loop - Small', 'Poin-poin fitur utama\r\n·   TANGGUH DAN SIAP DIBAWA KE MANA SAJA — Jam olahraga dan bertualang paling andal dibuat agar tahan lama dengan casing titanium yang sangat tangguh dan layar kristal safir yang kokoh. Tahan air 100 m — cocok dipakai berenang, menyelam, dan olahraga air berkecepatan tinggi.(3)\r\n·   LAYAR TERANG DAN MENAWAN — Layar yang besar dan canggih memancarkan lebih banyak cahaya pada sudut yang lebih lebar, sehingga lebih terang dan lebih mudah untuk dibaca.(2) Anda juga bisa menggunakan layar sebagai senter.\r\n·   KEKUATAN BATERAI BERHARI-HARI — Hingga 42 jam untuk penggunaan normal dan hingga 72 jam dalam Mode Daya Rendah.(1) Pantau olahraga dengan pemantauan GPS dan detak jantung lengkap selama hingga 20 jam dalam Mode Daya Rendah.(1)\r\n·   TEMAN BERLARI DAN OLAHRAGA TERBAIK — GPS frekuensi ganda yang presisi, Pengatur Laju, Zona Detak Jantung, Olahraga Khusus, tenaga berlari, dan beban latihan memberikan semua yang dibutuhkan pelari, perenang, pesepeda, dan atlet.', 14999000, 15, 1, '2026-03-30 12:01:23', '2026-04-05 15:20:24', 'produk/1YfTwuZR0WiOQYyQGB7FeAUyl7cZ5BXW4xUAHG3K.webp', 'produk/xpl8tKAjCW0oc0PU1dRawszCrMYl0tMj931676jC.webp', 'produk/bnkBXZDcg4CmvyxFoqgfvhHVdC5roJeO4SoFwGT8.webp'),
(29, 3, 'Samsung Galaxy Watch7 44mm - Silver', 'Detail Produk\r\nProsesor Exynos W1000\r\nMaterial Armor Aluminum & Sapphire Glass\r\nDual-Frequency GPS untuk pelacakan yang akurat & konsisten\r\nBioActive Sensor untuk monitor kesehatan & kebugaran\r\nFall Detection dapat mendeteksi saat Anda terjatuh ketika berolahraga atau tidur\r\nPengisian daya yang lebih cepat\r\nSertifikasi tahan air IP68', 4299000, 15, 1, '2026-03-30 12:04:55', '2026-03-30 12:04:55', 'produk/kBpfbMLJ4lz6mG456vLOnbpEP7k4Jh0dBKvhqThm.jpg', 'produk/yFXFd33P67kLnUdi0SJIKmL3raEa914zNjzIz6QG.webp', 'produk/SJuwc4GViDsEy4SSVSthAJWnrMuVQWIlIAEPtS6K.webp'),
(31, 3, 'Samsung Galaxy Watch6 Classic 47mm - Silver', 'Detail Produk\r\nLayar 1.47 Inch (47mm)\r\nLapisan layar Sapphire Crystal\r\nFitur monitor kesehatan dan kebugaran\r\nSleep tracking untuk kualitas tidur yang lebih baik\r\nPengisian daya yang lebih cepat\r\nSertifikasi tahan air IP68', 3999000, 15, 1, '2026-03-30 12:25:40', '2026-04-04 12:01:19', 'produk/HSUw4tfLMsahAyFZIuNtiniKe8RHvY581Iv0URDP.jpg', 'produk/OflV1Z1EPbfleH9meWI1EYpUamN8BE9IdIoEGbXB.webp', 'produk/TSLSH0tzhSDPvWOsk9lWFcPONu3RshIQWe2SDpfB.jpg'),
(32, 3, 'Samsung Galaxy Watch6 40mm - Graphite', 'Detail Produk\r\nLayar 1.31 Inch (40mm)\r\nLapisan layar Sapphire Crystal\r\nFitur monitor kesehatan dan kebugaran\r\nMemonitor waktu tidur yang lebih baik\r\nPengisian daya yang lebih cepat\r\nSertifikasi tahan air IP68', 2799000, 15, 1, '2026-03-30 12:27:05', '2026-03-30 12:27:05', 'produk/879Ggj6T3eYYPwV0c1m5g7DABgCX6ndLhMk0vRQP.webp', 'produk/J0KUIo5Y9FqpUrs3Mv6IPBe9rvEGBhbVBDGPoc4z.webp', 'produk/M69aMR1qjwjkMprSugZQX6nG7XhcY8UTBuniq2iR.jpg'),
(33, 3, 'Xiaomi Redmi Watch 4 - Silver Gray', 'Detail Produk\r\nLayar AMOLED besar 1,97 inci\r\nMulti sistem GNSS\r\nTahan air 5ATM\r\nMendukung panggilan telepon Bluetooth®️\r\nMasa pakai baterai hingga 20 hari', 1199000, 15, 1, '2026-03-30 12:28:40', '2026-03-30 12:28:40', 'produk/9HULdnpSnqLJzZhLpNd97iRe1XmIkx245uFw3Oic.jpg', 'produk/UQqs8qb40MJ4mRuiRg8ZGik9eNE2I2gVNhQZV1p3.jpg', 'produk/YSl6gH7xKvThwL8rzIqMzp5gI0fuh5o5AEondhHv.jpg'),
(34, 3, 'Samsung Galaxy Watch7 40mm - Green', 'Detail Produk\r\nProsesor Exynos W1000\r\nMaterial Armor Aluminum & Sapphire Glass\r\nDual-Frequency GPS untuk pelacakan yang akurat & konsisten\r\nBioActive Sensor untuk monitor kesehatan & kebugaran\r\nFall Detection dapat mendeteksi saat Anda terjatuh ketika berolahraga atau tidur\r\nPengisian daya yang lebih cepat\r\nSertifikasi tahan air IP68', 2999000, 15, 1, '2026-03-30 12:31:42', '2026-04-06 01:09:43', 'produk/Z1NK4FkaTCUtpFbvKNoXEUvq2iVDy3lLzEEMLvss.jpg', 'produk/L1xuy5YL6f4Waaq3MrE2X1VVaPpegG8R4KdB7pCy.webp', 'produk/pqDAGKBAPMNkDEGnBGgsJvV9Sw1iZ9O4xTBciwbm.webp'),
(35, 3, 'Xiaomi Redmi Watch 5 - Silver Gray', 'Detail Produk\r\nLayar AMOLED persegi 2,07 inci yang sangat besar\r\nMulti sistem GNSS\r\nTahan air 5ATM\r\nMendukung panggilan telepon Bluetooth\r\nMasa pakai baterai hingga 24 hari', 1099000, 15, 1, '2026-03-30 12:34:33', '2026-03-30 12:34:33', 'produk/5nkuzNjPpUsBbo0fjdRcHDAq7c1kqDA5zWNylUN7.jpg', 'produk/B5dkOee6bsoypTdZI9SZyWxC8x9L2A15gBq9rwhA.jpg', 'produk/u0wquFUgQ4hRnrSHMjyPMeiz4ROEMVzUY2HXpiPX.jpg'),
(36, 3, 'Huawei Watch Fit 4 Pro - Blue', 'Detail Produk\r\nLayar 1.82 inch AMOLED\r\nDesain sangat fit dan ringan\r\nPelacakan Kesehatan HUAWEI TruSense System\r\nDaya tahan baterai hingga 10 hari\r\nKompatibel dengan iOS dan Android', 2999000, 15, 1, '2026-03-30 12:36:07', '2026-03-30 12:36:07', 'produk/kokrpFPju3abjE3T2QbTSIbV3csLzaDEPyGPf4vX.jpg', 'produk/PCQoDtXuDzwJ7f76KMOaFYa9fwqoN70QaV71y8w7.jpg', 'produk/Lhpy6ZD2zRLWMpi0AqaS1CPZ5rDMhHFtDPe2lY4I.webp'),
(37, 3, 'Xiaomi Redmi Watch 5 Active - Midnight Black', 'Detail Produk\r\nLayar berukuran 2 inci\r\nFitur penggilan dengan noise cancellation\r\nSistem operasi HyperOS\r\nDukungan hingga 140 lebih mode olahraga\r\nMasa pakai baterai hingga 18 hari', 399000, 15, 1, '2026-03-30 12:37:39', '2026-04-03 15:14:11', 'produk/QnsgH1pvxRImzkiE3Zz4pQRUpIefAAfwoR7GfM3j.webp', 'produk/v5qo9xcXTYMLPVVeB9PyNLPJPNRNYP93DJtLsb8O.webp', 'produk/QLdZjJ656iRPT6CzE8ruMTPrqoetRvofr6N0smiX.webp'),
(38, 4, 'Logitech Keys-To-Go 2 Keyboard Universal - Graphite', 'Detail Produk\r\nTerbuat dari bahan daur ulang\r\nDesain yang tipis, ringan & mudah dibawa kemana saja\r\nMemberikan pengalaman mengetik yang luas & nyaman\r\nKompatibel dengan Android, ChromeOS, Windows, iPadOS, iOS, atau macOS\r\nMasa pakai baterai yang lama', 1129000, 14, 1, '2026-03-30 12:45:51', '2026-04-04 12:43:52', 'produk/TOxNKF3JiCuZyel9yAUYT9QnKRnAL00E9AWXzBXs.webp', 'produk/n8bZ2b0fh0pcuLiCPTsNmdl6qPjSwOlMW7wxMO4D.webp', 'produk/RuZx12z2h28xXksboYp7AWMMHBe1l786F0q0SOYc.webp'),
(39, 4, 'Apple Magic Mouse, Silver', 'Detail Produk\r\nMagic Mouse hadir tanpa kabel dan dapat diisi daya, dengan desain alas yang optimal, sehingga bisa meluncur tanpa hambatan di meja Anda. Permukaan Multi-Touch memungkinkan Anda melakukan gerakan sederhana, seperti mengusap pada halaman web dan menggulir dokumen.', 1299000, 15, 1, '2026-03-30 12:47:32', '2026-03-30 12:48:15', 'produk/hcAhYyIMxZ5oaElEHbtI9JgT585XQI7xOIzNWABo.webp', 'produk/h6Tl6mc7yFNaOZUwHaSEHS2a0rBnAE9i3xlMxFSb.webp', 'produk/HfXBsCFrQbwSuYLQwPavQu8kspFewkVrZK6jeqNI.webp'),
(40, 4, 'Logitech Keys-To-Go 2 Keyboard Universal - Pale Grey', 'Detail Produk\r\nTerbuat dari bahan daur ulang\r\nDesain yang tipis, ringan & mudah dibawa kemana saja\r\nMemberikan pengalaman mengetik yang luas & nyaman\r\nKompatibel dengan Android, ChromeOS, Windows, iPadOS, iOS, atau macOS\r\nMasa pakai baterai yang lama', 1129000, 15, 1, '2026-03-30 12:59:37', '2026-03-30 12:59:37', 'produk/5YXNU3NUr5ErPbZUdMZSkLHg4HjFNOQg7RL9YaPA.webp', 'produk/cjSbjKxzZLVDwaeVHndmtIfDdlA7FSAYsU1x0RZA.webp', 'produk/gELrblLYpBPnLLRNwHLhZ7cBe7OcKfwB1n4Kszme.webp'),
(41, 4, 'Sandisk Ultra Luxe OTG Type C/A 128GB - SIlver', 'Detail Produk\r\nKapasitas: 128GB\r\nInterface: USB 3.1 Gen 1\r\nKecepatan baca hingga 150MB/s\r\nCasing logam trendi dengan desain putaran yang dibuat untuk melindungi konektor\r\nAplikasi SanDisk Memory zone untuk otomatis cadangkan data Anda', 316000, 15, 1, '2026-03-30 13:01:33', '2026-03-30 13:01:33', 'produk/Up5prtuUa8bhVAB8O0YKnIP95qZPNfJGdjyWjYJy.jpg', 'produk/FPVSYVpaZ39HRAL5nwlEu5VVnKi2d5RZ3Rk3Zphi.jpg', 'produk/CdfchnVSyp0SZH6oOTG7bZDJPY7kdhsXL6FFC2CE.jpg'),
(42, 4, 'Belkin Power Bank 10K with Integrated Cable Disney Series - Zootopia', 'Detail Produk\r\nKabel USB-C terintegrasi\r\nOutput 20W untuk mengisi daya smartphone dan tablet Anda dengan cepat\r\nKapasitas baterai 10.000mAh\r\nMampu mengisi daya dua perangkat sekaligus\r\nFitur pass-through power memungkinkan pengisian daya perangkat saat power bank sedang diisi ulang', 699000, 15, 1, '2026-03-30 13:03:21', '2026-03-30 13:03:21', 'produk/JVtWZXQLnlMoxpa240ZBlZH0oJ3MYRi4YSxS8Ixx.webp', 'produk/hP1WJp17pcq0UtQLQVlMWHAMIOGu62fD58NevGSA.webp', 'produk/UoI5ZxxQeYEu9xgYaaU3E4Cf5KiJ0oyAtkFd0BOK.webp'),
(43, 4, 'Belkin Power Bank 10K with Integrated Cable Disney Series - Winnie The Pooh', 'Detail Produk\r\nKabel USB-C terintegrasi\r\nOutput 20W untuk mengisi daya smartphone dan tablet Anda dengan cepat\r\nKapasitas baterai 10.000mAh\r\nMampu mengisi daya dua perangkat sekaligus\r\nFitur pass-through power memungkinkan pengisian daya perangkat saat power bank sedang diisi ulang', 699000, 15, 1, '2026-03-30 13:05:27', '2026-03-30 13:05:27', 'produk/VXJF3juWk9cXbNziTybPhc2AVto3I87kBiPSHkvr.webp', 'produk/OejQ2pBdypHf4mSlEVtYU2g08x6Y5LsgtkdZWlQP.webp', 'produk/djddj7LmU8JyDeJpgEjgld7BKtTkNKQRSvMKgzSn.webp'),
(44, 4, 'Sony WF1000XM5 Noise Cancelling Earbud - Silver', 'Detail Produk\r\nNoise cancelling terbaik dengan dua prosesor performa tinggi dan mikrofon umpan balik ganda\r\nKualitas suara luar biasa dengan unit driver yang dirancang khusus\r\nPanggilan bebas noise superior dengan sensor konduksi tulang dan sistem pereduksi bising (menggunakan AI)\r\nDesain ergonomis premium untuk kenyamanan yang pas dan stabil\r\nTahan air dan baterai tahan lama untuk penggunaan sehari-hari', 3499000, 14, 1, '2026-03-30 13:08:38', '2026-04-04 11:01:12', 'produk/wMK7kLf4KoATeTab5FYPbwEsMRdpO9rkkA6ag8Ek.jpg', 'produk/9RrDsUb5X1hQG8fV460UAqURYs7kRK24h8z9d3Aj.jpg', 'produk/HWGcECfbIxQISBM2OiIHHG5HRvumV3Y0EfpEyxG1.jpg'),
(45, 4, 'Sony Headphone WH1000XM5 - Silver', 'Detail Produk\r\nHD Noise Cancelling Processor QN1, Integrated Processor V1, dan beberapa mikrofon untuk mendengarkan bebas gangguan\r\nPersonal Noise Cancelling Optimiser dan Atmospheric Pressure Optimising yang sepenuhnya otomatis\r\nUnit driver 30mm desain khusus untuk suara yang luar biasa\r\nPanggilan bebas noise sangat bagus dengan 2x2 mikrofon beamforming dan sistem pereduksi bising (dengan AI)\r\nDesain ringan super nyaman di dalam “Soft fit leather”', 4599000, 15, 1, '2026-03-30 13:12:25', '2026-04-04 16:04:21', 'produk/VNeJrIYp47Be0ayuotGDkh9X2fRYpsPvWQw93B3H.jpg', 'produk/82HGM7Hw2ig4MIWheCJiWbmY3XIxJ9v5ikDTnoEy.jpg', 'produk/uZG9W8GrB6zUqnreOEt7Yk6fSKLMLTxzjnmyb0cc.jpg'),
(46, 4, 'LOOPS Dual Port Charger 30W', 'Detail Produk\r\n1 x USB-A & 1x USB-C\r\nOutput daya hingga 30W\r\nKompatibel dengan Power Delivery dan Quick Charge 3.0\r\nUkuran yang kecil dan compact\r\nGaransi TAM 1 tahun', 179000, 11, 1, '2026-03-30 13:14:30', '2026-04-06 13:27:27', 'produk/2OgebT7iiPK2CAlEqz2im1Kdza7Xg7hlemdTcxcQ.webp', 'produk/TED609J5hFBgqrpp17YbNYM3Jh1CoVikzztDQfVl.webp', 'produk/HuAjaNUXPjZlrmNPVMRReQpxplq5QQOMw38LRH9t.webp'),
(47, 4, 'LOOPS Candy Series Cable A to C - Black', 'Detail Produk\r\nBahan TPE anti kusut\r\nMendukung pengisian daya untuk Android\r\nMendukung transfer data berkecepatan tinggi', 45000, 14, 1, '2026-03-30 13:18:37', '2026-04-05 15:31:30', 'produk/I7yfTUUNT3DZFd2xk1s38JnatJKXE14BcvdrSwOa.webp', 'produk/QYzfSoOhcy6VZSXCBaItWv76C0smFlofxzDlSoOZ.webp', 'produk/6WUAUOFgsd606aNsqkQOorESHQCRbRm5rX0TiQOU.webp');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3SRxuxCgFplD30hFxvtdyvTptk8h3BnYd21sB0AV', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiaEp4MVJWa2N5a0hyczNIOWd2djMzdHBaS1JCR0EyeTVjbVY2Z0tOaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775524602),
('8pQ0her2wLr1XA1TR5aOUQ1IgPXTFZNe8obwvjWm', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiblpKVTU0aWVEZHdDaGVRcnNkM1FjeHF3aVBRb2FPSjJsSGg4WGt1SiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775524621),
('inJ8r7NWtanCYUtXUeuoIP5zmanKvzuhyusDVzF4', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia25tb3JtcTBSTExCWTFhWUFGcXpzMmN0dG5jS2c3Rkt1c1J1TlRySiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ub3RpZmljYXRpb25zL2xvYWQ/cGFnZT0yIjtzOjU6InJvdXRlIjtzOjE4OiJub3RpZmljYXRpb25zLmxvYWQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1775534628);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('customer','admin','petugas') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Achmad Riyandi', 'riyandiachmad448@gmail.com', NULL, '$2y$12$/9aPLV3Void/os8Ga09Vp.CJ/5EOz6Ppz1ZT4f8tniD1.GGviBy9e', 'customer', NULL, '2026-03-23 13:57:40', '2026-03-23 13:57:40'),
(2, 'Admin', 'admin@digitalzone.com', NULL, '$2y$12$krWOZ9jpxGzTLndz.9MSheO6sDBZxFzofLBZ/tiY5ujaIIFbZejoa', 'admin', NULL, '2026-03-23 13:57:40', '2026-03-23 13:57:40'),
(5, 'Petugas1', 'petugas1@digitalzone.com', NULL, '$2y$12$V7yKl6VQgMZIuagKXdCC1O6ntnCpVYed5jF.X6hlgXWkVdy66aA3y', 'petugas', NULL, '2026-03-28 14:37:43', '2026-03-28 14:37:43'),
(6, 'Petugas2', 'petugas2@digitalzone.com', NULL, '$2y$12$c2XzZXzowhkd8zTuDhokTuCHUrX9HobS3PIImmseRRm51gHM9y1/C', 'petugas', NULL, '2026-04-06 01:23:58', '2026-04-06 01:23:58'),
(7, 'Freya Jayawardana', 'freya@gmail.com', NULL, '$2y$12$pnCJi2ozlEZYcbg2zBDr9uK0vn/EvX70wAZsT7S7itZx0M/Z1ZjPG', 'customer', NULL, '2026-04-07 00:40:12', '2026-04-07 00:40:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamats`
--
ALTER TABLE `alamats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alamats_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keranjangs_user_id_foreign` (`user_id`),
  ADD KEY `keranjangs_produk_id_foreign` (`produk_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pesanans`
--
ALTER TABLE `pesanans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pesanans_kode_unique` (`kode`),
  ADD KEY `pesanans_user_id_foreign` (`user_id`),
  ADD KEY `pesanans_alamat_id_foreign` (`alamat_id`);

--
-- Indexes for table `pesanan_details`
--
ALTER TABLE `pesanan_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_details_pesanan_id_foreign` (`pesanan_id`),
  ADD KEY `pesanan_details_produk_id_foreign` (`produk_id`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produks_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `alamats`
--
ALTER TABLE `alamats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `keranjangs`
--
ALTER TABLE `keranjangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `pesanans`
--
ALTER TABLE `pesanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `pesanan_details`
--
ALTER TABLE `pesanan_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamats`
--
ALTER TABLE `alamats`
  ADD CONSTRAINT `alamats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD CONSTRAINT `keranjangs_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `keranjangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pesanans`
--
ALTER TABLE `pesanans`
  ADD CONSTRAINT `pesanans_alamat_id_foreign` FOREIGN KEY (`alamat_id`) REFERENCES `alamats` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pesanans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pesanan_details`
--
ALTER TABLE `pesanan_details`
  ADD CONSTRAINT `pesanan_details_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_details_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `produks`
--
ALTER TABLE `produks`
  ADD CONSTRAINT `produks_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
