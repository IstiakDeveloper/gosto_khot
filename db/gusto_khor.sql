/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member_id` bigint unsigned NOT NULL,
  `payment_date` date NOT NULL,
  `amount` int NOT NULL DEFAULT '100',
  `total_weeks` int NOT NULL DEFAULT '0',
  `total_amount` int NOT NULL DEFAULT '0',
  `total_payment` int NOT NULL DEFAULT '0',
  `total_due` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_member_id_foreign` (`member_id`),
  CONSTRAINT `payments_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('arifurrahmanreza@gmail.com|103.68.118.16', 'i:1;', 1719125510);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('arifurrahmanreza@gmail.com|103.68.118.16:timer', 'i:1719125510;', 1719125510);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:1;', 1719567345);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1719567345;', 1719567345),
('elio.ferrara@goodpostman.com|185.17.107.85', 'i:2;', 1719228007),
('elio.ferrara@goodpostman.com|185.17.107.85:timer', 'i:1719228007;', 1719228007),
('hugolehmann92@outlook.com|185.17.107.85', 'i:4;', 1719228063),
('hugolehmann92@outlook.com|185.17.107.85:timer', 'i:1719228063;', 1719228063),
('sstokes81@yahoo.com|185.17.107.85', 'i:2;', 1719228045),
('sstokes81@yahoo.com|185.17.107.85:timer', 'i:1719228045;', 1719228045),
('superadmin@gmail.con|103.68.118.16', 'i:2;', 1719125708),
('superadmin@gmail.con|103.68.118.16:timer', 'i:1719125708;', 1719125708),
('superadmin@mail.con|103.68.118.16', 'i:1;', 1719125694),
('superadmin@mail.con|103.68.118.16:timer', 'i:1719125694;', 1719125694);









INSERT INTO `members` (`id`, `name`, `gram`, `phone`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'Arifur Rahman', 'Baniapara', '01723533993', 'photos/CaNqeYq3v30oOP4YpJMjcUah3CADO9DUlYKPpLMh.png', '2024-06-23 19:49:53', '2024-06-28 09:33:46');
INSERT INTO `members` (`id`, `name`, `gram`, `phone`, `photo`, `created_at`, `updated_at`) VALUES
(3, 'Abdul Hai', 'Dorgapara', '01737064155', 'photos/xr5NU1sz0DxoL8RnGqMD0anVdD56jrCbciY2Z71L.jpg', '2024-06-24 20:10:50', '2024-06-28 08:55:57');
INSERT INTO `members` (`id`, `name`, `gram`, `phone`, `photo`, `created_at`, `updated_at`) VALUES
(4, 'Atiqul', 'Dorgapara', NULL, 'photos/SGrmqRv45FAKvHPK3g0LWMg4AtmL9lW2Pdh2lJNX.png', '2024-06-24 20:11:52', '2024-06-28 09:33:57');
INSERT INTO `members` (`id`, `name`, `gram`, `phone`, `photo`, `created_at`, `updated_at`) VALUES
(5, 'Ashraful/Komola', 'Dorgapara', NULL, NULL, '2024-06-24 20:12:44', '2024-06-24 20:12:44'),
(6, 'Awal vai', 'Madrasa para', NULL, NULL, '2024-06-24 20:15:18', '2024-06-24 20:15:18'),
(7, 'Azmul Vai', 'Madrasapara', NULL, NULL, '2024-06-24 20:15:50', '2024-06-24 20:15:50'),
(8, 'Dulal vai', 'Dorgapara', NULL, NULL, '2024-06-24 20:16:43', '2024-06-24 20:16:43'),
(9, 'Farid babu', 'Dorgapara', NULL, NULL, '2024-06-24 20:17:15', '2024-06-24 20:17:15'),
(10, 'Faruk', 'Baniapara', '01776180380', NULL, '2024-06-24 20:17:42', '2024-06-27 23:46:30'),
(11, 'Arifur Rahman', 'Baniapara', '01723533993', NULL, '2024-06-24 20:18:16', '2024-06-28 14:46:37'),
(12, 'Firoz ', 'Pukurpara', NULL, NULL, '2024-06-24 20:18:58', '2024-06-24 20:18:58'),
(13, 'Jahidul', 'Bumbupara', NULL, NULL, '2024-06-24 20:19:34', '2024-06-24 20:19:34'),
(14, 'Jobayer', 'Dorgapara', NULL, NULL, '2024-06-24 20:19:53', '2024-06-24 20:19:53'),
(15, 'Jony', 'Dorgapara', NULL, NULL, '2024-06-24 20:20:17', '2024-06-24 20:20:17'),
(16, 'Juwel chacha', 'Dorgapara', NULL, NULL, '2024-06-24 20:23:09', '2024-06-24 20:23:09'),
(17, 'Matin chacha', 'Pukurpara', NULL, NULL, '2024-06-24 20:23:48', '2024-06-24 20:23:48'),
(18, 'Md Tanvir', 'Sorokpara', NULL, NULL, '2024-06-24 20:24:32', '2024-06-24 20:24:32'),
(19, 'Muktadir', 'Dorgapara', NULL, NULL, '2024-06-24 20:25:22', '2024-06-24 20:25:22'),
(20, 'Rabiul vai', 'Dorgapara', NULL, NULL, '2024-06-24 20:25:51', '2024-06-24 20:25:51'),
(21, 'Ripon', 'Sorokpara', NULL, NULL, '2024-06-24 20:26:41', '2024-06-24 20:26:41'),
(22, 'Saddam babu', 'Sorokpara', NULL, 'photos/pTqqEazYHkFRiw9oOPsItJWrRLLYTSqJFH27ATYg.png', '2024-06-24 20:27:19', '2024-06-28 09:31:52'),
(23, 'Shafi chacchu', 'Dorgapara', NULL, NULL, '2024-06-24 20:27:45', '2024-06-24 20:27:45'),
(24, 'Shahin', 'Dorgapara', NULL, NULL, '2024-06-24 20:28:28', '2024-06-24 20:28:28'),
(25, 'Shakibul', 'Dorgapara', NULL, NULL, '2024-06-24 20:29:01', '2024-06-24 20:29:01'),
(26, 'Shakil', 'Dorgapara', NULL, NULL, '2024-06-24 20:29:21', '2024-06-24 20:29:21'),
(27, 'Shihab chacha', 'Dorgapara', NULL, NULL, '2024-06-24 20:30:16', '2024-06-24 20:30:16'),
(28, 'Sifat', 'Dorgapara', NULL, NULL, '2024-06-24 20:32:05', '2024-06-24 20:32:05'),
(29, 'Sona vai', 'Dorgapara', NULL, NULL, '2024-06-24 20:32:33', '2024-06-24 20:32:33'),
(30, 'Shakil', 'Dorgapara', '01722287221', NULL, '2024-06-24 20:33:55', '2024-06-28 00:28:19'),
(31, 'dhshsgh', 'Baniapara', '01717893432', 'photos/xMY2pd2fEmCBEuBjs5sRAOmP7ezjlY4iFZHpqDyZ.jpg', '2024-06-28 09:27:45', '2024-06-28 09:27:45'),
(32, 'xhsfh', 'sgdsfg', 'sdfgdsfg', 'photos/t2hSoSi2FZoMGOQyGPYAXshbndFlvvvFCpYU4wZG.png', '2024-06-28 09:32:40', '2024-06-28 09:32:40');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2024_06_22_204700_create_members_table', 1),
(5, '2024_06_22_204701_create_payments_table', 1);



INSERT INTO `payments` (`id`, `member_id`, `payment_date`, `amount`, `total_weeks`, `total_amount`, `total_payment`, `total_due`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-06-23', 100, 7, 700, 100, 600, '2024-06-23 19:53:29', '2024-06-23 19:53:29');
INSERT INTO `payments` (`id`, `member_id`, `payment_date`, `amount`, `total_weeks`, `total_amount`, `total_payment`, `total_due`, `created_at`, `updated_at`) VALUES
(2, 1, '2024-06-23', 100, 0, 0, 0, 0, '2024-06-23 19:53:52', '2024-06-23 19:53:52');
INSERT INTO `payments` (`id`, `member_id`, `payment_date`, `amount`, `total_weeks`, `total_amount`, `total_payment`, `total_due`, `created_at`, `updated_at`) VALUES
(3, 1, '2024-06-24', 500, 0, 0, 0, 0, '2024-06-24 20:08:46', '2024-06-24 20:08:46');
INSERT INTO `payments` (`id`, `member_id`, `payment_date`, `amount`, `total_weeks`, `total_amount`, `total_payment`, `total_due`, `created_at`, `updated_at`) VALUES
(5, 3, '2024-06-24', 700, 0, 0, 0, 0, '2024-06-24 20:11:29', '2024-06-24 20:11:29'),
(6, 4, '2024-06-24', 700, 0, 0, 0, 0, '2024-06-24 20:12:04', '2024-06-24 20:12:04'),
(7, 5, '2024-06-24', 700, 0, 0, 0, 0, '2024-06-24 20:12:54', '2024-06-24 20:12:54'),
(8, 6, '2024-06-24', 700, 0, 0, 0, 0, '2024-06-24 20:15:33', '2024-06-24 20:15:33'),
(9, 7, '2024-06-24', 700, 0, 0, 0, 0, '2024-06-24 20:16:25', '2024-06-24 20:16:25'),
(10, 8, '2024-06-24', 700, 0, 0, 0, 0, '2024-06-24 20:16:54', '2024-06-24 20:16:54'),
(11, 9, '2024-06-24', 700, 0, 0, 0, 0, '2024-06-24 20:17:28', '2024-06-24 20:17:28'),
(12, 10, '2024-06-24', 600, 0, 0, 0, 0, '2024-06-24 20:17:52', '2024-06-24 20:17:52'),
(13, 11, '2024-06-24', 700, 0, 0, 0, 0, '2024-06-24 20:18:39', '2024-06-24 20:18:39'),
(14, 12, '2024-06-24', 600, 0, 0, 0, 0, '2024-06-24 20:19:17', '2024-06-24 20:19:17'),
(15, 13, '2024-06-24', 100, 0, 0, 0, 0, '2024-06-24 20:19:42', '2024-06-24 20:19:42'),
(16, 14, '2024-06-24', 700, 0, 0, 0, 0, '2024-06-24 20:20:02', '2024-06-24 20:20:02'),
(17, 15, '2024-06-24', 700, 0, 0, 0, 0, '2024-06-24 20:21:08', '2024-06-24 20:21:08'),
(18, 16, '2024-06-24', 100, 0, 0, 0, 0, '2024-06-24 20:23:22', '2024-06-24 20:23:22'),
(19, 17, '2024-06-24', 600, 0, 0, 0, 0, '2024-06-24 20:24:11', '2024-06-24 20:24:11'),
(20, 18, '2024-06-24', 500, 0, 0, 0, 0, '2024-06-24 20:24:43', '2024-06-24 20:24:43'),
(21, 19, '2024-06-24', 700, 0, 0, 0, 0, '2024-06-24 20:25:35', '2024-06-24 20:25:35'),
(22, 20, '2024-06-24', 700, 0, 0, 0, 0, '2024-06-24 20:26:04', '2024-06-24 20:26:04'),
(23, 21, '2024-06-24', 400, 0, 0, 0, 0, '2024-06-24 20:27:02', '2024-06-24 20:27:02'),
(24, 22, '2024-06-24', 700, 0, 0, 0, 0, '2024-06-24 20:27:28', '2024-06-24 20:27:28'),
(25, 23, '2024-06-24', 600, 0, 0, 0, 0, '2024-06-24 20:28:05', '2024-06-24 20:28:05'),
(26, 24, '2024-06-24', 700, 0, 0, 0, 0, '2024-06-24 20:28:46', '2024-06-24 20:28:46'),
(27, 25, '2024-06-24', 300, 0, 0, 0, 0, '2024-06-24 20:29:12', '2024-06-24 20:29:12'),
(28, 26, '2024-06-24', 600, 0, 0, 0, 0, '2024-06-24 20:29:31', '2024-06-24 20:29:31'),
(29, 27, '2024-06-24', 700, 0, 0, 0, 0, '2024-06-24 20:31:45', '2024-06-24 20:31:45'),
(30, 28, '2024-06-24', 100, 0, 0, 0, 0, '2024-06-24 20:32:17', '2024-06-24 20:32:17'),
(31, 29, '2024-06-24', 100, 0, 0, 0, 0, '2024-06-24 20:32:42', '2024-06-24 20:32:42'),
(32, 22, '2024-06-28', 500, 0, 0, 0, 0, '2024-06-28 09:32:13', '2024-06-28 09:32:23');

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('21HvIX7kowm0Scsa8A2rkcCRYS5cqRLujxa8YWkF', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiV3lQNlhqS3M5eXl0VFZnNGtBRGpyS25JbmVGWFAwRmlFSTkwUThVYyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjE4OiJmbGFzaGVyOjplbnZlbG9wZXMiO2E6MDp7fX0=', 1719567291);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7fpQjRNK0pXVfzHfTCLVU2GV1H8XUu1ZUQsFRJSY', 2, '103.230.209.84', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSWQxQW51eTY2cndRRFpCTXlHZUdHUnhqdEpCUFFVMmpwMFZPeXRZeiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vZ29zdG8uZGVzaWduZmljLmNvbS9tZW1iZXJzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1719564418);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('o59MwUocpaVEynaZ3cAS0urWEr6a0eiRpjda8m2B', 2, '103.230.209.66', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZm5YUlJrMmQzdkJXVEQwUVBaMTluR2JSalNYZ21BaUFHUHUyeGo5ayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vZ29zdG8uZGVzaWduZmljLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1719561594);

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2024-06-23 06:31:58', '$2y$12$MDPVcnTwtNTct.LBKbVhLO5DdCxn4G2JvRHZvSfZFAJdfIm3uv1ZK', 'yvByWTeg5Q', '2024-06-23 06:31:58', '2024-06-23 06:31:58');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Super Admin', 'superadmin@mail.com', NULL, '$2y$12$PcH.9X4DZe.Es70rYADSeOu.YFQVEgRF/KQVQxO8JZQuDq56CVfY6', 'ferSO9VM6NJyFjALky0YshvemjS9W3z2DlOP7ESxFjlzTSuxhzMuZoLa4CTv', '2024-06-23 06:39:12', '2024-06-23 06:39:12');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;