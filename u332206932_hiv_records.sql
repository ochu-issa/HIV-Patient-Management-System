-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 16, 2024 at 09:21 AM
-- Server version: 10.11.8-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u332206932_hiv_records`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ministry of Health', '1', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(2, 'Morogoro Clinic Mazimbu Center', '1', '2024-06-03 13:50:46', '2024-06-03 13:50:46'),
(3, 'IYUNGA DISPENSARY', '1', '2024-06-03 16:04:14', '2024-06-03 16:05:27'),
(4, 'MRCC', '1', '2024-06-08 04:52:08', '2024-06-08 04:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `branch_admins`
--

CREATE TABLE `branch_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `branch_id` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `branch_id` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `branch_id` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `f_name`, `l_name`, `gender`, `email`, `phone_number`, `branch_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Lead ', 'Administrator', 'Male', 'super@gmail.com', '255674478982', 1, 1, '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(2, 'Hakim', 'Zyech', 'Male', 'hakimi@gmail.com', '255654332211', 2, 1, '2024-06-03 13:51:23', '2024-06-03 13:51:23'),
(3, 'Godfrey', 'Chuma', 'Male', 'godfrey@gmail.com', '255765879023', 3, 1, '2024-06-08 04:48:08', '2024-06-08 04:48:08'),
(4, 'Happy', 'Joseph', 'Female', 'happy@gmail.com', '255678693045', 3, 1, '2024-06-08 04:49:15', '2024-06-08 04:49:15'),
(5, 'Beata', 'Wilson', 'Female', 'beata@gmail.com', '255746570039', 3, 1, '2024-06-09 13:42:22', '2024-06-09 13:42:22'),
(6, 'Happy', 'Test', 'Female', 'happytest@gmail.com', '255654556655', 3, 1, '2024-06-09 14:04:53', '2024-06-09 14:04:53'),
(7, 'Magreth', 'Michael', 'Female', 'magreth@gmail.com', '255696252147', 3, 1, '2024-07-07 18:27:09', '2024-07-07 18:27:09');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` tinyint(1) NOT NULL,
  `branch_id` tinyint(1) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_04_124359_create_doctors_table', 1),
(6, '2023_01_04_134842_create_receptionists_table', 1),
(7, '2023_01_04_140916_create_branches_table', 1),
(8, '2023_01_04_151534_create_branch_admins_table', 1),
(9, '2023_01_14_101559_create_permission_tables', 1),
(10, '2023_01_18_084500_create_pattients_table', 1),
(11, '2023_01_20_150232_create_members_table', 1),
(12, '2023_03_15_063639_create_patient_details_table', 1),
(13, '2023_03_21_145152_create_messages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 11),
(2, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 21),
(4, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 9);

-- --------------------------------------------------------

--
-- Table structure for table `otp_codes`
--

CREATE TABLE `otp_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `otp_code` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otp_codes`
--

INSERT INTO `otp_codes` (`id`, `patient_id`, `created_by`, `otp_code`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 14, 1, '868712', 0, '2024-07-06 13:39:37', '2024-07-06 13:40:14'),
(2, 12, 1, '207409', 1, '2024-07-07 17:30:12', '2024-07-07 17:30:12'),
(3, 14, 1, '603718', 0, '2024-07-07 18:05:59', '2024-07-07 18:21:30'),
(4, 12, 11, '519619', 1, '2024-07-07 18:09:32', '2024-07-07 18:09:32'),
(5, 12, 9, '411838', 1, '2024-07-09 07:29:14', '2024-07-09 07:29:14'),
(6, 12, 9, '679732', 1, '2024-07-09 07:29:29', '2024-07-09 07:29:29'),
(7, 12, 9, '338134', 1, '2024-07-09 07:45:10', '2024-07-09 07:45:10'),
(8, 15, 9, '563546', 1, '2024-07-09 07:47:44', '2024-07-09 07:47:44'),
(9, 15, 9, '986182', 1, '2024-07-09 07:52:54', '2024-07-09 07:52:54'),
(10, 15, 1, '475684', 0, '2024-07-13 10:15:21', '2024-07-13 10:16:13'),
(11, 15, 9, '194523', 0, '2024-07-13 10:58:49', '2024-07-13 11:01:23'),
(12, 18, 9, '261872', 0, '2024-07-16 08:28:59', '2024-07-16 08:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

CREATE TABLE `patient_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_session_id` bigint(20) UNSIGNED DEFAULT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `medics_type` varchar(255) NOT NULL,
  `HIV_level` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_details`
--

INSERT INTO `patient_details` (`id`, `patient_session_id`, `patient_id`, `branch_id`, `doctor_id`, `medics_type`, `HIV_level`, `description`, `status`, `created_at`, `updated_at`) VALUES
(2, NULL, 9, 1, 1, 'NRTIs, PrEP, Fusion inhibitors, Fusion inhibitors', 'Level 2', 'Not normal', 1, '2024-06-15 05:56:09', '2024-06-15 05:56:09'),
(7, NULL, 9, 1, 1, 'CCR5 antagonists', 'Level 3', 'Good', 1, '2024-06-16 14:24:45', '2024-06-16 14:24:45'),
(8, 1, 8, 1, 1, 'NRTIs, PrEP, Fusion inhibitors, Fusion inhibitors', 'Level 3', 'Doing normal', 1, '2024-06-20 09:46:12', '2024-06-20 09:46:12'),
(10, 2, 7, 1, 1, 'CCR5 antagonists', 'Level 2', 'This is normal', 1, '2024-06-20 13:51:29', '2024-06-20 13:51:29'),
(14, 3, 10, 3, 10, 'ARV', 'Level 1', 'Well attended', 1, '2024-06-20 15:25:22', '2024-06-20 15:25:22'),
(15, 3, 10, 3, 10, 'ARV', 'Level 1', 'Well attended', 1, '2024-06-20 15:36:44', '2024-06-20 15:36:44'),
(16, 4, 12, 3, 10, 'ART', 'Level 1', 'No bad symptoms', 1, '2024-06-22 07:37:13', '2024-06-22 07:37:13'),
(17, 2, 7, 1, 1, 'Medical HIV ARV4', 'Level 2', 'take care of carbonate foods', 1, '2024-06-28 20:34:03', '2024-06-28 20:34:03'),
(18, 2, 7, 1, 1, 'NRTIs, PrEP, Fusion inhibitors', 'Level 1', 'Weight has increse', 1, '2024-06-28 20:35:05', '2024-06-28 20:35:05'),
(19, 2, 7, 1, 1, 'ARV-5, Hypotrixic, Panadol', 'Level 3', 'Medication AR4', 1, '2024-06-28 20:36:33', '2024-06-28 20:36:33'),
(20, 10, 15, 3, 10, 'ARV', 'Level 2', 'Attended', 1, '2024-07-13 11:25:35', '2024-07-13 11:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `patient_detail_items`
--

CREATE TABLE `patient_detail_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_details_id` bigint(20) UNSIGNED NOT NULL,
  `cd4_count` int(200) NOT NULL,
  `viral_load` int(200) NOT NULL,
  `allergies` varchar(255) NOT NULL,
  `blood_pressure` varchar(200) NOT NULL,
  `medication_adherence` int(200) NOT NULL DEFAULT 1,
  `diagnosis_date` timestamp NOT NULL,
  `weight` decimal(10,0) NOT NULL,
  `art_regimen` varchar(255) NOT NULL,
  `next_appointment_date` date DEFAULT NULL,
  `appointment_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_detail_items`
--

INSERT INTO `patient_detail_items` (`id`, `patient_details_id`, `cd4_count`, `viral_load`, `allergies`, `blood_pressure`, `medication_adherence`, `diagnosis_date`, `weight`, `art_regimen`, `next_appointment_date`, `appointment_by`, `status`) VALUES
(1, 2, 30, 20, 'Potassium, Calcuim', '31', 1, '2024-06-15 05:56:09', 75, '40', NULL, NULL, 1),
(2, 7, 70, 20, 'Potassium', '31', 0, '2024-06-16 14:24:45', 80, '60', NULL, NULL, 0),
(3, 8, 40, 25, 'Potassium', '31', 0, '2024-06-20 09:46:12', 80, '40', NULL, NULL, 0),
(4, 10, 3, 2, 'Potassium', '31', 0, '2024-06-20 13:51:29', 50, '40', NULL, NULL, 0),
(5, 14, 5, 12, 'Meat allergy', '120/80', 1, '2024-06-20 15:25:22', 54, 'cobicistat', NULL, NULL, 0),
(6, 15, 5, 12, 'Meat allergy', '120/80', 1, '2024-06-20 15:36:44', 54, 'cobicistat', NULL, NULL, 0),
(7, 16, 5, 20, 'milk', '110/70', 1, '2024-06-22 07:37:13', 5, 'abacavir', NULL, NULL, 0),
(8, 17, 76, 89, 'No allegies', '105/185', 0, '2024-06-28 20:34:03', 85, '40', NULL, NULL, 0),
(9, 18, 50, 67, 'Potassium Carbonate', '105/185', 1, '2024-06-28 20:35:05', 90, '65', NULL, NULL, 0),
(10, 19, 54, 78, 'No allegies', '105/185', 0, '2024-06-28 20:36:33', 85, '60', NULL, NULL, 0),
(11, 20, 8, -3, 'headache medicine', '100/72', 1, '2024-07-13 11:25:35', 27, 'abacavir', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient_sessions`
--

CREATE TABLE `patient_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `patient_otp_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_sessions`
--

INSERT INTO `patient_sessions` (`id`, `patient_id`, `branch_id`, `patient_otp_id`, `created_by`, `updated_by`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 8, 1, NULL, 1, 1, 0, '2024-06-20 09:44:53', '2024-06-20 09:46:22'),
(2, 7, 1, NULL, 1, 1, 0, '2024-06-20 13:38:41', '2024-07-07 18:13:30'),
(3, 10, 3, NULL, 9, 10, 0, '2024-06-20 14:08:38', '2024-06-22 07:41:01'),
(4, 12, 3, NULL, 9, 10, 0, '2024-06-22 07:22:24', '2024-06-22 07:38:03'),
(5, 8, 1, NULL, 1, 1, 0, '2024-06-24 19:06:56', '2024-06-24 19:09:04'),
(6, 8, 1, NULL, 1, 1, 0, '2024-06-28 06:17:33', '2024-06-28 06:18:25'),
(7, 14, 1, 1, 1, 1, 0, '2024-07-06 13:40:14', '2024-07-06 13:40:43'),
(8, 14, 3, 3, 11, 10, 0, '2024-07-07 18:21:30', '2024-07-07 18:35:31'),
(9, 15, 1, 10, 1, 1, 0, '2024-07-13 10:16:13', '2024-07-13 10:57:35'),
(10, 15, 3, 11, 9, 10, 0, '2024-07-13 11:01:23', '2024-07-13 11:25:53'),
(11, 18, 3, 12, 9, 1, 0, '2024-07-16 08:30:00', '2024-07-16 08:53:27');

-- --------------------------------------------------------

--
-- Table structure for table `pattients`
--

CREATE TABLE `pattients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `pattient_number` varchar(255) NOT NULL,
  `branch_id` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pattients`
--

INSERT INTO `pattients` (`id`, `f_name`, `l_name`, `gender`, `dob`, `address`, `phone_number`, `pattient_number`, `branch_id`, `status`, `created_at`, `updated_at`) VALUES
(7, 'Jackson', 'Kamara', 'Male', '1995-06-01', 'Jaki Honda', '255656788700', 'MM/9/9793', 3, 1, '2024-06-10 06:04:41', '2024-06-10 06:04:41'),
(8, 'Ezekiel', 'Christopher', 'Male', '1995-06-01', 'Iwambi', '255678417511', 'MM/16/6147', 3, 1, '2024-06-10 06:06:53', '2024-06-10 06:06:53'),
(9, 'Zena', 'Thomas', 'Female', '1995-06-01', 'Holand', '255654442222', 'MM/21/8025', 1, 1, '2024-06-10 15:40:10', '2024-06-10 15:40:10'),
(10, 'Sarah', 'Sadick', 'Female', '1995-06-01', 'Iwambi', '255627876233', 'MM/26/4347', 3, 1, '2024-06-20 13:58:41', '2024-06-20 13:58:41'),
(11, 'Premium', 'Master', 'Male', '1995-06-01', 'Danger Zone', '255626560699', 'MM/26/2401', 1, 1, '2024-06-20 15:26:41', '2024-06-20 15:26:41'),
(12, 'Sophia', 'John', 'Female', '2000-06-15', 'Ikuti', '255677859304', 'MM/28/1926', 3, 1, '2024-06-22 06:36:09', '2024-06-22 06:36:09'),
(14, 'Neymar', 'Junior', 'Male', '1998-07-06', 'Kilombelo', '255626560698', 'MM/13/7926', 1, 1, '2024-07-06 13:36:48', '2024-07-06 13:36:48'),
(15, 'Lucy', 'Joseph', 'Female', '2020-01-09', 'Iyunga', '255626560698', 'MM/16/8135', 3, 1, '2024-07-09 07:46:45', '2024-07-13 11:14:54'),
(16, 'Semen', 'Alex', 'Male', '2016-11-13', 'Iyunga', '255622982188', 'MM/20/7572', 3, 1, '2024-07-13 11:16:53', '2024-07-13 11:16:53'),
(18, 'happy', 'joseph', 'Female', '2024-07-07', 'ikuti', '255627991019', 'MM/23/6562', 3, 1, '2024-07-16 08:27:17', '2024-07-16 08:27:17');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Create-Branch', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(2, 'View-Branch', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(3, 'Edit-Branch', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(4, 'Delete-Branch', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(5, 'Create-Branch-Admin', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(6, 'View-Branch-Admin', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(7, 'Edit-Branch-Admin', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(8, 'Delete-Branch-Admin', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(9, 'Create-Doctor', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(10, 'View-Doctor', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(11, 'Edit-Doctor', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(12, 'Delete-Doctor', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(13, 'Create-Receptionist', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(14, 'View-Receptionist', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(15, 'Edit-Receptionist', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(16, 'Delete-Receptionist', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(17, 'Create-Pattient', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(18, 'View-Pattient', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(19, 'Edit-Pattient', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(20, 'Delete-Pattient', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(21, 'Generate-report', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(22, 'Access-Pattient', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(23, 'Setting', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', 'a60d05481a8d96666d16506a5e597faa81371bc3f86591ef9a1be6d2839f6647', '[\"*\"]', NULL, NULL, '2024-06-03 13:56:24', '2024-06-03 13:56:24'),
(2, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', 'de4d838d4891a250a5585e3606b75e2df2485077f5fb29065ec7b4308b74a1f1', '[\"*\"]', NULL, NULL, '2024-06-05 20:26:23', '2024-06-05 20:26:23'),
(3, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', 'e38528be78177c0c2d4b437da00f9cc18064316d494377b80bb69d1d3f9ca4e1', '[\"*\"]', NULL, NULL, '2024-06-05 20:26:24', '2024-06-05 20:26:24'),
(4, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', '917310ee320cf0cfa7ef99c2b09e1010acd282cd91e2afe4737d696fa48e0d08', '[\"*\"]', NULL, NULL, '2024-06-05 21:03:20', '2024-06-05 21:03:20'),
(5, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', '89914ee7c49ce3f18005248b962f327165e3097e0aadf6e74e80c2c6eacaaccf', '[\"*\"]', NULL, NULL, '2024-06-05 21:05:54', '2024-06-05 21:05:54'),
(6, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', '119ac170769d16e47ee9e5db46e5935dfe60098f804297dcf29e8e17bd8f4fc3', '[\"*\"]', NULL, NULL, '2024-06-05 21:10:31', '2024-06-05 21:10:31'),
(7, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', '6ff83bb6c27f938b256a4d7d388af90c8adf970445244eaccec8c4147aa40e16', '[\"*\"]', NULL, NULL, '2024-06-05 21:16:25', '2024-06-05 21:16:25'),
(8, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', '0635dbf6f1cc6de4a20c08a82c875f03f0ff2a4553e11a98b4ee1650c3c9c99d', '[\"*\"]', NULL, NULL, '2024-06-05 21:33:52', '2024-06-05 21:33:52'),
(9, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', '42241071132253eddc860a4e07ff94e967bbbf74cbbff0cfdacef92a838f287d', '[\"*\"]', NULL, NULL, '2024-06-05 21:36:29', '2024-06-05 21:36:29'),
(10, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', '01b83c07cfec52a0de2d311b9bb80bbc7b35885d01401de33a48c71fbfde21b4', '[\"*\"]', NULL, NULL, '2024-06-05 21:54:51', '2024-06-05 21:54:51'),
(11, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', '392e90e726729ec2fbf3f2b1063e327ea94c73bf30fe3ad2fa22eeaea409efc6', '[\"*\"]', NULL, NULL, '2024-06-05 22:05:54', '2024-06-05 22:05:54'),
(12, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', '78ec6b3e2c59f078e212ded854266b857417ed900ecd06ee36f145097c01ea86', '[\"*\"]', NULL, NULL, '2024-06-05 22:14:57', '2024-06-05 22:14:57'),
(13, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', '02809f8aba301a75f597b51a35e23aaa248729d2f7a1a05e51b9747cd05e3646', '[\"*\"]', NULL, NULL, '2024-06-05 22:17:10', '2024-06-05 22:17:10'),
(14, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', 'dafdac8fe62a9e072aa4a64eac93f8dbdddab3a7c230fcddfc4e12c02864749c', '[\"*\"]', NULL, NULL, '2024-06-06 04:59:33', '2024-06-06 04:59:33'),
(15, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', '085ecb7e4b92337062554e096d8353951b78c7df76e1933756f2c57e3eedc46d', '[\"*\"]', NULL, NULL, '2024-06-09 15:16:58', '2024-06-09 15:16:58'),
(16, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', '6e9123e59cbfb4753c9053f80a87bba4644d59e4ba07375b82aef1e0f283f2d8', '[\"*\"]', NULL, NULL, '2024-06-09 15:22:23', '2024-06-09 15:22:23'),
(17, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', 'c9d26eb2ca832c26a2a5001913fa5a11d6eef1c9961add7bf31a81fc18295f2f', '[\"*\"]', NULL, NULL, '2024-06-09 15:23:08', '2024-06-09 15:23:08'),
(18, 'App\\Models\\User', 3, 'Api Token forMM/9/9793', 'b34751684edd5c6c4a3de4feec39ac6eaab99eed81eb9e0d3e044851744956f1', '[\"*\"]', NULL, NULL, '2024-06-09 15:24:07', '2024-06-09 15:24:07'),
(19, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '90d375f59f6116903bf220c0d4caf1796aee46ac5aad592ce9a6c0ce65592374', '[\"*\"]', NULL, NULL, '2024-06-10 14:22:48', '2024-06-10 14:22:48'),
(20, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'bd0c24c211ecdad03b90ea9aba79ae81cca0a6eb7c19201653d73d39b06d0a3b', '[\"*\"]', NULL, NULL, '2024-06-10 14:23:10', '2024-06-10 14:23:10'),
(21, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'a58a2b445909be1ba4070e1841ec1536845acb92614be71cc9543da8957f0b00', '[\"*\"]', NULL, NULL, '2024-06-10 14:23:16', '2024-06-10 14:23:16'),
(22, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '1e575fe0ffd28c163a58af46fd4ebd80d3b04ee346c41eb2da105acff2a428b2', '[\"*\"]', NULL, NULL, '2024-06-10 14:23:39', '2024-06-10 14:23:39'),
(23, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '9a045205ce4ab7139535ba42d7d9058b99e0b365b0028e1701ccc03974cc2d60', '[\"*\"]', NULL, NULL, '2024-06-10 14:24:12', '2024-06-10 14:24:12'),
(24, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '9dbf608247bb3e717fb09d084d1e5bbda69cb47f0cde1e3cb02f17b39a44dae3', '[\"*\"]', NULL, NULL, '2024-06-10 15:00:29', '2024-06-10 15:00:29'),
(25, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '1bfe8833b339c26b0690d91ebabada541207420c9d04b8486828d66c109bd665', '[\"*\"]', NULL, NULL, '2024-06-10 15:00:34', '2024-06-10 15:00:34'),
(26, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '7392905d3e3057e33d4819893d4eff4012cfaddf7cc8a2e3c94ab66a5fd0c590', '[\"*\"]', NULL, NULL, '2024-06-10 15:29:09', '2024-06-10 15:29:09'),
(27, 'App\\Models\\User', 15, 'Api Token forMM/16/6820', '3e289cf31d674be84af97813f1048ab2883a6bb1651ed406685cacba0f42f4a2', '[\"*\"]', NULL, NULL, '2024-06-10 15:40:27', '2024-06-10 15:40:27'),
(30, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'eb4588dfc99ffbfa5e33ce8396a26b6643ebe3303bad84f2c88529697eac89a3', '[\"*\"]', NULL, NULL, '2024-06-17 14:18:03', '2024-06-17 14:18:03'),
(31, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '5ceb21089353bd8894e16cd6aad1e4f3326d251bf449cb30a075bf68f9ca432d', '[\"*\"]', NULL, NULL, '2024-06-17 14:22:04', '2024-06-17 14:22:04'),
(32, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'f7ab9c12e2712814c6a20bf4d3d5c63ca073af5586c162a5af8c42a14244d226', '[\"*\"]', NULL, NULL, '2024-06-17 14:26:28', '2024-06-17 14:26:28'),
(33, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '8eda8a57c2a77e36bfa605c5fa57708179e8701b540c08766afc25b5155c9b61', '[\"*\"]', NULL, NULL, '2024-06-17 14:27:06', '2024-06-17 14:27:06'),
(34, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '60b3f3ed185c22c5f979c279bc5ffe7cd7fb216de107406f587588050cbd92d4', '[\"*\"]', NULL, NULL, '2024-06-17 14:32:23', '2024-06-17 14:32:23'),
(35, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'd101419fbeb90ca17194d85cd359b229da4a936fc0f0d89b24ff33e5c644890e', '[\"*\"]', NULL, NULL, '2024-06-17 14:33:03', '2024-06-17 14:33:03'),
(36, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '11caf4b16128a192cd113493d33e40e050f06b305912a6baeb7ee942e1fb1dff', '[\"*\"]', NULL, NULL, '2024-06-17 14:37:31', '2024-06-17 14:37:31'),
(37, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'd47dd867e41645603a4b86ae5a3cd5e157536f7acca905eb3f434a84290f1af3', '[\"*\"]', NULL, NULL, '2024-06-17 14:42:38', '2024-06-17 14:42:38'),
(38, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '69ae2c95eeca1b0303cea76f9c2e62291303ae9532bbc6d50fd303297568ef67', '[\"*\"]', NULL, NULL, '2024-06-17 14:50:26', '2024-06-17 14:50:26'),
(39, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'f23aadfabf730b76a5cf17acd3ada83f414455f8b2540a35c5f75f00a1b421d9', '[\"*\"]', NULL, NULL, '2024-06-17 17:07:35', '2024-06-17 17:07:35'),
(40, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '747ec8c95f83f9576f00828b39aaea16c1013db483a495e89cbb0c9d0bfcc782', '[\"*\"]', NULL, NULL, '2024-06-17 17:16:41', '2024-06-17 17:16:41'),
(41, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'bc5eaf985420b82529ce37473f178201e1cc25594262fa9da14734bac57727e3', '[\"*\"]', NULL, NULL, '2024-06-17 17:49:03', '2024-06-17 17:49:03'),
(42, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'fc1462ba7b9ac42a2d0e646e5162e3f752c670743a86dd686f6a17caba7f41b5', '[\"*\"]', NULL, NULL, '2024-06-17 17:54:05', '2024-06-17 17:54:05'),
(43, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '3c44f7f0cf4b1455720eab9681e219238eee06f17e648b34bd2eb565468890af', '[\"*\"]', NULL, NULL, '2024-06-17 17:54:23', '2024-06-17 17:54:23'),
(45, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '9dfe0c985b49735897870cf9b75c588c5d13cd59f41b7e1b94bbdaa2a059bd74', '[\"*\"]', NULL, NULL, '2024-06-17 20:15:21', '2024-06-17 20:15:21'),
(46, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '657fa9d9ee4fc59ce8d32f2d01fd882621114805028e9f76684c1ce58723581b', '[\"*\"]', NULL, NULL, '2024-06-17 20:19:50', '2024-06-17 20:19:50'),
(47, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '4f554cb18d1a93c49b40a9a622cae27df84638dee4e4465bd33c5fdaa3eabe98', '[\"*\"]', NULL, NULL, '2024-06-17 20:26:28', '2024-06-17 20:26:28'),
(48, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '424ea3aef1f3e0b3adf81897b5aa1ac1c5a4f8d5ed0a6c74532a07566c518165', '[\"*\"]', NULL, NULL, '2024-06-17 20:32:36', '2024-06-17 20:32:36'),
(49, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '9671ae09173e2e09f63f42d04f113181b88c9493966d85b9042fee7175293c71', '[\"*\"]', NULL, NULL, '2024-06-17 20:35:56', '2024-06-17 20:35:56'),
(50, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '31b76461fc76d533b66871ec03fa4a4c44fb8fb2efaf47c7f94a43d69760021a', '[\"*\"]', NULL, NULL, '2024-06-17 20:42:40', '2024-06-17 20:42:40'),
(51, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'e13539ae7d244d529f40d3e205e57379e4825396ad120e5274da9b42fd1c3f05', '[\"*\"]', NULL, NULL, '2024-06-17 20:45:50', '2024-06-17 20:45:50'),
(52, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'b633d97a621c74a69f4c32804a5259f93a45bf3b537e03fc3f988be4d2b35580', '[\"*\"]', NULL, NULL, '2024-06-17 20:48:16', '2024-06-17 20:48:16'),
(53, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '74400bc0cc42fa53eb95d1fd7f636d94de69a7335938a973f01b960ad4d186eb', '[\"*\"]', NULL, NULL, '2024-06-17 21:03:11', '2024-06-17 21:03:11'),
(55, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '0f600103d58fd228b10c20daa45c485f57e97545afcc9bcb3cd2ea9398b378c1', '[\"*\"]', '2024-06-20 13:51:44', NULL, '2024-06-20 13:50:35', '2024-06-20 13:51:44'),
(56, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'facc088bf9aca8d849c0bc126d66a9479b143030b724b68ba14fefc398954149', '[\"*\"]', NULL, NULL, '2024-06-20 15:04:19', '2024-06-20 15:04:19'),
(57, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '6e0debb56ae2f0583154c59fcad3a1a7a4833dae7b72c6c1078629152885a33a', '[\"*\"]', NULL, NULL, '2024-06-20 15:10:05', '2024-06-20 15:10:05'),
(58, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '0965b13ad95fd59deeab1428bb855459a05d379aec3d2f1581f5f677364d9b42', '[\"*\"]', NULL, NULL, '2024-06-20 15:22:09', '2024-06-20 15:22:09'),
(59, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '1438d8d10638665719e40bd01205ce55a50b28e879c126da54574ebb1f8d47e3', '[\"*\"]', NULL, NULL, '2024-06-20 15:22:33', '2024-06-20 15:22:33'),
(60, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'c4529cceaf44acc3c5132d290a99f92033c13e013d12633beb9a4a237ccf55b9', '[\"*\"]', NULL, NULL, '2024-06-20 15:24:31', '2024-06-20 15:24:31'),
(61, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '8b829af0b65f5497a9340ec398575df80a976670c9a41dc5f772e73c3df8cfe2', '[\"*\"]', '2024-06-20 15:41:12', NULL, '2024-06-20 15:27:10', '2024-06-20 15:41:12'),
(62, 'App\\Models\\User', 15, 'Api Token forMM/16/6820', 'c311a3e7f81d02db402dd5694e905446c1d517a07ad136e43383b32baee2eb61', '[\"*\"]', NULL, NULL, '2024-06-20 15:33:47', '2024-06-20 15:33:47'),
(63, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '1f4cd843e296db5bad74f7ce864852b6efca3cd140d416427d49cc4b001e1134', '[\"*\"]', NULL, NULL, '2024-06-20 15:36:32', '2024-06-20 15:36:32'),
(64, 'App\\Models\\User', 15, 'Api Token forMM/16/6820', '5167c99ac85c1ec4a8b243c329c752f6bf3d0d41e8709517762ab1252d4568a6', '[\"*\"]', NULL, NULL, '2024-06-20 15:40:32', '2024-06-20 15:40:32'),
(65, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'f9ac943555cd5081b28561a36a7fdff1655ac6676c8ab38c3b324afd7124d4b2', '[\"*\"]', '2024-06-20 15:43:19', NULL, '2024-06-20 15:43:17', '2024-06-20 15:43:19'),
(66, 'App\\Models\\User', 15, 'Api Token forMM/21/8025', '60653c905da36224128fbb53cb99976b8e9e34ec54febc689785e998300048dd', '[\"*\"]', '2024-06-20 15:44:42', NULL, '2024-06-20 15:44:40', '2024-06-20 15:44:42'),
(67, 'App\\Models\\User', 15, 'Api Token forMM/21/8025', '174100ad0e0fd710f2f537b9b63659c843d121f88089707ff0e5f837ac6ffe2a', '[\"*\"]', NULL, NULL, '2024-06-20 15:45:19', '2024-06-20 15:45:19'),
(68, 'App\\Models\\User', 15, 'Api Token forMM/21/8025', '13438c52d95973af242ca4c9bbae7aa6da8e540d69a9dad92a53a035be503832', '[\"*\"]', NULL, NULL, '2024-06-20 15:45:20', '2024-06-20 15:45:20'),
(69, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'dfaaca42ed3fb1541fb922cbe0a9c59aeafc8a802f275d10db082c800b3f63fd', '[\"*\"]', '2024-07-02 16:11:01', NULL, '2024-06-20 16:30:51', '2024-07-02 16:11:01'),
(70, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'cb0d891c178627d74ae6184348402e8605d026e13b7287d1d24544d2d0b7984b', '[\"*\"]', '2024-06-20 17:37:27', NULL, '2024-06-20 17:37:19', '2024-06-20 17:37:27'),
(71, 'App\\Models\\User', 15, 'Api Token forMM/21/8025', '83e4b7a0f22cd57d49fbe54fba4b6cfcff323b9d52e614d9a4e0d4a30626b22a', '[\"*\"]', '2024-06-20 18:04:09', NULL, '2024-06-20 18:03:46', '2024-06-20 18:04:09'),
(72, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '43ce54e6fad1e57bdde31dd31e86fce584bfb028111006a6465291c3959709cd', '[\"*\"]', '2024-06-21 15:50:15', NULL, '2024-06-21 15:50:03', '2024-06-21 15:50:15'),
(73, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '69ac2b2051e60f0aba3790adeb4ef72fc6e35916d4f4d48a596e03b3faa43049', '[\"*\"]', '2024-06-23 16:39:56', NULL, '2024-06-23 16:39:38', '2024-06-23 16:39:56'),
(74, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'cb3e7c9a1280781faaa2b9920ab79a5286fac6a716345821ca0a6c81c7de431d', '[\"*\"]', '2024-06-24 07:23:35', NULL, '2024-06-24 07:23:24', '2024-06-24 07:23:35'),
(75, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '93e8f240ebb1836ee6418fe596a8dbbe1f0317f55d45d7e959893ed490e50f38', '[\"*\"]', '2024-06-24 11:30:03', NULL, '2024-06-24 10:25:39', '2024-06-24 11:30:03'),
(76, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '342c9e711a76995286ed76efd04c4654b4c5af52ec9e723bbf2ab4dcd5995619', '[\"*\"]', '2024-06-28 06:34:25', NULL, '2024-06-28 06:33:15', '2024-06-28 06:34:25'),
(77, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'c6204c8a24d7bbf2d577c70cdfbbfceccd58e9cb4eeb05c3b2bce5df314671bd', '[\"*\"]', '2024-06-29 07:20:28', NULL, '2024-06-28 20:37:52', '2024-06-29 07:20:28'),
(78, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'cb8581b792cb5b3d72812a57d386e1399165d0ffa93d52c50764565b7bc57097', '[\"*\"]', '2024-07-02 13:47:45', NULL, '2024-07-02 13:47:03', '2024-07-02 13:47:45'),
(79, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '3b3b218e42c80fec59cfd585cecdd7f69149baea8fe5b8dfbf34955054aa95b2', '[\"*\"]', '2024-07-02 16:00:02', NULL, '2024-07-02 15:49:48', '2024-07-02 16:00:02'),
(80, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '6ddae8ff2dd8974b38c962169f42f427d003892a4a9f813c75cf13c073add3d2', '[\"*\"]', '2024-07-02 15:52:19', NULL, '2024-07-02 15:52:17', '2024-07-02 15:52:19'),
(81, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '44751b6f77a4f8c3d6ec50007e27ca847953ea28520090a0b31c77e015bbc99b', '[\"*\"]', '2024-07-02 15:52:57', NULL, '2024-07-02 15:52:56', '2024-07-02 15:52:57'),
(82, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '0744473ef3ddaf31da38f7377ba7a2794630af1f76d6738eca093e112d8d8493', '[\"*\"]', '2024-07-02 15:54:51', NULL, '2024-07-02 15:54:49', '2024-07-02 15:54:51'),
(83, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'bd38adbf08d7d29621d9f3cf01f5801b6e0170e61e63d0d63ca9190f5042a971', '[\"*\"]', '2024-07-02 15:55:17', NULL, '2024-07-02 15:55:15', '2024-07-02 15:55:17'),
(84, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '17334e6ee0ed41b255d0fe80ccf7eb48aa2abb63cefe3e0ff5246b1426fb3e8e', '[\"*\"]', '2024-07-02 15:58:55', NULL, '2024-07-02 15:58:53', '2024-07-02 15:58:55'),
(85, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '8fd7eb776b53a6dee1400d53c911b16dca9e06abaa1d7b145078e6d2db7c3c0f', '[\"*\"]', NULL, NULL, '2024-07-02 15:59:50', '2024-07-02 15:59:50'),
(86, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '83f9dd79b7738c2d4e2abc6a3719936a89b7addc2d9d90cba7e3bf12a56d99a6', '[\"*\"]', '2024-07-02 16:10:35', NULL, '2024-07-02 16:09:34', '2024-07-02 16:10:35'),
(87, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '89fb2b3c3a44295397bd968468efb5876130be3b52a173315d870c540ea194fd', '[\"*\"]', '2024-07-02 16:39:25', NULL, '2024-07-02 16:38:59', '2024-07-02 16:39:25'),
(88, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '1bec53356b08a602796ed5ccad29b3be2820a5447845ae34f6da00e668f97dea', '[\"*\"]', '2024-07-02 16:40:46', NULL, '2024-07-02 16:40:44', '2024-07-02 16:40:46'),
(89, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'c487721f01e7091732b6cf644b6059d473118d74163c6fa3a0dbbaae1290dff0', '[\"*\"]', '2024-07-02 16:44:16', NULL, '2024-07-02 16:42:32', '2024-07-02 16:44:16'),
(90, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '8395b6d8165acb9c232b1aac71eac8e92895f87e4ae187d222d176ac9d609943', '[\"*\"]', '2024-07-02 16:46:22', NULL, '2024-07-02 16:44:51', '2024-07-02 16:46:22'),
(91, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'ebc7241c7e92fdf90ea95071b5045f847bf45abdc9030de62cdcdf09235d22fb', '[\"*\"]', '2024-07-02 16:50:35', NULL, '2024-07-02 16:50:28', '2024-07-02 16:50:35'),
(92, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '30885e03c97a65fbfa889e505ba4374ff0a6cfcd97d922d00ef71fd96c9e6b4f', '[\"*\"]', NULL, NULL, '2024-07-02 16:52:40', '2024-07-02 16:52:40'),
(93, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '333bc17b32b697e205f61ce4b027224f7c008fe16ebad64f63e5985083251451', '[\"*\"]', '2024-07-02 16:52:41', NULL, '2024-07-02 16:52:40', '2024-07-02 16:52:41'),
(94, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'd69b8e8197886d8476801dbc4e781b1184921afdc8f9577addc02250a586c3f8', '[\"*\"]', '2024-07-02 16:54:16', NULL, '2024-07-02 16:53:59', '2024-07-02 16:54:16'),
(95, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '128786eb794d748db291a17dc04f269ce56aee174f911b30e3ee9dcf95fc57e9', '[\"*\"]', '2024-07-03 18:28:51', NULL, '2024-07-03 18:28:39', '2024-07-03 18:28:51'),
(96, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '5331876a4152f39ba7ab0bb6a02f80bf084ef2643a6e289b1fb9c916b1ffd39e', '[\"*\"]', '2024-07-03 18:30:35', NULL, '2024-07-03 18:29:47', '2024-07-03 18:30:35'),
(99, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '8d68423f37f3d351088daba1b3beef045f995a5a155638a23b2b618b88c0c35f', '[\"*\"]', '2024-07-04 10:12:34', NULL, '2024-07-04 06:18:43', '2024-07-04 10:12:34'),
(100, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', 'c8c08721c481e2304fae5a110e4ea64047b45a674ee8bb773f8d5f28fd896b5e', '[\"*\"]', '2024-07-10 11:37:46', NULL, '2024-07-10 11:37:44', '2024-07-10 11:37:46'),
(101, 'App\\Models\\User', 23, 'Api Token forMM/20/7572', '657090da53ada413fd3dcc9d5603d036dc379a30ace3dbeee31498ade0df4465', '[\"*\"]', '2024-07-15 05:58:31', NULL, '2024-07-15 05:58:09', '2024-07-15 05:58:31'),
(104, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '8afe859be48a63298543fe71b8c8d1b536b375e9786561d122767653e5e1a834', '[\"*\"]', '2024-07-16 08:11:42', NULL, '2024-07-16 08:11:35', '2024-07-16 08:11:42'),
(105, 'App\\Models\\User', 13, 'Api Token forMM/9/9793', '7908009fdac5e4f0fe31d17695dbb6ae3d56a24fd1cf31f3598eb234d4b5d7f5', '[\"*\"]', '2024-07-16 08:33:40', NULL, '2024-07-16 08:32:39', '2024-07-16 08:33:40');

-- --------------------------------------------------------

--
-- Table structure for table `receptionists`
--

CREATE TABLE `receptionists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `branch_id` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super-Admin', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(2, 'Branch-Admin', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(3, 'Doctor', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(4, 'Receptionist', 'web', '2024-05-23 08:34:44', '2024-05-23 08:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(18, 1),
(18, 2),
(18, 3),
(18, 4),
(19, 1),
(19, 2),
(19, 3),
(19, 4),
(20, 1),
(20, 2),
(20, 3),
(20, 4),
(21, 1),
(21, 2),
(21, 3),
(22, 1),
(22, 2),
(22, 3),
(23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `member_id`, `role_id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, '$2y$10$8eb7O.tJUhRf8RIMZBa5beo1z908RdmRzbN/Duk7jdk6w/9RoR0Lu', '2024-05-23 08:34:44', '2024-05-23 08:34:44'),
(2, 2, 4, NULL, '$2y$10$pXMHgizYP7tuLuEsBiMBV.2N3NQ0W2CYjNtnoTAmUjbB7EdoQA9Pq', '2024-06-03 13:51:24', '2024-06-03 13:51:24'),
(9, 3, 4, NULL, '$2y$10$KtbLeBQN0p0BQMOL7UDyAeIWRpLDM36dkUgROHYmTRYV8dD9eYwF2', '2024-06-08 04:48:08', '2024-06-08 04:48:08'),
(10, 4, 3, NULL, '$2y$10$7raW6qMGau/1jRhrYHWBlOIqWLwMkkA0L3wDNDk30vmAl5VatEsCS', '2024-06-08 04:49:15', '2024-06-08 04:49:15'),
(11, 5, 2, NULL, '$2y$10$iZX3FVshRSTIljxj9RFfZuJNJcXpz1sh56rh8SiSRCxz.RRZmIJhG', '2024-06-09 13:42:22', '2024-06-09 13:42:22'),
(12, 6, 2, NULL, '$2y$10$k6IY7F2rfV8hSzbuMyMA0Od1oIJLbV7Br7jp.TuJOSZhmF.xtNAZS', '2024-06-09 14:04:53', '2024-06-09 14:04:53'),
(13, NULL, NULL, 'MM/9/9793', '$2y$10$8eb7O.tJUhRf8RIMZBa5beo1z908RdmRzbN/Duk7jdk6w/9RoR0Lu', '2024-06-10 06:04:41', '2024-06-10 06:04:41'),
(14, NULL, NULL, 'MM/16/6147', '$2y$10$8eb7O.tJUhRf8RIMZBa5beo1z908RdmRzbN/Duk7jdk...', '2024-06-10 06:06:53', '2024-06-10 06:06:53'),
(15, NULL, NULL, 'MM/21/8025', '$2y$10$Sa2M9uUqB1EF/igKWPQNRuNvcmutqVpyj0yAFYAC52oEbR2pQktku', '2024-06-10 15:40:10', '2024-06-10 15:40:10'),
(16, NULL, NULL, 'MM/26/4347', '$2y$10$HsjM69KpLin9jWbPqZLK2OuQBZ/f6KCppTxJfi7zZpgJdKNiSy6Eq', '2024-06-20 13:58:41', '2024-06-20 13:58:41'),
(17, NULL, NULL, 'MM/26/2401', '$2y$10$Jch8pglLG/itirLgjVsjuO6qRrEwk.BeLU33t9RAWESnDHrDToswO', '2024-06-20 15:26:41', '2024-06-20 15:26:41'),
(18, NULL, NULL, 'MM/28/1926', '$2y$10$MFY/BktJoGVJ4BT1E1.ESuorN.OwFg6EIUsyct99GQN5BMXjClM32', '2024-06-22 06:36:09', '2024-06-22 06:36:09'),
(20, NULL, NULL, 'MM/13/7926', '$2y$10$GEiDW1Qt53sSpCBDDNLvxertWQD1VjjbJXX0YK14JelXEQmXhkPuG', '2024-07-06 13:36:48', '2024-07-06 13:36:48'),
(21, 7, 3, NULL, '$2y$10$bNwJXQKGFauD20A.aMILbO2qz9hNTGgVZ8cqbPK21eAOdWVGhqUBe', '2024-07-07 18:27:09', '2024-07-07 18:27:09'),
(22, NULL, NULL, 'MM/16/8135', '$2y$10$ygBxNk48TWsot9ae9ePSSekzLLCM2v8.ye20D2rCvBZ4OcWEtWRIi', '2024-07-09 07:46:45', '2024-07-09 07:46:45'),
(23, NULL, NULL, 'MM/20/7572', '$2y$10$xIxjUtmMq5rmSbQNaU.8segbTBuWvO8MbSm55HycLhHliGoHE2d0e', '2024-07-13 11:16:53', '2024-07-13 11:16:53'),
(25, NULL, NULL, 'MM/23/6562', '$2y$10$cwpbQtxjhLC6eWRce59TLuTTdPmz8GLEv3TvjSFLjw7YPKTqLHVMi', '2024-07-16 08:27:17', '2024-07-16 08:27:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_admins`
--
ALTER TABLE `branch_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `otp_codes`
--
ALTER TABLE `otp_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `patient_session_id` (`patient_session_id`);

--
-- Indexes for table `patient_detail_items`
--
ALTER TABLE `patient_detail_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_detail_id` (`patient_details_id`);

--
-- Indexes for table `patient_sessions`
--
ALTER TABLE `patient_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `pattients`
--
ALTER TABLE `pattients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `receptionists`
--
ALTER TABLE `receptionists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `member_id` (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `branch_admins`
--
ALTER TABLE `branch_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `otp_codes`
--
ALTER TABLE `otp_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `patient_details`
--
ALTER TABLE `patient_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `patient_detail_items`
--
ALTER TABLE `patient_detail_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `patient_sessions`
--
ALTER TABLE `patient_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pattients`
--
ALTER TABLE `pattients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `receptionists`
--
ALTER TABLE `receptionists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `otp_codes`
--
ALTER TABLE `otp_codes`
  ADD CONSTRAINT `otp_codes_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `otp_codes_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `pattients` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `otp_codes_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `otp_codes_ibfk_4` FOREIGN KEY (`patient_id`) REFERENCES `pattients` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD CONSTRAINT `patient_details_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_details_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_details_ibfk_3` FOREIGN KEY (`patient_id`) REFERENCES `pattients` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_details_ibfk_4` FOREIGN KEY (`patient_session_id`) REFERENCES `patient_sessions` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `patient_detail_items`
--
ALTER TABLE `patient_detail_items`
  ADD CONSTRAINT `patient_detail_items_ibfk_1` FOREIGN KEY (`patient_details_id`) REFERENCES `patient_details` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `patient_sessions`
--
ALTER TABLE `patient_sessions`
  ADD CONSTRAINT `patient_sessions_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_sessions_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `pattients` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_sessions_ibfk_3` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_sessions_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
