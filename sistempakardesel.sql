-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Bulan Mei 2022 pada 14.33
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistempakardesel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`) VALUES
(2, 'dodik', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `basis_pengetahuan`
--

CREATE TABLE `basis_pengetahuan` (
  `id_pengetahuan` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `mb_basis` float NOT NULL,
  `md_basis` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `basis_pengetahuan`
--

INSERT INTO `basis_pengetahuan` (`id_pengetahuan`, `id_admin`, `keterangan`, `mb_basis`, `md_basis`) VALUES
(10, 2, 'Sangat Yakin', 1, 0.2),
(11, 2, 'Yakin', 0.8, 0.1),
(12, 2, 'Cukup Yakin', 0.6, 0),
(13, 2, 'Sedikit Yakin', 0.4, 0),
(14, 2, 'Tidak Tahu', 0.2, 0),
(15, 2, 'Tidak', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `kd_kerusakan` varchar(20) NOT NULL,
  `nilai_cf` double NOT NULL,
  `Kemungkinan_kerusakan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `kd_kerusakan`, `nilai_cf`, `Kemungkinan_kerusakan`) VALUES
(4751, 'K001', 0.8, ''),
(4752, 'K002', 0.72, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_diagnosa`
--

CREATE TABLE `t_diagnosa` (
  `kd_diagnosa` int(10) NOT NULL,
  `id_gejala` int(11) NOT NULL,
  `kd_kerusakan` varchar(20) NOT NULL,
  `mb` float NOT NULL,
  `md` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_gejala`
--

CREATE TABLE `t_gejala` (
  `id_gejala` int(11) NOT NULL,
  `kd_gejala` varchar(120) NOT NULL,
  `kd_kerusakaan` varchar(20) NOT NULL,
  `nama_gejala` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_gejala`
--

INSERT INTO `t_gejala` (`id_gejala`, `kd_gejala`, `kd_kerusakaan`, `nama_gejala`) VALUES
(1, 'G01', 'K001', 'sistem pengapian hilang'),
(2, 'G07', 'K001', 'tidak bisa nyala'),
(3, 'G08', 'K001', 'Susah Nyala'),
(4, 'G011', 'K001', 'Sering Mogok'),
(5, 'G02', 'K002', 'mesin tidak stabil'),
(6, 'G03', 'K002', 'gas tidak bisa dikecilkan ( bandang )'),
(7, 'G01', 'K002', 'tidak bisa nyala'),
(8, 'G08', 'K002', 'Susah Nyala'),
(9, 'G010', 'K002', 'Boros BBM'),
(10, 'G010', 'K002', 'Oli Campur Bensin'),
(11, 'G03', 'K002', 'gas tidak bisa dikecilkan ( bandang )'),
(12, 'G10', 'K003', 'ddd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kerusakan`
--

CREATE TABLE `t_kerusakan` (
  `kd_kerusakan` varchar(20) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama_kerusakan` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_kerusakan`
--

INSERT INTO `t_kerusakan` (`kd_kerusakan`, `id_admin`, `nama_kerusakan`) VALUES
('K001', 2, 'Busi'),
('K002', 2, 'Karburator'),
('K003', 2, 'Ring Piston'),
('K004', 2, 'Klep (Valve)'),
('K005', 2, 'Gigi (Gear Governoor)'),
('K006', 2, 'Klaker (Bearing Crankshaft)'),
('K007', 2, 'CDI');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `basis_pengetahuan`
--
ALTER TABLE `basis_pengetahuan`
  ADD PRIMARY KEY (`id_pengetahuan`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_kerusakan` (`kd_kerusakan`) USING BTREE;

--
-- Indeks untuk tabel `t_diagnosa`
--
ALTER TABLE `t_diagnosa`
  ADD PRIMARY KEY (`kd_diagnosa`),
  ADD KEY `kd_kerusakan` (`kd_kerusakan`),
  ADD KEY `id_gejala` (`id_gejala`);

--
-- Indeks untuk tabel `t_gejala`
--
ALTER TABLE `t_gejala`
  ADD PRIMARY KEY (`id_gejala`),
  ADD KEY `kd_kerusakan` (`kd_kerusakaan`) USING BTREE;

--
-- Indeks untuk tabel `t_kerusakan`
--
ALTER TABLE `t_kerusakan`
  ADD PRIMARY KEY (`kd_kerusakan`),
  ADD KEY `id_admin` (`id_admin`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `basis_pengetahuan`
--
ALTER TABLE `basis_pengetahuan`
  MODIFY `id_pengetahuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4753;

--
-- AUTO_INCREMENT untuk tabel `t_diagnosa`
--
ALTER TABLE `t_diagnosa`
  MODIFY `kd_diagnosa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1693;

--
-- AUTO_INCREMENT untuk tabel `t_gejala`
--
ALTER TABLE `t_gejala`
  MODIFY `id_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `basis_pengetahuan`
--
ALTER TABLE `basis_pengetahuan`
  ADD CONSTRAINT `basis_pengetahuan_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);

--
-- Ketidakleluasaan untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`kd_kerusakan`) REFERENCES `t_kerusakan` (`kd_kerusakan`);

--
-- Ketidakleluasaan untuk tabel `t_diagnosa`
--
ALTER TABLE `t_diagnosa`
  ADD CONSTRAINT `t_diagnosa_ibfk_1` FOREIGN KEY (`kd_kerusakan`) REFERENCES `t_kerusakan` (`kd_kerusakan`);

--
-- Ketidakleluasaan untuk tabel `t_gejala`
--
ALTER TABLE `t_gejala`
  ADD CONSTRAINT `t_gejala_ibfk_1` FOREIGN KEY (`kd_kerusakaan`) REFERENCES `t_kerusakan` (`kd_kerusakan`);

--
-- Ketidakleluasaan untuk tabel `t_kerusakan`
--
ALTER TABLE `t_kerusakan`
  ADD CONSTRAINT `t_kerusakan_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
