-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: localhost    Database: project_eas_sandana
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `berita_acaras`
--

DROP TABLE IF EXISTS `berita_acaras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `berita_acaras` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brd_id` bigint(20) unsigned NOT NULL,
  `nomor_ba` varchar(255) NOT NULL,
  `nama_project` varchar(255) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `tanggal_ba` date NOT NULL,
  `deadline` date DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `notes_finance` text DEFAULT NULL,
  `pihak_pertama` varchar(255) DEFAULT NULL,
  `pihak_kedua` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `berita_acaras_brd_id_foreign` (`brd_id`),
  CONSTRAINT `berita_acaras_brd_id_foreign` FOREIGN KEY (`brd_id`) REFERENCES `brds` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `berita_acaras`
--

LOCK TABLES `berita_acaras` WRITE;
/*!40000 ALTER TABLE `berita_acaras` DISABLE KEYS */;
INSERT INTO `berita_acaras` VALUES (1,1,'BRD/001/06/2006','Instalasi Ruang ICU A','RSUD SIDOARJO','2026-06-03','2026-06-03','approved',NULL,'nadia','feri','Pada hari Senin, tanggal 08 Juni 2026, pekerjaan Instalasi Ruang Radiologi C telah selesai dilaksanakan dan dilakukan pemeriksaan bersama oleh kedua belah pihak. Berdasarkan hasil pemeriksaan, pekerjaan dinyatakan selesai dengan kondisi baik dan dapat digunakan untuk operasional. Namun demikian, terdapat beberapa catatan berupa penyempurnaan penandaan area keselamatan radiasi, pengumpulan dokumen garansi peralatan, serta pelaksanaan uji coba operasional sebelum proyek dinyatakan selesai 100%.','2026-06-01 04:58:07','2026-06-01 04:58:49'),(3,3,'07/BA','Instalasi ICU','RS SIDOARJO','2026-06-13','2026-06-14','approved',NULL,'NADIA','NANA','BGUFGYTDCTRXCTCB','2026-06-12 03:44:38','2026-06-12 03:45:24');
/*!40000 ALTER TABLE `berita_acaras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brd_files`
--

DROP TABLE IF EXISTS `brd_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brd_files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brd_id` bigint(20) unsigned NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `path_file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brd_files_brd_id_foreign` (`brd_id`),
  CONSTRAINT `brd_files_brd_id_foreign` FOREIGN KEY (`brd_id`) REFERENCES `brds` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brd_files`
--

LOCK TABLES `brd_files` WRITE;
/*!40000 ALTER TABLE `brd_files` DISABLE KEYS */;
INSERT INTO `brd_files` VALUES (1,1,'1780314880_cv.pdf','brd_files/1780314880_cv.pdf','2026-06-01 04:54:40','2026-06-01 04:54:40'),(2,2,'1780368135_cv.pdf','brd_files/1780368135_cv.pdf','2026-06-01 19:42:15','2026-06-01 19:42:15'),(3,3,'1781260931_Project Timeline.pdf','brd_files/1781260931_Project Timeline.pdf','2026-06-12 03:42:11','2026-06-12 03:42:11');
/*!40000 ALTER TABLE `brd_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brds`
--

DROP TABLE IF EXISTS `brds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brds` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nomor_brd` varchar(255) NOT NULL,
  `client` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_upload` date NOT NULL,
  `deadline` date NOT NULL,
  `sales_id` bigint(20) unsigned NOT NULL,
  `status_engineering` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `notes_engineering` text DEFAULT NULL,
  `status_finance` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `notes_finance` text DEFAULT NULL,
  `status_final` enum('pending','approved','rejected','revision') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brds_sales_id_foreign` (`sales_id`),
  CONSTRAINT `brds_sales_id_foreign` FOREIGN KEY (`sales_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brds`
--

LOCK TABLES `brds` WRITE;
/*!40000 ALTER TABLE `brds` DISABLE KEYS */;
INSERT INTO `brds` VALUES (1,'BRD/001/06/2006','RSUD SIDOARJO','Instalasi Ruang ICU A','BRD ini disusun untuk mendokumentasikan kebutuhan pembangunan dan instalasi Ruang Radiologi C guna meningkatkan kapasitas layanan radiologi, mendukung operasional rumah sakit, serta memastikan kesesuaian kebutuhan pengguna dengan pelaksanaan proyek.','2026-06-01','2026-06-02',2,'approved','ok acc','approved','okk','approved','2026-06-01 04:54:40','2026-06-01 04:56:49'),(2,'BRD/002/06/2006','RS SURABAYA','Instalasi Ruang ICU A','Pembayaran DP sebesar 30% dari nilai kontrak kepada PT Medika Teknologi Indonesia dilakukan untuk mendukung proses pengadaan unit Digital X-Ray, PACS Server, workstation radiologi, UPS, dan perlengkapan proteksi radiasi yang akan digunakan pada Instalasi Ruang Radiologi C.','2026-06-02','2026-06-03',2,'approved','OK','approved','OK','approved','2026-06-01 19:42:15','2026-06-01 19:43:53'),(3,'BRD/02','RS SIDOARJO','Instalasi ICU','VJNSJVNSIV','2026-06-12','2026-06-13',2,'approved','OK','approved','OK','approved','2026-06-12 03:42:11','2026-06-12 03:43:49');
/*!40000 ALTER TABLE `brds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `berita_acara_id` bigint(20) unsigned NOT NULL,
  `nomor_invoice` varchar(255) NOT NULL,
  `tanggal_invoice` date NOT NULL,
  `deadline_pembayaran` date DEFAULT NULL,
  `total_nominal` decimal(15,2) NOT NULL,
  `dp_masuk` decimal(15,2) NOT NULL DEFAULT 0.00,
  `sisa_pembayaran` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','lunas') NOT NULL DEFAULT 'pending',
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_berita_acara_id_foreign` (`berita_acara_id`),
  CONSTRAINT `invoices_berita_acara_id_foreign` FOREIGN KEY (`berita_acara_id`) REFERENCES `berita_acaras` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (1,1,'INVOICE/001/06/2006','2026-06-05','2026-06-06',50000000.00,20000000.00,30000000.00,'lunas','Invoice ini diajukan untuk pelunasan pekerjaan Instalasi Ruang ICU A yang meliputi pemasangan panel listrik, sistem jaringan medis, bed ICU, monitor pasien, ventilator, UPS, dan perangkat pendukung lainnya. Setelah pembayaran DP sebesar Rp20.000.000 diterima, tersisa pembayaran sebesar Rp30.000.000 yang harus dilunasi sesuai deadline pembayaran guna menyelesaikan administrasi proyek dan proses serah terima akhir.','2026-06-01 05:21:51','2026-06-01 05:58:11'),(3,3,'04/INVOIVCCE','2026-06-13','2026-06-19',20000000.00,10000000.00,10000000.00,'lunas','BJGBH','2026-06-12 03:46:03','2026-06-12 03:46:38');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2026_05_30_022717_add_role_to_users_table',1),(6,'2026_05_30_034552_create_brds_table',1),(7,'2026_05_30_034553_create_brd_files_table',1),(8,'2026_05_30_155724_add_tanggal_upload_deadline_to_brds_table',1),(9,'2026_05_31_120124_create_berita_acaras_table',1),(10,'2026_05_31_152452_add_deadline_status_notes_to_berita_acaras_table',1),(11,'2026_06_01_055543_add_client_to_brds_table',1),(12,'2026_06_01_110547_create_invoices_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('sales','engineering','finance') NOT NULL DEFAULT 'sales',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Nadia','nadiaeng@gmail.com',NULL,'$2y$12$sZ37B7vEX13W9hudSHTav.Aa5uNup8VrPyLjW2dq74j086ojtpGwq',NULL,'2026-06-01 04:51:55','2026-06-01 04:51:55','engineering'),(2,'shelvia','shelvias@gmail.com',NULL,'$2y$12$9LAf6W4LF78ge.xGrIR7muWMPcWzEkr3/riDWK73dk5LEYWROpjp2',NULL,'2026-06-01 04:52:54','2026-06-01 04:52:54','sales'),(3,'nafiisha','nafiishaf@gmail.com',NULL,'$2y$12$PXTpbNPhXrFj7/AKcd1icO6VAUS3hE/uVXeQ4kNeH.NuwxLLtq0fC',NULL,'2026-06-01 04:55:51','2026-06-01 04:55:51','finance');
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

-- Dump completed on 2026-06-12 18:49:19
