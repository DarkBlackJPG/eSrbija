-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: esrbija
-- ------------------------------------------------------
-- Server version	8.0.18

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
-- Table structure for table `administrators`
--

DROP TABLE IF EXISTS `administrators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrators` (
  `id` bigint(20) unsigned NOT NULL,
  `ime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `administrators_id_foreign` FOREIGN KEY (`id`) REFERENCES `korisniks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrators`
--

LOCK TABLES `administrators` WRITE;
/*!40000 ALTER TABLE `administrators` DISABLE KEYS */;
INSERT INTO `administrators` VALUES (1,'Drazen','Draskovic','2020-06-01 21:26:08','2020-06-01 21:26:08');
/*!40000 ALTER TABLE `administrators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ankete_mestos`
--

DROP TABLE IF EXISTS `ankete_mestos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ankete_mestos` (
  `ankete_id` bigint(20) unsigned NOT NULL,
  `mesto_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`ankete_id`,`mesto_id`),
  UNIQUE KEY `ankete_mestos_ankete_id_mesto_id_unique` (`ankete_id`,`mesto_id`),
  KEY `ankete_mestos_mesto_id_foreign` (`mesto_id`),
  CONSTRAINT `ankete_mestos_ankete_id_foreign` FOREIGN KEY (`ankete_id`) REFERENCES `anketes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ankete_mestos_mesto_id_foreign` FOREIGN KEY (`mesto_id`) REFERENCES `mestos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ankete_mestos`
--

LOCK TABLES `ankete_mestos` WRITE;
/*!40000 ALTER TABLE `ankete_mestos` DISABLE KEYS */;
INSERT INTO `ankete_mestos` VALUES (2,1),(3,1),(2,5),(2,6);
/*!40000 ALTER TABLE `ankete_mestos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anketes`
--

DROP TABLE IF EXISTS `anketes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anketes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `naziv` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obrisanoFlag` tinyint(1) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `nivoLokNac` int(11) NOT NULL,
  `tip` int(11) NOT NULL,
  `korisnik_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `anketes_korisnik_id_foreign` (`korisnik_id`),
  CONSTRAINT `anketes_korisnik_id_foreign` FOREIGN KEY (`korisnik_id`) REFERENCES `korisniks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anketes`
--

LOCK TABLES `anketes` WRITE;
/*!40000 ALTER TABLE `anketes` DISABLE KEYS */;
INSERT INTO `anketes` VALUES (1,'Izbori',0,1,0,2,1,'2020-06-01 19:38:47','2020-06-01 19:38:47'),(2,'Ocena projekta',0,1,1,0,1,'2020-06-01 19:40:25','2020-06-01 19:40:25'),(3,'Prikupljanje potpisa',0,1,1,0,3,'2020-06-01 19:47:23','2020-06-01 19:47:23'),(4,'Ocena projekta moderator',0,1,0,0,3,'2020-06-01 19:50:12','2020-06-01 19:50:12');
/*!40000 ALTER TABLE `anketes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategorije_obavestenjas`
--

DROP TABLE IF EXISTS `kategorije_obavestenjas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategorije_obavestenjas` (
  `obavestenja_id` bigint(20) unsigned NOT NULL,
  `kategorije_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`obavestenja_id`,`kategorije_id`),
  UNIQUE KEY `kategorije_obavestenjas_obavestenja_id_kategorije_id_unique` (`obavestenja_id`,`kategorije_id`),
  KEY `kategorije_obavestenjas_kategorije_id_foreign` (`kategorije_id`),
  CONSTRAINT `kategorije_obavestenjas_kategorije_id_foreign` FOREIGN KEY (`kategorije_id`) REFERENCES `kategorijes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `kategorije_obavestenjas_obavestenja_id_foreign` FOREIGN KEY (`obavestenja_id`) REFERENCES `obavestenjas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategorije_obavestenjas`
--

LOCK TABLES `kategorije_obavestenjas` WRITE;
/*!40000 ALTER TABLE `kategorije_obavestenjas` DISABLE KEYS */;
INSERT INTO `kategorije_obavestenjas` VALUES (1,1),(3,1),(2,20);
/*!40000 ALTER TABLE `kategorije_obavestenjas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategorije_ovlascenjas`
--

DROP TABLE IF EXISTS `kategorije_ovlascenjas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategorije_ovlascenjas` (
  `korisnik_id` bigint(20) unsigned NOT NULL,
  `kategorije_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`korisnik_id`,`kategorije_id`),
  UNIQUE KEY `kategorije_ovlascenjas_korisnik_id_kategorije_id_unique` (`korisnik_id`,`kategorije_id`),
  KEY `kategorije_ovlascenjas_kategorije_id_foreign` (`kategorije_id`),
  CONSTRAINT `kategorije_ovlascenjas_kategorije_id_foreign` FOREIGN KEY (`kategorije_id`) REFERENCES `kategorijes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `kategorije_ovlascenjas_korisnik_id_foreign` FOREIGN KEY (`korisnik_id`) REFERENCES `korisniks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategorije_ovlascenjas`
--

LOCK TABLES `kategorije_ovlascenjas` WRITE;
/*!40000 ALTER TABLE `kategorije_ovlascenjas` DISABLE KEYS */;
INSERT INTO `kategorije_ovlascenjas` VALUES (3,1),(3,2);
/*!40000 ALTER TABLE `kategorije_ovlascenjas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategorije_pretplates`
--

DROP TABLE IF EXISTS `kategorije_pretplates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategorije_pretplates` (
  `korisnik_id` bigint(20) unsigned NOT NULL,
  `kategorije_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`korisnik_id`,`kategorije_id`),
  UNIQUE KEY `kategorije_pretplates_korisnik_id_kategorije_id_unique` (`korisnik_id`,`kategorije_id`),
  KEY `kategorije_pretplates_kategorije_id_foreign` (`kategorije_id`),
  CONSTRAINT `kategorije_pretplates_kategorije_id_foreign` FOREIGN KEY (`kategorije_id`) REFERENCES `kategorijes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `kategorije_pretplates_korisnik_id_foreign` FOREIGN KEY (`korisnik_id`) REFERENCES `korisniks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategorije_pretplates`
--

LOCK TABLES `kategorije_pretplates` WRITE;
/*!40000 ALTER TABLE `kategorije_pretplates` DISABLE KEYS */;
/*!40000 ALTER TABLE `kategorije_pretplates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategorijes`
--

DROP TABLE IF EXISTS `kategorijes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategorijes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `naziv` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategorijes`
--

LOCK TABLES `kategorijes` WRITE;
/*!40000 ALTER TABLE `kategorijes` DISABLE KEYS */;
INSERT INTO `kategorijes` VALUES (1,'Omladina i sport','2020-06-01 21:31:39','2020-06-01 21:31:39'),(2,'Energetika i rudarstvo','2020-06-01 21:31:39','2020-06-01 21:31:39'),(3,'Prosveta,nauka i tehnološki razvoj','2020-06-01 21:31:39','2020-06-01 21:31:39'),(4,'Zdravlje','2020-06-01 21:31:39','2020-06-01 21:31:39'),(5,'Kultura i informisanje','2020-06-01 21:31:39','2020-06-01 21:31:39'),(6,'Odbrana','2020-06-01 21:31:39','2020-06-01 21:31:39'),(7,'Finansije','2020-06-01 21:31:39','2020-06-01 21:31:39'),(8,'Poljoprivreda,šumarstvo i vodoprivreda','2020-06-01 21:31:39','2020-06-01 21:31:39'),(9,'Spoljni poslovi','2020-06-01 21:31:39','2020-06-01 21:31:39'),(10,'Regionalni razvoj i koordinacija rada preduzeća','2020-06-01 21:31:39','2020-06-01 21:31:39'),(11,'Unutrašnji poslovi','2020-06-01 21:31:39','2020-06-01 21:31:39'),(12,'Trgovina, turizam i telekomunikacije','2020-06-01 21:31:39','2020-06-01 21:31:39'),(13,'Građevinarstvo, saobraćaj i infrastruktura','2020-06-01 21:31:39','2020-06-01 21:31:39'),(14,'Privreda','2020-06-01 21:31:39','2020-06-01 21:31:39'),(15,'Zaštita životne sredine','2020-06-01 21:31:39','2020-06-01 21:31:39'),(16,'Pravda','2020-06-01 21:31:39','2020-06-01 21:31:39'),(17,'Evropske integracije','2020-06-01 21:31:39','2020-06-01 21:31:39'),(18,'Rad, zapošljavanje, boračka i socijalna pitanja','2020-06-01 21:31:39','2020-06-01 21:31:39'),(19,'Demografija i populaciona politika','2020-06-01 21:31:39','2020-06-01 21:31:39'),(20,'VAZNO','2020-06-01 21:31:39','2020-06-01 21:31:39');
/*!40000 ALTER TABLE `kategorijes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `korisniks`
--

DROP TABLE IF EXISTS `korisniks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `korisniks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verification_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `isMod` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `korisniks_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisniks`
--

LOCK TABLES `korisniks` WRITE;
/*!40000 ALTER TABLE `korisniks` DISABLE KEYS */;
INSERT INTO `korisniks` VALUES (1,'admin@admin','2020-06-01 21:26:07',NULL,'$2y$10$l4/4pWDtHHhkZBJslDvxjulCeiUWciyBcJbz40OQmxhtc8ZdZ98He',1,1,NULL,'2020-06-01 21:26:07','2020-06-01 21:26:07'),(2,'kor@kor','2020-06-01 21:26:07',NULL,'$2y$10$l4/4pWDtHHhkZBJslDvxjulCeiUWciyBcJbz40OQmxhtc8ZdZ98He',0,0,NULL,'2020-06-01 21:26:07','2020-06-01 21:26:07'),(3,'mod@mod','2020-06-01 21:26:07',NULL,'$2y$10$l4/4pWDtHHhkZBJslDvxjulCeiUWciyBcJbz40OQmxhtc8ZdZ98He',0,1,NULL,'2020-06-01 21:26:07','2020-06-01 21:26:07');
/*!40000 ALTER TABLE `korisniks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mesto_obavestenjas`
--

DROP TABLE IF EXISTS `mesto_obavestenjas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mesto_obavestenjas` (
  `mesto_id` int(11) NOT NULL,
  `obavestenja_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesto_obavestenjas`
--

LOCK TABLES `mesto_obavestenjas` WRITE;
/*!40000 ALTER TABLE `mesto_obavestenjas` DISABLE KEYS */;
INSERT INTO `mesto_obavestenjas` VALUES (1,1,'2020-06-01 19:36:58','2020-06-01 19:36:58'),(1,3,'2020-06-01 19:46:11','2020-06-01 19:46:11');
/*!40000 ALTER TABLE `mesto_obavestenjas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mestos`
--

DROP TABLE IF EXISTS `mestos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mestos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `naziv` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mestos`
--

LOCK TABLES `mestos` WRITE;
/*!40000 ALTER TABLE `mestos` DISABLE KEYS */;
INSERT INTO `mestos` VALUES (1,'LAZAREVAC','2020-06-01 21:31:28','2020-06-01 21:31:28'),(2,'LAJKOVAC','2020-06-01 21:31:28','2020-06-01 21:31:28'),(3,'LAPOVO','2020-06-01 21:31:28','2020-06-01 21:31:28'),(4,'LEBANE','2020-06-01 21:31:28','2020-06-01 21:31:28'),(5,'LEPOSAVIĆ','2020-06-01 21:31:28','2020-06-01 21:31:28'),(6,'LESKOVAC','2020-06-01 21:31:28','2020-06-01 21:31:28'),(7,'LIPLJAN','2020-06-01 21:31:28','2020-06-01 21:31:28'),(8,'LOZNICA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(9,'LUČANI','2020-06-01 21:31:28','2020-06-01 21:31:28'),(10,'LJIG','2020-06-01 21:31:28','2020-06-01 21:31:28'),(11,'LJUBOVIJA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(12,'MAJDANPEK','2020-06-01 21:31:28','2020-06-01 21:31:28'),(13,'MALI ZVORNIK','2020-06-01 21:31:28','2020-06-01 21:31:28'),(14,'MALI IĐOŠ','2020-06-01 21:31:28','2020-06-01 21:31:28'),(15,'MALO CRNIĆE','2020-06-01 21:31:28','2020-06-01 21:31:28'),(16,'MEDVEĐA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(17,'MEDIANA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(18,'MEROŠINA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(19,'MIONICA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(20,'MLADENOVAC','2020-06-01 21:31:28','2020-06-01 21:31:28'),(21,'NEGOTIN','2020-06-01 21:31:28','2020-06-01 21:31:28'),(22,'NIŠKA BANJA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(23,'NOVA VAROŠ','2020-06-01 21:31:28','2020-06-01 21:31:28'),(24,'NOVA CRNJA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(25,'NOVI BEOGRAD','2020-06-01 21:31:28','2020-06-01 21:31:28'),(26,'NOVI BEČEJ','2020-06-01 21:31:28','2020-06-01 21:31:28'),(27,'NOVI KNEŽEVAC','2020-06-01 21:31:28','2020-06-01 21:31:28'),(28,'NOVI PAZAR','2020-06-01 21:31:28','2020-06-01 21:31:28'),(29,'NOVI SAD','2020-06-01 21:31:28','2020-06-01 21:31:28'),(30,'NOVO BRDO','2020-06-01 21:31:28','2020-06-01 21:31:28'),(31,'OBILIĆ','2020-06-01 21:31:28','2020-06-01 21:31:28'),(32,'OBRENOVAC','2020-06-01 21:31:28','2020-06-01 21:31:28'),(33,'OPOVO','2020-06-01 21:31:28','2020-06-01 21:31:28'),(34,'ORAHOVAC','2020-06-01 21:31:28','2020-06-01 21:31:28'),(35,'OSEČINA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(36,'ODŽACI','2020-06-01 21:31:28','2020-06-01 21:31:28'),(37,'PALILULA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(38,'PALILULA-NIŠ','2020-06-01 21:31:28','2020-06-01 21:31:28'),(39,'PANTELEJ','2020-06-01 21:31:28','2020-06-01 21:31:28'),(40,'PANČEVO','2020-06-01 21:31:28','2020-06-01 21:31:28'),(41,'PARAĆIN','2020-06-01 21:31:28','2020-06-01 21:31:28'),(42,'PETROVARADIN','2020-06-01 21:31:28','2020-06-01 21:31:28'),(43,'PETROVAC NA MLAVI','2020-06-01 21:31:28','2020-06-01 21:31:28'),(44,'PEĆ','2020-06-01 21:31:28','2020-06-01 21:31:28'),(45,'PEĆINCI','2020-06-01 21:31:28','2020-06-01 21:31:28'),(46,'PIROT','2020-06-01 21:31:28','2020-06-01 21:31:28'),(47,'PLANDIŠTE','2020-06-01 21:31:28','2020-06-01 21:31:28'),(48,'PODUJEVO','2020-06-01 21:31:28','2020-06-01 21:31:28'),(49,'POŽAREVAC','2020-06-01 21:31:28','2020-06-01 21:31:28'),(50,'POŽEGA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(51,'PREŠEVO','2020-06-01 21:31:28','2020-06-01 21:31:28'),(52,'PRIBOJ','2020-06-01 21:31:28','2020-06-01 21:31:28'),(53,'PRIZREN','2020-06-01 21:31:28','2020-06-01 21:31:28'),(54,'PRIJEPOLJE','2020-06-01 21:31:28','2020-06-01 21:31:28'),(55,'PRIŠTINA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(56,'PROKUPLJE','2020-06-01 21:31:28','2020-06-01 21:31:28'),(57,'RAŽANJ','2020-06-01 21:31:28','2020-06-01 21:31:28'),(58,'RAKOVICA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(59,'RAČA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(60,'RAŠKA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(61,'REKOVAC','2020-06-01 21:31:28','2020-06-01 21:31:28'),(62,'RUMA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(63,'SAVSKI VENAC','2020-06-01 21:31:28','2020-06-01 21:31:28'),(64,'SVILAJNAC','2020-06-01 21:31:28','2020-06-01 21:31:28'),(65,'SVRLJIG','2020-06-01 21:31:28','2020-06-01 21:31:28'),(66,'SENTA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(67,'SEČANJ','2020-06-01 21:31:28','2020-06-01 21:31:28'),(68,'SJENICA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(69,'SMEDEREVO','2020-06-01 21:31:28','2020-06-01 21:31:28'),(70,'SMEDEREVSKA PALANKA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(71,'SOKO BANJA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(72,'SOMBOR','2020-06-01 21:31:28','2020-06-01 21:31:28'),(73,'SOPOT','2020-06-01 21:31:28','2020-06-01 21:31:28'),(74,'SRBICA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(75,'SRBOBRAN','2020-06-01 21:31:28','2020-06-01 21:31:28'),(76,'SREMSKA MITROVICA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(77,'SREMSKI KARLOVCI','2020-06-01 21:31:28','2020-06-01 21:31:28'),(78,'STARA PAZOVA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(79,'STARI GRAD','2020-06-01 21:31:28','2020-06-01 21:31:28'),(80,'STRAGARI','2020-06-01 21:31:28','2020-06-01 21:31:28'),(81,'SUBOTICA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(82,'SUVA REKA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(83,'SURDULICA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(84,'SURČIN','2020-06-01 21:31:28','2020-06-01 21:31:28'),(85,'TEMERIN','2020-06-01 21:31:28','2020-06-01 21:31:28'),(86,'TITEL','2020-06-01 21:31:28','2020-06-01 21:31:28'),(87,'TOPOLA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(88,'TRGOVIŠTE','2020-06-01 21:31:28','2020-06-01 21:31:28'),(89,'TRSTENIK','2020-06-01 21:31:28','2020-06-01 21:31:28'),(90,'TUTIN','2020-06-01 21:31:28','2020-06-01 21:31:28'),(91,'ĆIĆEVAC','2020-06-01 21:31:28','2020-06-01 21:31:28'),(92,'ĆUPRIJA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(93,'UB','2020-06-01 21:31:28','2020-06-01 21:31:28'),(94,'UŽICE','2020-06-01 21:31:28','2020-06-01 21:31:28'),(95,'UROŠEVAC','2020-06-01 21:31:28','2020-06-01 21:31:28'),(96,'CRVENI KRST -NIŠ','2020-06-01 21:31:28','2020-06-01 21:31:28'),(97,'CRNA TRAVA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(98,'ČAJETINA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(99,'ČAČAK','2020-06-01 21:31:28','2020-06-01 21:31:28'),(100,'ČOKA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(101,'ČUKARICA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(102,'ŠABAC','2020-06-01 21:31:28','2020-06-01 21:31:28'),(103,'ŠID','2020-06-01 21:31:28','2020-06-01 21:31:28'),(104,'ŠTIMLJE','2020-06-01 21:31:28','2020-06-01 21:31:28'),(105,'ŠTRPCE','2020-06-01 21:31:28','2020-06-01 21:31:28'),(106,'GRAD BEOGRAD','2020-06-01 21:31:28','2020-06-01 21:31:28'),(107,'REPUBLIKA SRBIJA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(108,'GRAD NOVI SAD','2020-06-01 21:31:28','2020-06-01 21:31:28'),(109,'AP VOJVODINA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(110,'GRAD NIŠ','2020-06-01 21:31:28','2020-06-01 21:31:28'),(111,'GRAD KRAGUJEVAC','2020-06-01 21:31:28','2020-06-01 21:31:28'),(112,'GRAD PRIŠTINA','2020-06-01 21:31:28','2020-06-01 21:31:28'),(113,'AP KOSOVO I METOHIJA','2020-06-01 21:31:28','2020-06-01 21:31:28');
/*!40000 ALTER TABLE `mestos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_resets_table',1),(2,'2020_03_19_144218_create_korisniks_table',1),(3,'2020_03_19_145733_create_neprivilegovan_korisniks_table',1),(4,'2020_03_19_145749_create_administrators_table',1),(5,'2020_03_19_145800_create_moderators_table',1),(6,'2020_03_19_145818_create_mestos_table',1),(7,'2020_03_19_150012_create_kategorijes_table',1),(8,'2020_03_19_150023_create_obavestenjas_table',1),(9,'2020_03_19_150034_create_pitanjas_table',1),(10,'2020_03_19_150043_create_anketes_table',1),(11,'2020_03_19_150056_create_ponudjeni_odgovoris_table',1),(12,'2020_04_12_212644_create_kategorije_obavestenjas_table',1),(13,'2020_04_15_164500_mesto_obavestenjas',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moderators`
--

DROP TABLE IF EXISTS `moderators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `moderators` (
  `id` bigint(20) unsigned NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `naziv` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adminNotified` tinyint(1) NOT NULL DEFAULT '0',
  `pib` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maticniBroj` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokalnost` smallint(6) NOT NULL DEFAULT '1',
  `ankete` smallint(6) NOT NULL DEFAULT '1',
  `opstinaPoslovanja_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `moderators_naziv_unique` (`naziv`),
  UNIQUE KEY `moderators_pib_unique` (`pib`),
  UNIQUE KEY `moderators_maticnibroj_unique` (`maticniBroj`),
  KEY `moderators_opstinaposlovanja_id_foreign` (`opstinaPoslovanja_id`),
  CONSTRAINT `moderators_id_foreign` FOREIGN KEY (`id`) REFERENCES `korisniks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `moderators_opstinaposlovanja_id_foreign` FOREIGN KEY (`opstinaPoslovanja_id`) REFERENCES `mestos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moderators`
--

LOCK TABLES `moderators` WRITE;
/*!40000 ALTER TABLE `moderators` DISABLE KEYS */;
INSERT INTO `moderators` VALUES (3,1,'Moderator','ulica2',1,'123456789','12345678',2,1,2,'2020-06-01 21:31:39','2020-06-01 21:31:39');
/*!40000 ALTER TABLE `moderators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `neprivilegovan_korisniks`
--

DROP TABLE IF EXISTS `neprivilegovan_korisniks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `neprivilegovan_korisniks` (
  `id` bigint(20) unsigned NOT NULL,
  `ime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datumRodjenja` date NOT NULL,
  `adresaPrebivalista` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jmbg` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pol` tinyint(1) NOT NULL,
  `brojLicneKarte` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opstinaPrebivalista_id` bigint(20) unsigned NOT NULL,
  `opstinaRodjenja_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `neprivilegovan_korisniks_jmbg_unique` (`jmbg`),
  UNIQUE KEY `neprivilegovan_korisniks_brojlicnekarte_unique` (`brojLicneKarte`),
  KEY `neprivilegovan_korisniks_opstinarodjenja_id_foreign` (`opstinaRodjenja_id`),
  KEY `neprivilegovan_korisniks_opstinaprebivalista_id_foreign` (`opstinaPrebivalista_id`),
  CONSTRAINT `neprivilegovan_korisniks_id_foreign` FOREIGN KEY (`id`) REFERENCES `korisniks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `neprivilegovan_korisniks_opstinaprebivalista_id_foreign` FOREIGN KEY (`opstinaPrebivalista_id`) REFERENCES `mestos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `neprivilegovan_korisniks_opstinarodjenja_id_foreign` FOREIGN KEY (`opstinaRodjenja_id`) REFERENCES `mestos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `neprivilegovan_korisniks`
--

LOCK TABLES `neprivilegovan_korisniks` WRITE;
/*!40000 ALTER TABLE `neprivilegovan_korisniks` DISABLE KEYS */;
INSERT INTO `neprivilegovan_korisniks` VALUES (2,'Filip','Carevic','1998-06-01','Ulica 2','2009998782818',1,'123456789',1,1,'2020-05-31 22:00:00','2020-05-31 22:00:00');
/*!40000 ALTER TABLE `neprivilegovan_korisniks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obavestenjas`
--

DROP TABLE IF EXISTS `obavestenjas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obavestenjas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `naslov` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opis` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nivoLokNac` smallint(6) NOT NULL,
  `korisnik_id` bigint(20) unsigned NOT NULL,
  `obrisanoFlag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `obavestenjas_korisnik_id_foreign` (`korisnik_id`),
  CONSTRAINT `obavestenjas_korisnik_id_foreign` FOREIGN KEY (`korisnik_id`) REFERENCES `korisniks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obavestenjas`
--

LOCK TABLES `obavestenjas` WRITE;
/*!40000 ALTER TABLE `obavestenjas` DISABLE KEYS */;
INSERT INTO `obavestenjas` VALUES (1,'Lokalno Lazarevac','Turnir u Fudbalu',NULL,1,1,0,'2020-06-01 19:36:57','2020-06-01 19:36:57'),(2,'Vanredno stanje','Usled covid19, proglasava se vanredno stanje',NULL,0,1,0,'2020-06-01 19:37:41','2020-06-01 19:37:41'),(3,'Lazarevac obavestenje kosarka','Turnir u baksetu 3x3 odrzava se 26.06.2020.',NULL,1,3,0,'2020-06-01 19:46:10','2020-06-01 19:46:10');
/*!40000 ALTER TABLE `obavestenjas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odgovori_korisniks`
--

DROP TABLE IF EXISTS `odgovori_korisniks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `odgovori_korisniks` (
  `korisnik_id` bigint(20) unsigned NOT NULL,
  `ponudjeni_odgovori_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`korisnik_id`,`ponudjeni_odgovori_id`),
  UNIQUE KEY `odgovori_korisniks_korisnik_id_ponudjeni_odgovori_id_unique` (`korisnik_id`,`ponudjeni_odgovori_id`),
  KEY `odgovori_korisniks_ponudjeni_odgovori_id_foreign` (`ponudjeni_odgovori_id`),
  CONSTRAINT `odgovori_korisniks_korisnik_id_foreign` FOREIGN KEY (`korisnik_id`) REFERENCES `korisniks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `odgovori_korisniks_ponudjeni_odgovori_id_foreign` FOREIGN KEY (`ponudjeni_odgovori_id`) REFERENCES `ponudjeni_odgovoris` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odgovori_korisniks`
--

LOCK TABLES `odgovori_korisniks` WRITE;
/*!40000 ALTER TABLE `odgovori_korisniks` DISABLE KEYS */;
/*!40000 ALTER TABLE `odgovori_korisniks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pitanjas`
--

DROP TABLE IF EXISTS `pitanjas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pitanjas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tekst` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ankete_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pitanjas_ankete_id_foreign` (`ankete_id`),
  CONSTRAINT `pitanjas_ankete_id_foreign` FOREIGN KEY (`ankete_id`) REFERENCES `anketes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pitanjas`
--

LOCK TABLES `pitanjas` WRITE;
/*!40000 ALTER TABLE `pitanjas` DISABLE KEYS */;
INSERT INTO `pitanjas` VALUES (1,'Za koga glasate?',1,'2020-06-01 19:38:47','2020-06-01 19:38:47'),(2,'Da li vam se svidja projekat?',2,'2020-06-01 19:40:25','2020-06-01 19:40:25'),(3,'Da li podrzavate stranku1?',3,'2020-06-01 19:47:23','2020-06-01 19:47:23'),(4,'Da li vam se svidja projekat?',4,'2020-06-01 19:50:13','2020-06-01 19:50:13');
/*!40000 ALTER TABLE `pitanjas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ponudjeni_odgovoris`
--

DROP TABLE IF EXISTS `ponudjeni_odgovoris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ponudjeni_odgovoris` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tekst` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pitanja_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ponudjeni_odgovoris_pitanja_id_foreign` (`pitanja_id`),
  CONSTRAINT `ponudjeni_odgovoris_pitanja_id_foreign` FOREIGN KEY (`pitanja_id`) REFERENCES `pitanjas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ponudjeni_odgovoris`
--

LOCK TABLES `ponudjeni_odgovoris` WRITE;
/*!40000 ALTER TABLE `ponudjeni_odgovoris` DISABLE KEYS */;
INSERT INTO `ponudjeni_odgovoris` VALUES (1,'stranka1',1,'2020-06-01 19:38:47','2020-06-01 19:38:47'),(2,'stranka2',1,'2020-06-01 19:38:47','2020-06-01 19:38:47'),(3,'stranka3',1,'2020-06-01 19:38:48','2020-06-01 19:38:48'),(4,'Da',2,'2020-06-01 19:40:26','2020-06-01 19:40:26'),(5,'Ne',2,'2020-06-01 19:40:26','2020-06-01 19:40:26'),(6,'Ne bih da se izjasnim',2,'2020-06-01 19:40:26','2020-06-01 19:40:26'),(7,'Da',3,'2020-06-01 19:47:23','2020-06-01 19:47:23'),(8,'Ne',3,'2020-06-01 19:47:23','2020-06-01 19:47:23'),(9,'da',4,'2020-06-01 19:50:13','2020-06-01 19:50:13'),(10,'ne',4,'2020-06-01 19:50:13','2020-06-01 19:50:13');
/*!40000 ALTER TABLE `ponudjeni_odgovoris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'esrbija'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-01 23:51:52
