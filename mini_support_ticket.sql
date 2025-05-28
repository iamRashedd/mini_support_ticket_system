-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for mini_ticket
CREATE DATABASE IF NOT EXISTS `mini_ticket` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mini_ticket`;

-- Dumping structure for table mini_ticket.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mini_ticket.departments: ~0 rows (approximately)
INSERT INTO `departments` (`id`, `name`, `created_at`) VALUES
	(2, 'bbb', '2025-05-27 19:02:25'),
	(3, 'Math', '2025-05-27 21:39:30');

-- Dumping structure for table mini_ticket.personal_access_token
CREATE TABLE IF NOT EXISTS `personal_access_token` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_id` bigint unsigned NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `tokenable_id` (`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mini_ticket.personal_access_token: ~16 rows (approximately)
INSERT INTO `personal_access_token` (`id`, `tokenable_id`, `token`, `expires_at`, `created_at`) VALUES
	(1, 1, '6835bdae8598c', '2025-05-27 08:27:10', '2025-05-27 13:27:10'),
	(2, 1, 'SFlMT1dUQ2srMWJ4aTN6RTlTekkxQT09', '2025-05-27 08:38:54', '2025-05-27 13:38:54'),
	(3, 1, 'MlFSbzFqMjN5RE5DR0lUTjVaTDVGdz09', '2025-05-27 08:41:26', '2025-05-27 13:41:26'),
	(4, 1, 'bHRvZUs2OUF6MzdSNjJibGVqd3NNUT09', '2025-05-27 08:42:41', '2025-05-27 13:42:41'),
	(6, 1, 'U2pGdWZKMnYzRUpnYjhxR1RmTmtzdz09', '2025-05-27 10:55:55', '2025-05-27 15:55:55'),
	(7, 1, 'VHN4VjAyRXYzTDc5VGtUTVZrSWtWdz09', '2025-05-27 10:57:00', '2025-05-27 15:57:45'),
	(8, 1, 'TWNYQWlVOHBmL3pHTWVCbW9oTm8wZz09', '2025-05-27 09:59:00', '2025-05-27 15:58:34'),
	(9, 1, 'MzZIeHpwdXBac3Bzb2wwbDVlOFA0dz09', '2025-05-27 10:04:00', '2025-05-27 16:03:10'),
	(12, 1, 'OXVOTU5YbEIxNitmR3ZtaUlwQlFIdz09', '2025-05-27 16:07:00', '2025-05-27 16:06:58'),
	(13, 1, 'L1VwY1pmNld6MDc3d24rUTVSTkpLZz09', '2025-05-27 17:07:00', '2025-05-27 16:07:47'),
	(14, 8, 'OXJYa2JnQk4zUU9QcWxLMmJtMTFCQT09', '2025-05-27 18:43:00', '2025-05-27 17:43:20'),
	(15, 1, 'T1lKWUdsaEV5VllZRDl4SDFsWEJrUT09', '2025-05-27 19:12:00', '2025-05-27 18:12:57'),
	(16, 1, 'dGFvRGVXbG1Dc2EyRFRsTThQZ2lzQT09', '2025-05-27 19:39:00', '2025-05-27 18:39:01'),
	(17, 8, 'MnIvN2o2RzhiTXBaWlMvdVQ1OHJ6dz09', '2025-05-27 19:56:00', '2025-05-27 18:56:50'),
	(18, 1, 'bktrdFM0NDRmYlVmR2UyenlKK1NDZz09', '2025-05-27 19:57:00', '2025-05-27 18:57:15'),
	(19, 1, 'NlkrMFNrZUdBRDJ4UmJOYlBEc3RqQT09', '2025-05-27 22:33:00', '2025-05-27 21:33:25'),
	(20, 1, 'NEh4eTIrTnVIWHEvQmZJeENybUM5Zz09', '2025-05-28 12:03:00', '2025-05-28 11:03:33'),
	(21, 8, 'eHhIUGttNDIrNW4rMi9KbjF4Ry9xUT09', '2025-05-28 12:25:00', '2025-05-28 11:25:55');

-- Dumping structure for table mini_ticket.tickets
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('open','in_progress','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `user_id` bigint unsigned NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `assigned_to` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mini_ticket.tickets: ~0 rows (approximately)
INSERT INTO `tickets` (`id`, `title`, `description`, `status`, `user_id`, `department_id`, `created_at`, `assigned_to`) VALUES
	(1, 'Test1', 'aabbccdjkbkjasd', 'in_progress', 1, 2, '2025-05-28 11:08:11', 8);

-- Dumping structure for table mini_ticket.ticket_notes
CREATE TABLE IF NOT EXISTS `ticket_notes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mini_ticket.ticket_notes: ~0 rows (approximately)
INSERT INTO `ticket_notes` (`id`, `ticket_id`, `note`, `user_id`, `created_at`) VALUES
	(1, 1, 'ajihasijdjbjkbjnjbijhuiasdasdasdasdasd', 8, '2025-05-28 11:45:31');

-- Dumping structure for table mini_ticket.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','agent','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mini_ticket.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
	(1, 'Admin', 'admin@gmail.com', '$2y$12$FBWYa.wc/2gxBhHa02iRUuuqbv1WOzyEiSFMnBoaqhcJTeqic70pa', 'admin', NULL),
	(2, 'Admin', 'aadmin@gmail.com', '$2y$12$h2DfKpxVGR87z6fqwxbumOMeuhR2CoxV.QT54bTCVhktnJ5hiW922', 'admin', '2025-05-27 12:59:51'),
	(5, 'Admin', 'avdmin@gmail.com', '$2y$12$3ba9wlQPMCFHc/gxOUcGIOgNfCPFdRSvQQHfG5B8erPbT5Jit5/cK', 'admin', '2025-05-27 13:18:14'),
	(7, 'Admin', 'aaadmin@gmail.com', '$2y$12$DdogtSvSh5DkZR2dKcZzluVwrVAGgLY90NpzUUFHAx1Xe9mCYZjIS', 'admin', '2025-05-27 13:20:48'),
	(8, 'Agent', 'agent@gmail.com', '$2y$12$ybBw0utdJiIGb8GdkIjzI.swgYW9oq2B/7rQgYVeyPaVLls2ckJyy', 'agent', '2025-05-27 17:43:20');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
