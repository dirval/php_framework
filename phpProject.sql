-- MySQL dump 10.13  Distrib 5.5.46, for Win32 (x86)
--
-- Host: localhost    Database: projectphp
-- ------------------------------------------------------
-- Server version	5.5.46

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_text` text NOT NULL,
  `ranking` char(1) NOT NULL,
  `ref_id_user` int(10) unsigned NOT NULL,
  `ref_id_media` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`ref_id_user`),
  KEY `fk_media_id` (`ref_id_media`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`ref_id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_media_id` FOREIGN KEY (`ref_id_media`) REFERENCES `media` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (2,'It\'s the best manga ever! I advice you to read it! ','5',3,5),(3,'Yep it great but a don\'t like the end! Sometime is funny.','3',3,7),(4,'I totaly agree with toto !!!','5',4,5),(5,'This manga is fun, there all what we want, we laugh, there are lot of action and the story is awesome!\r\nIf you don\'t know what read, take it! ','4',4,6);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` char(1) NOT NULL,
  `title` varchar(40) NOT NULL,
  `author` varchar(40) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `year` varchar(9) NOT NULL,
  `in_anime` char(1) DEFAULT NULL,
  `studio` varchar(30) DEFAULT NULL,
  `image` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'1','Naruto','Masashi Kishimoto','Shōnen','1999/2014','0',NULL,'images/manga/Naruto_manga3.jpg','A powerful fox known as the Nine-Tails attacks Konoha, the hidden village in the Land of Fire, one of the Five Great Shinobi Countries in the Ninja World. In response, the leader of Konoha, the Fourth Hokage, seals the fox inside the body of his newborn son, Naruto Uzumaki, at the cost of the father\'s life. As a child, Naruto is isolated from the Konoha community, which regards him as if he was the Nine-Tails. A decree made by the leader the Third Hokage forbids anyone mentioning the Nine-Tails to anyone else. Twelve years later, renegade ninja Mizuki reveals the truth to Naruto before being defeated by him with the Shadow Clone Jutsu technique, earning the respect of his teacher Iruka Umino. Shortly after, Naruto becomes a ninja and is assigned along with Sasuke Uchiha, whom he often competes against, and Sakura Haruno, on whom he has a crush, to form a three-person team, Team 7, under an experienced sensei, the elite ninja Kakashi Hatake. Like all the ninja teams from every village, Team 7 is charged with completing missions requested by villagers, ranging from doing chores and being bodyguards to performing assassinations.'),(2,'0','Angel Beats','Seiji Kishi','Action / Comedy-drama / Supernatural','2010',NULL,'P.A Work','images/anime/angel_beats_anime.jpg','Angel Beats! takes place at a high school acting as a limbo for teenagers who have died, but experienced hardships or traumas when alive that they must come to terms with and accept before being given a second chance at life. Those in the afterlife school can still feel pain as they did when they were alive, as well as dying again, only to awaken later with no injuries. The story follows the main protagonist Otonashi, a boy who has lost his memories of his life after dying. He meets Yuri, a girl who invites him to join the Afterlife Battlefront (死んだ世界戦線 Shinda Sekai Sensen, (SSS)), an organization she founded and leads which fights against God for the negative experiences the SSS members went through in life.'),(3,'0','Death Note','Tsugumi Ohba','Shōnen / Occult / detective / psychological thrill','2006/2007',NULL,'Madhouse','images/anime/death_note.jpg','Light Yagami is a genius high school student who discovers the \"Death Note\", a notebook that kills anyone whose name is written in it. After experimenting with the notebook, Light meets the Shinigami Ryuk, the notebook\'s original owner, who dropped the notebook to the human world out of boredom. Light tells Ryuk of his plan to rule as a god over a new world free from criminals, where only people he deems morally fit to live remain. Light becomes known to the public as Kira (キラ?), which is derived from the Japanese pronunciation of the word \"killer\".'),(4,'1','Satan 666','Kishimoto Seishi','Action / Adventure / Comedy / Fantasy / Shonen','2001/2007','0',NULL,'images/manga/666-satan.jpg','Ruby Crescent is an ordinary girl, who likes to go out with boys and shop. Her life is changed dramatically when her father dies and she becomes a treasure hunter as he was. Her objective is to find O-Parts -- magical items hidden under the ground which grant people superhuman powers and can only be used by an O.P.T. (O-Part Tactician) or descendant of the Angel and Devil. She soon meets a mysterious boy named Jio who, due to having a dark, lonely past, seeks to conquer the world. Jio is hostile to her at first, but ends up travelling with Ruby as her bodyguard. When Ruby is attacked by an O.P.T. claiming to be Satan, Jio rushes to her rescue and a battle occurs. Initially they are on the losing side, but Jio releases his true power and is revealed to be not only an O.P.T., but the real Satan. Thus, the two continue to travel together in hopes of unlocking their pasts.'),(5,'1','Dragon Ball','Akira Toriyama','Action / Aventure / Shonen / Comedy','1984/1995','1',NULL,'images/manga/dragon-ball.jpg','Son Goku\'s adventure starts with Bulma crashing into to him while she is searching for the seven magical Dragon Balls, which can grant any wish. Together, they meet many people and many foes in their adventure chasing after the Dragon Balls.'),(6,'1','Assassination Classroom','MATSUI Yuusei','Action / Shonen','2012','1',NULL,'images/manga/assassination-classroom.jpg','The students of class 3-E have a mission: kill their teacher before graduation. He has already destroyed the moon, and has promised to destroy the Earth if he can not be killed within a year. But how can this class of misfits kill a tentacled monster, capable of reaching Mach 20 speed, who may be the best teacher any of them have ever had?'),(7,'0','Soul Eater','Atsushi Ōkubo','Shōnen / action / aventure','2008/2009',NULL,'Bones','images/anime/soul_eater.jpg','Soul Eater is set at Death Weapon Meister Academy (死神武器職人専門学校 Shinigami Buki Shokunin Senmon Gakkō)—\"DWMA\" (死武専 Shibusen) for short—located in the fictional Death City in Nevada, United States. The school is run by Shinigami, also known as Death, as a training facility for humans with the ability to transform into weapons, as well as the wielders of those weapons, called meisters (職人 shokunin?). Attending this school are meister Maka Albarn and her scythe partner Soul Eater; assassin Black Star and his partner Tsubaki Nakatsukasa, who can turn into weapons such as a kusarigama, shuriken, and ninjatō; and Shinigami\'s son Death the Kid and his pistol partners Liz and Patty Thompson. The goal of the school\'s meister students is to have their weapons defeat and absorb the souls of 99 evil humans and one witch, which will dramatically increase the power of the weapon and turn them into \"death scythes\", weapons capable of being used by Shinigami.'),(8,'0','Samurai Champloo','Shinichirō Watanabe','Action / Adventure / Chanbara','2004/2005',NULL,'Manglobe','images/anime/Samurai_Champloo_Logo.png','A young woman named Fuu is working as a waitress in a tea shop when she is abused by a band of samurai. She is saved by a mysterious rogue named Mugen and a young rōnin named Jin. Mugen attacks Jin after he proves to be a worthy opponent. The pair begin fighting one another and inadvertently cause the death of Shibui Tomonoshina, the magistrate\'s son. For this crime, they are to be executed. With help from Fuu, they are able to escape execution. In return, Fuu asks them to travel with her to find \"the samurai who smells of sunflowers\".');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(50) NOT NULL,
  `img_profile` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918','admin@admin.com','images/user/default_profile.png','I am the administrator'),(3,'toto','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4','toto@toto.com','images/user/15cd4af31e51e535b4a888e319587d4e.jpg',''),(4,'tata','d1c7c99c6e2e7b311f51dd9d19161a5832625fb21f35131fba6da62513f0c099','tata@tata.com','images/user/091010145756_20.jpg','I\'am a fan of the Manga I love it!');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-25 19:23:59
