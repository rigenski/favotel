-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2022 at 03:20 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_facility_hotel`
--

CREATE TABLE `tb_facility_hotel` (
  `id_facility` int(12) NOT NULL,
  `name_facility` varchar(24) NOT NULL,
  `date_create` int(12) NOT NULL,
  `date_update` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_guest`
--

CREATE TABLE `tb_guest` (
  `guest_id` int(11) NOT NULL,
  `guest_username` varchar(10) NOT NULL,
  `guest_password` varchar(50) NOT NULL,
  `guest_name` varchar(50) NOT NULL,
  `guest_notelp` varchar(20) NOT NULL,
  `guest_addres` text NOT NULL,
  `guest_gender` enum('male','female','','') NOT NULL,
  `guest_age` int(5) NOT NULL,
  `guest_created` date NOT NULL,
  `guest_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_reservasi`
--

CREATE TABLE `tb_reservasi` (
  `id` int(11) NOT NULL,
  `nama_pemesanan` varchar(50) NOT NULL,
  `email_pemesanan` varchar(50) NOT NULL,
  `no_handphone_pemesanan` varchar(20) NOT NULL,
  `nama_tamu` varchar(20) NOT NULL,
  `room_type` int(20) NOT NULL,
  `room_jumlah` int(20) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_in_out` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_room`
--

CREATE TABLE `tb_room` (
  `id_room` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `cllastype_id` int(11) NOT NULL,
  `roomtype_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `eat_id` int(11) NOT NULL,
  `room_people` int(10) NOT NULL,
  `room_no` int(100) NOT NULL,
  `room_price` int(100) NOT NULL,
  `room_photo` varchar(100) NOT NULL,
  `room_created` date NOT NULL,
  `room_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_room_facility`
--

CREATE TABLE `tb_room_facility` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_room_spec`
--

CREATE TABLE `tb_room_spec` (
  `id_room_spec` int(11) NOT NULL,
  `name_room` varchar(20) NOT NULL,
  `id_room_facility` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(8) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `role` enum('admin','resepsionis','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_facility_hotel`
--
ALTER TABLE `tb_facility_hotel`
  ADD PRIMARY KEY (`id_facility`);

--
-- Indexes for table `tb_guest`
--
ALTER TABLE `tb_guest`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `tb_reservasi`
--
ALTER TABLE `tb_reservasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_room`
--
ALTER TABLE `tb_room`
  ADD PRIMARY KEY (`id_room`);

--
-- Indexes for table `tb_room_facility`
--
ALTER TABLE `tb_room_facility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_room_spec`
--
ALTER TABLE `tb_room_spec`
  ADD PRIMARY KEY (`id_room_spec`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_facility_hotel`
--
ALTER TABLE `tb_facility_hotel`
  MODIFY `id_facility` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_guest`
--
ALTER TABLE `tb_guest`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_room`
--
ALTER TABLE `tb_room`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_room_facility`
--
ALTER TABLE `tb_room_facility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_room_spec`
--
ALTER TABLE `tb_room_spec`
  MODIFY `id_room_spec` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
