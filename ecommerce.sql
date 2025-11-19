-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2025 at 04:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conversation_messages`
--

CREATE TABLE `conversation_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `conversation_id` bigint(20) UNSIGNED NOT NULL,
  `sender_type` enum('user','admin') NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversation_messages`
--

INSERT INTO `conversation_messages` (`id`, `conversation_id`, `sender_type`, `sender_id`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 1, 'Test', 0, '2025-09-24 04:12:07', '2025-09-24 04:12:07'),
(2, 2, 'admin', 1, 'Test1', 1, '2025-09-24 04:27:37', '2025-09-24 04:58:15'),
(3, 2, 'admin', 1, 'Testing', 1, '2025-09-24 04:29:33', '2025-09-24 04:58:15'),
(4, 2, 'admin', 1, 'Hello', 1, '2025-09-24 04:31:48', '2025-09-24 04:58:15'),
(5, 2, 'admin', 1, 'Nice Testing', 1, '2025-09-24 04:31:56', '2025-09-24 04:58:15'),
(6, 2, 'user', 7, 'HAHAHAHA', 1, '2025-09-24 04:43:53', '2025-09-24 04:58:15'),
(7, 2, 'admin', 1, 'Gegege', 1, '2025-09-24 04:44:05', '2025-09-24 04:58:15'),
(8, 2, 'user', 7, 'Nice gumagana na', 1, '2025-09-24 04:44:14', '2025-09-24 04:58:15'),
(9, 2, 'user', 7, 'HAHHAAHHAHA', 1, '2025-09-24 04:45:01', '2025-09-24 04:58:15'),
(10, 2, 'admin', 1, 'oo nga eh', 1, '2025-09-24 04:45:10', '2025-09-24 04:58:15'),
(11, 2, 'admin', 1, 'Ulaga kase', 1, '2025-09-24 04:52:24', '2025-09-24 04:58:15'),
(12, 2, 'user', 7, 'ako pa', 1, '2025-09-24 04:56:50', '2025-09-24 04:58:15'),
(13, 2, 'admin', 1, 'alangan naman ako', 1, '2025-09-24 04:57:04', '2025-09-24 04:58:15'),
(14, 2, 'user', 7, 'eh bat ako?', 1, '2025-09-24 04:57:14', '2025-09-24 04:58:15'),
(15, 2, 'admin', 1, 'HAHAHHAHAHHA', 1, '2025-09-24 04:57:22', '2025-09-24 04:58:15'),
(16, 2, 'user', 7, 'AHHAHHAHAAA', 1, '2025-09-24 04:57:28', '2025-09-24 04:58:15'),
(17, 2, 'user', 7, 'we di nga', 1, '2025-09-24 04:59:24', '2025-09-24 04:59:25'),
(18, 2, 'user', 7, 'HAHHAHAHA', 1, '2025-09-24 05:01:13', '2025-09-24 05:01:13'),
(19, 2, 'admin', 1, 'HAHHAHAHHAA', 1, '2025-09-24 05:02:35', '2025-09-24 05:02:36'),
(20, 2, 'user', 7, 'AHAHAHAHHAHA', 1, '2025-09-24 05:02:47', '2025-09-24 05:02:48'),
(21, 2, 'admin', 1, 'ngek', 1, '2025-09-24 05:02:52', '2025-09-24 05:02:53');

-- --------------------------------------------------------

--
-- Table structure for table `customer_addto_carts`
--

CREATE TABLE `customer_addto_carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_addto_carts`
--

INSERT INTO `customer_addto_carts` (`id`, `customer_id`, `item_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 7, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_information`
--

CREATE TABLE `customer_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `hash_token` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` enum('active','banned','suspended') NOT NULL DEFAULT 'active',
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_information`
--

INSERT INTO `customer_information` (`id`, `name`, `email`, `phone`, `address`, `email_verified_at`, `password`, `hash_token`, `remember_token`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(7, 'Kent Cortiguerra', 'kentcortiguerra.troubleshouter@gmail.com', '09297966745', 'Bangin San Nicolas, Batangas', '2025-09-21 06:33:39', '$2y$12$unNbIbj5OvW1ooHzMIDMquNXPvvodFhOCUk10Z.fkzydmGbGDHCCi', NULL, NULL, 'active', NULL, '2025-09-21 06:33:24', '2025-09-22 03:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_type_id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `file_path` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_type_id`, `item_name`, `description`, `stock`, `price`, `is_featured`, `file_path`, `created_at`, `updated_at`) VALUES
(17, 1, 'BeltBag 1', 'BeltBag 1', 100, 150.00, 1, 'product_68d3ed52ba5129.42596406.png', '2025-09-24 05:08:34', '2025-09-24 06:26:47'),
(18, 1, 'BeltBag 2', 'BeltBag 2', 10, 210.00, 0, 'product_68d3ed71672c96.53871694.png', '2025-09-24 05:09:05', '2025-09-24 05:09:05'),
(19, 2, 'Blanket - Small', 'Blanket - Small', 10, 300.00, 0, 'product_68d3ed9ee77448.52693562.png', '2025-09-24 05:09:51', '2025-09-24 05:09:51'),
(20, 2, 'Blanket - Medium', 'Blanket - Medium', 10, 500.00, 1, 'product_68d3edb9b19646.11000612.png', '2025-09-24 05:10:17', '2025-09-24 05:10:17'),
(21, 3, 'FIL -1', 'FIL -1', 10, 750.00, 0, 'product_68d3ede2a4c408.22554186.png', '2025-09-24 05:10:58', '2025-09-24 05:10:58'),
(22, 3, 'FIL -2', 'FIL -2', 11, 850.00, 0, 'product_68d3ee039248f6.98505116.png', '2025-09-24 05:11:31', '2025-09-24 05:11:31'),
(23, 3, 'FIL -3', 'FIL -3', 5, 1000.00, 0, 'product_68d3ee211fc221.46898790.png', '2025-09-24 05:12:01', '2025-09-24 05:12:01'),
(24, 4, 'Handbag-1', 'Handbag-1', 15, 750.00, 1, 'product_68d3ee439f98e2.64256236.png', '2025-09-24 05:12:35', '2025-09-24 05:12:35'),
(25, 4, 'Handbag-2', 'Handbag-2', 15, 1050.00, 0, 'product_68d3ee5a338642.69842629.png', '2025-09-24 05:12:58', '2025-09-24 05:12:58'),
(26, 4, 'Handbag-3', 'Handbag-3', 12, 450.00, 0, 'product_68d3ee7a6f99e4.68256311.png', '2025-09-24 05:13:30', '2025-09-24 05:13:30'),
(27, 4, 'Handbag-4', 'Handbag-4', 15, 900.00, 0, 'product_68d3ee92d22026.98317677.png', '2025-09-24 05:13:54', '2025-09-24 05:13:54'),
(28, 4, 'Handbag-5', 'Handbag-5', 15, 210.00, 1, 'product_68d3eea52bbd21.71746156.png', '2025-09-24 05:14:13', '2025-09-24 05:14:13'),
(29, 5, 'Headband 1', 'Headband 1', 25, 150.00, 0, 'product_68d3eecaf0b131.07139713.png', '2025-09-24 05:14:51', '2025-09-24 05:14:51'),
(30, 5, 'Headband 2', 'Headband 2', 12, 126.00, 0, 'product_68d3eee11185e8.09129694.png', '2025-09-24 05:15:13', '2025-09-24 05:15:13'),
(31, 5, 'Headband 3', 'Headband 3', 12, 124.00, 1, 'product_68d3eef78c6160.59379621.png', '2025-09-24 05:15:35', '2025-09-24 05:15:35'),
(32, 6, 'Scarf 1', 'Scarf 1', 10, 150.00, 0, 'product_68d3ef15247a31.49525725.png', '2025-09-24 05:16:05', '2025-09-24 05:16:05'),
(33, 6, 'Scarf 2', 'Scarf 2', 12, 170.00, 0, 'product_68d3ef2a417114.91884363.png', '2025-09-24 05:16:26', '2025-09-24 05:16:26'),
(34, 6, 'Scarf 3', 'Scarf 3', 15, 178.00, 1, 'product_68d3ef40149f74.56072539.png', '2025-09-24 05:16:48', '2025-09-24 05:16:48'),
(35, 6, 'Scarf 4', 'Scarf 4', 15, 120.00, 0, 'product_68d3ef5318a685.41856129.png', '2025-09-24 05:17:07', '2025-09-24 05:17:07'),
(36, 6, 'Scarf 5', 'Scarf 5', 5, 169.00, 1, 'product_68d3ef6fc96d94.26063199.png', '2025-09-24 05:17:35', '2025-09-24 05:17:35'),
(37, 6, 'Scarf 6', 'Scarf 6', 13, 158.00, 0, 'product_68d3ef85989014.96573424.png', '2025-09-24 05:17:57', '2025-09-24 05:17:57'),
(38, 7, 'Case 1', 'Case 1', 13, 145.00, 1, 'product_68d3efa1ecca06.20276466.png', '2025-09-24 05:18:26', '2025-09-24 05:18:26'),
(39, 7, 'Case 2', 'Case 2', 13, 145.00, 0, 'product_68d3efb837a336.99521886.png', '2025-09-24 05:18:48', '2025-09-24 05:18:48'),
(40, 8, 'Wallet 1', 'Wallet 1', 10, 145.00, 0, 'product_68d3efd1680a19.47874639.png', '2025-09-24 05:19:13', '2025-09-24 05:19:13'),
(41, 8, 'Wallet 2', 'Wallet 2', 15, 13.00, 0, 'product_68d3efe6df54f4.70622094.png', '2025-09-24 05:19:34', '2025-09-24 05:19:34'),
(42, 8, 'Wallet 3', 'Wallet 3', 0, 165.00, 0, 'product_68d3effaf21e78.77179933.png', '2025-09-24 05:19:55', '2025-09-24 05:19:55'),
(43, 8, 'Wallet 4', 'Wallet 4', 0, 150.00, 1, 'product_68d3f045aaae84.22571822.png', '2025-09-24 05:21:09', '2025-09-24 05:21:09'),
(44, 8, 'Wallet 5', 'Wallet 5', 9, 150.00, 0, 'product_68d3f07a634d37.74254757.png', '2025-09-24 05:22:02', '2025-09-24 05:22:02'),
(45, 8, 'Wallet 6', 'Wallet 6', 0, 123.00, 0, 'product_68d3f094278be1.59690158.png', '2025-09-24 05:22:28', '2025-09-24 05:22:28'),
(46, 8, 'Wallet 7', 'Wallet 7', 3, 125.00, 0, 'product_68d3f0aedb8597.80870084.png', '2025-09-24 05:22:54', '2025-09-24 05:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `item_sizes`
--

CREATE TABLE `item_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_types`
--

CREATE TABLE `item_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_types`
--

INSERT INTO `item_types` (`id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 'BeltBag', '2025-09-19 03:52:37', '2025-09-19 03:52:37'),
(2, 'Blanket', '2025-09-19 03:52:37', '2025-09-19 03:52:37'),
(3, 'Filipiniana', '2025-09-19 03:52:37', '2025-09-19 03:52:37'),
(4, 'Handbag', '2025-09-19 03:52:37', '2025-09-19 03:52:37'),
(5, 'Headband', '2025-09-19 03:52:37', '2025-09-19 03:52:37'),
(6, 'Scarf', '2025-09-19 03:52:37', '2025-09-19 03:52:37'),
(7, 'Tumbler Case', '2025-09-19 03:52:37', '2025-09-19 03:52:37'),
(8, 'Wallets', '2025-09-19 03:52:37', '2025-09-19 03:52:37');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_03_131402_create_item_types_table', 2),
(5, '2025_09_03_132425_create_customer_information_table', 2),
(6, '2025_09_03_132725_create_order_details_table', 2),
(7, '2025_09_21_131544_add_status_for_customer_information', 3),
(8, '2025_09_21_131806_add_remarks_for_customer_information', 4),
(9, '2025_09_21_140338_add_hash_token_for_email_confirmation', 5),
(10, '2025_09_22_111807_create_customer_carts_table', 6),
(11, '2025_09_24_114712_create_user_conversation_with_admins_table', 6),
(12, '2025_09_24_114904_create_conversation_messages_table', 6),
(13, '2025_09_24_122259_add_last_message', 7),
(14, '2025_09_24_141917_add_field_for_make_product_featured_item', 8),
(15, '2025_09_24_150106_create_customer_addto_carts_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail_items`
--

CREATE TABLE `order_detail_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_detail_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail_item_customizations`
--

CREATE TABLE `order_detail_item_customizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_detail_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `textile` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1RTVdY6jRp0xgMvpMWYymz3e7BMvSLRQDLmGmPNE', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQlVLNnZIcWp0aFdzQmNrNXVSMlBUZk5CUThON2dBeU1Qc2R1aGN1YiI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoxNDc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC8/ZmJjbGlkPUl3WTJ4amF3TkE1YlJsZUhSdUEyRmxiUUl4TVFBQkhubm9GcWdpbFVYa2JBc25EaHYyVVBYeTVLUkgxdTNhR3JtSUFSNmxGZGtFVTRZNmRLUWVfS0l0RVQwaF9hZW1fQlVVRVE4bGJuZVR4VTZPSF8yTWF1QSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758725786),
('5PzGZtXdtzSkjMEY2grIg6XdQGJ1snys0trGmKa5', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMzA0TE0wamRBNWVsVlJGOHgxOFM1dkEyTFh5NWxrTU9Bdk1MZHh1NiI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoxNDc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC8/ZmJjbGlkPUl3WTJ4amF3TkE1WEZsZUhSdUEyRmxiUUl4TVFBQkhpR1VDR3lsejFhaXZYdWxjYnBDYmoyMkZWTkNYMnRGQmRnOEtJaU1BNG00X1J4TGt6WXJTZjBHdE9XX19hZW1fT05QQlA0UTB0U3hZMkZTemNZdkI0dyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758725680),
('d2E3vFylvzzWZWW9TnxS8EaWQwFo23NC3CTMzY1C', NULL, '127.0.0.1', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSW9XeDl6blUxQzZsNTFtQmxwNWJ5NkVVSERNWEVCZEh6Q0VzeXA5UiI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758725676),
('JFfA5UalZblxxiTmJb84DU9nXt3OsVV8aaxCevy0', NULL, '127.0.0.1', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUGJtRHVyNEhzVTIzeWtNZjhSNEh0ZTBhSlJETzJ1YVVKb3lkZ3FtRSI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758725725),
('MYvrkFqGTsxNduzxmb3vGOjEKsE2MtCpQoeFQGIu', NULL, '127.0.0.1', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSDlta1B6dHlYVGNXZGY4dHpHdlpEcmlUS1lOSFFSNEwzTEhNWTVFRCI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758725661),
('uP6GY0sTRY0pbRCdsARz39Yi0L81iWyT3ZfXglMx', NULL, '127.0.0.1', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTXZ0bFZaTG03dTVCRkUxNlljT3ExUlI2TGI3NkQwMExnYTlUVDJqWSI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758725678),
('UrsThGSgKVp1vzEmHyjOc5eoFfTil46GjQQbTirk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibktCcEpEN0ZoN044dVFlR1ZzbmFpYk1kaTZtSmNab0ZNRGw3SnRzOCI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoxNDc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC8/ZmJjbGlkPUl3WTJ4amF3TkE1WUpsZUhSdUEyRmxiUUl4TVFBQkh2MUpsNlhFaGI2NDhXTkF3Yl9VYU10RS1wclNmcHk4N3Y1M3dWR05VY3BHV2dQOHZYZlNya2FuOVJlN19hZW1famdvQTlHMTBYMktmU1BkVlRubkxyZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758725694),
('zzq3j9Qw0D2snrLBbucluOoFQVURURtKBLDGuObU', NULL, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiU1gwTDROR3lJUG9sWkpFUjMwaVdWVmVJcDdpNGp1anNTdW5iZVdYeSI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxMToiY3VzdG9tZXJfaWQiO2k6Nzt9', 1758729549);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kent', 'kent@gmail.com', '2025-09-24 12:25:31', '1234', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_conversation_with_admins`
--

CREATE TABLE `user_conversation_with_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('open','closed') NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_message` text DEFAULT NULL,
  `last_message_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_conversation_with_admins`
--

INSERT INTO `user_conversation_with_admins` (`id`, `user_id`, `admin_id`, `status`, `created_at`, `updated_at`, `last_message`, `last_message_at`) VALUES
(1, 1, 1, 'open', '2025-09-24 04:25:54', '2025-09-24 04:25:54', NULL, NULL),
(2, 7, 1, 'open', '2025-09-24 04:27:19', '2025-09-24 04:27:19', NULL, NULL);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `conversation_messages`
--
ALTER TABLE `conversation_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addto_carts`
--
ALTER TABLE `customer_addto_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_information`
--
ALTER TABLE `customer_information`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_information_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_item_type_id_foreign` (`item_type_id`);

--
-- Indexes for table `item_sizes`
--
ALTER TABLE `item_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_sizes_item_id_foreign` (`item_id`);

--
-- Indexes for table `item_types`
--
ALTER TABLE `item_types`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail_items`
--
ALTER TABLE `order_detail_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail_item_customizations`
--
ALTER TABLE `order_detail_item_customizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
-- Indexes for table `user_conversation_with_admins`
--
ALTER TABLE `user_conversation_with_admins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conversation_messages`
--
ALTER TABLE `conversation_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customer_addto_carts`
--
ALTER TABLE `customer_addto_carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_information`
--
ALTER TABLE `customer_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `item_sizes`
--
ALTER TABLE `item_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_types`
--
ALTER TABLE `item_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail_items`
--
ALTER TABLE `order_detail_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail_item_customizations`
--
ALTER TABLE `order_detail_item_customizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_conversation_with_admins`
--
ALTER TABLE `user_conversation_with_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_item_type_id_foreign` FOREIGN KEY (`item_type_id`) REFERENCES `item_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_sizes`
--
ALTER TABLE `item_sizes`
  ADD CONSTRAINT `item_sizes_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
