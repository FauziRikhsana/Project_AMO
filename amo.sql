-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2026 at 05:08 PM
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
-- Database: `amo`
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
-- Table structure for table `form_fields`
--

CREATE TABLE `form_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_section_id` bigint(20) UNSIGNED NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_label` varchar(255) NOT NULL,
  `field_type` varchar(255) NOT NULL DEFAULT 'text',
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `is_required` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_fields`
--

INSERT INTO `form_fields` (`id`, `form_section_id`, `field_name`, `field_label`, `field_type`, `options`, `is_required`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'report_number', 'Report Number', 'text', NULL, 1, 1, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(2, 1, 'date', 'Date', 'date', NULL, 1, 2, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(3, 1, 'department', 'Department', 'text', NULL, 1, 3, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(4, 1, 'prepared_by', 'Prepared By', 'text', NULL, 1, 4, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(5, 2, 'aircraft_registration', 'Aircraft Registration', 'text', NULL, 1, 1, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(6, 2, 'aircraft_type', 'Aircraft Type', 'text', NULL, 1, 2, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(7, 2, 'job_task_number', 'Job / Task Number', 'text', NULL, 1, 3, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(8, 2, 'job_title', 'Job Title', 'text', NULL, 1, 4, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(9, 2, 'job_description', 'Job Description', 'textarea', NULL, 1, 5, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(10, 3, 'reference_document', 'Reference Document', 'text', NULL, 0, 1, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(11, 3, 'reference_number', 'Reference Number', 'text', NULL, 0, 2, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(12, 3, 'maintenance_manual', 'Maintenance Manual / Document', 'text', NULL, 0, 3, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(13, 3, 'revision', 'Revision', 'text', NULL, 0, 4, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(14, 4, 'special_tooling', 'Job requires special tooling?', 'select', '[\"Yes\",\"No\"]', 1, 1, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(15, 4, 'special_equipment', 'Job requires special equipment?', 'select', '[\"Yes\",\"No\"]', 1, 2, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(16, 4, 'special_skill', 'Job requires special skill?', 'select', '[\"Yes\",\"No\"]', 1, 3, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(17, 4, 'additional_personnel', 'Job requires additional maintenance personnel?', 'select', '[\"Yes\",\"No\"]', 1, 4, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(18, 4, 'additional_safety', 'Job requires additional safety precautions?', 'select', '[\"Yes\",\"No\"]', 1, 5, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(19, 4, 'evaluation_result', 'Evaluation Result', 'textarea', NULL, 1, 6, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(20, 5, 'estimated_man_hours', 'Estimated Man Hours', 'number', NULL, 1, 1, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(21, 5, 'number_of_personnel', 'Number of Personnel', 'number', NULL, 1, 2, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(22, 5, 'required_skill', 'Required Skill / Qualification', 'textarea', NULL, 1, 3, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(23, 5, 'special_tools_equipment', 'Special Tools / Equipment', 'textarea', NULL, 0, 4, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(24, 6, 'remarks', 'Remarks', 'textarea', NULL, 0, 1, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(25, 7, 'prepared_by_name', 'Prepared By - Name', 'text', NULL, 1, 1, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(26, 7, 'prepared_by_date', 'Prepared By - Date', 'date', NULL, 1, 2, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(27, 7, 'reviewed_by_name', 'Reviewed By - Name', 'text', NULL, 0, 3, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(28, 7, 'reviewed_by_date', 'Reviewed By - Date', 'date', NULL, 0, 4, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(29, 7, 'approved_by_name', 'Approved By - Name', 'text', NULL, 0, 5, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(30, 7, 'approved_by_date', 'Approved By - Date', 'date', NULL, 0, 6, '2026-09-30 02:09:27', '2026-09-30 02:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `form_sections`
--

CREATE TABLE `form_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_template_id` bigint(20) UNSIGNED NOT NULL,
  `section_title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_sections`
--

INSERT INTO `form_sections` (`id`, `form_template_id`, `section_title`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Document Information', 'Informasi dasar dokumen Job Evaluation.', 1, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(2, 1, 'Job Information', 'Informasi mengenai pekerjaan yang akan dievaluasi.', 2, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(3, 1, 'Reference', 'Dokumen referensi yang digunakan dalam pekerjaan.', 3, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(4, 1, 'Job Evaluation', 'Evaluasi terhadap kebutuhan dan karakteristik pekerjaan.', 4, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(5, 1, 'Work Requirement', 'Kebutuhan pekerjaan dalam pelaksanaan maintenance.', 5, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(6, 1, 'Remarks', 'Catatan tambahan mengenai Job Evaluation.', 6, '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(7, 1, 'Approval', 'Informasi persetujuan dokumen.', 7, '2026-09-30 02:09:27', '2026-09-30 02:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `form_submissions`
--

CREATE TABLE `form_submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_template_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `document_number` varchar(255) NOT NULL,
  `status` enum('draft','submitted','review','approved','rejected') NOT NULL DEFAULT 'draft',
  `pdf_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_submissions`
--

INSERT INTO `form_submissions` (`id`, `form_template_id`, `user_id`, `document_number`, `status`, `pdf_path`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'JE-001', 'draft', NULL, '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(2, 1, 1, 'JE-002', 'submitted', NULL, '2026-09-30 07:22:12', '2026-10-01 03:39:57'),
(3, 1, 1, 'JE-003', 'approved', NULL, '2026-09-30 07:28:09', '2026-10-01 08:48:11');

-- --------------------------------------------------------

--
-- Table structure for table `form_templates`
--

CREATE TABLE `form_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `version` varchar(255) NOT NULL DEFAULT '1.0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_templates`
--

INSERT INTO `form_templates` (`id`, `form_code`, `name`, `description`, `version`, `status`, `created_at`, `updated_at`) VALUES
(1, 'QC-AS-0128', 'JOB EVALUATION (JE)', 'Form Job Evaluation untuk melakukan evaluasi pekerjaan maintenance.', '1.0', 'active', '2026-09-30 02:09:27', '2026-09-30 02:09:27'),
(2, '0001', 'Test Update', 'Testing 1', '1.0', 'active', '2026-10-01 09:15:34', '2026-10-01 09:22:25');

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
(4, '2026_09_30_070820_add_role_to_users_table', 2),
(5, '2026_09_30_084001_create_form_templates_table', 3),
(6, '2026_09_30_084330_create_form_sections_table', 3),
(7, '2026_09_30_084557_create_form_fields_table', 3),
(8, '2026_09_30_134040_create_form_submissions_table', 4),
(9, '2026_09_30_134046_create_submission_values_table', 4);

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
('MkIF1E0GQvZv3KRWZTyNGE8XqjbJZvO0ybpTZBaZ', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic1JHaGQ4alliMjNVMWJHdW1ya1pCcER4ZEw2Y1puWncyVkNGcjQ3NyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi90ZW1wbGF0ZXMiO3M6NToicm91dGUiO3M6MjE6ImFkbWluLnRlbXBsYXRlcy5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1791972806),
('V5mHoqWGTVtrIz4fk7a46fKrxcu6sMl2QxL47uXb', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMnVTVVIzbDZVTUxFZFhjTkFKT3Q4ZFBGSFZwdjR2dmg2Wk5XYTQzNCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hbW8vcmVwb3J0cy8yL3BkZiI7czo1OiJyb3V0ZSI7czoxNToiYW1vLnJlcG9ydHMucGRmIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1790914583);

-- --------------------------------------------------------

--
-- Table structure for table `submission_values`
--

CREATE TABLE `submission_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_submission_id` bigint(20) UNSIGNED NOT NULL,
  `form_field_id` bigint(20) UNSIGNED NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `submission_values`
--

INSERT INTO `submission_values` (`id`, `form_submission_id`, `form_field_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(2, 1, 2, '2026-09-30', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(3, 1, 3, 'Maintenence Engenering', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(4, 1, 4, 'orang', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(5, 1, 5, 'test 1', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(6, 1, 6, 'test 1', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(7, 1, 7, 'tes 1', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(8, 1, 8, 'test 1', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(9, 1, 9, 'test', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(10, 1, 10, '1', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(11, 1, 11, '1', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(12, 1, 12, '1', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(13, 1, 13, '1', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(14, 1, 14, 'Yes', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(15, 1, 15, 'Yes', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(16, 1, 16, 'Yes', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(17, 1, 17, 'Yes', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(18, 1, 18, 'Yes', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(19, 1, 19, 'tes', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(20, 1, 20, '4', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(21, 1, 21, '4', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(22, 1, 22, 'tes', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(23, 1, 23, 'tes', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(24, 1, 24, 'tes', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(25, 1, 25, 'orang', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(26, 1, 26, '2026-09-30', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(27, 1, 27, 'test', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(28, 1, 28, '2026-09-30', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(29, 1, 29, 'test', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(30, 1, 30, '2026-09-30', '2026-09-30 07:21:02', '2026-09-30 07:21:02'),
(31, 2, 1, '1', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(32, 2, 2, '2026-09-30', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(33, 2, 3, 'Maintenence Engenering', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(34, 2, 4, 'orang', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(35, 2, 5, 'test 1', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(36, 2, 6, 'test 1', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(37, 2, 7, 'tes 1', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(38, 2, 8, 'test 1', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(39, 2, 9, 't', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(40, 2, 10, '1', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(41, 2, 11, '1', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(42, 2, 12, '1', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(43, 2, 13, '1', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(44, 2, 14, 'Yes', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(45, 2, 15, 'Yes', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(46, 2, 16, 'Yes', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(47, 2, 17, 'Yes', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(48, 2, 18, 'No', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(49, 2, 19, 't', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(50, 2, 20, '4', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(51, 2, 21, '4', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(52, 2, 22, 't', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(53, 2, 23, 't', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(54, 2, 24, 't', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(55, 2, 25, 'orang', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(56, 2, 26, '2026-09-30', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(57, 2, 27, 'test', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(58, 2, 28, '2026-09-30', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(59, 2, 29, 'test', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(60, 2, 30, '2026-09-30', '2026-09-30 07:22:12', '2026-09-30 07:22:12'),
(61, 3, 1, 'JE-003', '2026-09-30 07:28:09', '2026-09-30 09:06:07'),
(62, 3, 2, '2026-09-30', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(63, 3, 3, 'Maintenence Engenering', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(64, 3, 4, 'test oleh orang', '2026-09-30 07:28:09', '2026-09-30 09:06:07'),
(65, 3, 5, 'test 1', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(66, 3, 6, 'test 1', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(67, 3, 7, 'tes 1', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(68, 3, 8, 'test 1', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(69, 3, 9, 'tes', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(70, 3, 10, '1', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(71, 3, 11, '1', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(72, 3, 12, '1', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(73, 3, 13, '1', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(74, 3, 14, 'Yes', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(75, 3, 15, 'Yes', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(76, 3, 16, 'Yes', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(77, 3, 17, 'Yes', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(78, 3, 18, 'Yes', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(79, 3, 19, 'tes', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(80, 3, 20, '4', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(81, 3, 21, '4', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(82, 3, 22, 'tes', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(83, 3, 23, 'tes', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(84, 3, 24, 'tes', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(85, 3, 25, 'orang', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(86, 3, 26, '2026-09-30', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(87, 3, 27, 'test', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(88, 3, 28, '2026-09-30', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(89, 3, 29, 'test', '2026-09-30 07:28:09', '2026-09-30 07:28:09'),
(90, 3, 30, '2026-09-30', '2026-09-30 07:28:09', '2026-09-30 07:28:09');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'User MEDALI', 'user@medali.test', NULL, '$2y$12$KHFdDhSIePmi8l1TzKTncOrNMDxoXLIPDMsgFDPcIsuBtSaHU4Nva', NULL, '2026-09-27 18:57:31', '2026-09-27 18:57:31', 'user'),
(2, 'Admin MEDALI', 'admin@medali.test', NULL, '$2y$12$yOW/TIg0QNxIGs/V8fsweuoOXzVxALrIeEUYpmjDxlaT8ynTpBttm', NULL, '2026-09-27 18:57:48', '2026-09-30 00:10:07', 'admin'),
(3, 'Super Admin MEDALI', 'superadmin@medali.test', NULL, '$2y$12$PDn.EjeJq3LMxeKAe8ZfEufqaYqd8mm0qw8TOWIHqMnid/DR8/o9G', NULL, '2026-09-27 18:57:56', '2026-09-30 00:10:15', 'super_admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `form_fields`
--
ALTER TABLE `form_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_fields_form_section_id_foreign` (`form_section_id`);

--
-- Indexes for table `form_sections`
--
ALTER TABLE `form_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_sections_form_template_id_foreign` (`form_template_id`);

--
-- Indexes for table `form_submissions`
--
ALTER TABLE `form_submissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `form_submissions_document_number_unique` (`document_number`),
  ADD KEY `form_submissions_form_template_id_foreign` (`form_template_id`),
  ADD KEY `form_submissions_user_id_foreign` (`user_id`);

--
-- Indexes for table `form_templates`
--
ALTER TABLE `form_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `form_templates_form_code_unique` (`form_code`);

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
-- Indexes for table `submission_values`
--
ALTER TABLE `submission_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `submission_values_form_submission_id_form_field_id_unique` (`form_submission_id`,`form_field_id`),
  ADD KEY `submission_values_form_field_id_foreign` (`form_field_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_fields`
--
ALTER TABLE `form_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `form_sections`
--
ALTER TABLE `form_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `form_submissions`
--
ALTER TABLE `form_submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `form_templates`
--
ALTER TABLE `form_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `submission_values`
--
ALTER TABLE `submission_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `form_fields`
--
ALTER TABLE `form_fields`
  ADD CONSTRAINT `form_fields_form_section_id_foreign` FOREIGN KEY (`form_section_id`) REFERENCES `form_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `form_sections`
--
ALTER TABLE `form_sections`
  ADD CONSTRAINT `form_sections_form_template_id_foreign` FOREIGN KEY (`form_template_id`) REFERENCES `form_templates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `form_submissions`
--
ALTER TABLE `form_submissions`
  ADD CONSTRAINT `form_submissions_form_template_id_foreign` FOREIGN KEY (`form_template_id`) REFERENCES `form_templates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `form_submissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `submission_values`
--
ALTER TABLE `submission_values`
  ADD CONSTRAINT `submission_values_form_field_id_foreign` FOREIGN KEY (`form_field_id`) REFERENCES `form_fields` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submission_values_form_submission_id_foreign` FOREIGN KEY (`form_submission_id`) REFERENCES `form_submissions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
