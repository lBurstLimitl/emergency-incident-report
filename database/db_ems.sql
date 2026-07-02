-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 12:12 AM
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
-- Database: `db_ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(20) NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `state` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `agency_id` varchar(50) NOT NULL,
  `photo` varchar(700) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `phone`, `state`, `username`, `password`, `address`, `agency_id`, `photo`) VALUES
(10, 'Allen Pascual\r\n', 'jonathan@gmail.com', '09063633140', 'Abuja', 'admin', 'admin', 'FCT', '6757', 'admin08d9b861efdf38556a13bceab9930529.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

CREATE TABLE `agency` (
  `id` int(11) NOT NULL,
  `agency_id` varchar(50) NOT NULL,
  `categories_id` varchar(255) NOT NULL,
  `agency_name` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `personincharge` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`id`, `agency_id`, `categories_id`, `agency_name`, `phone_number`, `email`, `personincharge`, `username`, `password`, `state`, `address`, `latitude`, `longitude`, `photo`) VALUES
(29, '8812', '26', 'test', 'test', 'test@test', 'test', 'test', 'test', 'test', '625, Santo Niño Street, Royal Townhomes, Plainview, Mandaluyong, Eastern Manila District, Metro Manila, 1551, Philippines', 14.57976242, 121.03241869, 'agency0bcb9466d20a4bcdf4efd07633b429d3.jpg'),
(30, '2343', '27', 'test 1 ', '09123456789', 'test1@test1', 'test', 'test', 'test', 'test', 'F. Manalo Street, Batis, 1st District, San Juan, Eastern Manila District, Metro Manila, 1067, Philippines', 14.60142080, 121.02205440, 'agencyc083c4398512e8435132f1786613383b.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `description`, `created_at`) VALUES
(26, 'Medical Station', 'A facility or setup where medical care is provided to injured or ill individuals during an emergency, including first aid, triage, and more advanced care.', '2024-12-30 04:17:52'),
(27, 'Fire Station', '\r\nA fire station is a facility where fire department personnel and equipment are housed and maintained. It serves as the base of operations for firefighters and emergency response teams. Fire stations play a crucial role in ensuring public safety by provi', '2024-12-30 04:19:17'),
(28, 'Police Station', 'A police station in the Philippines is a facility where law enforcement officers are stationed and tasked with maintaining peace, order, and safety in a specific jurisdiction or community. It serves as the central hub for police operations, including crim', '2024-12-30 04:19:33');

-- --------------------------------------------------------

--
-- Table structure for table `emergency`
--

CREATE TABLE `emergency` (
  `id` int(11) NOT NULL,
  `emergency_id` int(11) NOT NULL,
  `agency_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `agency_name` varchar(50) NOT NULL,
  `case_severity` varchar(50) NOT NULL,
  `emergency_category` varchar(50) NOT NULL,
  `date` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `state` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dates` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `victim_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `photo` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency`
--

INSERT INTO `emergency` (`id`, `emergency_id`, `agency_id`, `agency_name`, `case_severity`, `emergency_category`, `date`, `state`, `phone_number`, `address`, `name`, `status`, `email`, `dates`, `victim_id`, `description`, `photo`) VALUES
(78, 6001, '1337', '', 'Normal', 'Accident', '', 'Abuja', '09063633140', 'nn', 'Jonathan Odoh', 'Pending', 'jonathan@gmail.com', '17-05-2023', '3253', 'nn', 'emergency0283bcfb67710bf2957fe23b3a061590.jpeg'),
(79, 3642, '9496', '', 'Normal', 'Accident', '', 'Abuja', '090637889', 'tgfhg', 'Police', 'Resolved', 'police@gmail.com', '18-05-2023', '1337', 'hjhgf', 'emergency38642db2c33f41d4f4a5157c0fcbb2b0.jpeg'),
(80, 5637, '9496', '', 'Normal', 'Accident', '', 'Kogi', '09063633140', 'gtbf', 'EFCC', 'Resolved', 'efcc@gmail.com', '18-05-2023', '9496', 'ggb', 'emergencye153c9b4edaf52253f997e9a7c9923ad.jpeg'),
(81, 8287, '1337', '', 'Normal', 'Accident', '', 'Abuja', '09063633140', 'hh', 'Jonathan Odoh', 'Resolved', 'jonathan@gmail.com', '29-05-2023', '3253', 'sgzf', 'emergency34e2e5968dfd4122bcb598c4b63bb9eb.jpeg'),
(82, 1218, '2258', '', 'Select', 'Fire out break', '', 'test', '09063633140', 'Santo NiÃ±o Street, Muntinlupa, , Philippines', 'Jonathan Odoh', 'Resolved', 'jonathan@gmail.com', '04-12-2024', '3253', 'test', 'emergencyc1c2d7d5a69491bd5188646c0f2815b2.jpg'),
(83, 1916, '9061', '', 'Critical', 'Accident', '', 'test2', '09063633140', 'Ilaya Street, Muntinlupa, , Philippines', 'Jonathan Odoh', 'Pending', 'jonathan@gmail.com', '04-12-2024', '3253', 'test2', 'emergency5a52e0b580005d3598d6fc2e4d13478d.jpg'),
(84, 1457, '2258', '', 'Normal', 'Accident', '', 'Test3', '09063633140', 'Santo NiÃ±o Street, Muntinlupa, , Philippines', 'Jonathan Odoh', 'Resolved', 'jonathan@gmail.com', '05-12-2024', '3253', 'test', 'emergency91a6b21f114c968e742913f7098d11a8.jpg'),
(85, 1965, '2258', '', 'Normal', 'Accident', '', 'Sample 1', '09063633140', 'T. Molina Street, Muntinlupa, , Philippines', 'Jonathan Odoh', 'Pending', 'jonathan@gmail.com', '05-12-2024', '3253', 'Sample 1', 'emergency6cbe70f92e40a497cffab368b3051314.jpg'),
(86, 1304, '2258', '', 'Select', 'Fire out break', '', 'test', '09063633140', 'Santo NiÃ±o Street, Muntinlupa, , Philippines', 'Allen Pascual', 'Pending', 'jonathan@gmail.com', '05-12-2024', '6757', 'test', 'emergency140c05ceb76e7d19d470bd94b21bb064.jfif'),
(87, 5203, '8010', '', 'Select', 'Fire out break', '', 'test', '09063633140', 'Santo NiÃ±o Street, Muntinlupa, Philippines', 'Jonathan Odoh', 'Pending', 'jonathan@gmail.com', '06-12-2024', '3253', 'test', 'emergencyd066101eb7991c5f8f2dd9ca022f3ede.jpg'),
(88, 4032, '9061', '', 'Select', 'Fire out break', '', 'asd', '09063633140', 'Santo NiÃ±o Street, Muntinlupa, Philippines', 'Jonathan Odoh', 'Resolved', 'jonathan@gmail.com', '06-12-2024', '3253', 'asd', 'emergencydf615603fb5a934eca1232a0d9b2bb67.jpg'),
(89, 3615, '8010', '', 'Normal', 'Accident', '', 'N/A', '09063633140', 'National Road, Muntinlupa, Philippines', 'Jonathan Odoh', 'Pending', 'jonathan@gmail.com', '15-12-2024', '3253', 'dasdasd', 'emergency3d0d1ca95e1d16d6b424b9f3017c3810.jpg'),
(90, 8711, '8010', '', 'Critical', 'Accident', '', 'test', '09063633140', 'Katihan Street, Muntinlupa, Philippines', 'Jonathan Odoh', 'Pending', 'jonathan@gmail.com', '15-12-2024', '3253', 'TEST', 'emergency3bac54c0a73a87e0f818514414098985.jpg'),
(91, 2306, '2258', '', 'Normal', 'Accident', '', 'test', '', 'test', 'Police', 'Pending', '', '15-12-2024', '8010', 'test', 'emergency683d60f95bcef8166307cc6813cffebe.jpg'),
(92, 1828, '2258', '', 'Critical', 'Fire out break', '', 'Sunog', '09063633140', 'National Road, Muntinlupa, Philippines', 'Jonathan Odoh', 'Pending', 'jonathan@gmail.com', '15-12-2024', '3253', 'Malala na yung sunog dito sa may muntinlupa', 'emergencyeeed083719978d296d5b0ff63e26cfe3.jpg'),
(93, 1010, '2258', '', 'Critical', 'Fire out break', '', 'test', '09063633140', 'National Road, Muntinlupa, Philippines', 'Jonathan Odoh', 'Pending', 'jonathan@gmail.com', '15-12-2024', '3253', 'test', 'emergency8aa9d1bd3c3eb299112ce00675edda4e.jpg'),
(94, 7527, '8010', '', 'Critical', 'Fire out break', '', 'dasdas', '09063633140', 'Mindanao Street, Muntinlupa, Philippines', 'Jonathan Odoh', 'Pending', 'jonathan@gmail.com', '15-12-2024', '3253', 'dasdas', 'emergencyd38717bca42a9c53fedc42359a81edc2.jpg'),
(95, 4311, '2258', '', 'Critical', 'Accident', '', 'N/A', '09063633140', 'Mindanao Street, Muntinlupa, Philippines', 'Jonathan Odoh', 'Pending', 'jonathan@gmail.com', '29-12-2024', '3253', 'please help me!', 'emergency37b163bc343b4b89fd5ced6dd7f4570f.jpeg'),
(96, 9465, '2379', '', 'Critical', 'Fire out break', '', 'N/A', '09063633140', 'Unable to fetch address. Please verify your location.', 'Jonathan Odoh', 'Pending', 'jonathan@gmail.com', '29-12-2024', '3253', 'test', 'emergency91a34683f03ff868db037b746cd33009.jpeg'),
(97, 5620, '5163', '', 'Critical', 'Fire out break', '', 'Please help me!', '09063633140', 'San Pedro, Laguna, Philippines', 'Jonathan Odoh', 'Pending', 'jonathan@gmail.com', '29-12-2024', '3253', 'Please help me ', 'emergency018fa2af25fdf37947811505ef999aee.jpg'),
(98, 9700, '5163', '', 'Critical', 'Covid-19', '', 'Please help me!', '09063633140', 'Vista Terminal Exchange Arrivals, Muntinlupa, Philippines', 'Jonathan Odoh', 'Pending', 'jonathan@gmail.com', '29-12-2024', '3253', 'Test', 'emergency9ff570ea0dbd618aa13f60555830a846.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_type`
--

CREATE TABLE `emergency_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_type`
--

INSERT INTO `emergency_type` (`id`, `name`, `description`) VALUES
(1, 'Accident', ''),
(2, 'Fire out break', ''),
(3, 'Covid-19', ''),
(4, 'Insurgency', ''),
(5, 'Armed Robbery', ''),
(7, 'test', 'test'),
(8, 'test', 'test'),
(9, 'test', 'test'),
(10, 'test', 'test\r\n'),
(11, 'test', 'test'),
(12, 'test', 'test'),
(13, 'test', 'test'),
(14, 'test', 'test'),
(15, 'test', 'test'),
(16, 'test', 'test'),
(17, 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `joined` varchar(30) NOT NULL,
  `state` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `joined`, `state`, `phone`, `user_id`, `address`, `photo`) VALUES
(23, 'Jonathan Odoh', 'jonathan@gmail.com', 'jona', 'jona', '', 'Abuja', '09063633140', '3253', '', ''),
(24, 'Marc Alimon', 'alimon@yahoo.com', 'alimon', 'marc', '', 'NA', '09123456789', '8300', '', 'user814fa1aa677bdcf1f959951fcddfc255.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency`
--
ALTER TABLE `emergency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_type`
--
ALTER TABLE `emergency_type`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `agency`
--
ALTER TABLE `agency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `emergency`
--
ALTER TABLE `emergency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `emergency_type`
--
ALTER TABLE `emergency_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
