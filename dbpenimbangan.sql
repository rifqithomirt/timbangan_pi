-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2018 at 09:24 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpenimbangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `idU` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(6) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `posisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`idU`, `username`, `password`, `nama_user`, `posisi`) VALUES
(1, 'admin', 'swan', 'Administrator', 'operator'),
(2, 'Administrator', 'swan12', 'Ilham', 'operator');

-- --------------------------------------------------------

--
-- Table structure for table `formula`
--

CREATE TABLE `formula` (
  `nama_produk` varchar(50) NOT NULL,
  `nama_material` varchar(50) NOT NULL,
  `netto` int(50) NOT NULL,
  `no_timbangan` int(40) NOT NULL,
  `no_urut` int(40) NOT NULL,
  `idf` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `formula`
--

INSERT INTO `formula` (`nama_produk`, `nama_material`, `netto`, `no_timbangan`, `no_urut`, `idf`) VALUES
('Karet Gelang', 'Karet', 200, 1, 1, 1),
('Karet Ban', 'Karet', 400, 2, 1, 2),
('Karet Gelang', 'Lem', 50, 4, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `Nama produk` varchar(50) NOT NULL,
  `Nama Material` varchar(50) NOT NULL,
  `Netto` int(40) NOT NULL,
  `Tara` int(40) NOT NULL,
  `No Timbangan` int(40) NOT NULL,
  `Jam Timbang` int(40) NOT NULL,
  `idh` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `nama_produk_aktif` varchar(50) NOT NULL,
  `nama_material_aktif` varchar(50) NOT NULL,
  `netto_target` int(40) NOT NULL,
  `no_timbangan_aktif` int(40) NOT NULL,
  `no_urut` int(40) NOT NULL,
  `ids` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`nama_produk_aktif`, `nama_material_aktif`, `netto_target`, `no_timbangan_aktif`, `no_urut`, `ids`) VALUES
('Karet Gelang', 'Karet', 200, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`idU`);

--
-- Indexes for table `formula`
--
ALTER TABLE `formula`
  ADD PRIMARY KEY (`idf`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`idh`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ids`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `idU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `formula`
--
ALTER TABLE `formula`
  MODIFY `idf` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `idh` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `ids` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
