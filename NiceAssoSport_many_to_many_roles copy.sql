-- MariaDB dump 10.19  Distrib 10.5.19-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: NiceAssoSport
-- ------------------------------------------------------
-- Server version       10.5.19-MariaDB-0+deb11u2
--
-- REFACTORED: Relation ADHERENT <-> ROLE en Many-to-Many
-- via la table d'association ADHERENT_ROLE
-- La colonne ADH_ROLE a été supprimée de ADHERENT

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
-- Table structure for table `ROLE`
--

DROP TABLE IF EXISTS `ROLE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ROLE` (
  `ROL_ID` int(11) NOT NULL,
  `ROL_LIBELLE` varchar(50) NOT NULL,
  PRIMARY KEY (`ROL_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ROLE`
--

LOCK TABLES `ROLE` WRITE;
/*!40000 ALTER TABLE `ROLE` DISABLE KEYS */;
INSERT INTO `ROLE` VALUES (0,'Adhérent'),(1,'Entraîneur'),(2,'Administrateur plateforme');
/*!40000 ALTER TABLE `ROLE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DISCIPLINE`
--

DROP TABLE IF EXISTS `DISCIPLINE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DISCIPLINE` (
  `DIS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `DIS_NOM` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`DIS_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DISCIPLINE`
--

LOCK TABLES `DISCIPLINE` WRITE;
/*!40000 ALTER TABLE `DISCIPLINE` DISABLE KEYS */;
INSERT INTO `DISCIPLINE` VALUES (1,'Athlét'),(2,'Badminton'),(3,'Basketball'),(4,'Football'),(5,'Gymnastique'),(6,'Judo'),(7,'Kyte surf'),(8,'Natation'),(9,'Rugby'),(10,'Tennis'),(11,'Volley');
/*!40000 ALTER TABLE `DISCIPLINE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CLUB`
--

DROP TABLE IF EXISTS `CLUB`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CLUB` (
  `CLU_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CLU_NOM` varchar(50) DEFAULT NULL,
  `CLU_ADRESSEVILLE` varchar(50) DEFAULT NULL,
  `CLU_ADRESSERUE` varchar(255) DEFAULT NULL,
  `CLU_ADRESSECP` varchar(6) DEFAULT NULL,
  `CLU_MAIL` varchar(25) DEFAULT NULL,
  `CLU_TELFIXE` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`CLU_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CLUB`
--

LOCK TABLES `CLUB` WRITE;
/*!40000 ALTER TABLE `CLUB` DISABLE KEYS */;
INSERT INTO `CLUB` VALUES (1,'AS Nice Football l','Nice','Rue de France','06000','contact@asnicefoot.fr','04921234'),(2,'Nice Basket Club','Nice','Avenue Jean Médecin','06000','contact@nbc.fr','04929876'),(3,'AS Natation Nice','Nice','Boulevard Gambetta','06000','natation@nice.fr','04923456'),(4,'Nice Athlétisme','Nice','Rue Masséna','06000','athle@nice.fr','04925678'),(5,'Volley Nice','Nice','Rue de l\'Eglise','06000','volley@nice.fr','04921239'),(6,'Tennis Club Nice','Nice','Allée des Jardins','06000','tennis@nice.fr','04927654'),(7,'AS Judo Nice','Nice','Rue du Temple','06000','judo@nice.fr','04921239'),(8,'Badminton Nice','Nice','Boulevard Carabacel','06000','badminton@nice.fr','04923459'),(9,'Rugby Nice','Nice','Rue de la Buffa','06000','rugby@nice.fr','04927896'),(10,'AS Gym Nice','Nice','Rue Bonaparte','06000','gym@nice.fr','04921230'),(11,'Foot2rue','Nice','Avenue de Pessicart','06100','foot2rue@gmail.com','0695578519');
/*!40000 ALTER TABLE `CLUB` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ADHERENT`
-- MODIFIÉ: suppression de la colonne ADH_ROLE et de la FK ADHERENT_ibfk_3
--

DROP TABLE IF EXISTS `ADHERENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ADHERENT` (
  `ADH_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CLU_ID` int(11) NOT NULL,
  `DIS_ID` int(11) NOT NULL,
  `ADH_NOM` varchar(50) DEFAULT NULL,
  `ADH_PRENOM` varchar(25) DEFAULT NULL,
  `ADH_DDN` date DEFAULT NULL,
  `ADH_ADRESSE` varchar(50) DEFAULT NULL,
  `ADH_HASH_PWD` varchar(256) DEFAULT NULL,
  `ADH_EMAIL` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ADH_ID`),
  KEY `CLU_ID` (`CLU_ID`),
  KEY `DIS_ID` (`DIS_ID`),
  CONSTRAINT `ADHERENT_ibfk_1` FOREIGN KEY (`CLU_ID`) REFERENCES `CLUB` (`CLU_ID`),
  CONSTRAINT `ADHERENT_ibfk_2` FOREIGN KEY (`DIS_ID`) REFERENCES `DISCIPLINE` (`DIS_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9003 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ADHERENT`
-- MODIFIÉ: plus de colonne ADH_ROLE dans les INSERT
--

LOCK TABLES `ADHERENT` WRITE;
/*!40000 ALTER TABLE `ADHERENT` DISABLE KEYS */;
INSERT INTO `ADHERENT` VALUES (1,1,4,'Dupont','Jean','2005-02-15','10 rue de France',NULL,NULL),(2,1,4,'Martin','Luc','2006-06-20','12 rue de France',NULL,NULL),(3,2,3,'Bernard','Sophie','2004-11-05','5 avenue Jean Médecin',NULL,NULL),(4,2,3,'Durand','Paul','2005-01-22','8 avenue Jean Médecin',NULL,NULL),(5,3,8,'Petit','Claire','2006-03-12','20 boulevard Gambetta',NULL,NULL),(6,3,8,'Moreau','Antoine','2005-07-30','22 boulevard Gambetta',NULL,NULL),(7,4,1,'Leroy','Emma','2005-09-25','15 rue Masséna',NULL,NULL),(9,6,10,'Faure','Alice','2005-05-10','3 allée des Jardins',NULL,NULL),(10,7,6,'Blanc','Thomas','2006-08-08','7 rue du Temple',NULL,NULL),(11,1,6,'Aoustin','Evan','2006-10-20','Avenue de Pessicart','$2y$12$4ncInxPb2fau1lmSq0Qc/e6MYXNRznuYqJbwmKh2cyBtPCT1Ioqfu','evan.aoustin@gmail.com'),(12,11,10,'dsfd','dtr','2026-03-02','11 yujtgjgj','$2y$12$GN7Wuyk9YTjnhXlMy5G86.gIEaHDmmIHRJPvkFb0Pw4LY6d4PZEl.','soleil@gmail.com'),(13,11,4,'khattaf mendil','jibril','2005-04-11','13 rue des selves','$2y$12$ZGJg18kiq8Fw9tUg6wDcAeRaR5CuB/f.eqHGYQWcP8agvzNuckh5K','jibril.khattaf@icloud.com'),(14,8,11,'kado','kado','2002-09-17','montauroux','$2y$12$FJjN.V1s6vzy/MHkJzzze.ptuGrvgP/1/RuQ2fBYPrar40eGi28HW','root@root.com'),(15,3,8,'c','nov','2011-11-11','ghg','$2y$12$hKLeEO4BUQxzA5bwV0DWCulTTuRt26GyCyvr/G8wjSNpdxRRpZz4q','cn@gmail.fr'),(16,4,4,'Jeudy','Vincent','2004-06-04','Nice','$2y$12$19S9BogC3JV0LO2wGXEmtemixJ6l7FKjqK7jwAhZviNSqF3XXNweO','vincentjeudy@cloud.com'),(9001,1,1,'admin','Plateforme',NULL,'Nice','$2y$12$hEBG05V.pU1WwEttYvoauOMjQZZtNkEXA.ktlnvYWY/DZOUb4Ve0e','admin@assosport.test'),(9002,2,2,'adherent','Simple',NULL,'Nice','$2y$12$El2QpYRR4srYka0ncMpseeLilic8w8ZCU5OZsz6mwB/JTj7Kr5/gq','adherent@assosport.test');
/*!40000 ALTER TABLE `ADHERENT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ADHERENT_ROLE`
-- NOUVEAU: table d'association Many-to-Many entre ADHERENT et ROLE
--

DROP TABLE IF EXISTS `ADHERENT_ROLE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ADHERENT_ROLE` (
  `ADH_ID` int(11) NOT NULL,
  `ROL_ID` int(11) NOT NULL,
  PRIMARY KEY (`ADH_ID`,`ROL_ID`),
  KEY `ROL_ID` (`ROL_ID`),
  CONSTRAINT `ADHERENT_ROLE_ibfk_1` FOREIGN KEY (`ADH_ID`) REFERENCES `ADHERENT` (`ADH_ID`) ON DELETE CASCADE,
  CONSTRAINT `ADHERENT_ROLE_ibfk_2` FOREIGN KEY (`ROL_ID`) REFERENCES `ROLE` (`ROL_ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ADHERENT_ROLE`
-- Migration des anciennes valeurs ADH_ROLE vers la table d'association
-- Chaque adhérent conserve son rôle actuel
--

LOCK TABLES `ADHERENT_ROLE` WRITE;
/*!40000 ALTER TABLE `ADHERENT_ROLE` DISABLE KEYS */;
INSERT INTO `ADHERENT_ROLE` VALUES
  (1,0),(2,0),(3,0),(4,0),(5,0),(6,0),(7,0),(9,0),(10,0),
  (11,2),(12,2),(13,2),
  (14,0),(15,0),(16,0),
  (9001,1),
  (9002,0);
/*!40000 ALTER TABLE `ADHERENT_ROLE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CLUB_DISCIPLINE`
--

DROP TABLE IF EXISTS `CLUB_DISCIPLINE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CLUB_DISCIPLINE` (
  `CLUB_ID` int(11) NOT NULL,
  `DISCIPLINE_ID` int(11) NOT NULL,
  PRIMARY KEY (`CLUB_ID`,`DISCIPLINE_ID`),
  KEY `DISCIPLINE_ID` (`DISCIPLINE_ID`),
  CONSTRAINT `CLUB_DISCIPLINE_ibfk_1` FOREIGN KEY (`CLUB_ID`) REFERENCES `CLUB` (`CLU_ID`),
  CONSTRAINT `CLUB_DISCIPLINE_ibfk_2` FOREIGN KEY (`DISCIPLINE_ID`) REFERENCES `DISCIPLINE` (`DIS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CLUB_DISCIPLINE`
--

LOCK TABLES `CLUB_DISCIPLINE` WRITE;
/*!40000 ALTER TABLE `CLUB_DISCIPLINE` DISABLE KEYS */;
INSERT INTO `CLUB_DISCIPLINE` VALUES (2,3),(3,8),(4,1),(5,11),(6,10),(7,6),(8,2),(9,3),(10,5);
/*!40000 ALTER TABLE `CLUB_DISCIPLINE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COMPETITION`
--

DROP TABLE IF EXISTS `COMPETITION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COMPETITION` (
  `COM_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CLU_ID` varchar(10) DEFAULT NULL,
  `DIS_ID` int(11) NOT NULL,
  `CLU_ID_LOCAL` varchar(10) DEFAULT NULL,
  `COM_NOM` varchar(50) DEFAULT NULL,
  `COM_DATE` date DEFAULT NULL,
  PRIMARY KEY (`COM_ID`),
  KEY `CLU_ID` (`CLU_ID`),
  KEY `DIS_ID` (`DIS_ID`),
  KEY `CLU_ID_LOCAL` (`CLU_ID_LOCAL`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COMPETITION`
--

LOCK TABLES `COMPETITION` WRITE;
/*!40000 ALTER TABLE `COMPETITION` DISABLE KEYS */;
INSERT INTO `COMPETITION` VALUES (1,'1',4,'2','Coupe de Football 2026','2026-04-15'),(2,'2',3,'3','Basket Challenge 2026','2026-05-10'),(3,'3',8,'4','Natation Open 2026','2026-06-05'),(4,'4',4,'5','Athlé 100m 2026','2026-06-20'),(5,'5',11,'6','Volley Cup 2026','2026-07-10'),(6,'6',10,'7','Tennis Masters 2026','2026-07-25'),(7,'7',6,'8','Tournoi Judo 2026','2026-08-15'),(8,'8',2,'9','Badminton Open 2026','2026-08-30'),(9,'9',9,'10','Rugby Challenge 2026','2026-09-12'),(10,'10',5,'1','Gymnastique Gala 2026','2026-09-25'),(12,NULL,7,NULL,'test2','2222-02-22');
/*!40000 ALTER TABLE `COMPETITION` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `INSCRIPTION`
--

DROP TABLE IF EXISTS `INSCRIPTION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `INSCRIPTION` (
  `INS_NUM` int(11) NOT NULL AUTO_INCREMENT,
  `ADH_ID` int(11) NOT NULL,
  `COM_ID` int(11) NOT NULL,
  `INS_DATE` date DEFAULT NULL,
  `INS_ETAT` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`INS_NUM`),
  KEY `ADH_ID` (`ADH_ID`),
  KEY `COM_ID` (`COM_ID`),
  CONSTRAINT `INSCRIPTION_ibfk_1` FOREIGN KEY (`ADH_ID`) REFERENCES `ADHERENT` (`ADH_ID`),
  CONSTRAINT `INSCRIPTION_ibfk_2` FOREIGN KEY (`COM_ID`) REFERENCES `COMPETITION` (`COM_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `INSCRIPTION`
--

LOCK TABLES `INSCRIPTION` WRITE;
/*!40000 ALTER TABLE `INSCRIPTION` DISABLE KEYS */;
INSERT INTO `INSCRIPTION` VALUES (1,1,1,'2026-03-01',1),(2,2,1,'2026-03-02',2),(3,3,2,'2026-03-05',1),(4,4,2,'2026-03-06',1),(5,5,3,'2026-03-10',2),(6,6,3,'2026-03-12',1),(7,7,4,'2026-03-15',1),(9,9,6,'2026-03-20',1),(10,10,7,'2026-03-22',2),(11,13,1,'2026-03-19',2),(12,14,1,'2026-03-19',1),(13,14,2,'2026-03-19',2),(14,9002,4,'2026-03-25',2),(15,9002,1,'2026-03-25',2),(16,9001,4,'2026-03-25',2);
/*!40000 ALTER TABLE `INSCRIPTION` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026_03_18_085425_make_clu_id_nullable_in_competition_table',1),(2,'2026_03_18_085713_make_clu_id_local_nullable_in_competition_table',2),(3,'2026_03_19_100000_create_role_table',3),(4,'2026_03_26_100000_refactor_adherent_role_many_to_many',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-26
