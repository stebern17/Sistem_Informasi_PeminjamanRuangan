-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2023 at 07:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinjam_ruangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `NIDN` varchar(10) DEFAULT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`NIDN`, `UserID`) VALUES
('1810130100', 27),
('1810130200', 28),
('1122334455', 37),
('23445123', 42);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `jenisFasilitas` varchar(30) NOT NULL,
  `IDFasilitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`jenisFasilitas`, `IDFasilitas`) VALUES
('AC', 5),
('Seperangkat Komputer', 6),
('LCD Projector', 7),
('Microphone', 8),
('Kursi Kuliah', 9),
('Meja', 10);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_ruangan`
--

CREATE TABLE `fasilitas_ruangan` (
  `IDFasilRuangan` int(11) NOT NULL,
  `IDFasilitas` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `IDPeminjaman` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjam`
--

CREATE TABLE `peminjam` (
  `NIM` varchar(10) DEFAULT NULL,
  `NIDN` varchar(10) DEFAULT NULL,
  `IDProdi` int(11) DEFAULT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `peminjam`
--

INSERT INTO `peminjam` (`NIM`, `NIDN`, `IDProdi`, `UserID`) VALUES
('21113980', '', 6, 38),
('21113988', '', 6, 39),
('21113988', '', 6, 40),
('21113988', '', 6, 41);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_ruangan`
--

CREATE TABLE `peminjaman_ruangan` (
  `IDPeminjaman` int(11) NOT NULL,
  `jamPinjam` time NOT NULL,
  `jamSelesai` time NOT NULL,
  `lamaPinjam` time NOT NULL,
  `keperluan` varchar(350) NOT NULL,
  `tglPinjam` date NOT NULL,
  `tglSelesai` date NOT NULL,
  `persetujuan` varchar(20) NOT NULL DEFAULT 'Belum disetujui',
  `tglPersetujuan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UserID` int(11) DEFAULT NULL,
  `IDRuangan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `IDProdi` int(11) NOT NULL,
  `namaProdi` varchar(20) NOT NULL,
  `kaprodi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`IDProdi`, `namaProdi`, `kaprodi`) VALUES
(6, 'Informatika', 'Windha Mega Pradnya Dhuhita, M');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `IDRuangan` int(11) NOT NULL,
  `namaRuangan` varchar(100) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `lantai` int(11) NOT NULL,
  `fotoRuangan` varchar(40) NOT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userruangan`
--

CREATE TABLE `userruangan` (
  `UserID` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `noTelp` varchar(13) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userruangan`
--

INSERT INTO `userruangan` (`UserID`, `nama`, `email`, `password`, `alamat`, `role`, `noTelp`, `gender`) VALUES
(27, 'Admin', 'roombookingebs@gmail.com', '$2y$10$dZ61iRv4Nn0TP3Pc9ppb/u0T2Nkolb3UG9T9PbwfqTeU/e1j2lhKa', 'Tegal', 'Admin', '08143256789', 'M'),
(28, 'Kadiv', 'Kadivsatu@gmail.com', '$2y$10$oUYUkCMS/ndUGTKw/JTVBOPPmaY/X302.6J5z66KUC44vkakK1gLO', 'Bekasi', 'Kadiv', '08132456789', 'F'),
(37, 'Admin Farhan', 'adminsatu@gmail.com', '$2y$10$f5ifRfR/Rfyqd8MQm4U7V.3phW0OERdsVJbjeeQZ0pfg5yGqgEsP6', 'Magelang, Jawa tengah', 'Admin', '0812345678', 'M'),
(38, 'Sultan Faaiz', 'sultan.faaiz@students.amikom.ac.id', '$2y$10$Jaj1F3YZn.1pDQWG0RHzl.NNIg2DpC6pxr2rciklQhAFcvBfXorRe', 'Jl.Buah Naga Gandok Rt 001/ Rw 055 Condongcatur Depok Sleman', 'Mahasiswa', '088215591428', 'M'),
(39, 'Agus Nur Mendho', 'agusnurwahid0123@students.amikom.ac.id', '$2y$10$1.DLNp9975SmYAXXyLS4FOtZGSxsCjITY0EkU.r5dBgLac.1spKeG', 'Sleman, Yogyakarta', 'Mahasiswa', '0882123123131', 'M'),
(40, 'Agus Nur Mendho', 'agusnurwahid0123@students.amikom.ac.id', '$2y$10$wekpBz7UYveLcENDrHYFWuj0W3sK6535aLDQfSyMzv4EDztxaVqJ.', 'Sleman, Yogyakarta', 'Mahasiswa', '0882123123131', 'M'),
(41, 'Agus Nur Mendho', 'agusnurwahid0123@students.amikom.ac.id', '$2y$10$Ykl01b5Jg7bq6vXmn98T9Oqb5f0ojhnVuWZWOAO34vsJ5YNRU5pgS', 'Sleman, Yogyakarta', 'Mahasiswa', '0882123123131', 'M'),
(42, 'Kadiv Sultan', 'kadivdua@gmail.com', '$2y$10$PZzoo4qcH73wY013prWzfuq91y0zPUUPDIoCxmajOb0ilbbxP7jWu', 'Caturtunggal, Depok, Sleman', 'Kadiv', '0123124235345', 'F');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`IDFasilitas`);

--
-- Indexes for table `fasilitas_ruangan`
--
ALTER TABLE `fasilitas_ruangan`
  ADD PRIMARY KEY (`IDFasilRuangan`),
  ADD KEY `fk_IDFasilitasRuangan` (`IDFasilitas`),
  ADD KEY `fk_IDPeminjamanFasilitas` (`IDPeminjaman`);

--
-- Indexes for table `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `fk_IDProdiPeminjam` (`IDProdi`);

--
-- Indexes for table `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  ADD PRIMARY KEY (`IDPeminjaman`),
  ADD KEY `fk_UserIDPeminjamanRuangan` (`UserID`),
  ADD KEY `fk_IDRuanganPeminjaman` (`IDRuangan`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`IDProdi`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`IDRuangan`),
  ADD KEY `fk_UserIDRuangan` (`UserID`);

--
-- Indexes for table `userruangan`
--
ALTER TABLE `userruangan`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `IDFasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fasilitas_ruangan`
--
ALTER TABLE `fasilitas_ruangan`
  MODIFY `IDFasilRuangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `peminjam`
--
ALTER TABLE `peminjam`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  MODIFY `IDPeminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `IDProdi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `IDRuangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `userruangan`
--
ALTER TABLE `userruangan`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_UserIDAdmin` FOREIGN KEY (`UserID`) REFERENCES `userruangan` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fasilitas_ruangan`
--
ALTER TABLE `fasilitas_ruangan`
  ADD CONSTRAINT `fk_IDFasilitasRuangan` FOREIGN KEY (`IDFasilitas`) REFERENCES `fasilitas` (`IDFasilitas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_IDPeminjamanFasilitas` FOREIGN KEY (`IDPeminjaman`) REFERENCES `peminjaman_ruangan` (`IDPeminjaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjam`
--
ALTER TABLE `peminjam`
  ADD CONSTRAINT `fk_IDProdiPeminjam` FOREIGN KEY (`IDProdi`) REFERENCES `prodi` (`IDProdi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_UserIDPeminjam` FOREIGN KEY (`UserID`) REFERENCES `userruangan` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  ADD CONSTRAINT `fk_IDRuanganPeminjaman` FOREIGN KEY (`IDRuangan`) REFERENCES `ruangan` (`IDRuangan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD CONSTRAINT `fk_UserIDRuangan` FOREIGN KEY (`UserID`) REFERENCES `admin` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
