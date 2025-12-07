-- SQL Script untuk membuat tabel product_request_items
-- Jalankan script ini di phpMyAdmin atau MySQL client jika migration tidak bisa dijalankan

USE db_inventori;

CREATE TABLE IF NOT EXISTS `product_request_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_request_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `npk` varchar(255) DEFAULT NULL,
  `validated` tinyint(1) NOT NULL DEFAULT 0,
  `validated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_request_items_product_request_id_foreign` (`product_request_id`),
  KEY `product_request_items_product_id_foreign` (`product_id`),
  CONSTRAINT `product_request_items_product_request_id_foreign` FOREIGN KEY (`product_request_id`) REFERENCES `product_requests` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_request_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


