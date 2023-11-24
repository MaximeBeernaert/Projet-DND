-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: projetDND
-- ------------------------------------------------------
-- Server version	11.1.2-MariaDB

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
-- Table structure for table `competence`
--

DROP TABLE IF EXISTS `competence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `competence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `desc` int(11) NOT NULL,
  `atk` int(11) DEFAULT NULL,
  `heal` int(11) DEFAULT NULL,
  `niveauMinimum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competence`
--

LOCK TABLES `competence` WRITE;
/*!40000 ALTER TABLE `competence` DISABLE KEYS */;
/*!40000 ALTER TABLE `competence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enigme`
--

DROP TABLE IF EXISTS `enigme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enigme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(100) NOT NULL,
  `reponse` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enigme`
--

LOCK TABLES `enigme` WRITE;
/*!40000 ALTER TABLE `enigme` DISABLE KEYS */;
INSERT INTO `enigme` VALUES (1,'Qu\'est-ce qui est jaune et qui attend ?','Jonathan'),(2,'Qu\'est-ce qui est vert et qui attend ?','Jonathan'),(3,'Qu\'est-ce qui est rouge et qui attend ?','Jonathan'),(4,'Qu\'est-ce qui est bleu et qui attend ?','Jonathan'),(5,'Qu\'est-ce qui est noir et qui attend ?','Jonathan');
/*!40000 ALTER TABLE `enigme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monstre`
--

DROP TABLE IF EXISTS `monstre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `monstre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `atk` int(11) NOT NULL,
  `descAtk` varchar(100) NOT NULL,
  `def` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `pv` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monstre`
--

LOCK TABLES `monstre` WRITE;
/*!40000 ALTER TABLE `monstre` DISABLE KEYS */;
INSERT INTO `monstre` VALUES (1,'Gobelin',10,'Attaque de base',5,10,20),(2,'Dragon',20,'Souffle de feu',10,500,100),(3,'Ogre',25,'Frappe puissante',15,600,120),(4,'Spectre',15,'Toucher glacial',8,300,80),(5,'Banshee',18,'Cri perçant',12,400,90),(6,'Loup-garou',22,'Morsure féroce',12,550,110),(7,'Chimère',30,'Rugissement dévastateur',20,700,150),(8,'Hydre',35,'Morsure venimeuse',25,800,180),(9,'Orc',12,'Frappe brutale',10,300,80),(10,'Elemental',40,'Furie élémentaire',30,1000,200),(11,'Golem',45,'Frappe de pierre',35,1200,250),(12,'Géant',50,'Frappe dévastatrice',40,1500,300),(13,'Squelette',8,'Attaque de base',5,200,50),(14,'Zombie',10,'Morsure infectée',8,250,60),(15,'Vampire',12,'Morsure vampirique',10,300,70),(16,'Liche',15,'Toucher glacial',12,400,100),(17,'Démon',20,'Frappe démoniaque',15,600,150);
/*!40000 ALTER TABLE `monstre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objet`
--

DROP TABLE IF EXISTS `objet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `objet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `desc` varchar(100) DEFAULT NULL,
  `heal` int(11) DEFAULT NULL,
  `atk` int(11) DEFAULT NULL,
  `def` int(11) DEFAULT NULL,
  `dodge` int(11) DEFAULT NULL,
  `isConsumable` int(11) DEFAULT NULL,
  `niveauMinimum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objet`
--

LOCK TABLES `objet` WRITE;
/*!40000 ALTER TABLE `objet` DISABLE KEYS */;
/*!40000 ALTER TABLE `objet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personnage`
--

DROP TABLE IF EXISTS `personnage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personnage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `pv` int(11) NOT NULL,
  `atk` int(11) NOT NULL,
  `def` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `maxpv` int(11) NOT NULL,
  `maxdef` int(11) NOT NULL,
  `maxatk` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personnage`
--

LOCK TABLES `personnage` WRITE;
/*!40000 ALTER TABLE `personnage` DISABLE KEYS */;
INSERT INTO `personnage` VALUES (5,'Yohann',100,10,10,0,1,100,10,10),(6,'Maxime',80,10,10,0,1,100,10,10),(18,'bob',70,10,10,1100,1,100,10,10);
/*!40000 ALTER TABLE `personnage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `porter`
--

DROP TABLE IF EXISTS `porter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `porter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPerso` int(11) NOT NULL,
  `idObj` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `porter`
--

LOCK TABLES `porter` WRITE;
/*!40000 ALTER TABLE `porter` DISABLE KEYS */;
/*!40000 ALTER TABLE `porter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salle`
--

DROP TABLE IF EXISTS `salle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `niveau` int(11) NOT NULL,
  `ennemi` int(11) DEFAULT NULL,
  `piege` int(11) DEFAULT NULL,
  `enigme` int(11) DEFAULT NULL,
  `marchand` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salle`
--

LOCK TABLES `salle` WRITE;
/*!40000 ALTER TABLE `salle` DISABLE KEYS */;
/*!40000 ALTER TABLE `salle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utiliser`
--

DROP TABLE IF EXISTS `utiliser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utiliser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCom` int(11) NOT NULL,
  `idPerso` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utiliser`
--

LOCK TABLES `utiliser` WRITE;
/*!40000 ALTER TABLE `utiliser` DISABLE KEYS */;
/*!40000 ALTER TABLE `utiliser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'projetDND'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-24 16:40:52
