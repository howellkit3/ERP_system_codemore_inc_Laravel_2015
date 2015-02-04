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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `addresses` */

insert  into `addresses`(`id`,`model`,`foreign_key`,`type`,`address1`,`address2`,`city`,`state_province`,`zip_code`,`country`,`created_by`,`modified_by`,`created`,`modified`) values (1,'Company',13,0,'laguna','laguna','laguna','laguna',111,'BS',1,1,'2015-02-02 03:56:10','2015-02-02 04:08:12'),(2,'ContactPerson',1,0,'filinvest','filinvest','filinvest','filinvest',22,'AS',1,1,'2015-02-02 03:56:10','2015-02-02 04:08:12'),(3,'Company',14,0,'web address','sdf','sadf','asdf',123,'AT',1,1,'2015-02-03 01:06:43','2015-02-03 01:06:43'),(4,'ContactPerson',2,0,'irvin haus','dsf','dfs','sdfs',213,'AO',1,1,'2015-02-03 01:06:43','2015-02-03 01:06:43');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `companies` */

insert  into `companies`(`id`,`company_name`,`description`,`website`,`created_by`,`modified_by`,`created`,`modified`) values (13,'CodeMore','web','codemore.com',1,1,'2015-02-02 03:56:10','2015-02-02 04:08:12'),(14,'Web Instrument','web development','webinstrument.com',1,1,'2015-02-03 01:06:43','2015-02-03 01:06:43');

/*Table structure for table `contact_people` */

DROP TABLE IF EXISTS `contact_people`;

CREATE TABLE `contact_people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_idx` (`company_id`),
  CONSTRAINT `id` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `contact_people` */

insert  into `contact_people`(`id`,`company_id`,`firstname`,`middlename`,`lastname`,`created_by`,`modified_by`,`created`,`modified`) values (1,13,'bien','c','relampagos',1,1,'2015-02-02 03:56:10','2015-02-02 04:08:12'),(2,14,'irvin','c','pogi',1,1,'2015-02-03 01:06:43','2015-02-03 01:06:43');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `contacts` */

insert  into `contacts`(`id`,`model`,`foreign_key`,`type`,`number`,`created_by`,`modified_by`,`created`,`modified`) values (1,'Company',13,0,'111',1,1,'2015-02-02 03:56:10','2015-02-02 04:08:12'),(2,'ContactPerson',1,0,'22',1,1,'2015-02-02 03:56:10','2015-02-02 04:08:12'),(3,'Company',14,0,'21312',1,1,'2015-02-03 01:06:43','2015-02-03 01:06:43'),(4,'ContactPerson',2,0,'3221',1,1,'2015-02-03 01:06:43','2015-02-03 01:06:43');

/*Table structure for table `custom_fields` */

DROP TABLE IF EXISTS `custom_fields`;

CREATE TABLE `custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(60) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `custom_fields` */

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `emails` */

insert  into `emails`(`id`,`model`,`foreign_key`,`type`,`email`,`created_by`,`modified_by`,`created`,`modified`) values (1,'Company',13,0,'codemore@yahoo.com',1,1,'2015-02-02 03:56:10','2015-02-02 04:08:12'),(2,'ContactPerson',1,0,'bien@yahoo.com',1,1,'2015-02-02 03:56:10','2015-02-02 04:08:12'),(3,'Company',14,0,'instrument@yahoo.com',1,1,'2015-02-03 01:06:43','2015-02-03 01:06:43'),(4,'ContactPerson',2,0,'irvin@yahoo.com',1,1,'2015-02-03 01:06:44','2015-02-03 01:06:44');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `inquiries` */

insert  into `inquiries`(`id`,`company_id`,`quotes`,`remarks`,`created_by`,`modified_by`,`created`,`modified`) values (1,13,'inquiry test','remarks test',1,1,'2015-02-03 05:38:20','2015-02-03 05:38:20'),(2,14,'dsad','sad',1,1,'2015-02-03 05:39:52','2015-02-03 05:39:52'),(3,13,'sfas','asdf',1,1,'2015-02-03 05:42:31','2015-02-03 05:42:31'),(4,13,'fdsaf','asdf',1,1,'2015-02-03 05:43:22','2015-02-03 05:43:22'),(5,13,'fdsafasdf','asdfsdf',1,1,'2015-02-03 08:09:26','2015-02-03 08:09:26'),(6,14,'testing ','testing',1,1,'2015-02-04 00:41:04','2015-02-04 00:41:04');

/*Table structure for table `quotations` */

DROP TABLE IF EXISTS `quotations`;

CREATE TABLE `quotations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inquiry_id` int(11) DEFAULT NULL,
  `label` int(11) DEFAULT NULL,
  `description` varchar(60) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `quotations` */

insert  into `quotations`(`id`,`inquiry_id`,`label`,`description`,`created_by`,`modified_by`,`created`,`modified`) values (1,2,3,'100',1,1,'2015-02-04 00:05:15','2015-02-04 00:05:15');

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
