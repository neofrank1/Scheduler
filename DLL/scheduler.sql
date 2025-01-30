-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2025 at 04:13 PM
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
-- Database: `scheduler`
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
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`id`, `short_name`, `full_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'COEduc', 'College of Education', 1, '2024-10-11 23:35:32', '2024-10-11 23:35:32'),
(2, 'COEng', 'College of Engineering', 1, '2024-10-11 23:35:33', '2024-10-11 23:35:33'),
(3, 'COT', 'College of Technology', 1, '2024-10-11 23:35:33', '2024-10-11 23:35:33'),
(4, '', 'College of Management and Entrepreneurship', 1, '2024-10-11 23:35:33', '2024-10-11 23:35:33'),
(5, 'CCICT', 'College of Information and Communications Technology', 1, '2024-10-11 23:35:33', '2024-10-11 23:35:33'),
(6, 'CAS', 'College of Arts and Science', 1, '2024-10-11 23:35:33', '2024-10-11 23:35:33'),
(7, 'BSIT-2-B', 'Bachelor of Science in Information Technology-2-B', 1, '2024-10-22 07:01:29', '2024-10-22 07:01:29');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `college_id` bigint(20) UNSIGNED NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `college_id`, `short_name`, `full_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'BEEd', 'Bachelor in Elementary Education', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(2, 1, 'BECEd', 'Bachelor in Early Childhood Education', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(3, 1, 'BSNEd', 'Bachelor in Special Need Education', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(4, 1, 'BSEd - Math', 'Bachelor in Secondary Education Major in Mathematics', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(5, 1, 'BSEd - Science', 'Bachelor in Secondary Education Major in Science', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(6, 1, 'BSEd - Values Ed', 'Bachelor in Secondary Education Major in Values Education', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(7, 1, 'BSEd - English', 'Bachelor in Secondary Education Major in English', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(8, 1, 'BSEd - Filipino', 'Bachelor in Secondary Education Major in Filipino', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(9, 1, 'BTLEd-IA', 'Bachelor in Technology and Livelihood Education Major in Industrial Arts', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(10, 1, 'BTLEd-HE', 'Bachelor in Technology and Livelihood Education Major in Home Economics', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(11, 1, 'BTLEd-ICT', 'Bachelor in Technology and Livelihood Education Major in Information and Communication Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(12, 1, 'BTVTEd-Draft', 'Bachelor in Technical and Vocational Teacher Education Major in Architectural Drafting ', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(13, 1, 'BTVTEd-Auto', 'Bachelor in Technical and Vocational Teacher Education Major in Automotive Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(14, 1, 'BTVTEd-Food', 'Bachelor in Technical and Vocational Teacher Education Major in Food Services Management Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(15, 1, 'BTVTEd-Elec', 'Bachelor in Technical and Vocational Teacher Education Major in Electrical Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(16, 1, 'BTVTEd-Elex', 'Bachelor in Technical and Vocational Teacher Education Major in Electrical Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(17, 1, 'BTVTEd-GFD', 'Bachelor in Technical and Vocational Teacher Education Major in Garments, Fashion and Design Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(18, 1, 'BTVTEd-WF', 'Bachelor in Technical and Vocational Teacher Education Major in Welding and Fabrication Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(19, 2, 'BSCE', 'Bachelor of Science in Civil Engineering', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(20, 2, 'BSCompEng', 'Bachelor of Science in Computer Engineering', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(21, 2, 'BSECE', 'Bachelor of Science in Electronics Engineeringg', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(22, 2, 'BSEE', 'Bachelor of Science in Electrical Engineering', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(23, 2, 'BSIE', 'Bachelor of Science in Industrial Engineering', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(24, 2, 'BSME', 'Bachelor of Science in Mechanical Engineering', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(25, 3, 'BSMx', 'Bachelor of Science in Mechatronics', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(26, 3, 'BSGD', 'Bachelor of Science in Graphics and Design', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(27, 3, 'BSTechM', 'Bachelor of Science in Technology Management', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(28, 3, 'BIT - Automotive Technology', 'Bachelor of Industrial Technology Major in Automotive Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(29, 3, 'BIT - Civil Technology', 'Bachelor of Industrial Technology Major in Civil Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(30, 3, 'BIT - Cosmetology', 'Bachelor of Industrial Technology Major in Cosmetology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(31, 3, 'BIT - Drafting Technology', 'Bachelor of Industrial Technology Major in Drafting Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(32, 3, 'BIT - Electrical Technology', 'Bachelor of Industrial Technology Major in Electrical Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(33, 3, 'BIT - Electronics Technology', 'Bachelor of Industrial Technology Major in Electronics Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(34, 3, 'BIT - FoodTech', 'Bachelor of Industrial Technology Major in Food Preparation and Services Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(35, 3, 'BIT - Furniture and Cabinet Making', 'Bachelor of Industrial Technology Major in Furniture and Cabinet Making', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(36, 3, 'BIT - Garments Technology', 'Bachelor of Industrial Technology Major in Garments Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(37, 3, 'BIT - Interior Design Technology', 'Bachelor of Industrial Technology Major in Interior Design Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(38, 3, 'BIT - Machine Shop Technology', 'Bachelor of Industrial Technology Major in Machine Shop Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(39, 3, 'BIT - Power Plant Technology', 'chelor of Industrial Technology Major in Power Plant Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(40, 3, 'BIT - Refrigeration and Air-conditioning Technology', 'Bachelor of Industrial Technology Major in Refrigeration and Air-conditioning Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(41, 3, 'BIT - Welding and Fabrication Technology', 'Bachelor of Industrial Technology major in Welding and Fabrication Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(42, 4, 'BPA', 'Bachelor of Public Administration', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(43, 4, 'BSHM', 'Bachelor of Science in Hospitality Management', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(44, 4, 'BSBA- MM', 'Bachelor of Science in Business Administration Major in Marketing Management', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(45, 4, 'BSTM', 'Bachelor of Science in Tourism Management', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(46, 5, 'BSIT', 'Bachelor of Science in Information Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(47, 5, 'BSIS', 'Bachelor of Science in Information Systems', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(48, 5, 'BIT-CT', 'Bachelor in Industrial Technology - Computer Technology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(49, 6, 'BAEL-ECP', 'Bachelor of Arts in English Language Major in English Across the Professions', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(50, 6, 'BAEL-ELSD', 'Bachelor of Arts in English Language Major in English Language Studies as Discipline ', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(51, 6, 'BAL–LCS', 'Bachelor of Arts in Literature Major in Literature And Cultural Studies', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(52, 6, 'BAL–LA', 'Bachelor of Arts in Literature Major in Literature Across The Professions', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(53, 6, 'BS MATH', 'Bachelor of Science in Mathematics', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(54, 6, 'BS STAT', 'Bachelor of Science in Statistics', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(55, 6, 'BSDevCom', 'Bachelor of Science in Development Communication', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(56, 6, 'BAF', 'Batsilyer ng Sining sa Filipino', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(57, 6, 'BS PSYCH', 'Bachelor of Science in Psychology', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49'),
(58, 6, 'BSN', 'Bachelor of Science in Nursing', 1, '2024-10-11 23:37:49', '2024-10-11 23:37:49');

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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2024_07_29_150324_create_college_table', 1),
(4, '2024_07_29_151906_create_course_table', 1),
(5, '2024_07_29_151907_create_users_table', 1),
(6, '2024_08_10_023629_create_professors_table', 1),
(7, '2024_08_24_131526_create_ranking_table', 1),
(9, '2024_10_12_080937_create_section_table', 2),
(10, '2024_11_19_150041_create_rooms_table', 3),
(13, '2024_11_28_133415_create_subjects_table', 4),
(31, '2024_12_18_124224_create_schedule_table', 17),
(32, '2025_01_21_132209_create_time_slot_table', 18);

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
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `education_id` int(11) NOT NULL,
  `ranking_id` int(11) NOT NULL,
  `college_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `maximum_hours` double NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`id`, `employee_id`, `first_name`, `middle_name`, `last_name`, `address`, `mobile_no`, `education_id`, `ranking_id`, `college_id`, `course_id`, `maximum_hours`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Neo Frank', 'Defensor', 'Uy', 'Mandaue City', '09222145350', 1, 1, 5, 46, 100, 1, '2024-12-20 19:38:06', '2024-12-20 19:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `ranking`
--

CREATE TABLE `ranking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ranking`
--

INSERT INTO `ranking` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Instructor 1', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(2, 'Instructor 2', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(3, 'Instructor 3', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(4, 'Instructor 4', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(5, 'Instructor 5', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(6, 'Instructor 6', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(7, 'Instructor 7', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(8, 'Assistant Prof. 1', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(9, 'Assistant Prof. 2', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(10, 'Assistant Prof. 3', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(11, 'Assistant Prof. 4', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(12, 'Assistant Prof. 5', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(13, 'Assistant Prof. 6', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(14, 'Assistant Prof. 7', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(15, 'Associate Prof. 1', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(16, 'Associate Prof. 2', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(17, 'Associate Prof. 3', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(18, 'Associate Prof. 4', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(19, 'Associate Prof. 5', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(20, 'Associate Prof. 6', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(21, 'Associate Prof. 7', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(22, 'Professor 1', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(23, 'Professor 2', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(24, 'Professor 3', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(25, 'Professor 4', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(26, 'Professor 5', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(27, 'Professor 6', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(28, 'Professor 7', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(29, 'Professor 8', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(30, 'Professor 9', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(31, 'Professor 10', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(32, 'Professor 11', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(33, 'Professor 12', '2024-10-11 23:38:05', '2024-10-11 23:38:05'),
(34, 'Univ. Professor', '2024-10-11 23:38:05', '2024-10-11 23:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `building_name` varchar(255) NOT NULL,
  `floor_number` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `building_name`, `floor_number`, `room_number`, `created_at`, `updated_at`) VALUES
(1, 'Test Building', 1, 1, '2024-11-27 04:37:44', '2024-11-28 05:24:54'),
(2, 'Test Building 2', 2, 2, '2024-11-27 04:54:54', '2024-11-27 04:54:54');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED DEFAULT NULL,
  `prof_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `school_yr` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `room_id`, `prof_id`, `subject_id`, `section_id`, `course_id`, `school_yr`, `semester`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, 46, '2025-2026', '1', 1, '2025-01-23 05:23:04', '2025-01-26 06:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `year_lvl` int(11) NOT NULL,
  `college_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `program` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`, `year_lvl`, `college_id`, `course_id`, `program`, `created_at`, `updated_at`) VALUES
(1, 'BSIT-2-B', 3, 5, 46, 1, '2024-10-22 07:18:19', '2024-11-13 07:00:18'),
(2, 'BSIT-2-A', 2, 5, 46, 1, '2024-10-22 07:19:10', '2024-10-22 07:19:10');

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
('uJu2W2hx9xM1OzgRcsyYaCgt2TADTjY2hBhGAERL', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiNVQyRlhaSlJsYUNLWDRoRE9xOXozaWh6b1pGQ0xORjROVlc3RXBjYiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM5OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvcGRmL2dlbmVyYXRlTUlTLzEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTczODI0NjkzMjt9fQ==', 1738249853);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subj_code` varchar(255) NOT NULL,
  `subj_desc` varchar(255) NOT NULL,
  `subj_prereq` varchar(255) NOT NULL,
  `subj_type` int(11) NOT NULL,
  `subj_lec_hours` float NOT NULL,
  `subj_lab_hours` float NOT NULL,
  `subj_hours` float NOT NULL,
  `subj_units` int(11) NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `semester` int(11) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `year_level` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subj_code`, `subj_desc`, `subj_prereq`, `subj_type`, `subj_lec_hours`, `subj_lab_hours`, `subj_hours`, `subj_units`, `course_id`, `semester`, `school_year`, `year_level`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Subj-1', 'Subj 1', 'Subj-0', 1, 50, 100, 200, 0, 46, 1, '2024-2025', 1, 1, '2024-12-15 02:11:53', '2024-12-16 08:02:23'),
(2, 'Subj-2', 'Subj 2', 'Subj-1', 1, 50, 100, 150, 0, 46, 1, '2024-2025', 1, 1, '2024-12-15 02:16:22', '2024-12-15 02:16:22'),
(3, 'Test 1', 'Test 1', 'Test 2', 1, 25, 25.5, 50.5, 0, 46, 1, '2024-2025', 1, 1, '2024-12-15 04:20:23', '2024-12-15 04:20:23'),
(4, 'Test 2', 'Test 1', 'Test 1', 1, 25.5, 25.5, 55.5, 0, 46, 1, '2024-2025', 1, 1, '2024-12-15 04:21:54', '2024-12-15 04:21:54'),
(5, 'Test 3', 'Test 3', 'Test 3', 1, 4, 3, 12, 2, 46, 1, '2025-2026', 2, 1, '2025-01-28 07:15:03', '2025-01-28 07:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `schedule_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `day` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`id`, `schedule_id`, `start_time`, `end_time`, `day`, `created_at`, `updated_at`) VALUES
(1, 1, '07:00:00', '12:00:00', '1', '2025-01-23 05:23:04', '2025-01-26 05:50:21'),
(2, 1, '07:00:00', '12:00:00', '2', '2025-01-23 05:23:04', '2025-01-26 05:50:21'),
(3, 1, '07:00:00', '12:00:00', '3', '2025-01-26 05:48:29', '2025-01-26 05:50:21'),
(4, 1, '07:00:00', '12:00:00', '4', '2025-01-26 05:48:29', '2025-01-26 05:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL,
  `college_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employee_id`, `first_name`, `middle_name`, `last_name`, `user_type`, `college_id`, `course_id`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '1', 'Neo Frank', 'Defensor', 'Uy', 1, NULL, NULL, 'neofrankuy21@gmail.com', NULL, '$2y$12$rBl7DV9lKlW3Ueq7w9pdRu7MKjEtJ/DNBXM.gJoo6fKrODqS8.uBa', 1, NULL, '2024-10-11 23:45:08', '2024-10-11 23:45:08'),
(2, '2', 'Neo Frank', 'Defensor', 'Uy', 2, 5, NULL, 'neofrankuy22@gmail.com', NULL, '$2y$12$nCThQBbvs/oYW/sh3B39fOF.B6z1mtj7V6GI83cQDMsQctHQgRSNO', 1, NULL, '2024-10-11 23:46:14', '2024-10-18 22:20:12'),
(3, '3', 'Neo Frank', 'Defensor', 'Uy', 3, 5, 46, 'neofrankuy23@gmail.com', NULL, '$2y$12$fM2a8xOIcqhynIDTikAkZOo9SIhPWMLoHKA/3wZZXcgXS2n.jfjrm', 1, NULL, '2024-10-11 23:46:41', '2024-10-18 22:20:06');

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
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_college_id_foreign` (`college_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professors_college_id_foreign` (`college_id`),
  ADD KEY `professors_course_id_foreign` (`course_id`);

--
-- Indexes for table `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_room_id_foreign` (`room_id`),
  ADD KEY `schedule_prof_id_foreign` (`prof_id`),
  ADD KEY `schedule_subject_id_foreign` (`subject_id`),
  ADD KEY `schedule_section_id_foreign` (`section_id`),
  ADD KEY `schedule_course_id_foreign` (`course_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_college_id_foreign` (`college_id`),
  ADD KEY `section_course_id_foreign` (`course_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subjects_course_id_foreign` (`course_id`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `time_slot_schedule_id_foreign` (`schedule_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_college_id_foreign` (`college_id`),
  ADD KEY `users_course_id_foreign` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `professors`
--
ALTER TABLE `professors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ranking`
--
ALTER TABLE `ranking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_college_id_foreign` FOREIGN KEY (`college_id`) REFERENCES `college` (`id`);

--
-- Constraints for table `professors`
--
ALTER TABLE `professors`
  ADD CONSTRAINT `professors_college_id_foreign` FOREIGN KEY (`college_id`) REFERENCES `college` (`id`),
  ADD CONSTRAINT `professors_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `schedule_prof_id_foreign` FOREIGN KEY (`prof_id`) REFERENCES `professors` (`id`),
  ADD CONSTRAINT `schedule_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `schedule_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`),
  ADD CONSTRAINT `schedule_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_college_id_foreign` FOREIGN KEY (`college_id`) REFERENCES `college` (`id`),
  ADD CONSTRAINT `section_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Constraints for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD CONSTRAINT `time_slot_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_college_id_foreign` FOREIGN KEY (`college_id`) REFERENCES `college` (`id`),
  ADD CONSTRAINT `users_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
