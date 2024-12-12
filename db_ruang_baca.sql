-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 07:17 PM
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
-- Database: `db_ruang_baca`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_anggota`
--

CREATE TABLE `tbl_anggota` (
  `id_anggota` int(11) NOT NULL,
  `nim` bigint(11) DEFAULT NULL,
  `nama_mahasiswa` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_angkatan` int(11) DEFAULT NULL,
  `verifikasi` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_anggota`
--

INSERT INTO `tbl_anggota` (`id_anggota`, `nim`, `nama_mahasiswa`, `jenis_kelamin`, `alamat`, `no_hp`, `foto`, `password`, `id_angkatan`, `verifikasi`) VALUES
(1, 2201020135, 'Annisya Awari', 'Perempuan', 'batu10', '08126754367', '1733223117_0390571f18100e8b8e8b.jpg', 'icabruh', 1, 1),
(2, 220102003, 'tata', 'Laki-Laki', 'kota tanjungpinang', '083012951803', '1733282155_be05ee3ad5fadb3f9bf7.jpeg', '3012', 5, 1),
(4, 2201020111, 'mardita rindi', 'Perempuan', 'kota tanjungpinang', '083012951890', '1733282837_be59726b6eddda7b3a91.jpeg', '3012', 1, 1),
(6, 220102098, 'cecep', 'Laki-Laki', NULL, '67544789999', NULL, 'cecep', 3, 1),
(7, 2201020052, 'Ade Latifia', 'Perempuan', 'kijang', '081234567612', '1733285587_237afaa323ef31efabe8.jpg', 'fia', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_angkatan`
--

CREATE TABLE `tbl_angkatan` (
  `id_angkatan` int(11) NOT NULL,
  `nama_angkatan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_angkatan`
--

INSERT INTO `tbl_angkatan` (`id_angkatan`, `nama_angkatan`) VALUES
(1, 'Teknik Informatika'),
(2, 'Teknik Elektro'),
(3, 'Teknik Perkapalan'),
(4, 'Teknik Industri'),
(5, 'Kimia');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku`
--

CREATE TABLE `tbl_buku` (
  `id_buku` int(11) NOT NULL,
  `kode_buku` varchar(50) DEFAULT NULL,
  `judul_buku` varchar(100) DEFAULT NULL,
  `id_kategori` int(2) DEFAULT NULL,
  `id_penulis` int(2) DEFAULT NULL,
  `id_penerbit` int(2) DEFAULT NULL,
  `id_rak` int(2) DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `bahasa` varchar(20) DEFAULT NULL,
  `halaman` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `cover` varchar(100) DEFAULT NULL,
  `jml_tersedia` int(11) DEFAULT NULL,
  `jml_dipinjam` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_buku`
--

INSERT INTO `tbl_buku` (`id_buku`, `kode_buku`, `judul_buku`, `id_kategori`, `id_penulis`, `id_penerbit`, `id_rak`, `isbn`, `tahun`, `bahasa`, `halaman`, `jumlah`, `cover`, `jml_tersedia`, `jml_dipinjam`) VALUES
(1, 'RYL/PPY/005.117 Nud p/1988', 'Pemrograman Python untuk Ilmu Komputer dan Teknik', 1, 1, 1, 1, '978-979-29-6618-3', '2018', 'Indonesia', 168, 3, 'cover.jpg', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Ekonomi'),
(2, 'Komik'),
(3, 'Matematika'),
(4, 'Bahasa'),
(5, 'Sejarah'),
(6, 'Sosial'),
(7, 'Novel'),
(8, 'Budaya');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_peminjaman`
--

CREATE TABLE `tbl_peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `no_pinjam` varchar(20) DEFAULT NULL,
  `tgl_pengajuan` date DEFAULT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `lama_pinjam` int(11) DEFAULT NULL,
  `tgl_harus_kembali` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `keterlambatan` int(11) DEFAULT NULL,
  `denda` int(11) DEFAULT NULL,
  `status_pinjam` varchar(15) DEFAULT NULL,
  `ket` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_peminjaman`
--

INSERT INTO `tbl_peminjaman` (`id_pinjam`, `no_pinjam`, `tgl_pengajuan`, `id_anggota`, `tgl_pinjam`, `id_buku`, `qty`, `lama_pinjam`, `tgl_harus_kembali`, `tgl_kembali`, `keterlambatan`, `denda`, `status_pinjam`, `ket`) VALUES
(4, '120241206112442', '2024-12-06', 1, '2024-12-10', 1, 1, 5, '2024-12-15', NULL, NULL, NULL, 'Ditolak', 'sudah tidak bisa dipinjam lagi'),
(5, '420241206112849', '2024-12-06', 4, '2024-12-27', 1, 1, 6, '2025-01-02', NULL, NULL, NULL, 'Diterima', NULL),
(6, '120241206162413', '2024-12-06', 1, '2024-12-18', 1, 1, 5, '2024-12-23', NULL, NULL, NULL, 'Ditolak', 'sudah habis tidak bisa dipinjam lagi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penerbit`
--

CREATE TABLE `tbl_penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `nama_penerbit` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_penerbit`
--

INSERT INTO `tbl_penerbit` (`id_penerbit`, `nama_penerbit`) VALUES
(1, 'Erlangga'),
(3, 'Gramedia'),
(4, 'Bintang Media'),
(5, 'Andi Publisher');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penulis`
--

CREATE TABLE `tbl_penulis` (
  `id_penulis` int(11) NOT NULL,
  `nama_penulis` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_penulis`
--

INSERT INTO `tbl_penulis` (`id_penulis`, `nama_penulis`) VALUES
(1, 'Supardi'),
(2, 'Samsulhadi'),
(3, 'Komang Ayu Heni'),
(4, 'Zainul Anwar'),
(5, 'Nasruddin Anshoriy');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rak`
--

CREATE TABLE `tbl_rak` (
  `id_rak` int(11) NOT NULL,
  `nama_rak` varchar(50) DEFAULT NULL,
  `lantai_rak` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rak`
--

INSERT INTO `tbl_rak` (`id_rak`, `nama_rak`, `lantai_rak`) VALUES
(1, 'Rak A', 1),
(2, 'Rak B', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id_slider` int(2) NOT NULL,
  `slider` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`id_slider`, `slider`) VALUES
(1, '1733278923_b98fa503b8d1a32099a6.jpeg'),
(2, 'slider12.jpeg'),
(3, 'slider13.jpeg'),
(4, 'slider14.jpeg'),
(5, 'slider15.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `level` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `email`, `no_hp`, `password`, `foto`, `level`) VALUES
(1, 'Admin', 'admin@gmail.com', '085218309503', '1234', '1733224139_6779f6a5f8d52a8a914c.jpg', 0),
(2, 'Petugas Ruang Baca', 'user@gmail.com', '085218019703', '1234', 'foto 2.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_web`
--

CREATE TABLE `tbl_web` (
  `id_web` int(1) NOT NULL,
  `nama_fakultas` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kab_kota` varchar(50) DEFAULT NULL,
  `kode_pos` varchar(20) DEFAULT NULL,
  `kontak` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `sejarah` text DEFAULT NULL,
  `visi` text DEFAULT NULL,
  `misi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_web`
--

INSERT INTO `tbl_web` (`id_web`, `nama_fakultas`, `alamat`, `kecamatan`, `kab_kota`, `kode_pos`, `kontak`, `logo`, `sejarah`, `visi`, `misi`) VALUES
(1, 'FTTK UMRAH', 'Jl.Politeknik-Senggarang', 'Tj.Pinang Kota', 'Tanjungpinang', '29115', 'Instagram: @teknikumrahYoutube: FTTK UMRAH OfficialFacebook: @ftumrah_official', '1733149496_6f9191f6443c3a586b60.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tristique tincidunt arcu, non cursus sem blandit non. Fusce eget arcu id nulla dignissim eleifend. Suspendisse potenti. Ut ac eros eget felis ultricies vestibulum. Integer tristique, ligula et sagittis aliquam, augue libero ultricies risus, sit amet blandit augue odio in justo. Proin placerat, justo sit amet tincidunt volutpat, tortor justo molestie ligula, at dictum elit urna et urna. Integer vel tincidunt erat. Aliquam erat volutpat. Curabitur nec metus in ex blandit ullamcorper.\r\n\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Integer efficitur quam vel dui scelerisque, non bibendum purus consequat. Aenean id mauris eget dolor dapibus interdum ut vel lorem. Phasellus id metus mi. Cras a fermentum neque. Fusce viverra dapibus lacus, id malesuada enim faucibus nec. Nam vehicula dolor a dui sagittis, in vehicula metus pharetra. Duis semper magna sit amet varius tincidunt. Aenean ultricies turpis id volutpat faucibus. Donec porttitor interdum suscipit.\r\n\r\nSed nec velit non ligula gravida interdum. In eget facilisis neque, vel venenatis lorem. Praesent tempus, ex a fringilla lacinia, libero nunc condimentum libero, vitae eleifend eros lacus eget tortor. Nulla consectetur metus ac ipsum aliquam, et dictum ipsum tincidunt. Nullam ut nulla tortor. Integer ut vulputate lacus. Aenean faucibus convallis magna non volutpat. Duis scelerisque enim nec sapien efficitur fermentum. Donec sed feugiat nisi. Phasellus suscipit arcu risus, id vehicula magna eleifend in. Nullam nec mauris lacinia, feugiat ipsum sit amet, tincidunt erat.\r\n\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse potenti. Cras scelerisque, nunc a suscipit feugiat, mauris neque mollis eros, a venenatis sem odio sit amet turpis. Ut sed nibh non odio condimentum feugiat. Vestibulum malesuada turpis quis augue mollis interdum. Nam convallis est eu sapien consequat, vel laoreet nulla dapibus. Proin malesuada lectus in tincidunt sodales. Fusce dignissim odio vel nisl malesuada, eget vulputate libero tempor. Mauris dignissim fringilla scelerisque. Curabitur porttitor orci ac ultricies egestas. Aenean vel justo risus. Suspendisse quis congue libero.\r\n\r\nMorbi porttitor, ipsum id iaculis tincidunt, felis elit iaculis risus, a finibus sapien turpis non libero. Vestibulum tempor consequat bibendum. Mauris bibendum urna nec magna fermentum, a iaculis risus ultricies. Integer in posuere erat, sed cursus velit. Vivamus eleifend odio quis sapien consequat luctus. Nam mollis, nisl et gravida fermentum, ligula quam tempor tortor, et tincidunt nisl lacus vel odio. Suspendisse potenti. Proin bibendum eros quis ex volutpat, vel pulvinar elit hendrerit.', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `tbl_angkatan`
--
ALTER TABLE `tbl_angkatan`
  ADD PRIMARY KEY (`id_angkatan`);

--
-- Indexes for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_peminjaman`
--
ALTER TABLE `tbl_peminjaman`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indexes for table `tbl_penerbit`
--
ALTER TABLE `tbl_penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `tbl_penulis`
--
ALTER TABLE `tbl_penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- Indexes for table `tbl_rak`
--
ALTER TABLE `tbl_rak`
  ADD PRIMARY KEY (`id_rak`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_web`
--
ALTER TABLE `tbl_web`
  ADD PRIMARY KEY (`id_web`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_angkatan`
--
ALTER TABLE `tbl_angkatan`
  MODIFY `id_angkatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_peminjaman`
--
ALTER TABLE `tbl_peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_penerbit`
--
ALTER TABLE `tbl_penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_penulis`
--
ALTER TABLE `tbl_penulis`
  MODIFY `id_penulis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_rak`
--
ALTER TABLE `tbl_rak`
  MODIFY `id_rak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id_slider` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  ADD CONSTRAINT `fk_angkatan_id` FOREIGN KEY (`id_angkatan`) REFERENCES `tbl_angkatan` (`id_angkatan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
