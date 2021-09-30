-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2021 at 03:13 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_log`
--

CREATE TABLE `tb_log` (
  `id` int(5) NOT NULL,
  `id_user` int(8) NOT NULL,
  `time_log` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_log`
--

INSERT INTO `tb_log` (`id`, `id_user`, `time_log`) VALUES
(1, 14, '2021-09-29 22:09:18'),
(2, 14, '2021-09-29 23:55:07'),
(3, 14, '2021-09-30 00:19:07'),
(4, 17, '2021-09-30 00:24:44'),
(5, 14, '2021-09-30 08:07:32');

-- --------------------------------------------------------

--
-- Table structure for table `tb_masuk`
--

CREATE TABLE `tb_masuk` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('user','admin') NOT NULL,
  `verification` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_masuk`
--

INSERT INTO `tb_masuk` (`id`, `email`, `username`, `password`, `level`, `verification`) VALUES
(14, 'fachreza.19036@mhs.unesa.ac.id', 'fachreza norrahma', '$2y$10$bJ.PbPJJeta83pYj7VVffuWOgUfhr1er0r.250cGCNePvVGp5ooWa', 'admin', 'yes'),
(15, 'fnorrahma@gmail.com', 'gilang', '$2y$10$RiEFr2k9uYbRl.2Se1451.ugkNJgYL6efyGRHUZ3ZIOUSEmX5O55S', 'user', 'no'),
(16, 'gilang.19006@mhs.unesa.ac.id', 'gilang', '$2y$10$ZP50FGNJWdKaVcj5etxr7.4rfvHDHNxicvGrqRzcUv4SX7QtVDAMu', 'user', 'no'),
(17, 'ramadhantifirda801@gmail.com', 'firda', '$2y$10$6od2dmkoEUOR1DYgX4TbtO0wAR.5lchg1tbsSeFxqSS3AYPwiSmjm', 'user', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tb_reset_password`
--

CREATE TABLE `tb_reset_password` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `otp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_masuk`
--
ALTER TABLE `tb_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_reset_password`
--
ALTER TABLE `tb_reset_password`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_masuk`
--
ALTER TABLE `tb_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_reset_password`
--
ALTER TABLE `tb_reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_log`
--
ALTER TABLE `tb_log`
  ADD CONSTRAINT `tb_log_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_masuk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tb_reset_password`
--
ALTER TABLE `tb_reset_password`
  ADD CONSTRAINT `tb_reset_password_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_masuk` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
