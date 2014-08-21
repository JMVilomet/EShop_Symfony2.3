/*
SQLyog Community v11.12 Beta1 (64 bit)
MySQL - 5.5.27 : Database - symfony
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`symfony` /*!40100 DEFAULT CHARACTER SET utf8 */;

/*Data for the table `admin_user` */

insert  into `admin_user`(`id`,`username`,`username_canonical`,`email`,`email_canonical`,`enabled`,`salt`,`password`,`last_login`,`locked`,`expired`,`expires_at`,`confirmation_token`,`password_requested_at`,`roles`,`credentials_expired`,`credentials_expire_at`) values (1,'admin','admin','admin@localhost','admin@localhost',1,'p6s3j9krx34wgww4ocskg80gk4sogcg','C7eHdkwZWLxNUtzfZVz/bP/6bY4AeaAXcEYw3yUh5PWI7bv5veu1io0rPrusGnpBwtoB6y9GRZIJP6WW5h89RA==','2014-08-21 15:16:03',0,0,NULL,NULL,NULL,'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}',0,NULL);

/*Data for the table `article` */

insert  into `article`(`id`,`designation`,`puht`,`lot`,`stock`,`categorie_id`,`description`,`photo`,`cab`,`enligne`,`date_ajout`) values (1,'Dead Rising 3 Apocalypse Edition','29.01',1,100,1,'Parcourez Los Perdidos pour trouver un moyen de vous échapper avant qu’une frappe militaire ne raye de la carte cette ville envahie par les zombies.','http://cdn.akamai.steamstatic.com/steam/apps/265550/header_292x136.jpg','353879',1,'2014-07-31 10:21:09');
insert  into `article`(`id`,`designation`,`puht`,`lot`,`stock`,`categorie_id`,`description`,`photo`,`cab`,`enligne`,`date_ajout`) values (2,'Counter-Strike: Global Offensive','8.28',1,100,2,'Counter-Strike: Global Offensive (CS: GO) étend le genre du jeu d\'action dont Counter-Strike fut le pionnier lors de sa sortie, il y a plus de 12 ans.','http://cdn.akamai.steamstatic.com/steam/apps/730/header_292x136.jpg?t=1404760172','965416',1,'2014-08-05 10:21:06');
insert  into `article`(`id`,`designation`,`puht`,`lot`,`stock`,`categorie_id`,`description`,`photo`,`cab`,`enligne`,`date_ajout`) values (3,'Dota 2','0.00',1,100,3,'Dota a tout d\'abord été une modification faite par des joueurs de Warcraft 3 et a fini par être un des jeux les plus joués au monde. Dota 2 est le fruit du recrutement des développeurs de la communauté. ','http://cdn.akamai.steamstatic.com/steam/apps/570/header_292x136.jpg','652588',1,'2014-05-08 10:21:13');
insert  into `article`(`id`,`designation`,`puht`,`lot`,`stock`,`categorie_id`,`description`,`photo`,`cab`,`enligne`,`date_ajout`) values (4,'Royal Quest','0.00',1,0,3,'Royal Quest offers a fresh MMO experience from the creators of Space Rangers and King\'s Bounty series. Join Guild Wars, conquer Castles, and battle other players in unique PvPvE locations, or explore the vast world of Aura.','http://cdn.akamai.steamstatic.com/steam/apps/295550/header_292x136.jpg','868515',1,'2014-08-08 14:28:08');
insert  into `article`(`id`,`designation`,`puht`,`lot`,`stock`,`categorie_id`,`description`,`photo`,`cab`,`enligne`,`date_ajout`) values (5,'The Witcher® 3: Wild Hunt','33.16',1,100,4,'The Witcher 3: Wild Hunt is a storydriven, next-generation open world role-playing game, set in a graphically stunning fantasy universe, full of meaningful choices and impactful consequences.','http://cdn.akamai.steamstatic.com/steam/apps/292030/header_292x136.jpg','889878',1,'2014-08-08 14:30:13');

/*Data for the table `categorie` */

insert  into `categorie`(`id`,`libelle`,`ordre`) values (1,'Action',1);
insert  into `categorie`(`id`,`libelle`,`ordre`) values (2,'FPS',2);
insert  into `categorie`(`id`,`libelle`,`ordre`) values (3,'F2P',3);
insert  into `categorie`(`id`,`libelle`,`ordre`) values (4,'RPG',4);

/*Data for the table `departement` */

insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (1,'1','Ain','Bourg-en-Bresse','Rhône-Alpes');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (2,'2','Aisne','Laon','Picardie');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (3,'3','Allier','Moulins','Auvergne');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (4,'4','Alpes-de-Haute-Provence','Digne-les-Bains','Provence-Alpes-Côte d\'Azur');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (5,'5','Hautes-Alpes','Gap','Provence-Alpes-Côte d\'Azur');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (6,'6','Alpes-Maritimes','Nice','Provence-Alpes-Côte d\'Azur');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (7,'7','Ardèche','Privas','Rhône-Alpes');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (8,'8','Ardennes','Charleville-Mézières','Champagne-Ardenne');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (9,'9','Ariège','Foix','Midi-Pyrénées');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (10,'10','Aube','Troyes','Champagne-Ardenne');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (11,'11','Aude','Carcassonne','Languedoc-Roussillon');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (12,'12','Aveyron','Rodez','Midi-Pyrénées');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (13,'13','Bouches-du-Rhône','Marseille','Provence-Alpes-Côte d\'Azur');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (14,'14','Calvados','Caen','Basse-Normandie');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (15,'15','Cantal','Aurillac','Auvergne');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (16,'16','Charente','Angoulême','Poitou-Charentes');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (17,'17','Charente-Maritime','La Rochelle','Poitou-Charentes');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (18,'18','Cher','Bourges','Centre');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (19,'19','Corrèze','Tulle','Limousin');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (20,'2A','Corse-du-Sud','Ajaccio','Corse');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (21,'2B','Haute-Corse','Bastia','Corse');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (22,'21','Côte-d\'Or','Dijon','Bourgogne');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (23,'22','Côtes-d\'Armor','Saint-Brieuc','Bretagne');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (24,'23','Creuse','Guéret','Limousin');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (25,'24','Dordogne','Périgueux','Aquitaine');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (26,'25','Doubs','Besançon','Franche-Comté');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (27,'26','Drôme','Valence','Rhône-Alpes');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (28,'27','Eure','Évreux','Haute-Normandie');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (29,'28','Eure-et-Loir','Chartres','Centre');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (30,'29','Finistère','Quimper','Bretagne');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (31,'30','Gard','Nîmes','Languedoc-Roussillon');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (32,'31','Haute-Garonne','Toulouse','Midi-Pyrénées');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (33,'32','Gers','Auch','Midi-Pyrénées');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (34,'33','Gironde','Bordeaux','Aquitaine');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (35,'34','Hérault','Montpellier','Languedoc-Roussillon');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (36,'35','Ille-et-Vilaine','Rennes','Bretagne');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (37,'36','Indre','Châteauroux','Centre');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (38,'37','Indre-et-Loire','Tours','Centre');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (39,'38','Isère','Grenoble','Rhône-Alpes');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (40,'39','Jura','Lons-le-Saunier','Franche-Comté');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (41,'40','Landes','Mont-de-Marsan','Aquitaine');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (42,'41','Loir-et-Cher','Blois','Centre');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (43,'42','Loire','Saint-Étienne','Rhône-Alpes');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (44,'43','Haute-Loire','Le Puy-en-Velay','Auvergne');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (45,'44','Loire-Atlantique','Nantes','Pays de la Loire');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (46,'45','Loiret','Orléans','Centre');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (47,'46','Lot','Cahors','Midi-Pyrénées');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (48,'47','Lot-et-Garonne','Agen','Aquitaine');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (49,'48','Lozère','Mende','Languedoc-Roussillon');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (50,'49','Maine-et-Loire','Angers','Pays de la Loire');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (51,'50','Manche','Saint-Lô','Basse-Normandie');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (52,'51','Marne','Châlons-en-Champagne','Champagne-Ardenne');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (53,'52','Haute-Marne','Chaumont','Champagne-Ardenne');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (54,'53','Mayenne','Laval','Pays de la Loire');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (55,'54','Meurthe-et-Moselle','Nancy','Lorraine');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (56,'55','Meuse','Bar-le-Duc','Lorraine');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (57,'56','Morbihan','Vannes','Bretagne');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (58,'57','Moselle','Metz','Lorraine');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (59,'58','Nièvre','Nevers','Bourgogne');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (60,'59','Nord','Lille','Nord-Pas-de-Calais');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (61,'60','Oise','Beauvais','Picardie');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (62,'61','Orne','Alençon','Basse-Normandie');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (63,'62','Pas-de-Calais','Arras','Nord-Pas-de-Calais');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (64,'63','Puy-de-Dôme','Clermont-Ferrand','Auvergne');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (65,'64','Pyrénées-Atlantiques','Pau','Aquitaine');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (66,'65','Hautes-Pyrénées','Tarbes','Midi-Pyrénées');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (67,'66','Pyrénées-Orientales','Perpignan','Languedoc-Roussillon');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (68,'67','Bas-Rhin','Strasbourg','Alsace');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (69,'68','Haut-Rhin','Colmar','Alsace');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (70,'69','Rhône','Lyon','Rhône-Alpes');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (71,'70','Haute-Saône','Vesoul','Franche-Comté');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (72,'71','Saône-et-Loire','Macon','Bourgogne');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (73,'72','Sarthe','Le Mans','Pays de la Loire');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (74,'73','Savoie','Chambéry','Rhône-Alpes');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (75,'74','Haute-Savoie','Annecy','Rhône-Alpes');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (76,'75','Paris','Paris','Île-de-France');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (77,'76','Seine-Maritime','Rouen','Haute-Normandie');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (78,'77','Seine-et-Marne','Melun','Île-de-France');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (79,'78','Yvelines','Versailles','Île-de-France');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (80,'79','Deux-Sèvres','Niort','Poitou-Charentes');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (81,'80','Somme','Amiens','Picardie');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (82,'81','Tarn','Albi','Midi-Pyrénées');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (83,'82','Tarn-et-Garonne','Montauban','Midi-Pyrénées');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (84,'83','Var','Toulon','Provence-Alpes-Côte d\'Azur');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (85,'84','Vaucluse','Avignon','Provence-Alpes-Côte d\'Azur');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (86,'85','Vendée','La Roche-sur-Yon','Pays de la Loire');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (87,'86','Vienne','Poitiers','Poitou-Charentes');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (88,'87','Haute-Vienne','Limoges','Limousin');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (89,'88','Vosges','Épinal','Lorraine');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (90,'89','Yonne','Auxerre','Bourgogne');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (91,'90','Territoire de Belfort','Belfort','Franche-Comté');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (92,'91','Essonne','Évry','Île-de-France');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (93,'92','Hauts-de-Seine','Nanterre','Île-de-France');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (94,'93','Seine-Saint-Denis','Bobigny','Île-de-France');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (95,'94','Val-de-Marne','Créteil','Île-de-France');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (96,'95','Val-d\'Oise','Pontoise2','Île-de-France');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (97,'971','Guadeloupe','Basse-Terre','Guadeloupe');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (98,'972','Martinique','Fort-de-France','Martinique');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (99,'973','Guyane','Cayenne','Guyane');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (100,'974','La Réunion','Saint-Denis','La Réunion');
insert  into `departement`(`id`,`numero`,`Departement`,`Prefecture`,`Region`) values (101,'976','Mayotte','Mamoudzou','Mayotte');

/*Data for the table `livraison` */

/*Data for the table `livraison_panier` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
