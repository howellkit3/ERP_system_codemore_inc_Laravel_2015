# ************************************************************
# Sql Patch
# Version 0.1
# 
# @created by jRr
# @date April 23, 2015
#
# Host: koufucolorprinting.com (MySQL 5.5.41-cll-lve)
# Database: dev_koufu_system
# Generation Time: 2015-04-23 03:59:41 +0000
#
# NOTE: PLEASE FOLLOW THE FORMAT
# ************************************************************

#NOTE: SELECT KOUFU_SYSTEM DATABASE ----

/** jRr added this 04/27/2015 11:22AM */
CREATE TABLE IF NOT EXISTS `sub_processes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `process_id` INT(11) NULL DEFAULT NULL,
  `name` VARCHAR(80) NULL DEFAULT NULL,
  `created_by` INT(11) NULL DEFAULT NULL COMMENT '	',
  `modified_by` INT(11) NULL DEFAULT NULL,
  `created` TIMESTAMP NULL DEFAULT NULL,
  `modified` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;


#NOTE: SELECT KOUFU_SALE DATABASE ----

/** jRr added this 04/28/2015 05:26AM */
ALTER TABLE `addresses` 
CHANGE COLUMN `type` `type` VARCHAR(60) NULL DEFAULT NULL;

ALTER TABLE `contacts` 
CHANGE COLUMN `type` `type` VARCHAR(60) NULL DEFAULT NULL;

ALTER TABLE `emails` 
CHANGE COLUMN `type` `type` VARCHAR(60) NULL DEFAULT NULL;

DROP TABLE `item_category_holders`;
DROP TABLE `item_type_holders`;


#NOTE: SELECT KOUFU SYSTEM DATABASE ----
/** jRr added this 05/05/2015 03:58PM */
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NULL DEFAULT NULL,
  `created_by` INT(11) NULL DEFAULT NULL COMMENT '	',
  `modified_by` INT(11) NULL DEFAULT NULL,
  `created` TIMESTAMP NULL DEFAULT NULL,
  `modified` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

#NOTE: SELECT KOUFU SALE DATABASE ----
ALTER TABLE `quotation_item_details` 
ADD COLUMN `quantity_unit_id` INT(11) NULL DEFAULT NULL AFTER `quantity`,
ADD COLUMN `unit_price_currency_id` INT(11) NULL DEFAULT NULL AFTER `unit_price`

#NOTE: SELECT KOUFU SALE DATABASE ----
/** Aldrin added this 05/06/2015 11:13AM */
ALTER TABLE `quotations`  ADD `status` TEXT NULL  AFTER `currency`;

#NOTE: SELECT KOUFU SYSTEM DATABASE ----
/** bien added this 05/08/2015  */
ALTER TABLE `koufu_system`.`payment_term_holders`     CHANGE `name` `name` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ;

#NOTE: SELECT KOUFU SYSTEM DATABASE ----
/** jRr added this 05/11/2015  */
ALTER TABLE `koufu_system`.`users` ADD COLUMN `role_id` INT NULL AFTER `uuid`;

CREATE TABLE `roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(120) DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `updated_by` INT(11) DEFAULT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1;

CREATE TABLE `permissions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(120) DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `updated_by` INT(11) DEFAULT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1;

CREATE TABLE `roles_permissions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `role_id` INT(11) DEFAULT NULL,
  `permission_id` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1;

#NOTE: SELECT KOUFU SALE DATABASE ----
/** bien added this 05/14/2015  */
ALTER TABLE `approvers`     ADD COLUMN `created_by` INT(11) NULL AFTER `is_approved`,     ADD COLUMN `modified_by` INT(11) NULL AFTER `created_by`,     ADD COLUMN `created` TIMESTAMP NULL AFTER `modified_by`,     ADD COLUMN `modified` TIMESTAMP NULL AFTER `created`,    CHANGE `approver_id` `user_id` INT(11) NULL ;
ALTER TABLE `quotation_item_details`     ADD COLUMN `unit_price_unit_id` INT(11) NULL AFTER `unit_price`;


#NOTE: SELECT KOUFU SALE DATABASE ----
/** bien added this 05/26/2015  */
CREATE TABLE `product_specification_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `foreign_key` int(11) DEFAULT NULL,
  `order` int(5) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` TIMESTAMP NULL DEFAULT NULL,
  `modified` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

CREATE TABLE `product_specification_labels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_specification_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` TIMESTAMP NULL DEFAULT NULL,
  `modified` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

CREATE TABLE `product_specification_parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_specification_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `material` varchar(80) DEFAULT NULL,
  `part` varchar(80) DEFAULT NULL,
  `rate` varchar(80) DEFAULT NULL,
  `size1` varchar(80) DEFAULT NULL,
  `size2` varchar(80) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `quantity_unit_id` int(11) DEFAULT NULL,
  `paper_quantity` int(11) DEFAULT NULL,
  `color` varchar(80) DEFAULT NULL,
  `outs1` int(11) DEFAULT NULL,
  `outs2` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` TIMESTAMP NULL DEFAULT NULL,
  `modified` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

CREATE TABLE `product_specification_processes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_specification_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` TIMESTAMP NULL DEFAULT NULL,
  `modified` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

CREATE TABLE `product_specification_process_holders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_specification_process_id` int(11) DEFAULT NULL,
  `process_id` int(11) DEFAULT NULL,
  `sub_process_id` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` TIMESTAMP NULL DEFAULT NULL,
  `modified` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

#NOTE: SELECT KOUFU SALE DATABASE ----
/** howell kit added this 05/28/2015  */

ALTER TABLE `client_order_delivery_schedules`    ADD COLUMN `allowance` VARCHAR(30) NULL AFTER `quantity`;
ALTER TABLE `client_order_delivery_schedules`    ADD COLUMN `delivery_type` VARCHAR(30) NULL AFTER `client_order_id`;

#NOTE: SELECT KOUFU SALE DATABASE ----
/** bien  added this 05/29/2015  */

ALTER TABLE `koufu_sale`.`client_order_delivery_schedules`     ADD COLUMN `uuid` INT(11) NULL AFTER `id`;

#NOTE: SELECT KOUFU DELIVERY DATABASE ----
/** bien  added this 05/29/2015  */

ALTER TABLE `koufu_delivery`.`deliveries` DROP COLUMN `description`,    CHANGE `sales_order_id` `schedule_uuid` INT(11) NULL ,     CHANGE `delivery_details_id` `clients_order_id` INT(11) NULL ,     CHANGE `modified` `modified` TIMESTAMP NULL ,     CHANGE `created` `created` TIMESTAMP NULL ;

#NOTE: SELECT KOUFU SALE DATABASE ----
/** bien  added this 06/03/2015  */
RENAME TABLE `koufu_sale`.`product_specification_labels` TO `koufu_sale`.`product_specification_components`;

#NOTE: SELECT KOUFU delivery_type DATABASE ----
/** howell kit added this 06/05/2015  */
ALTER TABLE `koufu_delivery`.`deliveries` ADD COLUMN `dr_uuid` INT(11) NULL AFTER `id`;

ALTER TABLE `koufu_delivery`.`delivery_details` ADD COLUMN `schedule` TIMESTAMP NULL AFTER `id`;
ALTER TABLE `koufu_delivery`.`delivery_details` ADD COLUMN `quantity` VARCHAR(100) NULL AFTER `schedule`;
ALTER TABLE `koufu_delivery`.`delivery_details` ADD COLUMN `location` VARCHAR(200) NULL AFTER `quantity`;
ALTER TABLE `koufu_delivery`.`delivery_details` ADD COLUMN `delivery_uuid` int(11) AFTER `id`;
ALTER TABLE `koufu_delivery`.`delivery_details` ADD COLUMN `created_by` INT(11) AFTER `description`;
ALTER TABLE `koufu_delivery`.`delivery_details` ADD COLUMN `modified_by` INT(11) AFTER `description`;
ALTER TABLE `koufu_delivery`.`delivery_details` ADD COLUMN `remarks` VARCHAR(60) NULL AFTER `description`;

#NOTE: SELECT KOUFU SALE DATABASE ----
/** bien  added this 06/03/2015  */
ALTER TABLE `koufu_sale`.`product_specifications`     ADD COLUMN `stock` VARCHAR(50) NULL AFTER `quantity_unit_id`;
ALTER TABLE `koufu_sale`.`product_specification_parts`     ADD COLUMN `allowance` VARCHAR(50) NULL AFTER `outs2`;

#NOTE: SELECT KOUFU DELIVERY DATABASE ----
/** HOWELL KIT added this 06/03/2015  */
ALTER TABLE `koufu_delivery`.`delivery_details`  ADD COLUMN `delivery_type` TINYINT(1) NULL AFTER `description`;

CREATE TABLE `delivery_plans` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `dr_uuid` INT(11) DEFAULT NULL,
  `status` VARCHAR(30) DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  `created` TIMESTAMP NULL DEFAULT NULL,
  `modified` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

ALTER TABLE `koufu_delivery`.`delivery_plans` ADD COLUMN  `schedule_uuid` INT(11) NULL AFTER `dr_uuid`;
ALTER TABLE `koufu_delivery`.`delivery_plans` ADD COLUMN  `client_order_id` INT(11) NULL AFTER `schedule_uuid`;

#NOTE: SELECT KOUFU DELIVERY DATABASE ----
/** HOWELL KIT added this 06/10/2015  */
ALTER TABLE `koufu_delivery`.`delivery_details` DROP COLUMN `description` ;
ALTER TABLE `koufu_delivery`.`delivery_details` ADD COLUMN  `status` VARCHAR(30) NULL AFTER `delivery_type`;
ALTER TABLE `koufu_delivery`.`delivery_details` ADD COLUMN  `remaining_quantity` INT(11) NULL AFTER `quantity`;

#NOTE: SELECT KOUFU DELIVERY DATABASE ----
/** HOWELL KIT added this 06/11/2015  */
ALTER TABLE `koufu_delivery`.`delivery_details`  CHANGE `remaining_quantity` `delivered_quantity` INT(11) NULL;

#NOTE: SELECT KOUFU ACCOUNTING DATABASE ----
/** bien added this 06/15/2015  */
DROP TABLE IF EXISTS `sales_invoices`;

CREATE TABLE `sales_invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_invoice_no` varchar(100) DEFAULT NULL,
  `dr_uuid` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `koufu_accounting`.`sales_invoices`     ADD COLUMN `status` INT(1) NULL AFTER `dr_uuid`;

ALTER TABLE `koufu_accounting`.`sales_invoices`     CHANGE `status` `statement_no` varchar(100) NULL ;

ALTER TABLE `koufu_accounting`.`sales_invoices`     ADD COLUMN `status` INT(1) NULL AFTER `statement_no`;

#NOTE: SELECT KOUFU DELIVERY DATABASE ----
/** howell kit added this 06/15/2015  */
CREATE TABLE `transmittals` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tr_uuid` INT(11) DEFAULT NULL,
  `dr_uuid` INT(11) DEFAULT NULL,
  `quantity`  VARCHAR(30) DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  `created` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

ALTER TABLE `koufu_delivery`.`transmittals` ADD COLUMN `contact_person` VARCHAR(30) NULL AFTER `dr_uuid`;
ALTER TABLE `koufu_delivery`.`transmittals` ADD COLUMN `remarks` VARCHAR(60) NULL AFTER `quantity`;

#NOTE: SELECT KOUFU ACCOUNTING DATABASE ----
/** bien added this 06/15/2015  */
ALTER TABLE `koufu_sale`.`companies`     ADD COLUMN `short_name` VARCHAR(80) NULL AFTER `company_name`;
ALTER TABLE `koufu_accounting`.`sales_invoices`     CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT,     CHANGE `sales_invoice_no` `sales_invoice_no` INT(6) NOT NULL,     CHANGE `dr_uuid` `dr_uuid` INT(11) NULL ,     CHANGE `statement_no` `statement_no` INT(6) NULL ,     CHANGE `status` `status` INT(1) NULL ,     CHANGE `created_by` `created_by` INT(11) NULL ,     CHANGE `modified_by` `modified_by` INT(11) NULL ;
ALTER TABLE `koufu_accounting`.`sales_invoices`     CHANGE `statement_no` `statement_no` VARCHAR(6) NULL ;

#NOTE: SELECT KOUFU DELIVERY DATABASE ----
/** howell kit added this 07/02/2015  */

CREATE TABLE `delivery_receipts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `dr_uuid` INT(11) DEFAULT NULL,
  `quantity`  VARCHAR(30) DEFAULT NULL,
  `remarks` VARCHAR(60),
  `printed_by` INT(11) DEFAULT NULL,
  `approved_by` INT(11) DEFAULT NULL,
  `print` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

ALTER TABLE `koufu_delivery`.`delivery_receipts` ADD COLUMN `schedule` VARCHAR(60) NULL AFTER `dr_uuid`;
ALTER TABLE `koufu_delivery`.`delivery_receipts` ADD COLUMN `location` VARCHAR(60) NULL AFTER `quantity`;

ALTER TABLE `delivery_receipts` 
CHANGE COLUMN `print` `printed` TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE `koufu_delivery`.`delivery_receipts` ADD COLUMN `type` VARCHAR(60) NULL AFTER `location`;

#NOTE: SELECT KOUFU SYSTEM DATABASE ----
/** bien added this 07/03/2015  */

CREATE TABLE `assistants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 `modified` TIMESTAMP NOT NULL DEFAULT  '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

insert  into `assistants`(`id`,`full_name`,`created_by`,`modified_by`,`created`,`modified`) values (1,'arjay austria',1,1,'2015-07-03 11:23:22','2015-07-02 09:52:01'),(2,'jonald fabie',1,1,'2015-07-03 11:22:25','2015-07-03 11:22:25'),(3,'reymark besana',1,1,'2015-07-03 11:23:44','2015-07-03 11:22:25'),(4,'mark darril cruz',1,1,'2015-07-03 11:22:25','2015-07-03 11:22:25'),(5,'alrin osinsao',1,1,'2015-07-03 11:22:25','2015-07-03 11:22:25'),(6,'walter mirabueno',1,1,'2015-07-03 11:24:16','2015-07-03 11:22:25'),(7,'christopher naraja',1,1,'2015-07-03 11:22:25','2015-07-03 11:22:25');

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 `modified` TIMESTAMP NOT NULL DEFAULT  '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

insert  into `drivers`(`id`,`full_name`,`created_by`,`modified_by`,`created`,`modified`) values (1,'nicanor sulit',1,1,'2015-07-03 11:22:55','2015-07-03 11:22:55'),(2,'rene azares',1,1,'2015-07-03 11:22:55','2015-07-03 11:22:55'),(3,'allan corona',1,1,'2015-07-03 11:22:55','2015-07-03 11:22:55'),(4,'vincent alvarado',1,1,'2015-07-03 11:22:55','2015-07-03 11:22:55');

CREATE TABLE `gate_passes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `foreign_key` int(11) DEFAULT NULL,
  `truck_id` int(11) DEFAULT NULL,
  `name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `remarks` text COLLATE utf8_bin,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` TIMESTAMP NOT NULL DEFAULT  '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `gate_pass_assistants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `helper_id` int(11) DEFAULT NULL,
  `gate_pass_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 `modified` TIMESTAMP NOT NULL DEFAULT  '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `trucks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `truck_no` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

insert  into `trucks`(`id`,`truck_no`,`created_by`,`modified_by`,`created`,`modified`) values (1,'nqx 893',1,1,'2015-07-03 11:22:55','2015-07-02 09:52:01'),(2,'VDL 679',1,1,'2015-07-03 11:22:55','2015-07-02 09:52:01'),(3,'ZLL 773',1,1,'2015-07-03 11:22:56','2015-07-02 09:52:01'),(4,'RJN 204',1,1,'2015-07-03 11:22:57','2015-07-02 09:52:01'),(5,'POT 216',1,1,'2015-07-03 11:22:57','2015-07-02 09:52:01'),(6,'XPB 842',1,1,'2015-07-03 11:22:58','2015-07-02 09:52:01'),(7,'NOO 901',1,1,'2015-07-03 11:22:58','2015-07-02 09:52:01'),(8,'AAA 9592',1,1,'2015-07-03 11:22:59','2015-07-02 09:52:01');


#NOTE: SELECT KOUFU DELIVERY DATABASE ----
/** howell kit added this 07/03/2015  */

ALTER TABLE `koufu_delivery`.`transmittals` ADD COLUMN `type` VARCHAR(60) NULL AFTER `quantity`;

#NOTE: SELECT KOUFU SYSTEM DATABASE ----
/** bien added this 07/07/2015  */

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(80) DEFAULT NULL,
  `description` text,
  `website` varchar(255) DEFAULT NULL,
  `tin` varchar(250) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#NOTE: SELECT KOUFU PURCHASING DATABASE ----
/** bien added this 07/08/2015  */

DROP TABLE IF EXISTS `contact_people`;

CREATE TABLE `supplier_contact_people` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` INT(11) DEFAULT NULL,
  `prefix` VARCHAR(45) DEFAULT NULL,
  `firstname` VARCHAR(50) DEFAULT NULL,
  `middlename` VARCHAR(50) DEFAULT NULL,
  `lastname` VARCHAR(50) DEFAULT NULL,
  `position` VARCHAR(120) DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  `created` TIMESTAMP NULL DEFAULT NULL,
  `modified` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;


#NOTE: SELECT KOUFU SYSTEM DATABASE ----
/** bien added this 07/09/2015  */

insert  into `status_field_holders`(`id`,`status`,`created_by`,`modified_by`,`created`,`modified`) values (1,'Approved',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(2,'Incomplete',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(3,'Delivered',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(4,'Completed',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(5,'Terminate',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(6,'Pending',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(7,'Due',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03');

#NOTE: SELECT KOUFU DELIVERY DATABASE ----
/** howellkit added this 07/09/2015  */

ALTER TABLE `koufu_delivery`.`delivery_details` DROP COLUMN `status`;
ALTER TABLE `koufu_delivery`.`delivery_details` ADD COLUMN  `status` INT(11) NULL AFTER `delivery_type`;

#NOTE: SELECT KOUFU PURCHASING DATABASE ----
/** howellkit added this 07/10/2015 -codemark for koufu- */  

CREATE TABLE `requests` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `uuid` INT(11) DEFAULT NULL,
  `pur_type_id` INT(11) DEFAULT NULL,
  `status_id` INT(11) DEFAULT NULL,
  `remarks` VARCHAR(60) DEFAULT NULL,
  `created` TIMESTAMP NULL DEFAULT NULL,
  `modified` TIMESTAMP NULL DEFAULT NULL,
  `prepared_by` INT(11) DEFAULT NULL,
  `approved_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

CREATE TABLE `purchasing_items` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `model` VARCHAR(30) DEFAULT NULL,
  `foreign_key` INT(11) DEFAULT NULL,
  `item_group_id` INT(11) DEFAULT NULL,
  `size1` VARCHAR(80) DEFAULT NULL,
  `size1_unit_id` INT(11) DEFAULT NULL,
  `size2` VARCHAR(80) DEFAULT NULL,
  `size2_unit_id` INT(11) DEFAULT NULL,
  `size3` VARCHAR(80) DEFAULT NULL,
  `size3_unit_id` INT(11) DEFAULT NULL,
  `quantity` INT(11) DEFAULT NULL,
  `quantity_unit_id` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

CREATE TABLE `purchasing_types` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) DEFAULT NULL,
  `description` TEXT,
  `created` DATETIME NOT NULL,
  `modified` DATETIME NOT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

#NOTE: SELECT KOUFU PURCHASING DATABASE ----
/** bien added this 07/10/2015  */

ALTER TABLE `koufu_system`.`gate_passes`  CHANGE `foreign_key` `ref_uuid` VARCHAR(250) NULL , CHANGE `modified` `modified` TIMESTAMP NOT NULL;
ALTER TABLE `koufu_system`.`gate_pass_assistants`     CHANGE `gate_pass_id` `ref_uuid` VARCHAR(250) NULL ,     CHANGE `modified` `modified` TIMESTAMP NOT NULL;

#NOTE: SELECT KOUFU PURCHASING DATABASE ----
/** howellkit added this 07/10/2015  */

ALTER TABLE `koufu_purchasing`.`requests`  ADD COLUMN  `name` VARCHAR(80) NULL AFTER `uuid`;

#NOTE: SELECT KOUFU SYSTEM DATABASE ----
/** howellkit added this 07/13/2015  */
insert  into `status_field_holders`(`id`,`status`,`created_by`,`modified_by`,`created`,`modified`) values (8,'Waiting',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03');

#NOTE: SELECT KOUFU SYSTEM DATABASE ----
/** bien added this 07/15/2015  */
INSERT INTO `roles` (`id`, `name`, `created_by`, `updated_by`, `created`, `modified`)
VALUES
  (1,'Super Admin',2,2,'2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (2,'CEO',2,2,'2015-05-12 10:21:48','2015-07-14 15:17:38'),
  (3,'Sales Supervisor',2,2,'2015-05-12 10:22:01','2015-07-14 17:14:29'),
  (4,'Warehouse Supervisor',2,2,'2015-05-12 10:22:22','2015-07-14 17:14:49'),
  (5,'Delivery Staff',2,2,'2015-05-12 10:22:22','2015-07-15 09:00:33'),
  (6,'Accounting Head',2,2,'2015-07-14 17:15:24','2015-07-14 17:15:24'),
  (7,'Purchasing Supervisor',2,2,'2015-07-14 17:15:49','2015-07-14 17:15:49'),
  (8,'Sales Staff',2,2,'2015-07-14 17:16:17','2015-07-14 17:16:17'),
  (9,'Receivable Staff',2,2,'2015-07-14 17:17:06','2015-07-14 17:17:06'),
  (10,'Payable Staff',2,2,'2015-07-14 17:17:22','2015-07-14 17:17:22'),
  (11,'Accounting Staff',2,2,'2015-07-14 17:17:42','2015-07-14 17:17:42');

INSERT INTO `roles_permissions` (`id`, `role_id`, `permission_id`)
VALUES
  (1,1,1),
  (2,1,2),
  (3,1,3),
  (4,1,4),
  (5,8,1),
  (6,8,2),
  (7,8,3),
  (8,3,1),
  (9,3,2),
  (10,3,3),
  (11,3,4);

#NOTE: SELECT KOUFU Re ----
/** aldrin added this 07/14/2015  */
#NOTE: SELECT KOUFU HR DATABASE ----
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `emails` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;


#NOTE: SELECT KOUFU SYSTEM DATABASE ----
/** howellkit added this 07/14/2015  */
INSERT  INTO `roles`(`id`,`name`,`created_by`,`updated_by`,`created`,`modified`) VALUES (1,'C.E.O.',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(2,'Sales Supervisor',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(3,'Sales Staff',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(4,'Delivery Staff',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(5,'Purchasing Staff',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(6,'Accounting Head',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(7,'Payable Staff',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(8,'Receivable Staff',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(9,'Accounting  Staff',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03')
,(10,'Warehouse Staff',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(11,'Human Resource Staff',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03');


#NOTE: SELECT KOUFU SYSTEM DATABASE ----
/** bien added this 07/15/2015  */
INSERT INTO `roles` (`id`, `name`, `created_by`, `updated_by`, `created`, `modified`)
VALUES
  (1,'Super Admin',2,2,'2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (2,'CEO',2,2,'2015-05-12 10:21:48','2015-07-14 15:17:38'),
  (3,'Sales Supervisor',2,2,'2015-05-12 10:22:01','2015-07-14 17:14:29'),
  (4,'Warehouse Supervisor',2,2,'2015-05-12 10:22:22','2015-07-14 17:14:49'),
  (5,'Delivery Staff',2,2,'2015-05-12 10:22:22','2015-07-15 09:00:33'),
  (6,'Accounting Head',2,2,'2015-07-14 17:15:24','2015-07-14 17:15:24'),
  (7,'Purchasing Supervisor',2,2,'2015-07-14 17:15:49','2015-07-14 17:15:49'),
  (8,'Sales Staff',2,2,'2015-07-14 17:16:17','2015-07-14 17:16:17'),
  (9,'Receivable Staff',2,2,'2015-07-14 17:17:06','2015-07-14 17:17:06'),
  (10,'Payable Staff',2,2,'2015-07-14 17:17:22','2015-07-14 17:17:22'),
  (11,'Accounting Staff',2,2,'2015-07-14 17:17:42','2015-07-14 17:17:42');

INSERT INTO `roles_permissions` (`id`, `role_id`, `permission_id`)
VALUES
  (1,1,1),
  (2,1,2),
  (3,1,3),
  (4,1,4),
  (5,8,1),
  (6,8,2),
  (7,8,3),
  (8,3,1),
  (9,3,2),
  (10,3,3),
  (11,3,4);
#NOTE: SELECT KOUFU Re ----
/** aldrin added this 07/16/2015  */

ALTER TABLE `employee_additional_informations`  ADD `languages` VARCHAR(255) NULL  AFTER `blood`;


CREATE TABLE IF NOT EXISTS `toolings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `tools_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `pay` varchar(255) NOT NULL,
  `status` varchar(45) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `tools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

#NOTE: SELECT KOUFU DELIVERY DATABASE ----
/** howellkit added this 07/14/2015  */


ALTER TABLE `dev_koufu_delivery`.`deliveries` ADD COLUMN `from` INT(11) NULL AFTER `dr_uuid`;

#NOTE: SELECT KOUFU PURCHASING DATABASE ----

ALTER TABLE `dev_koufu_purchasing`.`purchasing_items`  CHANGE `item_group_id` `request_uuid` INT(11) NULL;

#NOTE: SELECT KOUFU PURCHASING DATABASE ----
/** howellkit added this 07/20/2015  */

INSERT INTO `purchasing_types` (`id`, `name`, `description`, `created`, `modified`, `created_by`, `modified_by`)
VALUES
  (1,'By Focus',' ','2015-05-12 10:20:35','2015-05-12 11:26:22',1,1),
  (2,'Basic P.O.',' ','2015-05-12 10:20:35','2015-05-12 11:26:22',1,1),
  (3,'Maintainances',' ','2015-05-12 10:20:35','2015-05-12 11:26:22',1,1),
  (4,'Stock',' ','2015-05-12 10:20:35','2015-05-12 11:26:22',1,1),
  (5,'Emergency',' ','2015-05-12 10:20:35','2015-05-12 11:26:22',1,1),
  (6,'Stock',' ','2015-05-12 10:20:35','2015-05-12 11:26:22',1,1),
  (7,'Other',' ','2015-05-12 10:20:35','2015-05-12 11:26:22',1,1);

#NOTE: SELECT KOUFU PURCHASING DATABASE ----
/** howellkit added this 07/20/2015  */

  CREATE TABLE IF NOT EXISTS `purchase_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` INT(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `po_number` VARCHAR(120) DEFAULT NULL,
  `request_id` int(11) DEFAULT NULL,
  `name` varchar(60) NOT NULL,
  `remarks` varchar(60) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

#NOTE: SELECT KOUFU PURCHASING DATABASE ----
/** bien added this 07/21/2015  */
ALTER TABLE `purchase_orders` ADD `delivery_date` DATETIME  NULL  AFTER `modified`;
ALTER TABLE `purchase_orders` ADD `payment_term` INT(11)  NULL  DEFAULT NULL  AFTER `modified`;

#NOTE: SELECT KOUFU DELIVERY DATABASE ----
/** howell kit added this 07/22/2015  */

ALTER TABLE `deliveries` ADD `company_id` INT(11)  NULL  AFTER `clients_order_id`;

#NOTE: SELECT KOUFU SYSTEM DATABASE ----

ALTER TABLE `koufu_system`.`gate_passes`  CHANGE `foreign_key` `ref_uuid` INT(11) NULL;
ALTER TABLE `koufu_system`.`gate_passes` DROP COLUMN `name`;
ALTER TABLE `koufu_system`.`gate_passes` DROP COLUMN `remarks`;
ALTER TABLE `koufu_system`.`gate_passes` DROP COLUMN `driver_id`;
ALTER TABLE `koufu_system`.`gate_passes` DROP COLUMN `truck_id`;
ALTER TABLE `koufu_system`.`gate_passes` DROP COLUMN `created_by`;
ALTER TABLE `koufu_system`.`gate_passes` DROP COLUMN `created`;
ALTER TABLE `koufu_system`.`gate_passes` DROP COLUMN `modified`;
ALTER TABLE `koufu_system`.`gate_passes` DROP COLUMN `modified_by`;

ALTER TABLE `gate_passes` ADD `gatepass_truck_id` INT(11)  NULL  AFTER `ref_uuid`;

CREATE TABLE IF NOT EXISTS `gate_pass_trucks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `truck_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `remarks` varchar(60) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `koufu_system`.`gate_pass_assistants` DROP COLUMN `gate_pass_id`;
ALTER TABLE `koufu_system`.`gate_pass_assistants` DROP COLUMN `created_by`;
ALTER TABLE `koufu_system`.`gate_pass_assistants` DROP COLUMN `created`;
ALTER TABLE `koufu_system`.`gate_pass_assistants` DROP COLUMN `modified`;
ALTER TABLE `koufu_system`.`gate_pass_assistants` DROP COLUMN `modified_by`;
ALTER TABLE `gate_pass_assistants` ADD `gatepass_truck_id` INT(11)  NULL  AFTER `helper_id`;

#NOTE: SELECT KOUFU PURCHASING DATABASE ----
/** bien added this 07/22/2015  */
ALTER TABLE `purchase_orders` ADD `status` INT(11)  NULL  DEFAULT NULL  AFTER `modified`;
ALTER TABLE `purchase_orders` ADD `version` INT(11)  NULL  DEFAULT NULL  AFTER `status`;
ALTER TABLE `purchase_orders` MODIFY COLUMN `contact_id` INT(11) DEFAULT NULL AFTER `version`;
ALTER TABLE `purchase_orders` MODIFY COLUMN `contact_person_id` INT(11) DEFAULT NULL AFTER `contact_id`;

#NOTE: SELECT KOUFU PURCHASING DATABASE ----
/** bien added this 07/23/2015  */
ALTER TABLE `purchasing_items` ADD `unit_price` DOUBLE  NULL  DEFAULT NULL  AFTER `quantity_unit_id`;
ALTER TABLE `purchasing_items` ADD `unit_price_unit_id` INT(11)  NULL  DEFAULT NULL  AFTER `unit_price`;

#NOTE: SELECT KOUFU PURCHASING DATABASE ----
/** bien added this 07/24/2015  */
CREATE TABLE `request_items` (   `id` int(11) NOT NULL AUTO_INCREMENT,   `model` varchar(30) DEFAULT NULL,   `foreign_key` int(11) DEFAULT NULL,   `request_uuid` int(11) DEFAULT NULL,   `size1` varchar(80) DEFAULT NULL,   `size1_unit_id` int(11) DEFAULT NULL,   `size2` varchar(80) DEFAULT NULL,   `size2_unit_id` int(11) DEFAULT NULL,   `size3` varchar(80) DEFAULT NULL,   `size3_unit_id` int(11) DEFAULT NULL,   `quantity` int(11) DEFAULT NULL,   `quantity_unit_id` int(11) DEFAULT NULL,   `unit_price` double DEFAULT NULL,   `unit_price_unit_id` int(11) DEFAULT NULL,   PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1;



#NOTE: SELECT KOUFU Human Resource DATABASE ----
/** aldrin added this 07/23/2015  */
  CREATE TABLE IF NOT EXISTS `breaktimes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

  CREATE TABLE IF NOT EXISTS `work_shifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `is_default` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


#NOTE: SELECT KOUFU Human Resource DATABASE ----
/** aldrin added this 07/24/2015  */

  CREATE TABLE IF NOT EXISTS `work_shift_breaks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `worshift_id` int(11) NOT NULL,
  `break_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



