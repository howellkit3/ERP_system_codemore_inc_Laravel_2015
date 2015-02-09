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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `addresses` */

insert  into `addresses`(`id`,`model`,`foreign_key`,`type`,`address1`,`address2`,`city`,`state_province`,`zip_code`,`country`,`created_by`,`modified_by`,`created`,`modified`) values (5,'Company',19,0,'pacita','pacita2','san pedro','laguna',3123,'AO',1,1,'2015-02-09 04:11:30','2015-02-09 04:11:30'),(6,'ContactPerson',7,0,'filinvest','filinvest2','san pedro','laguna',12312,'AS',1,1,'2015-02-09 04:11:30','2015-02-09 04:11:30'),(7,'Company',20,0,'web address','address2','san pedro','laguna',12312,'AL',1,1,'2015-02-09 04:13:12','2015-02-09 04:13:12'),(8,'ContactPerson',8,0,'irvin haus','irvin haus2','san pedro','laguna',3212,'DZ',1,1,'2015-02-09 04:13:12','2015-02-09 04:13:12'),(9,'Company',21,0,'tesda address','tesda address2','san pedro','laguna',321,'AS',1,1,'2015-02-09 04:14:43','2015-02-09 05:24:17'),(10,'ContactPerson',9,0,'gerald haus','gerald haus2','gma','cavite',2321,'AS',1,1,'2015-02-09 04:14:44','2015-02-09 05:24:18');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `companies` */

insert  into `companies`(`id`,`company_name`,`description`,`website`,`created_by`,`modified_by`,`created`,`modified`) values (19,'CodeMore','web development','codemore.com',1,1,'2015-02-09 04:11:30','2015-02-09 04:11:30'),(20,'Web Instrument','web development','webinstrument.com',1,1,'2015-02-09 04:13:12','2015-02-09 04:13:12'),(21,'TESDA','school','tesda.com',1,1,'2015-02-09 04:14:43','2015-02-09 05:24:17');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `contact_people` */

insert  into `contact_people`(`id`,`company_id`,`firstname`,`middlename`,`lastname`,`position`,`created_by`,`modified_by`,`created`,`modified`) values (7,19,'bien','c','relampagos','manager',1,1,'2015-02-09 04:11:30','2015-02-09 04:11:30'),(8,20,'irvin','c','pogi','manager',1,1,'2015-02-09 04:13:12','2015-02-09 04:13:12'),(9,21,'Gerald','f','sinlao','clerk',1,1,'2015-02-09 04:14:43','2015-02-09 05:24:17');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `contacts` */

insert  into `contacts`(`id`,`model`,`foreign_key`,`type`,`number`,`created_by`,`modified_by`,`created`,`modified`) values (5,'Company',19,0,'312312',1,1,'2015-02-09 04:11:30','2015-02-09 04:11:30'),(6,'ContactPerson',7,0,'2123',1,1,'2015-02-09 04:11:30','2015-02-09 04:11:30'),(7,'Company',20,0,'13212',1,1,'2015-02-09 04:13:12','2015-02-09 04:13:12'),(8,'ContactPerson',8,0,'213',1,1,'2015-02-09 04:13:12','2015-02-09 04:13:12'),(9,'Company',21,0,'2131',1,1,'2015-02-09 04:14:43','2015-02-09 05:24:17'),(10,'ContactPerson',9,0,'21312',1,1,'2015-02-09 04:14:43','2015-02-09 05:24:17');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `emails` */

insert  into `emails`(`id`,`model`,`foreign_key`,`type`,`email`,`created_by`,`modified_by`,`created`,`modified`) values (5,'Company',19,0,'codemore@yahoo.com',1,1,'2015-02-09 04:11:30','2015-02-09 04:11:30'),(6,'ContactPerson',7,0,'bien@yahoo.com',1,1,'2015-02-09 04:11:30','2015-02-09 04:11:30'),(7,'Company',20,0,'web@yahoo.com',1,1,'2015-02-09 04:13:12','2015-02-09 04:13:12'),(8,'ContactPerson',8,0,'irvin@yahoo.com',1,1,'2015-02-09 04:13:12','2015-02-09 04:13:12'),(9,'Company',21,0,'tesda@yahoo.com',1,1,'2015-02-09 04:14:43','2015-02-09 05:24:17'),(10,'ContactPerson',9,0,'gerald@yahoo.com',1,1,'2015-02-09 04:14:44','2015-02-09 05:24:18');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `inquiries` */

insert  into `inquiries`(`id`,`company_id`,`quotes`,`remarks`,`created_by`,`modified_by`,`created`,`modified`) values (7,19,'testing inquiry','test',1,1,'2015-02-09 04:15:19','2015-02-09 04:15:19'),(8,20,'test 2','test 2',1,1,'2015-02-09 04:15:47','2015-02-09 04:15:47'),(9,21,'test 3','test 3',1,1,'2015-02-09 04:16:03','2015-02-09 04:16:03');

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `quotation_fields` */

insert  into `quotation_fields`(`id`,`quotation_id`,`custom_fields_id`,`description`,`created_by`,`modified_by`,`created`,`modified`) values (1,1,1,'baso',1,1,'2015-02-09 04:17:32','2015-02-09 06:00:34'),(2,1,2,'bilog',1,1,'2015-02-09 04:17:32','2015-02-09 06:00:34'),(3,1,6,'blue',1,1,'2015-02-09 04:17:32','2015-02-09 06:00:34'),(4,1,3,'200',1,1,'2015-02-09 04:17:32','2015-02-09 06:00:35'),(5,1,4,'5000',1,1,'2015-02-09 04:17:32','2015-02-09 06:00:35'),(6,2,1,'plato',1,1,'2015-02-09 04:18:30','2015-02-09 04:18:30'),(7,2,2,'triangle',1,1,'2015-02-09 04:18:30','2015-02-09 04:18:30'),(8,2,3,'20',1,1,'2015-02-09 04:18:30','2015-02-09 04:18:30'),(9,2,4,'3000',1,1,'2015-02-09 04:18:30','2015-02-09 04:18:30'),(10,3,1,'computer case',1,1,'2015-02-09 04:19:42','2015-02-09 04:19:42'),(11,3,2,'small',1,1,'2015-02-09 04:19:42','2015-02-09 04:19:42'),(12,3,3,'1',1,1,'2015-02-09 04:19:42','2015-02-09 04:19:42'),(13,3,4,'1000',1,1,'2015-02-09 04:19:42','2015-02-09 04:19:42'),(25,4,1,'sample item',1,1,'2015-02-09 06:49:50','2015-02-09 06:49:50'),(26,4,2,'big',1,1,'2015-02-09 06:49:50','2015-02-09 06:49:50'),(27,4,4,'500',1,1,'2015-02-09 06:49:51','2015-02-09 06:49:51');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `quotations` */

insert  into `quotations`(`id`,`name`,`company_id`,`inquiry_id`,`status`,`unique_id`,`created_by`,`modified_by`,`created`,`modified`) values (1,'Tesda Quotations',NULL,9,0,'656-1423461634',1,1,'2015-02-09 04:17:32','2015-02-09 06:00:34'),(2,'web quotation',NULL,8,1,'8-11423455510',1,1,'2015-02-09 04:18:30','2015-02-09 04:20:56'),(3,'code quotation',19,NULL,1,'512-1423455582',1,1,'2015-02-09 04:19:42','2015-02-09 04:20:18'),(4,'sample quotation',21,NULL,0,'987-1423464590',1,1,'2015-02-09 06:49:50','2015-02-09 06:49:50');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `sales_orders` */

insert  into `sales_orders`(`id`,`quotation_id`,`status`,`created_by`,`modified_by`,`created`,`modified`) values (1,3,1,1,1,'2015-02-09 04:20:38','2015-02-09 04:20:38'),(2,2,1,1,1,'2015-02-09 06:19:28','2015-02-09 06:19:28');

/*Table structure for table `types` */

DROP TABLE IF EXISTS `types`;

CREATE TABLE `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `types` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
