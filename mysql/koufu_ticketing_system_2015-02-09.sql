/*
SQLyog Ultimate v8.55 
MySQL - 5.6.21 : Database - koufu_ticketing_system
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`koufu_ticketing_system` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `koufu_ticketing_system`;

/*Table structure for table `job_tickets` */

DROP TABLE IF EXISTS `job_tickets`;

CREATE TABLE `job_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_ticket_desc` varchar(100) DEFAULT NULL,
  `created` varchar(100) DEFAULT NULL,
  `modified` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `job_tickets` */

insert  into `job_tickets`(`id`,`job_ticket_desc`,`created`,`modified`) values (1,'Prepressed','2015-02-17 10:05:59','2015-02-17 10:05:53'),(2,'Plate Making',NULL,NULL),(3,'RM Requisition',NULL,NULL),(4,'Production',NULL,NULL),(5,'Finished Goods',NULL,NULL),(6,'Shipping',NULL,NULL);

/*Table structure for table `tickets` */

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(120) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `job_ticket_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tickets` */

insert  into `tickets`(`id`,`unique_id`,`status`,`job_ticket_id`,`created_by`,`modified_by`,`created`,`modified`) values (1,'987-1423464590',0,1,1,1,'2015-02-09 09:59:32','2015-02-17 05:30:14'),(2,'656-1423461634',0,6,1,1,'2015-02-17 01:35:01','2015-02-17 08:20:58');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
