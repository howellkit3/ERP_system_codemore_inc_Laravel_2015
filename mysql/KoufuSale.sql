/*
SQLyog Ultimate v8.55 
MySQL - 5.6.21 : Database - koufu_sale
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`koufu_sale` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `koufu_sale`;

/*Table structure for table `addresses` */

DROP TABLE IF EXISTS `addresses`;

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(45) DEFAULT NULL,
  `foreign_key` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `address1` varchar(180) DEFAULT NULL,
  `address2` varchar(180) DEFAULT NULL,
  `city` varchar(80) DEFAULT NULL,
  `state_province` varchar(50) DEFAULT NULL,
  `zip_code` int(11) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `addresses` */

insert  into `addresses`(`id`,`model`,`foreign_key`,`type`,`address1`,`address2`,`city`,`state_province`,`zip_code`,`country`,`created_by`,`modified_by`,`created`,`modified`) values (1,'Company',1,0,'pacita','','san pedro','laguna',4023,'PH',2,2,'2015-03-30 01:29:05','2015-04-06 10:37:57');
insert  into `addresses`(`id`,`model`,`foreign_key`,`type`,`address1`,`address2`,`city`,`state_province`,`zip_code`,`country`,`created_by`,`modified_by`,`created`,`modified`) values (2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,2,'2015-04-06 10:37:57','2015-04-06 10:37:57');

/*Table structure for table `approvers` */

DROP TABLE IF EXISTS `approvers`;

CREATE TABLE `approvers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(60) DEFAULT NULL,
  `foreign_key` int(11) DEFAULT NULL,
  `approver_id` int(11) DEFAULT NULL,
  `is_approved` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `approvers` */

/*Table structure for table `client_order_delivery_schedules` */

DROP TABLE IF EXISTS `client_order_delivery_schedules`;

CREATE TABLE `client_order_delivery_schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_order_id` int(11) DEFAULT NULL,
  `schedule` timestamp NULL DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_client_order_delivery_schedules_idx` (`client_order_id`),
  CONSTRAINT `fk_client_order_delivery_schedules` FOREIGN KEY (`client_order_id`) REFERENCES `client_orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `client_order_delivery_schedules` */

insert  into `client_order_delivery_schedules`(`id`,`client_order_id`,`schedule`,`location`,`quantity`,`created_by`,`modified_by`,`created`,`modified`) values (1,16,'2015-04-28 00:00:00','san pedro','200',1,1,'2015-04-01 05:44:52','2015-04-01 05:44:52');
insert  into `client_order_delivery_schedules`(`id`,`client_order_id`,`schedule`,`location`,`quantity`,`created_by`,`modified_by`,`created`,`modified`) values (2,17,'2015-04-29 00:00:00','adgaf','45',1,1,'2015-04-02 08:36:55','2015-04-02 08:36:55');
insert  into `client_order_delivery_schedules`(`id`,`client_order_id`,`schedule`,`location`,`quantity`,`created_by`,`modified_by`,`created`,`modified`) values (3,18,'2015-04-03 00:00:00','dfasdfaffa','123',1,1,'2015-04-02 10:34:34','2015-04-02 10:34:34');
insert  into `client_order_delivery_schedules`(`id`,`client_order_id`,`schedule`,`location`,`quantity`,`created_by`,`modified_by`,`created`,`modified`) values (4,19,'2015-04-30 00:00:00','pacita','1000',1,1,'2015-04-02 12:03:19','2015-04-02 12:03:19');

/*Table structure for table `client_orders` */

DROP TABLE IF EXISTS `client_orders`;

CREATE TABLE `client_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `po_number` varchar(120) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `client_order_item_details_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `remarks` text,
  `payment_terms` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_client_orders_company_idx` (`company_id`),
  CONSTRAINT `fk_client_orders_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `client_orders` */

insert  into `client_orders`(`id`,`uuid`,`company_id`,`po_number`,`quotation_id`,`client_order_item_details_id`,`name`,`remarks`,`payment_terms`,`created_by`,`modified_by`,`created`,`modified`) values (16,1427867092,1,'PO-1427867080427',33,3,'test name','test',21,1,1,'2015-04-01 05:44:52','2015-04-01 05:44:52');
insert  into `client_orders`(`id`,`uuid`,`company_id`,`po_number`,`quotation_id`,`client_order_item_details_id`,`name`,`remarks`,`payment_terms`,`created_by`,`modified_by`,`created`,`modified`) values (17,1427963815,1,'PO-1427963796312',32,2,'tesat','hhhhh',21,1,1,'2015-04-02 08:36:55','2015-04-02 08:36:55');
insert  into `client_orders`(`id`,`uuid`,`company_id`,`po_number`,`quotation_id`,`client_order_item_details_id`,`name`,`remarks`,`payment_terms`,`created_by`,`modified_by`,`created`,`modified`) values (18,1427970874,1,'PO-1427970859915',36,6,'sdfasdf','sdfasdf',21,1,1,'2015-04-02 10:34:34','2015-04-02 10:34:34');
insert  into `client_orders`(`id`,`uuid`,`company_id`,`po_number`,`quotation_id`,`client_order_item_details_id`,`name`,`remarks`,`payment_terms`,`created_by`,`modified_by`,`created`,`modified`) values (19,1427976199,1,'PO-1427976168742',31,1,'bien po','tesitn lang',21,1,1,'2015-04-02 12:03:19','2015-04-02 12:03:19');

/*Table structure for table `companies` */

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` int(11) DEFAULT NULL,
  `company_name` varchar(80) DEFAULT NULL,
  `description` text,
  `website` varchar(80) DEFAULT NULL,
  `payment_term` int(11) DEFAULT NULL,
  `tin` varchar(80) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `companies` */

insert  into `companies`(`id`,`uuid`,`company_name`,`description`,`website`,`payment_term`,`tin`,`created_by`,`modified_by`,`created`,`modified`) values (1,NULL,'CodeMore','web Development','codemore.com',21,'21312',2,2,'2015-03-30 01:29:05','2015-04-06 10:37:57');

/*Table structure for table `contact_people` */

DROP TABLE IF EXISTS `contact_people`;

CREATE TABLE `contact_people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `prefix` varchar(45) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `position` varchar(120) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_idx` (`company_id`),
  CONSTRAINT `id` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `contact_people` */

insert  into `contact_people`(`id`,`company_id`,`prefix`,`firstname`,`middlename`,`lastname`,`position`,`created_by`,`modified_by`,`created`,`modified`) values (1,1,NULL,'bien','c','relampagos','Developer',2,2,'2015-03-30 01:29:05','2015-04-06 10:37:57');

/*Table structure for table `contacts` */

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(45) DEFAULT NULL,
  `foreign_key` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `contacts` */

insert  into `contacts`(`id`,`model`,`foreign_key`,`type`,`number`,`created_by`,`modified_by`,`created`,`modified`) values (1,'Company',1,0,'12312',2,2,'2015-03-30 01:29:05','2015-04-06 10:37:57');
insert  into `contacts`(`id`,`model`,`foreign_key`,`type`,`number`,`created_by`,`modified_by`,`created`,`modified`) values (2,'ContactPerson',1,0,'1231',2,2,'2015-03-30 01:29:05','2015-04-06 10:37:57');

/*Table structure for table `emails` */

DROP TABLE IF EXISTS `emails`;

CREATE TABLE `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(45) DEFAULT NULL,
  `foreign_key` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `emails` */

insert  into `emails`(`id`,`model`,`foreign_key`,`type`,`email`,`created_by`,`modified_by`,`created`,`modified`) values (1,'Company',1,0,'code@yahoo.com',2,2,'2015-03-30 01:29:05','2015-04-06 10:37:57');
insert  into `emails`(`id`,`model`,`foreign_key`,`type`,`email`,`created_by`,`modified_by`,`created`,`modified`) values (2,'ContactPerson',1,0,'bien@yahoo.com',2,2,'2015-03-30 01:29:05','2015-04-06 10:37:57');
insert  into `emails`(`id`,`model`,`foreign_key`,`type`,`email`,`created_by`,`modified_by`,`created`,`modified`) values (3,'Company',1,0,'code@yahoo.com',2,2,'2015-04-06 10:37:57','2015-04-06 10:37:57');

/*Table structure for table `inquiries` */

DROP TABLE IF EXISTS `inquiries`;

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `quotes` text,
  `remarks` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inquiries_companies1_idx` (`company_id`),
  CONSTRAINT `fk_inquiries_companies1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `inquiries` */

insert  into `inquiries`(`id`,`uuid`,`company_id`,`quotes`,`remarks`,`created_by`,`modified_by`,`created`,`modified`) values (1,NULL,1,'test','test',1,1,'2015-03-30 01:30:37','2015-03-30 01:30:37');

/*Table structure for table `item_category_holders` */

DROP TABLE IF EXISTS `item_category_holders`;

CREATE TABLE `item_category_holders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `item_category_holders` */

/*Table structure for table `item_type_holders` */

DROP TABLE IF EXISTS `item_type_holders`;

CREATE TABLE `item_type_holders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_category_holder_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `item_type_holders` */

/*Table structure for table `packaging_holders` */

DROP TABLE IF EXISTS `packaging_holders`;

CREATE TABLE `packaging_holders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `packaging_holders` */

/*Table structure for table `payment_term_holders` */

DROP TABLE IF EXISTS `payment_term_holders`;

CREATE TABLE `payment_term_holders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `payment_term_holders` */

/*Table structure for table `product_process_details` */

DROP TABLE IF EXISTS `product_process_details`;

CREATE TABLE `product_process_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_specification_id` int(11) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL COMMENT 'Types can be: Component, Part, Process',
  `details` text,
  `order` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `product_process_details` */

/*Table structure for table `product_specifications` */

DROP TABLE IF EXISTS `product_specifications`;

CREATE TABLE `product_specifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `size1` int(11) DEFAULT NULL,
  `size2` int(11) DEFAULT NULL,
  `size3` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `quantity_unit_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_specifications_idx` (`product_id`),
  CONSTRAINT `fk_product_specifications` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `product_specifications` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `item_category_holder_id` int(11) DEFAULT NULL,
  `item_type_holder_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `remarks` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_company_idx` (`company_id`),
  CONSTRAINT `fk_products_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `products` */

insert  into `products`(`id`,`uuid`,`company_id`,`item_category_holder_id`,`item_type_holder_id`,`name`,`remarks`,`created_by`,`modified_by`,`created`,`modified`) values (1,NULL,1,NULL,NULL,NULL,NULL,1,1,'2015-03-30 06:57:48','2015-03-30 06:57:48');
insert  into `products`(`id`,`uuid`,`company_id`,`item_category_holder_id`,`item_type_holder_id`,`name`,`remarks`,`created_by`,`modified_by`,`created`,`modified`) values (2,NULL,1,NULL,NULL,NULL,NULL,1,1,'2015-03-30 07:02:18','2015-03-30 07:02:18');
insert  into `products`(`id`,`uuid`,`company_id`,`item_category_holder_id`,`item_type_holder_id`,`name`,`remarks`,`created_by`,`modified_by`,`created`,`modified`) values (3,NULL,1,NULL,NULL,NULL,NULL,1,1,'2015-03-30 07:02:44','2015-03-30 07:02:44');
insert  into `products`(`id`,`uuid`,`company_id`,`item_category_holder_id`,`item_type_holder_id`,`name`,`remarks`,`created_by`,`modified_by`,`created`,`modified`) values (4,NULL,1,NULL,NULL,NULL,NULL,1,1,'2015-03-30 07:03:42','2015-03-30 07:03:42');
insert  into `products`(`id`,`uuid`,`company_id`,`item_category_holder_id`,`item_type_holder_id`,`name`,`remarks`,`created_by`,`modified_by`,`created`,`modified`) values (5,NULL,1,NULL,NULL,NULL,NULL,1,1,'2015-03-30 07:12:34','2015-03-30 07:12:34');
insert  into `products`(`id`,`uuid`,`company_id`,`item_category_holder_id`,`item_type_holder_id`,`name`,`remarks`,`created_by`,`modified_by`,`created`,`modified`) values (6,NULL,1,NULL,NULL,NULL,NULL,1,1,'2015-03-30 09:44:33','2015-03-30 09:44:33');

/*Table structure for table `quotation_approvers` */

DROP TABLE IF EXISTS `quotation_approvers`;

CREATE TABLE `quotation_approvers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order` smallint(6) DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `quotation_approvers` */

/*Table structure for table `quotation_details` */

DROP TABLE IF EXISTS `quotation_details`;

CREATE TABLE `quotation_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size` varchar(80) DEFAULT NULL,
  `color` varchar(80) DEFAULT NULL,
  `process` text,
  `packaging` varchar(80) DEFAULT NULL,
  `other_specs` text,
  `remarks` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_quotation_details_idx` (`quotation_id`),
  CONSTRAINT `fk_quotation_details` FOREIGN KEY (`quotation_id`) REFERENCES `quotations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `quotation_details` */

insert  into `quotation_details`(`id`,`quotation_id`,`product_id`,`size`,`color`,`process`,`packaging`,`other_specs`,`remarks`,`created_by`,`modified_by`,`modified`,`created`) values (1,31,NULL,'small','blue','printing->cutting','pack','none','test only',1,1,'2015-03-30 09:51:10','2015-03-30 09:51:10');
insert  into `quotation_details`(`id`,`quotation_id`,`product_id`,`size`,`color`,`process`,`packaging`,`other_specs`,`remarks`,`created_by`,`modified_by`,`modified`,`created`) values (2,32,NULL,'test','test','test','test','test','test',1,1,'2015-03-30 09:56:10','2015-03-30 09:56:10');
insert  into `quotation_details`(`id`,`quotation_id`,`product_id`,`size`,`color`,`process`,`packaging`,`other_specs`,`remarks`,`created_by`,`modified_by`,`modified`,`created`) values (3,33,NULL,'asdf','fsadf','asdf','fasd','fasdf','afsdf',1,1,'2015-03-30 10:24:58','2015-03-30 10:24:58');
insert  into `quotation_details`(`id`,`quotation_id`,`product_id`,`size`,`color`,`process`,`packaging`,`other_specs`,`remarks`,`created_by`,`modified_by`,`modified`,`created`) values (4,35,NULL,'as','asdf','asasf','asf','afs','sdf',1,1,'2015-04-02 08:33:38','2015-04-02 08:33:38');
insert  into `quotation_details`(`id`,`quotation_id`,`product_id`,`size`,`color`,`process`,`packaging`,`other_specs`,`remarks`,`created_by`,`modified_by`,`modified`,`created`) values (5,36,NULL,'asd','fsdaf','asdfas','asdf','asdf','fasdf',1,1,'2015-04-02 10:13:33','2015-04-02 10:13:33');

/*Table structure for table `quotation_item_details` */

DROP TABLE IF EXISTS `quotation_item_details`;

CREATE TABLE `quotation_item_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `vat_price` double DEFAULT NULL,
  `material` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_quotation_item_details_idx` (`quotation_id`),
  CONSTRAINT `fk_quotation_item_details` FOREIGN KEY (`quotation_id`) REFERENCES `quotations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `quotation_item_details` */

insert  into `quotation_item_details`(`id`,`quotation_id`,`quantity`,`unit_price`,`vat_price`,`material`) values (1,31,100,5000,2,'hard paper');
insert  into `quotation_item_details`(`id`,`quotation_id`,`quantity`,`unit_price`,`vat_price`,`material`) values (2,32,12,123,1,'test');
insert  into `quotation_item_details`(`id`,`quotation_id`,`quantity`,`unit_price`,`vat_price`,`material`) values (3,33,53,78,9,'food pack');
insert  into `quotation_item_details`(`id`,`quotation_id`,`quantity`,`unit_price`,`vat_price`,`material`) values (4,33,43,643,7,'tv pack');
insert  into `quotation_item_details`(`id`,`quotation_id`,`quantity`,`unit_price`,`vat_price`,`material`) values (5,35,12,1,NULL,'sadf');
insert  into `quotation_item_details`(`id`,`quotation_id`,`quantity`,`unit_price`,`vat_price`,`material`) values (6,36,100,500,560,'sdfasf');

/*Table structure for table `quotations` */

DROP TABLE IF EXISTS `quotations`;

CREATE TABLE `quotations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` int(11) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `inquiry_id` int(11) DEFAULT NULL,
  `attention_details` varchar(120) DEFAULT NULL,
  `payment_terms` int(11) DEFAULT NULL,
  `validity` timestamp NULL DEFAULT NULL,
  `currency` varchar(45) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_quotations_companies1_idx` (`company_id`),
  CONSTRAINT `fk_quotations_companies1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

/*Data for the table `quotations` */

insert  into `quotations`(`id`,`uuid`,`name`,`company_id`,`inquiry_id`,`attention_details`,`payment_terms`,`validity`,`currency`,`created_by`,`modified_by`,`created`,`modified`) values (31,1427709070,'test item',1,NULL,'Mr.bien',21,'2015-04-04 00:00:00',NULL,1,1,'2015-03-30 09:51:10','2015-03-30 09:51:10');
insert  into `quotations`(`id`,`uuid`,`name`,`company_id`,`inquiry_id`,`attention_details`,`payment_terms`,`validity`,`currency`,`created_by`,`modified_by`,`created`,`modified`) values (32,1427709370,'Test Lang Ulit',1,1,'test',5,'2015-04-02 00:00:00',NULL,1,1,'2015-03-30 09:56:10','2015-03-30 09:56:10');
insert  into `quotations`(`id`,`uuid`,`name`,`company_id`,`inquiry_id`,`attention_details`,`payment_terms`,`validity`,`currency`,`created_by`,`modified_by`,`created`,`modified`) values (33,1427711098,'asdfsf',1,NULL,'Mr.Bienskie',12,'2015-04-03 00:00:00',NULL,1,1,'2015-03-30 10:24:58','2015-03-30 10:24:58');
insert  into `quotations`(`id`,`uuid`,`name`,`company_id`,`inquiry_id`,`attention_details`,`payment_terms`,`validity`,`currency`,`created_by`,`modified_by`,`created`,`modified`) values (35,1427963618,'fasdfa',1,1,'asdf',21,'2015-04-28 00:00:00',NULL,1,1,'2015-04-02 08:33:38','2015-04-02 08:33:38');
insert  into `quotations`(`id`,`uuid`,`name`,`company_id`,`inquiry_id`,`attention_details`,`payment_terms`,`validity`,`currency`,`created_by`,`modified_by`,`created`,`modified`) values (36,1427969613,'dsaf',1,NULL,'sfdasf',45,'2015-04-29 00:00:00',NULL,1,1,'2015-04-02 10:13:33','2015-04-02 10:13:33');

/*Table structure for table `status_field_holders` */

DROP TABLE IF EXISTS `status_field_holders`;

CREATE TABLE `status_field_holders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `status_field_holders` */

/*Table structure for table `statuses` */

DROP TABLE IF EXISTS `statuses`;

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(45) DEFAULT NULL,
  `foreign_key` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `label` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `statuses` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
