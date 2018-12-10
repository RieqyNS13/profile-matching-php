-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2018 at 03:45 PM
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
-- Database: `test2`
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
(2, 'Kos1', 'Kos Cakra'),
(3, 'Kos2', 'Kos Wibu'),
(4, 'Kos3', 'Kos Otaku'),
(5, 'Kos4', 'Kos Arjuna'),
(6, 'Kos5', 'Kontrakan ã‚„ã‚‰ãªã„ã‹'),
(7, 'Kos6', 'Kontrakan 2'),
(8, 'Kos7', 'ðŸŽŒ Kos'),
(9, 'Kos8', 'Kos ðŸ‡°ðŸ‡·'),
(15, 'Kos9', 'Kos ã•ãã‚‰'),
(19, 'Kos9', 'Kos å®®è„‡ å’²è‰¯');

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
(3, 'AI', 'Jarak', 25),
(15, 'AII', 'Harga', 30),
(16, 'AIII', 'Fasilitas', 30),
(18, 'AIV', 'Suhu ruangan', 15);

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
(26, 3, 'AI1', 'Jarak ke kampus', 7, '1'),
(27, 3, 'AI2', 'Jarak ke perpustakan', 5, '2'),
(28, 15, 'AII1', 'Harga persemester', 8, '1'),
(29, 15, 'AII2', 'Harga pertahun', 6, '1'),
(30, 15, 'AII3', 'Harga perbulan', 5, '2'),
(31, 16, 'AIII1', 'Kulkas', 9, '1'),
(32, 16, 'AIII2', 'TV', 6, '1'),
(33, 16, 'AIII3', 'AC', 5, '2'),
(34, 16, 'AIII4', 'Kamar mandi dalam', 4, '2'),
(35, 18, 'AIV1', 'Suhu siang hari', 7, '1'),
(36, 18, 'AIV2', 'Suhu sore malam hari', 9, '1'),
(37, 18, 'AIV3', 'Suhu pagi sore hari', 4, '2');

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
(232, 2, 26, 9),
(233, 2, 27, 6),
(234, 3, 26, 6),
(235, 3, 27, 7),
(236, 4, 26, 7),
(237, 4, 27, 8),
(238, 5, 26, 7),
(239, 5, 27, 5),
(240, 6, 26, 5),
(241, 6, 27, 6),
(242, 7, 26, 6),
(243, 7, 27, 7),
(244, 8, 26, 7),
(245, 8, 27, 5),
(246, 9, 26, 5),
(247, 9, 27, 7),
(248, 15, 26, 4),
(249, 15, 27, 9),
(250, 19, 26, 5),
(251, 19, 27, 8),
(252, 2, 28, 6),
(253, 2, 29, 7),
(254, 2, 30, 8),
(255, 3, 28, 7),
(256, 3, 29, 7),
(257, 3, 30, 6),
(258, 4, 28, 4),
(259, 4, 29, 7),
(260, 4, 30, 7),
(261, 5, 28, 5),
(262, 5, 29, 7),
(263, 5, 30, 8),
(264, 6, 28, 9),
(265, 6, 29, 8),
(266, 6, 30, 7),
(267, 7, 28, 5),
(268, 7, 29, 8),
(269, 7, 30, 7),
(270, 8, 28, 6),
(271, 8, 29, 9),
(272, 8, 30, 5),
(273, 9, 28, 5),
(274, 9, 29, 8),
(275, 9, 30, 9),
(276, 15, 28, 9),
(277, 15, 29, 8),
(278, 15, 30, 7),
(279, 19, 28, 7),
(280, 19, 29, 6),
(281, 19, 30, 8),
(282, 2, 31, 5),
(283, 2, 32, 5),
(284, 2, 33, 6),
(285, 2, 34, 6),
(286, 3, 31, 6),
(287, 3, 32, 9),
(288, 3, 33, 8),
(289, 3, 34, 4),
(290, 4, 31, 5),
(291, 4, 32, 6),
(292, 4, 33, 7),
(293, 4, 34, 4),
(294, 5, 31, 4),
(295, 5, 32, 5),
(296, 5, 33, 6),
(297, 5, 34, 5),
(298, 6, 31, 7),
(299, 6, 32, 8),
(300, 6, 33, 9),
(301, 6, 34, 4),
(302, 7, 31, 5),
(303, 7, 32, 6),
(304, 7, 33, 7),
(305, 7, 34, 5),
(306, 8, 31, 9),
(307, 8, 32, 5),
(308, 8, 33, 8),
(309, 8, 34, 7),
(310, 9, 31, 6),
(311, 9, 32, 5),
(312, 9, 33, 4),
(313, 9, 34, 7),
(314, 15, 31, 6),
(315, 15, 32, 6),
(316, 15, 33, 6),
(317, 15, 34, 6),
(318, 19, 31, 6),
(319, 19, 32, 9),
(320, 19, 33, 6),
(321, 19, 34, 9),
(322, 2, 35, 5),
(323, 2, 36, 8),
(324, 2, 37, 9),
(325, 3, 35, 5),
(326, 3, 36, 7),
(327, 3, 37, 9),
(328, 4, 35, 6),
(329, 4, 36, 9),
(330, 4, 37, 6),
(331, 5, 35, 9),
(332, 5, 36, 6),
(333, 5, 37, 9),
(334, 6, 35, 8),
(335, 6, 36, 4),
(336, 6, 37, 9),
(337, 7, 35, 6),
(338, 7, 36, 4),
(339, 7, 37, 8),
(340, 8, 35, 6),
(341, 8, 36, 8),
(342, 8, 37, 7),
(343, 9, 35, 6),
(344, 9, 36, 9),
(345, 9, 37, 9),
(346, 15, 35, 9),
(347, 15, 36, 8),
(348, 15, 37, 7),
(349, 19, 35, 5),
(350, 19, 36, 5),
(351, 19, 37, 6);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_profile`
--
ALTER TABLE `tbl_profile`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

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
