-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2022 at 06:45 PM
-- Server version: 10.3.34-MariaDB-cll-lve
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opitdev_erpsherali`
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
(101, 1, 4, 101, 'Route Cost', 0, 1, 1, NULL, '2022-02-28 12:02:01', '2022-02-28 12:02:01'),
(102, 1, NULL, 2, 'Sales Center', 0, 1, 1, NULL, '2022-06-11 18:00:27', '2022-06-11 18:00:27');

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
(101, 1, 4, 'Office Expense', 0, 1, NULL, '2022-02-28 11:58:33', '2022-02-28 11:58:33');

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

--
-- Dumping data for table `balance_transfers`
--

INSERT INTO `balance_transfers` (`id`, `client_id`, `section_id`, `company_branch_id`, `transfer_no`, `date`, `debit_payment_method`, `debit_account_id`, `debit_bank_id`, `credit_payment_method`, `credit_account_id`, `credit_bank_id`, `amount`, `note`, `user_id`, `status`, `delete_user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, '00001', '2022-06-12', 2, 4, 2, 2, 4, 1, 0.000000, NULL, 1, 1, NULL, NULL, '2022-06-11 18:06:45', '2022-06-11 18:06:45');

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
(1, 1, 'Sahjalal Islami Bank Ltd', 'Company Account', '4008 111 000 100 15', NULL, 'Uttara', 1, 1, '2022-02-09 06:18:16', '2022-06-08 11:32:05'),
(2, 1, 'Dutch Bangla Bank Ltd', 'Ma Computer and Training Center', '02512', NULL, NULL, 1, 1, '2022-06-11 17:58:52', '2022-06-11 17:58:52'),
(3, 1, 'Dutch Bangla Bank Ltd', 'Ma Computer and Training Center', '02512', NULL, NULL, 1, 1, '2022-06-11 17:58:57', '2022-06-12 03:44:31');

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

INSERT INTO `company_branches` (`id`, `client_id`, `section_id`, `name`, `email`, `mobile_no`, `address`, `logo`, `description`, `status`, `user_id`, `delete_user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Rampura', 'rampura@gmail.com', '12121212121', 'Test address', NULL, NULL, 1, 1, NULL, NULL, '2022-03-21 11:00:59', '2022-03-21 11:00:59'),
(2, 1, 1, 'Hatirjhil', NULL, '11222222222', 'Hatirjhil', NULL, NULL, 1, 1, NULL, NULL, '2022-03-23 04:39:42', '2022-03-23 04:39:42'),
(3, 1, 1, 'Kushura Branch', 'macomputer51@yahoo.com', '01958414051', 'Kushura, Dhamrai, Dhaka', NULL, NULL, 1, 1, NULL, NULL, '2022-06-12 03:42:31', '2022-06-12 03:42:31');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 1, 'test', '650837948', NULL, '77 Rue Roger Salengro', 1, 2, '2022-02-13 07:06:12', '2021-07-30 17:48:07', '2022-02-13 07:06:12'),
(2, 1, 'AMA Librairie', '650837948', NULL, '77 Rue Roger Salengro', 1, 2, NULL, '2021-07-30 22:39:44', '2021-08-01 06:29:10'),
(3, 1, 'Sonali', '075182003', NULL, '77 rue Roger, 93700', 1, 7, NULL, '2021-07-30 22:52:41', '2021-07-30 22:52:41'),
(4, 1, 'Sonali', '075182003', NULL, '77 rue Roger, 93700', 1, 7, '2022-02-17 05:57:40', '2021-07-30 22:52:42', '2022-02-17 05:57:40'),
(5, 1, 'Tangail Shop', '354353245425', NULL, 'bvxcv', 1, 1, NULL, '2021-08-01 06:30:40', '2021-08-01 06:30:40'),
(6, 1, 'Sher ali', '01958414097', 'jkhadiza203@gmail.com', 'Kalampur', 1, 1, NULL, '2022-06-11 17:30:08', '2022-06-11 17:30:08');

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
(1, 1, 'Manager', 'MGR', 0, 1, 1, NULL, '2022-03-21 10:09:37', '2022-03-21 10:09:37');

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

INSERT INTO `inventory_logs` (`id`, `client_id`, `section_id`, `company_branch_id`, `product_id`, `product_category_id`, `code`, `invoice_no`, `stock_type`, `type`, `date`, `quantity`, `return_quantity`, `unit_price`, `buy_price`, `discount`, `tax`, `vat`, `product_total`, `buy_total`, `total`, `supplier_id`, `purchase_order_id`, `customer_id`, `sale_order_id`, `note`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, '00001', NULL, 1, 1, '2022-05-31', 150.00, 0.00, 50.00, 50.00, 0.00, 0.00, 0.00, 7500.00, 7500.00, 7500.00, 1, 1, NULL, NULL, 'Purchase Product In', 1, 1, NULL, '2022-05-31 07:13:55', '2022-05-31 07:13:55'),
(2, 1, 1, 1, 2, 1, '00002', NULL, 1, 1, '2022-05-31', 100.00, 0.00, 200.00, 200.00, 0.00, 0.00, 0.00, 20000.00, 20000.00, 20000.00, 1, 1, NULL, NULL, 'Purchase Product In', 1, 1, NULL, '2022-05-31 07:13:55', '2022-05-31 07:13:55'),
(3, 1, 1, 1, 1, 1, '00001', NULL, 3, 2, '2022-05-31', 10.00, 0.00, 80.00, 50.00, 0.00, 40.00, 0.00, 800.00, 500.00, 840.00, NULL, NULL, 2, 1, 'Sale Product Out', 1, 1, NULL, '2022-05-31 07:24:29', '2022-05-31 07:24:29');

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
(113, '2022_03_13_121235_create_balance_transfers_table', 43);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
  `product_category_id` bigint(20) UNSIGNED DEFAULT NULL,
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

INSERT INTO `products` (`id`, `client_id`, `product_category_id`, `product_unit_id`, `name`, `code`, `buy_price`, `sale_price`, `whole_sale_price`, `tax`, `vat`, `minimum_alert`, `image`, `description`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Cable IPhone', '00001', 50.00, 80.00, 700.00, 5.00, 0.00, 50.00, NULL, 'cable IPhone 1M, 2A', 1, 1, NULL, '2022-02-10 09:56:51', '2022-02-20 05:29:25'),
(2, 1, 1, 1, 'Cable Micro', '00002', 200.00, 300.00, 250.00, 0.00, 0.00, 0.00, NULL, NULL, 1, 1, NULL, '2022-02-15 06:23:24', '2022-02-15 06:23:24'),
(3, 1, 2, 1, 'Keyboard', '00003', 500.00, 600.00, 550.00, 0.00, 0.00, 0.00, NULL, NULL, 1, 1, NULL, '2022-06-11 17:56:01', '2022-06-11 17:56:01'),
(4, 1, 3, 1, 'Mouse', '00004', 300.00, 350.00, 320.00, 0.00, 0.00, 5.00, NULL, NULL, 1, 1, NULL, '2022-06-11 17:56:54', '2022-06-11 17:56:54');

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
(1, 1, 'Stationary', 'Description here', 1, 1, NULL, '2022-02-09 10:32:57', '2022-02-09 10:32:57'),
(2, 1, 'Keyboard', NULL, 1, 1, NULL, '2022-06-11 17:54:30', '2022-06-11 17:54:30'),
(3, 1, 'Mouse', NULL, 1, 1, NULL, '2022-06-11 17:54:48', '2022-06-11 17:54:48'),
(4, 1, 'Monitor', NULL, 1, 1, NULL, '2022-06-11 17:54:58', '2022-06-11 17:54:58');

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
(1, 1, 'pcs', 1, 1, NULL, '2022-02-13 07:17:10', '2022-02-13 07:17:57'),
(2, 1, 'Pkt', 1, 1, NULL, '2022-06-11 03:37:21', '2022-06-11 03:37:21'),
(3, 1, 'Rim', 1, 1, NULL, '2022-06-11 03:37:40', '2022-06-11 03:37:40'),
(4, 1, 'Box', 1, 1, NULL, '2022-06-11 03:37:52', '2022-06-11 03:37:52');

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
(1, 1, 1, 1, '00001', 1, '2022-05-31', 1, 0.00, 27500.00, 0.00, 27500.00, 7500.00, 20000.00, 'Test', 1, 1, NULL, '2022-05-31 07:13:55', '2022-06-05 07:01:20');

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

INSERT INTO `purchase_order_products` (`id`, `client_id`, `section_id`, `company_branch_id`, `purchase_order_id`, `supplier_id`, `product_id`, `product_category_id`, `inventory_log_id`, `date`, `name`, `code`, `discount`, `quantity`, `return_quantity`, `return_at`, `unit_price`, `product_total`, `return_total`, `total`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, '2022-05-31', 'Cable IPhone', '00001', 0.00, 150.00, 0.00, NULL, 50.00, 7500.00, 0.00, 7500.00, 1, 1, NULL, '2022-05-31 07:13:55', '2022-05-31 07:13:55'),
(2, 1, 1, 1, 1, 1, 2, 1, 2, '2022-05-31', 'Cable Micro', '00002', 0.00, 100.00, 0.00, NULL, 200.00, 20000.00, 0.00, 20000.00, 1, 1, NULL, '2022-05-31 07:13:55', '2022-05-31 07:13:55');

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
(1, 1, 1, 1, '00001', 2, '2022-05-31', 1, 0.00, 40.00, 40.00, 40.00, 0.00, 800.00, 840.00, 0.00, 800.00, 500.00, 300.00, NULL, 1, NULL, NULL, '2022-05-31 07:24:29', '2022-05-31 07:24:29');

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
  `product_discount` double(20,2) DEFAULT 0.00,
  `discount` double(20,2) DEFAULT 0.00,
  `quantity` double(20,2) DEFAULT 0.00,
  `return_quantity` double(20,2) NOT NULL DEFAULT 0.00,
  `return_at` timestamp NULL DEFAULT NULL,
  `unit_price` double(20,2) DEFAULT 0.00,
  `buy_price` double(20,2) DEFAULT 0.00,
  `tax` double(20,2) DEFAULT 0.00,
  `vat` double(20,2) DEFAULT 0.00,
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

INSERT INTO `sale_order_products` (`id`, `client_id`, `section_id`, `company_branch_id`, `sale_order_id`, `customer_id`, `product_id`, `product_category_id`, `inventory_log_id`, `date`, `name`, `code`, `product_discount`, `discount`, `quantity`, `return_quantity`, `return_at`, `unit_price`, `buy_price`, `tax`, `vat`, `product_total`, `return_total`, `buy_total`, `total`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 2, 1, 1, 3, '2022-05-31', 'Cable IPhone', '00001', 0.00, 40.00, 10.00, 0.00, NULL, 80.00, 50.00, 40.00, 0.00, 800.00, 0.00, 800.00, 800.00, 1, 1, NULL, '2022-05-31 07:24:29', '2022-05-31 07:24:29');

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
(2, 'Traning Center', 'training', NULL, 1, '2022-02-06 07:15:42', '2022-02-06 07:15:42');

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
(1, 1, 'Ma Computer And Training Center', 'public/setting/frgOlfeLgtJdJVNmqnlSgVJ0aS00ZepdssZoAP5l.png', 'macomputer100@gmail.com', '01958414050', NULL, 'Kalampur Bazar, Dhamrai, Dhaka', '2022-02-06 11:23:58', '2022-06-12 03:41:10');

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
(3, 1, 'Jony', NULL, '12345678910', NULL, NULL, '77 Rue Roger Salengro', 1, 2, NULL, '2021-07-30 17:23:26', '2022-02-13 07:00:33'),
(4, 1, 'Md Uzzal Hossain', 'Alamin Stationary', '01958414050', NULL, 'macomputer100@gmail.com', 'Kalampur Bazar, Dhamrai, Dhaka', 1, 1, NULL, '2022-06-11 17:26:02', '2022-06-11 17:26:02');

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
  `transaction_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Income, 2=Expense, 3=Purchase, 4=Sale',
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

INSERT INTO `transaction_logs` (`id`, `client_id`, `section_id`, `company_branch_id`, `voucher_no`, `transaction_type`, `date`, `particular`, `account_class_id`, `account_head_id`, `account_id`, `payment_method`, `bank_id`, `debit`, `credit`, `amount`, `note`, `supplier_id`, `purchase_order_id`, `customer_id`, `sale_order_id`, `inventory_log_id`, `salary_process_id`, `employee_id`, `transaction_id`, `balance_transfer_id`, `adjustment_status`, `opening_status`, `user_id`, `status`, `delete_user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '00001', 1, '2022-05-31', 'Purchase of invoice no. 00001', 4, 1, 1, NULL, NULL, 0.00, 27500.00, 27500.00, 'Purchase from LT Plus', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-05-31 07:13:55', '2022-05-31 07:13:55'),
(2, 1, 1, 1, '00002', 1, '2022-05-31', 'Purchase payable for invoice no. 00001', 2, 7, 8, NULL, NULL, 0.00, 20000.00, 20000.00, 'Purchase payable from LT Plus', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-05-31 07:13:55', '2022-06-05 07:01:20'),
(3, 1, 1, 1, '00003', 2, '2022-05-31', 'Customer receivable for invoice no. 00001', 3, 2, 2, NULL, NULL, 0.00, 800.00, 0.00, 'Sale for AMA Librairie', NULL, NULL, 2, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-05-31 07:24:29', '2022-05-31 07:24:29'),
(4, 1, 1, 1, '00004', 2, '2022-05-31', 'Customer receive for invoice no. 00001', 1, 4, 3, 1, 1, 0.00, 500.00, 500.00, 'Sale receive fromAMA Librairie', NULL, NULL, 2, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-05-31 07:24:29', '2022-05-31 07:24:29'),
(5, 1, 1, 1, '00005', 2, '2022-05-31', 'Customer receivable for invoice no. 00001', 1, 8, 9, NULL, NULL, 0.00, 300.00, 300.00, 'Sale receivable from AMA Librairie', NULL, NULL, 2, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-05-31 07:24:30', '2022-05-31 07:24:30'),
(6, 1, 1, 1, '00006', 2, '2022-06-05', 'Supplier payment for invoice no. 00001', 1, 4, 3, 1, NULL, 7500.00, 0.00, 7500.00, 'Supplier payment of LT Plus', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-05 07:01:20', '2022-06-05 07:01:20'),
(7, 1, 1, 1, '00007', 9, '2022-06-05', 'Jony opening balance', 4, 1, 1, NULL, NULL, 0.00, 2000.00, 2000.00, 'Test', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 1, NULL, NULL, '2022-06-05 07:11:56', '2022-06-05 07:11:56'),
(8, 1, 1, 1, '00008', 9, '2022-06-07', 'Cash In Hand opening balance', 1, 4, 3, NULL, NULL, 0.00, 50000.00, 50000.00, 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 1, NULL, NULL, '2022-06-07 10:30:28', '2022-06-07 10:30:28'),
(9, 1, 1, 1, '00009', 6, '2022-06-07', 'Credit transaction for transaction no. 00001', 4, 50, 101, NULL, NULL, 0.00, 200.00, 200.00, 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-07 12:29:07', '2022-06-07 12:29:07'),
(10, 1, 1, 1, '00010', 1, '2022-06-07', 'Credit transaction for transaction no. 00001', 1, 4, 3, 1, 1, 200.00, 0.00, 200.00, 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, 0, 1, 1, NULL, NULL, '2022-06-07 12:29:07', '2022-06-07 12:29:07'),
(11, 1, 1, 1, '00011', 9, '2022-06-12', 'Sales Center opening balance', NULL, 2, 102, NULL, NULL, 0.00, 10000.00, 10000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 1, NULL, NULL, '2022-06-11 18:01:42', '2022-06-11 18:01:42'),
(12, 1, 1, 2, '00012', 8, '2022-06-12', 'Debit Balance Transfer from Bank', 1, 4, 4, 2, 2, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, NULL, NULL, '2022-06-11 18:06:45', '2022-06-11 18:06:45'),
(13, 1, 1, 2, '00013', 8, '2022-06-12', 'Credit Balance Transfer from Bank', 1, 4, 4, 2, 1, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, NULL, NULL, '2022-06-11 18:06:45', '2022-06-11 18:06:45');

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
(1, 1, NULL, NULL, 'One Point', 'admin@gmail.com', NULL, 1, NULL, '$2a$12$UXoNZrVnmqHmwdOv2RbQLeT2eYn/8XyhDV0n1.SWwkgGzdXNIc2hG', 'tz8X7srhr0LqK3cOOMkFgrmX6BIXTjL6CkB3IUnUWOywC8cFzU06sr0fdu6D', 1, 1, 1, NULL, '2020-08-20 15:16:14', '2022-06-12 07:20:52'),
(2, 1, 1, NULL, 'Admin', 'admin1@gmail.com', NULL, 2, NULL, '$2a$12$Wvi1dtw2d0kziysPM.UmcOMpcXfhdrb8HXswhf8wMVdmIDcz8P5aO', 'pBmzx9hzgYDJiIxjnpQvtJrbMlFcTjEwx4uZm4wtn6pjIdaMteSaThU8hJi2', 1, 1, 1, NULL, '2020-08-20 15:21:49', '2022-06-08 08:46:57'),
(9, 1, NULL, NULL, 'Training Admin', 'training@gmail.com', '11122211111', 2, NULL, '$2y$10$fHxeMhO4ko7FSnDnDQTY1.G0JJ4pec6nUSmo977pEHG4F8AeHxpEO', NULL, 2, 1, 1, NULL, '2022-02-08 11:01:50', '2022-06-08 06:51:57'),
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
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `account_classes`
--
ALTER TABLE `account_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `account_heads`
--
ALTER TABLE `account_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `balance_transfers`
--
ALTER TABLE `balance_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_branches`
--
ALTER TABLE `company_branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `months`
--
ALTER TABLE `months`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_units`
--
ALTER TABLE `product_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_order_products`
--
ALTER TABLE `purchase_order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sale_order_products`
--
ALTER TABLE `sale_order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
