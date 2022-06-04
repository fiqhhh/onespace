-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2020 at 05:04 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onespace`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `id_privilege` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `id_privilege`, `password`, `foto`) VALUES
(1, 1, '$2y$10$INI1wZfcT0dtjGAJyvMEJuytF3hqnmvSR401pGMr.fX7cTYs6V.Yq', 'admin.png');

-- --------------------------------------------------------

--
-- Table structure for table `alamat`
--

CREATE TABLE `alamat` (
  `id_alamat` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kelurahan` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `kode_pos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alamat`
--

INSERT INTO `alamat` (`id_alamat`, `alamat`, `kecamatan`, `kelurahan`, `kota`, `provinsi`, `kode_pos`) VALUES
(13, 'Mandala RT10 RW12 No. 34', 'Cilodong', 'Sukamaju', 'Depok', 'Jawa Barat', 16475),
(14, 'Sidamukti RT06 RW02 No. 64', 'Cilodong', 'Sukamaju', 'Depok', 'Jawa Barat', 16475),
(15, 'Sidamukti RT06 RW02 No. 64', 'Cilodong', 'Sukamaju', 'Depok', 'Jawa Barat', 16475),
(16, 'Villa Pertiwi RT03 RW15 Blok C', 'Cilodong', 'Sukamaju', 'Depok', 'Jawa Barat', 16475);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `id_alamat` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `nip_guru` int(11) NOT NULL,
  `email_guru` varchar(255) NOT NULL,
  `gender_guru` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir_guru` varchar(100) NOT NULL,
  `tanggal_lahir_guru` date NOT NULL,
  `telepon_guru` varchar(13) NOT NULL,
  `gelar_guru` varchar(100) NOT NULL,
  `dibuat_guru` timestamp NOT NULL DEFAULT current_timestamp(),
  `diupdate_guru` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `id_alamat`, `id_mapel`, `nama_guru`, `nip_guru`, `email_guru`, `gender_guru`, `tempat_lahir_guru`, `tanggal_lahir_guru`, `telepon_guru`, `gelar_guru`, `dibuat_guru`, `diupdate_guru`) VALUES
(6, 13, 5, 'Zikri Endisyah', 180190920, 'azikriazikri@gmail.com', 'Laki-laki', 'Jakarta', '2003-04-10', '089766283312', 'S. Kom', '2020-10-20 07:58:53', '2020-10-20 07:58:53'),
(7, 14, 7, 'Aura Cahyani', 190991872, 'auracahayanii@gmail.com', 'Perempuan', 'Depok', '2009-12-29', '089655299381', 'S. Pd', '2020-10-20 08:27:17', '2020-10-20 08:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `tahun_pembelajaran` varchar(100) NOT NULL,
  `token_kelas` varchar(7) NOT NULL,
  `dibuat_kelas` timestamp NOT NULL DEFAULT current_timestamp(),
  `diupdate_kelas` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_guru`, `id_jurusan`, `nama_kelas`, `tahun_pembelajaran`, `token_kelas`, `dibuat_kelas`, `diupdate_kelas`) VALUES
(10, 6, 1, '12 RPL 1 - Pemrograman Web Bergerak', '2020/2021', 'DAIUP0Q', '2020-10-20 09:24:18', '2020-10-20 09:35:10'),
(11, 7, 1, '12 RPL 2 - Bahasa Inggris', '2020/2021', 'A0MKREF', '2020-10-20 09:28:28', '2020-10-20 09:34:22'),
(12, 7, 1, '12 RPL 1 - Bahasa Inggris', '2020/2021', 'OBDZQPB', '2020-10-20 09:34:07', '2020-10-20 09:34:07'),
(13, 6, 1, '12 RPL 2 - Pemrograman Web Bergerak', '2020/2021', 'CDZCA6E', '2020-10-20 09:35:46', '2020-10-20 09:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `lampiran`
--

CREATE TABLE `lampiran` (
  `id_lampiran` int(11) NOT NULL,
  `id_tugas` int(11) DEFAULT NULL,
  `id_materi` int(11) DEFAULT NULL,
  `id_hasil_tugas` int(11) DEFAULT NULL,
  `nama_lampiran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lampiran`
--

INSERT INTO `lampiran` (`id_lampiran`, `id_tugas`, `id_materi`, `id_hasil_tugas`, `nama_lampiran`) VALUES
(190, NULL, 31, NULL, '6a751e6195221d555b467d3e64006c69.docx'),
(191, NULL, 31, NULL, '052206703a051608f390f6255202af64.pdf'),
(192, NULL, 31, NULL, '972fc5269314b84fa41c3dfaa20f97bf.pptx'),
(193, 28, NULL, NULL, '0277f4038ab5e1c76e242c99f18eec70.docx'),
(194, 28, NULL, NULL, '435ff3ff0bdc48aa07fa5f66a951ba17.pdf'),
(195, NULL, NULL, 13, '6d6e5a41c427723c40fc677ea0576196.docx');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`) VALUES
(1, 'Pendidikan Agama Islam'),
(3, 'Basis Data'),
(4, 'Bahasa Indonesia'),
(5, 'Pemrograman Web Bergerak'),
(6, 'Matematika'),
(7, 'Bahasa Inggris'),
(8, 'Bahasa Sunda');

-- --------------------------------------------------------

--
-- Table structure for table `murid`
--

CREATE TABLE `murid` (
  `id_murid` int(11) NOT NULL,
  `id_alamat` int(11) NOT NULL,
  `nama_murid` varchar(100) NOT NULL,
  `email_murid` varchar(255) NOT NULL,
  `nisn_murid` varchar(10) NOT NULL,
  `nis_murid` varchar(9) NOT NULL,
  `kelas_murid` varchar(5) NOT NULL,
  `jurusan_murid` varchar(50) NOT NULL,
  `tempat_lahir_murid` varchar(100) NOT NULL,
  `tanggal_lahir_murid` date NOT NULL,
  `gender_murid` enum('Laki-laki','Perempuan','','') NOT NULL,
  `telepon_murid` varchar(13) NOT NULL,
  `dibuat_murid` timestamp NOT NULL DEFAULT current_timestamp(),
  `diupdate_murid` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `murid`
--

INSERT INTO `murid` (`id_murid`, `id_alamat`, `nama_murid`, `email_murid`, `nisn_murid`, `nis_murid`, `kelas_murid`, `jurusan_murid`, `tempat_lahir_murid`, `tanggal_lahir_murid`, `gender_murid`, `telepon_murid`, `dibuat_murid`, `diupdate_murid`) VALUES
(9, 15, 'Fathur Rahman Rifqi Azzami', 'farizi17@gmail.com', '0038198798', '181907866', 'XII', 'RPL 2', 'Jakarta', '2001-10-19', 'Laki-laki', '089639356407', '2020-10-20 08:38:56', '2020-10-20 08:38:56'),
(10, 16, 'Farindra Diaz Ibrahim', 'dazfarwar18@gmail.com', '0038976756', '181934565', 'XII', 'RPL 2', 'Yogyakarta', '2003-04-14', 'Laki-laki', '089766283763', '2020-10-20 08:42:56', '2020-10-20 08:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua`
--

CREATE TABLE `orang_tua` (
  `id_orang_tua` int(11) NOT NULL,
  `id_murid` int(11) NOT NULL,
  `nama_ortu` varchar(100) DEFAULT NULL,
  `email_ortu` varchar(255) DEFAULT NULL,
  `telepon_ortu` varchar(13) NOT NULL,
  `status_ortu` enum('Lengkap','Yatim','Piatu','Yatim Piatu') NOT NULL,
  `dibuat_ortu` timestamp NOT NULL DEFAULT current_timestamp(),
  `diupdate_ortu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orang_tua`
--

INSERT INTO `orang_tua` (`id_orang_tua`, `id_murid`, `nama_ortu`, `email_ortu`, `telepon_ortu`, `status_ortu`, `dibuat_ortu`, `diupdate_ortu`) VALUES
(5, 9, 'Kurniawan', 'krniawanuuy@gmail.com', '085100178981', 'Lengkap', '2020-10-20 08:46:53', '2020-10-20 08:46:53'),
(6, 10, 'Indra WIjaya', 'dazfarwar18@gmail.com', '089522637287', 'Lengkap', '2020-10-20 08:47:38', '2020-10-20 08:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `id_privilege` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id_privilege`, `role_name`) VALUES
(1, 'Super Admin'),
(2, 'Kepala Sekolah'),
(3, 'Siswa'),
(4, 'Guru'),
(5, 'Orang Tua');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama_tugas` varchar(255) NOT NULL,
  `deksripsi_tugas` text NOT NULL,
  `tenggat_tugas` timestamp NULL DEFAULT current_timestamp(),
  `dibuat_tugas` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `diupdate_tugas` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `id_kelas`, `nama_tugas`, `deksripsi_tugas`, `tenggat_tugas`, `dibuat_tugas`, `diupdate_tugas`) VALUES
(28, 11, 'Present Tense', '<p>Assalamu\'alaikum Hello Everyone How Are you Today?</p>', '2023-10-20 05:00:00', '2020-10-20 22:54:15', '2020-10-20 22:57:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`id_alamat`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `lampiran`
--
ALTER TABLE `lampiran`
  ADD PRIMARY KEY (`id_lampiran`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `murid`
--
ALTER TABLE `murid`
  ADD PRIMARY KEY (`id_murid`);

--
-- Indexes for table `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD PRIMARY KEY (`id_orang_tua`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id_privilege`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alamat`
--
ALTER TABLE `alamat`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `lampiran`
--
ALTER TABLE `lampiran`
  MODIFY `id_lampiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `murid`
--
ALTER TABLE `murid`
  MODIFY `id_murid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id_orang_tua` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id_privilege` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
