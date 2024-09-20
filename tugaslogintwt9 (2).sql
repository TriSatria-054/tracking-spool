-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jun 2024 pada 11.05
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
-- Database: `tugaslogintwt9`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `install_spool`
--

CREATE TABLE `install_spool` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `line_number` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `material` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `contractor` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `install_spool`
--

INSERT INTO `install_spool` (`id`, `user_id`, `line_number`, `status`, `material`, `area`, `contractor`, `created_at`) VALUES
(11, 8, 'd', 1, 'd', 'd', 'd', '2024-05-23 23:14:13'),
(12, 8, 'd', 1, 'd', 'd', 'd', '2024-05-23 23:15:22'),
(13, 8, 'd', 1, 'd', 'd', 'd', '2024-05-23 23:28:24'),
(14, 8, 'd', 1, 'd', 'd', 'd', '2024-05-23 23:29:10'),
(15, 8, 'd', 1, 'd', 'd', 'd', '2024-05-24 21:05:28'),
(16, 8, 'd', 1, 'd', 'd', 'd', '2024-05-24 21:08:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `move_spool`
--

CREATE TABLE `move_spool` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `line_number` text NOT NULL,
  `status` text NOT NULL,
  `material` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `contractor` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_installed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `move_spool`
--

INSERT INTO `move_spool` (`id`, `user_id`, `line_number`, `status`, `material`, `area`, `contractor`, `created_at`, `is_installed`) VALUES
(27, 7, 'd', 'da', 'd', 'd', 'd', '2024-05-23 15:16:17', 1),
(28, 8, 'd', 'adwdadwaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'd', 'd', 'd', '2024-05-23 15:16:20', 1),
(29, 8, 'd', 'dawd', 'd', 'd', 'd', '2024-05-23 15:47:46', 1),
(30, 8, 'd', 'dawd', 'd', 'd', 'd', '2024-05-23 15:51:11', 1),
(31, 8, 'd', 'dwad', 'd', 'd', 'd', '2024-05-23 15:53:10', 1),
(32, 8, 'd', 'eff', 'd', 'd', 'd', '2024-05-23 15:53:46', 1),
(33, 8, 'd', 'gegsg', 'd', 'd', 'd', '2024-05-23 15:57:23', 1),
(34, 8, 'd', '', 'd', 'd', 'd', '2024-05-23 16:02:05', 1),
(35, 8, 'd', '', 'd', 'd', 'd', '2024-05-23 16:03:25', 1),
(36, 8, 'd', '', 'd', 'd', 'd', '2024-05-23 16:06:33', 1),
(37, 8, 'd', '', 'd', 'd', 'd', '2024-05-23 16:06:50', 1),
(38, 8, 'd', '', 'd', 'd', 'd', '2024-05-23 16:12:53', 1),
(39, 8, 'd', '', 'd', 'd', 'd', '2024-05-23 16:14:16', 1),
(40, 8, 'd', '', 'd', 'd', 'd', '2024-05-23 16:15:37', 1),
(41, 8, 'd', '', 'd', 'd', 'd', '2024-05-23 16:28:24', 1),
(42, 8, 'd', '', 'd', 'd', 'd', '2024-05-23 16:29:10', 1),
(43, 8, 'd', '', 'd', 'd', 'd', '2024-05-24 14:05:28', 1),
(44, 8, 'd', '', 'd', 'd', 'd', '2024-05-24 14:08:41', 1),
(45, 8, 'd', '', 'd', 'd', 'd', '2024-05-24 14:09:22', 0),
(46, 8, 'd', '', 'd', 'd', 'd', '2024-06-01 05:59:46', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `spool`
--

CREATE TABLE `spool` (
  `id` int(11) NOT NULL,
  `qrcode` text NOT NULL,
  `test_package` varchar(100) NOT NULL,
  `p_id` varchar(100) NOT NULL,
  `subsystem_name` varchar(100) NOT NULL,
  `line_number` text NOT NULL,
  `material` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `contractor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `spool`
--

INSERT INTO `spool` (`id`, `qrcode`, `test_package`, `p_id`, `subsystem_name`, `line_number`, `material`, `area`, `contractor`) VALUES
(20, 'iVBORw0KGgoAAAANSUhEUgAAAJMAAACTAQMAAACwK7lWAAAABlBMVEX///8AAABVwtN+AAAACXBIWXMAAA7EAAAOxAGVKw4bAAAB/UlEQVRIieWVMa7sIAxFHaWgIxtAYht0bCmzgQnZANkSHduIxAYyHUUUv8tM5v9X4vqhKBKnQPb1tU30187EHJy9lJlduTxfEqZp3LLlSuR3crhKmC9rMtqdsyJyHIUs+sKprHxqOVuzefA5E19ShjwSbmbIJfzKrYdBv+jK/f3XtIvhDHk8iKMfv6CXTQwB7KuWjc2SzSxh2kGAEVEcdC6QUMJI8Zb22XHwNOU7mF7mT7gsKjiOlnS/18mGylvdh1S2ah7ZHiKW8I3M59vju5Yw7cor4z3SqiAhkjAihADAhy8XfbTvZRPcne3ajAYwBgnTypA3WrU8Xnzn0cmGxIdDT5spt9KRhE18Ds1iHAge//ZHH3tnP66Jpmo02Shj9CQMkjYSNmYRg1OiI8SyMWrIQcKmdFJzSvtv6ZwlDEYLjl8ZMwx5fNq6l2HWzmqMan9UuLUECUO51goZbFDNsyJGipY6BswDR49/fd7Hpjyu6I+MQAyp27udTLsmQ/Q7lFv43lHdrFl7qdBvXKsNIubPienpbfA7ZqcWMbKH5/U9ThYul4S9ZTDokiftT2IRa3uGLCfG+Ly+Pu1k8FfwBtPo2fYMnpQwXzYULdPAdru9JmCRdlKfPGwUsi3R7NqaYt5JxNo+LwF7xu8o4Cxhb/3OB+pWzfz1bif7W+cHkp2QMQ7exdUAAAAASUVORK5CYII=', 'ad', 'd', 'd', 'd', 'd', 'd', 'd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_picture` text NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'client',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `userinfo`
--

INSERT INTO `userinfo` (`id`, `username`, `user_email`, `password`, `profile_picture`, `role`, `created_at`) VALUES
(7, 'Strx68 ', 'satriaboang68@gmail.com', '', 'https://lh3.googleusercontent.com/a/ACg8ocI9zUVyHlF6_QMFY5iJXjA5-eODdAr5ctNiFb-MpPK6JiJ8tA=s96-c', 'client', '2024-05-23 14:59:47'),
(8, 'F2_Tri Satria', 'satriaboang67@gmail.com', '', 'https://lh3.googleusercontent.com/a/ACg8ocJ00zHhSi5e-dw0vAhyYi-YUFAAA7g9asdRaXB7UhHCdKMR0r5z=s96-c', 'admin', '2024-05-30 03:48:10'),
(9, ' ', '', '', '', 'client', '2024-05-24 15:28:06'),
(10, 'a', 'a', '$2y$10$GIX0SP/ESLk0KaUCkRMzHOTtqMmwh1/An7yx49Myrx3WCIK5oeYva', 'https://toppng.com//public/uploads/preview/circled-user-icon-user-pro-icon-11553397069rpnu1bqqup.png', 'client', '2024-06-02 05:25:11');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `install_spool`
--
ALTER TABLE `install_spool`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `move_spool`
--
ALTER TABLE `move_spool`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `spool`
--
ALTER TABLE `spool`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `install_spool`
--
ALTER TABLE `install_spool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `move_spool`
--
ALTER TABLE `move_spool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `spool`
--
ALTER TABLE `spool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
