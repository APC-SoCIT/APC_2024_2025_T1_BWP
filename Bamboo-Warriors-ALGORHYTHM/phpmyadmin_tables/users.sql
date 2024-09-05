-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 23, 2024 at 09:20 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$hmUafuTVjfSevq8jvnvLFubZCNItvJgOmooaJKy4fWXi/WTGnTDLW', NULL, '2024-02-20 23:42:25', '2024-02-20 23:42:25'),
(4, 'mico', '$2y$12$h7JSOxKj90PA0vEjfDA7yu7F3Frh5saqOCtzsg.oR2cggFdtCXpWO', NULL, '2024-02-21 23:15:18', '2024-02-21 23:15:18'),
(5, 'carl', '$2y$12$ExQNiE3aMXM9pzLhCM5YfOOYiMEBgG.kwMnI.CYoHbWa2SrSMMDPC', NULL, '2024-02-21 23:15:50', '2024-02-21 23:15:50'),
(6, 'aaron', '$2y$12$m5QOFJJ8lhq.HuR.gANPd.a88.ZW.q9WTzXvAf.aNXeLmAeA1fAse', NULL, '2024-02-21 23:17:06', '2024-02-21 23:17:06'),
(7, 'matt', '$2y$12$yVxWiVoVjNzjQJg1pqZ.C.egtDIe.3sD3nSNetpmniL6XVh7sF69i', NULL, '2024-02-21 23:17:27', '2024-02-21 23:17:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
