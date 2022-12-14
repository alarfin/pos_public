-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2022 at 02:19 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erpsherali`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `account_class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `account_head_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_status` tinyint(4) NOT NULL DEFAULT 0,
  `transaction_status` tinyint(4) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `client_id`, `account_class_id`, `account_head_id`, `name`, `default_status`, `transaction_status`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 0, 4, 1, 'Purchase (Supplier)', 1, 0, 1, NULL, '2022-02-26 11:59:02', '2022-02-26 11:59:02'),
(2, 0, 3, 2, 'Sale (Customer)', 1, 0, 1, NULL, '2022-02-26 12:00:14', '2022-02-26 12:00:14'),
(3, 0, 1, 4, 'Cash In Hand', 1, 0, 1, NULL, '2022-02-26 12:00:14', '2022-02-26 12:00:14'),
(4, 0, 1, 4, 'Bank', 1, 0, 1, NULL, '2022-02-26 12:00:14', '2022-02-26 12:00:14'),
(6, 0, 5, 3, 'Capital', 1, 0, 1, NULL, '2022-02-26 12:00:14', '2022-02-26 12:00:14'),
(7, 0, 4, 6, 'Salary', 1, 0, 1, NULL, '2022-02-26 11:59:02', '2022-02-26 11:59:02'),
(8, 0, 2, 7, 'Purchase Payable', 1, 0, 1, NULL, '2022-02-26 11:59:02', '2022-02-26 11:59:02'),
(9, 0, 1, 8, 'Sale Receivable', 1, 0, 1, NULL, '2022-02-26 12:00:14', '2022-02-26 12:00:14'),
(10, 0, 2, 7, 'Salary Payable', 1, 0, 1, NULL, '2022-02-26 12:00:14', '2022-02-26 12:00:14'),
(11, 0, 3, 9, 'Online Information', 1, 0, 1, NULL, '2022-02-26 12:00:14', '2022-02-26 12:00:14'),
(12, 0, 2, 7, 'Online Payable', 1, 0, 1, NULL, '2022-02-26 11:59:02', '2022-02-26 11:59:02'),
(13, 0, 1, 8, 'Online Receivable', 1, 0, 1, NULL, '2022-02-26 12:00:14', '2022-02-26 12:00:14'),
(14, 0, 4, 10, 'Online Fee Payments', 1, 1, 1, NULL, '2022-02-26 12:00:14', '2022-02-26 12:00:14'),
(15, 0, 3, 11, 'Photocopy', 1, 0, 1, NULL, '2022-02-26 12:00:14', '2022-02-26 12:00:14'),
(16, 0, 2, 7, 'Photocopy Payable', 1, 0, 1, NULL, '2022-02-26 11:59:02', '2022-02-26 11:59:02'),
(17, 0, 1, 8, 'Photocopy Receivable', 1, 0, 1, NULL, '2022-02-26 12:00:14', '2022-02-26 12:00:14'),
(18, 0, 3, 13, 'Student Collection', 1, 0, 1, NULL, '2022-02-26 12:00:14', '2022-02-26 12:00:14'),
(19, 0, 2, 7, 'Student Payable', 1, 0, 1, NULL, '2022-02-26 11:59:02', '2022-02-26 11:59:02'),
(20, 0, 1, 8, 'Student Receivable', 1, 0, 1, NULL, '2022-02-26 12:00:14', '2022-02-26 12:00:14'),
(101, 1, 3, 101, 'Others Income', 0, 1, 1, NULL, '2022-02-28 12:02:01', '2022-02-28 12:02:01'),
(102, 1, 4, 102, 'Mobile Bill', 0, 1, 1, NULL, '2022-02-28 12:02:01', '2022-02-28 12:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `account_classes`
--

CREATE TABLE `account_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_classes`
--

INSERT INTO `account_classes` (`id`, `name`, `type`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Assets', 1, 1, NULL, '2022-02-26 11:52:04', '2022-02-26 11:52:04'),
(2, 'Liability', 2, 1, NULL, '2022-02-26 11:52:52', '2022-02-26 11:52:52'),
(3, 'Income', 2, 1, NULL, '2022-02-26 11:52:52', '2022-02-26 11:52:52'),
(4, 'Expense', 1, 1, NULL, '2022-02-26 11:52:52', '2022-02-26 11:52:52'),
(5, 'Equity', 2, 1, NULL, '2022-02-26 11:52:52', '2022-02-26 11:52:52');

-- --------------------------------------------------------

--
-- Table structure for table `account_heads`
--

CREATE TABLE `account_heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `account_class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_status` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_heads`
--

INSERT INTO `account_heads` (`id`, `client_id`, `account_class_id`, `name`, `default_status`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 0, 4, 'Purchase', 1, 1, NULL, '2022-02-26 11:55:45', '2022-02-26 11:55:45'),
(2, 0, 3, 'Sale', 1, 1, NULL, '2022-02-26 11:55:45', '2022-02-26 11:55:45'),
(3, 0, 5, 'Share Capital', 1, 1, NULL, '2022-02-26 12:02:01', '2022-02-26 12:02:01'),
(4, 0, 1, 'Transaction Method', 1, 1, NULL, '2022-02-26 12:02:01', '2022-02-26 12:02:01'),
(6, 0, 4, 'Salary Process', 1, 1, NULL, '2022-02-27 09:17:57', '2022-02-27 09:17:57'),
(7, 0, 2, 'Account Payable', 1, 1, NULL, '2022-02-27 09:17:57', '2022-02-27 09:17:57'),
(8, 0, 1, 'Account Receivable', 1, 1, NULL, '2022-02-27 09:17:57', '2022-02-27 09:17:57'),
(9, 0, 3, 'Online Information Income', 1, 1, NULL, '2022-02-26 11:55:45', '2022-02-26 11:55:45'),
(10, 0, 4, 'Online Information Expense', 1, 1, NULL, '2022-02-26 11:55:45', '2022-02-26 11:55:45'),
(11, 0, 3, 'Photocopy Income', 1, 1, NULL, '2022-02-26 11:55:45', '2022-02-26 11:55:45'),
(12, 0, 4, 'Photocopy Expense', 1, 1, NULL, '2022-02-26 11:55:45', '2022-02-26 11:55:45'),
(13, 0, 3, 'Training Center Income', 1, 1, NULL, '2022-02-26 11:55:45', '2022-02-26 11:55:45'),
(14, 0, 4, 'Training Center Expense', 1, 1, NULL, '2022-02-26 11:55:45', '2022-02-26 11:55:45'),
(101, 1, 4, 'Office Income', 0, 1, NULL, '2022-02-28 11:58:33', '2022-02-28 11:58:33'),
(102, 1, 4, 'Office Expense', 0, 1, NULL, '2022-02-28 11:58:33', '2022-02-28 11:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `application_types`
--

CREATE TABLE `application_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application_types`
--

INSERT INTO `application_types` (`id`, `client_id`, `section_id`, `company_branch_id`, `name`, `description`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 6, NULL, 'Primary Teacher', 'Testing', 1, 1, NULL, '2022-06-18 10:27:52', '2022-06-18 11:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `date` date NOT NULL,
  `present` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=present,0=absent',
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `total_time` double(20,2) DEFAULT 0.00,
  `late` tinyint(4) NOT NULL DEFAULT 0,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `client_id`, `employee_id`, `section_id`, `company_branch_id`, `date`, `present`, `in_time`, `out_time`, `total_time`, `late`, `note`, `status`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2022-03-21', 1, '09:00:00', '19:00:00', 36000.00, 0, NULL, 1, 1, NULL, '2022-03-21 11:51:11', '2022-06-08 11:34:11'),
(2, 1, 1, 1, 1, '2022-03-20', 1, '10:00:00', '19:00:00', 32400.00, 0, NULL, 1, 1, NULL, '2022-03-22 06:08:10', '2022-03-22 06:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `balance_transfers`
--

CREATE TABLE `balance_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `transfer_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `debit_payment_method` tinyint(4) DEFAULT NULL,
  `debit_account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `debit_bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `credit_payment_method` tinyint(4) DEFAULT NULL,
  `credit_account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `credit_bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` double(20,6) DEFAULT 0.000000,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `delete_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `user_id` int(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `client_id`, `name`, `account_name`, `account_no`, `account_code`, `branch`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sahjalal Islami Bank Ltd', 'Company Account', '4008 111 000 100 15', NULL, 'Uttara', 1, 1, '2022-02-09 06:18:16', '2022-06-08 11:32:05');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `course_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seat` int(11) DEFAULT 0,
  `user_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `client_id`, `section_id`, `company_branch_id`, `course_id`, `name`, `batch_no`, `seat`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL, 'AB Morning', '1001', 50, 1, 1, NULL, '2022-07-06 09:10:10', '2022-07-06 09:10:10'),
(2, 1, 2, NULL, NULL, 'Evening', 'EV-1001', 20, 1, 1, NULL, '2022-07-19 11:56:15', '2022-07-19 11:56:15');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_branches`
--

CREATE TABLE `company_branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delete_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_branches`
--

INSERT INTO `company_branches` (`id`, `client_id`, `section_id`, `name`, `email`, `mobile_no`, `address`, `image`, `logo`, `description`, `status`, `user_id`, `delete_user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Rampura', 'rampura@gmail.com', '12121212121', 'Test address', NULL, NULL, NULL, 1, 1, NULL, NULL, '2022-03-21 11:00:59', '2022-03-21 11:00:59'),
(2, 1, 1, 'Hatirjhil', NULL, '11222222222', 'Hatirjhil', NULL, NULL, NULL, 1, 1, NULL, NULL, '2022-03-23 04:39:42', '2022-03-23 04:39:42'),
(3, 1, 6, 'Head Office', NULL, '01212323021', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, '2022-06-09 10:35:38', '2022-06-09 10:35:38'),
(4, 1, 7, 'Main Branch', NULL, '11121111111', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, '2022-06-22 05:38:51', '2022-06-22 05:38:51'),
(5, 1, 2, 'Main Training Center', NULL, '1122222211', NULL, 'public/uploads/company_branch/bQEzgtxKoM9UX1wqxcPo5FWQPpy5UEMwP4CwVi5bhbHXfimHOUfeaturedimage2019-04-03-22-50-03_5ca51c7b1d4e3.jpg', NULL, NULL, 1, 1, NULL, NULL, '2022-07-06 04:53:08', '2022-07-25 09:40:03');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `course_category_id` bigint(20) DEFAULT NULL,
  `teacher_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `previous_fee` double(20,2) DEFAULT 0.00,
  `fee` double(20,2) DEFAULT 0.00,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `client_id`, `section_id`, `company_branch_id`, `course_category_id`, `teacher_id`, `name`, `duration`, `image`, `previous_fee`, `fee`, `short_description`, `description`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, 1, 1, 'Basic to advanced web design', '3 month', 'public/uploads/course/Sn78DhyeliiVRqaWaXhlfiAJ4FiXFN0BSu01pHSq7j3JKmYxUHbusiness-company-logo-27438249.jpg', 0.00, 10000.00, 'short descriptio here', '<p>This tutorial will help you learn quickly and thoroughly. Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. You&rsquo;ll be exposed to principles and strategies, but, more importantly, you&rsquo;ll learn how to actually apply these abstract concepts by coding three different websites for three very different audiences. Lorem ipsum is dummy text used in laying out print, graphic or web designs Lorem ipsum.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>What Will I Learn?</p>\r\n\r\n<ul>\r\n	<li>Learn how perspective works and how to incorporate it into your art</li>\r\n	<li>Learn how perspective works and how to incorporate it into your art</li>\r\n</ul>', 1, 1, NULL, '2022-07-05 09:50:53', '2022-07-23 08:58:02'),
(2, 1, 2, NULL, 2, 2, 'Graphics Design for Begginer', '3 Month', 'public/uploads/course/yujswVK3dMt2lt0rWxZPuhO5t04JB5tkqUewdjExX1URbuS5fTcount_up_bg.jpg', 0.00, 5000.00, 'Testing couse here', '<p>This tutorial will help you learn quickly and thoroughly. Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. You&rsquo;ll be exposed to principles and strategies, but, more importantly, you&rsquo;ll learn how to actually apply these abstract concepts by coding three different websites for three very different audiences. Lorem ipsum is dummy text used in laying out print, graphic or web designs Lorem ipsum.</p>\r\n\r\n<p>What Will I Learn?</p>\r\n\r\n<ul>\r\n	<li>Learn how perspective works and how to incorporate it into your art</li>\r\n	<li>What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting</li>\r\n	<li>Learn and apply industry-standard drawing techniques</li>\r\n	<li>Get friendly and fast support in the course Q&amp;A</li>\r\n	<li>Why do we use it? t is a long established fact that a reader will be distracted</li>\r\n	<li>Downloadable lectures, code and design assets for all projects</li>\r\n	<li>Learn how perspective works and how to incorporate it into your art</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>', 1, 1, NULL, '2022-07-19 11:55:39', '2022-07-23 08:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `course_categories`
--

CREATE TABLE `course_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_categories`
--

INSERT INTO `course_categories` (`id`, `client_id`, `section_id`, `company_branch_id`, `name`, `description`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, 'Professional Web design', 'Description here', 1, 1, NULL, '2022-07-05 06:15:16', '2022-07-05 06:16:08'),
(2, 1, 2, NULL, 'Graphics Design', 'Testing', 1, 1, NULL, '2022-07-19 11:54:16', '2022-07-19 11:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `user_id` int(15) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `client_id`, `name`, `mobile_no`, `email`, `address`, `status`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'General Customers', '650837948', NULL, '77 Rue Roger Salengro', 1, 2, NULL, '2021-07-30 17:48:07', '2022-02-13 07:06:12'),
(2, 1, 'AMA Librairie', '650837948', NULL, '77 Rue Roger Salengro', 1, 2, NULL, '2021-07-30 22:39:44', '2021-08-01 06:29:10'),
(3, 1, 'Sonali', '075182003', NULL, '77 rue Roger, 93700', 1, 7, NULL, '2021-07-30 22:52:41', '2021-07-30 22:52:41'),
(4, 1, 'Sonali', '075182003', NULL, '77 rue Roger, 93700', 1, 7, '2022-02-17 05:57:40', '2021-07-30 22:52:42', '2022-02-17 05:57:40'),
(5, 1, 'Tangail Shop', '354353245425', NULL, 'bvxcv', 1, 1, NULL, '2021-08-01 06:30:40', '2021-08-01 06:30:40'),
(6, 1, NULL, '0111111111212', NULL, NULL, 1, 1, NULL, '2022-06-12 12:15:11', '2022-06-12 12:15:11'),
(7, 1, 'Testing', '11211122222', NULL, NULL, 1, 1, NULL, '2022-06-12 12:20:35', '2022-06-12 12:20:35'),
(8, 1, 'Online Customer', '0122112211', NULL, NULL, 1, 1, NULL, '2022-06-18 09:46:09', '2022-06-18 09:46:09'),
(9, 1, 'Photocopy Extra Entry', '11122221111', NULL, NULL, 1, 1, NULL, '2022-06-23 10:30:10', '2022-06-23 10:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_status` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `client_id`, `name`, `short_name`, `default_status`, `status`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Manager', 'MGR', 0, 1, 1, NULL, '2022-03-21 10:09:37', '2022-03-21 10:09:37'),
(2, 1, 'Web Design', 'WD', 0, 1, 1, NULL, '2022-07-06 05:01:14', '2022-07-06 05:01:14'),
(3, 1, 'Graphics Designer', 'GD', 0, 1, 1, NULL, '2022-07-19 11:47:20', '2022-07-19 11:47:20');

-- --------------------------------------------------------

--
-- Table structure for table `designation_logs`
--

CREATE TABLE `designation_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designation_logs`
--

INSERT INTO `designation_logs` (`id`, `client_id`, `employee_id`, `designation_id`, `date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '1', '1', '2022-03-21', NULL, '2022-03-21 11:21:00', '2022-03-21 11:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `id_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `permanent_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `nid_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` tinyint(4) DEFAULT NULL COMMENT '1=Islam,2=Hinduism,3=Christianity,4=Buddhism,5=Others',
  `gender` tinyint(4) DEFAULT NULL COMMENT '1=male,2=female,3=other',
  `marital_status` tinyint(4) DEFAULT NULL COMMENT '1=single,2=married,3=divorced,4=other',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `own_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `client_id`, `section_id`, `company_branch_id`, `id_no`, `designation_id`, `name`, `email`, `father_name`, `mother_name`, `photo`, `signature`, `salary`, `birth_date`, `permanent_address`, `present_address`, `join_date`, `nid_no`, `mobile_no`, `religion`, `gender`, `marital_status`, `status`, `user_id`, `own_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '00001', 1, 'Aminur Rahman', 'aminur@gmail.com', NULL, NULL, NULL, NULL, '15000', NULL, NULL, NULL, NULL, NULL, '12311111112', 1, 1, NULL, 1, 1, 10, NULL, '2022-03-21 11:21:00', '2022-03-21 11:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_logs`
--

CREATE TABLE `inventory_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_category_id` int(15) DEFAULT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Purchase,2=Manually Stock, 3=Sale, 4=Damage',
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=In, 2=Out',
  `date` date NOT NULL,
  `serial_no` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` double(20,2) DEFAULT 0.00,
  `return_quantity` double(20,2) NOT NULL DEFAULT 0.00,
  `unit_price` double(20,2) DEFAULT 0.00,
  `buy_price` double(20,2) NOT NULL DEFAULT 0.00,
  `discount` double(20,2) NOT NULL DEFAULT 0.00,
  `tax` double(20,2) NOT NULL DEFAULT 0.00,
  `vat` double(20,2) NOT NULL DEFAULT 0.00,
  `product_total` double(20,2) NOT NULL DEFAULT 0.00,
  `buy_total` double(20,2) NOT NULL DEFAULT 0.00,
  `total` double(20,2) DEFAULT 0.00,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_logs`
--

INSERT INTO `inventory_logs` (`id`, `client_id`, `section_id`, `company_branch_id`, `product_id`, `product_category_id`, `code`, `invoice_no`, `stock_type`, `type`, `date`, `serial_no`, `quantity`, `return_quantity`, `unit_price`, `buy_price`, `discount`, `tax`, `vat`, `product_total`, `buy_total`, `total`, `supplier_id`, `purchase_order_id`, `customer_id`, `sale_order_id`, `note`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, '00001', NULL, 1, 1, '2022-05-31', NULL, 150.00, 0.00, 50.00, 50.00, 0.00, 0.00, 0.00, 7500.00, 7500.00, 7500.00, 1, 1, NULL, NULL, 'Purchase Product In', 1, 1, NULL, '2022-05-31 07:13:55', '2022-05-31 07:13:55'),
(2, 1, 1, 1, 2, 1, '00002', NULL, 1, 1, '2022-05-31', NULL, 100.00, 0.00, 200.00, 200.00, 0.00, 0.00, 0.00, 20000.00, 20000.00, 20000.00, 1, 1, NULL, NULL, 'Purchase Product In', 1, 1, NULL, '2022-05-31 07:13:55', '2022-05-31 07:13:55'),
(3, 1, 1, 1, 1, 1, '00001', NULL, 3, 2, '2022-05-31', NULL, 10.00, 0.00, 80.00, 50.00, 0.00, 40.00, 0.00, 800.00, 500.00, 840.00, NULL, NULL, 2, 1, 'Sale Product Out', 1, 1, NULL, '2022-05-31 07:24:29', '2022-05-31 07:24:29'),
(4, 1, 1, 1, 1, 1, '00001', NULL, 1, 1, '2022-06-12', NULL, 100.00, 0.00, 50.00, 50.00, 0.00, 0.00, 0.00, 5000.00, 5000.00, 5000.00, 1, 2, NULL, NULL, 'Purchase Product In', 1, 1, NULL, '2022-06-12 06:40:22', '2022-06-12 06:40:22'),
(5, 1, 1, 1, 2, 1, '00002', NULL, 3, 2, '2022-06-14', '546546', 5.00, 0.00, 300.00, 200.00, 0.00, 0.00, 0.00, 1500.00, 1000.00, 1500.00, NULL, NULL, 1, 2, 'Sale Product Out', 1, 1, NULL, '2022-06-14 07:07:40', '2022-06-14 07:07:40'),
(6, 1, 1, 1, 1, 1, '00001', NULL, 3, 2, '2022-06-14', '213313', 5.00, 0.00, 80.00, 50.00, 0.00, 20.00, 0.00, 400.00, 250.00, 420.00, NULL, NULL, 2, 3, 'Sale Product Out', 1, 1, NULL, '2022-06-14 07:08:25', '2022-06-14 07:08:25'),
(7, 1, 1, 1, 1, 1, '00001', NULL, 3, 2, '2022-06-15', NULL, 1.00, 0.00, 80.00, 50.00, 0.00, 4.00, 0.00, 80.00, 50.00, 84.00, NULL, NULL, 1, 4, 'Sale Product Out', 1, 1, NULL, '2022-06-15 06:11:54', '2022-06-15 06:11:54'),
(8, 1, 1, 1, 1, 1, '00001', NULL, 3, 2, '2022-06-15', NULL, 5.00, 0.00, 80.00, 50.00, 0.00, 20.00, 0.00, 400.00, 250.00, 420.00, NULL, NULL, 2, 5, 'Sale Product Out', 1, 1, NULL, '2022-06-15 06:49:37', '2022-06-15 06:49:37'),
(9, 1, 1, 1, 3, 1, '00003', NULL, 1, 1, '2022-06-16', NULL, 100.00, 0.00, 150.00, 150.00, 0.00, 0.00, 0.00, 15000.00, 15000.00, 15000.00, 1, 3, NULL, NULL, 'Purchase Product In', 1, 1, NULL, '2022-06-16 06:41:44', '2022-06-16 06:41:44'),
(10, 1, 1, 1, 1, 1, '00001', NULL, 3, 2, '2022-06-16', NULL, 3.00, 0.00, 80.00, 50.00, 0.00, 12.00, 0.00, 240.00, 150.00, 252.00, NULL, NULL, 1, 6, 'Sale Product Out', 1, 1, NULL, '2022-06-16 12:01:38', '2022-06-16 12:17:21'),
(11, 1, 1, 1, 1, 1, '00001', NULL, 3, 2, '2022-06-16', NULL, 1.00, 0.00, 80.00, 50.00, 0.00, 4.00, 0.00, 80.00, 50.00, 84.00, NULL, NULL, 1, 7, 'Sale Product Out', 1, 1, NULL, '2022-06-16 12:02:40', '2022-06-16 12:02:40'),
(20, 1, 1, 1, 3, 1, '00003', NULL, 3, 2, '2022-06-16', NULL, 1.00, 0.00, 250.00, 150.00, 0.00, 0.00, 0.00, 250.00, 150.00, 250.00, NULL, NULL, 1, 6, 'Sale Product Out', 1, 1, '2022-06-16 12:22:56', '2022-06-16 12:22:40', '2022-06-16 12:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `machine_closings`
--

CREATE TABLE `machine_closings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `photocopy_machine_id` bigint(20) DEFAULT NULL,
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `quantity` double(20,2) DEFAULT 0.00,
  `note` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `update_user_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `machine_closings`
--

INSERT INTO `machine_closings` (`id`, `client_id`, `section_id`, `company_branch_id`, `photocopy_machine_id`, `serial_no`, `date`, `quantity`, `note`, `user_id`, `update_user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 4, 1, '00001', '2022-06-22', 500.00, NULL, 1, 1, 1, NULL, '2022-06-23 03:58:19', '2022-06-23 07:57:32'),
(2, 1, 7, 4, 2, '00002', '2022-06-22', 700.00, NULL, 1, 1, 1, NULL, '2022-06-23 03:58:19', '2022-06-23 07:57:32'),
(3, 1, 7, 4, 1, '00003', '2022-06-23', 3000.00, 'Update note1', 1, 1, 1, NULL, '2022-06-23 04:08:40', '2022-06-23 04:19:24'),
(4, 1, 7, 4, 2, '00004', '2022-06-23', 4000.00, 'Update note2', 1, 1, 1, NULL, '2022-06-23 04:08:40', '2022-06-23 04:19:24');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_08_06_105916_create_warehouses_table', 2),
(5, '2020_08_06_133014_create_banks_table', 3),
(6, '2020_08_06_133407_create_branches_table', 4),
(7, '2020_08_06_133615_create_bank_accounts_table', 5),
(8, '2020_08_06_134846_add_account_name_column_in_bank_accounts_table', 6),
(9, '2020_08_06_143539_create_suppliers_table', 7),
(12, '2020_08_09_122922_create_purchase_products_table', 8),
(17, '2020_08_09_134131_create_purchase_orders_table', 9),
(18, '2020_08_09_134346_create_purchase_order_purchase_product_table', 9),
(19, '2020_08_09_140508_create_purchase_payments_table', 9),
(20, '2020_08_10_135758_create_cashes_table', 10),
(21, '2020_08_10_140052_create_transaction_logs_table', 11),
(22, '2020_08_10_172405_create_mobile_bankings_table', 12),
(39, '2020_08_10_201620_create_purchase_inventories_table', 13),
(40, '2020_08_10_201848_create_purchase_inventory_logs_table', 13),
(41, '2020_08_11_200012_create_sales_orders_table', 13),
(42, '2020_08_11_200835_create_purchase_product_sales_order_table', 13),
(43, '2020_08_11_225945_add_next_payment_date_column_in_sales_orders', 14),
(44, '2020_08_11_234520_create_sale_payments_table', 15),
(45, '2020_08_11_235319_add_sale_payment_id_colunm_in_transaction_logs', 16),
(46, '2020_08_12_144558_add_sales_order_id_column_in_transaction_logs', 17),
(47, '2020_08_12_145752_add_created_by_column_in_sales_orders', 18),
(48, '2020_08_12_204603_create_account_head_types_table', 19),
(49, '2020_08_12_204957_create_account_head_sub_types_table', 20),
(51, '2020_08_12_205408_add_transaction_id_column_in_transaction_logs_table', 22),
(53, '2020_08_12_205711_add_balace_transfer_id_in_transaction_logs_table', 24),
(54, '2020_08_14_234208_create_customers_table', 25),
(55, '2020_08_15_000650_change_customer_in_sales_orders', 26),
(56, '2020_08_15_004254_add_received_by_column_in_sales_orders', 27),
(57, '2020_08_16_214745_add_vat_percentage_in_sales_orders', 1),
(58, '2020_08_18_213532_create_permission_tables', 1),
(59, '2020_08_19_160319_add_column_in_transaction_logs', 1),
(60, '2020_08_22_221720_add_services_columns_in_sales_orders', 1),
(61, '2020_08_22_222401_create_services_table', 1),
(62, '2020_08_24_150722_add_refund_column_in_purchase_orders', 1),
(63, '2020_08_24_204041_add_type_column_in_purchase_payments', 1),
(64, '2020_08_25_214933_add_refund_column_in_sales_orders', 1),
(65, '2020_08_26_114900_add_type_column_in_sale_payments', 1),
(66, '2020_09_14_143319_add_received_type_column_in_sale_payments_table', 1),
(67, '2021_07_28_111953_create_companies_table', 28),
(68, '2019_12_14_000001_create_personal_access_tokens_table', 29),
(69, '2022_02_06_112122_create_permission_tables', 1),
(70, '2022_02_06_125538_create_sections_table', 30),
(71, '2022_02_06_112122_create_permission_tables', 1),
(72, '2022_02_06_161135_create_settings_table', 31),
(73, '2022_02_08_153047_create_user_sections_table', 32),
(75, '2022_02_09_154026_create_product_units_table', 33),
(76, '2022_02_09_161828_create_product_categories_table', 34),
(77, '2022_02_09_192709_create_account_classes_table', 35),
(78, '2022_02_10_123102_create_products_table', 36),
(83, '2022_02_12_155258_create_account_heads_table', 37),
(84, '2022_02_12_155739_create_accounts_table', 37),
(91, '2022_02_13_153935_create_inventory_logs_table', 38),
(92, '2022_02_13_154220_create_clients_table', 38),
(93, '2022_02_13_160555_create_purchase_order_products_table', 38),
(94, '2022_02_13_174259_create_purchase_orders_table', 1),
(95, '2022_02_13_180555_create_purchase_order_products_table', 1),
(100, '2022_02_15_155551_create_sale_orders_table', 39),
(101, '2022_02_15_155739_create_sale_order_products_table', 39),
(102, '2022_03_21_131623_create_company_branches_table', 40),
(103, '2022_02_27_153917_create_designations_table', 41),
(104, '2022_02_28_115237_create_employees_table', 41),
(105, '2022_02_28_123903_create_designation_logs_table', 41),
(106, '2022_02_28_123934_create_salary_logs_table', 41),
(107, '2022_02_28_143840_create_transactions_table', 42),
(108, '2022_03_01_175926_create_salary_processes_table', 42),
(109, '2022_03_01_180128_create_salary_process_details_table', 42),
(110, '2022_03_02_104011_create_years_table', 42),
(111, '2022_03_02_104028_create_months_table', 42),
(112, '2022_03_05_164237_create_attendances_table', 42),
(113, '2022_03_13_121235_create_balance_transfers_table', 43),
(116, '2022_06_09_165539_create_online_information_table', 44),
(117, '2022_06_09_170421_create_online_categories_table', 44),
(122, '2022_06_14_151153_create_price_quotations_table', 45),
(123, '2022_06_14_151729_create_price_quotation_products_table', 45),
(124, '2022_06_14_180931_create_product_brands_table', 46),
(125, '2022_06_18_160644_create_application_types_table', 47),
(126, '2022_06_18_161344_create_online_payment_types_table', 47),
(133, '2022_06_20_111504_create_online_incomes_table', 48),
(134, '2022_06_20_111546_create_online_expenses_table', 48),
(135, '2022_06_21_164311_create_photocopy_machines_table', 49),
(139, '2022_06_22_110410_create_photocopies_table', 50),
(141, '2022_06_22_124641_create_machine_closings_table', 51),
(142, '2022_06_23_131053_create_photocopy_cash_closings_table', 52),
(143, '2022_07_05_114740_create_course_categories_table', 53),
(144, '2022_07_05_121741_create_courses_table', 54),
(146, '2022_07_05_164757_create_teachers_table', 55),
(147, '2022_07_06_130655_create_batches_table', 56),
(148, '2022_07_06_151929_create_students_table', 57),
(149, '2022_07_18_103001_create_student_attendances_table', 58),
(150, '2022_07_20_161706_create_training_sliders_table', 59),
(151, '2022_07_21_155443_create_training_about_us_table', 60),
(152, '2022_07_21_165216_create_training_settings_table', 61),
(153, '2022_07_24_171558_create_training_contact_messages_table', 62),
(154, '2022_07_25_101939_create_training_photo_galleries_table', 63),
(155, '2022_07_25_111156_create_student_results_table', 64);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\User', 1),
(1, 'App\\Models\\User', 2),
(1, 'App\\User', 2),
(1, 'App\\User', 3),
(2, 'App\\Models\\User', 1),
(2, 'App\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\User', 2),
(2, 'App\\User', 3),
(3, 'App\\Models\\User', 1),
(3, 'App\\User', 1),
(3, 'App\\Models\\User', 2),
(3, 'App\\User', 2),
(3, 'App\\User', 3),
(4, 'App\\Models\\User', 1),
(4, 'App\\User', 1),
(4, 'App\\Models\\User', 2),
(4, 'App\\User', 2),
(4, 'App\\User', 3),
(5, 'App\\Models\\User', 1),
(5, 'App\\User', 1),
(5, 'App\\Models\\User', 2),
(5, 'App\\User', 2),
(5, 'App\\User', 3),
(6, 'App\\Models\\User', 1),
(6, 'App\\User', 1),
(6, 'App\\Models\\User', 2),
(6, 'App\\User', 2),
(6, 'App\\User', 3),
(7, 'App\\Models\\User', 1),
(7, 'App\\User', 1),
(7, 'App\\Models\\User', 2),
(7, 'App\\User', 2),
(7, 'App\\User', 3),
(8, 'App\\Models\\User', 1),
(8, 'App\\User', 1),
(8, 'App\\Models\\User', 2),
(8, 'App\\User', 2),
(8, 'App\\User', 3),
(9, 'App\\Models\\User', 1),
(9, 'App\\User', 1),
(9, 'App\\Models\\User', 2),
(9, 'App\\User', 2),
(9, 'App\\User', 3),
(10, 'App\\Models\\User', 1),
(10, 'App\\User', 1),
(10, 'App\\Models\\User', 2),
(10, 'App\\User', 2),
(10, 'App\\User', 3),
(11, 'App\\Models\\User', 1),
(11, 'App\\User', 1),
(11, 'App\\Models\\User', 2),
(11, 'App\\User', 2),
(11, 'App\\User', 3),
(12, 'App\\Models\\User', 1),
(12, 'App\\User', 1),
(12, 'App\\Models\\User', 2),
(12, 'App\\User', 2),
(12, 'App\\User', 3),
(13, 'App\\Models\\User', 1),
(13, 'App\\User', 1),
(13, 'App\\Models\\User', 2),
(13, 'App\\User', 2),
(13, 'App\\User', 3),
(14, 'App\\Models\\User', 1),
(14, 'App\\User', 1),
(14, 'App\\Models\\User', 2),
(14, 'App\\User', 2),
(14, 'App\\User', 3),
(14, 'App\\User', 4),
(14, 'App\\User', 5),
(14, 'App\\User', 6),
(14, 'App\\User', 7),
(14, 'App\\User', 8),
(15, 'App\\Models\\User', 1),
(15, 'App\\User', 1),
(15, 'App\\Models\\User', 2),
(15, 'App\\User', 2),
(15, 'App\\User', 3),
(15, 'App\\User', 5),
(15, 'App\\User', 6),
(15, 'App\\User', 7),
(15, 'App\\User', 8),
(17, 'App\\Models\\User', 1),
(17, 'App\\User', 1),
(17, 'App\\Models\\User', 2),
(17, 'App\\User', 2),
(17, 'App\\User', 3),
(17, 'App\\User', 4),
(17, 'App\\User', 5),
(17, 'App\\User', 6),
(17, 'App\\User', 7),
(17, 'App\\User', 8),
(18, 'App\\Models\\User', 1),
(18, 'App\\User', 1),
(18, 'App\\Models\\User', 2),
(18, 'App\\User', 2),
(18, 'App\\User', 3),
(18, 'App\\User', 4),
(18, 'App\\User', 5),
(18, 'App\\User', 6),
(18, 'App\\User', 7),
(18, 'App\\User', 8),
(19, 'App\\Models\\User', 1),
(19, 'App\\User', 1),
(19, 'App\\Models\\User', 2),
(19, 'App\\User', 2),
(19, 'App\\User', 3),
(20, 'App\\Models\\User', 1),
(20, 'App\\User', 1),
(20, 'App\\Models\\User', 2),
(20, 'App\\User', 2),
(20, 'App\\User', 3),
(21, 'App\\Models\\User', 1),
(21, 'App\\User', 1),
(21, 'App\\Models\\User', 2),
(21, 'App\\User', 2),
(21, 'App\\User', 3),
(22, 'App\\Models\\User', 1),
(22, 'App\\User', 1),
(22, 'App\\Models\\User', 2),
(22, 'App\\User', 2),
(22, 'App\\User', 3),
(23, 'App\\Models\\User', 1),
(23, 'App\\User', 1),
(23, 'App\\Models\\User', 2),
(23, 'App\\User', 2),
(23, 'App\\User', 3),
(24, 'App\\Models\\User', 1),
(24, 'App\\User', 1),
(24, 'App\\Models\\User', 2),
(24, 'App\\User', 2),
(24, 'App\\User', 3),
(25, 'App\\Models\\User', 1),
(25, 'App\\User', 1),
(25, 'App\\Models\\User', 2),
(25, 'App\\User', 2),
(25, 'App\\User', 3),
(26, 'App\\Models\\User', 1),
(26, 'App\\User', 1),
(26, 'App\\Models\\User', 2),
(26, 'App\\User', 2),
(26, 'App\\User', 3),
(27, 'App\\Models\\User', 1),
(27, 'App\\User', 1),
(27, 'App\\Models\\User', 2),
(27, 'App\\User', 2),
(27, 'App\\User', 3),
(28, 'App\\Models\\User', 1),
(28, 'App\\User', 1),
(28, 'App\\Models\\User', 2),
(28, 'App\\User', 2),
(28, 'App\\User', 3),
(29, 'App\\Models\\User', 1),
(29, 'App\\User', 1),
(29, 'App\\Models\\User', 2),
(29, 'App\\User', 2),
(29, 'App\\User', 3),
(30, 'App\\Models\\User', 1),
(30, 'App\\User', 1),
(30, 'App\\Models\\User', 2),
(30, 'App\\User', 2),
(30, 'App\\User', 3),
(31, 'App\\Models\\User', 1),
(31, 'App\\User', 1),
(31, 'App\\Models\\User', 2),
(31, 'App\\User', 2),
(31, 'App\\User', 3),
(32, 'App\\Models\\User', 1),
(32, 'App\\User', 1),
(32, 'App\\Models\\User', 2),
(32, 'App\\User', 2),
(32, 'App\\User', 3),
(33, 'App\\Models\\User', 1),
(33, 'App\\User', 1),
(33, 'App\\Models\\User', 2),
(33, 'App\\User', 2),
(33, 'App\\User', 3),
(34, 'App\\Models\\User', 1),
(34, 'App\\User', 1),
(34, 'App\\Models\\User', 2),
(34, 'App\\User', 2),
(34, 'App\\User', 3),
(35, 'App\\Models\\User', 1),
(35, 'App\\User', 1),
(35, 'App\\Models\\User', 2),
(35, 'App\\User', 2),
(36, 'App\\Models\\User', 1),
(36, 'App\\User', 1),
(36, 'App\\Models\\User', 2),
(36, 'App\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE `months` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `months`
--

INSERT INTO `months` (`id`, `name`, `full_name`, `short_name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '01', 'January', 'Jan', 1, NULL, '2022-03-03 05:22:23', '2022-03-03 05:22:23'),
(2, '02', 'February', 'Feb', 1, NULL, '2022-03-03 05:22:23', '2022-03-03 05:22:23'),
(3, '03', 'March', 'Mar', 1, NULL, '2022-03-03 05:22:23', '2022-03-03 05:22:23'),
(4, '04', 'April', 'Apr', 1, NULL, '2022-03-03 05:22:23', '2022-03-03 05:22:23'),
(5, '05', 'May', 'May', 1, NULL, '2022-03-03 05:22:23', '2022-03-03 05:22:23'),
(6, '06', 'June', 'Jun', 1, NULL, '2022-03-03 05:22:23', '2022-03-03 05:22:23'),
(7, '07', 'July', 'Jul', 1, NULL, '2022-03-03 05:22:23', '2022-03-03 05:22:23'),
(8, '08', 'August', 'Aug', 1, NULL, '2022-03-03 05:22:23', '2022-03-03 05:22:23'),
(9, '09', 'September', 'Sep', 1, NULL, '2022-03-03 05:22:24', '2022-03-03 05:22:24'),
(10, '10', 'October', 'Oct', 1, NULL, '2022-03-03 05:22:24', '2022-03-03 05:22:24'),
(11, '11', 'November', 'Nov', 1, NULL, '2022-03-03 05:22:24', '2022-03-03 05:22:24'),
(12, '12', 'December', 'Dec', 1, NULL, '2022-03-03 05:22:24', '2022-03-03 05:22:24');

-- --------------------------------------------------------

--
-- Table structure for table `online_categories`
--

CREATE TABLE `online_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `online_categories`
--

INSERT INTO `online_categories` (`id`, `client_id`, `section_id`, `name`, `description`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 'Job Application', 'Testing', NULL, 1, NULL, '2022-06-09 12:05:15', '2022-06-18 10:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `online_expenses`
--

CREATE TABLE `online_expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `account_head_id` bigint(20) UNSIGNED DEFAULT NULL,
  `account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `payment_method` bigint(20) DEFAULT NULL,
  `bank_id` bigint(20) DEFAULT NULL,
  `quantity` double(20,2) NOT NULL DEFAULT 0.00,
  `amount` double(20,2) NOT NULL DEFAULT 0.00,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `online_expenses`
--

INSERT INTO `online_expenses` (`id`, `client_id`, `section_id`, `company_branch_id`, `account_head_id`, `account_id`, `serial_no`, `date`, `payment_method`, `bank_id`, `quantity`, `amount`, `note`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 3, 102, 102, '00001', '2022-06-20', 1, NULL, 2.00, 100.00, 'Testing', 1, 1, NULL, '2022-06-20 09:13:04', '2022-06-20 10:23:37'),
(2, 1, 7, 4, 102, 102, '00002', '2022-06-25', 1, NULL, 1.00, 200.00, 'Test', 1, 1, NULL, '2022-06-25 07:08:41', '2022-06-25 07:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `online_incomes`
--

CREATE TABLE `online_incomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `account_head_id` bigint(20) UNSIGNED DEFAULT NULL,
  `account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` tinyint(4) DEFAULT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `quantity` double(20,2) NOT NULL DEFAULT 0.00,
  `amount` double(20,2) NOT NULL DEFAULT 0.00,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `online_incomes`
--

INSERT INTO `online_incomes` (`id`, `client_id`, `section_id`, `company_branch_id`, `account_head_id`, `account_id`, `serial_no`, `payment_method`, `bank_id`, `date`, `quantity`, `amount`, `note`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 3, 101, 101, '00001', 1, NULL, '2022-06-20', 5.00, 1200.00, NULL, 1, 1, NULL, '2022-06-20 07:18:06', '2022-06-20 12:34:39'),
(2, 1, 6, 4, 101, 101, '00002', 1, NULL, '2022-06-25', 5.00, 300.00, NULL, 1, 1, NULL, '2022-06-25 07:05:38', '2022-06-25 07:05:38'),
(3, 1, 7, 4, 101, 101, '00003', 1, NULL, '2022-06-25', 2.00, 100.00, NULL, 1, 1, NULL, '2022-06-25 07:07:54', '2022-06-25 07:07:54');

-- --------------------------------------------------------

--
-- Table structure for table `online_information`
--

CREATE TABLE `online_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `online_category_id` bigint(20) DEFAULT NULL,
  `application_type_id` int(11) DEFAULT NULL,
  `online_payment_type_id` int(11) DEFAULT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` tinyint(4) DEFAULT NULL COMMENT '1=Cash In Hand, 2=Bank',
  `bank_id` int(11) DEFAULT NULL,
  `quantity` double(20,2) NOT NULL DEFAULT 0.00,
  `total` double(20,2) DEFAULT 0.00,
  `paid` double(20,2) DEFAULT 0.00,
  `due` double(20,2) DEFAULT 0.00,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee_payment` tinyint(4) NOT NULL DEFAULT 0,
  `fee_payment_paid` double(20,2) NOT NULL DEFAULT 0.00,
  `fee_payment_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee_payment_date` date DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `online_information`
--

INSERT INTO `online_information` (`id`, `client_id`, `section_id`, `company_branch_id`, `online_category_id`, `application_type_id`, `online_payment_type_id`, `customer_id`, `serial_no`, `date`, `name`, `mobile_no`, `nid_no`, `user`, `pin`, `password`, `payment_method`, `bank_id`, `quantity`, `total`, `paid`, `due`, `note`, `fee_payment`, `fee_payment_paid`, `fee_payment_note`, `fee_payment_date`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 1, 1, NULL, NULL, 1, '00001', '2022-06-12', 'Rokon', '01729890904', '325664564', 'rokon', '1234', '123456', 1, NULL, 0.00, 100.00, 100.00, 0.00, 'test', 0, 0.00, NULL, NULL, NULL, 1, NULL, '2022-06-11 11:58:56', '2022-06-19 06:34:42'),
(2, 1, 6, 1, 1, NULL, NULL, 1, '00002', '2022-06-12', 'Al Arfin', '01729890904', '365426', 'alarfin', '1234', '12345678', 2, 1, 0.00, 150.00, 100.00, 50.00, 'Note here', 0, 0.00, NULL, NULL, NULL, 1, NULL, '2022-06-12 04:23:53', '2022-06-12 06:20:21'),
(3, 1, 6, 3, 1, 1, NULL, 8, '00003', '2022-06-19', NULL, NULL, NULL, 'Test1', '1234', '123456', 1, NULL, 2.00, 1000.00, 700.00, 300.00, 'note here', 1, 800.00, 'Testing note', '2022-06-19', 1, 1, NULL, '2022-06-18 12:06:07', '2022-07-18 04:31:50'),
(4, 1, 6, 3, 1, 1, 1, 3, '00004', '2022-06-19', NULL, NULL, NULL, 'alarfin', '124536', '12345678', 1, NULL, 1.00, 600.00, 600.00, 0.00, NULL, 1, 500.00, 'fee payment note', '2022-06-19', 1, 1, NULL, '2022-06-19 10:54:14', '2022-06-19 10:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `online_payment_types`
--

CREATE TABLE `online_payment_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `online_payment_types`
--

INSERT INTO `online_payment_types` (`id`, `client_id`, `section_id`, `company_branch_id`, `name`, `description`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 6, NULL, 'Bkash', 'Testing', 1, 1, NULL, '2022-06-18 10:57:43', '2022-06-18 11:06:49');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'web', '2020-08-18 15:41:49', '2020-08-18 15:41:49'),
(2, 'warehouse', 'web', '2020-08-18 15:41:59', '2020-08-18 15:41:59'),
(3, 'bank_and_account', 'web', '2020-08-18 15:42:10', '2020-08-18 15:42:10'),
(4, 'bank', 'web', '2020-08-18 15:42:21', '2020-08-18 15:42:21'),
(5, 'branch', 'web', '2020-08-18 15:42:29', '2020-08-18 15:42:29'),
(6, 'account', 'web', '2020-08-18 15:43:01', '2020-08-18 15:43:01'),
(7, 'purchase', 'web', '2020-08-18 15:43:11', '2020-08-18 15:43:11'),
(8, 'supplier', 'web', '2020-08-18 15:43:29', '2020-08-18 15:43:29'),
(9, 'purchase_product', 'web', '2020-08-18 15:43:36', '2020-08-18 15:43:36'),
(10, 'purchase_order', 'web', '2020-08-18 15:43:53', '2020-08-18 15:43:53'),
(11, 'purchase_receipt', 'web', '2020-08-18 15:44:02', '2020-08-18 15:44:02'),
(12, 'purchase_inventory', 'web', '2020-08-18 15:44:11', '2020-08-18 15:44:11'),
(13, 'supplier_payment', 'web', '2020-08-18 15:44:31', '2020-08-18 15:44:31'),
(14, 'sale', 'web', '2020-08-18 15:44:41', '2020-08-18 15:44:41'),
(15, 'customer', 'web', '2020-08-18 15:44:49', '2020-08-18 15:44:49'),
(16, 'sale_product', 'web', '2020-08-18 15:45:05', '2020-08-18 15:45:05'),
(17, 'sales_order', 'web', '2020-08-18 15:45:13', '2020-08-18 15:45:13'),
(18, 'sale_receipt', 'web', '2020-08-18 15:45:24', '2020-08-18 15:45:24'),
(19, 'product_sale_information', 'web', '2020-08-18 15:45:46', '2020-08-18 15:45:46'),
(20, 'customer_payment', 'web', '2020-08-18 15:45:54', '2020-08-18 15:45:54'),
(21, 'accounts', 'web', '2020-08-18 15:46:04', '2020-08-18 15:46:04'),
(22, 'account_head_type', 'web', '2020-08-18 15:46:11', '2020-08-18 15:46:11'),
(23, 'account_head_sub_type', 'web', '2020-08-18 15:46:19', '2020-08-18 15:46:19'),
(24, 'transaction', 'web', '2020-08-18 15:46:27', '2020-08-18 15:46:27'),
(25, 'balance_transfer', 'web', '2020-08-18 15:46:34', '2020-08-18 15:46:34'),
(26, 'report', 'web', '2020-08-18 15:46:42', '2020-08-18 15:46:42'),
(27, 'purchase_report', 'web', '2020-08-18 15:46:50', '2020-08-18 15:46:50'),
(28, 'sale_report', 'web', '2020-08-18 15:46:58', '2020-08-18 15:46:58'),
(29, 'user_management', 'web', '2020-08-18 15:47:17', '2020-08-18 15:47:17'),
(30, 'users', 'web', '2020-08-18 15:47:24', '2020-08-18 15:47:24'),
(31, 'balance_sheet', 'web', '2020-08-19 14:44:58', '2020-08-19 14:44:58'),
(32, 'profit_and_loss', 'web', '2020-08-19 14:45:12', '2020-08-19 14:45:12'),
(33, 'ledger', 'web', '2020-08-19 14:45:24', '2020-08-19 14:45:24'),
(34, 'transaction_report', 'web', '2020-09-02 11:23:54', '2020-09-02 11:23:54'),
(35, 'company', 'web', '2020-08-18 15:41:49', '2020-08-18 15:41:49'),
(36, 'dashboard', 'web', '2020-08-18 15:41:49', '2020-08-18 15:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photocopies`
--

CREATE TABLE `photocopies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` tinyint(4) DEFAULT NULL,
  `bank_id` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `quantity` double(20,2) DEFAULT 0.00,
  `amount` double(20,2) DEFAULT 0.00,
  `extra_entry` tinyint(4) NOT NULL DEFAULT 0,
  `user_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photocopies`
--

INSERT INTO `photocopies` (`id`, `client_id`, `section_id`, `company_branch_id`, `customer_id`, `serial_no`, `payment_method`, `bank_id`, `date`, `quantity`, `amount`, `extra_entry`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 4, 1, '00001', 1, NULL, '2022-06-22', 50.00, 90.00, 0, 1, 1, NULL, '2022-06-22 06:09:54', '2022-06-22 06:20:22'),
(2, 1, 7, 4, 9, '00002', 1, NULL, '2022-06-22', 1155.00, 10.00, 1, 1, 1, NULL, '2022-06-23 10:31:09', '2022-06-23 10:31:09'),
(3, 1, 7, 4, 2, '00003', 1, NULL, '2022-06-26', 300.00, 600.00, 0, 1, 1, NULL, '2022-06-26 07:08:37', '2022-06-26 07:08:37');

-- --------------------------------------------------------

--
-- Table structure for table `photocopy_cash_closings`
--

CREATE TABLE `photocopy_cash_closings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` double(20,2) DEFAULT 0.00,
  `note` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `update_user_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photocopy_cash_closings`
--

INSERT INTO `photocopy_cash_closings` (`id`, `client_id`, `section_id`, `company_branch_id`, `serial_no`, `date`, `amount`, `note`, `user_id`, `update_user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 4, '00001', '2022-06-22', 100.00, 'Cash entry', 1, 1, 1, NULL, '2022-06-23 08:26:32', '2022-06-23 08:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `photocopy_machines`
--

CREATE TABLE `photocopy_machines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photocopy_machines`
--

INSERT INTO `photocopy_machines` (`id`, `client_id`, `section_id`, `company_branch_id`, `name`, `description`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 4, 'Machine1', 'Machine Update', 1, 1, NULL, '2022-06-21 10:55:13', '2022-06-22 09:18:35'),
(2, 1, 7, 4, 'Machine2', 'Testing', 1, 1, NULL, '2022-06-21 10:55:39', '2022-06-22 09:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `price_quotations`
--

CREATE TABLE `price_quotations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `section_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `company_branch_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `payment_method` tinyint(4) DEFAULT NULL COMMENT '1=Cashb In Hand, 2=Bank',
  `product_discount` double(20,2) DEFAULT 0.00,
  `discount` double(20,2) DEFAULT 0.00,
  `total_discount` double(20,2) DEFAULT 0.00,
  `tax` double(20,2) DEFAULT 0.00,
  `vat` double(20,2) DEFAULT 0.00,
  `product_sub_total` double(20,2) DEFAULT 0.00,
  `sub_total` double(20,2) DEFAULT 0.00,
  `total` double(20,2) DEFAULT 0.00,
  `paid` double(20,2) DEFAULT 0.00,
  `due` double(20,2) DEFAULT 0.00,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delete_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_quotations`
--

INSERT INTO `price_quotations` (`id`, `client_id`, `section_id`, `company_branch_id`, `invoice_no`, `customer_id`, `date`, `payment_method`, `product_discount`, `discount`, `total_discount`, `tax`, `vat`, `product_sub_total`, `sub_total`, `total`, `paid`, `due`, `note`, `user_id`, `delete_user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '00001', 3, '2022-06-16', NULL, 0.00, 0.00, 0.00, 80.00, 0.00, 6100.00, 6180.00, 6180.00, 0.00, 6180.00, NULL, 1, 1, NULL, '2022-06-14 09:59:34', '2022-06-16 11:06:14');

-- --------------------------------------------------------

--
-- Table structure for table `price_quotation_products`
--

CREATE TABLE `price_quotation_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price_quotation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `inventory_log_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_discount` double(20,2) DEFAULT 0.00,
  `discount` double(20,2) DEFAULT 0.00,
  `quantity` double(20,2) DEFAULT 0.00,
  `unit_price` double(20,2) DEFAULT 0.00,
  `buy_price` double(20,2) DEFAULT 0.00,
  `tax` double(20,2) DEFAULT 0.00,
  `tax_percentage` double(20,2) NOT NULL DEFAULT 0.00,
  `vat` double(20,2) DEFAULT 0.00,
  `vat_percentage` double(20,2) DEFAULT 0.00,
  `product_total` double(20,2) DEFAULT 0.00,
  `buy_total` double(20,2) DEFAULT 0.00,
  `total` double(20,2) DEFAULT 0.00,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_quotation_products`
--

INSERT INTO `price_quotation_products` (`id`, `client_id`, `section_id`, `company_branch_id`, `price_quotation_id`, `customer_id`, `product_id`, `product_category_id`, `inventory_log_id`, `date`, `name`, `code`, `warranty`, `guarantee`, `serial_no`, `product_discount`, `discount`, `quantity`, `unit_price`, `buy_price`, `tax`, `tax_percentage`, `vat`, `vat_percentage`, `product_total`, `buy_total`, `total`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 3, 1, 1, NULL, '2022-06-16', 'Cable IPhone', '00001', '5 Year', '1 Year', NULL, 0.00, 0.00, 20.00, 80.00, 50.00, 80.00, 5.00, 0.00, 0.00, 1600.00, 1600.00, 1680.00, 1, 1, NULL, '2022-06-14 09:59:34', '2022-06-16 11:04:58'),
(2, 1, 1, 1, 1, 3, 2, 1, NULL, '2022-06-16', 'Cable Micro', '00002', NULL, NULL, NULL, 0.00, 0.00, 15.00, 300.00, 200.00, 0.00, 0.00, 0.00, 0.00, 4500.00, 4500.00, 4500.00, 1, 1, NULL, '2022-06-14 09:59:34', '2022-06-16 11:06:14');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
  `product_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_brand_id` bigint(20) DEFAULT NULL,
  `product_unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buy_price` double(20,2) DEFAULT 0.00,
  `sale_price` double(20,2) DEFAULT 0.00,
  `whole_sale_price` double(20,2) DEFAULT 0.00,
  `tax` double(20,2) DEFAULT 0.00,
  `vat` double(20,2) DEFAULT 0.00,
  `minimum_alert` double(20,2) DEFAULT 0.00,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `client_id`, `product_category_id`, `product_brand_id`, `product_unit_id`, `name`, `code`, `buy_price`, `sale_price`, `whole_sale_price`, `tax`, `vat`, `minimum_alert`, `image`, `warranty`, `guarantee`, `description`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 1, 'Cable IPhone', '00001', 50.00, 80.00, 700.00, 5.00, 0.00, 50.00, NULL, '5 Year', '1 Year', 'cable IPhone 1M, 2A', 1, 1, NULL, '2022-02-10 09:56:51', '2022-06-15 04:38:47'),
(2, 1, 1, NULL, 1, 'Cable Micro', '00002', 200.00, 300.00, 250.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, 1, 1, NULL, '2022-02-15 06:23:24', '2022-02-15 06:23:24'),
(3, 1, 1, 1, 1, 'Computer Mouse', '00003', 150.00, 250.00, 240.00, 0.00, 0.00, 0.00, NULL, '6 Month', NULL, NULL, 1, 1, NULL, '2022-06-16 06:40:38', '2022-06-16 06:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `product_brands`
--

CREATE TABLE `product_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_brands`
--

INSERT INTO `product_brands` (`id`, `client_id`, `name`, `description`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Samsung', 'Description here', 1, 1, NULL, '2022-06-14 12:26:54', '2022-06-14 12:27:14');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `client_id`, `name`, `description`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Stationary', 'Description here', 1, 1, NULL, '2022-02-09 10:32:57', '2022-02-09 10:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_units`
--

CREATE TABLE `product_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_units`
--

INSERT INTO `product_units` (`id`, `client_id`, `name`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'pcs', 1, 1, NULL, '2022-02-13 07:17:10', '2022-02-13 07:17:57');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
  `section_id` int(15) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `invoice_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_id` int(15) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `payment_method` tinyint(4) DEFAULT NULL COMMENT '1=Cash In Hand, 2=Bank',
  `discount` double(20,2) NOT NULL DEFAULT 0.00,
  `sub_total` double(20,2) NOT NULL DEFAULT 0.00,
  `return_total` double(20,2) NOT NULL DEFAULT 0.00,
  `total` double(20,2) NOT NULL,
  `paid` double(20,2) NOT NULL,
  `due` double(20,2) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(15) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `client_id`, `section_id`, `company_branch_id`, `invoice_no`, `supplier_id`, `date`, `payment_method`, `discount`, `sub_total`, `return_total`, `total`, `paid`, `due`, `note`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '00001', 1, '2022-05-31', 1, 0.00, 27500.00, 0.00, 27500.00, 7500.00, 20000.00, 'Test', 1, 1, NULL, '2022-05-31 07:13:55', '2022-06-05 07:01:20'),
(2, 1, 1, 1, '00002', 1, '2022-06-12', 1, 0.00, 5000.00, 0.00, 5000.00, 0.00, 5000.00, 'test', 1, 1, NULL, '2022-06-12 06:40:22', '2022-06-12 06:40:22'),
(3, 1, 1, 1, '00003', 1, '2022-06-16', 2, 0.00, 15000.00, 0.00, 15000.00, 0.00, 15000.00, NULL, 1, 1, NULL, '2022-06-16 06:41:44', '2022-06-16 06:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_products`
--

CREATE TABLE `purchase_order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `purchase_order_id` int(15) DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_category_id` int(15) DEFAULT NULL,
  `inventory_log_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` double(20,2) NOT NULL DEFAULT 0.00,
  `serial_no` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` double(20,2) DEFAULT 1.00,
  `return_quantity` double(20,2) NOT NULL DEFAULT 0.00,
  `return_at` timestamp NULL DEFAULT NULL,
  `unit_price` double(20,2) DEFAULT 1.00,
  `product_total` double(20,2) NOT NULL DEFAULT 0.00,
  `return_total` double(20,2) NOT NULL DEFAULT 0.00,
  `total` double(20,2) DEFAULT 1.00,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_products`
--

INSERT INTO `purchase_order_products` (`id`, `client_id`, `section_id`, `company_branch_id`, `purchase_order_id`, `supplier_id`, `product_id`, `product_category_id`, `inventory_log_id`, `date`, `name`, `code`, `discount`, `serial_no`, `quantity`, `return_quantity`, `return_at`, `unit_price`, `product_total`, `return_total`, `total`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, '2022-05-31', 'Cable IPhone', '00001', 0.00, NULL, 150.00, 0.00, NULL, 50.00, 7500.00, 0.00, 7500.00, 1, 1, NULL, '2022-05-31 07:13:55', '2022-05-31 07:13:55'),
(2, 1, 1, 1, 1, 1, 2, 1, 2, '2022-05-31', 'Cable Micro', '00002', 0.00, NULL, 100.00, 0.00, NULL, 200.00, 20000.00, 0.00, 20000.00, 1, 1, NULL, '2022-05-31 07:13:55', '2022-05-31 07:13:55'),
(3, 1, 1, 1, 2, 1, 1, 1, 4, '2022-06-12', 'Cable IPhone', '00001', 0.00, '3214234,1243214', 100.00, 0.00, NULL, 50.00, 5000.00, 0.00, 5000.00, 1, 1, NULL, '2022-06-12 06:40:22', '2022-06-14 06:39:43'),
(4, 1, 1, 1, 3, 1, 3, 1, 9, '2022-06-16', 'Computer Mouse', '00003', 0.00, NULL, 100.00, 0.00, NULL, 150.00, 15000.00, 0.00, 15000.00, 1, 1, NULL, '2022-06-16 06:41:44', '2022-06-16 06:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_logs`
--

CREATE TABLE `salary_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(700) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1=promotion,2=increment,3=performance,4=decrement,5=other',
  `date` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salary_logs`
--

INSERT INTO `salary_logs` (`id`, `client_id`, `employee_id`, `note`, `type`, `date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 'Joining', '3', '2022-03-21', NULL, '2022-03-21 11:21:00', '2022-03-21 11:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `salary_processes`
--

CREATE TABLE `salary_processes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `salary_process_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` tinyint(4) DEFAULT NULL COMMENT '1=Cash In hand, 2=Bank',
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total` double(20,6) DEFAULT 0.000000,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delete_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salary_processes`
--

INSERT INTO `salary_processes` (`id`, `client_id`, `section_id`, `company_branch_id`, `salary_process_no`, `date`, `month`, `year`, `payment_method`, `bank_id`, `total`, `status`, `user_id`, `delete_user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '00001', '2022-03-24', '01', '2022', 2, 1, 15000.000000, 1, 1, NULL, NULL, '2022-03-24 05:45:57', '2022-03-24 05:45:57');

-- --------------------------------------------------------

--
-- Table structure for table `salary_process_details`
--

CREATE TABLE `salary_process_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `salary_process_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` tinyint(4) DEFAULT NULL COMMENT '1=Cash In hand, 2=Bank',
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `month_days` double(20,6) DEFAULT 0.000000,
  `leave_days` double(20,6) DEFAULT 0.000000,
  `absent_days` double(20,6) DEFAULT 0.000000,
  `payble_days` double(20,6) DEFAULT 0.000000,
  `salary` double(20,6) DEFAULT 0.000000,
  `others_addition` double(20,6) DEFAULT 0.000000,
  `absent_deduct` double(20,6) DEFAULT 0.000000,
  `others_deduct` double(20,6) DEFAULT 0.000000,
  `per_day_salary` double(20,6) DEFAULT 0.000000,
  `net_salary` double(20,6) DEFAULT 0.000000,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salary_process_details`
--

INSERT INTO `salary_process_details` (`id`, `client_id`, `section_id`, `company_branch_id`, `salary_process_id`, `employee_id`, `date`, `month`, `year`, `payment_method`, `bank_id`, `month_days`, `leave_days`, `absent_days`, `payble_days`, `salary`, `others_addition`, `absent_deduct`, `others_deduct`, `per_day_salary`, `net_salary`, `status`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, '2022-03-24', '01', '2022', 2, 1, 31.000000, 0.000000, 0.000000, 31.000000, 15000.000000, 0.000000, 0.000000, 0.000000, 483.870968, 15000.000000, 1, 1, NULL, '2022-03-24 05:45:57', '2022-03-24 05:45:57');

-- --------------------------------------------------------

--
-- Table structure for table `sale_orders`
--

CREATE TABLE `sale_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `section_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `payment_method` tinyint(4) DEFAULT NULL COMMENT '1=Cashb In Hand, 2=Bank',
  `product_discount` double(20,2) DEFAULT 0.00,
  `discount` double(20,2) DEFAULT 0.00,
  `total_discount` double(20,2) DEFAULT 0.00,
  `tax` double(20,2) DEFAULT 0.00,
  `vat` double(20,2) DEFAULT 0.00,
  `product_sub_total` double(20,2) DEFAULT 0.00,
  `sub_total` double(20,2) DEFAULT 0.00,
  `return_total` double(20,2) NOT NULL DEFAULT 0.00,
  `total` double(20,2) DEFAULT 0.00,
  `paid` double(20,2) DEFAULT 0.00,
  `due` double(20,2) DEFAULT 0.00,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delete_user_id` int(15) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_orders`
--

INSERT INTO `sale_orders` (`id`, `client_id`, `section_id`, `company_branch_id`, `invoice_no`, `customer_id`, `date`, `payment_method`, `product_discount`, `discount`, `total_discount`, `tax`, `vat`, `product_sub_total`, `sub_total`, `return_total`, `total`, `paid`, `due`, `note`, `user_id`, `delete_user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '00001', 2, '2022-05-31', 1, 0.00, 40.00, 40.00, 40.00, 0.00, 800.00, 840.00, 0.00, 800.00, 500.00, 300.00, NULL, 1, NULL, NULL, '2022-05-31 07:24:29', '2022-05-31 07:24:29'),
(2, 1, 1, 1, '00002', 1, '2022-06-14', 1, 0.00, 0.00, 0.00, 0.00, 0.00, 1500.00, 1500.00, 0.00, 1500.00, 1500.00, 0.00, NULL, 1, NULL, NULL, '2022-06-14 07:07:39', '2022-06-14 07:07:40'),
(3, 1, 1, 1, '00003', 2, '2022-06-14', 1, 0.00, 0.00, 0.00, 20.00, 0.00, 400.00, 420.00, 0.00, 420.00, 420.00, 0.00, NULL, 1, NULL, NULL, '2022-06-14 07:08:25', '2022-06-14 07:08:25'),
(4, 1, 1, 1, '00004', 1, '2022-06-16', 1, 0.00, 0.00, 0.00, 4.00, 0.00, 80.00, 84.00, 0.00, 84.00, 84.00, 0.00, NULL, 1, NULL, NULL, '2022-06-15 06:11:54', '2022-06-16 12:06:02'),
(5, 1, 1, 1, '00005', 2, '2022-06-15', 1, 0.00, 0.00, 0.00, 20.00, 0.00, 400.00, 420.00, 0.00, 420.00, 0.00, 420.00, NULL, 1, NULL, NULL, '2022-06-15 06:49:37', '2022-06-15 06:49:37'),
(6, 1, 1, 1, NULL, 1, '2022-06-16', 1, 0.00, 0.00, 0.00, 12.00, 0.00, 240.00, 252.00, 0.00, 252.00, 0.00, 252.00, NULL, NULL, NULL, NULL, '2022-06-16 12:01:38', '2022-06-16 12:22:56'),
(7, 1, 1, 1, NULL, 1, '2022-06-16', 1, 0.00, 0.00, 0.00, 8.00, 0.00, 160.00, 168.00, 0.00, 168.00, 0.00, 168.00, NULL, NULL, NULL, NULL, '2022-06-16 12:02:40', '2022-06-16 12:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `sale_order_products`
--

CREATE TABLE `sale_order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `sale_order_id` int(15) DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `inventory_log_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_discount` double(20,2) DEFAULT 0.00,
  `discount` double(20,2) DEFAULT 0.00,
  `serial_no` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` double(20,2) DEFAULT 0.00,
  `return_quantity` double(20,2) NOT NULL DEFAULT 0.00,
  `return_at` timestamp NULL DEFAULT NULL,
  `unit_price` double(20,2) DEFAULT 0.00,
  `buy_price` double(20,2) DEFAULT 0.00,
  `tax` double(20,2) DEFAULT 0.00,
  `tax_percentage` double(20,2) NOT NULL DEFAULT 0.00,
  `vat` double(20,2) DEFAULT 0.00,
  `vat_percentage` double(20,2) NOT NULL DEFAULT 0.00,
  `product_total` double(20,2) DEFAULT 0.00,
  `return_total` double(20,2) NOT NULL DEFAULT 0.00,
  `buy_total` double(20,2) DEFAULT 0.00,
  `total` double(20,2) DEFAULT 0.00,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_order_products`
--

INSERT INTO `sale_order_products` (`id`, `client_id`, `section_id`, `company_branch_id`, `sale_order_id`, `customer_id`, `product_id`, `product_category_id`, `inventory_log_id`, `date`, `name`, `code`, `warranty`, `guarantee`, `product_discount`, `discount`, `serial_no`, `quantity`, `return_quantity`, `return_at`, `unit_price`, `buy_price`, `tax`, `tax_percentage`, `vat`, `vat_percentage`, `product_total`, `return_total`, `buy_total`, `total`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 2, 1, 1, 3, '2022-05-31', 'Cable IPhone', '00001', NULL, NULL, 0.00, 40.00, NULL, 10.00, 0.00, NULL, 80.00, 50.00, 40.00, 5.00, 0.00, 0.00, 800.00, 0.00, 800.00, 800.00, 1, 1, NULL, '2022-05-31 07:24:29', '2022-05-31 07:24:29'),
(2, 1, 1, 1, 2, 1, 2, 1, 5, '2022-06-14', 'Cable Micro', '00002', NULL, NULL, 0.00, 0.00, '546546', 5.00, 0.00, NULL, 300.00, 200.00, 0.00, 0.00, 0.00, 0.00, 1500.00, 0.00, 1500.00, 1500.00, 1, 1, NULL, '2022-06-14 07:07:40', '2022-06-14 07:07:40'),
(3, 1, 1, 1, 3, 2, 1, 1, 6, '2022-06-14', 'Cable IPhone', '00001', '5 Year', '1 Year', 0.00, 0.00, '213313', 5.00, 0.00, NULL, 80.00, 50.00, 20.00, 5.00, 0.00, 0.00, 400.00, 0.00, 400.00, 420.00, 1, 1, NULL, '2022-06-14 07:08:25', '2022-06-14 07:08:25'),
(4, 1, 1, 1, 4, 1, 1, 1, 7, '2022-06-15', 'Cable IPhone', '00001', '5 Year', '1 Year', 0.00, 0.00, NULL, 1.00, 0.00, NULL, 80.00, 50.00, 4.00, 5.00, 0.00, 0.00, 80.00, 0.00, 80.00, 84.00, 1, 1, NULL, '2022-06-15 06:11:54', '2022-06-15 06:11:54'),
(5, 1, 1, 1, 5, 2, 1, 1, 8, '2022-06-15', 'Cable IPhone', '00001', '5 Year', '1 Year', 0.00, 0.00, NULL, 5.00, 0.00, NULL, 80.00, 50.00, 20.00, 5.00, 0.00, 0.00, 400.00, 0.00, 250.00, 420.00, 1, 1, NULL, '2022-06-15 06:49:37', '2022-06-15 06:49:37'),
(6, 1, 1, 1, 6, 1, 1, 1, 10, '2022-06-16', 'Cable IPhone', '00001', '5 Year', '1 Year', 0.00, 0.00, NULL, 3.00, 0.00, NULL, 80.00, 50.00, 12.00, 5.00, 0.00, 0.00, 240.00, 0.00, 150.00, 252.00, 1, 1, NULL, '2022-06-16 12:01:38', '2022-06-16 12:14:58'),
(7, 1, 1, 1, 7, 1, 1, 1, 11, '2022-06-16', 'Cable IPhone', '00001', '5 Year', '1 Year', 0.00, 0.00, NULL, 2.00, 0.00, NULL, 80.00, 50.00, 8.00, 5.00, 0.00, 0.00, 160.00, 0.00, 100.00, 168.00, 1, 1, NULL, '2022-06-16 12:02:40', '2022-06-16 12:13:37'),
(12, 1, 1, 1, 6, 1, 3, 1, 19, '2022-06-16', 'Computer Mouse', '00003', '6 Month', NULL, 0.00, 0.00, NULL, 1.00, 0.00, NULL, 250.00, 150.00, 0.00, 0.00, 0.00, 0.00, 250.00, 0.00, 150.00, 250.00, 1, 1, '2022-06-16 12:19:00', '2022-06-16 12:18:27', '2022-06-16 12:19:00'),
(13, 1, 1, 1, 6, 1, 3, 1, 20, '2022-06-16', 'Computer Mouse', '00003', '6 Month', NULL, 0.00, 0.00, NULL, 1.00, 0.00, NULL, 250.00, 150.00, 0.00, 0.00, 0.00, 0.00, 250.00, 0.00, 150.00, 250.00, 1, 1, '2022-06-16 12:22:56', '2022-06-16 12:22:40', '2022-06-16 12:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `url_name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'POS Software', 'pos', NULL, 1, '2022-02-06 07:15:42', '2022-02-06 07:15:42'),
(2, 'Traning Center', 'training', NULL, 1, '2022-02-06 07:15:42', '2022-02-06 07:15:42'),
(3, 'Bkash', 'bkash', 'Bkash Agent System', 0, '2022-02-06 07:15:42', '2022-02-06 07:15:42'),
(4, 'Rocket', 'rocket', 'Rocket Agent System', 0, '2022-02-06 07:15:42', '2022-02-06 07:15:42'),
(5, 'Felxiload', 'flexiload', 'Felxiload System', 0, '2022-02-06 07:15:42', '2022-02-06 07:15:42'),
(6, 'Online Information', 'online', 'Online Information System', 1, '2022-02-06 07:15:42', '2022-02-06 07:15:42'),
(7, 'Photocopy', 'photocopy', 'Photocopy Management System', 1, '2022-02-06 07:15:42', '2022-02-06 07:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `client_id`, `name`, `logo`, `email`, `mobile_no`, `web`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, 'Company name', 'public/setting/frgOlfeLgtJdJVNmqnlSgVJ0aS00ZepdssZoAP5l.png', 'company@mail.com', '11122111212', NULL, 'Testing address', '2022-02-06 11:23:58', '2022-02-12 13:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `course_id` bigint(20) DEFAULT NULL,
  `batch_id` bigint(20) DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `educational_qualification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_address` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `payment_method` tinyint(4) DEFAULT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fee` double(20,2) DEFAULT 0.00,
  `certificate_fee` double(20,2) DEFAULT 0.00,
  `discount` double(20,2) DEFAULT 0.00,
  `total` double(20,2) DEFAULT 0.00,
  `paid` double(20,2) DEFAULT 0.00,
  `due` double(20,2) DEFAULT 0.00,
  `result` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_at` date DEFAULT NULL,
  `certificate_delivered_at` date DEFAULT NULL,
  `online_application` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=pending,1=Approved,2=Rejected, 3=Complete',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `client_id`, `section_id`, `company_branch_id`, `course_id`, `batch_id`, `photo`, `id_no`, `name`, `email`, `mobile_no`, `educational_qualification`, `fathers_name`, `fathers_mobile_no`, `mothers_name`, `mothers_mobile_no`, `gender`, `present_address`, `permanent_address`, `dob`, `payment_method`, `bank_id`, `fee`, `certificate_fee`, `discount`, `total`, `paid`, `due`, `result`, `approved_at`, `certificate_delivered_at`, `online_application`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5, 1, 1, 'public/uploads/student/NjpNtLCBRUpZqNBc8hyvRPBCIiGoF88xrkZWlFjxS7N1BM1X7simages.png', '00001', 'Al Arfin', NULL, '01729890904', NULL, NULL, NULL, NULL, NULL, 'Male', NULL, NULL, NULL, 1, NULL, 10000.00, 200.00, 500.00, 9700.00, 6400.00, 3300.00, NULL, NULL, '2022-07-19', 1, 0, 1, NULL, '2022-07-16 09:07:32', '2022-07-19 05:50:57'),
(2, 1, 2, 5, 2, 2, NULL, '00002', 'Yousuf Ali', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', NULL, NULL, NULL, 1, NULL, 5000.00, 0.00, 0.00, 5000.00, 0.00, 5000.00, NULL, NULL, NULL, 0, 1, 1, NULL, '2022-07-19 11:59:11', '2022-07-19 11:59:11'),
(6, 1, 2, 5, 1, 1, 'public/uploads/student/Kvia9ujsxqATYFFEZwxpM8F9R8YLNuwZwowWfBGAE1DKK8Cuvvabout.png', '00003', 'Online Student', NULL, '01223564725', NULL, NULL, NULL, NULL, NULL, 'Male', NULL, NULL, NULL, 1, NULL, 10000.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, NULL, '2022-07-24', NULL, 1, 1, 1, NULL, '2022-07-24 05:26:52', '2022-07-25 05:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendances`
--

CREATE TABLE `student_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_branch_id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `present` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=present,0=absent',
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `total_time` double(20,2) DEFAULT 0.00,
  `late` tinyint(4) NOT NULL DEFAULT 0,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_attendances`
--

INSERT INTO `student_attendances` (`id`, `client_id`, `section_id`, `company_branch_id`, `batch_id`, `student_id`, `date`, `present`, `in_time`, `out_time`, `total_time`, `late`, `note`, `status`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5, 1, 1, '2022-07-17', 1, '09:00:00', NULL, 0.00, 0, NULL, 1, 1, NULL, '2022-07-18 06:17:09', '2022-07-18 06:17:09');

-- --------------------------------------------------------

--
-- Table structure for table `student_results`
--

CREATE TABLE `student_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `batch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `result` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_results`
--

INSERT INTO `student_results` (`id`, `client_id`, `section_id`, `company_branch_id`, `course_id`, `batch_id`, `student_id`, `result`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5, 1, 1, 1, '4.94', 1, 1, '2022-07-25 06:38:35', '2022-07-25 06:38:35'),
(2, 1, 2, 5, 1, 1, 2, '3.81', 1, 1, '2022-07-25 06:38:35', '2022-07-25 06:38:35'),
(3, 1, 2, 5, 1, 1, 6, '4.50', 1, 1, '2022-07-25 06:38:35', '2022-07-25 06:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alternative_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `user_id` int(15) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `client_id`, `name`, `company_name`, `mobile_no`, `alternative_mobile`, `email`, `address`, `status`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'LT Plus', NULL, '07518200000', NULL, NULL, '333', 1, 2, NULL, '2021-07-30 17:22:26', '2021-07-30 17:22:26'),
(2, 1, 'Masud', NULL, '00000000000', NULL, NULL, '77 Rue Roger Salengro', 1, 2, NULL, '2021-07-30 17:22:57', '2021-07-30 17:22:57'),
(3, 1, 'Jony', NULL, '12345678910', NULL, NULL, '77 Rue Roger Salengro', 1, 2, NULL, '2021-07-30 17:23:26', '2022-02-13 07:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `designation_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gross_salary` double(20,2) DEFAULT 0.00,
  `short_bio` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `client_id`, `section_id`, `company_branch_id`, `designation_id`, `name`, `mobile_no`, `education`, `gender`, `photo`, `gross_salary`, `short_bio`, `address`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5, 1, 'Abdul Jalil', '01729890904', NULL, 'Male', 'public/uploads/teacher/KKpwQ18nfHvh9qNE2juIvhqgD1oRkWSsgHhAFJaKHTrBngk1uwuser1.png', 0.00, NULL, NULL, 1, 1, NULL, '2022-07-06 06:05:42', '2022-07-16 06:15:25'),
(2, 1, 2, 5, 3, 'Abdur Rahman', NULL, NULL, 'Male', NULL, 0.00, NULL, NULL, 1, 1, NULL, '2022-07-19 11:47:46', '2022-07-19 11:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `training_about_us`
--

CREATE TABLE `training_about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_about_us`
--

INSERT INTO `training_about_us` (`id`, `client_id`, `section_id`, `company_branch_id`, `name`, `content`, `image`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, 'About Us', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'public/uploads/training_about_us/N4w6YEQqheOqgxzUUkW4twEsblGMjRv2z22z5vFkEoQvty4mfjfeaturedimage2019-04-03-11-13-45_5ca479497f7ee.jpg', 1, 1, '2022-07-21 10:28:56', '2022-07-21 10:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `training_contact_messages`
--

CREATE TABLE `training_contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_contact_messages`
--

INSERT INTO `training_contact_messages` (`id`, `client_id`, `section_id`, `company_branch_id`, `name`, `mobile_no`, `email`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, 'Rokon Uzzaman', NULL, 'rokonrrr@gmail.com', 'Testing message', 1, '2022-07-24 06:12:38', '2022-07-24 06:12:38');

-- --------------------------------------------------------

--
-- Table structure for table `training_photo_galleries`
--

CREATE TABLE `training_photo_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 1,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_photo_galleries`
--

INSERT INTO `training_photo_galleries` (`id`, `client_id`, `section_id`, `company_branch_id`, `name`, `sort`, `image`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 1, 2, NULL, 'Gallery-1', 1, 'public/uploads/training_photo_gallery/Dh2Nt8FklHwWrgPiPg2x0MWlctYPEG1p8SB1WA6DWFRtjm4c1Ufeaturedimage2019-04-03-11-13-45_5ca479497f7ee.jpg', 1, 1, '2022-07-25 04:50:48', '2022-07-25 09:00:57'),
(3, 1, 2, NULL, 'Galley-02', 2, 'public/uploads/training_photo_gallery/NdIvYvCCLCaVW3729kqCzFQtJbeo7sOtCQ5A1bskz227W51Lowfeaturedimage2019-04-03-22-48-28_5ca51c1cb0456.jpg', 1, 1, '2022-07-25 04:51:36', '2022-07-25 09:02:17'),
(4, 1, 2, NULL, 'Gallery-3', 3, 'public/uploads/training_photo_gallery/dflv45DWNdkn3dOp8wvYZp5OW0qRCekCgxG0ecAEfUnxIUbtdUfeaturedimage2019-04-04-01-30-26_5ca54212eadcf.jpg', 1, 1, '2022-07-25 04:52:41', '2022-07-25 09:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `training_settings`
--

CREATE TABLE `training_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_map_embeded_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_settings`
--

INSERT INTO `training_settings` (`id`, `client_id`, `section_id`, `company_branch_id`, `logo`, `company_name`, `email`, `mobile_no`, `website`, `address`, `google_map_embeded_code`, `copyright_text`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, 'public/uploads/training_setting/dymJLWfZFmMm6Pxt5czP629Tw2O4mLlBwJp46IlpPlkQ8DxHmXLogo.png', 'Training Center', 'info@onepointitbd.com', '8801958368160-64', NULL, 'House # 172 (Jahaj Bulding) Wapda Road, West Rampura, Dhaka-1219', '<iframe    src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.5996966054704!2d90.41756187924791!3d23.761650234608563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b878b41d604d%3A0xb0dd79e468ba27c9!2sJahaj%20Building%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1628585538133!5m2!1sen!2sbd\"   width=\"400\" height=\"300\" style=\"border:0;\" allowfullscreen=\"\"    loading=\"lazy\"></iframe>', 'Copyright ?? 2022 Training Center. All rights reserved.', 1, 1, '2022-07-21 11:51:10', '2022-07-24 10:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `training_sliders`
--

CREATE TABLE `training_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 1,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_sliders`
--

INSERT INTO `training_sliders` (`id`, `client_id`, `section_id`, `company_branch_id`, `name`, `sort`, `url`, `image`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, 'Web Design & Development', 1, NULL, 'public/uploads/training_slider/81egOUsadJXnoOOdaJ0VGIIHqmb0JCI2ZwgoyuK7McVM3tfciU1.jpg', 1, 1, '2022-07-21 07:20:03', '2022-07-21 07:20:03'),
(2, 1, 2, NULL, 'Graphic Design', 2, NULL, 'public/uploads/training_slider/rmnZqSAjUMESypq5Nau0Ka2MIvP1DL2GELYeJ3DihGamAiCoST2.jpg', 1, 1, '2022-07-21 09:32:33', '2022-07-21 09:32:33'),
(3, 1, 2, NULL, 'Creative Graphic Design & Freelancing', 3, NULL, 'public/uploads/training_slider/2xaesGHpT6RvhvscgbzCf48DcxtcLNCxC6mBV0n1kgMbNWlRWq3.jpg', 1, 1, '2022-07-21 09:33:49', '2022-07-21 09:33:49'),
(4, 1, 2, NULL, 'Microsoft Office', 4, NULL, 'public/uploads/training_slider/jof0bxkd1keaoGdv50cre5kxnUvgE7hSqa2fuEQIif6GIhCUWF4.jpg', 1, 1, '2022-07-21 09:34:07', '2022-07-21 09:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `transaction_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `employee_id` bigint(20) DEFAULT NULL,
  `supplier_id` bigint(20) DEFAULT NULL,
  `payment_method` tinyint(4) DEFAULT NULL COMMENT '1=Cash,2=Bank,3=Credit',
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` double(20,6) DEFAULT 0.000000,
  `remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '1=Debit, 2=Credit',
  `user_id` int(15) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `delete_user_id` bigint(20) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `client_id`, `section_id`, `company_branch_id`, `transaction_no`, `date`, `employee_id`, `supplier_id`, `payment_method`, `bank_id`, `amount`, `remark`, `type`, `user_id`, `status`, `delete_user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '00001', '2022-06-07', NULL, NULL, 1, NULL, 200.000000, NULL, 2, 1, 1, NULL, NULL, '2022-06-07 12:29:07', '2022-06-07 12:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_logs`
--

CREATE TABLE `transaction_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
  `section_id` int(15) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `voucher_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Income, 2=Expense, 3=Purchase, 4=Sale, 5= Salary Process, 6= , 7= , 8=Balance Transafer, 9=Opening Balance, 10=Online Information, 11=Photocopy, 12=Student Fee Collection',
  `date` date NOT NULL,
  `particular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_class_id` int(15) DEFAULT NULL,
  `account_head_id` int(15) DEFAULT NULL,
  `account_id` int(15) DEFAULT NULL,
  `payment_method` tinyint(4) DEFAULT NULL COMMENT '1=Cash In hand, 2=Bank',
  `bank_id` int(10) UNSIGNED DEFAULT NULL,
  `debit` double(20,2) NOT NULL DEFAULT 0.00,
  `credit` double(20,2) NOT NULL DEFAULT 0.00,
  `amount` double(20,2) NOT NULL DEFAULT 0.00,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_id` int(15) DEFAULT NULL,
  `purchase_order_id` int(15) DEFAULT NULL,
  `customer_id` int(15) DEFAULT NULL,
  `sale_order_id` int(15) UNSIGNED DEFAULT NULL,
  `inventory_log_id` int(15) DEFAULT NULL,
  `salary_process_id` bigint(20) DEFAULT NULL,
  `employee_id` bigint(20) DEFAULT NULL,
  `transaction_id` bigint(20) DEFAULT NULL,
  `balance_transfer_id` bigint(20) DEFAULT NULL,
  `online_information_id` bigint(20) DEFAULT NULL,
  `online_income_id` bigint(20) DEFAULT NULL,
  `online_expense_id` bigint(20) DEFAULT NULL,
  `photocopy_id` bigint(20) DEFAULT NULL,
  `student_id` bigint(20) DEFAULT NULL,
  `adjustment_status` tinyint(4) NOT NULL DEFAULT 0,
  `opening_status` tinyint(4) NOT NULL DEFAULT 0,
  `user_id` int(15) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `delete_user_id` int(15) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_logs`
--

INSERT INTO `transaction_logs` (`id`, `client_id`, `section_id`, `company_branch_id`, `voucher_no`, `transaction_type`, `date`, `particular`, `account_class_id`, `account_head_id`, `account_id`, `payment_method`, `bank_id`, `debit`, `credit`, `amount`, `note`, `supplier_id`, `purchase_order_id`, `customer_id`, `sale_order_id`, `inventory_log_id`, `salary_process_id`, `employee_id`, `transaction_id`, `balance_transfer_id`, `online_information_id`, `online_income_id`, `online_expense_id`, `photocopy_id`, `student_id`, `adjustment_status`, `opening_status`, `user_id`, `status`, `delete_user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '00001', 1, '2022-05-31', 'Purchase of invoice no. 00001', 4, 1, 1, NULL, NULL, 0.00, 27500.00, 27500.00, 'Purchase from LT Plus', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-05-31 07:13:55', '2022-05-31 07:13:55'),
(2, 1, 1, 1, '00002', 1, '2022-05-31', 'Purchase payable for invoice no. 00001', 2, 7, 8, NULL, NULL, 0.00, 20000.00, 20000.00, 'Purchase payable from LT Plus', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-05-31 07:13:55', '2022-06-05 07:01:20'),
(3, 1, 1, 1, '00003', 2, '2022-05-31', 'Customer receivable for invoice no. 00001', 3, 2, 2, NULL, NULL, 0.00, 800.00, 0.00, 'Sale for AMA Librairie', NULL, NULL, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-05-31 07:24:29', '2022-05-31 07:24:29'),
(4, 1, 1, 1, '00004', 2, '2022-05-31', 'Customer receive for invoice no. 00001', 1, 4, 3, 1, 1, 0.00, 500.00, 500.00, 'Sale receive fromAMA Librairie', NULL, NULL, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-05-31 07:24:29', '2022-05-31 07:24:29'),
(5, 1, 1, 1, '00005', 2, '2022-05-31', 'Customer receivable for invoice no. 00001', 1, 8, 9, NULL, NULL, 0.00, 300.00, 300.00, 'Sale receivable from AMA Librairie', NULL, NULL, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-05-31 07:24:30', '2022-05-31 07:24:30'),
(6, 1, 1, 1, '00006', 2, '2022-06-05', 'Supplier payment for invoice no. 00001', 1, 4, 3, 1, NULL, 7500.00, 0.00, 7500.00, 'Supplier payment of LT Plus', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-05 07:01:20', '2022-06-05 07:01:20'),
(7, 1, 1, 1, '00007', 9, '2022-06-05', 'Jony opening balance', 4, 1, 1, NULL, NULL, 0.00, 2000.00, 2000.00, 'Test', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 1, NULL, NULL, '2022-06-05 07:11:56', '2022-06-05 07:11:56'),
(8, 1, 1, 1, '00008', 9, '2022-06-07', 'Cash In Hand opening balance', 1, 4, 3, NULL, NULL, 0.00, 50000.00, 50000.00, 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 1, NULL, NULL, '2022-06-07 10:30:28', '2022-06-07 10:30:28'),
(9, 1, 1, 1, '00009', 6, '2022-06-07', 'Credit transaction for transaction no. 00001', 4, 50, 101, NULL, NULL, 0.00, 200.00, 200.00, 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-07 12:29:07', '2022-06-07 12:29:07'),
(10, 1, 1, 1, '00010', 1, '2022-06-07', 'Credit transaction for transaction no. 00001', 1, 4, 3, 1, 1, 200.00, 0.00, 200.00, 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-07 12:29:07', '2022-06-07 12:29:07'),
(11, 1, 6, 3, '00011', 10, '2022-06-12', 'Online information for serial no. 00001', 3, 9, 11, NULL, NULL, 0.00, 100.00, 100.00, 'Online information for General Customers', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-11 11:58:56', '2022-06-19 06:34:42'),
(12, 1, 6, 3, '00012', 1, '2022-06-12', 'Online information receive for serial no. 00001', 1, 4, 3, 1, NULL, 0.00, 100.00, 100.00, 'Online information receive fromGeneral Customers', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-11 11:58:56', '2022-06-19 06:34:42'),
(13, 1, 6, 3, '00013', 10, '2022-06-12', 'Online information for serial no. 00002', 1, 4, 11, 2, 1, 0.00, 150.00, 150.00, 'Online information for General Customers', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-12 04:23:53', '2022-06-12 06:26:17'),
(15, 1, 6, 3, '00015', 10, '2022-06-12', 'Customer receivable for serial no. ', 1, 4, 4, 2, 1, 0.00, 100.00, 100.00, 'Online information receivable from General Customers', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-12 04:23:53', '2022-06-12 06:26:17'),
(16, 1, 6, 1, '00016', 10, '2022-06-12', 'Customer receivable for serial no. ', 1, 8, 13, NULL, NULL, 0.00, 50.00, 50.00, 'Online information receivable from General Customers', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-12 06:26:18', '2022-06-12 06:26:18'),
(17, 1, 1, 1, '00016', 3, '2022-06-12', 'Purchase of invoice no. 00002', 4, 1, 1, NULL, NULL, 0.00, 5000.00, 5000.00, 'Purchase from LT Plus', 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-12 06:40:22', '2022-06-12 06:40:22'),
(18, 1, 1, 1, '00017', 3, '2022-06-12', 'Purchase payable for invoice no. 00002', 2, 7, 8, NULL, NULL, 0.00, 5000.00, 5000.00, 'Purchase payable from LT Plus', 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-12 06:40:22', '2022-06-12 06:40:22'),
(19, 1, 1, 1, '00018', 4, '2022-06-14', 'Customer receivable for invoice no. 00002', 3, 2, 2, NULL, NULL, 0.00, 1500.00, 0.00, 'Sale for General Customers', NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-14 07:07:40', '2022-06-14 07:07:40'),
(20, 1, 1, 1, '00019', 1, '2022-06-14', 'Customer receive for invoice no. 00002', 1, 4, 3, 1, 1, 0.00, 1500.00, 1500.00, 'Sale receive fromGeneral Customers', NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-14 07:07:40', '2022-06-14 07:07:40'),
(21, 1, 1, 1, '00020', 4, '2022-06-14', 'Customer receivable for invoice no. 00003', 3, 2, 2, NULL, NULL, 0.00, 420.00, 0.00, 'Sale for AMA Librairie', NULL, NULL, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-14 07:08:25', '2022-06-14 07:08:25'),
(22, 1, 1, 1, '00021', 1, '2022-06-14', 'Customer receive for invoice no. 00003', 1, 4, 3, 1, 1, 0.00, 420.00, 420.00, 'Sale receive fromAMA Librairie', NULL, NULL, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-14 07:08:25', '2022-06-14 07:08:25'),
(23, 1, 1, 1, '00022', 4, '2022-06-16', 'Customer receivable for invoice no. 00004', 3, 2, 2, NULL, NULL, 0.00, 84.00, 84.00, 'Sale for General Customers', NULL, NULL, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-15 06:11:54', '2022-06-16 12:04:44'),
(24, 1, 1, 1, '00023', 1, '2022-06-15', 'Customer receive for invoice no. 00004', 1, 4, 3, 1, 1, 0.00, 84.00, 84.00, 'Sale receive fromGeneral Customers', NULL, NULL, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-15 06:11:54', '2022-06-15 06:11:54'),
(25, 1, 1, 1, '00024', 4, '2022-06-15', 'Customer receivable for invoice no. 00005', 3, 2, 2, NULL, NULL, 0.00, 420.00, 0.00, 'Sale for AMA Librairie', NULL, NULL, 2, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-15 06:49:37', '2022-06-15 06:49:37'),
(26, 1, 1, 1, '00025', 4, '2022-06-15', 'Customer receivable for invoice no. 00005', 1, 8, 9, NULL, NULL, 0.00, 420.00, 420.00, 'Sale receivable from AMA Librairie', NULL, NULL, 2, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-15 06:49:37', '2022-06-15 06:49:37'),
(27, 1, 1, 1, '00026', 3, '2022-06-16', 'Purchase of invoice no. 00003', 4, 1, 1, NULL, NULL, 0.00, 15000.00, 15000.00, 'Purchase from LT Plus', 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-16 06:41:45', '2022-06-16 06:41:45'),
(28, 1, 1, 1, '00027', 3, '2022-06-16', 'Purchase payable for invoice no. 00003', 2, 7, 8, NULL, NULL, 0.00, 15000.00, 15000.00, 'Purchase payable from LT Plus', 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-16 06:41:45', '2022-06-16 06:41:45'),
(29, 1, 1, 1, '00028', 4, '2022-06-16', 'Customer receivable for invoice no. ', 1, 8, 9, NULL, NULL, 0.00, 84.00, 84.00, 'Sale receivable from General Customers', NULL, NULL, 1, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-16 12:01:38', '2022-06-16 12:01:38'),
(30, 1, 1, 1, '00029', 4, '2022-06-16', 'Customer receivable for invoice no. ', 1, 8, 9, NULL, NULL, 0.00, 84.00, 84.00, 'Sale receivable from General Customers', NULL, NULL, 1, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-16 12:02:40', '2022-06-16 12:02:40'),
(31, 1, 1, 1, '00030', 4, '2022-06-16', 'Customer receivable for invoice no. 00004', 1, 8, 9, NULL, NULL, 0.00, 0.00, 0.00, 'Sale receivable from General Customers', NULL, NULL, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-16 12:04:44', '2022-06-16 12:04:44'),
(32, 1, 1, 1, '00031', 4, '2022-06-16', 'Customer receivable for invoice no. 00004', 1, 8, 9, NULL, NULL, 0.00, 0.00, 0.00, 'Sale receivable from General Customers', NULL, NULL, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-16 12:06:02', '2022-06-16 12:06:02'),
(33, 1, 1, 1, '00032', 4, '2022-06-16', 'Customer receivable for invoice no. ', 1, 8, 9, NULL, NULL, 0.00, 168.00, 168.00, 'Sale receivable from General Customers', NULL, NULL, 1, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-16 12:07:44', '2022-06-16 12:07:44'),
(34, 1, 1, 1, '00033', 4, '2022-06-16', 'Customer receivable for invoice no. ', 1, 8, 9, NULL, NULL, 0.00, 168.00, 168.00, 'Sale receivable from General Customers', NULL, NULL, 1, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-16 12:10:22', '2022-06-16 12:10:22'),
(35, 1, 1, 1, '00034', 4, '2022-06-16', 'Customer receivable for invoice no. ', 1, 8, 9, NULL, NULL, 0.00, 168.00, 168.00, 'Sale receivable from General Customers', NULL, NULL, 1, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-16 12:13:37', '2022-06-16 12:13:37'),
(36, 1, 1, 1, '00035', 4, '2022-06-16', 'Customer receivable for invoice no. ', 1, 8, 9, NULL, NULL, 0.00, 84.00, 84.00, 'Sale receivable from General Customers', NULL, NULL, 1, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-16 12:14:25', '2022-06-16 12:14:25'),
(37, 1, 1, 1, '00036', 4, '2022-06-16', 'Customer receivable for invoice no. ', 1, 8, 9, NULL, NULL, 0.00, 252.00, 252.00, 'Sale receivable from General Customers', NULL, NULL, 1, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-16 12:14:59', '2022-06-16 12:14:59'),
(38, 1, 1, 1, '00037', 4, '2022-06-16', 'Customer receivable for invoice no. ', 1, 8, 9, NULL, NULL, 0.00, 252.00, 252.00, 'Sale receivable from General Customers', NULL, NULL, 1, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-16 12:17:21', '2022-06-16 12:17:21'),
(39, 1, 1, 1, '00038', 4, '2022-06-16', 'Customer receivable for invoice no. ', 1, 8, 9, NULL, NULL, 0.00, 502.00, 502.00, 'Sale receivable from General Customers', NULL, NULL, 1, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-16 12:18:28', '2022-06-16 12:18:28'),
(40, 1, 1, 1, '00039', 4, '2022-06-16', 'Customer receivable for invoice no. ', 1, 8, 9, NULL, NULL, 0.00, 252.00, 252.00, 'Sale receivable from General Customers', NULL, NULL, 1, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-16 12:19:00', '2022-06-16 12:19:00'),
(41, 1, 1, 1, '00040', 4, '2022-06-16', 'Customer receivable for invoice no. ', 1, 8, 9, NULL, NULL, 0.00, 252.00, 252.00, 'Sale receivable from General Customers', NULL, NULL, 1, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-16 12:21:42', '2022-06-16 12:21:42'),
(42, 1, 1, 1, '00041', 4, '2022-06-16', 'Customer receivable for invoice no. ', 1, 8, 9, NULL, NULL, 0.00, 502.00, 502.00, 'Sale receivable from General Customers', NULL, NULL, 1, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-16 12:22:40', '2022-06-16 12:22:40'),
(43, 1, 1, 1, '00042', 4, '2022-06-16', 'Customer receivable for invoice no. ', 1, 8, 9, NULL, NULL, 0.00, 252.00, 252.00, 'Sale receivable from General Customers', NULL, NULL, 1, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-16 12:22:56', '2022-06-16 12:22:56'),
(44, 1, 6, 3, '00043', 10, '2022-06-19', 'Online information for serial no. 00003', 3, 9, 11, NULL, NULL, 0.00, 1000.00, 1000.00, 'Online information for Online Customer', NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-18 12:06:07', '2022-06-19 05:52:31'),
(45, 1, 6, 3, '00044', 1, '2022-06-18', 'Online information receive for serial no. 00003', 1, 4, 3, 1, NULL, 0.00, 500.00, 500.00, 'Online information receive fromOnline Customer', NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-18 12:06:07', '2022-06-18 12:06:07'),
(46, 1, 6, 3, '00045', 10, '2022-06-19', 'Customer receivable for serial no. ', 1, 8, 13, NULL, NULL, 0.00, 300.00, 300.00, 'Online information receivable from Online Customer', NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-18 12:06:07', '2022-07-18 04:31:50'),
(47, 1, 6, NULL, '00046', 1, '2022-06-19', 'Online information due receive for serial no. 00003', 1, 4, 3, 1, NULL, 0.00, 100.00, 100.00, 'Online information due receive fromOnline Customer', NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-19 06:30:29', '2022-06-19 06:30:29'),
(50, 1, 6, 3, '00047', 11, '2022-06-19', 'Online information fee payment for serial no. 00003', 4, 9, 14, NULL, NULL, 0.00, 800.00, 800.00, 'Online information fee payment.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-19 09:59:21', '2022-06-19 09:59:21'),
(51, 1, 6, 3, '00048', 2, '2022-06-19', 'Online information due receive for serial no. 00003', 1, 4, 3, 1, NULL, 800.00, 0.00, 800.00, 'Online information fee payment', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-19 09:59:21', '2022-06-19 09:59:21'),
(52, 1, 6, 3, '00049', 10, '2022-06-19', 'Online information for serial no. 00004', 3, 9, 11, NULL, NULL, 0.00, 600.00, 600.00, 'Online information for Sonali', NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-19 10:54:14', '2022-06-19 10:54:14'),
(53, 1, 6, 3, '00050', 1, '2022-06-19', 'Online information receive for serial no. 00004', 1, 4, 3, 1, NULL, 0.00, 600.00, 600.00, 'Online information receive fromSonali', NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-19 10:54:14', '2022-06-19 10:54:14'),
(54, 1, 6, 3, '00051', 11, '2022-06-19', 'Online information fee payment for serial no. 00004', 4, 9, 14, NULL, NULL, 0.00, 500.00, 500.00, 'Online information fee payment.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-19 10:55:25', '2022-06-19 10:55:25'),
(55, 1, 6, 3, '00052', 2, '2022-06-19', 'Online information due receive for serial no. 00004', 1, 4, 3, 1, NULL, 500.00, 0.00, 500.00, 'Online information fee payment', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-19 10:55:25', '2022-06-19 10:55:25'),
(56, 1, 6, 3, '00053', 10, '2022-06-20', 'Online income for serial no. 00001', 3, 101, 101, NULL, NULL, 0.00, 1200.00, 1200.00, 'Online Income', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-20 07:18:06', '2022-06-20 08:48:28'),
(57, 1, 6, 3, '00054', 1, '2022-06-20', 'Online income for serial no. 00001', 1, 4, 3, 1, NULL, 0.00, 1200.00, 1200.00, 'Online Income', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-20 07:18:06', '2022-06-20 08:48:28'),
(58, 1, 6, 3, '00055', 10, '2022-06-20', 'Online expense for serial no. 00001', 4, 102, 102, NULL, NULL, 0.00, 100.00, 100.00, 'Online Expense', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-20 09:13:04', '2022-06-20 09:13:04'),
(59, 1, 6, 3, '00056', 1, '2022-06-20', 'Online expense for serial no. 00001', 1, 4, 3, 1, NULL, 0.00, 100.00, 100.00, 'Online Expense', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-20 09:13:04', '2022-06-20 09:13:04'),
(60, 1, 7, 4, '00057', 11, '2022-06-22', 'Photocopy credit for serial no. 00001', 3, 11, 15, NULL, NULL, 0.00, 90.00, 90.00, 'Photocopy for General Customers', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-22 06:09:54', '2022-06-22 06:20:22'),
(61, 1, 7, 4, '00058', 1, '2022-06-22', 'Photocopy receive for serial no. 00001', 1, 4, 3, 1, NULL, 0.00, 90.00, 90.00, 'Photocopy receive fromGeneral Customers', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-22 06:09:54', '2022-06-22 06:20:22'),
(62, 1, 7, 4, '00059', 11, '2022-06-22', 'Photocopy credit for serial no. 00002', 3, 11, 15, NULL, NULL, 0.00, 10.00, 10.00, 'Photocopy for Photocopy Extra Entry', NULL, NULL, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-23 10:31:09', '2022-06-23 10:31:09'),
(63, 1, 7, 4, '00060', 1, '2022-06-22', 'Photocopy receive for serial no. 00002', 1, 4, 3, 1, NULL, 0.00, 10.00, 10.00, 'Photocopy receive fromPhotocopy Extra Entry', NULL, NULL, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-23 10:31:10', '2022-06-23 10:31:10'),
(64, 1, 6, 4, '00061', 10, '2022-06-25', 'Online income for serial no. 00002', 3, 101, 101, NULL, NULL, 0.00, 300.00, 300.00, 'Online Income', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-25 07:05:38', '2022-06-25 07:05:38'),
(65, 1, 6, 4, '00062', 1, '2022-06-25', 'Online income for serial no. 00002', 1, 4, 3, 1, NULL, 0.00, 300.00, 300.00, 'Online Income', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-25 07:05:38', '2022-06-25 07:05:38'),
(66, 1, 7, 4, '00063', 10, '2022-06-25', 'Online income for serial no. 00003', 3, 101, 101, NULL, NULL, 0.00, 100.00, 100.00, 'Online Income', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-25 07:07:54', '2022-06-25 07:07:54'),
(67, 1, 7, 4, '00064', 1, '2022-06-25', 'Online income for serial no. 00003', 1, 4, 3, 1, NULL, 0.00, 100.00, 100.00, 'Online Income', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-25 07:07:54', '2022-06-25 07:07:54'),
(68, 1, 7, 4, '00065', 10, '2022-06-25', 'Online expense for serial no. 00002', 4, 102, 102, NULL, NULL, 0.00, 200.00, 200.00, 'Online Expense', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-25 07:08:41', '2022-06-25 07:08:41'),
(69, 1, 7, 4, '00066', 1, '2022-06-25', 'Online expense for serial no. 00002', 1, 4, 3, 1, NULL, 0.00, 200.00, 200.00, 'Online Expense', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-25 07:08:41', '2022-06-25 07:08:41'),
(70, 1, 7, 4, '00067', 11, '2022-06-26', 'Photocopy credit for serial no. 00003', 3, 11, 15, NULL, NULL, 0.00, 600.00, 600.00, 'Photocopy for AMA Librairie', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-26 07:08:37', '2022-06-26 07:08:37'),
(71, 1, 7, 4, '00068', 1, '2022-06-26', 'Photocopy receive for serial no. 00003', 1, 4, 3, 1, NULL, 0.00, 600.00, 600.00, 'Photocopy receive fromAMA Librairie', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-26 07:08:37', '2022-06-26 07:08:37'),
(72, 1, 2, 5, '00069', 12, '2022-07-16', 'Student collection from Al Arfin', 3, 13, 18, NULL, NULL, 0.00, 9700.00, 0.00, 'Student collection for Basic to advanced web design', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, NULL, NULL, '2022-07-16 09:07:32', '2022-07-20 07:08:44'),
(73, 1, 2, 5, '00070', 1, '0200-07-16', 'Student collection from Al Arfin', 1, 4, 3, 1, NULL, 0.00, 4500.00, 4500.00, 'Student collection for Basic to advanced web design', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, NULL, NULL, '2022-07-16 09:07:32', '2022-07-16 09:07:32'),
(74, 1, 2, 5, '00071', 4, '0200-07-16', 'Student receivable from Al Arfin', 1, 8, 20, NULL, NULL, 0.00, 3300.00, 3300.00, 'Student receivable from Al Arfin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, NULL, NULL, '2022-07-16 09:07:32', '2022-07-19 05:49:15'),
(80, 1, 2, 5, '00077', 1, '2022-07-17', 'Student fee payment for 00001', 4, 4, 3, 1, NULL, 0.00, 1000.00, 1000.00, 'Student fee payment.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, NULL, NULL, '2022-07-17 05:57:10', '2022-07-17 05:57:10'),
(81, 1, 2, 5, '00073', 1, '2022-07-17', 'Student fee payment for 00001', 1, 4, 3, 1, NULL, 0.00, 500.00, 500.00, 'Student fee payment.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, NULL, NULL, '2022-07-17 06:14:35', '2022-07-17 06:14:35'),
(82, 1, 6, 3, '00074', 1, '2022-07-18', 'Online information due receive for serial no. 00003', 1, 4, 3, 1, NULL, 0.00, 100.00, 100.00, 'Online information due receive fromOnline Customer', NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-07-18 04:31:50', '2022-07-18 04:31:50'),
(83, 1, 2, 5, '00075', 1, '2022-07-19', 'Student fee payment for 00001', 1, 4, 3, 1, NULL, 0.00, 100.00, 100.00, 'Student fee payment.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, NULL, NULL, '2022-07-19 05:39:36', '2022-07-19 05:39:36'),
(84, 1, 2, 5, '00076', 1, '2022-07-19', 'Student fee payment for 00001', 1, 4, 3, 1, NULL, 0.00, 100.00, 100.00, 'Student fee payment.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, NULL, NULL, '2022-07-19 05:49:15', '2022-07-19 05:49:15'),
(85, 1, 2, 5, '00077', 1, '2022-07-19', 'Student certificate fee payment for 00001', 1, 4, 3, 1, NULL, 0.00, 200.00, 200.00, 'Student certificate fee payment.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, NULL, NULL, '2022-07-19 05:50:57', '2022-07-19 05:50:57'),
(86, 1, 2, 5, '00078', 12, '2022-07-19', 'Student collection from Yousuf Ali', 3, 13, 18, NULL, NULL, 0.00, 5000.00, 0.00, 'Student collection for Graphics Design for Begginer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 1, 1, NULL, NULL, '2022-07-19 11:59:11', '2022-07-19 11:59:11'),
(87, 1, 2, 5, '00079', 12, '2022-07-19', 'Student receivable from Yousuf Ali', 1, 8, 20, NULL, NULL, 0.00, 5000.00, 5000.00, 'Student receivable from Yousuf Ali', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 1, 1, NULL, NULL, '2022-07-19 11:59:11', '2022-07-19 11:59:11'),
(88, 1, 2, 5, '00080', 12, '2022-07-24', 'Student collection from Online Student', 3, 13, 18, NULL, NULL, 0.00, 10000.00, 10000.00, 'Student collection for Basic to advanced web design', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, 0, 0, 1, 1, NULL, NULL, '2022-07-24 08:54:47', '2022-07-24 08:54:47'),
(89, 1, 2, 5, '00081', 12, '2022-07-24', 'Student receivable from Online Student', 1, 8, 20, NULL, NULL, 0.00, 10000.00, 10000.00, 'Student receivable from Online Student', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, 0, 0, 1, 1, NULL, NULL, '2022-07-24 08:54:47', '2022-07-24 08:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
  `section_id` int(15) DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(12) NOT NULL DEFAULT 2 COMMENT '1=Super Admin, 2=Admin, 3=Employee',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logged_section_id` int(15) DEFAULT 0,
  `user_id` int(15) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=Disable, 1=Enable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `client_id`, `section_id`, `company_branch_id`, `name`, `email`, `mobile_no`, `role_id`, `email_verified_at`, `password`, `remember_token`, `logged_section_id`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 'One Point', 'admin@gmail.com', NULL, 1, NULL, '$2a$12$UXoNZrVnmqHmwdOv2RbQLeT2eYn/8XyhDV0n1.SWwkgGzdXNIc2hG', 'tTBnm8rPieL9krgCSGXKoYczsnd9AvZYdGxIkWAxcFpQ2c1l419kwPsenhFC', 2, 1, 1, NULL, '2020-08-20 15:16:14', '2022-07-25 04:13:33'),
(2, 1, 1, NULL, 'Admin', 'admin1@gmail.com', NULL, 2, NULL, '$2a$12$Wvi1dtw2d0kziysPM.UmcOMpcXfhdrb8HXswhf8wMVdmIDcz8P5aO', 'tHeB6DTy9zw7AYnzgqo16bLgEBFlGL9EU4MjzNQY6Fr7lbqYeCBIcTxC64AB', 1, 1, 1, NULL, '2020-08-20 15:21:49', '2022-06-08 12:21:43'),
(9, 1, NULL, NULL, 'Training Admin', 'training@gmail.com', '11122211111', 2, NULL, '$2y$10$fHxeMhO4ko7FSnDnDQTY1.G0JJ4pec6nUSmo977pEHG4F8AeHxpEO', NULL, 2, 1, 1, NULL, '2022-02-08 11:01:50', '2022-06-08 12:22:14'),
(10, 1, 1, 1, 'Aminur Rahman', 'aminur@gmail.com', '12311111112', 3, NULL, '$2y$10$EEWl8tYJKF5JIkiMWuhVbu7KKdaWoOjbZtp5/VVon0EI3Luipt5Hu', NULL, 0, 1, 1, NULL, '2022-03-21 11:21:00', '2022-03-21 11:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_sections`
--

CREATE TABLE `user_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `creator_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_sections`
--

INSERT INTO `user_sections` (`id`, `user_id`, `section_id`, `creator_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2022-02-08 09:44:21', '2022-02-08 09:44:21'),
(2, 1, 2, 1, '2022-02-08 11:00:29', '2022-02-08 11:00:29'),
(3, 9, 2, 1, '2022-02-08 11:01:50', '2022-02-08 11:01:50'),
(4, 2, 1, 1, '2022-06-08 08:46:37', '2022-06-08 08:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `name`, `short_name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '2022', '22', 1, NULL, '2022-03-02 05:19:56', '2022-03-02 05:19:56'),
(2, '2023', '23', 1, NULL, '2022-03-02 05:19:56', '2022-03-02 05:19:56'),
(3, '2024', '24', 1, NULL, '2022-03-02 05:19:56', '2022-03-02 05:19:56'),
(4, '2025', '25', 1, NULL, '2022-03-02 05:19:56', '2022-03-02 05:19:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_classes`
--
ALTER TABLE `account_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_heads`
--
ALTER TABLE `account_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_types`
--
ALTER TABLE `application_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balance_transfers`
--
ALTER TABLE `balance_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_branches`
--
ALTER TABLE `company_branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_categories`
--
ALTER TABLE `course_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation_logs`
--
ALTER TABLE `designation_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_logs`
--
ALTER TABLE `inventory_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine_closings`
--
ALTER TABLE `machine_closings`
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
-- Indexes for table `months`
--
ALTER TABLE `months`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_categories`
--
ALTER TABLE `online_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_expenses`
--
ALTER TABLE `online_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_incomes`
--
ALTER TABLE `online_incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_information`
--
ALTER TABLE `online_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_payment_types`
--
ALTER TABLE `online_payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `photocopies`
--
ALTER TABLE `photocopies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photocopy_cash_closings`
--
ALTER TABLE `photocopy_cash_closings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photocopy_machines`
--
ALTER TABLE `photocopy_machines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_quotations`
--
ALTER TABLE `price_quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_quotation_products`
--
ALTER TABLE `price_quotation_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_brands`
--
ALTER TABLE `product_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_units`
--
ALTER TABLE `product_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_products`
--
ALTER TABLE `purchase_order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `salary_logs`
--
ALTER TABLE `salary_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_processes`
--
ALTER TABLE `salary_processes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_process_details`
--
ALTER TABLE `salary_process_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_orders`
--
ALTER TABLE `sale_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_order_products`
--
ALTER TABLE `sale_order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendances`
--
ALTER TABLE `student_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_results`
--
ALTER TABLE `student_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_about_us`
--
ALTER TABLE `training_about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_contact_messages`
--
ALTER TABLE `training_contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_photo_galleries`
--
ALTER TABLE `training_photo_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_settings`
--
ALTER TABLE `training_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_sliders`
--
ALTER TABLE `training_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_sections`
--
ALTER TABLE `user_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `account_classes`
--
ALTER TABLE `account_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `account_heads`
--
ALTER TABLE `account_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `application_types`
--
ALTER TABLE `application_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `balance_transfers`
--
ALTER TABLE `balance_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_branches`
--
ALTER TABLE `company_branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_categories`
--
ALTER TABLE `course_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `designation_logs`
--
ALTER TABLE `designation_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_logs`
--
ALTER TABLE `inventory_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `machine_closings`
--
ALTER TABLE `machine_closings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `months`
--
ALTER TABLE `months`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `online_categories`
--
ALTER TABLE `online_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `online_expenses`
--
ALTER TABLE `online_expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `online_incomes`
--
ALTER TABLE `online_incomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `online_information`
--
ALTER TABLE `online_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `online_payment_types`
--
ALTER TABLE `online_payment_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photocopies`
--
ALTER TABLE `photocopies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `photocopy_cash_closings`
--
ALTER TABLE `photocopy_cash_closings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `photocopy_machines`
--
ALTER TABLE `photocopy_machines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `price_quotations`
--
ALTER TABLE `price_quotations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `price_quotation_products`
--
ALTER TABLE `price_quotation_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_brands`
--
ALTER TABLE `product_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_units`
--
ALTER TABLE `product_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_order_products`
--
ALTER TABLE `purchase_order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_logs`
--
ALTER TABLE `salary_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salary_processes`
--
ALTER TABLE `salary_processes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salary_process_details`
--
ALTER TABLE `salary_process_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sale_orders`
--
ALTER TABLE `sale_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sale_order_products`
--
ALTER TABLE `sale_order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_attendances`
--
ALTER TABLE `student_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_results`
--
ALTER TABLE `student_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `training_about_us`
--
ALTER TABLE `training_about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `training_contact_messages`
--
ALTER TABLE `training_contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `training_photo_galleries`
--
ALTER TABLE `training_photo_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `training_settings`
--
ALTER TABLE `training_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `training_sliders`
--
ALTER TABLE `training_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_sections`
--
ALTER TABLE `user_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
