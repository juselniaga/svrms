-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: svrms
-- ------------------------------------------------------
-- Server version	8.4.3

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
  `reference_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `developer_id` bigint unsigned NOT NULL,
  `tajuk` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_fail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'RECORDED',
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (10,'SVRMS-2026-0001',4,'Permohonan Cadangan Guna tanah bagi kerja-kerja membangunkan project solor','Tapak pelepasan roket Asahan','MPJ-JPB-2921','APPROVED',2,1,'2026-05-03 15:37:11','2026-05-28 16:20:04'),(11,'SVRMS-2026-0002',7,'Pemohonan untuk mendapatkan tanah bagi kerja perlombongan','Tapak Lombong arang batu RIM','MPJ-JPB-2921','APPROVED',2,1,'2026-05-03 17:41:09','2026-05-29 06:54:13'),(12,'SVRMS-2026-0003',9,'Pemohonan untuk mendapatkan tanah bagi kerja perlombongan EMAS dan arang batu','Bukit Asahan','MPJ-JPB-35','SITE_VISIT_IN_PROGRESS',2,1,'2026-05-14 20:59:43','2026-05-31 02:03:06'),(13,'SVRMS-2026-0004',3,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempor felis sed velit fringilla pharetra. Sed id dignissim eros. Curabitur.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non eros non urna iaculis tempor ut bibendum urna. In blandit felis ac mi aliquet, sed ornare libero euismod. Vivamus eu velit nec purus blandit eleifend. Nullam sit amet pretium augue, quis maximus nisl. Curabitur eros augue, placerat sit amet ligula.','MPJ-JPB-35','FILED',2,1,'2026-05-18 05:16:27','2026-05-28 16:21:55'),(14,'SVRMS-2026-0005',4,'Permohonan Cadangan Guna tanah bagi kerja-kerja membangunkan project solor','Mukin Kesang','MPJ-JPB-2921','PENDING_APPROVAL',2,1,'2026-05-28 19:14:46','2026-05-28 19:40:58'),(15,'SVRMS-2026-0006',1,'Pemohonan untuk memiliki Tanah kerajaan secara lesen pendudukan sementara(LPS) di atas lot 7 seluas 297.7477 hektar','01','PDTJ.600-2/6/133(9)','SITE_VISIT_IN_PROGRESS',2,1,'2026-05-29 19:57:54','2026-05-30 06:05:52'),(16,'SVRMS-2026-0007',8,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ipsum nulla, rutrum quis commodo nec, fringilla sit amet odio. Donec vel porttitor velit. Integer vel pretium neque. Fusce eu magna in velit finibus pulvinar. Maecenas felis justo, pharetra in libero ut, feugiat commodo nulla. Ut a neque felis. Vivamus sed.','08','MPJ-JPB-34','PENDING_APPROVAL',2,1,'2026-05-30 14:58:45','2026-05-30 19:18:43'),(17,'SVRMS-2026-0008',8,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac elit vel est vestibulum ultrices in eget urna. Maecenas sed diam libero. Aliquam ultricies faucibus lectus ut pharetra. Sed finibus a ipsum ac scelerisque. Quisque finibus, dolor in egestas pharetra, arcu erat tincidunt tellus, ac efficitur mi odio pulvinar dui. Integer dignissim fringilla nibh, non suscipit leo pulvinar vitae.','08','PDTJ.600-2/6/133(9)','APPROVED',2,1,'2026-05-30 18:14:19','2026-05-30 18:28:49');
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
  `decision` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `conditions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remarks_history` json DEFAULT NULL,
  `approval_status` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`approval_id`),
  KEY `approvals_application_id_foreign` (`application_id`),
  KEY `approvals_director_id_foreign` (`director_id`),
  CONSTRAINT `approvals_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`),
  CONSTRAINT `approvals_director_id_foreign` FOREIGN KEY (`director_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvals`
--

LOCK TABLES `approvals` WRITE;
/*!40000 ALTER TABLE `approvals` DISABLE KEYS */;
INSERT INTO `approvals` VALUES (5,13,4,'SVRMS-2026-0004, approved by Hafidh Bin Sulaiman, 2026-05-28 and 22:12:48 approved.',NULL,'Lulus',NULL,'APPROVED','2026-05-28 14:12:48','2026-05-28 14:12:48','2026-05-28 14:12:48'),(6,10,4,'SVRMS-2026-0001, approved by Hafidh Bin Sulaiman, 2026-05-28 and 23:15:02 approved.',NULL,'Lulus',NULL,'APPROVED','2026-05-28 15:15:02','2026-05-28 15:15:02','2026-05-28 15:15:02'),(7,11,4,'SVRMS-2026-0002, approved by Hafidh Bin Sulaiman, 2026-05-29 and 14:54:13 APPROVED.',NULL,'sediakan surat kelulusan','[{\"text\": \"Tapak terletak di zon gunatanah pertanian; BPK 3.4: Seri Kesang berdasarkan Rancangan Tempatan Majlid Perbandaran Jasin 2035\", \"user_id\": 4, \"user_name\": \"Hafidh Bin Sulaiman\", \"created_at\": \"29 May 2026, 14:54 PM\", \"updated_at\": \"29 May 2026, 14:54 PM\"}]','APPROVED','2026-05-29 06:54:13','2026-05-29 06:54:13','2026-05-29 06:54:13'),(8,17,4,'SVRMS-2026-0008, approved by Hafidh Bin Sulaiman, 2026-05-31 and 02:28:49 APPROVED.',NULL,'Sila Keluarkan surat kelulusan','[{\"text\": \"Tapak Terletak di zon guna tanah pertanian: BPK 3.4: Seri Kesang Berdasarkan Rancangan Tempatan Majlis Perbandaran Jasin 2035\", \"user_id\": 4, \"user_name\": \"Hafidh Bin Sulaiman\", \"created_at\": \"31 May 2026, 02:28 AM\", \"updated_at\": \"31 May 2026, 02:28 AM\"}, {\"text\": \"Aktiviti yang di pohon merupakan aktiviti yang dibenarkan.\", \"user_id\": 4, \"user_name\": \"Hafidh Bin Sulaiman\", \"created_at\": \"31 May 2026, 02:28 AM\", \"updated_at\": \"31 May 2026, 02:28 AM\"}, {\"text\": \"Pada pandangan MPNJ, dari segi saiz dan kedudukan tanah sesuai dimohon oleh agensi kerajaan.\", \"user_id\": 4, \"user_name\": \"Hafidh Bin Sulaiman\", \"created_at\": \"31 May 2026, 02:28 AM\", \"updated_at\": \"31 May 2026, 02:28 AM\"}, {\"text\": \"Sebarang Binaan dan kerja tanah perlu kelulusan MPJ terlebih dahulu\", \"user_id\": 4, \"user_name\": \"Hafidh Bin Sulaiman\", \"created_at\": \"31 May 2026, 02:28 AM\", \"updated_at\": \"31 May 2026, 02:28 AM\"}, {\"text\": \"Mematuhi ulasan dan syarat teknikal jabatan lain\", \"user_id\": 4, \"user_name\": \"Hafidh Bin Sulaiman\", \"created_at\": \"31 May 2026, 02:28 AM\", \"updated_at\": \"31 May 2026, 02:28 AM\"}]','APPROVED','2026-05-30 18:28:49','2026-05-30 18:28:49','2026-05-30 18:28:49');
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
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `previous_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `snapshot_old` json DEFAULT NULL,
  `snapshot_new` json DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_logs_application_id_foreign` (`application_id`),
  KEY `audit_logs_user_id_foreign` (`user_id`),
  CONSTRAINT `audit_logs_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`),
  CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_logs`
--

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;
INSERT INTO `audit_logs` VALUES (28,10,2,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-05-03 23:39:04','2026-05-03 15:39:04','2026-05-03 15:39:04'),(29,10,2,'SITE_INVESTIGATION_COMPLETED',NULL,NULL,NULL,NULL,'Officer formally submitted Site Investigation. Location Data: 5.42860000, 100.37900000','2026-05-03 23:40:28','2026-05-03 15:40:28','2026-05-03 15:40:28'),(30,13,2,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-05-18 13:19:10','2026-05-18 05:19:10','2026-05-18 05:19:10'),(31,13,2,'SITE_INVESTIGATION_COMPLETED',NULL,NULL,NULL,NULL,'Officer formally submitted Site Investigation. Location Data: 5.33380000, 100.26580000','2026-05-28 22:03:23','2026-05-28 14:03:23','2026-05-28 14:03:23'),(32,13,3,'VERIFICATION_VERIFIED',NULL,NULL,NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fermentum dolor a dolor ultrices vulputate. Proin quis nunc sem. Aliquam aliquet metus odio, et semper nulla varius non. Vestibulum hendrerit elit id augue mollis, sit amet ultrices tortor venenatis. Mauris molestie lacus tellus, et aliquam nulla bibendum vel. Praesent vestibulum dignissim turpis, quis egestas arcu tempor non. Mauris finibus felis vitae leo tempor condimentum. Ut vehicula mollis neque nec dictum. Mauris ligula purus, consectetur in ullamcorper ac, fringilla fringilla metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nunc volutpat elit in libero tincidunt pharetra.','2026-05-28 22:09:03','2026-05-28 14:09:03','2026-05-28 14:09:03'),(33,13,4,'APPROVAL_APPROVED',NULL,NULL,NULL,NULL,'Lulus','2026-05-28 22:12:48','2026-05-28 14:12:48','2026-05-28 14:12:48'),(34,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-28T22:12:48.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-28 22:47:17\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-28 22:47:17','2026-05-28 14:47:17','2026-05-28 14:47:17'),(35,10,3,'VERIFICATION_VERIFIED',NULL,NULL,NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at sollicitudin ex, sagittis vulputate eros. Quisque ac enim in purus efficitur cursus. Aenean scelerisque suscipit ligula. Maecenas ut tellus vitae tortor interdum viverra. Maecenas volutpat magna nec dolor elementum, id pharetra justo rutrum. Pellentesque sed nisi sodales, ultricies eros sit.','2026-05-28 23:14:20','2026-05-28 15:14:20','2026-05-28 15:14:20'),(36,10,4,'APPROVAL_APPROVED',NULL,NULL,NULL,NULL,'Lulus','2026-05-28 23:15:02','2026-05-28 15:15:02','2026-05-28 15:15:02'),(37,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-28T22:47:17.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-28 23:16:18\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-28 23:16:18','2026-05-28 15:16:18','2026-05-28 15:16:18'),(38,10,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-28T23:15:02.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-28 23:18:38\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-28 23:18:38','2026-05-28 15:18:38','2026-05-28 15:18:38'),(39,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-28T23:16:18.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-28 23:28:02\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-28 23:28:02','2026-05-28 15:28:02','2026-05-28 15:28:02'),(40,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-28T23:28:02.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-28 23:30:23\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-28 23:30:23','2026-05-28 15:30:23','2026-05-28 15:30:23'),(41,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-28T23:30:23.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-29 00:01:18\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-29 00:01:18','2026-05-28 16:01:18','2026-05-28 16:01:18'),(42,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-29T00:01:18.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-29 00:09:34\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-29 00:09:34','2026-05-28 16:09:34','2026-05-28 16:09:34'),(43,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-29T00:09:34.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-29 00:13:16\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-29 00:13:16','2026-05-28 16:13:16','2026-05-28 16:13:16'),(44,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-29T00:13:16.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-29 00:14:42\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-29 00:14:42','2026-05-28 16:14:42','2026-05-28 16:14:42'),(45,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-29T00:14:42.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-29 00:17:00\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-29 00:17:00','2026-05-28 16:17:00','2026-05-28 16:17:00'),(46,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-29T00:17:00.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-29 00:18:53\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-29 00:18:53','2026-05-28 16:18:53','2026-05-28 16:18:53'),(47,10,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-28T23:18:38.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-29 00:20:04\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-29 00:20:04','2026-05-28 16:20:04','2026-05-28 16:20:04'),(48,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-29T00:18:53.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-29 00:21:55\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-29 00:21:55','2026-05-28 16:21:55','2026-05-28 16:21:55'),(49,11,3,'VERIFICATION_VERIFIED',NULL,NULL,NULL,NULL,'Tapak terletak di zon gunatanah pertanian; BPK 3.4: Seri Kesang berdasarkan Rancangan Tempatan Majlid Perbandaran Jasin 2035','2026-05-29 03:02:34','2026-05-28 19:02:34','2026-05-28 19:02:34'),(50,14,2,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-05-29 03:15:58','2026-05-28 19:15:58','2026-05-28 19:15:58'),(51,14,2,'SITE_INVESTIGATION_COMPLETED',NULL,NULL,NULL,NULL,'Officer formally submitted Site Investigation. Location Data: 5.33380000, 100.26580000','2026-05-29 03:17:38','2026-05-28 19:17:38','2026-05-28 19:17:38'),(52,14,3,'VERIFICATION_VERIFIED',NULL,NULL,NULL,NULL,'Terletak di zon tanah pertanian; BPK 3.4; Seri Kesang berdasarkan Rancangan Tempatan MPJ 2035; Aktiviti yang dipohon merupakan aktiviti yang dibenarkan.','2026-05-29 03:40:17','2026-05-28 19:40:17','2026-05-28 19:40:17'),(53,14,3,'SUBMITTED_TO_APPROVAL',NULL,NULL,NULL,NULL,'Application forwarded to approval stage.','2026-05-29 03:40:58','2026-05-28 19:40:58','2026-05-28 19:40:58'),(54,11,4,'APPROVAL_APPROVED',NULL,NULL,NULL,NULL,'sediakan surat kelulusan','2026-05-29 14:54:13','2026-05-29 06:54:13','2026-05-29 06:54:13'),(55,15,2,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-05-30 11:02:00','2026-05-30 03:02:00','2026-05-30 03:02:00'),(56,15,2,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-05-30 11:13:15','2026-05-30 03:13:15','2026-05-30 03:13:15'),(57,15,2,'SITE_INVESTIGATION_COMPLETED',NULL,NULL,NULL,NULL,'Officer formally submitted Site Investigation. Location Data: 5.33380000, 100.26580000','2026-05-30 14:05:52','2026-05-30 06:05:52','2026-05-30 06:05:52'),(58,16,2,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-05-30 23:01:01','2026-05-30 15:01:01','2026-05-30 15:01:01'),(59,16,2,'SITE_INVESTIGATION_COMPLETED',NULL,NULL,NULL,NULL,'Officer formally submitted Site Investigation. Location Data: 5.33380000, 100.26580000','2026-05-30 23:03:16','2026-05-30 15:03:16','2026-05-30 15:03:16'),(60,17,2,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-05-31 02:16:15','2026-05-30 18:16:15','2026-05-30 18:16:15'),(61,17,2,'SITE_INVESTIGATION_COMPLETED',NULL,NULL,NULL,NULL,'Officer formally submitted Site Investigation. Location Data: 5.33380000, 100.26580000','2026-05-31 02:18:30','2026-05-30 18:18:30','2026-05-30 18:18:30'),(62,17,3,'VERIFICATION_VERIFIED',NULL,NULL,NULL,NULL,'Tapak Terletak di zon guna tanah pertanian: BPK 3.4: Seri Kesang Berdasarkan Rancangan Tempatan Majlis Perbandaran Jasin 2035; Aktiviti yang di pohon merupakan aktiviti yang dibenarkan.','2026-05-31 02:22:44','2026-05-30 18:22:44','2026-05-30 18:22:44'),(63,17,3,'SUBMITTED_TO_APPROVAL',NULL,NULL,NULL,NULL,'Application forwarded to approval stage.','2026-05-31 02:22:58','2026-05-30 18:22:58','2026-05-30 18:22:58'),(64,17,4,'APPROVAL_APPROVED',NULL,NULL,NULL,NULL,'Sila Keluarkan surat kelulusan','2026-05-31 02:28:49','2026-05-30 18:28:49','2026-05-30 18:28:49'),(65,16,3,'VERIFICATION_VERIFIED',NULL,NULL,NULL,NULL,'Maecenas sed nisi aliquet, consectetur justo nec, sagittis nunc.; Aliquam vitae nisi in ipsum condimentum convallis ac vel odio.','2026-05-31 03:18:35','2026-05-30 19:18:35','2026-05-30 19:18:35'),(66,16,3,'SUBMITTED_TO_APPROVAL',NULL,NULL,NULL,NULL,'Application forwarded to approval stage.','2026-05-31 03:18:43','2026-05-30 19:18:43','2026-05-30 19:18:43'),(67,12,2,'SITE_INVESTIGATION_COMPLETED',NULL,NULL,NULL,NULL,'Officer formally submitted Site Investigation. Location Data: 5.33380000, 100.26580000','2026-05-31 10:03:06','2026-05-31 02:03:06','2026-05-31 02:03:06');
/*!40000 ALTER TABLE `audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `b_p_k_s`
--

DROP TABLE IF EXISTS `b_p_k_s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `b_p_k_s` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bp_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bpk_short` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bpk_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `b_p_k_s_bp_id_foreign` (`bp_id`),
  CONSTRAINT `b_p_k_s_bp_id_foreign` FOREIGN KEY (`bp_id`) REFERENCES `b_p_s` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `b_p_k_s`
--

LOCK TABLES `b_p_k_s` WRITE;
/*!40000 ALTER TABLE `b_p_k_s` DISABLE KEYS */;
INSERT INTO `b_p_k_s` VALUES ('BP 4.2','BP4','Pekan Serkam','Pekan Serkam',1,NULL,NULL),('BPK1.1','BP1','Pekan Selandar','Pekan Selandar',1,NULL,NULL),('BPK1.10','BP1','Ladang Bukit Asahan','Ladang Bukit Asahan',1,NULL,NULL),('BPK1.11','BP1','Empangan Jus','Empangan Jus',1,NULL,NULL),('BPK1.12','BP1','HSK Bukit Sedanan','HSK Bukit Sedanan',1,NULL,NULL),('BPK1.13','BP1','HSK Bukit Senggeh','HSK Bukit Senggeh',1,NULL,NULL),('BPK1.14','BP1','HSK Batang Melaka','HSK Batang Melaka',1,NULL,NULL),('BPK1.2','BP1','Pekan Batang Melaka','Pekan Batang Melaka',1,NULL,NULL),('BPK1.3','BP1','Pekan Nyalas','Pekan Nyalas',1,NULL,NULL),('BPK1.4','BP1','Pekan Asahan','Pekan Asahan',1,NULL,NULL),('BPK1.5','BP1','Laman Tiga Budaya','Laman Tiga Budaya',1,NULL,NULL),('BPK1.6','BP1','Kg. Baru Bukit Sedanan','Kg. Baru Bukit Sedanan',1,NULL,NULL),('BPK1.7','BP1','Kg. Batang Melaka Baru','Kg. Batang Melaka Baru',1,NULL,NULL),('BPK1.8','BP1','Lembah Selandar','Lembah Selandar',1,NULL,NULL),('BPK1.9','BP1','Lembah Senggeh','Lembah Senggeh',1,NULL,NULL),('BPK2.1','BP2','Bandar Jasin','Bandar Jasin',1,NULL,NULL),('BPK2.2','BP2','Bandar Jasin Selatan','Bandar Jasin Selatan',1,NULL,NULL),('BPK2.3','BP2','Jasin Bestari','Jasin Bestari',1,NULL,NULL),('BPK2.4','BP2','Pekan Kesang Pajak','Pekan Kesang Pajak',1,NULL,NULL),('BPK2.5','BP2','Bemban Utara','Bemban Utara',1,NULL,NULL),('BPK2.6','BP2','Desa Kesang','Desa Kesang',1,NULL,NULL),('BPK3.1','BP3','Bandar Jasin Utara','Bandar Jasin Utara',1,NULL,NULL),('BPK3.2','BP3','Pekan Simpang Bekoh','Pekan Simpang Bekoh',1,NULL,NULL),('BPK3.3','BP3','Pekan Chin-Chin','Pekan Chin-Chin',1,NULL,NULL),('BPK3.4','BP3','Seri Kesang','Seri Kesang',1,NULL,NULL),('BPK3.5','BP3','Jasin-Chenderah','Jasin-Chenderah',1,NULL,NULL),('BPK3.6','BP3','Parit Keliling','Parit Keliling',1,NULL,NULL),('BPK3.7','BP3','Simpang Kerayong','Simpang Kerayong',1,NULL,NULL),('BPK3.8','BP3','Ladang Kempas','Ladang Kempas',1,NULL,NULL),('BPK3.9','BP3','Tasik Chin Chin','Tasik Chin Chin',1,NULL,NULL),('BPK4.1','BP4','Pekan Umbai','Pekan Umbai',1,NULL,NULL),('BPK4.3','BP4','Pantai Siring','Pantai Siring',1,NULL,NULL),('BPK4.4','BP4','Melaka Halal Hub','Melaka Halal Hub',1,NULL,NULL),('BPK4.5','BP4','Bukit Tembakau','Bukit Tembakau',1,NULL,NULL),('BPK4.6','BP4','Serkam Darat','Serkam Darat',1,NULL,NULL),('BPK4.7','BP4','Ladang Serkam','Ladang Serkam',1,NULL,NULL),('BPK4.8','BP4','Serkam Pantai','Serkam Pantai',1,NULL,NULL),('BPK4.9','BP4','Perindustrian Serkam','Perindustrian Serkam',1,NULL,NULL),('BPK5.1','BP5','Bandar Merlimau','Bandar Merlimau',1,NULL,NULL),('BPK5.10','BP5','Melaka Halal Hub 2','Melaka Halal Hub 2',1,NULL,NULL),('BPK5.2','BP5','Perindustrian Merlimau','Perindustrian Merlimau',1,NULL,NULL),('BPK5.3','BP5','Merlimau Utara','Merlimau Utara',1,NULL,NULL),('BPK5.4','BP5','Ayer Tawar','Ayer Tawar',1,NULL,NULL),('BPK5.5','BP5','Merlimau Pantai','Merlimau Pantai',1,NULL,NULL),('BPK5.6','BP5','Bukit Kepok','Bukit Kepok',1,NULL,NULL),('BPK5.7','BP5','Lipat Kajang','Lipat Kajang',1,NULL,NULL),('BPK5.8','BP5','Perindustrian Elkay','Perindustrian Elkay',1,NULL,NULL),('BPK5.9','BP5','Jasin Green Valley','Jasin Green Valley',1,NULL,NULL),('BPK6.1','BP6','Pekan Sungai Rambai','Pekan Sungai Rambai',1,NULL,NULL),('BPK6.2','BP6','Parit Penghulu','Parit Penghulu',1,NULL,NULL),('BPK6.3','BP6','Sebatu','Sebatu',1,NULL,NULL),('BPK6.4','BP6','Sungai Rambai Pantai','Sungai Rambai Pantai',1,NULL,NULL),('BPK6.5','BP6','Batu Gajah','Batu Gajah',1,NULL,NULL),('BPK6.6','BP6','Semujok','Semujok',1,NULL,NULL),('BPK6.7','BP6','Penghulu Benteng','Penghulu Benteng',1,NULL,NULL),('BPK7.1','BP7','Enklaf Umbai-Siring','Enklaf Umbai-Siring',1,NULL,NULL),('BPK7.2','BP7','Zon Akuakultur dan Eko Pelancongan','Zon Akuakultur dan Eko Pelancongan',1,NULL,NULL),('BPK7.3','BP7','Zon Taman Laut','Zon Taman Laut',1,NULL,NULL);
/*!40000 ALTER TABLE `b_p_k_s` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `b_p_s`
--

DROP TABLE IF EXISTS `b_p_s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `b_p_s` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bp_short` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bp_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `b_p_s`
--

LOCK TABLES `b_p_s` WRITE;
/*!40000 ALTER TABLE `b_p_s` DISABLE KEYS */;
INSERT INTO `b_p_s` VALUES ('BP1','ASH','ASAHAN',1,'2026-05-29 18:19:48','2026-05-29 18:20:11'),('BP2','BMB','BEMBAN',1,'2026-05-29 18:20:43','2026-05-29 18:23:32'),('BP3','RIM','JASIN-RIM',1,'2026-05-29 18:21:13','2026-05-29 18:21:13'),('BP4','SKM','SERKAM',1,'2026-05-29 18:21:34','2026-05-29 18:23:03'),('BP5','MER','MERLIMAU',1,'2026-05-29 18:22:02','2026-05-29 18:22:50'),('BP6','SR','SUNGAI RAMBAI',1,'2026-05-29 18:22:40','2026-05-29 18:22:40'),('BP7','KPJ','KAWASAN PERAIRAN JASIN',1,'2026-05-29 18:27:16','2026-05-29 18:27:16');
/*!40000 ALTER TABLE `b_p_s` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `cache` VALUES ('laravel-cache-admin@mpjasin.gov.my|127.0.0.1','i:1;',1776758386),('laravel-cache-admin@mpjasin.gov.my|127.0.0.1:timer','i:1776758386;',1776758386),('laravel-cache-clerk@svrms.gov|127.0.0.1','i:2;',1775099901),('laravel-cache-clerk@svrms.gov|127.0.0.1:timer','i:1775099901;',1775099901),('laravel-cache-nasrin@mpjasin.gov.my|127.0.0.1','i:1;',1777775965),('laravel-cache-nasrin@mpjasin.gov.my|127.0.0.1:timer','i:1777775965;',1777775965),('svrms-cache-hafith@mpjasin.gov.my|127.0.0.1','i:1;',1780006243),('svrms-cache-hafith@mpjasin.gov.my|127.0.0.1:timer','i:1780006243;',1780006243);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poskod` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`developer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `developers`
--

LOCK TABLES `developers` WRITE;
/*!40000 ALTER TABLE `developers` DISABLE KEYS */;
INSERT INTO `developers` VALUES (1,'bumi berkat','Jalan Melaka tinggal',NULL,'75214','Durian Tunggal','Melaka','bumi@berkat.com',NULL,'04589657','2026-03-10 15:41:29','2026-03-10 15:41:29'),(2,'world Jaya Sdn Bhd','Putera jaya',NULL,'90001','putrajaya','putraya','world@jaya.com',NULL,'01547859','2026-03-10 16:43:22','2026-03-10 16:43:22'),(3,'bumi utara bhd','Bangunan industri cheras',NULL,'90987','cheras','selangor','bumi@utara.com',NULL,'102548547','2026-03-10 17:17:52','2026-03-10 17:17:52'),(4,'UJANG KASIH SDN.BHD','Batu54 Jalan pertam',NULL,'8899887','pertama','selangor','ujang@kasih.com',NULL,'01254587','2026-04-21 00:02:45','2026-04-21 00:02:45'),(5,'Siang Jaya SDN BHD','JALAN Tengara 1',NULL,'1234567','Tengara','Johor','siang@jaya.com',NULL,'012458745452','2026-04-22 18:21:34','2026-04-22 18:21:34'),(6,'hujung jaya sdn bhd','Jalan 4 taman cheras',NULL,'8987665','Cheras','Selangor','hujung@jaya.com.my',NULL,'987654321','2026-05-01 17:46:24','2026-05-01 17:46:24'),(7,'Aman Jaya sdn bhd','Jlan jaya cyberjaya',NULL,'898766','Cyberjaya','Selangor','aman@jaya.com.my',NULL,'0128987656','2026-05-02 18:23:16','2026-05-02 18:23:16'),(8,'Bumi jaya Sdn Bhd','Bandar Baru Senawang',NULL,'89876','Senawang','Negeri Sembilan','bumi@jaya.com',NULL,'898187271','2026-05-14 20:59:11','2026-05-14 20:59:11'),(9,'Bumi jaya Sdn Bhd','Bandar Baru Senawang',NULL,'89876','Senawang','Negeri Sembilan','bumi@jaya1.com',NULL,'898187271','2026-05-14 20:59:20','2026-05-14 20:59:20');
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
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_03_04_015142_create_developers_table',2),(5,'2026_03_04_015143_create_applications_table',2),(6,'2026_03_04_015143_create_sites_table',2),(7,'2026_03_04_015144_create_reviews_table',2),(8,'2026_03_04_015144_create_site_visits_table',2),(9,'2026_03_04_015144_create_verifications_table',2),(10,'2026_03_04_015145_create_approvals_table',2),(11,'2026_03_04_015145_create_audit_logs_table',2),(12,'2026_05_28_220246_add_jalan_location_fields_to_site_visits_table',3),(13,'2026_05_29_add_remarks_array_to_verifications',4),(14,'2026_05_29_add_remarks_history_to_approvals',5),(15,'2026_05_29_234144_create_mukims_table',6),(16,'2026_05_29_235235_create_b_p_s_table',7),(17,'2026_05_29_235827_create_b_p_k_s_table',8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mukims`
--

DROP TABLE IF EXISTS `mukims`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mukims` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mukim_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_mukim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mukim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mukims_mukim_no_unique` (`mukim_no`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mukims`
--

LOCK TABLES `mukims` WRITE;
/*!40000 ALTER TABLE `mukims` DISABLE KEYS */;
INSERT INTO `mukims` VALUES (1,'01','AP','Ayer Panas',1,NULL,NULL),(2,'02','BM','Batang Melaka',1,NULL,NULL),(3,'03','BS','Bukit Senggeh',1,NULL,NULL),(4,'04','CB','Chabau',1,NULL,NULL),(5,'05','CC','Chinchin',1,NULL,NULL),(6,'06','CH','Chohong',1,NULL,NULL),(7,'07','JSN','Jasin',1,NULL,NULL),(8,'08','JUS','Jus',1,NULL,NULL),(9,'09','KSG','Kesang',1,NULL,NULL),(10,'10','MER','Merlimau',1,NULL,NULL),(11,'11','NYL','Nyalas',1,NULL,NULL),(12,'12','RIM','Rim',1,NULL,NULL),(13,'13','SEBATU','Sebatu',1,NULL,NULL),(14,'14','SLDR','Selandar',1,NULL,NULL),(15,'15','SPG','Sempang',1,NULL,NULL),(16,'16','SMJ','Semujok',1,NULL,NULL),(17,'17','SERKAM','Serkam',1,NULL,NULL),(18,'18','SR','Sg. Rambai',1,NULL,NULL),(19,'19','TDG','Tedong',1,NULL,NULL),(20,'20','UMBAI','Umbai',1,NULL,NULL);
/*!40000 ALTER TABLE `mukims` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `review_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `recommendation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `self_check_completed` tinyint(1) NOT NULL DEFAULT '0',
  `submitted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `local_id` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  UNIQUE KEY `local_id` (`local_id`),
  KEY `reviews_application_id_foreign` (`application_id`),
  KEY `reviews_officer_id_foreign` (`officer_id`),
  CONSTRAINT `reviews_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`),
  CONSTRAINT `reviews_officer_id_foreign` FOREIGN KEY (`officer_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (5,11,2,'Disokong','NOT_SUPPORTED',1,'2026-05-04 22:21:16','2026-05-04 22:21:16','2026-05-04 22:21:16',NULL),(6,10,2,'Disokong','SUPPORTED',1,'2026-05-04 22:22:15','2026-05-04 22:22:15','2026-05-04 22:22:15',NULL),(7,13,2,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vitae ante tellus. Quisque vitae finibus velit, ut rhoncus libero. Donec id sem nibh. Ut vulputate mauris magna, sed facilisis elit finibus eu. Donec ut sem egestas, luctus velit non, imperdiet orci. Morbi vitae malesuada sapien. Nulla pharetra volutpat urna. Donec.','SUPPORTED',1,'2026-05-28 14:04:39','2026-05-28 14:04:39','2026-05-28 14:04:39',NULL),(8,14,2,'Sedia untuk kegunaan tanah','SUPPORTED',1,'2026-05-28 19:18:46','2026-05-28 19:18:46','2026-05-28 19:18:46',NULL),(9,17,2,'Setuju','SUPPORTED',1,'2026-05-30 18:19:12','2026-05-30 18:19:12','2026-05-30 18:19:12',NULL),(10,16,2,'Morbi ut tortor cursus, interdum lectus ut, ultricies nisi.\r\nNullam quis elit porttitor, luctus lacus ut, accumsan risus.\r\nAenean at purus faucibus, sodales lectus ut, vulputate orci.','SUPPORTED',1,'2026-05-30 18:59:53','2026-05-30 18:59:53','2026-05-30 18:59:53',NULL);
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `sessions` VALUES ('6fogljzwjH7i0SAnNa06DeZTxcP9x9O4XpvswEHY',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQklPczdiZU1uTkNlQU5mMWJyRjRxbnZBamtmVmk5dUtuUmZ5QWZpOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vZmZpY2VyL2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czoxNzoib2ZmaWNlci5kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=',1780224372),('iJP7U3Qd2cdSGsmUNvhhMUSLpNcH8ACdvRVJ4WyA',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoibGMzZHlvOEYzU0ZPcjF5M1ZXcUhidXZ4M3F6ZnFibHM3T2dOdGFjTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tYW5hZ2VtZW50L3ZlcmlmaWNhdGlvbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MjI6InZlcmlmaWNhdGlvbi5kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=',1780198557),('y4BjNvp919K5VcBirbrp2X9X7XgQfOk9NLlgV0Ex',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidzhYN0VDSUM5N1RuSVlTRVpmOWx5VzZWSkljR09adXZRS0l6WHNzSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=',1780267574);
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
  `finding_north` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `photos_north` json DEFAULT NULL,
  `findings_south` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `photos_south` json DEFAULT NULL,
  `findings_east` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `photo_east` json DEFAULT NULL,
  `finding_west` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `photo_west` json DEFAULT NULL,
  `finding_jalan` text COLLATE utf8mb4_unicode_ci,
  `photos_jalan` json DEFAULT NULL,
  `finding_location` text COLLATE utf8mb4_unicode_ci,
  `photos_location` json DEFAULT NULL,
  `attachments` json DEFAULT NULL,
  `activity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facility` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entrance_way` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tree` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topography` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `land_use_zone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `density` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recommend_road` tinyint(1) NOT NULL DEFAULT '0',
  `parking` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anjakan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_facility` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo_utara` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_selatan` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_timur` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_barat` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `local_id` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`site_visit_id`),
  UNIQUE KEY `local_id` (`local_id`),
  KEY `site_visits_application_id_foreign` (`application_id`),
  KEY `site_visits_officer_id_foreign` (`officer_id`),
  CONSTRAINT `site_visits_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`),
  CONSTRAINT `site_visits_officer_id_foreign` FOREIGN KEY (`officer_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_visits`
--

LOCK TABLES `site_visits` WRITE;
/*!40000 ALTER TABLE `site_visits` DISABLE KEYS */;
INSERT INTO `site_visits` VALUES (9,10,2,'2026-05-03','Hutan','[\"photos/c5xIdRdhQMZVA7Iq1ejfJREfcIifobUa7NoOsCx4.png\"]','Hutan','[\"photos/IBZiTlrlA753RA5TX2e8uJ6jC8x5pro5sImdrjVr.png\"]','Hutan','[\"photos/Jix71qWQekTWjqiRIiG6Z957S3EGgbwp2FyXaDXv.png\"]','Hutan','[\"photos/drq91z3Rl8qmwbD18Hk5r0vXIu8Jn3GDRFFiWSt5.png\"]',NULL,NULL,NULL,NULL,NULL,'kawasan lapang kawasan baru','terdapat longkang tanah.','Tiada','tiada','semak','berbukit','Pertanian','20 orang',0,NULL,'Tiada keperluan','Tiada Keperluan','5.42860000, 100.37900000','COMPLETED','2026-05-03 15:40:28','2026-05-03 15:40:28',NULL,NULL,NULL,NULL,NULL),(11,11,2,'2026-05-04','Hutan','[\"photos/photos_north-1777860101652-157396478.png\"]','Hutan','[\"photos/photos_south-1777860101673-743314420.png\"]','Hutan','[\"photos/photo_east-1777860101674-773414532.png\"]','Hutan','[\"photos/photo_west-1777860101674-163473048.png\"]',NULL,NULL,NULL,NULL,NULL,'Tiada Aktiviti','Tiada ','tiada','tiada','tiada','Berbukit ','tiada','10',1,NULL,'tiada','Tiada ','5.428600, 100.379000','COMPLETED',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,13,2,'2026-05-28','Semak Samun','[\"photos/aHtaOFxFzITYi4EcqgndtODpTjg9d6nWGEWEgEcR.png\"]','Semak samun','[\"photos/HLFQTwOGsP0WdUHjmacHQrX9aF0hY8nexz7FVnr3.png\"]','Semak samun',NULL,'Semak samun','[\"photos/wuxukS3wUyL40nPjTDa7KI7b8PrgZzCy3lrKh6m5.png\"]','Jalan Masuk','[\"photos/8cLWqW6pnzd8wDaX9yC5H3w19yYFKU2nWSGGE0C3.png\"]','Lokasi cadangan','[\"photos/0OWmltPyUWM48ZipELbIcxsBb1Md2a7sO1KU91SS.png\"]',NULL,'kawasan lapang kawasan baru','tiada','Tiada','tiada','semak','baik','Pertanian','10 keluarga',1,NULL,'tiada','tiada','5.33380000, 100.26580000','COMPLETED','2026-05-28 14:03:23','2026-05-28 14:03:23',NULL,NULL,NULL,NULL,NULL),(13,14,2,'2026-05-29','Semak','[\"photos/m5Binka2RXFA7hYCvrbc8Fo6iv0Vx1Tll35bLsxh.png\"]','sefasdasdfasd','[\"photos/5wF1zY0QrDAfDShCTOkjh7PWABWiOe67fajndDRz.png\"]','aseraevcad','[\"photos/Q09VQ4Bn5aTnbJIWcTVv2yshqRL7k9NgF1TpHleG.png\"]','ewradaf','[\"photos/ZDZyoGELXaNaiAeUVnBmFA9RDZqwyvqnGk7NewuL.png\"]','daddeesasdf','[\"photos/wccs9FPXVq0lNv3JBqlAEajxbtMqHgeBAMbFqubD.png\"]','dasdfvasdfawera','[\"photos/FeazjSGsS1t8LycAFb8yObsQmYNz3ztbqw2X1jLU.png\"]',NULL,'kawasan lapang kawasan baru','tiada','Tiada','tiada','semak','baik','Pertanian','10 keluarga',1,NULL,'2','tiada','5.33380000, 100.26580000','COMPLETED','2026-05-28 19:17:38','2026-05-28 19:17:38',NULL,NULL,NULL,NULL,NULL),(14,15,2,'2026-05-30','Kelapa Sawit','[\"photos/99GvjiIYMgQePtPzlVEoAZbTpUk8O0QOO8Yq2xnA.png\"]','Kelapa Sawit','[\"photos/s0sPsPLc1dtT96wmJ4EEL12WwHJCRW5aVk5pSyqk.png\"]','Kelapa sawit','[\"photos/HRFtSlPBxeQyBiXbs1ZX3XM8hlUhwypYCNxhOx7v.png\"]','Kelapa Sawit','[\"photos/T4Mhx3gFRJ9vT0WXKUKpunnf9qaIuwghya0i34NB.png\"]','Kelapa Sawit','[\"photos/8e99w4bc8KYtD5KGcVIaiINF06j4ChDzT3HqJCyU.png\"]','Kelapa Sawit','[\"photos/TBIoGbLSIOnmFZyX6AMRxTp4Ts8Twznb2FiLFy5H.png\"]',NULL,'kawasan lapang kawasan baru','terdapat longkang tanah.','Jln Jasin-Jln Bt Langsat','tiada','tiada','bukit bakau','Pertanian','tiada',0,NULL,'tiada','tiada','5.33380000, 100.26580000','COMPLETED','2026-05-30 06:05:52','2026-05-30 06:05:52',NULL,NULL,NULL,NULL,NULL),(15,16,2,'2026-05-30','Kelapa Sawit','[\"photos/Zg5NPU5h2lNw5IMOsG205NroktvZFoSgsVKOrUJ4.png\"]','Kelapa Sawit','[\"photos/6dTwaqfHAB0zEQiX8yJD1b7YGbkaMXX8hSFCyIzZ.png\"]','Kelapa Sawit','[\"photos/2vIhD7siY0tBd9EYyFj5vKHvwQ8WyNhwQGdEjiCo.png\"]','Kelapa Sawit','[\"photos/14nz0vjYTiuVsOGE4I0EdJOUsNWqEHgjAK1iKAWi.png\"]','Kelapa Sawit','[\"photos/5TTEwmEj9kHONGSdu6Zz1YM2VfgMirYHvNrD8yC3.png\"]','Kelapa Sawit','[\"photos/XjKZrNPcnqd948xOPxbACA0vp0O71U8Koac8Qlkr.png\"]',NULL,'kawasan lapang kawasan baru','tiada','Jln Jasin-Jln Bt Langsat','tiada','tiada','bukit bakau','Pertanian',NULL,0,NULL,'tiada','tiada','5.33380000, 100.26580000','COMPLETED','2026-05-30 15:03:16','2026-05-30 15:03:16',NULL,NULL,NULL,NULL,NULL),(16,17,2,'2026-05-31','Semak samun','[\"photos/nCm9ZNSLBRhAnxj3JHopRMkcw287mO7afaWXYiZ1.jpg\"]','Semak Samun','[\"photos/9GVa1FoBHenaiuoUqOFJ7kXXYef2HFMOmlQvS0OS.jpg\"]','Semak Samun','[\"photos/KUXdYknW5PHQjJuepRQWjKnpt1KxvzOeYTgg0q22.jpg\"]','Semak Samun','[\"photos/icE7MhZjd1TuiQ3efArpS6W1tl3PtvfKvGcywIk6.jpg\"]','Semak Samun','[\"photos/3epmSA77fjkhFX36bEvBcPmrJU2rVo0RTnyP8lvA.jpg\"]','Semak Samun','[\"photos/clYvkDU2OKNsLvgGHZZOG49hzzOR6ZP0cC87aQz5.jpg\"]',NULL,'kawasan lapang','tiada','Jln Jasin-Jln Bt Langsat','tiada','semak','bukit bakau','Pertanian',NULL,0,NULL,'tiada','tiada','5.33380000, 100.26580000','COMPLETED','2026-05-30 18:18:30','2026-05-30 18:18:30',NULL,NULL,NULL,NULL,NULL),(17,12,2,'2026-05-31','hutan belukar','[\"photos/MK4s1pSQVjkJRRIMqG7xgBBk43S8cBBI4HoEc15E.jpg\"]','hutan belukar','[\"photos/r2g5V8xQYkE9CjNZeGCSQM3D9ubKRDbuq9AdeSqz.jpg\"]','hutan belukar','[\"photos/evYVy0kI5TI2gtSJDPZ5KpoRFde38xfuCpDvvwYS.jpg\"]','hutan belukar','[\"photos/qMAB24Blw7lrZAkaFnzz1yoOIflWJNlJCmSfdzvC.jpg\"]','hutan belukar','[\"photos/U0HKDvHxRJFIe8fnzQqDFFy8niEtQv5o10saunj8.jpg\"]','hutan belukar','[\"photos/TtRSZcWTaWFz3P9w3thjwG0uXYkGs6QP1A4e50Q8.jpg\"]',NULL,'kawasan lapang kawasan baru','terdapat longkang tanah.','Jln Jasin-Jln Bt Langsat','tiada','tiada','bukit bakau','Pertanian','tiada',0,NULL,'tiada','tiada','5.33380000, 100.26580000','COMPLETED','2026-05-31 02:03:06','2026-05-31 02:03:06',NULL,NULL,NULL,NULL,NULL);
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
  `mukim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bp` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `luas` decimal(10,4) NOT NULL,
  `google_lat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_long` decimal(11,8) DEFAULT NULL,
  `map` json DEFAULT NULL,
  `lot` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lembaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_tanah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_tanah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `local_id` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`site_id`),
  UNIQUE KEY `local_id` (`local_id`),
  KEY `sites_application_id_foreign` (`application_id`),
  CONSTRAINT `sites_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sites`
--

LOCK TABLES `sites` WRITE;
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;
INSERT INTO `sites` VALUES (8,10,'ASAHAN',NULL,'101',25.0000,'2.386041,102.532776',NULL,NULL,'101','map sheet','Pertanian','Freehold','REGISTERED',1,'2026-05-03 15:39:04','2026-05-03 15:39:04',NULL),(9,11,'jasin',NULL,'bpk1',25.0000,'2.313774,102.448441',NULL,NULL,'205','25458','Pertanian','Frehold','REGISTERED',1,'2026-05-04 01:43:29','2026-05-04 01:43:29',NULL),(10,12,'jasin',NULL,'bpk1',25.0000,'2.386670,102.533122',NULL,NULL,'1519','25458','Pertanian','Frehold','REGISTERED',1,'2026-05-15 05:02:07','2026-05-15 05:02:07',NULL),(11,13,'BEMBAN',NULL,'212',45.0000,'2.394674,102.547444',NULL,NULL,'101','125','Pertanian','Free Hold','REGISTERED',1,'2026-05-18 05:19:10','2026-05-18 05:19:10',NULL),(12,14,'BEMBAN',NULL,'212',257.0000,'2.146451,102.426097',NULL,NULL,'101','125','Pertanian','Free Hold','REGISTERED',1,'2026-05-28 19:15:58','2026-05-28 19:15:58',NULL),(14,15,'01','BP1','BPK1.1',24.0000,'2.392039,102.379303',NULL,NULL,'101','map sheet','PERTANIAN','FRE HOLD','REGISTERED',1,'2026-05-30 03:13:15','2026-05-30 03:13:15',NULL),(15,16,'08','BP1','BPK1.11',24.9998,'2.447800,102.372307',NULL,NULL,'121','125','kategori tanah','Freehold','REGISTERED',1,'2026-05-30 15:01:01','2026-05-30 15:01:01',NULL),(16,17,'08','BP1','BPK1.11',24.9998,'2.425434,102.396386',NULL,NULL,'123','125','PERTANIAN','Free Hold','REGISTERED',1,'2026-05-30 18:16:15','2026-05-30 18:16:15',NULL);
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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Developer',
  `department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
INSERT INTO `users` VALUES (1,'nadia','nadia@mpjasin.gov.my','2026-03-18 21:09:02','$2y$12$AYBg1yphLw15udkLTsD.IewAAbAPGVQF1Rcjdoc2QAg6JFtrlOyWW','Clerk','Registration',1,'11TtTKrAlEUUyE8JEF5HsFepIeuQ7Tk9mOdSj2azplsXtgZ2YWEYLSOoSjSs','2026-03-18 21:09:02','2026-04-01 19:18:56'),(2,'Nazrin Almanzo','nazrin@mpjasin.gov.my','2026-03-18 21:09:02','$2y$12$Xt7fV/rX.PnBUWO.9/pS5egOaKp0vAI2HaIbtLAu3WVEM2ewaxkti','Officer','Site Operations',1,'xSSSabtuuWFKvObtJoMscOOb1b7VO87sKbRJh4Ebt19QesXTNuBCupyYGKrY','2026-03-18 21:09:02','2026-05-02 01:16:05'),(3,'Ashraf','ad@mpjasin.gov.my','2026-03-18 21:09:02','$2y$12$2AgDrrapEOiq5eYC/M1owe5wD.3Q7mTc340H1UBuI997NTiLChQmC','Assistant Director','Administration',1,'kgeN4A4TnupGGeQKRa5ExbItCCELHld8hH9xXu3uvvRtcO0Ymv9k8ZqSAoiv','2026-03-18 21:09:02','2026-03-18 21:19:07'),(4,'Hafidh Bin Sulaiman','hafidh@mpjasin.gov.my','2026-03-18 21:09:02','$2y$12$2pNnLctcm.b8Hle7jGEg7.P9Jbf43/B8k/p5tmH.tt8PlEqrygih.','Director','Management',1,'Jk5dngYV7WWo32fmKPboZHlAzIb3Sfpnu6NVRr0HGNxbA90BRAqBoiD9s1B8','2026-03-18 21:09:02','2026-03-18 21:19:42'),(5,'System Administrator','admin@svrms.local','2026-03-18 21:09:02','$2y$12$3aMJcyc38RcV4VGinbMX9eqgx/u7fkKq9QFZTnDgpAOaXm.BTm0R6','Admin','IT Services',1,'q6hi05YlSd2OYlFF2nudfo7OmwpQKaGxpFxbNQUGbMY1TRsGcFFqFPn6zMth','2026-03-18 21:09:02','2026-03-18 21:09:02'),(6,'kharudin','din@mpjasin.gov.my',NULL,'$2y$12$DFqfHCXF6bQLcovajRa8m.9rMdrcbpyNBSFRFng9BWqjYLfMgu.qe','Officer','JPBD',1,NULL,'2026-03-18 21:21:27','2026-03-18 21:21:27'),(7,'zamzul','zam@mpjasin.gov.my',NULL,'$2y$12$WCltEoB94yKGWsjMFLf8O.YcvOOVNUs.wUwi90tj1CJcx.ut.fzZK','Admin','IT Services',1,NULL,'2026-03-18 21:21:57','2026-03-18 21:21:57');
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
  `verification_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remark_history` json DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`verify_id`),
  KEY `verifications_application_id_foreign` (`application_id`),
  KEY `verifications_assistant_director_id_foreign` (`assistant_director_id`),
  CONSTRAINT `verifications_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`),
  CONSTRAINT `verifications_assistant_director_id_foreign` FOREIGN KEY (`assistant_director_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verifications`
--

LOCK TABLES `verifications` WRITE;
/*!40000 ALTER TABLE `verifications` DISABLE KEYS */;
INSERT INTO `verifications` VALUES (3,13,3,'VERIFIED','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fermentum dolor a dolor ultrices vulputate. Proin quis nunc sem. Aliquam aliquet metus odio, et semper nulla varius non. Vestibulum hendrerit elit id augue mollis, sit amet ultrices tortor venenatis. Mauris molestie lacus tellus, et aliquam nulla bibendum vel. Praesent vestibulum dignissim turpis, quis egestas arcu tempor non. Mauris finibus felis vitae leo tempor condimentum. Ut vehicula mollis neque nec dictum. Mauris ligula purus, consectetur in ullamcorper ac, fringilla fringilla metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nunc volutpat elit in libero tincidunt pharetra.',NULL,'2026-05-28 14:09:03','2026-05-28 14:09:03','2026-05-28 14:09:03'),(4,10,3,'VERIFIED','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at sollicitudin ex, sagittis vulputate eros. Quisque ac enim in purus efficitur cursus. Aenean scelerisque suscipit ligula. Maecenas ut tellus vitae tortor interdum viverra. Maecenas volutpat magna nec dolor elementum, id pharetra justo rutrum. Pellentesque sed nisi sodales, ultricies eros sit.',NULL,'2026-05-28 15:14:20','2026-05-28 15:14:20','2026-05-28 15:14:20'),(5,11,3,'VERIFIED','Tapak terletak di zon gunatanah pertanian; BPK 3.4: Seri Kesang berdasarkan Rancangan Tempatan Majlid Perbandaran Jasin 2035',NULL,'2026-05-28 19:02:34','2026-05-28 19:02:34','2026-05-28 19:02:34'),(6,14,3,'VERIFIED','Terletak di zon tanah pertanian; BPK 3.4; Seri Kesang berdasarkan Rancangan Tempatan MPJ 2035','[{\"text\": \"Terletak di zon tanah pertanian; BPK 3.4; Seri Kesang berdasarkan Rancangan Tempatan MPJ 2035\", \"user_id\": 3, \"user_name\": \"Ashraf\", \"created_at\": \"29 May 2026, 03:40 AM\", \"updated_at\": \"29 May 2026, 03:40 AM\"}, {\"text\": \"Aktiviti yang dipohon merupakan aktiviti yang dibenarkan.\", \"user_id\": 3, \"user_name\": \"Ashraf\", \"created_at\": \"29 May 2026, 03:40 AM\", \"updated_at\": \"29 May 2026, 03:40 AM\"}, {\"text\": \"Pada pandangan MPJ, Dari segi saiz dan kedudukan tanah sesuai dipohon oleh agensi kerajaan.\", \"user_id\": 3, \"user_name\": \"Ashraf\", \"created_at\": \"29 May 2026, 03:40 AM\", \"updated_at\": \"29 May 2026, 03:40 AM\"}, {\"text\": \"Sebarang binaan dan kerja tanah perlu mendapatkan kelulusan Majlis Perbandaran Jasin terlebih dahulu.\", \"user_id\": 3, \"user_name\": \"Ashraf\", \"created_at\": \"29 May 2026, 03:40 AM\", \"updated_at\": \"29 May 2026, 03:40 AM\"}]','2026-05-28 19:40:17','2026-05-28 19:40:17','2026-05-28 19:40:17'),(7,17,3,'VERIFIED','Tapak Terletak di zon guna tanah pertanian: BPK 3.4: Seri Kesang Berdasarkan Rancangan Tempatan Majlis Perbandaran Jasin 2035','[{\"text\": \"Tapak Terletak di zon guna tanah pertanian: BPK 3.4: Seri Kesang Berdasarkan Rancangan Tempatan Majlis Perbandaran Jasin 2035\", \"user_id\": 3, \"user_name\": \"Ashraf\", \"created_at\": \"31 May 2026, 02:22 AM\", \"updated_at\": \"31 May 2026, 02:22 AM\"}, {\"text\": \"Aktiviti yang di pohon merupakan aktiviti yang dibenarkan.\", \"user_id\": 3, \"user_name\": \"Ashraf\", \"created_at\": \"31 May 2026, 02:22 AM\", \"updated_at\": \"31 May 2026, 02:22 AM\"}, {\"text\": \"Pada pandangan MPNJ, dari segi saiz dan kedudukan tanah sesuai dimohon oleh agensi kerajaan.\", \"user_id\": 3, \"user_name\": \"Ashraf\", \"created_at\": \"31 May 2026, 02:22 AM\", \"updated_at\": \"31 May 2026, 02:22 AM\"}, {\"text\": \"Sebarang Binaan dan kerja tanah perlu kelulusan MPJ terlebih dahulu\", \"user_id\": 3, \"user_name\": \"Ashraf\", \"created_at\": \"31 May 2026, 02:22 AM\", \"updated_at\": \"31 May 2026, 02:22 AM\"}, {\"text\": \"Mematuhi ulasan dan syarat teknikal jabatan lain\", \"user_id\": 3, \"user_name\": \"Ashraf\", \"created_at\": \"31 May 2026, 02:22 AM\", \"updated_at\": \"31 May 2026, 02:22 AM\"}]','2026-05-30 18:22:44','2026-05-30 18:22:44','2026-05-30 18:22:44'),(8,16,3,'VERIFIED','Maecenas sed nisi aliquet, consectetur justo nec, sagittis nunc.','[{\"text\": \"Maecenas sed nisi aliquet, consectetur justo nec, sagittis nunc.\", \"user_id\": 3, \"user_name\": \"Ashraf\", \"created_at\": \"31 May 2026, 03:18 AM\", \"updated_at\": \"31 May 2026, 03:18 AM\"}, {\"text\": \"Aliquam vitae nisi in ipsum condimentum convallis ac vel odio.\", \"user_id\": 3, \"user_name\": \"Ashraf\", \"created_at\": \"31 May 2026, 03:18 AM\", \"updated_at\": \"31 May 2026, 03:18 AM\"}]','2026-05-30 19:18:35','2026-05-30 19:18:35','2026-05-30 19:18:35');
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

-- Dump completed on 2026-06-03  6:45:15
