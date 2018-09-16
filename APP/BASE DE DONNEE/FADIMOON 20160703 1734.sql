-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.45-community


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema gestion_pavc
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ gestion_pavc;
USE gestion_pavc;

--
-- Table structure for table `gestion_pavc`.`activite`
--

DROP TABLE IF EXISTS `activite`;
CREATE TABLE `activite` (
  `id_activite` int(10) NOT NULL AUTO_INCREMENT,
  `Design_activite` varchar(30) DEFAULT NULL,
  `id_user` int(10) NOT NULL DEFAULT '0',
  `priorite_activite` varchar(10) DEFAULT NULL,
  `date_debut_activite` varchar(255) DEFAULT NULL,
  `date_fin_activite` varchar(255) DEFAULT NULL,
  `Etat_activite` int(3) DEFAULT '0',
  PRIMARY KEY (`id_activite`,`id_user`),
  KEY `FK_user5` (`id_user`),
  CONSTRAINT `FK_user5` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gestion_pavc`.`activite`
--

/*!40000 ALTER TABLE `activite` DISABLE KEYS */;
INSERT INTO `activite` (`id_activite`,`Design_activite`,`id_user`,`priorite_activite`,`date_debut_activite`,`date_fin_activite`,`Etat_activite`) VALUES 
 (2,'ACTIVITE 2 ',8,'BASSE','2016-04-27','2016-04-29',1),
 (7,'ACTIVITE 1',23,'HAUTE','2016-04-27','2016-04-29',1),
 (8,'ACTIVITE 3 ',24,'MOYENNE','2016-04-27','2016-04-30',1);
/*!40000 ALTER TABLE `activite` ENABLE KEYS */;


--
-- Table structure for table `gestion_pavc`.`client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `id_client` int(10) NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(30) DEFAULT NULL,
  `Adr_client` varchar(30) DEFAULT NULL,
  `Description_client` mediumtext,
  `Initials_client` varchar(10) DEFAULT NULL,
  `id_departement` int(10) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_client`),
  KEY `FK_departement2` (`id_departement`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `client_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `FK_departement2` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id_departement`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gestion_pavc`.`client`
--

/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` (`id_client`,`nom_client`,`Adr_client`,`Description_client`,`Initials_client`,`id_departement`,`id_user`) VALUES 
 (1,'Huaweii','algere','c bon','salasld',2,18),
 (3,'kkhj','hj','hj','jhj',3,18),
 (4,'Policeee2','algerr','erere','DGSN1',2,NULL),
 (9,'1','2','4','3',NULL,NULL),
 (11,'Huaweii','algere','ccxccs','salasld',2,NULL),
 (12,'Huaweii','algere','ccxccs','salasld',2,NULL),
 (13,'dfghjk',';ertyuiop','fghjk','fgh',1,NULL),
 (14,'kkhj','algere',',,,,','salasld',1,NULL),
 (15,'Policeee','alger','aa','DGSN',2,NULL),
 (17,'Ministere de la Santé','aaaa','aaa','MSPRH',4,NULL),
 (18,'SNTR','JK ','K KJ K','K K ',3,8),
 (19,'dfghjk','fghjk','ghjk','fghj',1,18),
 (20,'fadadafsafsa','jkl','lhjk','l',1,18),
 (21,'AADL','aaaa','aaa','aaa',2,18),
 (22,'ANRH','DD','DDDD','DDD',3,13),
 (23,'DRAGON OIL','EEE','EEE','EEE',5,13),
 (24,'Cosider TP','jjj','kkkk','kkkkk',2,13),
 (25,'hkbk','nbk','jk','n;n',1,18),
 (26,'n','nbk','nn','n;n',1,18);
/*!40000 ALTER TABLE `client` ENABLE KEYS */;


--
-- Table structure for table `gestion_pavc`.`contact_client`
--

DROP TABLE IF EXISTS `contact_client`;
CREATE TABLE `contact_client` (
  `id_contact_client` int(10) NOT NULL AUTO_INCREMENT,
  `id_client` int(10) NOT NULL,
  `nom_contact_client` varchar(30) DEFAULT NULL,
  `prenom_contact_client` varchar(30) DEFAULT NULL,
  `email_contact_client` varchar(30) DEFAULT NULL,
  `adr_contact_client` varchar(30) DEFAULT NULL,
  `tel_contact_client` int(15) DEFAULT NULL,
  PRIMARY KEY (`id_contact_client`,`id_client`),
  KEY `FK_client3` (`id_client`),
  CONSTRAINT `FK_client3` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gestion_pavc`.`contact_client`
--

/*!40000 ALTER TABLE `contact_client` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_client` ENABLE KEYS */;


--
-- Table structure for table `gestion_pavc`.`contact_fournisseur`
--

DROP TABLE IF EXISTS `contact_fournisseur`;
CREATE TABLE `contact_fournisseur` (
  `id_contact_fournisseur` int(10) NOT NULL AUTO_INCREMENT,
  `id_fourn` int(10) NOT NULL,
  `nom_contact_fournisseur` varchar(10) DEFAULT NULL,
  `prenom_contact_fournisseur` varchar(50) NOT NULL,
  `email_contact_fournisseur` varchar(20) DEFAULT NULL,
  `adr_contact_fournisseur` varchar(20) DEFAULT NULL,
  `tel_contact_fournisseur` int(20) DEFAULT NULL,
  PRIMARY KEY (`id_contact_fournisseur`,`id_fourn`),
  KEY `FK_Fourn2` (`id_fourn`),
  CONSTRAINT `FK_Fourn2` FOREIGN KEY (`id_fourn`) REFERENCES `fournisseur` (`id_fourn`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gestion_pavc`.`contact_fournisseur`
--

/*!40000 ALTER TABLE `contact_fournisseur` DISABLE KEYS */;
INSERT INTO `contact_fournisseur` (`id_contact_fournisseur`,`id_fourn`,`nom_contact_fournisseur`,`prenom_contact_fournisseur`,`email_contact_fournisseur`,`adr_contact_fournisseur`,`tel_contact_fournisseur`) VALUES 
 (2,2,'xqXQx','SQDd','jkhj@GMAIL.COM','hhhhh',4555555),
 (3,2,'med2','mod3','med4@gmail.com','alger83',55452228);
/*!40000 ALTER TABLE `contact_fournisseur` ENABLE KEYS */;


--
-- Table structure for table `gestion_pavc`.`departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE `departement` (
  `id_departement` int(10) NOT NULL AUTO_INCREMENT,
  `Nom_departement` varchar(50) DEFAULT NULL,
  `Designation` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_departement`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gestion_pavc`.`departement`
--

/*!40000 ALTER TABLE `departement` DISABLE KEYS */;
INSERT INTO `departement` (`id_departement`,`Nom_departement`,`Designation`) VALUES 
 (1,'DDA','Departement Developpement d\'affaires'),
 (2,'DOS','Departement Organisme Spécifique'),
 (3,'DE','Departement Entreprises'),
 (4,'DAP','Departement Administrations Publiques'),
 (5,'DEF','Departement Etablissements Financiers');
/*!40000 ALTER TABLE `departement` ENABLE KEYS */;


--
-- Table structure for table `gestion_pavc`.`fonction`
--

DROP TABLE IF EXISTS `fonction`;
CREATE TABLE `fonction` (
  `id_fonction` int(10) NOT NULL AUTO_INCREMENT,
  `Design_fonction` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_fonction`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gestion_pavc`.`fonction`
--

/*!40000 ALTER TABLE `fonction` DISABLE KEYS */;
INSERT INTO `fonction` (`id_fonction`,`Design_fonction`) VALUES 
 (0,'Directeur'),
 (1,'Chef du Departement Developpement d\'Affaire'),
 (2,'Ingenieur Avant-Vente'),
 (3,'Chef de Service Appel d\'Offre'),
 (4,'Chargé de Compte Hébergement Web'),
 (5,'Chargé de compte');
/*!40000 ALTER TABLE `fonction` ENABLE KEYS */;


--
-- Table structure for table `gestion_pavc`.`formulaire_pdf`
--

DROP TABLE IF EXISTS `formulaire_pdf`;
CREATE TABLE `formulaire_pdf` (
  `id_projet` int(10) NOT NULL AUTO_INCREMENT,
  `Nom_Fichier` varchar(255) DEFAULT NULL,
  `pdf` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_projet`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gestion_pavc`.`formulaire_pdf`
--

/*!40000 ALTER TABLE `formulaire_pdf` DISABLE KEYS */;
INSERT INTO `formulaire_pdf` (`id_projet`,`Nom_Fichier`,`pdf`) VALUES 
 (152,'mohoooo','upload/Dy-marche.pdf'),
 (153,'nonon','upload/DemandeAdmission.pdf'),
 (154,'pmpmpm','upload/Dy-marche.pdf');
/*!40000 ALTER TABLE `formulaire_pdf` ENABLE KEYS */;


--
-- Table structure for table `gestion_pavc`.`fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE `fournisseur` (
  `id_fourn` int(10) NOT NULL AUTO_INCREMENT,
  `Nom_fourn` varchar(15) DEFAULT NULL,
  `Adr_fourn` varchar(30) DEFAULT NULL,
  `Description_fourn` mediumtext,
  PRIMARY KEY (`id_fourn`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gestion_pavc`.`fournisseur`
--

/*!40000 ALTER TABLE `fournisseur` DISABLE KEYS */;
INSERT INTO `fournisseur` (`id_fourn`,`Nom_fourn`,`Adr_fourn`,`Description_fourn`) VALUES 
 (2,'HUAWEI','hydra','rien'),
 (6,'CISCO','Bab Ezzouar',',nk,nk');
/*!40000 ALTER TABLE `fournisseur` ENABLE KEYS */;


--
-- Table structure for table `gestion_pavc`.`projet`
--

DROP TABLE IF EXISTS `projet`;
CREATE TABLE `projet` (
  `id_projet` int(10) NOT NULL AUTO_INCREMENT,
  `Design_projet` varchar(50) DEFAULT NULL,
  `id_client` int(10) DEFAULT NULL,
  `id_user` int(10) NOT NULL DEFAULT '0',
  `Description_projet` longtext,
  `date_debut_projet` varchar(255) DEFAULT NULL,
  `date_fin_projet` varchar(255) DEFAULT NULL,
  `Etat_projet` int(3) DEFAULT '0',
  `Type_techno` longtext,
  PRIMARY KEY (`id_projet`,`id_user`),
  KEY `FK_client` (`id_client`),
  KEY `FK_user2` (`id_user`),
  CONSTRAINT `projet_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  CONSTRAINT `projet_ibfk_4` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gestion_pavc`.`projet`
--

/*!40000 ALTER TABLE `projet` DISABLE KEYS */;
INSERT INTO `projet` (`id_projet`,`Design_projet`,`id_client`,`id_user`,`Description_projet`,`date_debut_projet`,`date_fin_projet`,`Etat_projet`,`Type_techno`) VALUES 
 (36,'DRAGON OIL - Devis routeur',23,15,'devis établie à la base dela demande du DE pour répondre à une consultation restreinte\r\n','01-02-2016','16-02-2016',1,'Routeur'),
 (38,'Cosider - WAN',24,9,'en cours de négocition vue que le client souhaite avoir une solution full Wimax \r\n','01-04-2016','24-04-2016',1,'Interconnexion WAN- solution hybride-\r\nInterconnexion WAN- solution hybride-\r\n'),
 (132,'aaaaa',24,16,'dfghj','05/31/2016','06/15/2016',0,NULL),
 (133,'aaaaa',24,16,'dfghj','05/31/2016','06/15/2016',0,NULL),
 (134,'aaaaazertt',20,17,'ksokao','06/07/2016','06/08/2016',0,NULL),
 (135,'aaaaazertt',20,17,'ksokao','06/07/2016','06/08/2016',0,NULL),
 (136,'fghjk',22,24,'fghjk;','06/07/2016','07/06/2016',0,NULL),
 (137,'fghjk',22,24,'fghjk;','06/07/2016','07/06/2016',0,NULL),
 (138,'popop',17,17,'kk,k','06/22/2016','06/08/2016',0,NULL),
 (139,'popop',17,17,'kk,k','06/22/2016','06/08/2016',0,NULL);
INSERT INTO `projet` (`id_projet`,`Design_projet`,`id_client`,`id_user`,`Description_projet`,`date_debut_projet`,`date_fin_projet`,`Etat_projet`,`Type_techno`) VALUES 
 (140,'kppppppp',15,20,'llk','06/09/2016','06/16/2016',0,NULL),
 (141,'kppppppp',15,20,'llk','06/09/2016','06/16/2016',0,NULL),
 (142,'iuoioio',18,19,'kjkj','06/08/2016','06/10/2016',0,NULL),
 (143,'iuoioio',18,19,'kjkj','06/08/2016','06/10/2016',0,NULL),
 (144,'iuoioio',18,19,'kjkj','06/08/2016','06/10/2016',0,NULL),
 (145,'iuoioio',18,19,'kjkj','06/08/2016','06/10/2016',0,NULL),
 (146,'loool',21,17,'kjkjk','06/16/2016','06/10/2016',0,NULL),
 (147,'11324',19,16,'jhjj','06/09/2016','06/16/2016',0,NULL),
 (148,'testooo',21,19,'fghjk','06/23/2016','06/08/2016',0,NULL),
 (149,'tasetoop',22,20,'ghjkl','06/23/2016','06/07/2016',0,NULL),
 (150,'pouop',21,18,'ghjkl:','06/01/2016','06/02/2016',0,NULL),
 (151,'aminoo',19,18,'fghjk','06/02/2016','06/29/2016',0,NULL),
 (152,'mohmoh',18,17,'ghjkl','06/08/2016','06/23/2016',0,NULL),
 (153,'wissem',12,18,'sdfghjk','06/08/2016','06/22/2016',0,NULL);
INSERT INTO `projet` (`id_projet`,`Design_projet`,`id_client`,`id_user`,`Description_projet`,`date_debut_projet`,`date_fin_projet`,`Etat_projet`,`Type_techno`) VALUES 
 (154,'mipa',18,16,'ertyui','06/01/2016','06/09/2016',0,NULL);
/*!40000 ALTER TABLE `projet` ENABLE KEYS */;


--
-- Table structure for table `gestion_pavc`.`projet_fournisseur`
--

DROP TABLE IF EXISTS `projet_fournisseur`;
CREATE TABLE `projet_fournisseur` (
  `id_projet` int(10) NOT NULL DEFAULT '0',
  `id_fourn` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_projet`,`id_fourn`),
  KEY `FK_fourn` (`id_fourn`),
  CONSTRAINT `FK_fourn` FOREIGN KEY (`id_fourn`) REFERENCES `fournisseur` (`id_fourn`),
  CONSTRAINT `FK_projet` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id_projet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gestion_pavc`.`projet_fournisseur`
--

/*!40000 ALTER TABLE `projet_fournisseur` DISABLE KEYS */;
INSERT INTO `projet_fournisseur` (`id_projet`,`id_fourn`) VALUES 
 (146,2),
 (148,2),
 (149,2),
 (150,2),
 (151,2),
 (152,2),
 (153,2),
 (154,2),
 (147,6);
/*!40000 ALTER TABLE `projet_fournisseur` ENABLE KEYS */;


--
-- Table structure for table `gestion_pavc`.`projet_structure`
--

DROP TABLE IF EXISTS `projet_structure`;
CREATE TABLE `projet_structure` (
  `id_projet` int(10) NOT NULL DEFAULT '0',
  `id_struc` int(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_projet`,`id_struc`),
  KEY `id_struc` (`id_struc`),
  CONSTRAINT `FK_projet3` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id_projet`),
  CONSTRAINT `projet_structure_ibfk_1` FOREIGN KEY (`id_struc`) REFERENCES `structure_technique` (`id_struc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gestion_pavc`.`projet_structure`
--

/*!40000 ALTER TABLE `projet_structure` DISABLE KEYS */;
/*!40000 ALTER TABLE `projet_structure` ENABLE KEYS */;


--
-- Table structure for table `gestion_pavc`.`structure_technique`
--

DROP TABLE IF EXISTS `structure_technique`;
CREATE TABLE `structure_technique` (
  `id_struc` int(10) NOT NULL AUTO_INCREMENT,
  `Design_struc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_struc`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gestion_pavc`.`structure_technique`
--

/*!40000 ALTER TABLE `structure_technique` DISABLE KEYS */;
INSERT INTO `structure_technique` (`id_struc`,`Design_struc`) VALUES 
 (1,'Reseau LAN WAN'),
 (2,'Wifi Wimax'),
 (3,'LTE'),
 (4,'4G');
/*!40000 ALTER TABLE `structure_technique` ENABLE KEYS */;


--
-- Table structure for table `gestion_pavc`.`tache_predifinie`
--

DROP TABLE IF EXISTS `tache_predifinie`;
CREATE TABLE `tache_predifinie` (
  `id_tache` int(10) NOT NULL AUTO_INCREMENT,
  `Design_tache` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_tache`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gestion_pavc`.`tache_predifinie`
--

/*!40000 ALTER TABLE `tache_predifinie` DISABLE KEYS */;
INSERT INTO `tache_predifinie` (`id_tache`,`Design_tache`) VALUES 
 (1,'rienrr'),
 (2,'Defintion des besoins'),
 (3,'ARRAAR'),
 (4,'sasa');
/*!40000 ALTER TABLE `tache_predifinie` ENABLE KEYS */;


--
-- Table structure for table `gestion_pavc`.`tache_projet`
--

DROP TABLE IF EXISTS `tache_projet`;
CREATE TABLE `tache_projet` (
  `id_tache_projet` int(10) NOT NULL AUTO_INCREMENT,
  `Priorite_tache` varchar(10) DEFAULT NULL,
  `id_tache` int(10) NOT NULL DEFAULT '0',
  `id_projet` int(10) NOT NULL DEFAULT '0',
  `date_debut_tache` varchar(255) DEFAULT NULL,
  `date_fin_tache` varchar(255) DEFAULT NULL,
  `Etat_tache` int(11) DEFAULT '0',
  PRIMARY KEY (`id_tache_projet`,`id_tache`,`id_projet`),
  KEY `FK_projet5` (`id_projet`),
  KEY `FK_tache` (`id_tache`),
  CONSTRAINT `FK_projet5` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id_projet`),
  CONSTRAINT `FK_tache` FOREIGN KEY (`id_tache`) REFERENCES `tache_predifinie` (`id_tache`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gestion_pavc`.`tache_projet`
--

/*!40000 ALTER TABLE `tache_projet` DISABLE KEYS */;
INSERT INTO `tache_projet` (`id_tache_projet`,`Priorite_tache`,`id_tache`,`id_projet`,`date_debut_tache`,`date_fin_tache`,`Etat_tache`) VALUES 
 (5,'haute',2,38,'12/12/12','12/12/12',1);
/*!40000 ALTER TABLE `tache_projet` ENABLE KEYS */;


--
-- Table structure for table `gestion_pavc`.`user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `Nom_user` char(20) NOT NULL,
  `Prenom_user` char(20) DEFAULT NULL,
  `Tel_user` varchar(10) DEFAULT NULL,
  `Email_user` varchar(50) DEFAULT NULL,
  `id_fonction` int(10) DEFAULT NULL,
  `pseudo` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `id_departement` int(10) DEFAULT NULL,
  `matricule` int(10) DEFAULT NULL,
  `num_install` int(10) DEFAULT NULL,
  `date_recru` varchar(10) DEFAULT NULL,
  `date_install` varchar(10) DEFAULT NULL,
  `type_contr` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_user`,`Nom_user`),
  KEY `FK_fonction` (`id_fonction`),
  KEY `FK_departement` (`id_departement`),
  CONSTRAINT `FK_departement` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id_departement`),
  CONSTRAINT `FK_fonction` FOREIGN KEY (`id_fonction`) REFERENCES `fonction` (`id_fonction`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gestion_pavc`.`user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`,`Nom_user`,`Prenom_user`,`Tel_user`,`Email_user`,`id_fonction`,`pseudo`,`password`,`id_departement`,`matricule`,`num_install`,`date_recru`,`date_install`,`type_contr`) VALUES 
 (8,'wissem','0Wissem','2054220000','wissem@gmail.com',2,'wissem','2016',2,1222,1581181,'12-11-13','12-01-11','CDI'),
 (9,'Bougheloum','Mohammed','0660770389','Bougheloum@algerietelecom.dz',2,'Mou','0000000',1,151515,1581155,'12-11-13','12-05-13','CDI'),
 (11,'FELFOUL','Lynda','0660848943','felfoul@at.dz',2,'Lynda','0000',1,15151651,15811665,'12-11-13','12-11-13','CDI'),
 (13,'AFRIT','Siham','0660340349','siham.alem@algerietelecom.dz',2,'Siham','motdepasse',1,1615656,15814555,'12-11-13','12-05-16','CDI'),
 (15,'BELARBI','Rachda','0660378710','r_belarbi@algerietelecom.dz',2,'Rachda','1234',1,156565,15859441,'12-11-13','12-11-13','CDI'),
 (16,'DJENOURI','Mohamed Amine','0557984102','amine.djenouri@alegerietelecom.dz',2,'94','0000',1,6616161,4941181,'12-11-13','12-11-13','CDT'),
 (17,'ALLALI','Redha','0660824189','allali@algerietelecom.dz',1,'The_Boss','2015',1,6845454,18954121,'12-11-13','12-04-13','CDI'),
 (18,'DAOUD','Yacine',NULL,NULL,5,'yacine','0000',4,55222222,15145454,'02-10-15','12-11-13','CDI');
INSERT INTO `user` (`id_user`,`Nom_user`,`Prenom_user`,`Tel_user`,`Email_user`,`id_fonction`,`pseudo`,`password`,`id_departement`,`matricule`,`num_install`,`date_recru`,`date_install`,`type_contr`) VALUES 
 (19,'ABDMEZIANE','Abderrahmane','0660570005','a.abdmeziane@algerietelecom.dz',2,'Abdou','abdou',1,16151561,556564,'12-01-16','01-04-14','CDT'),
 (20,'TIDADINI','FOUZI LARBI','0660843702','TIDADINI@ALGERIETELECOM.DZ',2,'FOUZI','ADAMWASSIM',1,55456522,5154,'17-04-14','12-11-14','CDI'),
 (23,'fadi','fao','05547555','fado@gmail.com',2,'fadi','azerty',3,5155,7888,'22-12-14','22-05-14','CDI'),
 (24,'fadi','fao','05547555','fado@gmail.com',2,'fado','12346',3,55445555,584894854,'04-04-14','12-11-15','CDI'),
 (25,'mouniii','i','5243','i@gmail.com',2,'kjghj','1234565',5,5649464,65654546,'22-12-14','12-11-13','CDI'),
 (26,'eghjk','dfghj','54785','k@gmail.com',1,'fghj','hj',4,656565,5555555,'25-06-10','12-11-12','CDI'),
 (27,'jj','jjj','0222555565','jjjj@gmail.comc',1,'aaaaaaaaa','aaaaaaaaa',4,1555545,5845555,'14-11-12','12-11-11','CDI');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
