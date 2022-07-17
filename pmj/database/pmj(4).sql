-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2022 at 05:22 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pmj`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengunjung`
--

CREATE TABLE `detail_pengunjung` (
  `id_detail_pengunjung` int(11) NOT NULL,
  `id_pengunjung` varchar(5) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `pendidikan` varchar(25) NOT NULL,
  `id_produk` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pengunjung`
--

INSERT INTO `detail_pengunjung` (`id_detail_pengunjung`, `id_pengunjung`, `nama`, `alamat`, `no_hp`, `pendidikan`, `id_produk`) VALUES
(17, '12', 'Ahmad joni', 'wfsaf', '2134124', 'SD', ''),
(18, '12', 'Ahmad', 'disana', '32-4', 'TK', ''),
(19, '14', 'eHen', 'disana', '083123', 'TK', ''),
(20, '14', 'asd', 'asd', '4234', 'TK', ''),
(21, '14', 'vbdgf', 'bcxb', '34532', 'TK', ''),
(22, '3', 'czxc', 'xzczx', 'cxzczx', 'TK', ''),
(23, '3', 'wrfsefds', 'sdfsdfds', 'fsdfsd', 'TK', '');

-- --------------------------------------------------------

--
-- Table structure for table `item_tukar_poin`
--

CREATE TABLE `item_tukar_poin` (
  `id_item_tukar_poin` int(25) NOT NULL,
  `nama_item_tukar_poin` varchar(25) NOT NULL,
  `gambar` text NOT NULL,
  `keterangan` text NOT NULL,
  `poin` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_tukar_poin`
--

INSERT INTO `item_tukar_poin` (`id_item_tukar_poin`, `nama_item_tukar_poin`, `gambar`, `keterangan`, `poin`) VALUES
(5, 'Paket 1', '220517115141.jpg', 'eskrim\r\nayam\r\nnasi ', 4),
(6, 'Mainan', '220605090751.png', 'kucing', 90),
(7, 'asd', '220521055409.png', 'asd', 0),
(9, 'Laptop', '220605090927.jpg', 'legion', 0);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_pengunjung` varchar(5) NOT NULL,
  `id_detail_pengunjung` varchar(5) NOT NULL,
  `id_produk` varchar(5) NOT NULL,
  `qty` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(3) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `email` text NOT NULL,
  `nohp` varchar(12) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `email`, `nohp`, `password`) VALUES
(1, 'Ahmad Syarif', 'maransi', '081212121212', '11'),
(5, 'Wesman', 'psdnpn', 'kndcvkn', '123'),
(6, 'Hamid', 'abc@gmail.com', '098', '123'),
(7, 'Hamid Septian', 'hamid@gmail.com', '018123', '');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan_keranjang`
--

CREATE TABLE `pelanggan_keranjang` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `kategori` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id_pengunjung` int(11) NOT NULL,
  `nama_kelompok` varchar(25) NOT NULL,
  `tgl_kunjungan` date NOT NULL DEFAULT current_timestamp(),
  `jam_kunjungan` varchar(25) NOT NULL,
  `pj` varchar(25) NOT NULL,
  `nohp_pj` varchar(25) NOT NULL,
  `id_pelanggan` varchar(5) NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`id_pengunjung`, `nama_kelompok`, `tgl_kunjungan`, `jam_kunjungan`, `pj`, `nohp_pj`, `id_pelanggan`, `kategori`, `status`) VALUES
(3, 'kelompok ini', '2022-06-06', '', '', '', '5', 'Kelompok', 'Booking'),
(12, 'khvjkh', '2022-05-13', '04:27', '', '', '5', 'Kelompok', 'Booking'),
(13, '', '2022-06-09', '04:31', '', '', '1', 'Pribadi', 'Booking'),
(14, 'Kelompok A', '2022-06-14', '16:50', '', '', '6', 'Kelompok', 'Selesai'),
(15, '', '2022-06-23', '07:02', '', '', '1', 'Pribadi', 'Selesai'),
(16, '', '2022-06-23', '07:07', '', '', '7', 'Pribadi', 'Selesai'),
(17, '', '2022-06-23', '07:08', '', '', '1', 'Pribadi', 'Selesai'),
(18, '', '2022-06-23', '07:09', '', '', '7', 'Pribadi', 'Selesai'),
(19, '', '2022-06-23', '07:10', '', '', '1', 'Pribadi', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_pengunjung` varchar(5) NOT NULL,
  `id_detail_pengunjung` varchar(5) NOT NULL,
  `id_produk` varchar(5) NOT NULL,
  `qty` varchar(5) NOT NULL,
  `waktu_pesan` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_pengunjung`, `id_detail_pengunjung`, `id_produk`, `qty`, `waktu_pesan`, `status`) VALUES
(48, '12', '18', '1', '3', '2022-06-18 00:32:43', ''),
(49, '12', '18', '2', '1', '2022-06-08 00:32:43', ''),
(51, '12', '17', '2', '6', '2022-06-01 00:32:43', ''),
(54, '14', '21', '1', '2', '2022-06-18 00:32:43', ''),
(55, '14', '21', '3', '1', '2022-06-18 00:32:43', ''),
(67, '13', '', '1', '2', '2022-06-23 03:11:52', 'Diproses'),
(68, '13', '', '2', '2', '2022-06-23 03:12:49', 'Diproses'),
(69, '13', '', '1', '2', '2022-06-23 03:32:50', 'Diproses'),
(70, '13', '', '1', '2', '2022-06-23 03:36:48', 'Diproses'),
(71, '3', '22', '1', '2', '2022-06-23 03:38:51', 'Diproses'),
(72, '3', '22', '1', '3', '2022-06-23 03:38:54', 'Diproses'),
(73, '3', '23', '1', '2', '2022-06-23 03:55:19', 'Diproses'),
(74, '3', '23', '1', '2', '2022-06-23 04:00:40', 'Diproses'),
(75, '15', '', '1', '1', '2022-06-23 05:02:44', 'Selesai'),
(76, '16', '', '1', '83', '2022-06-23 05:07:23', 'Diproses'),
(77, '17', '', '2', '1', '2022-06-23 05:08:22', ''),
(78, '18', '', '3', '3', '2022-06-23 05:09:41', 'Diproses'),
(79, '19', '', '2', '1', '2022-06-23 05:10:17', 'Selesai'),
(80, '16', '', '1', '6', '2022-07-02 00:15:48', 'Diproses'),
(81, '16', '', '1', '3', '2022-07-02 02:34:58', 'Diproses'),
(82, '19', '', '3', '2', '2022-07-02 02:39:33', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `pmj`
--

CREATE TABLE `pmj` (
  `id` int(3) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `nohp` varchar(13) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pmj`
--

INSERT INTO `pmj` (`id`, `nama`, `alamat`, `nohp`, `jabatan`, `email`, `password`, `foto`) VALUES
(4, 'Ica', 'Sitebasssss', '0811111', 'Ownersssss', '1111', '1111', '220510040820.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(25) NOT NULL,
  `nama_produk` varchar(25) NOT NULL,
  `harga` int(12) NOT NULL,
  `gambar` text NOT NULL,
  `harga_per` varchar(25) NOT NULL,
  `keterangan` text NOT NULL,
  `poin` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `gambar`, `harga_per`, `keterangan`, `poin`) VALUES
(1, 'Doube Box', 150000, '220606045750.jpg', 'Bok', 's', 4),
(2, 'Big Box', 200000, '220606045811.jpg', 'box', 'besar', 5),
(3, 'Pizza Rendang', 40000, '220606045836.jpg', 'Unit', '-', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_bantu`
--

CREATE TABLE `tabel_bantu` (
  `id` int(11) NOT NULL,
  `ukuran_kertas_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_bantu`
--

INSERT INTO `tabel_bantu` (`id`, `ukuran_kertas_item`) VALUES
(1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_poin`
--

CREATE TABLE `transaksi_poin` (
  `id_transaksi` int(11) NOT NULL,
  `id_pengunjung` varchar(5) NOT NULL,
  `id_pelanggan` varchar(5) NOT NULL,
  `tgl_kunjungan` varchar(25) NOT NULL,
  `jam_kunjungan` varchar(25) NOT NULL,
  `jumlah_belanja` int(12) NOT NULL,
  `poin` int(5) NOT NULL,
  `status_poin` varchar(15) NOT NULL,
  `id_item_tukar_poin` varchar(5) NOT NULL,
  `qty` int(3) NOT NULL,
  `tgl_transaksi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_poin`
--

INSERT INTO `transaksi_poin` (`id_transaksi`, `id_pengunjung`, `id_pelanggan`, `tgl_kunjungan`, `jam_kunjungan`, `jumlah_belanja`, `poin`, `status_poin`, `id_item_tukar_poin`, `qty`, `tgl_transaksi`) VALUES
(7, '', '5', '', '', 0, 0, '-', '5', 1, '2022-06-13 03:17:44'),
(8, '', '5', '', '', 0, 0, '-', '5', 1, '2022-06-13 03:17:49'),
(9, '', '5', '', '', 0, 0, '-', '5', 1, '2022-06-13 03:18:45'),
(10, '', '5', '', '', 0, 0, '-', '6', 3, '2022-06-13 03:19:25'),
(18, '', '6', '', '', 0, 0, '-', '5', 1, '2022-06-14 16:59:01'),
(30, '13', '1', '2022-06-09', '04:31', 34, 1300000, '+', '', 0, '2022-06-23 05:36:50'),
(36, '3', '5', '2022-06-06', '', 1350000, 36, '+', '', 0, '2022-06-23 06:01:47'),
(37, '12', '5', '2022-05-13', '04:27', 1850000, 47, '+', '', 0, '2022-06-23 06:06:34'),
(47, '14', '6', '2022-06-14', '16:50', 340000, 14, '+', '', 0, '2022-07-02 04:31:55'),
(50, '15', '1', '2022-06-23', '07:02', 150000, 4, '+', '', 0, '2022-07-02 04:34:43'),
(51, '16', '7', '2022-06-23', '07:07', 0, 0, '+', '', 0, '2022-07-02 04:35:04'),
(52, '17', '1', '2022-06-23', '07:08', 0, 0, '+', '', 0, '2022-07-02 04:36:49'),
(53, '18', '7', '2022-06-23', '07:09', 0, 0, '+', '', 0, '2022-07-02 04:37:11'),
(54, '19', '1', '2022-06-23', '07:10', 0, 0, '+', '', 0, '2022-07-02 04:40:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pengunjung`
--
ALTER TABLE `detail_pengunjung`
  ADD PRIMARY KEY (`id_detail_pengunjung`);

--
-- Indexes for table `item_tukar_poin`
--
ALTER TABLE `item_tukar_poin`
  ADD PRIMARY KEY (`id_item_tukar_poin`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pelanggan_keranjang`
--
ALTER TABLE `pelanggan_keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id_pengunjung`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `pmj`
--
ALTER TABLE `pmj`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tabel_bantu`
--
ALTER TABLE `tabel_bantu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_poin`
--
ALTER TABLE `transaksi_poin`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pengunjung`
--
ALTER TABLE `detail_pengunjung`
  MODIFY `id_detail_pengunjung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `item_tukar_poin`
--
ALTER TABLE `item_tukar_poin`
  MODIFY `id_item_tukar_poin` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelanggan_keranjang`
--
ALTER TABLE `pelanggan_keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id_pengunjung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `pmj`
--
ALTER TABLE `pmj`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tabel_bantu`
--
ALTER TABLE `tabel_bantu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi_poin`
--
ALTER TABLE `transaksi_poin`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
