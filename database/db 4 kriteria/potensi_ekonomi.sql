-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2016 at 01:15 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penempatantoko`
--

-- --------------------------------------------------------

--
-- Table structure for table `potensi_ekonomi`
--

CREATE TABLE `potensi_ekonomi` (
  `id_potensi` int(11) NOT NULL,
  `id_kelurahan` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `nilai_potensi` int(11) NOT NULL,
  `id_klasifikasipotensi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `potensi_ekonomi`
--

INSERT INTO `potensi_ekonomi` (`id_potensi`, `id_kelurahan`, `tahun`, `nilai_potensi`, `id_klasifikasipotensi`) VALUES
(1, 1, 2014, 256, 1),
(2, 2, 2014, 270, 1),
(3, 3, 2014, 222, 2),
(4, 4, 2014, 159, 2),
(5, 5, 2014, 216, 2),
(6, 6, 2014, 316, 2),
(7, 7, 2014, 227, 2),
(8, 8, 2014, 175, 2),
(9, 9, 2014, 153, 2),
(10, 10, 2014, 167, 2),
(11, 11, 2014, 215, 2),
(12, 12, 2014, 155, 2),
(13, 13, 2014, 100, 2),
(14, 14, 2014, 124, 3),
(15, 15, 2014, 103, 2),
(16, 16, 2014, 132, 4),
(17, 17, 2014, 137, 4),
(18, 18, 2014, 137, 2),
(19, 19, 2014, 120, 2),
(20, 20, 2014, 117, 2),
(21, 21, 2014, 243, 1),
(22, 22, 2014, 139, 3),
(23, 23, 2014, 139, 4),
(24, 24, 2014, 170, 3),
(25, 25, 2014, 194, 4),
(26, 26, 2014, 139, 4),
(27, 27, 2014, 107, 4),
(28, 28, 2014, 113, 4),
(29, 29, 2014, 135, 3),
(30, 30, 2014, 144, 4),
(31, 31, 2014, 127, 2),
(32, 32, 2014, 285, 3),
(33, 33, 2014, 106, 3),
(34, 34, 2014, 157, 4),
(35, 35, 2014, 100, 2),
(36, 36, 2014, 109, 2),
(37, 37, 2014, 153, 3),
(38, 38, 2014, 142, 4),
(39, 39, 2014, 111, 3),
(40, 40, 2014, 156, 4),
(41, 41, 2014, 421, 4),
(42, 42, 2014, 207, 4),
(43, 43, 2014, 183, 5),
(44, 44, 2014, 213, 2),
(45, 45, 2014, 109, 3),
(46, 46, 2014, 465, 4),
(47, 47, 2014, 60, 3),
(48, 48, 2014, 158, 4),
(49, 49, 2014, 146, 5),
(50, 50, 2014, 100, 2),
(51, 51, 2014, 283, 4),
(52, 52, 2014, 594, 5),
(53, 53, 2014, 100, 2),
(54, 54, 2014, 926, 4),
(55, 55, 2014, 197, 4),
(56, 56, 2014, 166, 4),
(57, 57, 2014, 700, 5),
(58, 58, 2014, 127, 4),
(59, 59, 2014, 220, 3),
(60, 60, 2014, 130, 5),
(61, 61, 2014, 153, 2),
(62, 62, 2014, 150, 2),
(63, 63, 2014, 132, 2),
(64, 64, 2014, 222, 2),
(65, 65, 2014, 149, 2),
(66, 66, 2014, 218, 2),
(67, 67, 2014, 104, 2),
(68, 68, 2014, 131, 2),
(69, 69, 2014, 149, 2),
(70, 70, 2014, 104, 2),
(71, 71, 2014, 127, 2),
(72, 72, 2014, 127, 2),
(73, 73, 2014, 239, 2),
(74, 74, 2014, 120, 2),
(75, 75, 2014, 134, 4),
(76, 76, 2014, 145, 2),
(77, 77, 2014, 185, 2),
(78, 78, 2014, 107, 4),
(79, 79, 2014, 307, 2),
(80, 80, 2014, 128, 4),
(81, 81, 2014, 300, 2),
(82, 82, 2014, 275, 3),
(83, 83, 2014, 286, 4),
(84, 84, 2014, 162, 2),
(85, 85, 2014, 119, 4),
(86, 86, 2014, 285, 2),
(87, 87, 2014, 159, 4),
(88, 88, 2014, 212, 2),
(89, 89, 2014, 331, 2),
(90, 90, 2014, 185, 2),
(91, 91, 2014, 194, 1),
(92, 92, 2014, 192, 1),
(93, 93, 2014, 111, 1),
(94, 94, 2014, 139, 1),
(95, 95, 2014, 271, 1),
(96, 96, 2014, 112, 2),
(97, 97, 2014, 454, 1),
(98, 98, 2014, 130, 2),
(99, 99, 2014, 119, 3),
(100, 100, 2014, 131, 2),
(101, 101, 2014, 274, 2),
(102, 102, 2014, 130, 2),
(103, 103, 2014, 500, 1),
(104, 104, 2014, 256, 1),
(105, 105, 2014, 270, 1),
(106, 106, 2014, 222, 2),
(107, 107, 2014, 159, 2),
(108, 108, 2014, 216, 2),
(109, 109, 2014, 316, 2),
(110, 110, 2014, 227, 2),
(111, 111, 2014, 175, 2),
(112, 112, 2014, 153, 2),
(113, 113, 2014, 167, 2),
(114, 114, 2014, 215, 2),
(115, 115, 2014, 155, 2),
(116, 116, 2014, 100, 2),
(117, 117, 2014, 124, 3),
(118, 118, 2014, 103, 2),
(119, 119, 2014, 132, 4),
(120, 120, 2014, 137, 4),
(121, 121, 2014, 137, 2),
(122, 122, 2014, 120, 2),
(123, 123, 2014, 117, 2),
(124, 124, 2014, 243, 1),
(125, 125, 2014, 139, 3),
(126, 126, 2014, 139, 4),
(127, 127, 2014, 170, 3),
(128, 128, 2014, 194, 4),
(129, 129, 2014, 139, 4),
(130, 130, 2014, 107, 4),
(131, 131, 2014, 113, 4),
(132, 132, 2014, 135, 3),
(133, 133, 2014, 144, 4),
(134, 134, 2014, 127, 2),
(135, 135, 2014, 285, 3),
(136, 136, 2014, 106, 3),
(137, 137, 2014, 157, 4),
(138, 138, 2014, 100, 2),
(139, 139, 2014, 109, 2),
(140, 140, 2014, 153, 3),
(141, 141, 2014, 142, 4),
(142, 142, 2014, 111, 3),
(143, 143, 2014, 156, 4),
(144, 144, 2014, 421, 4),
(145, 145, 2014, 207, 4),
(146, 146, 2014, 183, 5),
(147, 147, 2014, 213, 2),
(148, 148, 2014, 109, 3),
(149, 149, 2014, 465, 4),
(150, 150, 2014, 60, 3),
(151, 151, 2014, 158, 4),
(152, 152, 2014, 146, 5),
(153, 153, 2014, 100, 2),
(154, 154, 2014, 283, 4),
(155, 155, 2014, 594, 5),
(156, 156, 2014, 100, 2),
(157, 157, 2014, 926, 4),
(158, 158, 2014, 197, 4),
(159, 159, 2014, 166, 4),
(160, 160, 2014, 700, 5),
(161, 161, 2014, 127, 4),
(162, 162, 2014, 220, 3),
(163, 163, 2014, 130, 5),
(164, 164, 2014, 153, 2),
(165, 165, 2014, 150, 2),
(166, 166, 2014, 132, 2),
(167, 167, 2014, 222, 2),
(168, 168, 2014, 149, 2),
(169, 169, 2014, 218, 2),
(170, 170, 2014, 104, 2),
(171, 171, 2014, 131, 2),
(172, 172, 2014, 149, 2),
(173, 173, 2014, 104, 2),
(174, 174, 2014, 127, 2),
(175, 175, 2014, 127, 2),
(176, 176, 2014, 239, 2),
(177, 177, 2014, 120, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `potensi_ekonomi`
--
ALTER TABLE `potensi_ekonomi`
  ADD PRIMARY KEY (`id_potensi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `potensi_ekonomi`
--
ALTER TABLE `potensi_ekonomi`
  MODIFY `id_potensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
