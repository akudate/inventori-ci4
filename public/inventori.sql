-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2023 at 04:28 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventori`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `productID` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `supplierID` int(11) NOT NULL,
  `harga` double NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`productID`, `productName`, `gambar`, `supplierID`, `harga`, `stok`) VALUES
('ASW-G-08', 'Gundam Barbatos', 'ASW-G-08_1677650034_444812be52165c45be96.webp', 103, 320000, 5),
('GN-010', 'Gundam Zabanya', 'GN-010_1678862883_55ac62a3795df5987c62.webp', 104, 200000, 4),
('XVX-016', 'Gundam Aerial', 'XVX-016_1677650624_0c14113419f35d5feaf2.webp', 101, 250000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `transactionID` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `productID` varchar(255) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `tujuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`transactionID`, `tanggal`, `productID`, `jumlah_keluar`, `tujuan`) VALUES
(111, '2121-02-21', 'XVX-016', 3, 'Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `transactionID` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `productID` varchar(255) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`transactionID`, `tanggal`, `productID`, `jumlah_masuk`) VALUES
(121, '1212-12-12', 'XVX-016', 3),
(122, '3333-12-12', 'ASW-G-08', 2);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierID`, `supplierName`, `alamat`, `telepon`) VALUES
(101, 'Research Dept. QMC', '4110 Old Redmond, USA', '(206) 555-8122'),
(102, 'Gongaga Accessories', '14 Garrett Hill London, UK', '(71) 555-4848'),
(103, 'Nibel Institute', '12 Winchester Way London, UK', '(71) 555-5598'),
(104, 'Wutai Commerce', 'Rue Joseph-Bens 532 Bruxelles, Belgium', '(02) 2012467'),
(105, 'Junon Souvenirs', '4726-11th Ave.N.E Seattle, USA', '(206) 555-1189');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `role`) VALUES
(3, 'admin1', '$2y$10$BOKiorlwyfEA0SjjoglMQ.zOn1w18EOvudLEgjn4lwH.FX3AfgBmS', 'Daffa', 'admin'),
(4, 'owner1', '$2y$10$bWIEjLwcoZgZYFkQDAERaeHgdGh.i.8oGV/ctN/cau5Q4r5QHeSou', 'Faiz', 'owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `supplierID` (`supplierID`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `supID` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `pkeluar` FOREIGN KEY (`productID`) REFERENCES `barang` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `pmasuk` FOREIGN KEY (`productID`) REFERENCES `barang` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
