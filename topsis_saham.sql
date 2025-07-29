-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 24, 2025 at 11:17 AM
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
-- Database: `topsis_saham`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `datasaham`
--

CREATE TABLE `datasaham` (
  `id` int(11) NOT NULL,
  `kodesaham` varchar(10) NOT NULL,
  `namaperusahaan` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `datasaham`
--

INSERT INTO `datasaham` (`id`, `kodesaham`, `namaperusahaan`, `keterangan`) VALUES
(1, 'ACES', 'PT Ace Hardware Indonesia Tbk', 'Ritel Perlengkapan Rumah'),
(2, 'ADMR', 'PT Adaro Minerals Indonesia Tbk', 'Pertambangan Mineral'),
(3, 'ADRO', 'PT Adaro Energy Indonesia Tbk', 'Energi & Pertambangan'),
(4, 'AKRA', 'PT AKR Corporindo Tbk', 'Distribusi Energi & Logistik'),
(5, 'AMMN', 'PT Amman Mineral Internasional Tbk', 'Tambang Emas dan Tembaga'),
(6, 'AMRT', 'PT Sumber Alfaria Trijaya Tbk (Alfamart)', 'Ritel'),
(7, 'ANTM', 'PT Aneka Tambang Tbk', 'Pertambangan Logam'),
(8, 'ARTO', 'PT Bank Jago Tbk', 'Perbankan Digital'),
(9, 'ASII', 'PT Astra International Tbk', 'Konglomerasi Otomotif & Finansial'),
(10, 'BBCA', 'PT Bank Central Asia Tbk', 'Perbankan'),
(11, 'BBNI', 'PT Bank Negara Indonesia (Persero) Tbk', 'Perbankan'),
(12, 'BBRI', 'PT Bank Rakyat Indonesia (Persero) Tbk', 'Perbankan Mikro'),
(13, 'BBTN', 'PT Bank Tabungan Negara (Persero) Tbk', 'Perbankan Perumahan'),
(14, 'BMRI', 'PT Bank Mandiri (Persero) Tbk', 'Perbankan'),
(15, 'BRIS', 'PT Bank Syariah Indonesia Tbk', 'Perbankan Syariah'),
(16, 'BRPT', 'PT Barito Pacific Tbk', 'Petrokimia & Energi'),
(17, 'CPIN', 'PT Charoen Pokphand Indonesia Tbk', 'Pangan & Peternakan'),
(18, 'CTRA', 'PT Ciputra Development Tbk', 'Properti'),
(19, 'ESSA', 'PT Surya Esa Perkasa Tbk', 'Petrokimia & Gas'),
(20, 'EXCL', 'PT XL Axiata Tbk', 'Telekomunikasi'),
(21, 'GOTO', 'PT GoTo Gojek Tokopedia Tbk', 'Teknologi & Platform Digital'),
(22, 'ICBP', 'PT Indofood CBP Sukses Makmur Tbk', 'Makanan & Minuman Konsumen'),
(23, 'INCO', 'PT Vale Indonesia Tbk', 'Pertambangan Nikel'),
(24, 'INDF', 'PT Indofood Sukses Makmur Tbk', 'Industri Konsumsi'),
(25, 'INKP', 'PT Indah Kiat Pulp & Paper Tbk', 'Pulp & Kertas'),
(26, 'ISAT', 'PT Indosat Tbk', 'Telekomunikasi'),
(27, 'ITMG', 'PT Indo Tambangraya Megah Tbk', 'Pertambangan Batubara'),
(28, 'JPFA', 'PT Japfa Comfeed Indonesia Tbk', 'Peternakan & Pakan Ternak'),
(29, 'JSMR', 'PT Jasa Marga (Persero) Tbk', 'Jalan Tol & Infrastruktur'),
(30, 'KLBF', 'PT Kalbe Farma Tbk', 'Farmasi & Kesehatan'),
(31, 'MAPA', 'PT MAP Aktif Adiperkasa Tbk', 'Ritel & Lifestyle'),
(32, 'MAPI', 'PT Mitra Adiperkasa Tbk', 'Ritel Mode & Gaya Hidup'),
(33, 'MBMA', 'PT Merdeka Battery Materials Tbk', 'Baterai & Logam'),
(34, 'MDKA', 'PT Merdeka Copper Gold Tbk', 'Pertambangan Emas & Tembaga'),
(35, 'MEDC', 'PT Medco Energi Internasional Tbk', 'Minyak & Gas'),
(36, 'PGAS', 'PT Perusahaan Gas Negara Tbk', 'Distribusi Gas'),
(37, 'PGEO', 'PT Pertamina Geothermal Energy Tbk', 'Energi Panas Bumi'),
(38, 'PTBA', 'PT Bukit Asam Tbk', 'Pertambangan Batubara'),
(39, 'SIDO', 'PT Industri Jamu dan Farmasi Sido Muncul Tbk', 'Farmasi & Herbal'),
(40, 'SMGR', 'PT Semen Indonesia (Persero) Tbk', 'Semen & Bahan Bangunan'),
(41, 'SMRA', 'PT Summarecon Agung Tbk', 'Properti & Real Estat'),
(42, 'TLKM', 'PT Telkom Indonesia (Persero) Tbk', 'Telekomunikasi'),
(43, 'TOWR', 'PT Sarana Menara Nusantara Tbk', 'Menara Telekomunikasi'),
(44, 'UNTR', 'PT United Tractors Tbk', 'Alat Berat & Tambang'),
(45, 'UNVR', 'PT Unilever Indonesia Tbk', 'Barang Konsumsi');

-- --------------------------------------------------------

--
-- Table structure for table `saham`
--

CREATE TABLE `saham` (
  `id` int(11) NOT NULL,
  `kode_saham` varchar(10) DEFAULT NULL,
  `nama_perusahaan` varchar(100) DEFAULT NULL,
  `eps` float DEFAULT NULL,
  `pbv` float DEFAULT NULL,
  `dpr` float DEFAULT NULL,
  `der` float DEFAULT NULL,
  `roa` float DEFAULT NULL,
  `roe` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saham`
--

INSERT INTO `saham` (`id`, `kode_saham`, `nama_perusahaan`, `eps`, `pbv`, `dpr`, `der`, `roa`, `roe`) VALUES
(1, 'ACES', 'Aspirasi Hidup Indonesia Tbk', 49.76, 2.19, 67.32, 0.25, 7.34, 9.2),
(2, 'ADMR', 'Adaro Minerals Indonesia Tbk', 195, 2.02, 0, 0.38, 20.97, 28.94),
(3, 'ADRO', 'Alamtri Resources Indonesia Tbk', 792.6, 0.86, 196.59, 0.2, 23.22, 28.97),
(4, 'AKRA', 'AKR Corporindo Tbk', 126.52, 1.65, 138.32, 1.19, 5.22, 11.41),
(5, 'AMMN', 'Amman Mineral Internasional Tbk', 190.05, 7.56, 0, 1.03, 6.62, 13.41),
(6, 'AMRT', 'Sumber Alfaria Trijaya Tbk', 86.99, 7.05, 32.97, 1.18, 6.76, 14.75),
(7, 'ANTM', 'Aneka Tambang Tbk', 101.13, 1.21, 126.64, 0.35, 5.44, 7.34),
(8, 'ARTO', 'Bank Jago Tbk', 7.78, 3.94, 0, 2.15, 0.32, 1.01),
(9, 'ASII', 'Astra International Tbk', 839.9, 0.73, 73.46, 0.74, 9.18, 15.99),
(10, 'BBCA', 'Bank Central Asia Tbk', 432.31, 4.49, 64.19, 4.48, 3.78, 20.87),
(11, 'BBNI', 'Bank Negara Indonesia (Persero) Tbk', 575.5, 0.96, 48.74, 5.76, 1.92, 12.96),
(12, 'BBRI', 'Bank Rakyat Indonesia (Persero) Tbk', 403.62, 1.89, 79.04, 5.17, 3.04, 18.76),
(13, 'BBTN', 'Bank Tabungan Negara (Persero) Tbk', 233.05, 0.49, 21.41, 12.52, 0.64, 9.23),
(14, 'BMRI', 'Bank Mandiri (Persero) Tbk', 621.58, 1.68, 56.95, 5.93, 2.52, 19.51),
(15, 'BRIS', 'Bank Syariah Indonesia Tbk', 143.31, 2.77, 12.94, 2.37, 1.71, 15.55),
(16, 'BRPT', 'Barito Pacific Tbk', 2.71, 1.38, 32.23, 1.48, 0.6, 1.48),
(17, 'CPIN', 'Charoen Pokphand Indonesia Tbk', 123.78, 2.7, 24.24, 0.48, 5.56, 8.25),
(18, 'CTRA', 'Ciputra Development Tbk', 104.77, 0.77, 20.04, 0.98, 3.02, 5.97),
(19, 'ESSA', 'ESSA Industries Indonesia Tbk', 51.75, 1.56, 9.66, 0.25, 8.72, 10.92),
(20, 'EXCL', 'XL Axiata Tbk', 120.14, 1.13, 40.45, 2.29, 2.14, 7.05),
(21, 'GOTO', 'GoTo Gojek Tokopedia Tbk', -74.66, 2.63, 0, 0.42, -12.65, -17.97),
(22, 'ICBP', 'Indofood CBP Sukses Makmur Tbk', 692.84, 1.96, 28.87, 0.83, 7.55, 13.84),
(23, 'INCO', 'Vale Indonesia Tbk', 125.18, 0.86, 0, 0.16, 1.82, 2.11),
(24, 'INDF', 'Indofood Sukses Makmur Tbk', 1118.97, 0.63, 23.86, 0.81, 6.28, 11.38),
(25, 'INKP', 'Indah Kiat Pulp & Paper Tbk', 878.68, 0.4, 5.69, 0.83, 1.99, 3.64),
(26, 'ISAT', 'Indosat Tbk', 173.56, 2.18, 154.65, 2.12, 4.61, 14.39),
(27, 'ITMG', 'Indo Tambangraya Megah Tbk', 4933.02, 0.97, 60.31, 0.24, 15.61, 19.42),
(28, 'JPFA', 'Japfa Comfeed Indonesia Tbk', 178.09, 1.37, 39.31, 1.09, 9.27, 19.38),
(29, 'JSMR', 'Jasa Marga (Persero) Tbk', 567.59, 0.55, 6.67, 1.45, 3.99, 9.77),
(30, 'KLBF', 'Kalbe Farma Tbk', 65.71, 2.67, 47.18, 0.2, 8.33, 10.02),
(31, 'MAPA', 'Map Aktif Adiperkasa Tbk', 50.91, 4.48, 9.82, 0.81, 8.85, 16),
(32, 'MAPI', 'Mitra Adiperkasa Tbk', 107.08, 1.69, 7.47, 1.07, 5.63, 11.66),
(33, 'MBMA', 'Merdeka Battery Materials Tbk', 3.48, 1.4, 0, 0.44, 1.78, 2.57),
(34, 'MDKA', 'Merdeka Copper Gold Tbk', -39.46, 0.9, 0, 0.78, -0.38, -0.68),
(35, 'MEDC', 'Medco Energi Internasional Tbk', 218.42, 0.81, 20.64, 2.42, 3.68, 12.59),
(36, 'PGAS', 'Perusahaan Gas Negara Tbk', 214.84, 0.71, 69.03, 0.77, 5.44, 9.65),
(37, 'PGEO', 'Pertamina Geothermal Energy Tbk', 59.92, 1.29, 79.73, 0.49, 4.54, 6.75),
(38, 'PTBA', 'Bukit Asam Tbk', 482.35, 1.56, 82.45, 0.97, 8.12, 16.02),
(39, 'SIDO', 'Industri Jamu dan Farmasi Sido Muncul Tbk', 38.07, 5.07, 94.56, 0.13, 29.72, 33.57),
(40, 'SMGR', 'Semen Indonesia (Persero) Tbk', 174.22, 0.46, 48.63, 0.64, 0.94, 1.55),
(41, 'SMRA', 'Summarecon Agung Tbk', 63.4, 0.61, 14.2, 1.51, 3.75, 9.41),
(42, 'TLKM', 'Telkom Indonesia (Persero) Tbk', 229.51, 1.74, 77.78, 0.85, 8.07, 14.91),
(43, 'TOWR', 'Sarana Menara Nusantara Tbk', 64.19, 1.83, 28.2, 3.32, 3.14, 13.56),
(44, 'UNTR', 'United Tractors Tbk', 5590.87, 1.02, 52.53, 0.73, 11.87, 20.49),
(45, 'UNVR', 'Unilever Indonesia Tbk', 94.94, 33.46, 124.3, 6.47, 20.99, 156.74);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datasaham`
--
ALTER TABLE `datasaham`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saham`
--
ALTER TABLE `saham`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `datasaham`
--
ALTER TABLE `datasaham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `saham`
--
ALTER TABLE `saham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
