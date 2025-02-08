-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2025 at 03:00 PM
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
-- Database: `db_mahasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `bio` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `first_name`, `last_name`, `email`, `bio`, `photo`, `password`, `remember_token`) VALUES
('A001', 'admin', 'BNCC', 'adminBNCC@gmail.com', 'Hi my name is Admin, and I like \nbackend development. ', NULL, '0192023a7bbd73250516f069df18b500', ''),
('MHS002', 'Mochammad Aqsa', 'Sandhy Pradipta', 'mochammad.pradipta@binus.ac.id', 'Yoo', 'b8eb66e6-5a93-46c8-b4b8-f0dd3bb10d2a.jpg', '3f92b4d84f80190a9990278834985e80', NULL),
('MHS003', 'Jesse', 'Soetedjo', 'jesse.soetedjo@gmail.com', '', 'Screenshot 2025-01-09 184105.png', 'bbd8a1c8b716f90cfaf9493cbb3868dc', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_email` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
