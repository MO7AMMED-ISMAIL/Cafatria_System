-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2024 at 11:48 AM
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
-- Database: `cafeteria`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `profile_picture`, `created_at`) VALUES
(1, 'admin1', 'admin1@gmail.com', '123456', 'user.png', '2024-03-15 10:33:49'),
(2, 'admin2', 'admin2@gmail.com', '123456', 'user.png', '2024-03-15 10:33:49');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_description`, `created_at`) VALUES
(1, 'Drinks', 'Various beverages', '2024-03-15 10:33:49'),
(2, 'Snacks', 'Quick bites', '2024-03-15 10:33:49'),
(3, 'Desserts', 'Sweet treats', '2024-03-15 10:33:49');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_id` int(10) UNSIGNED NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_id`, `notifiable_type`, `data`, `read_at`, `created_at`) VALUES
(1, 'OrderStatus', 1, 'orders', '{\"status\": \"Done\"}', '2024-03-08 10:00:00', '2024-03-15 10:33:49'),
(2, 'OrderStatus', 2, 'orders', '{\"status\": \"Processing\"}', NULL, '2024-03-15 10:33:49');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `total_price` float NOT NULL,
  `tax` float NOT NULL DEFAULT 0.1,
  `status` enum('Processing','Out For Delivery','Done','Cancelled') DEFAULT 'Processing',
  `notes` text DEFAULT NULL,
  `room_id` int(10) UNSIGNED DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `tax`, `status`, `notes`, `room_id`, `order_date`) VALUES
(1, 1, 30, 0.1, 'Done', 'Special instructions for the order', 1, '2024-03-08 10:00:00'),
(2, 1, 30, 0.1, 'Cancelled', 'Special instructions for the order', 2, '2024-03-07 10:00:00'),
(3, 2, 20, 0.1, 'Out For Delivery', 'Special instructions for the order', 2, '2024-03-11 10:00:00'),
(4, 2, 20, 0.1, 'Processing', 'Special instructions for the order', 2, '2024-03-04 10:00:00'),
(5, 3, 10, 0.1, 'Processing', 'Special instructions for the order', 2, '2024-03-12 10:00:00'),
(6, 3, 10, 0.1, 'Processing', NULL, 3, '2024-03-10 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_price` float NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_price` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_price`, `quantity`, `total_price`, `created_at`) VALUES
(1, 1, 1, 10, 2, 10, '2024-03-08 10:00:00'),
(2, 1, 2, 20, 1, 20, '2024-03-08 10:00:00'),
(3, 2, 5, 30, 1, 30, '2024-03-07 10:00:00'),
(4, 3, 2, 20, 1, 20, '2024-03-11 10:00:00'),
(5, 4, 3, 20, 1, 20, '2024-03-04 10:00:00'),
(6, 5, 4, 10, 1, 20, '2024-03-12 10:00:00'),
(7, 6, 1, 10, 1, 20, '2024-03-10 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` float NOT NULL,
  `picture` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `status` enum('Available','Not Available') DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `picture`, `category_id`, `status`, `created_at`) VALUES
(1, 'Cola', 'Refreshing soda', 10, 'default.png', 1, 'Available', '2024-03-15 10:33:49'),
(2, 'Chips', 'Crunchy potato chips', 20, 'default.png', 2, 'Available', '2024-03-15 10:33:49'),
(3, 'Coffee', 'Coffee cup', 20, 'default.png', 1, 'Available', '2024-03-15 10:33:49'),
(4, 'Watter', 'Watter Bottle', 10, 'default.png', 2, 'Available', '2024-03-15 10:33:49'),
(5, 'Chocolate Cake', 'Rich and moist cake', 30, 'default.png', 3, 'Available', '2024-03-15 10:33:49');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `ext` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `ext`) VALUES
(1, 'Room One', 'info room1'),
(2, 'Room Two', 'info room2'),
(3, 'Room Three', 'info room3'),
(4, 'Room Four', 'info room4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `room_id` int(10) UNSIGNED DEFAULT NULL,
  `extra_data` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `room_id`, `extra_data`, `profile_picture`, `created_at`) VALUES
(1, 'User one', 'user1@gmail.com', '123456', 1, 'Some extra data', 'user.png', '2024-03-15 10:33:49'),
(2, 'User Two', 'user2@gmail.com', '123456', 2, 'Additional info', 'user.png', '2024-03-15 10:33:49'),
(3, 'User Three', 'user3@gmail.com', '123456', 1, 'Additional info', 'user.png', '2024-03-15 10:33:49'),
(4, 'User Four', 'user4@gmail.com', '123456', 4, 'Additional info', 'user.png', '2024-03-15 10:33:49'),
(5, 'User Five', 'user5@gmail.com', '123456', 3, 'Additional info', 'user.png', '2024-03-15 10:33:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_admins_email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifiable_id` (`notifiable_id`,`notifiable_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `idx_users_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`notifiable_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
