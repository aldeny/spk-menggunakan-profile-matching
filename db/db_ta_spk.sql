-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2024 at 12:08 PM
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
-- Database: `db_ta_spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama_kriteria`, `keterangan`) VALUES
(1, 'Akademik', 'Nilai akademik'),
(2, 'Non Akademik', 'Nilai Non Akademik');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_bobot_gap`
--

CREATE TABLE `nilai_bobot_gap` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `bobot_ipa` float(6,2) NOT NULL,
  `bobot_ips` float(6,2) NOT NULL,
  `students_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_bobot_gap`
--

INSERT INTO `nilai_bobot_gap` (`id`, `kode`, `bobot_ipa`, `bobot_ips`, `students_id`) VALUES
(1, 'C1', 5.00, 5.00, 28),
(2, 'C2', 4.00, 4.50, 28),
(3, 'C3', 4.50, 4.00, 28),
(4, 'C4', 4.50, 3.50, 28),
(5, 'C5', 4.50, 5.00, 28),
(6, 'C6', 5.00, 5.00, 28),
(7, 'C7', 4.00, 4.00, 28),
(8, 'C8', 2.50, 2.50, 28);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_gap`
--

CREATE TABLE `nilai_gap` (
  `id` int(11) NOT NULL,
  `gap` float NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_gap`
--

INSERT INTO `nilai_gap` (`id`, `gap`, `bobot`) VALUES
(3, 0, 5),
(9, 1, 4.5),
(10, -1, 4),
(11, 2, 3.5);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_murni`
--

CREATE TABLE `nilai_murni` (
  `id` int(11) NOT NULL,
  `students_id` int(11) NOT NULL,
  `ppdb` float(6,2) NOT NULL,
  `ipa` float(6,2) NOT NULL,
  `ips` float(6,2) NOT NULL,
  `mtk` float(6,2) NOT NULL,
  `bindo` float(6,2) NOT NULL,
  `psikotes` float(6,2) NOT NULL,
  `minat_siswa` float(6,2) NOT NULL,
  `minat_ortu` float(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_murni`
--

INSERT INTO `nilai_murni` (`id`, `students_id`, `ppdb`, `ipa`, `ips`, `mtk`, `bindo`, `psikotes`, `minat_siswa`, `minat_ortu`) VALUES
(5, 30, 74.44, 92.00, 92.00, 95.00, 92.00, 2.00, 2.00, 5.00),
(6, 29, 82.00, 74.50, 78.84, 95.00, 84.00, 4.00, 2.00, 1.00),
(8, 26, 75.00, 84.00, 80.00, 82.00, 88.00, 5.00, 2.00, 2.00),
(9, 28, 74.44, 92.00, 92.00, 95.00, 92.00, 5.00, 2.00, 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_target`
--

CREATE TABLE `nilai_target` (
  `id` int(11) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `nilai_target` int(11) NOT NULL,
  `sub_kriteria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_target`
--

INSERT INTO `nilai_target` (`id`, `kelas`, `nilai_target`, `sub_kriteria_id`) VALUES
(1, 'IPA', 5, 1),
(4, 'IPA', 5, 2),
(5, 'IPA', 3, 3),
(6, 'IPA', 4, 4),
(7, 'IPA', 3, 5),
(8, 'IPA', 5, 6),
(9, 'IPA', 3, 25),
(10, 'IPA', 2, 30),
(11, 'IPS', 5, 1),
(12, 'IPS', 3, 2),
(13, 'IPS', 5, 3),
(14, 'IPS', 3, 4),
(15, 'IPS', 4, 5),
(16, 'IPS', 5, 6),
(17, 'IPS', 3, 25),
(18, 'IPS', 2, 30);

-- --------------------------------------------------------

--
-- Table structure for table `profile_matching`
--

CREATE TABLE `profile_matching` (
  `id` int(11) NOT NULL,
  `students_id` int(11) NOT NULL,
  `ncf_akademik_ipa` float(6,2) NOT NULL,
  `nsf_akademik_ipa` float(6,2) NOT NULL,
  `ncf_nonakademik_ipa` float(6,2) NOT NULL,
  `nsf_nonakademik_ipa` float(6,2) NOT NULL,
  `n1_ipa` float(6,2) NOT NULL,
  `n2_ipa` float(6,2) NOT NULL,
  `n_total_ipa` float(6,2) NOT NULL,
  `ncf_akademik_ips` float(6,2) NOT NULL,
  `nsf_akademik_ips` float(6,2) NOT NULL,
  `ncf_nonakademik_ips` float(6,2) NOT NULL,
  `nsf_nonakademik_ips` float(6,2) NOT NULL,
  `n1_ips` float(6,2) NOT NULL,
  `n2_ips` float(6,2) NOT NULL,
  `n_total_ips` float(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile_matching`
--

INSERT INTO `profile_matching` (`id`, `students_id`, `ncf_akademik_ipa`, `nsf_akademik_ipa`, `ncf_nonakademik_ipa`, `nsf_nonakademik_ipa`, `n1_ipa`, `n2_ipa`, `n_total_ipa`, `ncf_akademik_ips`, `nsf_akademik_ips`, `ncf_nonakademik_ips`, `nsf_nonakademik_ips`, `n1_ips`, `n2_ips`, `n_total_ips`) VALUES
(5, 30, 4.50, 4.50, 3.00, 2.50, 4.50, 2.80, 7.30, 4.50, 4.25, 3.00, 2.50, 4.40, 2.80, 7.20),
(6, 29, 3.33, 4.75, 4.00, 4.00, 3.90, 4.00, 7.90, 3.33, 3.75, 4.00, 4.00, 3.50, 4.00, 7.50),
(8, 26, 4.00, 4.25, 4.50, 5.00, 4.10, 4.70, 8.80, 4.00, 5.00, 4.50, 5.00, 4.40, 4.70, 9.10),
(9, 28, 4.50, 4.50, 4.50, 2.50, 4.50, 3.70, 8.20, 4.50, 4.25, 4.50, 2.50, 4.40, 3.70, 8.10);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) NOT NULL,
  `role_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`) VALUES
(1, 'Kepala Sekolah'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `scoring`
--

CREATE TABLE `scoring` (
  `id` int(11) NOT NULL,
  `students_id` int(11) NOT NULL,
  `nilai_ppdb` float(6,2) NOT NULL,
  `nilai_ipa` float(6,2) NOT NULL,
  `nilai_ips` float(6,2) NOT NULL,
  `nilai_mtk` float(6,2) NOT NULL,
  `nilai_bindo` float(6,2) NOT NULL,
  `nilai_psikotes` float(6,2) NOT NULL,
  `nilai_minat_siswa` float(6,2) NOT NULL,
  `nilai_minat_ortu` float(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scoring`
--

INSERT INTO `scoring` (`id`, `students_id`, `nilai_ppdb`, `nilai_ipa`, `nilai_ips`, `nilai_mtk`, `nilai_bindo`, `nilai_psikotes`, `nilai_minat_siswa`, `nilai_minat_ortu`) VALUES
(5, 30, 5.00, 4.00, 4.00, 5.00, 4.00, 2.00, 2.00, 5.00),
(6, 29, 5.00, 1.00, 2.00, 5.00, 3.00, 4.00, 2.00, 1.00),
(8, 26, 5.00, 3.00, 2.00, 3.00, 4.00, 5.00, 2.00, 2.00),
(9, 28, 5.00, 4.00, 4.00, 5.00, 4.00, 5.00, 2.00, 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `skala`
--

CREATE TABLE `skala` (
  `id` int(11) NOT NULL,
  `nilai_pertama` float(6,2) NOT NULL,
  `kondisi_pertama` varchar(10) NOT NULL,
  `nilai_kedua` float(6,2) NOT NULL,
  `kondisi_kedua` varchar(10) NOT NULL,
  `skala` float NOT NULL,
  `sub_kriteria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skala`
--

INSERT INTO `skala` (`id`, `nilai_pertama`, `kondisi_pertama`, `nilai_kedua`, `kondisi_kedua`, `skala`, `sub_kriteria_id`) VALUES
(1, 61.00, '2', 100.00, '4', 5, 1),
(2, 56.00, '2', 60.00, '4', 4, 1),
(3, 51.00, '2', 55.00, '4', 3, 1),
(4, 46.00, '2', 50.00, '4', 2, 1),
(5, 0.00, '2', 45.00, '4', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `tahun_ajaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `nis`, `nama_siswa`, `jenis_kelamin`, `kelas`, `tahun_ajaran`) VALUES
(26, '1153102656', 'Sri Sumiati', 'Perempuan', 'XB', '2024'),
(28, '1153102652', 'Anisa Bahar', 'Perempuan', 'XA', '2024'),
(29, '1153102658', 'Yopi Ramadhan', 'Laki-Laki', 'XE', '2024'),
(30, '1402062812', 'Muhammad Alhaqq Khaleed', 'Laki-Laki', 'XD', '2024');

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id` int(11) NOT NULL,
  `sub_kriteria` varchar(100) NOT NULL,
  `faktor` varchar(100) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id`, `sub_kriteria`, `faktor`, `kode`, `kriteria_id`, `keterangan`) VALUES
(1, 'Nilai PPDB', 'NCF', 'C1', 1, 'Nilai PPDB'),
(2, 'Nilai IPA', 'NCF', 'C2', 1, 'Nilai Ilmu Pengetahuan Alam'),
(3, 'Nilai IPS', 'NCF', 'C3', 1, 'Nilai Ilmu Pengetahuan Sosial'),
(4, 'Nilai Matematika', 'NSF', 'C4', 1, 'Nilai Matematika'),
(5, 'Nilai B.Indonesia', 'NSF', 'C5', 1, 'Nilai Bahasa Indonesia'),
(6, 'Psikotes', 'NCF', 'C6', 2, 'Nilai Psikotes'),
(25, 'Minat Siswa', 'NCF', 'C7', 2, 'Jika = Psikotes (4)\r\njika != Psikotes (2)'),
(30, 'Minat Orang Tua', 'NSF', 'C8', 2, 'Jika = Siswa (4)\r\nJika ≠ Siswa (2)\r\nJika terserah (1)');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `role_id`) VALUES
(16, 'Admin', 'admin', 'admin', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_bobot_gap`
--
ALTER TABLE `nilai_bobot_gap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_gap`
--
ALTER TABLE `nilai_gap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_murni`
--
ALTER TABLE `nilai_murni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_target`
--
ALTER TABLE `nilai_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_matching`
--
ALTER TABLE `profile_matching`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scoring`
--
ALTER TABLE `scoring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skala`
--
ALTER TABLE `skala`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nilai_bobot_gap`
--
ALTER TABLE `nilai_bobot_gap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nilai_gap`
--
ALTER TABLE `nilai_gap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `nilai_murni`
--
ALTER TABLE `nilai_murni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nilai_target`
--
ALTER TABLE `nilai_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `profile_matching`
--
ALTER TABLE `profile_matching`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scoring`
--
ALTER TABLE `scoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `skala`
--
ALTER TABLE `skala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
