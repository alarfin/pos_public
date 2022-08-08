-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 08, 2022 at 07:56 PM
-- Server version: 10.3.35-MariaDB-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opitdev_larapos`
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
(5, 0, 4, 5, 'Damage Product', 1, 0, 1, NULL, '2022-02-26 12:00:14', '2022-02-26 12:00:14'),
(6, 0, 5, 3, 'Capital', 1, 0, 1, NULL, '2022-02-26 12:00:14', '2022-02-26 12:00:14'),
(7, 0, 4, 6, 'Salary', 1, 0, 1, NULL, '2022-02-26 11:59:02', '2022-02-26 11:59:02'),
(8, 0, 2, 7, 'Purchase Payable', 1, 0, 1, NULL, '2022-02-26 11:59:02', '2022-02-26 11:59:02'),
(9, 0, 1, 8, 'Sale Receivable', 1, 0, 1, NULL, '2022-02-26 12:00:14', '2022-02-26 12:00:14'),
(10, 0, 2, 7, 'Salary Payable', 1, 0, 1, NULL, '2022-02-26 12:00:14', '2022-02-26 12:00:14'),
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
(5, 0, 4, 'Damage Product', 1, 1, NULL, '2022-02-27 09:17:57', '2022-02-27 09:17:57'),
(6, 0, 4, 'Salary Process', 1, 1, NULL, '2022-02-27 09:17:57', '2022-02-27 09:17:57'),
(7, 0, 2, 'Account Payable', 1, 1, NULL, '2022-02-27 09:17:57', '2022-02-27 09:17:57'),
(8, 0, 1, 'Account Receivable', 1, 1, NULL, '2022-02-27 09:17:57', '2022-02-27 09:17:57'),
(101, 1, 4, 'Office Income', 0, 1, NULL, '2022-02-28 11:58:33', '2022-02-28 11:58:33'),
(102, 1, 4, 'Office Expense', 0, 1, NULL, '2022-02-28 11:58:33', '2022-02-28 11:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `balance_transfers`
--

CREATE TABLE `balance_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
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
(1, 1, 'Dutch Bangla Bank', 'Company Account', '4008 111 000 100 15', 'DBBL', NULL, 1, 1, '2022-07-26 11:41:06', '2022-07-26 11:41:06'),
(2, 1, 'Islamic Bank ltd.', 'Testing Bank Account', '4008 111 000 100', 'IBLTD', 'Uttara', 1, 1, '2022-07-26 11:41:58', '2022-07-26 11:41:58'),
(3, 1, 'test', 'test', '123457', '7654', 'mirpur', 1, 1, '2022-08-04 06:33:18', '2022-08-04 06:33:18');

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

INSERT INTO `company_branches` (`id`, `client_id`, `name`, `email`, `mobile_no`, `address`, `image`, `logo`, `description`, `status`, `user_id`, `delete_user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rampura', NULL, '01722111112', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, '2022-07-26 11:33:18', '2022-07-26 11:33:18'),
(2, 1, 'Malibag', NULL, '01222333221', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, '2022-07-26 11:33:37', '2022-07-26 11:33:37'),
(3, 1, 'Hatirjhil', NULL, '01322211210', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, '2022-07-26 11:34:05', '2022-07-26 11:34:05');

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
(1, 1, 'Jahidul Islam', '12123214251', NULL, NULL, 1, 1, NULL, '2022-07-26 11:50:04', '2022-07-26 11:50:04'),
(2, 1, 'Shahidul Islam', '01222111210', NULL, NULL, 1, 1, NULL, '2022-07-26 11:50:29', '2022-07-26 11:50:29'),
(3, 1, 'test', '01711589794', 'admin@gmail.com', 'hgf4', 1, 1, NULL, '2022-08-04 06:32:38', '2022-08-04 06:32:38');

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
(1, 1, 'IT Engineer', 'IT', 0, 1, 1, NULL, '2022-07-26 11:50:50', '2022-07-26 11:50:50'),
(2, 1, 'General Manager', 'GM', 0, 1, 1, NULL, '2022-07-26 11:51:04', '2022-07-26 11:51:04'),
(3, 1, 'Salesman', 'SM', 0, 1, 1, NULL, '2022-07-26 11:51:21', '2022-07-26 11:51:21');

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
(1, 1, '1', '1', '2022-08-04', NULL, '2022-08-04 06:38:57', '2022-08-04 06:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
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

INSERT INTO `employees` (`id`, `client_id`, `company_branch_id`, `id_no`, `designation_id`, `name`, `email`, `father_name`, `mother_name`, `photo`, `signature`, `salary`, `birth_date`, `permanent_address`, `present_address`, `join_date`, `nid_no`, `mobile_no`, `religion`, `gender`, `marital_status`, `status`, `user_id`, `own_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '00001', 1, 'test', 'superadmin@gmail.com', 'test', NULL, NULL, NULL, '10000', '2000-08-02', NULL, NULL, '2022-08-04', '12345', '01919235690', NULL, 1, 1, 1, 1, 14, NULL, '2022-08-04 06:38:57', '2022-08-04 06:38:57');

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
  `company_branch_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_color_id` int(11) DEFAULT NULL,
  `product_size_id` int(11) DEFAULT NULL,
  `product_category_id` int(15) DEFAULT NULL,
  `product_brand_id` int(11) DEFAULT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Purchase,2=Manually Stock, 3=Sale, 4=Damage, 5=Product transfer',
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
  `product_transfer_id` bigint(20) DEFAULT NULL,
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

INSERT INTO `inventory_logs` (`id`, `client_id`, `company_branch_id`, `product_id`, `product_color_id`, `product_size_id`, `product_category_id`, `product_brand_id`, `code`, `invoice_no`, `stock_type`, `type`, `date`, `serial_no`, `quantity`, `return_quantity`, `unit_price`, `buy_price`, `discount`, `tax`, `vat`, `product_total`, `buy_total`, `total`, `supplier_id`, `purchase_order_id`, `customer_id`, `sale_order_id`, `product_transfer_id`, `note`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 2, NULL, '00001', NULL, 1, 1, '2022-08-01', NULL, 150.00, 0.00, 100.00, 100.00, 0.00, 0.00, 0.00, 15000.00, 15000.00, 15000.00, 1, 1, NULL, NULL, NULL, 'Purchase Product In', 1, 1, NULL, '2022-08-01 09:41:44', '2022-08-01 09:41:44'),
(2, 1, 1, 2, 1, 1, 2, NULL, '00002', NULL, 1, 1, '2022-08-01', NULL, 200.00, 0.00, 50.00, 50.00, 0.00, 0.00, 0.00, 10000.00, 10000.00, 10000.00, 1, 1, NULL, NULL, NULL, 'Purchase Product In', 1, 1, NULL, '2022-08-01 09:41:44', '2022-08-01 09:41:44'),
(3, 1, 1, 3, 2, 1, 2, NULL, '00003', NULL, 1, 1, '2022-08-01', NULL, 20.00, 0.00, 25000.00, 25000.00, 0.00, 0.00, 0.00, 500000.00, 500000.00, 500000.00, 1, 1, NULL, NULL, NULL, 'Purchase Product In', 1, 1, NULL, '2022-08-01 09:41:44', '2022-08-01 09:41:44'),
(4, 1, 1, 1, 1, 1, 2, NULL, '00001', NULL, 3, 2, '2022-08-01', NULL, 5.00, 0.00, 150.00, 100.00, 0.00, 0.00, 0.00, 750.00, 500.00, 750.00, NULL, NULL, 1, 1, NULL, 'Sale Product Out', 1, 1, NULL, '2022-08-01 09:43:11', '2022-08-01 09:43:11'),
(5, 1, 1, 5, 4, 4, 3, NULL, '00005', NULL, 1, 1, '2022-08-04', NULL, 900.00, 100.00, 60.00, 60.00, 10.00, 0.00, 0.00, 60000.00, 59990.00, 59990.00, 3, 2, NULL, NULL, NULL, 'Purchase Product In', 1, 1, NULL, '2022-08-04 06:53:08', '2022-08-04 07:27:36'),
(6, 1, 2, 5, 4, 4, 3, 4, '00005', NULL, 5, 1, '2022-08-04', NULL, 200.00, 0.00, 60.00, 60.00, 0.00, 0.00, 0.00, 0.00, 12000.00, 12000.00, NULL, NULL, NULL, NULL, 1, 'Product Transfer In', 1, 1, NULL, '2022-08-04 06:57:07', '2022-08-04 06:57:07'),
(7, 1, 1, 5, 4, 4, 3, 4, '00005', NULL, 5, 2, '2022-08-04', NULL, 200.00, 0.00, 60.00, 60.00, 0.00, 0.00, 0.00, 0.00, 12000.00, 12000.00, NULL, NULL, NULL, NULL, 1, 'Product Transfer In', 1, 1, NULL, '2022-08-04 06:57:07', '2022-08-04 06:57:07'),
(8, 1, 1, 5, 4, 4, 3, NULL, '00005', '00001', 4, 2, '2022-08-04', NULL, 10.00, 0.00, 60.00, 0.00, 0.00, 0.00, 0.00, 600.00, 0.00, 600.00, NULL, NULL, NULL, NULL, NULL, 'Product Damage', 1, 1, NULL, '2022-08-04 07:02:50', '2022-08-04 07:02:50'),
(9, 1, 1, 5, 4, 4, 3, NULL, '00005', NULL, 3, 2, '2022-08-04', NULL, 3.00, 2.00, 80.00, 60.00, 0.00, 0.00, 0.00, 400.00, 300.00, 400.00, NULL, NULL, 3, 2, NULL, 'Sale Product Out', 1, 1, NULL, '2022-08-04 07:16:43', '2022-08-04 07:37:02');

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
(155, '2022_07_25_111156_create_student_results_table', 64),
(156, '2022_07_30_165338_create_product_colors_table', 65),
(157, '2022_07_30_175432_create_product_sizes_table', 66),
(159, '2022_07_31_162534_create_product_transfers_table', 67);

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
(1, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 1),
(2, 'App\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\User', 2),
(2, 'App\\User', 3),
(2, 'App\\Models\\User', 13),
(3, 'App\\Models\\User', 1),
(3, 'App\\User', 1),
(3, 'App\\Models\\User', 2),
(3, 'App\\User', 2),
(3, 'App\\User', 3),
(3, 'App\\Models\\User', 13),
(4, 'App\\Models\\User', 1),
(4, 'App\\User', 1),
(4, 'App\\Models\\User', 2),
(4, 'App\\User', 2),
(4, 'App\\User', 3),
(4, 'App\\Models\\User', 13),
(5, 'App\\Models\\User', 1),
(5, 'App\\User', 1),
(5, 'App\\Models\\User', 2),
(5, 'App\\User', 2),
(5, 'App\\User', 3),
(5, 'App\\Models\\User', 13),
(6, 'App\\Models\\User', 1),
(6, 'App\\User', 1),
(6, 'App\\Models\\User', 2),
(6, 'App\\User', 2),
(6, 'App\\User', 3),
(6, 'App\\Models\\User', 13),
(7, 'App\\Models\\User', 1),
(7, 'App\\User', 1),
(7, 'App\\Models\\User', 2),
(7, 'App\\User', 2),
(7, 'App\\User', 3),
(7, 'App\\Models\\User', 13),
(8, 'App\\Models\\User', 1),
(8, 'App\\User', 1),
(8, 'App\\Models\\User', 2),
(8, 'App\\User', 2),
(8, 'App\\User', 3),
(8, 'App\\Models\\User', 13),
(9, 'App\\Models\\User', 1),
(9, 'App\\User', 1),
(9, 'App\\Models\\User', 2),
(9, 'App\\User', 2),
(9, 'App\\User', 3),
(9, 'App\\Models\\User', 13),
(10, 'App\\Models\\User', 1),
(10, 'App\\User', 1),
(10, 'App\\Models\\User', 2),
(10, 'App\\User', 2),
(10, 'App\\User', 3),
(10, 'App\\Models\\User', 13),
(11, 'App\\Models\\User', 1),
(11, 'App\\User', 1),
(11, 'App\\Models\\User', 2),
(11, 'App\\User', 2),
(11, 'App\\User', 3),
(11, 'App\\Models\\User', 13),
(12, 'App\\Models\\User', 1),
(12, 'App\\User', 1),
(12, 'App\\Models\\User', 2),
(12, 'App\\User', 2),
(12, 'App\\User', 3),
(12, 'App\\Models\\User', 13),
(13, 'App\\Models\\User', 1),
(13, 'App\\User', 1),
(13, 'App\\Models\\User', 2),
(13, 'App\\User', 2),
(13, 'App\\User', 3),
(13, 'App\\Models\\User', 13),
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
(14, 'App\\Models\\User', 13),
(15, 'App\\Models\\User', 1),
(15, 'App\\User', 1),
(15, 'App\\Models\\User', 2),
(15, 'App\\User', 2),
(15, 'App\\User', 3),
(15, 'App\\User', 5),
(15, 'App\\User', 6),
(15, 'App\\User', 7),
(15, 'App\\User', 8),
(15, 'App\\Models\\User', 13),
(16, 'App\\Models\\User', 1),
(16, 'App\\Models\\User', 2),
(16, 'App\\Models\\User', 13),
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
(17, 'App\\Models\\User', 13),
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
(18, 'App\\Models\\User', 13),
(19, 'App\\Models\\User', 1),
(19, 'App\\User', 1),
(19, 'App\\Models\\User', 2),
(19, 'App\\User', 2),
(19, 'App\\User', 3),
(19, 'App\\Models\\User', 13),
(20, 'App\\Models\\User', 1),
(20, 'App\\User', 1),
(20, 'App\\Models\\User', 2),
(20, 'App\\User', 2),
(20, 'App\\User', 3),
(20, 'App\\Models\\User', 13),
(21, 'App\\Models\\User', 1),
(21, 'App\\User', 1),
(21, 'App\\Models\\User', 2),
(21, 'App\\User', 2),
(21, 'App\\User', 3),
(21, 'App\\Models\\User', 13),
(22, 'App\\Models\\User', 1),
(22, 'App\\User', 1),
(22, 'App\\Models\\User', 2),
(22, 'App\\User', 2),
(22, 'App\\User', 3),
(22, 'App\\Models\\User', 13),
(23, 'App\\Models\\User', 1),
(23, 'App\\User', 1),
(23, 'App\\Models\\User', 2),
(23, 'App\\User', 2),
(23, 'App\\User', 3),
(23, 'App\\Models\\User', 13),
(24, 'App\\Models\\User', 1),
(24, 'App\\User', 1),
(24, 'App\\Models\\User', 2),
(24, 'App\\User', 2),
(24, 'App\\User', 3),
(24, 'App\\Models\\User', 13),
(25, 'App\\Models\\User', 1),
(25, 'App\\User', 1),
(25, 'App\\Models\\User', 2),
(25, 'App\\User', 2),
(25, 'App\\User', 3),
(25, 'App\\Models\\User', 13),
(26, 'App\\Models\\User', 1),
(26, 'App\\User', 1),
(26, 'App\\Models\\User', 2),
(26, 'App\\User', 2),
(26, 'App\\User', 3),
(26, 'App\\Models\\User', 13),
(27, 'App\\Models\\User', 1),
(27, 'App\\User', 1),
(27, 'App\\Models\\User', 2),
(27, 'App\\User', 2),
(27, 'App\\User', 3),
(27, 'App\\Models\\User', 13),
(28, 'App\\Models\\User', 1),
(28, 'App\\User', 1),
(28, 'App\\Models\\User', 2),
(28, 'App\\User', 2),
(28, 'App\\User', 3),
(28, 'App\\Models\\User', 13),
(29, 'App\\Models\\User', 1),
(29, 'App\\User', 1),
(29, 'App\\Models\\User', 2),
(29, 'App\\User', 2),
(29, 'App\\User', 3),
(29, 'App\\Models\\User', 13),
(30, 'App\\Models\\User', 1),
(30, 'App\\User', 1),
(30, 'App\\Models\\User', 2),
(30, 'App\\User', 2),
(30, 'App\\User', 3),
(30, 'App\\Models\\User', 13),
(31, 'App\\Models\\User', 1),
(31, 'App\\User', 1),
(31, 'App\\Models\\User', 2),
(31, 'App\\User', 2),
(31, 'App\\User', 3),
(31, 'App\\Models\\User', 13),
(32, 'App\\Models\\User', 1),
(32, 'App\\User', 1),
(32, 'App\\Models\\User', 2),
(32, 'App\\User', 2),
(32, 'App\\User', 3),
(32, 'App\\Models\\User', 13),
(33, 'App\\Models\\User', 1),
(33, 'App\\User', 1),
(33, 'App\\Models\\User', 2),
(33, 'App\\User', 2),
(33, 'App\\User', 3),
(33, 'App\\Models\\User', 13),
(34, 'App\\Models\\User', 1),
(34, 'App\\User', 1),
(34, 'App\\Models\\User', 2),
(34, 'App\\User', 2),
(34, 'App\\User', 3),
(34, 'App\\Models\\User', 13),
(35, 'App\\Models\\User', 1),
(35, 'App\\User', 1),
(35, 'App\\Models\\User', 2),
(35, 'App\\User', 2),
(35, 'App\\Models\\User', 13),
(36, 'App\\Models\\User', 1),
(36, 'App\\User', 1),
(36, 'App\\Models\\User', 2),
(36, 'App\\User', 3),
(36, 'App\\Models\\User', 13),
(37, 'App\\Models\\User', 1),
(37, 'App\\Models\\User', 2),
(37, 'App\\Models\\User', 13),
(38, 'App\\Models\\User', 1),
(38, 'App\\Models\\User', 2),
(38, 'App\\Models\\User', 13),
(39, 'App\\Models\\User', 1),
(39, 'App\\Models\\User', 2),
(39, 'App\\Models\\User', 13),
(40, 'App\\Models\\User', 1),
(40, 'App\\Models\\User', 2),
(40, 'App\\Models\\User', 13),
(41, 'App\\Models\\User', 1),
(41, 'App\\Models\\User', 2),
(41, 'App\\Models\\User', 13),
(42, 'App\\Models\\User', 1),
(42, 'App\\Models\\User', 2),
(42, 'App\\Models\\User', 13),
(43, 'App\\Models\\User', 1),
(43, 'App\\Models\\User', 2),
(43, 'App\\Models\\User', 13),
(44, 'App\\Models\\User', 1),
(44, 'App\\Models\\User', 2),
(44, 'App\\Models\\User', 13),
(45, 'App\\Models\\User', 1),
(45, 'App\\Models\\User', 2),
(45, 'App\\Models\\User', 13),
(46, 'App\\Models\\User', 1),
(46, 'App\\Models\\User', 2),
(46, 'App\\Models\\User', 13),
(47, 'App\\Models\\User', 1),
(47, 'App\\Models\\User', 2),
(47, 'App\\Models\\User', 13),
(48, 'App\\Models\\User', 1),
(48, 'App\\Models\\User', 2),
(48, 'App\\Models\\User', 13),
(49, 'App\\Models\\User', 1),
(49, 'App\\Models\\User', 2),
(49, 'App\\Models\\User', 13),
(50, 'App\\Models\\User', 1),
(50, 'App\\Models\\User', 2),
(50, 'App\\Models\\User', 13),
(51, 'App\\Models\\User', 1),
(51, 'App\\Models\\User', 2),
(51, 'App\\Models\\User', 13),
(52, 'App\\Models\\User', 1),
(52, 'App\\Models\\User', 2),
(52, 'App\\Models\\User', 13),
(53, 'App\\Models\\User', 1),
(53, 'App\\Models\\User', 2),
(53, 'App\\Models\\User', 13),
(54, 'App\\Models\\User', 1),
(54, 'App\\Models\\User', 2),
(54, 'App\\Models\\User', 13),
(55, 'App\\Models\\User', 1),
(55, 'App\\Models\\User', 2),
(55, 'App\\Models\\User', 13),
(56, 'App\\Models\\User', 1),
(56, 'App\\Models\\User', 2),
(56, 'App\\Models\\User', 13),
(57, 'App\\Models\\User', 1),
(57, 'App\\Models\\User', 2),
(57, 'App\\Models\\User', 13),
(58, 'App\\Models\\User', 1),
(58, 'App\\Models\\User', 2),
(58, 'App\\Models\\User', 13),
(59, 'App\\Models\\User', 1),
(59, 'App\\Models\\User', 2),
(59, 'App\\Models\\User', 13),
(60, 'App\\Models\\User', 1),
(60, 'App\\Models\\User', 2),
(60, 'App\\Models\\User', 13),
(61, 'App\\Models\\User', 1),
(61, 'App\\Models\\User', 2),
(61, 'App\\Models\\User', 13),
(62, 'App\\Models\\User', 1),
(62, 'App\\Models\\User', 2),
(62, 'App\\Models\\User', 13),
(63, 'App\\Models\\User', 1),
(63, 'App\\Models\\User', 2),
(63, 'App\\Models\\User', 13),
(64, 'App\\Models\\User', 1),
(64, 'App\\Models\\User', 2),
(64, 'App\\Models\\User', 13),
(65, 'App\\Models\\User', 1),
(65, 'App\\Models\\User', 2),
(65, 'App\\Models\\User', 13),
(66, 'App\\Models\\User', 1),
(66, 'App\\Models\\User', 2),
(66, 'App\\Models\\User', 13),
(67, 'App\\Models\\User', 1),
(67, 'App\\Models\\User', 2),
(67, 'App\\Models\\User', 13),
(68, 'App\\Models\\User', 1),
(68, 'App\\Models\\User', 2),
(68, 'App\\Models\\User', 13),
(69, 'App\\Models\\User', 1),
(69, 'App\\Models\\User', 2),
(69, 'App\\Models\\User', 13),
(70, 'App\\Models\\User', 1),
(70, 'App\\Models\\User', 2),
(70, 'App\\Models\\User', 13),
(71, 'App\\Models\\User', 1),
(71, 'App\\Models\\User', 2),
(71, 'App\\Models\\User', 13),
(72, 'App\\Models\\User', 1),
(72, 'App\\Models\\User', 2),
(72, 'App\\Models\\User', 13),
(73, 'App\\Models\\User', 1),
(73, 'App\\Models\\User', 2),
(73, 'App\\Models\\User', 13),
(74, 'App\\Models\\User', 1),
(74, 'App\\Models\\User', 2),
(74, 'App\\Models\\User', 13),
(75, 'App\\Models\\User', 1),
(75, 'App\\Models\\User', 2),
(75, 'App\\Models\\User', 13),
(76, 'App\\Models\\User', 1),
(76, 'App\\Models\\User', 2),
(76, 'App\\Models\\User', 13),
(77, 'App\\Models\\User', 1),
(77, 'App\\Models\\User', 2),
(77, 'App\\Models\\User', 13),
(78, 'App\\Models\\User', 1),
(78, 'App\\Models\\User', 2),
(78, 'App\\Models\\User', 13),
(79, 'App\\Models\\User', 1),
(79, 'App\\Models\\User', 2),
(79, 'App\\Models\\User', 13),
(80, 'App\\Models\\User', 1),
(80, 'App\\Models\\User', 2),
(80, 'App\\Models\\User', 13),
(81, 'App\\Models\\User', 1),
(81, 'App\\Models\\User', 2),
(81, 'App\\Models\\User', 13),
(82, 'App\\Models\\User', 1),
(82, 'App\\Models\\User', 2),
(82, 'App\\Models\\User', 13),
(83, 'App\\Models\\User', 1),
(83, 'App\\Models\\User', 2),
(83, 'App\\Models\\User', 13),
(84, 'App\\Models\\User', 1),
(84, 'App\\Models\\User', 2),
(84, 'App\\Models\\User', 13),
(85, 'App\\Models\\User', 1),
(85, 'App\\Models\\User', 2),
(85, 'App\\Models\\User', 13),
(86, 'App\\Models\\User', 1),
(86, 'App\\Models\\User', 2),
(86, 'App\\Models\\User', 13),
(87, 'App\\Models\\User', 1),
(87, 'App\\Models\\User', 2),
(87, 'App\\Models\\User', 13),
(88, 'App\\Models\\User', 1),
(88, 'App\\Models\\User', 2),
(88, 'App\\Models\\User', 13),
(89, 'App\\Models\\User', 1),
(89, 'App\\Models\\User', 2),
(89, 'App\\Models\\User', 13),
(90, 'App\\Models\\User', 1),
(90, 'App\\Models\\User', 2),
(90, 'App\\Models\\User', 13),
(91, 'App\\Models\\User', 1),
(91, 'App\\Models\\User', 2),
(91, 'App\\Models\\User', 13),
(92, 'App\\Models\\User', 1),
(92, 'App\\Models\\User', 2),
(92, 'App\\Models\\User', 13),
(93, 'App\\Models\\User', 1),
(93, 'App\\Models\\User', 2),
(93, 'App\\Models\\User', 13),
(94, 'App\\Models\\User', 1),
(94, 'App\\Models\\User', 2),
(94, 'App\\Models\\User', 13),
(95, 'App\\Models\\User', 1),
(95, 'App\\Models\\User', 2),
(95, 'App\\Models\\User', 13),
(96, 'App\\Models\\User', 1),
(96, 'App\\Models\\User', 2),
(96, 'App\\Models\\User', 13),
(97, 'App\\Models\\User', 1),
(97, 'App\\Models\\User', 2),
(97, 'App\\Models\\User', 13),
(98, 'App\\Models\\User', 1),
(98, 'App\\Models\\User', 2),
(98, 'App\\Models\\User', 13),
(99, 'App\\Models\\User', 1),
(99, 'App\\Models\\User', 2),
(99, 'App\\Models\\User', 13),
(100, 'App\\Models\\User', 1),
(100, 'App\\Models\\User', 2),
(100, 'App\\Models\\User', 13),
(101, 'App\\Models\\User', 1),
(101, 'App\\Models\\User', 2),
(101, 'App\\Models\\User', 13),
(102, 'App\\Models\\User', 1),
(102, 'App\\Models\\User', 2),
(102, 'App\\Models\\User', 13),
(103, 'App\\Models\\User', 1),
(103, 'App\\Models\\User', 2),
(103, 'App\\Models\\User', 13),
(104, 'App\\Models\\User', 1),
(104, 'App\\Models\\User', 2),
(104, 'App\\Models\\User', 13),
(105, 'App\\Models\\User', 1),
(105, 'App\\Models\\User', 2),
(105, 'App\\Models\\User', 13),
(106, 'App\\Models\\User', 1),
(106, 'App\\Models\\User', 2),
(106, 'App\\Models\\User', 13),
(107, 'App\\Models\\User', 1),
(107, 'App\\Models\\User', 2),
(107, 'App\\Models\\User', 13),
(108, 'App\\Models\\User', 1),
(108, 'App\\Models\\User', 2),
(108, 'App\\Models\\User', 13),
(109, 'App\\Models\\User', 1),
(109, 'App\\Models\\User', 2),
(109, 'App\\Models\\User', 13),
(110, 'App\\Models\\User', 1),
(110, 'App\\Models\\User', 2),
(110, 'App\\Models\\User', 13),
(111, 'App\\Models\\User', 1),
(111, 'App\\Models\\User', 2),
(111, 'App\\Models\\User', 13),
(112, 'App\\Models\\User', 1),
(112, 'App\\Models\\User', 2),
(112, 'App\\Models\\User', 13),
(113, 'App\\Models\\User', 1),
(113, 'App\\Models\\User', 2),
(113, 'App\\Models\\User', 13),
(114, 'App\\Models\\User', 1),
(114, 'App\\Models\\User', 2),
(114, 'App\\Models\\User', 13),
(115, 'App\\Models\\User', 1),
(115, 'App\\Models\\User', 2),
(115, 'App\\Models\\User', 13),
(116, 'App\\Models\\User', 1),
(116, 'App\\Models\\User', 2),
(116, 'App\\Models\\User', 13),
(117, 'App\\Models\\User', 1),
(117, 'App\\Models\\User', 2),
(117, 'App\\Models\\User', 13),
(118, 'App\\Models\\User', 1),
(118, 'App\\Models\\User', 2),
(118, 'App\\Models\\User', 13),
(119, 'App\\Models\\User', 1),
(119, 'App\\Models\\User', 2),
(119, 'App\\Models\\User', 13),
(120, 'App\\Models\\User', 1),
(120, 'App\\Models\\User', 2),
(120, 'App\\Models\\User', 13),
(121, 'App\\Models\\User', 1),
(121, 'App\\Models\\User', 2),
(121, 'App\\Models\\User', 13),
(122, 'App\\Models\\User', 1),
(122, 'App\\Models\\User', 2),
(122, 'App\\Models\\User', 13),
(123, 'App\\Models\\User', 1),
(123, 'App\\Models\\User', 2),
(123, 'App\\Models\\User', 13),
(124, 'App\\Models\\User', 1),
(124, 'App\\Models\\User', 2),
(124, 'App\\Models\\User', 13),
(125, 'App\\Models\\User', 1),
(125, 'App\\Models\\User', 2),
(125, 'App\\Models\\User', 13),
(126, 'App\\Models\\User', 1),
(126, 'App\\Models\\User', 2),
(126, 'App\\Models\\User', 13),
(127, 'App\\Models\\User', 1),
(127, 'App\\Models\\User', 2),
(127, 'App\\Models\\User', 13),
(128, 'App\\Models\\User', 1),
(128, 'App\\Models\\User', 2),
(128, 'App\\Models\\User', 13),
(129, 'App\\Models\\User', 1),
(129, 'App\\Models\\User', 2),
(129, 'App\\Models\\User', 13),
(130, 'App\\Models\\User', 1),
(130, 'App\\Models\\User', 2),
(130, 'App\\Models\\User', 13),
(131, 'App\\Models\\User', 1),
(131, 'App\\Models\\User', 2),
(131, 'App\\Models\\User', 13),
(132, 'App\\Models\\User', 1),
(132, 'App\\Models\\User', 2),
(132, 'App\\Models\\User', 13),
(133, 'App\\Models\\User', 1),
(133, 'App\\Models\\User', 2),
(133, 'App\\Models\\User', 13),
(134, 'App\\Models\\User', 1),
(134, 'App\\Models\\User', 2),
(134, 'App\\Models\\User', 13),
(135, 'App\\Models\\User', 1),
(135, 'App\\Models\\User', 2),
(135, 'App\\Models\\User', 13),
(136, 'App\\Models\\User', 1),
(136, 'App\\Models\\User', 2),
(136, 'App\\Models\\User', 13),
(137, 'App\\Models\\User', 1),
(137, 'App\\Models\\User', 2),
(137, 'App\\Models\\User', 13),
(138, 'App\\Models\\User', 1),
(138, 'App\\Models\\User', 2),
(139, 'App\\Models\\User', 1),
(139, 'App\\Models\\User', 2),
(140, 'App\\Models\\User', 1),
(140, 'App\\Models\\User', 2);

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
-- Table structure for table `online_expenses`
--

CREATE TABLE `online_expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `online_incomes`
--

CREATE TABLE `online_incomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
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
(1, 'administrator', 'web', '2022-08-01 08:51:41', '2022-08-01 08:51:41'),
(2, 'dashboard', 'web', '2022-08-01 08:51:41', '2022-08-01 08:51:41'),
(3, 'setting', 'web', '2022-08-01 08:51:41', '2022-08-01 08:51:41'),
(4, 'setting_edit', 'web', '2022-08-01 08:51:41', '2022-08-01 08:51:41'),
(5, 'company_branch', 'web', '2022-08-01 08:51:41', '2022-08-01 08:51:41'),
(6, 'company_branch_add', 'web', '2022-08-01 08:51:41', '2022-08-01 08:51:41'),
(7, 'company_branch_edit', 'web', '2022-08-01 08:51:41', '2022-08-01 08:51:41'),
(8, 'company_branch_delete', 'web', '2022-08-01 08:51:41', '2022-08-01 08:51:41'),
(9, 'user', 'web', '2022-08-01 08:51:41', '2022-08-01 08:51:41'),
(10, 'user_add', 'web', '2022-08-01 08:51:41', '2022-08-01 08:51:41'),
(11, 'user_edit', 'web', '2022-08-01 08:51:41', '2022-08-01 08:51:41'),
(12, 'bank', 'web', '2022-08-01 08:51:41', '2022-08-01 08:51:41'),
(13, 'bank_add', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(14, 'bank_edit', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(15, 'supplier', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(16, 'supplier_add', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(17, 'supplier_edit', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(18, 'supplier_delete', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(19, 'customer', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(20, 'customer_add', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(21, 'customer_edit', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(22, 'customer_delete', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(23, 'hr', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(24, 'designation', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(25, 'designation_add', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(26, 'designation_edit', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(27, 'designation_delete', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(28, 'employee', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(29, 'employee_add', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(30, 'employee_edit', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(31, 'employee_delete', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(32, 'employee_attendance', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(33, 'employee_attendance_add', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(34, 'employee_attendance_edit', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(35, 'salary_process', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(36, 'salary_process_add', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(37, 'salary_process_edit', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(38, 'salary_process_delete', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(39, 'products', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(40, 'product_unit', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(41, 'product_unit_add', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(42, 'product_unit_edit', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(43, 'product_unit_delete', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(44, 'product_category', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(45, 'product_category_add', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(46, 'product_category_edit', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(47, 'product_category_delete', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(48, 'product_brand', 'web', '2022-08-01 08:51:42', '2022-08-01 08:51:42'),
(49, 'product_brand_add', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(50, 'product_brand_edit', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(51, 'product_brand_delete', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(52, 'product_color', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(53, 'product_color_add', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(54, 'product_color_edit', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(55, 'product_color_delete', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(56, 'product_size', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(57, 'product_size_add', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(58, 'product_size_edit', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(59, 'product_size_delete', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(60, 'product', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(61, 'product_add', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(62, 'product_edit', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(63, 'product_delete', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(64, 'product_transfers', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(65, 'product_transfer_create', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(66, 'product_transfer_delete', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(67, 'product_damage', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(68, 'product_damage_add', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(69, 'product_damage_delete', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(70, 'product_inventory', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(71, 'product_inventory_details', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(72, 'purchase', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(73, 'purchase_add', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(74, 'purchase_edit', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(75, 'supplier_payment', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(76, 'price_quotation', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(77, 'price_quotation_add', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(78, 'price_quotation_edit', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(79, 'price_quotation_delete', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(80, 'sale', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(81, 'sale_add', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(82, 'sale_edit', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(83, 'sale_delete', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(84, 'customer_payment', 'web', '2022-08-01 08:51:43', '2022-08-01 08:51:43'),
(85, 'return', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(86, 'purchase_return', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(87, 'sale_return', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(88, 'others_income', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(89, 'others_income_add', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(90, 'others_income_edit', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(91, 'others_income_delete', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(92, 'others_expense', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(93, 'others_expense_add', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(94, 'others_expense_edit', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(95, 'others_expense_delete', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(96, 'accounts', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(97, 'account_head', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(98, 'account_head_add', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(99, 'account_head_edit', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(100, 'account', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(101, 'account_add', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(102, 'account_edit', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(103, 'debit_transaction', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(104, 'employee_debit_transaction_add', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(105, 'supplier_debit_transaction_add', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(106, 'debit_transaction_add', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(107, 'credit_transaction', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(108, 'employee_credit_transaction_add', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(109, 'supplier_credit_transaction_add', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(110, 'credit_transaction_add', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(111, 'balance_transfer', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(112, 'balance_transfer_add', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(113, 'account_adjustment', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(114, 'account_adjustment_add', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(115, 'opening_balance', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(116, 'employee_opening_add', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(117, 'customer_opening_add', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(118, 'supplier_opening_add', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(119, 'bank_opening_add', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(120, 'account_opening_add', 'web', '2022-08-01 08:51:44', '2022-08-01 08:51:44'),
(121, 'report', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(122, 'chart_of_account', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(123, 'trial_balance', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(124, 'ledger', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(125, 'cash_bank_statement', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(126, 'salary_sheet', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(127, 'supplier_report', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(128, 'supplier_due_report', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(129, 'customer_report', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(130, 'customer_due_report', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(131, 'report_purchase', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(132, 'report_purchase_product', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(133, 'report_purchase_product_return', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(134, 'report_sale', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(135, 'report_sale_product', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(136, 'report_sale_product_return', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(137, 'report_stock', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(138, 'report_sale_profit_loss', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(139, 'net_profit_loss', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45'),
(140, 'daily_balance_summary', 'web', '2022-08-01 08:51:45', '2022-08-01 08:51:45');

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
-- Table structure for table `price_quotations`
--

CREATE TABLE `price_quotations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
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

INSERT INTO `price_quotations` (`id`, `client_id`, `company_branch_id`, `invoice_no`, `customer_id`, `date`, `payment_method`, `product_discount`, `discount`, `total_discount`, `tax`, `vat`, `product_sub_total`, `sub_total`, `total`, `paid`, `due`, `note`, `user_id`, `delete_user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '00001', 1, '2022-08-01', NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 2250.00, 2250.00, 2250.00, 0.00, 2250.00, NULL, 1, NULL, NULL, '2022-08-01 09:42:32', '2022-08-01 09:42:39'),
(2, 1, 1, '00002', 1, '2022-08-04', NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 800.00, 800.00, 800.00, 0.00, 800.00, 'test', 1, NULL, NULL, '2022-08-04 07:07:05', '2022-08-04 07:07:05');

-- --------------------------------------------------------

--
-- Table structure for table `price_quotation_products`
--

CREATE TABLE `price_quotation_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
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

INSERT INTO `price_quotation_products` (`id`, `client_id`, `company_branch_id`, `price_quotation_id`, `customer_id`, `product_id`, `product_category_id`, `inventory_log_id`, `date`, `name`, `code`, `warranty`, `guarantee`, `serial_no`, `product_discount`, `discount`, `quantity`, `unit_price`, `buy_price`, `tax`, `tax_percentage`, `vat`, `vat_percentage`, `product_total`, `buy_total`, `total`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 2, NULL, '2022-08-01', 'Cable IPhone', '00001', '6 Month', '1 Week', NULL, 0.00, 0.00, 15.00, 150.00, 100.00, 0.00, 0.00, 0.00, 0.00, 2250.00, 2250.00, 2250.00, 1, 1, NULL, '2022-08-01 09:42:32', '2022-08-01 09:42:32'),
(2, 1, 1, 2, 1, 5, 3, NULL, '2022-08-04', 'test', '00005', NULL, NULL, NULL, 0.00, 0.00, 10.00, 80.00, 60.00, 0.00, 0.00, 0.00, 0.00, 800.00, 800.00, 800.00, 1, 1, NULL, '2022-08-04 07:07:05', '2022-08-04 07:07:05');

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
  `product_color_id` int(11) DEFAULT NULL,
  `product_size_id` int(11) DEFAULT NULL,
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

INSERT INTO `products` (`id`, `client_id`, `product_category_id`, `product_brand_id`, `product_unit_id`, `product_color_id`, `product_size_id`, `name`, `code`, `buy_price`, `sale_price`, `whole_sale_price`, `tax`, `vat`, `minimum_alert`, `image`, `warranty`, `guarantee`, `description`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 1, 1, 1, 'Cable IPhone', '00001', 100.00, 150.00, 140.00, 0.00, 0.00, 5.00, NULL, '6 Month', '1 Week', NULL, 1, 1, NULL, '2022-07-26 12:00:50', '2022-07-31 04:50:42'),
(2, 1, 2, 1, 1, 1, 1, 'Cable Android', '00002', 50.00, 100.00, 90.00, 0.00, 0.00, 5.00, NULL, '3 Month', NULL, NULL, 1, 1, NULL, '2022-07-26 12:01:38', '2022-07-31 04:50:47'),
(3, 1, 2, 3, 1, 2, 1, 'Laptop', '00003', 25000.00, 32000.00, 30000.00, 0.00, 0.00, 2.00, NULL, '1 Year', NULL, NULL, 1, 1, NULL, '2022-07-31 04:45:15', '2022-07-31 04:45:15'),
(4, 1, 2, 1, 1, 3, 1, 'Samsun Galaxy A10', '00004', 8000.00, 12000.00, 11000.00, 0.00, 0.00, 3.00, NULL, '1 Year', NULL, NULL, 1, 1, NULL, '2022-08-02 10:26:48', '2022-08-02 10:26:48'),
(5, 1, 3, 4, 1, 4, 4, 'test', '00005', 60.00, 80.00, 75.00, 0.00, 0.00, 5.00, NULL, NULL, NULL, 'test', 1, 1, NULL, '2022-08-04 06:45:28', '2022-08-04 06:45:28');

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
(1, 1, 'Samsung', NULL, 1, 1, NULL, '2022-07-26 11:58:37', '2022-07-26 11:58:37'),
(2, 1, 'Boshundhara', NULL, 1, 1, NULL, '2022-07-26 11:58:51', '2022-07-26 11:58:51'),
(3, 1, 'Dell', NULL, 1, 1, NULL, '2022-07-26 11:58:58', '2022-07-26 11:58:58'),
(4, 1, 'abc', NULL, 1, 1, NULL, '2022-08-04 06:41:24', '2022-08-04 06:41:24');

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
(1, 1, 'Stationary', NULL, 1, 1, NULL, '2022-07-26 11:56:47', '2022-07-26 11:56:47'),
(2, 1, 'Electronics', NULL, 1, 1, NULL, '2022-07-26 11:57:00', '2022-07-26 11:57:00'),
(3, 1, 'medichine', NULL, 1, 1, NULL, '2022-08-04 06:40:33', '2022-08-04 06:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`id`, `client_id`, `name`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'No Color', 1, 1, NULL, '2022-07-31 04:27:20', '2022-08-04 06:44:16'),
(2, 1, 'White', 1, 1, NULL, '2022-07-31 04:28:58', '2022-07-31 04:28:58'),
(3, 1, 'Black', 1, 1, NULL, '2022-07-31 04:29:05', '2022-07-31 04:29:05'),
(4, 1, 'yellow', 1, 1, NULL, '2022-08-04 06:41:41', '2022-08-04 06:41:41'),
(5, 1, 'Green', 1, 1, NULL, '2022-08-04 06:41:59', '2022-08-04 06:41:59'),
(6, 1, 'Red', 1, 1, NULL, '2022-08-04 06:44:30', '2022-08-04 06:44:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `client_id`, `name`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'No Size', 1, 1, NULL, '2022-07-31 04:27:38', '2022-07-31 04:27:38'),
(2, 1, '8-9', 1, 1, NULL, '2022-07-31 04:28:37', '2022-07-31 04:28:37'),
(3, 1, '10-12', 1, 1, NULL, '2022-07-31 04:28:46', '2022-07-31 04:28:46'),
(4, 1, '38', 1, 1, NULL, '2022-08-04 06:42:33', '2022-08-04 06:42:33'),
(5, 1, '42', 1, 1, NULL, '2022-08-04 06:42:39', '2022-08-04 06:42:39'),
(6, 1, '40', 1, 1, NULL, '2022-08-04 06:42:45', '2022-08-04 06:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_transfers`
--

CREATE TABLE `product_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `target_branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_size_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `buy_price` double(20,2) DEFAULT 0.00,
  `quantity` double(20,2) DEFAULT 0.00,
  `total` double(20,2) DEFAULT 0.00,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_transfers`
--

INSERT INTO `product_transfers` (`id`, `client_id`, `invoice_no`, `source_branch_id`, `target_branch_id`, `product_id`, `product_color_id`, `product_size_id`, `product_category_id`, `product_brand_id`, `code`, `name`, `date`, `buy_price`, `quantity`, `total`, `note`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '00001', 1, 2, 5, 4, 4, 3, 4, '00005', 'test', '2022-08-04', 60.00, 200.00, 12000.00, 'test', 1, 1, NULL, '2022-08-04 06:57:07', '2022-08-04 06:57:07');

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
(1, 1, 'pcs', 1, 1, NULL, '2022-07-26 11:54:16', '2022-07-26 11:54:16'),
(2, 1, 'kg', 1, 1, NULL, '2022-07-26 11:54:23', '2022-07-26 11:54:23'),
(3, 1, 'size', 1, 1, '2022-08-04 06:41:04', '2022-08-04 06:40:49', '2022-08-04 06:41:04'),
(4, 1, 'gm', 1, 1, NULL, '2022-08-04 06:41:12', '2022-08-04 06:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
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

INSERT INTO `purchase_orders` (`id`, `client_id`, `company_branch_id`, `invoice_no`, `supplier_id`, `date`, `payment_method`, `discount`, `sub_total`, `return_total`, `total`, `paid`, `due`, `note`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '00001', 1, '2022-08-01', 1, 0.00, 525000.00, 0.00, 525000.00, 0.00, 525000.00, 'Test', 1, 1, NULL, '2022-08-01 09:41:44', '2022-08-01 09:41:44'),
(2, 1, 1, '00002', 3, '2022-08-04', 1, 10.00, 60000.00, 0.00, 54000.00, 0.00, 54000.00, NULL, 1, 1, NULL, '2022-08-04 06:53:08', '2022-08-04 07:27:36');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_products`
--

CREATE TABLE `purchase_order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `purchase_order_id` int(15) DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_color_id` int(11) DEFAULT NULL,
  `product_size_id` int(11) DEFAULT NULL,
  `product_category_id` int(15) DEFAULT NULL,
  `product_brand_id` int(11) DEFAULT NULL,
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

INSERT INTO `purchase_order_products` (`id`, `client_id`, `company_branch_id`, `purchase_order_id`, `supplier_id`, `product_id`, `product_color_id`, `product_size_id`, `product_category_id`, `product_brand_id`, `inventory_log_id`, `date`, `name`, `code`, `discount`, `serial_no`, `quantity`, `return_quantity`, `return_at`, `unit_price`, `product_total`, `return_total`, `total`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 2, NULL, 1, '2022-08-01', 'Cable IPhone', '00001', 0.00, NULL, 150.00, 0.00, NULL, 100.00, 15000.00, 0.00, 15000.00, 1, 1, NULL, '2022-08-01 09:41:44', '2022-08-01 09:41:44'),
(2, 1, 1, 1, 1, 2, 1, 1, 2, NULL, 2, '2022-08-01', 'Cable Android', '00002', 0.00, NULL, 200.00, 0.00, NULL, 50.00, 10000.00, 0.00, 10000.00, 1, 1, NULL, '2022-08-01 09:41:44', '2022-08-01 09:41:44'),
(3, 1, 1, 1, 1, 3, 2, 1, 2, NULL, 3, '2022-08-01', 'Laptop', '00003', 0.00, NULL, 20.00, 0.00, NULL, 25000.00, 500000.00, 0.00, 500000.00, 1, 1, NULL, '2022-08-01 09:41:44', '2022-08-01 09:41:44'),
(4, 1, 1, 2, 3, 5, 4, 4, 3, NULL, 5, '2022-08-04', 'test', '00005', 10.00, NULL, 900.00, 100.00, '2022-08-04 07:27:36', 60.00, 60000.00, 6000.00, 54000.00, 1, 1, NULL, '2022-08-04 06:53:08', '2022-08-04 07:27:36');

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
(1, 1, '1', 'Joining', '3', '2022-08-04', NULL, '2022-08-04 06:38:57', '2022-08-04 06:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `salary_processes`
--

CREATE TABLE `salary_processes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `salary_process_details`
--

CREATE TABLE `salary_process_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `sale_orders`
--

CREATE TABLE `sale_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
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

INSERT INTO `sale_orders` (`id`, `client_id`, `company_branch_id`, `invoice_no`, `customer_id`, `date`, `payment_method`, `product_discount`, `discount`, `total_discount`, `tax`, `vat`, `product_sub_total`, `sub_total`, `return_total`, `total`, `paid`, `due`, `note`, `user_id`, `delete_user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '00001', 1, '2022-08-01', 1, 0.00, 0.00, 0.00, 0.00, 0.00, 750.00, 750.00, 0.00, 750.00, 250.00, 500.00, NULL, 1, NULL, NULL, '2022-08-01 09:43:11', '2022-08-01 09:43:11'),
(2, 1, 1, '00002', 3, '2022-08-04', 1, 0.00, 0.00, 0.00, 0.00, 0.00, 400.00, 400.00, 0.00, 240.00, 400.00, -160.00, 'test', 1, NULL, NULL, '2022-08-04 07:16:43', '2022-08-04 07:37:02');

-- --------------------------------------------------------

--
-- Table structure for table `sale_order_products`
--

CREATE TABLE `sale_order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `sale_order_id` int(15) DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_color_id` int(11) DEFAULT NULL,
  `product_size_id` int(11) DEFAULT NULL,
  `product_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_brand_id` int(11) DEFAULT NULL,
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

INSERT INTO `sale_order_products` (`id`, `client_id`, `company_branch_id`, `sale_order_id`, `customer_id`, `product_id`, `product_color_id`, `product_size_id`, `product_category_id`, `product_brand_id`, `inventory_log_id`, `date`, `name`, `code`, `warranty`, `guarantee`, `product_discount`, `discount`, `serial_no`, `quantity`, `return_quantity`, `return_at`, `unit_price`, `buy_price`, `tax`, `tax_percentage`, `vat`, `vat_percentage`, `product_total`, `return_total`, `buy_total`, `total`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 2, NULL, 4, '2022-08-01', 'Cable IPhone', '00001', '6 Month', '1 Week', 0.00, 0.00, NULL, 5.00, 0.00, NULL, 150.00, 100.00, 0.00, 0.00, 0.00, 0.00, 750.00, 0.00, 500.00, 750.00, 1, 1, NULL, '2022-08-01 09:43:11', '2022-08-01 09:43:11'),
(2, 1, 1, 2, 3, 5, 4, 4, 3, NULL, 9, '2022-08-04', 'test', '00005', NULL, NULL, 0.00, 0.00, NULL, 3.00, 2.00, '2022-08-04 07:37:02', 80.00, 60.00, 0.00, 0.00, 0.00, 0.00, 400.00, 160.00, 300.00, 240.00, 1, 1, NULL, '2022-08-04 07:16:43', '2022-08-04 07:37:02');

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
(1, 1, 'Ashikur Rahman', 'Ashik Enterprice', '11231231231', NULL, NULL, 'Testing address', 1, 1, NULL, '2022-07-26 11:46:02', '2022-07-26 11:46:02'),
(2, 1, 'Rabby Ahmed', 'Saber brothers', '01211122102', NULL, NULL, 'Test', 1, 1, NULL, '2022-07-26 11:49:28', '2022-07-26 11:49:28'),
(3, 1, 'test', 'Shodesh Bangla Co-oparative ltd', '01919235690', NULL, 'admin@gmail.com', 'hgf4', 1, 1, NULL, '2022-08-04 06:32:53', '2022-08-04 06:32:53');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `transaction_logs`
--

CREATE TABLE `transaction_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
  `company_branch_id` bigint(20) DEFAULT NULL,
  `voucher_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Income, 2=Expense, 3=Purchase, 4=Sale, 5= Salary Process, 6= , 7= , 8=Balance Transafer, 9=Opening Balance',
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
  `online_income_id` bigint(20) DEFAULT NULL,
  `online_expense_id` bigint(20) DEFAULT NULL,
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

INSERT INTO `transaction_logs` (`id`, `client_id`, `company_branch_id`, `voucher_no`, `transaction_type`, `date`, `particular`, `account_class_id`, `account_head_id`, `account_id`, `payment_method`, `bank_id`, `debit`, `credit`, `amount`, `note`, `supplier_id`, `purchase_order_id`, `customer_id`, `sale_order_id`, `inventory_log_id`, `salary_process_id`, `employee_id`, `transaction_id`, `balance_transfer_id`, `online_income_id`, `online_expense_id`, `adjustment_status`, `opening_status`, `user_id`, `status`, `delete_user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '00001', 3, '2022-08-01', 'Purchase of invoice no. 00001', 4, 1, 1, NULL, NULL, 0.00, 525000.00, 525000.00, 'Purchase from Ashikur Rahman', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-08-01 09:41:44', '2022-08-01 09:41:44'),
(2, 1, 1, '00002', 3, '2022-08-01', 'Purchase payable for invoice no. 00001', 2, 7, 8, NULL, NULL, 0.00, 525000.00, 525000.00, 'Purchase payable from Ashikur Rahman', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-08-01 09:41:44', '2022-08-01 09:41:44'),
(3, 1, 1, '00003', 4, '2022-08-01', 'Customer receivable for invoice no. 00001', 3, 2, 2, NULL, NULL, 0.00, 750.00, 0.00, 'Sale for Jahidul Islam', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-08-01 09:43:11', '2022-08-01 09:43:11'),
(4, 1, 1, '00004', 1, '2022-08-01', 'Customer receive for invoice no. 00001', 1, 4, 3, 1, 1, 0.00, 250.00, 250.00, 'Sale receive fromJahidul Islam', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-08-01 09:43:11', '2022-08-01 09:43:11'),
(5, 1, 1, '00005', 4, '2022-08-01', 'Customer receivable for invoice no. 00001', 1, 8, 9, NULL, NULL, 0.00, 500.00, 500.00, 'Sale receivable from Jahidul Islam', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-08-01 09:43:11', '2022-08-01 09:43:11'),
(6, 1, 1, '00006', 3, '2022-08-04', 'Purchase of invoice no. 00002', 4, 1, 1, NULL, NULL, 0.00, 54000.00, 54000.00, 'Purchase from test', 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-08-04 06:53:08', '2022-08-04 07:27:36'),
(7, 1, 1, '00007', 3, '2022-08-04', 'Purchase payable for invoice no. 00002', 2, 7, 8, NULL, NULL, 0.00, 54000.00, 54000.00, 'Purchase payable from test', 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-08-04 06:53:08', '2022-08-04 07:27:36'),
(8, 1, 1, '00008', 2, '2022-08-04', 'Damage product for invoice no. 00001', 4, 5, NULL, NULL, NULL, 0.00, 600.00, 600.00, 'Damage Product', NULL, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-08-04 07:02:50', '2022-08-04 07:02:50'),
(9, 1, 1, '00009', 4, '2022-08-04', 'Customer receivable for invoice no. 00002', 3, 2, 2, NULL, NULL, 0.00, 240.00, 240.00, 'Sale for test', NULL, NULL, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-08-04 07:16:43', '2022-08-04 07:37:02'),
(10, 1, 1, '00010', 4, '2022-08-04', 'Customer receivable for invoice no. 00002', 1, 8, 9, NULL, NULL, 0.00, 400.00, 400.00, 'Sale receivable from test', NULL, NULL, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-08-04 07:16:43', '2022-08-04 07:16:43'),
(11, 1, NULL, '00011', 4, '2022-08-04', 'Customer payment for invoice no. 00002', 4, 1, NULL, 1, NULL, 0.00, 300.00, 300.00, 'Customer payment of test', NULL, NULL, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-08-04 07:18:08', '2022-08-04 07:18:08'),
(12, 1, NULL, '00012', 4, '2022-08-04', 'Customer receivable for invoice no. 00002', 1, 8, 9, NULL, NULL, 300.00, 0.00, 300.00, 'Sale receivable fromtest', NULL, NULL, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-08-04 07:18:08', '2022-08-04 07:18:08'),
(13, 1, NULL, '00013', 4, '2022-08-04', 'Customer payment for invoice no. 00002', 4, 1, NULL, 1, NULL, 0.00, 100.00, 100.00, 'Customer payment of test', NULL, NULL, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-08-04 07:19:11', '2022-08-04 07:19:11'),
(14, 1, NULL, '00014', 4, '2022-08-04', 'Customer receivable for invoice no. 00002', 1, 8, 9, NULL, NULL, 100.00, 0.00, 100.00, 'Sale receivable fromtest', NULL, NULL, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, '2022-08-04 07:19:11', '2022-08-04 07:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
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

INSERT INTO `users` (`id`, `client_id`, `company_branch_id`, `name`, `email`, `mobile_no`, `role_id`, `email_verified_at`, `password`, `remember_token`, `logged_section_id`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'One Point', 'admin@gmail.com', NULL, 1, NULL, '$2a$12$UXoNZrVnmqHmwdOv2RbQLeT2eYn/8XyhDV0n1.SWwkgGzdXNIc2hG', 'tTBnm8rPieL9krgCSGXKoYczsnd9AvZYdGxIkWAxcFpQ2c1l419kwPsenhFC', 2, 1, 1, NULL, '2020-08-20 15:16:14', '2022-07-25 04:13:33'),
(2, 1, NULL, 'Admin', 'admin1@gmail.com', NULL, 2, NULL, '$2a$12$Wvi1dtw2d0kziysPM.UmcOMpcXfhdrb8HXswhf8wMVdmIDcz8P5aO', 'tHeB6DTy9zw7AYnzgqo16bLgEBFlGL9EU4MjzNQY6Fr7lbqYeCBIcTxC64AB', 1, 1, 1, NULL, '2020-08-20 15:21:49', '2022-06-08 12:21:43'),
(14, 1, 1, 'test', 'superadmin@gmail.com', '01919235690', 3, NULL, '$2y$10$wdeaOotMfR9aLm6kddqyz.SrqbYS1guW.tY7R.K3LYPXICW2Zc2gC', NULL, 0, 1, 1, NULL, '2022-08-04 06:38:57', '2022-08-04 06:38:57');

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
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_transfers`
--
ALTER TABLE `product_transfers`
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
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `balance_transfers`
--
ALTER TABLE `balance_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `months`
--
ALTER TABLE `months`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `online_expenses`
--
ALTER TABLE `online_expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `online_incomes`
--
ALTER TABLE `online_incomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_quotations`
--
ALTER TABLE `price_quotations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `price_quotation_products`
--
ALTER TABLE `price_quotation_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_brands`
--
ALTER TABLE `product_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_transfers`
--
ALTER TABLE `product_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_units`
--
ALTER TABLE `product_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_process_details`
--
ALTER TABLE `salary_process_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_orders`
--
ALTER TABLE `sale_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sale_order_products`
--
ALTER TABLE `sale_order_products`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
