-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Des 2024 pada 23.06
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
-- Database: `keuangan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `catatan`
--

CREATE TABLE `catatan` (
  `id_catatan` int(11) NOT NULL,
  `id_user` varchar(500) NOT NULL,
  `judul_catatan` varchar(500) NOT NULL,
  `catatan` text NOT NULL,
  `tanggal_catatan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `catatan`
--

INSERT INTO `catatan` (`id_catatan`, `id_user`, `judul_catatan`, `catatan`, `tanggal_catatan`) VALUES
(2, '1', 'kerja kelompok ', 'mau kerja kelompok tugas besar alpro jam 2 siang', '02-12-2024'),
(4, '2', 'makan siang', 'hari iini', '02-12-2024'),
(5, '1', 'makan swk', 'makan di swk sekalian bahas tubes kalo jadi', '02-12-2024'),
(6, '1', 'mengerjakan tubes', 'tubes psi, alpro dan tugas lms ada 6', '02-12-2024');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` varchar(500) NOT NULL,
  `saldo_transaksi` varchar(500) NOT NULL,
  `keterangan_transaksi` text NOT NULL,
  `tanggal_transaksi` varchar(500) NOT NULL,
  `jenis_transaksi` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `saldo_transaksi`, `keterangan_transaksi`, `tanggal_transaksi`, `jenis_transaksi`) VALUES
(1, '1', '10000', 'uang jajan dari papa', '01-12-2024', '+'),
(2, '1', '5000', 'uang jajan lagi', '01-12-2024', '+'),
(3, '1', '4000', 'beli makan', '01-12-2024', '-'),
(4, '1', '12000', 'wkwkw', '01-12-2024', '-'),
(5, '1', '10000', 'sangu', '01-12-2024', '+'),
(6, '1', '500000', 'Sangu mingguan', '02-12-2024', '+'),
(7, '1', '900000', 'Bayar kost', '02-12-2024', '+'),
(8, '2', '2000000', 'uang saku bulanan', '02-12-2024', '+'),
(9, '1', '10000', 'jajan ', '02-12-2024', '-'),
(10, '1', '5000', 'jajan', '02-12-2024', '-'),
(11, '1', '4000', 'jajan lagi wkwkwkkw', '02-12-2024', '-'),
(12, '1', '1000', 'pentol', '02-12-2024', '-'),
(13, '1', '900000', 'bayar kost', '02-12-2024', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name_user` varchar(500) NOT NULL,
  `email_user` varchar(500) NOT NULL,
  `password_user` varchar(500) NOT NULL,
  `image_user` varchar(500) NOT NULL,
  `saldo_user` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `name_user`, `email_user`, `password_user`, `image_user`, `saldo_user`) VALUES
(1, 'Naufal Adli', 'naufaladli@gmail.com', '9955c26a5dba4d3e52b47a2ce912e8e6', '-', '489000'),
(2, 'Jhoni Nugroho', 'joniganskuy@gmail.com', '63b68c1ad6892d0c34c47213252c4e96', '-', '2000000');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id_catatan`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id_catatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
