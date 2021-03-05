-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2021 at 03:10 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vapehitz2`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `kode_aksesoris` varchar(20) NOT NULL,
  `nama_aksesoris` varchar(100) NOT NULL,
  `merk_aksesoris` varchar(100) NOT NULL,
  `jenis_aksesoris` varchar(10) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `on_hand` int(11) NOT NULL,
  `stok_pusat` int(11) NOT NULL,
  `stok_retail` int(11) NOT NULL,
  `stok_studio` int(11) NOT NULL,
  `bad_stock` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `hj_agen` int(11) NOT NULL,
  `hj_retail` int(11) NOT NULL,
  `hj_whs` int(11) NOT NULL,
  `kode_supplier` varchar(20) NOT NULL,
  `id_kode_barang` varchar(20) NOT NULL,
  `seq_kode_barang` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`kode_aksesoris`, `nama_aksesoris`, `merk_aksesoris`, `jenis_aksesoris`, `ket`, `on_hand`, `stok_pusat`, `stok_retail`, `stok_studio`, `bad_stock`, `berat`, `harga_beli`, `hj_agen`, `hj_retail`, `hj_whs`, `kode_supplier`, `id_kode_barang`, `seq_kode_barang`, `status`) VALUES
('L-CHG-00001', 'Nama Aksesoris', '', 'CHG', 'Test Keterangan', 20, 180, 99, 86, 3, 1000, 75000, 80000, 90000, 100000, 'S0001', 'L-CHG', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `nama_akun` varchar(50) NOT NULL,
  `saldo_awal` int(11) NOT NULL,
  `no_akun` int(11) NOT NULL,
  `kode_cabang` int(3) NOT NULL,
  `nama_cabang_pembuka` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `nama_akun`, `saldo_awal`, `no_akun`, `kode_cabang`, `nama_cabang_pembuka`, `type`) VALUES
(7, 'BNI', 20000000, 1212121, 21, 'BNI Utama', 'Transfer'),
(9, 'BCA', 2000000, 123456789, 21, 'BCA Vapehitz', 'Transfer'),
(10, 'BCA', 200000, 12341234, 61, 'Manjahlega bank BCA', 'Transfer'),
(11, 'Cash Retail', 20000000, 0, 0, '', 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `atomizer`
--

CREATE TABLE `atomizer` (
  `kode_atomizer` varchar(20) NOT NULL,
  `merk_atomizer` varchar(20) NOT NULL,
  `nama_atomizer` varchar(100) NOT NULL,
  `jenis_atomizer` varchar(20) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `kode_warna` varchar(5) NOT NULL,
  `berat` int(11) NOT NULL,
  `on_hand` int(11) NOT NULL,
  `stok_pusat` int(11) NOT NULL,
  `stok_retail` int(11) NOT NULL,
  `stok_studio` int(11) NOT NULL,
  `bad_stock` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `hj_agen` int(11) NOT NULL,
  `hj_retail` int(11) NOT NULL,
  `hj_whs` int(11) NOT NULL,
  `kode_supplier` varchar(20) NOT NULL,
  `id_kode_barang` varchar(20) NOT NULL,
  `seq_kode_barang` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `atomizer`
--

INSERT INTO `atomizer` (`kode_atomizer`, `merk_atomizer`, `nama_atomizer`, `jenis_atomizer`, `ket`, `kode_warna`, `berat`, `on_hand`, `stok_pusat`, `stok_retail`, `stok_studio`, `bad_stock`, `harga_beli`, `hj_agen`, `hj_retail`, `hj_whs`, `kode_supplier`, `id_kode_barang`, `seq_kode_barang`, `status`) VALUES
('I-AT/RDTA-00001', 'Merk Atomizer', 'Nama Atomizer', 'RDTA', '', '2', 1000, 0, 200, 196, 195, 5, 200000, 220000, 230000, 240000, 'S0002', 'I-AT/RDTA', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `badstockgudang`
--

CREATE TABLE `badstockgudang` (
  `no_proses` varchar(30) NOT NULL,
  `tgl_proses` datetime NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `tahun` int(11) NOT NULL,
  `seq` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `badstockgudang`
--

INSERT INTO `badstockgudang` (`no_proses`, `tgl_proses`, `nama_file`, `status`, `tahun`, `seq`) VALUES
('BS/VH/2021-01/00001', '2021-01-05 00:00:00', 'File_BS_VH_2021-01_00001.jpg', 'Approve', 2021, '00001'),
('BS/VH/2021-01/00002', '2021-01-15 00:00:00', 'File_BS_VH_2021-01_00002.jpg', 'Approve', 2021, '00002'),
('BS/VH/2021-02/00003', '2021-02-13 00:00:00', 'File_BS_VH_2021-02_00003.jpg', 'Approve', 2021, '00003');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `kode_customer` varchar(20) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `alamat_customer` text NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `no_hp` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`kode_customer`, `nama_customer`, `alamat_customer`, `no_tlp`, `no_hp`, `email`, `status`) VALUES
('C0001', 'CV. Susah MoveOn', 'Jl Kesedihan', '46546564545', 2147483647, 'susah@moveon.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `dateline`
--

CREATE TABLE `dateline` (
  `id_cot` varchar(5) NOT NULL,
  `batas_waktu` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dateline`
--

INSERT INTO `dateline` (`id_cot`, `batas_waktu`, `status`, `seq`) VALUES
('COT01', 22, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `kode_device` varchar(20) NOT NULL,
  `merk_device` varchar(20) NOT NULL,
  `nama_device` varchar(100) NOT NULL,
  `jenis_device` varchar(5) NOT NULL,
  `kode_warna` int(11) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `on_hand` int(11) NOT NULL,
  `stok_pusat` int(11) NOT NULL,
  `stok_retail` int(11) NOT NULL,
  `stok_studio` int(11) NOT NULL,
  `bad_stock` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `hj_agen` int(11) NOT NULL,
  `hj_retail` int(11) NOT NULL,
  `hj_whs` int(11) NOT NULL,
  `kode_supplier` varchar(20) NOT NULL,
  `id_kode_barang` varchar(20) NOT NULL,
  `seq_kode_barang` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`kode_device`, `merk_device`, `nama_device`, `jenis_device`, `kode_warna`, `ket`, `on_hand`, `stok_pusat`, `stok_retail`, `stok_studio`, `bad_stock`, `berat`, `harga_beli`, `hj_agen`, `hj_retail`, `hj_whs`, `kode_supplier`, `id_kode_barang`, `seq_kode_barang`, `status`) VALUES
('L-DMK-00001', '-', 'Battlestar Baby By Smoant ', 'DMK', 4, '-', 0, 0, 0, 1001, 0, 250, 206227, 220000, 290000, 240000, 'S0001', 'L-DMK', 1, '1'),
('L-MDO-00001', 'Test Merk', 'Test Device', 'MDO', 2, 'Leterangan', 4, 108, 98, 92, 0, 100, 150000, 170000, 180000, 200000, 'S0001', 'L-MDO', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `permission`) VALUES
(2, 'Testing', 'a:5:{i:0;s:12:\"viewSupplier\";i:1;s:12:\"editSupplier\";i:2;s:13:\"hapusSupplier\";i:3;s:15:\"laporanSupplier\";i:4;s:12:\"viewCustomer\";}'),
(3, 'Admin', 'a:171:{i:0;s:12:\"viewSupplier\";i:1;s:14:\"tambahSupplier\";i:2;s:12:\"editSupplier\";i:3;s:13:\"hapusSupplier\";i:4;s:15:\"laporanSupplier\";i:5;s:9:\"viewSales\";i:6;s:11:\"tambahSales\";i:7;s:9:\"editSales\";i:8;s:10:\"hapusSales\";i:9;s:12:\"laporanSales\";i:10;s:12:\"viewCustomer\";i:11;s:14:\"tambahCustomer\";i:12;s:12:\"editCustomer\";i:13;s:13:\"hapusCustomer\";i:14;s:15:\"laporanCustomer\";i:15;s:10:\"viewLiquid\";i:16;s:12:\"tambahLiquid\";i:17;s:10:\"editLiquid\";i:18;s:11:\"hapusLiquid\";i:19;s:13:\"laporanLiquid\";i:20;s:16:\"viewPerlengkapan\";i:21;s:18:\"tambahPerlengkapan\";i:22;s:16:\"editPerlengkapan\";i:23;s:17:\"hapusPerlengkapan\";i:24;s:19:\"laporanPerlengkapan\";i:25;s:13:\"viewAksesoris\";i:26;s:15:\"tambahAksesoris\";i:27;s:13:\"editAksesoris\";i:28;s:14:\"hapusAksesoris\";i:29;s:16:\"laporanAksesoris\";i:30;s:12:\"viewAtomizer\";i:31;s:14:\"tambahAtomizer\";i:32;s:12:\"editAtomizer\";i:33;s:13:\"hapusAtomizer\";i:34;s:15:\"laporanAtomizer\";i:35;s:16:\"viewOrderCentral\";i:36;s:18:\"tambahOrderCentral\";i:37;s:16:\"editOrderCentral\";i:38;s:17:\"hapusOrderCentral\";i:39;s:19:\"laporanOrderCentral\";i:40;s:22:\"viewPembayaranSupplier\";i:41;s:24:\"tambahPembayaranSupplier\";i:42;s:25:\"laporanPembayaranSupplier\";i:43;s:17:\"viewReturSupplier\";i:44;s:19:\"tambahReturSupplier\";i:45;s:20:\"laporanReturSupplier\";i:46;s:25:\"viewPenyelesaianPembelian\";i:47;s:27:\"tambahPenyelesaianPembelian\";i:48;s:28:\"laporanPenyelesaianPembelian\";i:49;s:15:\"viewSaleCentral\";i:50;s:17:\"tambahSaleCentral\";i:51;s:15:\"editSaleCentral\";i:52;s:16:\"hapusSaleCentral\";i:53;s:18:\"laporanSaleCentral\";i:54;s:19:\"approvalSaleCentral\";i:55;s:22:\"viewPembayaranCustomer\";i:56;s:24:\"tambahPembayaranCustomer\";i:57;s:25:\"laporanPembayaranCustomer\";i:58;s:17:\"viewReturCustomer\";i:59;s:19:\"tambahReturCustomer\";i:60;s:20:\"laporanReturCustomer\";i:61;s:25:\"viewPenyelesaianPenjualan\";i:62;s:27:\"tambahPenyelesaianPenjualan\";i:63;s:28:\"laporanPenyelesaianPenjualan\";i:64;s:13:\"viewSopGudang\";i:65;s:15:\"tambahSopGudang\";i:66;s:13:\"editSopGudang\";i:67;s:16:\"laporanSopGudang\";i:68;s:18:\"viewBadstockGudang\";i:69;s:20:\"tambahBadstockGudang\";i:70;s:18:\"editBadstockGudang\";i:71;s:19:\"hapusBadstockGudang\";i:72;s:21:\"laporanBadstockGudang\";i:73;s:22:\"approvalBadstockGudang\";i:74;s:15:\"viewReqtoRetail\";i:75;s:17:\"tambahReqtoRetail\";i:76;s:15:\"editReqtoRetail\";i:77;s:16:\"hapusReqtoRetail\";i:78;s:18:\"laporanReqtoRetail\";i:79;s:15:\"viewReqtoStudio\";i:80;s:17:\"tambahReqtoStudio\";i:81;s:15:\"editReqtoStudio\";i:82;s:16:\"hapusReqtoStudio\";i:83;s:18:\"laporanReqtoStudio\";i:84;s:16:\"viewApprvCentral\";i:85;s:19:\"laporanApprvCentral\";i:86;s:20:\"approvalApprvCentral\";i:87;s:22:\"viewReqretailToCentral\";i:88;s:24:\"tambahReqretailToCentral\";i:89;s:22:\"editReqretailToCentral\";i:90;s:23:\"hapusReqretailToCentral\";i:91;s:25:\"laporanReqretailToCentral\";i:92;s:14:\"viewSaleRetail\";i:93;s:16:\"tambahSaleRetail\";i:94;s:17:\"laporanSaleRetail\";i:95;s:18:\"approvalSaleRetail\";i:96;s:19:\"viewReturSaleRetail\";i:97;s:21:\"tambahReturSaleRetail\";i:98;s:22:\"laporanReturSaleRetail\";i:99;s:13:\"viewSopRetail\";i:100;s:15:\"tambahSopRetail\";i:101;s:13:\"editSopRetail\";i:102;s:16:\"laporanSopRetail\";i:103;s:15:\"viewApprvRetail\";i:104;s:18:\"laporanApprvRetail\";i:105;s:19:\"approvalApprvRetail\";i:106;s:22:\"viewReqstudioToCentral\";i:107;s:24:\"tambahReqstudioToCentral\";i:108;s:22:\"editReqstudioToCentral\";i:109;s:23:\"hapusReqstudioToCentral\";i:110;s:25:\"laporanReqstudioToCentral\";i:111;s:14:\"viewSaleStudio\";i:112;s:16:\"tambahSaleStudio\";i:113;s:17:\"laporanSaleStudio\";i:114;s:18:\"approvalSaleStudio\";i:115;s:19:\"viewReturSaleStudio\";i:116;s:21:\"tambahReturSaleStudio\";i:117;s:22:\"laporanReturSaleStudio\";i:118;s:13:\"viewSopStudio\";i:119;s:15:\"tambahSopStudio\";i:120;s:13:\"editSopStudio\";i:121;s:16:\"laporanSopStudio\";i:122;s:15:\"viewApprvStudio\";i:123;s:18:\"laporanApprvStudio\";i:124;s:19:\"approvalApprvStudio\";i:125;s:13:\"viewVolLiquid\";i:126;s:15:\"tambahVolLiquid\";i:127;s:13:\"editVolLiquid\";i:128;s:14:\"hapusVolLiquid\";i:129;s:15:\"viewJenisDevice\";i:130;s:17:\"tambahJenisDevice\";i:131;s:15:\"editJenisDevice\";i:132;s:16:\"hapusJenisDevice\";i:133;s:12:\"viewJenisAcc\";i:134;s:14:\"tambahJenisAcc\";i:135;s:12:\"editJenisAcc\";i:136;s:13:\"hapusJenisAcc\";i:137;s:17:\"viewJenisAtomizer\";i:138;s:19:\"tambahJenisAtomizer\";i:139;s:17:\"editJenisAtomizer\";i:140;s:18:\"hapusJenisAtomizer\";i:141;s:12:\"viewRekening\";i:142;s:14:\"tambahRekening\";i:143;s:12:\"editRekening\";i:144;s:13:\"hapusRekening\";i:145;s:14:\"viewRasaLiquid\";i:146;s:16:\"tambahRasaLiquid\";i:147;s:14:\"editRasaLiquid\";i:148;s:15:\"hapusRasaLiquid\";i:149;s:9:\"viewWarna\";i:150;s:11:\"tambahWarna\";i:151;s:9:\"editWarna\";i:152;s:10:\"hapusWarna\";i:153;s:12:\"viewKatRetur\";i:154;s:14:\"tambahKatRetur\";i:155;s:12:\"editKatRetur\";i:156;s:13:\"hapusKatRetur\";i:157;s:12:\"viewDateLine\";i:158;s:14:\"tambahDateLine\";i:159;s:12:\"editDateLine\";i:160;s:13:\"hapusDateLine\";i:161;s:10:\"viewGroups\";i:162;s:12:\"tambahGroups\";i:163;s:10:\"editGroups\";i:164;s:11:\"hapusGroups\";i:165;s:9:\"viewUsers\";i:166;s:11:\"tambahUsers\";i:167;s:9:\"editUsers\";i:168;s:10:\"hapusUsers\";i:169;s:15:\"viewGntPassword\";i:170;s:15:\"editGntPassword\";}');

-- --------------------------------------------------------

--
-- Table structure for table `hutang`
--

CREATE TABLE `hutang` (
  `id_hutang` int(11) NOT NULL,
  `no_order` varchar(50) NOT NULL,
  `tgl_pembayaran` datetime NOT NULL,
  `jumlah_pembayaran` int(11) NOT NULL,
  `sisa_pembayaran` int(11) NOT NULL,
  `metode_pembayaran` varchar(20) NOT NULL,
  `no_rekening` varchar(50) NOT NULL,
  `catatan` text NOT NULL,
  `tgl_entry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hutang`
--

INSERT INTO `hutang` (`id_hutang`, `no_order`, `tgl_pembayaran`, `jumlah_pembayaran`, `sisa_pembayaran`, `metode_pembayaran`, `no_rekening`, `catatan`, `tgl_entry`) VALUES
(1, 'PO/VH/08122020/00001', '2020-12-08 00:00:00', 720000, 2000000, 'Transfer', 'BCA - 787941515 (Drajat)', '', '0000-00-00 00:00:00'),
(2, 'PO/VH/08122020/00001', '2020-12-08 00:00:00', 500000, 1500000, 'Transfer', 'BNI - 61656565 (Bima)', 'test', '0000-00-00 00:00:00'),
(3, 'PO/VH/08122020/00001', '2020-12-08 00:00:00', 250000, 1250000, 'Transfer', 'BNI - 61656565 (Bima)', 'Blm Done', '0000-00-00 00:00:00'),
(4, 'PO/VH/08122020/00002', '2020-12-10 00:00:00', 500000, 2300000, 'Transfer', 'BNI - 61656565 (Bima)', '', '0000-00-00 00:00:00'),
(5, 'PO/VH/08122020/00002', '2020-12-08 00:00:00', 200000, 2100000, 'Cash', '0', 'coba', '0000-00-00 00:00:00'),
(6, 'PO/VH/08122020/00002', '2020-12-08 00:00:00', 300000, 1800000, 'Cash', '0', 'assa', '0000-00-00 00:00:00'),
(7, 'PO/VH/10122020/00003', '2020-12-10 00:00:00', 0, 80000, 'Cash', '0', '', '0000-00-00 00:00:00'),
(8, 'PO/VH/10122020/00003', '2020-12-10 00:00:00', 50000, 110000, 'Cash', '0', '', '0000-00-00 00:00:00'),
(9, 'PO/VH/10122020/00004', '2020-12-12 00:00:00', 100000, 200000, 'Cash', '0', '', '0000-00-00 00:00:00'),
(10, 'PO/VH/13012021/00005', '2021-01-13 00:00:00', 3130000, 10000000, 'Transfer', 'BNI - 61656565 (Bima)', '', '0000-00-00 00:00:00'),
(11, 'PO/VH/13012021/00005', '2021-01-13 00:00:00', 5000000, 5000000, 'Cash', '0', 'cash aja', '0000-00-00 00:00:00'),
(12, 'PO/VH/13012021/00005', '2021-01-13 00:00:00', 3000000, 2000000, 'Transfer', 'BRI - 1301321323234 (Dery)', 'Transfer aja', '0000-00-00 00:00:00'),
(13, 'PO/VH/13012021/00006', '2021-01-13 00:00:00', 1100000, 2000000, 'Cash', '0', '', '0000-00-00 00:00:00'),
(14, 'PO/VH/13012021/00006', '2021-01-13 00:00:00', 1000000, 1000000, 'Cash', '0', 'test', '0000-00-00 00:00:00'),
(15, 'PO/VH/13012021/00007', '2021-01-17 00:00:00', 1100000, 2000000, 'Cash', '0', '', '0000-00-00 00:00:00'),
(16, 'PO/VH/13012021/00007', '2021-01-13 00:00:00', 1000000, 1000000, 'Cash', '0', 'test', '0000-00-00 00:00:00'),
(17, 'PO/VH/13012021/00008', '2021-01-13 00:00:00', 1100000, 2000000, 'Cash', '0', '', '0000-00-00 00:00:00'),
(18, 'PO/VH/13012021/00008', '2021-01-13 00:00:00', 1000000, 1000000, 'Transfer', 'BNI - 61656565 (Bima)', 'test', '0000-00-00 00:00:00'),
(19, 'PO/VH/16012021/00009', '2021-01-17 00:00:00', 200000, 550000, 'Transfer', 'BJB - 454566566 (Mukti)', '', '0000-00-00 00:00:00'),
(20, 'PO/VH/16012021/00009', '2021-01-16 00:00:00', 500000, 50000, 'Cash', '0', 'cASH', '0000-00-00 00:00:00'),
(21, 'PO/VH/13012021/00007', '2021-02-03 00:00:00', 200000, 300000, 'Cash', '0', 'dfsfdf', '0000-00-00 00:00:00'),
(22, 'PO/VH/03022021/00011', '2021-02-03 00:00:00', 0, 0, 'Transfer', 'BRI - 1301321323234 (Dery)', '', '0000-00-00 00:00:00'),
(23, 'PO/VH/04022021/00011', '2021-04-02 00:00:00', 100000, 150000, 'Cash', '0', '', '0000-00-00 00:00:00'),
(24, 'PO/VH/04022021/00012', '1970-01-01 01:00:00', 200000, 0, 'Cash', '0', '', '0000-00-00 00:00:00'),
(25, 'PO/VH/04022021/00013', '2021-02-18 00:00:00', 50000, 100000, 'Transfer', 'BJB - 454566566 (Mukti)', '', '0000-00-00 00:00:00'),
(26, 'PO/VH/04022021/00014', '2021-02-28 00:00:00', 510000, 1060000, 'Cash', '0', '', '0000-00-00 00:00:00'),
(27, 'PO/VH/04022021/00013', '2021-02-07 00:00:00', 100000, 0, 'Cash', '0', '', '0000-00-00 00:00:00'),
(28, 'PO/VH/08022021/00001', '2021-02-02 00:00:00', 0, 1500000, 'Cash', '0', '', '0000-00-00 00:00:00'),
(29, 'PO/VH/08022021/00001', '2021-02-08 00:00:00', 1000000, 500000, 'Cash', '0', '', '0000-00-00 00:00:00'),
(30, 'PO/VH/08022021/00001', '2021-02-08 00:00:00', 200000, 300000, 'Cash', '0', '', '0000-00-00 00:00:00'),
(31, 'PO/VH/28022021/00002', '2021-02-10 00:00:00', 4900000, -34720000, 'Cash', '0', '', '0000-00-00 00:00:00'),
(32, 'PO/VH/01032021/00003', '2021-03-09 00:00:00', 30000, 20050000, 'Transfer', 'BNI - 61656565 (Bima)', '', '0000-00-00 00:00:00'),
(33, 'PO/VH/01032021/00004', '2021-03-15 00:00:00', 100000, 80000, 'Transfer', '7', '', '0000-00-00 00:00:00'),
(34, 'PO/VH/01032021/00005', '2021-03-26 00:00:00', 340000, 0, 'Transfer', '7', '', '0000-00-00 00:00:00'),
(35, 'PO/VH/01032021/00006', '2021-03-20 00:00:00', 50000, 40000, 'Transfer', '9', '', '0000-00-00 00:00:00'),
(36, 'PO/VH/01032021/00007', '2021-03-30 00:00:00', 29999, 263001, 'Transfer', '7', '', '0000-00-00 00:00:00'),
(37, 'PO/VH/01032021/00008', '2021-03-13 00:00:00', 20000, 130000, 'Transfer', '7', '', '0000-00-00 00:00:00'),
(38, 'PO/VH/01032021/00009', '2021-03-01 00:00:00', 0, 190000, 'Transfer', '9', '', '0000-00-00 00:00:00'),
(39, 'PO/VH/01032021/00010', '2021-03-01 00:00:00', 50000, 140000, 'Transfer', '9', '', '0000-00-00 00:00:00'),
(40, 'PO/VH/01032021/00011', '2021-02-08 00:00:00', 100000, 15000, 'Cash', '0', '', '0000-00-00 00:00:00'),
(41, 'PO/VH/01032021/00012', '2021-03-08 00:00:00', 1000, 149000, 'Cash', '11', '', '0000-00-00 00:00:00'),
(42, 'PO/VH/02032021/00010', '2021-03-17 00:00:00', 4000, 226000, 'Transfer', '0', '', '0000-00-00 00:00:00'),
(43, 'PO/VH/01032021/00003', '2021-03-02 00:00:00', 200000, 19850000, 'Transfer', '0', '-', '0000-00-00 00:00:00'),
(44, 'PO/VH/01032021/00004', '2021-03-02 00:00:00', 2000, 78000, 'Transfer', '0', '-', '0000-00-00 00:00:00'),
(45, 'PO/VH/01032021/00003', '2021-03-02 00:00:00', 200000, 19650000, 'Transfer', '', '-', '0000-00-00 00:00:00'),
(46, 'PO/VH/01032021/00003', '2021-03-02 00:00:00', 1000, 19649000, 'Cash', '1', '-', '0000-00-00 00:00:00'),
(47, 'PO/VH/01032021/00003', '2021-03-02 00:00:00', 11, 19648989, 'Transfer', '', '-', '0000-00-00 00:00:00'),
(48, 'PO/VH/01032021/00003', '2021-03-02 00:00:00', 1111, 19647878, 'Transfer', '7', '-', '0000-00-00 00:00:00'),
(49, 'PO/VH/01032021/00003', '2021-03-02 00:00:00', 111, 19647767, 'Cash', '11', '-', '0000-00-00 00:00:00'),
(50, 'PO/VH/01032021/00003', '2021-03-02 00:00:00', 1212, 19646555, 'Transfer', '7', '-', '0000-00-00 00:00:00'),
(51, 'PO/VH/01032021/00003', '2021-03-02 00:00:00', 10000, 19636555, 'Cash', '11', '-', '0000-00-00 00:00:00'),
(52, 'PO/VH/02032021/00009', '2021-03-02 00:00:00', 1000, 157000, 'Transfer', '9', '', '0000-00-00 00:00:00'),
(53, 'PO/VH/02032021/00010', '2021-03-11 00:00:00', 1000, 94111, 'Transfer', '9', '', '0000-00-00 00:00:00'),
(54, 'PO/VH/02032021/00011', '2021-03-09 00:00:00', 0, 124701, 'Transfer', '7', '', '0000-00-00 00:00:00'),
(55, 'PO/VH/02032021/00012', '2021-03-02 00:00:00', 10000, 148000, 'Cash', '0', '', '0000-00-00 00:00:00'),
(56, 'PO/VH/02032021/00013', '2021-03-15 00:00:00', 2000, 113000, 'Cash', '0', '', '0000-00-00 00:00:00'),
(57, 'PO/VH/02032021/00014', '2021-03-09 00:00:00', 10000, 113000, 'Transfer', '7', '', '0000-00-00 00:00:00'),
(58, 'PO/VH/02032021/00015', '2021-03-01 00:00:00', 10999, 137002, 'Cash', '11', '', '0000-00-00 00:00:00'),
(59, 'PO/VH/03032021/00018', '2021-03-23 00:00:00', 10000, 230000, 'Transfer', '7', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jenisacc`
--

CREATE TABLE `jenisacc` (
  `id_jenis` varchar(5) NOT NULL,
  `kode_ket` varchar(20) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenisacc`
--

INSERT INTO `jenisacc` (`id_jenis`, `kode_ket`, `keterangan`, `status`, `seq`) VALUES
('JAK01', 'PSBB', 'Persib Bandung', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jenisatomizer`
--

CREATE TABLE `jenisatomizer` (
  `id_jenis` varchar(4) NOT NULL,
  `kode_ket` varchar(20) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenisatomizer`
--

INSERT INTO `jenisatomizer` (`id_jenis`, `kode_ket`, `keterangan`, `status`, `seq`) VALUES
('JA01', 'JKT48', 'Jakarta 48', '0', 1),
('JA02', 'RDA', 'RDA', '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jenisdevice`
--

CREATE TABLE `jenisdevice` (
  `id_jenis` varchar(4) NOT NULL,
  `kode_ket` varchar(20) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenisdevice`
--

INSERT INTO `jenisdevice` (`id_jenis`, `kode_ket`, `keterangan`, `status`, `seq`) VALUES
('JD01', 'TSL', 'Test Lanjut', '1', 1),
('JD02', 'DMK', 'MOD KIT', '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jenisexpense`
--

CREATE TABLE `jenisexpense` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenisexpense`
--

INSERT INTO `jenisexpense` (`id`, `keterangan`, `status`) VALUES
(6, 'Biaya sewa gedung', '1'),
(7, 'Biaya sewa peralatan', '1'),
(8, 'Sewa  property lainnya', '1'),
(9, 'MOD KIT', '1');

-- --------------------------------------------------------

--
-- Table structure for table `katretur`
--

CREATE TABLE `katretur` (
  `kode_retur` varchar(5) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `liquid`
--

CREATE TABLE `liquid` (
  `kode_barang` varchar(20) NOT NULL,
  `merk_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `kode_rasa` varchar(5) NOT NULL,
  `nic` int(11) NOT NULL,
  `volume` int(11) NOT NULL,
  `on_hand` int(11) NOT NULL,
  `stok_pusat` int(11) NOT NULL,
  `stok_retail` int(11) NOT NULL,
  `stok_studio` int(11) NOT NULL,
  `bad_stock` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `harga_beli` int(50) NOT NULL,
  `hj_agen` int(11) NOT NULL,
  `hj_retail` int(11) NOT NULL,
  `hj_whs` int(11) NOT NULL,
  `kode_supplier` varchar(20) NOT NULL,
  `id_kode_barang` varchar(20) NOT NULL,
  `seq_kode_barang` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `liquid`
--

INSERT INTO `liquid` (`kode_barang`, `merk_barang`, `nama_barang`, `ket`, `kode_rasa`, `nic`, `volume`, `on_hand`, `stok_pusat`, `stok_retail`, `stok_studio`, `bad_stock`, `berat`, `harga_beli`, `hj_agen`, `hj_retail`, `hj_whs`, `kode_supplier`, `id_kode_barang`, `seq_kode_barang`, `status`) VALUES
('L-L100-00001', 'Merk Liquid', 'Nama Liquid', 'test keterangan', '3', 100, 100, 23, 141, 82, 84, 63, 1000, 150000, 200000, 225000, 250000, 'S0001', 'L-L100', 1, '1'),
('L-L100-00002', '-', 'Alacarte - Cream Biscuit By Jnc', '', '1', 3, 100, 2, 989, 1060, -2, 5, 588, 115000, 125000, 190000, 150000, 'S0001', 'L-L100', 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `kode_menu` int(2) NOT NULL,
  `menu_level` varchar(15) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `source` varchar(30) NOT NULL,
  `ket_menu` varchar(100) NOT NULL,
  `status` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`kode_menu`, `menu_level`, `nama_menu`, `source`, `ket_menu`, `status`) VALUES
(2, '2.0', 'Master Data', 'javascript:;', 'Master Data', '1'),
(3, '2.1', 'Master Data Supplier', 'supplier', 'Master Data', '1'),
(4, '2.2', 'Master Data Sales', 'sales', 'Master Data', '1'),
(5, '2.3', 'Master Data Customer', 'customer', 'Master Data', '1'),
(1, '1.0', 'Dashboard', 'index', 'Dashboard', '1'),
(6, '2.4', 'Master Data Isi Ulang Liquid', 'liquid', 'Master Data', '1'),
(7, '2.5', 'Master Data Perlengkapan', 'device', 'Master Data', '1'),
(8, '2.6', 'Master Data Aksesoris', 'accessories', 'Master Data', '1'),
(9, '2.7', 'Master Data Atomizer', 'atomizer', 'Master Data', '1'),
(10, '3.0', 'Transaksi Pusat', '', 'Transaksi Pusat', '1'),
(11, '3.1', 'Pembelian Barang', 'ordercentral', 'Transaksi Pusat', '1'),
(12, '3.2', 'Pembayaran Supplier (Hutang)', 'pembayaransupplier', 'Transaksi Pusat', '1'),
(13, '3.3', 'Retur Barang Pembelian', 'retursupplier', 'Transaksi Pusat', '1'),
(14, '3.4', 'Penjualan Barang', 'salecentral', 'Transaksi Pusat', '1'),
(15, '3.5', 'Pembayaran Pelanggan (Piutang)', 'pembayarancustomer', 'Transaksi Pusat', '1'),
(16, '3.6', 'Retur Barang Penjualan', 'returcustomer', 'Transaksi Pusat', '1'),
(17, '3.7', 'Stock Opname', 'sopgudang', 'Transaksi Pusat', '1'),
(18, '3.8', 'Pengeluaran Bad Stock', 'badstockgudang', 'Transaksi Pusat', '1'),
(19, '3.9', 'Permintaan ke Gudang Retail', 'reqtoretail', 'Transaksi Pusat', '1'),
(20, '3.10', 'Permintaan ke Gudang Studio', 'reqtostudio', 'Transaksi Pusat', '1'),
(21, '4.0', 'Transaksi Retail', '', 'Transaksi Retail', '1'),
(22, '4.1', 'Permintaan Ke Gudang Pusat', 'reqretailtocentral', 'Transaksi Retail', '1'),
(23, '4.2', 'Penjualan Barang', 'saleretail', 'Transaksi Retail', '1'),
(25, '4.4', 'Stock Opname', 'sopretail', 'Transaksi Retail', '1'),
(26, '5.0', 'Transaksi Studio', '', 'Transaksi Studio', '1'),
(27, '5.1', 'Permintaan Ke Gudang Pusat', 'reqstudiotocentral', 'Transaksi Studio', '1'),
(28, '5.2', 'Penjualan Barang', 'salestudio', 'Transaksi Studio', '1'),
(30, '5.4', 'Stock Opname', 'sopstudio', 'Transaksi Studio', '1'),
(24, '4.3', 'Retur Barang Penjualan', 'retursaleretail', 'Transaksi Retail', '1'),
(29, '5.3', 'Retur Barang Penjualan', 'retursalestudio', 'Transaksi Studio', '1'),
(31, '6.0', 'Parameter', '', 'Parameter', '1'),
(32, '6.1', 'Data Isi Volume Liquid', 'volliquid', 'Parameter', '1'),
(33, '6.2', 'Data Jenis Device', 'jenisdevice', 'Parameter', '1'),
(34, '6.3', 'Data Jenis Aksesoris', 'jenisacc', 'Parameter', '1'),
(35, '6.4', 'Data Jenis Atomizer', 'jenisatomizer', 'Parameter', '1'),
(36, '6.5', 'Data Rasa Liquid', 'rasaliquid', 'Parameter', '1'),
(37, '6.6', 'Data Warna', 'warna', 'Parameter', '1'),
(38, '6.7', 'Kategori Retur Barang', 'katretur', 'Parameter', '1'),
(39, '6.8', 'Batas Waktu Transaksi', 'dateline', 'Parameter', '1'),
(40, '6.9', 'Jenis Expense', 'rekening', 'Parameter', '1'),
(41, '7.0', 'Administrator', '', 'Administrator', '1'),
(42, '7.1', 'Data Groups', 'groups', 'Administrator', '1'),
(43, '7.2', 'Data User', 'user', 'Administrator', '1'),
(44, '7.3', 'Ganti Password', 'gntpassword', 'Administrator', '1'),
(45, '3.11', 'Permintaan Dari Retail', 'reqfromretail', 'Transaksi Pusat', '1'),
(46, '3.12', 'Permintaan Dari Studio', 'reqfromstudio', 'Transaksi Pusat', '1'),
(47, '4.5', 'Permintaan Dari Pusat', 'apprvretail', 'Transaksi Retail', '1'),
(48, '5.5', 'Permintaan Dari Pusat', 'apprvstudio', 'Transaksi Studio', '1'),
(49, '3.11', 'Penyelesaian Retur Pembelian', 'penyelesaianpembelian', 'Transaksi Pusat', '1'),
(50, '3.12', 'Penyelesaian Retur Penjualan', 'penyelesaianpenjualan', 'Transaksi Pusat', '1'),
(51, '8.0', 'Laporan', 'laporan', 'Laporan', '1'),
(53, '9.0', 'Akun', 'akun', 'Finance', '1'),
(54, '9.1', 'Cash In Cash Out', 'cashincashout', 'Finance', '1'),
(55, '9.2', 'Transaksi', 'transaksi', 'Finance', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ordercentral`
--

CREATE TABLE `ordercentral` (
  `no_order` varchar(20) NOT NULL,
  `tgl_order` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `biaya_kirim` int(11) NOT NULL,
  `diskon` varchar(20) NOT NULL,
  `net_total` int(11) NOT NULL,
  `jml_bayar_dp` int(11) NOT NULL,
  `sisa_bayar` int(11) NOT NULL,
  `metode_bayar` varchar(20) NOT NULL,
  `metode_bayar2` varchar(20) NOT NULL,
  `no_rekening` varchar(50) NOT NULL,
  `kode_supplier` varchar(20) NOT NULL,
  `tgl_entry` datetime NOT NULL,
  `seq` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordercentral`
--

INSERT INTO `ordercentral` (`no_order`, `tgl_order`, `total`, `biaya_kirim`, `diskon`, `net_total`, `jml_bayar_dp`, `sisa_bayar`, `metode_bayar`, `metode_bayar2`, `no_rekening`, `kode_supplier`, `tgl_entry`, `seq`, `user_id`) VALUES
('PO/VH/01032021/00003', '2021-03-09 00:00:00', 150000, 20000000, '100000', 20050000, 443445, 19486555, '', 'Transfer', 'BNI - 61656565 (Bima)', 'S0001', '0000-00-00 00:00:00', '00003', ''),
('PO/VH/01032021/00004', '2021-03-15 00:00:00', 150000, 50000, '20000', 180000, 102000, 78000, '', 'Transfer', '7', 'S0001', '0000-00-00 00:00:00', '00004', ''),
('PO/VH/01032021/00005', '2021-03-26 00:00:00', 150000, 200000, '10000', 340000, 340000, 0, '', 'Transfer', '7', 'S0001', '0000-00-00 00:00:00', '00017', ''),
('PO/VH/01032021/00006', '2021-03-20 00:00:00', 150000, 100000, '10000', 240000, 50000, 40000, '', 'Transfer', '9', 'S0001', '0000-00-00 00:00:00', '00016', ''),
('PO/VH/01032021/00007', '2021-03-30 00:00:00', 300000, 3000, '10000', 293000, 29999, 263001, '', 'Transfer', '7', 'S0001', '0000-00-00 00:00:00', '00007', ''),
('PO/VH/01032021/00008', '2021-03-13 00:00:00', 150000, 200000, '200000', 150000, 20000, 130000, '', 'Transfer', '7', 'S0001', '0000-00-00 00:00:00', '00008', ''),
('PO/VH/02032021/00009', '2021-03-02 00:00:00', 150000, 10000, '2000', 158000, 1000, 157000, '', 'Transfer', '9', 'S0001', '0000-00-00 00:00:00', '00009', ''),
('PO/VH/02032021/00010', '2021-03-11 00:00:00', 115000, 111, '20000', 95111, 1000, 94111, '', 'Transfer', '9', 'S0001', '0000-00-00 00:00:00', '00010', ''),
('PO/VH/02032021/00011', '2021-03-09 00:00:00', 115000, 10000, '299', 124701, 0, 124701, '', 'Transfer', '7', 'S0001', '0000-00-00 00:00:00', '00011', ''),
('PO/VH/02032021/00012', '2021-03-02 00:00:00', 150000, 10000, '2000', 158000, 10000, 148000, '', 'Cash', '0', 'S0001', '0000-00-00 00:00:00', '00012', ''),
('PO/VH/02032021/00013', '2021-03-15 00:00:00', 115000, 11, '11', 115000, 2000, 113000, '', 'Cash', '0', 'S0001', '0000-00-00 00:00:00', '00013', ''),
('PO/VH/02032021/00014', '2021-03-09 00:00:00', 115000, 10000, '2000', 123000, 10000, 113000, '', 'Transfer', '7', 'S0001', '0000-00-00 00:00:00', '00014', ''),
('PO/VH/02032021/00015', '2021-03-01 00:00:00', 150000, 1000, '2999', 148001, 10999, 137002, '', 'Cash', '11', 'S0001', '0000-00-00 00:00:00', '00015', ''),
('PO/VH/08022021/00001', '2021-02-02 00:00:00', 1500000, 0, '0', 1500000, 1200000, 300000, '', 'Cash', '0', 'S0002', '0000-00-00 00:00:00', '00001', '');

-- --------------------------------------------------------

--
-- Table structure for table `piutang`
--

CREATE TABLE `piutang` (
  `id_piutang` int(11) NOT NULL,
  `no_invoice` varchar(50) NOT NULL,
  `tgl_pembayaran` datetime NOT NULL,
  `jumlah_pembayaran` int(11) NOT NULL,
  `sisa_pembayaran` int(11) NOT NULL,
  `metode_pembayaran` varchar(20) NOT NULL,
  `no_rekening` varchar(50) NOT NULL,
  `catatan` text NOT NULL,
  `tgl_entry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `piutang`
--

INSERT INTO `piutang` (`id_piutang`, `no_invoice`, `tgl_pembayaran`, `jumlah_pembayaran`, `sisa_pembayaran`, `metode_pembayaran`, `no_rekening`, `catatan`, `tgl_entry`) VALUES
(1, 'SO/VH/081220 11:35:34/00001', '0000-00-00 00:00:00', 160000, 3300000, '-', '-', '', '0000-00-00 00:00:00'),
(2, 'SO/VH/081220 11:35:34/00001', '2020-12-08 00:00:00', 40000, 3260000, 'Cash', '0', 'oke', '0000-00-00 00:00:00'),
(3, 'SO/VH/081220 11:35:34/00001', '2020-12-08 00:00:00', 200000, 3060000, 'Cash', '0', 'ss', '0000-00-00 00:00:00'),
(4, 'SO/VH/081220 11:35:34/00001', '2020-12-11 00:00:00', 3060000, 0, 'Cash', '0', 'oke', '0000-00-00 00:00:00'),
(5, 'SO/VH/130121 09:41:27/00001', '0000-00-00 00:00:00', 1500000, 1000000, '-', '-', '', '0000-00-00 00:00:00'),
(6, 'SO/VH/130121 09:41:27/00001', '2021-01-13 00:00:00', 500000, 500000, 'Cash', '0', 'test', '0000-00-00 00:00:00'),
(8, 'SO/VH/070221 15:14:34/00002', '0000-00-00 00:00:00', 235000, 0, '-', '-', '', '0000-00-00 00:00:00'),
(12, 'SO/VH/030221 07:25:12/00002', '2021-02-08 00:00:00', 200000, 1150000, 'Cash', '0', 'sdasd', '0000-00-00 00:00:00'),
(13, 'SO/VH/030221 07:25:12/00002', '2021-02-08 00:00:00', 100000, 1050000, 'Cash', '0', '', '0000-00-00 00:00:00'),
(14, 'SO/VH/030221 07:25:12/00002', '2021-02-08 00:00:00', 100000, 950000, 'Cash', '0', '', '0000-00-00 00:00:00'),
(15, 'SO/VH/080221 02:05:00/00001', '0000-00-00 00:00:00', 245000, 0, '-', '-', '', '0000-00-00 00:00:00'),
(16, 'SO/VH/080221 05:52:17/00005', '0000-00-00 00:00:00', 100000, 125000, '-', '-', '', '0000-00-00 00:00:00'),
(17, 'SO/VH/080221 05:52:17/00005', '2021-02-08 00:00:00', 125000, 0, 'Transfer', 'BRI - 1301321323234 (Dery)', 'qwer', '0000-00-00 00:00:00'),
(18, 'SO/VH/080221 05:51:35/00004', '0000-00-00 00:00:00', 1000000, -775000, '-', '-', '', '0000-00-00 00:00:00'),
(19, 'SO/VH/010321 03:21:22/00001', '0000-00-00 00:00:00', 1200000, 490000, '-', '-', '', '0000-00-00 00:00:00'),
(20, 'SO/VH/080221 05:50:55/00003', '0000-00-00 00:00:00', 225000, 0, '-', '-', '', '0000-00-00 00:00:00'),
(21, 'SO/VH/010321 05:23:49/00010', '0000-00-00 00:00:00', 229999, 985001, '-', '-', '', '0000-00-00 00:00:00'),
(22, 'SO/VH/010321 08:07:33/00012', '0000-00-00 00:00:00', 200000, 180000, '-', '-', '', '0000-00-00 00:00:00'),
(23, 'SO/VH/010321 08:07:33/00012', '2021-03-01 00:00:00', 100000, 80000, 'Transfer', 'BJB - 454566566 (Mukti)', '-', '0000-00-00 00:00:00'),
(24, 'SO/VH/010321 08:07:33/00012', '2021-03-02 00:00:00', 100, 79900, 'Transfer', '7', '-', '0000-00-00 00:00:00'),
(25, 'SO/VH/010321 08:07:33/00012', '2021-03-02 00:00:00', 321, 79579, 'Cash', '0', '-', '0000-00-00 00:00:00'),
(26, 'SO/VH/010321 08:07:33/00012', '2021-03-02 00:00:00', 11, 79568, 'Transfer', '7', '20000', '0000-00-00 00:00:00'),
(27, 'SO/VH/010321 08:07:33/00012', '2021-03-02 00:00:00', 20000, 59568, 'Transfer', '7', '20000', '0000-00-00 00:00:00'),
(28, 'SO/VH/010321 08:07:33/00012', '2021-03-02 00:00:00', 100000, -40432, 'Transfer', '7', '10000', '0000-00-00 00:00:00'),
(29, 'SO/VH/030321 13:04:45/00001', '0000-00-00 00:00:00', 120000, 124000, '-', '-', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rasa_liquid`
--

CREATE TABLE `rasa_liquid` (
  `kode_rasa` varchar(5) NOT NULL,
  `rasa` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rasa_liquid`
--

INSERT INTO `rasa_liquid` (`kode_rasa`, `rasa`, `status`) VALUES
('1', 'coklat', '1'),
('2', 'vanila', '1'),
('3', 'alpuket', '1'),
('4', 'enak', '1');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `no_id` int(11) NOT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `atas_nama` varchar(50) NOT NULL,
  `no_rekening` varchar(50) NOT NULL,
  `saldo_awal` int(11) NOT NULL,
  `kode_cabang` int(3) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`no_id`, `nama_bank`, `atas_nama`, `no_rekening`, `saldo_awal`, `kode_cabang`, `status`) VALUES
(1, 'BRI', 'Dery', '1301321323234', 0, 0, '1'),
(2, 'BNI', 'Bima', '61656565', 0, 0, '1'),
(3, 'BJB', 'Mukti', '454566566', 0, 0, '1'),
(4, 'BCA', 'Drajat', '787941515', 0, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `reqretailtocentral`
--

CREATE TABLE `reqretailtocentral` (
  `no_request` varchar(30) NOT NULL,
  `tgl_request` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `tahun` int(11) NOT NULL,
  `seq` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reqretailtocentral`
--

INSERT INTO `reqretailtocentral` (`no_request`, `tgl_request`, `status`, `tahun`, `seq`) VALUES
('ROGR/VH/01-21/0001', '2021-01-16', 'Approve', 2021, '0001'),
('ROGR/VH/02-21/0002', '2021-02-07', 'Dalam Proses', 2021, '0002'),
('ROGR/VH/12-20/0001', '2020-12-30', 'Approve', 2020, '0001');

-- --------------------------------------------------------

--
-- Table structure for table `reqretailtocentral_sub`
--

CREATE TABLE `reqretailtocentral_sub` (
  `kode_subrequest` int(11) NOT NULL,
  `no_request` varchar(50) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `jenis_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reqretailtocentral_sub`
--

INSERT INTO `reqretailtocentral_sub` (`kode_subrequest`, `no_request`, `kode_barang`, `qty`, `jenis_barang`, `kode_jenis_barang`) VALUES
(7, 'ROGR/VH/12-20/0001', 'L-L100-00001', 12, 'liquid', 'kode_barang'),
(8, 'ROGR/VH/12-20/0001', 'L-MDO-00001', 20, 'device', 'kode_device'),
(10, 'ROGR/VH/01-21/0001', 'L-L100-00001', 5, 'liquid', 'kode_barang'),
(12, 'ROGR/VH/02-21/0002', 'L-L100-00001', 5, 'liquid', 'kode_barang');

-- --------------------------------------------------------

--
-- Table structure for table `reqstudiotocentral`
--

CREATE TABLE `reqstudiotocentral` (
  `no_request` varchar(30) NOT NULL,
  `tgl_request` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `tahun` int(11) NOT NULL,
  `seq` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reqstudiotocentral`
--

INSERT INTO `reqstudiotocentral` (`no_request`, `tgl_request`, `status`, `tahun`, `seq`) VALUES
('ROGR/VH/01-21/0001', '2021-01-16', 'Approve', 2021, '0001'),
('ROGR/VH/02-21/0002', '2021-02-05', 'Dalam Proses', 2021, '0002'),
('ROGR/VH/12-20/0001', '2020-12-26', 'Approve', 2020, '0001');

-- --------------------------------------------------------

--
-- Table structure for table `reqstudiotocentral_sub`
--

CREATE TABLE `reqstudiotocentral_sub` (
  `kode_subrequest` int(11) NOT NULL,
  `no_request` varchar(50) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `jenis_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reqstudiotocentral_sub`
--

INSERT INTO `reqstudiotocentral_sub` (`kode_subrequest`, `no_request`, `kode_barang`, `qty`, `jenis_barang`, `kode_jenis_barang`) VALUES
(5, 'ROGR/VH/12-20/0001', 'L-L100-00001', 15, 'liquid', 'kode_barang'),
(6, 'ROGR/VH/12-20/0001', 'L-MDO-00001', 7, 'device', 'kode_device'),
(8, 'ROGR/VH/01-21/0001', 'L-L100-00001', 7, 'liquid', 'kode_barang'),
(9, 'ROGR/VH/02-21/0002', 'L-MDO-00001', 4, 'device', 'kode_device');

-- --------------------------------------------------------

--
-- Table structure for table `reqtoretail`
--

CREATE TABLE `reqtoretail` (
  `no_request` varchar(30) NOT NULL,
  `tgl_request` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `tahun` int(11) NOT NULL,
  `seq` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reqtoretail`
--

INSERT INTO `reqtoretail` (`no_request`, `tgl_request`, `status`, `tahun`, `seq`) VALUES
('ROGP/VH/01-21/0001', '2021-01-12', 'Dalam Proses', 2021, '0001'),
('ROGP/VH/01-21/0002', '2021-01-16', 'Approve', 2021, '0002'),
('ROGP/VH/02-21/0003', '2021-02-11', 'Dalam Proses', 2021, '0003'),
('ROGP/VH/12-20/0001', '2020-12-02', 'Approve', 2020, '0001'),
('ROGP/VH/12-20/0002', '2020-12-23', 'Not-Approve', 2020, '0002');

-- --------------------------------------------------------

--
-- Table structure for table `reqtoretail_sub`
--

CREATE TABLE `reqtoretail_sub` (
  `kode_subrequest` int(11) NOT NULL,
  `no_request` varchar(50) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `stok_retail` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `jenis_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reqtoretail_sub`
--

INSERT INTO `reqtoretail_sub` (`kode_subrequest`, `no_request`, `kode_barang`, `stok_retail`, `qty`, `jenis_barang`, `kode_jenis_barang`) VALUES
(9, 'ROGP/VH/12-20/0001', 'L-L100-00001', 88, 12, 'liquid', 'kode_barang'),
(10, 'ROGP/VH/12-20/0001', 'L-MDO-00001', 85, 15, 'device', 'kode_device'),
(13, 'ROGP/VH/12-20/0002', 'L-CHG-00001', 100, 25, 'accessories', 'kode_aksesoris'),
(14, 'ROGP/VH/12-20/0002', 'I-AT/RDTA-00001', 200, 30, 'atomizer', 'kode_atomizer'),
(17, 'ROGP/VH/01-21/0002', 'L-L100-00001', 90, 3, 'liquid', 'kode_barang'),
(18, 'ROGP/VH/02-21/0003', 'I-AT/RDTA-00001', 196, 4, 'atomizer', 'kode_atomizer'),
(19, 'ROGP/VH/01-21/0001', 'L-L100-00001', 98, 5, 'liquid', 'kode_barang');

-- --------------------------------------------------------

--
-- Table structure for table `reqtostudio`
--

CREATE TABLE `reqtostudio` (
  `no_request` varchar(30) NOT NULL,
  `tgl_request` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `tahun` int(11) NOT NULL,
  `seq` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reqtostudio`
--

INSERT INTO `reqtostudio` (`no_request`, `tgl_request`, `status`, `tahun`, `seq`) VALUES
('SOGP/VH/01-21/0001', '2021-01-16', 'Approve', 2021, '0001'),
('SOGP/VH/02-21/0002', '2021-02-17', 'Dalam Proses', 2021, '0002'),
('SOGP/VH/12-20/0001', '2020-12-05', 'Approve', 2020, '0001'),
('SOGP/VH/12-20/0002', '2020-12-17', 'Not-Approve', 2020, '0002');

-- --------------------------------------------------------

--
-- Table structure for table `reqtostudio_sub`
--

CREATE TABLE `reqtostudio_sub` (
  `kode_subrequest` int(11) NOT NULL,
  `no_request` varchar(50) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `stok_studio` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `jenis_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reqtostudio_sub`
--

INSERT INTO `reqtostudio_sub` (`kode_subrequest`, `no_request`, `kode_barang`, `stok_studio`, `qty`, `jenis_barang`, `kode_jenis_barang`) VALUES
(7, 'SOGP/VH/12-20/0001', 'L-L100-00001', 82, 18, 'liquid', 'kode_barang'),
(8, 'SOGP/VH/12-20/0001', 'L-MDO-00001', 87, 13, 'device', 'kode_device'),
(11, 'SOGP/VH/12-20/0002', 'L-L100-00001', 82, 20, 'liquid', 'kode_barang'),
(13, 'SOGP/VH/01-21/0001', 'L-L100-00001', 80, 8, 'liquid', 'kode_barang'),
(15, 'SOGP/VH/02-21/0002', 'L-CHG-00001', 88, 6, 'accessories', 'kode_aksesoris');

-- --------------------------------------------------------

--
-- Table structure for table `retursaleretail`
--

CREATE TABLE `retursaleretail` (
  `no_retur` varchar(50) NOT NULL,
  `no_invoice` varchar(50) NOT NULL,
  `tgl_retur` datetime NOT NULL,
  `total_qty_retur` int(11) NOT NULL,
  `total_nominal_retur` int(11) NOT NULL,
  `seq` varchar(20) NOT NULL,
  `metode_bayar` varchar(50) NOT NULL,
  `id_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retursaleretail`
--

INSERT INTO `retursaleretail` (`no_retur`, `no_invoice`, `tgl_retur`, `total_qty_retur`, `total_nominal_retur`, `seq`, `metode_bayar`, `id_akun`) VALUES
('RR/VH/01-21/0001', 'SOGR/VH/311220/00003', '2021-01-06 00:00:00', 1, 225000, '0001', '', 0),
('RR/VH/01-21/0002', 'SOGR/VH/311220/00002', '2021-01-07 00:00:00', 1, 225000, '0002', '', 0),
('RR/VH/01-21/0003', 'SOGR/VH/130121/00001', '2021-01-13 00:00:00', 3, 675000, '0003', '', 0),
('RR/VH/03-21/0004', 'SOGR/VH/030321/00006', '2021-03-06 00:00:00', 1, 225000, '0004', 'Cash', 11);

-- --------------------------------------------------------

--
-- Table structure for table `retursaleretail_sub`
--

CREATE TABLE `retursaleretail_sub` (
  `no_subretur` int(11) NOT NULL,
  `no_retur` varchar(50) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `qty_retur` int(11) NOT NULL,
  `nominal_retur` int(11) NOT NULL,
  `alasan` varchar(20) NOT NULL,
  `jenis_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retursaleretail_sub`
--

INSERT INTO `retursaleretail_sub` (`no_subretur`, `no_retur`, `kode_barang`, `qty`, `harga_jual`, `sub_total`, `qty_retur`, `nominal_retur`, `alasan`, `jenis_barang`, `kode_jenis_barang`) VALUES
(2, 'RR/VH/01-21/0001', 'L-L100-00001', 0, 225000, -40000, 1, 225000, 'cacat/rusak', 'liquid', 'kode_barang'),
(3, 'RR/VH/01-21/0002', 'L-L100-00001', 0, 225000, 0, 1, 225000, 'cacat/rusak', 'liquid', 'kode_barang'),
(4, 'RR/VH/01-21/0003', 'L-L100-00001', 5, 225000, 1125000, 3, 675000, 'cacat/rusak', 'liquid', 'kode_barang'),
(9, 'RR/VH/03-21/0004', 'L-L100-00001', 0, 225000, 0, 1, 225000, '', 'liquid', 'kode_barang');

-- --------------------------------------------------------

--
-- Table structure for table `retursalestudio`
--

CREATE TABLE `retursalestudio` (
  `no_retur` varchar(50) NOT NULL,
  `no_invoice` varchar(50) NOT NULL,
  `tgl_retur` datetime NOT NULL,
  `total_qty_retur` int(11) NOT NULL,
  `total_nominal_retur` int(11) NOT NULL,
  `seq` varchar(20) NOT NULL,
  `metode_bayar` varchar(50) NOT NULL,
  `id_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retursalestudio`
--

INSERT INTO `retursalestudio` (`no_retur`, `no_invoice`, `tgl_retur`, `total_qty_retur`, `total_nominal_retur`, `seq`, `metode_bayar`, `id_akun`) VALUES
('RS/VH/01-21/0001', 'SOGS/VH/311220/00001', '2021-01-06 00:00:00', 3, 300000, '0001', '', 0),
('RS/VH/02-21/0002', 'SOGS/VH/050221/00001', '2021-02-05 00:00:00', 1, 250000, '0002', '', 0),
('RS/VH/03-21/0003', 'SOGS/VH/020321/00004', '2021-03-20 00:00:00', 2, 500000, '0003', 'Cash', 0);

-- --------------------------------------------------------

--
-- Table structure for table `retursalestudio_sub`
--

CREATE TABLE `retursalestudio_sub` (
  `no_subretur` int(11) NOT NULL,
  `no_retur` varchar(50) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `qty_retur` int(11) NOT NULL,
  `nominal_retur` int(11) NOT NULL,
  `alasan` varchar(20) NOT NULL,
  `jenis_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retursalestudio_sub`
--

INSERT INTO `retursalestudio_sub` (`no_subretur`, `no_retur`, `kode_barang`, `qty`, `harga_jual`, `sub_total`, `qty_retur`, `nominal_retur`, `alasan`, `jenis_barang`, `kode_jenis_barang`) VALUES
(1, 'RS/VH/01-21/0001', 'L-CHG-00001', 7, 100000, 690000, 3, 300000, 'tidak sesuai', 'accessories', 'kode_aksesoris'),
(2, 'RS/VH/02-21/0002', 'L-L100-00001', 0, 250000, 0, 1, 250000, 'cacat/rusak', 'liquid', 'kode_barang'),
(6, 'RS/VH/03-21/0003', 'L-L100-00001', -1, 250000, -250000, 2, 500000, '', 'liquid', 'kode_barang');

-- --------------------------------------------------------

--
-- Table structure for table `retur_pembelian`
--

CREATE TABLE `retur_pembelian` (
  `no_retur` varchar(50) NOT NULL,
  `no_order` varchar(50) NOT NULL,
  `tgl_retur` datetime NOT NULL,
  `total_qty_retur` int(11) NOT NULL,
  `total_nominal_retur` int(11) NOT NULL,
  `seq` varchar(20) NOT NULL,
  `metode_bayar` varchar(50) NOT NULL,
  `id_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retur_pembelian`
--

INSERT INTO `retur_pembelian` (`no_retur`, `no_order`, `tgl_retur`, `total_qty_retur`, `total_nominal_retur`, `seq`, `metode_bayar`, `id_akun`) VALUES
('RB/VH/01-21/0002', 'PO/VH/08122020/00001', '2021-01-12 00:00:00', 3, 450000, '0002', '', 0),
('RB/VH/01-21/0003', 'PO/VH/13012021/00005', '2021-01-15 00:00:00', 20, 3000000, '0003', '', 0),
('RB/VH/01-21/0004', 'PO/VH/13012021/00006', '2021-01-16 00:00:00', 10, 1500000, '0004', '', 0),
('RB/VH/01-21/0005', 'PO/VH/13012021/00007', '2021-01-20 00:00:00', 10, 1500000, '0005', '', 0),
('RB/VH/01-21/0006', 'PO/VH/13012021/00008', '2021-01-20 00:00:00', 10, 1500000, '0006', '', 0),
('RB/VH/01-21/0007', 'PO/VH/16012021/00009', '2021-01-18 00:00:00', 2, 300000, '0007', '', 0),
('RB/VH/02-21/0008', 'PO/VH/13012021/00007', '2021-02-05 00:00:00', 1, 150000, '0008', '', 0),
('RB/VH/03-21/0009', 'PO/VH/01032021/00006', '2021-03-11 00:00:00', 1, 150000, '0009', '', 7),
('RB/VH/03-21/0010', 'PO/VH/01032021/00003', '2021-03-23 00:00:00', 1, 150000, '0010', '', 0),
('RB/VH/12-20/0001', 'PO/VH/08122020/00002', '2020-12-17 00:00:00', 5, 375000, '0001', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `retur_penjualan`
--

CREATE TABLE `retur_penjualan` (
  `no_retur` varchar(50) NOT NULL,
  `no_invoice` varchar(50) NOT NULL,
  `tgl_retur` datetime NOT NULL,
  `total_qty_retur` int(11) NOT NULL,
  `total_nominal_retur` int(11) NOT NULL,
  `seq` varchar(20) NOT NULL,
  `metode_bayar` varchar(50) NOT NULL,
  `id_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retur_penjualan`
--

INSERT INTO `retur_penjualan` (`no_retur`, `no_invoice`, `tgl_retur`, `total_qty_retur`, `total_nominal_retur`, `seq`, `metode_bayar`, `id_akun`) VALUES
('SO/VH/02-21/0001', 'SO/VH/130121 09:41:27/00001', '2021-02-10 00:00:00', 10, 2250000, '0001', '', 0),
('SO/VH/02-21/0002', 'SO/VH/080221 05:51:35/00004', '2021-02-08 00:00:00', 1, 225000, '0002', '', 0),
('SO/VH/03-21/0003', 'SO/VH/010321 08:07:33/00012', '2021-03-18 00:00:00', 1, 190000, '0003', '', 0),
('SO/VH/03-21/0004', 'SO/VH/080221 05:51:35/00004', '2021-03-25 00:00:00', 1, 225000, '0004', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salecentral`
--

CREATE TABLE `salecentral` (
  `no_invoice` varchar(50) NOT NULL,
  `tgl_invoice` datetime NOT NULL,
  `kode_customer` varchar(20) NOT NULL,
  `shipment` varchar(20) NOT NULL,
  `nama_kurir` varchar(25) NOT NULL,
  `total_berat` int(11) NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `diskon` varchar(20) NOT NULL,
  `biaya_kirim` int(11) NOT NULL,
  `net_total` int(11) NOT NULL,
  `metode_penerimaan` varchar(50) NOT NULL,
  `jml_penerimaan` int(11) NOT NULL,
  `metode_penerimaan2` varchar(50) NOT NULL,
  `jml_penerimaan2` int(11) NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `sisa_bayar` int(11) NOT NULL,
  `nama_penerima` varchar(50) NOT NULL,
  `alamat_penerima` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tgl_entry` datetime NOT NULL,
  `kode_inv` varchar(20) NOT NULL,
  `seq` varchar(20) NOT NULL,
  `kode_sales` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salecentral`
--

INSERT INTO `salecentral` (`no_invoice`, `tgl_invoice`, `kode_customer`, `shipment`, `nama_kurir`, `total_berat`, `total_biaya`, `diskon`, `biaya_kirim`, `net_total`, `metode_penerimaan`, `jml_penerimaan`, `metode_penerimaan2`, `jml_penerimaan2`, `jml_bayar`, `sisa_bayar`, `nama_penerima`, `alamat_penerima`, `keterangan`, `tgl_entry`, `kode_inv`, `seq`, `kode_sales`, `status`) VALUES
('SO/VH/010321 03:21:22/00001', '0000-00-00 00:00:00', 'C0001', 'COD', '', 2000, 450000, '10000', 50000, 490000, 'BRI - 1301321323234 (Dery)', 200000, 'BNI - 61656565 (Bima)', 1000000, 1200000, 490000, 'Eza', 'Manjahlega', '-', '0000-00-00 00:00:00', '010321', '00008', '', 'Not-Approve'),
('SO/VH/010321 05:23:49/00010', '0000-00-00 00:00:00', 'C0001', 'COD', '', 1000, 225000, '10000', 1000000, 1215000, 'BRI - 1301321323234 (Dery)', 200000, '0', 29999, 229999, 985001, 'RIfan', '-', '-', '0000-00-00 00:00:00', '010321', '00011', '', 'Not-Approve'),
('SO/VH/010321 08:07:33/00012', '0000-00-00 00:00:00', 'C0001', 'COD', '', 588, 190000, '10000', 200000, 380000, 'BRI - 1301321323234 (Dery)', 100000, 'BRI - 1301321323234 (Dery)', 100000, 420432, -230432, '-', '-', '-', '0000-00-00 00:00:00', '010321', '00013', '', 'Approve'),
('SO/VH/020321 04:55:03/00001', '2021-03-04 00:00:00', 'C0001', 'COD', '', 1000, 225000, '1000', 100000, 324000, '7', 100000, '10', 200000, 300000, 24000, 'rifan', '-', '-', '0000-00-00 00:00:00', '020321', '00001', '', ''),
('SO/VH/020321 04:58:30/00002', '2021-03-09 00:00:00', 'C0001', 'COD', '', 588, 190000, '20000', 10000, 180000, '7', 1000, '7', 10000, 11000, 169000, '-', '-', '-', '0000-00-00 00:00:00', '020321', '00002', '', ''),
('SO/VH/030321 13:04:45/00001', '0000-00-00 00:00:00', 'C0001', 'COD', '', 1000, 225000, '10000', 29000, 244000, '7', 20000, '<br ></option>\n<b>Notice</b>:  Undefined variable:', 100000, 120000, 124000, 'Hidayat', '-', '-', '0000-00-00 00:00:00', '030321', '00014', '', 'Approve'),
('SO/VH/080221 02:05:00/00001', '0000-00-00 00:00:00', 'C0001', 'Gojek', '', 1000, 225000, '10000', 30000, 245000, 'BRI - 1301321323234 (Dery)', 0, 'BJB - 454566566 (Mukti)', 0, 0, 0, 'Rudi', 'Bandung', 'Belum lunas', '0000-00-00 00:00:00', '080221', '00002', '', 'Approve'),
('SO/VH/080221 05:50:55/00003', '0000-00-00 00:00:00', 'C0001', 'COD', '', 1000, 225000, '10000', 10000, 225000, 'BRI - 1301321323234 (Dery)', 125000, 'BCA - 787941515 (Drajat)', 100000, 225000, 0, 'reza', 'sadasd', 'reza', '0000-00-00 00:00:00', '010321', '00009', '', 'Not-Approve'),
('SO/VH/080221 05:51:35/00004', '0000-00-00 00:00:00', 'C0001', 'Gojek', '', 1000, 225000, '20000', 20000, 225000, 'cash', 1000000, '0', 0, 1000000, -1225000, 'asdas', 'asdas', 'adsd', '0000-00-00 00:00:00', '080221', '00007', '', 'Approve'),
('SO/VH/080221 05:52:17/00005', '0000-00-00 00:00:00', 'C0001', 'Gojek', '', 1000, 225000, '0', 0, 225000, 'BRI - 1301321323234 (Dery)', 100000, '0', 0, 225000, 0, 'sdas', 'dasdas', 'dasd', '0000-00-00 00:00:00', '080221', '00006', '', 'Approve');

-- --------------------------------------------------------

--
-- Table structure for table `saleretail`
--

CREATE TABLE `saleretail` (
  `no_invoice` varchar(50) NOT NULL,
  `tgl_invoice` datetime NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `no_rekening` varchar(50) NOT NULL,
  `jml_pembayaran` int(11) NOT NULL,
  `uang_kembali` int(11) NOT NULL,
  `biaya_admin` int(11) NOT NULL,
  `kode_inv` varchar(20) NOT NULL,
  `seq` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saleretail`
--

INSERT INTO `saleretail` (`no_invoice`, `tgl_invoice`, `total_biaya`, `metode_pembayaran`, `no_rekening`, `jml_pembayaran`, `uang_kembali`, `biaya_admin`, `kode_inv`, `seq`, `status`) VALUES
('', '1970-01-01 01:00:00', 0, '', '', 0, 0, 0, '020321', '', ''),
('SOGR/VH/030221/00001', '2021-02-03 00:00:00', 1125000, 'Tunai', '', 1125000, 0, 0, '030221', '00001', ''),
('SOGR/VH/030321/00001', '2021-03-11 00:00:00', 225000, 'Tunai', '', 2000000, 1775000, 0, '030321', '00001', ''),
('SOGR/VH/030321/00002', '2021-03-11 00:00:00', 225000, 'Tunai', '', 2000000, 1775000, 0, '030321', '00002', ''),
('SOGR/VH/030321/00003', '2021-03-03 00:00:00', 225000, 'Transfer', '', 225000, 0, 0, '030321', '00003', ''),
('SOGR/VH/030321/00004', '2021-03-26 00:00:00', 225000, 'Tunai', '11', 2000000, 1775000, 0, '030321', '00004', ''),
('SOGR/VH/030321/00005', '2021-03-11 00:00:00', 225000, 'Tunai', '11', 100000000, 99775000, 0, '030321', '00005', ''),
('SOGR/VH/030321/00006', '2021-03-11 00:00:00', 225000, 'Tunai', '11', 1000000, 775000, 0, '030321', '00006', ''),
('SOGR/VH/040221/00001', '1970-01-01 01:00:00', 1110000, 'Transfer', '', 1115000, 0, 5000, '040221', '00001', ''),
('SOGR/VH/050221/00001', '2021-02-05 00:00:00', 90000, 'Tunai', '', 90000, 0, 0, '050221', '00001', ''),
('SOGR/VH/080221/00001', '1970-01-01 01:00:00', 225000, 'Tunai', '', 225000, 0, 0, '080221', '00001', ''),
('SOGR/VH/130121/00001', '2021-01-13 00:00:00', 1800000, 'Tunai', '', 1800000, 0, 0, '130121', '00001', ''),
('SOGR/VH/311220/00001', '2020-12-31 00:00:00', 545000, 'Transfer', 'BNI - 61656565 (Bima)', 1200000, 70000, 0, '311220', '00001', ''),
('SOGR/VH/311220/00002', '2020-12-23 00:00:00', 0, 'Tunai', 'BRI - 1301321323234 (Dery)', 250000, 25000, 0, '311220', '00002', ''),
('SOGR/VH/311220/00003', '2020-12-31 00:00:00', -40000, 'Transfer', 'BRI - 1301321323234 (Dery)', 420000, 0, 10000, '311220', '00003', '');

-- --------------------------------------------------------

--
-- Table structure for table `saleretail_sub`
--

CREATE TABLE `saleretail_sub` (
  `kode_subsale` int(11) NOT NULL,
  `no_invoice` varchar(50) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `jenis_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saleretail_sub`
--

INSERT INTO `saleretail_sub` (`kode_subsale`, `no_invoice`, `kode_barang`, `harga_jual`, `discount`, `qty`, `sub_total`, `jenis_barang`, `kode_jenis_barang`) VALUES
(1, 'SOGR/VH/311220/00001', 'L-L100-00001', 225000, 10000, 1, 205000, 'liquid', 'kode_barang'),
(2, 'SOGR/VH/311220/00001', 'L-MDO-00001', 180000, 5000, 2, 340000, 'device', 'kode_device'),
(3, 'SOGR/VH/311220/00002', 'L-L100-00001', 225000, 0, 0, 0, 'liquid', 'kode_barang'),
(4, 'SOGR/VH/311220/00003', 'L-L100-00001', 225000, 20000, 0, -40000, 'liquid', 'kode_barang'),
(5, 'SOGR/VH/130121/00001', 'L-L100-00001', 225000, 0, 8, 1800000, 'liquid', 'kode_barang'),
(6, 'SOGR/VH/030221/00001', 'L-L100-00001', 225000, 0, 5, 1125000, 'liquid', 'kode_barang'),
(7, 'SOGR/VH/040221/00001', 'L-L100-00001', 225000, 10000, 2, 430000, 'liquid', 'kode_barang'),
(8, 'SOGR/VH/040221/00001', 'L-MDO-00001', 180000, 30000, 3, 450000, 'device', 'kode_device'),
(9, 'SOGR/VH/040221/00001', 'I-AT/RDTA-00001', 230000, 0, 1, 230000, 'atomizer', 'kode_atomizer'),
(10, 'SOGR/VH/050221/00001', 'L-CHG-00001', 90000, 0, 1, 90000, 'accessories', 'kode_aksesoris'),
(11, 'SOGR/VH/080221/00001', 'L-L100-00001', 225000, 0, 1, 225000, 'liquid', 'kode_barang'),
(27, 'SOGR/VH/030321/00001', 'L-L100-00001', 225000, 0, 1, 225000, 'liquid', 'kode_barang'),
(28, 'SOGR/VH/030321/00002', 'L-L100-00001', 225000, 0, 1, 225000, 'liquid', 'kode_barang'),
(29, 'SOGR/VH/030321/00003', 'L-L100-00001', 225000, 0, 1, 225000, 'liquid', 'kode_barang'),
(30, 'SOGR/VH/030321/00004', 'L-L100-00001', 225000, 0, 1, 225000, 'liquid', 'kode_barang'),
(31, 'SOGR/VH/030321/00005', 'L-L100-00001', 225000, 0, 1, 225000, 'liquid', 'kode_barang'),
(32, 'SOGR/VH/030321/00006', 'L-L100-00001', 225000, 0, 1, 225000, 'liquid', 'kode_barang');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `kode_sales` varchar(20) NOT NULL,
  `nama_sales` varchar(50) NOT NULL,
  `alamat_sales` text NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `no_hp` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`kode_sales`, `nama_sales`, `alamat_sales`, `no_tlp`, `no_hp`, `email`, `status`) VALUES
('SL0001', 'Mukidi', 'Bandung Barat', '454545454', 813235465, 'mu@kidi.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `salestudio`
--

CREATE TABLE `salestudio` (
  `no_invoice` varchar(50) NOT NULL,
  `tgl_invoice` datetime NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `no_rekening` varchar(50) NOT NULL,
  `jml_pembayaran` int(11) NOT NULL,
  `uang_kembali` int(11) NOT NULL,
  `biaya_admin` int(11) NOT NULL,
  `kode_inv` varchar(20) NOT NULL,
  `seq` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salestudio`
--

INSERT INTO `salestudio` (`no_invoice`, `tgl_invoice`, `total_biaya`, `metode_pembayaran`, `no_rekening`, `jml_pembayaran`, `uang_kembali`, `biaya_admin`, `kode_inv`, `seq`, `status`) VALUES
('SOGS/VH/020321/00001', '2021-03-11 00:00:00', 150000, 'Tunai', '0', 1000000, 850000, 0, '020321', '00001', ''),
('SOGS/VH/020321/00002', '2021-03-10 00:00:00', 250000, 'Tunai', '0', 1000000, 750000, 0, '020321', '00002', ''),
('SOGS/VH/020321/00003', '2021-03-04 00:00:00', 150000, 'Tunai', '', 1000000, 850000, 0, '020321', '00003', ''),
('SOGS/VH/020321/00004', '2021-03-11 00:00:00', 250000, 'Tunai', '11', 2000000, 2000000, 0, '020321', '00004', ''),
('SOGS/VH/030321/00001', '2021-03-19 00:00:00', 250000, 'Tunai', '11', 250000, 0, 0, '030321', '00001', ''),
('SOGS/VH/050221/00001', '2021-02-05 00:00:00', 250000, 'Tunai', '0', 250000, 0, 0, '050221', '00001', ''),
('SOGS/VH/080221/00001', '2021-02-08 00:00:00', 250000, 'Tunai', '0', 250000, 0, 0, '080221', '00001', ''),
('SOGS/VH/080221/00002', '2021-02-08 00:00:00', 250000, 'Tunai', '0', 260000, 10000, 0, '080221', '00002', ''),
('SOGS/VH/130121/00001', '2021-01-13 00:00:00', 250000, 'Tunai', 'BRI - 1301321323234 (Dery)', 250000, 0, 0, '130121', '00001', ''),
('SOGS/VH/130121/00002', '2021-01-13 00:00:00', 250000, 'Tunai', '0', 260000, 10000, 0, '130121', '00002', ''),
('SOGS/VH/311220/00001', '2020-12-29 00:00:00', 3510000, 'Tunai', '0', 4000000, 190000, 0, '311220', '00001', '');

-- --------------------------------------------------------

--
-- Table structure for table `salestudio_sub`
--

CREATE TABLE `salestudio_sub` (
  `kode_subsale` int(11) NOT NULL,
  `no_invoice` varchar(50) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `jenis_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salestudio_sub`
--

INSERT INTO `salestudio_sub` (`kode_subsale`, `no_invoice`, `kode_barang`, `harga_jual`, `discount`, `qty`, `sub_total`, `jenis_barang`, `kode_jenis_barang`) VALUES
(1, 'SOGS/VH/311220/00001', 'L-L100-00001', 250000, 15000, 7, 1645000, 'liquid', 'kode_barang'),
(2, 'SOGS/VH/311220/00001', 'I-AT/RDTA-00001', 240000, 5000, 5, 1175000, 'atomizer', 'kode_atomizer'),
(3, 'SOGS/VH/311220/00001', 'L-CHG-00001', 100000, 1000, 7, 690000, 'accessories', 'kode_aksesoris'),
(4, 'SOGS/VH/130121/00001', 'L-L100-00001', 250000, 0, 1, 250000, 'liquid', 'kode_barang'),
(5, 'SOGS/VH/130121/00002', 'L-L100-00001', 250000, 0, 1, 250000, 'liquid', 'kode_barang'),
(6, 'SOGS/VH/050221/00001', 'L-L100-00001', 250000, 0, 1, 250000, 'liquid', 'kode_barang'),
(7, 'SOGS/VH/080221/00001', 'L-L100-00001', 250000, 0, 1, 250000, 'liquid', 'kode_barang'),
(8, 'SOGS/VH/080221/00002', 'L-L100-00001', 250000, 0, 1, 250000, 'liquid', 'kode_barang'),
(9, 'SOGS/VH/020321/00001', 'L-L100-00002', 150000, 0, 1, 150000, 'liquid', 'kode_barang'),
(10, 'SOGS/VH/020321/00002', 'L-L100-00001', 250000, 0, 1, 250000, 'liquid', 'kode_barang'),
(11, 'SOGS/VH/020321/00003', 'L-L100-00002', 150000, 0, 1, 150000, 'liquid', 'kode_barang'),
(12, 'SOGS/VH/020321/00004', 'L-L100-00001', 250000, 0, 1, 250000, 'liquid', 'kode_barang'),
(13, 'SOGS/VH/030321/00001', 'L-L100-00001', 250000, 0, 1, 250000, 'liquid', 'kode_barang');

-- --------------------------------------------------------

--
-- Table structure for table `selisih_pembelian`
--

CREATE TABLE `selisih_pembelian` (
  `id_hutang` int(11) NOT NULL,
  `no_order` varchar(50) NOT NULL,
  `no_retur` varchar(50) NOT NULL,
  `tgl_pembayaran` datetime NOT NULL,
  `jumlah_pembayaran` int(11) NOT NULL,
  `sisa_pembayaran` int(11) NOT NULL,
  `metode_pembayaran` varchar(20) NOT NULL,
  `no_rekening` varchar(50) NOT NULL,
  `catatan` text NOT NULL,
  `tgl_entry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selisih_pembelian`
--

INSERT INTO `selisih_pembelian` (`id_hutang`, `no_order`, `no_retur`, `tgl_pembayaran`, `jumlah_pembayaran`, `sisa_pembayaran`, `metode_pembayaran`, `no_rekening`, `catatan`, `tgl_entry`) VALUES
(2, 'PO/VH/13012021/00008', 'RB/VH/01-21/0006', '2021-01-16 00:00:00', 100000, -400000, 'Transfer', 'BNI - 61656565 (Bima)', 'Test 1', '0000-00-00 00:00:00'),
(3, 'PO/VH/13012021/00008', 'RB/VH/01-21/0006', '2021-01-16 00:00:00', 250000, -150000, 'Cash', '0', 'Cash AJa', '0000-00-00 00:00:00'),
(4, 'PO/VH/13012021/00008', 'RB/VH/01-21/0006', '2021-01-16 00:00:00', 150000, 0, 'Transfer', 'BRI - 1301321323234 (Dery)', 'Lunas', '0000-00-00 00:00:00'),
(5, 'PO/VH/16012021/00009', 'RB/VH/01-21/0007', '2021-01-16 00:00:00', 50000, -200000, 'Transfer', 'BCA - 787941515 (Drajat)', 'oKE', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `selisih_penjualan`
--

CREATE TABLE `selisih_penjualan` (
  `id_hutang` int(11) NOT NULL,
  `no_invoice` varchar(50) NOT NULL,
  `no_retur` varchar(50) NOT NULL,
  `tgl_pembayaran` datetime NOT NULL,
  `jumlah_pembayaran` int(11) NOT NULL,
  `sisa_pembayaran` int(11) NOT NULL,
  `metode_pembayaran` varchar(20) NOT NULL,
  `no_rekening` varchar(50) NOT NULL,
  `catatan` text NOT NULL,
  `tgl_entry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selisih_penjualan`
--

INSERT INTO `selisih_penjualan` (`id_hutang`, `no_invoice`, `no_retur`, `tgl_pembayaran`, `jumlah_pembayaran`, `sisa_pembayaran`, `metode_pembayaran`, `no_rekening`, `catatan`, `tgl_entry`) VALUES
(1, 'SO/VH/130121 09:41:27/00001', 'SO/VH/01-21/0003', '2021-01-16 00:00:00', 35000, -365000, 'Cash', '0', 'Test Cash', '0000-00-00 00:00:00'),
(2, 'SO/VH/130121 09:41:27/00001', 'SO/VH/01-21/0003', '2021-01-16 00:00:00', 200000, -165000, 'Transfer', 'BJB - 454566566 (Mukti)', 'Transfer aja', '0000-00-00 00:00:00'),
(3, 'SO/VH/130121 09:41:27/00001', 'SO/VH/01-21/0003', '2021-01-16 00:00:00', 165000, 0, 'Cash', '0', 'test3 ', '0000-00-00 00:00:00'),
(4, 'SO/VH/130121 09:41:27/00001', 'SO/VH/02-21/0005', '2021-02-07 00:00:00', 2250000, 0, 'Transfer', 'BRI - 1301321323234 (Dery)', 'dasdasd', '0000-00-00 00:00:00'),
(5, 'SO/VH/130121 09:41:27/00001', 'SO/VH/02-21/0006', '2021-02-07 00:00:00', 1125000, 0, 'Transfer', 'BNI - 61656565 (Bima)', 'dfdsfdf', '0000-00-00 00:00:00'),
(6, 'SO/VH/081220 11:35:34/00001', 'SO/VH/02-21/0007', '2021-02-07 00:00:00', 1575000, 0, 'Cash', '0', 'asdsad', '0000-00-00 00:00:00'),
(7, 'SO/VH/130121 09:41:27/00001', 'SO/VH/02-21/0009', '2021-02-07 00:00:00', 4500000, 0, 'Cash', '0', 'sdasd', '0000-00-00 00:00:00'),
(8, 'SO/VH/130121 09:41:27/00001', 'SO/VH/02-21/0010', '2021-02-07 00:00:00', 2250000, 0, 'Cash', '0', 'sdasd', '0000-00-00 00:00:00'),
(9, 'SO/VH/130121 09:41:27/00001', 'SO/VH/02-21/0001', '2021-02-07 00:00:00', 2250000, 0, 'Cash', '0', 'jlkjlkj', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sop_gudang`
--

CREATE TABLE `sop_gudang` (
  `no_sop` varchar(30) NOT NULL,
  `tgl_sop` datetime NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `seq` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sop_gudang`
--

INSERT INTO `sop_gudang` (`no_sop`, `tgl_sop`, `kategori`, `seq`) VALUES
('SOGP-0001/VH/02-21/L', '2021-02-07 00:00:00', 'Liquid', '0001'),
('SOGP-0002/VH/02-21/L', '2021-02-08 00:00:00', 'Liquid', '0002');

-- --------------------------------------------------------

--
-- Table structure for table `sop_retail`
--

CREATE TABLE `sop_retail` (
  `no_sop` varchar(30) NOT NULL,
  `tgl_sop` datetime NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `seq` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sop_retail`
--

INSERT INTO `sop_retail` (`no_sop`, `tgl_sop`, `kategori`, `seq`) VALUES
('SOGR-A/VH/01-21/0002', '2021-01-21 00:00:00', 'Aksesoris', '0002'),
('SOGR-L/VH/02-21/0003', '2021-02-05 00:00:00', 'Liquid', '0003'),
('SOGR-T/VH/01-21/0001', '2020-12-31 00:00:00', 'Atomizer', '0001');

-- --------------------------------------------------------

--
-- Table structure for table `sop_retail_sub`
--

CREATE TABLE `sop_retail_sub` (
  `kode_subsop` int(11) NOT NULL,
  `no_sop` varchar(50) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `qty_before` int(11) NOT NULL,
  `qty_after` int(11) NOT NULL,
  `bad_stock` int(11) NOT NULL,
  `selisih` int(11) NOT NULL,
  `ket` text NOT NULL,
  `jenis_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sop_retail_sub`
--

INSERT INTO `sop_retail_sub` (`kode_subsop`, `no_sop`, `kode_barang`, `qty_before`, `qty_after`, `bad_stock`, `selisih`, `ket`, `jenis_barang`, `kode_jenis_barang`) VALUES
(2, 'SOGR-T/VH/01-21/0001', 'I-AT/RDTA-00001', 198, 197, 0, 1, '', 'atomizer', 'kode_atomizer'),
(5, 'SOGR-L/VH/02-21/0003', 'L-L100-00001', 88, 88, 0, 0, 'Sesuai', 'liquid', 'kode_barang'),
(6, 'SOGR-A/VH/01-21/0002', 'L-CHG-00001', 100, 99, 0, 1, '1 Selisihnya (Eh 2 Ketang) 1 denk', 'accessories', 'kode_aksesoris');

-- --------------------------------------------------------

--
-- Table structure for table `sop_studio`
--

CREATE TABLE `sop_studio` (
  `no_sop` varchar(30) NOT NULL,
  `tgl_sop` datetime NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `seq` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sop_studio`
--

INSERT INTO `sop_studio` (`no_sop`, `tgl_sop`, `kategori`, `seq`) VALUES
('SOGS-A/VH/01-21/0001', '2021-01-21 00:00:00', 'Aksesoris', '0001'),
('SOGS-D/VH/01-21/0002', '2021-01-13 00:00:00', 'Device', '0002'),
('SOGS-T/VH/02-21/0003', '2021-02-05 00:00:00', 'Atomizer', '0003');

-- --------------------------------------------------------

--
-- Table structure for table `sop_studio_sub`
--

CREATE TABLE `sop_studio_sub` (
  `kode_subsop` int(11) NOT NULL,
  `no_sop` varchar(50) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `qty_before` int(11) NOT NULL,
  `qty_after` int(11) NOT NULL,
  `bad_stock` int(11) NOT NULL,
  `selisih` int(11) NOT NULL,
  `ket` text NOT NULL,
  `jenis_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sop_studio_sub`
--

INSERT INTO `sop_studio_sub` (`kode_subsop`, `no_sop`, `kode_barang`, `qty_before`, `qty_after`, `bad_stock`, `selisih`, `ket`, `jenis_barang`, `kode_jenis_barang`) VALUES
(4, 'SOGS-D/VH/01-21/0002', 'L-MDO-00001', 94, 92, 0, 2, 'Kurang 2', 'device', 'kode_device'),
(5, 'SOGS-T/VH/02-21/0003', 'I-AT/RDTA-00001', 195, 195, 0, 0, 'Sesuai', 'atomizer', 'kode_atomizer'),
(6, 'SOGS-A/VH/01-21/0001', 'L-CHG-00001', 90, 86, 0, 4, 'ok', 'accessories', 'kode_aksesoris');

-- --------------------------------------------------------

--
-- Table structure for table `sub_badstockgudang`
--

CREATE TABLE `sub_badstockgudang` (
  `kode_subproses` int(11) NOT NULL,
  `no_proses` varchar(50) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `stok_pusat` int(11) NOT NULL,
  `bad_stock` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `jenis_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_badstockgudang`
--

INSERT INTO `sub_badstockgudang` (`kode_subproses`, `no_proses`, `kode_barang`, `stok_pusat`, `bad_stock`, `qty`, `sisa`, `jenis_barang`, `kode_jenis_barang`) VALUES
(9, '', 'L-CHG-00001', 105, 0, 20, 0, 'accessories', 'kode_aksesoris'),
(10, '', 'I-AT/RDTA-00001', 210, 0, 25, 0, 'atomizer', 'kode_atomizer'),
(17, 'BS/VH/2021-01/00002', 'L-L100-00001', 146, 11, 4, 7, 'liquid', 'kode_barang'),
(18, 'BS/VH/2021-01/00001', 'L-L100-00001', 96, 7, 4, 3, 'liquid', 'kode_barang'),
(21, 'BS/VH/2021-02/00003', 'I-AT/RDTA-00001', 200, 7, 2, 5, 'atomizer', 'kode_atomizer');

-- --------------------------------------------------------

--
-- Table structure for table `sub_ordercentral`
--

CREATE TABLE `sub_ordercentral` (
  `kode_suborder` int(11) NOT NULL,
  `no_order` varchar(20) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `jenis_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_ordercentral`
--

INSERT INTO `sub_ordercentral` (`kode_suborder`, `no_order`, `kode_barang`, `harga_beli`, `qty`, `sub_total`, `jenis_barang`, `kode_jenis_barang`) VALUES
(1, 'PO/VH/08122020/00001', 'L-L100-00001', 150000, 7, 1050000, 'liquid', 'kode_barang'),
(2, 'PO/VH/08122020/00001', 'I-MDO-00001', 80000, 15, 1200000, 'device', 'kode_device'),
(3, 'PO/VH/08122020/00002', 'L-CHG-00001', 75000, 5, 375000, 'accessories', 'kode_aksesoris'),
(4, 'PO/VH/08122020/00002', 'I-AT/RDTA-00001', 200000, 10, 2000000, 'atomizer', 'kode_atomizer'),
(6, 'PO/VH/10122020/00003', 'L-MDO-00001', 150000, 1, 150000, 'device', 'kode_device'),
(8, 'PO/VH/13012021/00005', 'L-L100-00001', 150000, 30, 4500000, 'liquid', 'kode_barang'),
(9, 'PO/VH/13012021/00005', 'L-CHG-00001', 75000, 75, 5625000, 'accessories', 'kode_aksesoris'),
(10, 'PO/VH/13012021/00006', 'L-L100-00001', 150000, 20, 3000000, 'liquid', 'kode_barang'),
(11, 'PO/VH/13012021/00007', 'L-L100-00001', 150000, 20, 3000000, 'liquid', 'kode_barang'),
(12, 'PO/VH/13012021/00008', 'L-L100-00001', 150000, 20, 3000000, 'liquid', 'kode_barang'),
(13, 'PO/VH/16012021/00009', 'L-MDO-00001', 150000, 5, 750000, 'device', 'kode_device'),
(14, 'PO/VH/10122020/00004', 'L-MDO-00001', 150000, 2, 300000, 'device', 'kode_device'),
(15, 'PO/VH/04022021/00011', 'L-L100-00001', 150000, 1, 150000, 'liquid', 'kode_barang'),
(16, 'PO/VH/04022021/00012', 'I-AT/RDTA-00001', 200000, 1, 200000, 'atomizer', 'kode_atomizer'),
(17, 'PO/VH/04022021/00013', 'L-L100-00001', 150000, 1, 150000, 'liquid', 'kode_barang'),
(22, 'PO/VH/08022021/00001', 'L-L100-00001', 150000, 10, 1500000, 'liquid', 'kode_barang'),
(24, 'PO/VH/01032021/00003', 'L-L100-00001', 150000, 1, 150000, 'liquid', 'kode_barang'),
(25, 'PO/VH/01032021/00004', 'L-L100-00001', 150000, 1, 150000, 'liquid', 'kode_barang'),
(28, 'PO/VH/01032021/00007', 'L-L100-00001', 150000, 2, 300000, 'liquid', 'kode_barang'),
(29, 'PO/VH/01032021/00008', 'L-L100-00001', 150000, 1, 150000, 'liquid', 'kode_barang'),
(35, 'PO/VH/02032021/00009', 'L-L100-00001', 150000, 1, 150000, 'liquid', 'kode_barang'),
(36, 'PO/VH/02032021/00010', 'L-L100-00002', 115000, 1, 115000, 'liquid', 'kode_barang'),
(37, 'PO/VH/02032021/00011', 'L-L100-00002', 115000, 1, 115000, 'liquid', 'kode_barang'),
(38, 'PO/VH/02032021/00012', 'L-L100-00001', 150000, 1, 150000, 'liquid', 'kode_barang'),
(39, 'PO/VH/02032021/00013', 'L-L100-00002', 115000, 1, 115000, 'liquid', 'kode_barang'),
(40, 'PO/VH/02032021/00014', 'L-L100-00002', 115000, 1, 115000, 'liquid', 'kode_barang'),
(41, 'PO/VH/02032021/00015', 'L-L100-00001', 150000, 1, 150000, 'liquid', 'kode_barang'),
(42, 'PO/VH/01032021/00006', 'L-L100-00001', 150000, 1, 150000, 'liquid', 'kode_barang'),
(43, 'PO/VH/01032021/00005', 'L-L100-00001', 150000, 1, 150000, 'liquid', 'kode_barang');

-- --------------------------------------------------------

--
-- Table structure for table `sub_returpembelian`
--

CREATE TABLE `sub_returpembelian` (
  `no_subretur` int(11) NOT NULL,
  `no_retur` varchar(50) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `qty_retur` int(11) NOT NULL,
  `nominal_retur` int(11) NOT NULL,
  `alasan` varchar(20) NOT NULL,
  `jenis_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_returpembelian`
--

INSERT INTO `sub_returpembelian` (`no_subretur`, `no_retur`, `kode_barang`, `qty`, `harga_beli`, `sub_total`, `qty_retur`, `nominal_retur`, `alasan`, `jenis_barang`, `kode_jenis_barang`) VALUES
(1, 'RB/VH/12-20/0001', 'L-CHG-00001', 5, 75000, 375000, 5, 375000, 'tidak sesuai', 'accessories', 'kode_aksesoris'),
(2, 'RB/VH/01-21/0002', 'L-L100-00001', 7, 150000, 1050000, 3, 450000, 'cacat/rusak', 'liquid', 'kode_barang'),
(3, 'RB/VH/01-21/0003', 'L-L100-00001', 30, 150000, 4500000, 20, 3000000, 'cacat/rusak', 'liquid', 'kode_barang'),
(4, 'RB/VH/01-21/0004', 'L-L100-00001', 10, 150000, 1500000, 10, 1500000, 'cacat/rusak', 'liquid', 'kode_barang'),
(5, 'RB/VH/01-21/0005', 'L-L100-00001', 10, 150000, 1500000, 10, 1500000, 'tidak sesuai', 'liquid', 'kode_barang'),
(6, 'RB/VH/01-21/0006', 'L-L100-00001', 10, 150000, 1500000, 10, 1500000, 'tidak sesuai', 'liquid', 'kode_barang'),
(7, 'RB/VH/01-21/0007', 'L-MDO-00001', 3, 150000, 450000, 2, 300000, 'tidak sesuai', 'device', 'kode_device'),
(8, 'RB/VH/02-21/0008', 'L-L100-00001', 19, 150000, 2850000, 1, 150000, 'cacat/rusak', 'liquid', 'kode_barang'),
(9, 'RB/VH/03-21/0009', 'L-L100-00001', 0, 150000, 0, 1, 150000, '', 'liquid', 'kode_barang'),
(10, 'RB/VH/03-21/0010', 'L-L100-00001', 0, 150000, 0, 1, 150000, 'cacat/rusak', 'liquid', 'kode_barang');

-- --------------------------------------------------------

--
-- Table structure for table `sub_returpenjualan`
--

CREATE TABLE `sub_returpenjualan` (
  `no_subretur` int(11) NOT NULL,
  `no_retur` varchar(50) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `qty_retur` int(11) NOT NULL,
  `nominal_retur` int(11) NOT NULL,
  `alasan` varchar(20) NOT NULL,
  `jenis_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_returpenjualan`
--

INSERT INTO `sub_returpenjualan` (`no_subretur`, `no_retur`, `kode_barang`, `qty`, `harga_jual`, `sub_total`, `qty_retur`, `nominal_retur`, `alasan`, `jenis_barang`, `kode_jenis_barang`) VALUES
(1, 'SO/VH/12-20/0001', 'I-MDO-00001', 5, 120000, 600000, 5, 600000, 'cacat/rusak', 'device', 'kode_device'),
(2, 'SO/VH/01-21/0002', 'L-L100-00001', 7, 225000, 1575000, 3, 675000, 'tidak sesuai', 'liquid', 'kode_barang'),
(3, 'SO/VH/01-21/0003', 'L-L100-00001', 6, 225000, 1350000, 4, 900000, 'cacat/rusak', 'liquid', 'kode_barang'),
(4, 'SO/VH/02-21/0004', 'L-L100-00001', 5, 225000, 1125000, 5, 1125000, 'cacat/rusak', 'liquid', 'kode_barang'),
(5, 'SO/VH/02-21/0005', 'L-L100-00001', 5, 225000, 1125000, 5, 1125000, 'cacat/rusak', 'liquid', 'kode_barang'),
(6, 'SO/VH/02-21/0006', 'L-L100-00001', 5, 225000, 1125000, 5, 1125000, 'cacat/rusak', 'liquid', 'kode_barang'),
(7, 'SO/VH/02-21/0007', 'L-L100-00001', 0, 225000, 0, 7, 1575000, 'cacat/rusak', 'liquid', 'kode_barang'),
(8, 'SO/VH/02-21/0008', 'L-L100-00001', 0, 225000, 0, 10, 2250000, 'cacat/rusak', 'liquid', 'kode_barang'),
(9, 'SO/VH/02-21/0009', 'L-L100-00001', 0, 225000, 0, 10, 2250000, 'cacat/rusak', 'liquid', 'kode_barang'),
(10, 'SO/VH/02-21/0010', 'L-L100-00001', 0, 225000, 0, 10, 2250000, 'cacat/rusak', 'liquid', 'kode_barang'),
(11, 'SO/VH/02-21/0001', 'L-L100-00001', 0, 225000, 0, 10, 2250000, 'tidak sesuai', 'liquid', 'kode_barang'),
(12, 'SO/VH/02-21/0002', 'L-L100-00001', 0, 225000, 0, 1, 225000, 'tidak sesuai', 'liquid', 'kode_barang'),
(13, 'SO/VH/03-21/0003', 'L-L100-00002', 0, 190000, 0, 1, 190000, 'tidak sesuai', 'liquid', 'kode_barang'),
(14, 'SO/VH/03-21/0004', 'L-L100-00001', 0, 225000, 0, 1, 225000, 'cacat/rusak', 'liquid', 'kode_barang');

-- --------------------------------------------------------

--
-- Table structure for table `sub_salecentral`
--

CREATE TABLE `sub_salecentral` (
  `kode_subsale` int(11) NOT NULL,
  `no_invoice` varchar(50) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `free` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `sub_total_berat` int(11) NOT NULL,
  `jenis_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_salecentral`
--

INSERT INTO `sub_salecentral` (`kode_subsale`, `no_invoice`, `kode_barang`, `harga_jual`, `qty`, `free`, `sub_total`, `sub_total_berat`, `jenis_barang`, `kode_jenis_barang`) VALUES
(3, 'SO/VH/081220 11:35:34/00001', 'I-MDO-00001', 120000, 5, 0, 600000, 10000, 'device', 'kode_device'),
(4, 'SO/VH/081220 11:35:34/00001', 'L-L100-00001', 225000, 7, 0, 1575000, 10000, 'liquid', 'kode_barang'),
(5, 'SO/VH/101220 05:15:24/00001', 'L-L100-00001', 225000, 20, 0, 4500000, 20000, 'liquid', 'kode_barang'),
(6, 'SO/VH/101220 05:15:24/00001', 'L-CHG-00001', 90000, 20, 0, 1800000, 20000, 'accessories', 'kode_aksesoris'),
(8, 'SO/VH/130121 09:41:27/00001', 'L-L100-00001', 225000, 10, 0, 2250000, 10000, 'liquid', 'kode_barang'),
(9, 'SO/VH/030221 05:14:18/00001', 'L-L100-00001', 225000, 5, 0, 1125000, 5000, 'liquid', 'kode_barang'),
(11, 'SO/VH/030221 07:25:12/00002', 'I-AT/RDTA-00001', 230000, 6, 0, 1380000, 6000, 'atomizer', 'kode_atomizer'),
(12, 'SO/VH/070221 12:56:29/00001', 'L-L100-00001', 225000, 1, 0, 225000, 1000, 'liquid', 'kode_barang'),
(14, 'SO/VH/070221 15:14:34/00002', 'L-L100-00001', 225000, 1, 0, 225000, 1000, 'liquid', 'kode_barang'),
(16, 'SO/VH/080221 02:05:00/00001', 'L-L100-00001', 225000, 1, 0, 225000, 1000, 'liquid', 'kode_barang'),
(22, 'SO/VH/080221 05:52:17/00005', 'L-L100-00001', 225000, 1, 0, 225000, 1000, 'liquid', 'kode_barang'),
(23, 'SO/VH/080221 05:51:35/00004', 'L-L100-00001', 225000, 1, 0, 225000, 1000, 'liquid', 'kode_barang'),
(25, 'SO/VH/010321 03:21:22/00001', 'L-L100-00001', 225000, 2, 0, 450000, 2000, 'liquid', 'kode_barang'),
(26, 'SO/VH/080221 05:50:55/00003', 'L-L100-00001', 225000, 1, 0, 225000, 1000, 'liquid', 'kode_barang'),
(28, 'SO/VH/010321 05:23:49/00010', 'L-L100-00001', 225000, 1, 0, 225000, 1000, 'liquid', 'kode_barang'),
(30, 'SO/VH/010321 08:07:33/00012', 'L-L100-00002', 190000, 1, 0, 190000, 588, 'liquid', 'kode_barang'),
(31, 'SO/VH/020321 04:55:03/00001', 'L-L100-00001', 225000, 1, 0, 225000, 1000, 'liquid', 'kode_barang'),
(32, 'SO/VH/020321 04:58:30/00002', 'L-L100-00002', 190000, 1, 0, 190000, 588, 'liquid', 'kode_barang'),
(40, 'SO/VH/030321 13:04:45/00001', 'L-L100-00001', 225000, 1, 0, 225000, 1000, 'liquid', 'kode_barang');

-- --------------------------------------------------------

--
-- Table structure for table `sub_sop_gudang`
--

CREATE TABLE `sub_sop_gudang` (
  `kode_subsop` int(11) NOT NULL,
  `no_sop` varchar(50) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `qty_before` int(11) NOT NULL,
  `qty_after` int(11) NOT NULL,
  `bad_stock` int(11) NOT NULL,
  `selisih` int(11) NOT NULL,
  `ket` text NOT NULL,
  `jenis_barang` varchar(20) NOT NULL,
  `kode_jenis_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_sop_gudang`
--

INSERT INTO `sub_sop_gudang` (`kode_subsop`, `no_sop`, `kode_barang`, `qty_before`, `qty_after`, `bad_stock`, `selisih`, `ket`, `jenis_barang`, `kode_jenis_barang`) VALUES
(3, 'SOGP-0001/VH/01-21/L', 'L-L100-00001', 99, 97, 0, 2, '', 'liquid', 'kode_barang'),
(4, 'SOGP-0002/VH/01-21/L', 'L-L100-00001', 97, 94, 1, 2, '', 'liquid', 'kode_barang'),
(6, 'SOGP-0003/VH/01-21/T', 'I-AT/RDTA-00001', 210, 206, 3, 1, 'Bad Stock 3, Selisih 1', 'atomizer', 'kode_atomizer'),
(8, 'SOGP-0004/VH/02-21/L', 'L-L100-00001', 152, 150, 0, 2, '', 'liquid', 'kode_barang'),
(9, 'SOGP-0005/VH/02-21/L', 'L-L100-00001', 150, 160, 1, -11, '', 'liquid', 'kode_barang'),
(10, 'SOGP-0006/VH/02-21/L', 'L-L100-00001', 160, 150, 5, 5, '', 'liquid', 'kode_barang'),
(11, 'SOGP-0007/VH/02-21/L', 'L-L100-00001', 150, 140, 4, 6, '', 'liquid', 'kode_barang'),
(12, 'SOGP-0008/VH/02-21/L', 'L-L100-00001', 140, 0, 0, 0, '', 'liquid', 'kode_barang'),
(13, 'SOGP-0009/VH/02-21/L', 'L-L100-00001', 0, 150, 5, -155, '', 'liquid', 'kode_barang'),
(14, 'SOGP-0010/VH/02-21/L', 'L-L100-00001', 150, 120, 4, 26, '', 'liquid', 'kode_barang'),
(15, 'SOGP-0001/VH/02-21/L', 'L-L100-00001', 120, 140, 5, -25, '', 'liquid', 'kode_barang'),
(16, 'SOGP-0002/VH/02-21/L', 'L-L100-00001', 140, 120, 20, 0, '', 'liquid', 'kode_barang');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kode_supplier` varchar(20) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat_supplier` text NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kode_supplier`, `nama_supplier`, `alamat_supplier`, `no_tlp`, `no_hp`, `email`, `tipe`, `status`) VALUES
('S0001', 'PT. Angin Berhembus', 'Jl. Antartika No.99 Kab.Garut', '7511466', '08136565598', 'angin@berhembus.com', 'Lokal', '1'),
('S0002', 'CV. Kodok Terbang', 'Jl.Mie Aceh No.35 Kota Indomie', '23332332323', '08112233114', 'mie@aceh.com', 'Impor', '1');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `nominal` int(11) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `catatan` varchar(100) NOT NULL,
  `type` varchar(30) NOT NULL,
  `nama_table` varchar(50) NOT NULL,
  `id_table` varchar(50) NOT NULL,
  `id_jenisexpense` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `tgl_transaksi`, `nominal`, `deskripsi`, `catatan`, `type`, `nama_table`, `id_table`, `id_jenisexpense`, `id_akun`) VALUES
(59, '2021-03-11', 2000000, 'Transaksi Sales Tudio \nSOGS/VH/020321/00004', '', 'Cash In', 'salestudio', 'SOGS/VH/020321/00004', 0, 11),
(64, '2021-03-11', 150000, 'Transaksi Pembelian \nRB/VH/03-21/0009', '', 'Cash Out', 'retur_pembelian', 'RB/VH/03-21/0009', 0, 7),
(67, '2021-03-25', 225000, 'Transaksi Pembelian \nSO/VH/03-21/0004', '', 'Cash In', 'retur_penjualan', 'SO/VH/03-21/0004', 0, 11),
(69, '2021-03-19', 250000, 'Transaksi Sales Studio \nSOGS/VH/030321/00001', '', 'Cash In', 'salestudio', 'SOGS/VH/030321/00001', 0, 11),
(77, '2021-03-11', 100000000, 'Transaksi Sales Studio \nSOGR/VH/030321/00005', '', 'Cash In', 'saleretail', 'SOGR/VH/030321/00005', 0, 11),
(78, '2021-03-11', 1000000, 'Transaksi Sales Retail \nSOGR/VH/030321/00006', '', 'Cash In', 'saleretail', 'SOGR/VH/030321/00006', 0, 11),
(79, '2021-03-06', 225000, 'Retur Sales Retail \nRR/VH/03-21/0004', '', 'Cash In', 'retursaleretail', 'RR/VH/03-21/0004', 0, 11),
(80, '0000-00-00', 20000, 'Transaksi Penjualan \nSO/VH/030321 13:04:45/00001', '', 'Cash In', 'salecentral', 'SO/VH/030321 13:04:45/00001', 0, 7),
(81, '0000-00-00', 100000, 'Transaksi Penjualan \nSO/VH/030321 13:04:45/00001', '', 'Cash In', 'salecentral', 'SO/VH/030321 13:04:45/00001', 0, 0),
(82, '2021-03-06', 200000, '', '-', 'Cash In', '', '', 6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(20) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `group` varchar(20) DEFAULT NULL,
  `i_entry` varchar(50) DEFAULT NULL,
  `d_entry` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `password`, `nama`, `email`, `group`, `i_entry`, `d_entry`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@admin.com', '3', 'admin', '2020-10-23'),
('budi', '202cb962ac59075b964b07152d234b70', 'Budiman', 'b@man.com', '2', 'admin', '2021-01-11');

-- --------------------------------------------------------

--
-- Table structure for table `volliquid`
--

CREATE TABLE `volliquid` (
  `id_volume` varchar(4) NOT NULL,
  `volume` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volliquid`
--

INSERT INTO `volliquid` (`id_volume`, `volume`, `status`, `seq`) VALUES
('', 0, '', 9),
('VL03', 26, '1', 3),
('VL04', 30, '1', 4),
('VL05', 21, '1', 5),
('VL06', 100, '1', 6),
('VL07', 100, '1', 7),
('VL08', 2, '1', 8);

-- --------------------------------------------------------

--
-- Table structure for table `warna`
--

CREATE TABLE `warna` (
  `kode_warna` varchar(5) NOT NULL,
  `nama_warna` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warna`
--

INSERT INTO `warna` (`kode_warna`, `nama_warna`, `status`) VALUES
('2', 'kuning', '1'),
('3', 'biru', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`kode_aksesoris`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `atomizer`
--
ALTER TABLE `atomizer`
  ADD PRIMARY KEY (`kode_atomizer`);

--
-- Indexes for table `badstockgudang`
--
ALTER TABLE `badstockgudang`
  ADD PRIMARY KEY (`no_proses`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`kode_customer`);

--
-- Indexes for table `dateline`
--
ALTER TABLE `dateline`
  ADD PRIMARY KEY (`id_cot`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`kode_device`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`id_hutang`);

--
-- Indexes for table `jenisacc`
--
ALTER TABLE `jenisacc`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `jenisatomizer`
--
ALTER TABLE `jenisatomizer`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `jenisdevice`
--
ALTER TABLE `jenisdevice`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `jenisexpense`
--
ALTER TABLE `jenisexpense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `katretur`
--
ALTER TABLE `katretur`
  ADD PRIMARY KEY (`kode_retur`);

--
-- Indexes for table `liquid`
--
ALTER TABLE `liquid`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`kode_menu`);

--
-- Indexes for table `ordercentral`
--
ALTER TABLE `ordercentral`
  ADD PRIMARY KEY (`no_order`);

--
-- Indexes for table `piutang`
--
ALTER TABLE `piutang`
  ADD PRIMARY KEY (`id_piutang`);

--
-- Indexes for table `rasa_liquid`
--
ALTER TABLE `rasa_liquid`
  ADD PRIMARY KEY (`kode_rasa`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`no_id`);

--
-- Indexes for table `reqretailtocentral`
--
ALTER TABLE `reqretailtocentral`
  ADD PRIMARY KEY (`no_request`);

--
-- Indexes for table `reqretailtocentral_sub`
--
ALTER TABLE `reqretailtocentral_sub`
  ADD PRIMARY KEY (`kode_subrequest`);

--
-- Indexes for table `reqstudiotocentral`
--
ALTER TABLE `reqstudiotocentral`
  ADD PRIMARY KEY (`no_request`);

--
-- Indexes for table `reqstudiotocentral_sub`
--
ALTER TABLE `reqstudiotocentral_sub`
  ADD PRIMARY KEY (`kode_subrequest`);

--
-- Indexes for table `reqtoretail`
--
ALTER TABLE `reqtoretail`
  ADD PRIMARY KEY (`no_request`);

--
-- Indexes for table `reqtoretail_sub`
--
ALTER TABLE `reqtoretail_sub`
  ADD PRIMARY KEY (`kode_subrequest`);

--
-- Indexes for table `reqtostudio`
--
ALTER TABLE `reqtostudio`
  ADD PRIMARY KEY (`no_request`);

--
-- Indexes for table `reqtostudio_sub`
--
ALTER TABLE `reqtostudio_sub`
  ADD PRIMARY KEY (`kode_subrequest`);

--
-- Indexes for table `retursaleretail`
--
ALTER TABLE `retursaleretail`
  ADD PRIMARY KEY (`no_retur`);

--
-- Indexes for table `retursaleretail_sub`
--
ALTER TABLE `retursaleretail_sub`
  ADD PRIMARY KEY (`no_subretur`);

--
-- Indexes for table `retursalestudio`
--
ALTER TABLE `retursalestudio`
  ADD PRIMARY KEY (`no_retur`);

--
-- Indexes for table `retursalestudio_sub`
--
ALTER TABLE `retursalestudio_sub`
  ADD PRIMARY KEY (`no_subretur`);

--
-- Indexes for table `retur_pembelian`
--
ALTER TABLE `retur_pembelian`
  ADD PRIMARY KEY (`no_retur`);

--
-- Indexes for table `retur_penjualan`
--
ALTER TABLE `retur_penjualan`
  ADD PRIMARY KEY (`no_retur`);

--
-- Indexes for table `salecentral`
--
ALTER TABLE `salecentral`
  ADD PRIMARY KEY (`no_invoice`);

--
-- Indexes for table `saleretail`
--
ALTER TABLE `saleretail`
  ADD PRIMARY KEY (`no_invoice`);

--
-- Indexes for table `saleretail_sub`
--
ALTER TABLE `saleretail_sub`
  ADD PRIMARY KEY (`kode_subsale`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`kode_sales`);

--
-- Indexes for table `salestudio`
--
ALTER TABLE `salestudio`
  ADD PRIMARY KEY (`no_invoice`);

--
-- Indexes for table `salestudio_sub`
--
ALTER TABLE `salestudio_sub`
  ADD PRIMARY KEY (`kode_subsale`);

--
-- Indexes for table `selisih_pembelian`
--
ALTER TABLE `selisih_pembelian`
  ADD PRIMARY KEY (`id_hutang`);

--
-- Indexes for table `selisih_penjualan`
--
ALTER TABLE `selisih_penjualan`
  ADD PRIMARY KEY (`id_hutang`);

--
-- Indexes for table `sop_gudang`
--
ALTER TABLE `sop_gudang`
  ADD PRIMARY KEY (`no_sop`);

--
-- Indexes for table `sop_retail`
--
ALTER TABLE `sop_retail`
  ADD PRIMARY KEY (`no_sop`);

--
-- Indexes for table `sop_retail_sub`
--
ALTER TABLE `sop_retail_sub`
  ADD PRIMARY KEY (`kode_subsop`);

--
-- Indexes for table `sop_studio`
--
ALTER TABLE `sop_studio`
  ADD PRIMARY KEY (`no_sop`);

--
-- Indexes for table `sop_studio_sub`
--
ALTER TABLE `sop_studio_sub`
  ADD PRIMARY KEY (`kode_subsop`);

--
-- Indexes for table `sub_badstockgudang`
--
ALTER TABLE `sub_badstockgudang`
  ADD PRIMARY KEY (`kode_subproses`);

--
-- Indexes for table `sub_ordercentral`
--
ALTER TABLE `sub_ordercentral`
  ADD PRIMARY KEY (`kode_suborder`);

--
-- Indexes for table `sub_returpembelian`
--
ALTER TABLE `sub_returpembelian`
  ADD PRIMARY KEY (`no_subretur`);

--
-- Indexes for table `sub_returpenjualan`
--
ALTER TABLE `sub_returpenjualan`
  ADD PRIMARY KEY (`no_subretur`);

--
-- Indexes for table `sub_salecentral`
--
ALTER TABLE `sub_salecentral`
  ADD PRIMARY KEY (`kode_subsale`);

--
-- Indexes for table `sub_sop_gudang`
--
ALTER TABLE `sub_sop_gudang`
  ADD PRIMARY KEY (`kode_subsop`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kode_supplier`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `volliquid`
--
ALTER TABLE `volliquid`
  ADD PRIMARY KEY (`id_volume`);

--
-- Indexes for table `warna`
--
ALTER TABLE `warna`
  ADD PRIMARY KEY (`kode_warna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id_hutang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `jenisexpense`
--
ALTER TABLE `jenisexpense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `piutang`
--
ALTER TABLE `piutang`
  MODIFY `id_piutang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `no_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reqretailtocentral_sub`
--
ALTER TABLE `reqretailtocentral_sub`
  MODIFY `kode_subrequest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reqstudiotocentral_sub`
--
ALTER TABLE `reqstudiotocentral_sub`
  MODIFY `kode_subrequest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reqtoretail_sub`
--
ALTER TABLE `reqtoretail_sub`
  MODIFY `kode_subrequest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reqtostudio_sub`
--
ALTER TABLE `reqtostudio_sub`
  MODIFY `kode_subrequest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `retursaleretail_sub`
--
ALTER TABLE `retursaleretail_sub`
  MODIFY `no_subretur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `retursalestudio_sub`
--
ALTER TABLE `retursalestudio_sub`
  MODIFY `no_subretur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `saleretail_sub`
--
ALTER TABLE `saleretail_sub`
  MODIFY `kode_subsale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `salestudio_sub`
--
ALTER TABLE `salestudio_sub`
  MODIFY `kode_subsale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `selisih_pembelian`
--
ALTER TABLE `selisih_pembelian`
  MODIFY `id_hutang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `selisih_penjualan`
--
ALTER TABLE `selisih_penjualan`
  MODIFY `id_hutang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sop_retail_sub`
--
ALTER TABLE `sop_retail_sub`
  MODIFY `kode_subsop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sop_studio_sub`
--
ALTER TABLE `sop_studio_sub`
  MODIFY `kode_subsop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_badstockgudang`
--
ALTER TABLE `sub_badstockgudang`
  MODIFY `kode_subproses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sub_ordercentral`
--
ALTER TABLE `sub_ordercentral`
  MODIFY `kode_suborder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `sub_returpembelian`
--
ALTER TABLE `sub_returpembelian`
  MODIFY `no_subretur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sub_returpenjualan`
--
ALTER TABLE `sub_returpenjualan`
  MODIFY `no_subretur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sub_salecentral`
--
ALTER TABLE `sub_salecentral`
  MODIFY `kode_subsale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `sub_sop_gudang`
--
ALTER TABLE `sub_sop_gudang`
  MODIFY `kode_subsop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
