-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2017 at 05:30 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplicatie_colectiv`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `surename` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `salar` int(11) DEFAULT NULL,
  `cerere` int(11) DEFAULT NULL,
  `cnp` bigint(15) NOT NULL,
  `data_nastere` datetime NOT NULL,
  `data_angajare` datetime DEFAULT NULL,
  `sf_contract` datetime DEFAULT NULL,
  `pontaj_zi` int(11) DEFAULT NULL,
  `pontaj_luna` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `name`, `role`, `password`, `surename`, `phone_number`, `salar`, `cerere`, `cnp`, `data_nastere`, `data_angajare`, `sf_contract`, `pontaj_zi`, `pontaj_luna`) VALUES
(1, 'admin@admin.ro', 'admin', 'ROLE_USER', '$2y$13$Byv/g1cbjUvfZ5utpoMJAelOa0Brm9oqkhyHYMemr0J6h0f9WOe6.', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(2, 'ion@ion.com', 'Ion', 'ROLE_USER', '$2y$13$8LXnAUKQrgmtOJ6J2lV6vOroXEvFoWHckaCaXUY60GAVUYO73E4Gu', 'Ioan', '754264658', NULL, NULL, 1223321321, '2012-01-05 00:00:00', NULL, NULL, NULL, NULL),
(3, 'stefana.pop@stefi.ro', 'Pop', 'ROLE_USER', '$2y$13$svUI11SfjfXECeTQEF2eXeg1NE3fThPv3yL5EI3T0HFF.1yiTLaTS', 'Stefana', '744682471', NULL, NULL, 2147483647, '2012-10-14 00:00:00', NULL, NULL, NULL, NULL),
(7, 'bulga@bulga.ro', 'bulgare', 'ROLE_ADMIN', '$2y$13$oEXIKr1yXJHkPz.1J70ble05NNp1WUtR0U7eXbNzfgaTkLzQzJABC', 'Corneliu', '745412452', NULL, NULL, 1451215215, '1995-08-04 00:00:00', NULL, NULL, NULL, NULL),
(10, 'mircea@mircea.com', 'Rec', 'ROLE_USER', '$2y$13$5fDsacmShqRzZX8xt5RVN.05aPcgy25WwGIX6BYCXAjGvbQNcyZRa', 'Mircea', '756434434', NULL, NULL, 12345678912345, '1981-04-04 00:00:00', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_8D93D6491EAB9B7E` (`cnp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
