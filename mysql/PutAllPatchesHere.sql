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



#NOTE: SELECT KOUFU Re ----
/** aldrin added this 07/14/2015 all tables are here  */
#NOTE: SELECT KOUFU HR DATABASE ----


CREATE TABLE IF NOT EXISTS `absences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `from` datetime NOT NULL,
  `to` datetime NOT NULL,
  `total_time` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(11) NOT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state_province` varchar(255) DEFAULT NULL,
  `zipcode` varchar(45) DEFAULT NULL,
  `languages` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

CREATE TABLE IF NOT EXISTS `attendances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `in` time DEFAULT NULL,
  `out` time DEFAULT NULL,
  `notes` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;



CREATE TABLE IF NOT EXISTS `contacts` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=152 ;


CREATE TABLE IF NOT EXISTS `contact_people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `prefix` varchar(45) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_idx` (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;



CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `specification` text,
  `notes` text,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;



CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `code` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;



CREATE TABLE IF NOT EXISTS `employee_additional_informations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `height` varchar(45) NOT NULL,
  `weight` varchar(45) NOT NULL,
  `gender` varchar(45) NOT NULL,
  `blood` varchar(45) NOT NULL,
  `languages` varchar(255) DEFAULT NULL,
  `skills` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;


CREATE TABLE IF NOT EXISTS `government_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `agency` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=173 ;



CREATE TABLE IF NOT EXISTS `holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date NOT NULL,
  `year` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;



CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `specification` text,
  `notes` text,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `timekeeps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `type` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;



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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;



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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


CREATE TABLE IF NOT EXISTS `work_schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `work_shift_id` int(11) NOT NULL,
  `day` datetime NOT NULL,
  `type` varchar(255) NOT NULL,
  `seq` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;


CREATE TABLE IF NOT EXISTS `work_shift_breaks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `workshift_id` int(11) NOT NULL,
  `breaktime_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

/** howell kit added this 07/30/2015  */

CREATE TABLE IF NOT EXISTS `cause_memos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `uuid` INT(11) DEFAULT NULL,
  `employee_id` INT(11) DEFAULT NULL,
  `description` VARCHAR(100) DEFAULT NULL,
  `violation_id` INT(11) DEFAULT NULL,
  `status_id` INT(11) DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  `created` TIMESTAMP NULL DEFAULT NULL,
  `modified` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

CREATE TABLE IF NOT EXISTS `violations` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) DEFAULT NULL,
  `disciplinary_action_id` INT(11) DEFAULT NULL,
  `description` VARCHAR(100) DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  `created` TIMESTAMP NULL DEFAULT NULL,
  `modified` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

CREATE TABLE IF NOT EXISTS `disciplinary_actions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  `created` TIMESTAMP NULL DEFAULT NULL,
  `modified` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

ALTER TABLE `koufu_human_resource`.`disciplinary_actions` ADD COLUMN `violation_id` INT NULL AFTER `name`;

ALTER TABLE `absences` CHANGE `total_time` `total_time` TIME NOT NULL;

/** aldrin added this 07/30/2015 all tables are here  */
ALTER TABLE `work_shifts`  ADD `overtime_id` INT NULL  AFTER `id`;
ALTER TABLE `work_schedules`  ADD `overtime_id` INT NULL  AFTER `foreign_key`;

CREATE TABLE IF NOT EXISTS `overtimes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `from` datetime NOT NULL,
  `to` datetime NOT NULL,
  `day_type_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `overtimes`  ADD `status` VARCHAR(255) NOT NULL  AFTER `remarks`,  ADD `approved_by` INT NOT NULL  AFTER `status`,  ADD `audit_date` DATETIME NOT NULL  AFTER `approved_by`,  ADD `audit_by` INT NOT NULL  AFTER `audit_date`;
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


ALTER TABLE `government_records` CHANGE `agency` `agency_id` INT(11)  NOT NULL;

CREATE TABLE `agencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `field` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/** howell kit added this 07/22/2015  */

INSERT INTO `departments` (`id`, `name`, `description`, `specification`,`notes`,`created_by`,`modified_by`, `created`, `modified`)
VALUES
  (1,'Sales','Sales','Sales','Sales','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (2,'Purchasing','Purchasing','Purchasing','Purchasing','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (3,'Delivery','Delivery','Delivery','Delivery','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (4,'Production','Production','Production','Production','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (5,'Accounting','Accounting','Accounting','Accounting','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (6,'Human Resource','Human Resource','Human Resource','Human Resource','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (7,'Warehouse','Warehouse','Warehouse','Warehouse','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22');

INSERT INTO `positions` (`id`, `name`, `description`,`notes`,`created_by`,`modified_by`, `created`, `modified`)
VALUES
  (1,'Sales Staff','Sales Staff','Sales Staff','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (2,'Sales Supervisor','Sales Supervisor','Sales Supervisor','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (3,'Delivery Staff','Delivery Staff','Delivery Staff','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (4,'Purchasing Staff','Purchasing Staff','Purchasing Staff','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (5,'Accounting Staff','Accounting Staff','Accounting Staff','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (6,'Accounting Payables','Accounting Payables','Accounting Payables','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (7,'Accounting Receivables','Accounting Receivables','Accounting Receivables','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (8,'Accounting Head','Accounting  Head','Accounting  Head','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (9,'Human Resource Staff','Human Resource Staff','Human Resource Staff','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (10,'Production Staff','Production Staff','Production Staff','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (11,'Warehouse Staff','Warehouse Staff','Warehouse Staff','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22'),
  (12,'CEO','CEO','CEO','1','1','2015-05-12 10:20:35','2015-05-12 11:26:22');

  ALTER TABLE `cause_memos`  ADD `disciplinary_action_id` TEXT NULL  AFTER `violation_id`;
/** bien added this 07/22/2015  */
  CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

  CREATE TABLE `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

  /* august 4 2015 */
  ALTER TABLE `overtimes`  ADD `employee_ids` TEXT NULL  AFTER `to`;
  ALTER TABLE `work_shift_breaks`  ADD `overtime_id` INT(11) NULL  AFTER `workshift_id`;

/* august 5 2015 */
  ALTER TABLE `employees` CHANGE `code` `code` VARCHAR(255) NULL DEFAULT NULL;

  ALTER TABLE `departments`  ADD `prefix` VARCHAR(45) NULL  AFTER `name`;
  
  CREATE TABLE IF NOT EXISTS `daily_infos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `work` varchar(255) NOT NULL,
  `ot` varchar(255) NOT NULL,
  `ob` varchar(255) NOT NULL,
  `night` varchar(255) NOT NULL,
  `night_ot` varchar(255) NOT NULL,
  `leave` varchar(255) NOT NULL,
  `no_work` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `employees`  ADD `date_hired` DATETIME NULL  AFTER `position_id`;

ALTER TABLE `work_schedules` CHANGE `day` `day` VARCHAR(255) NOT NULL;

/** bien added this 08/06/2015   */
ALTER TABLE `attendances` ADD `status` VARCHAR(50)  NULL  DEFAULT NULL  AFTER `modified`;

/** bien added this 08/10/2015   */
ALTER TABLE `employees` ADD `contract_id` INT(11)  NULL  DEFAULT NULL  AFTER `modified`;
ALTER TABLE `employee_additional_informations` ADD `birth_place` VARCHAR(255)  NULL  DEFAULT NULL  AFTER `modified`;

ALTER TABLE `attendances`  ADD `is_holiday` INT NULL  AFTER `type`;

ALTER TABLE `work_schedules`  ADD `holiday` INT(11) NOT NULL DEFAULT '0'  AFTER `type`;

/* end all HR tables */

/** howell kit added this 08/05/2015   */
#NOTE: SELECT KOUFU WAREHOUSE DATABASE ----

CREATE TABLE `received_orders` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `uuid` INT(11) NOT NULL,
  `purchase_order_id` INT(11) DEFAULT NULL,
  `status_id` INT(11) NOT NULL,
  `remarks` TEXT NOT NULL,
  `received_by` INT(11) NOT NULL,
  `approved_by` INT(11) NOT NULL,
  `created` TIMESTAMP NULL DEFAULT NULL,
  `modified` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1;

/** howell kit added this 08/06/2015   */

CREATE TABLE IF NOT EXISTS `received_items` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `received_orders_id` INT(11) DEFAULT NULL,
  `quantity` INT(11) NOT NULL,
  `item_uuid` INT(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `salaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `basic_pay` double DEFAULT '0',
  `overtime` double DEFAULT '0',
  `date` datetime NOT NULL,
  `from` datetime NOT NULL,
  `to` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;


/** howell kit added this 08/08/2015 TO DELIVERY DATABASE */
ALTER TABLE `delivery_details`  ADD `pieces` INT(11) NULL  AFTER `delivered_quantity`;
ALTER TABLE `delivery_details`  ADD `measure` INT(11) NULL  AFTER `pieces`;


/*aldrin brion added this koufu system database 08/12/2015 */
CREATE TABLE IF NOT EXISTS `accounting_sss_ranges` (
  `id` int(11) NOT NULL AUTO_INCREMENT, 
  `range_from` decimal(8,2) NOT NULL,
  `range_to` decimal(8,2) NOT NULL,
  `bounds` decimal(8,2) NOT NULL,
  `credits` decimal(8,2) NOT NULL,
  `employers` decimal(8,2) NOT NULL,
  `employees` decimal(8,2) NOT NULL,
  `employee_compensations` decimal(8,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `accounting_philhealth_ranges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `range_from` decimal(8,2) NOT NULL,
  `range_to` decimal(8,2) NOT NULL,
  `condition` varchar(45) DEFAULT NULL,
  `salary_base` decimal(8,2) NOT NULL,
  `employer` decimal(8,2) NOT NULL,
  `employee` decimal(8,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

ALTER TABLE `accounting_philhealth_ranges`  ADD `condition` VARCHAR(45) NULL  AFTER `range_to`;
ALTER TABLE `deductions` ADD `pay_split` INT NULL AFTER `amount`, ADD `paid_amount` DECIMAL(8,2) NULL AFTER `pay_split`;

ALTER TABLE `attendances`  ADD `leave_id` INT NULL  AFTER `is_holiday`;

/*end -aldrin brion added this 08/12/2015 */

/** howell kit added this 08/08/2015 TO WAREHOUSE DATABASE   */
ALTER TABLE `received_items`  ADD `foreign_key` INT(11) NULL  AFTER `received_orders_id`;
ALTER TABLE `received_items`  ADD `model` VARCHAR(30) DEFAULT NULL AFTER `received_orders_id`;
ALTER TABLE `received_items`  ADD `delivered_order_id` INT(11) NULL  AFTER `received_orders_id`;


/* added 08/13/2015 human resource */

CREATE TABLE IF NOT EXISTS `deductions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `mode` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `reason` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `salary_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `salary_type` varchar(255) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `days` int(11) NOT NULL,
  `total_hour_work` decimal(8,2) NOT NULL,
  `overtime_work` decimal(8,2) NOT NULL,
  `rest_day_work` decimal(8,2) NOT NULL,
  `rest_day_ot` decimal(8,2) NOT NULL,
  `regular_holiday` decimal(8,2) NOT NULL,
  `regular_holiday_work` decimal(8,2) NOT NULL,
  `regular_holiday_ot` decimal(8,2) NOT NULL,
  `regular_rest_work` decimal(8,2) NOT NULL,
  `regular_rest_ot` decimal(8,2) NOT NULL,
  `special_holiday_work` decimal(8,2) NOT NULL,
  `special_holiday_ot` decimal(8,2) NOT NULL,
  `night` decimal(8,2) NOT NULL,
  `leave` decimal(8,2) NOT NULL,
  `ctpa` decimal(8,2) NOT NULL,
  `sea` decimal(8,2) NOT NULL,
  `gross_pay` decimal(8,2) NOT NULL,
  `sss` decimal(8,2) NOT NULL,
  `philhealth` decimal(8,2) NOT NULL,
  `pagibig` decimal(8,2) NOT NULL,
  `wtax` decimal(8,2) NOT NULL,
  `ca_fund` decimal(8,2) NOT NULL,
  `sss_loan` decimal(8,2) NOT NULL,
  `pagibig_loan` decimal(8,2) NOT NULL,
  `uniform` decimal(8,2) NOT NULL,
  `other_1` decimal(8,2) NOT NULL,
  `medical` decimal(8,2) NOT NULL,
  `canteen` decimal(8,2) NOT NULL,
  `bank_loan` decimal(8,2) NOT NULL,
  `other_2` decimal(8,2) NOT NULL,
  `total_deduction` decimal(8,2) NOT NULL,
  `net_pay` decimal(8,2) NOT NULL,
  `allowance` decimal(8,2) NOT NULL,
  `incentives` decimal(8,2) NOT NULL,
  `total_pay` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `salaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `basic_pay` decimal(8,2) DEFAULT '0.00',
  `basic_pay_per_month` decimal(8,2) DEFAULT NULL,
  `ctpa` decimal(8,2) DEFAULT NULL,
  `sea` decimal(8,2) DEFAULT NULL,
  `allowances` decimal(8,2) DEFAULT NULL,
  `overtime` double DEFAULT '0',
  `date` datetime NOT NULL,
  `from` datetime NOT NULL,
  `to` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;



ALTER TABLE `salaries`  ADD `ctpa` DECIMAL(8,2) NULL  AFTER `basic_pay_per_month`,  ADD `sea` DECIMAL(8,2) NULL  AFTER `ctpa`,  ADD `allowances` DECIMAL(8,2) NULL  AFTER `sea`;

ALTER TABLE `salaries`  ADD `employee_salary_type` VARCHAR(255) NULL  AFTER `employee_id`;
/* end human resource */

#NOTE: SELECT KOUFU WAREHOUSE DATABASE ----
/** howellkit added this 08/08/2015  */

INSERT  INTO `status_field_holders`(`id`,`status`,`created_by`,`modified_by`,`created`,`modified`) VALUES (8,'Waiting',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(9,'Executing',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(10,'Replaced',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03');

/** bien added this 08/13/2015 TO HR DATABASE   */
ALTER TABLE `attendances` ADD `overtime_id` INT(11)  NULL  DEFAULT NULL  AFTER `status`;

INSERT  INTO `status_field_holders`(`id`,`status`,`created_by`,`modified_by`,`created`,`modified`) VALUES (8,'Waiting',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(9,'Executing',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(10,'Closed',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(11,'Replaced',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03');

/** bien added this 08/14/2015 TO HR DATABASE   */
CREATE TABLE `employee_educational_backgrounds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `stages` varchar(255) NOT NULL DEFAULT '',
  `degree` varchar(255) DEFAULT NULL,
  `year` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `employee_additional_informations` ADD `status` VARCHAR(255)  NULL  DEFAULT NULL  AFTER `birth_place`;

ALTER TABLE `employee_additional_informations` ADD `spouse` VARCHAR(255)  NULL  DEFAULT NULL  AFTER `status`;

ALTER TABLE `employee_additional_informations` ADD `no_children` VARCHAR(255)  NULL  DEFAULT NULL  AFTER `spouse`;

#NOTE: SELECT KOUFU WAREHOUSE DATABASE ----
/** howellkit added this 08/14/2015  */

ALTER TABLE `received_items` ADD `condition` VARCHAR(30)  NULL  DEFAULT NULL  AFTER `quantity`;
ALTER TABLE `koufu_warehouse`.`received_items` DROP COLUMN `item_uuid` ;

#NOTE: SELECT KOUFU PAyroll DATABASE ----
/** aldrin added this 08/17/2015  */

CREATE TABLE IF NOT EXISTS `amortizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deduction_id` int(11) NOT NULL,
  `payroll_date` date NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `deduction` decimal(8,2) NOT NULL,
  `interest` decimal(8,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `balance` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;


CREATE TABLE IF NOT EXISTS `deductions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `mode` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `reason` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

CREATE TABLE IF NOT EXISTS `salary_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `salary_type` varchar(255) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `days` int(11) NOT NULL,
  `total_hour_work` decimal(8,2) NOT NULL,
  `overtime_work` decimal(8,2) NOT NULL,
  `rest_day_work` decimal(8,2) NOT NULL,
  `rest_day_ot` decimal(8,2) NOT NULL,
  `regular_holiday` decimal(8,2) NOT NULL,
  `regular_holiday_work` decimal(8,2) NOT NULL,
  `regular_holiday_ot` decimal(8,2) NOT NULL,
  `regular_rest_work` decimal(8,2) NOT NULL,
  `regular_rest_ot` decimal(8,2) NOT NULL,
  `special_holiday_work` decimal(8,2) NOT NULL,
  `special_holiday_ot` decimal(8,2) NOT NULL,
  `night` decimal(8,2) NOT NULL,
  `leave` decimal(8,2) NOT NULL,
  `ctpa` decimal(8,2) NOT NULL,
  `sea` decimal(8,2) NOT NULL,
  `gross_pay` decimal(8,2) NOT NULL,
  `sss` decimal(8,2) NOT NULL,
  `philhealth` decimal(8,2) NOT NULL,
  `pagibig` decimal(8,2) NOT NULL,
  `wtax` decimal(8,2) NOT NULL,
  `ca_fund` decimal(8,2) NOT NULL,
  `sss_loan` decimal(8,2) NOT NULL,
  `pagibig_loan` decimal(8,2) NOT NULL,
  `uniform` decimal(8,2) NOT NULL,
  `other_1` decimal(8,2) NOT NULL,
  `medical` decimal(8,2) NOT NULL,
  `canteen` decimal(8,2) NOT NULL,
  `bank_loan` decimal(8,2) NOT NULL,
  `other_2` decimal(8,2) NOT NULL,
  `total_deduction` decimal(8,2) NOT NULL,
  `net_pay` decimal(8,2) NOT NULL,
  `allowance` decimal(8,2) NOT NULL,
  `incentives` decimal(8,2) NOT NULL,
  `total_pay` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/** end */

/** bien added this 08/17/2015 TO HR DATABASE   */
CREATE TABLE `leaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `type_id` int(11) NOT NULL DEFAULT '',
  `from` date NOT NULL,
  `to` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '',
  `remarks` text,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `measures` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) DEFAULT NULL,
  `created` DATETIME NOT NULL,
  `modified` DATETIME NOT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT  INTO `measures`(`id`,`name`,`created_by`,`modified_by`,`created`,`modified`) VALUES (1,'bundle',1,1,'2015-07-03 11:23:22','2015-07-02 09:52:01'),(2,'pack',1,1,'2015-07-03 11:22:25','2015-07-03 11:22:25'),(3,'piece',1,1,'2015-07-03 11:23:44','2015-07-03 11:22:25'),(4,'box',1,1,'2015-07-03 11:22:25','2015-07-03 11:22:25'),(5,'pallet',1,1,'2015-07-03 11:22:25','2015-07-03 11:22:25');
 
/* aldrin added this 8/18/2015 */

CREATE TABLE IF NOT EXISTS `loans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `schedules` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

#NOTE: SELECT KOUFU WAREHOUSE DATABASE ----

CREATE TABLE IF NOT EXISTS `stocks` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `uuid` INT(11) NOT NULL,
  `item_id` INT(11) NOT NULL,
  `supplier_id` INT(11) NOT NULL,
  `size` VARCHAR(20) NOT NULL,
  `size_unit_id` INT(11) NOT NULL,
  `quantity` INT(11) NOT NULL,
  `quantity_unit_id` INT(11) NOT NULL,
  `location_id` INT(11) NOT NULL,
  `remarks` TEXT NOT NULL,
  `created_by` INT(11) NOT NULL,
  `modified_by` INT(11) NOT NULL,
  `created` DATETIME NOT NULL,
  `modified` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


/* aldrin added this 8-19-2015 koufu payroll */

CREATE TABLE IF NOT EXISTS `loans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `schedules` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

CREATE TABLE IF NOT EXISTS `overtime_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day_type_id` int(11) NOT NULL,
  `rates` decimal(8,2) NOT NULL DEFAULT '0.00',
  `overtime` decimal(8,2) NOT NULL DEFAULT '0.00',
  `night_diffrential` decimal(8,2) NOT NULL DEFAULT '0.00',
  `night_defferential_ot` decimal(8,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


CREATE TABLE IF NOT EXISTS `payrolls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `year` year(4) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `range` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text,
  `transaction_date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `data` text,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


/* howell kit added this 8-19-2015 koufu WAREHOUSE */

CREATE TABLE IF NOT EXISTS `in_records` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `remarks` TEXT NOT NULL,
  `storekeeper_id` INT(11) NOT NULL,
  `status_id` INT(11) NOT NULL,
  `created_by` INT(11) NOT NULL,
  `modified_by` INT(11) NOT NULL,
  `created` DATETIME NOT NULL,
  `modified` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `out_records` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `request_id` INT(11) NOT NULL,
  `remarks` TEXT NOT NULL,
  `created_by` INT(11) NOT NULL,
  `modified_by` INT(11) NOT NULL,
  `created` DATETIME NOT NULL,
  `modified` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `item_records` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `type_record` INT(11) NOT NULL,
  `type_record_id` INT(11) NOT NULL,
  `model` VARCHAR(30) NOT NULL,
  `foreign_key` INT(11) NOT NULL,
  `quantity` INT(11) NOT NULL,
  `quantity_unit_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
/** bien added this 08/17/2015 TO HR DATABASE   */
ALTER TABLE `cause_memos` ADD `noted_user_id` INT(11)  NULL  DEFAULT NULL  AFTER `modified`;

/** howell kit added this 08/17/2015 TO WAREHOUSE DATABASE   */
ALTER TABLE `received_items` ADD `original_quantity` INT(11)  NULL  DEFAULT NULL  AFTER `quantity`;
ALTER TABLE `received_items` ADD `reject_quantity` INT(11)  NULL  DEFAULT NULL  AFTER `quantity`;
/** bien added this 08/20/2015 TO Koufu system DATABASE   */
CREATE TABLE `banks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `code` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `remarks` text COLLATE utf8_bin,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `limit` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

CREATE TABLE `dependents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `birth_date` varchar(255) NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `employee_additional_informations` ADD `bank_id` INT(11)  NULL  DEFAULT NULL  AFTER `no_children`;
ALTER TABLE `employee_additional_informations` ADD `bank_account_type` VARCHAR(50)  NULL  DEFAULT NULL  AFTER `bank_id`;
ALTER TABLE `employee_additional_informations` ADD `bank_account_number` VARCHAR(255)  NULL  DEFAULT NULL  AFTER `bank_account_type`;

CREATE TABLE `sections` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `remarks` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

CREATE TABLE `machines` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `no` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `remarks` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

CREATE TABLE `departments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `remarks` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


/** howell kit added this 08/20/2015 TO WAREHOUSE DATABASE   */
ALTER TABLE `stocks` 
CHANGE COLUMN `size` `size1` VARCHAR(30) NULL DEFAULT NULL;

ALTER TABLE `stocks` 
CHANGE COLUMN `size_unit_id` `size1_unit_id` INT(11) NULL DEFAULT NULL;
ALTER TABLE `stocks` ADD `size2` VARCHAR(30)  NULL  DEFAULT NULL  AFTER `size1_unit_id`;
ALTER TABLE `stocks` ADD `size2_unit_id` VARCHAR(30)  NULL  DEFAULT NULL  AFTER `size2`;
ALTER TABLE `stocks` ADD `size3` VARCHAR(30)  NULL  DEFAULT NULL  AFTER `size2_unit_id`;
ALTER TABLE `stocks` ADD `size3_unit_id` VARCHAR(30)  NULL  DEFAULT NULL  AFTER `size3`;
ALTER TABLE `stocks` ADD `model` VARCHAR(35)  NULL  DEFAULT NULL  AFTER `uuid`;
ALTER TABLE `in_records` ADD `received_orders_id` INT(11)  NULL  DEFAULT NULL  AFTER `id`;
/* aldrin added this for HR database 8-24-15 */

--
-- Table structure for table `contributions`
-

CREATE TABLE IF NOT EXISTS `contributions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `schedules` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;


INSERT INTO `contributions` (`id`, `name`, `description`, `schedules`, `created_by`, `modified_by`, `created`, `modified`) VALUES
('', 'SSS', 'desc', '1', 0, 0, '2015-08-24 01:27:47', '2015-08-24 01:40:14'),
('', 'Phil Health', 'descripion', '1', 0, 0, '2015-08-24 01:33:19', '2015-08-24 01:33:19'),
('', 'Pagibig', 'description', '2', 0, 0, '2015-08-24 01:39:52', '2015-08-24 01:39:52'); 

/* end */



/** bien added this 08/24/2015 TO PRODUCTION DATABASE   */
CREATE TABLE `machine_specifications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `machine_id` int(11) DEFAULT NULL,
  `paper_size_wmin` varchar(255) DEFAULT NULL,
  `paper_size_lmin` varchar(255) DEFAULT '',
  `paper_size_wmax` varchar(255) DEFAULT '',
  `paper_size_lmax` varchar(255) DEFAULT NULL,
  `work_area_wmin` varchar(255) DEFAULT NULL,
  `work_area_lmin` varchar(255) DEFAULT NULL,
  `work_area_wmax` varchar(255) DEFAULT NULL,
  `work_area_lmax` varchar(255) DEFAULT NULL,
  `paper_thickness_min` varchar(255) DEFAULT NULL,
  `paper_thickness_max` varchar(255) DEFAULT NULL,
  `machine_speed_min` varchar(255) DEFAULT NULL,
  `machine_speed_max` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/** bien added this 08/24/2015 TO System DATABASE   */
ALTER TABLE `sub_processes` ADD `machine_id` INT(11)  NULL  DEFAULT NULL  AFTER `process_id`;


/**howell kit added this 08/25/2015 TO WAREHOUSE DATABASE   */
DROP TABLE IF EXISTS `delivered_orders`;

CREATE TABLE `delivered_orders` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `received_orders_id` INT(11) DEFAULT NULL,
  `purchase_orders_id` INT(11) DEFAULT NULL,
  `uuid` VARCHAR(30) DEFAULT NULL,
  `status_id` INT(11) DEFAULT NULL,
  `created` DATETIME NOT NULL,
  `modified` DATETIME NOT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `warehouse_request_items`;

CREATE TABLE `warehouse_request_items` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `model` VARCHAR(30) DEFAULT NULL,
  `foreign_key` INT(11) DEFAULT NULL,
  `request_uuid` INT(11) DEFAULT NULL,
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

DROP TABLE IF EXISTS `requests`;

CREATE TABLE `requests` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `uuid` INT(11) DEFAULT NULL,
  `name` VARCHAR(80) DEFAULT NULL,
  `status_id` INT(11) DEFAULT NULL,
  `created` DATETIME NOT NULL,
  `modified` DATETIME NOT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;


ALTER TABLE `warehouse_request_items` ADD `remarks` TEXT  NULL  DEFAULT NULL  AFTER `quantity_unit_id`;

/* add salary report table for koufu_payroll */

CREATE TABLE IF NOT EXISTS `salary_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `salary_type` varchar(255) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `gross` decimal(8,2) NOT NULL,
  `total_deduction` decimal(8,2) NOT NULL,
  `allowances` decimal(8,2) NOT NULL,
  `incentives` decimal(8,2) NOT NULL,
  `total_pay` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


/* koufu payroll deductions table aug 26 2015*/
ALTER TABLE `deductions`  ADD `is_deleted` INT NULL DEFAULT '0'  AFTER `status`;

/* koufu human_resource salaries table aug 26 2015*/
ALTER TABLE `salaries`  ADD `tax_status` VARCHAR(255) NULL  AFTER `employee_salary_type`;

/**howell kit added this 08/26/2015 TO WAREHOUSE DATABASE   */
RENAME TABLE `koufu_warehouse`.`requests` TO `koufu_warehouse`.`warehouse_requests`;
ALTER TABLE `received_items` CHANGE COLUMN `item_uuid` `request_uuid` INT(11) NULL DEFAULT NULL;
ALTER TABLE `koufu_warehouse`.`item_records` DROP COLUMN `quantity_unit_id` ;
/** bien added this 08/26/2015 TO Ticket DATABASE   */
ALTER TABLE `job_tickets` ADD `production_status` VARCHAR(120)  NULL  DEFAULT NULL  AFTER `remarks`;

/** bien added this 08/26/2015 TO system DATABASE   */
ALTER TABLE `sub_processes` DROP `machine_id`;

/** bien added this 08/26/2015 TO production DATABASE   */
ALTER TABLE `machines` ADD `sub_process_id` INT(11)  NULL  DEFAULT NULL  AFTER `section_id`;

/** howell kit added this 08/27/2015 TO production DATABASE   */
ALTER TABLE `koufu_warehouse`.`stocks` DROP COLUMN `remarks` ;

#NOTE: SELECT KOUFU SYSTEm DATABASE ----
/** howellkit added this 08/28/2015  */

CREATE TABLE IF NOT EXISTS `areas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) DEFAULT NULL,
  `created` DATETIME NOT NULL,
  `modified` DATETIME NOT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

/** howellkit added this 08/29/2015  */
#NOTE: SELECT KOUFU WAREHOUSE DATABASE ----
ALTER TABLE `warehouse_request_items` CHANGE COLUMN `request_uuid` `request_id` INT(11) NULL DEFAULT NULL;
ALTER TABLE `warehouse_requests`  ADD `date_needed` DATETIME NULL  AFTER `quantity_unit_id`;
ALTER TABLE `warehouse_requests`  ADD `purpose` VARCHAR(50) NULL  AFTER `date_needed`;

#NOTE: SELECT KOUFU PURCHASING DATABASE ----
ALTER TABLE `request_items`  ADD `date_needed` DATETIME NULL  AFTER `quantity_unit_id`;
ALTER TABLE `request_items`  ADD `purpose` VARCHAR(50) NULL  AFTER `date_needed`;
ALTER TABLE `request_items`  ADD `remarks` VARCHAR(50) NULL  AFTER `purpose`;

INSERT  INTO `status_field_holders`(`id`,`status`,`created_by`,`modified_by`,`created`,`modified`) VALUES (11,'Received',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03'),(12,'Deducted',1,1,'2015-04-27 23:22:03','2015-04-27 23:22:03');


/* Select KOUFU PAYROLL */

ALTER TABLE `deductions` CHANGE `type` `type` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

ALTER TABLE `deductions`  ADD `loan_id` INT NULL  AFTER `type`;



CREATE TABLE IF NOT EXISTS `philhealth_ranges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `range_from` decimal(8,2) NOT NULL,
  `range_to` decimal(8,2) NOT NULL,
  `condition` varchar(45) DEFAULT NULL,
  `salary_base` decimal(8,2) NOT NULL,
  `employer` decimal(8,2) NOT NULL,
  `employee` decimal(8,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `accounting_philhealth_ranges`
--

INSERT INTO `philhealth_ranges` (`id`, `range_from`, `range_to`, `condition`, `salary_base`, `employer`, `employee`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(null, '8999.99', '0.00', 'below', '8000.00', '100.00', '100.00', 4, 4, '2015-08-12 04:05:41', '2015-08-12 04:05:41'),
(null, '9000.00', '9999.99', NULL, '9000.00', '112.50', '112.50', 4, 4, '2015-08-12 04:06:25', '2015-08-12 04:06:25');

CREATE TABLE IF NOT EXISTS `sss_ranges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `range_from` decimal(8,2) NOT NULL,
  `range_to` decimal(8,2) NOT NULL,
  `bounds` decimal(8,2) NOT NULL,
  `credits` decimal(8,2) NOT NULL,
  `employers` decimal(8,2) NOT NULL,
  `employees` decimal(8,2) NOT NULL,
  `employee_compensations` decimal(8,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `accounting_sss_ranges`
--

INSERT INTO `sss_ranges` (`id`, `range_from`, `range_to`, `bounds`, `credits`, `employers`, `employees`, `employee_compensations`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(null, '1250.00', '1749.99', '0.00', '1500.00', '110.50', '54.50', '10.00', 4, 4, '2015-08-12 02:33:19', '2015-08-12 03:05:32'),
(null, '1000.00', '1249.99', '0.00', '1000.00', '73.70', '36.30', '10.00', 4, 4, '2015-08-12 08:53:43', '2015-08-12 08:53:43'),
(null, '1750.00', '2249.99', '0.00', '2000.00', '147.30', '72.70', '10.00', 4, 4, '2015-08-24 06:39:01', '2015-08-24 06:39:01');


/** howellkit added this 09/02/2015  */
#NOTE: SELECT KOUFU PURCHASING DATABASE ----
ALTER TABLE `request_items`  ADD `pieces` INT(11) NULL  AFTER `quantity`;
ALTER TABLE `purchasing_items`  ADD `pieces` INT(11) NULL  AFTER `quantity`;

#NOTE: SELECT KOUFU JOB TICKET DATABASE ----
ALTER TABLE `job_tickets`  ADD `status_production_id` INT(11) NULL  AFTER `po_number`;

/** howellkit added this 09/02/2015  */
/* human resource table */
ALTER TABLE `attendances` CHANGE `in` `in` DATETIME NULL DEFAULT NULL, CHANGE `out` `out` DATETIME NULL DEFAULT NULL;


/** aldrin added this 09/03/2015  */
#NOTE: SELECT KOUFU Payroll DATABASE ----

CREATE TABLE IF NOT EXISTS `adjustments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `payroll_date` date NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `reasons` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/** howellkit added this 09/03/2015  */
#NOTE: SELECT KOUFU WAREHOUSE DATABASE ----

ALTER TABLE `warehouse_request_items`  ADD `stock_quantity` INT(11) NULL  AFTER `quantity_unit_id`;


/** aldrin added this 09/04/2015  */
#NOTE: SELECT KOUFU HUMAN RESOURCE DATABASE ----


CREATE TABLE IF NOT EXISTS `overtime_excess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `overtime_id` int(11) NOT NULL,
  `from` datetime NOT NULL,
  `to` datetime NOT NULL,
  `used_time` decimal(8,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `overtime_limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `from` datetime NOT NULL,
  `to` datetime NOT NULL,
  `limit` decimal(8,2) NOT NULL DEFAULT '12.00',
  `used` decimal(8,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;


/* aldrin added this / overtime excess / koufu humnan resource table */

ALTER TABLE `overtime_excess` ADD `employee_id` INT NULL AFTER `overtime_id`;
ALTER TABLE `overtime_excess`  ADD `attendance_id` INT NULL  AFTER `overtime_id`;

/* aldrin added this 9/7/15 / adjustments  / koufu payrolls table */
CREATE TABLE IF NOT EXISTS `adjustments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `payroll_date` datetime NOT NULL,
  `reason` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modifiy_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

/* aldrin added this 9/8/15 / adjustments  / koufu payrolls table */

ALTER TABLE `adjustments`  ADD `is_process` INT NOT NULL DEFAULT '0'  AFTER `reason`;

ALTER TABLE `salary_reports`  ADD `basic_pay_month` DECIMAL(8,2) NULL ,  ADD `basic_pay_month_with_holiday` DECIMAL(8,2) NULL ;

/* aldrin added this 9/14/15 / adjustments  / koufu payrolls table */
ALTER TABLE `taxes`  ADD `tax_deduction_id` INT NULL  AFTER `type`;


/*aldrin added this 9/16/15 koufu payroll */
ALTER TABLE `salary_reports`  ADD `sss_employees` DECIMAL(8,2) NULL  AFTER `basic_pay_month_with_holiday`,  ADD `sss_employers` DECIMAL(8,2) NULL  AFTER `sss_employees`,  ADD `sss_compensation` DECIMAL(8,2) NOT NULL  AFTER `sss_employers`;
ALTER TABLE `deductions`  ADD `paid_amount` DECIMAL(8,2) NOT NULL DEFAULT '0'  AFTER `amount`;


/* aldrin added this 9/24/15 koufu_warehouse */
CREATE TABLE IF NOT EXISTS `items`( 
   `id` int(11) NOT NULL AUTO_INCREMENT, 
   `name` varchar(500) , 
   `measure` varchar(500) , 
   `department_id` int(11) , 
   `category_type_id` int(11) , 
   `supplier` int(11) , 
   `remaining_stocks` int(11) , 
   `description` text , 
   `created_by` int(11) , 
   `modified_by` int(11) , 
   `created` datetime , 
   `modified` datetime , 
   PRIMARY KEY (`id`)
 )

CREATE TABLE IF NOT EXISTS `departments`( 
   `id` int(11) NOT NULL AUTO_INCREMENT  
   `name` varchar(500), 
   `description` text , 
   `created_by` int(11) , 
   `modified_by` int(11) , 
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
   PRIMARY KEY (`id`)
 )


CREATE TABLE IF NOT EXISTS `departments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) DEFAULT NULL,
  `description` text , 
  `created` DATETIME NOT NULL,
  `modified` DATETIME NOT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `item_categories`;



CREATE TABLE `item_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1500) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* aldrin added this spet 28 2015*/
ALTER TABLE `work_schedules`  ADD `from` DATETIME NULL  AFTER `day`,  ADD `to` DATETIME NULL  AFTER `from`;


/* aldrin added this oct - 3 2015 */

DROP TABLE IF EXISTS `cutting_job_tickets`;

CREATE TABLE `cutting_job_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_ticket_id` int(11) DEFAULT NULL,
  `process_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `remarks` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `wood_mold_job_tickets`;

CREATE TABLE `wood_mold_job_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `job_ticket_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `crease` varchar(255) DEFAULT NULL,
  `knife` varchar(255) DEFAULT NULL,
  `style` varchar(255) DEFAULT NULL,
  `remarks` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1; 

/* end */


/* added oct 5 2015 */

ALTER TABLE `koufu_purchasing`.`requests`   
  CHANGE `status` `status` INT(11) DEFAULT 1  NOT NULL  AFTER `status_id`;


  /* aldrin added this oct-9-2015 koufu_ticketing*/

  DROP TABLE IF EXISTS `plate_making_process`;

CREATE TABLE `plate_making_process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_ticket_id` int(11) DEFAULT NULL,
  `process_id` int(11) DEFAULT NULL,
  `machine` int(11) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `plate` varchar(255) DEFAULT NULL,
  `paper_gripper` varchar(255) DEFAULT NULL,
  `plate_gripper` varchar(255) DEFAULT NULL,
  `remarks` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;


ALTER TABLE `koufu_ticketing`.`plate_making_process`   
  ADD COLUMN `product_id` INT(11) NULL AFTER `process_id`;

  /* aldrin added this oct-12-2015 koufu_ticketing*/

ALTER TABLE `plate_making_process`
DROP COLUMN `product`,
ADD COLUMN `product`  int(11) NULL AFTER `modified`;

/* howell added this oct-9-2015 koufu_ticketing*/
ALTER TABLE `received_orders` ADD `supplier_id` INT(11)  NULL  DEFAULT NULL  AFTER `purchase_order_id`;
ALTER TABLE `received_orders`  ADD `address` VARCHAR(60) NULL  AFTER `supplier_id`;
ALTER TABLE `received_orders`  ADD `purchase_order_uuid` VARCHAR(60) NULL  AFTER `purchase_order_id`;


CREATE TABLE `received_receipt_items` (
  `id` INT(11) ,
  `delivered_order_id` INT(11),
  `received_orders_id` INT(11) ,
  `model` VARCHAR (90),
  `item_type` VARCHAR (90),
  `foreign_key` INT(11) ,
  `quantity` INT(11) ,
  `number_of_boxes` INT(11) ,
  `quantity_per_boxes` INT(11) ,
  `lot` INT(11) 
); 

ALTER TABLE `received_receipt_items`  ADD `remarks` VARCHAR(60) NULL  AFTER `lot`;

/* Bien added this oct-13-2015 koufu_sale*/

ALTER TABLE `koufu_sale`.`product_specification_parts`     ADD COLUMN `name` VARCHAR(80) NULL AFTER `product_id`;

/* howell added this oct-13-2015 koufu_purchasing*/

ALTER TABLE `request_items` ADD `category` INT(11)  NULL  DEFAULT NULL  AFTER `quantity_unit_id`;
ALTER TABLE `request_items` ADD `width` INT(11)  NULL  DEFAULT NULL  AFTER `category`;
ALTER TABLE `request_items` ADD `width_unit_id` INT(11)  NULL  DEFAULT NULL  AFTER `width`;

ALTER TABLE `purchasing_items` ADD `category` INT(11)  NULL  DEFAULT NULL  AFTER `quantity_unit_id`;
ALTER TABLE `purchasing_items` ADD `width` INT(11)  NULL  DEFAULT NULL  AFTER `category`;
ALTER TABLE `purchasing_items` ADD `width_unit_id` INT(11)  NULL  DEFAULT NULL  AFTER `width`;


/* howell added this oct-15-2015 koufu_purchasing*/

ALTER TABLE `leaves`
MODIFY COLUMN `from`  datetime NOT NULL AFTER `type_id`,
MODIFY COLUMN `to`  datetime NOT NULL AFTER `from`;

ALTER TABLE `payrolls`
MODIFY COLUMN `id`  int(11) NOT NULL AUTO_INCREMENT FIRST ,
ADD COLUMN `department_id`  int(11) NULL AFTER `employeeIds`;

/* howell kit added this oct-15-2015 sales*/
ALTER TABLE `client_orders`  ADD `status_id` INT(11)  NULL  DEFAULT NULL  AFTER `payment_terms`;

/* howell kit added this oct-15-2015 warehouse*/
ALTER TABLE `warehouse_requests`  ADD `pur_type_id` INT(11)  NULL  DEFAULT NULL  AFTER `name`;
ALTER TABLE `received_orders`  ADD `dr_num` INT(11)  NULL  DEFAULT NULL  AFTER `purchase_order_uuid`;

/* howell kit added this oct-20-2015 warehouse*/
ALTER TABLE `delivered_orders`  ADD `dr_num` INT(11)  NULL  DEFAULT NULL  AFTER `uuid`;
ALTER TABLE `delivered_orders`  ADD `si_num` INT(11)  NULL  DEFAULT NULL  AFTER `dr_num`;

/* howell kit added this oct-21-2015 warehouse*/
ALTER TABLE `purchase_orders`  ADD `receive_item_status` INT(11)  NULL  DEFAULT NULL  AFTER `uuid`;
ALTER TABLE `purchase_orders`  ADD `order` INT(11)  NULL  DEFAULT NULL  AFTER `dr_num`;
ALTER TABLE `delivered_orders`  ADD `order` INT(11)  NULL  DEFAULT NULL  AFTER `status_id`;
ALTER TABLE `delivered_orders`  ADD `purchase_order_uuid` INT(11)  NULL  DEFAULT NULL  AFTER `purchase_orders_id`;

/* bien added this oct-21-2015 sales*/
ALTER TABLE `koufu_sale`.`quotation_item_details`  ADD COLUMN `vat_status` VARCHAR(50) NULL AFTER `material`;

/* howell kit added this oct-21-2015 system*/
ALTER TABLE `units`  ADD COLUMN `type_measure` INT(11) NULL AFTER `unit`;

/* bien added this oct-21-2015 warehouse*/
ALTER TABLE `received_items`  ADD COLUMN `quantity_unit_id` INT(11) NULL AFTER `quantity`;

/* howellkit added this oct-21-2015 warehouse*/
ALTER TABLE `received_items`  ADD `unit_price` INT(11)  NULL  DEFAULT NULL  AFTER `original_quantity`;

/*aldrin addedd this oct-23-2015 */
ALTER TABLE `items`
ADD COLUMN `item_group` varchar(255) NULL AFTER `supplier`;

ALTER TABLE `ticket_process_schedules`
ADD COLUMN `status`  int(11) NULL DEFAULT 0 AFTER `remarks`;




/*aldrin added this oct 28 2015 */
-- ----------------------------
DROP TABLE IF EXISTS `pagibig_ranges`;
CREATE TABLE `pagibig_ranges` (
  `id` int(11) NOT NULL DEFAULT '0',
  `range_from` varchar(255) DEFAULT NULL,
  `range_to` varchar(255) DEFAULT NULL,
  `conditions` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pagibig_ranges
-- ----------------------------
INSERT INTO `pagibig_ranges` VALUES ('0', '1500', '0', 'below', null, null, null, null);
INSERT INTO `pagibig_ranges` VALUES ('1', '1,500', null, null, null, null, null, null);


/*howell kit addedd this oct-27-2015 Delivery */
ALTER TABLE `deliveries` CHANGE `dr_uuid` `dr_uuid` VARCHAR(50) NOT NULL;
ALTER TABLE `delivery_receipts` CHANGE `dr_uuid` `dr_uuid` VARCHAR(50) NOT NULL;
ALTER TABLE `delivery_details` CHANGE `delivery_uuid` `delivery_uuid` VARCHAR(50) NOT NULL;

/*howell kit addedd this oct-28-2015 Job Ticket */

CREATE TABLE `corrugated_paper_job_tickets` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `process_id` INT(11) DEFAULT NULL,
  `product_id` INT(11) DEFAULT NULL,
  `job_ticket_id` INT(11) DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  `created` DATETIME DEFAULT NULL,
  `modified` DATETIME DEFAULT NULL,
  `flute_combi` VARCHAR(255) DEFAULT NULL,
  `cutting_size` VARCHAR(255) DEFAULT NULL,
  `quantity` INT(11) DEFAULT NULL,
  `allowance` INT(11) DEFAULT NULL,
  `remarks` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

CREATE TABLE `corrugated_process_details` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `corrugated_job_ticket_id` INT(11) DEFAULT NULL,
  `no` INT(11) DEFAULT NULL,
  `foreign_key` INT(11) DEFAULT NULL,
  `model` VARCHAR(255) DEFAULT NULL,
  `flute` INT(11) DEFAULT NULL,
  `gsm` INT(11) DEFAULT NULL,
  `estimated_kg` INT(11) DEFAULT NULL, 
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

ALTER TABLE `corrugated_paper_job_tickets` ADD `corrugated_id` INT(11)  NULL  DEFAULT NULL  AFTER `job_ticket_id`;

/*howell kit addedd this oct-28-2015 Accounting */
ALTER TABLE `sales_invoices` CHANGE `dr_uuid` `dr_uuid` VARCHAR(50) NOT NULL;

/*howell kit addedd this oct-28-2015 Warehouse */
ALTER TABLE `received_receipt_items` ADD `quantity_unit_id` INT(11)  NULL  DEFAULT NULL  AFTER `quantity`;


/* aldrin added this nov-5-2015 koufu_system */
ALTER TABLE `users`
MODIFY COLUMN `id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT FIRST ,
ADD COLUMN `in_charge`  int(11) NULL DEFAULT 0 AFTER `image`,
ADD COLUMN `departments_handle`  text NULL AFTER `in_charge`;


ALTER TABLE `koufu_warehouse`.`items`   
  ADD COLUMN `gsm` VARCHAR(255) NULL AFTER `modified`,
  ADD COLUMN `type` VARCHAR(255) NULL AFTER `gsm`,
  ADD COLUMN `width` VARCHAR(255) NULL AFTER `type`,
  ADD COLUMN `length` VARCHAR(255) NULL AFTER `width`,
  ADD COLUMN `item_group` VARCHAR(255) NULL AFTER `length`,
  ADD COLUMN `quantity` VARCHAR(255) NULL AFTER `item_group`,
  ADD COLUMN `location` VARCHAR(255) NULL AFTER `quantity`;

ALTER TABLE `koufu_warehouse`.`items` 
ADD COLUMN `inch` VARCHAR(255) NULL AFTER `width`;


/* aldrin added this nov 9 2015 */
DROP TABLE IF EXISTS `item_specs`;
CREATE TABLE `item_specs` (
  `id` int(11) DEFAULT NULL,
  `items_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `item_group_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `item_specs`
ADD COLUMN `width`  varchar(255) NULL AFTER `unit`,
ADD COLUMN `length`  varchar(255) NULL AFTER `width`;
-- ----------------------------
-- Table structure for `item_specs`
-- ----------------------------
DROP TABLE IF EXISTS `item_specs`;
CREATE TABLE `item_specs` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
  `items_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `item_group` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `item_specs`
ADD COLUMN `unit_width`  varchar(255) NULL AFTER `length`,
ADD COLUMN `unit_length`  varchar(255) NULL AFTER `unit_width`;


/* howell kit added this nov 11 2015 Purchasing Table*/
ALTER TABLE `request_items` CHANGE COLUMN `purpose` `purpose` VARCHAR(300) NULL DEFAULT NULL;
ALTER TABLE `request_items` CHANGE COLUMN `remarks` `remarks` VARCHAR(300) NULL DEFAULT NULL;
ALTER TABLE `koufu_purchasing`.`purchasing_items` ADD COLUMN `purpose` VARCHAR(300) NULL AFTER `unit_price_unit_id`;
ALTER TABLE `koufu_purchasing`.`purchasing_items` ADD COLUMN `remarks` VARCHAR(300) NULL AFTER `purpose`;


/* add production output */
CREATE TABLE `outputs` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`ticket_process_schedule_id` int(11) NULL ,
`machine_log_id` int(11) NULL ,
`job_ticket_id`  int(11) NULL ,
`good`  varchar(255) NULL ,
`reject`  varchar(255) NULL ,
`created_by`  int(11) NULL ,
`modified_by`  int(11) NULL ,
`created`  int(11) NULL ,
`modified`  int(11) NULL ,
PRIMARY KEY (`id`)
);

/* Howell kit production */

UPDATE `job_tickets` SET `status_production_id` = 0 WHERE `status_production_id` IS NULL;

/* Howell kit purchasing */

UPDATE `purchase_orders` SET `receive_item_status` = 0 WHERE `receive_item_status` IS NULL;
UPDATE `purchase_orders` SET `status` = 11 WHERE `receive_item_status` = 1;

/* Howell kit product */

ALTER TABLE `koufu_sale`.`products` ADD COLUMN `status_id` INT(11) DEFAULT NULL AFTER `name`;
UPDATE `products` SET `status_id` = 0 WHERE `status_id` IS NULL;

/* aldrin added this nov-16-2015*/
ALTER TABLE `outputs`
ADD COLUMN `order`  int(11) NULL AFTER `job_ticket_id`;

ALTER TABLE `outputs`  ADD `status` VARCHAR(255) NOT NULL DEFAULT '' AFTER `reject`
ALTER TABLE `outputs`
ADD COLUMN `status`  varchar(255) NULL AFTER `modified`;


/* aldrin added this 11-18-2015 */
ALTER TABLE `corrugated_papers`
ADD COLUMN `from_warehouse`  int(11) NULL DEFAULT 0 AFTER `modified`;

ALTER TABLE `general_items`
ADD COLUMN `from_warehouse`  int(11) NULL DEFAULT 0 AFTER `modified`;

/* howellkit added this nov-18-2015*/
ALTER TABLE `koufu_sale`.`products` ADD COLUMN `status_id` INT(11) DEFAULT NULL AFTER `name`;
UPDATE `products` SET `status_id` = 0 WHERE `status_id` IS NULL;

/* howellkit added this nov-20-2015*/

CREATE TABLE `dr_holders` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `clients_order_id` INT(11) DEFAULT NULL,
  `schedule_id` INT(11) DEFAULT NULL,
  `status` VARCHAR(30) DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `modified_by` INT(11) DEFAULT NULL,
  `created` DATETIME DEFAULT NULL,
  `modified` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

ALTER TABLE `received_items`
ADD COLUMN `purchasing_order_id`  INT(11) NULL DEFAULT 0 AFTER `received_orders_id`;

ALTER TABLE `ticket_process_schedules`
ADD COLUMN `product_specification_process_holder_id`  int(11) NULL AFTER `department_process_id`;

ALTER TABLE `ticket_process_schedules`
ADD COLUMN `operator_id`  int(11) NULL AFTER `machine_id`;

/* howellkit added this nov-20-2015*/

ALTER TABLE `client_order_delivery_schedules`
ADD COLUMN `status_id`  INT(11) NULL AFTER `allowance`;
UPDATE `client_order_delivery_schedules` SET `status_id` = 0 WHERE `status_id` IS NULL;

ALTER TABLE `item_specs`
ADD COLUMN `unit_length_id`  int(11) NULL AFTER `unit_length`,
ADD COLUMN `unit_width_id`  int(11) NULL AFTER `unit_length_id`;


/*  aldrin added this 11 - 24 -15 koufu_human_resources */

ALTER TABLE `overtimes` CHANGE `approved_by` `approved_by` INT(11) NULL;

/*  aldrin added this 11 - 24 -15 koufu_human_resources */
CREATE TABLE IF NOT EXISTS `overtime_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `overtime_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `reason` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

CREATE TABLE `output_details` (
`id` int NULL AUTO_INCREMENT ,
`department_process_id`  int NULL ,
`output_id`  int NULL ,
`pallet`  varchar(255) NULL ,
`qty_pallet`  varchar(255) NULL ,
`height`  varchar(255) NULL ,
`created`  datetime NULL ,
`modified`  datetime NULL ,
PRIMARY KEY (`id`)
);

/* aldrin added this dec 1 2015 koufu payrolls */
CREATE TABLE IF NOT EXISTS `tax_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `payroll_id` int(11) NOT NULL,
  `payroll_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `deduction_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deduction_id` int(11) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `balance` decimal(8,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `tax_histories`
MODIFY COLUMN `payroll_id`  int(11) NOT NULL AFTER `loan_id`,
MODIFY COLUMN `amount`  decimal(8,2) NOT NULL AFTER `payroll_id`,
ADD COLUMN `employee`  decimal(8,2) NULL AFTER `amount`,
ADD COLUMN `employer`  decimal(8,2) NULL AFTER `employee`,
ADD COLUMN `compensation`  decimal(8,2) NULL AFTER `employer`;


/* koufu payroll */
CREATE TABLE `contribution_balances` (
`id`  int(11) NULL AUTO_INCREMENT,
`contribution_id`  int(11) NULL ,
`amount`  varchar(255) NULL,
`employee_id`  int(11) NULL ,
`payroll_id`  int(11) NULL ,
`sched`  varchar(255) NULL ,
`from`  datetime NULL ,
`to`  datetime NULL ,
`created`  datetime NULL ,
`modified`  datetime NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*  howellkit added this 11-24-15 koufu_human_resources */

ALTER TABLE `koufu_purchasing`.`requests` ADD COLUMN `received` DATETIME DEFAULT NULL AFTER modified; 
ALTER TABLE `koufu_purchasing`.`requests` ADD COLUMN `received_by`  INT(11) DEFAULT NULL AFTER approved_by;

ALTER TABLE `purchase_orders` CHANGE `supplier_id` `supplier_id` VARCHAR(120) DEFAULT NULL;
ALTER TABLE `purchase_orders` CHANGE `contact_person_id` `contact_person_id` VARCHAR(50) DEFAULT NULL;
ALTER TABLE `purchase_orders` CHANGE `contact_id` `contact_id` VARCHAR(50) DEFAULT NULL;

/* aldrin added this 12-2-15 */
ALTER TABLE `contribution_balances`
ADD COLUMN `amount`  decimal(8,2) NULL AFTER `payroll_id`;

/* aldrin added this 12-2-15 koufu payrolls*/
ALTER TABLE `sss_reports`
ADD COLUMN `salary_report_id`  int(11) NULL AFTER `employee_id`;

ALTER TABLE `sss_reports`
ADD COLUMN `from`  datetime NULL AFTER `compensation`,
ADD COLUMN `to`  datetime NULL AFTER `from`;

/* howell kit added this 12-3-15 koufu purchasing*/

ALTER TABLE `request_items`
ADD COLUMN `status_id`  INT(11) NULL AFTER `purpose`;

UPDATE `request_items` SET `status_id` = 0 WHERE `status_id` IS NULL;


/* howell kit added this 12-4-15 koufu purchasing*/

ALTER TABLE `purchasing_items`
ADD COLUMN `status_id`  INT(11) NULL AFTER `purpose`;

UPDATE `purchasing_items` SET `status_id` = 0 WHERE `status_id` IS NULL;

ALTER TABLE `purchase_orders`
ADD COLUMN `received_bycash_number`  INT(11) NULL AFTER `delivery_date`;

ALTER TABLE `request_items`
ADD COLUMN `received_bycash_number`  INT(11) NULL AFTER `unit_price_unit_id`;


/* aldrin added this 12 - 11 - 15 koufu production */
ALTER TABLE `ticket_process_schedules`  ADD `production_date_from` DATETIME NULL AFTER `production_date`,  ADD `production_date_to` DATETIME NULL AFTER `production_date_from`;

/* aldrin added this 12 - 14 - 15 koufu_human_resources */
ALTER TABLE `employees` ADD COLUMN `date_resigned`  datetime NULL AFTER `date_hired`;

/* aldrin added this 12 - 15 -15 koufu_human_resources */
ALTER TABLE `employees`
ADD COLUMN `last_payroll`  int(11) NULL DEFAULT 0 AFTER `finger_code`;


/* aldrin added this 01 - 21 -16 koufu_deliveries */
ALTER TABLE `delivery_receipts`   
  ADD COLUMN `delivery_id` INT NULL AFTER `dr_uuid`;


ALTER TABLE .`delivery_details` 
  ADD COLUMN `delivery_id` INT(11) NULL AFTER `delivery_uuid`;

/* aldrin added this 01 - 21 -16 koufu_deliveries */
ALTER TABLE `sales_invoices`
ADD COLUMN `is_multiple`  int(11) NULL DEFAULT 0 AFTER `modified`;

ALTER TABLE `delivery_details`
ADD COLUMN `delivery_id`  int(11) NULL AFTER `created`;



/* aldrin added this 02 - 02 - 16 */
ALTER TABLE `sales_invoices`
ADD COLUMN `delivery_id`  int(11) NULL AFTER `dr_uuid`;


/* aldrin added this 02 - 04 - 16 */
ALTER TABLE `received_items`
ADD COLUMN `pieces`  int(11) NULL AFTER `quantity_unit_id`;

ALTER TABLE `received_receipt_items`
ADD COLUMN `dr_num`  varchar(255) NULL AFTER `remarks`,
ADD COLUMN `si_num`  varchar(255) NULL AFTER `dr_num`,
ADD COLUMN `tracking`  varchar(255) NULL AFTER `si_num`;
ALTER TABLE `received_orders`
ADD COLUMN `si_num`  varchar(255) NULL AFTER `dr_num`;

