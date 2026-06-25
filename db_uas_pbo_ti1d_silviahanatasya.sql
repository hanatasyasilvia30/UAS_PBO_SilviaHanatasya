-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2026 at 10:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_ti1d_silviahanatasya`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_mahasiswa`
--

CREATE TABLE `tabel_mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `semester` int(11) NOT NULL,
  `tarif_ukt_nominal` decimal(10,2) NOT NULL,
  `jenis_pembiayaan` enum('mandiri','bidikmisi','prestasi') NOT NULL,
  `golongan_ukt` varchar(10) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `nomer_kip_kuliah` varchar(50) DEFAULT NULL,
  `dana_saku_subsidi` decimal(10,2) DEFAULT NULL,
  `nama_instansi_beasiswa` varchar(100) DEFAULT NULL,
  `minimal_ipk_syarat` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_mahasiswa`
--

INSERT INTO `tabel_mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `nim`, `semester`, `tarif_ukt_nominal`, `jenis_pembiayaan`, `golongan_ukt`, `nama_wali`, `nomer_kip_kuliah`, `dana_saku_subsidi`, `nama_instansi_beasiswa`, `minimal_ipk_syarat`) VALUES
(1, 'Ahmad Hidayat', '230101001', 3, 7500000.00, 'mandiri', 'Golongan 5', 'Budi Hidayat', 'Tidak Ada', 0.00, 'Tidak Ada', 0.00),
(2, 'Rina Lestari', '230101002', 3, 8500000.00, 'mandiri', 'Golongan 6', 'Joko Lestari', 'Tidak Ada', 0.00, 'Tidak Ada', 0.00),
(3, 'Fajar Nugroho', '230101003', 5, 6000000.00, 'mandiri', 'Golongan 4', 'Andi Nugroho', 'Tidak Ada', 0.00, 'Tidak Ada', 0.00),
(4, 'Siti Aminah', '230101004', 1, 7500000.00, 'mandiri', 'Golongan 5', 'Toto Aminah', 'Tidak Ada', 0.00, 'Tidak Ada', 0.00),
(5, 'Dewi Sartika', '230101005', 5, 9000000.00, 'mandiri', 'Golongan 6', 'Hadi Sartika', 'Tidak Ada', 0.00, 'Tidak Ada', 0.00),
(6, 'Budi Santoso', '230101006', 7, 6000000.00, 'mandiri', 'Golongan 4', 'Eko Santoso', 'Tidak Ada', 0.00, 'Tidak Ada', 0.00),
(7, 'Rizky Pratama', '230101007', 1, 7500000.00, 'mandiri', 'Golongan 5', 'Dedi Pratama', 'Tidak Ada', 0.00, 'Tidak Ada', 0.00),
(8, 'Andi Wijaya', '230102001', 3, 2400000.00, 'bidikmisi', 'Golongan 1', 'Supardi', 'KIP-102931', 700000.00, 'Kemendikbud', 2.75),
(9, 'Eka Putri', '230102002', 3, 2400000.00, 'bidikmisi', 'Golongan 1', 'Mulyono', 'KIP-102932', 700000.00, 'Kemendikbud', 2.75),
(10, 'Fikri Haikal', '230102003', 5, 2400000.00, 'bidikmisi', 'Golongan 1', 'Syarifuddin', 'KIP-102933', 750000.00, 'Kemendikbud', 2.75),
(11, 'Nanda Saputra', '230102004', 1, 2400000.00, 'bidikmisi', 'Golongan 2', 'Irwan Saputra', 'KIP-102934', 700000.00, 'Kemendikbud', 2.75),
(12, 'Putri Rahayu', '230102005', 5, 2400000.00, 'bidikmisi', 'Golongan 1', 'Sukijan', 'KIP-102935', 750000.00, 'Kemendikbud', 2.75),
(13, 'Bagus Anwar', '230102006', 7, 2400000.00, 'bidikmisi', 'Golongan 1', 'Anwar', 'KIP-102936', 750000.00, 'Kemendikbud', 2.75),
(14, 'Sari Wijayanti', '230102007', 1, 2400000.00, 'bidikmisi', 'Golongan 2', 'Wijaya', 'KIP-102937', 700000.00, 'Kemendikbud', 2.75),
(15, 'Gilang Permana', '230103001', 3, 0.00, 'prestasi', 'Golongan 0', 'Hendro Permana', 'Tidak Ada', 1000000.00, 'Yayasan Djarum', 3.50),
(16, 'Intan Permatasari', '230103002', 3, 0.00, 'prestasi', 'Golongan 0', 'Bambang', 'Tidak Ada', 1200000.00, 'Bank Indonesia', 3.25),
(17, 'Kevin Sanjaya', '230103003', 5, 1500000.00, 'prestasi', 'Golongan 2', 'Agus Sanjaya', 'Tidak Ada', 500000.00, 'PT Tanoto', 3.00),
(18, 'Larasati Putri', '230103004', 1, 0.00, 'prestasi', 'Golongan 0', 'Gunawan', 'Tidak Ada', 1000000.00, 'Yayasan Djarum', 3.50),
(19, 'Muhammad Rizal', '230103005', 5, 2000000.00, 'prestasi', 'Golongan 3', 'Soleh Rizal', 'Tidak Ada', 600000.00, 'Dinas Pendidikan', 3.40),
(20, 'Nadia Utami', '230103006', 7, 0.00, 'prestasi', 'Golongan 0', 'Yusuf Utami', 'Tidak Ada', 1200000.00, 'Bank Indonesia', 3.25),
(21, 'Oki Setiawan', '230103007', 1, 1500000.00, 'prestasi', 'Golongan 2', 'Indra Setiawan', 'Tidak Ada', 500000.00, 'PT Tanoto', 3.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
