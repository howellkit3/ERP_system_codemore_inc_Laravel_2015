/*
SQLyog Ultimate v8.55 
MySQL - 5.6.16 : Database - koufu_sale
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
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `addresses` */

insert  into `addresses`(`id`,`model`,`foreign_key`,`type`,`address1`,`address2`,`city`,`state_province`,`zip_code`,`country`,`created_by`,`modified_by`,`created`,`modified`) values (5,'Company',19,0,'pacita','pacita2','san pedro','laguna',4023,'PH',1,1,'2015-02-09 04:11:30','2015-02-13 01:42:19'),(6,'ContactPerson',7,0,'filinvest','langgam','san pedro','laguna',4023,'PH',1,1,'2015-02-09 04:11:30','2015-02-13 01:42:19'),(7,'Company',20,0,'Pacita main road','pacita2','san pedro','laguna',4023,'PH',1,1,'2015-02-09 04:13:12','2015-02-13 01:40:35'),(8,'ContactPerson',8,0,'filinvest','bagong silang','san pedro','laguna',4023,'PH',1,1,'2015-02-09 04:13:12','2015-02-13 01:40:35'),(9,'Company',21,0,'Pacita','rainbow street','san pedro','laguna',4023,'PH',1,1,'2015-02-09 04:14:43','2015-02-13 01:37:57'),(10,'ContactPerson',9,0,'Poblacion 5','','GMA','cavite',4117,'PH',1,1,'2015-02-09 04:14:44','2015-02-13 01:37:57');

/*Table structure for table `companies` */

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `website` varchar(120) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `companies` */

insert  into `companies`(`id`,`company_name`,`description`,`website`,`created_by`,`modified_by`,`created`,`modified`) values (19,'CodeMore','web development','codemoreph.com',1,1,'2015-02-09 04:11:30','2015-02-13 01:42:19'),(20,'Web Instrument','web development','webinstrument.com',1,1,'2015-02-09 04:13:12','2015-02-13 01:40:35'),(21,'TESDA','school','tesda.com',1,1,'2015-02-09 04:14:43','2015-02-13 01:37:57');

/*Table structure for table `contact_people` */

DROP TABLE IF EXISTS `contact_people`;

CREATE TABLE `contact_people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `position` varchar(120) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_idx` (`company_id`),
  CONSTRAINT `id` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `contact_people` */

insert  into `contact_people`(`id`,`company_id`,`firstname`,`middlename`,`lastname`,`position`,`created_by`,`modified_by`,`created`,`modified`) values (7,19,'bien','c','relampagos','web Developer',1,1,'2015-02-09 04:11:30','2015-02-13 01:42:19'),(8,20,'irvin','c','llonora','manager',1,1,'2015-02-09 04:13:12','2015-02-13 01:40:35'),(9,21,'Gerald','f','sinlao','clerk',1,1,'2015-02-09 04:14:43','2015-02-13 01:37:57');

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
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `contacts` */

insert  into `contacts`(`id`,`model`,`foreign_key`,`type`,`number`,`created_by`,`modified_by`,`created`,`modified`) values (5,'Company',19,0,'09193759819',1,1,'2015-02-09 04:11:30','2015-02-13 01:42:19'),(6,'ContactPerson',7,0,'09193759817',1,1,'2015-02-09 04:11:30','2015-02-13 01:42:19'),(7,'Company',20,0,'09227895842',1,1,'2015-02-09 04:13:12','2015-02-13 01:40:35'),(8,'ContactPerson',8,0,'09094578951',1,1,'2015-02-09 04:13:12','2015-02-13 01:40:35'),(9,'Company',21,0,'09193759817',1,1,'2015-02-09 04:14:43','2015-02-13 01:37:57'),(10,'ContactPerson',9,0,'09497889279',1,1,'2015-02-09 04:14:43','2015-02-13 01:37:57');

/*Table structure for table `custom_fields` */

DROP TABLE IF EXISTS `custom_fields`;

CREATE TABLE `custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fieldlabel` varchar(60) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `custom_fields` */

insert  into `custom_fields`(`id`,`fieldlabel`,`created_by`,`modified_by`,`created`,`modified`) values (1,'Item',1,1,'2015-02-04 02:16:34','2015-02-04 02:16:34'),(2,'Size',1,1,'2015-02-04 02:18:19','2015-02-04 02:18:19'),(3,'Qty',1,1,'2015-02-04 02:18:29','2015-02-04 02:18:29'),(4,'Unit Price',1,1,'2015-02-04 02:19:05','2015-02-04 02:19:05'),(5,'Material',1,1,'2015-02-04 02:19:21','2015-02-04 02:19:21'),(6,'Color',1,1,'2015-02-04 02:19:29','2015-02-04 02:19:29'),(7,'Process',1,1,'2015-02-04 02:19:37','2015-02-04 02:19:37'),(8,'Packaging',1,1,'2015-02-04 02:19:48','2015-02-04 02:19:48'),(9,'Other Specs',1,1,'2015-02-04 02:20:07','2015-02-04 02:20:07'),(10,'Terms',1,1,'2015-02-04 02:20:13','2015-02-04 02:20:13');

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
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `emails` */

insert  into `emails`(`id`,`model`,`foreign_key`,`type`,`email`,`created_by`,`modified_by`,`created`,`modified`) values (5,'Company',19,0,'codemore@yahoo.com',1,1,'2015-02-09 04:11:30','2015-02-13 01:42:19'),(6,'ContactPerson',7,0,'bienrelampagos@gmail.com',1,1,'2015-02-09 04:11:30','2015-02-13 01:42:19'),(7,'Company',20,0,'web@yahoo.com',1,1,'2015-02-09 04:13:12','2015-02-13 01:40:35'),(8,'ContactPerson',8,0,'irvin@yahoo.com',1,1,'2015-02-09 04:13:12','2015-02-13 01:40:35'),(9,'Company',21,0,'tesda@yahoo.com',1,1,'2015-02-09 04:14:43','2015-02-13 01:37:57'),(10,'ContactPerson',9,0,'gerald@yahoo.com',1,1,'2015-02-09 04:14:44','2015-02-13 01:37:58');

/*Table structure for table `inquiries` */

DROP TABLE IF EXISTS `inquiries`;

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `quotes` text,
  `remarks` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `inquiries` */

insert  into `inquiries`(`id`,`company_id`,`quotes`,`remarks`,`created_by`,`modified_by`,`created`,`modified`) values (7,19,'Phocopying Paper -12 reams\r\nArch Files - 24 Ea','Please take note of our B-Model for the dedicated walker on a limited budget.',1,1,'2015-02-09 04:15:19','2015-02-09 04:15:19'),(8,20,'I would like to inquire about one of your products, [Food Package]. I would like to have an idea about the different models, features, and options. Also please tell me about the available colors, prices, bulk order discounts, warranty, delivery, and credit payment option.','I appreciate if you could also enlighten me on the other alternatives that might also suit our needs. I look forward to your response. ',1,1,'2015-02-09 04:15:47','2015-02-09 04:15:47'),(9,21,'I would appreciate if you could send me information about the same including prices, colors, availability, delivery, and discounts. Also, I would like to inquire about the possibility of a trail period before making any commitments.','Please get back to me with all required information. Thank you very much. ',1,1,'2015-02-09 04:16:03','2015-02-09 04:16:03');

/*Table structure for table `quotation_fields` */

DROP TABLE IF EXISTS `quotation_fields`;

CREATE TABLE `quotation_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_id` int(11) DEFAULT NULL,
  `custom_fields_id` int(11) DEFAULT NULL,
  `description` varchar(120) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `quotation_fields` */

insert  into `quotation_fields`(`id`,`quotation_id`,`custom_fields_id`,`description`,`created_by`,`modified_by`,`created`,`modified`) values (1,1,1,'Glass Holder',1,1,'2015-02-09 04:17:32','2015-02-09 06:00:34'),(2,1,2,'Normal',1,1,'2015-02-09 04:17:32','2015-02-09 06:00:34'),(3,1,6,'blue',1,1,'2015-02-09 04:17:32','2015-02-09 06:00:34'),(4,1,3,'200',1,1,'2015-02-09 04:17:32','2015-02-09 06:00:35'),(5,1,4,'5000 PHP',1,1,'2015-02-09 04:17:32','2015-02-09 06:00:35'),(6,2,1,'plato',1,1,'2015-02-09 04:18:30','2015-02-09 04:18:30'),(7,2,2,'Circle ',1,1,'2015-02-09 04:18:30','2015-02-09 04:18:30'),(8,2,3,'20',1,1,'2015-02-09 04:18:30','2015-02-09 04:18:30'),(9,2,4,'3000 PHP',1,1,'2015-02-09 04:18:30','2015-02-09 04:18:30'),(10,3,1,'computer case',1,1,'2015-02-09 04:19:42','2015-02-09 04:19:42'),(11,3,2,'small',1,1,'2015-02-09 04:19:42','2015-02-09 04:19:42'),(12,3,3,'1',1,1,'2015-02-09 04:19:42','2015-02-09 04:19:42'),(13,3,4,'1000 PHP',1,1,'2015-02-09 04:19:42','2015-02-09 04:19:42'),(25,4,1,'Food package',1,1,'2015-02-09 06:49:50','2015-02-09 06:49:50'),(26,4,2,'Normal',1,1,'2015-02-09 06:49:50','2015-02-09 06:49:50'),(27,4,4,'500 PHP',1,1,'2015-02-09 06:49:51','2015-02-09 06:49:51');

/*Table structure for table `quotations` */

DROP TABLE IF EXISTS `quotations`;

CREATE TABLE `quotations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `inquiry_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `unique_id` varchar(120) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `quotations` */

insert  into `quotations`(`id`,`name`,`company_id`,`inquiry_id`,`status`,`unique_id`,`created_by`,`modified_by`,`created`,`modified`) values (1,'Tesda Quotations',NULL,9,0,'656-1423461634',1,1,'2015-02-09 04:17:32','2015-02-09 06:00:34'),(2,'web quotation',NULL,8,1,'8-11423455510',1,1,'2015-02-09 04:18:30','2015-02-09 04:20:56'),(3,'code quotation',19,NULL,1,'512-1423455582',1,1,'2015-02-09 04:19:42','2015-02-09 04:20:18'),(4,'Tesda quotation',21,NULL,1,'987-1423464590',1,1,'2015-02-09 06:49:50','2015-02-09 09:26:28');

/*Table structure for table `sales_orders` */

DROP TABLE IF EXISTS `sales_orders`;

CREATE TABLE `sales_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `sales_orders` */

insert  into `sales_orders`(`id`,`quotation_id`,`status`,`created_by`,`modified_by`,`created`,`modified`) values (1,3,1,1,1,'2015-02-09 04:20:38','2015-02-09 04:20:38'),(2,2,1,1,1,'2015-02-09 06:19:28','2015-02-09 06:19:28'),(3,4,1,1,1,'2015-02-09 09:55:16','2015-02-09 09:55:16');

/*Table structure for table `types` */

DROP TABLE IF EXISTS `types`;

CREATE TABLE `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Feb 2 2015 Irvin
INSERT INTO `custom_fields` (`id`, `fieldlabel`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(11, 'Vat Price', 1, 1, '2015-02-16 10:26:33', '2015-02-16 10:26:33'),
(12, 'Validity', 1, 1, '2015-02-16 10:36:58', '2015-02-16 10:36:58'),
(13, 'Remarks', 1, 1, '2015-02-16 10:37:06', '2015-02-16 10:37:06');

--- Feb 18 2015 Irvin
ALTER TABLE `companies` ADD `tin` INT(250) NULL AFTER `website`;
ALTER TABLE `companies` ADD `payment_term` varchar(250) NULL AFTER `website`;

--- March 2 2015 Jaimeer
 ALTER TABLE `koufu_sale`.`products`     ADD COLUMN `company_id` INT NULL AFTER `type_id`;
 products;