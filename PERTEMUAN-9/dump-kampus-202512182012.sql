/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.13-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: kampus
-- ------------------------------------------------------
-- Server version	10.11.13-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_dosen`
--

DROP TABLE IF EXISTS `tbl_dosen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_dosen` (
  `nidn` int(11) NOT NULL,
  `nama` varchar(120) DEFAULT NULL,
  `prodi` varchar(120) DEFAULT NULL,
  `email` char(50) DEFAULT NULL,
  PRIMARY KEY (`nidn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_dosen`
--

LOCK TABLES `tbl_dosen` WRITE;
/*!40000 ALTER TABLE `tbl_dosen` DISABLE KEYS */;
INSERT INTO `tbl_dosen` VALUES
(1001,'Dr. Budi Santoso','Teknik Informatika','budi@kampus.ac.id'),
(1002,'Siti Aminah, M.Kom','Sistem Informasi','siti@kampus.ac.id'),
(1003,'Rudi Hermawan, M.T','Teknik Informatika','rudi@kampus.ac.id'),
(1004,'Dewi Lestari, M.Si','Manajemen Informatika','dewi@kampus.ac.id'),
(1005,'Prof. Andi Wijaya','Teknik Komputer','andi@kampus.ac.id'),
(1006,'Rina Marlina, M.Kom','Sistem Informasi','rina@kampus.ac.id'),
(1007,'Eko Prasetyo, M.T','Teknik Informatika','eko@kampus.ac.id'),
(1008,'Fajar Nugraha, M.Cs','Teknik Informatika','fajar@kampus.ac.id'),
(1009,'Hendra Gunawan, M.Kom','Manajemen Informatika','hendra@kampus.ac.id'),
(1010,'Maya Putri, M.T','Teknik Komputer','maya@kampus.ac.id'),
(1022,'Dr. Eng. Reza Asriano Maulana, S.Kom., S.T., M.Kom., ','Sistem Informasi','reza@kampus.ac.id');
/*!40000 ALTER TABLE `tbl_dosen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mahasiswa`
--

DROP TABLE IF EXISTS `tbl_mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_mahasiswa` (
  `nim` int(11) NOT NULL,
  `nama` varchar(120) DEFAULT NULL,
  `prodi` varchar(120) DEFAULT NULL,
  `angkatan` int(11) DEFAULT NULL,
  `email` char(50) DEFAULT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mahasiswa`
--

LOCK TABLES `tbl_mahasiswa` WRITE;
/*!40000 ALTER TABLE `tbl_mahasiswa` DISABLE KEYS */;
INSERT INTO `tbl_mahasiswa` VALUES
(2022001,'Gilang Dirga','Teknik Informatika',2022,'gilang@mhs.ac.id'),
(2022002,'Hesti Purwadinata','Teknik Informatika',2022,'hesti@mhs.ac.id'),
(2022003,'Indra Bekti','Manajemen Informatika',2022,'indra@mhs.ac.id'),
(2022004,'Joko Anwar','Teknik Komputer',2022,'joko@mhs.ac.id'),
(2023001,'Ahmad Fauzi','Teknik Informatika',2023,'ahmad@mhs.ac.id'),
(2023002,'Bunga Citra','Sistem Informasi',2023,'bunga@mhs.ac.id'),
(2023003,'Candra Wijaya','Teknik Informatika',2023,'candra@mhs.ac.id'),
(2023004,'Dinda Kirana','Manajemen Informatika',2023,'dinda@mhs.ac.id'),
(2023005,'Erik Saputra','Teknik Komputer',2023,'erik@mhs.ac.id'),
(2023006,'Reza Asriano','Teknik Informatika',2023,'reza@mhs.ac.id');
/*!40000 ALTER TABLE `tbl_mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_matkul`
--

DROP TABLE IF EXISTS `tbl_matkul`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_matkul` (
  `kodeMatkul` varchar(10) NOT NULL,
  `namaMatkul` varchar(120) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL,
  `nidn` int(11) DEFAULT NULL,
  PRIMARY KEY (`kodeMatkul`),
  KEY `nidn` (`nidn`),
  CONSTRAINT `tbl_matkul_ibfk_1` FOREIGN KEY (`nidn`) REFERENCES `tbl_dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_matkul`
--

LOCK TABLES `tbl_matkul` WRITE;
/*!40000 ALTER TABLE `tbl_matkul` DISABLE KEYS */;
INSERT INTO `tbl_matkul` VALUES
('MK001','Pemrograman Dasar',3,1001),
('MK002','Basis Data',3,1002),
('MK003','Algoritma',3,1003),
('MK004','Jaringan Komputer',3,1005),
('MK005','Sistem Operasi',2,1007),
('MK006','Pemrograman Web',3,1008),
('MK007','Kecerdasan Buatan',3,1001),
('MK008','Analisis Sistem',3,1006),
('MK009','Etika Profesi',2,1004),
('MK010','Keamanan Jaringan',3,1010),
('MK020','Pemrograman PHP',6,1022);
/*!40000 ALTER TABLE `tbl_matkul` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nilai`
--

DROP TABLE IF EXISTS `tbl_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `nilai` double DEFAULT NULL,
  `nilaiHuruf` char(1) DEFAULT NULL,
  `kodeMatkul` varchar(10) DEFAULT NULL,
  `nim` int(11) DEFAULT NULL,
  `nidn` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `kodeMatkul` (`kodeMatkul`),
  KEY `nim` (`nim`),
  KEY `nidn` (`nidn`),
  CONSTRAINT `tbl_nilai_ibfk_1` FOREIGN KEY (`kodeMatkul`) REFERENCES `tbl_matkul` (`kodeMatkul`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_nilai_ibfk_2` FOREIGN KEY (`nim`) REFERENCES `tbl_mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_nilai_ibfk_3` FOREIGN KEY (`nidn`) REFERENCES `tbl_dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nilai`
--

LOCK TABLES `tbl_nilai` WRITE;
/*!40000 ALTER TABLE `tbl_nilai` DISABLE KEYS */;
INSERT INTO `tbl_nilai` VALUES
(1,85.5,'A','MK001',2023001,1001),
(2,78,'B','MK002',2023002,1002),
(4,65,'C','MK004',2023005,1005),
(5,88,'A','MK006',2023001,1008),
(6,72.5,'B','MK005',2022001,1007),
(7,95,'A','MK001',2023003,1001),
(8,60,'C','MK008',2023006,1006),
(9,82,'A','MK010',2022004,1010),
(10,79,'B','MK002',2023004,1002),
(13,88,'A','MK009',2023001,1004);
/*!40000 ALTER TABLE `tbl_nilai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_user_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES
(1,'1011','dosen123','dosen'),
(2,'2024021','mhs123','mahasiswa');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'kampus'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-18 20:12:16
