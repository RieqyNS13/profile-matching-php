-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2018 at 09:54 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id`, `id_user`, `id_menu`) VALUES
(7, 3, 1),
(8, 3, 2),
(9, 3, 3),
(10, 3, 4),
(11, 3, 5),
(12, 3, 6),
(13, 3, 7),
(14, 3, 8),
(15, 3, 9),
(16, 3, 10),
(17, 3, 11),
(18, 3, 12),
(19, 4, 2),
(20, 4, 6),
(21, 4, 5),
(22, 3, 13);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama_menu`) VALUES
(1, 'create_alternatif'),
(2, 'read_alternatif'),
(3, 'update_alternatif'),
(4, 'delete_alternatif'),
(5, 'create_aspek'),
(6, 'read_aspek'),
(7, 'update_aspek'),
(8, 'delete_aspek'),
(9, 'create_kriteria'),
(10, 'read_kriteria'),
(11, 'update_kriteria'),
(12, 'delete_kriteria'),
(13, 'input_profile');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nama_role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_alternatif`
--

CREATE TABLE `tbl_alternatif` (
  `id` int(10) NOT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `nama_alternatif` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_alternatif`
--

INSERT INTO `tbl_alternatif` (`id`, `kode`, `nama_alternatif`) VALUES
(2, '4611416002', 'ä¹±è—¤å››éƒŽ'),
(3, '4611416026', 'Ryuunosuke Akasaka\r\n'),
(4, '4611416028', 'Kashuu Kiyomitsu'),
(5, '4611416012', 'Yamatonokami Yasusada'),
(6, '4611416011', 'Mikazuki Munechika'),
(7, '4611416009', 'Tsurumaru Kuninaga'),
(8, '4611416014', 'Izuminokami Kanesada'),
(9, '4611416001', 'Yamanbagiri Kunihiro '),
(15, '4611416027', 'Yagen Toushirou'),
(19, '4611416013', 'Kogitsunemaru');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_aspek`
--

CREATE TABLE `tbl_aspek` (
  `id` int(10) NOT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `nama_aspek` varchar(30) DEFAULT NULL,
  `persentase` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_aspek`
--

INSERT INTO `tbl_aspek` (`id`, `kode`, `nama_aspek`, `persentase`) VALUES
(3, 'A1', 'Survival', 15),
(15, 'A2', 'Leadership', 8),
(16, 'A3', 'Impulse', 13),
(17, 'A4', 'Killing Blow', 20),
(18, 'A5', 'Camouflage', 15),
(19, 'A6', 'Impact', 10),
(20, 'A7', 'Mobility', 10),
(21, 'A8', 'Scouting', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `id` int(10) NOT NULL,
  `id_aspek` int(10) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama_kriteria` varchar(30) NOT NULL,
  `nilai` int(4) NOT NULL,
  `factor` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kriteria`
--

INSERT INTO `tbl_kriteria` (`id`, `id_aspek`, `kode`, `nama_kriteria`, `nilai`, `factor`) VALUES
(3, 3, 'A1a', 'Kriteria Survival 3', 6, '1'),
(4, 15, 'A21', 'Kriteria Killing Blow 1', 8, '2'),
(5, 3, 'A12', 'Kriteria Survival 1', 7, '2'),
(6, 3, 'A15', 'Kriteria Survival 2', 6, '1'),
(7, 15, 'A22', 'Kriteria Killing Blow 2', 7, '1'),
(8, 16, 'A31', 'Kriteria Range 1', 6, '1'),
(9, 16, 'A32', 'Kriteria Range 2', 4, '1'),
(10, 16, 'A33', 'Kriteria Range 3', 5, '2'),
(11, 17, 'A41', 'Killing Blow 1', 4, '1'),
(12, 17, 'A42', 'Killing Blow 2', 4, '2'),
(13, 17, 'A43', 'Killing Blow 3', 7, '2'),
(14, 18, 'A51', 'Camouflage 1', 6, '2'),
(15, 18, 'A52', 'Camouflage 2', 4, '1'),
(16, 19, 'A61', 'Impact 1', 6, '1'),
(17, 19, 'A62', 'Impact 2', 4, '1'),
(18, 19, 'A63', 'Impact 3', 7, '2'),
(19, 19, 'A64', 'Impact 4', 4, '2'),
(20, 20, 'A71', 'Mobility 1', 6, '2'),
(21, 20, 'A72', 'Mobility 2', 4, '2'),
(22, 20, 'A73', 'Mobility 3', 3, '1'),
(23, 21, 'A81', 'Scouting 1', 4, '1'),
(24, 21, 'A82', 'Scouting 1', 6, '1'),
(25, 21, 'A83', 'Scouting 3', 7, '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profile`
--

CREATE TABLE `tbl_profile` (
  `id` int(10) NOT NULL,
  `id_alternatif` int(10) NOT NULL,
  `id_kriteria` int(10) NOT NULL,
  `nilai_profile` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_profile`
--

INSERT INTO `tbl_profile` (`id`, `id_alternatif`, `id_kriteria`, `nilai_profile`) VALUES
(1, 9, 3, 5),
(2, 9, 5, 3),
(3, 9, 6, 3),
(4, 19, 3, 5),
(5, 19, 5, 3),
(6, 19, 6, 4),
(7, 15, 3, 6),
(8, 15, 5, 5),
(9, 15, 6, 3),
(10, 4, 6, 4),
(11, 4, 3, 4),
(12, 4, 5, 3),
(13, 5, 5, 6),
(14, 5, 3, 4),
(15, 5, 6, 6),
(16, 2, 4, 5),
(17, 2, 7, 6),
(18, 19, 4, 3),
(19, 19, 7, 4),
(21, 2, 5, 4),
(22, 2, 6, 3),
(23, 4, 4, 7),
(24, 4, 7, 5),
(25, 5, 4, 5),
(26, 5, 7, 7),
(27, 9, 4, 7),
(28, 9, 7, 4),
(29, 15, 7, 4),
(30, 15, 4, 5),
(31, 2, 8, 6),
(32, 2, 9, 5),
(33, 2, 10, 4),
(34, 19, 8, 3),
(35, 19, 9, 4),
(36, 19, 10, 6),
(37, 5, 10, 6),
(38, 5, 9, 6),
(39, 5, 8, 6),
(40, 4, 8, 6),
(41, 4, 10, 6),
(42, 4, 9, 6),
(43, 8, 8, 4),
(44, 8, 9, 5),
(45, 8, 10, 4),
(46, 9, 8, 7),
(47, 9, 9, 6),
(48, 9, 10, 7),
(49, 15, 8, 7),
(50, 15, 9, 5),
(51, 15, 10, 6),
(52, 8, 4, 6),
(53, 8, 7, 3),
(54, 8, 3, 3),
(55, 8, 5, 3),
(56, 8, 6, 5),
(57, 7, 3, 6),
(58, 7, 5, 7),
(59, 7, 6, 5),
(60, 2, 3, 4),
(61, 3, 3, 6),
(62, 3, 5, 6),
(63, 3, 6, 7),
(64, 6, 3, 7),
(65, 6, 5, 6),
(66, 6, 6, 6),
(67, 3, 8, 8),
(68, 3, 9, 6),
(69, 3, 10, 4),
(70, 6, 8, 3),
(71, 6, 9, 3),
(72, 6, 10, 4),
(73, 7, 8, 4),
(74, 7, 9, 6),
(75, 7, 10, 5),
(76, 3, 4, 6),
(77, 3, 7, 7),
(78, 6, 4, 6),
(79, 6, 7, 7),
(80, 7, 4, 0),
(81, 7, 7, 0),
(82, 2, 11, 7),
(83, 2, 12, 4),
(84, 2, 13, 4),
(85, 3, 11, 4),
(86, 3, 12, 7),
(87, 3, 13, 3),
(88, 4, 11, 6),
(89, 4, 12, 6),
(90, 4, 13, 6),
(91, 5, 11, 4),
(92, 5, 12, 3),
(93, 5, 13, 8),
(94, 6, 11, 5),
(95, 6, 12, 5),
(96, 6, 13, 7),
(97, 7, 11, 4),
(98, 7, 12, 6),
(99, 7, 13, 5),
(100, 8, 11, 5),
(101, 8, 12, 5),
(102, 8, 13, 7),
(103, 9, 11, 7),
(104, 9, 12, 5),
(105, 9, 13, 5),
(106, 15, 11, 6),
(107, 15, 12, 3),
(108, 15, 13, 4),
(109, 19, 11, 6),
(110, 19, 12, 5),
(111, 19, 13, 4),
(112, 2, 14, 5),
(113, 2, 15, 5),
(114, 3, 14, 6),
(115, 3, 15, 8),
(116, 4, 14, 6),
(117, 4, 15, 5),
(118, 5, 14, 3),
(119, 5, 15, 4),
(120, 6, 14, 5),
(121, 6, 15, 6),
(122, 7, 14, 7),
(123, 7, 15, 7),
(124, 8, 14, 5),
(125, 8, 15, 2),
(126, 9, 14, 4),
(127, 9, 15, 4),
(128, 15, 14, 3),
(129, 15, 15, 3),
(130, 19, 14, 6),
(131, 19, 15, 7),
(132, 2, 16, 4),
(133, 2, 17, 3),
(134, 2, 18, 4),
(135, 2, 19, 5),
(136, 3, 16, 5),
(137, 3, 17, 5),
(138, 3, 18, 5),
(139, 3, 19, 5),
(140, 4, 16, 6),
(141, 4, 17, 7),
(142, 4, 18, 4),
(143, 4, 19, 6),
(144, 5, 16, 6),
(145, 5, 17, 7),
(146, 5, 18, 7),
(147, 5, 19, 7),
(148, 6, 16, 2),
(149, 6, 17, 3),
(150, 6, 18, 4),
(151, 6, 19, 5),
(152, 7, 16, 5),
(153, 7, 17, 4),
(154, 7, 18, 2),
(155, 7, 19, 3),
(156, 8, 16, 4),
(157, 8, 17, 5),
(158, 8, 18, 3),
(159, 8, 19, 4),
(160, 9, 16, 5),
(161, 9, 17, 6),
(162, 9, 18, 7),
(163, 9, 19, 3),
(164, 15, 16, 6),
(165, 15, 17, 2),
(166, 15, 18, 3),
(167, 15, 19, 3),
(168, 19, 16, 6),
(169, 19, 17, 4),
(170, 19, 18, 6),
(171, 19, 19, 3),
(172, 2, 20, 6),
(173, 2, 21, 3),
(174, 2, 22, 6),
(175, 3, 20, 5),
(176, 3, 21, 5),
(177, 3, 22, 5),
(178, 4, 20, 4),
(179, 4, 21, 4),
(180, 4, 22, 4),
(181, 5, 20, 3),
(182, 5, 21, 5),
(183, 5, 22, 6),
(184, 6, 20, 6),
(185, 6, 21, 5),
(186, 6, 22, 3),
(187, 7, 20, 4),
(188, 7, 21, 2),
(189, 7, 22, 3),
(190, 8, 20, 5),
(191, 8, 21, 7),
(192, 8, 22, 6),
(193, 9, 20, 6),
(194, 9, 21, 7),
(195, 9, 22, 6),
(196, 15, 20, 5),
(197, 15, 21, 3),
(198, 15, 22, 4),
(199, 19, 20, 3),
(200, 19, 21, 4),
(201, 19, 22, 2),
(202, 2, 23, 2),
(203, 2, 24, 2),
(204, 2, 25, 3),
(205, 3, 23, 5),
(206, 3, 24, 4),
(207, 3, 25, 2),
(208, 4, 23, 5),
(209, 4, 24, 4),
(210, 4, 25, 8),
(211, 5, 23, 4),
(212, 5, 24, 6),
(213, 5, 25, 8),
(214, 6, 23, 8),
(215, 6, 24, 5),
(216, 6, 25, 2),
(217, 7, 23, 6),
(218, 7, 24, 4),
(219, 7, 25, 4),
(220, 8, 23, 3),
(221, 8, 24, 5),
(222, 8, 25, 7),
(223, 9, 23, 7),
(224, 9, 24, 5),
(225, 9, 25, 4),
(226, 15, 23, 5),
(227, 15, 24, 5),
(228, 15, 25, 4),
(229, 19, 23, 6),
(230, 19, 24, 7),
(231, 19, 25, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `password`, `id_role`) VALUES
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(4, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_id_user` (`id_user`) USING BTREE,
  ADD KEY `idx_id_menu` (`id_menu`) USING BTREE;

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_aspek`
--
ALTER TABLE `tbl_aspek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aspek_idx` (`id_aspek`) USING BTREE;

--
-- Indexes for table `tbl_profile`
--
ALTER TABLE `tbl_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kriteria_idx` (`id_alternatif`,`id_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id`,`user`,`password`,`id_role`),
  ADD KEY `id_role_2` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_aspek`
--
ALTER TABLE `tbl_aspek`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_profile`
--
ALTER TABLE `tbl_profile`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD CONSTRAINT `hak_akses_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `hak_akses_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  ADD CONSTRAINT `tbl_kriteria_ibfk_1` FOREIGN KEY (`id_aspek`) REFERENCES `tbl_aspek` (`id`);

--
-- Constraints for table `tbl_profile`
--
ALTER TABLE `tbl_profile`
  ADD CONSTRAINT `tbl_profile_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `tbl_kriteria` (`id`),
  ADD CONSTRAINT `tbl_profile_ibfk_2` FOREIGN KEY (`id_alternatif`) REFERENCES `tbl_alternatif` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
