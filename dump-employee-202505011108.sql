-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: employee
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
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
-- Table structure for table `daily_achievements`
--

DROP TABLE IF EXISTS `daily_achievements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `daily_achievements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `production_id` int NOT NULL,
  `divisi_id` int NOT NULL,
  `operator_id` int NOT NULL,
  `date_production` datetime NOT NULL,
  `achievement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_achievements`
--

LOCK TABLES `daily_achievements` WRITE;
/*!40000 ALTER TABLE `daily_achievements` DISABLE KEYS */;
INSERT INTO `daily_achievements` VALUES (1,1,1,10,'2025-03-13 00:00:00','83',NULL,NULL),(2,2,1,10,'2025-03-13 00:00:00','61',NULL,NULL),(3,3,1,21,'2025-04-05 00:00:00','46',NULL,NULL),(5,4,1,20,'2025-04-17 00:00:00','10','2025-04-26 07:16:08','2025-04-26 07:16:08');
/*!40000 ALTER TABLE `daily_achievements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divisions`
--

DROP TABLE IF EXISTS `divisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divisions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisions`
--

LOCK TABLES `divisions` WRITE;
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
INSERT INTO `divisions` VALUES (1,'Wire Brush',NULL,NULL),(2,'Finishing',NULL,NULL),(3,'Swagging',NULL,NULL),(4,'Nox Rust',NULL,NULL),(5,'CenterLess Grinding',NULL,NULL),(6,'Jig Toggle',NULL,NULL),(7,'Jig Toggle 2',NULL,NULL),(8,'Jig Diameter',NULL,NULL),(9,'Inspection',NULL,NULL),(10,'Painting',NULL,NULL),(11,'Assy Step',NULL,NULL);
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;
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
-- Table structure for table `main_group`
--

DROP TABLE IF EXISTS `main_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `main_group` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `main_group`
--

LOCK TABLES `main_group` WRITE;
/*!40000 ALTER TABLE `main_group` DISABLE KEYS */;
INSERT INTO `main_group` VALUES (1,1,20,NULL,NULL),(2,1,21,NULL,NULL),(3,2,14,NULL,NULL),(4,2,22,NULL,NULL),(5,3,18,NULL,NULL),(6,3,19,NULL,NULL),(7,3,10,NULL,NULL);
/*!40000 ALTER TABLE `main_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_group`
--

DROP TABLE IF EXISTS `master_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_group` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leader_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_group`
--

LOCK TABLES `master_group` WRITE;
/*!40000 ALTER TABLE `master_group` DISABLE KEYS */;
INSERT INTO `master_group` VALUES (1,'AKKU/202501',11,NULL,NULL),(2,'AKKU/202502',15,NULL,NULL),(3,'AKKU/202503',17,NULL,NULL);
/*!40000 ALTER TABLE `master_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_product`
--

DROP TABLE IF EXISTS `master_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_product` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_product`
--

LOCK TABLES `master_product` WRITE;
/*!40000 ALTER TABLE `master_product` DISABLE KEYS */;
INSERT INTO `master_product` VALUES (1,'Metal',NULL,NULL),(2,'Rubber',NULL,NULL);
/*!40000 ALTER TABLE `master_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_product_enginering`
--

DROP TABLE IF EXISTS `master_product_enginering`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_product_enginering` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `master_id` bigint NOT NULL,
  `date` timestamp NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi_id` bigint NOT NULL,
  `result_of_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_product_enginering`
--

LOCK TABLES `master_product_enginering` WRITE;
/*!40000 ALTER TABLE `master_product_enginering` DISABLE KEYS */;
INSERT INTO `master_product_enginering` VALUES (1,2,'2025-03-12 17:00:00','005024',0,'0','-'),(3,2,'2025-03-12 17:00:00','005026',1,'432','Active'),(4,2,'2025-03-12 17:00:00','005026',2,'480','Active'),(5,2,'2025-03-12 17:00:00','005026',3,'595','Active'),(6,2,'2025-03-12 17:00:00','005026',4,'0','Active'),(7,2,'2025-03-12 17:00:00','005026',5,'450','Active'),(8,2,'2025-03-12 17:00:00','005026',6,'0','Active'),(9,2,'2025-03-12 17:00:00','005026',7,'0','Active'),(10,2,'2025-03-12 17:00:00','005026',8,'3230','Active'),(11,2,'2025-03-12 17:00:00','005026',9,'846','Active'),(12,2,'2025-03-12 17:00:00','005026',10,'0','Active'),(13,2,'2025-03-12 17:00:00','005026',11,'0','Active'),(14,2,'2025-03-12 17:00:00','005028',1,'328','Active'),(15,2,'2025-03-12 17:00:00','005028',2,'463','Active'),(16,2,'2025-03-12 17:00:00','005028',3,'580','Active'),(17,2,'2025-03-12 17:00:00','005028',4,'0','Active'),(18,2,'2025-03-12 17:00:00','005028',5,'475','Active'),(19,2,'2025-03-12 17:00:00','005028',6,'0','Active'),(20,2,'2025-03-12 17:00:00','005028',7,'0','Active'),(21,2,'2025-03-12 17:00:00','005028',8,'500','Active'),(22,2,'2025-03-12 17:00:00','005028',9,'635','Active'),(23,2,'2025-03-12 17:00:00','005028',10,'0','Active'),(24,2,'2025-03-12 17:00:00','005028',11,'0','Active'),(25,2,'2025-03-12 17:00:00','005029',1,'326','Active'),(26,2,'2025-03-12 17:00:00','005029',2,'431','Active'),(27,2,'2025-03-12 17:00:00','005029',3,'550','Active'),(28,2,'2025-03-12 17:00:00','005029',4,'0','Active'),(29,2,'2025-03-12 17:00:00','005029',5,'450','Active'),(30,2,'2025-03-12 17:00:00','005029',6,'0','Active'),(31,2,'2025-03-12 17:00:00','005029',7,'0','Active'),(32,2,'2025-03-12 17:00:00','005029',8,'1402','Active'),(33,2,'2025-03-12 17:00:00','005029',9,'551','Active'),(34,2,'2025-03-12 17:00:00','005029',10,'0','Active'),(35,2,'2025-03-12 17:00:00','005029',11,'0','Active');
/*!40000 ALTER TABLE `master_product_enginering` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_09_29_035834_create_user_roles_table',2),(5,'2024_09_29_052028_create_productions_table',3),(6,'2025_02_28_232107_division',4),(7,'2025_02_28_232134_report_production',5),(8,'2025_02_28_232145_report_detail_production',6),(9,'2025_02_28_232215_report_detail_lot',7),(10,'2025_03_01_055923_report__approval',8),(11,'2025_03_13_125732_master_product',9),(12,'2025_03_13_125810_master_product_enginering',10),(13,'2025_04_06_153220_daily_achievement',11),(14,'2025_04_06_193655_main_group',12),(15,'2025_04_06_193633_master_group',13);
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
-- Table structure for table `productions`
--

DROP TABLE IF EXISTS `productions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `report_approval_id` bigint DEFAULT NULL,
  `date_production` datetime DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `standart` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ok` int DEFAULT NULL,
  `percent_of_ok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ng` int DEFAULT NULL,
  `percent_of_ng` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` int DEFAULT NULL,
  `achievement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_byId` int DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_byId` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productions`
--

LOCK TABLES `productions` WRITE;
/*!40000 ALTER TABLE `productions` DISABLE KEYS */;
INSERT INTO `productions` VALUES (1,3,'2025-03-13 00:00:00','005026','432','0.5','216',180,'83.33',0,'0.00',180,'83',NULL,'2025-04-05 16:20:32','2025-04-05 09:20:32','nova',9,NULL,NULL),(2,3,'2025-03-13 00:00:00','005028','328','1','328',200,'60.98',0,'0.00',200,'61',NULL,'2025-04-05 16:20:32','2025-04-05 09:20:32','nova',9,NULL,NULL),(3,4,'2025-04-05 00:00:00','005026','432','1','432',200,'46.30',0,'0.00',200,'46',NULL,'2025-04-06 14:33:54','2025-04-06 14:33:54','nova',9,NULL,NULL),(4,6,'2025-04-17 00:00:00','005026','432','0.5','216',20,'9',1,'5',21,'10',NULL,'2025-04-26 07:16:08','2025-04-26 07:16:08','Nova Indah Damayanti',9,NULL,NULL);
/*!40000 ALTER TABLE `productions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_approval`
--

DROP TABLE IF EXISTS `report_approval`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report_approval` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `divisi_id` bigint NOT NULL,
  `report_id` bigint NOT NULL,
  `report_detail_id` bigint NOT NULL,
  `approval_id` bigint NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_approval`
--

LOCK TABLES `report_approval` WRITE;
/*!40000 ALTER TABLE `report_approval` DISABLE KEYS */;
INSERT INTO `report_approval` VALUES (3,1,11,0,11,'Approve','2025-03-13 14:10:39',11,'2025-04-05 16:20:32'),(4,1,12,0,15,'Approve','2025-04-06 14:32:56',15,'2025-04-06 14:33:54'),(5,10,13,0,11,'Reject','2025-04-19 10:01:46',11,'2025-04-19 10:27:35'),(6,1,14,0,11,'Approve','2025-04-26 07:14:46',11,'2025-04-26 07:16:08');
/*!40000 ALTER TABLE `report_approval` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_detail_lot`
--

DROP TABLE IF EXISTS `report_detail_lot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report_detail_lot` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `report_id` bigint NOT NULL,
  `report_detail_id` bigint NOT NULL,
  `no_lot` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_detail_lot`
--

LOCK TABLES `report_detail_lot` WRITE;
/*!40000 ALTER TABLE `report_detail_lot` DISABLE KEYS */;
INSERT INTO `report_detail_lot` VALUES (10,11,9,'1982','180','0','30','180','-','2025-03-13 14:01:17',NULL),(11,11,10,'1891','200','0','60','200','-','2025-03-13 14:01:17',NULL),(12,12,11,'10910','200','0','60','200','-','2025-04-06 14:31:18',NULL),(13,13,12,'1982','200','0','60','200','-','2025-04-19 09:33:14',NULL),(14,13,12,'1983','150','50','60','200','Mesin Rusak','2025-04-19 09:33:14',NULL),(15,13,13,'1982','200','0','60','200','-','2025-04-19 09:33:14',NULL),(16,14,14,'121212','20','1','30','31','ng mc','2025-04-26 07:12:22',NULL),(17,14,14,'131313','33','2','10','35','ng kk','2025-04-26 07:12:22',NULL);
/*!40000 ALTER TABLE `report_detail_lot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_detail_productions`
--

DROP TABLE IF EXISTS `report_detail_productions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report_detail_productions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `report_id` bigint NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_detail_productions`
--

LOCK TABLES `report_detail_productions` WRITE;
/*!40000 ALTER TABLE `report_detail_productions` DISABLE KEYS */;
INSERT INTO `report_detail_productions` VALUES (9,11,'005026','2025-03-13 14:01:17',NULL),(10,11,'005028','2025-03-13 14:01:17',NULL),(11,12,'005026','2025-04-06 14:31:18',NULL),(12,13,'005026','2025-04-19 09:33:14',NULL),(13,13,'005029','2025-04-19 09:33:14',NULL),(14,14,'005026','2025-04-26 07:12:22',NULL);
/*!40000 ALTER TABLE `report_detail_productions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_productions`
--

DROP TABLE IF EXISTS `report_productions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report_productions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `divisi_id` bigint NOT NULL,
  `leader_id` bigint NOT NULL,
  `date_production` timestamp NOT NULL,
  `operator_id` bigint DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_productions`
--

LOCK TABLES `report_productions` WRITE;
/*!40000 ALTER TABLE `report_productions` DISABLE KEYS */;
INSERT INTO `report_productions` VALUES (11,1,11,'2025-03-12 17:00:00',10,'Andi','1','Sudah Approve','2025-03-13 14:01:17',NULL,'2025-03-13 14:10:39'),(12,1,15,'2025-04-04 17:00:00',21,'Dikry Firdaus','1','Sudah Approve','2025-04-06 14:31:18',NULL,'2025-04-06 14:32:56'),(13,10,11,'2025-04-17 17:00:00',18,'Sheyla Sepriliyani','2','Sudah Approve','2025-04-19 09:33:13',NULL,'2025-04-19 10:01:46'),(14,1,11,'2025-04-16 17:00:00',20,'Ismi Nurbaeti','1','Sudah Approve','2025-04-26 07:12:22',NULL,'2025-04-26 07:14:46');
/*!40000 ALTER TABLE `report_productions` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('L9suLueUfbQd94vupLyTxjXUnKzwkZxFpVzBXE6t',9,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 OPR/117.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRmVqUWNZZ0YyRWVtQ2pVcUZtbmw5OU5pdVByQ0R2cmE5aVQzcmNKRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wcm9kdWN0aW9uL29wZXJhdG9yLXByb2R1a3NpIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6OTtzOjEwOiJhdXRoX2xvZ2luIjtiOjE7fQ==',1745651969),('rYvdEWDqEUXK30HCnZA6gGjZ2HDmkJ8n5t6yQgMm',9,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 OPR/118.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOVh0bmo1YkhQdzhlREFlMUt4WDZyc3U1UlFPMjlsbEpoZFlMNnZDaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wcm9kdWN0aW9uLW1vbnRobHk/YnVsYW49MjAyNS0wNCZkaXZpc2k9Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6OTtzOjEwOiJhdXRoX2xvZ2luIjtiOjE7fQ==',1746064035),('sTeLsbB2MEeSDlxdEmwClTWr2ymTr5aCMSCX9Ynh',9,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 OPR/118.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoidHRWOGw4emhrY2g1TFZaU1g4cTJCbVl3dDZTS0IzVGlaSlVhYUZMTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9tb25pdG9yaW5nR3JvdXAiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo5O3M6MTA6ImF1dGhfbG9naW4iO2I6MTt9',1746072174),('zI7ewVAUI37dm5ms6ijVbppwVffY8ArSFhiNqa6c',9,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 OPR/118.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWk0ydUh3M0RQRnF6dVY1Z1pHUlptaXRVUmhHbnhwTllheVlzNlgxSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk7czoxMDoiYXV0aF9sb2dpbiI7YjoxO30=',1746072142);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_management`
--

DROP TABLE IF EXISTS `user_management`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_management` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `role_id` bigint DEFAULT NULL,
  `menu_id` bigint DEFAULT NULL,
  `feature_id` bigint DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `created_id` bigint DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `updated_id` bigint DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_management`
--

LOCK TABLES `user_management` WRITE;
/*!40000 ALTER TABLE `user_management` DISABLE KEYS */;
INSERT INTO `user_management` VALUES (1,NULL,1,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,NULL,1,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,NULL,1,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,NULL,1,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,NULL,6,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,NULL,6,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,NULL,5,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,NULL,5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,NULL,5,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,NULL,5,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,NULL,3,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,NULL,3,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,NULL,3,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,NULL,6,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `user_management` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_menu`
--

DROP TABLE IF EXISTS `user_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_menu` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_menu`
--

LOCK TABLES `user_menu` WRITE;
/*!40000 ALTER TABLE `user_menu` DISABLE KEYS */;
INSERT INTO `user_menu` VALUES (1,'Dashboard Leader'),(2,'Dashboard Admin'),(3,'Dashboard Manager'),(4,'Laporan Harian'),(5,'Laporan Produksi'),(6,'Laporan Bulanan'),(7,'Monitoring Group'),(11,'Operator Produksi');
/*!40000 ALTER TABLE `user_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1,'Admin',NULL,NULL),(2,'Karyawan',NULL,NULL),(3,'Hr Admin',NULL,NULL),(4,'Operator',NULL,NULL),(5,'Managemen',NULL,NULL),(6,'Leader',NULL,NULL);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (9,1,'Nova Indah Damayanti','nova@akku.co.id',NULL,'$2y$12$lsNmbHH7qspyb2PrHYQrDeuXsYN1gf5VQMMG.1JEt/Px0RTvCyKnK','SK2ay5MSPCTQxh7N9laSK09JnQlHHF3BRy9HgbEp0z0Jl86YXGICVTFdPkVZ','2024-09-28 20:24:59',NULL),(10,4,'Andi Karna','andi@akku.co.id',NULL,'$2y$12$lsNmbHH7qspyb2PrHYQrDeuXsYN1gf5VQMMG.1JEt/Px0RTvCyKnK','fXOjFKUaNdPfiBtWzBYsUhGvPomkLCGEvBZhxZikpRuDtyeskgOaavgWGftO','2024-09-28 21:32:21',NULL),(11,6,'Epan Rusliana','epan@akku.co.id',NULL,'$2y$12$lsNmbHH7qspyb2PrHYQrDeuXsYN1gf5VQMMG.1JEt/Px0RTvCyKnK','oxVQgc7OOjTdnA2nNXSpeAV1bIjF7cEvsVvmzedgnnjqZLf0nrx3vHZc7qA7','2024-10-05 23:38:07',NULL),(12,3,'Anton Prayogo','anton@akku.co.id',NULL,'$2y$12$lsNmbHH7qspyb2PrHYQrDeuXsYN1gf5VQMMG.1JEt/Px0RTvCyKnK','0BVqmmFa1RrklySjBbsIu8bhFTdxrHr5LRX4G0FWwrm6dSOynE4RXwsoKEjV','2025-01-27 21:36:58',NULL),(13,5,'Fauzi','fauzi@akku.co.id',NULL,'$2y$12$lsNmbHH7qspyb2PrHYQrDeuXsYN1gf5VQMMG.1JEt/Px0RTvCyKnK','KeTBEoTOox3HaFUmzBg9UwdSE3lHYm1UNixhzHAhKT3NLcSBwMqGhnfGJbtL','2025-02-22 23:05:43',NULL),(14,4,'mukdi','mukdi@akku.co.id',NULL,'$2y$12$lsNmbHH7qspyb2PrHYQrDeuXsYN1gf5VQMMG.1JEt/Px0RTvCyKnK','KeTBEoTOox3HaFUmzBg9UwdSE3lHYm1UNixhzHAhKT3NLcSBwMqGhnfGJbtL','2025-02-22 23:05:43',NULL),(15,6,'Topik Hidayat','topik@akku.co.id',NULL,'$2y$12$lsNmbHH7qspyb2PrHYQrDeuXsYN1gf5VQMMG.1JEt/Px0RTvCyKnK','koWv6fTx8Mm3JD4835rqmb3lHd9pO6bScZs7TZRTHkw4n7ruf7pDIKfPfZBy','2025-02-22 23:05:43',NULL),(17,6,'Iskak Nuryanto','iskak@akku.co.id',NULL,'$2y$12$lsNmbHH7qspyb2PrHYQrDeuXsYN1gf5VQMMG.1JEt/Px0RTvCyKnK','KeTBEoTOox3HaFUmzBg9UwdSE3lHYm1UNixhzHAhKT3NLcSBwMqGhnfGJbtL','2025-02-22 23:05:43',NULL),(18,4,'Sheyla Sepriliyani','sheyla@akku.co.id',NULL,'$2y$12$lsNmbHH7qspyb2PrHYQrDeuXsYN1gf5VQMMG.1JEt/Px0RTvCyKnK','fXOjFKUaNdPfiBtWzBYsUhGvPomkLCGEvBZhxZikpRuDtyeskgOaavgWGftO','2024-09-28 21:32:21',NULL),(19,4,'Nurhuda','nurhuda@akku.co.id',NULL,'$2y$12$lsNmbHH7qspyb2PrHYQrDeuXsYN1gf5VQMMG.1JEt/Px0RTvCyKnK','fXOjFKUaNdPfiBtWzBYsUhGvPomkLCGEvBZhxZikpRuDtyeskgOaavgWGftO','2024-09-28 21:32:21',NULL),(20,4,'Ismi Nurbaeti','ismi@akku.co.id',NULL,'$2y$12$lsNmbHH7qspyb2PrHYQrDeuXsYN1gf5VQMMG.1JEt/Px0RTvCyKnK','fXOjFKUaNdPfiBtWzBYsUhGvPomkLCGEvBZhxZikpRuDtyeskgOaavgWGftO','2024-09-28 21:32:21',NULL),(21,4,'Dikry Firdaus','dikry@akku.co.id',NULL,'$2y$12$lsNmbHH7qspyb2PrHYQrDeuXsYN1gf5VQMMG.1JEt/Px0RTvCyKnK','fXOjFKUaNdPfiBtWzBYsUhGvPomkLCGEvBZhxZikpRuDtyeskgOaavgWGftO','2024-09-28 21:32:21',NULL),(22,4,'Afriana Haris','haris@akku.co.id',NULL,'$2y$12$lsNmbHH7qspyb2PrHYQrDeuXsYN1gf5VQMMG.1JEt/Px0RTvCyKnK','KeTBEoTOox3HaFUmzBg9UwdSE3lHYm1UNixhzHAhKT3NLcSBwMqGhnfGJbtL','2025-02-22 23:05:43',NULL),(23,4,'Lala','lala@akku.com',NULL,'$2y$12$2jQ3WxtqbF1QU5Q305uKdOJL9G1j6zNRS.ZR2IYOAcVUEh0CaGv3m','ZdULxMPCOzQ11GKZVn1yqJmAjdNh574XilinYjXbZN47IOVdO6HO3cDCEwed','2025-04-26 07:08:16',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'employee'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-01 11:08:25
