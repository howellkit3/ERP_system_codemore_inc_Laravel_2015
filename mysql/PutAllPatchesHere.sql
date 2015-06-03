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