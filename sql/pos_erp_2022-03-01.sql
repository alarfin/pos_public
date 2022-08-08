-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2022 at 05:23 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
  `account_class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `account_head_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_status` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `client_id`, `account_class_id`, `account_head_id`, `name`, `default_status`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 'Supplier Payment', 1, 1, NULL, '2022-02-13 04:52:11', '2022-02-13 04:52:11'),
(2, 1, 1, 2, 'Customer Receivable', 1, 1, NULL, '2022-02-13 04:52:11', '2022-02-13 04:52:11'),
(3, 1, 1, 3, 'Cash In Hand', 1, 1, NULL, '2022-02-13 04:52:11', '2022-02-13 04:52:11'),
(4, 1, 1, 3, 'Bank', 1, 1, NULL, '2022-02-13 04:52:11', '2022-02-13 04:52:11'),
(5, 1, 2, 5, 'Damage Product', 1, 1, NULL, '2022-02-13 04:52:11', '2022-02-13 04:52:11');

-- --------------------------------------------------------

--
-- Table structure for table `account_classes`
--

CREATE TABLE `account_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Debit, 2=Credit',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_classes`
--

INSERT INTO `account_classes` (`id`, `name`, `type`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Asset', 1, 1, NULL, '2022-02-09 13:34:02', '2022-02-09 13:34:02'),
(2, 'Expense', 1, 1, NULL, '2022-02-09 13:34:02', '2022-02-09 13:34:02'),
(3, 'Liabilities', 2, 1, NULL, '2022-02-09 13:34:02', '2022-02-09 13:34:02'),
(4, 'Equity', 2, 1, NULL, '2022-02-09 13:34:02', '2022-02-09 13:34:02');

-- --------------------------------------------------------

--
-- Table structure for table `account_heads`
--

CREATE TABLE `account_heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
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
(1, 1, 3, 'Supplier', 1, 1, NULL, '2022-02-12 11:45:01', '2022-02-13 05:01:07'),
(3, 1, 1, 'Customer', 1, 1, NULL, '2022-02-14 06:56:49', '2022-02-14 06:56:49'),
(4, 1, 1, 'Account', 1, 1, NULL, '2022-02-14 06:56:49', '2022-02-14 06:56:49'),
(5, 1, 2, 'Damage', 1, 1, NULL, '2022-02-14 06:56:49', '2022-02-14 06:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `balance_transfers`
--

CREATE TABLE `balance_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(15) DEFAULT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1=Bank To Cash; 2=Cash To Bank; 3=Bank To Bank',
  `source_bank_id` int(10) UNSIGNED DEFAULT NULL,
  `source_branch_id` int(10) UNSIGNED DEFAULT NULL,
  `source_bank_account_id` int(10) UNSIGNED DEFAULT NULL,
  `source_cheque_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_cheque_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_bank_id` int(10) UNSIGNED DEFAULT NULL,
  `target_branch_id` int(10) UNSIGNED DEFAULT NULL,
  `target_bank_account_id` int(10) UNSIGNED DEFAULT NULL,
  `target_cheque_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_cheque_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(20,2) NOT NULL,
  `date` date NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(15) DEFAULT NULL,
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
(1, 1, 'Sahjalal Islami Bank Ltd', 'Health Care Limited', '4008 111 000 100 15', NULL, 'Uttara', 1, 1, '2022-02-09 06:18:16', '2022-02-09 06:30:49');

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
(5, 1, 'Tangail Shop', '354353245425', NULL, 'bvxcv', 1, 1, NULL, '2021-08-01 06:30:40', '2021-08-01 06:30:40');

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
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_category_id` int(15) DEFAULT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Purchase,2=Manually Stock, 3=Sale, 4=Damage',
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=In, 2=Out',
  `date` date NOT NULL,
  `quantity` double(20,2) DEFAULT 0.00,
  `unit_price` double(20,2) DEFAULT 0.00,
  `discount` double(20,2) NOT NULL DEFAULT 0.00,
  `tax` double(20,2) NOT NULL DEFAULT 0.00,
  `vat` double(20,2) NOT NULL DEFAULT 0.00,
  `product_total` double(20,2) NOT NULL DEFAULT 0.00,
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

INSERT INTO `inventory_logs` (`id`, `client_id`, `section_id`, `product_id`, `product_category_id`, `code`, `invoice_no`, `stock_type`, `type`, `date`, `quantity`, `unit_price`, `discount`, `tax`, `vat`, `product_total`, `total`, `supplier_id`, `purchase_order_id`, `customer_id`, `sale_order_id`, `note`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, '00001', NULL, 1, 1, '2022-02-15', 60.00, 50.00, 0.00, 0.00, 0.00, 3000.00, 3000.00, 2, 1, NULL, NULL, 'Purchase Product In', 1, 1, '2022-02-15 09:01:26', '2022-02-15 06:25:28', '2022-02-15 09:01:26'),
(2, 1, 1, 2, NULL, '00002', NULL, 1, 1, '2022-02-15', 50.00, 200.00, 250.00, 0.00, 0.00, 10000.00, 9750.00, 2, 1, NULL, NULL, 'Purchase Product In', 1, 1, NULL, '2022-02-15 06:25:28', '2022-02-16 04:30:03'),
(3, 1, 1, 1, NULL, '00001', NULL, 1, 1, '2022-02-15', 60.00, 50.00, 250.00, 0.00, 0.00, 3000.00, 2750.00, 2, 1, NULL, NULL, 'Purchase Product In', 1, 1, NULL, '2022-02-15 09:24:08', '2022-02-16 04:30:03'),
(5, 1, 1, 1, NULL, '00001', NULL, 3, 2, '2022-02-17', 5.00, 80.00, 20.00, 20.00, 0.00, 400.00, 400.00, NULL, NULL, 3, 1, 'sale Product In', 1, 1, '2022-02-17 09:26:04', '2022-02-17 07:00:29', '2022-02-17 09:26:04'),
(6, 1, 1, 2, NULL, '00002', NULL, 3, 2, '2022-02-17', 2.00, 300.00, 0.00, 0.00, 0.00, 600.00, 600.00, NULL, NULL, 2, 2, 'sale Product In', 1, 1, NULL, '2022-02-17 09:39:43', '2022-02-17 09:39:43'),
(7, 1, 1, 1, NULL, '00001', NULL, 3, 2, '2022-02-17', 2.00, 80.00, 8.00, 8.00, 0.00, 160.00, 160.00, NULL, NULL, 5, 3, 'sale Product In', 1, 1, '2022-02-17 11:52:27', '2022-02-17 10:58:26', '2022-02-17 11:52:27'),
(8, 1, 1, 1, NULL, '00001', NULL, 3, 2, '2022-02-17', 2.00, 80.00, 8.00, 8.00, 0.00, 160.00, 160.00, NULL, NULL, 5, 4, 'sale Product In', 1, 1, NULL, '2022-02-17 11:05:52', '2022-02-17 11:05:52'),
(9, 1, 1, 1, 1, '00001', '00001', 4, 2, '2022-02-22', 3.00, 50.00, 0.00, 0.00, 0.00, 150.00, 150.00, NULL, NULL, NULL, NULL, 'Product Damage', 1, 1, '2022-02-23 07:17:51', '2022-02-22 12:07:26', '2022-02-23 07:17:51'),
(10, 1, 1, 2, 1, '00002', '00002', 4, 2, '2022-02-23', 3.00, 200.00, 0.00, 0.00, 0.00, 600.00, 600.00, NULL, NULL, NULL, NULL, 'Product Damage', 1, 1, NULL, '2022-02-23 08:43:39', '2022-02-23 08:43:39');

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
(50, '2020_08_12_205137_create_transactions_table', 21),
(51, '2020_08_12_205408_add_transaction_id_column_in_transaction_logs_table', 22),
(52, '2020_08_12_205547_create_balance_transfers_table', 23),
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
(101, '2022_02_15_155739_create_sale_order_products_table', 39);

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
(2, 1, 1, 1, 'Cable Micro', '00002', 200.00, 300.00, 250.00, 0.00, 0.00, 0.00, NULL, NULL, 1, 1, NULL, '2022-02-15 06:23:24', '2022-02-15 06:23:24');

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
-- Table structure for table `purchase_inventory_logs`
--

CREATE TABLE `purchase_inventory_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
  `section_id` int(15) DEFAULT 1,
  `purchase_product_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1=In; 2=Out',
  `date` date NOT NULL,
  `quantity` double(20,2) NOT NULL,
  `unit_price` double(20,2) DEFAULT NULL,
  `total` double(20,2) NOT NULL DEFAULT 0.00,
  `supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `purchase_order_id` int(15) DEFAULT NULL,
  `sale_order_id` int(15) UNSIGNED DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Purchase,2=Manually Stock, 3=Sale',
  `user_id` int(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_inventory_logs`
--

INSERT INTO `purchase_inventory_logs` (`id`, `client_id`, `section_id`, `purchase_product_id`, `type`, `date`, `quantity`, `unit_price`, `total`, `supplier_id`, `purchase_order_id`, `sale_order_id`, `note`, `stock_type`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 14, 1, '2021-07-31', 50.00, 200.00, 0.00, 3, NULL, NULL, NULL, 1, 1, '2021-07-31 09:22:44', '2021-07-31 09:22:44'),
(2, 1, 1, 12, 1, '2021-07-31', 30.00, 400.00, 0.00, 3, NULL, NULL, NULL, 1, 1, '2021-07-31 09:22:44', '2021-07-31 09:22:44'),
(3, 1, 1, 12, 1, '2021-07-31', 10.00, 400.00, 0.00, 3, NULL, 1, 'Update In', 1, 1, '2021-07-31 09:23:16', '2021-07-31 09:23:16'),
(4, 1, 1, 12, 2, '2021-07-31', 10.00, 400.00, 0.00, 3, NULL, 1, 'Update Out', 1, 1, '2021-07-31 09:26:30', '2021-07-31 09:26:30'),
(5, 1, 1, 14, 2, '2021-07-31', 5.00, 250.00, 0.00, NULL, NULL, 1, NULL, 1, 1, '2021-07-31 10:11:43', '2021-07-31 10:11:43'),
(6, 1, NULL, 14, 1, '2021-07-31', 5.00, 200.00, 0.00, NULL, NULL, 1, 'Sale Update In', 1, 1, '2021-07-31 11:07:53', '2021-07-31 11:07:53'),
(7, 1, NULL, 14, 2, '2021-07-31', 5.00, 200.00, 0.00, NULL, NULL, 1, 'Sale Update Out', 1, 1, '2021-07-31 11:08:18', '2021-07-31 11:08:18'),
(8, 1, 1, 14, 1, '2021-08-01', 25.00, 10.00, 0.00, 3, NULL, NULL, NULL, 1, 1, '2021-08-01 06:53:03', '2021-08-01 06:53:03'),
(9, 1, 1, 6, 1, '2021-08-01', 15.00, 30.00, 0.00, 3, NULL, NULL, NULL, 1, 1, '2021-08-01 06:53:03', '2021-08-01 06:53:03'),
(10, 1, 1, 14, 2, '2021-08-01', 1.00, 250.00, 0.00, NULL, NULL, 2, NULL, 1, 1, '2021-08-01 11:29:25', '2021-08-01 11:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
  `section_id` int(15) DEFAULT NULL,
  `invoice_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_id` int(15) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `payment_method` tinyint(4) DEFAULT NULL COMMENT '1=Cash In Hand, 2=Bank',
  `discount` double(20,2) NOT NULL DEFAULT 0.00,
  `sub_total` double(20,2) NOT NULL DEFAULT 0.00,
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

INSERT INTO `purchase_orders` (`id`, `client_id`, `section_id`, `invoice_no`, `supplier_id`, `date`, `payment_method`, `discount`, `sub_total`, `total`, `paid`, `due`, `note`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '00001', 2, '2022-02-15', 2, 500.00, 13000.00, 12500.00, 3000.00, 9500.00, 'Testing', 1, 1, NULL, '2022-02-15 06:25:28', '2022-02-16 07:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_products`
--

CREATE TABLE `purchase_order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
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

INSERT INTO `purchase_order_products` (`id`, `client_id`, `section_id`, `purchase_order_id`, `supplier_id`, `product_id`, `product_category_id`, `inventory_log_id`, `date`, `name`, `code`, `discount`, `quantity`, `return_quantity`, `unit_price`, `product_total`, `return_total`, `total`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, 1, 1, 1, '2022-02-15', 'Cable IPhone', '00001', 0.00, 60.00, 0.00, 50.00, 0.00, 0.00, 3000.00, 1, 1, '2022-02-15 09:01:26', '2022-02-15 06:25:28', '2022-02-15 09:01:26'),
(2, 1, 1, 1, 2, 2, 1, 2, '2022-02-15', 'Cable Micro', '00002', 250.00, 50.00, 0.00, 200.00, 10000.00, 0.00, 9750.00, 1, 1, NULL, '2022-02-15 06:25:28', '2022-02-16 04:30:02'),
(3, 1, 1, 1, 2, 1, 1, 3, '2022-02-15', 'Cable IPhone', '00001', 250.00, 60.00, 0.00, 50.00, 3000.00, 0.00, 2750.00, 1, 1, NULL, '2022-02-15 09:24:08', '2022-02-16 04:30:02');

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
-- Table structure for table `sale_orders`
--

CREATE TABLE `sale_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `section_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
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
  `delete_user_id` int(15) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_orders`
--

INSERT INTO `sale_orders` (`id`, `client_id`, `section_id`, `invoice_no`, `customer_id`, `date`, `payment_method`, `product_discount`, `discount`, `total_discount`, `tax`, `vat`, `product_sub_total`, `sub_total`, `total`, `paid`, `due`, `note`, `user_id`, `delete_user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '00001', 3, '2022-02-17', 2, 20.00, 9.00, 29.00, 20.00, 0.00, 400.00, 400.00, 411.00, 90.00, 321.00, 'Test', 1, 1, '2022-02-17 09:26:04', '2022-02-17 07:00:29', '2022-02-17 09:26:04'),
(2, 1, 1, '00002', 2, '2022-02-17', 1, 0.00, 0.00, 0.00, 0.00, 0.00, 600.00, 600.00, 600.00, 200.00, 400.00, 'Test', 1, NULL, NULL, '2022-02-17 09:39:43', '2022-02-17 09:48:19'),
(3, 1, 1, '00003', 5, '2022-02-17', 2, 8.00, 0.00, 8.00, 8.00, 0.00, 160.00, 160.00, 168.00, 0.00, 168.00, 'Test', 1, 1, '2022-02-17 11:52:27', '2022-02-17 10:58:26', '2022-02-17 11:52:27'),
(4, 1, 1, '00004', 5, '2022-02-17', 2, 8.00, 0.00, 8.00, 8.00, 0.00, 160.00, 160.00, 160.00, 60.00, 100.00, 'Test', 1, NULL, NULL, '2022-02-17 11:05:52', '2022-02-17 11:23:02');

-- --------------------------------------------------------

--
-- Table structure for table `sale_order_products`
--

CREATE TABLE `sale_order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
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
  `unit_price` double(20,2) DEFAULT 0.00,
  `buy_price` double(20,2) DEFAULT 0.00,
  `tax` double(20,2) DEFAULT 0.00,
  `vat` double(20,2) DEFAULT 0.00,
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
-- Dumping data for table `sale_order_products`
--

INSERT INTO `sale_order_products` (`id`, `client_id`, `section_id`, `sale_order_id`, `customer_id`, `product_id`, `product_category_id`, `inventory_log_id`, `date`, `name`, `code`, `product_discount`, `discount`, `quantity`, `unit_price`, `buy_price`, `tax`, `vat`, `product_total`, `buy_total`, `total`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 3, 1, 1, 5, '2022-02-17', 'Cable IPhone', '00001', 20.00, 29.00, 5.00, 80.00, 50.00, 20.00, 0.00, 400.00, 400.00, 391.00, 1, 1, '2022-02-17 09:26:04', '2022-02-17 07:00:30', '2022-02-17 09:26:04'),
(2, 1, 1, 2, 2, 2, 1, 6, '2022-02-17', 'Cable Micro', '00002', 0.00, 0.00, 2.00, 300.00, 200.00, 0.00, 0.00, 600.00, 600.00, 600.00, 1, 1, NULL, '2022-02-17 09:39:43', '2022-02-17 09:39:43'),
(3, 1, 1, 3, 5, 1, 1, 7, '2022-02-17', 'Cable IPhone', '00001', 8.00, 8.00, 2.00, 80.00, 50.00, 8.00, 0.00, 160.00, 160.00, 160.00, 1, 1, '2022-02-17 11:52:27', '2022-02-17 10:58:26', '2022-02-17 11:52:27'),
(4, 1, 1, 4, 5, 1, 1, 8, '2022-02-17', 'Cable IPhone', '00001', 8.00, 8.00, 2.00, 80.00, 50.00, 8.00, 0.00, 160.00, 160.00, 160.00, 1, 1, NULL, '2022-02-17 11:05:52', '2022-02-17 11:05:52');

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
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `suppliers` (`id`, `client_id`, `name`, `company_name`, `mobile`, `alternative_mobile`, `email`, `address`, `status`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'LT Plus', NULL, '07518200000', NULL, NULL, '333', 1, 2, NULL, '2021-07-30 17:22:26', '2021-07-30 17:22:26'),
(2, 1, 'Masud', NULL, '00000000000', NULL, NULL, '77 Rue Roger Salengro', 1, 2, NULL, '2021-07-30 17:22:57', '2021-07-30 17:22:57'),
(3, 1, 'Jony', NULL, '12345678910', NULL, NULL, '77 Rue Roger Salengro', 1, 2, NULL, '2021-07-30 17:23:26', '2022-02-13 07:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` int(15) DEFAULT NULL,
  `transaction_type` tinyint(4) NOT NULL COMMENT '1=Income; 2=Expense',
  `account_head_type_id` int(10) UNSIGNED NOT NULL,
  `account_head_sub_type_id` int(10) UNSIGNED NOT NULL,
  `transaction_method` tinyint(4) NOT NULL COMMENT '1=Cash; 2=Bank; 3=Mobile Banking',
  `bank_id` int(10) UNSIGNED DEFAULT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  `bank_account_id` int(10) UNSIGNED DEFAULT NULL,
  `cheque_status` tinyint(4) DEFAULT NULL COMMENT '1=cheque,2=Virement',
  `cheque_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(20,2) NOT NULL,
  `date` date NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(15) DEFAULT NULL,
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
  `section_id` int(15) DEFAULT NULL,
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

INSERT INTO `transaction_logs` (`id`, `client_id`, `section_id`, `voucher_no`, `transaction_type`, `date`, `particular`, `account_class_id`, `account_head_id`, `account_id`, `payment_method`, `bank_id`, `debit`, `credit`, `amount`, `note`, `supplier_id`, `purchase_order_id`, `customer_id`, `sale_order_id`, `inventory_log_id`, `user_id`, `status`, `delete_user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '00001', 3, '2022-02-15', 'Purchase Credit from Masud', 3, 1, NULL, NULL, NULL, 0.00, 12500.00, 12500.00, 'Supplier Payable for invoice no. 00001', 2, 1, NULL, NULL, NULL, 1, 1, NULL, NULL, '2022-02-15 06:25:28', '2022-02-15 09:24:08'),
(2, 1, 1, '00002', 2, '2022-02-15', 'Supplier payment from Masud', 3, 1, NULL, 2, 1, 2000.00, 0.00, 2000.00, 'Supplier payment for invoice no. 00001', 2, 1, NULL, NULL, NULL, 1, 1, NULL, NULL, '2022-02-15 06:25:28', '2022-02-15 06:25:28'),
(3, 1, 1, '00003', 2, '2022-02-16', 'Supplier payment of Masud', 3, 1, NULL, 1, NULL, 500.00, 0.00, 500.00, 'Supplier payment for invoice no. 00001', 2, 1, NULL, NULL, NULL, 1, 1, NULL, NULL, '2022-02-16 07:17:47', '2022-02-16 07:17:47'),
(4, 1, 1, '00004', 2, '2022-02-16', 'Supplier payment of Masud', 3, 1, NULL, 1, NULL, 500.00, 0.00, 500.00, 'Supplier payment for invoice no. 00001', 2, 1, NULL, NULL, NULL, 1, 1, NULL, NULL, '2022-02-16 07:19:14', '2022-02-16 07:19:14'),
(5, 1, 1, '00005', 4, '2022-02-17', 'Customer receivable for invoice no. 00001', 1, 2, NULL, NULL, NULL, 0.00, 411.00, 0.00, 'Sale Credit for Sonali', NULL, NULL, 3, 1, NULL, 1, 1, NULL, '2022-02-17 09:26:04', '2022-02-17 07:00:30', '2022-02-17 09:26:04'),
(6, 1, 1, '00006', 1, '2022-02-17', 'Customer receivable for invoice no. 00001', 1, 2, NULL, 2, 1, 90.00, 0.00, 90.00, 'Customer receivable of Sonali', NULL, NULL, 3, 1, NULL, 1, 1, NULL, '2022-02-17 09:26:04', '2022-02-17 07:00:30', '2022-02-17 09:26:04'),
(7, 1, 1, '00007', 4, '2022-02-17', 'Customer receivable for invoice no. 00002', 1, 2, NULL, NULL, NULL, 0.00, 600.00, 0.00, 'Sale Credit for AMA Librairie', NULL, NULL, 2, 2, NULL, 1, 1, NULL, NULL, '2022-02-17 09:39:43', '2022-02-17 09:39:43'),
(8, 1, 1, '00008', 1, '2022-02-17', 'Customer receivable for invoice no. 00002', 1, 2, NULL, 1, 1, 100.00, 0.00, 100.00, 'Customer receivable of AMA Librairie', NULL, NULL, 2, 2, NULL, 1, 1, NULL, NULL, '2022-02-17 09:39:43', '2022-02-17 09:39:43'),
(9, 1, 1, '00009', 1, '2022-02-17', 'Customer payment for invoice no. 00002', 3, 1, NULL, 1, NULL, 100.00, 0.00, 100.00, 'Customer payment of AMA Librairie', NULL, NULL, 2, 2, NULL, 1, 1, NULL, NULL, '2022-02-17 09:48:19', '2022-02-17 09:48:19'),
(10, 1, 1, '00010', 4, '2022-02-17', 'Customer receivable for invoice no. 00003', 1, 2, NULL, NULL, NULL, 0.00, 168.00, 0.00, 'Sale Credit for Tangail Shop', NULL, NULL, 5, 3, NULL, 1, 1, NULL, '2022-02-17 11:52:27', '2022-02-17 10:58:27', '2022-02-17 11:52:27'),
(11, 1, 1, '00011', 4, '2022-02-17', 'Customer receivable for invoice no. 00004', 1, 2, NULL, NULL, NULL, 0.00, 160.00, 0.00, 'Sale Credit for Tangail Shop', NULL, NULL, 5, 4, NULL, 1, 1, NULL, NULL, '2022-02-17 11:05:52', '2022-02-17 11:05:52'),
(12, 1, 1, '00012', 1, '2022-02-17', 'Customer payment for invoice no. 00004', 3, 1, NULL, 1, NULL, 60.00, 0.00, 60.00, 'Customer payment of Tangail Shop', NULL, NULL, 5, 4, NULL, 1, 1, NULL, NULL, '2022-02-17 11:23:02', '2022-02-17 11:23:02'),
(13, 1, 1, '00013', 2, '2022-02-22', 'Damage product for invoice no. 00001', 2, 5, NULL, NULL, NULL, 0.00, 150.00, 150.00, ' Damage Product', NULL, NULL, NULL, NULL, 13, 1, 1, NULL, NULL, '2022-02-22 12:07:26', '2022-02-22 12:07:26'),
(14, 1, 1, '00014', 2, '2022-02-23', 'Damage product for invoice no. 00002', 2, 5, NULL, NULL, NULL, 0.00, 600.00, 600.00, 'Damage Product', NULL, NULL, NULL, NULL, 10, 1, 1, NULL, NULL, '2022-02-23 08:43:39', '2022-02-23 08:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(15) NOT NULL DEFAULT 1,
  `section_id` int(15) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(12) NOT NULL DEFAULT 2 COMMENT '1=Super Admin, 2=Admin',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logged_section_id` int(15) NOT NULL,
  `user_id` int(15) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=Disable, 1=Enable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `client_id`, `section_id`, `name`, `email`, `mobile_no`, `role_id`, `email_verified_at`, `password`, `remember_token`, `logged_section_id`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'One Point', 'admin@gmail.com', NULL, 1, NULL, '$2a$12$UXoNZrVnmqHmwdOv2RbQLeT2eYn/8XyhDV0n1.SWwkgGzdXNIc2hG', 'll9mFyGKfK6vG5woBc9usp0G5T5TOJhZa5VZByvkXNNvclx7kQmaa7N58hQs', 1, 1, 1, NULL, '2020-08-20 15:16:14', '2022-02-23 05:25:10'),
(2, 1, 1, 'Super Admin', 'admin1@gmail.com', NULL, 1, NULL, '$2b$10$JxbdYANgyCHyxWD7py897eEUJJVbnhzFcSO8aPQ/CnAFNrjOky1JW', 'XzNfD3fYQGQN9HA8ijOVn4jVGHhfXzcq0aau2UkPMJ3fPDC62exgE9UTFLON', 0, 1, 1, NULL, '2020-08-20 15:21:49', '2021-05-17 11:08:47'),
(9, 1, NULL, 'Training Admin', 'training@gmail.com', '11122211111', 2, NULL, '$2y$10$fHxeMhO4ko7FSnDnDQTY1.G0JJ4pec6nUSmo977pEHG4F8AeHxpEO', NULL, 0, 1, 1, NULL, '2022-02-08 11:01:50', '2022-02-08 11:01:50');

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
(3, 9, 2, 1, '2022-02-08 11:01:50', '2022-02-08 11:01:50');

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
-- Indexes for table `customers`
--
ALTER TABLE `customers`
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
-- Indexes for table `purchase_inventory_logs`
--
ALTER TABLE `purchase_inventory_logs`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `account_classes`
--
ALTER TABLE `account_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `account_heads`
--
ALTER TABLE `account_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_logs`
--
ALTER TABLE `inventory_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `purchase_inventory_logs`
--
ALTER TABLE `purchase_inventory_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_order_products`
--
ALTER TABLE `purchase_order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_orders`
--
ALTER TABLE `sale_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sale_order_products`
--
ALTER TABLE `sale_order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_sections`
--
ALTER TABLE `user_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
