-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2026 at 09:02 PM
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
-- Database: `fa3`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `full_name`, `email`, `phone`, `created_at`) VALUES
(1, 'John Doe', 'johndoe@example.com', '09171111111', '2026-09-22 14:38:47'),
(2, 'Jane Smith', 'janesmith@example.com', '09182222222', '2026-09-22 14:38:47'),
(3, 'Juan Dela Cruz', 'juandelacruz@example.com', '09193333333', '2026-09-22 14:38:47'),
(4, 'Maria Clara', 'mariaclara@example.com', '09204444444', '2026-09-22 14:38:47'),
(5, 'Pedro Penduko', 'pedropenduko@example.com', '09215555555', '2026-09-22 14:38:47'),
(6, 'Glorp', 'glorpathon@email.com', '0999676767', '2026-10-06 05:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `created_at`, `avatar`) VALUES
(1, 'admin_01', 'Admin Manager', '2026-09-22 14:38:47', '1791262459_f32fd7af5aeb61f285b4.jpg'),
(2, 'cashier_a', 'Cashier One', '2026-09-22 14:38:47', '1791262467_b1ef19285d398849978d.jpg'),
(3, 'cashier_b', 'Cashier Two', '2026-09-22 14:38:47', '1791262478_73f984c578b6335129bd.jpg'),
(4, 'stock_mgr', 'Inventory Head', '2026-09-22 14:38:47', '1791262482_d5ff7bd31c3d4b39a6fd.jpg'),
(5, 'audit_1', 'Auditor Ops', '2026-09-22 14:38:47', '1791262495_244eedcf60633ea78b7a.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
