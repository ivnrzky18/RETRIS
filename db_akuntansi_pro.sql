-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2025 at 11:11 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_akuntansi_pro`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounting_periods`
--

CREATE TABLE `accounting_periods` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_periode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `status` enum('Dibuka','Ditutup') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dibuka',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounting_periods`
--

INSERT INTO `accounting_periods` (`id`, `nama_periode`, `tanggal_awal`, `tanggal_akhir`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Juni 2025', '2025-06-01', '2025-06-30', 'Dibuka', '2025-06-12 00:25:09', '2025-06-12 00:26:28');

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Aset','Kewajiban','Modal','Pendapatan','Beban') COLLATE utf8mb4_unicode_ci NOT NULL,
  `normal_balance` enum('Debit','Kredit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `code`, `name`, `type`, `normal_balance`, `created_at`, `updated_at`) VALUES
(1, '1.1.01', 'Kas', 'Aset', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(2, '1.1.02', 'Bank', 'Aset', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(3, '1.1.03', 'Piutang Usaha', 'Aset', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(4, '1.1.04', 'Perlengkapan', 'Aset', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(5, '1.1.05', 'Sewa Dibayar Dimuka', 'Aset', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(6, '1.1.06', 'Asuransi Dibayar Dimuka', 'Aset', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(7, '1.1.07', 'Persediaan', 'Aset', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(8, '1.2.01', 'Peralatan', 'Aset', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(9, '1.2.02', 'Akumulasi Penyusutan Peralatan', 'Aset', 'Kredit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(10, '1.2.03', 'Kendaraan', 'Aset', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(11, '1.2.04', 'Akumulasi Penyusutan Kendaraan', 'Aset', 'Kredit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(12, '2.1.01', 'Utang Usaha', 'Kewajiban', 'Kredit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(13, '2.1.02', 'Utang Gaji', 'Kewajiban', 'Kredit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(14, '2.1.03', 'Utang Pajak', 'Kewajiban', 'Kredit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(15, '2.1.04', 'Pendapatan Diterima Dimuka', 'Kewajiban', 'Kredit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(16, '3.1.01', 'Modal Pemilik', 'Modal', 'Kredit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(17, '3.1.02', 'Prive', 'Modal', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(18, '4.1.01', 'Penjualan', 'Pendapatan', 'Kredit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(19, '4.1.02', 'Pendapatan Jasa', 'Pendapatan', 'Kredit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(20, '4.1.03', 'Pendapatan Sewa', 'Pendapatan', 'Kredit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(21, '4.1.04', 'Pendapatan Bunga', 'Pendapatan', 'Kredit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(22, '5.1.01', 'Beban Gaji', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(23, '5.1.02', 'Beban Sewa', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(24, '5.1.03', 'Beban Listrik', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(25, '5.1.04', 'Beban Air', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(26, '5.1.05', 'Beban Telepon', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(27, '5.1.06', 'Beban Penyusutan Peralatan', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(28, '5.1.07', 'Beban Penyusutan Kendaraan', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(29, '5.1.08', 'Beban Asuransi', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(30, '5.1.09', 'Beban Perlengkapan', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(31, '5.1.10', 'Beban Transportasi', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(32, '5.1.11', 'Beban Konsumsi', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(33, '5.1.12', 'Beban Kebersihan', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(34, '5.1.13', 'Beban Promosi', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(35, '5.1.14', 'Beban Administrasi', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(36, '5.1.15', 'Beban ATK', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(37, '5.1.16', 'Beban Pemeliharaan', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(38, '5.1.17', 'Beban Lain-lain', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(39, '5.1.18', 'Beban Bunga', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(40, '5.1.19', 'Beban Operasional', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(41, '5.1.20', 'Beban Pajak', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(42, '5.1.21', 'Beban Internet', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(43, '5.1.22', 'Beban Keamanan', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(44, '5.1.23', 'Beban Parkir', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(45, '5.1.24', 'Beban Cleaning Service', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(46, '5.1.25', 'Beban Pelatihan', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(47, '5.1.26', 'Beban Konsultan', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(48, '5.1.27', 'Beban Hukum', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(49, '5.1.28', 'Beban Audit', 'Beban', 'Debit', '2025-06-12 07:22:16', '2025-06-12 07:22:16'),
(50, '3.9.99', 'Ikhtisar Laba Rugi', 'Modal', 'Debit', '2025-06-12 10:37:12', '2025-06-12 10:37:12');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_1ded8334695753eee04d443f4fc17b3c', 'i:1;', 1749710489),
('laravel_cache_1ded8334695753eee04d443f4fc17b3c:timer', 'i:1749710489;', 1749710489),
('laravel_cache_herianto.sy@gmail.com|127.0.0.1', 'i:1;', 1749710491),
('laravel_cache_herianto.sy@gmail.com|127.0.0.1:timer', 'i:1749710491;', 1749710491);

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
-- Table structure for table `cash_banks`
--

CREATE TABLE `cash_banks` (
  `id` bigint UNSIGNED NOT NULL,
  `tipe_transaksi` enum('Masuk','Keluar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `sumber` enum('Kas','Bank') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` decimal(20,2) NOT NULL,
  `account_id` bigint UNSIGNED NOT NULL,
  `journal_entry_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `journal_details`
--

CREATE TABLE `journal_details` (
  `id` bigint UNSIGNED NOT NULL,
  `journal_entry_id` bigint UNSIGNED NOT NULL,
  `account_id` bigint UNSIGNED NOT NULL,
  `debit` decimal(15,2) NOT NULL DEFAULT '0.00',
  `credit` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journal_details`
--

INSERT INTO `journal_details` (`id`, `journal_entry_id`, `account_id`, `debit`, `credit`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '50000000.00', '0.00', '2025-06-12 00:27:02', '2025-06-12 00:27:02'),
(2, 1, 16, '0.00', '50000000.00', '2025-06-12 00:27:02', '2025-06-12 00:27:02'),
(3, 2, 5, '12000000.00', '0.00', '2025-06-12 00:39:01', '2025-06-12 00:39:01'),
(4, 2, 1, '0.00', '12000000.00', '2025-06-12 00:39:01', '2025-06-12 00:39:01'),
(5, 3, 4, '2000000.00', '0.00', '2025-06-12 02:05:06', '2025-06-12 02:05:06'),
(6, 3, 1, '0.00', '2000000.00', '2025-06-12 02:05:06', '2025-06-12 02:05:06'),
(7, 4, 8, '10000000.00', '0.00', '2025-06-12 02:09:51', '2025-06-12 02:09:51'),
(8, 4, 12, '0.00', '10000000.00', '2025-06-12 02:09:51', '2025-06-12 02:09:51'),
(9, 5, 1, '7500000.00', '0.00', '2025-06-12 02:11:10', '2025-06-12 02:11:10'),
(10, 5, 19, '0.00', '7500000.00', '2025-06-12 02:11:10', '2025-06-12 02:11:10'),
(11, 6, 3, '5000000.00', '0.00', '2025-06-12 02:12:21', '2025-06-12 02:12:21'),
(12, 6, 19, '0.00', '5000000.00', '2025-06-12 02:12:21', '2025-06-12 02:12:21'),
(13, 7, 22, '3000000.00', '0.00', '2025-06-12 02:18:43', '2025-06-12 02:18:43'),
(14, 7, 1, '0.00', '3000000.00', '2025-06-12 02:18:43', '2025-06-12 02:18:43'),
(15, 8, 24, '500000.00', '0.00', '2025-06-12 02:22:50', '2025-06-12 02:22:50'),
(16, 8, 1, '0.00', '500000.00', '2025-06-12 02:22:50', '2025-06-12 02:22:50'),
(17, 9, 25, '300000.00', '0.00', '2025-06-12 02:23:33', '2025-06-12 02:23:33'),
(18, 9, 1, '0.00', '300000.00', '2025-06-12 02:23:33', '2025-06-12 02:23:33'),
(19, 10, 12, '5000000.00', '0.00', '2025-06-12 02:24:32', '2025-06-12 02:24:32'),
(20, 10, 1, '0.00', '5000000.00', '2025-06-12 02:24:32', '2025-06-12 02:24:32'),
(21, 11, 1, '3000000.00', '0.00', '2025-06-12 03:00:59', '2025-06-12 03:00:59'),
(22, 11, 3, '0.00', '3000000.00', '2025-06-12 03:00:59', '2025-06-12 03:00:59'),
(23, 12, 26, '400000.00', '0.00', '2025-06-12 03:01:56', '2025-06-12 03:01:56'),
(24, 12, 1, '0.00', '400000.00', '2025-06-12 03:01:56', '2025-06-12 03:01:56'),
(25, 13, 1, '6000000.00', '0.00', '2025-06-12 03:05:08', '2025-06-12 03:05:08'),
(26, 13, 20, '0.00', '6000000.00', '2025-06-12 03:05:08', '2025-06-12 03:05:08'),
(27, 14, 36, '750000.00', '0.00', '2025-06-12 03:06:15', '2025-06-12 03:06:15'),
(28, 14, 1, '0.00', '750000.00', '2025-06-12 03:06:15', '2025-06-12 03:06:15'),
(29, 15, 42, '250000.00', '0.00', '2025-06-12 03:07:52', '2025-06-12 03:07:52'),
(30, 15, 1, '0.00', '250000.00', '2025-06-12 03:07:52', '2025-06-12 03:07:52'),
(31, 16, 1, '4000000.00', '0.00', '2025-06-12 03:08:23', '2025-06-12 03:08:23'),
(32, 16, 19, '0.00', '4000000.00', '2025-06-12 03:08:23', '2025-06-12 03:08:23'),
(33, 17, 17, '2000000.00', '0.00', '2025-06-12 03:09:00', '2025-06-12 03:09:00'),
(34, 17, 1, '0.00', '2000000.00', '2025-06-12 03:09:00', '2025-06-12 03:09:00'),
(35, 18, 1, '2000000.00', '0.00', '2025-06-12 03:09:47', '2025-06-12 03:09:47'),
(36, 18, 3, '0.00', '2000000.00', '2025-06-12 03:09:47', '2025-06-12 03:09:47'),
(37, 19, 12, '5000000.00', '0.00', '2025-06-12 03:10:30', '2025-06-12 03:10:30'),
(38, 19, 1, '0.00', '5000000.00', '2025-06-12 03:10:30', '2025-06-12 03:10:30'),
(39, 20, 34, '1000000.00', '0.00', '2025-06-12 03:11:25', '2025-06-12 03:11:25'),
(40, 20, 1, '0.00', '1000000.00', '2025-06-12 03:11:25', '2025-06-12 03:11:25'),
(41, 21, 33, '5000000.00', '0.00', '2025-06-12 03:11:59', '2025-06-12 03:11:59'),
(42, 21, 1, '0.00', '5000000.00', '2025-06-12 03:11:59', '2025-06-12 03:11:59'),
(43, 22, 23, '4000000.00', '0.00', '2025-06-12 03:17:57', '2025-06-12 03:17:57'),
(44, 22, 5, '0.00', '4000000.00', '2025-06-12 03:17:57', '2025-06-12 03:17:57'),
(45, 23, 30, '1500000.00', '0.00', '2025-06-12 03:19:27', '2025-06-12 03:19:27'),
(46, 23, 4, '0.00', '1500000.00', '2025-06-12 03:19:27', '2025-06-12 03:19:27'),
(47, 24, 27, '500000.00', '0.00', '2025-06-12 03:30:49', '2025-06-12 03:30:49'),
(48, 24, 9, '0.00', '500000.00', '2025-06-12 03:30:49', '2025-06-12 03:30:49'),
(49, 25, 15, '2000000.00', '0.00', '2025-06-12 03:31:47', '2025-06-12 03:31:47'),
(50, 25, 20, '0.00', '2000000.00', '2025-06-12 03:31:47', '2025-06-12 03:31:47'),
(51, 26, 22, '1000000.00', '0.00', '2025-06-12 03:32:28', '2025-06-12 03:32:28'),
(52, 26, 13, '0.00', '1000000.00', '2025-06-12 03:32:28', '2025-06-12 03:32:28'),
(53, 27, 19, '16500000.00', '0.00', '2025-06-12 03:39:18', '2025-06-12 03:39:18'),
(54, 27, 50, '0.00', '16500000.00', '2025-06-12 03:39:18', '2025-06-12 03:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `journal_entries`
--

CREATE TABLE `journal_entries` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `type` enum('Umum','Penyesuaian','Penutup') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journal_entries`
--

INSERT INTO `journal_entries` (`id`, `transaction_code`, `date`, `description`, `created_by`, `type`, `created_at`, `updated_at`) VALUES
(1, 'JU-1749713222', '2025-06-01', 'Kas (modal disetor tunai)', 1, 'Umum', '2025-06-12 00:27:02', '2025-06-12 00:27:02'),
(2, 'JU-1749713941', '2025-06-02', 'Sewa kantor dibayar 3 bulan di muka', 1, 'Umum', '2025-06-12 00:39:01', '2025-06-12 00:39:01'),
(3, 'JU-1749719106', '2025-06-03', 'Membeli perlengkapan kantor tunai', 1, 'Umum', '2025-06-12 02:05:06', '2025-06-12 02:05:06'),
(4, 'JU-1749719391', '2025-06-04', 'Membeli peralatan kerja secara kredit', 1, 'Umum', '2025-06-12 02:09:51', '2025-06-12 02:09:51'),
(5, 'JU-1749719470', '2025-06-05', 'Memberikan jasa kepada klien tunai', 1, 'Umum', '2025-06-12 02:11:10', '2025-06-12 02:11:10'),
(6, 'JU-1749719541', '2025-06-06', 'Memberikan jasa secara kredit', 1, 'Umum', '2025-06-12 02:12:21', '2025-06-12 02:12:21'),
(7, 'JU-1749719923', '2025-06-08', 'Membayar gaji karyawan', 1, 'Umum', '2025-06-12 02:18:43', '2025-06-12 02:18:43'),
(8, 'JU-1749720170', '2025-06-10', 'Membayar listrik', 1, 'Umum', '2025-06-12 02:22:50', '2025-06-12 02:22:50'),
(9, 'JU-1749720213', '2025-06-10', 'Membayar Air', 1, 'Umum', '2025-06-12 02:23:33', '2025-06-12 02:23:33'),
(10, 'JU-1749720272', '2025-06-12', 'Bayar utang usaha sebagian', 1, 'Umum', '2025-06-12 02:24:32', '2025-06-12 02:24:32'),
(11, 'JU-1749722459', '2025-06-15', 'Terima pelunasan dari piutang', 1, 'Umum', '2025-06-12 03:00:59', '2025-06-12 03:00:59'),
(12, 'JU-1749722516', '2025-06-17', 'Membayar beban telepon', 1, 'Umum', '2025-06-12 03:01:56', '2025-06-12 03:01:56'),
(13, 'JU-1749722708', '2025-06-20', 'Menerima pendapatan sewa diterima di muka', 1, 'Umum', '2025-06-12 03:05:08', '2025-06-12 03:05:08'),
(14, 'JU-1749722775', '2025-06-21', 'Membeli ATK untuk dipakai', 1, 'Umum', '2025-06-12 03:06:15', '2025-06-12 03:06:15'),
(15, 'JU-1749722872', '2025-06-22', 'Membayar biaya internet', 1, 'Umum', '2025-06-12 03:07:52', '2025-06-12 03:07:52'),
(16, 'JU-1749722903', '2025-06-25', 'Terima pendapatan jasa tunai', 1, 'Umum', '2025-06-12 03:08:23', '2025-06-12 03:08:23'),
(17, 'JU-1749722940', '2025-06-27', 'Penarikan pribadi pemilik', 1, 'Umum', '2025-06-12 03:09:00', '2025-06-12 03:09:00'),
(18, 'JU-1749722987', '2025-06-28', 'Terima pelunasan sisa piutang', 1, 'Umum', '2025-06-12 03:09:47', '2025-06-12 03:09:47'),
(19, 'JU-1749723030', '2025-06-29', 'Bayar utang usaha sisa', 1, 'Umum', '2025-06-12 03:10:30', '2025-06-12 03:10:30'),
(20, 'JU-1749723085', '2025-06-30', 'Bayar beban promosi', 1, 'Umum', '2025-06-12 03:11:25', '2025-06-12 03:11:25'),
(21, 'JU-1749723119', '2025-06-30', 'Bayar beban kebersihan', 1, 'Umum', '2025-06-12 03:11:59', '2025-06-12 03:11:59'),
(22, 'JU-1749723477', '2025-06-30', 'Beban Sewa (1 bulan dari 3 bulan)', 1, 'Penyesuaian', '2025-06-12 03:17:57', '2025-06-12 03:17:57'),
(23, 'JU-1749723567', '2025-06-30', 'Beban Perlengkapan (terpakai Rp1.500.000)', 1, 'Penyesuaian', '2025-06-12 03:19:27', '2025-06-12 03:19:27'),
(24, 'JU-1749724249', '2025-06-30', 'Beban Penyusutan Peralatan', 1, 'Penyesuaian', '2025-06-12 03:30:49', '2025-06-12 03:30:49'),
(25, 'JU-1749724307', '2025-06-30', 'Pendapatan Sewa (1 bulan diakui)', 1, 'Penyesuaian', '2025-06-12 03:31:47', '2025-06-12 03:31:47'),
(26, 'JU-1749724348', '2025-06-30', 'Beban Gaji terutang', 1, 'Penyesuaian', '2025-06-12 03:32:28', '2025-06-12 03:32:28'),
(27, 'JU-1749724758', '2025-06-30', 'Tutup pendapatan jasa', 1, 'Penutup', '2025-06-12 03:39:18', '2025-06-12 03:39:18');

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
(4, '2025_06_04_071028_add_two_factor_columns_to_users_table', 1),
(5, '2025_06_04_071057_create_personal_access_tokens_table', 1),
(6, '2025_06_11_081803_create_table_accounts', 1),
(7, '2025_06_11_081929_create_table_journal_entries', 1),
(8, '2025_06_11_082021_create_table_journal_details', 1),
(9, '2025_06_11_101329_create_cash_banks_table', 1),
(10, '2025_06_11_102149_create_accounting_periods_table', 1),
(11, '2025_06_11_105510_create_units_table', 1);

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
('zyolR06u671soTB7HRJpqa7zrHOU0Y5AOu1ZcS4g', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiendKZGVhWDFSc2kwWmQzY1dCVWpKTjVKU3VOdDhBbkxYMUtOM3FIRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sYXBvcmFuL2p1cm5hbC11bXVtIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRXOFNwRnR2V0txL29yUHMvemllR0xlMDIyUTFMV3h4NVRIR2pldy5CVEg5VldhVUpLeVF2UyI7fQ==', 1749726644);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Herianto', 'herianto.sy@gmail.com', NULL, '$2y$12$W8SpFtvWKq/orPs/zieGLe022Q1LWxx5THGjew.BTH9VWaUJKyQvS', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 23:40:50', '2025-06-11 23:40:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_periods`
--
ALTER TABLE `accounting_periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accounts_code_unique` (`code`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cash_banks`
--
ALTER TABLE `cash_banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_banks_account_id_foreign` (`account_id`),
  ADD KEY `cash_banks_journal_entry_id_foreign` (`journal_entry_id`);

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
-- Indexes for table `journal_details`
--
ALTER TABLE `journal_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journal_details_journal_entry_id_foreign` (`journal_entry_id`),
  ADD KEY `journal_details_account_id_foreign` (`account_id`);

--
-- Indexes for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `journal_entries_transaction_code_unique` (`transaction_code`),
  ADD KEY `journal_entries_created_by_foreign` (`created_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `units_kode_unique` (`kode`);

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
-- AUTO_INCREMENT for table `accounting_periods`
--
ALTER TABLE `accounting_periods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `cash_banks`
--
ALTER TABLE `cash_banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `journal_details`
--
ALTER TABLE `journal_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `journal_entries`
--
ALTER TABLE `journal_entries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cash_banks`
--
ALTER TABLE `cash_banks`
  ADD CONSTRAINT `cash_banks_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `cash_banks_journal_entry_id_foreign` FOREIGN KEY (`journal_entry_id`) REFERENCES `journal_entries` (`id`);

--
-- Constraints for table `journal_details`
--
ALTER TABLE `journal_details`
  ADD CONSTRAINT `journal_details_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `journal_details_journal_entry_id_foreign` FOREIGN KEY (`journal_entry_id`) REFERENCES `journal_entries` (`id`);

--
-- Constraints for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD CONSTRAINT `journal_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
