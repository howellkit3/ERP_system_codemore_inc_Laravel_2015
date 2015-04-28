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
