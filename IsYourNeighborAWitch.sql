-- MySQL dump 10.13  Distrib 8.0.21, for osx10.15 (x86_64)
--
-- Host: localhost    Database: witch
-- ------------------------------------------------------
-- Server version	8.0.21

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
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `answer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `text` varchar(255) DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT NULL,
  `question_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `response_question_id_fk` (`question_id`),
  CONSTRAINT `response_question_id_fk` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answer`
--

LOCK TABLES `answer` WRITE;
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
/*!40000 ALTER TABLE `answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bounty`
--

DROP TABLE IF EXISTS `bounty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bounty` (
  `id` int NOT NULL AUTO_INCREMENT,
  `inquisitor_id` int NOT NULL,
  `witch_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bounty_inquisitor_id_fk` (`inquisitor_id`),
  KEY `bounty_witch_id_fk` (`witch_id`),
  CONSTRAINT `bounty_inquisitor_id_fk` FOREIGN KEY (`inquisitor_id`) REFERENCES `inquisitor` (`id`),
  CONSTRAINT `bounty_witch_id_fk` FOREIGN KEY (`witch_id`) REFERENCES `witch` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bounty`
--

LOCK TABLES `bounty` WRITE;
/*!40000 ALTER TABLE `bounty` DISABLE KEYS */;
/*!40000 ALTER TABLE `bounty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inquisitor`
--

DROP TABLE IF EXISTS `inquisitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inquisitor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `registrationNumber` int NOT NULL,
  `password` varchar(260) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `inquisitor_registrationNumber_uindex` (`registrationNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inquisitor`
--

LOCK TABLES `inquisitor` WRITE;
/*!40000 ALTER TABLE `inquisitor` DISABLE KEYS */;
INSERT INTO `inquisitor` VALUES (1,'Perlinpinpin',12345678,'$2y$10$uNkt5IsZsoYvxO8h/pCyEu58.7brE/pZL5Sfmmi/OSluuzotnwtBC'),(3,'Perlinpinpin',12345679,'$2y$10$SmYBqhUKG2M0foP9CPsJ.eIs1D7woYUXdFI6r5cLmTflVWkxgTzle'),(4,'Perlinpinpin',12345674,'$2y$10$rlHTlqIStAyNC6IbUE/1r.yk1LpvaGOxWbtwczkJT138eLLykqL.a');
/*!40000 ALTER TABLE `inquisitor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question` (
  `id` int NOT NULL AUTO_INCREMENT,
  `text` varchar(255) DEFAULT NULL,
  `score` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `witch`
--

DROP TABLE IF EXISTS `witch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `witch` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `localisation` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `credibility` int DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `witch`
--

LOCK TABLES `witch` WRITE;
/*!40000 ALTER TABLE `witch` DISABLE KEYS */;
/*!40000 ALTER TABLE `witch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `witch_answer`
--

DROP TABLE IF EXISTS `witch_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `witch_answer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `witch_id` int DEFAULT NULL,
  `question_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `table_name_question_id_fk` (`question_id`),
  KEY `table_name_witch_id_fk` (`witch_id`),
  CONSTRAINT `table_name_question_id_fk` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`),
  CONSTRAINT `table_name_witch_id_fk` FOREIGN KEY (`witch_id`) REFERENCES `witch` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `witch_answer`
--

LOCK TABLES `witch_answer` WRITE;
/*!40000 ALTER TABLE `witch_answer` DISABLE KEYS */;
/*!40000 ALTER TABLE `witch_answer` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-19 17:21:22
