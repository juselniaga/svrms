-- MySQL dump 10.13  Distrib 8.4.6, for Win64 (x86_64)
--
-- Host: localhost    Database: svrms
-- ------------------------------------------------------
-- Server version	8.4.6

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applications` (
  `application_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `developer_id` bigint unsigned NOT NULL,
  `tajuk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_fail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'RECORDED',
  `officer_id` bigint unsigned DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`application_id`),
  UNIQUE KEY `applications_reference_no_unique` (`reference_no`),
  KEY `applications_developer_id_foreign` (`developer_id`),
  KEY `applications_officer_id_foreign` (`officer_id`),
  CONSTRAINT `applications_developer_id_foreign` FOREIGN KEY (`developer_id`) REFERENCES `developers` (`developer_id`),
  CONSTRAINT `applications_officer_id_foreign` FOREIGN KEY (`officer_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,'SVRMS-2026-0001',1,'Permohonan Cadangan Guna tanah bagi kerja-kerja membangunkan sebuah kilang.','LOT 24 Asahan Melaka','MPJ-JPB-35','FILED',6,1,'2026-03-10 15:42:03','2026-03-10 16:39:53'),(2,'SVRMS-2026-0002',2,'Permohonan membangunkan tapak pelupusan bahan kilang','Tanah lapang di dun ASAHAN','MPJ-JPB-23','REJECTED',2,1,'2026-03-10 16:45:23','2026-03-10 17:07:37'),(3,'SVRMS-2026-0003',3,'Permohonan Cadangan Guna tanah bagi kerja-kerja membangunkan project solor','LOT tanah 102 LOT BEMBAN','MPJ-JPB-35','REJECTED',6,1,'2026-03-10 17:19:26','2026-03-10 17:27:11'),(4,'SVRMS-2026-0004',4,'MEMBANGUNKAN PROJEK PEMBANGUNAN TIGA SERANGKAI','BT 34 56 JALAN DUTA DUN BEMBAN TIGA TIANG','MPJ-JPB-35-DUTA','APPROVED',2,1,'2026-04-21 00:03:33','2026-04-22 16:40:39'),(5,'SVRMS-2026-0005',5,'Permohonan Cadangan Guna tanah bagi kerja-kerja membangunkan sebuah kilang Batu dan Taman Permainan','DI bandar baru Asahan','MPJ-JPB-2921','FILED',2,1,'2026-04-22 18:22:04','2026-04-22 18:58:15');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvals`
--

DROP TABLE IF EXISTS `approvals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `approvals` (
  `approval_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `director_id` bigint unsigned NOT NULL,
  `decision` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conditions` text COLLATE utf8mb4_unicode_ci,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `approval_status` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`approval_id`),
  KEY `approvals_application_id_foreign` (`application_id`),
  KEY `approvals_director_id_foreign` (`director_id`),
  CONSTRAINT `approvals_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`),
  CONSTRAINT `approvals_director_id_foreign` FOREIGN KEY (`director_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvals`
--

LOCK TABLES `approvals` WRITE;
/*!40000 ALTER TABLE `approvals` DISABLE KEYS */;
INSERT INTO `approvals` VALUES (1,1,4,'SVRMS-2026-0001, approved by Hafidh Bin Sulaiman, 2026-03-11 and 00:16:46 approved.',NULL,'setuju untuk di bawa ke mesyuarat OSC','APPROVED','2026-03-10 16:16:46','2026-03-10 16:16:46','2026-03-10 16:16:46'),(2,3,4,'SVRMS-2026-0003, approved by Hafidh Bin Sulaiman, 2026-03-11 and 01:27:11 approved.',NULL,'Tidak sesuai di laksanakan mohon untu permohonan baru','REJECTED','2026-03-10 17:27:11','2026-03-10 17:27:11','2026-03-10 17:27:11'),(3,4,4,'SVRMS-2026-0004, approved by Hafidh Bin Sulaiman, 2026-04-23 and 00:40:39 approved.',NULL,'Setuju untuk dibawa ke mesyuarat OSC','APPROVED','2026-04-22 16:40:39','2026-04-22 16:40:39','2026-04-22 16:40:39'),(4,5,4,'SVRMS-2026-0005, approved by Hafidh Bin Sulaiman, 2026-04-23 and 02:39:26 approved.',NULL,'Setuju dan bawa ke mesyuarat OSC','APPROVED','2026-04-22 18:39:26','2026-04-22 18:39:26','2026-04-22 18:39:26');
/*!40000 ALTER TABLE `approvals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `previous_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `snapshot_old` json DEFAULT NULL,
  `snapshot_new` json DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_logs_application_id_foreign` (`application_id`),
  KEY `audit_logs_user_id_foreign` (`user_id`),
  CONSTRAINT `audit_logs_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`),
  CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_logs`
--

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;
INSERT INTO `audit_logs` VALUES (1,1,6,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-03-10 23:44:47','2026-03-10 15:44:47','2026-03-10 15:44:47'),(2,1,6,'SITE_INVESTIGATION_COMPLETED',NULL,NULL,NULL,NULL,'Location Data: 2.29489600, 102.41063500','2026-03-10 23:48:31','2026-03-10 15:48:31','2026-03-10 15:48:31'),(3,1,3,'VERIFICATION_VERIFIED',NULL,NULL,NULL,NULL,'Penelitian mendapati sesuai untuk di cadangkan sebuah kilang untuk dibangunkan.','2026-03-10 23:51:56','2026-03-10 15:51:56','2026-03-10 15:51:56'),(4,1,4,'APPROVAL_APPROVED',NULL,NULL,NULL,NULL,'setuju untuk di bawa ke mesyuarat OSC','2026-03-11 00:16:46','2026-03-10 16:16:46','2026-03-10 16:16:46'),(5,1,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-03-11T00:16:46.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-03-11 00:39:53\\\"}\"','Application Dossier completely compiled and FILED by Clerk Nadia.','2026-03-11 00:39:53','2026-03-10 16:39:53','2026-03-10 16:39:53'),(6,2,2,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-03-11 00:56:39','2026-03-10 16:56:39','2026-03-10 16:56:39'),(7,2,2,'SITE_INVESTIGATION_COMPLETED',NULL,NULL,NULL,NULL,'Location Data: 2.29489600, 102.41063500','2026-03-11 00:58:43','2026-03-10 16:58:43','2026-03-10 16:58:43'),(8,2,3,'VERIFICATION_REJECTED',NULL,NULL,NULL,NULL,'Setuju dengan cadangan pegawai penyiasat didapati terdapat masalah pada lokasi yang dipohon','2026-03-11 01:07:37','2026-03-10 17:07:37','2026-03-10 17:07:37'),(9,3,6,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-03-11 01:20:48','2026-03-10 17:20:48','2026-03-10 17:20:48'),(10,3,6,'SITE_INVESTIGATION_COMPLETED',NULL,NULL,NULL,NULL,'Location Data: 2.29489600, 102.41063500','2026-03-11 01:23:45','2026-03-10 17:23:45','2026-03-10 17:23:45'),(11,3,3,'VERIFICATION_VERIFIED',NULL,NULL,NULL,NULL,'semakan telah dibuat dan dirujuk untuk pengesahan','2026-03-11 01:26:17','2026-03-10 17:26:17','2026-03-10 17:26:17'),(12,3,4,'APPROVAL_REJECTED',NULL,NULL,NULL,NULL,'Tidak sesuai di laksanakan mohon untu permohonan baru','2026-03-11 01:27:11','2026-03-10 17:27:11','2026-03-10 17:27:11'),(13,4,2,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-04-22 08:26:59','2026-04-22 00:26:59','2026-04-22 00:26:59'),(14,4,2,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-04-22 08:29:17','2026-04-22 00:29:17','2026-04-22 00:29:17'),(15,4,2,'SITE_INVESTIGATION_COMPLETED',NULL,NULL,NULL,NULL,'Location Data: 2.29490000, 102.41063400','2026-04-23 00:10:00','2026-04-22 16:10:00','2026-04-22 16:10:00'),(16,4,3,'VERIFICATION_VERIFIED',NULL,NULL,NULL,NULL,'Disokong untuk pemeriksaan sistem','2026-04-23 00:28:52','2026-04-22 16:28:52','2026-04-22 16:28:52'),(17,4,4,'APPROVAL_APPROVED',NULL,NULL,NULL,NULL,'Setuju untuk dibawa ke mesyuarat OSC','2026-04-23 00:40:39','2026-04-22 16:40:39','2026-04-22 16:40:39'),(18,5,2,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-04-23 02:25:47','2026-04-22 18:25:47','2026-04-22 18:25:47'),(19,5,2,'SITE_INVESTIGATION_COMPLETED',NULL,NULL,NULL,NULL,'Location Data: 2.29490000, 102.41063400','2026-04-23 02:27:31','2026-04-22 18:27:31','2026-04-22 18:27:31'),(20,5,3,'VERIFICATION_VERIFIED',NULL,NULL,NULL,NULL,'Setuju untuk di beri tanggung jawab dan kita perlu berusaha untuk menjayakan projek ini hahahah','2026-04-23 02:29:50','2026-04-22 18:29:50','2026-04-22 18:29:50'),(21,5,4,'APPROVAL_APPROVED',NULL,NULL,NULL,NULL,'Setuju dan bawa ke mesyuarat OSC','2026-04-23 02:39:26','2026-04-22 18:39:26','2026-04-22 18:39:26'),(22,5,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-04-23T02:39:26.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-04-23 02:58:15\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-04-23 02:58:15','2026-04-22 18:58:15','2026-04-22 18:58:15');
/*!40000 ALTER TABLE `audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravel-cache-admin@mpjasin.gov.my|127.0.0.1','i:1;',1776758386),('laravel-cache-admin@mpjasin.gov.my|127.0.0.1:timer','i:1776758386;',1776758386),('laravel-cache-clerk@svrms.gov|127.0.0.1','i:2;',1775099901),('laravel-cache-clerk@svrms.gov|127.0.0.1:timer','i:1775099901;',1775099901);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
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
-- Table structure for table `developers`
--

DROP TABLE IF EXISTS `developers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `developers` (
  `developer_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poskod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`developer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `developers`
--

LOCK TABLES `developers` WRITE;
/*!40000 ALTER TABLE `developers` DISABLE KEYS */;
INSERT INTO `developers` VALUES (1,'bumi berkat','Jalan Melaka tinggal',NULL,'75214','Durian Tunggal','Melaka','bumi@berkat.com',NULL,'04589657','2026-03-10 15:41:29','2026-03-10 15:41:29'),(2,'world Jaya Sdn Bhd','Putera jaya',NULL,'90001','putrajaya','putraya','world@jaya.com',NULL,'01547859','2026-03-10 16:43:22','2026-03-10 16:43:22'),(3,'bumi utara bhd','Bangunan industri cheras',NULL,'90987','cheras','selangor','bumi@utara.com',NULL,'102548547','2026-03-10 17:17:52','2026-03-10 17:17:52'),(4,'UJANG KASIH SDN.BHD','Batu54 Jalan pertam',NULL,'8899887','pertama','selangor','ujang@kasih.com',NULL,'01254587','2026-04-21 00:02:45','2026-04-21 00:02:45'),(5,'Siang Jaya SDN BHD','JALAN Tengara 1',NULL,'1234567','Tengara','Johor','siang@jaya.com',NULL,'012458745452','2026-04-22 18:21:34','2026-04-22 18:21:34');
/*!40000 ALTER TABLE `developers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_03_04_015142_create_developers_table',2),(5,'2026_03_04_015143_create_applications_table',2),(6,'2026_03_04_015143_create_sites_table',2),(7,'2026_03_04_015144_create_reviews_table',2),(8,'2026_03_04_015144_create_site_visits_table',2),(9,'2026_03_04_015144_create_verifications_table',2),(10,'2026_03_04_015145_create_approvals_table',2),(11,'2026_03_04_015145_create_audit_logs_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `review_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `officer_id` bigint unsigned NOT NULL,
  `review_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `recommendation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `self_check_completed` tinyint(1) NOT NULL DEFAULT '0',
  `submitted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  KEY `reviews_application_id_foreign` (`application_id`),
  KEY `reviews_officer_id_foreign` (`officer_id`),
  CONSTRAINT `reviews_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`),
  CONSTRAINT `reviews_officer_id_foreign` FOREIGN KEY (`officer_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,4,2,'Semakan mendapati terdapat kawasan lapang yang telah semak samun dan memerlukan perhatian segera.','SUPPORTED',1,'2026-04-22 16:16:01','2026-04-22 16:16:01','2026-04-22 16:16:01'),(2,5,2,'Semakan kawasan dan siastan di lokasi telah dijalankan. didapati kawasan terbiar dan boleh dibangunkan.','SUPPORTED',1,'2026-04-22 18:28:17','2026-04-22 18:28:17','2026-04-22 18:28:17');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
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
INSERT INTO `sessions` VALUES ('LZV7ywFt2lmmBX1yWYCeZs8kofcIYdqLIzk2evCM',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZmUyWW9MRjNKczRWWVFyd0dBd0JlZU1xZlE1SXBQUExKUHhuc0xTQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9maWxpbmdzLzUiO3M6NToicm91dGUiO3M6MTI6ImZpbGluZ3Muc2hvdyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1776913096);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_visits`
--

DROP TABLE IF EXISTS `site_visits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_visits` (
  `site_visit_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `officer_id` bigint unsigned NOT NULL,
  `visit_date` date NOT NULL,
  `finding_north` text COLLATE utf8mb4_unicode_ci,
  `photos_north` json DEFAULT NULL,
  `findings_south` text COLLATE utf8mb4_unicode_ci,
  `photos_south` json DEFAULT NULL,
  `findings_east` text COLLATE utf8mb4_unicode_ci,
  `photo_east` json DEFAULT NULL,
  `finding_west` text COLLATE utf8mb4_unicode_ci,
  `photo_west` json DEFAULT NULL,
  `attachments` json DEFAULT NULL,
  `activity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facility` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entrance_way` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tree` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topography` text COLLATE utf8mb4_unicode_ci,
  `land_use_zone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `density` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recommend_road` tinyint(1) NOT NULL DEFAULT '0',
  `parking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anjakan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_facility` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_data` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`site_visit_id`),
  KEY `site_visits_application_id_foreign` (`application_id`),
  KEY `site_visits_officer_id_foreign` (`officer_id`),
  CONSTRAINT `site_visits_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`),
  CONSTRAINT `site_visits_officer_id_foreign` FOREIGN KEY (`officer_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_visits`
--

LOCK TABLES `site_visits` WRITE;
/*!40000 ALTER TABLE `site_visits` DISABLE KEYS */;
INSERT INTO `site_visits` VALUES (1,4,2,'2026-04-22','Semak','[\"photos/FePWivN5i06c8bCaI1ENUDjNjo2MrX5Ao7ngGVqx.png\"]','semak','[\"photos/HmrhvcqEfS51NoDKwYdtb7owkX2YwlMpPbqOrL8k.png\"]','semak','[\"photos/TmykUjmdz9be8BCSXgvrcMBqWoRmMdiQrIrgj9Fj.png\"]','Semak','[\"photos/CEvX6vxKjBx54wmX3FDX2x0MvF3uVvCsASQWkdl6.png\"]',NULL,'kawasan lapang kawasan baru','tiada','Tiada','tiada','semak','berbukit','Pertanian','10 keluarga',1,NULL,'tiada','tiada kawasan hutan','2.29490000, 102.41063400','COMPLETED','2026-04-22 16:10:00','2026-04-22 16:10:00'),(2,5,2,'2026-04-23','Semak Samun','[\"photos/DKwoXsgwwqkxaIgoeqxBq4BCu3QmVLelwcBPxLTz.png\"]','Semak Samun banyak pokok kelapa','[\"photos/vTmj8cmbpacAarHTcRah8xy1kscYAdRZQnBKLZON.png\"]','Semak samun juga hahaha','[\"photos/AEHr5K3QqiC5G6DddCiYamBq74VOGDz01tvchfHa.png\"]','Ini lagi teruk semak dia tak boleh bawa bincang punya.','[\"photos/8yCP0Uu5L5bkAEv4bcIITWMo1cig5PKK26PHalI2.png\"]',NULL,'kawasan lapang kawasan baru','terdapat longkang tanah.','Tiada','longkang tanah','semak','berbukit','Pertanian','20 orang',0,NULL,'tiada','tiada','2.29490000, 102.41063400','COMPLETED','2026-04-22 18:27:31','2026-04-22 18:27:31');
/*!40000 ALTER TABLE `site_visits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sites`
--

DROP TABLE IF EXISTS `sites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sites` (
  `site_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `mukim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bpk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `luas` decimal(10,4) NOT NULL,
  `google_lat` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_long` decimal(11,8) DEFAULT NULL,
  `map` json DEFAULT NULL,
  `lot` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lembaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_tanah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_tanah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`site_id`),
  KEY `sites_application_id_foreign` (`application_id`),
  CONSTRAINT `sites_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sites`
--

LOCK TABLES `sites` WRITE;
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;
INSERT INTO `sites` VALUES (1,4,'ASAHAN','101',25.0000,'2.146451,102.426097',NULL,NULL,'1025','1123','Pertanian','Freehold','REGISTERED',1,'2026-04-22 00:26:59','2026-04-22 00:26:59'),(2,4,'ASAHAN','101',25.0000,'2.146451,102.426097',NULL,NULL,'1025','1123','Pertanian','Freehold','REGISTERED',1,'2026-04-22 00:29:17','2026-04-22 00:29:17'),(3,5,'ASAHAN','212',25.0000,'2.392945,102.544231',NULL,NULL,'88','125','Pertanian','Free Hold','REGISTERED',1,'2026-04-22 18:25:47','2026-04-22 18:25:47');
/*!40000 ALTER TABLE `sites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Developer',
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'nadia','nadia@mpjasin.gov.my','2026-03-18 21:09:02','$2y$12$AYBg1yphLw15udkLTsD.IewAAbAPGVQF1Rcjdoc2QAg6JFtrlOyWW','Clerk','Registration',1,'NlqF7GBktA50uE26g89VhfGPGKzpTdpLtRwACy27azGyEfz9tOCA8jZ1yD1L','2026-03-18 21:09:02','2026-04-01 19:18:56'),(2,'Nazrin Almanzo','nazrin@mpjasin.gov.my','2026-03-18 21:09:02','$2y$12$8JdtitlI5Bt5tVCzpvej/OMOOoplmgYxzGa2uIQOYUpltdb.2YNRm','Officer','Site Operations',1,'bJbEsV6JJlCzPF1j8YTfl4Bw3MaxqXdhoVFuVjr4XHl5hjKxZdzb1dMSntuC','2026-03-18 21:09:02','2026-03-18 21:20:42'),(3,'Ashraf','ad@mpjasin.gov.my','2026-03-18 21:09:02','$2y$12$2AgDrrapEOiq5eYC/M1owe5wD.3Q7mTc340H1UBuI997NTiLChQmC','Assistant Director','Administration',1,'IHZByOhMHkvJWiVf8gx7UvbtwnHguxYB6J7zF9UHqlT5I6E3fZtwL5zCrZaU','2026-03-18 21:09:02','2026-03-18 21:19:07'),(4,'Hafidh Bin Sulaiman','hafidh@mpjasin.gov.my','2026-03-18 21:09:02','$2y$12$2pNnLctcm.b8Hle7jGEg7.P9Jbf43/B8k/p5tmH.tt8PlEqrygih.','Director','Management',1,'zwQTzhDLJCh53GEWE2a5O5EhD1zAo1awG8q7GB37S5S1T1vbudlE1CqokztD','2026-03-18 21:09:02','2026-03-18 21:19:42'),(5,'System Administrator','admin@svrms.local','2026-03-18 21:09:02','$2y$12$3aMJcyc38RcV4VGinbMX9eqgx/u7fkKq9QFZTnDgpAOaXm.BTm0R6','Admin','IT Services',1,'WGkiPzseVmAlv0HB3fa4i5WQoOI9mxqrXUuflf0j8zYske8zttOrP6JpSyFo','2026-03-18 21:09:02','2026-03-18 21:09:02'),(6,'kharudin','din@mpjasin.gov.my',NULL,'$2y$12$DFqfHCXF6bQLcovajRa8m.9rMdrcbpyNBSFRFng9BWqjYLfMgu.qe','Officer','JPBD',1,NULL,'2026-03-18 21:21:27','2026-03-18 21:21:27'),(7,'zamzul','zam@mpjasin.gov.my',NULL,'$2y$12$WCltEoB94yKGWsjMFLf8O.YcvOOVNUs.wUwi90tj1CJcx.ut.fzZK','Admin','IT Services',1,NULL,'2026-03-18 21:21:57','2026-03-18 21:21:57');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verifications`
--

DROP TABLE IF EXISTS `verifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `verifications` (
  `verify_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `assistant_director_id` bigint unsigned NOT NULL,
  `verification_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`verify_id`),
  KEY `verifications_application_id_foreign` (`application_id`),
  KEY `verifications_assistant_director_id_foreign` (`assistant_director_id`),
  CONSTRAINT `verifications_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`),
  CONSTRAINT `verifications_assistant_director_id_foreign` FOREIGN KEY (`assistant_director_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verifications`
--

LOCK TABLES `verifications` WRITE;
/*!40000 ALTER TABLE `verifications` DISABLE KEYS */;
INSERT INTO `verifications` VALUES (1,4,3,'VERIFIED','Disokong untuk pemeriksaan sistem','2026-04-22 16:28:52','2026-04-22 16:28:52','2026-04-22 16:28:52'),(2,5,3,'VERIFIED','Setuju untuk di beri tanggung jawab dan kita perlu berusaha untuk menjayakan projek ini hahahah','2026-04-22 18:29:50','2026-04-22 18:29:50','2026-04-22 18:29:50');
/*!40000 ALTER TABLE `verifications` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-23 14:47:35
