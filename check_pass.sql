-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 15, 2020 at 04:49 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `check_pass`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` varchar(100) NOT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `email`, `contact`, `created_at`, `updated_at`, `img`) VALUES
(2, 'Admin', 'admin', 'YWRtaW4=', 'admin@gmail.com', '9876543211', '2020-07-15 13:25:50', '2020-07-15 19:02:51', 'A1594819971.png');

-- --------------------------------------------------------

--
-- Table structure for table `check_history`
--

CREATE TABLE `check_history` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `pass_id` varchar(200) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 - Checked Out 1 - Checked In',
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `check_history`
--

INSERT INTO `check_history` (`id`, `name`, `pass_id`, `status`, `time`) VALUES
(1, 'Tejas Sonawane', 'T5F0F11B10098A1594823088', 1, '2020-07-15 14:24:49'),
(2, 'Prabhakar Sonawane', 'P5F0F1239A17BE1594823225', 1, '2020-07-15 14:27:05'),
(3, 'Asha Sonawane', 'A5F0F12A7BA0F11594823335', 1, '2020-07-15 14:28:55'),
(4, 'Prabhakar Sonawane', 'P5F0F1239A17BE1594823225', 0, '2020-07-15 14:36:57'),
(5, 'Prabhakar Sonawane', 'P5F0F1239A17BE1594823225', 1, '2020-07-15 14:37:54'),
(6, 'Prabhakar Sonawane', 'P5F0F1239A17BE1594823225', 0, '2020-07-15 14:38:10'),
(7, 'Tejas Sonawane', 'T5F0F11B10098A1594823088', 0, '2020-07-15 14:39:06'),
(8, 'Asha Sonawane', 'A5F0F12A7BA0F11594823335', 0, '2020-07-15 14:40:20'),
(9, 'Tejas Sonawane', 'T5F0F11B10098A1594823088', 1, '2020-07-15 14:41:07');

-- --------------------------------------------------------

--
-- Table structure for table `current_check`
--

CREATE TABLE `current_check` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `pass_id` varchar(200) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 - Checked Out 1 - Checked In'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `current_check`
--

INSERT INTO `current_check` (`id`, `name`, `pass_id`, `status`) VALUES
(1, 'Tejas Sonawane', 'T5F0F11B10098A1594823088', 1),
(2, 'Prabhakar Sonawane', 'P5F0F1239A17BE1594823225', 0),
(3, 'Asha Sonawane', 'A5F0F12A7BA0F11594823335', 0);

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`id`, `name`, `username`, `password`) VALUES
(1, 'Tejas Prabhakar Sonawane', 'tejas', 'dGVqYXM=');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` varchar(100) NOT NULL,
  `img` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `pass_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `created_at`, `updated_at`, `img`, `contact`, `pass_id`) VALUES
(1, 'Tejas Sonawane', 'liktejas@gmail.com', '2020-07-15 14:24:49', '', 'T1594823088.png', '7798261821', 'T5F0F11B10098A1594823088'),
(2, 'Prabhakar Sonawane', 'prabhakar.sonawane06@gmail.com', '2020-07-15 14:27:05', '', 'P1594823225.png', '9422792770', 'P5F0F1239A17BE1594823225'),
(3, 'Asha Sonawane', 'asha.sonawane03@gmail.com', '2020-07-15 14:28:55', '', 'A1594823335.png', '7588001418', 'A5F0F12A7BA0F11594823335');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `check_history`
--
ALTER TABLE `check_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `current_check`
--
ALTER TABLE `current_check`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pass_id` (`pass_id`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pass_id` (`pass_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `check_history`
--
ALTER TABLE `check_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `current_check`
--
ALTER TABLE `current_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
