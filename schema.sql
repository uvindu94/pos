-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2026 at 06:33 AM
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
-- Database: `pos_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`) VALUES
(1, 'Electronics', NULL, '2026-02-18 05:16:35'),
(2, 'Smartphones', 1, '2026-02-18 05:16:35'),
(3, 'Laptops', 1, '2026-02-18 05:16:35'),
(4, 'Wearables', 1, '2026-02-18 05:16:35'),
(5, 'Audio', 1, '2026-02-18 05:16:35'),
(6, 'Beverages', NULL, '2026-02-18 05:16:35'),
(7, 'Soft Drinks', 6, '2026-02-18 05:16:35'),
(8, 'Coffee & Tea', 6, '2026-02-18 05:16:35'),
(9, 'Juices', 6, '2026-02-18 05:16:35'),
(10, 'Energy Drinks', 6, '2026-02-18 05:16:35'),
(11, 'Snacks', NULL, '2026-02-18 05:16:35'),
(12, 'Chips', 11, '2026-02-18 05:16:35'),
(13, 'Cookies', 11, '2026-02-18 05:16:35'),
(14, 'Chocolate', 11, '2026-02-18 05:16:35'),
(15, 'Healthy Snacks', 11, '2026-02-18 05:16:35'),
(16, 'Home & Living', NULL, '2026-02-18 05:16:35'),
(17, 'Kitchenware', 16, '2026-02-18 05:16:35'),
(18, 'Furniture', 16, '2026-02-18 05:16:35'),
(19, 'Decor', 16, '2026-02-18 05:16:35'),
(20, 'Bedding', 16, '2026-02-18 05:16:35'),
(21, 'Clothing', NULL, '2026-02-18 05:16:35'),
(22, 'Menswear', 21, '2026-02-18 05:16:35'),
(23, 'Womenswear', 21, '2026-02-18 05:16:35'),
(24, 'Footwear', 21, '2026-02-18 05:16:35'),
(25, 'Accessories', 21, '2026-02-18 05:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `points` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `barcode`, `name`, `description`, `price`, `sale_price`, `stock`, `category_id`, `image`, `created_at`) VALUES
(1, 'APPLE15P', 'iPhone 15 Pro', NULL, 999.00, NULL, 15, 2, NULL, '2026-02-18 05:16:35'),
(2, 'SAMG24U', 'Samsung S24 Ultra', NULL, 1199.00, NULL, 12, 2, NULL, '2026-02-18 05:16:35'),
(3, 'PIX8P', 'Pixel 8 Pro', NULL, 899.00, NULL, 20, 2, NULL, '2026-02-18 05:16:35'),
(4, 'MBAM3', 'MacBook Air M3', NULL, 1199.00, NULL, 10, 3, NULL, '2026-02-18 05:16:35'),
(5, 'DELLX13', 'Dell XPS 13', NULL, 999.00, NULL, 8, 3, NULL, '2026-02-18 05:16:35'),
(6, 'ROGZEP', 'ASUS ROG Zephyrus', NULL, 1499.00, NULL, 5, 3, NULL, '2026-02-18 05:16:35'),
(7, 'AW9', 'Apple Watch Series 9', NULL, 399.00, NULL, 25, 4, NULL, '2026-02-18 05:16:35'),
(8, 'GW6', 'Galaxy Watch 6', NULL, 299.00, NULL, 29, 4, NULL, '2026-02-18 05:16:35'),
(9, 'APRO2', 'AirPods Pro 2', NULL, 249.00, NULL, 40, 5, NULL, '2026-02-18 05:16:35'),
(10, 'SONYX5', 'Sony WH-1000XM5', NULL, 349.00, NULL, 15, 5, NULL, '2026-02-18 05:16:35'),
(11, 'COKE500', 'Coca Cola 500ml', NULL, 1.50, NULL, 100, 7, NULL, '2026-02-18 05:16:35'),
(12, 'PEPSI500', 'Pepsi 500ml', NULL, 1.40, NULL, 119, 7, NULL, '2026-02-18 05:16:35'),
(13, 'SPRITE500', 'Sprite 500ml', NULL, 1.45, NULL, 90, 7, NULL, '2026-02-18 05:16:35'),
(14, 'FANTAO', 'Fanta Orange', NULL, 1.45, NULL, 80, 7, NULL, '2026-02-18 05:16:35'),
(15, 'SBLATTE', 'Starbucks Latte', NULL, 4.50, NULL, 50, 8, NULL, '2026-02-18 05:16:35'),
(16, 'LIPTI', 'Lipton Iced Tea', NULL, 2.20, NULL, 200, 8, NULL, '2026-02-18 05:16:35'),
(17, 'NESPOD', 'Nespresso Pods (10x)', NULL, 8.99, NULL, 60, 8, NULL, '2026-02-18 05:16:35'),
(18, 'OJ1L', 'Orange Juice 1L', NULL, 3.50, NULL, 45, 9, NULL, '2026-02-18 05:16:35'),
(19, 'AJ1L', 'Apple Juice 1L', NULL, 3.20, NULL, 40, 9, NULL, '2026-02-18 05:16:35'),
(20, 'RB250', 'Red Bull 250ml', NULL, 2.50, NULL, 150, 10, NULL, '2026-02-18 05:16:35'),
(21, 'MONST', 'Monster Energy', NULL, 2.80, NULL, 130, 10, NULL, '2026-02-18 05:16:35'),
(22, 'LAYSCL', 'Lays Classic', NULL, 1.99, NULL, 200, 12, NULL, '2026-02-18 05:16:35'),
(23, 'DORNC', 'Doritos Nacho Cheese', NULL, 2.49, NULL, 180, 12, NULL, '2026-02-18 05:16:35'),
(24, 'PRING', 'Pringles Original', NULL, 2.99, NULL, 150, 12, NULL, '2026-02-18 05:16:35'),
(25, 'OREO', 'Oreo Original', NULL, 1.80, NULL, 300, 13, NULL, '2026-02-18 05:16:35'),
(26, 'CAHOY', 'Chips Ahoy!', NULL, 2.20, NULL, 250, 13, NULL, '2026-02-18 05:16:35'),
(27, 'HERSH', 'Hershey Milk Chocolate', NULL, 1.50, NULL, 400, 14, NULL, '2026-02-18 05:16:35'),
(28, 'KITKAT', 'KitKat 4 Finger', NULL, 1.20, NULL, 500, 14, NULL, '2026-02-18 05:16:35'),
(29, 'LINDT70', 'Lindt Excellence 70%', NULL, 4.99, NULL, 100, 14, NULL, '2026-02-18 05:16:35'),
(30, 'TEFALFP', 'Tefal Frying Pan', NULL, 29.99, NULL, 15, 17, NULL, '2026-02-18 05:16:35'),
(31, 'NINJAAF', 'Ninja Air Fryer', NULL, 129.00, NULL, 10, 17, NULL, '2026-02-18 05:16:35'),
(32, 'KNSET', 'Knife Set (5pcs)', NULL, 49.99, NULL, 12, 17, NULL, '2026-02-18 05:16:35'),
(33, 'GCHAIR', 'Gaming Chair', NULL, 199.00, NULL, 5, 18, NULL, '2026-02-18 05:16:35'),
(34, 'DLAMP', 'Desk Lamp LED', NULL, 24.50, NULL, 20, 18, NULL, '2026-02-18 05:16:35'),
(35, 'CANDLE', 'Scented Candle Large', NULL, 15.99, NULL, 35, 19, NULL, '2026-02-18 05:16:35'),
(36, 'WCLOCK', 'Wall Clock Minimal', NULL, 19.99, NULL, 15, 19, NULL, '2026-02-18 05:16:35'),
(37, 'BEDK', 'Cotton Bed Sheets King', NULL, 45.00, NULL, 20, 20, NULL, '2026-02-18 05:16:35'),
(38, 'PILLOW', 'Memory Foam Pillow', NULL, 35.00, NULL, 25, 20, NULL, '2026-02-18 05:16:35'),
(39, 'TSHIRT-M', 'Cotton T-Shirt Black', NULL, 15.00, NULL, 100, 22, NULL, '2026-02-18 05:16:35'),
(40, 'LEVI501', 'Levi 501 Jeans', NULL, 59.99, NULL, 40, 22, NULL, '2026-02-18 05:16:35'),
(41, 'DRESS-S', 'Floral Summer Dress', NULL, 39.00, NULL, 30, 23, NULL, '2026-02-18 05:16:35'),
(42, 'YOGA-L', 'Yoga Leggings High-Waist', NULL, 25.00, NULL, 60, 23, NULL, '2026-02-18 05:16:35'),
(43, 'NIKE270', 'Nike Air Max 270', NULL, 150.00, NULL, 25, 24, NULL, '2026-02-18 05:16:35'),
(44, 'STANSM', 'Adidas Stan Smith', NULL, 90.00, NULL, 35, 24, NULL, '2026-02-18 05:16:35'),
(45, 'LBOOTS', 'Leather Boots Brown', NULL, 120.00, NULL, 15, 24, NULL, '2026-02-18 05:16:35'),
(46, 'RAYBAN', 'Ray-Ban Wayfarer', NULL, 160.00, NULL, 10, 25, NULL, '2026-02-18 05:16:35'),
(47, 'WALLETL', 'Leather Wallet Black', NULL, 45.00, NULL, 50, 25, NULL, '2026-02-18 05:16:35'),
(48, 'SUNHAT', 'Sun Hat Straw', NULL, 12.00, NULL, 20, 25, NULL, '2026-02-18 05:16:35'),
(49, 'SNICK', 'Snickers Bar 50g', NULL, 1.00, NULL, 600, 14, NULL, '2026-02-18 05:16:35'),
(50, 'GRANOL', 'Granola Bars (Pack of 6)', NULL, 5.50, NULL, 80, 15, NULL, '2026-02-18 05:16:35'),
(51, 'MNUTS', 'Mixed Nuts 200g', NULL, 4.20, NULL, 120, 15, NULL, '2026-02-18 05:16:35'),
(52, 'CHEET', 'Cheetos Puffs', NULL, 2.20, NULL, 160, 12, NULL, '2026-02-18 05:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `invoice_id` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) DEFAULT 0.00,
  `discount` decimal(10,2) DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `payment_method` enum('cash','card','mobile') DEFAULT 'cash',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `invoice_id`, `user_id`, `customer_id`, `subtotal`, `tax`, `discount`, `total`, `payment_method`, `created_at`) VALUES
(1, 'INV-83D6576D', 2, NULL, 1223.00, 220.14, 0.00, 1443.14, 'card', '2026-01-30 08:26:22'),
(2, 'INV-AC2342E3', 2, NULL, 3.00, 0.54, 6.00, -2.46, 'card', '2026-02-08 18:48:58'),
(3, 'INV-AF1D24AA', 3, NULL, 3602.50, 648.45, 0.00, 4250.95, 'card', '2026-02-18 02:18:10'),
(4, 'INV-CCCD9FE5', 3, NULL, 152.90, 27.52, 0.00, 180.42, '', '2026-02-02 03:53:32'),
(5, 'INV-7E09F821', 2, NULL, 39.98, 7.20, 18.00, 29.18, 'card', '2026-02-06 15:35:17'),
(6, 'INV-7E393334', 3, NULL, 145.88, 26.26, 0.00, 172.14, 'cash', '2026-01-21 03:56:40'),
(7, 'INV-A1C3CFE9', 2, NULL, 1523.35, 274.20, 0.00, 1797.55, '', '2026-02-02 05:13:13'),
(8, 'INV-EB864E1B', 3, NULL, 3992.60, 718.67, 0.00, 4711.27, 'cash', '2026-02-12 16:19:58'),
(9, 'INV-61462EBD', 3, NULL, 479.10, 86.24, 0.00, 565.34, '', '2026-01-28 17:06:16'),
(10, 'INV-5EEACC1B', 2, NULL, 2000.99, 360.18, 0.00, 2361.17, 'card', '2026-01-27 04:44:47'),
(11, 'INV-E27C283B', 2, NULL, 2631.00, 473.58, 0.00, 3104.58, '', '2026-02-09 02:23:01'),
(12, 'INV-6EDB68CE', 3, NULL, 1499.00, 269.82, 0.00, 1768.82, 'cash', '2026-01-27 07:53:40'),
(13, 'INV-3FE1B4C7', 3, NULL, 5.40, 0.97, 0.00, 6.37, 'card', '2026-02-07 08:21:39'),
(14, 'INV-F61C0604', 3, NULL, 4200.20, 756.04, 0.00, 4956.24, '', '2026-01-26 11:07:35'),
(15, 'INV-60E4DED7', 2, NULL, 883.71, 159.07, 0.00, 1042.78, '', '2026-02-03 08:03:56'),
(16, 'INV-B121222D', 2, NULL, 297.14, 53.49, 15.00, 335.63, 'card', '2026-01-19 22:36:36'),
(17, 'INV-44BD4CD3', 3, NULL, 398.00, 71.64, 0.00, 469.64, 'card', '2026-02-06 12:01:43'),
(18, 'INV-9C106C2B', 2, NULL, 151.47, 27.26, 0.00, 178.73, 'card', '2026-01-19 09:08:39'),
(19, 'INV-8FC5B13A', 3, NULL, 30.97, 5.57, 0.00, 36.54, 'cash', '2026-02-04 11:16:24'),
(20, 'INV-1131BF44', 3, NULL, 7.20, 1.30, 0.00, 8.50, '', '2026-01-29 22:00:24'),
(21, 'INV-B05161BE', 3, NULL, 953.00, 171.54, 5.00, 1119.54, 'card', '2026-01-24 06:23:56'),
(22, 'INV-0628BCFF', 2, NULL, 2153.19, 387.57, 0.00, 2540.76, '', '2026-02-11 05:55:14'),
(23, 'INV-E0F6D681', 2, NULL, 49.99, 9.00, 0.00, 58.99, 'card', '2026-01-31 02:18:16'),
(24, 'INV-D3B08075', 3, NULL, 872.80, 157.10, 0.00, 1029.90, 'card', '2026-02-09 15:53:04'),
(25, 'INV-33937732', 2, NULL, 486.48, 87.57, 0.00, 574.05, '', '2026-01-30 23:01:09'),
(26, 'INV-1771392065', 2, NULL, 300.40, 54.07, 0.00, 354.47, 'cash', '2026-02-18 05:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `price`, `total`) VALUES
(1, 1, 2, 1, 1199.00, 1199.00),
(2, 1, 48, 2, 12.00, 24.00),
(3, 2, 11, 2, 1.50, 3.00),
(4, 3, 50, 1, 5.50, 5.50),
(5, 3, 2, 3, 1199.00, 3597.00),
(6, 4, 43, 1, 150.00, 150.00),
(7, 4, 14, 2, 1.45, 2.90),
(8, 5, 36, 2, 19.99, 39.98),
(9, 6, 34, 1, 24.50, 24.50),
(10, 6, 12, 1, 1.40, 1.40),
(11, 6, 40, 2, 59.99, 119.98),
(12, 7, 46, 2, 160.00, 320.00),
(13, 7, 4, 1, 1199.00, 1199.00),
(14, 7, 13, 3, 1.45, 4.35),
(15, 8, 37, 2, 45.00, 90.00),
(16, 8, 3, 1, 899.00, 899.00),
(17, 8, 16, 2, 2.20, 4.40),
(18, 8, 1, 3, 999.00, 2997.00),
(19, 8, 16, 1, 2.20, 2.20),
(20, 9, 34, 3, 24.50, 73.50),
(21, 9, 26, 3, 2.20, 6.60),
(22, 9, 7, 1, 399.00, 399.00),
(23, 10, 1, 2, 999.00, 1998.00),
(24, 10, 24, 1, 2.99, 2.99),
(25, 11, 5, 2, 999.00, 1998.00),
(26, 11, 12, 3, 1.40, 4.20),
(27, 11, 33, 3, 199.00, 597.00),
(28, 11, 25, 1, 1.80, 1.80),
(29, 11, 39, 2, 15.00, 30.00),
(30, 12, 6, 1, 1499.00, 1499.00),
(31, 13, 25, 3, 1.80, 5.40),
(32, 14, 33, 3, 199.00, 597.00),
(33, 14, 2, 3, 1199.00, 3597.00),
(34, 14, 28, 1, 1.20, 1.20),
(35, 14, 20, 2, 2.50, 5.00),
(36, 15, 7, 2, 399.00, 798.00),
(37, 15, 32, 1, 49.99, 49.99),
(38, 15, 14, 3, 1.45, 4.35),
(39, 15, 52, 2, 2.20, 4.40),
(40, 15, 17, 3, 8.99, 26.97),
(41, 16, 51, 1, 4.20, 4.20),
(42, 16, 41, 2, 39.00, 78.00),
(43, 16, 40, 2, 59.99, 119.98),
(44, 16, 29, 1, 4.99, 4.99),
(45, 16, 30, 3, 29.99, 89.97),
(46, 17, 33, 2, 199.00, 398.00),
(47, 18, 22, 3, 1.99, 5.97),
(48, 18, 27, 3, 1.50, 4.50),
(49, 18, 41, 3, 39.00, 117.00),
(50, 18, 48, 2, 12.00, 24.00),
(51, 19, 42, 1, 25.00, 25.00),
(52, 19, 22, 3, 1.99, 5.97),
(53, 20, 27, 2, 1.50, 3.00),
(54, 20, 51, 1, 4.20, 4.20),
(55, 21, 28, 1, 1.20, 1.20),
(56, 21, 33, 3, 199.00, 597.00),
(57, 21, 52, 1, 2.20, 2.20),
(58, 21, 25, 2, 1.80, 3.60),
(59, 21, 10, 1, 349.00, 349.00),
(60, 22, 3, 2, 899.00, 1798.00),
(61, 22, 8, 1, 299.00, 299.00),
(62, 22, 32, 1, 49.99, 49.99),
(63, 22, 49, 2, 1.00, 2.00),
(64, 22, 51, 1, 4.20, 4.20),
(65, 23, 39, 2, 15.00, 30.00),
(66, 23, 36, 1, 19.99, 19.99),
(67, 24, 44, 3, 90.00, 270.00),
(68, 24, 44, 3, 90.00, 270.00),
(69, 24, 12, 2, 1.40, 2.80),
(70, 24, 43, 1, 150.00, 150.00),
(71, 24, 44, 2, 90.00, 180.00),
(72, 25, 40, 2, 59.99, 119.98),
(73, 25, 46, 2, 160.00, 320.00),
(74, 25, 50, 3, 5.50, 16.50),
(75, 25, 39, 2, 15.00, 30.00),
(76, 26, 8, 1, 299.00, 299.00),
(77, 26, 12, 1, 1.40, 1.40);

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_time` timestamp NULL DEFAULT NULL,
  `start_cash` decimal(10,2) DEFAULT 0.00,
  `end_cash` decimal(10,2) DEFAULT NULL,
  `status` enum('open','closed') DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','cashier') DEFAULT 'cashier',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Admin User', 'admin@admin.com', 'admin', '$2y$10$rz0nD/POJB6yMJ9zIR1Ub.ZX0l.0IX5/kEVco1ohAJZI1HYwVmVkK', 'admin', '2026-02-17 11:44:53'),
(2, 'Uvindua Admin', 'uvindua@sltds.lk', 'uvindua', '$2y$10$rz0nD/POJB6yMJ9zIR1Ub.ZX0l.0IX5/kEVco1ohAJZI1HYwVmVkK', 'admin', '2026-02-17 11:47:14'),
(3, 'Sample Cashier', 'cashier@pos.com', 'cashier', '$2y$10$rz0nD/POJB6yMJ9zIR1Ub.ZX0l.0IX5/kEVco1ohAJZI1HYwVmVkK', 'cashier', '2026-02-17 11:47:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_id` (`invoice_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `sale_items_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `shifts`
--
ALTER TABLE `shifts`
  ADD CONSTRAINT `shifts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
