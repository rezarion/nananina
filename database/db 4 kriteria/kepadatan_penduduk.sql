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
-- Table structure for table `kepadatan_penduduk`
--

CREATE TABLE `kepadatan_penduduk` (
  `id_kepadatan` int(11) NOT NULL,
  `id_kelurahan` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `nilai_kepadatan` int(11) NOT NULL,
  `id_klasifikasikepadatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kepadatan_penduduk`
--

INSERT INTO `kepadatan_penduduk` (`id_kepadatan`, `id_kelurahan`, `tahun`, `nilai_kepadatan`, `id_klasifikasikepadatan`) VALUES
(1, 1, 2014, 800, 1),
(2, 2, 2014, 171, 3),
(3, 3, 2014, 143, 3),
(4, 4, 2014, 327, 2),
(5, 5, 2014, 138, 3),
(6, 6, 2014, 231, 3),
(7, 7, 2014, 249, 3),
(8, 8, 2014, 258, 3),
(9, 9, 2014, 220, 3),
(10, 10, 2014, 154, 3),
(11, 11, 2014, 97, 4),
(12, 12, 2014, 222, 3),
(13, 13, 2014, 350, 2),
(14, 14, 2014, 220, 3),
(15, 15, 2014, 153, 3),
(16, 16, 2014, 301, 2),
(17, 17, 2014, 197, 3),
(18, 18, 2014, 173, 3),
(19, 19, 2014, 230, 3),
(20, 20, 2014, 193, 3),
(21, 21, 2014, 186, 3),
(22, 22, 2014, 159, 3),
(23, 23, 2014, 164, 3),
(24, 24, 2014, 383, 2),
(25, 25, 2014, 207, 3),
(26, 26, 2014, 189, 3),
(27, 27, 2014, 327, 2),
(28, 28, 2014, 33, 4),
(29, 29, 2014, 22, 4),
(30, 30, 2014, 43, 4),
(31, 31, 2014, 45, 4),
(32, 32, 2014, 80, 4),
(33, 33, 2014, 117, 3),
(34, 34, 2014, 43, 4),
(35, 35, 2014, 35, 0),
(36, 36, 2014, 69, 4),
(37, 37, 2014, 76, 4),
(38, 38, 2014, 21, 4),
(39, 39, 2014, 0, 4),
(40, 40, 2014, 0, 4),
(41, 41, 2014, 2, 4),
(42, 42, 2014, 0, 4),
(43, 43, 2014, 0, 4),
(44, 44, 2014, 0, 4),
(45, 45, 2014, 9, 4),
(46, 46, 2014, 0, 4),
(47, 47, 2014, 0, 4),
(48, 48, 2014, 0, 4),
(49, 49, 2014, 12, 4),
(50, 50, 2014, 14, 4),
(51, 51, 2014, 56, 4),
(52, 52, 2014, 86, 4),
(53, 53, 2014, 10, 4),
(54, 54, 2014, 18, 4),
(55, 55, 2014, 32, 4),
(56, 56, 2014, 37, 4),
(57, 57, 2014, 96, 4),
(58, 58, 2014, 64, 4),
(59, 59, 2014, 200, 3),
(60, 60, 2014, 91, 4),
(61, 61, 2014, 182, 3),
(62, 62, 2014, 181, 3),
(63, 63, 2014, 143, 3),
(64, 64, 2014, 193, 3),
(65, 65, 2014, 80, 3),
(66, 66, 2014, 130, 3),
(67, 67, 2014, 140, 3),
(68, 68, 2014, 209, 3),
(69, 69, 2014, 184, 3),
(70, 70, 2014, 172, 3),
(71, 71, 2014, 290, 3),
(72, 72, 2014, 129, 3),
(73, 73, 2014, 134, 3),
(74, 74, 2014, 152, 3),
(75, 75, 2014, 182, 3),
(76, 76, 2014, 98, 4),
(77, 77, 2014, 121, 3),
(78, 78, 2014, 129, 3),
(79, 79, 2014, 152, 3),
(80, 80, 2014, 150, 3),
(81, 81, 2014, 59, 4),
(82, 82, 2014, 187, 3),
(83, 83, 2014, 222, 3),
(84, 84, 2014, 57, 4),
(85, 85, 2014, 58, 4),
(86, 86, 2014, 98, 4),
(87, 87, 2014, 73, 4),
(88, 88, 2014, 71, 4),
(89, 89, 2014, 92, 4),
(90, 90, 2014, 132, 3),
(91, 91, 2014, 146, 3),
(92, 92, 2014, 167, 3),
(93, 93, 2014, 433, 1),
(94, 94, 2014, 135, 3),
(95, 95, 2014, 167, 3),
(96, 96, 2014, 315, 2),
(97, 97, 2014, 154, 3),
(98, 98, 2014, 199, 3),
(99, 99, 2014, 290, 3),
(100, 100, 2014, 130, 3),
(101, 101, 2014, 111, 3),
(102, 102, 2014, 229, 3),
(103, 103, 2014, 468, 1),
(104, 104, 2014, 328, 2),
(105, 105, 2014, 313, 2),
(106, 106, 2014, 275, 3),
(107, 107, 2014, 378, 2),
(108, 108, 2014, 455, 1),
(109, 109, 2014, 478, 1),
(110, 110, 2014, 384, 2),
(111, 111, 2014, 250, 3),
(112, 112, 2014, 395, 2),
(113, 113, 2014, 587, 1),
(114, 114, 2014, 738, 1),
(115, 115, 2014, 1094, 1),
(116, 116, 2014, 880, 1),
(117, 117, 2014, 734, 1),
(118, 118, 2014, 774, 1),
(119, 119, 2014, 835, 1),
(120, 120, 2014, 641, 1),
(121, 121, 2014, 428, 1),
(122, 122, 2014, 580, 1),
(123, 123, 2014, 1061, 1),
(124, 124, 2014, 200, 1),
(125, 125, 2014, 300, 1),
(126, 126, 2014, 350, 1),
(127, 127, 2014, 500, 1),
(128, 128, 2014, 770, 1),
(129, 129, 2014, 400, 1),
(130, 130, 2014, 500, 1),
(131, 131, 2014, 800, 1),
(132, 132, 2014, 171, 3),
(133, 133, 2014, 143, 3),
(134, 134, 2014, 327, 2),
(135, 135, 2014, 138, 3),
(136, 136, 2014, 231, 3),
(137, 137, 2014, 249, 3),
(138, 138, 2014, 258, 3),
(139, 139, 2014, 220, 3),
(140, 140, 2014, 154, 3),
(141, 141, 2014, 97, 4),
(142, 142, 2014, 222, 3),
(143, 143, 2014, 350, 2),
(144, 144, 2014, 220, 3),
(145, 145, 2014, 153, 3),
(146, 146, 2014, 301, 2),
(147, 147, 2014, 197, 3),
(148, 148, 2014, 173, 3),
(149, 149, 2014, 230, 3),
(150, 150, 2014, 193, 3),
(151, 151, 2014, 186, 3),
(152, 152, 2014, 159, 3),
(153, 153, 2014, 164, 3),
(154, 154, 2014, 383, 2),
(155, 155, 2014, 207, 3),
(156, 156, 2014, 189, 3),
(157, 157, 2014, 327, 2),
(158, 158, 2014, 33, 4),
(159, 159, 2014, 22, 4),
(160, 160, 2014, 43, 4),
(161, 161, 2014, 45, 4),
(162, 162, 2014, 80, 4),
(163, 163, 2014, 117, 3),
(164, 164, 2014, 43, 4),
(165, 165, 2014, 35, 0),
(166, 166, 2014, 69, 4),
(167, 167, 2014, 76, 4),
(168, 168, 2014, 21, 4),
(169, 169, 2014, 0, 4),
(170, 170, 2014, 0, 4),
(171, 171, 2014, 2, 4),
(172, 172, 2014, 0, 4),
(173, 173, 2014, 0, 4),
(174, 174, 2014, 0, 4),
(175, 175, 2014, 9, 4),
(176, 176, 2014, 0, 4),
(177, 177, 2014, 0, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kepadatan_penduduk`
--
ALTER TABLE `kepadatan_penduduk`
  ADD PRIMARY KEY (`id_kepadatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kepadatan_penduduk`
--
ALTER TABLE `kepadatan_penduduk`
  MODIFY `id_kepadatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
