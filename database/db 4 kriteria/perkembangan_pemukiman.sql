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
-- Table structure for table `perkembangan_pemukiman`
--

CREATE TABLE `perkembangan_pemukiman` (
  `id_perkembangan` int(11) NOT NULL,
  `id_kelurahan` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `nilai_perkembangan` int(11) NOT NULL,
  `id_klasifikasiperkembangan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perkembangan_pemukiman`
--

INSERT INTO `perkembangan_pemukiman` (`id_perkembangan`, `id_kelurahan`, `tahun`, `nilai_perkembangan`, `id_klasifikasiperkembangan`) VALUES
(1, 1, 2014, 555, 5),
(2, 2, 2014, 300, 5),
(3, 3, 2014, 0, 1),
(4, 4, 2014, 0, 1),
(5, 5, 2014, 0, 0),
(6, 6, 2014, 0, 1),
(7, 7, 2014, 0, 1),
(8, 8, 2014, 0, 1),
(9, 9, 2014, 0, 1),
(10, 10, 2014, 0, 1),
(11, 11, 2014, 0, 1),
(12, 12, 2014, 0, 1),
(13, 13, 2014, 0, 1),
(14, 14, 2014, 0, 1),
(15, 15, 2014, 0, 1),
(16, 16, 2014, 0, 1),
(17, 17, 2014, 0, 1),
(18, 18, 2014, 0, 1),
(19, 19, 2014, 0, 1),
(20, 20, 2014, 0, 1),
(21, 21, 2014, 0, 1),
(22, 22, 2014, 0, 1),
(23, 23, 2014, 0, 1),
(24, 24, 2014, 0, 1),
(25, 25, 2014, 0, 1),
(26, 26, 2014, 0, 1),
(27, 27, 2014, 0, 0),
(28, 28, 2014, 0, 1),
(29, 29, 2014, 0, 1),
(30, 30, 2014, 0, 0),
(31, 31, 2014, 0, 1),
(32, 32, 2014, 0, 0),
(33, 33, 2014, 0, 0),
(34, 34, 2014, 0, 0),
(35, 35, 2014, 0, 0),
(36, 36, 2014, 0, 0),
(37, 37, 2014, 0, 0),
(38, 38, 2014, 0, 0),
(39, 39, 2014, 0, 1),
(40, 40, 2014, 0, 0),
(41, 41, 2014, 0, 1),
(42, 42, 2014, 0, 0),
(43, 43, 2014, 0, 0),
(44, 44, 2014, 0, 0),
(45, 45, 2014, 0, 0),
(46, 46, 2014, 0, 1),
(47, 47, 2014, 0, 1),
(48, 48, 2014, 0, 1),
(49, 49, 2014, 0, 1),
(50, 50, 2014, 0, 1),
(51, 51, 2014, 0, 1),
(52, 52, 2014, 0, 1),
(53, 53, 2014, 0, 1),
(54, 54, 2014, 0, 1),
(55, 55, 2014, 0, 1),
(56, 56, 2014, 0, 1),
(57, 57, 2014, 0, 1),
(58, 58, 2014, 0, 1),
(59, 59, 2014, 0, 1),
(60, 60, 2014, 0, 1),
(61, 61, 2014, 0, 1),
(62, 62, 2014, 0, 1),
(63, 63, 2014, 0, 1),
(64, 64, 2014, 0, 1),
(65, 65, 2014, 0, 1),
(66, 66, 2014, 0, 1),
(67, 67, 2014, 0, 1),
(68, 68, 2014, 0, 1),
(69, 69, 2014, 0, 0),
(70, 70, 2014, 0, 1),
(71, 71, 2014, 70, 1),
(72, 72, 2014, 0, 1),
(73, 73, 2014, 0, 1),
(74, 74, 2014, 0, 0),
(75, 75, 2014, 0, 0),
(76, 76, 2014, 0, 1),
(77, 77, 2014, 0, 1),
(78, 78, 2014, 0, 1),
(79, 79, 2014, 0, 1),
(80, 80, 2014, 0, 1),
(81, 81, 2014, 0, 1),
(82, 82, 2014, 0, 1),
(83, 83, 2014, 0, 1),
(84, 84, 2014, 0, 0),
(85, 85, 2014, 0, 0),
(86, 86, 2014, 0, 1),
(87, 87, 2014, 0, 1),
(88, 88, 2014, 0, 0),
(89, 89, 2014, 0, 1),
(90, 90, 2014, 0, 1),
(91, 91, 2014, 0, 1),
(92, 92, 2014, 0, 0),
(93, 93, 2014, 0, 1),
(94, 94, 2014, 0, 0),
(95, 95, 2014, 0, 0),
(96, 96, 2014, 0, 1),
(97, 97, 2014, 0, 0),
(98, 98, 2014, 0, 1),
(99, 99, 2014, 0, 1),
(100, 100, 2014, 0, 0),
(101, 101, 2014, 0, 0),
(102, 102, 2014, 0, 1),
(103, 103, 2014, 0, 0),
(104, 104, 2014, 0, 0),
(105, 105, 2014, 0, 0),
(106, 106, 2014, 0, 0),
(107, 107, 2014, 0, 0),
(108, 108, 2014, 0, 1),
(109, 109, 2014, 0, 1),
(110, 110, 2014, 0, 0),
(111, 111, 2014, 0, 0),
(112, 112, 2014, 0, 0),
(113, 113, 2014, 0, 0),
(114, 114, 2014, 0, 1),
(115, 115, 2014, 0, 1),
(116, 116, 2014, 0, 0),
(117, 117, 2014, 0, 0),
(118, 118, 2014, 0, 0),
(119, 119, 2014, 0, 1),
(120, 120, 2014, 0, 0),
(121, 121, 2014, 0, 1),
(122, 122, 2014, 0, 0),
(123, 123, 2014, 0, 0),
(124, 124, 2014, 0, 0),
(125, 125, 2014, 0, 0),
(126, 126, 2014, 0, 1),
(127, 127, 2014, 0, 1),
(128, 128, 2014, 0, 0),
(129, 129, 2014, 0, 0),
(130, 130, 2014, 0, 0),
(131, 131, 2014, 0, 0),
(132, 132, 2014, 0, 1),
(133, 133, 2014, 0, 0),
(134, 134, 2014, 0, 1),
(135, 135, 2014, 0, 1),
(136, 136, 2014, 0, 0),
(137, 137, 2014, 0, 0),
(138, 138, 2014, 0, 0),
(139, 139, 2014, 0, 0),
(140, 140, 2014, 0, 0),
(141, 141, 2014, 0, 1),
(142, 142, 2014, 0, 0),
(143, 143, 2014, 0, 0),
(144, 144, 2014, 0, 1),
(145, 145, 2014, 0, 1),
(146, 146, 2014, 0, 0),
(147, 147, 2014, 0, 0),
(148, 148, 2014, 0, 0),
(149, 149, 2014, 0, 0),
(150, 150, 2014, 0, 0),
(151, 151, 2014, 0, 0),
(152, 152, 2014, 0, 0),
(153, 153, 2014, 0, 0),
(154, 154, 2014, 0, 0),
(155, 155, 2014, 0, 0),
(156, 156, 2014, 0, 0),
(157, 157, 2014, 0, 0),
(158, 158, 2014, 0, 1),
(159, 159, 2014, 0, 1),
(160, 160, 2014, 0, 1),
(161, 161, 2014, 0, 1),
(162, 162, 2014, 0, 1),
(163, 163, 2014, 0, 0),
(164, 164, 2014, 0, 0),
(165, 165, 2014, 0, 0),
(166, 166, 2014, 0, 1),
(167, 167, 2014, 0, 1),
(168, 168, 2014, 0, 1),
(169, 169, 2014, 0, 0),
(170, 170, 2014, 0, 0),
(171, 171, 2014, 0, 0),
(172, 172, 2014, 0, 0),
(173, 173, 2014, 0, 0),
(174, 174, 2014, 0, 0),
(175, 175, 2014, 0, 0),
(176, 176, 2014, 500, 5),
(177, 177, 2015, 234, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `perkembangan_pemukiman`
--
ALTER TABLE `perkembangan_pemukiman`
  ADD PRIMARY KEY (`id_perkembangan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `perkembangan_pemukiman`
--
ALTER TABLE `perkembangan_pemukiman`
  MODIFY `id_perkembangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
