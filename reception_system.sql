-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 05, 2021 at 11:51 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reception_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reception_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `reception_id`, `created_at`, `updated_at`) VALUES
(1, '10 دقیقه بعد بفرستید', 1, '2021-06-02 01:53:49', '2021-06-02 01:53:49'),
(2, 'درست است اجازه بدهید', 2, '2021-06-02 23:20:24', '2021-06-02 23:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `created_at`, `updated_at`) VALUES
(1, 'مقام اداره', NULL, NULL),
(2, 'معاونیت مالی و اداری', NULL, NULL),
(3, 'معاونیت تفتیش عملکرد و تکنالوژی معلوماتی', NULL, NULL),
(4, 'معاونیت مسلکی', NULL, NULL),
(5, 'ریاست دفتر', NULL, NULL),
(6, 'ریاست منابع بشری', NULL, NULL),
(7, 'ریاست تکنالوژی معلوماتی', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_22_051057_laratrust_setup_tables', 2),
(5, '2021_05_23_070145_create_receptions_table', 3),
(6, '2021_05_23_091532_create_departments_table', 4),
(7, '2021_05_23_091941_create_receptions_table', 5),
(8, '2021_05_24_043416_create_receptions_table', 6),
(9, '2021_05_24_044455_create_users_table', 7),
(10, '2021_05_25_062755_create_receptions_table', 8),
(11, '2021_05_26_055815_create_comments_table', 9),
(12, '2021_05_26_065950_create_receptions_table', 10),
(13, '2021_05_26_070029_create_comments_table', 10),
(14, '2021_05_26_092546_create_comments_table', 11),
(15, '2021_05_29_102723_add_mobile_number_to_receptions', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('reception@gmail.com', '$2y$10$c/71O6UumUADhElMD.5i.utmq8fC4L9107GbQ.IKStT1Xh7EBzYb.', '2021-05-23 00:04:02'),
('fayeq.rahmat@gmail.com', '$2y$10$W8wSzc4kSCfmDO5lEj0Tnex6plrXnBdBJj9rE7Qgz.puIH.X8/KtK', '2021-05-23 00:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'users-create', 'Create Users', 'Create Users', '2021-05-22 00:47:47', '2021-05-22 00:47:47'),
(2, 'users-read', 'Read Users', 'Read Users', '2021-05-22 00:47:47', '2021-05-22 00:47:47'),
(3, 'users-update', 'Update Users', 'Update Users', '2021-05-22 00:47:47', '2021-05-22 00:47:47'),
(4, 'users-delete', 'Delete Users', 'Delete Users', '2021-05-22 00:47:47', '2021-05-22 00:47:47'),
(5, 'payments-create', 'Create Payments', 'Create Payments', '2021-05-22 00:47:47', '2021-05-22 00:47:47'),
(6, 'payments-read', 'Read Payments', 'Read Payments', '2021-05-22 00:47:47', '2021-05-22 00:47:47'),
(7, 'payments-update', 'Update Payments', 'Update Payments', '2021-05-22 00:47:47', '2021-05-22 00:47:47'),
(8, 'payments-delete', 'Delete Payments', 'Delete Payments', '2021-05-22 00:47:47', '2021-05-22 00:47:47'),
(9, 'profile-read', 'Read Profile', 'Read Profile', '2021-05-22 00:47:47', '2021-05-22 00:47:47'),
(10, 'profile-update', 'Update Profile', 'Update Profile', '2021-05-22 00:47:47', '2021-05-22 00:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(9, 3),
(10, 1),
(10, 2),
(10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
CREATE TABLE IF NOT EXISTS `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  KEY `permission_user_permission_id_foreign` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receptions`
--

DROP TABLE IF EXISTS `receptions`;
CREATE TABLE IF NOT EXISTS `receptions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` int(11) NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `check_in` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_out` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visit_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accept_status` tinyint(4) NOT NULL DEFAULT 1,
  `reject_status` tinyint(4) NOT NULL DEFAULT 1,
  `comment_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receptions`
--

INSERT INTO `receptions` (`id`, `name`, `father_name`, `mobile_number`, `source`, `department_id`, `check_in`, `check_out`, `visit_date`, `description`, `accept_status`, `reject_status`, `comment_id`, `created_at`, `updated_at`) VALUES
(1, 'احمد', 'محمود', 799225732, 'وزارت تحصیلات عالی', 1, '10:51', '11:51', '1400/03/12', 'امورات رسمی', 0, 1, 1, '2021-06-02 01:52:34', '2021-06-02 01:53:52'),
(2, 'شیرزاد', 'محمد افضل', 788709700, 'MoWA', 1, '21:19', '23:21', '1400/03/13', 'کار شخصی', 0, 1, 2, '2021-06-02 23:19:10', '2021-06-02 23:20:33'),
(3, 'رحمت الله سعیدی', 'حیات الله', 799225732, 'اداره امور', 1, '09:23', '10:23', '1400/03/15', 'امورات رسمی', 1, 1, 0, '2021-06-05 00:24:01', '2021-06-05 00:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin', '2021-05-22 00:47:47', '2021-05-22 00:47:47'),
(2, 'reception', 'Reception', 'Reception', '2021-05-22 00:47:47', '2021-05-22 00:47:47'),
(3, 'department', 'Department', 'Department', '2021-05-22 00:47:47', '2021-05-22 00:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(3, 1, 'App\\Models\\User'),
(3, 2, 'App\\Models\\User'),
(2, 3, 'App\\Models\\User'),
(3, 4, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `department_id` tinyint(4) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `department_id`, `name`, `email`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
(1, 7, 'IT Dept', 'it@gmail.com', NULL, '$2y$10$S.YGBoEb6AciV9oQi0UrhucLLhLkIJ82VMVeV8f7ZPEINVUreI/Gy', '2021-05-24 00:38:38', '2021-05-24 00:38:38'),
(2, 6, 'HR', 'hr@gmail.com', NULL, '$2y$10$StIYGYKF8HsnB3F1iUSQ7utQu0oOXL78pkjbOcb6/q.B./3H2slRW', '2021-05-24 01:30:58', '2021-05-24 01:30:58'),
(3, 5, 'Reception', 'reception@gmail.com', NULL, '$2y$10$nyyxQfecrB5CUFF.ST6YMO/xgnbYao8YRNm12ADFjXHd95e3e4HIu', '2021-05-24 01:37:24', '2021-05-24 01:37:24'),
(4, 1, 'مقام اداره', 'authority@gmail.com', NULL, '$2y$10$OCJ3pODARSbLFjGvHHuxu.8RRP.g7Hy2P0W3Uk8E7H446MZ1Qvoeq', '2021-05-26 05:36:29', '2021-05-26 05:36:29');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
