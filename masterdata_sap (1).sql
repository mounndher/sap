-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 12 juin 2025 à 13:12
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `masterdata_sap`
--

-- --------------------------------------------------------

--
-- Structure de la table `achats`
--

CREATE TABLE `achats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `BSTME` varchar(3) NOT NULL,
  `groupe_acheteurs_id` int(11) NOT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = invalide, 1 = valide'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `achats`
--

INSERT INTO `achats` (`id`, `article_id`, `BSTME`, `groupe_acheteurs_id`, `from`, `to`, `created_at`, `updated_at`, `status`) VALUES
(17, 92, '%', 1, '20', '20', '2025-06-11 13:22:46', '2025-06-12 09:43:12', 1),
(18, 93, '%', 1, '1', NULL, '2025-06-11 13:24:56', '2025-06-11 13:25:50', 1),
(19, 94, '%', 1, '1', NULL, '2025-06-11 13:27:55', '2025-06-11 13:31:26', 1),
(20, 96, '%', 1, '1', NULL, '2025-06-12 09:46:58', '2025-06-12 09:58:20', 1),
(21, 98, '%', 1, '1', NULL, '2025-06-12 10:08:36', '2025-06-12 10:08:38', 1);

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `MTART` char(4) NOT NULL COMMENT 'type d''article',
  `MATKL` char(9) NOT NULL COMMENT 'Groupe d''articles',
  `MEINS` char(20) NOT NULL COMMENT 'Unité de quantité de base',
  `XCHPF` char(1) NOT NULL COMMENT 'gestion de lot ',
  `MAKTX` char(40) NOT NULL COMMENT 'Designation',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = invalide, 1 = valide',
  `statustotal` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `MTART`, `MATKL`, `MEINS`, `XCHPF`, `MAKTX`, `created_at`, `updated_at`, `status`, `statustotal`) VALUES
(92, '2', '1', '%O', '0', 'CALCULATRICE VERTEX 16 DIGITS d', '2025-06-11 13:22:11', '2025-06-12 09:42:47', 1, 1),
(93, '2', '1', '%', '0', 'TONER CANON 83A MF 231/232 gg', '2025-06-11 13:24:42', '2025-06-12 09:00:08', 1, 0),
(94, '2', '1', '%', '0', 'TONER CANON 83A MF 231/232 fffd', '2025-06-11 13:27:41', '2025-06-11 13:42:01', 1, 1),
(95, '2', '1', '%', '0', 'TONER CANON 83A MF 231/232 hgj', '2025-06-12 08:49:50', '2025-06-12 09:02:15', 1, 0),
(96, '2', '1', '%', '0', 'MULTIPRISE hhh', '2025-06-12 08:50:04', '2025-06-12 09:54:50', 1, 0),
(97, '2', '1', '%', '1', 'MULTIPRISE hh', '2025-06-12 09:43:33', '2025-06-12 09:45:48', 1, 0),
(98, '2', '2', '%', '1', 'CALCULATRICE VERTEX 16 DIGITS hfh', '2025-06-12 10:04:16', '2025-06-12 10:08:44', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `classvs`
--

CREATE TABLE `classvs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = inactive, 1 = active',
  `type_article_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `classvs`
--

INSERT INTO `classvs` (`id`, `value`, `name`, `status`, `type_article_id`, `created_at`, `updated_at`) VALUES
(1, 'M001', 'M001 ||  MP Substances actives', 1, 10, '2025-05-29 09:00:03', '2025-05-29 09:00:03'),
(2, 'M002', 'M002 || MP Excipients', 1, 10, '2025-05-29 09:01:04', '2025-05-29 09:01:04'),
(3, 'M013', 'M013 || Autres matières premières', 1, 10, '2025-05-29 09:01:49', '2025-05-29 09:01:49'),
(4, 'M004', 'M004 || Matières consommables', 1, 6, '2025-05-29 09:02:20', '2025-05-29 09:02:20'),
(5, 'M005', 'M005 || Carburants et lubrifiants', 1, 6, '2025-05-29 09:07:18', '2025-05-29 09:07:18'),
(6, 'M007', 'M007 || Fourniture parc roulant', 1, 6, '2025-05-29 09:13:47', '2025-05-29 09:13:47'),
(7, 'M021', 'M021 || Tenues de travail et de sécurité', 1, 6, '2025-05-29 09:14:20', '2025-05-29 09:14:20'),
(8, 'M022', 'M022 || Produits d\'entretiens', 1, 6, '2025-05-29 09:15:42', '2025-05-29 09:15:42'),
(9, 'M023', 'M023 || Droguerie et quincaillerie générale', 1, 6, '2025-05-29 09:16:19', '2025-05-29 09:16:19'),
(10, 'M024', 'M024 || Fournitures de bureau/informatiques', 1, 6, '2025-05-29 09:17:06', '2025-05-29 09:17:06'),
(11, 'M025', 'M025 || Autres fournitures consommables', 1, 6, '2025-05-29 09:17:35', '2025-05-29 09:17:35'),
(12, 'M006', 'M006 ||  PDR (Modification des comptes)', 1, 12, '2025-05-29 09:18:19', '2025-05-29 09:18:19'),
(13, 'M003', 'M003 || Blisters (Aluminium ou plastique)', 1, 2, '2025-05-29 09:18:55', '2025-05-29 09:18:55'),
(14, 'M014', 'M014 || Flacons', 1, 2, '2025-05-29 09:19:20', '2025-05-29 09:19:20'),
(15, 'M015', 'M015 || Ampoules', 1, 2, '2025-05-29 09:19:54', '2025-05-29 09:19:54'),
(16, 'M016', 'M016 ||  Autres articles de conditionnement primaire', 1, 2, '2025-05-29 09:20:23', '2025-05-29 09:20:23'),
(17, 'M017', 'M017 || Etuis (Boites)', 1, 2, '2025-05-29 09:20:50', '2025-05-29 09:20:50'),
(18, 'M018', 'M018 || Notices', 1, 2, '2025-05-29 09:21:17', '2025-05-29 09:21:17'),
(19, 'M019', 'M019 || Vignettes', 1, 2, '2025-05-29 09:21:37', '2025-05-29 09:21:37'),
(20, 'M020', 'M020 || Autres accessoires', 1, 2, '2025-05-29 09:22:13', '2025-05-29 09:22:13'),
(21, 'M026', 'M026 || Emballages (Cartons)', 1, 7, '2025-05-29 09:22:56', '2025-05-29 09:22:56');

-- --------------------------------------------------------

--
-- Structure de la table `comptabilités`
--

CREATE TABLE `comptabilités` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` int(11) NOT NULL,
  `classe_valoris_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code_prix` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = invalide, 1 = valide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comptabilités`
--

INSERT INTO `comptabilités` (`id`, `article_id`, `classe_valoris_id`, `code_prix`, `status`, `created_at`, `updated_at`) VALUES
(2, 65, 18, 'S', 1, '2025-06-03 13:26:19', '2025-06-05 09:58:06'),
(3, 68, 14, 'v', 1, '2025-06-09 12:44:09', '2025-06-09 12:44:09'),
(4, 88, 13, 'S', 0, '2025-06-11 12:53:47', '2025-06-11 13:01:51'),
(5, 89, 13, 'S', 0, '2025-06-11 13:00:33', '2025-06-11 13:00:38'),
(6, 90, NULL, 'S', 0, '2025-06-11 13:05:15', '2025-06-11 13:17:37'),
(7, 94, 13, 'S', 1, '2025-06-11 13:28:04', '2025-06-11 13:31:23'),
(8, 92, 13, 'S', 1, '2025-06-12 09:29:03', '2025-06-12 09:43:04'),
(9, 98, 13, 'S', 1, '2025-06-12 10:06:40', '2025-06-12 10:07:59');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
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
-- Structure de la table `groupe_acheteurs`
--

CREATE TABLE `groupe_acheteurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupe_acheteurs`
--

INSERT INTO `groupe_acheteurs` (`id`, `value`, `name`, `created_at`, `updated_at`) VALUES
(1, 'G01', 'G01|MP Locale', '2025-05-29 08:09:33', '2025-05-29 08:09:33'),
(2, 'G02', 'G02 |MP Import', '2025-05-29 08:10:04', '2025-05-29 08:10:04'),
(3, 'G03', 'G03 |Cdtmnt Local', '2025-05-29 08:10:17', '2025-05-29 08:10:17'),
(4, 'G04', 'G04 |Cdtmnt Import', '2025-05-29 08:10:29', '2025-05-29 08:10:29'),
(5, 'G05', 'G05 |Labo Local', '2025-05-29 08:10:42', '2025-05-29 08:10:42'),
(6, 'G06', 'G06 |Labo Import', '2025-05-29 08:10:53', '2025-05-29 08:10:53'),
(7, 'G07', 'G07 |Consommable Local', '2025-05-29 08:11:05', '2025-05-29 08:11:05'),
(8, 'G08', 'G08 |Consommable Import', '2025-05-29 08:11:16', '2025-05-29 08:11:16'),
(9, 'G09', 'G09 |Service', '2025-05-29 08:11:30', '2025-05-29 08:11:30'),
(10, 'G10', 'G10 |PDR & Outilage Lo', '2025-05-29 08:11:43', '2025-05-29 08:11:43'),
(11, 'G11', 'G11 |PDR & Outilage Im', '2025-05-29 08:11:57', '2025-05-29 08:11:57'),
(12, 'G12 |Parc Roulant', 'G12', '2025-05-29 08:12:17', '2025-05-29 08:12:17'),
(13, 'G13', 'G13 |Investissement', '2025-05-29 08:12:35', '2025-05-29 08:12:35'),
(14, 'G14', 'G14 |Sous-traitance', '2025-05-29 08:13:10', '2025-05-29 08:13:10');

-- --------------------------------------------------------

--
-- Structure de la table `groupe_articles`
--

CREATE TABLE `groupe_articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type_article_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupe_articles`
--

INSERT INTO `groupe_articles` (`id`, `value`, `name`, `type_article_id`, `created_at`, `updated_at`) VALUES
(1, 'ZACD-PRIM', 'ZACD-PRIM | Art. Cond. 1ere', 2, '2025-05-29 07:35:32', '2025-05-29 07:47:06'),
(2, 'ZACD-SECD', 'ZACD-SECD | Art. Cond. 2ere', 2, '2025-05-29 07:48:01', '2025-05-29 07:48:01'),
(3, 'ZACD-TERT', 'ZACD-TERT | Art. Cond. 3ere', 2, '2025-05-29 07:48:51', '2025-05-29 07:48:51'),
(4, 'ZCNS-ADM', 'ZCNS-ADM   |  Art. Nn Sto.cons ad', 4, '2025-05-29 07:51:04', '2025-05-29 07:51:04'),
(5, 'ZCNS-COM', 'ZCNS-COM   | Art. Nn Sto.com', 4, '2025-05-29 07:53:59', '2025-05-29 07:53:59'),
(6, 'ZCNS-ENRG', 'ZCNS-ENRG |Art. Nn Sto.Energies', 4, '2025-05-29 07:55:11', '2025-05-29 07:55:11'),
(7, 'ZCNS-LAB', 'ZCNS-LAB   |Art. Nn Sto.cons lab', 4, '2025-05-29 07:55:45', '2025-05-29 07:55:45'),
(8, 'ZCNS-PROD', 'ZCNS-PROD |Art. Nn Sto.cons pro', 4, '2025-05-29 07:56:39', '2025-05-29 07:56:39'),
(9, 'ZCNV-CON', 'ZCNV-CON |Art. Nn Val.Conso', 5, '2025-05-29 07:58:07', '2025-05-29 07:58:07');

-- --------------------------------------------------------

--
-- Structure de la table `mail_recipients`
--

CREATE TABLE `mail_recipients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Name of service',
  `email` varchar(255) NOT NULL COMMENT 'Email address of the mail recipient',
  `status` tinyint(1) NOT NULL,
  `validtion` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mail_recipients`
--

INSERT INTO `mail_recipients` (`id`, `name`, `email`, `status`, `validtion`, `created_at`, `updated_at`) VALUES
(1, 'IT', 'pip.it.support@pharmainvest.dz', 0, 0, NULL, '2025-06-02 07:01:21'),
(2, 'halim', 'm.ferkouz@pharmainvest.dz', 0, 0, '2025-06-01 13:41:49', '2025-06-02 12:08:31'),
(9, 'mondher mondher', 'Nanou.riache19@gmail.com', 0, 0, '2025-06-02 09:40:41', '2025-06-02 12:09:27'),
(10, 'mondher', 'm.tebib@pharmainvest.dz', 0, 0, '2025-06-02 10:23:54', '2025-06-02 11:41:43'),
(11, 'mondher mondher', 'admin@gmail.com', 1, 1, '2025-06-02 12:09:17', '2025-06-02 12:09:17');

-- --------------------------------------------------------

--
-- Structure de la table `mail_settings`
--

CREATE TABLE `mail_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mail_mailer` varchar(255) NOT NULL DEFAULT 'smtp',
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_port` int(11) DEFAULT NULL,
  `mail_username` varchar(255) DEFAULT NULL,
  `mail_password` varchar(255) DEFAULT NULL,
  `mail_encryption` varchar(255) DEFAULT NULL,
  `mail_from_address` varchar(255) DEFAULT NULL,
  `mail_from_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mail_settings`
--

INSERT INTO `mail_settings` (`id`, `mail_mailer`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encryption`, `mail_from_address`, `mail_from_name`, `created_at`, `updated_at`) VALUES
(1, 'smtp', 'smtp.gmail.com', 587, 'pip.it.support@pharmainvest.dz', 'anxmtylmzzkrxxiq', 'tls', 'pip.it.support@pharmainvest.dz', 'SAP Master Data', NULL, '2025-06-01 13:20:28');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_05_15_101713_add_guid_to_users_table', 2),
(6, '2025_05_15_101946_add_guid_and_domain_to_users_table', 3),
(7, '2025_05_25_134945_article', 4),
(8, '2025_05_25_140726_create_articles', 5),
(9, '2025_05_27_082530_create_achats_table', 6),
(10, '2025_05_28_072816_create_type_articles_table', 7),
(11, '2025_05_28_073142_create_groupe_articles_table', 8),
(12, '2025_05_28_073307_create_groupe_acheteurs_table', 9),
(13, '2025_05_28_080547_add_status_to_type_articles_table', 10),
(14, '2025_05_28_144831_create_settings_ldaps_table', 11),
(15, '2025_05_29_082242_add_type_article_id_to_groupe_articles_table', 12),
(16, '2025_05_29_093937_create_classvs_table', 13),
(17, '2025_05_29_105533_create_user_saps_table', 14),
(18, '2025_06_01_074100_add_status_to_table_name', 15),
(19, '2025_06_01_135050_create_mail_settings_table', 16),
(20, '2025_06_01_141349_create_mail_recipients_table', 17),
(21, '2025_06_02_082604_create_validations_table', 18),
(22, '2025_06_03_131355_add_status_to_table_name', 19),
(23, '2025_06_03_134011_create_comptabilités_table', 20),
(24, '2025_06_04_092808_create_permission_tables', 21),
(25, '2025_06_12_085330_add_unique_username_to_users_table', 22);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(6, 'App\\Models\\User', 617),
(14, 'App\\Models\\User', 618),
(15, 'App\\Models\\User', 619);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `group_name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(2, 'Article index', 'web', 'Article Permissions', '2025-06-04 09:55:09', '2025-06-04 09:55:09'),
(3, 'Article create', 'web', 'Article Permissions', '2025-06-04 09:55:45', '2025-06-04 09:55:45'),
(4, 'Article update', 'web', 'Article Permissions', '2025-06-04 09:56:09', '2025-06-04 09:56:09'),
(5, 'Article delete', 'web', 'Article Permissions', '2025-06-04 09:56:16', '2025-06-04 09:56:16'),
(6, 'Article paste', 'web', 'Article Permissions', '2025-06-04 09:56:32', '2025-06-04 09:56:32'),
(7, 'usersap index', 'web', 'UserSap Permissions', '2025-06-05 06:56:15', '2025-06-05 06:56:15'),
(8, 'usersap update', 'web', 'UserSap Permissions', '2025-06-05 06:56:23', '2025-06-05 06:56:23'),
(9, 'Smtp index', 'web', 'Smtp Permissions', '2025-06-05 06:59:23', '2025-06-05 06:59:23'),
(10, 'Smtp update', 'web', 'Smtp Permissions', '2025-06-05 06:59:29', '2025-06-05 06:59:29'),
(11, 'userldap index', 'web', 'UsersLdap Permissions', '2025-06-05 07:01:04', '2025-06-05 07:01:04'),
(14, 'Emailuser index', 'web', 'Emailuser Permissions', '2025-06-05 07:02:42', '2025-06-05 07:02:42'),
(15, 'Emailuser create', 'web', 'Emailuser Permissions', '2025-06-05 07:02:58', '2025-06-05 07:02:58'),
(16, 'Emailuser update', 'web', 'Emailuser Permissions', '2025-06-05 07:03:07', '2025-06-05 07:03:07'),
(17, 'Emailuser delete', 'web', 'Emailuser Permissions', '2025-06-05 07:03:22', '2025-06-05 07:03:22'),
(19, 'tempalte email index', 'web', 'Tempalte email Permissions', '2025-06-05 07:07:40', '2025-06-05 07:07:40'),
(20, 'tempalte email update', 'web', 'Tempalte email Permissions', '2025-06-05 07:07:48', '2025-06-05 07:07:48'),
(23, 'setting ldap  index', 'web', 'Setting ldap  Permissions', '2025-06-05 07:13:19', '2025-06-05 07:13:19'),
(24, 'setting ldap  update', 'web', 'Setting ldap  Permissions', '2025-06-05 07:13:27', '2025-06-05 07:13:27'),
(25, 'Groupes d Acheteurs  index', 'web', 'Groupes d Acheteurs Permissions', '2025-06-05 07:15:26', '2025-06-05 07:15:26'),
(26, 'Groupes d Acheteurs  create', 'web', 'Groupes d Acheteurs Permissions', '2025-06-05 07:15:32', '2025-06-05 07:15:32'),
(27, 'Groupes d Acheteurs  update', 'web', 'Groupes d Acheteurs Permissions', '2025-06-05 07:15:42', '2025-06-05 07:15:42'),
(28, 'Groupes d Acheteurs  delete', 'web', 'Groupes d Acheteurs Permissions', '2025-06-05 07:15:46', '2025-06-05 07:15:46'),
(29, 'Class valoris  index', 'web', 'Class valoris Permissions', '2025-06-05 07:19:48', '2025-06-05 07:19:48'),
(30, 'Class valoris  create', 'web', 'Class valoris Permissions', '2025-06-05 07:19:55', '2025-06-05 07:19:55'),
(31, 'Class valoris  update', 'web', 'Class valoris Permissions', '2025-06-05 07:20:02', '2025-06-05 07:20:02'),
(32, 'Class valoris  delete', 'web', 'Class valoris Permissions', '2025-06-05 07:20:09', '2025-06-05 07:20:09'),
(33, 'Groupe Article  index', 'web', 'Groupe Article Permissions', '2025-06-05 07:21:58', '2025-06-05 07:21:58'),
(34, 'Groupe Article  create', 'web', 'Groupe Article Permissions', '2025-06-05 07:22:03', '2025-06-05 07:22:03'),
(35, 'Groupe Article  update', 'web', 'Groupe Article Permissions', '2025-06-05 07:22:10', '2025-06-05 07:22:10'),
(36, 'Groupe Article  delete', 'web', 'Groupe Article Permissions', '2025-06-05 07:22:16', '2025-06-05 07:22:16'),
(37, 'Type d\'Article index', 'web', 'Type d\'Article Permissions', '2025-06-05 07:23:26', '2025-06-05 07:23:26'),
(38, 'Type d\'Article create', 'web', 'Type d\'Article Permissions', '2025-06-05 07:23:31', '2025-06-05 07:23:31'),
(39, 'Type d\'Article update', 'web', 'Type d\'Article Permissions', '2025-06-05 07:23:37', '2025-06-05 07:23:37'),
(40, 'Type d\'Article delete', 'web', 'Type d\'Article Permissions', '2025-06-05 07:23:42', '2025-06-05 07:23:42'),
(41, 'access management index', 'web', 'Access management Permissions', '2025-06-05 07:25:51', '2025-06-05 07:25:51'),
(42, 'access management create', 'web', 'Access management Permissions', '2025-06-05 07:26:01', '2025-06-05 07:26:01'),
(43, 'access management update', 'web', 'Access management Permissions', '2025-06-05 07:26:07', '2025-06-05 07:26:07'),
(44, 'access management delete', 'web', 'Access management Permissions', '2025-06-05 07:26:13', '2025-06-05 07:26:13'),
(50, 'achat edit', 'web', 'Achat Permission', '2025-06-05 09:11:17', '2025-06-05 09:11:17'),
(51, 'achat update', 'web', 'Achat Permission', '2025-06-05 09:11:24', '2025-06-05 09:11:24'),
(52, 'achat valider', 'web', 'Achat Permission', '2025-06-05 09:11:46', '2025-06-05 09:11:46'),
(53, 'achat invalider', 'web', 'Achat Permission', '2025-06-05 09:11:54', '2025-06-05 09:11:54'),
(54, 'Comptabilité  edit', 'web', 'Comptabilité Permission', '2025-06-05 09:13:40', '2025-06-05 09:13:40'),
(55, 'Comptabilité  update', 'web', 'Comptabilité Permission', '2025-06-05 09:13:51', '2025-06-05 09:13:51'),
(56, 'Comptabilité  valider', 'web', 'Comptabilité Permission', '2025-06-05 09:13:57', '2025-06-05 09:13:57'),
(57, 'Comptabilité  invalider', 'web', 'Comptabilité Permission', '2025-06-05 09:14:01', '2025-06-05 09:14:01'),
(59, 'edit Article', 'web', 'Article Permissions', '2025-06-09 07:28:56', '2025-06-09 07:28:56'),
(60, 'valider donneesdebase', 'web', 'Donnees Permissions', '2025-06-12 08:53:35', '2025-06-12 08:53:35'),
(61, 'invalider donneesdebase', 'web', 'Donnees Permissions', '2025-06-12 08:53:39', '2025-06-12 08:53:39');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(6, 'Super Admin', 'web', '2025-06-04 12:18:39', '2025-06-04 12:18:39'),
(14, 'achat', 'web', '2025-06-12 08:44:34', '2025-06-12 08:44:34'),
(15, 'Comptabilité', 'web', '2025-06-12 10:01:29', '2025-06-12 10:01:29');

-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 14),
(2, 15),
(3, 14),
(3, 15),
(4, 14),
(4, 15),
(6, 14),
(6, 15),
(50, 14),
(51, 14),
(52, 14),
(54, 15),
(55, 15),
(56, 15),
(59, 14),
(59, 15),
(60, 15);

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `favicon` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`id`, `title`, `description`, `keywords`, `logo`, `favicon`, `created_at`, `updated_at`) VALUES
(1, 'Master data sap Pip', 'Les données de base dans SAP désignent les informations fondamentales et structurantes utilisées de manière répétée dans les processus métiers de l’entreprise.', 'Master Data', '/uploads/1292994350logo-pharmaInvest.svg', '/uploads/14699429apple-touch-icon.png', NULL, '2025-06-10 11:58:10');

-- --------------------------------------------------------

--
-- Structure de la table `settings_ldaps`
--

CREATE TABLE `settings_ldaps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `LDAP_CONNECTION` varchar(255) NOT NULL,
  `LDAP_HOST` varchar(255) NOT NULL,
  `LDAP_PORT` int(11) NOT NULL,
  `LDAP_BASE_DN` text NOT NULL,
  `LDAP_USERNAME` text NOT NULL,
  `LDAP_PASSWORD` text NOT NULL,
  `LDAP_USE_SSL` varchar(53) NOT NULL,
  `LDAP_USE_TLS` varchar(53) NOT NULL,
  `LDAP_TIMEOUT` int(11) NOT NULL,
  `LDAP_LOGGING` varchar(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `settings_ldaps`
--

INSERT INTO `settings_ldaps` (`id`, `LDAP_CONNECTION`, `LDAP_HOST`, `LDAP_PORT`, `LDAP_BASE_DN`, `LDAP_USERNAME`, `LDAP_PASSWORD`, `LDAP_USE_SSL`, `LDAP_USE_TLS`, `LDAP_TIMEOUT`, `LDAP_LOGGING`, `created_at`, `updated_at`) VALUES
(1, 'default', '10.20.30.5', 389, 'OU=Users,OU=PharmaInvest Production,DC=local,DC=pharma', 'CN=glpi,OU=IT,OU=Users,OU=PharmaInvest Production,DC=local,DC=pharma', 'pharma@2025', 'false', 'false', 5, 'true', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_articles`
--

CREATE TABLE `type_articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1 COMMENT '0 = inactive, 1 = active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_articles`
--

INSERT INTO `type_articles` (`id`, `value`, `name`, `created_at`, `updated_at`, `status`) VALUES
(2, 'ZACD', 'ZACD || Articles Conditionnement', '2025-05-28 09:08:15', '2025-05-29 07:37:24', 1),
(3, 'ZAPR', 'ZAPR || Articles Ext.Prestations', '2025-05-28 09:08:15', '2025-05-29 07:37:33', 1),
(4, 'ZCNS', 'ZCNS || Article non géré en stock', '2025-05-28 09:08:15', '2025-05-29 07:37:42', 1),
(5, 'ZCNV', 'ZCNV || Article non valorisé', '2025-05-28 09:08:15', '2025-05-29 07:37:54', 1),
(6, 'ZCST', 'ZCST|| Matières et fourn.consom.', '2025-05-28 09:08:15', '2025-05-29 07:38:04', 1),
(7, 'ZEMC', 'ZEMC || Emballages (Cartons)', '2025-05-28 09:08:15', '2025-05-29 07:38:15', 1),
(8, 'ZFMP', 'ZFMP', '2025-05-28 09:08:15', '2025-05-29 07:39:08', 1),
(9, 'ZIMO', 'ZIMO || Immobilisation', '2025-05-28 09:08:15', '2025-05-29 07:38:25', 1),
(10, 'ZMPR', 'ZMPR || Matière première', '2025-05-28 09:08:15', '2025-05-29 07:38:34', 1),
(11, 'ZOUT', 'ZOUT || Outilage', '2025-05-28 09:08:15', '2025-05-29 07:38:42', 1),
(12, 'ZPDR', 'ZPDR || Pièces de rechange', '2025-05-28 09:08:15', '2025-05-29 07:39:27', 1),
(13, 'ZPRF', 'ZPRF || Produit fini', '2025-05-28 09:08:15', '2025-05-29 07:39:17', 1),
(14, 'ZPSF', 'ZPSF || Produit semi-fini', '2025-05-28 09:08:15', '2025-05-29 07:39:02', 1),
(15, 'ZSRV', 'ZSRV || Prestation de services', '2025-05-28 09:08:15', '2025-05-29 07:38:52', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `guid` varchar(255) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `guid`, `domain`) VALUES
(617, 'Elmoundhir RIACHE', 'e.riache', NULL, NULL, '$2y$12$P4Z5cH5gBrVCZ4urQPLwfOtPnwg2aYFwFs7jbTYqRL37Px9ZBrNcq', NULL, '2025-06-12 08:40:24', '2025-06-12 08:40:24', '7935d22b-c64e-41a0-8030-9e7adc8de9e8', 'default'),
(618, 'test', 'test', NULL, NULL, '$2y$12$jQAajyx665Z4vLXzYuSId.YNMwEuChEzI/05F3YhQuntzYD0z0YO6', NULL, '2025-06-12 08:41:38', '2025-06-12 08:41:38', '768d172b-dde5-47ff-8ef7-356dbce4fce0', 'default'),
(619, 'glpi', 'glpi', NULL, NULL, '$2y$12$UrVwfiuEcveP0D3Y8lHdNe/mlvUqOGGzfx05JragJdmy7shuvyH5m', NULL, '2025-06-12 10:00:29', '2025-06-12 10:00:29', '91b4f19d-c3c8-467d-a680-321a94284ebf', 'default');

-- --------------------------------------------------------

--
-- Structure de la table `user_saps`
--

CREATE TABLE `user_saps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` char(255) NOT NULL,
  `password` char(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_saps`
--

INSERT INTO `user_saps` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'eriache', 'eyJpdiI6IklKT1RxZFVBV2pSSmVPMmNMTTVJd0E9PSIsInZhbHVlIjoiN292WEpnenFibUxSTTdLUjFRZjZDdz09IiwibWFjIjoiZDM5MWViZWExNzFlMjUyODExMTM5MzNmMzkyODNhZTMxNDRkYzE1NWEyNjI2NDE1NmM2MDMzNWI0ODI1NWQwYyIsInRhZyI6IiJ9', NULL, '2025-06-12 08:47:38');

-- --------------------------------------------------------

--
-- Structure de la table `validations`
--

CREATE TABLE `validations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paragraph` mediumtext NOT NULL,
  `codecolor` char(11) NOT NULL,
  `object` varchar(155) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `validations`
--

INSERT INTO `validations` (`id`, `paragraph`, `codecolor`, `object`, `created_at`, `updated_at`) VALUES
(1, '<p data-start=\"190\" data-end=\"476\" class=\"\">\r\n                                               <p data-start=\"190\" data-end=\"476\" class=\"\">\r\n                                               <p data-start=\"190\" data-end=\"476\" class=\"\">\r\n                                               <p data-start=\"190\" data-end=\"476\" class=\"\">\r\n                                               <p data-start=\"190\" data-end=\"476\" class=\"\">\r\n                                               <p data-start=\"190\" data-end=\"476\" class=\"\">\r\n                                               <p><span style=\"font-family: Arial;\">Hello,</span></p><p><br></p><p><span style=\"font-family: Arial;\">We are delighted to inform you that your article {{ $article->MAKTX }} has been approved and successfully validated.</span></p><p><br></p><p><img data-emoji=\"✅\" class=\"an1\" alt=\"✅\" aria-label=\"✅\" draggable=\"false\" src=\"https://fonts.gstatic.com/s/e/notoemoji/16.0/2705/32.png\" loading=\"lazy\" style=\"height: 1.2em; width: 1.2em; color: rgb(51, 51, 51); font-family: Poppins, Arial, sans-serif; font-size: 16px;\"><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 16px;\"> </span><strong style=\"color: rgb(51, 51, 51); font-family: Poppins, Arial, sans-serif; font-size: 16px;\"><span style=\"font-family: Arial;\">Status:</span></strong><span style=\"color: rgb(51, 51, 51); font-family: Poppins, Arial, sans-serif; font-size: 16px;\"><span style=\"font-family: Arial;\"> </span><span style=\"font-family: Arial;\">Approved</span></span><br></p><div><span style=\"color: rgb(51, 51, 51); font-family: Arial; font-size: 16px;\">You may now proceed to use or publish the article within the platform.</span><br></div>', '3EB489', 'Article Successfully Validated', NULL, '2025-06-02 08:33:39');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achats`
--
ALTER TABLE `achats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `achats_article_id_foreign` (`article_id`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `classvs`
--
ALTER TABLE `classvs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classvs_type_article_id_foreign` (`type_article_id`);

--
-- Index pour la table `comptabilités`
--
ALTER TABLE `comptabilités`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comptabilités_classe_valoris_id_foreign` (`classe_valoris_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `groupe_acheteurs`
--
ALTER TABLE `groupe_acheteurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupe_articles`
--
ALTER TABLE `groupe_articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupe_articles_type_article_id_foreign` (`type_article_id`);

--
-- Index pour la table `mail_recipients`
--
ALTER TABLE `mail_recipients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail_recipients_email_unique` (`email`);

--
-- Index pour la table `mail_settings`
--
ALTER TABLE `mail_settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `settings_ldaps`
--
ALTER TABLE `settings_ldaps`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_articles`
--
ALTER TABLE `type_articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_guid_unique` (`guid`);

--
-- Index pour la table `user_saps`
--
ALTER TABLE `user_saps`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `validations`
--
ALTER TABLE `validations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `achats`
--
ALTER TABLE `achats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT pour la table `classvs`
--
ALTER TABLE `classvs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `comptabilités`
--
ALTER TABLE `comptabilités`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `groupe_acheteurs`
--
ALTER TABLE `groupe_acheteurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `groupe_articles`
--
ALTER TABLE `groupe_articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `mail_recipients`
--
ALTER TABLE `mail_recipients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `mail_settings`
--
ALTER TABLE `mail_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `settings_ldaps`
--
ALTER TABLE `settings_ldaps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `type_articles`
--
ALTER TABLE `type_articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=620;

--
-- AUTO_INCREMENT pour la table `user_saps`
--
ALTER TABLE `user_saps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `validations`
--
ALTER TABLE `validations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achats`
--
ALTER TABLE `achats`
  ADD CONSTRAINT `achats_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `classvs`
--
ALTER TABLE `classvs`
  ADD CONSTRAINT `classvs_type_article_id_foreign` FOREIGN KEY (`type_article_id`) REFERENCES `type_articles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comptabilités`
--
ALTER TABLE `comptabilités`
  ADD CONSTRAINT `comptabilités_classe_valoris_id_foreign` FOREIGN KEY (`classe_valoris_id`) REFERENCES `classvs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `groupe_articles`
--
ALTER TABLE `groupe_articles`
  ADD CONSTRAINT `groupe_articles_type_article_id_foreign` FOREIGN KEY (`type_article_id`) REFERENCES `type_articles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
