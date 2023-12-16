-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2023 pada 15.21
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datum-gereja`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dsc_aktivitas`
--

CREATE TABLE `dsc_aktivitas` (
  `id_aktivitas` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dsc_anggota_keluarga`
--

CREATE TABLE `dsc_anggota_keluarga` (
  `id_keluarga` varchar(13) NOT NULL,
  `id_anggota` varchar(15) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `nama_baptis` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(150) DEFAULT NULL,
  `tempat_baptis` varchar(100) DEFAULT NULL,
  `tgl_baptis` date DEFAULT NULL,
  `tempat_krisma` varchar(100) DEFAULT NULL,
  `tgl_krisma` date DEFAULT NULL,
  `jns_kelamin` varchar(9) DEFAULT NULL,
  `gol_darah` varchar(2) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `status_keluarga` varchar(25) DEFAULT NULL,
  `ayah_kandung` varchar(150) DEFAULT NULL,
  `ibu_kandung` varchar(150) DEFAULT NULL,
  `pertanyaan` text DEFAULT NULL,
  `tempat_tinggal` varchar(25) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `is_head` varchar(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dsc_detail_aktivitas`
--

CREATE TABLE `dsc_detail_aktivitas` (
  `id_anggota` varchar(15) NOT NULL,
  `id_aktivitas` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dsc_detail_kategorial`
--

CREATE TABLE `dsc_detail_kategorial` (
  `id_anggota` varchar(15) NOT NULL,
  `id_kategorial` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dsc_detail_pekerjaan`
--

CREATE TABLE `dsc_detail_pekerjaan` (
  `id_anggota` varchar(15) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dsc_detail_pendidikan`
--

CREATE TABLE `dsc_detail_pendidikan` (
  `id_anggota` varchar(15) NOT NULL,
  `id_pendidikan` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dsc_detail_pernikahan`
--

CREATE TABLE `dsc_detail_pernikahan` (
  `id_anggota` varchar(15) NOT NULL,
  `tempat_menikah` varchar(100) DEFAULT NULL,
  `tgl_menikah` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dsc_detail_sekolah`
--

CREATE TABLE `dsc_detail_sekolah` (
  `id_anggota` varchar(15) NOT NULL,
  `satuan_pendidikan` varchar(25) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `tingkat_pendidikan` varchar(3) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dsc_kategorial`
--

CREATE TABLE `dsc_kategorial` (
  `id_kategorial` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dsc_keluarga`
--

CREATE TABLE `dsc_keluarga` (
  `id_lingkungan` varchar(4) NOT NULL,
  `id_keluarga` varchar(13) NOT NULL,
  `no_kk` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `rt_rw` varchar(7) NOT NULL,
  `kelurahan` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dsc_lingkungan`
--

CREATE TABLE `dsc_lingkungan` (
  `id_lingkungan` varchar(4) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dsc_paroki`
--

CREATE TABLE `dsc_paroki` (
  `id_paroki` varchar(1) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dsc_pekerjaan`
--

CREATE TABLE `dsc_pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dsc_pendidikan`
--

CREATE TABLE `dsc_pendidikan` (
  `id_pendidikan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dsc_users`
--

CREATE TABLE `dsc_users` (
  `uid` varchar(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` varchar(9) NOT NULL,
  `is_first` varchar(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `dsc_users`
--

INSERT INTO `dsc_users` (`uid`, `name`, `email`, `username`, `password`, `role`, `status`, `is_first`, `created_at`, `updated_at`, `deleted_at`) VALUES
('AD202110001', 'Admin', '', 'admin', '$2y$10$tRzBCtjee/Df1ysZ6lWfH.wSeXBX2IkvNmK9vC3sB8KnU4KlKbrSm', 'Paroki', 'Aktif', 'N', '2021-11-12 00:00:00', '2021-11-17 01:09:52', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dsc_users_lingkungan`
--

CREATE TABLE `dsc_users_lingkungan` (
  `uid_lingkungan` varchar(9) NOT NULL,
  `uid` varchar(11) NOT NULL,
  `id_lingkungan` varchar(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dsc_aktivitas`
--
ALTER TABLE `dsc_aktivitas`
  ADD PRIMARY KEY (`id_aktivitas`);

--
-- Indeks untuk tabel `dsc_anggota_keluarga`
--
ALTER TABLE `dsc_anggota_keluarga`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `dsc_kategorial`
--
ALTER TABLE `dsc_kategorial`
  ADD PRIMARY KEY (`id_kategorial`);

--
-- Indeks untuk tabel `dsc_keluarga`
--
ALTER TABLE `dsc_keluarga`
  ADD PRIMARY KEY (`id_keluarga`);

--
-- Indeks untuk tabel `dsc_lingkungan`
--
ALTER TABLE `dsc_lingkungan`
  ADD PRIMARY KEY (`id_lingkungan`);

--
-- Indeks untuk tabel `dsc_paroki`
--
ALTER TABLE `dsc_paroki`
  ADD PRIMARY KEY (`id_paroki`);

--
-- Indeks untuk tabel `dsc_pekerjaan`
--
ALTER TABLE `dsc_pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indeks untuk tabel `dsc_pendidikan`
--
ALTER TABLE `dsc_pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`);

--
-- Indeks untuk tabel `dsc_users`
--
ALTER TABLE `dsc_users`
  ADD PRIMARY KEY (`uid`);

--
-- Indeks untuk tabel `dsc_users_lingkungan`
--
ALTER TABLE `dsc_users_lingkungan`
  ADD PRIMARY KEY (`uid_lingkungan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dsc_aktivitas`
--
ALTER TABLE `dsc_aktivitas`
  MODIFY `id_aktivitas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dsc_kategorial`
--
ALTER TABLE `dsc_kategorial`
  MODIFY `id_kategorial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dsc_pekerjaan`
--
ALTER TABLE `dsc_pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dsc_pendidikan`
--
ALTER TABLE `dsc_pendidikan`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
