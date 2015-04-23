# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: koufucolorprinting.com (MySQL 5.5.41-cll-lve)
# Database: dev_koufu_system
# Generation Time: 2015-04-23 03:59:41 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table item_category_holders
# ------------------------------------------------------------

LOCK TABLES `item_category_holders` WRITE;
/*!40000 ALTER TABLE `item_category_holders` DISABLE KEYS */;

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(18,'Packaging',NULL,NULL,NULL,0,'2015-04-14 23:33:11','2015-04-14 23:33:11');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(19,'Commercial',NULL,NULL,NULL,0,'2015-04-14 23:33:20','2015-04-14 23:33:20');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(20,'Publishing',NULL,NULL,NULL,0,'2015-04-14 23:33:28','2015-04-14 23:33:28');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(21,'Food Packaging',NULL,NULL,NULL,0,'2015-04-14 23:33:36','2015-04-14 23:33:36');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(22,'Digital Product',NULL,NULL,NULL,0,'2015-04-14 23:33:42','2015-04-14 23:33:42');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(23,'Promotional Items',NULL,NULL,NULL,0,'2015-04-14 23:33:49','2015-04-14 23:33:49');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(24,'Office Supplies',NULL,NULL,NULL,0,'2015-04-14 23:33:55','2015-04-14 23:33:55');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(25,'Fixed Items',NULL,NULL,NULL,0,'2015-04-14 23:34:01','2015-04-14 23:34:01');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(26,'Sticker',NULL,NULL,NULL,0,'2015-04-14 23:34:06','2015-04-14 23:34:06');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(27,'Service',NULL,NULL,NULL,0,'2015-04-14 23:34:12','2015-04-14 23:34:12');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(28,'Printing Service',NULL,NULL,NULL,0,'2015-04-14 23:34:18','2015-04-14 23:34:18');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(29,'Lamination Service',NULL,NULL,NULL,0,'2015-04-14 23:34:23','2015-04-14 23:34:23');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(30,'Prepress Service',NULL,NULL,NULL,0,'2015-04-14 23:34:28','2015-04-14 23:34:28');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(31,'Binding Service',NULL,NULL,NULL,0,'2015-04-14 23:34:32','2015-04-16 09:18:21');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(32,'Publishing Service',NULL,NULL,NULL,0,'2015-04-14 23:34:37','2015-04-14 23:34:37');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(33,'Packaging Service',NULL,NULL,NULL,0,'2015-04-14 23:34:42','2015-04-14 23:34:42');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(34,'Post Press Service',NULL,NULL,NULL,0,'2015-04-14 23:34:47','2015-04-14 23:34:47');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(35,'Material',NULL,NULL,NULL,0,'2015-04-14 23:34:51','2015-04-15 07:09:11');

INSERT INTO `item_category_holders` (`id`, `name`, `status`, `created_by`, `modified_by`, `category_type`, `created`, `modified`)
VALUES
	(47,'category fo item group',NULL,NULL,NULL,1,'2015-04-22 02:55:49','2015-04-22 02:55:49');

/*!40000 ALTER TABLE `item_category_holders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table item_type_holders
# ------------------------------------------------------------

LOCK TABLES `item_type_holders` WRITE;
/*!40000 ALTER TABLE `item_type_holders` DISABLE KEYS */;

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(11,18,'Box',NULL,'2015-04-16 06:30:13','2015-04-16 06:34:08');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(12,18,'Color Corrugated Box',NULL,'2015-04-16 06:30:31','2015-04-16 06:33:57');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(13,18,'Display Tray',NULL,'2015-04-16 06:32:24','2015-04-16 06:34:19');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(14,18,'Shopping Bag',NULL,'2015-04-16 06:33:27','2015-04-16 06:33:27');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(16,18,'Card',NULL,'2015-04-16 08:16:03','2015-04-16 08:16:03');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(17,18,'HardCase',NULL,'2015-04-16 08:16:25','2015-04-16 08:16:25');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(18,18,'Partition',NULL,'2015-04-16 08:16:47','2015-04-16 08:16:47');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(20,18,'Del',NULL,'2015-04-16 08:17:36','2015-04-16 08:17:36');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(21,18,'Master Carton',NULL,'2015-04-16 08:18:00','2015-04-16 08:18:00');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(22,18,'Insert',NULL,'2015-04-16 08:18:21','2015-04-16 08:18:21');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(23,18,'Envelope',NULL,'2015-04-16 08:19:25','2015-04-16 08:19:25');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(24,18,'Sleeve',NULL,'2015-04-16 08:21:47','2015-04-16 08:21:47');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(25,19,'Flyer',NULL,'2015-04-16 08:22:37','2015-04-16 08:22:37');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(26,19,'Poster',NULL,'2015-04-16 08:22:52','2015-04-16 08:22:52');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(27,19,'Label',NULL,'2015-04-16 08:23:09','2015-04-16 08:23:09');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(28,20,'Book',NULL,'2015-04-16 08:23:35','2015-04-16 08:23:35');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(29,20,'Magazine',NULL,'2015-04-16 08:23:53','2015-04-16 08:23:53');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(30,20,'Manual',NULL,'2015-04-16 08:24:04','2015-04-16 08:24:04');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(31,21,'Cake Pad',NULL,'2015-04-16 08:24:50','2015-04-16 08:24:50');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(32,21,'Cone Sleeve',NULL,'2015-04-16 08:25:24','2015-04-16 08:25:24');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(33,21,'Meal Box',NULL,'2015-04-16 08:25:39','2015-04-16 08:25:39');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(34,21,'Paper Cup',NULL,'2015-04-16 08:26:00','2015-04-16 08:26:00');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(35,21,'Food Wrapper',NULL,'2015-04-16 08:26:16','2015-04-16 08:26:16');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(36,21,'Lid',NULL,'2015-04-16 08:26:27','2015-04-16 08:26:27');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(37,21,'Tray',NULL,'2015-04-16 08:26:43','2015-04-16 08:26:43');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(38,21,'SOS Bag',NULL,'2015-04-16 08:27:00','2015-04-16 08:27:00');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(39,22,'Tarpauline',NULL,'2015-04-16 08:27:33','2015-04-16 08:27:33');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(40,22,'Variable Print',NULL,'2015-04-16 08:27:53','2015-04-16 08:27:53');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(41,22,'POD Photo Book',NULL,'2015-04-16 08:28:15','2015-04-16 08:28:15');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(42,22,'POD Book',NULL,'2015-04-16 08:28:36','2015-04-16 08:28:36');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(43,22,'POD Calendar',NULL,'2015-04-16 08:28:55','2015-04-16 08:28:55');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(44,22,'Del',NULL,'2015-04-16 08:29:10','2015-04-16 08:29:10');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(45,22,'ID',NULL,'2015-04-16 08:29:25','2015-04-16 08:29:25');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(46,23,'Scratch Card',NULL,'2015-04-16 08:30:05','2015-04-16 08:30:05');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(47,23,'Ticket',NULL,'2015-04-16 08:30:19','2015-04-16 08:30:19');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(48,23,'Peel of Card',NULL,'2015-04-16 08:30:35','2015-04-16 08:30:35');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(49,23,'Note Pad',NULL,'2015-04-16 08:30:56','2015-04-16 08:30:56');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(50,23,'Backboard Poster',NULL,'2015-04-16 08:31:19','2015-04-16 08:31:19');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(51,24,'Business Cards',NULL,'2015-04-16 08:31:45','2015-04-16 08:31:45');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(52,24,'Forms',NULL,'2015-04-16 08:32:01','2015-04-16 08:32:01');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(53,24,'Folder',NULL,'2015-04-16 08:32:19','2015-04-16 08:32:19');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(54,25,'Business Cards',NULL,'2015-04-16 08:32:46','2015-04-16 08:32:46');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(55,25,'Flyer',NULL,'2015-04-16 08:33:00','2015-04-16 08:33:00');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(56,25,'Poster',NULL,'2015-04-16 08:33:11','2015-04-16 08:33:11');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(57,26,'Blank Sticker by Roll',NULL,'2015-04-16 08:33:58','2015-04-16 08:33:58');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(58,26,'Blank Sticker by Sheet',NULL,'2015-04-16 08:34:27','2015-04-16 08:34:27');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(59,26,'Blank Sticker Form Type',NULL,'2015-04-16 08:34:50','2015-04-16 08:34:50');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(60,26,'Indoor Sticker',NULL,'2015-04-16 08:35:08','2015-04-16 08:35:08');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(61,26,'Outdoor Sticker',NULL,'2015-04-16 08:35:24','2015-04-16 08:35:25');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(62,27,'Product Finishing',NULL,'2015-04-16 08:35:51','2015-04-16 08:35:51');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(63,27,'Buy and Sell',NULL,'2015-04-16 08:36:03','2015-04-16 08:36:03');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(64,27,'Delivery',NULL,'2015-04-16 08:36:15','2015-04-16 08:36:15');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(65,28,'Digital Printing',NULL,'2015-04-16 08:36:51','2015-04-16 08:36:51');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(66,28,'Offset Printing',NULL,'2015-04-16 08:37:14','2015-04-16 08:37:14');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(67,28,'Flexo Printing',NULL,'2015-04-16 08:37:36','2015-04-16 08:37:36');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(68,29,'Water Base Gloss',NULL,'2015-04-16 08:38:04','2015-04-16 08:38:04');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(69,29,'Water Base Matt',NULL,'2015-04-16 08:38:26','2015-04-16 08:38:26');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(70,29,'UV Lamination',NULL,'2015-04-16 08:38:43','2015-04-16 08:38:43');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(71,29,'Blister',NULL,'2015-04-16 08:39:00','2015-04-16 08:39:00');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(72,29,'Plastic Lamination',NULL,'2015-04-16 08:39:37','2015-04-16 08:39:37');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(73,29,'Matt Lamination',NULL,'2015-04-16 08:39:59','2015-04-16 08:39:59');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(74,29,'3D Spot',NULL,'2015-04-16 08:40:16','2015-04-16 08:40:16');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(75,29,'Foil Lamination',NULL,'2015-04-16 08:40:38','2015-04-16 08:40:38');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(76,29,'Scratch Off',NULL,'2015-04-16 08:40:58','2015-04-16 08:40:58');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(77,30,'Film Output',NULL,'2015-04-16 08:41:26','2015-04-16 08:41:26');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(78,30,'CTP',NULL,'2015-04-16 08:41:41','2015-04-16 08:41:41');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(79,30,'Offset Conventional Plate',NULL,'2015-04-16 08:42:27','2015-04-16 08:42:27');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(80,30,'Flexo Conventional Plate',NULL,'2015-04-16 08:43:21','2015-04-16 08:43:21');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(81,30,'Flexo Digital Plate',NULL,'2015-04-16 08:43:42','2015-04-16 08:43:42');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(82,30,'WoodMould',NULL,'2015-04-16 08:44:30','2015-04-16 08:44:30');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(83,30,'Plastic Mould',NULL,'2015-04-16 08:44:51','2015-04-16 08:44:51');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(84,31,'Saddle Stitching',NULL,'2015-04-16 08:47:24','2015-04-16 08:47:24');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(85,31,'Perfect Binding',NULL,'2015-04-16 08:47:44','2015-04-16 08:47:44');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(86,31,'Ring Binding',NULL,'2015-04-16 08:48:09','2015-04-16 08:48:09');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(87,31,'Double Loop',NULL,'2015-04-16 08:48:25','2015-04-16 08:48:25');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(88,32,'Folding',NULL,'2015-04-16 08:48:42','2015-04-16 08:48:42');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(89,32,'Scoring/Perforation',NULL,'2015-04-16 08:49:13','2015-04-16 08:49:13');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(90,33,'Corrugated Lam',NULL,'2015-04-16 08:49:55','2015-04-16 08:49:55');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(91,33,'Die Cutting',NULL,'2015-04-16 08:50:19','2015-04-16 08:50:19');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(92,33,'Gluing-White Glue',NULL,'2015-04-16 08:50:50','2015-04-16 08:50:50');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(93,33,'Gluing-Hot Melt',NULL,'2015-04-16 08:51:07','2015-04-16 08:51:21');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(94,34,'Texturizing',NULL,'2015-04-16 08:51:47','2015-04-16 08:51:47');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(95,34,'Corner Cutting',NULL,'2015-04-16 08:52:02','2015-04-16 08:52:02');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(96,35,'Board',NULL,'2015-04-16 08:52:15','2015-04-16 08:52:15');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(97,35,'Paper',NULL,'2015-04-16 08:52:26','2015-04-16 08:52:26');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(98,35,'Single Face',NULL,'2015-04-16 08:52:39','2015-04-16 08:52:39');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(99,35,'Sticker',NULL,'2015-04-16 08:52:50','2015-04-16 08:52:50');

INSERT INTO `item_type_holders` (`id`, `item_category_holder_id`, `name`, `category_type`, `created`, `modified`)
VALUES
	(102,47,'type for item group',1,'2015-04-22 02:56:31','2015-04-22 02:56:31');

/*!40000 ALTER TABLE `item_type_holders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table suppliers
# ------------------------------------------------------------

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(1,NULL,'supplier a','',NULL,NULL,'2015-04-22 02:55:16','2015-04-22 02:55:16');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(2,NULL,'TONG CHENG IRON WORKS CO., LTD  æ±æ­£éµå·¥å» ','',NULL,NULL,'2015-04-22 03:04:57','2015-04-22 03:04:57');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(3,NULL,'3Mæå°¼èéç¤¦æ¥­è£½é è¡ä»½æéå¬å¸(3Mèºç£)','',NULL,NULL,'2015-04-22 03:06:17','2015-04-22 03:06:17');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(4,NULL,'Adhesion Corp','',NULL,NULL,'2015-04-22 03:06:38','2015-04-22 03:06:38');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(5,NULL,'Affix Printing','',NULL,NULL,'2015-04-22 03:07:21','2015-04-22 03:07:21');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(6,NULL,'Agfaæåç¼','',NULL,NULL,'2015-04-22 03:07:41','2015-04-22 03:07:41');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(7,NULL,'Agi Corp. æ°åç¾ç§æ(è¡)å¬å¸','',NULL,NULL,'2015-04-22 03:08:16','2015-04-22 03:08:16');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(8,NULL,'Airtac Enterprises Phils. Co. Ltd','',NULL,NULL,'2015-04-22 03:08:39','2015-04-22 03:08:39');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(9,NULL,'Alphasonics Ultrasonic Cleaning Systems','',NULL,NULL,'2015-04-22 03:09:05','2015-04-22 03:09:05');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(10,NULL,'APP','',NULL,NULL,'2015-04-22 03:09:20','2015-04-22 03:09:20');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(11,NULL,'April Fine','',NULL,NULL,'2015-04-22 03:09:30','2015-04-22 03:09:30');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(12,NULL,'ARMAK Tape Corporation','',NULL,NULL,'2015-04-22 03:11:06','2015-04-22 03:11:06');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(13,NULL,'Armor Steel è£ç²é¼å¸¶å·¥æ¥­','',NULL,NULL,'2015-04-22 03:12:16','2015-04-22 03:12:16');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(14,NULL,'Arrow Chemical  Products','',NULL,NULL,'2015-04-22 03:12:41','2015-04-22 03:12:41');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(15,NULL,'Artender','',NULL,NULL,'2015-04-22 03:13:12','2015-04-22 03:13:12');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(16,NULL,'Asia Chem','',NULL,NULL,'2015-04-22 03:13:36','2015-04-22 03:13:36');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(17,NULL,'Asia Pulp Paper (APP)_Indah Kiat','',NULL,NULL,'2015-04-22 03:15:45','2015-04-22 03:15:45');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(19,NULL,'Asia Pulp Paper (APP)_Yalong/Lami','',NULL,NULL,'2015-04-22 03:16:30','2015-04-22 03:16:30');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(20,NULL,'Avery Dennison','',NULL,NULL,'2015-04-22 03:16:48','2015-04-22 03:16:48');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(21,NULL,'Bear Ink å·¨ç','',NULL,NULL,'2015-04-22 03:17:03','2015-04-22 03:17:03');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(22,NULL,'Best Diamond Ind. Coä¸åé½ç³å·¥æ¥­(è¡)å¬å¸','',NULL,NULL,'2015-04-22 03:17:29','2015-04-22 03:17:29');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(23,NULL,'Bottcher åæå·¥æ¥­(è¡)æéå¬å¸','',NULL,NULL,'2015-04-22 03:17:51','2015-04-22 03:17:51');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(24,NULL,'Bottcher(phil)åæ(è²)','',NULL,NULL,'2015-04-22 03:18:54','2015-04-22 03:18:54');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(25,NULL,'Bottcher(taiwan)åæ(å°)','',NULL,NULL,'2015-04-22 03:19:50','2015-04-22 03:19:50');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(26,NULL,'C & J','',NULL,NULL,'2015-04-22 03:20:07','2015-04-22 03:20:07');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(27,NULL,'CALYPSO PLASTIC CENTER COMPANY','',NULL,NULL,'2015-04-22 03:20:29','2015-04-22 03:20:29');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(28,NULL,'CDI Sakata Ink Cotp.','',NULL,NULL,'2015-04-22 03:20:48','2015-04-22 03:20:48');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(29,NULL,'Chan Yu technology co.,Ltd.å¶æ±è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 03:21:08','2015-04-22 03:21:08');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(30,NULL,'Chang Kuai','',NULL,NULL,'2015-04-22 03:21:43','2015-04-22 03:21:43');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(31,NULL,'Chang Ruei Pastic Co. Ltd. é·çå¡è æéå¬å¸','',NULL,NULL,'2015-04-22 03:21:59','2015-04-22 03:21:59');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(32,NULL,'CHANG SHUAN ELECTRONICSéçé»å­','',NULL,NULL,'2015-04-22 03:22:57','2015-04-22 03:22:57');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(33,NULL,'changyongå¸¸ç¨æ©æ¢°æéå¬å¸','',NULL,NULL,'2015-04-22 03:23:17','2015-04-22 03:23:17');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(34,NULL,'Chase Marketing, Inc.','',NULL,NULL,'2015-04-22 03:23:41','2015-04-22 03:23:41');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(35,NULL,'Cheng Da Industrial Co., Ltd.ä¸éå¯¦æ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 03:23:58','2015-04-22 03:23:58');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(36,NULL,'Cheng Loong Paperæ­£éè¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 03:24:32','2015-04-22 03:24:32');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(37,NULL,'chin shu yu éæ¨¹ç','',NULL,NULL,'2015-04-22 03:24:52','2015-04-22 03:24:52');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(38,NULL,'CHINA ELECTRIC MFG. CORPORATION ä¸­åé»æ°£è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 03:25:08','2015-04-22 03:25:08');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(39,NULL,'Ching Feng Machinery Co., Ltd.æ¶å³°æ©æ¢°æéå¬å¸','',NULL,NULL,'2015-04-22 03:37:23','2015-04-22 03:37:23');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(40,NULL,'CHNTæµæ±æ­£æ³°é»å¨zhejiang chint electrical','',NULL,NULL,'2015-04-22 03:39:07','2015-04-22 03:39:07');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(41,NULL,'CHUANG JAY PACKAGING TECH NOLOGY CO.,LTD   åµååè£ç§ææéå¬å¸ ','',NULL,NULL,'2015-04-22 03:39:28','2015-04-22 03:39:28');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(42,NULL,'CHUAN-WEI PRINTING EQUIPMENT','',NULL,NULL,'2015-04-22 03:40:01','2015-04-22 03:40:01');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(43,NULL,'chuang hwa','',NULL,NULL,'2015-04-22 03:40:19','2015-04-22 03:40:19');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(44,NULL,'Chwen Shyangç´ç¥¥å¯¦æ¥­è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 03:40:37','2015-04-22 03:40:37');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(45,NULL,'Chyi Yu Machinery Industrial Co., Ltd.å¥è²æ©æ¢°å·¥æ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 03:40:57','2015-04-22 03:40:57');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(46,NULL,'Chyuan Sheng','',NULL,NULL,'2015-04-22 03:41:34','2015-04-22 03:41:34');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(47,NULL,'Conch Electronic Co.,Ltd ç¦åä¼æ¥­(é)','',NULL,NULL,'2015-04-22 03:42:07','2015-04-22 03:42:07');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(48,NULL,'Concordsky/ Quanta Paper','',NULL,NULL,'2015-04-22 03:42:30','2015-04-22 03:42:30');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(49,NULL,'Container Corp of the Philippines','',NULL,NULL,'2015-04-22 03:43:06','2015-04-22 03:43:06');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(50,NULL,'Cupo Tech Co., Ltd.éåç´æ¯è£½é å¬å¸ (APP CHINA)','',NULL,NULL,'2015-04-22 03:55:39','2015-04-22 03:55:39');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(51,NULL,'Da Chiaå¤§ä½³ä¼æ¥­ç¤¾','',NULL,NULL,'2015-04-22 03:56:00','2015-04-22 03:56:00');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(52,NULL,'Daio/JAPAN','',NULL,NULL,'2015-04-22 03:56:35','2015-04-22 03:56:35');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(53,NULL,'Dataknit','',NULL,NULL,'2015-04-22 03:56:49','2015-04-22 03:56:49');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(54,NULL,'DAVY TECHNIC CORP.å¾·å¨åæ¨¡ç§ææéå¬å¸','',NULL,NULL,'2015-04-22 03:57:08','2015-04-22 03:57:08');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(55,NULL,'Dghongming machineæ±èé´»éæ©æ¢°','',NULL,NULL,'2015-04-22 03:57:36','2015-04-22 03:57:36');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(56,NULL,'DHUNWELL','',NULL,NULL,'2015-04-22 03:59:14','2015-04-22 03:59:14');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(57,NULL,'Diy Shin è¿ªé«ä¼æ¥­(è¡)å¬å¸','',NULL,NULL,'2015-04-22 03:59:44','2015-04-22 03:59:44');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(58,NULL,'DLB å¾·éå¯¶å°å·æ©æ¢°æéå¬å¸','',NULL,NULL,'2015-04-22 04:00:44','2015-04-22 04:00:44');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(59,NULL,'DongGuan TongBao Printing Packaging','',NULL,NULL,'2015-04-22 04:01:14','2015-04-22 04:01:14');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(60,NULL,'DUPONT','',NULL,NULL,'2015-04-22 04:01:24','2015-04-22 04:01:24');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(61,NULL,'Dynamic Plastic Mfg. Inc.','',NULL,NULL,'2015-04-22 04:01:47','2015-04-22 04:01:47');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(62,NULL,'E.A.C - Carmona Branch','',NULL,NULL,'2015-04-22 04:02:06','2015-04-22 04:02:06');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(63,NULL,'EATON PHONEIXTEC MMPL Co., LTD.ä¼é é£çæåè¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 04:02:25','2015-04-22 04:02:25');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(64,NULL,'ECS Nottingham LTD.','',NULL,NULL,'2015-04-22 04:02:49','2015-04-22 04:02:49');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(65,NULL,'ELASTINå¯è¨å¯¦æ¥­','',NULL,NULL,'2015-04-22 04:03:27','2015-04-22 04:03:27');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(66,NULL,'Epson','',NULL,NULL,'2015-04-22 04:03:45','2015-04-22 04:03:45');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(67,NULL,'Erhardt + Leimer(taiwan)å¾·åèé»ç¾å°ç£åå¬å¸','',NULL,NULL,'2015-04-22 04:04:06','2015-04-22 04:04:06');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(68,NULL,'Espanola Machine Shop','',NULL,NULL,'2015-04-22 04:04:50','2015-04-22 04:04:50');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(69,NULL,'Evergreen','',NULL,NULL,'2015-04-22 04:05:14','2015-04-22 04:05:14');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(70,NULL,'Everlead','',NULL,NULL,'2015-04-22 04:05:32','2015-04-22 04:05:32');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(71,NULL,'Everspring Printing Equipment Co., Ltd','',NULL,NULL,'2015-04-22 04:06:13','2015-04-22 04:06:13');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(72,NULL,'Excellent Smooth Industrial Co. å©é ä¼æ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 04:06:47','2015-04-22 04:06:47');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(73,NULL,'Express Coat Enterprises, Inc.','',NULL,NULL,'2015-04-22 04:49:01','2015-04-22 04:49:01');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(74,NULL,'ExxonMobil International Limited, Taiwan Branch ç¾åååæ£®ç¾å­åéè¡ä»½æéå¬å¸èºç£åå¬å¸','',NULL,NULL,'2015-04-22 04:49:24','2015-04-22 04:49:24');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(75,NULL,'FAG','',NULL,NULL,'2015-04-22 04:49:58','2015-04-22 04:49:58');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(76,NULL,'FEDCO Paper Corporation','',NULL,NULL,'2015-04-22 04:50:26','2015-04-22 04:50:26');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(77,NULL,'Federal  è¼éå°å·æææéå¬å¸','',NULL,NULL,'2015-04-22 04:50:50','2015-04-22 04:50:50');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(78,NULL,'Feng Tien Electronic Co., Ltd.å¼ç°é»æ©æéå¬å¸','',NULL,NULL,'2015-04-22 04:51:34','2015-04-22 04:51:34');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(79,NULL,'First Solid Builders, Inc. ','',NULL,NULL,'2015-04-22 04:52:03','2015-04-22 04:52:03');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(80,NULL,'Flint Group','',NULL,NULL,'2015-04-22 04:52:18','2015-04-22 04:52:18');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(81,NULL,'Fotek Controls., Ltd.é½æé»æ©è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 04:52:38','2015-04-22 04:52:38');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(82,NULL,'Fu Kong machine å¯åæ©æ¢°äºéè¡','',NULL,NULL,'2015-04-22 04:53:00','2015-04-22 04:53:00');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(83,NULL,'Fuji å¯å£«','',NULL,NULL,'2015-04-22 04:53:26','2015-04-22 04:53:26');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(84,NULL,'Ga King Logistics Materials Handling Co.,Ltdå å¤ç©æµè³æ(è¡)å¬å¸','',NULL,NULL,'2015-04-22 04:53:49','2015-04-22 04:53:49');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(85,NULL,'GEW (EC) Limited','',NULL,NULL,'2015-04-22 04:54:08','2015-04-22 04:54:08');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(86,NULL,'Goann Tain Co., Ltd.','',NULL,NULL,'2015-04-22 04:54:50','2015-04-22 04:54:50');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(87,NULL,'Golden Dragon','',NULL,NULL,'2015-04-22 04:55:05','2015-04-22 04:55:05');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(88,NULL,'Golden Paper','',NULL,NULL,'2015-04-22 04:55:22','2015-04-22 04:55:22');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(89,NULL,'Gotech Testing Machines Co., Ltd.é«éµç§æè¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 04:55:42','2015-04-22 04:55:42');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(90,NULL,'Grafmac Two Co., Ltd. é¦èæéå¬å¸','',NULL,NULL,'2015-04-22 04:56:13','2015-04-22 04:56:13');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(91,NULL,'Grist Chem Corporation','',NULL,NULL,'2015-04-22 04:56:43','2015-04-22 04:56:43');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(92,NULL,'GVJ Lamination','',NULL,NULL,'2015-04-22 04:57:06','2015-04-22 04:57:06');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(93,NULL,'H. WELL ENTERPRISE CO., LTD. å®åä¼æ¥­','',NULL,NULL,'2015-04-22 04:57:26','2015-04-22 04:57:26');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(94,NULL,'HEIDELBERG (GERMANY)','',NULL,NULL,'2015-04-22 04:57:48','2015-04-22 04:57:48');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(95,NULL,'Heidelberg Philippines, Inc.','',NULL,NULL,'2015-04-22 04:58:19','2015-04-22 04:58:19');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(96,NULL,'Heidelberg å°ç£æµ·å¾·å ¡åéè¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 04:58:48','2015-04-22 04:58:48');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(97,NULL,'Hewlett-Packard Company (HP-Taiwan)æ æ®(å°ç£)','',NULL,NULL,'2015-04-22 04:59:23','2015-04-22 04:59:23');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(98,NULL,'HIGH-TECH','',NULL,NULL,'2015-04-22 04:59:50','2015-04-22 04:59:50');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(99,NULL,'Hit International','',NULL,NULL,'2015-04-22 05:00:25','2015-04-22 05:00:25');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(100,NULL,'Hitachi','',NULL,NULL,'2015-04-22 05:00:34','2015-04-22 05:00:42');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(101,NULL,'Ho John Machinery Co., Ltdæ²³æ¦®æ©æ¢°å·¥å» æéå¬å¸','',NULL,NULL,'2015-04-22 05:01:08','2015-04-22 05:01:08');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(102,NULL,'Hong Cheng ç´æ­£ä¼æ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 05:01:40','2015-04-22 05:01:40');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(103,NULL,'HongGi','',NULL,NULL,'2015-04-22 05:02:10','2015-04-22 05:02:10');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(104,NULL,'HongMing','',NULL,NULL,'2015-04-22 05:02:25','2015-04-22 05:02:25');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(105,NULL,'HonTai Building Material Co., Ltd.é´»æ³°å»ºææéå¬å¸','',NULL,NULL,'2015-04-22 05:02:46','2015-04-22 05:02:46');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(107,NULL,'HONTKOé´»ç¿è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 05:04:03','2015-04-22 05:04:03');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(108,NULL,'Horng Ming','',NULL,NULL,'2015-04-22 05:05:27','2015-04-22 05:05:27');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(109,NULL,'horng shenq dar tech ','',NULL,NULL,'2015-04-22 05:07:28','2015-04-22 05:07:48');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(110,NULL,'Hostmann-Steinberg GmbH','',NULL,NULL,'2015-04-22 05:16:36','2015-04-22 05:16:36');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(111,NULL,'Hsin Mei Kuang Co., Ltd.æ°ç¾å','',NULL,NULL,'2015-04-22 05:24:52','2015-04-22 05:24:52');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(112,NULL,'Hua Ying','',NULL,NULL,'2015-04-22 05:25:44','2015-04-22 05:25:44');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(113,NULL,'Huang Yih Kitchenware çåå»å·(è¡)å¬å¸','',NULL,NULL,'2015-04-22 05:26:29','2015-04-22 05:26:29');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(114,NULL,'Huber Group','',NULL,NULL,'2015-04-22 05:26:50','2015-04-22 05:26:50');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(115,NULL,'HUNG CHONG ææ¶å¯¦æ¥­è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 05:27:10','2015-04-22 05:27:10');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(116,NULL,'Hwang Sun Enterprise Co., Ltd.çå°ä¼æ¥­è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 05:27:30','2015-04-22 05:27:30');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(117,NULL,'HwaYu Plastic Co.,Ltd.è¯éå¡è æéå¬å¸','',NULL,NULL,'2015-04-22 05:27:50','2015-04-22 05:27:50');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(118,NULL,'Ideal Marketing And Manufacturing Corporation','',NULL,NULL,'2015-04-22 05:28:16','2015-04-22 05:28:16');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(119,NULL,'IDEC Corporation','',NULL,NULL,'2015-04-22 05:28:34','2015-04-22 05:28:34');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(120,NULL,'ILO  ä¸æ¨åå­¸å·¥æ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 05:28:55','2015-04-22 05:28:55');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(121,NULL,'International Paper (IPAD)','',NULL,NULL,'2015-04-22 05:29:31','2015-04-22 05:29:31');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(122,NULL,'Ji Liang','',NULL,NULL,'2015-04-22 05:29:51','2015-04-22 05:29:51');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(123,NULL,'Jiangsu Fangbang Machinery Co., Ltd.','',NULL,NULL,'2015-04-22 05:30:10','2015-04-22 05:30:10');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(124,NULL,'Jiann Tyan å°ç£å¥ç°è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 05:30:29','2015-04-22 05:30:29');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(125,NULL,'Jin Feng Yuan','',NULL,NULL,'2015-04-22 05:30:50','2015-04-22 05:30:50');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(126,NULL,'Jing Chye Enterprise Co.','',NULL,NULL,'2015-04-22 05:32:01','2015-04-22 05:32:01');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(127,NULL,'JND','',NULL,NULL,'2015-04-22 05:32:06','2015-04-22 05:32:06');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(128,NULL,'Jsiah Chung','',NULL,NULL,'2015-04-22 05:32:27','2015-04-22 05:32:27');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(129,NULL,'juing ching plastic co.,é§¿æ¶å¡è (è¡)å¬å¸','',NULL,NULL,'2015-04-22 05:32:42','2015-04-22 05:32:42');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(130,NULL,'K Laser Technology Inc. åç¾¤é·å°è¡ç§æè¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 05:33:02','2015-04-22 05:33:02');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(131,NULL,'KAESER- Italy','',NULL,NULL,'2015-04-22 05:33:26','2015-04-22 05:33:26');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(132,NULL,'Kai Suh Suh Enterprise Co., Ltd.å±å£«å£«ä¼æ¥­è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 05:33:55','2015-04-22 05:33:55');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(133,NULL,'King General Services & Printing Supplies, Inc.','',NULL,NULL,'2015-04-22 05:34:13','2015-04-22 05:34:13');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(134,NULL,'King Web Enterprises Co.,Ltdæ¶èª¼æ(ç¹)å¸¶','',NULL,NULL,'2015-04-22 05:34:45','2015-04-22 05:34:45');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(135,NULL,'KK Converter Phils., Inc.é«å è²¼ç´(è²)','',NULL,NULL,'2015-04-22 05:35:02','2015-04-22 05:35:02');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(136,NULL,'K-Laser','',NULL,NULL,'2015-04-22 05:35:23','2015-04-22 05:35:23');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(137,NULL,'Kluber Lubrication','',NULL,NULL,'2015-04-22 05:35:48','2015-04-22 05:35:48');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(138,NULL,'K-More Philippines , Inc.','',NULL,NULL,'2015-04-22 05:36:09','2015-04-22 05:36:09');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(139,NULL,'Koan Haoå éä¼æ¥­è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 05:36:29','2015-04-22 05:36:29');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(140,NULL,'Kodak','',NULL,NULL,'2015-04-22 05:36:47','2015-04-22 05:36:47');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(141,NULL,'KOMORI (US)','',NULL,NULL,'2015-04-22 05:37:14','2015-04-22 05:37:14');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(142,NULL,'Konda Enterprise Co., Ltd.é®éå¯¦æ¥­è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 05:37:27','2015-04-22 05:37:27');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(143,NULL,'KOTEN ENTERPRISES CO., INC.','',NULL,NULL,'2015-04-22 05:37:43','2015-04-22 05:37:43');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(144,NULL,'KouFu','',NULL,NULL,'2015-04-22 05:38:02','2015-04-22 05:38:02');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(145,NULL,'KounYuå»£äºè¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 05:38:16','2015-04-22 05:38:16');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(146,NULL,'KOYO','',NULL,NULL,'2015-04-22 05:38:31','2015-04-22 05:38:31');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(147,NULL,'Kuan Jung','',NULL,NULL,'2015-04-22 05:38:45','2015-04-22 05:38:45');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(148,NULL,'KuanYuan','',NULL,NULL,'2015-04-22 05:39:01','2015-04-22 05:39:01');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(149,NULL,'Kuen Sheng Company éç³ä¼æ¥­ç¤¾','',NULL,NULL,'2015-04-22 05:39:21','2015-04-22 05:39:21');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(150,NULL,'Lai Yu ä¾è­½ä¼æ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 05:39:45','2015-04-22 05:39:45');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(151,NULL,'Lamco Paper Products Inc,.','',NULL,NULL,'2015-04-22 05:40:01','2015-04-22 05:40:01');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(152,NULL,'LCW-Long Chené¾æ³é£²ç¨æ°´è¨­å','',NULL,NULL,'2015-04-22 05:40:16','2015-04-22 05:40:16');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(153,NULL,'Leung Chong Kee Machine Factory LTD.æ¢æ»è¨','',NULL,NULL,'2015-04-22 05:40:33','2015-04-22 05:40:33');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(154,NULL,'Li Renç«ä»»æ©æ¢°','',NULL,NULL,'2015-04-22 05:40:50','2015-04-22 05:40:50');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(155,NULL,'Li Shenq ç«çæ©æ¢°è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 05:41:08','2015-04-22 05:41:08');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(156,NULL,'Lianxing','',NULL,NULL,'2015-04-22 05:41:31','2015-04-22 05:41:31');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(157,NULL,'LingShenéèæ©æ¢°å·¥æ¥­è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 05:41:45','2015-04-22 05:41:45');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(158,NULL,'Linqu Hengsen Packaging Materials','',NULL,NULL,'2015-04-22 05:42:23','2015-04-22 05:42:23');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(159,NULL,'Lion Lamination','',NULL,NULL,'2015-04-22 05:42:36','2015-04-22 05:42:36');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(160,NULL,'LLOYD\'s TECHNOLOGIES, INC.','',NULL,NULL,'2015-04-22 05:42:51','2015-04-22 05:42:51');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(161,NULL,'Long Chen Paper æ¦®æç´æ¥­','',NULL,NULL,'2015-04-22 05:43:07','2015-04-22 05:43:07');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(162,NULL,'Long Durable Machinery Co., LTD é·èæ©æ¢°æéå¬å¸','',NULL,NULL,'2015-04-22 05:43:24','2015-04-22 05:43:24');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(163,NULL,'Longer Taiwan ç¦æ¶æ©æ¢°å·¥æ¥­(è¡)å¬å¸','',NULL,NULL,'2015-04-22 05:43:52','2015-04-22 05:43:52');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(164,NULL,'Lu Ya','',NULL,NULL,'2015-04-22 05:44:13','2015-04-22 05:44:13');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(165,NULL,'MANROLAND (GERMANY)','',NULL,NULL,'2015-04-22 05:44:35','2015-04-22 05:44:35');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(166,NULL,'manroland(Taiwan) Ltd. èºç£æ¼ç¾è­è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 05:44:49','2015-04-22 05:44:49');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(167,NULL,'MarkAndy Inc.','',NULL,NULL,'2015-04-22 05:45:13','2015-04-22 05:45:13');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(168,NULL,'MDC','',NULL,NULL,'2015-04-22 05:45:23','2015-04-22 05:45:23');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(169,NULL,'MeadWestVaco Hong Kong Ltd.','',NULL,NULL,'2015-04-22 05:46:00','2015-04-22 05:46:00');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(170,NULL,'Megapack Container Corp.','',NULL,NULL,'2015-04-22 05:46:34','2015-04-22 05:46:34');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(171,NULL,'Melcherså¾·åç¾ææè²¿æå¬å¸','',NULL,NULL,'2015-04-22 05:46:49','2015-04-22 05:46:49');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(172,NULL,'Michael Huber Munchen GmbH','',NULL,NULL,'2015-04-22 05:47:05','2015-04-22 05:47:05');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(173,NULL,'Michelman','',NULL,NULL,'2015-04-22 05:47:25','2015-04-22 05:47:25');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(174,NULL,'Min Yuen Rubber Ind.Co.,Ltdææºæ©¡è å·¥æ¥­','',NULL,NULL,'2015-04-22 05:47:40','2015-04-22 05:47:40');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(175,NULL,'MITSUBISHI','',NULL,NULL,'2015-04-22 05:48:02','2015-04-22 05:48:02');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(176,NULL,'MITUTOYO','',NULL,NULL,'2015-04-22 05:48:19','2015-04-22 05:48:19');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(177,NULL,'Moeller','',NULL,NULL,'2015-04-22 05:48:32','2015-04-22 05:48:32');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(178,NULL,'Multifine Plastic Inc äºè²¿å¡è (è¡)å¬å¸','',NULL,NULL,'2015-04-22 05:48:46','2015-04-22 05:48:46');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(179,NULL,'Multipack Container Corp.','',NULL,NULL,'2015-04-22 05:49:19','2015-04-22 05:49:19');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(180,NULL,'Nan Fang Co.,Ltd åæ¹å¯¦æ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 05:49:37','2015-04-22 05:49:37');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(181,NULL,'Nan Wa åé©è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 05:49:54','2015-04-22 05:49:54');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(182,NULL,'NanoFibert','',NULL,NULL,'2015-04-22 05:50:11','2015-04-22 05:50:11');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(183,NULL,'NanYaPlastics','',NULL,NULL,'2015-04-22 05:50:30','2015-04-22 05:50:30');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(184,NULL,'National Starch and Chemical Company','',NULL,NULL,'2015-04-22 05:53:52','2015-04-22 05:53:52');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(185,NULL,'NBR','',NULL,NULL,'2015-04-22 05:54:00','2015-04-22 05:54:00');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(186,NULL,'New City Pack','',NULL,NULL,'2015-04-22 05:54:17','2015-04-22 05:54:17');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(187,NULL,'NICHIDAN(Japan)','',NULL,NULL,'2015-04-22 05:55:14','2015-04-22 05:55:14');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(188,NULL,'NISSIN-GIKEN Corporationæ¥æ°æç æ ªå¼æç¤¾','',NULL,NULL,'2015-04-22 05:55:28','2015-04-22 05:55:28');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(189,NULL,'NOAH\'S PAPER MILLS, INC.','',NULL,NULL,'2015-04-22 05:55:56','2015-04-22 05:55:56');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(190,NULL,'NPI','',NULL,NULL,'2015-04-22 05:56:09','2015-04-22 05:56:09');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(191,NULL,'NSK','',NULL,NULL,'2015-04-22 05:56:18','2015-04-22 05:56:18');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(192,NULL,'Oerlikon Leybold Vacuumå°ç£æ­çåº·èå¯¶çç©ºè¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 05:56:35','2015-04-22 05:56:35');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(193,NULL,'OKI','',NULL,NULL,'2015-04-22 05:56:46','2015-04-22 05:56:46');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(194,NULL,'OMRONæ­å§é¾','',NULL,NULL,'2015-04-22 05:57:01','2015-04-22 05:57:01');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(195,NULL,'Pacific Electric Wire & Cable Co., Ltd.å¤ªå¹³æ´é»ç·é»çºè¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 05:57:17','2015-04-22 05:57:17');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(196,NULL,'panasonicæ¾ä¸','',NULL,NULL,'2015-04-22 05:57:33','2015-04-22 05:57:33');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(197,NULL,'Philips Lighting Division, Inc.(Taiwan)å°ç£é£å©æµ¦è¡ä»½æéå¬å¸ç§æäºæ¥­é¨','',NULL,NULL,'2015-04-22 05:57:55','2015-04-22 05:57:55');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(198,NULL,'Phoenix Xtra Blanketsé³³å°ç','',NULL,NULL,'2015-04-22 05:58:10','2015-04-22 05:58:10');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(199,NULL,'Primeline Paper Sales Inc.','',NULL,NULL,'2015-04-22 05:58:38','2015-04-22 05:58:38');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(200,NULL,'PT.ESA KERTAS NUSANTARA','',NULL,NULL,'2015-04-22 05:59:14','2015-04-22 05:59:14');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(201,NULL,'Purity','',NULL,NULL,'2015-04-22 05:59:24','2015-04-22 05:59:24');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(202,NULL,'rayfordçç','',NULL,NULL,'2015-04-22 05:59:36','2015-04-22 05:59:36');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(203,NULL,'Rey San çå±±è«å§éæææéå¬å¸','',NULL,NULL,'2015-04-22 05:59:53','2015-04-22 05:59:53');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(204,NULL,'RGR Industrial Sales','',NULL,NULL,'2015-04-22 06:00:26','2015-04-22 06:00:26');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(205,NULL,'RIKO YUNGGHU TECHNOLOGY CO., LTDæ°¸éé»æ©æéå¬å¸','',NULL,NULL,'2015-04-22 06:00:38','2015-04-22 06:00:38');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(206,NULL,'RIKOåç§åé»è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 06:00:53','2015-04-22 06:00:53');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(207,NULL,'RISO','',NULL,NULL,'2015-04-22 06:01:05','2015-04-22 06:01:05');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(208,NULL,'robatechçå£«æ¨ç¾å¾å´è ç³»çµ±','',NULL,NULL,'2015-04-22 06:01:17','2015-04-22 06:01:17');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(209,NULL,'Rong Yih Industry Co., Ltd.æ¦®å¥å·¥æ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 06:01:33','2015-04-22 06:01:33');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(210,NULL,'Rong- Yih Industry Co., Ltd.æ¦®å¥å·¥æ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 06:01:50','2015-04-22 06:01:50');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(211,NULL,'SANKEN','',NULL,NULL,'2015-04-22 06:02:09','2015-04-22 06:02:09');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(212,NULL,'SANKINGä¸è© éç¼å¡è è£½åæéå¬å¸','',NULL,NULL,'2015-04-22 06:02:40','2015-04-22 06:02:40');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(213,NULL,'Sankyo','',NULL,NULL,'2015-04-22 06:03:03','2015-04-22 06:03:03');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(214,NULL,'SBL MACHINERY CO.,LTD. è²¡é æ©æ¢°å·¥æ¥­è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 06:03:15','2015-04-22 06:03:15');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(215,NULL,'Seven Locality Co., Ltd.','',NULL,NULL,'2015-04-22 06:03:44','2015-04-22 06:03:44');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(216,NULL,'Shell Lubricants','',NULL,NULL,'2015-04-22 06:04:03','2015-04-22 06:04:03');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(217,NULL,'Shen Chang','',NULL,NULL,'2015-04-22 06:04:21','2015-04-22 06:04:21');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(218,NULL,'Shenzhen Shenhua Printing Equipment Technology Co., Ltd.','',NULL,NULL,'2015-04-22 06:04:34','2015-04-22 06:04:34');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(219,NULL,'ShiLin','',NULL,NULL,'2015-04-22 06:04:54','2015-04-22 06:04:54');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(220,NULL,'Shinesuné«çå°å·æéå¬å¸','',NULL,NULL,'2015-04-22 06:05:08','2015-04-22 06:05:08');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(221,NULL,'Shing Changä¿¡æ','',NULL,NULL,'2015-04-22 06:05:29','2015-04-22 06:05:29');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(222,NULL,'Shinkozanæ°é«å±±','',NULL,NULL,'2015-04-22 06:05:56','2015-04-22 06:05:56');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(223,NULL,'Shun Fa','',NULL,NULL,'2015-04-22 06:06:11','2015-04-22 06:06:11');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(224,NULL,'Shun Hua Enterprise Co., Ltd.ä¿¡é©ä¼æ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 06:06:24','2015-04-22 06:06:24');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(225,NULL,'Siemens Limited Taiwanè¥¿éå­è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 06:06:41','2015-04-22 06:06:41');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(226,NULL,'Sing Mas Enterpriseæéå£åå','',NULL,NULL,'2015-04-22 06:07:11','2015-04-22 06:07:11');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(227,NULL,'SKF','',NULL,NULL,'2015-04-22 06:07:25','2015-04-22 06:07:25');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(228,NULL,'SMC','',NULL,NULL,'2015-04-22 06:07:36','2015-04-22 06:07:36');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(229,NULL,'Soft Padä»éä¼æ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 06:07:49','2015-04-22 06:07:49');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(230,NULL,'Softek åªè»ç§æè¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 06:08:27','2015-04-22 06:08:27');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(231,NULL,'St. Thomas Paper Corp.','',NULL,NULL,'2015-04-22 06:08:53','2015-04-22 06:08:53');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(232,NULL,'STMicroelectronics   ST ææ³åå°é«','',NULL,NULL,'2015-04-22 06:09:09','2015-04-22 06:09:09');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(233,NULL,'Stora Enso','',NULL,NULL,'2015-04-22 06:09:28','2015-04-22 06:09:28');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(234,NULL,'Stora TW','',NULL,NULL,'2015-04-22 06:09:42','2015-04-22 06:09:42');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(235,NULL,'Suerte Steel Corporation','',NULL,NULL,'2015-04-22 06:09:55','2015-04-22 06:09:55');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(236,NULL,'Sunpack Container Packaging Corporation','',NULL,NULL,'2015-04-22 06:10:09','2015-04-22 06:10:09');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(237,NULL,'Sunspirng Ad System','',NULL,NULL,'2015-04-22 06:10:24','2015-04-22 06:10:24');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(238,NULL,'SuperDot','',NULL,NULL,'2015-04-22 06:10:48','2015-04-22 06:10:48');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(239,NULL,'Swan å¤©éµç','',NULL,NULL,'2015-04-22 06:11:00','2015-04-22 06:11:00');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(240,NULL,'swider paper co.,ltd','',NULL,NULL,'2015-04-22 06:11:24','2015-04-22 06:11:24');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(241,NULL,'T&K Toka Co., Ltd., æ¥æ¬æ±è¯','',NULL,NULL,'2015-04-22 06:11:53','2015-04-22 06:11:53');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(242,NULL,'Ta Fu Chi Plasticå¤§ç¦å¥å¡è è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 06:12:11','2015-04-22 06:12:11');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(243,NULL,'Tai Min Machinery Co., Ltd.å¤§éæ©æ¢°æéå¬å¸','',NULL,NULL,'2015-04-22 06:12:28','2015-04-22 06:12:28');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(244,NULL,'Taiwan Be Be  Industrialå°ç£æ¯æ¯å·¥æ¥­','',NULL,NULL,'2015-04-22 06:13:05','2015-04-22 06:13:05');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(245,NULL,'Taiwan Instrument & Control Co., Ltd','',NULL,NULL,'2015-04-22 06:14:42','2015-04-22 06:14:42');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(246,NULL,'Takano Machinery','',NULL,NULL,'2015-04-22 06:14:59','2015-04-22 06:14:59');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(247,NULL,'TAKEX','',NULL,NULL,'2015-04-22 06:15:08','2015-04-22 06:15:08');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(248,NULL,'Tarng Yun Company Limited. åéæéå¬å¸','',NULL,NULL,'2015-04-22 06:15:21','2015-04-22 06:15:21');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(249,NULL,'Tatungå¤§å','',NULL,NULL,'2015-04-22 06:15:35','2015-04-22 06:15:35');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(250,NULL,'Techgene machineryå¤©é§¿æ©æ¢°(è¡)å¬å¸','',NULL,NULL,'2015-04-22 06:15:55','2015-04-22 06:15:55');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(251,NULL,'Technotrans- Singapore','',NULL,NULL,'2015-04-22 06:16:18','2015-04-22 06:16:18');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(252,NULL,'Tecomæ±è¨è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 06:16:31','2015-04-22 06:16:31');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(253,NULL,'Temple Printing and Bookbinding Services','',NULL,NULL,'2015-04-22 06:16:50','2015-04-22 06:16:50');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(254,NULL,'Ten Shen å¤©å±±é¬ç³è¡','',NULL,NULL,'2015-04-22 06:18:31','2015-04-22 06:18:31');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(255,NULL,'Tern Shine Machinery Co., Ltd.','',NULL,NULL,'2015-04-22 06:19:31','2015-04-22 06:19:31');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(256,NULL,'Tesa','',NULL,NULL,'2015-04-22 06:19:41','2015-04-22 06:19:41');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(257,NULL,'Textyearå¾·æ·µ','',NULL,NULL,'2015-04-22 06:19:53','2015-04-22 06:19:53');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(258,NULL,'THK  å°ç£å¸æ¥­æå±è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 06:20:23','2015-04-22 06:20:23');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(259,NULL,'Three Royal ä¸çåå·¥ä¼æ¥­(è¡)å¬å¸','',NULL,NULL,'2015-04-22 06:20:40','2015-04-22 06:20:40');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(260,NULL,'Tianyue YouFeng Co., Ltdå¤©è¶æ²¹å°æéå¬å¸','',NULL,NULL,'2015-04-22 06:20:54','2015-04-22 06:20:54');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(261,NULL,'TongLongPaper','',NULL,NULL,'2015-04-22 06:21:58','2015-04-22 06:21:58');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(262,NULL,'TOYOãINK æ±æ´æ²¹å¢¨','',NULL,NULL,'2015-04-22 06:22:14','2015-04-22 06:22:14');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(263,NULL,'TOYOBO','',NULL,NULL,'2015-04-22 06:22:31','2015-04-22 06:22:31');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(264,NULL,'Triple Star Packaging Corp','',NULL,NULL,'2015-04-22 06:22:45','2015-04-22 06:22:45');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(265,NULL,'Triplex','',NULL,NULL,'2015-04-22 06:23:04','2015-04-22 06:23:04');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(266,NULL,'TRI-STAR READY MIX INC.','',NULL,NULL,'2015-04-22 06:23:19','2015-04-22 06:23:19');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(267,NULL,'Tsanr Fu è²¡å¯ä¼æ¥­(è¡)å¬å¸','',NULL,NULL,'2015-04-22 06:24:16','2015-04-22 06:24:16');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(268,NULL,'TSUKATANIå¡è°·åç©è£½ä½æ','',NULL,NULL,'2015-04-22 06:24:36','2015-04-22 06:24:36');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(269,NULL,'Union Enterprise Co., Ltd. è³ç¾ä¼æ¥­è¡ä»½æéå¬å¸ ','',NULL,NULL,'2015-04-22 06:25:54','2015-04-22 06:25:54');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(270,NULL,'upm (china)','',NULL,NULL,'2015-04-22 06:28:07','2015-04-22 06:28:07');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(271,NULL,'UPPC','',NULL,NULL,'2015-04-22 06:28:18','2015-04-22 06:28:18');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(272,NULL,'UV LIGHT ENTERPRISE CO., LTD.åæºä¼æ¥­è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 06:28:32','2015-04-22 06:28:32');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(273,NULL,'Valco Melton','',NULL,NULL,'2015-04-22 06:28:52','2015-04-22 06:28:52');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(274,NULL,'Vigour Pack Co. Ltd.ç«å¢©è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 06:29:07','2015-04-22 06:29:07');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(275,NULL,'Wan Lian Machineryå»£æ±è¬è¯åè£æ©æ¢°','',NULL,NULL,'2015-04-22 06:29:25','2015-04-22 06:29:25');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(276,NULL,'Weifang Huamei Printing and Technology Co., Ltd.','',NULL,NULL,'2015-04-22 06:29:45','2015-04-22 06:29:45');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(277,NULL,'Wellbond Enterprics Corp.é¾ä»£äºæ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 06:30:02','2015-04-22 06:30:02');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(278,NULL,'Welly Technology International Ltd.å¨åäºæ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 06:30:19','2015-04-22 06:30:19');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(279,NULL,'Wen Jiun é¯éå¯¦æ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 06:30:36','2015-04-22 06:30:36');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(280,NULL,'Win Pack  Machinery  Co.,  Ltd.ç¦¾é æ©æ¢°è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 06:30:50','2015-04-22 06:30:50');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(281,NULL,'Win Shine Machinery åäº«æ©æ¢°è¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 06:31:17','2015-04-22 06:31:17');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(282,NULL,'Wolf Compressor Co., Ltd.åçç§ææéå¬å¸','',NULL,NULL,'2015-04-22 06:31:35','2015-04-22 06:31:35');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(283,NULL,'WU-LIAN äºé£è»¸æ¿æéå¬å¸','',NULL,NULL,'2015-04-22 06:31:52','2015-04-22 06:31:52');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(284,NULL,'Xing Shang Bao','',NULL,NULL,'2015-04-22 06:32:38','2015-04-22 06:32:38');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(285,NULL,'Yao Di èç¬¬éç·æéå¬å¸','',NULL,NULL,'2015-04-22 06:32:50','2015-04-22 06:32:50');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(286,NULL,'Yem Chio Corporation Ltd.æ°æ´²å¨ç(è¡)å¬å¸(çæ´²éå)','',NULL,NULL,'2015-04-22 06:33:13','2015-04-22 06:33:13');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(287,NULL,'YEONG JONG INDUSTRAIL CO., LTD.','',NULL,NULL,'2015-04-22 06:33:46','2015-04-22 06:33:46');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(288,NULL,'YH Precision Co.,Ltd (Yi Hao )å¥éç²¾å¯','',NULL,NULL,'2015-04-22 06:48:04','2015-04-22 06:48:04');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(289,NULL,'Yi Chance ç¾©æ¬ä¼æ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 06:48:22','2015-04-22 06:48:22');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(290,NULL,'Yi Shin ç¾¿æ¬£å¯¦æ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 06:48:43','2015-04-22 06:48:43');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(291,NULL,'Yii lee èª¼åä¼æ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 06:49:08','2015-04-22 06:49:08');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(292,NULL,'Yishen','',NULL,NULL,'2015-04-22 06:49:25','2015-04-22 06:49:25');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(293,NULL,'Yong Chyuan æ°¸èå¡è (è¡)å¬å¸','',NULL,NULL,'2015-04-22 06:49:43','2015-04-22 06:49:43');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(294,NULL,'Yong Shin æ°¸é«ç¹æ®å°å·æéå¬å¸','',NULL,NULL,'2015-04-22 06:50:04','2015-04-22 06:50:04');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(295,NULL,'Yu Jing Industrial Co., Ltd.è²èå·¥æ¥­æéå¬å¸','',NULL,NULL,'2015-04-22 06:52:52','2015-04-22 06:52:52');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(296,NULL,'YUAN LIH KNIFE COMPANY æºå©è£½åè¡ä»½æéå¬å¸','',NULL,NULL,'2015-04-22 06:53:09','2015-04-22 06:53:09');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(297,NULL,'Yuan Pao Machinery Co., Ltd.åå¯¶æ©æ¢°æéå¬å¸','',NULL,NULL,'2015-04-22 06:53:30','2015-04-22 06:53:30');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(298,NULL,'Yuan Shin æºèäºé','',NULL,NULL,'2015-04-22 06:53:52','2015-04-22 06:53:52');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(299,NULL,'YuenFong','',NULL,NULL,'2015-04-22 06:55:11','2015-04-22 06:55:11');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(300,NULL,'Yung Liang Printing Supplies Co., Ltd. æ°¸è¯å°å·è£½çæææéå¬å¸ ','',NULL,NULL,'2015-04-22 06:56:03','2015-04-22 06:56:03');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(301,NULL,'YYD','',NULL,NULL,'2015-04-22 06:56:16','2015-04-22 06:56:16');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(302,NULL,'Zhejiang RUIDA Machinery Co., Ltd æµæ±çå¤§æ©æ¢°æéå¬å¸','',NULL,NULL,'2015-04-22 06:57:59','2015-04-22 06:57:59');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(303,NULL,'Zhong Shan Dong Sen Paper Product Co. Ltd.ä¸­å±±æ±æ£®ç´æ¥­','',NULL,NULL,'2015-04-22 06:58:23','2015-04-22 06:58:23');

INSERT INTO `suppliers` (`id`, `uuid`, `name`, `description`, `created_by`, `modified_by`, `created`, `modified`)
VALUES
	(304,NULL,'Zhong Shan Jin Tian','',NULL,NULL,'2015-04-22 06:59:33','2015-04-22 06:59:33');

/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
