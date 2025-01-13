-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jan 2025 pada 10.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bimbelonline`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_siswa`, `tanggal`, `status`) VALUES
(1, 111, '2024-12-26', 'hadir'),
(2, 111, '2024-12-26', 'hadir'),
(3, 111, '2024-12-26', 'hadir'),
(4, 111, '', 'Pilih Kehadiran'),
(5, 111, '2024-12-27', 'hadir'),
(6, 111, '', 'Pilih Kehadiran'),
(7, 111, '2024-12-19', 'tidak hadir'),
(8, 12041959, '2025-01-10', 'hadir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_absensi`
--

CREATE TABLE `table_absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_fasilitas`
--

CREATE TABLE `table_fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `nama_fasilitas` varchar(255) NOT NULL,
  `jumlah` int(16) NOT NULL,
  `status_fasilitas` enum('Lengkap','Tidak Lengkap','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `table_fasilitas`
--

INSERT INTO `table_fasilitas` (`id_fasilitas`, `nama_fasilitas`, `jumlah`, `status_fasilitas`) VALUES
(33, 'sasas', 2, 'Tidak Lengkap'),
(21, 'sasas', 12, 'Tidak Lengkap'),
(111, 'sas', 12, 'Lengkap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_jadwal`
--

CREATE TABLE `table_jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_mentor` int(13) NOT NULL,
  `id_kelas` int(16) NOT NULL,
  `no_ruang` varchar(11) NOT NULL,
  `hari` varchar(255) NOT NULL,
  `jam_kelas` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `table_jadwal`
--

INSERT INTO `table_jadwal` (`id_jadwal`, `id_mentor`, `id_kelas`, `no_ruang`, `hari`, `jam_kelas`) VALUES
(1123, 1, 222, '1', 'Sabtu', '23:00:00'),
(110111, 1, 222, '02', 'Senin', '16:00:00'),
(110116, 1, 222, '02', 'Kamis', '12:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_mentor`
--

CREATE TABLE `table_mentor` (
  `id_mentor` int(13) NOT NULL,
  `nama_mentor` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telp` int(13) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `table_mentor`
--

INSERT INTO `table_mentor` (`id_mentor`, `nama_mentor`, `email`, `telp`, `tgl_lahir`, `alamat`) VALUES
(1, 'Hesti Nawang', 'hesti@gmail.com', 321212, '1997-12-22', 'Ngawi'),
(2, 'jon', 'jon1@gmail.com', 2147483647, '2001-02-01', 'Ngawi barat dayas'),
(221, 'Rizki Pramudita', 'Riski@gmail.com', 823232189, '2024-12-03', 'Nganjuuk'),
(321, 'Roronoa Amirs', 'amsir@gmail.com', 2147483647, '2024-12-31', 'East Blue');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_paket_kls`
--

CREATE TABLE `table_paket_kls` (
  `id_kelas` int(16) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `kapasitas_kelas` int(5) NOT NULL,
  `harga` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `table_paket_kls`
--

INSERT INTO `table_paket_kls` (`id_kelas`, `nama_kelas`, `kapasitas_kelas`, `harga`) VALUES
(222, 'SKD Kedinasan', 15, '475000'),
(333, 'TNI - Polri Reguler', 12, '500000'),
(444, 'Bahasa Inggris', 12, '350000'),
(555, 'SKD CPNS', 12, '550000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_pembayaran`
--

CREATE TABLE `table_pembayaran` (
  `id_bayar` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `table_pembayaran`
--

INSERT INTO `table_pembayaran` (`id_bayar`, `tanggal`, `id_siswa`, `id_kelas`) VALUES
(50001, '2023-01-01', 12041959, 444),
(50002, '2023-07-01', 12041960, 222),
(50003, '2023-11-23', 12322121, 333),
(50004, '2023-11-02', 12041960, 222),
(50005, '2023-05-23', 12041960, 333),
(50007, '2023-11-24', 12041960, 222);

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_siswa`
--

CREATE TABLE `table_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `siswa_no_telp` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `table_siswa`
--

INSERT INTO `table_siswa` (`id_siswa`, `nama`, `siswa_no_telp`, `tanggal_lahir`, `alamat`, `tgl_daftar`) VALUES
(111, 'JUNANDA DEYASTUSESAs', '12222', '0021-12-21', 'sdsd', '1212-11-08'),
(12041959, 'SASA', '083287228918', '2023-12-23', 'SASA', '2023-09-22'),
(12041960, 'Nur Azizah Malang', '08563228918', '0102-01-01', 'Surabaya', '2023-12-23'),
(12322121, 'Adam Rendi', '08213228918', '2023-12-19', 'Malang', '2023-12-23'),
(1204220029, 'JUNANDA DEYASTUSESA', '08213223254', '2023-09-12', 'Ngawi', '2023-12-11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_user`
--

CREATE TABLE `table_user` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `table_user`
--

INSERT INTO `table_user` (`id_akun`, `username`, `pass`, `role`) VALUES
(1, 'junanda', 'juna123', 'admin'),
(2, 'hestinawang', 'hesti123', 'mentor'),
(3, 'mentor1', 'password', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indeks untuk tabel `table_absensi`
--
ALTER TABLE `table_absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indeks untuk tabel `table_jadwal`
--
ALTER TABLE `table_jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_mentor` (`id_mentor`) USING BTREE;

--
-- Indeks untuk tabel `table_mentor`
--
ALTER TABLE `table_mentor`
  ADD PRIMARY KEY (`id_mentor`);

--
-- Indeks untuk tabel `table_paket_kls`
--
ALTER TABLE `table_paket_kls`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `table_pembayaran`
--
ALTER TABLE `table_pembayaran`
  ADD PRIMARY KEY (`id_bayar`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_siswa` (`id_siswa`,`id_kelas`) USING BTREE;

--
-- Indeks untuk tabel `table_siswa`
--
ALTER TABLE `table_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`id_akun`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `table_absensi`
--
ALTER TABLE `table_absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `table_user`
--
ALTER TABLE `table_user`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `table_jadwal`
--
ALTER TABLE `table_jadwal`
  ADD CONSTRAINT `table_jadwal_ibfk_1` FOREIGN KEY (`id_mentor`) REFERENCES `table_mentor` (`id_mentor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `table_jadwal_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `table_paket_kls` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `table_pembayaran`
--
ALTER TABLE `table_pembayaran`
  ADD CONSTRAINT `table_pembayaran_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `table_paket_kls` (`id_kelas`),
  ADD CONSTRAINT `table_pembayaran_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `table_siswa` (`id_siswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
