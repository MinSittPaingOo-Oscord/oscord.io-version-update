-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2026 at 01:12 AM
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
-- Database: `oscord`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `profile` int(11) DEFAULT NULL,
  `country` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passcode` varchar(100) NOT NULL,
  `telegram` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(20) NOT NULL,
  `registerDateTime` datetime NOT NULL,
  `session_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `name`, `profile`, `country`, `email`, `passcode`, `telegram`, `birthday`, `phone`, `registerDateTime`, `session_token`) VALUES
(1, 'Aeint', NULL, 'Myanmar', 'aeint@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@n_iaeintmm', '2005-04-10', '09408811141', '2025-05-28 00:00:00', '33b571dc4bc026e45052175ded89a7ae4c7b7fab6fdd9a2ce4f3026825696c48'),
(2, 'Phyu Phyu Thant', NULL, 'Myanmar', 'phyuphyut119@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@t92nt', '2004-09-29', '09886058500', '2025-06-12 00:00:00', NULL),
(3, 'NAING NINE', NULL, 'Japan', 'naingosaka121212@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'eccnn9898', '2002-05-25', '07091423223', '2025-06-14 00:00:00', NULL),
(4, 'Merry Moe', NULL, 'Thailand', 'merrymoe345@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@merrymoe', '1984-01-13', '9952090401', '2025-06-14 00:00:00', NULL),
(5, 'Naw The\' Phyu', NULL, 'Thailand', 'nawthephyu@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@Charoen_Rasamee', '1994-02-14', '+66613607287', '2025-06-14 00:00:00', NULL),
(6, 'Phoo Myat Thwe', NULL, 'Myanmar', 'phoomyatthwe@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@H_ffe9ef', '2004-06-14', '09778654804', '2025-06-14 00:00:00', NULL),
(7, 'Janet', NULL, 'Sweden', 'nawjanet16@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'NJ', '1996-09-06', '+46733620774', '2025-06-14 00:00:00', NULL),
(8, 'Phyo Zin May', NULL, 'Japan', 'phyozinmay@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@Snowie_e', '1996-01-15', '+959250269248', '2025-06-15 00:00:00', 'cac9a6ff3d69af2162b07280b300cdb635f7e98c1d054456d66a4fded59cce32'),
(9, 'San Lin Bay', NULL, 'Thailand', 'sanlinbay@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@Sanlinbay', '1995-06-15', '0656506242', '2025-06-15 00:00:00', NULL),
(10, 'Nyi Nyi Htet', NULL, 'Singapore', 'nyinyihtet@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@nyinyihtet', '1988-06-15', '+6581618011', '2025-06-15 00:00:00', NULL),
(11, 'Hein Htet', NULL, 'Singapore', 'heinhtet@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@henry845879', '1998-02-15', '+66824762618', '2025-06-15 00:00:00', NULL),
(13, 'Nay Lin Thar', NULL, 'Myanmar', 'naylinthar@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@ellegigle', '1998-06-10', '09785925304', '2025-06-15 00:00:00', NULL),
(14, 'Nan May OO Myint', NULL, 'Singapore', 'naymayoomyint@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@nanmayoomyint', '1990-06-15', '+6591455714', '2025-06-15 00:00:00', NULL),
(15, 'So Pyay', NULL, 'Singapore', 'sopyay@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@sopyay', '1990-06-22', '+6598613482', '2025-06-15 00:00:00', NULL),
(16, 'Zayar Oo', NULL, 'Singapore', 'zayaroo@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@zayaroo', '1979-06-18', '+6597247756', '2025-06-15 00:00:00', NULL),
(17, 'Thaw Zin Latt', NULL, 'Myanmar', 'thawzinlatt@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@thawzinlatt', '2008-06-15', '+959967993562', '2025-06-15 00:00:00', NULL),
(18, 'Pyae Hein', NULL, 'Kuweit', 'pyaehein@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@pyaehein', '1984-02-15', '+96596645418', '2025-06-15 00:00:00', NULL),
(19, 'Aye Nadi Kyaw', NULL, 'Myanmar', 'ayenadikyaw@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@ayenadikyaw', '1984-06-15', '09428939200', '2025-06-15 00:00:00', NULL),
(20, 'Zaw Thura Soe', NULL, 'Myanmar', 'zawthurasoe@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@zatthuras', '2007-02-15', '09449536467', '2025-06-15 00:00:00', NULL),
(21, 'Christopher', NULL, 'America', 'christopher@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@christopher', '1989-06-21', '+14435099545', '2025-06-15 00:00:00', NULL),
(22, 'Bhone Wai Yan Moe', NULL, 'Vietnam', 'bhonewaiyan@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@bhonewaiyan', '2004-01-15', '09420065505', '2025-06-15 00:00:00', NULL),
(23, 'Myat Min Thu', NULL, 'Myanmar', 'myatminthu@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@myatminthu', '1995-02-15', '09974102510', '2025-06-15 00:00:00', NULL),
(24, 'Hnin Kabyar Tun', NULL, 'Thailand', 'hninkabyartun@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@hninkabyartun', '2000-06-15', '+66949611269', '2025-06-15 00:00:00', NULL),
(25, 'YaMin', NULL, 'Japan', 'yamin@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@yamin', '1989-06-15', '+817041269937', '2025-06-15 00:00:00', NULL),
(26, 'Htoo Aung Cho', NULL, 'Korea', 'htooaungcho@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@HAungC', '1998-06-15', '+821073929907', '2025-06-15 00:00:00', NULL),
(27, 'Ma Kyi Lin Thant', NULL, 'Myanmar', 'kylo.lalista2022@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'Elowen Hayes', '2012-04-30', '09650597711', '2025-07-06 00:00:00', NULL),
(28, 'Tayaw Pai Ko', NULL, 'Myanmar', 'tayawpaiko379@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'Htayaw', '2001-09-29', '0948023200', '2025-07-07 00:00:00', NULL),
(29, 'Hein Min Htet', NULL, 'Myanmar', 'htetheinmin132@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@hein25555', '2000-12-29', '09966731804', '2025-07-12 00:00:00', NULL),
(30, 'Yoon Yati Htut', NULL, 'Myanmar', 'yoon41105@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'Oliva Yoon', '2004-06-11', '09965559689', '2025-07-12 00:00:00', NULL),
(31, 'Ma Yamin Khaing', NULL, 'Myanmar', 'yaminkhaing2210@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'Yamin_75', '2003-10-22', '09785567496', '2025-07-12 00:00:00', NULL),
(32, 'Swe Lae Nandar', NULL, 'Myanmar', 'swelaenandar0415@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'swelae0415', '2005-04-15', '09672740155', '2025-07-12 00:00:00', NULL),
(33, 'Htay Linn Kyaw', NULL, 'Korea', 'htaylinaung.wka@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '태활', '2002-03-30', '01084209991', '2025-07-15 00:00:00', NULL),
(34, 'Yin Myat Theint', NULL, 'Japan', 'yinmyattheint.ymt@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'Kaw kaw', '1996-05-27', '09977170596', '2025-07-19 00:00:00', NULL),
(35, 'Leon', NULL, 'Thailand', 'mrlonely1711ken@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@Leowiet_ken', '2007-10-13', '0809234510', '2025-07-25 00:00:00', NULL),
(36, 'Khwann', NULL, 'Thailand', 'khawnn@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@Khawnn', '2002-06-13', '09762885331', '2025-07-28 00:00:00', NULL),
(37, 'Htin Aung Moe', NULL, 'Qatar', 'htinaungmoe@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@HtinAungMoe', '1998-06-28', '+97433202360', '2025-07-28 00:00:00', NULL),
(38, 'Zwe Lin Htut', NULL, 'Singapore', 'zwelinhtut@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@zwelinhtut', '1999-06-15', '09454450419', '2025-07-28 00:00:00', NULL),
(39, 'Hsu Myat San', NULL, 'America', 'hsumyatsan@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@hsumyatsan', '2005-02-28', '440-876-4294', '2025-07-28 00:00:00', NULL),
(40, 'Mya Thet Mon', NULL, 'Singapore', 'myathetmon@gmai.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@myatthetmon', '2005-01-12', '00000000001', '2025-07-28 00:00:00', NULL),
(41, 'Hnin Nu', NULL, 'Singapore', 'hninnu@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@hninnu', '1992-06-28', '98577726', '2025-07-28 00:00:00', NULL),
(42, 'AUNG AUNG LWIN', NULL, 'Myanmar', 'aungaunglwin2061999@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'AUNG AUNG LWIN', '1999-06-20', '090-8328-7025', '2025-08-03 00:00:00', NULL),
(43, 'Linn Lett Eain', NULL, 'Myanmar', 'linnletteain7@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'linnlett_7', '2025-12-17', '09 892474744', '2025-10-06 00:00:00', NULL),
(44, 'Riki', NULL, 'Myanmar', 'zin164268@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@riki983', '2000-09-04', '09964899660', '2025-11-10 00:00:00', NULL),
(45, 'Thet Htar San', NULL, 'Korea', 'thetsan1102@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@fiona1102', '2002-11-10', '09975723762', '2025-11-21 00:00:00', NULL),
(46, 'Ash', NULL, 'Ireland', 'htetookhin20@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@aitchezone', '2000-01-29', '0634901306', '2025-11-26 00:00:00', NULL),
(47, 'Pann Moh Moh Phyu', NULL, 'Myanmar', 'pannmohmohphyu@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'jill254_02', '2002-04-25', '07044808145', '2025-12-29 00:00:00', NULL),
(48, 'Hla Bhone Han', NULL, 'Singapore', 'hlaphonehan66@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'Hla Bhone Han', '2004-01-15', '+6585856697', '2026-01-02 00:00:00', NULL),
(49, 'MAY YAMONE PHOO', NULL, 'Japan', 'phoo966phoo@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'phoo22phoo', '1996-05-09', '+818013793610', '2026-01-12 00:00:00', '1a826c650bbc0b59412c95b3be43a9ae4677f0058b98ca2fc16d0341568f2447'),
(50, 'Kyaw Naing Win', NULL, 'Myanmar', 'knw767@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'Kyaw Naing Win', '2002-04-09', '09689976087', '2026-02-04 00:00:00', NULL),
(51, 'Hnin Thiri Aung', NULL, 'Japan', 'hninthriaung009@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'Hninthiriaung16', '2000-09-16', '08075268991', '2026-02-22 00:00:00', NULL),
(52, 'MAY THUZAR NYEIN', NULL, 'Japan', 'nyeinmaythuzar@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'nyein110718', '1997-10-09', '08090991127', '2026-02-22 00:00:00', NULL),
(53, 'David Khai Zo Tuang', NULL, 'Malaysia', 'davidkhaizothuang@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@DvKZT', '2000-05-25', '+601169905048', '2026-03-14 00:00:00', NULL),
(54, 'Ye Min Tun', NULL, 'Myanmar', 'tunyemin99420@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@pluviosmith', '1999-05-12', '09250270814', '2026-04-17 00:00:00', NULL),
(55, 'Min Thway Khant', NULL, 'Myanmar', 'minthway321@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'Iruma suzuki', '2000-03-06', '0947204232', '2026-05-04 00:00:00', NULL),
(56, 'Phyu Phyu Thant', NULL, 'Thailand', 'massmix111@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@Coracaroline11', '2005-03-03', '+66(9)42529215', '2026-05-10 00:00:00', 'e219b0160290ff1103b72ffa7c927cc072e3ccdd2c1328287d606ea5502ea752'),
(62, 'Moe Theigi Kyaw', NULL, 'Myanmar', 'moetheigikyaw@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@moetheigikyaw', '2005-06-15', '09954872198', '2025-06-15 00:00:00', NULL),
(64, 'Naing Soe Ag', NULL, 'Thailand', 'naingsoeag@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@naingsoeag', '1997-06-15', '07091779006', '2025-06-15 00:00:00', NULL),
(65, 'Myat Min Thu', NULL, 'Singapore', 'myatminthu2@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@myatminthu', '1995-02-15', '09974102510', '2025-06-15 00:00:00', NULL),
(66, 'Thiha Min Htin', NULL, 'Myanmar', 'thiha@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@thiha', '2000-06-15', '09957316840', '2025-06-15 00:00:00', NULL),
(67, 'Aye Myat Mon', NULL, 'Myanmar', 'ayemyatmon@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@ayemyatmon', '2002-02-15', '09790341692', '2025-06-15 00:00:00', NULL),
(68, 'Khin LaPyae Won', NULL, 'Thailand', 'khinlapyawwon@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@khinlapyae', '2003-02-15', '', '2025-06-15 00:00:00', NULL),
(69, 'YaMin Oo', NULL, 'Thailand', 'yaminoo@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@yaminoo', '2003-02-15', '', '2025-06-15 00:00:00', NULL),
(70, 'Shwe Zin', NULL, 'Myanmar', 'shwezin@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@shwezin', '1997-06-15', '', '2025-06-15 00:00:00', NULL),
(71, 'Sandah Aung', NULL, 'Thailand', 'sandahaung@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@sahdahaung', '1977-06-15', '', '2025-06-15 00:00:00', NULL),
(72, 'Min Thant Wai', NULL, 'Thailand', 'minthantwai@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@minthantwait', '1999-06-15', '', '2025-06-15 00:00:00', NULL),
(73, 'N Seng', NULL, 'Thailand', 'nseng@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@nseng', '1989-06-15', '', '2025-06-15 00:00:00', '47648b8643eea8b1ca82af32d48e6f7223f50486f55cfde8091cc0a7a20b9b10'),
(74, 'Thun Thiri Khin', NULL, 'Thailand', 'thunthirikhaing@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@thunthirikhaing', '2006-06-15', '09769889233', '2025-06-15 00:00:00', NULL),
(75, 'Okkar Min', NULL, 'Thailand', 'okkarmin@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@okkarmin', '2001-02-15', '0960564932', '2025-06-15 00:00:00', NULL),
(76, 'Khon LaYaung Win', NULL, 'Myanmar', 'khonlayaungwin@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@LeonLY7', '2000-01-15', '', '2025-06-15 00:00:00', NULL),
(77, 'Honey Aye', NULL, 'Japan', 'honeyaye@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@honeyaye', '1993-06-15', '+817084522233', '2025-06-15 00:00:00', NULL),
(78, 'Thet Oo Ag', NULL, 'Thailand', 'thetooag@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@thetooag', '2001-01-15', '+959698949363', '2025-06-15 00:00:00', NULL),
(79, 'Min Khant', NULL, 'Japan', 'minkhant@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@minkhant', '2004-01-15', '09070057005', '2025-06-15 00:00:00', NULL),
(80, 'Wai Yan Htet Naing', NULL, 'Thailand', 'waiyanhtetnaing2020@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', 'RhythmR_Kee Nolan', '1990-02-05', '09420015800', '2025-07-05 00:00:00', NULL),
(81, 'San San Aye', NULL, 'Finland', 'sansanaye@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@sansanaye', '1990-02-06', '+358469653868', '2025-07-06 00:00:00', NULL),
(82, 'Yan Paing Oo', NULL, 'Thailand', 'yanpaingoo@gmail.com', '$2y$10$UkA/oOp4cFCjhPF1ak1xL.e4iC5p5x3tuhXRjakq/zTv1oTYvkyLm', '@igzy_yan', '1990-04-06', '+66813151888', '2025-07-06 00:00:00', NULL),
(84, 'Kaung Khant Thaw', NULL, 'Myanmar', 'kaungkhantthaw087@gmail.com', '$2y$10$z6PqNSRAQb5UABKt/POh2OATdhOZ.jBlxQAHAV55aT3E0lC7w0.iG', '@Kkthaw123', '2005-04-11', '+66936499267', '2026-05-30 00:12:08', '90b4ea6fd392bd674b2e0207a2bc5922940daf19e8a9268c2475d594d12bfad7');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `pin` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `answerID` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `fileID` int(11) DEFAULT NULL,
  `linkID` int(11) DEFAULT NULL,
  `assignmentID` int(11) NOT NULL,
  `type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `openDateTime` datetime NOT NULL,
  `endDateTime` datetime NOT NULL,
  `point` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` int(11) NOT NULL,
  `batchNumber` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `schedule` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL,
  `seat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `batchNumber`, `courseID`, `startDate`, `endDate`, `schedule`, `status`, `seat`) VALUES
(2, 3, 35, '2025-07-26', '2026-01-26', 'Every Sat + Sun\n7:00 pm to 8:00 pm (Myanmar Time)', 'Completed', 0),
(3, 4, 35, '2025-12-12', '2026-06-12', 'Every Friday to Sunday\r\n8:00 pm to 9:00 pm (Myanmar Time)', 'In Progress', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Popular'),
(2, 'Web Development'),
(3, 'Beginner Friendly'),
(4, 'Intermediate'),
(5, 'Advanced');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `fee` double NOT NULL,
  `period` varchar(100) NOT NULL,
  `fbLink` varchar(500) NOT NULL,
  `description` longtext NOT NULL,
  `sort` int(11) NOT NULL,
  `photoID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `fee`, `period`, `fbLink`, `description`, `sort`, `photoID`) VALUES
(27, 'Java Programming (Basic to Advanced)', 450000, '4 months to 5 months', 'https://www.facebook.com/share/p/1LPb87aW6u/', 'Java Programming ကို အခြေခံ Basic Syntax တွေကစပြီး Database ဖြင့် Project ရေးနိုင်သည်အထိ သင်ယူရမဲ့ Oscord Code Academy ရဲ့  Java Programming (Basic to Advanced) Class \r\nဘာတွေ သင်ယူရမလဲ..? \r\nပထမဆုံးအနေနဲ့  Java Programming ကို အခြေခံကနေစ Java Syntax၊ OOP Concepts (Classes & Objects)၊ Exception Handling၊ File Handling စတဲ့ Fundamental အားလုံးကို ကျွမ်းကျင်ပိုင်နိုင်စေဖို့ Module တစ်ခုချင်းစီမှာ Exercise တွေ ၊ Practice တွေ Simple Project တွေ ပါဝင်ပါတယ်။\r\nဒုတိယအနေနဲ့ Software Developer တိုင်း ကျွမ်းကျင်ပိုင်နိုင်ဖိုလိုအပ်တဲ့ Database Design ဆွဲနည်း , Normalization နှင့် Database Query ရေးနည်းတွေကိုပါထည့်သွင်းသင်ကြားသွားမှာပါ\r\nတတိယ အနေနဲ့   Java Language ကို အသုံးပြုပြီး  Database ထဲက Data တွေကို Create/ Read/Update/Delete စတဲ့ Operation တွေကို Run နိုင်မဲ့ CRUD Application တစ်ခုကို MY SQL ဖြင့် ရေးသားနိုင်ဖို သင်ကြားပေးသွားမှာပါ။\r\nနောက်ဆုံးမှာတော့ Backend System တစ်ခုကိုကျွမ်းကျင်ပိုင်နိုင်စွာ ဖန်တီးတတ်စေဖို့ ကျောင်းသားနှစ်သက်ရာ Management system application တစ်ခုခုကို ဆရာဖြင့်အတူတူရေးသားဖန်တီးနိုင်ခြင်းဖြင့် မည်သည့် Software အမျိုးအစားကိုမဆို ဖန်တီးနိုင်သွားတဲ့ အရည်အချင်းတွေကိုပိုင်ဆိုင်သွားမှာဖြစ်ပါတယ်', 1, NULL),
(28, 'Python Programming (Basic to Advanced)', 500000, '4 months to 5 months', 'https://www.facebook.com/share/v/18G7M76U5D/', 'Python Programming ကို အခြေခံ Basic Syntax တွေကစပြီး Database MY SQL သာမက MongoBD တိုကိုလည်းသုံးပြီး CURD Project တွေရေးနိုင်သည်အထိ သင်ယူရမဲ့ Oscord Code Academy ရဲ့ Python Programming (Basic to Master) Class\r\nဒီအတန်းရဲ့ အဆုံးတွင် CRUD မှာတင်ရပ်သွားမှာမဟုတ်ဘဲ Final Project အနေဖြင့် Software Development ရဲ့ ရူပ်ထွေးတယ်လို လူသိများတဲ့ Backend System တစ်ခုကို သေချာစွာ Develop လုပ်နိုင်စေဖို POS application တစ်ခုကိုဆရာနဲ့ အတူတူဖန်တီးသွားမှာဖြစ်ပါတယ်', 2, NULL),
(29, 'Database Systems and Design(MY SQL)', 230000, '3 months', 'https://www.facebook.com/share/p/1KHJnBkWwA/', 'Learn how the database management system works , how to design a physical database starting from Conceptual database design and Logical database design, using it in application', 6, NULL),
(30, 'Web Design Foundation', 290000, '3 months', 'https://www.facebook.com/share/p/1CQCYsUsG1/', 'Kickstart your front-end web development journey with our beginner-friendly course! Learn to create stunning, interactive websites using HTML, CSS, Bootstrap and JavaScript. Through hands-on projects, you’ll build responsive web pages that shine on any device, gaining skills to launch a tech career or bring your ideas to life. All you need is basic computer knowledge and a passion for design!', 7, NULL),
(31, 'Backend Web Engineering & Design', 330000, '3 months', 'https://www.facebook.com/share/p/1CQCYsUsG1/', 'Launch your backend web development career with our beginner-friendly course! Learn to build powerful, secure server-side applications using tools like PHP...', 7, NULL),
(32, 'Desktop Application Developmet with C#.Net', 390000, '3 months to 4 months', 'https://www.facebook.com/share/p/1AQNx1RBEt/', 'Join Our C#.NET Fundamentals Course! Master C# programming from scratch and build practical desktop apps...', 8, NULL),
(33, 'C Programming', 250000, '3 months', 'https://www.facebook.com/share/p/1D5W1k541w/', 'Learning programming with C from basic easily and focusing on basic programming concepts', 9, NULL),
(34, 'C ++ Programming', 200000, '2 months', 'https://www.facebook.com/share/p/1D5W1k541w/', 'In this course, you will learn the basic programming concepts with C++ Programming', 10, NULL),
(35, 'Full Stack Web Developer Class', 600000, '6 months', 'https://www.facebook.com/share/p/1CQCYsUsG1/', 'Web Development ကို စိတ်ဝင်စားတဲ့သူတိုင်းအတွက် အခြေခံ Frontend Level ကနေစပြီး လုပ်ငန်းခွင်မှာ တကယ်အသုံးဝင်တဲ့ Backend Development နဲ့ Database တွေအထိ လက်တွေ့ကျကျ ရေးသားနိုင်အောင် သင်ပေးသွားမှာပါ။ Code Theory တွေကအစ လက်တွေ့ Project တွေထိ အကုန်ပါဝင်မှာဖြစ်ပါတယ်။ \r\nWebsite တစ်ခုကို Internet ပေါ်မှာ ကိုယ်ပိုင် Domain နှင့်တင်နိုင်တဲ့အထိ သင်ပြသွားမှာဖြစ်ပါတယ် Final Project မှာ ကိုယ်စိတ်ကြိုက် LMS, Ecommerence, POS system စသဖြင့် ကြိုက်တဲ့ Web Project တစ်ခုကို ဆရာနဲ့အတူ အစအဆုံး ရေးသားရမှာ ဖြစ်ပြီး၊ Project မစခင် ဆရာက နမူနာတစ်ခုကို အရင်ဆုံး သင်ပြပေးသွားမှာပါ', 3, NULL),
(36, 'Data Structure and algorithms', 270000, '3 months', 'www.facebook.com/oscordCodeAcademy', 'Explore coding with our beginner-friendly Data Structures and Algorithms course! Learn to organize data, solve problems, and write efficient code through hands-on projects. Perfect for landing tech jobs or acing coding interviews. All you need is basic programming knowledge!', 11, NULL),
(37, 'Applied Mathematics for Data Science & Machine Learning with Python', 330000, '4 months to 5 months', 'https://www.facebook.com/share/p/1ZGd7qTMAR/', 'Data Science/ Machine Learning နှင့် AI နည်းပညာတွေကို အဓိက ကူညီပံ့ပို့းပေးနေတဲ့ သင်္ချာပညာ Theoryတွေကို Computer Science ရူထောင့်ကနေ သင်ကြားမှာဖြစ်ပါတယ်\r\nModule တစ်ခုပြီးတိုင်း theory များကို Python Programming ကိုအသုံးပြုပြီးတော့ လက်တွေ့အသုံးချသွားမှာဖြစ်ပါတယ်\r\nဒီ Course မှာ သင်္ချာပညာရပ်ဟာ Computer Science နယ်ပယ်မှာဘယ်လောက်ထိအရေးပါလဲဆိုတာကို လက်တွေ့ Code ရေးပြီးသင်ကြားသွားမှာဖြစ်ပါတယ်', 7, NULL),
(38, 'Full Stack Revolution with React & Laravel', 440000, '3 months', 'https://www.facebook.com/share/p/1EsM6VaMvQ/', 'Master full-stack development with React and Laravel in this hands-on course. Learn React fundamentals, hooks, Redux, and API integration, paired with Laravel’s MVC, Eloquent ORM, and RESTful APIs. Build a task management system while exploring security with Sanctum, JWT, and role-based access. Ideal for advanced learners aiming to create modern, scalable web applications.', 5, NULL),
(39, 'Data Science Essential', 450000, '3 months', 'https://www.facebook.com/share/p/1DHff8nssF/', 'AI နည်းပညာခေတ်ကို ဦးဆောင်မယ့် အခြေခံအုတ်မြစ်ဖြစ်တဲ့ 𝐃𝐚𝐭𝐚 𝐒𝐜𝐢𝐞𝐧𝐜𝐞 𝐄𝐬𝐬𝐞𝐧𝐭𝐢𝐚𝐥 𝐂𝐥𝐚𝐬𝐬\r\nလက်ရှိခေတ်ရဲ့ အရေးပါဆုံး နည်းပညာနယ်ပယ်တွေဖြစ်တဲ့ 𝐀𝐈, 𝐌𝐚𝐜𝐡𝐢𝐧𝐞 𝐋𝐞𝐚𝐫𝐧𝐢𝐧𝐠, 𝐃𝐞𝐞𝐩 𝐋𝐞𝐚𝐫𝐧𝐢𝐧𝐠, နှင့် 𝐑𝐨𝐛𝐨𝐭𝐢𝐜𝐬 တို့ရဲ့ အဓိကသော့ချက်ဟာ 𝐃𝐚𝐭𝐚 𝐒𝐜𝐢𝐞𝐧𝐜𝐞 ပဲ ဖြစ်ပါတယ်။ \r\nအဲဒီလိုခေတ်မီနည်းပညာတွေကို စတင်သင်ယူဖို့အတွက် 𝐅𝐨𝐮𝐧𝐝𝐚𝐭𝐢𝐨𝐧𝐚𝐥 𝐂𝐨𝐫𝐞 𝐓𝐡𝐞𝐨𝐫𝐲 ကို အခြေခံအုတ်မြစ်ခိုင်မာအောင် တည်ဆောက်ပေးမယ့် ဒီသင်တန်းကို 𝐎𝐬𝐜𝐨𝐫𝐝 𝐂𝐨𝐝𝐞 𝐀𝐜𝐚𝐝𝐞𝐦𝐲 မှာတက်ရောက်သင်ယူနိုင်ပါပြီ \r\nဘာတွေသင်ယူရရှိမလဲ...?\r\nData Science ဟာ အစီအစဉ်မကျဖြစ်နေတဲ့ Raw Data တွေကို တန်ဖိုးရှိတဲ့ အချက်အလက် (Insights) တွေအဖြစ် ပြောင်းလဲပေးတဲ့ လုပ်ငန်းစဉ်တစ်ခုပါ။ ဒီ Course မှာ အဆိုပါလုပ်ငန်းစဉ်ရဲ့ အရေးအကြီးဆုံး Concept များကို လက်တွေ့ကျကျ သင်ကြားပေးသွားမှာဖြစ်ပါတယ်။\r\nData Science ရဲ့ အရေးပါတဲ့ အဆင့်တွေအနေနဲ့ \r\n👾𝐃𝐚𝐭𝐚 𝐂𝐥𝐞𝐚𝐧𝐢𝐧𝐠 & 𝐏𝐫𝐞𝐩𝐫𝐨𝐜𝐞𝐬𝐬𝐢𝐧𝐠\r\nအပေါက်များ (Missing Values) ပါဝင်နေသော၊ မလိုအပ်သော၊ ရောနှောနေသော Data များကို စနစ်တကျ ပြင်ဆင်ခြင်း၊ ခန့်မှန်းဖြည့်သွင်းခြင်းနှင့် ဖယ်ရှားခြင်း။\r\n👾 𝐃𝐚𝐭𝐚 𝐓𝐫𝐚𝐧𝐬𝐟𝐨𝐫𝐦𝐚𝐭𝐢𝐨𝐧\r\nData များကို တွက်ချက်နိုင်သော ပုံစံ (Standardization & Normalization) များအဖြစ် ပြောင်းလဲခြင်း။\r\n👾 𝐂𝐥𝐮𝐬𝐭𝐞𝐫𝐢𝐧𝐠 (အုပ်စုခွဲခြင်း)\r\nမတူညီသော Data များကို Distance/Similarity ကို အသုံးပြုပြီး (Hierarchical, K-Means, DB Scan) နည်းလမ်းများဖြင့် အုပ်စုခွဲခြားခြင်း။\r\n👾𝐀𝐬𝐬𝐨𝐜𝐢𝐚𝐭𝐢𝐯𝐞 𝐑𝐮𝐥𝐞 𝐌𝐢𝐧𝐢𝐧𝐠 \r\nဥပမာ- Online Shop တွင် ဝယ်ယူသူများ ဘယ်ပစ္စည်းနှင့် ဘယ်ပစ္စည်းကို တွဲဖက်ဝယ်ယူတတ်ကြောင်း တွက်ချက်ခြင်း။\r\n👾𝐒𝐮𝐩𝐞𝐫𝐯𝐢𝐬𝐞𝐝 𝐌𝐚𝐜𝐡𝐢𝐧𝐞 𝐋𝐞𝐚𝐫𝐧𝐢𝐧𝐠\r\n ရှိနှင့်ပြီးသား Data များမှ သင်ယူစေပြီး အနာဂတ်ရလဒ်များကို ခန့်မှန်းတွက်ချက်နိုင်သော Rule များ (ဥပမာ- ID3, C4.5 Classifier) ကို ဖော်ထုတ်ခြင်းတို့ကို စနစ်တကျလေ့လာသင်ယူရမှာဖြစ်ပါတယ် ', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coursexcategory`
--

CREATE TABLE `coursexcategory` (
  `id` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coursexcategory`
--

INSERT INTO `coursexcategory` (`id`, `courseID`, `categoryID`) VALUES
(24, 27, 1),
(25, 27, 3),
(26, 28, 1),
(27, 28, 3),
(28, 29, 3),
(29, 29, 4),
(30, 30, 2),
(31, 30, 3),
(32, 31, 2),
(33, 31, 4),
(34, 32, 3),
(35, 32, 4),
(36, 33, 3),
(37, 34, 3),
(38, 35, 1),
(39, 35, 2),
(40, 36, 3),
(41, 36, 4),
(42, 37, 4),
(43, 38, 2),
(44, 38, 4),
(45, 39, 3),
(46, 39, 4);

-- --------------------------------------------------------

--
-- Table structure for table `course_detail`
--

CREATE TABLE `course_detail` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sort` int(11) NOT NULL,
  `courseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_detail`
--

INSERT INTO `course_detail` (`id`, `name`, `sort`, `courseID`) VALUES
(174, 'Introduction to Java Programming', 1, 27),
(175, 'Variable and datatypes', 2, 27),
(176, 'Datatype Conversion', 3, 27),
(177, 'Operators in Java', 4, 27),
(178, 'User Input in Java', 5, 27),
(179, 'Decision Making and Conditional Statement', 6, 27),
(180, 'Loopings in Java', 7, 27),
(181, 'Functions in Java', 8, 27),
(182, 'Object Orientend Programming in Java', 9, 27),
(183, 'Character, String & StringBuffer Class', 10, 27),
(184, 'Exception Handling', 11, 27),
(185, 'File Handling in Java(IO)', 12, 27),
(186, 'Utility and collection classes', 13, 27),
(187, 'Database Systems and Design foundation', 14, 27),
(188, 'CRUD Project with Java (MY SQL)', 15, 27),
(189, 'Final Management System Project', 16, 27),
(190, 'Introduction to Python Programming', 1, 28),
(191, 'Variables and Datatypes', 2, 28),
(192, 'Type Conversion', 3, 28),
(193, 'Operators in Python', 4, 28),
(194, 'Python String', 5, 28),
(195, 'Conditional Statments', 6, 28),
(196, 'Loopings in Python', 7, 28),
(197, 'Python core datatypes - Tuple, List, Set, Dictionary', 8, 28),
(198, 'Object Oriented Programming', 9, 28),
(199, 'Exception Handling', 10, 28),
(200, 'File Handling in Python', 11, 28),
(201, 'Database Systems and Design (MY SQL)  - Complete Course', 12, 28),
(202, 'CRUD Project with Database MYSQL', 13, 28),
(203, 'CRUD Project with MongoDB NoSQL', 14, 28),
(204, 'Final Management System Project with Python', 15, 28),
(205, 'Conceptual Database Design', 1, 29),
(206, 'Logical Database Design', 2, 29),
(207, 'Normalization Project', 3, 29),
(208, 'Physical Database Design', 4, 29),
(209, 'Structure query language(DML, DDL, DCL, TCL)', 5, 29),
(210, 'Calculating Statement in query language', 6, 29),
(211, 'MY SQL Functions', 7, 29),
(212, 'Querying Multiple tables', 8, 29),
(213, 'Database System Environment using AWARDSPACE', 9, 29),
(214, 'CRUD Control Flow with PHP', 10, 29),
(215, 'Final Backend Application Project', 11, 29),
(216, 'HTML', 1, 30),
(217, 'CSS', 2, 30),
(218, 'JavaScript', 3, 30),
(219, 'Bootstrap', 4, 30),
(220, 'Frontend Web Project', 5, 30),
(221, 'Database Design & Systems (MY SQL)', 1, 31),
(222, 'PHP Programming (Basic to Advanced)', 2, 31),
(223, 'Simple CRUD backend project', 3, 31),
(224, 'Introduction to Laravel Framework', 4, 31),
(225, 'Final Web Application Project', 5, 31),
(226, 'Complete C# Fundamental Course', 1, 32),
(227, 'Introduction to C#.Net Framework - adding control to a blank form', 2, 32),
(228, 'Adding C# code to a button', 3, 32),
(229, 'A C# Messgage Box', 4, 32),
(230, 'Assigning Text to a string variable', 5, 32),
(231, 'Getting Numbers from text boxes', 6, 32),
(232, 'Conditional Logic in C#.Net', 7, 32),
(233, 'Checking blank text boxes in C#', 8, 32),
(234, 'Adding menus to window forms', 9, 32),
(235, 'File Dialogue Boxes in C#.Net', 10, 32),
(236, 'Checkboxes and Radio Buttons', 11, 32),
(237, 'Creating Multiple Forms in C#.Net', 12, 32),
(238, 'Dates and Times in C#', 13, 32),
(239, 'Final Desktop Application Project', 14, 32),
(240, 'Physical Database Design', 15, 32),
(241, 'CRUD Project with Database', 16, 32),
(242, 'Basic Knowledge with C Programming', 1, 33),
(243, 'Vraibles and Datatypes', 2, 33),
(244, 'User Input and Operators in C', 3, 33),
(245, 'Conditional Statments', 4, 33),
(246, 'Looping and Functions', 5, 33),
(247, 'Arrays & Pointers', 6, 33),
(248, 'C String', 7, 33),
(249, 'Basic Knowledge with C++', 1, 34),
(250, 'Variables and Datatypes', 2, 34),
(251, 'User Input & Operators', 3, 34),
(252, 'Conditional Statements', 4, 34),
(253, 'Loopings', 5, 34),
(254, 'Arrays', 6, 34),
(255, 'C++ Structure', 7, 34),
(256, 'C++ Enums', 8, 34),
(257, 'C++ Functions', 9, 34),
(258, 'OOP in C++', 10, 34),
(259, 'HTML', 1, 35),
(260, 'CSS', 2, 35),
(261, 'JavaScript (Basic to Advanced)', 3, 35),
(262, 'Boostrap', 4, 35),
(263, 'Database Systems and Design (MY SQL) - complete course', 5, 35),
(264, 'PHP Programming (Basic to Advanced)', 6, 35),
(265, 'Simple CRUD Project', 7, 35),
(266, 'Introduction to Laravel Framework', 8, 35),
(267, 'How to do website deployment', 9, 35),
(268, 'Final Web Application Project', 10, 35),
(269, 'Introduction to DSA', 1, 36),
(270, 'Array and Linked List', 2, 36),
(271, 'Stack and Queues', 3, 36),
(272, 'Binary Trees and Binary Search Trees', 4, 36),
(273, 'AVL and B-Trees', 5, 36),
(274, 'Graph Algorithms', 6, 36),
(275, 'Algorithm Design Techniques', 7, 36),
(276, 'Sorting and Searching Algorithms', 8, 36),
(277, 'Hash Table', 9, 36),
(278, 'Introduction - How Math can shape Multiverse', 1, 37),
(279, 'Boolean Logic & Propositional Calculus', 2, 37),
(280, 'Set Theory & Relations', 3, 37),
(281, 'Proof Techniques', 4, 37),
(282, 'Graph Representation', 5, 37),
(283, 'Trees', 6, 37),
(284, 'Graph Processing Techniques', 7, 37),
(285, 'Modular Arithmetic', 8, 37),
(286, 'Prime Numbers & GCD', 9, 37),
(287, 'Cryptography', 10, 37),
(288, 'Hash Functions', 11, 37),
(289, 'Algorithms Basics', 12, 37),
(290, 'Sorting & Searching Algorithms', 13, 37),
(291, 'Recursion & Divide & Conquer', 14, 37),
(292, 'Vectors & Matrices', 15, 37),
(293, 'Systems of Linear Equations', 16, 37),
(294, 'Eigenvalues & Eigenvectors', 17, 37),
(295, 'Singular Value Decomposition (SVD)', 18, 37),
(296, 'Probability Basics', 19, 37),
(297, 'Distributions', 20, 37),
(298, 'Basic of Counting', 21, 37),
(299, 'Permutations & Combinations', 22, 37),
(300, 'Advanced Counting Technique', 23, 37),
(301, 'Final Math in Action Project', 24, 37),
(302, 'Introduction to React', 1, 38),
(303, 'React ES6', 2, 38),
(304, 'JSX basics', 3, 38),
(305, 'Functions and Classes', 4, 38),
(306, 'State and Events', 5, 38),
(307, 'Lists and Keys', 6, 38),
(308, 'Forms and Controlled Components', 7, 38),
(309, 'React Router', 8, 38),
(310, 'React Hooks', 9, 38),
(311, 'use Effect and API calls', 10, 38),
(312, 'Context API', 11, 38),
(313, 'Custom Hooks', 12, 38),
(314, 'Advanced Hooks', 13, 38),
(315, 'Tools : Redux or Zustand', 14, 38),
(316, 'Security Features', 15, 38),
(317, 'Introduction to Laravel', 16, 38),
(318, 'Routing and Controllers', 17, 38),
(319, 'Models and Migrations', 18, 38),
(320, 'Basic CRUD Operations', 19, 38),
(321, 'Query Builder Introduction', 20, 38),
(322, 'Advanced Query Builder', 21, 38),
(323, 'Eloquent ORM Introduction', 22, 38),
(324, 'Advanced Eloquent', 23, 38),
(325, 'Building RESTful APIs', 24, 38),
(326, 'API Resources and Transformers', 25, 38),
(327, 'Authentication with Sanctum', 26, 38),
(328, 'JWT Authentication', 27, 38),
(329, 'Middleware Basics', 28, 38),
(330, 'Advanced Middleware and Security', 29, 38),
(331, 'Roles and Permissions', 30, 38),
(332, 'Role-Based Access', 31, 38),
(333, 'Introduction to Data Science', 1, 39),
(334, 'Distance & Similarity', 2, 39),
(335, 'Data', 3, 39),
(336, 'Finding Missing Value in Data Cleaning', 4, 39),
(337, 'Standardization & Normalization', 5, 39),
(338, 'Distance in Clustering', 6, 39),
(339, 'Hierarchical Clustering', 7, 39),
(340, 'K-Means Clustering', 8, 39),
(341, 'DB Scan Clustering', 9, 39),
(342, 'Clustering Evaluation', 10, 39),
(343, 'Associative Rule Mining', 11, 39),
(344, 'Supervised Machine Learning', 12, 39),
(345, 'ID3, Outlook, C4.5 Classifier, Gini Index', 13, 39),
(346, 'Correlation Coefficient', 14, 39);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `isApprove` tinyint(4) NOT NULL,
  `learningType` int(11) NOT NULL,
  `enrollDateTime` datetime DEFAULT NULL,
  `isComplete` tinyint(4) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`id`, `studentID`, `courseID`, `isApprove`, `learningType`, `enrollDateTime`, `isComplete`, `status`, `grade`) VALUES
(1, 2, 27, 1, 2, '2025-05-28 00:00:00', 1, 'GRADUATED', 'A+'),
(2, 2, 35, 1, 2, '2025-05-28 00:00:00', 1, 'GRADUATED', 'A+'),
(3, 3, 27, 1, 2, '2025-06-12 00:00:00', 1, 'GRADUATED', 'A+'),
(4, 3, 35, 1, 2, '2025-06-12 00:00:00', 1, 'GRADUATED', 'A+'),
(5, 4, 27, 1, 2, '2025-06-14 00:00:00', 1, NULL, NULL),
(6, 5, 32, 1, 2, '2025-06-14 00:00:00', 1, NULL, NULL),
(7, 6, 27, 1, 2, '2025-06-14 00:00:00', 1, NULL, NULL),
(9, 7, 27, 1, 2, '2025-06-14 00:00:00', 1, NULL, NULL),
(10, 8, 27, 1, 2, '2025-06-14 00:00:00', 1, NULL, NULL),
(11, 9, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(12, 10, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(13, 10, 30, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(14, 11, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(15, 12, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(18, 14, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(19, 15, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(20, 16, 33, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(21, 17, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(22, 18, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(23, 19, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(24, 20, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(25, 21, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(26, 22, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(27, 23, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(28, 24, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(29, 25, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(30, 26, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(31, 27, 33, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(33, 34, 28, 1, 2, '2025-07-15 00:00:00', 1, NULL, NULL),
(34, 28, 35, 1, 2, '2025-07-06 00:00:00', 1, 'DISAPPEAR', NULL),
(35, 29, 35, 1, 2, '2025-07-07 00:00:00', 1, NULL, NULL),
(37, 31, 27, 1, 6, '2025-07-12 00:00:00', 1, 'GRADUATED', 'A+'),
(38, 32, 27, 1, 6, '2025-07-12 00:00:00', 1, 'GRADUATED', 'A+'),
(39, 33, 27, 1, 6, '2025-07-12 00:00:00', 1, 'GRADUATED', 'A+'),
(41, 35, 27, 1, 2, '2025-07-19 00:00:00', 1, NULL, NULL),
(43, 37, 30, 1, 2, '2025-07-28 00:00:00', 1, 'DISAPPEAR', NULL),
(44, 38, 35, 1, 2, '2025-07-28 00:00:00', 1, NULL, NULL),
(45, 39, 30, 1, 2, '2025-07-28 00:00:00', 1, 'GRADUATED', 'A+'),
(46, 40, 35, 1, 2, '2025-07-28 00:00:00', 1, NULL, NULL),
(47, 41, 28, 1, 2, '2025-07-28 00:00:00', 1, NULL, NULL),
(48, 42, 28, 1, 2, '2025-07-28 00:00:00', 1, 'GRADUATED', 'A+'),
(49, 43, 27, 1, 1, '2025-08-03 00:00:00', 0, 'ONGOING', NULL),
(50, 2, 38, 1, 2, '2025-05-28 00:00:00', 1, 'GRADUATED', 'B+'),
(51, 44, 27, 1, 1, '2025-10-06 00:00:00', 0, 'ONGOING', NULL),
(53, 46, 31, 1, 2, '2025-11-21 00:00:00', 1, NULL, NULL),
(54, 47, 30, 1, 2, '2025-11-26 00:00:00', 1, NULL, NULL),
(55, 48, 35, 1, 2, '2025-12-29 00:00:00', 0, 'ONGOING', NULL),
(56, 49, 33, 1, 2, '2026-01-02 00:00:00', 1, 'LEAVE_WITH_REFUND', NULL),
(57, 50, 35, 1, 2, '2026-01-12 00:00:00', 0, 'ONGOING', NULL),
(58, 52, 27, 1, 6, '2026-02-22 00:00:00', 0, 'ONGOING', NULL),
(59, 53, 27, 1, 6, '2026-02-22 00:00:00', 0, 'ONGOING', NULL),
(60, 51, 35, 1, 1, '2026-02-04 00:00:00', 0, 'ONGOING', NULL),
(61, 54, 28, 1, 2, '2026-03-14 00:00:00', 0, 'ONGOING', NULL),
(62, 55, 35, 1, 1, '2026-04-17 00:00:00', 0, 'ONGOING', NULL),
(63, 33, 35, 1, 1, '2026-04-27 00:00:00', 0, 'ONGOING', NULL),
(64, 56, 35, 1, 2, '2026-05-04 00:00:00', 0, 'ONGOING', NULL),
(65, 57, 35, 1, 4, '2026-05-10 00:00:00', 0, 'ONGOING', NULL),
(132, 67, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(133, 69, 27, 1, 2, '2025-06-15 00:00:00', 1, 'GRADUATED', 'A+'),
(134, 70, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(135, 71, 27, 1, 2, '2025-06-15 00:00:00', 1, 'LEAVE_WITH_REFUND', NULL),
(136, 72, 27, 1, 2, '2025-06-15 00:00:00', 1, 'DISAPPEAR', NULL),
(137, 73, 27, 1, 2, '2025-06-15 00:00:00', 1, NULL, NULL),
(138, 74, 27, 1, 2, '2025-07-15 00:00:00', 1, NULL, NULL),
(139, 75, 27, 1, 2, '2025-07-19 00:00:00', 1, NULL, NULL),
(140, 76, 30, 1, 2, '2025-07-25 00:00:00', 1, NULL, NULL),
(141, 77, 27, 1, 2, '2025-07-28 00:00:00', 1, 'GRADUATED', NULL),
(142, 78, 35, 1, 2, '2025-07-28 00:00:00', 1, 'DISAPPEAR', NULL),
(143, 79, 27, 1, 2, '2025-07-28 00:00:00', 1, 'GRAUDATED', 'A+'),
(144, 80, 28, 1, 2, '2025-07-28 00:00:00', 1, NULL, NULL),
(145, 81, 27, 1, 2, '2025-07-28 00:00:00', 1, 'DISAPPEAR', NULL),
(146, 82, 28, 1, 2, '2025-07-28 00:00:00', 1, NULL, NULL),
(147, 83, 27, 1, 2, '2025-08-03 00:00:00', 1, NULL, NULL),
(148, 84, 27, 1, 2, '2025-10-06 00:00:00', 1, 'DISAPPEAR', 'F'),
(149, 85, 28, 1, 2, '2025-11-10 00:00:00', 1, NULL, NULL),
(150, 86, 28, 1, 2, '2025-05-01 00:00:00', 1, NULL, NULL),
(151, 87, 27, 1, 2, '2025-03-06 00:00:00', 1, 'DISAPPEAR', 'F'),
(152, 77, 35, 1, 2, '2025-02-17 19:56:05', 1, 'DISAPPEAR', 'F'),
(155, 89, 29, 0, 2, '2026-05-30 00:14:42', 0, 'ENROLLED', NULL),
(157, 2, 28, 0, 4, '2026-05-31 21:20:05', 0, 'ENROLLED', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `file` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_class_enrollment`
--

CREATE TABLE `group_class_enrollment` (
  `id` int(11) NOT NULL,
  `batchID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `enrollDateTime` datetime NOT NULL,
  `isApprove` tinyint(4) NOT NULL,
  `isComplete` tinyint(4) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group_class_enrollment`
--

INSERT INTO `group_class_enrollment` (`id`, `batchID`, `studentID`, `enrollDateTime`, `isApprove`, `isComplete`, `grade`, `status`) VALUES
(7, 3, 45, '2025-11-10 00:00:00', 1, 1, 'F', 'DISAPPEAR'),
(8, 2, 36, '2025-07-25 00:00:00', 1, 1, 'A+', 'GRADUATED'),
(9, 2, 30, '2025-07-12 00:00:00', 1, 1, 'C', 'DISAPPEAR');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `pin` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructorxcourse`
--

CREATE TABLE `instructorxcourse` (
  `id` int(11) NOT NULL,
  `instructorID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `learning_type`
--

CREATE TABLE `learning_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `learning_type`
--

INSERT INTO `learning_type` (`id`, `name`) VALUES
(1, 'Video Lectures Only'),
(2, 'VIP By One Class'),
(3, 'Group Class'),
(4, 'Video Lectures + Zoom - By One'),
(5, 'Face to Face in Bangkok'),
(6, 'Student-initiated group class');

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `courseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `title`, `courseID`) VALUES
(1, 'HTML', 35),
(2, 'CSS', 35),
(3, 'Javascript', 35),
(4, 'Bootstrap', 35),
(5, 'Database System & Design', 35),
(6, 'PHP Programming', 35),
(7, 'Final Web Project', 35),
(8, 'J2SE Fundamentals', 27),
(9, 'Conditional Statement & Decision Making', 27),
(10, 'Loopings in Java', 27),
(11, 'Arrays in Java', 27),
(12, 'Functions in Java', 27),
(13, 'Object Oriented Programming', 27),
(14, 'Character, String & StringBuffer Classes', 27),
(15, 'Exception Handling in Java', 27),
(16, 'File Handling in Java', 27),
(17, 'Utility & Collection Classes', 27),
(18, 'Database System & Design', 27),
(19, 'Final Java + MY SQL Project', 27),
(20, 'Array & Functions Extra Problems', 27);

-- --------------------------------------------------------

--
-- Table structure for table `module_item`
--

CREATE TABLE `module_item` (
  `id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `fileID` int(11) DEFAULT NULL,
  `videoID` int(11) DEFAULT NULL,
  `linkID` int(11) DEFAULT NULL,
  `assignmentID` int(11) DEFAULT NULL,
  `moduleID` int(11) NOT NULL,
  `isFree` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module_item`
--

INSERT INTO `module_item` (`id`, `sort`, `type`, `fileID`, `videoID`, `linkID`, `assignmentID`, `moduleID`, `isFree`) VALUES
(1, 1, 'VIDEO', NULL, 1, NULL, NULL, 1, 1),
(2, 2, 'VIDEO', NULL, 2, NULL, NULL, 1, 0),
(3, 3, 'VIDEO', NULL, 3, NULL, NULL, 1, 0),
(4, 4, 'VIDEO', NULL, 4, NULL, NULL, 1, 0),
(5, 5, 'VIDEO', NULL, 5, NULL, NULL, 1, 0),
(6, 1, 'VIDEO', NULL, 6, NULL, NULL, 2, 1),
(7, 2, 'VIDEO', NULL, 7, NULL, NULL, 2, 0),
(8, 3, 'VIDEO', NULL, 8, NULL, NULL, 2, 0),
(9, 4, 'VIDEO', NULL, 9, NULL, NULL, 2, 0),
(22, 1, 'VIDEO', NULL, 10, NULL, NULL, 3, 1),
(23, 2, 'VIDEO', NULL, 11, NULL, NULL, 3, 0),
(24, 3, 'VIDEO', NULL, 12, NULL, NULL, 3, 0),
(25, 4, 'VIDEO', NULL, 13, NULL, NULL, 3, 0),
(26, 5, 'VIDEO', NULL, 14, NULL, NULL, 3, 0),
(27, 6, 'VIDEO', NULL, 15, NULL, NULL, 3, 0),
(28, 1, 'VIDEO', NULL, 16, NULL, NULL, 4, 0),
(29, 2, 'VIDEO', NULL, 17, NULL, NULL, 4, 0),
(30, 1, 'VIDEO', NULL, 18, NULL, NULL, 5, 1),
(31, 2, 'VIDEO', NULL, 19, NULL, NULL, 5, 0),
(32, 3, 'VIDEO', NULL, 20, NULL, NULL, 5, 0),
(33, 4, 'VIDEO', NULL, 21, NULL, NULL, 5, 1),
(34, 5, 'VIDEO', NULL, 22, NULL, NULL, 5, 0),
(35, 6, 'VIDEO', NULL, 23, NULL, NULL, 5, 0),
(36, 7, 'VIDEO', NULL, 24, NULL, NULL, 5, 0),
(37, 8, 'VIDEO', NULL, 25, NULL, NULL, 5, 0),
(38, 9, 'VIDEO', NULL, 26, NULL, NULL, 5, 0),
(39, 10, 'VIDEO', NULL, 27, NULL, NULL, 5, 0),
(40, 1, 'VIDEO', NULL, 28, NULL, NULL, 6, 1),
(41, 2, 'VIDEO', NULL, 29, NULL, NULL, 6, 0),
(42, 1, 'VIDEO', NULL, 30, NULL, NULL, 8, 0),
(43, 2, 'VIDEO', NULL, 31, NULL, NULL, 8, 1),
(44, 3, 'VIDEO', NULL, 32, NULL, NULL, 8, 1),
(45, 4, 'VIDEO', NULL, 33, NULL, NULL, 8, 0),
(46, 5, 'VIDEO', NULL, 34, NULL, NULL, 8, 0),
(47, 6, 'VIDEO', NULL, 35, NULL, NULL, 8, 0),
(48, 7, 'VIDEO', NULL, 36, NULL, NULL, 8, 0),
(49, 8, 'VIDEO', NULL, 37, NULL, NULL, 8, 0),
(50, 1, 'VIDEO', NULL, 38, NULL, NULL, 9, 0),
(51, 2, 'VIDEO', NULL, 39, NULL, NULL, 9, 0),
(52, 3, 'VIDEO', NULL, 40, NULL, NULL, 9, 0),
(53, 1, 'VIDEO', NULL, 41, NULL, NULL, 10, 1),
(54, 2, 'VIDEO', NULL, 42, NULL, NULL, 10, 1),
(55, 3, 'VIDEO', NULL, 43, NULL, NULL, 10, 0),
(56, 4, 'VIDEO', NULL, 44, NULL, NULL, 10, 0),
(57, 5, 'VIDEO', NULL, 45, NULL, NULL, 10, 0),
(58, 1, 'VIDEO', NULL, 46, NULL, NULL, 11, 0),
(59, 2, 'VIDEO', NULL, 47, NULL, NULL, 11, 0),
(60, 1, 'VIDEO', NULL, 48, NULL, NULL, 12, 0),
(61, 2, 'VIDEO', NULL, 49, NULL, NULL, 12, 0),
(62, 1, 'VIDEO', NULL, 50, NULL, NULL, 13, 0),
(63, 2, 'VIDEO', NULL, 51, NULL, NULL, 13, 0),
(64, 3, 'VIDEO', NULL, 52, NULL, NULL, 13, 0),
(65, 4, 'VIDEO', NULL, 53, NULL, NULL, 13, 0),
(66, 5, 'VIDEO', NULL, 54, NULL, NULL, 13, 0),
(67, 1, 'VIDEO', NULL, 55, NULL, NULL, 14, 0),
(68, 1, 'VIDEO', NULL, 56, NULL, NULL, 15, 0),
(69, 2, 'VIDEO', NULL, 57, NULL, NULL, 15, 0),
(70, 1, 'VIDEO', NULL, 58, NULL, NULL, 16, 0),
(71, 2, 'VIDEO', NULL, 59, NULL, NULL, 16, 0),
(72, 1, 'VIDEO', NULL, 60, NULL, NULL, 17, 0),
(73, 1, 'VIDEO', NULL, 18, NULL, NULL, 18, 1),
(74, 2, 'VIDEO', NULL, 19, NULL, NULL, 18, 0),
(75, 3, 'VIDEO', NULL, 20, NULL, NULL, 18, 0),
(76, 4, 'VIDEO', NULL, 21, NULL, NULL, 18, 0),
(77, 5, 'VIDEO', NULL, 22, NULL, NULL, 18, 0),
(78, 6, 'VIDEO', NULL, 23, NULL, NULL, 18, 0),
(79, 7, 'VIDEO', NULL, 24, NULL, NULL, 18, 0),
(80, 8, 'VIDEO', NULL, 25, NULL, NULL, 18, 0),
(81, 9, 'VIDEO', NULL, 26, NULL, NULL, 18, 0),
(82, 10, 'VIDEO', NULL, 27, NULL, NULL, 18, 0),
(83, 1, 'VIDEO', NULL, 61, NULL, NULL, 19, 0),
(84, 2, 'VIDEO', NULL, 62, NULL, NULL, 19, 0);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `fileID` int(11) DEFAULT NULL,
  `linkID` int(11) DEFAULT NULL,
  `assignmentID` int(11) NOT NULL,
  `type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `review` longtext NOT NULL,
  `studentID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `isShown` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `review`, `studentID`, `courseID`, `isShown`) VALUES
(14, 'ဆရာက စေတနာပါပါနဲ့ အားလုံးကို နားလည်လွယ်‌အောင် ရှင်းပြပေးပါတယ် Exercise တွေနဲ့ နားမလည်တာတွေကို စိတ်ရှည်ရှည်နဲ့ရှင်းပြပြီး ရှင်းပြထားတဲ့notes တွေကို အမြဲပိုပေးတဲ့အတွက် စာပြန်ကြည့်တဲ့အခါအရမ်းကို အထောက်အကူဖြစ်စေပီး အဆင်ပြေပါတယ်', 2, 35, 1),
(15, 'သင်တန်းကို Facebook ကနေတွေ့ခဲ့တာပါ one by one သင်ပေးတာရယ် ၊ သင်တန်းကြေးက သင့်တင့်တာရယ် ၊ အချိန်လည်း သေချာလေး ညှိနှိင်းသင်ပေးတာရယ်ကြောင့်တက်ရောက်ဖြစ်ခဲ့ပါတယ်။ အရင်က ဘာမှမရေးတတ်ဘူး၊ အဓိကက ဆရာနဲ့ တက်လိုက်တာ တွေးတတ်သွားတယ်။ program/coding ရဲ့ အသွားအလာကို တွေးတတ်လာတယ်၊ ဒီနေရာမှာ ဒါလေး မရဘူးလား၊ ဒီအကြောင်း ဖြုတ်လိုက်ရင်ရော၊ အပေါ်အောက်ချိန်းလိုက်ရင်ရော အစရှိသဖြင့် အတွေးတွေက coding ကို သပ်သပ်ရပ်ရပ် ရေးတတ်လာစေတယ်။', 9, 27, 1),
(16, 'ဆရာ့ သင်တန်းတက်ပီးတော့မှ Java programming နဲ့ ပတ်သတ်ပီး class, function တွေကို သေချာ ရှင်းလင်း နားလည်အောင် သိရှိလာရတဲ့ အတွက် အရမ်းကို အဆင်ပြေပါတယ်။ exercise တွေ နဲ့သေချာ လေ့ကျင့်ရတဲ့ အတွက် java ကိုပိုပီး အကျွမ်းတဝင်ရှိလာစေပါတယ်။ java နဲ့ပတ်သတ်ရင် Oscord ကို recommends ပေးပါတယ်။', 70, 27, 1),
(17, 'To my dear programming tutor Saya, I’m thrilled with the programming training you provided. As a talented tutor from Myanmar, you skillfully assessed my level and tailored the lessons perfectly, even as a beginner. I truly appreciate your kindness, passion, excellent time management, and commitment. The reasonable fee, helpful teaching tools, and your patience in explaining concepts until I fully understood them made learning enjoyable and effective. Thanks to your guidance, I’m now confident I’ll become proficient in programming. I highly recommend your training to anyone interested in programming.Thank you again for your invaluable support!', 10, 28, 1),
(18, 'စာသင်တဲ့အခါ တစ်ယောက်ချင်း ရှင်းရှင်းလင်းလင်းနဲ့ သင်ပေးတဲ့အပြင် သင်တန်းချိန်ကို အဆင်ပြေအောင်ညှိပေးတာကို သဘောကျပါတယ် နားမလည်တာတွေကို သေချာပြန်ရှင်းပြတဲ့အပြင်သတ်မှတ်ထားတဲ့ Course တွေများတာကိုလည်းသဘောကျပါတယ် အစက ဒီအတိုင်းအချိန်ပိုနေလိုတတ်မယ် စဉ်းစားထားရာကနေ Programming ကိုအမှန်တကယ်တတ်ကျွမ်းချင်လာပါတယ်', 14, 27, 1),
(19, 'Programming ကိုအခြေခံကနေစပြီးလေ့လာချင်လို ခု  Programming သင်ပေးနေတဲ့ဆရာလေးဆီမှာတက်ဖြစ်ပါတယ် သင်ကြားပေးတဲ့စနစ်က စနစ်တကျရှိတော့သင်ယူရတာအဆင်ပြေပါတယ် သင်ခန်းစာအခန်းတိုင်းအတွက် မေးခွန်းလေးတွေလေ့ကျင့်ခန်းတွေနဲ့မိုစာပြန်လုပ်ဖြစ်စေပါတယ်နားလည်လွယ်အောင်စိတ်ရှည်ရှည်နဲ့ရှင်းပြပေးလ်ု နားလည်လွယ်စေပါတယ် ပြီးတော့ additional resources တွေနဲ့ recommended books တွေကိုဝေမျှပေးတဲ့အတွက်လည်းတော်တော်အဆင်ပြေပါတယ်OOP ကိုလည်းရှင်းပြပေးတဲ့အတွက်လည်းတော်တော်လေးအကျိုးရှိပါတယ်', 11, 27, 1),
(20, 'ကျောင်းတက်တုန်းက Programming ကိုသင်ရပေမယ့် ဘာမှန်းမသိသလို ဘာမှလဲမလုပ်ဖူးခဲ့ပါဖူး အိမ်ကသားကိုတက်စေချင်တာရယ် ကိုယ်တိုင်လည်း သိချင်စိတ်ရှိသေးတာရယ်နဲ့ ခု Programming သင်ပေးနေတဲ့ဆရာလေးဆီမှာတက်ဖြစ်ခဲ့ပါတယ် သူ့ကိုစင်ကာပူမှာအလုပ်လုပ်နေတဲ့ ညီလေးတစ်ယောက်ဆီကသိခွင့်ရတာပါ ငယ်သေးပေမယ့်တော်တော် တော်ပါတယ် သင်ကြားပေးတဲ့စနစ်ကစနစ်တကျရှိတော့သင်ယူရတာအဆင်ပြေပါတယ် သင်ခန်းစာအခန်းတိုင်းအတွက် မေးခွန်းလေးတွေလေ့ကျင့်ခန်းတွေနဲ့မိုစာပြန်လုပ်ဖြစ်စေပါတယ် နားလည်လွယ်အောင်စိတ်ရှည်ရှည်နဲ့ရှင်းပြပေးလိုကျွန်တော်လိုအသက်ကြီးသူရော သားငယ်လိုအသက်ငယ်သေးသူရောအတွက်အဆင်ပြေပါတယ်', 17, 27, 1),
(21, 'ဆရာနဲ့သင်ရတာတော်တော်အားရပါတယ် ပြီးတော့ ဆရာကနားမလည်တဲ့စာတွေကိုလဲသေသေချာချာပြန်ရှင်းပြပါတယ်အရင်တုန်းကကျွန်တော် computer programming skill ကတော်တော်ဆိုးပါတယ် ဆိုးတယ်ဆိုလုပ်ကိုမလုပ်တတ်တာပါခုတော့ဆရာ့ကျေးဇူးနဲ့ကျွမ်းကျွမ်းကျင်ကျင်လုပ်တတ်သွားပါပြီဒါကြောင့်ဆရာ့ကိုတော်တော်ကျေးဇူးတင်ပါတယ်ဆရာရေ', 18, 27, 1),
(22, 'Oscord က ဆရာတွေက စိတ်ရှည်ပြီးတော့ စာရှင်းရင်လည်း နားလည်လွယ်ပါတယ်။ Course တစ်ခုပြီးတိုင်း mini project လေးတွေလုပ်ရတာတော့ သဘောအကျဆုံးပါပဲ။ အချိန်တိုအတွင်းထိထိရောက်ရောက်နဲ့ programming ကို သင်ယူချင်ရင်တော့ Oscord ကို highly recommend ပါနော်', 3, 35, 1),
(23, 'Javaသင်တန်းတက်မယ်လို့ စဥ်းစားပြီး သင်တန်းတွေလိုက်ရှာရင်း Oscord pageကိုတွေ့ခဲ့တာပါ အစကတော့အဆင်ပြေပါ့မလားတွေးခဲ့ပေမဲ့ Javaစသင်တဲ့ရက်မှာပဲ ဆရာစာရှင်းပြတာက နားလည်လွယ်ပြီး conceptမိတယ်လို့လည်းခံစားရလို့ သဘောကျပါတယ် စာတဖြတ်ပြီးတိုင်း Quizတွေ examတွေဖြေရင်း သင်ရတာဆိုတော့ စာလည်းပြန်လုပ်ဖြစ်ပြီးပိုနားလည်လာပါတယ် စာသင်​ပေးတဲ့ဆရာကလည်းသင်တဲ့ဘာသာရပ်ပေါ် ကျွမ်းကျင်ပိုင်နိုင်တယ်လို့ခံစားရလို့ Oscordကို recommendပေးပါတယ်✨', 32, 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `accountID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `accountID`) VALUES
(2, 1),
(3, 2),
(4, 3),
(5, 4),
(6, 5),
(7, 6),
(8, 7),
(9, 8),
(10, 9),
(11, 10),
(12, 11),
(14, 13),
(15, 14),
(16, 15),
(17, 16),
(18, 17),
(19, 18),
(20, 19),
(21, 20),
(22, 21),
(23, 22),
(24, 23),
(25, 24),
(26, 25),
(27, 26),
(28, 27),
(29, 28),
(30, 29),
(31, 30),
(32, 31),
(33, 32),
(34, 33),
(35, 34),
(36, 35),
(37, 36),
(38, 37),
(39, 38),
(40, 39),
(41, 40),
(42, 41),
(43, 42),
(44, 43),
(45, 44),
(46, 45),
(47, 46),
(48, 47),
(49, 48),
(50, 49),
(51, 50),
(52, 51),
(53, 52),
(54, 53),
(55, 54),
(56, 55),
(57, 56),
(67, 62),
(69, 64),
(70, 65),
(71, 66),
(72, 67),
(73, 68),
(74, 69),
(75, 70),
(76, 71),
(77, 72),
(78, 73),
(79, 74),
(80, 75),
(81, 76),
(82, 77),
(83, 78),
(84, 79),
(85, 80),
(86, 81),
(87, 82),
(89, 84);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `video` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `name`, `video`) VALUES
(1, 'HTML Lecture 1', 'HTML L1.mp4'),
(2, 'HTML Lecture 2', 'HTML L2.mp4'),
(3, 'HTML Lecture 3', 'HTML L3.mp4'),
(4, 'HTML Lecture 4', 'HTML L4.mp4'),
(5, 'HTML Lecture 5', 'HTML L5.mp4'),
(6, 'CSS Lecture 1', 'CSS L1.mp4'),
(7, 'CSS Lecture 2', 'CSS L2.mp4'),
(8, 'CSS Lecture 3', 'CSS L3.mp4'),
(9, 'CSS Lecture 4', 'CSS L4.mp4'),
(10, 'Javascript Lecture 1', 'JS L1.mp4'),
(11, 'Javascript Lecture 2', 'JS L2.mp4'),
(12, 'Javascript Lecture 3', 'JS L3.mp4'),
(13, 'Javascript Lecture 4', 'JS L4.mp4'),
(14, 'Javascript Lecture 5', 'JS L5.mp4'),
(15, 'Javascript Lecture 6', 'JS L6.mp4'),
(16, 'Bootstrap Lecture 1', 'BS L1.mp4'),
(17, 'Bootstrap Lecture 2', 'BS L2.mp4'),
(18, 'Introduction to Database Design', 'DBD1.mp4'),
(19, 'Conceptual Database Design', 'DBD2.mp4'),
(20, 'Logical Database Design', 'DBD3.mp4'),
(21, 'Normalization Project Tutorial 1', 'DBD4.mp4'),
(22, 'Normalization Project Tutorial 2', 'DBD5.mp4'),
(23, 'Physical Database Design - Part 1', 'DBD6.mp4'),
(24, 'Physical Database Design - Part 2', 'DBD7.mp4'),
(25, 'SQL - Part 1', 'DBD8.mp4'),
(26, 'SQL - Part 2', 'DBD9.mp4'),
(27, 'Querying Multiple Tables', 'DBD10.mp4'),
(28, 'Introduction to PHP Programming', 'PHP1.mp4'),
(29, 'Use of $GET and $POST in PHP', 'PHP2.mp4'),
(30, 'Introduction to Java Programming', 'java1.mp4'),
(31, 'Variables and Datatypes - Part 1', 'java2.mp4'),
(32, 'Variables and Datatypes - Part 2', 'java3.mp4'),
(33, 'Datatype Conversion', 'java4.mp4'),
(34, 'User Input in Java', 'java5.mp4'),
(35, 'Operators - Part 1', 'java6.mp4'),
(36, 'Operators - Part 2', 'java7.mp4'),
(37, 'Exercises in Fundamental Concepts', 'java8.mp4'),
(38, 'Conditional Statement & Decision Making - Part 1', 'java9.mp4'),
(39, 'Conditional Statement & Decision Making - Part 2', 'java10.mp4'),
(40, 'Conditional Statements - Exercises', 'java11.mp4'),
(41, 'Loopings - Part 1', 'java12.mp4'),
(42, 'Loopings - Part 2', 'java13.mp4'),
(43, 'Looping Exercises - Part 1', 'java14.mp4'),
(44, 'Looping Exercises - Part 2', 'java15.mp4'),
(45, 'Loopings Exercises - Part 3', 'java16.mp4'),
(46, 'Array - Part 1', 'java17.mp4'),
(47, 'Array - Part 2', 'java18.mp4'),
(48, 'Functions - Part 1', 'java19.mp4'),
(49, 'Functions - Part 2', 'java20.mp4'),
(50, 'OOP - Part 1', 'java21.mp4'),
(51, 'OOP - Part 2', 'java22.mp4'),
(52, 'OOP - Part 3', 'java23.mp4'),
(53, 'OOP - Part 4', 'java24.mp4'),
(54, 'OOP - Part 5', 'java25.mp4'),
(55, 'Character, String and String Buffer Classes', 'java26.mp4'),
(56, 'Exception Handling - Part 1', 'java27.mp4'),
(57, 'Exception Handling - Part 2', 'java28.mp4'),
(58, 'File Handling - Part 1', 'java29.mp4'),
(59, 'File Handling - Part 2', 'java30.mp4'),
(60, 'Utility and Collection Classes', 'java31.mp4'),
(61, 'Java Final Project - Part 1', 'java32.mp4'),
(62, 'Java Final Project - Part 2', 'java33.mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile` (`profile`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answerID`),
  ADD KEY `assignmentID` (`assignmentID`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photoID` (`photoID`);

--
-- Indexes for table `coursexcategory`
--
ALTER TABLE `coursexcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courseID` (`courseID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `course_detail`
--
ALTER TABLE `course_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `courseID` (`courseID`),
  ADD KEY `learningType` (`learningType`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_class_enrollment`
--
ALTER TABLE `group_class_enrollment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `batchID` (`batchID`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `instructorxcourse`
--
ALTER TABLE `instructorxcourse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructorID` (`instructorID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `learning_type`
--
ALTER TABLE `learning_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `module_item`
--
ALTER TABLE `module_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fileID` (`fileID`),
  ADD KEY `videoID` (`videoID`),
  ADD KEY `linkID` (`linkID`),
  ADD KEY `moduleID` (`moduleID`),
  ADD KEY `assignmentID` (`assignmentID`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fileID` (`fileID`),
  ADD KEY `linkID` (`linkID`),
  ADD KEY `assignmentID` (`assignmentID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `answerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `coursexcategory`
--
ALTER TABLE `coursexcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `course_detail`
--
ALTER TABLE `course_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_class_enrollment`
--
ALTER TABLE `group_class_enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `instructorxcourse`
--
ALTER TABLE `instructorxcourse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `learning_type`
--
ALTER TABLE `learning_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `module_item`
--
ALTER TABLE `module_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`profile`) REFERENCES `photo` (`id`);

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`id`);

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`assignmentID`) REFERENCES `assignment` (`id`);

--
-- Constraints for table `batch`
--
ALTER TABLE `batch`
  ADD CONSTRAINT `batch_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `course` (`id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`photoID`) REFERENCES `photo` (`id`);

--
-- Constraints for table `coursexcategory`
--
ALTER TABLE `coursexcategory`
  ADD CONSTRAINT `coursexcategory_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `coursexcategory_ibfk_2` FOREIGN KEY (`categoryID`) REFERENCES `category` (`id`);

--
-- Constraints for table `course_detail`
--
ALTER TABLE `course_detail`
  ADD CONSTRAINT `course_detail_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `course` (`id`);

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `enrollment_ibfk_3` FOREIGN KEY (`learningType`) REFERENCES `learning_type` (`id`);

--
-- Constraints for table `group_class_enrollment`
--
ALTER TABLE `group_class_enrollment`
  ADD CONSTRAINT `group_class_enrollment_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `group_class_enrollment_ibfk_2` FOREIGN KEY (`batchID`) REFERENCES `batch` (`id`);

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`id`);

--
-- Constraints for table `instructorxcourse`
--
ALTER TABLE `instructorxcourse`
  ADD CONSTRAINT `instructorxcourse_ibfk_1` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`id`),
  ADD CONSTRAINT `instructorxcourse_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `course` (`id`);

--
-- Constraints for table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `course` (`id`);

--
-- Constraints for table `module_item`
--
ALTER TABLE `module_item`
  ADD CONSTRAINT `module_item_ibfk_1` FOREIGN KEY (`moduleID`) REFERENCES `module` (`id`),
  ADD CONSTRAINT `module_item_ibfk_2` FOREIGN KEY (`fileID`) REFERENCES `file` (`id`),
  ADD CONSTRAINT `module_item_ibfk_3` FOREIGN KEY (`videoID`) REFERENCES `video` (`id`),
  ADD CONSTRAINT `module_item_ibfk_4` FOREIGN KEY (`linkID`) REFERENCES `link` (`id`),
  ADD CONSTRAINT `module_item_ibfk_5` FOREIGN KEY (`moduleID`) REFERENCES `module` (`id`),
  ADD CONSTRAINT `module_item_ibfk_6` FOREIGN KEY (`assignmentID`) REFERENCES `assignment` (`id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`fileID`) REFERENCES `file` (`id`),
  ADD CONSTRAINT `question_ibfk_2` FOREIGN KEY (`linkID`) REFERENCES `link` (`id`),
  ADD CONSTRAINT `question_ibfk_3` FOREIGN KEY (`assignmentID`) REFERENCES `assignment` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `course` (`id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
