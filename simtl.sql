-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Bulan Mei 2023 pada 03.49
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simtl`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_12_06_142752_create_ncr_table', 1),
(6, '2022_12_11_014942_create_tlncr_table', 1),
(7, '2022_12_11_043013_create_ofi_table', 1),
(8, '2022_12_11_043535_create_tlofi_table', 1),
(9, '2022_12_28_064129_add_disetujui_oleh_to_tlncr_table', 1),
(10, '2022_12_29_012622_create_nc_table', 1),
(11, '2022_12_29_012859_create_tlnc_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nc`
--

CREATE TABLE `nc` (
  `id_nc` bigint(20) UNSIGNED NOT NULL,
  `opsi_temuan` varchar(50) DEFAULT NULL,
  `no_nc` varchar(200) DEFAULT NULL,
  `proses_audit` varchar(10) DEFAULT NULL,
  `tema_audit` varchar(10) DEFAULT NULL,
  `objek_audit` varchar(50) DEFAULT NULL,
  `jenis_temuan` varchar(25) DEFAULT NULL,
  `dokumen` varchar(5) DEFAULT NULL,
  `tgl_terbitnc` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `bukti` varchar(200) DEFAULT NULL,
  `bab_audit` varchar(100) DEFAULT NULL,
  `dok_acuan` varchar(100) DEFAULT NULL,
  `uraian_nc` text DEFAULT NULL,
  `kategori` varchar(5) DEFAULT NULL,
  `ttd_auditor_nc` text DEFAULT NULL,
  `nama_auditor` varchar(100) DEFAULT NULL,
  `tgl_deadline` date DEFAULT NULL,
  `ttd_diakui_oleh_nc` text DEFAULT NULL,
  `diakui_oleh` varchar(100) DEFAULT NULL,
  `ttd_disetujui_oleh_nc` text DEFAULT NULL,
  `disetujui_oleh` varchar(50) DEFAULT NULL,
  `tgl_accgm` date DEFAULT NULL,
  `tgl_planaction` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `nc`
--

INSERT INTO `nc` (`id_nc`, `opsi_temuan`, `no_nc`, `proses_audit`, `tema_audit`, `objek_audit`, `jenis_temuan`, `dokumen`, `tgl_terbitnc`, `status`, `bukti`, `bab_audit`, `dok_acuan`, `uraian_nc`, `kategori`, `ttd_auditor_nc`, `nama_auditor`, `tgl_deadline`, `ttd_diakui_oleh_nc`, `diakui_oleh`, `ttd_disetujui_oleh_nc`, `disetujui_oleh`, `tgl_accgm`, `tgl_planaction`, `created_at`, `updated_at`) VALUES
(50, 'NCR', '001/INT/SMM/NC/23', 'Internal', '34', '21', 'NC', NULL, '2023-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-17', NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-02 18:49:21', '2023-05-02 18:49:26'),
(51, 'NCR', NULL, 'Internal', '34', '20', 'NC', NULL, '2023-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-17', NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-02 18:49:46', '2023-05-02 18:49:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ncr`
--

CREATE TABLE `ncr` (
  `id_ncr` bigint(20) UNSIGNED NOT NULL,
  `no_ncr` varchar(200) DEFAULT NULL,
  `proses_audit` varchar(10) DEFAULT NULL,
  `tema_audit` varchar(10) DEFAULT NULL,
  `objek_audit` varchar(50) DEFAULT NULL,
  `jenis_temuan` varchar(25) DEFAULT NULL,
  `dokumen` varchar(5) DEFAULT NULL,
  `tgl_terbitncr` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `bukti` varchar(200) DEFAULT NULL,
  `bab_audit` varchar(100) DEFAULT NULL,
  `dok_acuan` varchar(100) DEFAULT NULL,
  `uraian_ncr` text DEFAULT NULL,
  `kategori` varchar(5) DEFAULT NULL,
  `nama_auditor` varchar(100) DEFAULT NULL,
  `ttd_auditor` text DEFAULT NULL,
  `ttd_auditee` text DEFAULT NULL,
  `ttd_auditee_gm_sm` text DEFAULT NULL,
  `tgl_deadline` date DEFAULT NULL,
  `diakui_oleh` varchar(100) DEFAULT NULL,
  `diakui_oleh_option` varchar(50) DEFAULT NULL,
  `disetujui_oleh1` varchar(50) DEFAULT NULL,
  `tgl_accgm1` date DEFAULT NULL,
  `tgl_planaction` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ncr`
--

INSERT INTO `ncr` (`id_ncr`, `no_ncr`, `proses_audit`, `tema_audit`, `objek_audit`, `jenis_temuan`, `dokumen`, `tgl_terbitncr`, `status`, `bukti`, `bab_audit`, `dok_acuan`, `uraian_ncr`, `kategori`, `nama_auditor`, `ttd_auditor`, `ttd_auditee`, `ttd_auditee_gm_sm`, `tgl_deadline`, `diakui_oleh`, `diakui_oleh_option`, `disetujui_oleh1`, `tgl_accgm1`, `tgl_planaction`, `created_at`, `updated_at`) VALUES
(191, '001/Int/SMM/NCR/23', 'Internal', '34', '20', 'NCR', NULL, '2023-05-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-16', NULL, NULL, NULL, NULL, NULL, '2023-05-01 23:50:19', '2023-05-02 00:46:42'),
(192, '002/Int/SMM/NCR/23', 'Internal', '34', '16', 'NCR', NULL, '2023-05-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-16', NULL, NULL, NULL, NULL, NULL, '2023-05-02 00:47:03', '2023-05-02 00:47:10'),
(193, '001/Int/SMAP/NCR/23', 'Internal', '35', '19', 'NCR', NULL, '2023-05-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-16', NULL, NULL, NULL, NULL, NULL, '2023-05-02 00:52:41', '2023-05-02 00:52:48'),
(194, '002/Int/SMAP/NCR/23', 'Internal', '35', '22', 'NCR', NULL, '2023-05-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-16', NULL, NULL, NULL, NULL, NULL, '2023-05-02 00:53:10', '2023-05-02 00:53:19'),
(211, '003/Int/SMM/NCR/23', 'Internal', '34', '23', 'NCR', NULL, '2023-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-17', NULL, NULL, NULL, NULL, NULL, '2023-05-02 19:20:41', '2023-05-02 19:56:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ofi`
--

CREATE TABLE `ofi` (
  `id_ofi` bigint(20) UNSIGNED NOT NULL,
  `no_ofi` varchar(20) DEFAULT NULL,
  `proses_audit` varchar(10) DEFAULT NULL,
  `tema_audit` varchar(10) DEFAULT NULL,
  `objek_audit` varchar(50) DEFAULT NULL,
  `jenis_temuan` varchar(25) DEFAULT NULL,
  `dokumen` varchar(5) DEFAULT NULL,
  `tgl_terbitofi` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `bukti` varchar(200) DEFAULT NULL,
  `lampiran1` varchar(200) DEFAULT NULL,
  `lampiran2` varchar(200) DEFAULT NULL,
  `lampiran3` varchar(200) DEFAULT NULL,
  `lampiran4` varchar(200) DEFAULT NULL,
  `lampiran5` varchar(200) DEFAULT NULL,
  `lampiran6` varchar(200) DEFAULT NULL,
  `asal_dept` varchar(100) DEFAULT NULL,
  `proyek` varchar(50) DEFAULT NULL,
  `dept_ygmngrjkn` varchar(100) DEFAULT NULL,
  `usulan_ofi` varchar(200) DEFAULT NULL,
  `uraian_permasalahan` text DEFAULT NULL,
  `usulan_peningkatan` text DEFAULT NULL,
  `ttd_dept_pengusul` text DEFAULT NULL,
  `dept_pengusul` varchar(100) DEFAULT NULL,
  `tgl_diusulkan` date DEFAULT NULL,
  `ttd_disetujui_oleh_ofi` text DEFAULT NULL,
  `disetujui_oleh` varchar(100) DEFAULT NULL,
  `tgl_disetujui` date DEFAULT NULL,
  `disposisi` varchar(100) DEFAULT NULL,
  `ttd_disposisi` text DEFAULT NULL,
  `disposisi_diselesaikan_oleh` varchar(100) DEFAULT NULL,
  `tgl_deadline` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ofi`
--

INSERT INTO `ofi` (`id_ofi`, `no_ofi`, `proses_audit`, `tema_audit`, `objek_audit`, `jenis_temuan`, `dokumen`, `tgl_terbitofi`, `status`, `bukti`, `lampiran1`, `lampiran2`, `lampiran3`, `lampiran4`, `lampiran5`, `lampiran6`, `asal_dept`, `proyek`, `dept_ygmngrjkn`, `usulan_ofi`, `uraian_permasalahan`, `usulan_peningkatan`, `ttd_dept_pengusul`, `dept_pengusul`, `tgl_diusulkan`, `ttd_disetujui_oleh_ofi`, `disetujui_oleh`, `tgl_disetujui`, `disposisi`, `ttd_disposisi`, `disposisi_diselesaikan_oleh`, `tgl_deadline`, `created_at`, `updated_at`) VALUES
(31, '001/Int/SMM/OFI/23', 'Internal', '34', '24', 'OFI', NULL, '2023-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-03', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-01', '2023-05-02 19:57:30', '2023-05-02 19:57:56'),
(32, '002/Int/SMM/OFI/23', 'Internal', '34', '24', 'OFI', NULL, '2023-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-03', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-01', '2023-05-02 19:58:11', '2023-05-02 19:58:16'),
(33, '001/Eks/SMM/OFI/23', 'Eksternal', '34', '21', 'OFI', NULL, '2023-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-03', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-01', '2023-05-02 19:58:31', '2023-05-02 19:58:35'),
(34, '003/Int/SMM/OFI/23', NULL, '34', '22', 'OFI', NULL, '2023-05-03', 'Belum Ditindaklanjuti', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-03', NULL, NULL, NULL, 'OFI diterima', NULL, NULL, '2023-08-01', '2023-05-02 20:01:49', '2023-05-03 00:42:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tema`
--

CREATE TABLE `tema` (
  `id_tema` bigint(20) UNSIGNED NOT NULL,
  `nama_tema` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tema`
--

INSERT INTO `tema` (`id_tema`, `nama_tema`, `created_at`, `updated_at`) VALUES
(1, 'ISO 9001 : 2015 (SMM)', '2023-04-16 20:32:49', '2023-04-16 20:32:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tlnc`
--

CREATE TABLE `tlnc` (
  `id_formnctl` bigint(20) UNSIGNED NOT NULL,
  `id_nc` int(11) NOT NULL,
  `akar_masalah` text DEFAULT NULL,
  `uraian_perbaikan` text DEFAULT NULL,
  `uraian_pencegahan` text DEFAULT NULL,
  `tgl_action` date DEFAULT NULL,
  `ttd_disetujui_oleh_tlnc` text DEFAULT NULL,
  `disetujui_oleh_tl` varchar(100) DEFAULT NULL,
  `tgl_accgm` date DEFAULT NULL,
  `uraian_verifikasi` text DEFAULT NULL,
  `hasil_verif` varchar(15) DEFAULT NULL,
  `ttd_verifikator_tlnc` text DEFAULT NULL,
  `verifikator` varchar(100) DEFAULT NULL,
  `tgl_verif` date DEFAULT NULL,
  `rekomendasi` text DEFAULT NULL,
  `ttd_verifsm_tlnc` text DEFAULT NULL,
  `namasm_verif` varchar(200) DEFAULT NULL,
  `tgl_verifsm` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tlnc`
--

INSERT INTO `tlnc` (`id_formnctl`, `id_nc`, `akar_masalah`, `uraian_perbaikan`, `uraian_pencegahan`, `tgl_action`, `ttd_disetujui_oleh_tlnc`, `disetujui_oleh_tl`, `tgl_accgm`, `uraian_verifikasi`, `hasil_verif`, `ttd_verifikator_tlnc`, `verifikator`, `tgl_verif`, `rekomendasi`, `ttd_verifsm_tlnc`, `namasm_verif`, `tgl_verifsm`, `created_at`, `updated_at`) VALUES
(13, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-11 02:26:37', '2023-04-11 02:26:37'),
(14, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-11 17:44:00', '2023-04-11 17:44:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tlncr`
--

CREATE TABLE `tlncr` (
  `id_formncrtl` bigint(20) UNSIGNED NOT NULL,
  `id_ncr` int(11) NOT NULL,
  `akar_masalah` text DEFAULT NULL,
  `uraian_perbaikan` text DEFAULT NULL,
  `uraian_pencegahan` text DEFAULT NULL,
  `tgl_action` date DEFAULT NULL,
  `ttd_tl_gm` text DEFAULT NULL,
  `ttd_tl_verif_auditor` text DEFAULT NULL,
  `ttd_tl_verif_adm` text DEFAULT NULL,
  `disetujui_oleh2` varchar(50) DEFAULT NULL,
  `tgl_accgm2` date DEFAULT NULL,
  `uraian_verifikasi` text DEFAULT NULL,
  `hasil_verif` varchar(15) DEFAULT NULL,
  `verifikator` varchar(100) DEFAULT NULL,
  `tgl_verif` date DEFAULT NULL,
  `rekomendasi` text DEFAULT NULL,
  `namasm_verif` varchar(200) DEFAULT NULL,
  `tgl_verif_adm2` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tlofi`
--

CREATE TABLE `tlofi` (
  `id_formofitl` bigint(20) UNSIGNED NOT NULL,
  `id_ofi` varchar(15) DEFAULT NULL,
  `tl_usulanofi` text DEFAULT NULL,
  `ttd_tlofi_oleh` text DEFAULT NULL,
  `nama_pekerjatl` varchar(100) DEFAULT NULL,
  `tgl_tl` date DEFAULT NULL,
  `uraian_verif` text DEFAULT NULL,
  `hasil_verif` varchar(500) DEFAULT NULL,
  `ttd_tlofi_verif` text DEFAULT NULL,
  `nama_verifikator` varchar(100) DEFAULT NULL,
  `tgl_verif` date DEFAULT NULL,
  `eval_saran` varchar(500) DEFAULT NULL,
  `nama_evaluator` varchar(100) DEFAULT NULL,
  `skor` varchar(5) DEFAULT NULL,
  `rekom_tinjauan` varchar(500) DEFAULT NULL,
  `namasm_verifikator` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tlofi`
--

INSERT INTO `tlofi` (`id_formofitl`, `id_ofi`, `tl_usulanofi`, `ttd_tlofi_oleh`, `nama_pekerjatl`, `tgl_tl`, `uraian_verif`, `hasil_verif`, `ttd_tlofi_verif`, `nama_verifikator`, `tgl_verif`, `eval_saran`, `nama_evaluator`, `skor`, `rekom_tinjauan`, `namasm_verifikator`, `created_at`, `updated_at`) VALUES
(22, '34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-03 00:42:20', '2023-05-03 00:42:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nip`, `role`, `name`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '001', 'Admin', 'Administrator', 'admin', '$2y$10$Oya39HQ25JtzCKqtnSIVguHOdZylSFwidfvQWCO1a42OltzxRHUSu', 'VyrClMNWCanphFpd7bU6IyUqnGmGGrQg617gzv30oGWNNqPGrOeRizQZqMrz', '2022-12-18 19:21:58', '2022-12-18 19:21:58'),
(2, '002', 'Auditor', 'Auditor', 'auditor', '$2y$10$lFDar/te5pnvsz01n47W1.EB8YhDsjijFWiQKBS0qNSSkG.plGc1q', 'OghonroehPhYDAEllaebOdUD583NUydCN3tyosgxbGae3xYLMPjbBVasCV0e', '2022-12-18 19:21:58', '2022-12-18 19:21:58'),
(6, '1', 'Auditee', 'Departemen TJSL dan Stakeholder Relationship', 'TJSL', '$2y$10$JuAmKGIoB2CPJJ/j0E6QLuVmwz6H9Kz/nYrplZrY9ezIROiXQQoxu', NULL, '2022-12-20 19:46:44', '2022-12-20 19:46:44'),
(7, '2', 'Auditee', 'Departemen Kantor Perwakilan dan Kesekretariatan', 'kanwil', '$2y$10$fg91ioREbj.VJkmPqUdyXuPvqj4Eahczt.wYElppT98izLwBT9/xa', NULL, '2022-12-20 19:47:26', '2022-12-20 19:47:26'),
(8, '3', 'Auditee', 'Departemen Audit Operasional', 'auditops', '$2y$10$7oJvz37.Fss4qf6oy7ZOhunBYmH3Oh.DKW3eX25Chq3E2TON97e.O', NULL, '2022-12-20 19:48:18', '2022-12-20 19:48:18'),
(9, '4', 'Auditee', 'Departemen Audit Keuangan', 'auditkeu', '$2y$10$SweJa28KE0bRgm4V9OEjYejp4i/uI6m/9ox.uqZlH9JHJcepXLNZi', NULL, '2022-12-20 19:48:58', '2022-12-20 19:48:58'),
(10, '5', 'Auditee', 'Departemen Tata Kelola Perusahaan', 'tatakelola', '$2y$10$JKVeCPQi.57rjnfk5k2WdeimtZSkV.Q.OlAV/y2EPPWbX5P/fG0Cu', NULL, '2022-12-20 19:49:25', '2022-12-20 19:49:25'),
(11, '6', 'Auditee', 'Departemen Perencanaan dan Pengendalian Keuangan', 'rendalkeu', '$2y$10$i.3W7M3RKPNxzet69EF/c.iri8HNMNHN0vRdsaJXdw5t.TAyzz1F2', NULL, '2022-12-20 19:50:19', '2022-12-20 19:50:19'),
(12, '7', 'Auditee', 'Departemen Pendanaan dan Perbendaharaan', 'bendahara', '$2y$10$7dfrQDE.ONYzRMUWdv8WnOWOwuzqUmQHore.HitnBf68nFSh2zxQK', NULL, '2022-12-20 19:51:00', '2022-12-20 19:51:00'),
(13, '8', 'Auditee', 'Departemen Akuntansi dan Perpajakan', 'akuntansi', '$2y$10$c/VRr8RjI3J8uburY9qNguaziuVrFZl2NlZl0owl/KsZOZlROU4/m', NULL, '2022-12-20 19:51:44', '2022-12-20 19:51:44'),
(14, '9', 'Auditee', 'Departemen Perencanaan, Pengelolaan dan Pengembangan SDM', 'pengembangansdm', '$2y$10$1pCA7eag.vxQpJPQ1QFKzeX6W7i9KR1eFtKO4mvg0veVk6EqfxAxm', NULL, '2022-12-20 19:53:40', '2022-12-20 19:53:40'),
(15, '10', 'Auditee', 'Departemen Kesejahteraan SDM dan Hubungan Industrial', 'kesejahteraansdm', '$2y$10$iG3dS.wr69o7mcnQ0SUXcecVZdhZ0UGalXz8C.F7Fsu2FeU5g7o1W', NULL, '2022-12-20 19:54:27', '2022-12-20 19:54:27'),
(16, '11', 'Auditee', 'Departemen General Affairs', 'generalaffairs', '$2y$10$PwwKz1hpGgfYUF/4olX5weafe0Bib656klwyBgvQ87kRcZY/kpNc6', NULL, '2022-12-20 19:54:58', '2022-12-20 19:54:58'),
(17, '12', 'Auditee', 'Departemen Manajemen Risiko dan Kepatuhan', 'manrisk', '$2y$10$UwFWsGl15pTc8J489u1IU.LdQBCOH8I5N5MswrrH39CIHa0OoLzia', NULL, '2022-12-20 19:55:28', '2022-12-20 19:55:28'),
(18, '13', 'Auditee', 'Departemen Hukum', 'hukum', '$2y$10$W6e7fgtT8dhinf1R0qVofOp6aY32zNC134o3PPUm7sG3zLgcwIKAy', NULL, '2022-12-20 19:55:55', '2022-12-20 19:55:55'),
(19, '14', 'Auditee', 'Departemen Engineering', 'engineering', '$2y$10$kHC3h7GlvuTxJXii.hWkV.rtUcZ46VoVCdj8/dvG2vRGLcWNp1Cva', NULL, '2022-12-20 19:56:20', '2022-12-20 19:56:20'),
(20, '15', 'Auditee', 'Departemen Desain', 'desain', '$2y$10$bMIBR8dgUnxNDifXxfbFNOyOCAULa36Vy5NeGkkaCJzNcHYhMJunm', NULL, '2022-12-20 19:57:52', '2022-12-20 19:57:52'),
(21, '16', 'Auditee', 'Departemen Pengendalian Kualitas', 'pengendaliankualitas', '$2y$10$7Vum70PwE4YK4Ww7JJN7fe59zkGNkLf91PaZcykIvDx4CR7YBJLQa', NULL, '2022-12-20 19:58:35', '2022-12-20 19:58:35'),
(22, '17', 'Auditee', 'Departemen Pengembangan Perusahaan', 'deptpp', '$2y$10$xU2Vr5v0ZYff/k.9P1LemO7WgdUlM.kZx8DZ0ua7dgBgegec.99fK', NULL, '2022-12-20 19:59:11', '2022-12-20 19:59:11'),
(23, '18', 'Auditee', 'Departemen Pengembangan Produk dan Teknologi', 'pengembanganproduktek', '$2y$10$r4yiLebwcTOgbl3TzeE/JOddOUuizPWHaaI6T69DT6jR7kXHJAzKm', NULL, '2022-12-20 20:00:01', '2022-12-20 20:00:01'),
(24, '19', 'Auditee', 'Departemen Pengembangan Bisnis', 'pengembanganbisnis', '$2y$10$St6.HVetzjegSpbqthGKLO1rSpcvAIscvZwslS2adRdONNlqs.tmS', NULL, '2022-12-20 20:00:34', '2022-12-20 20:00:34'),
(25, '20', 'Auditee', 'Departemen Teknologi Informasi', 'deptit', '$2y$10$EfDQdTEim/TZRyBm/9TgE.onzxBSaE5BZdjAwS/P7leD/rgIHoZ92', NULL, '2022-12-20 20:01:19', '2022-12-20 20:01:19'),
(26, '21', 'Auditee', 'SBU Tier 1 dan 2', 'sbutier', '$2y$10$CI4segzeut1UlFYuLJom6.Gc87h1K.Mu4teT3EUXudqryM7E6JAYO', NULL, '2022-12-21 21:27:12', '2022-12-21 21:27:12'),
(27, '22', 'Auditee', 'Departemen Pemasaran Proyek', 'pemasaran', '$2y$10$XLrIdgFYg06pVcrS32tzgO4d.tLuRsQbvj1O9uualjEaWV0kUNBse', NULL, '2022-12-21 21:28:01', '2022-12-21 21:28:01'),
(28, '23', 'Auditee', 'Departemen Bid and Pricing', 'bidpricing', '$2y$10$0q6Ev0i9HAO3D01KJSP/EOtJVuOk3s5VbvGhSot/l/ntPK06SSjE.', NULL, '2022-12-21 21:28:40', '2022-12-21 21:28:40'),
(29, '24', 'Auditee', 'Departemen Manajemen Rantai Pasokan', 'deptmrp', '$2y$10$X44JaGEutgFQtbyqzGyeM.993LKXom.WPCEBkqieV9WgbPIr9U1V6', NULL, '2022-12-21 21:29:12', '2022-12-21 21:29:12'),
(30, '25', 'Auditee', 'Departemen Perencanaan dan Pengendalian Produksi', 'rendalprod', '$2y$10$lgmwEIHvrk2LBtNnGxBT9e/uoKOXea5jHuEeg./TZLk0U85MdSjbC', NULL, '2022-12-21 21:31:43', '2022-12-21 21:31:43'),
(31, '26', 'Auditee', 'Departemen Penyediaan Jasa', 'penyediaanjasa', '$2y$10$1l/txM4chdVWrP.elt6e0.kwR6SDbygfT5BCw7tB4cnIzWHVu2pWe', NULL, '2022-12-21 21:32:18', '2022-12-21 21:32:18'),
(32, '27', 'Auditee', 'Departemen Pengelolaan Proyek', 'pengelolaanproyek', '$2y$10$DwgPHW9lrVBhi675qRJOCetYLdW2RA/m79i4NOreA6C3VHntqn7AK', NULL, '2022-12-21 21:32:40', '2022-12-21 21:32:40'),
(33, '01', 'Auditee', 'Auditor', 'auditor1', '$2y$10$yMrF8ehvCpjZTHuzlAOpbOnmd94L8sxpRgcqgPFmbdIgnz/RPjjqe', NULL, '2022-12-26 00:15:20', '2022-12-26 00:15:20'),
(34, '001', 'Tema', 'ISO 9001 : 2015  SMM', 'SMM', '$2y$10$JXI84SMYXngkZvTxZuns/OjOTjH46LeQSGt6Nq8Ovi3/49MMF6rMa', NULL, '2023-03-19 19:54:16', '2023-05-02 19:59:44'),
(35, '002', 'Tema', 'SMAP', 'ISO 37001 : 2016 SMAP', '$2y$10$.2myy34E8WRpMU46Ok0Cd.OU7mxs0EkNN.5DKHxVAaRfqYj0FGE9W', NULL, '2023-03-19 19:55:37', '2023-05-02 17:54:51'),
(36, '003', 'Tema', 'IRIS', 'ISO/TS 22163 : 2017 IRIS', '$2y$10$yyn3GyJucy8WwTgQ4G9awOU9zwby19RjeCLWts3lzpI3IaBj8i7fK', NULL, '2023-03-19 19:56:04', '2023-05-02 17:57:22'),
(37, '004', 'Tema', 'ISO 14001  : 2015', 'ISO 14001', '$2y$10$Z/atdsrfd/TcALD01MiZg.8mozR7WBlC7CandczKD6zTe6c2NkTjS', NULL, '2023-03-19 19:56:32', '2023-05-02 17:57:46'),
(38, '005', 'Tema', 'SMK3LH', 'ISO 45001 : 2018 SMK3LH', '$2y$10$w7m6s0R8djdT5fHGWRCnMerEA9lDke3hGol.wKeMBfi3w3tLsYiG2', NULL, '2023-03-19 19:57:04', '2023-05-02 17:58:24'),
(39, '1', 'Admin2', 'Admin2', 'Admin2', '$2y$10$lDvSxDDs3lwc9QsjS4Wd9uKHYnPjOHJ2Kp64iCdq5Vu.lo0oHMhnm', NULL, '2023-03-23 18:02:40', '2023-03-23 18:02:40');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nc`
--
ALTER TABLE `nc`
  ADD PRIMARY KEY (`id_nc`);

--
-- Indeks untuk tabel `ncr`
--
ALTER TABLE `ncr`
  ADD PRIMARY KEY (`id_ncr`);

--
-- Indeks untuk tabel `ofi`
--
ALTER TABLE `ofi`
  ADD PRIMARY KEY (`id_ofi`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id_tema`);

--
-- Indeks untuk tabel `tlnc`
--
ALTER TABLE `tlnc`
  ADD PRIMARY KEY (`id_formnctl`);

--
-- Indeks untuk tabel `tlncr`
--
ALTER TABLE `tlncr`
  ADD PRIMARY KEY (`id_formncrtl`);

--
-- Indeks untuk tabel `tlofi`
--
ALTER TABLE `tlofi`
  ADD PRIMARY KEY (`id_formofitl`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `nc`
--
ALTER TABLE `nc`
  MODIFY `id_nc` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `ncr`
--
ALTER TABLE `ncr`
  MODIFY `id_ncr` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT untuk tabel `ofi`
--
ALTER TABLE `ofi`
  MODIFY `id_ofi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tema`
--
ALTER TABLE `tema`
  MODIFY `id_tema` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tlnc`
--
ALTER TABLE `tlnc`
  MODIFY `id_formnctl` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tlncr`
--
ALTER TABLE `tlncr`
  MODIFY `id_formncrtl` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `tlofi`
--
ALTER TABLE `tlofi`
  MODIFY `id_formofitl` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
