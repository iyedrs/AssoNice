-- MariaDB dump - NiceAssoSport avec clés primaires INT AUTO_INCREMENT
-- Converti depuis les anciennes clés VARCHAR vers INT AUTO_INCREMENT
-- Les FK et relations sont conservées correctement

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
-- Table structure for table `DISCIPLINE`
--

DROP TABLE IF EXISTS `DISCIPLINE`;
CREATE TABLE `DISCIPLINE` (
  `DIS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `DIS_NOM` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`DIS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `DISCIPLINE`
-- Mapping: Ath=1, Bad=2, Bas=3, Foo=4, Gym=5, Jud=6, Kyt=7, Nat=8, Rug=9, Ten=10, Vol=11
--

LOCK TABLES `DISCIPLINE` WRITE;
INSERT INTO `DISCIPLINE` VALUES
  (1,'Athlétisme'),
  (2,'Badminton'),
  (3,'Basketball'),
  (4,'Football'),
  (5,'Gymnastique'),
  (6,'Judo'),
  (7,'Kyte surfe'),
  (8,'Natation'),
  (9,'Rugby'),
  (10,'Tennis'),
  (11,'Volley');
UNLOCK TABLES;

--
-- Table structure for table `CLUB`
--

DROP TABLE IF EXISTS `CLUB`;
CREATE TABLE `CLUB` (
  `CLU_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CLU_NOM` varchar(50) DEFAULT NULL,
  `CLU_ADRESSEVILLE` varchar(50) DEFAULT NULL,
  `CLU_ADRESSERUE` varchar(25) DEFAULT NULL,
  `CLU_ADRESSECP` varchar(6) DEFAULT NULL,
  `CLU_MAIL` varchar(25) DEFAULT NULL,
  `CLU_TELFIXE` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`CLU_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CLUB`
-- Mapping: clu1=1, clu2=2, clu3=3, clu4=4, clu5=5, clu6=6, clu7=7, clu8=8, clu9=9, clu10=10
--

LOCK TABLES `CLUB` WRITE;
INSERT INTO `CLUB` VALUES
  (1,'AS Nice Football','Nice','Rue de France','06000','contact@asnicefoot.fr','04921234'),
  (2,'Nice Basket Club','Nice','Avenue Jean Médecin','06000','contact@nbc.fr','04929876'),
  (3,'AS Natation Nice','Nice','Boulevard Gambetta','06000','natation@nice.fr','04923456'),
  (4,'Nice Athlétisme','Nice','Rue Masséna','06000','athle@nice.fr','04925678'),
  (5,'Volley Nice','Nice','Rue de l\'Eglise','06000','volley@nice.fr','04921239'),
  (6,'Tennis Club Nice','Nice','Allée des Jardins','06000','tennis@nice.fr','04927654'),
  (7,'AS Judo Nice','Nice','Rue du Temple','06000','judo@nice.fr','04921239'),
  (8,'Badminton Nice','Nice','Boulevard Carabacel','06000','badminton@nice.fr','04923459'),
  (9,'Rugby Nice','Nice','Rue de la Buffa','06000','rugby@nice.fr','04927896'),
  (10,'AS Gym Nice','Nice','Rue Bonaparte','06000','gym@nice.fr','04921230');
UNLOCK TABLES;

--
-- Table structure for table `CLUB_DISCIPLINE`
--

DROP TABLE IF EXISTS `CLUB_DISCIPLINE`;
CREATE TABLE `CLUB_DISCIPLINE` (
  `CLUB_ID` int(11) NOT NULL,
  `DISCIPLINE_ID` int(11) NOT NULL,
  PRIMARY KEY (`CLUB_ID`,`DISCIPLINE_ID`),
  KEY `DISCIPLINE_ID` (`DISCIPLINE_ID`),
  CONSTRAINT `CLUB_DISCIPLINE_ibfk_1` FOREIGN KEY (`CLUB_ID`) REFERENCES `CLUB` (`CLU_ID`),
  CONSTRAINT `CLUB_DISCIPLINE_ibfk_2` FOREIGN KEY (`DISCIPLINE_ID`) REFERENCES `DISCIPLINE` (`DIS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CLUB_DISCIPLINE`
--

LOCK TABLES `CLUB_DISCIPLINE` WRITE;
INSERT INTO `CLUB_DISCIPLINE` VALUES
  (1,4),
  (2,3),
  (3,8),
  (4,1),
  (5,11),
  (6,10),
  (7,6),
  (8,2),
  (9,9),
  (10,5);
UNLOCK TABLES;

--
-- Table structure for table `ADHERENT`
--

DROP TABLE IF EXISTS `ADHERENT`;
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
  `ADH_ROLE` int(2) DEFAULT 0,
  PRIMARY KEY (`ADH_ID`),
  KEY `CLU_ID` (`CLU_ID`),
  KEY `DIS_ID` (`DIS_ID`),
  CONSTRAINT `ADHERENT_ibfk_1` FOREIGN KEY (`CLU_ID`) REFERENCES `CLUB` (`CLU_ID`),
  CONSTRAINT `ADHERENT_ibfk_2` FOREIGN KEY (`DIS_ID`) REFERENCES `DISCIPLINE` (`DIS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ADHERENT`
-- Mapping: adh1=1, adh2=2, adh3=3, adh4=4, adh5=5, adh6=6, adh7=7, adh8=8, adh9=9, adh10=10
-- DIS_ID mapping: Foo=4, Bas=3, Nat=8, Ath=1, Vol=11, Ten=10, Jud=6
--

LOCK TABLES `ADHERENT` WRITE;
INSERT INTO `ADHERENT` VALUES
  (1,1,4,'Dupont','Jean','2005-02-15','10 rue de France',NULL,NULL,0),
  (2,1,4,'Martin','Luc','2006-06-20','12 rue de France',NULL,NULL,0),
  (3,2,3,'Bernard','Sophie','2004-11-05','5 avenue Jean Médecin',NULL,NULL,0),
  (4,2,3,'Durand','Paul','2005-01-22','8 avenue Jean Médecin',NULL,NULL,0),
  (5,3,8,'Petit','Claire','2006-03-12','20 boulevard Gambetta',NULL,NULL,0),
  (6,3,8,'Moreau','Antoine','2005-07-30','22 boulevard Gambetta',NULL,NULL,0),
  (7,4,1,'Leroy','Emma','2005-09-25','15 rue Masséna',NULL,NULL,0),
  (8,5,11,'Roux','Louis','2004-12-18','18 rue de l\'Eglise',NULL,NULL,0),
  (9,6,10,'Faure','Alice','2005-05-10','3 allée des Jardins',NULL,NULL,0),
  (10,7,6,'Blanc','Thomas','2006-08-08','7 rue du Temple',NULL,NULL,0);
UNLOCK TABLES;

--
-- Table structure for table `COMPETITION`
--

DROP TABLE IF EXISTS `COMPETITION`;
CREATE TABLE `COMPETITION` (
  `COM_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CLU_ID` int(11) NOT NULL,
  `DIS_ID` int(11) NOT NULL,
  `CLU_ID_LOCAL` int(11) NOT NULL,
  `COM_NOM` varchar(50) DEFAULT NULL,
  `COM_DATE` date DEFAULT NULL,
  PRIMARY KEY (`COM_ID`),
  KEY `CLU_ID` (`CLU_ID`),
  KEY `DIS_ID` (`DIS_ID`),
  KEY `CLU_ID_LOCAL` (`CLU_ID_LOCAL`),
  CONSTRAINT `COMPETITION_ibfk_1` FOREIGN KEY (`CLU_ID`) REFERENCES `CLUB` (`CLU_ID`),
  CONSTRAINT `COMPETITION_ibfk_2` FOREIGN KEY (`DIS_ID`) REFERENCES `DISCIPLINE` (`DIS_ID`),
  CONSTRAINT `COMPETITION_ibfk_3` FOREIGN KEY (`CLU_ID_LOCAL`) REFERENCES `CLUB` (`CLU_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `COMPETITION`
-- Mapping: com1=1, com2=2, com3=3, com4=4, com5=5, com6=6, com7=7, com8=8, com9=9, com10=10
--

LOCK TABLES `COMPETITION` WRITE;
INSERT INTO `COMPETITION` VALUES
  (1,1,4,2,'Coupe de Football 2026','2026-04-15'),
  (2,2,3,3,'Basket Challenge 2026','2026-05-10'),
  (3,3,8,4,'Natation Open 2026','2026-06-05'),
  (4,4,1,5,'Athlé 100m 2026','2026-06-20'),
  (5,5,11,6,'Volley Cup 2026','2026-07-10'),
  (6,6,10,7,'Tennis Masters 2026','2026-07-25'),
  (7,7,6,8,'Tournoi Judo 2026','2026-08-15'),
  (8,8,2,9,'Badminton Open 2026','2026-08-30'),
  (9,9,9,10,'Rugby Challenge 2026','2026-09-12'),
  (10,10,5,1,'Gymnastique Gala 2026','2026-09-25');
UNLOCK TABLES;

--
-- Table structure for table `INSCRIPTION`
--

DROP TABLE IF EXISTS `INSCRIPTION`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `INSCRIPTION`
-- Mapping: ins1=1, ins2=2, ins3=3, ins4=4, ins5=5, ins6=6, ins7=7, ins8=8, ins9=9, ins10=10
--

LOCK TABLES `INSCRIPTION` WRITE;
INSERT INTO `INSCRIPTION` VALUES
  (1,1,1,'2026-03-01',1),
  (2,2,1,'2026-03-02',0),
  (3,3,2,'2026-03-05',1),
  (4,4,2,'2026-03-06',1),
  (5,5,3,'2026-03-10',0),
  (6,6,3,'2026-03-12',1),
  (7,7,4,'2026-03-15',1),
  (8,8,5,'2026-03-18',0),
  (9,9,6,'2026-03-20',1),
  (10,10,7,'2026-03-22',0);
UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed
