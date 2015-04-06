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

CREATE DATABASE /*!32312 IF NOT EXISTS*/`koufu_ticketing` /*!40100 DEFAULT CHARACTER SET latin1 */;



USE `koufu_ticketing`;



/*Table structure for table `job_ticket_descriptions` */



DROP TABLE IF EXISTS `job_ticket_descriptions`;



CREATE TABLE `job_ticket_descriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descriptions` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



/*Data for the table `job_ticket_descriptions` */



/*Table structure for table `job_ticket_details` */



DROP TABLE IF EXISTS `job_ticket_details`;



CREATE TABLE `job_ticket_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(100) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



/*Data for the table `job_ticket_details` */



/*Table structure for table `job_ticket_summaries` */



DROP TABLE IF EXISTS `job_ticket_summaries`;



CREATE TABLE `job_ticket_summaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_id` int(11) DEFAULT NULL,
  `description_id` int(11) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



/*Data for the table `job_ticket_summaries` */



/*Table structure for table `job_tickets` */



DROP TABLE IF EXISTS `job_tickets`;



CREATE TABLE `job_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_ticket_desc` varchar(100) DEFAULT NULL,
  `created` varchar(100) DEFAULT NULL,
  `modified` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



/*Data for the table `job_tickets` */



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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



/*Data for the table `tickets` */



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;

/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

