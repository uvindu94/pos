-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2026 at 05:36 AM
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
(1, 'Electronics', NULL, '2026-02-18 04:08:59'),
(2, 'Smartphones', 1, '2026-02-18 04:08:59'),
(3, 'Laptops', 1, '2026-02-18 04:08:59'),
(4, 'Wearables', 1, '2026-02-18 04:08:59'),
(5, 'Audio', 1, '2026-02-18 04:08:59'),
(6, 'Beverages', NULL, '2026-02-18 04:08:59'),
(7, 'Soft Drinks', 6, '2026-02-18 04:08:59'),
(8, 'Coffee & Tea', 6, '2026-02-18 04:08:59'),
(9, 'Juices', 6, '2026-02-18 04:08:59'),
(10, 'Energy Drinks', 6, '2026-02-18 04:08:59'),
(11, 'Snacks', NULL, '2026-02-18 04:08:59'),
(12, 'Chips', 11, '2026-02-18 04:08:59'),
(13, 'Cookies', 11, '2026-02-18 04:08:59'),
(14, 'Chocolate', 11, '2026-02-18 04:08:59'),
(15, 'Healthy Snacks', 11, '2026-02-18 04:08:59'),
(16, 'Home & Living', NULL, '2026-02-18 04:08:59'),
(17, 'Kitchenware', 16, '2026-02-18 04:08:59'),
(18, 'Furniture', 16, '2026-02-18 04:08:59'),
(19, 'Decor', 16, '2026-02-18 04:08:59'),
(20, 'Bedding', 16, '2026-02-18 04:08:59'),
(21, 'Clothing', NULL, '2026-02-18 04:08:59'),
(22, 'Menswear', 21, '2026-02-18 04:08:59'),
(23, 'Womenswear', 21, '2026-02-18 04:08:59'),
(24, 'Footwear', 21, '2026-02-18 04:08:59'),
(25, 'Accessories', 21, '2026-02-18 04:08:59');

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
  `stock` int(11) DEFAULT 0,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `barcode`, `name`, `description`, `price`, `stock`, `category_id`, `image`, `created_at`) VALUES
(1, 'APPLE15P', 'iPhone 15 Pro', NULL, 999.00, 15, 2, NULL, '2026-02-18 04:09:00'),
(2, 'SAMG24U', 'Samsung S24 Ultra', NULL, 1199.00, 12, 2, NULL, '2026-02-18 04:09:00'),
(3, 'PIX8P', 'Pixel 8 Pro', NULL, 899.00, 20, 2, NULL, '2026-02-18 04:09:00'),
(4, 'MBAM3', 'MacBook Air M3', NULL, 1199.00, 10, 3, NULL, '2026-02-18 04:09:00'),
(5, 'DELLX13', 'Dell XPS 13', NULL, 999.00, 8, 3, NULL, '2026-02-18 04:09:00'),
(6, 'ROGZEP', 'ASUS ROG Zephyrus', NULL, 1499.00, 5, 3, NULL, '2026-02-18 04:09:00'),
(7, 'AW9', 'Apple Watch Series 9', NULL, 399.00, 25, 4, NULL, '2026-02-18 04:09:00'),
(8, 'GW6', 'Galaxy Watch 6', NULL, 299.00, 30, 4, NULL, '2026-02-18 04:09:00'),
(9, 'APRO2', 'AirPods Pro 2', NULL, 249.00, 40, 5, NULL, '2026-02-18 04:09:00'),
(10, 'SONYX5', 'Sony WH-1000XM5', NULL, 349.00, 15, 5, NULL, '2026-02-18 04:09:00'),
(11, 'COKE500', 'Coca Cola 500ml', NULL, 1.50, 100, 7, NULL, '2026-02-18 04:09:00'),
(12, 'PEPSI500', 'Pepsi 500ml', NULL, 1.40, 120, 7, NULL, '2026-02-18 04:09:00'),
(13, 'SPRITE500', 'Sprite 500ml', NULL, 1.45, 90, 7, NULL, '2026-02-18 04:09:00'),
(14, 'FANTAO', 'Fanta Orange', NULL, 1.45, 80, 7, NULL, '2026-02-18 04:09:00'),
(15, 'SBLATTE', 'Starbucks Latte', NULL, 4.50, 50, 8, NULL, '2026-02-18 04:09:00'),
(16, 'LIPTI', 'Lipton Iced Tea', NULL, 2.20, 200, 8, NULL, '2026-02-18 04:09:00'),
(17, 'NESPOD', 'Nespresso Pods (10x)', NULL, 8.99, 60, 8, NULL, '2026-02-18 04:09:00'),
(18, 'OJ1L', 'Orange Juice 1L', NULL, 3.50, 45, 9, NULL, '2026-02-18 04:09:00'),
(19, 'AJ1L', 'Apple Juice 1L', NULL, 3.20, 40, 9, NULL, '2026-02-18 04:09:00'),
(20, 'RB250', 'Red Bull 250ml', NULL, 2.50, 150, 10, NULL, '2026-02-18 04:09:00'),
(21, 'MONST', 'Monster Energy', NULL, 2.80, 130, 10, NULL, '2026-02-18 04:09:00'),
(22, 'LAYSCL', 'Lays Classic', NULL, 1.99, 200, 12, NULL, '2026-02-18 04:09:00'),
(23, 'DORNC', 'Doritos Nacho Cheese', NULL, 2.49, 180, 12, NULL, '2026-02-18 04:09:00'),
(24, 'PRING', 'Pringles Original', NULL, 2.99, 150, 12, NULL, '2026-02-18 04:09:00'),
(25, 'OREO', 'Oreo Original', NULL, 1.80, 300, 13, NULL, '2026-02-18 04:09:00'),
(26, 'CAHOY', 'Chips Ahoy!', NULL, 2.20, 250, 13, NULL, '2026-02-18 04:09:00'),
(27, 'HERSH', 'Hershey Milk Chocolate', NULL, 1.50, 400, 14, NULL, '2026-02-18 04:09:00'),
(28, 'KITKAT', 'KitKat 4 Finger', NULL, 1.20, 500, 14, NULL, '2026-02-18 04:09:00'),
(29, 'LINDT70', 'Lindt Excellence 70%', NULL, 4.99, 100, 14, NULL, '2026-02-18 04:09:00'),
(30, 'TEFALFP', 'Tefal Frying Pan', NULL, 29.99, 15, 17, NULL, '2026-02-18 04:09:00'),
(31, 'NINJAAF', 'Ninja Air Fryer', NULL, 129.00, 10, 17, NULL, '2026-02-18 04:09:00'),
(32, 'KNSET', 'Knife Set (5pcs)', NULL, 49.99, 12, 17, NULL, '2026-02-18 04:09:00'),
(33, 'GCHAIR', 'Gaming Chair', NULL, 199.00, 5, 18, NULL, '2026-02-18 04:09:00'),
(34, 'DLAMP', 'Desk Lamp LED', NULL, 24.50, 20, 18, NULL, '2026-02-18 04:09:00'),
(35, 'CANDLE', 'Scented Candle Large', NULL, 15.99, 35, 19, NULL, '2026-02-18 04:09:00'),
(36, 'WCLOCK', 'Wall Clock Minimal', NULL, 19.99, 15, 19, NULL, '2026-02-18 04:09:00'),
(37, 'BEDK', 'Cotton Bed Sheets King', NULL, 45.00, 20, 20, NULL, '2026-02-18 04:09:00'),
(38, 'PILLOW', 'Memory Foam Pillow', NULL, 35.00, 25, 20, NULL, '2026-02-18 04:09:00'),
(39, 'TSHIRT-M', 'Cotton T-Shirt Black', NULL, 15.00, 100, 22, NULL, '2026-02-18 04:09:00'),
(40, 'LEVI501', 'Levi 501 Jeans', NULL, 59.99, 40, 22, NULL, '2026-02-18 04:09:00'),
(41, 'DRESS-S', 'Floral Summer Dress', NULL, 39.00, 30, 23, NULL, '2026-02-18 04:09:00'),
(42, 'YOGA-L', 'Yoga Leggings High-Waist', NULL, 25.00, 60, 23, NULL, '2026-02-18 04:09:00'),
(43, 'NIKE270', 'Nike Air Max 270', NULL, 150.00, 25, 24, NULL, '2026-02-18 04:09:00'),
(44, 'STANSM', 'Adidas Stan Smith', NULL, 90.00, 34, 24, NULL, '2026-02-18 04:09:01'),
(45, 'LBOOTS', 'Leather Boots Brown', NULL, 120.00, 14, 24, NULL, '2026-02-18 04:09:01'),
(46, 'RAYBAN', 'Ray-Ban Wayfarer', NULL, 160.00, 10, 25, NULL, '2026-02-18 04:09:01'),
(47, 'WALLETL', 'Leather Wallet Black', NULL, 45.00, 50, 25, NULL, '2026-02-18 04:09:01'),
(48, 'SUNHAT', 'Sun Hat Straw', NULL, 12.00, 20, 25, NULL, '2026-02-18 04:09:01'),
(49, 'SNICK', 'Snickers Bar 50g', NULL, 1.00, 600, 14, NULL, '2026-02-18 04:09:01'),
(50, 'GRANOL', 'Granola Bars (Pack of 6)', NULL, 5.50, 80, 15, NULL, '2026-02-18 04:09:01'),
(51, 'MNUTS', 'Mixed Nuts 200g', NULL, 4.20, 120, 15, NULL, '2026-02-18 04:09:01'),
(52, 'CHEET', 'Cheetos Puffs', NULL, 2.20, 160, 12, NULL, '2026-02-18 04:09:01');

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
(1, 'INV-1771387963', 3, NULL, 210.00, 21.00, 0.00, 231.00, 'cash', '2026-02-18 04:12:43');

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
(1, 1, 44, 1, 90.00, 90.00),
(2, 1, 45, 1, 120.00, 120.00);

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
(1, 'Admin User', 'admin@admin.com', 'admin', '$2y$10$UserPasswordHashPlaceholder', 'admin', '2026-02-17 11:44:53'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
