/*
SQLyog Ultimate v11.5 (32 bit)
MySQL - 5.6.26-log : Database - dev_koufu_warehouse
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dev_koufu_warehouse` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `dev_koufu_warehouse`;

/*Table structure for table `delivered_orders` */

DROP TABLE IF EXISTS `delivered_orders`;

CREATE TABLE `delivered_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `received_orders_id` int(11) DEFAULT NULL,
  `purchase_orders_id` int(11) DEFAULT NULL,
  `uuid` varchar(30) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `delivered_orders` */

insert  into `delivered_orders`(`id`,`received_orders_id`,`purchase_orders_id`,`uuid`,`status_id`,`created`,`modified`,`created_by`,`modified_by`) values (1,1,1,'15091434',1,'2015-09-21 07:31:01','2015-09-21 07:31:19',19,19),(2,1,1,'15093994',1,'2015-09-23 07:01:32','2015-09-23 07:01:54',6,6),(3,1,1,'15094914',13,'2015-09-23 07:01:43','2015-09-23 07:02:14',6,6),(4,2,2,'15096402',NULL,'2015-09-23 07:16:58','2015-09-23 07:16:58',6,6),(5,2,2,'15096408',NULL,'2015-09-23 07:17:24','2015-09-23 07:17:24',6,6);

/*Table structure for table `departments` */

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `departments` */

insert  into `departments`(`id`,`name`,`description`,`created_by`,`modified_by`,`created`,`modified`) values (1,'APC',NULL,NULL,NULL,NULL,NULL),(2,'Box Gluing',NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `in_records` */

DROP TABLE IF EXISTS `in_records`;

CREATE TABLE `in_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `received_orders_id` int(11) DEFAULT NULL,
  `remarks` text NOT NULL,
  `storekeeper_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `in_records` */

/*Table structure for table `item_categories` */

DROP TABLE IF EXISTS `item_categories`;

CREATE TABLE `item_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `item_categories` */

insert  into `item_categories`(`id`,`name`,`description`,`created_by`,`modified_by`,`created`,`modified`) values (1,'Consumables','consumemables',1,1,NULL,NULL),(2,'Raw Materials',NULL,NULL,NULL,NULL,NULL),(3,'Finished Goods',NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `item_records` */

DROP TABLE IF EXISTS `item_records`;

CREATE TABLE `item_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_record` int(11) NOT NULL,
  `type_record_id` int(11) NOT NULL,
  `model` varchar(30) NOT NULL,
  `foreign_key` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `item_records` */

/*Table structure for table `items` */

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `description` text,
  `supplier` varchar(255) DEFAULT NULL,
  `remaining_stocks` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `items` */

/*Table structure for table `out_records` */

DROP TABLE IF EXISTS `out_records`;

CREATE TABLE `out_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `out_records` */

/*Table structure for table `received_items` */

DROP TABLE IF EXISTS `received_items`;

CREATE TABLE `received_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delivered_order_id` int(11) DEFAULT NULL,
  `received_orders_id` int(11) DEFAULT NULL,
  `model` varchar(30) DEFAULT NULL,
  `foreign_key` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `reject_quantity` int(11) DEFAULT NULL,
  `original_quantity` int(11) DEFAULT NULL,
  `request_uuid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `received_items` */

insert  into `received_items`(`id`,`delivered_order_id`,`received_orders_id`,`model`,`foreign_key`,`quantity`,`reject_quantity`,`original_quantity`,`request_uuid`) values (1,1,1,'GeneralItem',133,100,0,200,15097545),(2,2,1,'Substrate',198,50,0,50,15094793),(3,4,2,'Substrate',198,1,0,1,15092225);

/*Table structure for table `received_orders` */

DROP TABLE IF EXISTS `received_orders`;

CREATE TABLE `received_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` int(11) NOT NULL,
  `purchase_order_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `received_by` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `received_orders` */

insert  into `received_orders`(`id`,`uuid`,`purchase_order_id`,`status_id`,`remarks`,`received_by`,`approved_by`,`created`,`modified`) values (1,15095223,1,11,'',19,19,'2015-09-21 07:31:01','2015-09-21 07:31:01'),(2,15099828,2,11,'',6,6,'2015-09-23 07:16:58','2015-09-23 07:16:58');

/*Table structure for table `stocks` */

DROP TABLE IF EXISTS `stocks`;

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` int(11) NOT NULL,
  `model` varchar(35) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `size1` varchar(30) DEFAULT NULL,
  `size1_unit_id` int(11) DEFAULT NULL,
  `size2` varchar(30) DEFAULT NULL,
  `size2_unit_id` varchar(30) DEFAULT NULL,
  `size3` varchar(30) DEFAULT NULL,
  `size3_unit_id` varchar(30) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `quantity_unit_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `stocks` */

/*Table structure for table `warehouse_request_items` */

DROP TABLE IF EXISTS `warehouse_request_items`;

CREATE TABLE `warehouse_request_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(30) DEFAULT NULL,
  `foreign_key` int(11) DEFAULT NULL,
  `request_id` int(11) DEFAULT NULL,
  `size1` varchar(80) DEFAULT NULL,
  `size1_unit_id` int(11) DEFAULT NULL,
  `size2` varchar(80) DEFAULT NULL,
  `size2_unit_id` int(11) DEFAULT NULL,
  `size3` varchar(80) DEFAULT NULL,
  `size3_unit_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `quantity_unit_id` int(11) DEFAULT NULL,
  `date_needed` datetime DEFAULT NULL,
  `purpose` varchar(50) DEFAULT NULL,
  `remarks` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `warehouse_request_items` */

insert  into `warehouse_request_items`(`id`,`model`,`foreign_key`,`request_id`,`size1`,`size1_unit_id`,`size2`,`size2_unit_id`,`size3`,`size3_unit_id`,`quantity`,`quantity_unit_id`,`date_needed`,`purpose`,`remarks`) values (1,'CorrugatedPaper',15,1,'1',2,'1',2,'1',2,1,14,'2015-09-30 00:00:00','operation',''),(2,'GeneralItem',133,2,'20',36,'23',35,'4',36,50,14,'2015-09-11 00:00:00','dsd','');

/*Table structure for table `warehouse_requests` */

DROP TABLE IF EXISTS `warehouse_requests`;

CREATE TABLE `warehouse_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` int(11) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `warehouse_requests` */

insert  into `warehouse_requests`(`id`,`uuid`,`name`,`status_id`,`created`,`modified`,`created_by`,`modified_by`) values (1,15097607,'',1,'2015-09-21 07:33:37','2015-09-21 07:34:03',19,19),(2,15097974,'sd',8,'2015-09-23 07:08:05','2015-09-23 07:08:05',6,6);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
