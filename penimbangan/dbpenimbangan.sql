-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2018 at 12:16 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbpenimbangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE IF NOT EXISTS `data_user` (
`idU` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(6) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `posisi` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `formula` (
  `Nama produk` varchar(50) NOT NULL,
  `Nama Material` varchar(50) NOT NULL,
  `Netto` int(50) NOT NULL,
  `No Timbangan` int(40) NOT NULL,
  `No Urut` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE IF NOT EXISTS `hasil` (
  `Nama produk` varchar(50) NOT NULL,
  `Nama Material` varchar(50) NOT NULL,
  `Netto` int(40) NOT NULL,
  `Tara` int(40) NOT NULL,
  `No Timbangan` int(40) NOT NULL,
  `Jam Timbang` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `Nama Produk Aktif` varchar(50) NOT NULL,
  `Nama Material Aktif` varchar(50) NOT NULL,
  `Netto Target` int(40) NOT NULL,
  `No Timbangan Aktif` int(40) NOT NULL,
  `No Urut` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
 ADD PRIMARY KEY (`idU`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
MODIFY `idU` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
