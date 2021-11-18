-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Nov 2021 pada 14.30
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lay_user`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(18) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis_kelamin` int(1) DEFAULT NULL,
  `alamat` varchar(32) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `gambar` varchar(32) DEFAULT NULL,
  `username` varchar(32) NOT NULL,
  `prodi` varchar(4) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `tanggal_buat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`, `jenis_kelamin`, `alamat`, `tanggal_lahir`, `no_hp`, `gambar`, `username`, `prodi`, `email`, `tanggal_buat`) VALUES
('170411100024', 'Moh Irsad', NULL, NULL, NULL, NULL, NULL, '170411100024', NULL, NULL, '2021-08-08'),
('170411100042', 'ria rostiani2', 2, 'utm', '0000-00-00', '082319856686', 'ia.jpg', '170411100042', '111', 'meichan12348765@gmail.com', '0000-00-00'),
('197406102008121002', 'Abdullah Basuki Rahmat, S.Si, ', 1, 'kososng', '2021-11-02', '123123', '12312312.jpg', '197406102008121002', '111', '123123@gmail.com', '2021-11-18'),
('198002232008121001', 'Aeri Rachmad, S.T., M.T.', 1, 'kososng', '2021-11-01', '123123', '12312312.jpg', '198002232008121001', '111', '123123@gmail.com', '2021-11-18'),
('198101092006041003', 'Achmad Jauhari, S.T., M.Kom', 1, 'kososng', '2021-11-01', '123123', '12312312.jpg', '198101092006041003', '111', '123123@gmail.com', '2021-11-18'),
('198609262014041001', 'Ach. Khozaimi, S.Kom.,M.Kom', 1, 'kososng', '2021-11-01', '123123', '12312312.jpg', '198609262014041001', '111', '123123@gmail.com', '2021-11-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fakultas`
--

CREATE TABLE `fakultas` (
  `kode_fakultas` varchar(2) NOT NULL,
  `fakultas` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `fakultas`
--

INSERT INTO `fakultas` (`kode_fakultas`, `fakultas`) VALUES
('04', 'Teknik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_kelamin`
--

CREATE TABLE `jenis_kelamin` (
  `id` int(11) NOT NULL,
  `jenis_kelamin` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_kelamin`
--

INSERT INTO `jenis_kelamin` (`id`, `jenis_kelamin`) VALUES
(1, 'laki-laki'),
(2, 'perempuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `level` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id`, `level`) VALUES
(1, 'admin'),
(2, 'Koordinator'),
(3, 'Dosen'),
(4, 'Mahasiswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(12) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(32) DEFAULT NULL,
  `prodi` varchar(4) NOT NULL,
  `jenis_kelamin` int(1) DEFAULT NULL,
  `alamat` varchar(32) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `gambar` varchar(32) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tanggal_buat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `username`, `email`, `prodi`, `jenis_kelamin`, `alamat`, `no_hp`, `gambar`, `tanggal_lahir`, `tanggal_buat`) VALUES
('170411100099', 'Ahmad Khairi Ramadan', '170411100099', 'mypasshidden@gmail.com', '111', 1, 'utm', '085203580638', 'ama.jpg', '0000-00-00', '0000-00-00'),
('170411100119', 'Syaban', '170411100119', NULL, '111', NULL, NULL, NULL, NULL, NULL, '2021-08-08'),
('170411100122', 'M. Hilhamdi Romadhon', '170411100122', NULL, '111', NULL, NULL, NULL, NULL, NULL, '2021-10-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `kode_fakultas` varchar(2) NOT NULL,
  `kode_prodi` varchar(4) NOT NULL,
  `prodi` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`kode_fakultas`, `kode_prodi`, `prodi`) VALUES
('04', '111', 'Teknik Informatika'),
('04', '112', 'Sistem Informasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(32) NOT NULL,
  `password` varchar(256) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`, `level`) VALUES
('170411100024', '170411100024', 3),
('170411100042', '170411100042', 3),
('170411100099', '170411100099', 4),
('170411100119', '170411100119', 4),
('170411100122', '170411100122', 4),
('197406102008121002', '197406102008121002', 3),
('198002232008121001', '198002232008121001', 3),
('198101092006041003', '198101092006041003', 3),
('198609262014041001', '198609262014041001', 3),
('Admin', 'admin', 1),
('koordinator', 'koordinator', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `dosen_jk` (`jenis_kelamin`),
  ADD KEY `dosen_user` (`username`),
  ADD KEY `dosen_prodi` (`prodi`);

--
-- Indeks untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`kode_fakultas`);

--
-- Indeks untuk tabel `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `mhs_user` (`username`),
  ADD KEY `mhs_prodi` (`prodi`),
  ADD KEY `mhs_jk` (`jenis_kelamin`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`kode_prodi`),
  ADD KEY `fakpro` (`kode_fakultas`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `user_level` (`level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_jk` FOREIGN KEY (`jenis_kelamin`) REFERENCES `jenis_kelamin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dosen_prodi` FOREIGN KEY (`prodi`) REFERENCES `prodi` (`kode_prodi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dosen_user` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mhs_jk` FOREIGN KEY (`jenis_kelamin`) REFERENCES `jenis_kelamin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mhs_prodi` FOREIGN KEY (`prodi`) REFERENCES `prodi` (`kode_prodi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mhs_user` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD CONSTRAINT `fakpro` FOREIGN KEY (`kode_fakultas`) REFERENCES `fakultas` (`kode_fakultas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_level` FOREIGN KEY (`level`) REFERENCES `level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
