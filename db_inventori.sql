-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Des 2025 pada 15.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventori`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `departments`
--

INSERT INTO `departments` (`id`, `name`, `kode`, `created_at`, `updated_at`) VALUES
(1, 'Produksi', NULL, '2025-11-24 00:22:23', '2025-11-24 00:22:23'),
(2, 'Quality Control', NULL, '2025-11-24 00:22:23', '2025-11-24 00:22:23'),
(3, 'Maintenance', NULL, '2025-11-24 00:22:23', '2025-11-24 00:22:23'),
(4, 'HRD', NULL, '2025-11-24 00:22:23', '2025-11-24 00:22:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawans`
--

CREATE TABLE `karyawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `npk` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `status_karyawan` enum('Tetap','Kontrak','Magang') NOT NULL DEFAULT 'Tetap',
  `tanggal_masuk` date DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_09_30_000000_create_departments_table', 1),
(4, '2025_10_01_000000_create_users_table', 1),
(5, '2025_10_04_080624_create_products_table', 1),
(6, '2025_10_04_081438_update_products_table_add_missing_columns', 1),
(7, '2025_10_08_150845_create_product_requests_table', 1),
(8, '2025_10_14_135503_create_karyawans_table', 1),
(9, '2025_10_21_054732_update_products_table_add_inventory_columns', 1),
(10, '2025_10_21_064516_add_department_id_to_products_table', 1),
(11, '2025_11_23_185328_add_created_by_to_product_requests', 1),
(12, '2025_11_24_065342_create_product_request_items_table', 1),
(13, '2025_11_24_091144_add_note_to_product_requests_table', 2),
(14, '2025_11_24_094755_add_request_code_to_product_requests', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `min_stock` int(11) NOT NULL DEFAULT 0,
  `loc` varchar(255) DEFAULT NULL,
  `total_gr_september` int(11) NOT NULL DEFAULT 0,
  `gi_september` int(11) NOT NULL DEFAULT 0,
  `ending_balance_september` int(11) NOT NULL DEFAULT 0,
  `uom` varchar(255) DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `item_code`, `description`, `user`, `name`, `category`, `qty`, `min_stock`, `loc`, `total_gr_september`, `gi_september`, `ending_balance_september`, `uom`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'P001', NULL, NULL, 'Kabel Listrik', 'Elektrikal', 10, 2, 'Rak A1', 0, 0, 0, 'pcs', 1, '2025-11-24 00:22:24', '2025-11-24 00:22:24'),
(2, 'P002', NULL, NULL, 'Sarung Tangan Safety', 'Consumable', 20, 5, 'Rak B2', 0, 0, 0, 'pair', 3, '2025-11-24 00:22:24', '2025-11-24 00:22:24'),
(3, '00001', NULL, NULL, 'aaaaaaaaaaaaaaa', 'Sparepart', 130, 10, 'D-5-1(A.1)', 0, 0, 0, 'CAN', 1, '2025-11-24 00:29:06', '2025-11-24 00:29:06'),
(4, '12', NULL, NULL, 'qqqqqqqqqq', 'Sparepart', 111111111, 12, 'D-5-1(A.1)', 0, 0, 0, 'Pcs', 1, '2025-11-24 01:16:30', '2025-11-24 01:16:30'),
(5, '143', NULL, NULL, 'aadawwa', 'Elektrikal', 124, 125, 'OIL AREA', 0, 0, 0, 'Ltr', 1, '2025-11-24 02:03:19', '2025-11-24 02:03:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_requests`
--

CREATE TABLE `product_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) NOT NULL DEFAULT 'user',
  `note` varchar(255) DEFAULT NULL,
  `request_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_requests`
--

INSERT INTO `product_requests` (`id`, `user_id`, `department_id`, `status`, `approved_at`, `created_at`, `updated_at`, `created_by`, `note`, `request_code`) VALUES
(1, 1, NULL, 'pending', NULL, '2025-11-24 02:22:37', '2025-11-24 02:22:37', 'user', 'Request oleh reka', NULL),
(2, 2, NULL, 'pending', NULL, '2025-11-24 02:41:57', '2025-11-24 02:41:57', 'user', 'Request oleh rea', NULL),
(3, 1, NULL, 'rejected', NULL, '2025-11-24 02:50:19', '2025-11-24 02:58:27', 'user', 'Request oleh reka', NULL),
(4, 1, NULL, 'pending', NULL, '2025-11-24 07:28:28', '2025-11-24 07:28:28', 'user', 'Request oleh a', NULL),
(5, 1, NULL, 'pending', NULL, '2025-11-24 07:35:51', '2025-11-24 07:35:51', 'user', 'Request oleh wv', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_request_items`
--

CREATE TABLE `product_request_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_request_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `npk` varchar(255) DEFAULT NULL,
  `validated` tinyint(1) NOT NULL DEFAULT 0,
  `validated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_request_items`
--

INSERT INTO `product_request_items` (`id`, `product_request_id`, `product_id`, `qty`, `npk`, `validated`, `validated_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 12, '11', 0, NULL, '2025-11-24 02:22:37', '2025-11-24 02:22:37'),
(2, 2, 2, 112, NULL, 0, NULL, '2025-11-24 02:41:57', '2025-11-24 02:41:57'),
(3, 3, 4, 10, NULL, 0, NULL, '2025-11-24 02:50:20', '2025-11-24 02:50:20'),
(4, 3, 4, 4, NULL, 0, NULL, '2025-11-24 02:50:20', '2025-11-24 02:50:20'),
(5, 4, 2, 1, NULL, 0, NULL, '2025-11-24 07:28:28', '2025-11-24 07:28:28'),
(6, 5, 3, 1, NULL, 0, NULL, '2025-11-24 07:35:51', '2025-11-24 07:35:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@metalart.com', '$2y$12$dUGc2RQckvzn6MLpHvgbOelJ300bdc66kHy9xjBwX0dUYm5i.68Ci', 'admin', NULL, '2025-11-24 00:22:23', '2025-11-24 00:22:23'),
(2, 'Staff Produksi', 'user@metalart.com', '$2y$12$hEbkQmW5WWE59V1iQ4NoL.CSZ4SMHcpg3dJLkFDklGjzqghfL0eiK', 'user', NULL, '2025-11-24 00:22:24', '2025-11-24 00:22:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `karyawans_npk_unique` (`npk`),
  ADD KEY `karyawans_user_id_foreign` (`user_id`),
  ADD KEY `karyawans_department_id_foreign` (`department_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_item_code_unique` (`item_code`),
  ADD KEY `products_department_id_foreign` (`department_id`);

--
-- Indeks untuk tabel `product_requests`
--
ALTER TABLE `product_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_requests_request_code_unique` (`request_code`),
  ADD KEY `product_requests_user_id_foreign` (`user_id`),
  ADD KEY `product_requests_department_id_foreign` (`department_id`);

--
-- Indeks untuk tabel `product_request_items`
--
ALTER TABLE `product_request_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_request_items_product_request_id_foreign` (`product_request_id`),
  ADD KEY `product_request_items_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `product_requests`
--
ALTER TABLE `product_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `product_request_items`
--
ALTER TABLE `product_request_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `karyawans`
--
ALTER TABLE `karyawans`
  ADD CONSTRAINT `karyawans_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `karyawans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `product_requests`
--
ALTER TABLE `product_requests`
  ADD CONSTRAINT `product_requests_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_request_items`
--
ALTER TABLE `product_request_items`
  ADD CONSTRAINT `product_request_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_request_items_product_request_id_foreign` FOREIGN KEY (`product_request_id`) REFERENCES `product_requests` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
