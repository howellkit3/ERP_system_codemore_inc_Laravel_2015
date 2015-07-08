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


#NOTE: SELECT KOUFU ACCOUNTING DATABASE ----
/** howell kit added this 07/03/2015  */

ALTER TABLE `koufu_delivery`.`transmittals` ADD COLUMN `type` VARCHAR(60) NULL AFTER `quantity`;

#NOTE: SELECT KOUFU PURCHASING DATABASE ----
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) DEFAULT NULL,
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
  KEY `id_idx` (`supplier_id`),
  CONSTRAINT `id` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
