-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-08-2022 a las 12:07:48
-- Versión del servidor: 5.7.39
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `i9finance_app`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_payment_settings`
--

CREATE TABLE `admin_payment_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `admin_payment_settings`
--

INSERT INTO `admin_payment_settings` (`id`, `name`, `value`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'is_stripe_enabled', 'on', 1, NULL, NULL),
(2, 'is_paypal_enabled', 'on', 1, NULL, NULL),
(3, 'is_paystack_enabled', 'on', 1, NULL, NULL),
(4, 'is_flutterwave_enabled', 'on', 1, NULL, NULL),
(5, 'is_razorpay_enabled', 'on', 1, NULL, NULL),
(6, 'is_mercado_enabled', 'on', 1, NULL, NULL),
(7, 'is_paytm_enabled', 'on', 1, NULL, NULL),
(8, 'is_mollie_enabled', 'on', 1, NULL, NULL),
(9, 'is_skrill_enabled', 'on', 1, NULL, NULL),
(10, 'is_coingate_enabled', 'on', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assets`
--

CREATE TABLE `assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` date NOT NULL,
  `supported_date` date NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `holder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_balance` double(15,2) NOT NULL DEFAULT '0.00',
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `holder_name`, `bank_name`, `account_number`, `opening_balance`, `contact_number`, `bank_address`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Cash', '', '-', 0.00, '-', '-', 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(2, 'TuPromotor', 'Caja Chica', '001', 0.00, '71608981', ',', 4, '2022-08-13 21:54:50', '2022-08-13 21:54:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bills`
--

CREATE TABLE `bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `vender_id` int(11) NOT NULL,
  `bill_date` date NOT NULL,
  `due_date` date NOT NULL,
  `order_number` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `shipping_display` int(11) NOT NULL DEFAULT '1',
  `send_date` date DEFAULT NULL,
  `discount_apply` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bill_payments`
--

CREATE TABLE `bill_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `account_id` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bill_products`
--

CREATE TABLE `bill_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `tax` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0.00',
  `discount` double(8,2) NOT NULL DEFAULT '0.00',
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `sub_type` int(11) NOT NULL DEFAULT '0',
  `is_enabled` int(11) NOT NULL DEFAULT '1',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `chart_of_accounts`
--

INSERT INTO `chart_of_accounts` (`id`, `name`, `code`, `type`, `sub_type`, `is_enabled`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Accounts Receivable', 120, 1, 1, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(2, 'Computer Equipment', 160, 1, 2, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(3, 'Office Equipment', 150, 1, 2, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(4, 'Inventory', 140, 1, 3, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(5, 'Budget - Finance Staff', 857, 1, 6, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(6, 'Accumulated Depreciation', 170, 1, 7, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(7, 'Accounts Payable', 200, 2, 8, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(8, 'Accruals', 205, 2, 8, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(9, 'Office Equipment', 150, 2, 8, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(10, 'Clearing Account', 855, 2, 8, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(11, 'Employee Benefits Payable', 235, 2, 8, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(12, 'Employee Deductions payable', 236, 2, 8, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(13, 'Historical Adjustments', 255, 2, 8, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(14, 'Revenue Received in Advance', 835, 2, 8, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(15, 'Rounding', 260, 2, 8, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(16, 'Costs of Goods Sold', 500, 3, 11, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(17, 'Advertising', 600, 3, 12, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(18, 'Automobile Expenses', 644, 3, 12, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(19, 'Bad Debts', 684, 3, 12, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(20, 'Bank Revaluations', 810, 3, 12, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(21, 'Bank Service Charges', 605, 3, 12, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(22, 'Consulting & Accounting', 615, 3, 12, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(23, 'Depreciation', 700, 3, 12, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(24, 'General Expenses', 628, 3, 12, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(25, 'Interest Income', 460, 4, 13, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(26, 'Other Revenue', 470, 4, 13, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(27, 'Purchase Discount', 475, 4, 13, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(28, 'Sales', 400, 4, 13, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(29, 'Common Stock', 330, 5, 16, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(30, 'Owners Contribution', 300, 5, 16, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(31, 'Owners Draw', 310, 5, 16, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(32, 'Retained Earnings', 320, 5, 16, 1, NULL, 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(33, 'Accounts Receivable', 120, 1, 1, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(34, 'Computer Equipment', 160, 1, 2, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(35, 'Office Equipment', 150, 1, 2, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(36, 'Inventory', 140, 1, 3, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(37, 'Budget - Finance Staff', 857, 1, 6, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(38, 'Accumulated Depreciation', 170, 1, 7, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(39, 'Accounts Payable', 200, 2, 8, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(40, 'Accruals', 205, 2, 8, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(41, 'Office Equipment', 150, 2, 8, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(42, 'Clearing Account', 855, 2, 8, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(43, 'Employee Benefits Payable', 235, 2, 8, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(44, 'Employee Deductions payable', 236, 2, 8, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(45, 'Historical Adjustments', 255, 2, 8, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(46, 'Revenue Received in Advance', 835, 2, 8, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(47, 'Rounding', 260, 2, 8, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(48, 'Costs of Goods Sold', 500, 3, 11, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(49, 'Advertising', 600, 3, 12, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(50, 'Automobile Expenses', 644, 3, 12, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(51, 'Bad Debts', 684, 3, 12, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(52, 'Bank Revaluations', 810, 3, 12, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(53, 'Bank Service Charges', 605, 3, 12, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(54, 'Consulting & Accounting', 615, 3, 12, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(55, 'Depreciation', 700, 3, 12, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(56, 'General Expenses', 628, 3, 12, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(57, 'Interest Income', 460, 4, 13, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(58, 'Other Revenue', 470, 4, 13, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(59, 'Purchase Discount', 475, 4, 13, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(60, 'Sales', 400, 4, 13, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(61, 'Common Stock', 330, 5, 16, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(62, 'Owners Contribution', 300, 5, 16, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(63, 'Owners Draw', 310, 5, 16, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(64, 'Retained Earnings', 320, 5, 16, 1, NULL, 4, '2022-08-11 20:18:09', '2022-08-11 20:18:09'),
(65, 'Accounts Receivable', 120, 1, 1, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(66, 'Computer Equipment', 160, 1, 2, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(67, 'Office Equipment', 150, 1, 2, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(68, 'Inventory', 140, 1, 3, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(69, 'Budget - Finance Staff', 857, 1, 6, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(70, 'Accumulated Depreciation', 170, 1, 7, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(71, 'Accounts Payable', 200, 2, 8, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(72, 'Accruals', 205, 2, 8, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(73, 'Office Equipment', 150, 2, 8, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(74, 'Clearing Account', 855, 2, 8, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(75, 'Employee Benefits Payable', 235, 2, 8, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(76, 'Employee Deductions payable', 236, 2, 8, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(77, 'Historical Adjustments', 255, 2, 8, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(78, 'Revenue Received in Advance', 835, 2, 8, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(79, 'Rounding', 260, 2, 8, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(80, 'Costs of Goods Sold', 500, 3, 11, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(81, 'Advertising', 600, 3, 12, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(82, 'Automobile Expenses', 644, 3, 12, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(83, 'Bad Debts', 684, 3, 12, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(84, 'Bank Revaluations', 810, 3, 12, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(85, 'Bank Service Charges', 605, 3, 12, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(86, 'Consulting & Accounting', 615, 3, 12, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(87, 'Depreciation', 700, 3, 12, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(88, 'General Expenses', 628, 3, 12, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(89, 'Interest Income', 460, 4, 13, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(90, 'Other Revenue', 470, 4, 13, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(91, 'Purchase Discount', 475, 4, 13, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(92, 'Sales', 400, 4, 13, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(93, 'Common Stock', 330, 5, 16, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(94, 'Owners Contribution', 300, 5, 16, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(95, 'Owners Draw', 310, 5, 16, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16'),
(96, 'Retained Earnings', 320, 5, 16, 1, NULL, 5, '2022-08-18 01:05:16', '2022-08-18 01:05:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chart_of_account_sub_types`
--

CREATE TABLE `chart_of_account_sub_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `type` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `chart_of_account_sub_types`
--

INSERT INTO `chart_of_account_sub_types` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Current Asset', 1, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(2, 'Fixed Asset', 1, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(3, 'Inventory', 1, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(4, 'Non-current Asset', 1, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(5, 'Prepayment', 1, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(6, 'Bank & Cash', 1, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(7, 'Depreciation', 1, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(8, 'Current Liability', 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(9, 'Liability', 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(10, 'Non-current Liability', 2, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(11, 'Direct Costs', 3, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(12, 'Expense', 3, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(13, 'Revenue', 4, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(14, 'Sales', 4, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(15, 'Other Income', 4, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(16, 'Equity', 5, '2022-08-09 21:01:43', '2022-08-09 21:01:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chart_of_account_types`
--

CREATE TABLE `chart_of_account_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `chart_of_account_types`
--

INSERT INTO `chart_of_account_types` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Assets', 1, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(2, 'Liabilities', 1, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(3, 'Expenses', 1, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(4, 'Income', 1, '2022-08-09 21:01:43', '2022-08-09 21:01:43'),
(5, 'Equity', 1, '2022-08-09 21:01:43', '2022-08-09 21:01:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_payment_settings`
--

CREATE TABLE `company_payment_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contracts`
--

CREATE TABLE `contracts` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `theme` varchar(256) DEFAULT NULL,
  `amount` varchar(256) DEFAULT NULL,
  `type` varchar(256) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contracts`
--

INSERT INTO `contracts` (`id`, `customer_id`, `project_id`, `theme`, `amount`, `type`, `date_start`, `date_end`, `description`) VALUES
(1, 1, 2, 'Contrato de prueba', '123', 'Criative Digital', '2022-08-05', '2022-09-15', 'Descripción de prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double(8,2) NOT NULL DEFAULT '0.00',
  `limit` int(11) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credit_notes`
--

CREATE TABLE `credit_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice` int(11) NOT NULL DEFAULT '0',
  `customer` int(11) NOT NULL DEFAULT '0',
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `is_active` int(11) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `billing_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_zip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `balance` double(8,2) NOT NULL DEFAULT '0.00',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `name`, `email`, `password`, `contact`, `avatar`, `created_by`, `is_active`, `email_verified_at`, `billing_name`, `billing_country`, `billing_state`, `billing_city`, `billing_phone`, `billing_zip`, `billing_address`, `shipping_name`, `shipping_country`, `shipping_state`, `shipping_city`, `shipping_phone`, `shipping_zip`, `shipping_address`, `lang`, `balance`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nisa Delgado', 'nisadelgado@gmail.com', '$2y$10$RSJaUZFajyi6pAxYECbeWOVZ24Yi7YpUDwJgyQXEXQTLi3SzZCu.C', '+58 424-6402701', '', 2, 1, NULL, 'Casa', 'Venezuela', 'Casado', 'Maracaibo', '04246402701', '4001', 'Calle 90, Av. 16', '', '', '', '', '', '', '', 'en', 0.00, NULL, '2022-08-11 05:35:09', '2022-08-11 05:35:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `custom_fields`
--

INSERT INTO `custom_fields` (`id`, `name`, `type`, `module`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'peso', 'text', 'user', 4, '2022-08-17 00:40:52', '2022-08-17 00:40:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `custom_field_values`
--

CREATE TABLE `custom_field_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `record_id` bigint(20) UNSIGNED NOT NULL,
  `field_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `debit_notes`
--

CREATE TABLE `debit_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill` int(11) NOT NULL DEFAULT '0',
  `vendor` int(11) NOT NULL DEFAULT '0',
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `amount` double(8,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `project` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `type` varchar(256) DEFAULT NULL,
  `total_comments` varchar(256) DEFAULT NULL,
  `upload_by` varchar(256) DEFAULT NULL,
  `date_upload` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `files`
--

INSERT INTO `files` (`id`, `project_id`, `name`, `type`, `total_comments`, `upload_by`, `date_upload`) VALUES
(4, 2, 'Captura de pantalla (1).png', 'png', NULL, '2', '2022-08-15 06:32:52'),
(5, 2, 'Captura de pantalla (2).png', 'png', NULL, '2', '2022-08-15 06:32:53'),
(6, 2, 'Captura de pantalla (3).png', 'png', NULL, '2', '2022-08-15 06:32:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `file_project_comments`
--

CREATE TABLE `file_project_comments` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `file_project_comments`
--

INSERT INTO `file_project_comments` (`id`, `file_id`, `user_id`, `comment`, `date`) VALUES
(1, 4, 1, 'Comentario prueba', '2022-08-15 15:27:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `goals`
--

CREATE TABLE `goals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `is_display` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `send_date` date DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `ref_number` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '0',
  `shipping_display` int(11) NOT NULL DEFAULT '1',
  `discount_apply` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_id`, `customer_id`, `issue_date`, `due_date`, `send_date`, `category_id`, `ref_number`, `status`, `shipping_display`, `discount_apply`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-08-12', '2022-08-12', NULL, 0, '', 0, 1, 0, 2, '2022-08-12 21:28:13', '2022-08-12 21:28:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice_payments`
--

CREATE TABLE `invoice_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `account_id` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `receipt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Manually',
  `txn_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice_products`
--

CREATE TABLE `invoice_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `tax` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0.00',
  `discount` double(8,2) NOT NULL DEFAULT '0.00',
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `invoice_products`
--

INSERT INTO `invoice_products` (`id`, `invoice_id`, `product_id`, `quantity`, `tax`, `discount`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '', 0.00, 123.00, '', '2022-08-12 21:28:13', '2022-08-12 21:28:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `journal_entries`
--

CREATE TABLE `journal_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `journal_id` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `journal_items`
--

CREATE TABLE `journal_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `journal` int(11) NOT NULL DEFAULT '0',
  `account` int(11) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `debit` double(8,2) NOT NULL DEFAULT '0.00',
  `credit` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `landing_page_sections`
--

CREATE TABLE `landing_page_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_order` int(11) NOT NULL DEFAULT '0',
  `content` text COLLATE utf8mb4_unicode_ci,
  `section_type` enum('section-1','section-2','section-3','section-4','section-5','section-6','section-7','section-8','section-9','section-10','section-plan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_demo_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_blade_file_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `landing_page_sections`
--

INSERT INTO `landing_page_sections` (`id`, `section_name`, `section_order`, `content`, `section_type`, `default_content`, `section_demo_image`, `section_blade_file_name`, `created_at`, `updated_at`) VALUES
(1, 'section-1', 1, '{\"logo\":\"logo_166041202861344535.png\",\"image\":\"top-banner.png\",\"button\":{\"text\":\"Login\"},\"menu\":[{\"menu\":\"Recursos\",\"href\":\"#\"},{\"menu\":\"Precios\",\"href\":\"#\"}],\"text\":{\"text-1\":\"I9 Finance\",\"text-2\":\"Herramienta de Contabilidad y Facturaci\\u00f3n\",\"text-3\":\"Con I9 Finance, comenzar\\u00e1 r\\u00e1pidamente a identificar patrones de gasto clave y comenzar\\u00e1 a ahorrar dinero de manera eficiente en tu negocio.\",\"text-4\":\"Empezar - es gratis\",\"text-5\":\"No se requiere tarjeta de cr\\u00e9dito\"},\"custom_class_name\":\"\"}', 'section-1', '{\"logo\":\"landing_logo.png\",\"image\":\"top-banner.png\",\"button\":{\"text\":\"Login\"},\"menu\":[{\"menu\":\"Features\",\"href\":\"#\"},{\"menu\":\"Pricing\",\"href\":\"#\"}],\"text\":{\"text-1\":\"AccountGo Saas\",\"text-2\":\"Accounting and Billing Tool\",\"text-3\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\",\"text-4\":\"get started - its free\",\"text-5\":\"no creadit card reqired \"},\"custom_class_name\":\"\"}', 'top-header-section.png', 'custome-top-header-section', '2022-08-09 21:01:43', '2022-08-13 20:33:48'),
(2, 'section-2', 2, '{\"image\":\"cal-sec.png\",\"button\":{\"text\":\"Prueba Gratis\",\"href\":\"https:\\/\\/i9finance.com\\/register\"},\"text\":{\"text-1\":\"Caracter\\u00edsticas\",\"text-2\":\"Toma el control de tu empresa\",\"text-3\":\"Flexible para todo tipo de negocio\",\"text-4\":\"Si ha intentado rastrear dinero antes, sabe que puede ser extremadamente frustrante con las herramientas incorrectas. i9 Finance lo ayuda y lo empodera desglosando sus gastos de una manera simple, intuitiva y comprensible.\\r\\n\\r\\nCon i9 Finance, comenzar\\u00e1 r\\u00e1pidamente a identificar patrones de gasto clave y comenzar\\u00e1 a ahorrar dinero de manera eficiente.\"},\"image_array\":[{\"id\":1,\"image\":\"nexo.png\"},{\"id\":2,\"image\":\"edge.png\"},{\"id\":3,\"image\":\"atomic.png\"},{\"id\":4,\"image\":\"brd.png\"},{\"id\":5,\"image\":\"trust.png\"},{\"id\":6,\"image\":\"keep-key.png\"},{\"id\":7,\"image\":\"atomic.png\"},{\"id\":8,\"image\":\"edge.png\"}],\"custom_class_name\":\"\"}', 'section-2', '{\"image\":\"cal-sec.png\",\"button\":{\"text\":\"try our system\",\"href\":\"#\"},\"text\":{\"text-1\":\"Features\",\"text-2\":\"Lorem Ipsum is simply dummy\",\"text-3\":\"text of the printing\",\"text-4\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting\"},\"image_array\":[{\"id\":1,\"image\":\"nexo.png\"},{\"id\":2,\"image\":\"edge.png\"},{\"id\":3,\"image\":\"atomic.png\"},{\"id\":4,\"image\":\"brd.png\"},{\"id\":5,\"image\":\"trust.png\"},{\"id\":6,\"image\":\"keep-key.png\"},{\"id\":7,\"image\":\"atomic.png\"},{\"id\":8,\"image\":\"edge.png\"}],\"custom_class_name\":\"\"}', 'logo-part-main-back-part.png', 'custome-logo-part-main-back-part', '2022-08-09 21:01:43', '2022-08-13 21:30:58'),
(3, 'section-3', 8, NULL, 'section-3', '{\"image\": \"sec-2.png\",\"button\": {\"text\": \"try our system\",\"href\": \"#\"},\"text\": {\"text-1\": \"Features\",\"text-2\": \"Lorem Ipsum is simply dummy\",\"text-3\": \"text of the printing\",\"text-4\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting\"},\"custom_class_name\":\"\"}', 'simple-sec-even.png', 'custome-simple-sec-even', '2022-08-09 21:01:43', '2022-08-13 22:34:56'),
(4, 'section-4', 9, NULL, 'section-4', '{\"image\": \"sec-3.png\",\"button\": {\"text\": \"try our system\",\"href\": \"#\"},\"text\": {\"text-1\": \"Features\",\"text-2\": \"Lorem Ipsum is simply dummy\",\"text-3\": \"text of the printing\",\"text-4\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting\"},\"custom_class_name\":\"\"}', 'simple-sec-odd.png', 'custome-simple-sec-odd', '2022-08-09 21:01:43', '2022-08-13 22:34:56'),
(5, 'section-5', 10, NULL, 'section-5', '{\"button\": {\"text\": \"TRY OUR SYSTEM\",\"href\": \"#\"},\"text\": {\"text-1\": \"See more features\",\"text-2\": \"All Features\",\"text-3\": \"in one place\",\"text-4\": \"Attractive Dashboard Customer & Vendor Login Multi Languages\",\"text-5\":\"Invoice, Billing & Transaction Multi User & Permission Paypal & Stripe for Invoice User Friendly Invoice Theme Make your own setting\",\"text-6\":\"Multi User & Permission Paypal & Stripe for Invoice User Friendly Invoice Theme Make your own setting\",\"text-7\":\"Multi User & Permission Paypal & Stripe for Invoice User Friendly Invoice Theme Make your own setting User Friendly Invoice Theme Make your own setting\",\"text-8\":\"Multi User & Permission Paypal & Stripe for Invoice\"},\"custom_class_name\":\"\"}', 'features-inner-part.png', 'custome-features-inner-part', '2022-08-09 21:01:43', '2022-08-13 22:34:56'),
(6, 'section-6', 3, '{\"system\":[{\"id\":1,\"name\":\"Dashboard\",\"data\":[{\"data_id\":1,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"P\\u00e1gina principal\"},\"button\":{\"text\":\"Prueba Gratis\",\"href\":\"https:\\/\\/i9finance.com\\/register\"},\"image\":\"tab-1.png\"},{\"data_id\":2,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Ingreso x Gastos\"},\"button\":{\"text\":\"Prueba Gratis\",\"href\":\"https:\\/\\/i9finance.com\\/register\"},\"image\":\"image_16604183781021346256.png\"},{\"data_id\":3,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Graficos\"},\"button\":{\"text\":\"Prueba Gratis\",\"href\":\"https:\\/\\/i9finance.com\\/register\"},\"image\":\"tab-3.png\"},{\"data_id\":4,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Flujo de Caja\"},\"button\":{\"text\":\"Prueba Gratis\",\"href\":\"https:\\/\\/i9finance.com\\/register\"},\"image\":\"tab-1.png\"},{\"data_id\":5,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-2.png\"}]},{\"id\":2,\"name\":\"Functions\",\"data\":[{\"data_id\":2,\"text\":{\"text_1\":\"Funcciones\",\"text_2\":\"Propuestas\"},\"button\":{\"text\":\"Prueba Gratis\",\"href\":\"https:\\/\\/i9finance.com\\/register\"},\"image\":\"image_16604179061367267036.png\"},{\"data_id\":3,\"text\":{\"text_1\":\"Funcciones\",\"text_2\":\"Contractos\"},\"button\":{\"text\":\"Prueba Gratis\",\"href\":\"https:\\/\\/i9finance.com\\/register\"},\"image\":\"image_1660417439892311921.png\"},{\"data_id\":3,\"text\":{\"text_1\":\"Funcciones\",\"text_2\":\"Productos y Servicios\"},\"button\":{\"text\":\"Prueba Gratis\",\"href\":\"https:\\/\\/i9finance.com\\/register\"},\"image\":\"image_166041758225852142.png\"},{\"data_id\":4,\"text\":{\"text_1\":\"Funcciones\",\"text_2\":\"Clientes\"},\"button\":{\"text\":\"Prueba Gratis\",\"href\":\"https:\\/\\/i9finance.com\\/register\"},\"image\":\"image_16604177661900302481.png\"},{\"data_id\":5,\"text\":{\"text_1\":\"Funcciones\",\"text_2\":\"Proveedores\"},\"button\":{\"text\":\"Prueba Gratis\",\"href\":\"https:\\/\\/i9finance.com\\/register\"},\"image\":\"image_16604178111194660080.png\"},{\"data_id\":6,\"text\":{\"text_1\":\"Funcciones\",\"text_2\":\"Bancos\"},\"button\":{\"text\":\"Prueba Gratis\",\"href\":\"https:\\/\\/i9finance.com\\/register\"},\"image\":\"image_1660417869436168489.png\"},{\"data_id\":7,\"text\":{\"text_1\":\"Funcciones\",\"text_2\":\"Facturas\"},\"button\":{\"text\":\"Prueba Gratis\",\"href\":\"https:\\/\\/i9finance.com\\/register\"},\"image\":\"image_1660417935216963600.png\"},{\"data_id\":8,\"text\":{\"text_1\":\"Funcciones\",\"text_2\":\"Pagos\"},\"button\":{\"text\":\"Prueba Gratis\",\"href\":\"https:\\/\\/i9finance.com\\/register\"},\"image\":\"image_1660418010660812327.png\"},{\"data_id\":9,\"text\":{\"text_1\":\"Funcciones\",\"text_2\":\"Metas\"},\"button\":{\"text\":\"Prueba Gratis\",\"href\":\"https:\\/\\/i9finance.com\\/register\"},\"image\":\"image_16604180391890067779.png\"}]},{\"id\":3,\"name\":\"Reports\",\"data\":[{\"data_id\":1,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-1.png\"},{\"data_id\":2,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-2.png\"}]},{\"id\":4,\"name\":\"Tables\",\"data\":[{\"data_id\":1,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-1.png\"},{\"data_id\":2,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-2.png\"},{\"data_id\":3,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-3.png\"},{\"data_id\":4,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-1.png\"}]},{\"id\":5,\"name\":\"Settings\",\"data\":[{\"data_id\":1,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-1.png\"},{\"data_id\":2,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-2.png\"}]},{\"id\":6,\"name\":\"Contact\",\"data\":[{\"data_id\":1,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-1.png\"}]}],\"custom_class_name\":null}', 'section-6', '{\"system\":[{\"id\":1,\"name\":\"Dashboard\",\"data\":[{\"data_id\":1,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-1.png\"},{\"data_id\":2,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-2.png\"},{\"data_id\":3,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-3.png\"},{\"data_id\":4,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-1.png\"},{\"data_id\":5,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-2.png\"}]},{\"id\":2,\"name\":\"Functions\",\"data\":[{\"data_id\":1,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-1.png\"},{\"data_id\":2,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-2.png\"},{\"data_id\":3,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-3.png\"}]},{\"id\":3,\"name\":\"Reports\",\"data\":[{\"data_id\":1,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-1.png\"},{\"data_id\":2,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-2.png\"}]},{\"id\":4,\"name\":\"Tables\",\"data\":[{\"data_id\":1,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-1.png\"},{\"data_id\":2,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-2.png\"},{\"data_id\":3,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-3.png\"},{\"data_id\":4,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-1.png\"}]},{\"id\":5,\"name\":\"Settings\",\"data\":[{\"data_id\":1,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-1.png\"},{\"data_id\":2,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-2.png\"}]},{\"id\":6,\"name\":\"Contact\",\"data\":[{\"data_id\":1,\"text\":{\"text_1\":\"Dashboard\",\"text_2\":\"Main Page\"},\"button\":{\"text\":\"LIVE DEMO\",\"href\":\"#\"},\"image\":\"tab-1.png\"}]}],\"custom_class_name\":\"\"}', 'container-our-system-div.png', 'custome-container-our-system-div', '2022-08-09 21:01:43', '2022-08-13 22:34:56'),
(7, 'section-7', 11, NULL, 'section-7', '{\"testimonials\":[{\"id\":1,\"text\":{\"text_1\":\"We have been building AI projects for a long time and we decided it was time to build a platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.\",\"text_2\":\"Lorem Ipsum\",\"text_3\":\"Founder and CEO at Rajodiya Infotech\"},\"image\":\"testimonials-img.png\"},{\"id\":2,\"text\":{\"text_1\":\"We have been building AI projects for a long time and we decided it was time to build a platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.\",\"text_2\":\"Lorem Ipsum\",\"text_3\":\"Founder and CEO at Rajodiya Infotech\"},\"image\":\"testimonials-img.png\"},{\"id\":3,\"text\":{\"text_1\":\"We have been building AI projects for a long time and we decided it was time to build a platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.\",\"text_2\":\"Lorem Ipsum\",\"text_3\":\"Founder and CEO at Rajodiya Infotech\"},\"image\":\"testimonials-img.png\"},{\"id\":4,\"text\":{\"text_1\":\"We have been building AI projects for a long time and we decided it was time to build a platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.\",\"text_2\":\"Lorem Ipsum\",\"text_3\":\"Founder and CEO at Rajodiya Infotech\"},\"image\":\"testimonials-img.png\"},{\"id\":5,\"text\":{\"text_1\":\"We have been building AI projects for a long time and we decided it was time to build a platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.\",\"text_2\":\"Lorem Ipsum\",\"text_3\":\"Founder and CEO at Rajodiya Infotech\"},\"image\":\"testimonials-img.png\"}],\"custom_class_name\":\"\"}', 'testimonials-section.png', 'custome-testimonials-section', '2022-08-09 21:01:43', '2022-08-13 22:34:56'),
(8, 'section-plan', 4, 'plan', 'section-plan', 'plan', 'plan-section.png', 'plan-section', '2022-08-09 21:01:43', '2022-08-13 22:34:56'),
(9, 'section-8', 5, '{\"button\":{\"text\":\"Subscribe\"},\"text\":{\"text-1\":\"Receba informaciones\",\"text-2\":\"Hecho con amor para tu neg\\u00f3cio\",\"text-3\":\"Prueba Gr\\u00e1tis\",\"text-4\":\"Digite su mejor correo electr\\u00f3nico y dale click en subscribe\"},\"custom_class_name\":\"\"}', 'section-8', '{\"button\":{\"text\":\"Subscribe\"},\"text\":{\"text-1\":\"Try for free\",\"text-2\":\"Lorem Ipsum is simply dummy text\",\"text-3\":\"of the printing and typesetting industry\",\"text-4\":\"Type your email address and click the button\"},\"custom_class_name\":\"\"}', 'subscribe-part.png', 'custome-subscribe-part', '2022-08-09 21:01:43', '2022-08-13 23:09:45'),
(10, 'section-9', 6, '', 'section-9', '{\"menu\":[{\"menu\":\"Facebook\",\"href\":\"#\"},{\"menu\":\"LinkedIn\",\"href\":\"#\"},{\"menu\":\"Twitter\",\"href\":\"#\"},{\"menu\":\"Discord\",\"href\":\"#\"}],\"custom_class_name\":\"\"}', 'social-links.png', 'custome-social-links', '2022-08-09 21:01:43', '2022-08-13 23:09:55'),
(11, 'section-10', 7, '{\"footer\":{\"logo\":{\"logo\":\"logo_1660421677729704174.png\",\"text\":\"\"},\"footer_menu\":[{\"id\":1,\"menu\":\"FIO Protocol\",\"data\":[{\"menu_name\":\"Feature\",\"menu_href\":\"#\"},{\"menu_name\":\"Download\",\"menu_href\":\"#\"},{\"menu_name\":\"Integration\",\"menu_href\":\"#\"},{\"menu_name\":\"Extras\",\"menu_href\":\"#\"}]},{\"id\":2,\"menu\":\"Learn\",\"data\":[{\"menu_name\":\"Feature\",\"menu_href\":\"#\"},{\"menu_name\":\"Download\",\"menu_href\":\"#\"},{\"menu_name\":\"Integration\",\"menu_href\":\"#\"},{\"menu_name\":\"Extras\",\"menu_href\":\"#\"}]},{\"id\":3,\"menu\":\"Foundation\",\"data\":[{\"menu_name\":\"About Us\",\"menu_href\":\"#\"},{\"menu_name\":\"Customers\",\"menu_href\":\"#\"},{\"menu_name\":\"Resources\",\"menu_href\":\"#\"},{\"menu_name\":\"Blog\",\"menu_href\":\"#\"}]}],\"contact_app\":[{\"menu\":\"Contacto\",\"data\":[{\"id\":1,\"image\":\"app-store.png\",\"image_href\":\"#\"},{\"id\":2,\"image\":\"google-pay.png\",\"image_href\":\"#\"}]}],\"bottom_menu\":{\"id\":\"bottom_menu\",\"text\":\"All rights reserved.\",\"data\":[{\"menu_name\":\"Privacy Policy\",\"menu_href\":\"#\"},{\"menu_name\":\"Github\",\"menu_href\":\"#\"},{\"menu_name\":\"Press Kit\",\"menu_href\":\"#\"},{\"menu_name\":\"Contact\",\"menu_href\":\"https:\\/\\/wa.me\\/+59171608981?text=Informacion%20%20i9Finance\"}]}},\"custom_class_name\":\"\"}', 'section-10', '{\"footer\":{\"logo\":{\"logo\":\"landing_logo.png\"},\"footer_menu\":[{\"id\":1,\"menu\":\"FIO Protocol\",\"data\":[{\"menu_name\":\"Feature\",\"menu_href\":\"#\"},{\"menu_name\":\"Download\",\"menu_href\":\"#\"},{\"menu_name\":\"Integration\",\"menu_href\":\"#\"},{\"menu_name\":\"Extras\",\"menu_href\":\"#\"}]},{\"id\":2,\"menu\":\"Learn\",\"data\":[{\"menu_name\":\"Feature\",\"menu_href\":\"#\"},{\"menu_name\":\"Download\",\"menu_href\":\"#\"},{\"menu_name\":\"Integration\",\"menu_href\":\"#\"},{\"menu_name\":\"Extras\",\"menu_href\":\"#\"}]},{\"id\":3,\"menu\":\"Foundation\",\"data\":[{\"menu_name\":\"About Us\",\"menu_href\":\"#\"},{\"menu_name\":\"Customers\",\"menu_href\":\"#\"},{\"menu_name\":\"Resources\",\"menu_href\":\"#\"},{\"menu_name\":\"Blog\",\"menu_href\":\"#\"}]}],\"contact_app\":[{\"menu\":\"Contact\",\"data\":[{\"id\":1,\"image\":\"app-store.png\",\"image_href\":\"#\"},{\"id\":2,\"image\":\"google-pay.png\",\"image_href\":\"#\"}]}],\"bottom_menu\":{\"text\":\"All rights reserved.\",\"data\":[{\"menu_name\":\"Privacy Policy\",\"menu_href\":\"#\"},{\"menu_name\":\"Github\",\"menu_href\":\"#\"},{\"menu_name\":\"Press Kit\",\"menu_href\":\"#\"},{\"menu_name\":\"Contact\",\"menu_href\":\"#\"}]}},\"custom_class_name\":\"\"}', 'footer-section.png', 'custome-footer-section', '2022-08-09 21:01:43', '2022-08-13 23:14:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_09_28_102009_create_settings_table', 1),
(5, '2019_11_13_051828_create_taxes_table', 1),
(6, '2019_11_13_055026_create_invoices_table', 1),
(7, '2019_11_13_072623_create_expenses_table', 1),
(8, '2019_11_21_090403_create_plans_table', 1),
(9, '2020_01_08_063207_create_product_services_table', 1),
(10, '2020_01_08_084029_create_product_service_categories_table', 1),
(11, '2020_01_08_092717_create_product_service_units_table', 1),
(12, '2020_01_08_121541_create_customers_table', 1),
(13, '2020_01_09_104945_create_venders_table', 1),
(14, '2020_01_09_113852_create_bank_accounts_table', 1),
(15, '2020_01_09_124222_create_transfers_table', 1),
(16, '2020_01_10_064723_create_transactions_table', 1),
(17, '2020_01_13_072608_create_invoice_products_table', 1),
(18, '2020_01_15_034438_create_revenues_table', 1),
(19, '2020_01_15_051228_create_bills_table', 1),
(20, '2020_01_15_060859_create_bill_products_table', 1),
(21, '2020_01_15_073237_create_payments_table', 1),
(22, '2020_01_16_043907_create_orders_table', 1),
(23, '2020_01_18_051650_create_invoice_payments_table', 1),
(24, '2020_01_20_091035_create_bill_payments_table', 1),
(25, '2020_02_25_052356_create_credit_notes_table', 1),
(26, '2020_02_26_033827_create_debit_notes_table', 1),
(27, '2020_03_12_095629_create_coupons_table', 1),
(28, '2020_03_12_120749_create_user_coupons_table', 1),
(29, '2020_04_02_045834_create_proposals_table', 1),
(30, '2020_04_02_055706_create_proposal_products_table', 1),
(31, '2020_04_18_035141_create_goals_table', 1),
(32, '2020_04_21_115823_create_assets_table', 1),
(33, '2020_04_24_023732_create_custom_fields_table', 1),
(34, '2020_04_24_024217_create_custom_field_values_table', 1),
(35, '2020_05_21_065337_create_permission_tables', 1),
(36, '2020_06_30_120854_add_balance_to_customers_table', 1),
(37, '2020_06_30_121531_add_balance_to_vender_table', 1),
(38, '2020_07_01_033457_change_product_services_tax_id_column_type', 1),
(39, '2020_07_01_063255_change_tax_column_type', 1),
(40, '2020_07_03_054342_add_convert_in_proposal_table', 1),
(41, '2020_07_06_102454_add_payment_type_in_orders_table', 1),
(42, '2020_07_07_052211_add_field_in_invoice_payments_table', 1),
(43, '2020_07_22_131715_change_amount_type_size', 1),
(44, '2020_08_04_034206_change_settings_value_type', 1),
(45, '2020_09_16_040822_change_user_type_size_in_users_table', 1),
(46, '2020_09_17_053350_change_shipping_default_val', 1),
(47, '2020_09_17_070031_add_description_field', 1),
(48, '2021_01_11_062508_create_chart_of_accounts_table', 1),
(49, '2021_01_11_070441_create_chart_of_account_types_table', 1),
(50, '2021_01_12_032834_create_journal_entries_table', 1),
(51, '2021_01_12_033815_create_journal_items_table', 1),
(52, '2021_01_20_072219_create_chart_of_account_sub_types_table', 1),
(53, '2021_06_15_035736_create_landing_page_sections_table', 1),
(54, '2021_07_15_091920_admin_payment_settings', 1),
(55, '2021_07_15_091933_company_payment_settings', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Customer', 1),
(1, 'App\\User', 1),
(4, 'App\\User', 2),
(5, 'App\\User', 3),
(4, 'App\\User', 4),
(4, 'App\\User', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_exp_month` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_exp_year` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_id` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `price_currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `txn_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Manually',
  `receipt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `name`, `email`, `card_number`, `card_exp_month`, `card_exp_year`, `plan_name`, `plan_id`, `price`, `price_currency`, `txn_id`, `payment_status`, `payment_type`, `receipt`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '62F80D45E11E7433158861', NULL, NULL, NULL, NULL, NULL, 'Basic', 2, 5.00, '', '', 'succeeded', 'Manually', NULL, 4, '2022-08-13 23:44:53', '2022-08-13 23:44:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `account_id` int(11) NOT NULL,
  `vender_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `recurring` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` int(11) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'show dashboard', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(2, 'manage user', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(3, 'create user', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(4, 'edit user', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(5, 'delete user', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(6, 'create language', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(7, 'manage system settings', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(8, 'manage role', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(9, 'create role', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(10, 'edit role', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(11, 'delete role', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(12, 'manage permission', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(13, 'create permission', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(14, 'edit permission', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(15, 'delete permission', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(16, 'manage company settings', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(17, 'manage business settings', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(18, 'manage stripe settings', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(19, 'manage expense', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(20, 'create expense', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(21, 'edit expense', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(22, 'delete expense', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(23, 'manage invoice', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(24, 'create invoice', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(25, 'edit invoice', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(26, 'delete invoice', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(27, 'show invoice', 'web', '2022-08-09 20:59:10', '2022-08-09 20:59:10'),
(28, 'create payment invoice', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(29, 'delete payment invoice', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(30, 'send invoice', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(31, 'delete invoice product', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(32, 'convert invoice', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(33, 'manage plan', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(34, 'create plan', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(35, 'edit plan', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(36, 'manage constant unit', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(37, 'create constant unit', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(38, 'edit constant unit', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(39, 'delete constant unit', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(40, 'manage constant tax', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(41, 'create constant tax', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(42, 'edit constant tax', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(43, 'delete constant tax', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(44, 'manage constant category', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(45, 'create constant category', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(46, 'edit constant category', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(47, 'delete constant category', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(48, 'manage product & service', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(49, 'create product & service', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(50, 'edit product & service', 'web', '2022-08-09 20:59:11', '2022-08-09 20:59:11'),
(51, 'delete product & service', 'web', '2022-08-09 20:59:12', '2022-08-09 20:59:12'),
(52, 'manage customer', 'web', '2022-08-09 20:59:12', '2022-08-09 20:59:12'),
(53, 'create customer', 'web', '2022-08-09 20:59:12', '2022-08-09 20:59:12'),
(54, 'edit customer', 'web', '2022-08-09 20:59:12', '2022-08-09 20:59:12'),
(55, 'delete customer', 'web', '2022-08-09 20:59:12', '2022-08-09 20:59:12'),
(56, 'show customer', 'web', '2022-08-09 20:59:12', '2022-08-09 20:59:12'),
(57, 'manage vender', 'web', '2022-08-09 20:59:12', '2022-08-09 20:59:12'),
(58, 'create vender', 'web', '2022-08-09 20:59:12', '2022-08-09 20:59:12'),
(59, 'edit vender', 'web', '2022-08-09 20:59:12', '2022-08-09 20:59:12'),
(60, 'delete vender', 'web', '2022-08-09 20:59:12', '2022-08-09 20:59:12'),
(61, 'show vender', 'web', '2022-08-09 20:59:12', '2022-08-09 20:59:12'),
(62, 'manage bank account', 'web', '2022-08-09 20:59:12', '2022-08-09 20:59:12'),
(63, 'create bank account', 'web', '2022-08-09 20:59:12', '2022-08-09 20:59:12'),
(64, 'edit bank account', 'web', '2022-08-09 20:59:12', '2022-08-09 20:59:12'),
(65, 'delete bank account', 'web', '2022-08-09 20:59:12', '2022-08-09 20:59:12'),
(66, 'manage transfer', 'web', '2022-08-09 20:59:13', '2022-08-09 20:59:13'),
(67, 'create transfer', 'web', '2022-08-09 20:59:13', '2022-08-09 20:59:13'),
(68, 'edit transfer', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(69, 'delete transfer', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(70, 'manage constant payment method', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(71, 'create constant payment method', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(72, 'edit constant payment method', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(73, 'delete constant payment method', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(74, 'manage transaction', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(75, 'manage revenue', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(76, 'create revenue', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(77, 'edit revenue', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(78, 'delete revenue', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(79, 'manage bill', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(80, 'create bill', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(81, 'edit bill', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(82, 'delete bill', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(83, 'show bill', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(84, 'manage payment', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(85, 'create payment', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(86, 'edit payment', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(87, 'delete payment', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(88, 'delete bill product', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(89, 'buy plan', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(90, 'send bill', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(91, 'create payment bill', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(92, 'delete payment bill', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(93, 'manage order', 'web', '2022-08-09 20:59:15', '2022-08-09 20:59:15'),
(94, 'income report', 'web', '2022-08-09 20:59:17', '2022-08-09 20:59:17'),
(95, 'expense report', 'web', '2022-08-09 20:59:17', '2022-08-09 20:59:17'),
(96, 'income vs expense report', 'web', '2022-08-09 20:59:17', '2022-08-09 20:59:17'),
(97, 'invoice report', 'web', '2022-08-09 20:59:17', '2022-08-09 20:59:17'),
(98, 'bill report', 'web', '2022-08-09 20:59:17', '2022-08-09 20:59:17'),
(99, 'tax report', 'web', '2022-08-09 20:59:17', '2022-08-09 20:59:17'),
(100, 'loss & profit report', 'web', '2022-08-09 20:59:17', '2022-08-09 20:59:17'),
(101, 'manage customer payment', 'web', '2022-08-09 20:59:17', '2022-08-09 20:59:17'),
(102, 'manage customer transaction', 'web', '2022-08-09 20:59:17', '2022-08-09 20:59:17'),
(103, 'manage customer invoice', 'web', '2022-08-09 20:59:17', '2022-08-09 20:59:17'),
(104, 'vender manage bill', 'web', '2022-08-09 20:59:17', '2022-08-09 20:59:17'),
(105, 'manage vender bill', 'web', '2022-08-09 20:59:17', '2022-08-09 20:59:17'),
(106, 'manage vender payment', 'web', '2022-08-09 20:59:17', '2022-08-09 20:59:17'),
(107, 'manage vender transaction', 'web', '2022-08-09 20:59:17', '2022-08-09 20:59:17'),
(108, 'manage credit note', 'web', '2022-08-09 20:59:17', '2022-08-09 20:59:17'),
(109, 'create credit note', 'web', '2022-08-09 20:59:17', '2022-08-09 20:59:17'),
(110, 'edit credit note', 'web', '2022-08-09 20:59:17', '2022-08-09 20:59:17'),
(111, 'delete credit note', 'web', '2022-08-09 20:59:18', '2022-08-09 20:59:18'),
(112, 'manage debit note', 'web', '2022-08-09 20:59:18', '2022-08-09 20:59:18'),
(113, 'create debit note', 'web', '2022-08-09 20:59:18', '2022-08-09 20:59:18'),
(114, 'edit debit note', 'web', '2022-08-09 20:59:18', '2022-08-09 20:59:18'),
(115, 'delete debit note', 'web', '2022-08-09 20:59:18', '2022-08-09 20:59:18'),
(116, 'duplicate invoice', 'web', '2022-08-09 20:59:18', '2022-08-09 20:59:18'),
(117, 'duplicate bill', 'web', '2022-08-09 20:59:18', '2022-08-09 20:59:18'),
(118, 'manage coupon', 'web', '2022-08-09 20:59:18', '2022-08-09 20:59:18'),
(119, 'create coupon', 'web', '2022-08-09 20:59:18', '2022-08-09 20:59:18'),
(120, 'edit coupon', 'web', '2022-08-09 20:59:19', '2022-08-09 20:59:19'),
(121, 'delete coupon', 'web', '2022-08-09 20:59:19', '2022-08-09 20:59:19'),
(122, 'manage proposal', 'web', '2022-08-09 20:59:19', '2022-08-09 20:59:19'),
(123, 'create proposal', 'web', '2022-08-09 20:59:19', '2022-08-09 20:59:19'),
(124, 'edit proposal', 'web', '2022-08-09 20:59:19', '2022-08-09 20:59:19'),
(125, 'delete proposal', 'web', '2022-08-09 20:59:19', '2022-08-09 20:59:19'),
(126, 'duplicate proposal', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(127, 'show proposal', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(128, 'send proposal', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(129, 'delete proposal product', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(130, 'manage customer proposal', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(131, 'manage goal', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(132, 'create goal', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(133, 'edit goal', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(134, 'delete goal', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(135, 'manage assets', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(136, 'create assets', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(137, 'edit assets', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(138, 'delete assets', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(139, 'statement report', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(140, 'manage constant custom field', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(141, 'create constant custom field', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(142, 'edit constant custom field', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(143, 'delete constant custom field', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(144, 'manage chart of account', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(145, 'create chart of account', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(146, 'edit chart of account', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(147, 'delete chart of account', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(148, 'manage journal entry', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(149, 'create journal entry', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(150, 'edit journal entry', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(151, 'delete journal entry', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(152, 'show journal entry', 'web', '2022-08-09 20:59:24', '2022-08-09 20:59:24'),
(153, 'balance sheet report', 'web', '2022-08-09 20:59:25', '2022-08-09 20:59:25'),
(154, 'ledger report', 'web', '2022-08-09 20:59:25', '2022-08-09 20:59:25'),
(155, 'trial balance report', 'web', '2022-08-09 20:59:25', '2022-08-09 20:59:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `duration` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_users` int(11) NOT NULL DEFAULT '0',
  `max_customers` int(11) NOT NULL DEFAULT '0',
  `max_venders` int(11) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plans`
--

INSERT INTO `plans` (`id`, `name`, `price`, `duration`, `max_users`, `max_customers`, `max_venders`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Free Plan', 0.00, 'unlimited', 2, 10, 2, '', 'free_plan.png', '2022-08-09 20:59:10', '2022-08-13 23:44:29'),
(2, 'Basic', 5.00, 'month', 50, 50, 50, '', NULL, '2022-08-13 21:21:15', '2022-08-13 21:21:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_services`
--

CREATE TABLE `product_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_price` double(20,2) NOT NULL DEFAULT '0.00',
  `purchase_price` double(20,2) NOT NULL DEFAULT '0.00',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `tax_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `unit_id` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `product_services`
--

INSERT INTO `product_services` (`id`, `name`, `sku`, `sale_price`, `purchase_price`, `quantity`, `tax_id`, `category_id`, `unit_id`, `type`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Servicio 1', '123', 123.00, 132.00, 0, '', 1, 1, 'service', '', 2, '2022-08-12 21:07:53', '2022-08-12 21:07:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_service_categories`
--

CREATE TABLE `product_service_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#fc544b',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `product_service_categories`
--

INSERT INTO `product_service_categories` (`id`, `name`, `type`, `color`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Categoria 1', '0', 'FFFFFF', 2, '2022-08-12 21:06:41', '2022-08-12 21:06:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_service_units`
--

CREATE TABLE `product_service_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `product_service_units`
--

INSERT INTO `product_service_units` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Unidad 1', 2, '2022-08-12 21:07:35', '2022-08-12 21:07:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `calculate_progress_through_tasks` int(11) DEFAULT NULL,
  `billing_type` varchar(256) DEFAULT NULL,
  `status` varchar(256) DEFAULT NULL,
  `total_cost` varchar(256) DEFAULT NULL,
  `estimated_hours` varchar(256) DEFAULT NULL,
  `project_members` text,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `labels` text,
  `description` text,
  `send_project_creation_email` int(11) DEFAULT NULL,
  `project_settings` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`id`, `customer_id`, `name`, `calculate_progress_through_tasks`, `billing_type`, `status`, `total_cost`, `estimated_hours`, `project_members`, `date_start`, `date_end`, `labels`, `description`, `send_project_creation_email`, `project_settings`) VALUES
(2, 1, 'Smart', NULL, 'Fixed price', 'Not started', '1000', '50', '[\"3\"]', '2022-08-10', '2022-09-10', NULL, 'Esto es un proyecto de prueba', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proposals`
--

CREATE TABLE `proposals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proposal_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `issue_date` date NOT NULL,
  `send_date` date DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `discount_apply` int(11) NOT NULL DEFAULT '0',
  `converted_invoice_id` int(11) NOT NULL DEFAULT '0',
  `is_convert` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proposals`
--

INSERT INTO `proposals` (`id`, `proposal_id`, `customer_id`, `issue_date`, `send_date`, `category_id`, `status`, `discount_apply`, `converted_invoice_id`, `is_convert`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-08-12', NULL, 0, 0, 0, 0, 0, 2, '2022-08-12 21:15:07', '2022-08-12 21:15:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proposal_products`
--

CREATE TABLE `proposal_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `tax` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0.00',
  `discount` double(8,2) NOT NULL DEFAULT '0.00',
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proposal_products`
--

INSERT INTO `proposal_products` (`id`, `proposal_id`, `product_id`, `quantity`, `tax`, `discount`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '', 0.00, 123.00, '', '2022-08-12 21:15:07', '2022-08-12 21:15:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revenues`
--

CREATE TABLE `revenues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `account_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'web', 0, '2022-08-09 20:59:25', '2022-08-09 20:59:25'),
(2, 'customer', 'web', 0, '2022-08-09 20:59:30', '2022-08-09 20:59:30'),
(3, 'vender', 'web', 0, '2022-08-09 20:59:32', '2022-08-09 20:59:32'),
(4, 'company', 'web', 1, '2022-08-09 20:59:34', '2022-08-09 20:59:34'),
(5, 'accountant', 'web', 2, '2022-08-09 21:00:28', '2022-08-09 21:00:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(18, 1),
(33, 1),
(34, 1),
(35, 1),
(93, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(27, 2),
(56, 2),
(101, 2),
(102, 2),
(103, 2),
(127, 2),
(130, 2),
(61, 3),
(83, 3),
(104, 3),
(105, 3),
(106, 3),
(107, 3),
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 4),
(17, 4),
(19, 4),
(20, 4),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(25, 4),
(26, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 4),
(32, 4),
(33, 4),
(36, 4),
(37, 4),
(38, 4),
(39, 4),
(40, 4),
(41, 4),
(42, 4),
(43, 4),
(44, 4),
(45, 4),
(46, 4),
(47, 4),
(48, 4),
(49, 4),
(50, 4),
(51, 4),
(52, 4),
(53, 4),
(54, 4),
(55, 4),
(56, 4),
(57, 4),
(58, 4),
(59, 4),
(60, 4),
(61, 4),
(62, 4),
(63, 4),
(64, 4),
(65, 4),
(66, 4),
(67, 4),
(68, 4),
(69, 4),
(74, 4),
(75, 4),
(76, 4),
(77, 4),
(78, 4),
(79, 4),
(80, 4),
(81, 4),
(82, 4),
(83, 4),
(84, 4),
(85, 4),
(86, 4),
(87, 4),
(88, 4),
(89, 4),
(90, 4),
(91, 4),
(92, 4),
(93, 4),
(94, 4),
(95, 4),
(96, 4),
(97, 4),
(98, 4),
(99, 4),
(100, 4),
(108, 4),
(109, 4),
(110, 4),
(111, 4),
(112, 4),
(113, 4),
(114, 4),
(115, 4),
(116, 4),
(117, 4),
(122, 4),
(123, 4),
(124, 4),
(125, 4),
(126, 4),
(127, 4),
(128, 4),
(129, 4),
(131, 4),
(132, 4),
(133, 4),
(134, 4),
(135, 4),
(136, 4),
(137, 4),
(138, 4),
(139, 4),
(140, 4),
(141, 4),
(142, 4),
(143, 4),
(144, 4),
(145, 4),
(146, 4),
(147, 4),
(148, 4),
(149, 4),
(150, 4),
(151, 4),
(152, 4),
(153, 4),
(154, 4),
(155, 4),
(1, 5),
(19, 5),
(20, 5),
(21, 5),
(22, 5),
(23, 5),
(24, 5),
(25, 5),
(26, 5),
(27, 5),
(28, 5),
(29, 5),
(30, 5),
(31, 5),
(32, 5),
(36, 5),
(37, 5),
(38, 5),
(39, 5),
(40, 5),
(41, 5),
(42, 5),
(43, 5),
(44, 5),
(45, 5),
(46, 5),
(47, 5),
(48, 5),
(49, 5),
(50, 5),
(51, 5),
(52, 5),
(53, 5),
(54, 5),
(55, 5),
(56, 5),
(57, 5),
(58, 5),
(59, 5),
(60, 5),
(61, 5),
(62, 5),
(63, 5),
(64, 5),
(65, 5),
(66, 5),
(67, 5),
(68, 5),
(69, 5),
(74, 5),
(75, 5),
(76, 5),
(77, 5),
(78, 5),
(79, 5),
(80, 5),
(81, 5),
(82, 5),
(83, 5),
(84, 5),
(85, 5),
(86, 5),
(87, 5),
(88, 5),
(90, 5),
(91, 5),
(92, 5),
(94, 5),
(95, 5),
(96, 5),
(97, 5),
(98, 5),
(99, 5),
(100, 5),
(108, 5),
(109, 5),
(110, 5),
(111, 5),
(112, 5),
(113, 5),
(114, 5),
(115, 5),
(122, 5),
(123, 5),
(124, 5),
(125, 5),
(126, 5),
(127, 5),
(128, 5),
(129, 5),
(131, 5),
(132, 5),
(133, 5),
(134, 5),
(135, 5),
(136, 5),
(137, 5),
(138, 5),
(139, 5),
(140, 5),
(141, 5),
(142, 5),
(143, 5),
(144, 5),
(145, 5),
(146, 5),
(147, 5),
(148, 5),
(149, 5),
(150, 5),
(151, 5),
(152, 5),
(153, 5),
(154, 5),
(155, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `schedules`
--

INSERT INTO `schedules` (`id`, `name`, `description`) VALUES
(1, 'Agenda 1 prueba', 'Descripción de agenda 1 prueba'),
(2, 'Agenda 2', 'Cree esta agenda para probar el funcionamiento del cambio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `schedule_items`
--

CREATE TABLE `schedule_items` (
  `id` int(11) NOT NULL,
  `timestamp` varchar(256) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_start` varchar(256) DEFAULT NULL,
  `date_end` varchar(256) DEFAULT NULL,
  `status` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `schedule_items`
--

INSERT INTO `schedule_items` (`id`, `timestamp`, `schedule_id`, `customer_id`, `service_id`, `user_id`, `date_start`, `date_end`, `status`) VALUES
(55, '1660774053', 1, 1, 1, 1, '2022-08-15 08:00:00', '2022-08-15 08:00:00', 'in progress'),
(56, '1660774053', 1, 1, 1, 1, '2022-08-15 08:15:00', '2022-08-15 08:15:00', 'in progress');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'display_landing_page', 'on', 1, NULL, NULL),
(2, 'title_text', '', 1, NULL, NULL),
(3, 'default_language', 'es', 1, NULL, NULL),
(28, 'company_logo', '4_logo.png', 4, NULL, NULL),
(29, 'company_favicon', '4_favicon.png', 4, NULL, NULL),
(31, 'title_text', 'TuPromotor', 4, NULL, NULL),
(32, 'company_name', 'TuPromotor SRL', 4, NULL, NULL),
(33, 'company_address', '6to Anillo Banzer', 4, NULL, NULL),
(34, 'company_city', 'Santa Cruz de la Sierra', 4, NULL, NULL),
(35, 'company_state', 'Santa Cruz', 4, NULL, NULL),
(36, 'company_zipcode', '', 4, NULL, NULL),
(37, 'company_country', 'Bolivia', 4, NULL, NULL),
(38, 'company_telephone', '+591 70098239', 4, NULL, NULL),
(39, 'company_email', 'info@tupromotor.net', 4, NULL, NULL),
(40, 'company_email_from_name', 'Finanzas', 4, NULL, NULL),
(41, 'registration_number', '', 4, NULL, NULL),
(42, 'vat_number', '', 4, NULL, NULL),
(60, 'site_currency', 'BOB', 4, '2022-08-13 23:26:31', '2022-08-13 23:26:31'),
(61, 'site_currency_symbol', 'Bs.', 4, '2022-08-13 23:26:31', '2022-08-13 23:26:31'),
(62, 'site_currency_symbol_position', 'pre', 4, '2022-08-13 23:26:31', '2022-08-13 23:26:31'),
(63, 'site_date_format', 'M j, Y', 4, '2022-08-13 23:26:31', '2022-08-13 23:26:31'),
(64, 'site_time_format', 'g:i A', 4, '2022-08-13 23:26:31', '2022-08-13 23:26:31'),
(65, 'invoice_prefix', '#INVO', 4, '2022-08-13 23:26:31', '2022-08-13 23:26:31'),
(66, 'proposal_prefix', '#PROP', 4, '2022-08-13 23:26:31', '2022-08-13 23:26:31'),
(67, 'bill_prefix', '#Nota de Venta', 4, '2022-08-13 23:26:31', '2022-08-13 23:26:31'),
(68, 'customer_prefix', '#Cliente', 4, '2022-08-13 23:26:31', '2022-08-13 23:26:31'),
(69, 'vender_prefix', '#VENDEDOR', 4, '2022-08-13 23:26:31', '2022-08-13 23:26:31'),
(70, 'footer_title', '', 4, '2022-08-13 23:26:31', '2022-08-13 23:26:31'),
(71, 'decimal_number', '2', 4, '2022-08-13 23:26:31', '2022-08-13 23:26:31'),
(72, 'journal_prefix', '#JUR', 4, '2022-08-13 23:26:31', '2022-08-13 23:26:31'),
(73, 'shipping_display', 'on', 4, '2022-08-13 23:26:31', '2022-08-13 23:26:31'),
(74, 'footer_notes', '', 4, '2022-08-13 23:26:31', '2022-08-13 23:26:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `theme` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_per_hours` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `priority` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assign_to` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `theme`, `price_per_hours`, `date_start`, `date_end`, `priority`, `assign_to`, `description`, `status`, `cost`) VALUES
(1, 2, 'Tarea de prueba', '123', '2022-08-11 00:00:00', NULL, 'Urgent', '[\"2\",\"3\"]', '123123123', 'On trial', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `taxes`
--

INSERT INTO `taxes` (`id`, `name`, `rate`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'IVA', '16', 2, '2022-08-09 23:50:57', '2022-08-09 23:50:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `payment_id` int(11) NOT NULL DEFAULT '0',
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_account` int(11) NOT NULL DEFAULT '0',
  `to_account` int(11) NOT NULL DEFAULT '0',
  `amount` double(15,2) NOT NULL DEFAULT '0.00',
  `date` date NOT NULL,
  `payment_method` int(11) NOT NULL DEFAULT '0',
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `plan` int(11) DEFAULT NULL,
  `plan_expire_date` date DEFAULT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '1',
  `is_active` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `avatar`, `lang`, `created_by`, `plan`, `plan_expire_date`, `delete_status`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@example.com', NULL, '$2y$10$LkiJbkndcWMN6LcCgSHOs.LPQEGz.sq8XeJXq563foBEGkQVm1bLi', 'super admin', '', 'es', 0, NULL, NULL, 1, 1, NULL, '2022-08-09 20:59:30', '2022-08-13 20:25:24'),
(2, 'company', 'company@example.com', NULL, '$2y$10$P6dhYMx2.V/L30wFlOiO2O4C5OIGV2oGsW0rmJSdLPzlAOvQNVpGm', 'company', '', 'es', 1, 1, NULL, 1, 1, NULL, '2022-08-09 21:00:28', '2022-08-10 22:19:00'),
(3, 'Nisa Delgado', 'accountant@example.com', NULL, '$2y$10$bqw77lysLh7y/SMBn/lfzOXRQZ7/qOWgCE0Ev0lAdmFMPM5hdES7e', 'accountant', '', 'es', 2, NULL, NULL, 1, 1, NULL, '2022-08-09 21:01:43', '2022-08-09 21:04:09'),
(4, 'Tu Promotor', 'info@tupromotor.net', NULL, '$2y$10$DVaT7fEzgpxr8MsF6fwvoOa41ZUUfh/oiMSdSGPyHXi4B/1YdY3ti', 'company', NULL, 'es', 1, 2, '2022-09-13', 1, 1, NULL, '2022-08-11 20:18:09', '2022-08-13 23:44:53'),
(5, 'Ayran iezzy da Silva lima', 'ayraniezzy@gmail.com', NULL, '$2y$10$CB5mtOPKXDBQ/Xo438qFLuSuujUN1/UWly4D5y6V80f28DiWkRNDG', 'company', NULL, 'es', 1, 1, NULL, 1, 1, NULL, '2022-08-18 01:05:16', '2022-08-18 01:05:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_coupons`
--

CREATE TABLE `user_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(11) NOT NULL,
  `coupon` int(11) NOT NULL,
  `order` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venders`
--

CREATE TABLE `venders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vender_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `is_active` int(11) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `billing_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_zip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `balance` double(8,2) NOT NULL DEFAULT '0.00',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin_payment_settings`
--
ALTER TABLE `admin_payment_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_payment_settings_name_created_by_unique` (`name`,`created_by`);

--
-- Indices de la tabla `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bill_payments`
--
ALTER TABLE `bill_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bill_products`
--
ALTER TABLE `bill_products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chart_of_account_sub_types`
--
ALTER TABLE `chart_of_account_sub_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chart_of_account_types`
--
ALTER TABLE `chart_of_account_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `company_payment_settings`
--
ALTER TABLE `company_payment_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_payment_settings_name_created_by_unique` (`name`,`created_by`);

--
-- Indices de la tabla `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `credit_notes`
--
ALTER TABLE `credit_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indices de la tabla `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `custom_field_values`
--
ALTER TABLE `custom_field_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `custom_field_values_record_id_field_id_unique` (`record_id`,`field_id`),
  ADD KEY `custom_field_values_field_id_foreign` (`field_id`);

--
-- Indices de la tabla `debit_notes`
--
ALTER TABLE `debit_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `file_project_comments`
--
ALTER TABLE `file_project_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `invoice_payments`
--
ALTER TABLE `invoice_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `invoice_products`
--
ALTER TABLE `invoice_products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `journal_items`
--
ALTER TABLE `journal_items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `landing_page_sections`
--
ALTER TABLE `landing_page_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_id_unique` (`order_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plans_name_unique` (`name`);

--
-- Indices de la tabla `product_services`
--
ALTER TABLE `product_services`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product_service_categories`
--
ALTER TABLE `product_service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product_service_units`
--
ALTER TABLE `product_service_units`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proposal_products`
--
ALTER TABLE `proposal_products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `revenues`
--
ALTER TABLE `revenues`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `schedule_items`
--
ALTER TABLE `schedule_items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_name_created_by_unique` (`name`,`created_by`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `user_coupons`
--
ALTER TABLE `user_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venders`
--
ALTER TABLE `venders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `venders_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin_payment_settings`
--
ALTER TABLE `admin_payment_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bill_payments`
--
ALTER TABLE `bill_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bill_products`
--
ALTER TABLE `bill_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `chart_of_account_sub_types`
--
ALTER TABLE `chart_of_account_sub_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `chart_of_account_types`
--
ALTER TABLE `chart_of_account_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `company_payment_settings`
--
ALTER TABLE `company_payment_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `credit_notes`
--
ALTER TABLE `credit_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `custom_field_values`
--
ALTER TABLE `custom_field_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `debit_notes`
--
ALTER TABLE `debit_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `file_project_comments`
--
ALTER TABLE `file_project_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `goals`
--
ALTER TABLE `goals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `invoice_payments`
--
ALTER TABLE `invoice_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `invoice_products`
--
ALTER TABLE `invoice_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `journal_entries`
--
ALTER TABLE `journal_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `journal_items`
--
ALTER TABLE `journal_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `landing_page_sections`
--
ALTER TABLE `landing_page_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT de la tabla `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `product_services`
--
ALTER TABLE `product_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `product_service_categories`
--
ALTER TABLE `product_service_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `product_service_units`
--
ALTER TABLE `product_service_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `proposal_products`
--
ALTER TABLE `proposal_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `revenues`
--
ALTER TABLE `revenues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `schedule_items`
--
ALTER TABLE `schedule_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `user_coupons`
--
ALTER TABLE `user_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venders`
--
ALTER TABLE `venders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `custom_field_values`
--
ALTER TABLE `custom_field_values`
  ADD CONSTRAINT `custom_field_values_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `custom_fields` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;
