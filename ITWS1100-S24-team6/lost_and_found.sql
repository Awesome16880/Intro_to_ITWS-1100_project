-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2024 at 12:42 AM
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
-- Database: `lost_and_found`
--

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `name` varchar(40) NOT NULL,
  `room` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`name`, `room`) VALUES
('87 Gymnasium', NULL),
('Academy Hall', NULL),
('Admissions', NULL),
('Alumni House', NULL),
('Alumni Sports & Recreation Center', NULL),
('Amos Eaton Hall', NULL),
('Barton Hall', NULL),
('Blitman Commons', NULL),
('Bray Hall', NULL),
('Bryckwyck', NULL),
('Burdett Avenue Residence Hall', NULL),
('Carnegie Building', NULL),
('CBIS', NULL),
('Chapel + Cultural Center', NULL),
('Cogswell Laboratory', NULL),
('Colonie Apartments', NULL),
('Commons Dining Hall', NULL),
('DCC', '209'),
('ECAV', NULL),
('EMPAC', NULL),
('Folsom Library', NULL),
('Greene Building', NULL),
('Hall Hall', NULL),
('Houston Field House', NULL),
('JEC', NULL),
('Jonsson-Rowland Science Center', NULL),
('Lally Hall', NULL),
('LINAC Facility', NULL),
('Low Center for Industrial Innovation', NULL),
('Mueller Center', NULL),
('Nason Hall', NULL),
('North Hall', NULL),
('Nugent Hall', NULL),
('Pittsburgh Building', NULL),
('Playhouse', NULL),
('Polytechnic Residence Commons', NULL),
('Public Safety', NULL),
('Quadrangle Complex', NULL),
('RAHPA', NULL),
('RAHPB', NULL),
('Rensselaer Union', NULL),
('Ricketts Building', NULL),
('Robison Swimming Pool', NULL),
('Rousseau Apartments', NULL),
('Russell Sage Dining Hall', NULL),
('Russell Sage Laboratory', NULL),
('Service Building', NULL),
('Sharp Hall', NULL),
('Stacwyck Apartments', NULL),
('Troy Building', NULL),
('VCC', NULL),
('Walker Laboratory', NULL),
('Warren Hall', NULL),
('West Hall', NULL),
('Williams Apartments', NULL),
('Winslow Building', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `location_items`
--

CREATE TABLE `location_items` (
  `location_name` varchar(40) NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location_items`
--

INSERT INTO `location_items` (`location_name`, `item_id`) VALUES
('Academy Hall', 5),
('Cogswell Laboratory', 11),
('DCC', 4),
('DCC', 6);

-- --------------------------------------------------------

--
-- Table structure for table `lost_items`
--

CREATE TABLE `lost_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `timeReported` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'The time this item was added.',
  `isFound` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Whether or not the item found its owner',
  `foundTime` datetime DEFAULT NULL COMMENT 'The time the item was found',
  `imageLink` varchar(1000) DEFAULT NULL COMMENT 'The link to the image',
  `priority` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lost_items`
--

INSERT INTO `lost_items` (`id`, `name`, `timeReported`, `isFound`, `foundTime`, `imageLink`, `priority`) VALUES
(4, 'Phone', '2024-04-08 00:00:00', 0, NULL, 'https://i.pcmag.com/imagery/roundups/01WOu4NbEnv3pJ54qp7j50k-16..v1647874749.jpg', 1),
(5, 'Book', '2024-04-08 00:00:00', 0, NULL, 'https://play-lh.googleusercontent.com/_tslXR7zUXgzpiZI9t70ywHqWAxwMi8LLSfx8Ab4Mq4NUTHMjFNxVMwTM1G0Q-XNU80', 0),
(6, 'BenQ GW2480 Computer Monitor 24\" FHD 1920x1080p', '2024-04-09 00:00:00', 0, NULL, 'https://m.media-amazon.com/images/I/71fldUuE52L._AC_SL1082_.jpg', 0),
(7, 'Lego Brick', '2024-04-09 00:00:00', 0, NULL, 'https://upload.wikimedia.org/wikipedia/commons/c/cd/Red_lego_brick.png', 0),
(8, 'Raspberry Pi', '2024-04-09 11:14:07', 0, NULL, 'https://tarpn.net/t/builder/images/2019-07-03-raspberry_pi_4b_7486prcr.jpg', 0),
(9, '12 Wash Cloths', '2024-04-09 11:20:38', 0, NULL, 'https://m.media-amazon.com/images/I/81Bd2Z7t3zL._AC_UF894,1000_QL80_.jpg', 0),
(10, 'Red Flannel', '2024-04-09 11:33:09', 0, NULL, 'https://www.yoopershirts.com/cdn/shop/products/FLANNEL-RED-2021_42f55e95-0264-47f9-8a3c-760c99215616_600x.png?v=1636139482', 0),
(11, 'Cardboard cutout of Obama', '2024-04-09 11:41:14', 0, NULL, 'https://m.media-amazon.com/images/I/61sX4yoF8nL.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `location_items`
--
ALTER TABLE `location_items`
  ADD UNIQUE KEY `item_id_2` (`item_id`),
  ADD UNIQUE KEY `item_id_3` (`item_id`),
  ADD KEY `location_name` (`location_name`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `lost_items`
--
ALTER TABLE `lost_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lost_items`
--
ALTER TABLE `lost_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `location_items`
--
ALTER TABLE `location_items`
  ADD CONSTRAINT `location_items_ibfk_1` FOREIGN KEY (`location_name`) REFERENCES `locations` (`name`),
  ADD CONSTRAINT `location_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `lost_items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
