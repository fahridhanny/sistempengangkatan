-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2020 at 04:37 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `primaloka_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `jabatan` int(11) NOT NULL,
  `jk` varchar(20) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `akses` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama`, `jabatan`, `jk`, `no_hp`, `alamat`, `email`, `username`, `password`, `akses`) VALUES
(5, 'Nadia', 4, 'Perempuan', '089706127132', 'Timur Regency  ', 'nadia@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'hrd'),
(6, 'Siti Aminah', 1, 'Perempuan', '089656421299', 'jl Cipinang Muara', 'sitiaminah@gmail.com', 'manager01', 'a6fb09317477cd074b8830e54b8c4931', 'manager_keuangan'),
(7, 'Muhamad Dafi', 2, 'Laki - laki', '089671276132', 'Perum Graha Prima', 'dafi@gmail.com', 'manager02', 'a45ce0f8cc211649738cd53367f01c76', 'manager_pemasaran'),
(8, 'Imam Khufron', 3, 'Laki - laki', '089567127813', 'Griya Asri 2', 'khufron@gmail.com', 'manager03', '6095ba7db0f1abe65a6953459bab59f2', 'manager_administrasi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Finance'),
(2, 'Marketing'),
(3, 'Administrasi'),
(4, 'hrd');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id_karyawan` varchar(20) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jk` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `tmp_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kontrak` varchar(15) NOT NULL,
  `awal_kontrak` date NOT NULL,
  `akhir_kontrak` date NOT NULL,
  `foto` text NOT NULL,
  `ket` varchar(30) NOT NULL,
  `status` enum('Diajukan','Selesai Kontrak','Belum Diajukan','Proses Penilaian','Perpanjang Kontrak','Sudah Dinilai','Dalam Masa Kontrak','Sudah Habis Kontrak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id_karyawan`, `id_jabatan`, `nama`, `jk`, `alamat`, `no_telp`, `tmp_lahir`, `tgl_lahir`, `kontrak`, `awal_kontrak`, `akhir_kontrak`, `foto`, `ket`, `status`) VALUES
('KAR153826', 3, 'Fatimah', 'Perempuan', 'puri cendana', '089678786778', 'bekasi', '2002-12-06', '3 Bulan', '2020-08-10', '2020-08-17', 'karakter3.png', 'Sudah Habis Masa Kontrak', 'Sudah Dinilai'),
('KAR341066', 2, 'Akbar', 'Laki - laki', 'Jln. Kemanggisan Raya', '089634345643', 'Jakarta', '1998-06-17', '3 Bulan', '2020-08-23', '2020-08-29', 'karakter4.png', 'Sudah Habis Masa Kontrak', 'Belum Diajukan'),
('KAR622919', 1, 'Rendi', 'Laki - laki', 'Griya Asri 2', '089512123454', 'Bandung', '1998-03-20', '3 Bulan', '2020-08-23', '2020-11-21', 'karakter2.png', 'Masih Dalam Masa Kontrak', 'Belum Diajukan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(20) NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`) VALUES
(1, 'absensi', 40),
(2, 'wawancara', 10),
(3, 'psikotes', 10),
(4, 'skill', 40);

-- --------------------------------------------------------

--
-- Table structure for table `tb_penilaian`
--

CREATE TABLE `tb_penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_karyawan` varchar(20) NOT NULL,
  `absensi` int(11) NOT NULL,
  `wawancara` int(11) NOT NULL,
  `psikotes` int(11) NOT NULL,
  `skill` int(11) NOT NULL,
  `hasil` float(5,2) NOT NULL,
  `hasil_rekomendasi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_penilaian`
--

INSERT INTO `tb_penilaian` (`id_penilaian`, `id_karyawan`, `absensi`, `wawancara`, `psikotes`, `skill`, `hasil`, `hasil_rekomendasi`) VALUES
(80, 'KAR153826', 80, 70, 90, 70, 73.33, 'Diangkat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `jabatan` (`jabatan`);

--
-- Indexes for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `tb_penilaian_ibfk_1` (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD CONSTRAINT `tb_admin_ibfk_1` FOREIGN KEY (`jabatan`) REFERENCES `tb_jabatan` (`id_jabatan`);

--
-- Constraints for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD CONSTRAINT `tb_karyawan_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id_jabatan`);

--
-- Constraints for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD CONSTRAINT `tb_penilaian_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `tb_karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
