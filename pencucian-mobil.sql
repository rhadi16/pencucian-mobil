-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for pencucian-mobil
CREATE DATABASE IF NOT EXISTS `pencucian-mobil` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `pencucian-mobil`;

-- Dumping structure for table pencucian-mobil.auth_tokens
CREATE TABLE IF NOT EXISTS `auth_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `selector` varchar(12) NOT NULL,
  `hashedvalidator` varchar(64) NOT NULL,
  `userid` int(11) NOT NULL,
  `expires` timestamp NULL DEFAULT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table pencucian-mobil.auth_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `auth_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_tokens` ENABLE KEYS */;

-- Dumping structure for table pencucian-mobil.jenis_kendaraan
CREATE TABLE IF NOT EXISTS `jenis_kendaraan` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `tipe_kendaraan` varchar(150) DEFAULT NULL,
  `no_plat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pencucian-mobil.jenis_kendaraan: ~2 rows (approximately)
/*!40000 ALTER TABLE `jenis_kendaraan` DISABLE KEYS */;
INSERT INTO `jenis_kendaraan` (`no`, `tipe_kendaraan`, `no_plat`) VALUES
  (1, 'Roda 15', 'DD 1234 AS');
/*!40000 ALTER TABLE `jenis_kendaraan` ENABLE KEYS */;

-- Dumping structure for table pencucian-mobil.log_accessi
CREATE TABLE IF NOT EXISTS `log_accessi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL,
  `mail_immessa` varchar(50) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  `accesso` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- Dumping data for table pencucian-mobil.log_accessi: ~21 rows (approximately)
/*!40000 ALTER TABLE `log_accessi` DISABLE KEYS */;
INSERT INTO `log_accessi` (`id`, `ip`, `mail_immessa`, `data`, `accesso`) VALUES
  (37, '::1', 'herlianasorga@gmail.com', '2022-04-09 11:23:51', 1),
  (38, '::1', 'herlianasorga@gmail.com', '2022-04-09 12:43:04', 1),
  (39, '::1', 'herlianasorga@gmail.com', '2022-04-09 13:15:53', 1),
  (40, '::1', 'herlianasorga@gmail.com', '2022-04-10 12:55:40', 1),
  (41, '::1', 'herlianasorga@gmail.com', '2022-04-11 08:19:28', 1),
  (42, '::1', 'indrawanrhadi@gmail.com', '2022-04-11 09:23:55', 1),
  (43, '::1', 'indrawanrhadi@gmail.com', '2022-04-11 09:24:21', 0),
  (44, '::1', 'indrawanrhadi@gmail.com', '2022-04-11 09:24:32', 1),
  (45, '::1', 'indrawanrhadi@gmail.com', '2022-04-11 09:28:46', 0),
  (46, '::1', 'indrawanrhadi@gmail.com', '2022-04-11 09:28:51', 0),
  (47, '::1', 'herlianasorga@gmail.com', '2022-04-11 09:29:15', 1),
  (48, '::1', 'indrawanrhadi@gmail.com', '2022-04-11 09:30:12', 1),
  (49, '::1', 'indrawanrhadi@gmail.com', '2022-04-11 09:32:00', 1),
  (50, '::1', 'herlianasorga@gmail.com', '2022-04-11 11:37:21', 1),
  (51, '::1', 'indrawanrhadi@gmail.com', '2022-04-11 11:37:43', 0),
  (52, '::1', 'indrawanrhadi@gmail.com', '2022-04-11 11:37:49', 1),
  (53, '::1', 'herlianasorga@gmail.com', '2022-04-11 11:38:36', 1),
  (54, '::1', 'herlianasorga@gmail.com', '2022-04-11 12:40:44', 1),
  (55, '::1', 'herlianasorga@gmail.com', '2022-04-11 15:55:50', 1),
  (56, '::1', 'herlianasorga@gmail.com', '2022-04-11 16:15:02', 1),
  (57, '::1', 'herlianasorga@gmail.com', '2022-04-11 16:20:39', 1),
  (58, '::1', 'herlianasorga@gmail.com', '2022-04-14 09:01:15', 1),
  (59, '::1', 'herlianasorga@gmail.com', '2022-04-14 09:35:58', 1),
  (60, '::1', 'herlianasorga@gmail.com', '2022-04-15 09:27:50', 1),
  (61, '::1', 'herlianasorga@gmail.com', '2022-04-19 10:29:39', 1),
  (62, '::1', 'indrawanrhadi@gmail.com', '2022-04-19 10:34:58', 1),
  (63, '::1', 'admin@admin.com', '2022-06-13 13:26:31', 0),
  (64, '::1', 'herlianasorga@gmail.com', '2022-06-13 13:26:52', 1);
/*!40000 ALTER TABLE `log_accessi` ENABLE KEYS */;

-- Dumping structure for table pencucian-mobil.operator
CREATE TABLE IF NOT EXISTS `operator` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) DEFAULT NULL,
  `posisi` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pencucian-mobil.operator: ~0 rows (approximately)
/*!40000 ALTER TABLE `operator` DISABLE KEYS */;
INSERT INTO `operator` (`no`, `nama`, `posisi`) VALUES
  (1, 'rhadi', 'admin');
/*!40000 ALTER TABLE `operator` ENABLE KEYS */;

-- Dumping structure for table pencucian-mobil.paket
CREATE TABLE IF NOT EXISTS `paket` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `paket` varchar(100) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pencucian-mobil.paket: ~2 rows (approximately)
/*!40000 ALTER TABLE `paket` DISABLE KEYS */;
INSERT INTO `paket` (`no`, `paket`, `harga`) VALUES
  (1, 'Combo Ekstra Keju', 25000);
/*!40000 ALTER TABLE `paket` ENABLE KEYS */;

-- Dumping structure for table pencucian-mobil.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` varchar(150) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL,
  `paket` varchar(150) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `tipe_kendaraan` varchar(150) DEFAULT NULL,
  `no_plat` varchar(150) DEFAULT NULL,
  `operator` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pencucian-mobil.transaksi: ~8 rows (approximately)
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` (`id_transaksi`, `tanggal`, `nama`, `alamat`, `no_hp`, `paket`, `harga`, `tipe_kendaraan`, `no_plat`, `operator`) VALUES
  ('0001', '2022-04-11', 'Rhadi Indrawan', 'Jl. pongtiku I', '04593435', 'Combo Ekstra Keju', 25000, 'Roda 15', 'DD 1234 AS', 'lola'),
  ('0002', '2022-04-08', 'Tony Stark', 'wefw', '3452313', 'Combo Ekstra Keju', 25000, 'Roda 15', 'DD 1234 AS', 'lola'),
  ('0003', '2022-04-15', 'Hulk', 'wefew', '87908978', 'Combo Ekstra Keju', 25000, 'Roda 15', 'DD 1234 AS', 'lola'),
  ('0004', '2022-04-21', 'Thor', 'pongtiku', '54353234', 'Combo Ekstra Keju', 25000, 'Roda 15', 'DD 1234 AS', 'lola'),
  ('0005', '2022-04-04', 'spiderman', 'wefw', '231213', 'Combo Ekstra Keju', 25000, 'Roda 15', 'DD 1234 AS', 'lola'),
  ('0006', '2022-03-11', 'loki', 'wefw', '45643543', 'Combo Ekstra Keju', 25000, 'Roda 15', 'DD 1234 AS', 'lola'),
  ('0007', '2022-04-19', 'Amirul', 'perintis', '085255554789', 'Combo Ekstra Keju', 25000, 'Roda 15', 'DD 1234 AS', 'lola'),
  ('0008', '2022-04-14', 'Farhan', 'ablam', '08349332', 'Combo Ekstra Keju', 25000, 'Roda 15', 'DD 1234 AS', 'lola'),
  ('0009', '2022-04-19', 'Arman', 'perintis', '35893853', 'Combo Ekstra Keju', 25000, 'Roda 15', 'DD 1234 AS', 'Rhadi Indrawan');
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;

-- Dumping structure for table pencucian-mobil.utenti
CREATE TABLE IF NOT EXISTS `utenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `posisi` varchar(100) NOT NULL,
  `stato` int(11) NOT NULL,
  `reset_selector` varchar(100) NOT NULL,
  `reset_code` varchar(256) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table pencucian-mobil.utenti: ~2 rows (approximately)
/*!40000 ALTER TABLE `utenti` DISABLE KEYS */;
INSERT INTO `utenti` (`id`, `email`, `password`, `nama`, `posisi`, `stato`, `reset_selector`, `reset_code`, `data`, `last_update`) VALUES
  (1, 'herlianasorga@gmail.com', '$2y$12$PupDEG76G2/iiWDIiBEiJ.ftFnpT09IcnBRlqLVWNCP5q0lXPS6Qi', 'lola', 'admin', 0, '', '', '2022-04-09 11:22:41', '2022-04-11 08:56:17'),
  (5, 'indrawanrhadi@gmail.com', '$2y$12$7Uuo90Ydig519JebOsMuG.YN5/egyiAFufkOdXQvH9qJkYnZXaufm', 'Rhadi Indrawan', 'kasir', 0, '', '', '2022-04-11 09:03:28', '2022-04-11 11:37:31');
/*!40000 ALTER TABLE `utenti` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
