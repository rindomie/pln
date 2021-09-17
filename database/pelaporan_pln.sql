/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.4.8-MariaDB : Database - pelaporan_pln
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pelaporan_pln` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `pelaporan_pln`;

/*Table structure for table `department` */

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `iddept` int(11) NOT NULL AUTO_INCREMENT,
  `namadept` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`iddept`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `department` */

insert  into `department`(`iddept`,`namadept`) values 
(1,'Jaringan'),
(2,'Listrik'),
(3,'Humas');

/*Table structure for table `masyarakat` */

DROP TABLE IF EXISTS `masyarakat`;

CREATE TABLE `masyarakat` (
  `nik` bigint(16) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(225) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `foto_profile` varchar(225) NOT NULL,
  PRIMARY KEY (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `masyarakat` */

insert  into `masyarakat`(`nik`,`nama`,`username`,`password`,`telp`,`foto_profile`) values 
(123,'robbi','masyarakat','$2y$10$BqCVWU56ME/Y.MctVXBw7uI8w26d1gK/HY219JiQWe./ppfYVEeYS','123','user.png');

/*Table structure for table `petugas` */

DROP TABLE IF EXISTS `petugas`;

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_petugas` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(225) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `level` enum('admin','petugas') NOT NULL,
  `foto_profile` varchar(225) NOT NULL,
  PRIMARY KEY (`id_petugas`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `petugas` */

insert  into `petugas`(`id_petugas`,`nama_petugas`,`username`,`password`,`telp`,`level`,`foto_profile`) values 
(2,'abdul','admin','$2y$10$YlpZmz2Uq.RxG5bHvMjYjej5y2AYkEzr9JbDKGHe3sWbpFkVhkury','123','admin','user.png'),
(6,'petugas','petugas','$2y$10$SIUNsTMGwDOoXJ62kgoMueorXuuDenxdG0ZKRU1NUigM2Xby0bAmC','123456','petugas','user.png');

/*Table structure for table `subunit` */

DROP TABLE IF EXISTS `subunit`;

CREATE TABLE `subunit` (
  `idsub` int(11) NOT NULL AUTO_INCREMENT,
  `idunit` int(11) DEFAULT NULL,
  `namasub` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idsub`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `subunit` */

insert  into `subunit`(`idsub`,`idunit`,`namasub`) values 
(1,1,'PLN Kasongan'),
(2,2,'PLN Banjarbaru'),
(3,2,'PLN Banjarmasin'),
(4,3,'PLN Samarinda'),
(5,1,'PLN Palangkaraya');

/*Table structure for table `tanggapan` */

DROP TABLE IF EXISTS `tanggapan`;

CREATE TABLE `tanggapan` (
  `id_tanggapan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengaduan` bigint(16) NOT NULL,
  `tgl_tanggapan` date NOT NULL,
  `tanggapan` text NOT NULL,
  `id_petugas` int(11) NOT NULL,
  PRIMARY KEY (`id_tanggapan`),
  KEY `id_pengaduan` (`id_pengaduan`),
  KEY `id_petugas` (`id_petugas`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `tanggapan` */

/*Table structure for table `temuan` */

DROP TABLE IF EXISTS `temuan`;

CREATE TABLE `temuan` (
  `idtemuan` bigint(16) NOT NULL AUTO_INCREMENT,
  `idpenemu` int(11) DEFAULT NULL,
  `tgltemuan` date DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `ststemuan` varchar(255) DEFAULT NULL,
  `tipetemuan` varchar(255) DEFAULT NULL,
  `tanggapan` text DEFAULT NULL,
  `pjdept` varchar(255) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `idmoderator` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idtemuan`),
  KEY `nik` (`tgltemuan`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `temuan` */

insert  into `temuan`(`idtemuan`,`idpenemu`,`tgltemuan`,`title`,`keterangan`,`lokasi`,`ststemuan`,`tipetemuan`,`tanggapan`,`pjdept`,`deadline`,`idmoderator`,`foto`) values 
(9,4,'2021-09-13','Kabel Putus','Ditemukan kabel putus dengan aliran listrik masih hidup','Jalan Karang Anyar 1','diproses','Unsafe Condition',NULL,NULL,NULL,NULL,'kabel putus.jpg'),
(12,4,'2021-09-13','Tiang Rubuh','Tiang listrik rubuh karena hujan','Jalan Permata 123','disetujui','Unsafe Condition','OTW','Jaringan','2021-09-13',2,'tiangrubuh.jpeg'),
(13,3,'2021-09-13','Tiang Rubuh','Tiang listrik rubuh karena hujan','Jalan Permata 123','selesai','Unsafe Condition',NULL,NULL,NULL,2,'tiangrubuh.jpeg'),
(14,4,'2021-09-13','Kabel Putus','Ditemukan kabel putus dengan aliran listrik masih hidup','Jalan Karang Anyar 1','ditolak','Unsafe Condition','Hoax',NULL,NULL,2,'kabel putus.jpg'),
(15,4,'2021-09-13','Mayat di tiang','Ada mayat digantung','banjarbaru','diproses','Accident',NULL,NULL,NULL,NULL,'pekerjagantung1.jpg'),
(16,4,'2021-09-13','Mayat ditemukan','mayat di tiang listrik','banjarbaru','diproses','Unsafe Act',NULL,NULL,NULL,NULL,'pekerjagantung2.jpg'),
(17,4,'2021-09-16','adadada','dadadadadadaadad','dadadadadada','diproses','Unsafe Act',NULL,NULL,NULL,NULL,'alat-berat-excavator.jpg'),
(18,3,'2021-09-16','sadsdDdD','addasdva ada a d','SDASDADADAWDfsa','disetujui','Unsafe Act','disetujui','Jaringan','2021-09-30',2,'jenis-jenis-alat-berat.jpg'),
(19,4,'2021-09-13','Kabel Putus','Ditemukan kabel putus dengan aliran listrik masih hidup','Jalan Karang Anyar 1','diproses','Unsafe Condition',NULL,NULL,NULL,NULL,'kabel putus.jpg'),
(20,3,'2021-09-16','sadsdDdD','addasdva ada a d','SDASDADADAWDfsa','ditolak','Unsafe Act','hoax',NULL,NULL,2,'jenis-jenis-alat-berat.jpg');

/*Table structure for table `unit` */

DROP TABLE IF EXISTS `unit`;

CREATE TABLE `unit` (
  `idunit` int(11) NOT NULL AUTO_INCREMENT,
  `namaunit` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idunit`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `unit` */

insert  into `unit`(`idunit`,`namaunit`,`alamat`) values 
(1,'Kanwil Kalteng','Kalteng'),
(2,'Kanwil Kalsel','Kalsel'),
(3,'Kanwil Kaltim','Kaltim');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(24) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `subunit` int(11) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `level` int(1) DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`iduser`,`nik`,`password`,`nama`,`unit`,`subunit`,`department`,`status`,`foto`,`level`) values 
(1,'admin','$2y$10$FOQUpskmgRT9Y37aq5ldxOmJCuP3PjVFZSgu4kGWW.u4iRLqmH9wS','Admin',NULL,NULL,NULL,1,'logo_new.png',1),
(2,'12345','$2y$10$YlpZmz2Uq.RxG5bHvMjYjej5y2AYkEzr9JbDKGHe3sWbpFkVhkury','Somad',1,NULL,NULL,1,'logo_new.png',2),
(3,'54321','$2y$10$YlpZmz2Uq.RxG5bHvMjYjej5y2AYkEzr9JbDKGHe3sWbpFkVhkury','Ahmad',1,NULL,NULL,0,'logo_new.png',3),
(4,'1231123','$2y$10$ryz5GqNAYtmPwHYhW1Sug.py4TekzJxvi0/SFU9TjsgSJKtHQdD92','wwqwqeqq',2,NULL,NULL,NULL,'Logo_ULM_Baru.png',3),
(5,'1234567','$2y$10$wllp.SHd4uJdNDO5phwFxOGz.pWWqYdp6vsKJNmrla/iuvuo.eZvC','Abdul',2,NULL,NULL,NULL,'logo_new.png',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
