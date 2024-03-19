-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Mar 2024 pada 03.44
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventaris_gudang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_nomor_keluar` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode_bidang` varchar(255) NOT NULL,
  `tanggal_keluar` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `jumlah_unit_keluar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_nomor_keluar`, `nama`, `kode_bidang`, `tanggal_keluar`, `nama_barang`, `satuan`, `jumlah_unit_keluar`) VALUES
(1, 'rery', '02 Dalep', '2024-03-18', 'buku keuangan', 'PCS', '1 buah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_nomor_masuk` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode_bidang` varchar(255) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `jumlah_unit_masuk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_nomor_masuk`, `nama`, `kode_bidang`, `tanggal_masuk`, `nama_barang`, `satuan`, `jumlah_unit_masuk`) VALUES
(1, 'rery', '05 Inpraswil', '2024-03-18', 'mouse komputer', 'PCS', '2 buah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode_bidang`
--

CREATE TABLE `kode_bidang` (
  `id_kode_bidang` int(11) NOT NULL,
  `nama_bidang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kode_bidang`
--

INSERT INTO `kode_bidang` (`id_kode_bidang`, `nama_bidang`) VALUES
(1, '01 Sekretariat'),
(2, '02 Dalep'),
(3, '03 PTT'),
(4, '04 Ekonomi'),
(5, '05 Inpraswil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login_session_key` varchar(255) DEFAULT NULL,
  `email_status` varchar(255) DEFAULT NULL,
  `password_expire_date` datetime DEFAULT '2024-06-17 00:00:00',
  `password_reset_key` varchar(255) DEFAULT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `nama`, `email`, `login_session_key`, `email_status`, `password_expire_date`, `password_reset_key`, `user_role_id`) VALUES
(1, 'admin', '$2y$10$mFLUGPafsBpzQHKJwyJ/LO2hTX.A3VbIY/H590nLejGTUCWr0.fce', 'Rihanna', 'wiwin8585@gmail.com', NULL, NULL, '2024-06-17 00:00:00', NULL, 1),
(2, 'User', '$2y$10$GW7b1yTOTZMAzOlA9DrqpOx1htlMoWXu.Z3QD7O64nFLlheQyKDa6', 'Katy Perry', 'salvatera82@gmail.com', NULL, NULL, '2024-06-17 00:00:00', NULL, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_permissions`
--

CREATE TABLE `role_permissions` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `action_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role_permissions`
--

INSERT INTO `role_permissions` (`permission_id`, `role_id`, `page_name`, `action_name`) VALUES
(177, 1, 'barang_keluar', 'list'),
(178, 1, 'barang_keluar', 'view'),
(179, 1, 'barang_keluar', 'add'),
(180, 1, 'barang_keluar', 'edit'),
(181, 1, 'barang_keluar', 'editfield'),
(182, 1, 'barang_keluar', 'delete'),
(183, 1, 'barang_keluar', 'import_data'),
(184, 1, 'barang_masuk', 'list'),
(185, 1, 'barang_masuk', 'view'),
(186, 1, 'barang_masuk', 'add'),
(187, 1, 'barang_masuk', 'edit'),
(188, 1, 'barang_masuk', 'editfield'),
(189, 1, 'barang_masuk', 'delete'),
(190, 1, 'barang_masuk', 'import_data'),
(191, 1, 'kode_bidang', 'list'),
(192, 1, 'kode_bidang', 'view'),
(193, 1, 'kode_bidang', 'add'),
(194, 1, 'kode_bidang', 'edit'),
(195, 1, 'kode_bidang', 'editfield'),
(196, 1, 'kode_bidang', 'delete'),
(197, 1, 'kode_bidang', 'import_data'),
(198, 1, 'satuan', 'list'),
(199, 1, 'satuan', 'view'),
(200, 1, 'satuan', 'add'),
(201, 1, 'satuan', 'edit'),
(202, 1, 'satuan', 'editfield'),
(203, 1, 'satuan', 'delete'),
(204, 1, 'satuan', 'import_data'),
(205, 2, 'barang_keluar', 'list'),
(206, 2, 'barang_keluar', 'view'),
(207, 2, 'barang_keluar', 'add'),
(208, 2, 'barang_keluar', 'edit'),
(209, 2, 'barang_keluar', 'editfield'),
(210, 2, 'barang_keluar', 'delete'),
(211, 2, 'barang_keluar', 'import_data'),
(212, 2, 'barang_masuk', 'list'),
(213, 2, 'barang_masuk', 'view'),
(214, 2, 'barang_masuk', 'add'),
(215, 2, 'barang_masuk', 'edit'),
(216, 2, 'barang_masuk', 'editfield'),
(217, 2, 'barang_masuk', 'delete'),
(218, 2, 'barang_masuk', 'import_data');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(1, 'Rim'),
(2, 'Pcs'),
(3, 'lusin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_nomor_keluar`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_nomor_masuk`);

--
-- Indeks untuk tabel `kode_bidang`
--
ALTER TABLE `kode_bidang`
  ADD PRIMARY KEY (`id_kode_bidang`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indeks untuk tabel `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_nomor_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_nomor_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kode_bidang`
--
ALTER TABLE `kode_bidang`
  MODIFY `id_kode_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
