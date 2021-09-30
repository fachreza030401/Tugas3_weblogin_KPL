-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2021 at 03:09 PM
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
-- Table structure for table `tb_masuk`
--

CREATE TABLE `tb_masuk` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_masuk`
--

INSERT INTO `tb_masuk` (`id`, `email`, `username`, `password`) VALUES
(4, 'fnorrahma@gmail.com', 'fachreza n', '$2y$10$PNJNQj2CkNcbplSRKbd6h.2le5uSY2sVMhoWNQWBDtAg2juWf9Z/W'),
(5, 'miracle234@gmail.com', 'fachreza n', '$2y$10$LtlV2t7DIUwyEWL6cx7yHuhpHJrrV.a43zB5Nw2pf2AGccDAJ5Lzu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_masuk`
--
ALTER TABLE `tb_masuk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_masuk`
--
ALTER TABLE `tb_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
