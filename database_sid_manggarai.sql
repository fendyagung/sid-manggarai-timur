-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sid_manggarai_timur
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `arsips`
--

DROP TABLE IF EXISTS `arsips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arsips` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `judul` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `arsips_user_id_foreign` (`user_id`),
  CONSTRAINT `arsips_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arsips`
--

LOCK TABLES `arsips` WRITE;
/*!40000 ALTER TABLE `arsips` DISABLE KEYS */;
/*!40000 ALTER TABLE `arsips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `beritas`
--

DROP TABLE IF EXISTS `beritas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beritas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `isi` longtext NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) NOT NULL DEFAULT 'Kegiatan',
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `beritas_slug_unique` (`slug`),
  KEY `beritas_user_id_foreign` (`user_id`),
  CONSTRAINT `beritas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beritas`
--

LOCK TABLES `beritas` WRITE;
/*!40000 ALTER TABLE `beritas` DISABLE KEYS */;
INSERT INTO `beritas` VALUES (3,349,'Geliat Ekonomi Kreatif Pelatihan Tenun Ikat di Desa Ngampang Mas','geliat-ekonomi-kreatif-pelatihan-tenun-ikat-di-desa-ngampang-mas-69d3558639b12','Pemerintah Desa hari ini mengadakan pelatihan tenun ikat bagi kelompok ibu-ibu PKK. Kegiatan ini bertujuan untuk meningkatkan keterampilan warga sekaligus melestarikan bu-daya lokal Manggarai Timur. Pelatihan ini diikuti oleh 20 peserta dan dipandu oleh nara-sumber ahli dari Borong. Diharapkan hasil tenun ini nantinya bisa menjadi produk unggulan desa.','berita/nDHYMrJX7IPA3ZLaNAC6emMstqPhcNTrV1NJO04z.jpg','kegiatan',1,'2026-04-06 06:41:10','2026-04-06 06:41:10'),(4,349,'DPMD Kab. Manggarai Timur Gelar Pelatihan Digitalisasi Laporan Desa','dpmd-kab-manggarai-timur-gelar-pelatihan-digitalisasi-laporan-desa-69d3560dc48a6','Hari ini, Dinas PMD Kabupaten Manggarai Timur resmi meluncurkan sistem pelaporan dig-ital terbaru. Pelatihan ini diikuti oleh perwakilan Aparat Pemerintah Desa guna memper-cepat proses pengiriman data dan transparansi anggaran.','berita/5JOJU3OZGvZWCXPoAmKljmTao0DSuwqDSGTT4IIu.jpg','kegiatan',1,'2026-04-06 06:43:25','2026-04-06 06:43:25'),(5,349,'Peringatan Keterlambatan Laporan Bulanan Maret - Desa Ngampang Mas.','peringatan-keterlambatan-laporan-bulanan-maret-desa-ngampang-mas-69d35b1bb2b4e','Laporan ini mencakup penggunaan Dana Desa bulan Januari - Maret 2026, termasuk pem-bangunan drainase di Dusun Lorong Koe dan bantuan bibit jagung untuk kelompok tani.','berita/3JJVDdY7cUHZ1szYkspupBB5Yu1DM5PZj0hcZTLO.jpg','kegiatan',1,'2026-04-06 07:04:59','2026-04-06 07:04:59'),(6,349,'Percepatan Penyaluran Dana Desa & Evaluasi Laporan Feb 2026 - Kec. Borong','percepatan-penyaluran-dana-desa-evaluasi-laporan-feb-2026-kec-borong-69d3632dce20f','saya jAHIIAJJSKNKBJDBJBDB','berita/u06uZssVspuDjtfH5wxJmxZKldMaoWgPQmqyvt2L.jpg','kegiatan',1,'2026-04-06 07:39:25','2026-04-06 07:39:25');
/*!40000 ALTER TABLE `beritas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `desa_galleries`
--

DROP TABLE IF EXISTS `desa_galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `desa_galleries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `desa_id` bigint(20) unsigned NOT NULL,
  `type` enum('foto','video') NOT NULL,
  `url_or_path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `desa_galleries_desa_id_foreign` (`desa_id`),
  CONSTRAINT `desa_galleries_desa_id_foreign` FOREIGN KEY (`desa_id`) REFERENCES `desas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `desa_galleries`
--

LOCK TABLES `desa_galleries` WRITE;
/*!40000 ALTER TABLE `desa_galleries` DISABLE KEYS */;
/*!40000 ALTER TABLE `desa_galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `desas`
--

DROP TABLE IF EXISTS `desas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `desas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_desa` varchar(255) NOT NULL,
  `jenis` enum('desa','kelurahan') NOT NULL DEFAULT 'desa',
  `kode_desa` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kepala_desa` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `video_youtube` varchar(255) DEFAULT NULL,
  `jumlah_penduduk` int(11) DEFAULT NULL,
  `jumlah_kk` int(11) DEFAULT NULL,
  `luas_wilayah` varchar(255) DEFAULT NULL,
  `deskripsi_batas` text DEFAULT NULL,
  `potensi_ekonomi` text DEFAULT NULL,
  `lokasi_maps` varchar(255) DEFAULT NULL,
  `is_desa_wisata` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `desas_kode_desa_unique` (`kode_desa`),
  KEY `desas_user_id_foreign` (`user_id`),
  CONSTRAINT `desas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=217 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `desas`
--

LOCK TABLES `desas` WRITE;
/*!40000 ALTER TABLE `desas` DISABLE KEYS */;
INSERT INTO `desas` VALUES (1,'Balus Permai','desa',NULL,'Borong',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,362,'2026-03-30 12:10:52','2026-03-30 12:10:52'),(2,'Bangka Kantar','desa',NULL,'Borong',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,363,'2026-03-30 12:10:52','2026-03-30 12:10:52'),(3,'Benteng Raja','desa',NULL,'Borong',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,364,'2026-03-30 12:10:52','2026-03-30 12:10:52'),(4,'Benteng Riwu','desa',NULL,'Borong',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,365,'2026-03-30 12:10:52','2026-03-30 12:10:52'),(5,'Compang Ndejing','desa',NULL,'Borong',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,366,'2026-03-30 12:10:53','2026-03-30 12:10:53'),(6,'Compang Tenda','desa',NULL,'Borong',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,367,'2026-03-30 12:10:53','2026-03-30 12:10:53'),(7,'Golo Kantar','desa',NULL,'Borong',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,368,'2026-03-30 12:10:53','2026-03-30 12:10:53'),(8,'Golo Lalong','desa',NULL,'Borong',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,369,'2026-03-30 12:10:53','2026-03-30 12:10:53'),(9,'Golo Leda','desa',NULL,'Borong',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,370,'2026-03-30 12:10:54','2026-03-30 12:10:54'),(10,'Gurung Liwut','desa',NULL,'Borong',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,371,'2026-03-30 12:10:54','2026-03-30 12:10:54'),(11,'Nanga Labang','desa',NULL,'Borong',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,372,'2026-03-30 12:10:54','2026-03-30 12:10:54'),(12,'Ngampang Mas','desa',NULL,'Borong','Philipus Ganda Waja',NULL,'desa-profil/Efs3hWTpwK8Fw5JLj9og7tBKcLruiKHzCUB5G0DV.jpg',NULL,1500,150,'12.5 km',NULL,NULL,NULL,0,373,'2026-03-30 12:10:54','2026-03-30 12:10:54'),(13,'Poco Rii','desa',NULL,'Borong',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,374,'2026-03-30 12:10:54','2026-03-30 12:10:54'),(14,'Rana Masak','desa',NULL,'Borong',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,375,'2026-03-30 12:10:55','2026-03-30 12:10:55'),(15,'Waling','desa',NULL,'Borong',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,376,'2026-03-30 12:10:55','2026-03-30 12:10:55'),(16,'Bangka Kuleng','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,377,'2026-03-30 12:10:55','2026-03-30 12:10:55'),(17,'Bangka Pau','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,378,'2026-03-30 12:10:55','2026-03-30 12:10:55'),(18,'Bea Waek','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,379,'2026-03-30 12:10:56','2026-03-30 12:10:56'),(19,'Compang Laho','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,380,'2026-03-30 12:10:56','2026-03-30 12:10:56'),(20,'Compang Wesang','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,381,'2026-03-30 12:10:56','2026-03-30 12:10:56'),(21,'Compang Weluk','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,382,'2026-03-30 12:10:56','2026-03-30 12:10:56'),(22,'Deno','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,383,'2026-03-30 12:10:57','2026-03-30 12:10:57'),(23,'Golo Lobos','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,384,'2026-03-30 12:10:57','2026-03-30 12:10:57'),(24,'Golo Ndari','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,385,'2026-03-30 12:10:57','2026-03-30 12:10:57'),(26,'Golo Rengket','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,387,'2026-03-30 12:10:57','2026-03-30 12:10:57'),(27,'Golo Wune','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,388,'2026-03-30 12:10:58','2026-03-30 12:10:58'),(28,'Gurung Turi','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,389,'2026-03-30 12:10:58','2026-03-30 12:10:58'),(29,'Lenang','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,390,'2026-03-30 12:10:58','2026-03-30 12:10:58'),(30,'Lento','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,391,'2026-03-30 12:10:58','2026-03-30 12:10:58'),(31,'Leong','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,392,'2026-03-30 12:10:59','2026-03-30 12:10:59'),(32,'Melo','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,393,'2026-03-30 12:10:59','2026-03-30 12:10:59'),(33,'Poco Lia','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,394,'2026-03-30 12:10:59','2026-03-30 12:10:59'),(34,'Pocong','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,395,'2026-03-30 12:10:59','2026-03-30 12:10:59'),(35,'Satar Tesem','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,396,'2026-03-30 12:10:59','2026-03-30 12:10:59'),(36,'Watu Lanur','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,397,'2026-03-30 12:11:00','2026-03-30 12:11:00'),(37,'Compang Deru','desa',NULL,'Lamba Leda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,398,'2026-03-30 12:11:00','2026-03-30 12:11:00'),(38,'Compang Mekar','desa',NULL,'Lamba Leda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,399,'2026-03-30 12:11:00','2026-03-30 12:11:00'),(39,'Compang Necak','desa',NULL,'Lamba Leda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,400,'2026-03-30 12:11:00','2026-03-30 12:11:00'),(40,'Goreng Meni','desa',NULL,'Lamba Leda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,401,'2026-03-30 12:11:01','2026-03-30 12:11:01'),(41,'Goreng Meni Utara','desa',NULL,'Lamba Leda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,402,'2026-03-30 12:11:01','2026-03-30 12:11:01'),(42,'Golo Lembur','desa',NULL,'Lamba Leda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,403,'2026-03-30 12:11:01','2026-03-30 12:11:01'),(43,'Golo Munga','desa',NULL,'Lamba Leda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,404,'2026-03-30 12:11:01','2026-03-30 12:11:01'),(44,'Golo Nimbung','desa',NULL,'Lamba Leda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,405,'2026-03-30 12:11:02','2026-03-30 12:11:02'),(45,'Golo Paleng','desa',NULL,'Lamba Leda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,406,'2026-03-30 12:11:02','2026-03-30 12:11:02'),(46,'Golo Rentung','desa',NULL,'Lamba Leda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,407,'2026-03-30 12:11:02','2026-03-30 12:11:02'),(47,'Lamba Keli','desa',NULL,'Lamba Leda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,408,'2026-03-30 12:11:02','2026-03-30 12:11:02'),(48,'Tengku Lawar','desa',NULL,'Lamba Leda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,409,'2026-03-30 12:11:02','2026-03-30 12:11:02'),(49,'Tengku Leda','desa',NULL,'Lamba Leda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,410,'2026-03-30 12:11:03','2026-03-30 12:11:03'),(50,'Golo Mangung','desa',NULL,'Lamba Leda Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,411,'2026-03-30 12:11:03','2026-03-30 12:11:03'),(51,'Golo Munga Barat','desa',NULL,'Lamba Leda Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,412,'2026-03-30 12:11:03','2026-03-30 12:11:03'),(52,'Golo Wontong','desa',NULL,'Lamba Leda Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,413,'2026-03-30 12:11:03','2026-03-30 12:11:03'),(53,'Haju Wangi','desa',NULL,'Lamba Leda Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,414,'2026-03-30 12:11:04','2026-03-30 12:11:04'),(54,'Lencur','desa',NULL,'Lamba Leda Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,415,'2026-03-30 12:11:04','2026-03-30 12:11:04'),(55,'Liang Deruk','desa',NULL,'Lamba Leda Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,416,'2026-03-30 12:11:04','2026-03-30 12:11:04'),(56,'Nampar Tabang','desa',NULL,'Lamba Leda Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,417,'2026-03-30 12:11:04','2026-03-30 12:11:04'),(57,'Satar Kampas','desa',NULL,'Lamba Leda Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,418,'2026-03-30 12:11:04','2026-03-30 12:11:04'),(58,'Satar Padut','desa',NULL,'Lamba Leda Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,419,'2026-03-30 12:11:05','2026-03-30 12:11:05'),(59,'Satar Punda','desa',NULL,'Lamba Leda Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,420,'2026-03-30 12:11:05','2026-03-30 12:11:05'),(60,'Satar Punda Barat','desa',NULL,'Lamba Leda Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,421,'2026-03-30 12:11:05','2026-03-30 12:11:05'),(61,'Kembang Mekar','desa',NULL,'Sambi Rampas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,422,'2026-03-30 12:11:05','2026-03-30 12:11:05'),(62,'Lada Mese','desa',NULL,'Sambi Rampas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,423,'2026-03-30 12:11:06','2026-03-30 12:11:06'),(63,'Nampar Sepang','desa',NULL,'Sambi Rampas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,424,'2026-03-30 12:11:06','2026-03-30 12:11:06'),(64,'Nanga Mbaling','desa',NULL,'Sambi Rampas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,425,'2026-03-30 12:11:06','2026-03-30 12:11:06'),(65,'Nanga Mbaur','desa',NULL,'Sambi Rampas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,426,'2026-03-30 12:11:06','2026-03-30 12:11:06'),(66,'Wela Lada','desa',NULL,'Sambi Rampas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,427,'2026-03-30 12:11:07','2026-03-30 12:11:07'),(67,'Buti','desa',NULL,'Congkar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,428,'2026-03-30 12:11:07','2026-03-30 12:11:07'),(68,'Golo Ngawan','desa',NULL,'Congkar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,429,'2026-03-30 12:11:07','2026-03-30 12:11:07'),(69,'Satar Nawang','desa',NULL,'Congkar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,430,'2026-03-30 12:11:07','2026-03-30 12:11:07'),(70,'Rana Mese','desa',NULL,'Congkar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,431,'2026-03-30 12:11:08','2026-03-30 12:11:08'),(71,'Compang Congkar','desa',NULL,'Congkar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,432,'2026-03-30 12:11:08','2026-03-30 12:11:08'),(72,'Compang Lawi','desa',NULL,'Congkar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,433,'2026-03-30 12:11:08','2026-03-30 12:11:08'),(73,'Golo Pari','desa',NULL,'Congkar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,434,'2026-03-30 12:11:08','2026-03-30 12:11:08'),(74,'Wea','desa',NULL,'Congkar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,435,'2026-03-30 12:11:08','2026-03-30 12:11:08'),(75,'Biting','desa',NULL,'Elar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,436,'2026-03-30 12:11:09','2026-03-30 12:11:09'),(76,'Compang Soba','desa',NULL,'Elar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,437,'2026-03-30 12:11:09','2026-03-30 12:11:09'),(77,'Compang Teo','desa',NULL,'Elar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,438,'2026-03-30 12:11:09','2026-03-30 12:11:09'),(78,'Golo Lebo','desa',NULL,'Elar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,439,'2026-03-30 12:11:09','2026-03-30 12:11:09'),(79,'Golo Lijun','desa',NULL,'Elar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,440,'2026-03-30 12:11:10','2026-03-30 12:11:10'),(80,'Golo Munde','desa',NULL,'Elar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,441,'2026-03-30 12:11:10','2026-03-30 12:11:10'),(81,'Haju Ngendong','desa',NULL,'Elar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,442,'2026-03-30 12:11:10','2026-03-30 12:11:10'),(82,'Kaju Wangi','desa',NULL,'Elar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,443,'2026-03-30 12:11:10','2026-03-30 12:11:10'),(83,'Legur Lai','desa',NULL,'Elar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,444,'2026-03-30 12:11:11','2026-03-30 12:11:11'),(84,'Lengko Namut','desa',NULL,'Elar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,445,'2026-03-30 12:11:11','2026-03-30 12:11:11'),(85,'Rana Gapang','desa',NULL,'Elar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,446,'2026-03-30 12:11:11','2026-03-30 12:11:11'),(86,'Rana Kulan','desa',NULL,'Elar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,447,'2026-03-30 12:11:11','2026-03-30 12:11:11'),(87,'Sisir','desa',NULL,'Elar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,448,'2026-03-30 12:11:11','2026-03-30 12:11:11'),(88,'Wae Lokom','desa',NULL,'Elar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,449,'2026-03-30 12:11:12','2026-03-30 12:11:12'),(90,'Golo Meni','desa',NULL,'Kota Komba Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-15 04:50:11','2026-03-30 08:58:34'),(91,'Golo Ndele','desa',NULL,'Kota Komba Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-15 04:50:12','2026-03-30 08:58:34'),(93,'Golo Tolang','desa',NULL,'Kota Komba Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-15 04:50:12','2026-03-30 08:58:34'),(95,'Gunung Baru','desa',NULL,'Kota Komba Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-15 04:50:13','2026-03-30 08:59:34'),(99,'Mokel','desa',NULL,'Kota Komba Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-15 04:50:14','2026-03-30 08:58:34'),(100,'Mokel Morid','desa',NULL,'Kota Komba Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-15 04:50:14','2026-03-30 08:58:34'),(101,'Paan Leleng','desa',NULL,'Kota Komba Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-15 04:50:14','2026-03-30 09:19:06'),(105,'Rana Mbeling','desa',NULL,'Kota Komba Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-15 04:50:16','2026-03-30 09:19:06'),(106,'Rana Mbata','desa',NULL,'Kota Komba Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-15 04:50:16','2026-03-30 09:19:06'),(108,'Bangka Kempo','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,469,'2026-03-30 12:11:16','2026-03-30 12:11:16'),(109,'Bangka Masa','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,470,'2026-03-30 12:11:17','2026-03-30 12:11:17'),(110,'Bea Ngencung','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,471,'2026-03-30 12:11:18','2026-03-30 12:11:18'),(111,'Compang Kantar','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,472,'2026-03-30 12:11:19','2026-03-30 12:11:19'),(112,'Compang Kempo','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,473,'2026-03-30 12:11:20','2026-03-30 12:11:20'),(113,'Compang Loni','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,474,'2026-03-30 12:11:20','2026-03-30 12:11:20'),(114,'Compang Teber','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,475,'2026-03-30 12:11:21','2026-03-30 12:11:21'),(115,'Golo Loni','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,476,'2026-03-30 12:11:22','2026-03-30 12:11:22'),(116,'Golo Meleng','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,477,'2026-03-30 12:11:23','2026-03-30 12:11:23'),(117,'Golo Ros','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,478,'2026-03-30 12:11:23','2026-03-30 12:11:23'),(118,'Golo Rutuk','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,479,'2026-03-30 12:11:24','2026-03-30 12:11:24'),(119,'Lalang','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,480,'2026-03-30 12:11:25','2026-03-30 12:11:25'),(120,'Lidi','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,481,'2026-03-30 12:11:26','2026-03-30 12:11:26'),(121,'Rondo Woing','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,482,'2026-03-30 12:11:26','2026-03-30 12:11:26'),(122,'Sano Lokom','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,483,'2026-03-30 12:11:27','2026-03-30 12:11:27'),(123,'Satar Lahing','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,484,'2026-03-30 12:11:28','2026-03-30 12:11:28'),(124,'Satar Lenda','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,485,'2026-03-30 12:11:29','2026-03-30 12:11:29'),(125,'Sita','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,486,'2026-03-30 12:11:29','2026-03-30 12:11:29'),(126,'Torok Golo','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,487,'2026-03-30 12:11:30','2026-03-30 12:11:30'),(127,'Wae Nggori','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,488,'2026-03-30 12:11:31','2026-03-30 12:11:31'),(128,'Watu Mori','desa',NULL,'Rana Mese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,489,'2026-03-30 12:11:33','2026-03-30 12:11:33'),(129,'Arus','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,490,'2026-03-30 12:11:33','2026-03-30 12:11:33'),(130,'Bangka Arus','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,491,'2026-03-30 12:11:34','2026-03-30 12:11:34'),(131,'Benteng Rampas','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,492,'2026-03-30 12:11:35','2026-03-30 12:11:35'),(132,'Benteng Wunis','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,493,'2026-03-30 12:11:36','2026-03-30 12:11:36'),(133,'Colol','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,494,'2026-03-30 12:11:37','2026-03-30 12:11:37'),(134,'Compang Raci','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,495,'2026-03-30 12:11:38','2026-03-30 12:11:38'),(135,'Compang Wunis','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,496,'2026-03-30 12:11:39','2026-03-30 12:11:39'),(136,'Golo Lero','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,497,'2026-03-30 12:11:40','2026-03-30 12:11:40'),(137,'Ngkiong Dora','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,498,'2026-03-30 12:11:41','2026-03-30 12:11:41'),(138,'Rende Nao','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,499,'2026-03-30 12:11:41','2026-03-30 12:11:41'),(139,'Rengkam','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,500,'2026-03-30 12:11:42','2026-03-30 12:11:42'),(140,'Tango Molas','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,501,'2026-03-30 12:11:43','2026-03-30 12:11:43'),(141,'Ulu Wae','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,502,'2026-03-30 12:11:44','2026-03-30 12:11:44'),(142,'Urung Dora','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,503,'2026-03-30 12:11:45','2026-03-30 12:11:45'),(143,'Wangkar Weli','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,504,'2026-03-30 12:11:46','2026-03-30 12:11:46'),(144,'Watu Arus','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,505,'2026-03-30 12:11:47','2026-03-30 12:11:47'),(145,'Wejang Mali','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,506,'2026-03-30 12:11:47','2026-03-30 12:11:47'),(146,'Wejang Mawe','desa',NULL,'Lamba Leda Timur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,507,'2026-03-30 12:11:48','2026-03-30 12:11:48'),(147,'Benteng Pau','desa',NULL,'Elar Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,508,'2026-03-30 12:11:49','2026-03-30 12:11:49'),(148,'Gising','desa',NULL,'Elar Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,509,'2026-03-30 12:11:50','2026-03-30 12:11:50'),(149,'Golo Linus','desa',NULL,'Elar Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,510,'2026-03-30 12:11:51','2026-03-30 12:11:51'),(150,'Golo Wuas','desa',NULL,'Elar Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,511,'2026-03-30 12:11:51','2026-03-30 12:11:51'),(151,'Langga Sai','desa',NULL,'Elar Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,512,'2026-03-30 12:11:52','2026-03-30 12:11:52'),(152,'Mosi Ngaran','desa',NULL,'Elar Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,513,'2026-03-30 12:11:53','2026-03-30 12:11:53'),(153,'Nanga Meje','desa',NULL,'Elar Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,514,'2026-03-30 12:11:53','2026-03-30 12:11:53'),(154,'Nanga Puun','desa',NULL,'Elar Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,515,'2026-03-30 12:11:54','2026-03-30 12:11:54'),(155,'Paan Waru','desa',NULL,'Elar Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,516,'2026-03-30 12:11:55','2026-03-30 12:11:55'),(156,'Sangan Kalo','desa',NULL,'Elar Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,517,'2026-03-30 12:11:56','2026-03-30 12:11:56'),(157,'Sipi','desa',NULL,'Elar Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,518,'2026-03-30 12:11:57','2026-03-30 12:11:57'),(158,'Teno Mese','desa',NULL,'Elar Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,519,'2026-03-30 12:11:57','2026-03-30 12:11:57'),(159,'Wae Rasan','desa',NULL,'Elar Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,520,'2026-03-30 12:11:58','2026-03-30 12:11:58'),(160,'Rana Loba','kelurahan',NULL,'Borong',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-17 09:21:22','2026-03-30 09:31:02'),(161,'Kota Ndora','kelurahan',NULL,'Borong',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-17 09:21:22','2026-03-30 09:31:02'),(162,'Satar Peot','kelurahan',NULL,'Borong',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-17 09:21:22','2026-03-30 09:31:02'),(163,'Tiwu Kondo','kelurahan',NULL,'Elar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-17 09:21:22','2026-03-30 09:31:02'),(164,'Lempang Paji','kelurahan',NULL,'Elar Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-17 09:21:22','2026-03-30 09:31:02'),(165,'Rongga Koe','kelurahan',NULL,'Kota Komba',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-17 09:21:22','2026-03-30 09:31:02'),(166,'Tanah Rata','kelurahan',NULL,'Kota Komba',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-17 09:21:22','2026-03-30 09:31:02'),(167,'WatuNggene','kelurahan',NULL,'Kota Komba',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-17 09:21:22','2026-03-30 09:31:02'),(171,'Golo Wangkung','kelurahan',NULL,'Sambi Rampas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-17 09:21:22','2026-03-30 09:31:02'),(172,'Golo Wangkung Barat','kelurahan',NULL,'Sambi Rampas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-17 09:21:22','2026-03-30 09:31:02'),(173,'Golo Wangkung Utara','kelurahan',NULL,'Sambi Rampas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-17 09:21:22','2026-03-30 09:31:02'),(174,'Nanga Baras','kelurahan',NULL,'Sambi Rampas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-17 09:21:22','2026-03-30 09:31:02'),(175,'Pota','kelurahan',NULL,'Sambi Rampas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-17 09:21:22','2026-03-30 09:31:02'),(176,'Ulung Baras','kelurahan',NULL,'Sambi Rampas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-17 09:21:22','2026-03-30 09:31:02'),(180,'Golo Nderu','desa',NULL,'Kota Komba Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,386,'2026-03-30 12:10:57','2026-04-06 06:23:20'),(181,'Mandosawu','kelurahan',NULL,'Lamba Leda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-30 09:19:06','2026-03-30 09:19:06'),(182,'Nggalak Leleng','kelurahan',NULL,'Lamba Leda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-30 09:19:06','2026-03-30 09:19:06'),(183,'Bangka Leleng','kelurahan',NULL,'Lamba Leda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-30 09:19:06','2026-03-30 09:19:06'),(195,'Watu Pari','desa',NULL,'Kota Komba Utara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-03-30 09:19:06','2026-03-30 09:19:06'),(197,'Lembur','desa',NULL,'Kota Komba',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,458,'2026-03-30 12:11:14','2026-03-30 12:11:14'),(198,'Ruan','desa',NULL,'Kota Komba',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,468,'2026-03-30 12:11:16','2026-03-30 12:11:16'),(199,'Mbengan','desa',NULL,'Kota Komba',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,459,'2026-03-30 12:11:14','2026-03-30 12:11:14'),(200,'Rana Kolong','desa',NULL,'Kota Komba',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,465,'2026-03-30 12:11:15','2026-03-30 12:11:15'),(201,'Gunung','desa',NULL,'Kota Komba',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,455,'2026-03-30 12:11:13','2026-03-30 12:11:13'),(202,'Komba','desa',NULL,'Kota Komba',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,457,'2026-03-30 12:11:14','2026-03-30 12:11:14'),(203,'Bamo','desa',NULL,'Kota Komba',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,450,'2026-03-30 12:11:12','2026-03-30 12:11:12'),(204,'Pong Ruan','desa',NULL,'Kota Komba',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,464,'2026-03-30 12:11:15','2026-03-30 12:11:15'),(216,'Golo Nderu','desa',NULL,'Lamba Leda Selatan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2026-04-06 06:24:04','2026-04-06 06:24:04');
/*!40000 ALTER TABLE `desas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dokumens`
--

DROP TABLE IF EXISTS `dokumens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dokumens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `sender_id` bigint(20) unsigned NOT NULL,
  `receiver_desa_id` bigint(20) unsigned DEFAULT NULL,
  `receiver_user_id` bigint(20) unsigned DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dokumens_sender_id_foreign` (`sender_id`),
  KEY `dokumens_receiver_desa_id_foreign` (`receiver_desa_id`),
  KEY `dokumens_receiver_user_id_foreign` (`receiver_user_id`),
  CONSTRAINT `dokumens_receiver_desa_id_foreign` FOREIGN KEY (`receiver_desa_id`) REFERENCES `desas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `dokumens_receiver_user_id_foreign` FOREIGN KEY (`receiver_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `dokumens_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokumens`
--

LOCK TABLES `dokumens` WRITE;
/*!40000 ALTER TABLE `dokumens` DISABLE KEYS */;
/*!40000 ALTER TABLE `dokumens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dpmd_galleries`
--

DROP TABLE IF EXISTS `dpmd_galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dpmd_galleries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dpmd_profile_id` bigint(20) unsigned NOT NULL,
  `type` enum('foto','video') NOT NULL,
  `url_or_path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dpmd_galleries_dpmd_profile_id_foreign` (`dpmd_profile_id`),
  CONSTRAINT `dpmd_galleries_dpmd_profile_id_foreign` FOREIGN KEY (`dpmd_profile_id`) REFERENCES `dpmd_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dpmd_galleries`
--

LOCK TABLES `dpmd_galleries` WRITE;
/*!40000 ALTER TABLE `dpmd_galleries` DISABLE KEYS */;
/*!40000 ALTER TABLE `dpmd_galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dpmd_profiles`
--

DROP TABLE IF EXISTS `dpmd_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dpmd_profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kadis` varchar(255) DEFAULT NULL,
  `foto_kadis` varchar(255) DEFAULT NULL,
  `foto_struktur` varchar(255) DEFAULT NULL,
  `logo_website` varchar(255) DEFAULT NULL,
  `video_promo_url` varchar(255) DEFAULT NULL,
  `sambutan_judul` varchar(255) DEFAULT NULL,
  `sambutan_teks` text DEFAULT NULL,
  `visi` text DEFAULT NULL,
  `misi` text DEFAULT NULL,
  `nama_sekretaris` varchar(255) DEFAULT NULL,
  `nama_kabid_pemberdayaan` varchar(255) DEFAULT NULL,
  `nama_kabid_pemerintahan` varchar(255) DEFAULT NULL,
  `nama_kabid_ekonomi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stat_total_desa` int(11) DEFAULT NULL,
  `stat_kecamatan` int(11) DEFAULT NULL,
  `stat_desa_wisata` int(11) DEFAULT NULL,
  `stat_spot_wisata` int(11) DEFAULT NULL,
  `stat_wisatawan` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nip_kadis` varchar(255) DEFAULT NULL,
  `pangkat_kadis` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dpmd_profiles`
--

LOCK TABLES `dpmd_profiles` WRITE;
/*!40000 ALTER TABLE `dpmd_profiles` DISABLE KEYS */;
INSERT INTO `dpmd_profiles` VALUES (1,'GASPAR NANGGAR, S.ST.','dpmd-profile/QIlbVlb4jODDh7m1QsDo9VgbEAJmY7ms9QxMLM3j.jpg',NULL,'website-branding/N94hBTU3Sq0cpnMEeM7YwxHMcWmJUaqLEUkqu2Eb.jpg',NULL,'MEMBANGUN DESA MEMBANGUN INDONESIA. DESA MAJU RAKYAT SEJAHTERA.','Selamat datang di Portal SID Manggarai Timur. Kami berkomitmen untuk terus mendorong transparansi dan inovasi di setiap desa di Kabupaten Manggarai Timur.\r\n\r\nBranding Dinas PMD: Desa Melayani dengan \"HEPI\" (HUMANIS, EDUKATIF, PROFESIONAL DAN INOVATIF). Melalui platform ini, kami mengintegrasikan tata kelola yang akuntabel demi menciptakan pemerintahan desa yang mandiri dan berdaya saing.','Manggarai Timur Maju, Sejahtera, Berbudaya dan Berkelanjutan (MAMA SEBER)','Mewujudkan Sumber Daya Manusia Manggarai Timur yang maju dan berkualitas serta adaptif terhadap perkembangan ilmu pengetahuan dan teknologi.\r\nPenguatan ekonomi kerakyatan yang berbasis potensi daerah dan kearifan lokal untuk pertumbuhan ekonomi inklusif guna mewujudkan pusat pusat pertumbuhan ekonomi baru yang produktif.\r\nMelanjutkan pembangunan infrastruktur dasar yang berwawasan lingkungan yang merata di berbagai sektor untuk mendorong kesinambungan pembangunan.\r\nMemperkuat desa membangun menuju desa sebagai basis penghidupan dan kehidupan masyarakat secara berkelanjutan serta menjadikan desa sebagai entitas yang mandiri.\r\nMewujudkan pembangunan yang dilandasi budaya dan kesetaraan gender serta penguatan peran perempuan dan perlindungan anak.\r\nMewujudkan tata kelola pemerintahan dan pelayanan publik yang beritegritas, transparan dan reponsif.','Sekretaris Dinas','Bidang Pemberdayaan','Bidang Pemerintahan','Bidang Ekonomi','2026-03-15 04:35:07','2026-04-06 06:32:26',176,12,0,0,'0',NULL,NULL,'manggaraitimur@kab.go.id','196801061992121002',NULL);
/*!40000 ALTER TABLE `dpmd_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dpmd_staff`
--

DROP TABLE IF EXISTS `dpmd_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dpmd_staff` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dpmd_profile_id` bigint(20) unsigned DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `pangkat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dpmd_staff_dpmd_profile_id_foreign` (`dpmd_profile_id`),
  CONSTRAINT `dpmd_staff_dpmd_profile_id_foreign` FOREIGN KEY (`dpmd_profile_id`) REFERENCES `dpmd_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dpmd_staff`
--

LOCK TABLES `dpmd_staff` WRITE;
/*!40000 ALTER TABLE `dpmd_staff` DISABLE KEYS */;
INSERT INTO `dpmd_staff` VALUES (1,1,'Hendrikus Radas, Se','SEKERTARIS',NULL,1,1,'2026-03-25 05:09:32','2026-03-25 19:00:34','197305092006041013','Pembina Tk I, IV/b'),(2,1,'Robertus V. L. Laba, S.km','KEPALA BIDANG PEMBERDAYAAN KELEMBAGAAN',NULL,2,1,'2026-03-25 05:09:32','2026-03-25 19:00:34','198702232011011009','Penata Tk I, III/d'),(3,1,'Martinus Sajong, S. Sos','KEPALA BIDANG PEMERINTAHAN DESA',NULL,3,1,'2026-03-25 05:09:32','2026-03-25 19:00:34','197912172009031005','Pembina, IV/a'),(4,1,'Tino Rani, St','KEPALA BIDANG PENATAAN DESA DAN KERJA SAMA DESA',NULL,4,1,'2026-03-25 05:09:32','2026-03-25 19:00:34','198205022010011046','Pembina, IV/a'),(5,1,'Maria Yoangela Nanggut, S.sos','KEPALA SUB KEPEGAWAIAN',NULL,5,1,'2026-03-25 05:09:32','2026-03-25 19:00:34','198301282015032003','Penata Tk I, III/d'),(6,1,'Theresia Tutut, S.ip','KEPALA SUB KEUANGAN',NULL,6,1,'2026-03-25 05:09:32','2026-03-25 19:00:34','197903142009032004','Penata Tk I, III/d');
/*!40000 ALTER TABLE `dpmd_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kecamatans`
--

DROP TABLE IF EXISTS `kecamatans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kecamatans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kecamatans_nama_unique` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kecamatans`
--

LOCK TABLES `kecamatans` WRITE;
/*!40000 ALTER TABLE `kecamatans` DISABLE KEYS */;
INSERT INTO `kecamatans` VALUES (1,'Borong','2026-03-30 12:10:49','2026-03-30 12:10:49'),(2,'Congkar','2026-03-30 12:10:49','2026-03-30 12:10:49'),(3,'Elar','2026-03-30 12:10:49','2026-03-30 12:10:49'),(4,'Elar Selatan','2026-03-30 12:10:49','2026-03-30 12:10:49'),(5,'Kota Komba','2026-03-30 12:10:50','2026-03-30 12:10:50'),(6,'Kota Komba Utara','2026-03-30 12:10:50','2026-03-30 12:10:50'),(7,'Lamba Leda','2026-03-30 12:10:50','2026-03-30 12:10:50'),(8,'Lamba Leda Selatan','2026-03-30 12:10:50','2026-03-30 12:10:50'),(9,'Lamba Leda Timur','2026-03-30 12:10:51','2026-03-30 12:10:51'),(10,'Lamba Leda Utara','2026-03-30 12:10:51','2026-03-30 12:10:51'),(11,'Rana Mese','2026-03-30 12:10:51','2026-03-30 12:10:51'),(12,'Sambi Rampas','2026-03-30 12:10:51','2026-03-30 12:10:51');
/*!40000 ALTER TABLE `kecamatans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laporans`
--

DROP TABLE IF EXISTS `laporans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laporans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `desa_id` bigint(20) unsigned NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori` enum('keuangan','penduduk','kejadian','lainnya') NOT NULL,
  `keterangan` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `tanggal_laporan` date NOT NULL,
  `status` enum('pending','diterima','ditolak') NOT NULL DEFAULT 'pending',
  `catatan_admin` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laporans_desa_id_foreign` (`desa_id`),
  CONSTRAINT `laporans_desa_id_foreign` FOREIGN KEY (`desa_id`) REFERENCES `desas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laporans`
--

LOCK TABLES `laporans` WRITE;
/*!40000 ALTER TABLE `laporans` DISABLE KEYS */;
/*!40000 ALTER TABLE `laporans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_01_23_163602_create_desas_table',1),(5,'2026_01_23_163605_create_potensis_table',1),(6,'2026_01_23_163608_create_laporans_table',1),(7,'2026_01_24_094550_create_dpmd_profiles_table',1),(8,'2026_01_24_101723_add_logo_website_to_dpmd_profiles_table',1),(9,'2026_01_24_103134_create_pesans_table',1),(10,'2026_01_24_103826_create_beritas_table',1),(11,'2026_01_24_105632_add_stats_to_dpmd_profiles',1),(12,'2026_01_24_113622_add_lampiran_to_pesans_table',1),(13,'2026_01_24_121418_add_video_promo_url_to_dpmd_profiles_table',1),(14,'2026_01_24_122557_add_video_youtube_to_desas_table',1),(15,'2026_01_24_130337_create_regulasis_table',1),(16,'2026_01_24_132527_add_statistics_to_desas_table',1),(17,'2026_01_24_134429_create_pengumumen_table',1),(18,'2026_01_24_201325_create_regulasi_downloads_table',1),(19,'2026_01_26_171410_create_dokumens_table',1),(20,'2026_01_26_180342_create_desa_galleries_table',1),(21,'2026_01_26_184002_add_user_id_and_balasan_to_pesans_table',1),(22,'2026_01_26_190824_add_is_read_desa_to_pesans_table',1),(23,'2026_01_27_035513_create_dpmd_galleries_table',1),(24,'2026_01_28_004417_update_potensis_categories',1),(25,'2026_01_28_005503_create_potensi_galleries_table',1),(26,'2026_01_28_013316_add_contact_to_dpmd_profiles_table',1),(27,'2026_01_30_173511_add_komoditi_to_potensis_kategori',1),(28,'2026_01_30_224520_create_kecamatans_table',1),(29,'2026_01_30_add_jenis_to_desas',1),(30,'2026_02_19_195807_add_username_to_users_table',1),(31,'2026_02_22_191545_add_stat_kecamatan_to_dpmd_profiles_table',1),(32,'2026_02_22_192135_make_stats_nullable_in_dpmd_profiles_table',1),(33,'2026_02_22_210500_add_original_name_to_various_tables',1),(34,'2026_02_25_131038_create_dpmd_staff_table',1),(35,'2026_03_14_104232_add_kecamatan_and_role_to_users_table',1),(36,'2026_03_17_fix_lamba_leda_data',2),(37,'2026_03_17_sync_all_kelurahans',3),(38,'2026_03_17_create_admin_accounts_for_kelurahans',4),(39,'2026_03_17_add_foto_struktur_to_dpmd_profiles',5),(40,'2026_03_25_120807_add_nip_to_dpmd_tables',6),(41,'2026_03_25_123849_clean_nip_data',7),(42,'2026_03_26_002451_create_arsips_table',8),(43,'2026_03_27_230812_add_display_toggles_to_pengumumans_table',9),(45,'2026_03_27_232224_add_pdf_to_pengumumans_table',10),(46,'2026_03_30_153508_add_recovery_codes_to_users_table',11),(47,'2026_04_07_111100_add_foto_and_views_to_pengumumans_table',12);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES ('fenditusagung31@gmail.com','$2y$12$n9KG011RgIzQXNMy4lzf0.qA6FP0JxFs8NStE29C47E0vIjAsuX1u','2026-03-30 08:09:35');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengumumans`
--

DROP TABLE IF EXISTS `pengumumans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengumumans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `tipe` enum('info','penting','darurat') NOT NULL DEFAULT 'info',
  `foto` varchar(255) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `show_on_dashboard` tinyint(1) NOT NULL DEFAULT 1,
  `show_on_public` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengumumans_user_id_foreign` (`user_id`),
  CONSTRAINT `pengumumans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengumumans`
--

LOCK TABLES `pengumumans` WRITE;
/*!40000 ALTER TABLE `pengumumans` DISABLE KEYS */;
INSERT INTO `pengumumans` VALUES (11,'Realisasi Dana Desa Tahap I - Tahun Anggaran 2026','Pemberitahuan Pelaksanaan Musyawarah Desa Khusus (Musdesus)','pengumuman-files/7nvChoRNoUb1xtf1QWThm62Y5LcfMnt1Hsz7xZmI.pdf','Pemberitahuan Pelaksanaan Musyawarah Desa Khusus (Musdesus) .pdf','info',NULL,0,1,0,1,349,'2026-04-06 06:53:47','2026-04-06 06:53:47'),(12,'Realisasi Dana Desa Tahap I - Tahun Anggaran 2026',': Laporan ini mencakup penggunaan Dana Desa bulan Januari - Maret 2026, termasuk pem-bangunan drainase di Dusun Lorong Koe dan bantuan bibit jagung untuk kelompok tani.','pengumuman-files/rDK23bzLE4FC8uWNPybtq67H2BYAaoZ8QfzziRKr.pdf','Surat_DPMD_Camat_Borong_Percepatan_Laporan_Februari_2026.pdf','info',NULL,6,1,0,1,349,'2026-04-06 07:02:49','2026-04-07 04:39:00'),(14,'DPMD Kab. Manggarai Timur Gelar Pelatihan Digitalisasi Laporan Desa','Laporan ini mencakup penggunaan Dana Desa bulan Januari - Maret 2026, termasuk pem-bangunan drainase di Dusun Lorong Koe dan bantuan bibit jagung untuk kelompok tani.','pengumuman-files/nu8JNwZ9Anq9E1Haq2fKGeFkUHnmwbRQxDRnXIt5.pdf','Surat_DPMD_Camat_Borong_Percepatan_Laporan_Februari_2026.pdf','info',NULL,5,1,0,1,349,'2026-04-06 07:04:26','2026-04-07 04:29:24');
/*!40000 ALTER TABLE `pengumumans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pesans`
--

DROP TABLE IF EXISTS `pesans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pesans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subjek` varchar(255) DEFAULT NULL,
  `pesan` text NOT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `balasan` text DEFAULT NULL,
  `balasan_at` timestamp NULL DEFAULT NULL,
  `is_read_desa` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `pesans_user_id_foreign` (`user_id`),
  CONSTRAINT `pesans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pesans`
--

LOCK TABLES `pesans` WRITE;
/*!40000 ALTER TABLE `pesans` DISABLE KEYS */;
/*!40000 ALTER TABLE `pesans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `potensi_galleries`
--

DROP TABLE IF EXISTS `potensi_galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `potensi_galleries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `potensi_id` bigint(20) unsigned NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `potensi_galleries_potensi_id_foreign` (`potensi_id`),
  CONSTRAINT `potensi_galleries_potensi_id_foreign` FOREIGN KEY (`potensi_id`) REFERENCES `potensis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `potensi_galleries`
--

LOCK TABLES `potensi_galleries` WRITE;
/*!40000 ALTER TABLE `potensi_galleries` DISABLE KEYS */;
/*!40000 ALTER TABLE `potensi_galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `potensis`
--

DROP TABLE IF EXISTS `potensis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `potensis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `desa_id` bigint(20) unsigned NOT NULL,
  `nama_potensi` varchar(255) NOT NULL,
  `kategori` enum('kuliner','kerajinan','event','alam','budaya','komoditi','lainnya') NOT NULL,
  `deskripsi` text NOT NULL,
  `foto_utama` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `potensis_desa_id_foreign` (`desa_id`),
  CONSTRAINT `potensis_desa_id_foreign` FOREIGN KEY (`desa_id`) REFERENCES `desas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `potensis`
--

LOCK TABLES `potensis` WRITE;
/*!40000 ALTER TABLE `potensis` DISABLE KEYS */;
/*!40000 ALTER TABLE `potensis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regulasi_downloads`
--

DROP TABLE IF EXISTS `regulasi_downloads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regulasi_downloads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `regulasi_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `downloaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `regulasi_downloads_regulasi_id_foreign` (`regulasi_id`),
  KEY `regulasi_downloads_user_id_foreign` (`user_id`),
  CONSTRAINT `regulasi_downloads_regulasi_id_foreign` FOREIGN KEY (`regulasi_id`) REFERENCES `regulasis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `regulasi_downloads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regulasi_downloads`
--

LOCK TABLES `regulasi_downloads` WRITE;
/*!40000 ALTER TABLE `regulasi_downloads` DISABLE KEYS */;
/*!40000 ALTER TABLE `regulasi_downloads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regulasis`
--

DROP TABLE IF EXISTS `regulasis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regulasis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `regulasis_user_id_foreign` (`user_id`),
  CONSTRAINT `regulasis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regulasis`
--

LOCK TABLES `regulasis` WRITE;
/*!40000 ALTER TABLE `regulasis` DISABLE KEYS */;
/*!40000 ALTER TABLE `regulasis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('gDJsyD3BHJj4tFQ0jJIdmksPFAYyUIb0T32Tmv92',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUGRuT2owU3FCcklvbFhkMzBqNlVnanU2VmpkTFRadHZCOXpvdlRwUyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czoxMToicHVibGljLmhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1775539704),('wX8HskWdenmmfgHgjz3YIyn3eauLmoEiCvxy7fYF',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoick5ES210dkUxSVB3RGJOeHMxTzFqOWUzaFZTanE5ZFNNTkxITFNWbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wZW5ndW11bWFuLzEyIjtzOjU6InJvdXRlIjtzOjI0OiJwdWJsaWMucGVuZ3VtdW1hbi5kZXRhaWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1775536281);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` enum('admin_dpmd','admin_desa','admin_kecamatan') DEFAULT 'admin_desa',
  `kecamatan` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `recovery_codes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`recovery_codes`)),
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=521 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (349,'Admin DPMD Manggarai Timur','admin@dpmd.com',NULL,NULL,'admin_dpmd',NULL,NULL,'$2y$12$H38.4wehqhpHZZaGMRC9UOTo.5JSjBju5TIGnbh30FO5.A.Pwy2KS',NULL,NULL,'2026-03-30 12:10:49','2026-03-30 12:10:49'),(350,'Admin Kec. Borong','borong@kecamatan.com',NULL,NULL,'admin_kecamatan','Borong',NULL,'$2y$12$JxzqeJ6r1Spr7hufUZCSMuNYWvzyl5Geb6EeH41S.WUV9p.PzuiwO',NULL,NULL,'2026-03-30 12:10:49','2026-03-30 12:10:49'),(351,'Admin Kec. Congkar','congkar@kecamatan.com',NULL,NULL,'admin_kecamatan','Congkar',NULL,'$2y$12$Sgx02YsCarnFXnjHpSw7iOBGBvA3xxN5iTsszjz92Nz5SUV08NBS2',NULL,NULL,'2026-03-30 12:10:49','2026-03-30 12:10:49'),(352,'Admin Kec. Elar','elar@kecamatan.com',NULL,NULL,'admin_kecamatan','Elar',NULL,'$2y$12$ZBh2np/L5FGC9GTonARhjuK4GFzMmOqK/iqkS16UY55kE8jgooH/.',NULL,NULL,'2026-03-30 12:10:49','2026-03-30 12:10:49'),(353,'Admin Kec. Elar Selatan','elarselatan@kecamatan.com',NULL,NULL,'admin_kecamatan','Elar Selatan',NULL,'$2y$12$oB6wQ33tSK2AasGZN0bv2ugDVyLyS55faJpCeviUI4NQfjcVUB4ny',NULL,NULL,'2026-03-30 12:10:50','2026-03-30 12:10:50'),(354,'Admin Kec. Kota Komba','kotakomba@kecamatan.com',NULL,NULL,'admin_kecamatan','Kota Komba',NULL,'$2y$12$9gJ3vEcAdzHFCpZdciZfYuArziqszhNLzRx2QNSud.Cjqu8AryIH6',NULL,NULL,'2026-03-30 12:10:50','2026-03-30 12:10:50'),(355,'Admin Kec. Kota Komba Utara','kotakombautara@kecamatan.com',NULL,NULL,'admin_kecamatan','Kota Komba Utara',NULL,'$2y$12$0.NeWnvtSM64Wes1gW/RPuB2CddRLhqcZAHcTtnpZ/9LFZ.04rM0i',NULL,NULL,'2026-03-30 12:10:50','2026-03-30 12:10:50'),(356,'Admin Kec. Lamba Leda','lambaleda@kecamatan.com',NULL,NULL,'admin_kecamatan','Lamba Leda',NULL,'$2y$12$ivKikn74KuJsQaitb59R3uOD0GUTIRaW133D9mZhIEGOmQOhlt0Na',NULL,NULL,'2026-03-30 12:10:50','2026-03-30 12:10:50'),(357,'Admin Kec. Lamba Leda Selatan','lambaledaselatan@kecamatan.com',NULL,NULL,'admin_kecamatan','Lamba Leda Selatan',NULL,'$2y$12$0CzkV5TSpjQ0LOI/H8MZe.UxZFJ5R2fSb.ksrbJiQAn/A2ClKOMh6',NULL,NULL,'2026-03-30 12:10:51','2026-03-30 12:10:51'),(358,'Admin Kec. Lamba Leda Timur','lambaledatimur@kecamatan.com',NULL,NULL,'admin_kecamatan','Lamba Leda Timur',NULL,'$2y$12$hww.c9WGU1ozbTRloNGD5uRI3jFLc8kFLz0k3./gf/Wf0IXv8Ywhi',NULL,NULL,'2026-03-30 12:10:51','2026-03-30 12:10:51'),(359,'Admin Kec. Lamba Leda Utara','lambaledautara@kecamatan.com',NULL,NULL,'admin_kecamatan','Lamba Leda Utara',NULL,'$2y$12$/3rodftm.ZZBi/rHRVbGkOnmBVtgECrQfs6rDCsstARV23SHECZpe',NULL,NULL,'2026-03-30 12:10:51','2026-03-30 12:10:51'),(360,'Admin Kec. Rana Mese','ranamese@kecamatan.com',NULL,NULL,'admin_kecamatan','Rana Mese',NULL,'$2y$12$62IjUeaJLCS8wk6vLeuZBeZmzWImnCngMY23ncBbzCwYI2RZhRsTK',NULL,NULL,'2026-03-30 12:10:51','2026-03-30 12:10:51'),(361,'Admin Kec. Sambi Rampas','sambirampas@kecamatan.com',NULL,NULL,'admin_kecamatan','Sambi Rampas',NULL,'$2y$12$u0NugLROfNO3sN3a8lG3UeQh0tgEpw9anOWk9aP9RySKaDAjgMxU.',NULL,NULL,'2026-03-30 12:10:52','2026-03-30 12:10:52'),(362,'Admin Desa Balus Permai','baluspermai.borong@desa.com',NULL,NULL,'admin_desa','Borong',NULL,'$2y$12$Z1pe3nRdvk5i4cUbBbfyNe7s5DCUN7Y4DWA8MMKhRb8ch0xZzOz/C',NULL,NULL,'2026-03-30 12:10:52','2026-03-30 12:10:52'),(363,'Admin Desa Bangka Kantar','bangkakantar.borong@desa.com',NULL,NULL,'admin_desa','Borong',NULL,'$2y$12$QZuKJ0UnAET2eiDKAnafDuNm0vGP2m/3.LVDbCvIDDZnWvbbkF9dq',NULL,NULL,'2026-03-30 12:10:52','2026-03-30 12:10:52'),(364,'Admin Desa Benteng Raja','bentengraja.borong@desa.com',NULL,NULL,'admin_desa','Borong',NULL,'$2y$12$d1SWIfROGYaokQnqBC/Vu.ygzgRl/GH3LLrYimHPRwybUltkP/uoe',NULL,NULL,'2026-03-30 12:10:52','2026-03-30 12:10:52'),(365,'Admin Desa Benteng Riwu','bentengriwu.borong@desa.com',NULL,NULL,'admin_desa','Borong',NULL,'$2y$12$c7nBmg.Ag/lmLj72xO93U.ZJP0H2NI67Q.516PG2JCuA3DNKhYhzO',NULL,NULL,'2026-03-30 12:10:52','2026-03-30 12:10:52'),(366,'Admin Desa Compang Ndejing','compangndejing.borong@desa.com',NULL,NULL,'admin_desa','Borong',NULL,'$2y$12$DM3qHG2l67gA1lNnreSXCuGkiLNTWu9/bplxpZY9Az9kebnC/TgSq',NULL,NULL,'2026-03-30 12:10:53','2026-03-30 12:10:53'),(367,'Admin Desa Compang Tenda','compangtenda.borong@desa.com',NULL,NULL,'admin_desa','Borong',NULL,'$2y$12$Eb6H8O5xwuYMWmaxcx330.ovY5sHzo59SG1Gm.0Vgmbx1xgbhTVP2',NULL,NULL,'2026-03-30 12:10:53','2026-03-30 12:10:53'),(368,'Admin Desa Golo Kantar','golokantar.borong@desa.com',NULL,NULL,'admin_desa','Borong',NULL,'$2y$12$9wNh3qUVic2GCsqNFYA6NeGsnQRYZVpXQ2rCFtkd3m9.feMKB7DN6',NULL,NULL,'2026-03-30 12:10:53','2026-03-30 12:10:53'),(369,'Admin Desa Golo Lalong','gololalong.borong@desa.com',NULL,NULL,'admin_desa','Borong',NULL,'$2y$12$Uc.tMONBd0TGkNMu6ENBi.Ca8hyA2BKPoj1vERmAkcoWNZdBaKfCy',NULL,NULL,'2026-03-30 12:10:53','2026-03-30 12:10:53'),(370,'Admin Desa Golo Leda','gololeda.borong@desa.com',NULL,NULL,'admin_desa','Borong',NULL,'$2y$12$RO7X6UIRZqcCLijf5ZCnxeuvcmvqT4Mcyre4lzHxBdpAX4Gz0X6DC',NULL,NULL,'2026-03-30 12:10:54','2026-03-30 12:10:54'),(371,'Admin Desa Gurung Liwut','gurungliwut.borong@desa.com',NULL,NULL,'admin_desa','Borong',NULL,'$2y$12$uUIcvXpAvt85KaBHlQl4jO2zn2Kj8Erh/886gAVLsG6NSCDA1Fjj2',NULL,NULL,'2026-03-30 12:10:54','2026-03-30 12:10:54'),(372,'Admin Desa Nanga Labang','nangalabang.borong@desa.com',NULL,NULL,'admin_desa','Borong',NULL,'$2y$12$RDsjrXxpmkNx1lt0z.5mauYwpX9EytzG7q4mypK/bV77AAEIDpQly',NULL,NULL,'2026-03-30 12:10:54','2026-03-30 12:10:54'),(373,'Admin Desa Ngampang Mas','ngampangmas.borong@desa.com',NULL,NULL,'admin_desa','Borong',NULL,'$2y$12$TULMarmEHadwLiTRmSSkuONdvWMWVJx.uudEGXOmpkhnCk/qLKu0u',NULL,NULL,'2026-03-30 12:10:54','2026-03-30 12:10:54'),(374,'Admin Desa Poco Rii','pocorii.borong@desa.com',NULL,NULL,'admin_desa','Borong',NULL,'$2y$12$NClOuHsrJ3C1vHiDpRSZTOzrazTCyqxatCBThW1DI/zOvOEf62NGK',NULL,NULL,'2026-03-30 12:10:54','2026-03-30 12:10:54'),(375,'Admin Desa Rana Masak','ranamasak.borong@desa.com',NULL,NULL,'admin_desa','Borong',NULL,'$2y$12$.APcnFglASokFhMRoVwvWe/rEhVfN5PxuXXILHfn/G3xMSaRnsEK6',NULL,NULL,'2026-03-30 12:10:55','2026-03-30 12:10:55'),(376,'Admin Desa Waling','waling.borong@desa.com',NULL,NULL,'admin_desa','Borong',NULL,'$2y$12$jwftpDlMmvCI7YSbwdUfCeO75bV5dlqODtoxQvqA8H8LC5Rkk7r6W',NULL,NULL,'2026-03-30 12:10:55','2026-03-30 12:10:55'),(377,'Admin Desa Bangka Kuleng','bangkakuleng.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$1h/zrhNC33YE0KYJQHLK1uAjX832Lv6dKMvduTOz9QEThIks5UW1S',NULL,NULL,'2026-03-30 12:10:55','2026-03-30 12:10:55'),(378,'Admin Desa Bangka Pau','bangkapau.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$jhquXZJBArleSZMYzCVLSe2lRQUcsCzy6rO24gvoHjlqPMbGVXcx6',NULL,NULL,'2026-03-30 12:10:55','2026-03-30 12:10:55'),(379,'Admin Desa Bea Waek','beawaek.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$89JwazxeZrMOlhGz2FNHGO7.Y/yAbFohWoxUV4CK0/FUaAkl/OfSS',NULL,NULL,'2026-03-30 12:10:56','2026-03-30 12:10:56'),(380,'Admin Desa Compang Laho','companglaho.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$UMizhpd2aCGFlsq6IcD/j.7eVyA/OyKifkS2WAXawfgI550/G9Ope',NULL,NULL,'2026-03-30 12:10:56','2026-03-30 12:10:56'),(381,'Admin Desa Compang Wesang','compangwesang.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$5HvASAZDfwJb30Y8f4tx.uULM/o.7wuQIrrBj/NvxV1UZEjDq7vtq',NULL,NULL,'2026-03-30 12:10:56','2026-03-30 12:10:56'),(382,'Admin Desa Compang Weluk','compangweluk.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$qijrXTp6i7V2csjJ3v2lmebxZktGwbSMaMVRo2rdN8..sjDEfMgC.',NULL,NULL,'2026-03-30 12:10:56','2026-03-30 12:10:56'),(383,'Admin Desa Deno','deno.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$VbvPOrXTR5eh/Nk.x2Hpkek16VGwrVDjjKEs2pG1PqBMHnQYozih6',NULL,NULL,'2026-03-30 12:10:57','2026-03-30 12:10:57'),(384,'Admin Desa Golo Lobos','gololobos.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$a0.0kz0LCWnEMWoz9BGNFuQU4/qSP9mgo06jqHyNn/yWH2fAT.Ae6',NULL,NULL,'2026-03-30 12:10:57','2026-03-30 12:10:57'),(385,'Admin Desa Golo Ndari','golondari.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$zn8mrBIxARy1EPOTRGqx7OneIzUYi1sXJ9GAAv9bjVXvhyd5gf.qO',NULL,NULL,'2026-03-30 12:10:57','2026-03-30 12:10:57'),(386,'Admin Desa Golo Nderu','golonderu.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$BtbDLNT6brFzvj43NIiNXOado4VgAa13EhzRaOSaw5oqq0.DreEfq',NULL,NULL,'2026-03-30 12:10:57','2026-03-30 12:10:57'),(387,'Admin Desa Golo Rengket','golorengket.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$h/WtsOC81F8AY3lYwqBtZO3XCwdOr9hpNE/zCRrnJP5SYQh.EsYKS',NULL,NULL,'2026-03-30 12:10:57','2026-03-30 12:10:57'),(388,'Admin Desa Golo Wune','golowune.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$XqBTYtkM.VeyE7u8c9ECR.R7bVIP1EEC9muEMuGmG.gRAMZ8gUL36',NULL,NULL,'2026-03-30 12:10:58','2026-03-30 12:10:58'),(389,'Admin Desa Gurung Turi','gurungturi.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$E.OSo0zRdK7SSUTredfgJ.KFuwWZh8krQi.Cpnt.xE.gNDq6EY6ZK',NULL,NULL,'2026-03-30 12:10:58','2026-03-30 12:10:58'),(390,'Admin Desa Lenang','lenang.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$TfcbHKMh4o3L2T0EfViIxO1rs8oMSBaSz4BLnAUDKPsjs4Ux8Zcxy',NULL,NULL,'2026-03-30 12:10:58','2026-03-30 12:10:58'),(391,'Admin Desa Lento','lento.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$kqjbEjr5Xq4clvcoX9FZ0eZH.bRW7D0ASG6//XJAStkOZmGmtmIWK',NULL,NULL,'2026-03-30 12:10:58','2026-03-30 12:10:58'),(392,'Admin Desa Leong','leong.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$/8EjH4BRY/PUVWvX4CdAAu9wh3uU6ZCPoffD0fOmQD/7QQ4Se0Qua',NULL,NULL,'2026-03-30 12:10:59','2026-03-30 12:10:59'),(393,'Admin Desa Melo','melo.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$VSDUTP3yWVjSW4eEvqL10uL0m6bRk3MCIab2u1CWA3eLOY1T1qyd.',NULL,NULL,'2026-03-30 12:10:59','2026-03-30 12:10:59'),(394,'Admin Desa Poco Lia','pocolia.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$jhfZ5atjxd7rT1yaOTASW.PKhXbjeEMnSQtD0zp..QkYU0ZWqGcu6',NULL,NULL,'2026-03-30 12:10:59','2026-03-30 12:10:59'),(395,'Admin Desa Pocong','pocong.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$PKItZGmN732lAqHQX0r06uNzuupJM5vBkzuX7s5oA9vvLimWN957W',NULL,NULL,'2026-03-30 12:10:59','2026-03-30 12:10:59'),(396,'Admin Desa Satar Tesem','satartesem.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$axHhBErwPvQRXcqly1N4wu1ZJAYlBMMibx5x2oQ/nM6jOWTJWp/Za',NULL,NULL,'2026-03-30 12:10:59','2026-03-30 12:10:59'),(397,'Admin Desa Watu Lanur','watulanur.lambaledaselatan@desa.com',NULL,NULL,'admin_desa','Lamba Leda Selatan',NULL,'$2y$12$6D4ZZsvug5lCQzou7Dc8E.Cc/JOvXjA2o5dnHCEjBHCKRQi/j/bAK',NULL,NULL,'2026-03-30 12:11:00','2026-03-30 12:11:00'),(398,'Admin Desa Compang Deru','compangderu.lambaleda@desa.com',NULL,NULL,'admin_desa','Lamba Leda',NULL,'$2y$12$RN4GxAYzD4pun/3VGzBffeF1JUy21Q9kSdzynQBwMfKWQ3uIaz8xy',NULL,NULL,'2026-03-30 12:11:00','2026-03-30 12:11:00'),(399,'Admin Desa Compang Mekar','compangmekar.lambaleda@desa.com',NULL,NULL,'admin_desa','Lamba Leda',NULL,'$2y$12$/bEpOPVbFDmVy1gwN3FNXOWSb/g1hfTMDz7SSddYCZlmHoaYsA6sG',NULL,NULL,'2026-03-30 12:11:00','2026-03-30 12:11:00'),(400,'Admin Desa Compang Necak','compangnecak.lambaleda@desa.com',NULL,NULL,'admin_desa','Lamba Leda',NULL,'$2y$12$MLUMLULpA8nRU9NjCZoiPOThyI.OvREg5VgIkKFvXbAdExhCTWYC6',NULL,NULL,'2026-03-30 12:11:00','2026-03-30 12:11:00'),(401,'Admin Desa Goreng Meni','gorengmeni.lambaleda@desa.com',NULL,NULL,'admin_desa','Lamba Leda',NULL,'$2y$12$TNiF9GPv5TbTTp44.nciZ.ZPGwJFtEWocHWz8KLCXybH1ENvi4Hwy',NULL,NULL,'2026-03-30 12:11:01','2026-03-30 12:11:01'),(402,'Admin Desa Goreng Meni Utara','gorengmeniutara.lambaleda@desa.com',NULL,NULL,'admin_desa','Lamba Leda',NULL,'$2y$12$oAfq2OEBfFSN4ZOPUZCmROcpSee99z0wknpgLnffZvjIJtIJ9AM22',NULL,NULL,'2026-03-30 12:11:01','2026-03-30 12:11:01'),(403,'Admin Desa Golo Lembur','gololembur.lambaleda@desa.com',NULL,NULL,'admin_desa','Lamba Leda',NULL,'$2y$12$9qhgAV8XccmgIhdrwJmpp.L98TpvrVXSn7uN/fWJQ9Z1uuednaoMu',NULL,NULL,'2026-03-30 12:11:01','2026-03-30 12:11:01'),(404,'Admin Desa Golo Munga','golomunga.lambaleda@desa.com',NULL,NULL,'admin_desa','Lamba Leda',NULL,'$2y$12$s9T83U9xoudz4TH2mvQv2OPNpzKg6hR.3cJXnSB205VAfMNfNHHZi',NULL,NULL,'2026-03-30 12:11:01','2026-03-30 12:11:01'),(405,'Admin Desa Golo Nimbung','golonimbung.lambaleda@desa.com',NULL,NULL,'admin_desa','Lamba Leda',NULL,'$2y$12$L7j6BsD.1Nrdhltz0Hz0C.XtNc8xLCWGaKW4GnViotaZq7JudT2K2',NULL,NULL,'2026-03-30 12:11:02','2026-03-30 12:11:02'),(406,'Admin Desa Golo Paleng','golopaleng.lambaleda@desa.com',NULL,NULL,'admin_desa','Lamba Leda',NULL,'$2y$12$ETMXlmqT488XAsC.PtnRy.dnVn82EIs9TWZXHHM0EAPeIkJG1RfbO',NULL,NULL,'2026-03-30 12:11:02','2026-03-30 12:11:02'),(407,'Admin Desa Golo Rentung','golorentung.lambaleda@desa.com',NULL,NULL,'admin_desa','Lamba Leda',NULL,'$2y$12$JSTNdz/qzE8ivvXg.jsh0OGMNuvH7nw9Ep8xdJyl1KphLkYzb.q6O',NULL,NULL,'2026-03-30 12:11:02','2026-03-30 12:11:02'),(408,'Admin Desa Lamba Keli','lambakeli.lambaleda@desa.com',NULL,NULL,'admin_desa','Lamba Leda',NULL,'$2y$12$LEGLd7AxDGQKGP5/i1lp0uUqM6B0MKN.GibxLyMYiF81JAYHkhJ8u',NULL,NULL,'2026-03-30 12:11:02','2026-03-30 12:11:02'),(409,'Admin Desa Tengku Lawar','tengkulawar.lambaleda@desa.com',NULL,NULL,'admin_desa','Lamba Leda',NULL,'$2y$12$HKSIfdUqpnsMNEUk.euV2em9jIDiK60VR4MT375OwbNUvzlC02nRK',NULL,NULL,'2026-03-30 12:11:02','2026-03-30 12:11:02'),(410,'Admin Desa Tengku Leda','tengkuleda.lambaleda@desa.com',NULL,NULL,'admin_desa','Lamba Leda',NULL,'$2y$12$OHNjixDNAJteRs6jfQP6kOoo0Q3zk32Sam3d3rZn9MW6JwiEg6Fti',NULL,NULL,'2026-03-30 12:11:03','2026-03-30 12:11:03'),(411,'Admin Desa Golo Mangung','golomangung.lambaledautara@desa.com',NULL,NULL,'admin_desa','Lamba Leda Utara',NULL,'$2y$12$o21/Z6GB8R2TQi218yPU0ebCTJib72iHdDuNm9QNktxPimdcEPLdG',NULL,NULL,'2026-03-30 12:11:03','2026-03-30 12:11:03'),(412,'Admin Desa Golo Munga Barat','golomungabarat.lambaledautara@desa.com',NULL,NULL,'admin_desa','Lamba Leda Utara',NULL,'$2y$12$5i8ryc1d17.dDO5g0Bhz3OXxHbXvEvPlPsq6Grf8Ep/XZw896K4uy',NULL,NULL,'2026-03-30 12:11:03','2026-03-30 12:11:03'),(413,'Admin Desa Golo Wontong','golowontong.lambaledautara@desa.com',NULL,NULL,'admin_desa','Lamba Leda Utara',NULL,'$2y$12$OBFdmPNrX4HwdQY7qCgW.uUWZHgB97ugUcZJsApCLj9R/qn6Y2ueS',NULL,NULL,'2026-03-30 12:11:03','2026-03-30 12:11:03'),(414,'Admin Desa Haju Wangi','hajuwangi.lambaledautara@desa.com',NULL,NULL,'admin_desa','Lamba Leda Utara',NULL,'$2y$12$U92T2tJQ6owsp4Qg.x93aOasw.5LOZjEd.JtNvODNoKkylQK51bNS',NULL,NULL,'2026-03-30 12:11:04','2026-03-30 12:11:04'),(415,'Admin Desa Lencur','lencur.lambaledautara@desa.com',NULL,NULL,'admin_desa','Lamba Leda Utara',NULL,'$2y$12$a6XUrlJ3RAlSH2l4QHc3uuqxyR89BLyg6IwJxafbys3Pf83wQfRYK',NULL,NULL,'2026-03-30 12:11:04','2026-03-30 12:11:04'),(416,'Admin Desa Liang Deruk','liangderuk.lambaledautara@desa.com',NULL,NULL,'admin_desa','Lamba Leda Utara',NULL,'$2y$12$x9.VSCckvKRdaWE.usUv1ekpyRhRGoMw5s7H73GY2WgqWzSqADwPK',NULL,NULL,'2026-03-30 12:11:04','2026-03-30 12:11:04'),(417,'Admin Desa Nampar Tabang','nampartabang.lambaledautara@desa.com',NULL,NULL,'admin_desa','Lamba Leda Utara',NULL,'$2y$12$Jv77uswfDyeRYPYGf3Uj3.3PtVhbn0rNlafQJF2f8bjAlw3OWPz9q',NULL,NULL,'2026-03-30 12:11:04','2026-03-30 12:11:04'),(418,'Admin Desa Satar Kampas','satarkampas.lambaledautara@desa.com',NULL,NULL,'admin_desa','Lamba Leda Utara',NULL,'$2y$12$J4Ln8sd8Lu561bskI1IpkOz7Qbhzu1MeHEZzIaBdh.44456c9eWYS',NULL,NULL,'2026-03-30 12:11:04','2026-03-30 12:11:04'),(419,'Admin Desa Satar Padut','satarpadut.lambaledautara@desa.com',NULL,NULL,'admin_desa','Lamba Leda Utara',NULL,'$2y$12$TuwaI5NXk5WAFVjyhYVB2utSu5/noSeQaINDnP/q7KMuTxOMYOZp6',NULL,NULL,'2026-03-30 12:11:05','2026-03-30 12:11:05'),(420,'Admin Desa Satar Punda','satarpunda.lambaledautara@desa.com',NULL,NULL,'admin_desa','Lamba Leda Utara',NULL,'$2y$12$700mehnmeA2R7IkQoAlRouNJqt5GnwLzoPmfqXdhZ5RDMuumSo.Sq',NULL,NULL,'2026-03-30 12:11:05','2026-03-30 12:11:05'),(421,'Admin Desa Satar Punda Barat','satarpundabarat.lambaledautara@desa.com',NULL,NULL,'admin_desa','Lamba Leda Utara',NULL,'$2y$12$yojqGGWgDQE6AwrICIyPTOggpEawKDgzexaZlncGGbqO1GnRZRaO2',NULL,NULL,'2026-03-30 12:11:05','2026-03-30 12:11:05'),(422,'Admin Desa Kembang Mekar','kembangmekar.sambirampas@desa.com',NULL,NULL,'admin_desa','Sambi Rampas',NULL,'$2y$12$JiOfnYFA/7egPUNjmyFi7.5WFG/iyqMwlsAzxn5fBKGI2ULM7PaBS',NULL,NULL,'2026-03-30 12:11:05','2026-03-30 12:11:05'),(423,'Admin Desa Lada Mese','ladamese.sambirampas@desa.com',NULL,NULL,'admin_desa','Sambi Rampas',NULL,'$2y$12$rkZmly2PZLZuLB8od70xC.ZVua0ODJ.km1816cVRYvCJKwSc7Os8K',NULL,NULL,'2026-03-30 12:11:06','2026-03-30 12:11:06'),(424,'Admin Desa Nampar Sepang','namparsepang.sambirampas@desa.com',NULL,NULL,'admin_desa','Sambi Rampas',NULL,'$2y$12$ms8iSqy8KAo9.qAOSSt1V.vjsnfhGfTiOv/qI4lpo6yAeu9qgfuE.',NULL,NULL,'2026-03-30 12:11:06','2026-03-30 12:11:06'),(425,'Admin Desa Nanga Mbaling','nangambaling.sambirampas@desa.com',NULL,NULL,'admin_desa','Sambi Rampas',NULL,'$2y$12$WSqeMM1mX7H3y9XXkZfWte9T5dKgnk0Vh/FFrXEv372wWLJyIlzea',NULL,NULL,'2026-03-30 12:11:06','2026-03-30 12:11:06'),(426,'Admin Desa Nanga Mbaur','nangambaur.sambirampas@desa.com',NULL,NULL,'admin_desa','Sambi Rampas',NULL,'$2y$12$kVg4sqCcMH17yPZfioKsWO7QWwIbRy93MiccDBGzBxx2JP6NWiS.O',NULL,NULL,'2026-03-30 12:11:06','2026-03-30 12:11:06'),(427,'Admin Desa Wela Lada','welalada.sambirampas@desa.com',NULL,NULL,'admin_desa','Sambi Rampas',NULL,'$2y$12$105g5xYpWQ49l25wiwxZIu.braQa3.SGxRtG/2Q.c9QEeQsGSnAWy',NULL,NULL,'2026-03-30 12:11:07','2026-03-30 12:11:07'),(428,'Admin Desa Buti','buti.congkar@desa.com',NULL,NULL,'admin_desa','Congkar',NULL,'$2y$12$LYPjr8Ri171PRW8hDPl93ezcH1uEjIliQjBsFO8aCUZdPsMB0t3vG',NULL,NULL,'2026-03-30 12:11:07','2026-03-30 12:11:07'),(429,'Admin Desa Golo Ngawan','golongawan.congkar@desa.com',NULL,NULL,'admin_desa','Congkar',NULL,'$2y$12$E5TxHOn8W.wdTXq2IWOLBOSdLU5u6gO/sgHQWkv1grkuO4aSFoTJW',NULL,NULL,'2026-03-30 12:11:07','2026-03-30 12:11:07'),(430,'Admin Desa Satar Nawang','satarnawang.congkar@desa.com',NULL,NULL,'admin_desa','Congkar',NULL,'$2y$12$I2JaKY9l352T0ioL9J/Zn.wLX4Y6KkLD5EsJHpXFWuFpPktjfT0mW',NULL,NULL,'2026-03-30 12:11:07','2026-03-30 12:11:07'),(431,'Admin Desa Rana Mese','ranamese.congkar@desa.com',NULL,NULL,'admin_desa','Congkar',NULL,'$2y$12$h3C/fli1yy1vMjS8v84pruCaHrOAY6lzwWHtAOL1Gd584hgyOluCK',NULL,NULL,'2026-03-30 12:11:08','2026-03-30 12:11:08'),(432,'Admin Desa Compang Congkar','compangcongkar.congkar@desa.com',NULL,NULL,'admin_desa','Congkar',NULL,'$2y$12$0LsUwiaOxkup0BP4JuOYIeD0q9FwOAHe1Kx0nYh25i2oxbTfubec.',NULL,NULL,'2026-03-30 12:11:08','2026-03-30 12:11:08'),(433,'Admin Desa Compang Lawi','companglawi.congkar@desa.com',NULL,NULL,'admin_desa','Congkar',NULL,'$2y$12$8tptXHMCrs0J2mNy2zB5Me4xVSLzcOAb3xbvRpEK9EdMHCRB81eoC',NULL,NULL,'2026-03-30 12:11:08','2026-03-30 12:11:08'),(434,'Admin Desa Golo Pari','golopari.congkar@desa.com',NULL,NULL,'admin_desa','Congkar',NULL,'$2y$12$0Fct2O8BbCV2a4XbYWvfweun7xB6i3J..RlTmeUzNCwPAZMe4b8GC',NULL,NULL,'2026-03-30 12:11:08','2026-03-30 12:11:08'),(435,'Admin Desa Wea','wea.congkar@desa.com',NULL,NULL,'admin_desa','Congkar',NULL,'$2y$12$mI6MaCuFr9d70UmumGxIruf7BhJtUCOOd/gp7J.5Kw.l.cEysvSgq',NULL,NULL,'2026-03-30 12:11:08','2026-03-30 12:11:08'),(436,'Admin Desa Biting','biting.elar@desa.com',NULL,NULL,'admin_desa','Elar',NULL,'$2y$12$jog9Khp8VvHWdpfMtKWDH.czjQGLoDj/h4U7NXpL5PK1vkhVf2Iwi',NULL,NULL,'2026-03-30 12:11:09','2026-03-30 12:11:09'),(437,'Admin Desa Compang Soba','compangsoba.elar@desa.com',NULL,NULL,'admin_desa','Elar',NULL,'$2y$12$OvEt8L59H8doe4l25QG9S.zDlTwFdldLE7tLnBcXLNle5QaqR4dBO',NULL,NULL,'2026-03-30 12:11:09','2026-03-30 12:11:09'),(438,'Admin Desa Compang Teo','compangteo.elar@desa.com',NULL,NULL,'admin_desa','Elar',NULL,'$2y$12$pEUTLJ1wMxXvGpGZ5VZ16.NqZtlsj6h4FJZ4m0JWNROi0/CMaCTqi',NULL,NULL,'2026-03-30 12:11:09','2026-03-30 12:11:09'),(439,'Admin Desa Golo Lebo','gololebo.elar@desa.com',NULL,NULL,'admin_desa','Elar',NULL,'$2y$12$hliCt2VLv7wpH1PKhsSo9uRZSnq1p33iGoJ09R8rayxeRuFvdxfaW',NULL,NULL,'2026-03-30 12:11:09','2026-03-30 12:11:09'),(440,'Admin Desa Golo Lijun','gololijun.elar@desa.com',NULL,NULL,'admin_desa','Elar',NULL,'$2y$12$PIs.7Umau1pXjW79za.pUe7p0mlp1.4sTGnjOcHOlH1gHd41VS/0C',NULL,NULL,'2026-03-30 12:11:10','2026-03-30 12:11:10'),(441,'Admin Desa Golo Munde','golomunde.elar@desa.com',NULL,NULL,'admin_desa','Elar',NULL,'$2y$12$xSv5.mJJecQZowT5wIC.Q.usTWSpx3IM/C6.Y59DTyUYDpwehOolq',NULL,NULL,'2026-03-30 12:11:10','2026-03-30 12:11:10'),(442,'Admin Desa Haju Ngendong','hajungendong.elar@desa.com',NULL,NULL,'admin_desa','Elar',NULL,'$2y$12$z9w7yohq7X9GZ/c5pZc5Ae95aX.jqSdq9sW/syTcB2mn52J3A9Iye',NULL,NULL,'2026-03-30 12:11:10','2026-03-30 12:11:10'),(443,'Admin Desa Kaju Wangi','kajuwangi.elar@desa.com',NULL,NULL,'admin_desa','Elar',NULL,'$2y$12$EU.vX0gYtjq02/ueOi7xXOSc121JdF7Aoe18XhSeIxqCC1XSJ5szS',NULL,NULL,'2026-03-30 12:11:10','2026-03-30 12:11:10'),(444,'Admin Desa Legur Lai','legurlai.elar@desa.com',NULL,NULL,'admin_desa','Elar',NULL,'$2y$12$vIoLsAwzvhiD8u9OWO0q..Lf7AmIhMZnzGqp1qEtvwpJgqPFstDXa',NULL,NULL,'2026-03-30 12:11:11','2026-03-30 12:11:11'),(445,'Admin Desa Lengko Namut','lengkonamut.elar@desa.com',NULL,NULL,'admin_desa','Elar',NULL,'$2y$12$6am2uQAy1MVG91SgnVLIfuOmJy6HjBEv4T7aIO5qENyM8ay7YwYFa',NULL,NULL,'2026-03-30 12:11:11','2026-03-30 12:11:11'),(446,'Admin Desa Rana Gapang','ranagapang.elar@desa.com',NULL,NULL,'admin_desa','Elar',NULL,'$2y$12$YajRpRZAP920QThWgcvUKuPh11wZDq89jfsSkfEX6hIpVyXbzyecS',NULL,NULL,'2026-03-30 12:11:11','2026-03-30 12:11:11'),(447,'Admin Desa Rana Kulan','ranakulan.elar@desa.com',NULL,NULL,'admin_desa','Elar',NULL,'$2y$12$5jO8bBR11Zziw7w3h4RZRe2Kn3FvCZthYQVKGok8Shx7h/XL5GZlO',NULL,NULL,'2026-03-30 12:11:11','2026-03-30 12:11:11'),(448,'Admin Desa Sisir','sisir.elar@desa.com',NULL,NULL,'admin_desa','Elar',NULL,'$2y$12$gS7AJTF4sMqomMxIKu5vEei4W8XvoeQ/7X5FhilcDlfl9Ic./J8lW',NULL,NULL,'2026-03-30 12:11:11','2026-03-30 12:11:11'),(449,'Admin Desa Wae Lokom','waelokom.elar@desa.com',NULL,NULL,'admin_desa','Elar',NULL,'$2y$12$ACarYX6o4zKqOjrXl1w5OezJ4Zf80GGRI8G7wPu1UorpGLQFHUpfy',NULL,NULL,'2026-03-30 12:11:12','2026-03-30 12:11:12'),(450,'Admin Desa Bamo','bamo.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$.2D3i9.xu/HYMT1SdHG.yuxjhKRGGXAmd0/.GjT7D.WBJmnU/Zi7q',NULL,NULL,'2026-03-30 12:11:12','2026-03-30 12:11:12'),(451,'Admin Desa Golo Meni','golomeni.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$hDBHsABeq1sJPtI/WcU1HO4VepLgu14SsBkr9cj.cJIGksCoAa.g6',NULL,NULL,'2026-03-30 12:11:12','2026-03-30 12:11:12'),(452,'Admin Desa Golo Ndele','golondele.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$DOoXNyNeZjiv2K30L6piv.8jpZoWeqMT9qlA8kWHVhKV9viBjXgRe',NULL,NULL,'2026-03-30 12:11:12','2026-03-30 12:11:12'),(453,'Admin Desa Golo Nderu','golonderu.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$7i7YQJ1LQGSseV4XGl2zDOFFFZBZptLfkuXd/gQVSV487gbxX5hZa',NULL,NULL,'2026-03-30 12:11:13','2026-03-30 12:11:13'),(454,'Admin Desa Golo Tolang','golotolang.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$tp93wYNK1sEFCP9X4b2SxO.J.Ke70RewSUcPQrAUtfwCl/rYegNly',NULL,NULL,'2026-03-30 12:11:13','2026-03-30 12:11:13'),(455,'Admin Desa Gunung','gunung.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$SxdeNWkt6dCyUJAlCUDMz.aifT7RLsI2NwpZDclQcfJIAiBoHTTWa',NULL,NULL,'2026-03-30 12:11:13','2026-03-30 12:11:13'),(456,'Admin Desa Gunung Baru','gunungbaru.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$OEZMgcMT78/AhjzgxX2mku2T/0XwQhDwVbTBiCwoO.SptskhzreWy',NULL,NULL,'2026-03-30 12:11:13','2026-03-30 12:11:13'),(457,'Admin Desa Komba','komba.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$tbRN2GMO8Lk3uK66qEws1uQ1TDOERa8/R2/bvNfULT7vhtGAA4xse',NULL,NULL,'2026-03-30 12:11:14','2026-03-30 12:11:14'),(458,'Admin Desa Lembur','lembur.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$KGR68wS/HIAO9irnSiBDfufNZfGPEu1M6ej56xRDgH0WRG33y5zQO',NULL,NULL,'2026-03-30 12:11:14','2026-03-30 12:11:14'),(459,'Admin Desa Mbengan','mbengan.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$cuIl0brFVUESrfrZgPwpyuL4xemB5IyEtxUHh9PtJZRagx0A/Ztpe',NULL,NULL,'2026-03-30 12:11:14','2026-03-30 12:11:14'),(460,'Admin Desa Mokel','mokel.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$Vke.edkmvipDXwH3Joj34uRLIJh.cemYIF2O4BJeuRFHu8tQkS9T2',NULL,NULL,'2026-03-30 12:11:14','2026-03-30 12:11:14'),(461,'Admin Desa Mokel Morid','mokelmorid.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$s9BfN13ZXm4vRuln5hcHJe0WHXrmKvOp9lfHMyjEI5idsfLYkG1Yq',NULL,NULL,'2026-03-30 12:11:14','2026-03-30 12:11:14'),(462,'Admin Desa Paan Leleng','paanleleng.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$sia2fxoSIYrAhHKebIcDx.XE02cVF5sKfcYjFNnVe1K.dWSqTjEfe',NULL,NULL,'2026-03-30 12:11:15','2026-03-30 12:11:15'),(463,'Admin Desa Pari','pari.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$9rLGpDORCpMU2ZpVQpGzbuh1snwJj1Jj8ayEvZG2Q/RuV/f/.nTZa',NULL,NULL,'2026-03-30 12:11:15','2026-03-30 12:11:15'),(464,'Admin Desa Pong Ruan','pongruan.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$0461qLefuj33R/EwFnMCYeQNUU9ScCnkYDi/yCUjSXwJ4gIgrezaa',NULL,NULL,'2026-03-30 12:11:15','2026-03-30 12:11:15'),(465,'Admin Desa Rana Kolong','ranakolong.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$iQFKml15w1HTZr60uCp6SuA2TZ.pUGRFWsfZbAnQL2oFh8tzH.WwS',NULL,NULL,'2026-03-30 12:11:15','2026-03-30 12:11:15'),(466,'Admin Desa Rana Mbeling','ranambeling.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$TcZYpqYAtZ.HGYzg56pcg.XzAelvxugAlu6wph.KM9LnCtHsSguO6',NULL,NULL,'2026-03-30 12:11:16','2026-03-30 12:11:16'),(467,'Admin Desa Rana Mbata','ranambata.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$sj4XE8W193pju8PFjnEgeukpR4a4j3XFAmSonwYB4E8kCgK4UgXAK',NULL,NULL,'2026-03-30 12:11:16','2026-03-30 12:11:16'),(468,'Admin Desa Ruan','ruan.kotakomba@desa.com',NULL,NULL,'admin_desa','Kota Komba',NULL,'$2y$12$v4li4XDKd8Dx8Nw6oXskNum7ljJ9NxBs1zQJMaJIXWFDJ7nULbtTq',NULL,NULL,'2026-03-30 12:11:16','2026-03-30 12:11:16'),(469,'Admin Desa Bangka Kempo','bangkakempo.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$CEQL4j9GYLSAQNy3CCbMTu2ifKApCHN5z9EJm2BUpqSK.yTlYvno.',NULL,NULL,'2026-03-30 12:11:16','2026-03-30 12:11:16'),(470,'Admin Desa Bangka Masa','bangkamasa.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$YgtAtg1Y6W076qJuxt5Ef.GPT3djeQaFONr7JkfFu8VFQMXUxpy1e',NULL,NULL,'2026-03-30 12:11:17','2026-03-30 12:11:17'),(471,'Admin Desa Bea Ngencung','beangencung.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$63t7liQsjSctvhuYvQ.FTOpiqqzu4N7IlituGpuXa4TzGVsc5YVZS',NULL,NULL,'2026-03-30 12:11:18','2026-03-30 12:11:18'),(472,'Admin Desa Compang Kantar','compangkantar.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$MeXa1LdNDbD2u1wKjulz5e5bS0f73KCibeKvCbsDP5hLThXQDlGpC',NULL,NULL,'2026-03-30 12:11:19','2026-03-30 12:11:19'),(473,'Admin Desa Compang Kempo','compangkempo.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$YTgi.nlkbT3rLodRNyGDlO0OoAy3YZnkNzfRMz6TYwSdpV8ZD1GJi',NULL,NULL,'2026-03-30 12:11:20','2026-03-30 12:11:20'),(474,'Admin Desa Compang Loni','compangloni.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$cRJ.16m3p7vc43Ss39rgOeIhEoqV5LrJSV/tqN77/ciWbiaf0cAEi',NULL,NULL,'2026-03-30 12:11:20','2026-03-30 12:11:20'),(475,'Admin Desa Compang Teber','compangteber.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$hbwsHRTbuMEybdHuxklGxu2pZhCgrOJ4pVvd1kD6tf3EWKUEFz2MW',NULL,NULL,'2026-03-30 12:11:21','2026-03-30 12:11:21'),(476,'Admin Desa Golo Loni','gololoni.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$hhRAy0Ah/Xp6.PqSRPiwd..gWtOZJIi3CYdpuA4pO3w3eR8nfeYQi',NULL,NULL,'2026-03-30 12:11:22','2026-03-30 12:11:22'),(477,'Admin Desa Golo Meleng','golomeleng.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$D4hoD4V.fgF5jTWtUpL65eoi9Gq6qs7.aQqGVqkkvzEPsXUM.XIWi',NULL,NULL,'2026-03-30 12:11:23','2026-03-30 12:11:23'),(478,'Admin Desa Golo Ros','goloros.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$9jCOsMoTPiASHfUI49LIu.YHtsM36htJyestMwexsrxm8F2YFJcC.',NULL,NULL,'2026-03-30 12:11:23','2026-03-30 12:11:23'),(479,'Admin Desa Golo Rutuk','golorutuk.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$hb7wZBUH8kRGODA8ZH1bqOLBKazCo02LuQU.QhimXQ3wX086s6GR.',NULL,NULL,'2026-03-30 12:11:24','2026-03-30 12:11:24'),(480,'Admin Desa Lalang','lalang.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$TGJomHGc4Uf6DW.5MitkveoiIGSjEH.wc7xUEVHWmaPpQJsKHUYGu',NULL,NULL,'2026-03-30 12:11:25','2026-03-30 12:11:25'),(481,'Admin Desa Lidi','lidi.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$PoK1O.//B/45QczJtRH.DuXz38W1cQOJbJFwmwgFQhEkFH3cW2og.',NULL,NULL,'2026-03-30 12:11:26','2026-03-30 12:11:26'),(482,'Admin Desa Rondo Woing','rondowoing.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$yk9t2gn46XlsWGhLmaRrqexeEJxRChyrGcKx1nV29jlYp5ar4XwWy',NULL,NULL,'2026-03-30 12:11:26','2026-03-30 12:11:26'),(483,'Admin Desa Sano Lokom','sanolokom.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$S3czM.ShPmZWJdZLlW6M3.vGSbmnBGNloyrQSIh4UwRY/32GHElna',NULL,NULL,'2026-03-30 12:11:27','2026-03-30 12:11:27'),(484,'Admin Desa Satar Lahing','satarlahing.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$dtlLeAgr790pKDBmQh50vuDXR.Mvs32dX40MIB6gz2ZscTvFzNwUm',NULL,NULL,'2026-03-30 12:11:28','2026-03-30 12:11:28'),(485,'Admin Desa Satar Lenda','satarlenda.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$9wEh8I9Plr01rjdzVp1EmuhUlZ.D.4lxnCGOF0NMYKTe2mzE5FAY6',NULL,NULL,'2026-03-30 12:11:29','2026-03-30 12:11:29'),(486,'Admin Desa Sita','sita.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$usJGrAURL.LydSRF.npqdu0G1hpA25QVrEB3Z3kpe59ZEpntMdu8i',NULL,NULL,'2026-03-30 12:11:29','2026-03-30 12:11:29'),(487,'Admin Desa Torok Golo','torokgolo.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$V1uCyK.XMLAgBCbqw1Pc9edOy6ivsjW7xUZ8PrHiQymCOGPZ75Rvq',NULL,NULL,'2026-03-30 12:11:30','2026-03-30 12:11:30'),(488,'Admin Desa Wae Nggori','waenggori.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$sFcX0iJQ1Vm8vRgTrQNi.e5jNWxsBe/8DopPAs.APP11akJfr1/fa',NULL,NULL,'2026-03-30 12:11:31','2026-03-30 12:11:31'),(489,'Admin Desa Watu Mori','watumori.ranamese@desa.com',NULL,NULL,'admin_desa','Rana Mese',NULL,'$2y$12$2jYtGdXL2SbLLRRE6F/66uidyKtUe.4bWuOOuyXUODFWqEiY4ScXi',NULL,NULL,'2026-03-30 12:11:33','2026-03-30 12:11:33'),(490,'Admin Desa Arus','arus.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$qawOOW3w1bAyme7XL4mafuWz0AIPWGPQ7kuMt0LUOky.WrDEmJGBO',NULL,NULL,'2026-03-30 12:11:33','2026-03-30 12:11:33'),(491,'Admin Desa Bangka Arus','bangkaarus.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$v7Wc0SooT2GZHztZZjg0iuGUC4OQ4FUobn5rIwCP/ClLFU0f.lOGq',NULL,NULL,'2026-03-30 12:11:34','2026-03-30 12:11:34'),(492,'Admin Desa Benteng Rampas','bentengrampas.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$KmrD3j60XI1v7c7gZTxW6uxyOD2Keo0gt7sCLzIBJbmVHlBd9B4pS',NULL,NULL,'2026-03-30 12:11:35','2026-03-30 12:11:35'),(493,'Admin Desa Benteng Wunis','bentengwunis.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$sr4RGXX0P1BTG.InoAhLAO51uvN1AQAhnDgzFl4YUWBUkJ/u3bUj.',NULL,NULL,'2026-03-30 12:11:36','2026-03-30 12:11:36'),(494,'Admin Desa Colol','colol.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$gRSjbBBJFBYTG7jwmT.Fwu22GSFJRyhNE6iIDtd.kKjTLAue8P4p2',NULL,NULL,'2026-03-30 12:11:37','2026-03-30 12:11:37'),(495,'Admin Desa Compang Raci','compangraci.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$yzzi2lQPRv4cHS9Bd7HspOeY5rQEkeg7Qm/KiCfiqcWH4DuR0biwm',NULL,NULL,'2026-03-30 12:11:38','2026-03-30 12:11:38'),(496,'Admin Desa Compang Wunis','compangwunis.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$FPYKuP0Qe8NkAEJSQDapseMZOaCZ1YbzGMA86xYd9thgfOIhaseG6',NULL,NULL,'2026-03-30 12:11:39','2026-03-30 12:11:39'),(497,'Admin Desa Golo Lero','gololero.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$ofS3QbV6Mv8bvhwLyOgg1OORKD0kIl9xWhVcA5u3USgzuIKqix0ca',NULL,NULL,'2026-03-30 12:11:40','2026-03-30 12:11:40'),(498,'Admin Desa Ngkiong Dora','ngkiongdora.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$9Br7mKbq7i8dX59iSzP7iO8hU/cwBdpP1ESMewfmbirwmtXZ2YX5q',NULL,NULL,'2026-03-30 12:11:41','2026-03-30 12:11:41'),(499,'Admin Desa Rende Nao','rendenao.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$KhUxCLngBf10wleWmltOcOylaLf/MR0yzQmXR6KHnZuNwDSsy.nOm',NULL,NULL,'2026-03-30 12:11:41','2026-03-30 12:11:41'),(500,'Admin Desa Rengkam','rengkam.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$TS85F9Sxf.2U8TynbHRumuZ7CcCZTaSEQTu9hNF5We7rW9eh7Y8V6',NULL,NULL,'2026-03-30 12:11:42','2026-03-30 12:11:42'),(501,'Admin Desa Tango Molas','tangomolas.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$l8XlEsJN1e4nNf6.THVs5uRqPPeVEuTHwsWVtmr4ReCFOW7qn.Zdm',NULL,NULL,'2026-03-30 12:11:43','2026-03-30 12:11:43'),(502,'Admin Desa Ulu Wae','uluwae.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$7/iXGxEizpcMD6oHrDFsn.ob5uUD4WOY.K8522/Q10I/Nqie6Nv6G',NULL,NULL,'2026-03-30 12:11:44','2026-03-30 12:11:44'),(503,'Admin Desa Urung Dora','urungdora.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$ULkM.cPdunQmy2vlEi6P2.gbtvSRcecWHETrdCYfedgsaRNhqdCGC',NULL,NULL,'2026-03-30 12:11:45','2026-03-30 12:11:45'),(504,'Admin Desa Wangkar Weli','wangkarweli.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$1bYCqv63A97bY1xd67XYyebwNsL8DVqamO6D6RyPcoti.nDEP2DkO',NULL,NULL,'2026-03-30 12:11:46','2026-03-30 12:11:46'),(505,'Admin Desa Watu Arus','watuarus.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$Mnf5gqOGS0Sr.NmNbxpgEOKHOXh.907CceNaO/fDO7yaHFsiJzr.e',NULL,NULL,'2026-03-30 12:11:47','2026-03-30 12:11:47'),(506,'Admin Desa Wejang Mali','wejangmali.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$oa2HLo0rmoqJDx.vwF46iOL0XTuCi6vkgnDlRHA9MheYsWoS4tETK',NULL,NULL,'2026-03-30 12:11:47','2026-03-30 12:11:47'),(507,'Admin Desa Wejang Mawe','wejangmawe.lambaledatimur@desa.com',NULL,NULL,'admin_desa','Lamba Leda Timur',NULL,'$2y$12$Hlu6rwAzQWYTtPIBIGpsqOn9AwLT4dl5L/m19ZODtzu1QBcUIgqaC',NULL,NULL,'2026-03-30 12:11:48','2026-03-30 12:11:48'),(508,'Admin Desa Benteng Pau','bentengpau.elarselatan@desa.com',NULL,NULL,'admin_desa','Elar Selatan',NULL,'$2y$12$YGUFPCLLYfki6DI9QhsmJejV64QPfi.5R.5zBx4stFRnImP4NkwYm',NULL,NULL,'2026-03-30 12:11:49','2026-03-30 12:11:49'),(509,'Admin Desa Gising','gising.elarselatan@desa.com',NULL,NULL,'admin_desa','Elar Selatan',NULL,'$2y$12$LZniehlFeLd.7z57YEgU3.BWOb2OuiavjLn9xIZvOs0uThBs6BogK',NULL,NULL,'2026-03-30 12:11:50','2026-03-30 12:11:50'),(510,'Admin Desa Golo Linus','gololinus.elarselatan@desa.com',NULL,NULL,'admin_desa','Elar Selatan',NULL,'$2y$12$KPDnh1jHBCuSBghghkFeDud96i27j4.0jIVqCUVtUFDqu.99EYFfG',NULL,NULL,'2026-03-30 12:11:51','2026-03-30 12:11:51'),(511,'Admin Desa Golo Wuas','golowuas.elarselatan@desa.com',NULL,NULL,'admin_desa','Elar Selatan',NULL,'$2y$12$J38THCvAAS4LW7pDD7bEL.SIJBKLqu8J9gOXjj/81PSgaNjzoNQTy',NULL,NULL,'2026-03-30 12:11:51','2026-03-30 12:11:51'),(512,'Admin Desa Langga Sai','langgasai.elarselatan@desa.com',NULL,NULL,'admin_desa','Elar Selatan',NULL,'$2y$12$K/crQqY6IIwsBL6kYqHFm..CLCcu6fYXc57xPHrZIYaxwhTpB.rtG',NULL,NULL,'2026-03-30 12:11:52','2026-03-30 12:11:52'),(513,'Admin Desa Mosi Ngaran','mosingaran.elarselatan@desa.com',NULL,NULL,'admin_desa','Elar Selatan',NULL,'$2y$12$ImwSVNe7y.ezxhhWYyMQb.EVCLLHfd4vyPoYJXGncZLAtn3sZmN5O',NULL,NULL,'2026-03-30 12:11:53','2026-03-30 12:11:53'),(514,'Admin Desa Nanga Meje','nangameje.elarselatan@desa.com',NULL,NULL,'admin_desa','Elar Selatan',NULL,'$2y$12$rpyUPJJOtGsHgD8Iz6ZHCOMfdEgdkdRSaQhld8N1n8nvee3z4pXUK',NULL,NULL,'2026-03-30 12:11:53','2026-03-30 12:11:53'),(515,'Admin Desa Nanga Puun','nangapuun.elarselatan@desa.com',NULL,NULL,'admin_desa','Elar Selatan',NULL,'$2y$12$f.CPiQCfvhhXHL4p7nj/7uYjrvmmnBTYzNzdKaokyTaHHMz92AFW6',NULL,NULL,'2026-03-30 12:11:54','2026-03-30 12:11:54'),(516,'Admin Desa Paan Waru','paanwaru.elarselatan@desa.com',NULL,NULL,'admin_desa','Elar Selatan',NULL,'$2y$12$D.2x0vZ5hyPEpbQ6YcS2OeY6oRzphGWv0o5vH4Y6EZt2TWQr4krkC',NULL,NULL,'2026-03-30 12:11:55','2026-03-30 12:11:55'),(517,'Admin Desa Sangan Kalo','sangankalo.elarselatan@desa.com',NULL,NULL,'admin_desa','Elar Selatan',NULL,'$2y$12$NP5Ag1/XjEjXpLr14HmQ8.VRNM1J/ymu2N2RjqHJLZG5IKq0KNoYy',NULL,NULL,'2026-03-30 12:11:56','2026-03-30 12:11:56'),(518,'Admin Desa Sipi','sipi.elarselatan@desa.com',NULL,NULL,'admin_desa','Elar Selatan',NULL,'$2y$12$t5iVjTxrip8Pt8NX19O1EO8pNdx07wWilfhw/C1oRdi0CPEAfv56G',NULL,NULL,'2026-03-30 12:11:57','2026-03-30 12:11:57'),(519,'Admin Desa Teno Mese','tenomese.elarselatan@desa.com',NULL,NULL,'admin_desa','Elar Selatan',NULL,'$2y$12$rpBfon174Ze1LGmAvrxH1.sIBivcZwl21qPvpqqmJj//i2vFouiP6',NULL,NULL,'2026-03-30 12:11:57','2026-03-30 12:11:57'),(520,'Admin Desa Wae Rasan','waerasan.elarselatan@desa.com',NULL,NULL,'admin_desa','Elar Selatan',NULL,'$2y$12$4T3aTAwcXvMhf..TRXf9HePoTzqCltNiKJ2JjkXxzk10PDQAx4fe6',NULL,NULL,'2026-03-30 12:11:58','2026-03-30 12:11:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-07 12:44:59
