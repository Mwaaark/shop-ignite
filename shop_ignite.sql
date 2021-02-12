-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2018 at 09:52 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bumatay_fa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Mark Robert', 'admin@gmail.com', 'admin123', '2018-10-03 04:50:42', '2018-10-03 04:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(2, 4, 1, '2018-10-01 04:12:01', '2018-10-03 04:32:34'),
(4, 3, 3, '2018-10-01 04:52:33', '2018-10-03 04:33:01'),
(7, 5, 4, '2018-10-01 04:53:50', '2018-10-03 04:33:04'),
(10, 4, 1, '2018-10-04 04:47:36', '2018-10-04 04:47:36'),
(11, 4, 6, '2018-10-04 04:47:36', '2018-10-04 04:47:36'),
(12, 4, 6, '2018-10-04 04:56:12', '2018-10-04 04:56:12'),
(13, 6, 6, '2018-10-04 05:00:17', '2018-10-04 05:00:17'),
(14, 6, 6, '2018-10-04 05:00:39', '2018-10-04 05:00:39'),
(15, 6, 6, '2018-10-04 05:01:02', '2018-10-04 05:01:02'),
(17, 8, 6, '2018-10-04 06:41:19', '2018-10-04 06:41:19');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Electric Guitar', '2018-10-01 02:22:20', '2018-10-03 04:21:53'),
(2, 'Bass Guitar', '2018-10-01 02:22:20', '2018-10-03 04:21:59'),
(3, 'Acoustic Guitar', '2018-10-01 02:22:20', '2018-10-03 04:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` double(10,2) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `quantity`, `image_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Guitar 1 edit2', 11999.00, 11, '2.png', '2018-10-02 02:46:23', '2018-10-03 13:42:27'),
(2, 1, 'Guitar 2', 13000.00, 6, '16.png', '2018-10-02 02:48:44', '2018-10-03 04:24:00'),
(3, 1, 'Guitar 3', 2200.00, 22, '8.png', '2018-10-02 02:49:59', '2018-10-03 04:24:07'),
(4, 1, 'Guitar 4 edited', 27000.00, 7, '6.png', '2018-10-02 02:50:49', '2018-10-04 03:58:24'),
(5, 1, 'Guitar 8', 18000.00, 22, '10.png', '2018-10-03 06:49:00', '2018-10-03 13:43:15'),
(6, 1, 'Guitar 10', 20000.00, 12, '13.png', '2018-10-03 06:54:02', '2018-10-03 13:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(3, 'mary', 'mary@gmail.com', 'mary123', '2018-10-01 04:11:23', '2018-10-01 04:11:23'),
(4, 'kram', 'kram@gmail.com', 'kram123', '2018-10-01 04:11:23', '2018-10-02 04:34:19'),
(5, 'aileen', 'aileen@gmail.com', 'aileen123', '2018-10-01 04:24:20', '2018-10-01 04:24:20'),
(6, 'mark', 'mark@gmail.com', 'mark123', '2018-10-02 05:48:12', '2018-10-02 05:48:12'),
(7, 'robert', 'robert@gmail.com', 'robert123', '2018-10-02 05:50:21', '2018-10-02 05:50:21'),
(8, 'marcus', 'marcus@gmail.com', 'marcus123', '2018-10-02 05:59:42', '2018-10-02 05:59:42'),
(9, 'trevor', 'trevor@gmail.com', 'trevor123', '2018-10-02 06:00:31', '2018-10-02 06:00:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `carts_ibfk_1` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
