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
  `tajuk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (10,'SVRMS-2026-0001',4,'Permohonan Cadangan Guna tanah bagi kerja-kerja membangunkan project solor','Tapak pelepasan roket Asahan','MPJ-JPB-2921','APPROVED',2,1,'2026-05-03 15:37:11','2026-05-28 16:20:04'),(11,'SVRMS-2026-0002',7,'Pemohonan untuk mendapatkan tanah bagi kerja perlombongan','Tapak Lombong arang batu RIM','MPJ-JPB-2921','APPROVED',2,1,'2026-05-03 17:41:09','2026-05-29 06:54:13'),(12,'SVRMS-2026-0003',9,'Pemohonan untuk mendapatkan tanah bagi kerja perlombongan EMAS dan arang batu','Bukit Asahan','MPJ-JPB-35','RECORDED',2,1,'2026-05-14 20:59:43','2026-05-14 20:59:43'),(13,'SVRMS-2026-0004',3,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempor felis sed velit fringilla pharetra. Sed id dignissim eros. Curabitur.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non eros non urna iaculis tempor ut bibendum urna. In blandit felis ac mi aliquet, sed ornare libero euismod. Vivamus eu velit nec purus blandit eleifend. Nullam sit amet pretium augue, quis maximus nisl. Curabitur eros augue, placerat sit amet ligula.','MPJ-JPB-35','FILED',2,1,'2026-05-18 05:16:27','2026-05-28 16:21:55'),(14,'SVRMS-2026-0005',4,'Permohonan Cadangan Guna tanah bagi kerja-kerja membangunkan project solor','Mukin Kesang','MPJ-JPB-2921','PENDING_APPROVAL',2,1,'2026-05-28 19:14:46','2026-05-28 19:40:58'),(15,'SVRMS-2026-0006',1,'Pemohonan untuk memiliki Tanah kerajaan secara lesen pendudukan sementara(LPS) di atas lot 7 seluas 297.7477 hektar','01','PDTJ.600-2/6/133(9)','RECORDED',2,1,'2026-05-29 19:57:54','2026-05-29 19:57:54');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvals`
--

LOCK TABLES `approvals` WRITE;
/*!40000 ALTER TABLE `approvals` DISABLE KEYS */;
INSERT INTO `approvals` VALUES (5,13,4,'SVRMS-2026-0004, approved by Hafidh Bin Sulaiman, 2026-05-28 and 22:12:48 approved.',NULL,'Lulus',NULL,'APPROVED','2026-05-28 14:12:48','2026-05-28 14:12:48','2026-05-28 14:12:48'),(6,10,4,'SVRMS-2026-0001, approved by Hafidh Bin Sulaiman, 2026-05-28 and 23:15:02 approved.',NULL,'Lulus',NULL,'APPROVED','2026-05-28 15:15:02','2026-05-28 15:15:02','2026-05-28 15:15:02'),(7,11,4,'SVRMS-2026-0002, approved by Hafidh Bin Sulaiman, 2026-05-29 and 14:54:13 APPROVED.',NULL,'sediakan surat kelulusan','[{\"text\": \"Tapak terletak di zon gunatanah pertanian; BPK 3.4: Seri Kesang berdasarkan Rancangan Tempatan Majlid Perbandaran Jasin 2035\", \"user_id\": 4, \"user_name\": \"Hafidh Bin Sulaiman\", \"created_at\": \"29 May 2026, 14:54 PM\", \"updated_at\": \"29 May 2026, 14:54 PM\"}]','APPROVED','2026-05-29 06:54:13','2026-05-29 06:54:13','2026-05-29 06:54:13');
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_logs`
--

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;
INSERT INTO `audit_logs` VALUES (28,10,2,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-05-03 23:39:04','2026-05-03 15:39:04','2026-05-03 15:39:04'),(29,10,2,'SITE_INVESTIGATION_COMPLETED',NULL,NULL,NULL,NULL,'Officer formally submitted Site Investigation. Location Data: 5.42860000, 100.37900000','2026-05-03 23:40:28','2026-05-03 15:40:28','2026-05-03 15:40:28'),(30,13,2,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-05-18 13:19:10','2026-05-18 05:19:10','2026-05-18 05:19:10'),(31,13,2,'SITE_INVESTIGATION_COMPLETED',NULL,NULL,NULL,NULL,'Officer formally submitted Site Investigation. Location Data: 5.33380000, 100.26580000','2026-05-28 22:03:23','2026-05-28 14:03:23','2026-05-28 14:03:23'),(32,13,3,'VERIFICATION_VERIFIED',NULL,NULL,NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fermentum dolor a dolor ultrices vulputate. Proin quis nunc sem. Aliquam aliquet metus odio, et semper nulla varius non. Vestibulum hendrerit elit id augue mollis, sit amet ultrices tortor venenatis. Mauris molestie lacus tellus, et aliquam nulla bibendum vel. Praesent vestibulum dignissim turpis, quis egestas arcu tempor non. Mauris finibus felis vitae leo tempor condimentum. Ut vehicula mollis neque nec dictum. Mauris ligula purus, consectetur in ullamcorper ac, fringilla fringilla metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nunc volutpat elit in libero tincidunt pharetra.','2026-05-28 22:09:03','2026-05-28 14:09:03','2026-05-28 14:09:03'),(33,13,4,'APPROVAL_APPROVED',NULL,NULL,NULL,NULL,'Lulus','2026-05-28 22:12:48','2026-05-28 14:12:48','2026-05-28 14:12:48'),(34,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-28T22:12:48.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-28 22:47:17\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-28 22:47:17','2026-05-28 14:47:17','2026-05-28 14:47:17'),(35,10,3,'VERIFICATION_VERIFIED',NULL,NULL,NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at sollicitudin ex, sagittis vulputate eros. Quisque ac enim in purus efficitur cursus. Aenean scelerisque suscipit ligula. Maecenas ut tellus vitae tortor interdum viverra. Maecenas volutpat magna nec dolor elementum, id pharetra justo rutrum. Pellentesque sed nisi sodales, ultricies eros sit.','2026-05-28 23:14:20','2026-05-28 15:14:20','2026-05-28 15:14:20'),(36,10,4,'APPROVAL_APPROVED',NULL,NULL,NULL,NULL,'Lulus','2026-05-28 23:15:02','2026-05-28 15:15:02','2026-05-28 15:15:02'),(37,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-28T22:47:17.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-28 23:16:18\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-28 23:16:18','2026-05-28 15:16:18','2026-05-28 15:16:18'),(38,10,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-28T23:15:02.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-28 23:18:38\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-28 23:18:38','2026-05-28 15:18:38','2026-05-28 15:18:38'),(39,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-28T23:16:18.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-28 23:28:02\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-28 23:28:02','2026-05-28 15:28:02','2026-05-28 15:28:02'),(40,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-28T23:28:02.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-28 23:30:23\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-28 23:30:23','2026-05-28 15:30:23','2026-05-28 15:30:23'),(41,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-28T23:30:23.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-29 00:01:18\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-29 00:01:18','2026-05-28 16:01:18','2026-05-28 16:01:18'),(42,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-29T00:01:18.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-29 00:09:34\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-29 00:09:34','2026-05-28 16:09:34','2026-05-28 16:09:34'),(43,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-29T00:09:34.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-29 00:13:16\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-29 00:13:16','2026-05-28 16:13:16','2026-05-28 16:13:16'),(44,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-29T00:13:16.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-29 00:14:42\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-29 00:14:42','2026-05-28 16:14:42','2026-05-28 16:14:42'),(45,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-29T00:14:42.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-29 00:17:00\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-29 00:17:00','2026-05-28 16:17:00','2026-05-28 16:17:00'),(46,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-29T00:17:00.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-29 00:18:53\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-29 00:18:53','2026-05-28 16:18:53','2026-05-28 16:18:53'),(47,10,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-28T23:18:38.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-29 00:20:04\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-29 00:20:04','2026-05-28 16:20:04','2026-05-28 16:20:04'),(48,13,1,'status_transition','APPROVED','FILED','\"{\\\"status\\\":\\\"APPROVED\\\",\\\"updated_at\\\":\\\"2026-05-29T00:18:53.000000Z\\\"}\"','\"{\\\"status\\\":\\\"FILED\\\",\\\"updated_at\\\":\\\"2026-05-29 00:21:55\\\"}\"','Application Dossier completely compiled and FILED by Clerk nadia.','2026-05-29 00:21:55','2026-05-28 16:21:55','2026-05-28 16:21:55'),(49,11,3,'VERIFICATION_VERIFIED',NULL,NULL,NULL,NULL,'Tapak terletak di zon gunatanah pertanian; BPK 3.4: Seri Kesang berdasarkan Rancangan Tempatan Majlid Perbandaran Jasin 2035','2026-05-29 03:02:34','2026-05-28 19:02:34','2026-05-28 19:02:34'),(50,14,2,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-05-29 03:15:58','2026-05-28 19:15:58','2026-05-28 19:15:58'),(51,14,2,'SITE_INVESTIGATION_COMPLETED',NULL,NULL,NULL,NULL,'Officer formally submitted Site Investigation. Location Data: 5.33380000, 100.26580000','2026-05-29 03:17:38','2026-05-28 19:17:38','2026-05-28 19:17:38'),(52,14,3,'VERIFICATION_VERIFIED',NULL,NULL,NULL,NULL,'Terletak di zon tanah pertanian; BPK 3.4; Seri Kesang berdasarkan Rancangan Tempatan MPJ 2035; Aktiviti yang dipohon merupakan aktiviti yang dibenarkan.','2026-05-29 03:40:17','2026-05-28 19:40:17','2026-05-28 19:40:17'),(53,14,3,'SUBMITTED_TO_APPROVAL',NULL,NULL,NULL,NULL,'Application forwarded to approval stage.','2026-05-29 03:40:58','2026-05-28 19:40:58','2026-05-28 19:40:58'),(54,11,4,'APPROVAL_APPROVED',NULL,NULL,NULL,NULL,'sediakan surat kelulusan','2026-05-29 14:54:13','2026-05-29 06:54:13','2026-05-29 06:54:13'),(55,15,2,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-05-30 11:02:00','2026-05-30 03:02:00','2026-05-30 03:02:00'),(56,15,2,'SITE_REGISTERED',NULL,NULL,NULL,NULL,NULL,'2026-05-30 11:13:15','2026-05-30 03:13:15','2026-05-30 03:13:15');
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
INSERT INTO `b_p_k_s` VALUES ('BPK1.1','BP1','PS','PEKAN SELANDAR',1,'2026-05-29 18:28:08','2026-05-29 18:28:08'),('BPK2.1','BP2','BDRJ','BANDAR JASIN',1,'2026-05-29 20:12:53','2026-05-29 20:12:53');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mukims`
--

LOCK TABLES `mukims` WRITE;
/*!40000 ALTER TABLE `mukims` DISABLE KEYS */;
INSERT INTO `mukims` VALUES (1,'01','AP','AIR PANAS',1,'2026-05-29 18:17:03','2026-05-29 18:17:03');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (5,11,2,'Disokong','NOT_SUPPORTED',1,'2026-05-04 22:21:16','2026-05-04 22:21:16','2026-05-04 22:21:16',NULL),(6,10,2,'Disokong','SUPPORTED',1,'2026-05-04 22:22:15','2026-05-04 22:22:15','2026-05-04 22:22:15',NULL),(7,13,2,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vitae ante tellus. Quisque vitae finibus velit, ut rhoncus libero. Donec id sem nibh. Ut vulputate mauris magna, sed facilisis elit finibus eu. Donec ut sem egestas, luctus velit non, imperdiet orci. Morbi vitae malesuada sapien. Nulla pharetra volutpat urna. Donec.','SUPPORTED',1,'2026-05-28 14:04:39','2026-05-28 14:04:39','2026-05-28 14:04:39',NULL),(8,14,2,'Sedia untuk kegunaan tanah','SUPPORTED',1,'2026-05-28 19:18:46','2026-05-28 19:18:46','2026-05-28 19:18:46',NULL);
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
INSERT INTO `sessions` VALUES ('ol4mRYB5SJp3nCiMTnuJEiByg9YhyzXEW6HXvu2D',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTVNsR01sTzNlc1NUcEU5MFhGbTJKUTBPZVJ6SktVZmsyeHJsT0UzRSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjYzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvb2ZmaWNlci9hcHBsaWNhdGlvbnMvMTUvc2l0ZS12aXNpdC9jcmVhdGUiO3M6NToicm91dGUiO3M6MjU6Im9mZmljZXIuc2l0ZS12aXNpdC5jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=',1780141007);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_visits`
--

LOCK TABLES `site_visits` WRITE;
/*!40000 ALTER TABLE `site_visits` DISABLE KEYS */;
INSERT INTO `site_visits` VALUES (9,10,2,'2026-05-03','Hutan','[\"photos/c5xIdRdhQMZVA7Iq1ejfJREfcIifobUa7NoOsCx4.png\"]','Hutan','[\"photos/IBZiTlrlA753RA5TX2e8uJ6jC8x5pro5sImdrjVr.png\"]','Hutan','[\"photos/Jix71qWQekTWjqiRIiG6Z957S3EGgbwp2FyXaDXv.png\"]','Hutan','[\"photos/drq91z3Rl8qmwbD18Hk5r0vXIu8Jn3GDRFFiWSt5.png\"]',NULL,NULL,NULL,NULL,NULL,'kawasan lapang kawasan baru','terdapat longkang tanah.','Tiada','tiada','semak','berbukit','Pertanian','20 orang',0,NULL,'Tiada keperluan','Tiada Keperluan','5.42860000, 100.37900000','COMPLETED','2026-05-03 15:40:28','2026-05-03 15:40:28',NULL,NULL,NULL,NULL,NULL),(11,11,2,'2026-05-04','Hutan','[\"photos/photos_north-1777860101652-157396478.png\"]','Hutan','[\"photos/photos_south-1777860101673-743314420.png\"]','Hutan','[\"photos/photo_east-1777860101674-773414532.png\"]','Hutan','[\"photos/photo_west-1777860101674-163473048.png\"]',NULL,NULL,NULL,NULL,NULL,'Tiada Aktiviti','Tiada ','tiada','tiada','tiada','Berbukit ','tiada','10',1,NULL,'tiada','Tiada ','5.428600, 100.379000','COMPLETED',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,13,2,'2026-05-28','Semak Samun','[\"photos/aHtaOFxFzITYi4EcqgndtODpTjg9d6nWGEWEgEcR.png\"]','Semak samun','[\"photos/HLFQTwOGsP0WdUHjmacHQrX9aF0hY8nexz7FVnr3.png\"]','Semak samun',NULL,'Semak samun','[\"photos/wuxukS3wUyL40nPjTDa7KI7b8PrgZzCy3lrKh6m5.png\"]','Jalan Masuk','[\"photos/8cLWqW6pnzd8wDaX9yC5H3w19yYFKU2nWSGGE0C3.png\"]','Lokasi cadangan','[\"photos/0OWmltPyUWM48ZipELbIcxsBb1Md2a7sO1KU91SS.png\"]',NULL,'kawasan lapang kawasan baru','tiada','Tiada','tiada','semak','baik','Pertanian','10 keluarga',1,NULL,'tiada','tiada','5.33380000, 100.26580000','COMPLETED','2026-05-28 14:03:23','2026-05-28 14:03:23',NULL,NULL,NULL,NULL,NULL),(13,14,2,'2026-05-29','Semak','[\"photos/m5Binka2RXFA7hYCvrbc8Fo6iv0Vx1Tll35bLsxh.png\"]','sefasdasdfasd','[\"photos/5wF1zY0QrDAfDShCTOkjh7PWABWiOe67fajndDRz.png\"]','aseraevcad','[\"photos/Q09VQ4Bn5aTnbJIWcTVv2yshqRL7k9NgF1TpHleG.png\"]','ewradaf','[\"photos/ZDZyoGELXaNaiAeUVnBmFA9RDZqwyvqnGk7NewuL.png\"]','daddeesasdf','[\"photos/wccs9FPXVq0lNv3JBqlAEajxbtMqHgeBAMbFqubD.png\"]','dasdfvasdfawera','[\"photos/FeazjSGsS1t8LycAFb8yObsQmYNz3ztbqw2X1jLU.png\"]',NULL,'kawasan lapang kawasan baru','tiada','Tiada','tiada','semak','baik','Pertanian','10 keluarga',1,NULL,'2','tiada','5.33380000, 100.26580000','COMPLETED','2026-05-28 19:17:38','2026-05-28 19:17:38',NULL,NULL,NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sites`
--

LOCK TABLES `sites` WRITE;
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;
INSERT INTO `sites` VALUES (8,10,'ASAHAN',NULL,'101',25.0000,'2.386041,102.532776',NULL,NULL,'101','map sheet','Pertanian','Freehold','REGISTERED',1,'2026-05-03 15:39:04','2026-05-03 15:39:04',NULL),(9,11,'jasin',NULL,'bpk1',25.0000,'2.313774,102.448441',NULL,NULL,'205','25458','Pertanian','Frehold','REGISTERED',1,'2026-05-04 01:43:29','2026-05-04 01:43:29',NULL),(10,12,'jasin',NULL,'bpk1',25.0000,'2.386670,102.533122',NULL,NULL,'1519','25458','Pertanian','Frehold','REGISTERED',1,'2026-05-15 05:02:07','2026-05-15 05:02:07',NULL),(11,13,'BEMBAN',NULL,'212',45.0000,'2.394674,102.547444',NULL,NULL,'101','125','Pertanian','Free Hold','REGISTERED',1,'2026-05-18 05:19:10','2026-05-18 05:19:10',NULL),(12,14,'BEMBAN',NULL,'212',257.0000,'2.146451,102.426097',NULL,NULL,'101','125','Pertanian','Free Hold','REGISTERED',1,'2026-05-28 19:15:58','2026-05-28 19:15:58',NULL),(14,15,'01','BP1','BPK1.1',24.0000,'2.392039,102.379303',NULL,NULL,'101','map sheet','PERTANIAN','FRE HOLD','REGISTERED',1,'2026-05-30 03:13:15','2026-05-30 03:13:15',NULL);
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
INSERT INTO `users` VALUES (1,'nadia','nadia@mpjasin.gov.my','2026-03-18 21:09:02','$2y$12$AYBg1yphLw15udkLTsD.IewAAbAPGVQF1Rcjdoc2QAg6JFtrlOyWW','Clerk','Registration',1,'ezkfoXWlV9p31UPVgYJi3RfPD5leQV4L8IzoP00Y6GCz8CF4r1143sy5Z7UB','2026-03-18 21:09:02','2026-04-01 19:18:56'),(2,'Nazrin Almanzo','nazrin@mpjasin.gov.my','2026-03-18 21:09:02','$2y$12$Xt7fV/rX.PnBUWO.9/pS5egOaKp0vAI2HaIbtLAu3WVEM2ewaxkti','Officer','Site Operations',1,'FUIZ3NlTTKdUjlGWRagi92qTC0BOdlzJdVBdoCPMSQsVFIRPkrYN7LhmN27e','2026-03-18 21:09:02','2026-05-02 01:16:05'),(3,'Ashraf','ad@mpjasin.gov.my','2026-03-18 21:09:02','$2y$12$2AgDrrapEOiq5eYC/M1owe5wD.3Q7mTc340H1UBuI997NTiLChQmC','Assistant Director','Administration',1,'ySaWVfCeoWh0nZR1WSd1sQgIHI3YspfqxE6Y5anCECelHAH2ndalPIVZRbDO','2026-03-18 21:09:02','2026-03-18 21:19:07'),(4,'Hafidh Bin Sulaiman','hafidh@mpjasin.gov.my','2026-03-18 21:09:02','$2y$12$2pNnLctcm.b8Hle7jGEg7.P9Jbf43/B8k/p5tmH.tt8PlEqrygih.','Director','Management',1,'8b5uRdLiFKpxfssYsDDFcLPfD9uU5hYiK13BBNRtDwJ9n5FUKzd2yaXsmR0W','2026-03-18 21:09:02','2026-03-18 21:19:42'),(5,'System Administrator','admin@svrms.local','2026-03-18 21:09:02','$2y$12$3aMJcyc38RcV4VGinbMX9eqgx/u7fkKq9QFZTnDgpAOaXm.BTm0R6','Admin','IT Services',1,'q6hi05YlSd2OYlFF2nudfo7OmwpQKaGxpFxbNQUGbMY1TRsGcFFqFPn6zMth','2026-03-18 21:09:02','2026-03-18 21:09:02'),(6,'kharudin','din@mpjasin.gov.my',NULL,'$2y$12$DFqfHCXF6bQLcovajRa8m.9rMdrcbpyNBSFRFng9BWqjYLfMgu.qe','Officer','JPBD',1,NULL,'2026-03-18 21:21:27','2026-03-18 21:21:27'),(7,'zamzul','zam@mpjasin.gov.my',NULL,'$2y$12$WCltEoB94yKGWsjMFLf8O.YcvOOVNUs.wUwi90tj1CJcx.ut.fzZK','Admin','IT Services',1,NULL,'2026-03-18 21:21:57','2026-03-18 21:21:57');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verifications`
--

LOCK TABLES `verifications` WRITE;
/*!40000 ALTER TABLE `verifications` DISABLE KEYS */;
INSERT INTO `verifications` VALUES (3,13,3,'VERIFIED','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fermentum dolor a dolor ultrices vulputate. Proin quis nunc sem. Aliquam aliquet metus odio, et semper nulla varius non. Vestibulum hendrerit elit id augue mollis, sit amet ultrices tortor venenatis. Mauris molestie lacus tellus, et aliquam nulla bibendum vel. Praesent vestibulum dignissim turpis, quis egestas arcu tempor non. Mauris finibus felis vitae leo tempor condimentum. Ut vehicula mollis neque nec dictum. Mauris ligula purus, consectetur in ullamcorper ac, fringilla fringilla metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nunc volutpat elit in libero tincidunt pharetra.',NULL,'2026-05-28 14:09:03','2026-05-28 14:09:03','2026-05-28 14:09:03'),(4,10,3,'VERIFIED','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at sollicitudin ex, sagittis vulputate eros. Quisque ac enim in purus efficitur cursus. Aenean scelerisque suscipit ligula. Maecenas ut tellus vitae tortor interdum viverra. Maecenas volutpat magna nec dolor elementum, id pharetra justo rutrum. Pellentesque sed nisi sodales, ultricies eros sit.',NULL,'2026-05-28 15:14:20','2026-05-28 15:14:20','2026-05-28 15:14:20'),(5,11,3,'VERIFIED','Tapak terletak di zon gunatanah pertanian; BPK 3.4: Seri Kesang berdasarkan Rancangan Tempatan Majlid Perbandaran Jasin 2035',NULL,'2026-05-28 19:02:34','2026-05-28 19:02:34','2026-05-28 19:02:34'),(6,14,3,'VERIFIED','Terletak di zon tanah pertanian; BPK 3.4; Seri Kesang berdasarkan Rancangan Tempatan MPJ 2035','[{\"text\": \"Terletak di zon tanah pertanian; BPK 3.4; Seri Kesang berdasarkan Rancangan Tempatan MPJ 2035\", \"user_id\": 3, \"user_name\": \"Ashraf\", \"created_at\": \"29 May 2026, 03:40 AM\", \"updated_at\": \"29 May 2026, 03:40 AM\"}, {\"text\": \"Aktiviti yang dipohon merupakan aktiviti yang dibenarkan.\", \"user_id\": 3, \"user_name\": \"Ashraf\", \"created_at\": \"29 May 2026, 03:40 AM\", \"updated_at\": \"29 May 2026, 03:40 AM\"}, {\"text\": \"Pada pandangan MPJ, Dari segi saiz dan kedudukan tanah sesuai dipohon oleh agensi kerajaan.\", \"user_id\": 3, \"user_name\": \"Ashraf\", \"created_at\": \"29 May 2026, 03:40 AM\", \"updated_at\": \"29 May 2026, 03:40 AM\"}, {\"text\": \"Sebarang binaan dan kerja tanah perlu mendapatkan kelulusan Majlis Perbandaran Jasin terlebih dahulu.\", \"user_id\": 3, \"user_name\": \"Ashraf\", \"created_at\": \"29 May 2026, 03:40 AM\", \"updated_at\": \"29 May 2026, 03:40 AM\"}]','2026-05-28 19:40:17','2026-05-28 19:40:17','2026-05-28 19:40:17');
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

-- Dump completed on 2026-05-30 19:42:35
