-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2024 at 07:43 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_logistik`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory_out`
--

CREATE TABLE `inventory_out` (
  `id` int(11) NOT NULL,
  `no_invoice` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `date_out` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory_out`
--

INSERT INTO `inventory_out` (`id`, `no_invoice`, `nama_barang`, `qty`, `date_out`) VALUES
(1, 'TT678', 'Panadol', -12, '2024-07-12 07:09:21'),
(2, 'AB123', 'Neuralgin', -23, '2024-07-12 07:38:17'),
(3, 'CC123', 'Proris', -2, '2024-07-12 07:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `no_item` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`no_item`, `nama_barang`) VALUES
(1, 'Panadol'),
(2, 'Neuralgin'),
(3, 'Feminax'),
(4, 'Proris');

-- --------------------------------------------------------

--
-- Table structure for table `receive`
--

CREATE TABLE `receive` (
  `no_invoice` int(11) NOT NULL,
  `id_request` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `Nama_Barang` varchar(255) NOT NULL,
  `Qty` int(11) DEFAULT NULL,
  `detail_pengirim` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receive`
--

INSERT INTO `receive` (`no_invoice`, `id_request`, `tanggal`, `Nama_Barang`, `Qty`, `detail_pengirim`, `status`) VALUES
(1, 1, '2024-07-12', '', NULL, 'PT SEJAHTERA', NULL),
(2, 1, '2024-07-12', '', NULL, 'PT SEJAHTERA', NULL),
(890, 1, '2024-07-12', '', NULL, 'PT MAJU', NULL),
(891, 2, '2024-07-12', '', NULL, 'PT MAJU', NULL),
(892, 2, '2024-07-12', '', NULL, 'PT MAJU', NULL),
(893, 3, '2024-07-12', '', NULL, 'PT MAJU', NULL),
(894, 3, '2024-07-12', '', NULL, 'PT MAJU', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `ID_Request` int(11) NOT NULL,
  `No_Request_Detail` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `Tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`ID_Request`, `No_Request_Detail`, `user_id`, `Tanggal`) VALUES
(1, '1200', 1, '2024-07-09'),
(2, '1300', 2, '2024-07-12'),
(3, '1400', 2, '2024-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `request_details`
--

CREATE TABLE `request_details` (
  `ID_Request_Detail` int(11) NOT NULL,
  `ID_Request` int(11) NOT NULL,
  `No_Item` varchar(255) NOT NULL,
  `Nama_Barang` varchar(255) NOT NULL,
  `Qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_details`
--

INSERT INTO `request_details` (`ID_Request_Detail`, `ID_Request`, `No_Item`, `Nama_Barang`, `Qty`) VALUES
(1, 1, '1', 'Panadol', 13),
(2, 2, '2', 'Neuralgin', 19),
(3, 3, '3', 'Feminax', 90),
(4, 4, '4', 'Proris', 80);

-- --------------------------------------------------------

--
-- Table structure for table `stock_report`
--

CREATE TABLE `stock_report` (
  `id` int(11) NOT NULL,
  `no_invoice` varchar(50) DEFAULT NULL,
  `Nama_Barang` varchar(100) NOT NULL,
  `Qty` int(11) NOT NULL,
  `status` enum('in','out') NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_report`
--

INSERT INTO `stock_report` (`id`, `no_invoice`, `Nama_Barang`, `Qty`, `status`, `date`) VALUES
(1, 'CC123', 'Panadol', 13, 'in', '2024-07-12 05:07:24'),
(2, 'TT678', 'Panadol', 13, 'in', '2024-07-12 05:09:05'),
(3, 'TT678', 'Panadol', -12, 'out', '2024-07-12 05:09:21'),
(4, '890', 'Panadol', 13, 'in', '2024-07-12 05:15:00'),
(5, 'AB123', 'Neuralgin', 19, 'in', '2024-07-12 05:37:56'),
(6, 'AB123', 'Neuralgin', -23, 'out', '2024-07-12 05:38:17'),
(7, 'CC123', 'Proris', -2, 'out', '2024-07-12 05:38:51'),
(8, 'CC123', 'Neuralgin', 19, 'in', '2024-07-12 05:39:16'),
(9, 'GH123', 'Feminax', 90, 'in', '2024-07-12 05:41:04'),
(10, 'KL890', 'Feminax', 90, 'in', '2024-07-12 05:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Andre', 'Andre@umb.ac.id', 'default.jpg', '1234', 2, 1, 123456),
(2, 'vanisha', 'cacah@gmail.com', 'default.jpg', '$2y$10$n1RzH4OA8jARMnxNnI1NJO5Mlnbbsa670rW9BAfiTPIdZGixBERPC', 1, 1, 1720757198),
(3, 'kania', 'cc@gmail.com', 'default.jpg', '$2y$10$SJ13l4zIGtp/u1fTLURQZeoHfrtCcOMWJ2W9PFvTVhFYtSMXdjutq', 2, 1, 1720759424);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'ADMIN'),
(2, 'USER'),
(3, 'MENU');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Logistik'),
(2, 'Pengadaan');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(4, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory_out`
--
ALTER TABLE `inventory_out`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receive`
--
ALTER TABLE `receive`
  ADD PRIMARY KEY (`no_invoice`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`ID_Request`);

--
-- Indexes for table `request_details`
--
ALTER TABLE `request_details`
  ADD PRIMARY KEY (`ID_Request_Detail`);

--
-- Indexes for table `stock_report`
--
ALTER TABLE `stock_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory_out`
--
ALTER TABLE `inventory_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `receive`
--
ALTER TABLE `receive`
  MODIFY `no_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=895;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `ID_Request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request_details`
--
ALTER TABLE `request_details`
  MODIFY `ID_Request_Detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock_report`
--
ALTER TABLE `stock_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
