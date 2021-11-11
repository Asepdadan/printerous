-- Adminer 4.7.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(5,	'2021_11_10_140238_create_organizations_table',	2),
(6,	'2021_11_10_140547_create_persons_table',	3),
(7,	'2014_10_12_000000_create_users_table',	4);

DROP TABLE IF EXISTS `organizations`;
CREATE TABLE `organizations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `organizations` (`id`, `name`, `phone`, `email`, `website`, `logo`, `created_at`, `updated_at`) VALUES
(7,	'PT JAYA SENTOSA',	'0819030778665',	'dadanasep74@gmail.com',	'http://www.technoshopku.com',	'2222ec3f-31d2-48cc-ac39-1a13ae6550dc.jpg',	'2021-11-10 11:53:27',	'2021-11-10 11:53:27'),
(8,	'PT Akbar Jaya',	'0819030778665',	'dadanasep74@gmail.com',	'http://www.technoshopku.com',	'2222ec3f-31d2-48cc-ac39-1a13ae6550dc.jpg',	'2021-11-10 11:53:27',	'2021-11-10 11:53:27'),
(9,	'pt smc codesign',	'0819030778665',	'dadanasep74@gmail.com',	'tes',	'43747ce7-5576-444d-a78b-b0be26caefb2.jpeg',	'2021-11-10 18:05:46',	'2021-11-10 18:05:46');

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `permissions` (`id`, `name`, `created_by`, `updated_by`, `deleted_by`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Create-Organization',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(2,	'Edit-Organization',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(3,	'Hapus-Organization',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(4,	'Create-Person',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(5,	'Edit-Person',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(6,	'Hapus-Person',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(7,	'Create-User',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(8,	'Edit-User',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(9,	'Hapus-User',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `persons`;
CREATE TABLE `persons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `persons` (`id`, `organization_id`, `name`, `phone`, `email`, `avatar`, `created_at`, `updated_at`) VALUES
(1,	1,	'asep dadan',	'+62819030778665',	'dadanasep74@gmail.com',	'',	'2021-11-10 15:09:18',	NULL),
(2,	7,	'asep dadan',	'0819030778665',	'dadanasep74@gmail.com',	'9f827baa-ac92-4274-89a8-5731c8c896f9.jpg',	'2021-11-10 18:07:31',	'2021-11-10 18:07:31');

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `description`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Account Manager',	'Account Manager',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(2,	'Administrator',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(3,	'Staff',	'Staff',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE `role_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `role_user` (`id`, `user_id`, `role_id`) VALUES
(12,	'8',	'2'),
(15,	'6',	'1'),
(17,	'9',	'3'),
(19,	'7',	'2');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(6,	'asep dadan',	'dadanasep74@gmail.com',	NULL,	'$2y$10$B0X8tNQeGYbAuZR.29A3g.kjHYlfgJa51tBOQsNN7iyXKWMgMv6oq',	NULL,	'2021-11-10 11:18:10',	'2021-11-10 17:52:22'),
(7,	'administrator',	'administrator@gmail.com',	NULL,	'$2y$10$RcBp4v4htIQ.azHtPgwbZuOC8/u.9MkSI1wjOrXMMIsEJ9z5zc9TW',	NULL,	'2021-11-10 11:32:44',	'2021-11-10 17:59:05'),
(8,	'asep dadan',	'dadanasep74+111@gmail.com',	NULL,	'$2y$10$/4Zt1zOnnvyNmeofcOdbC.KSxiy.l/1RFhnBpvOvj26LUd0EcsCUG',	NULL,	'2021-11-10 11:36:49',	'2021-11-10 11:54:27'),
(9,	'staff kepres',	'staff@gmail.com',	NULL,	'$2y$10$RcBp4v4htIQ.azHtPgwbZuOC8/u.9MkSI1wjOrXMMIsEJ9z5zc9TW',	NULL,	'2021-11-10 17:55:59',	'2021-11-10 17:57:51');

DROP TABLE IF EXISTS `user_organization`;
CREATE TABLE `user_organization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `organization_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_organization` (`id`, `user_id`, `organization_id`, `created_at`, `updated_at`) VALUES
(2,	6,	7,	'2021-11-10 17:52:22',	'2021-11-10 17:52:22'),
(4,	6,	9,	'2021-11-10 18:05:46',	'2021-11-10 18:05:46');

-- 2021-11-11 01:24:04
