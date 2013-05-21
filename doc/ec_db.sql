/*
SQLyog Job Agent Version 9.50 Copyright(c) Webyog Inc. All Rights Reserved.


MySQL - 5.6.10 : Database - echo_analize_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`echo_analize_db` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `echo_analize_db`;

/*Table structure for table `ads_option` */

DROP TABLE IF EXISTS `ads_option`;

CREATE TABLE `ads_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ads_option` */

/*Table structure for table `ads_order` */

DROP TABLE IF EXISTS `ads_order`;

CREATE TABLE `ads_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `advertise_id` int(11) NOT NULL,
  `invoid_id` int(11) NOT NULL,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ads_payment_advertise1_idx` (`advertise_id`),
  KEY `fk_ads_payment_invoid1_idx` (`invoid_id`),
  CONSTRAINT `fk_ads_payment_advertise1` FOREIGN KEY (`advertise_id`) REFERENCES `advertise` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ads_payment_invoid1` FOREIGN KEY (`invoid_id`) REFERENCES `invoid` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ads_order` */

/*Table structure for table `advertise` */

DROP TABLE IF EXISTS `advertise`;

CREATE TABLE `advertise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('enabled','disabled','expired') COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `ads_option_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_advertise_user1_idx` (`user_id`),
  KEY `fk_advertise_ads_option1_idx` (`ads_option_id`),
  CONSTRAINT `fk_advertise_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_advertise_ads_option1` FOREIGN KEY (`ads_option_id`) REFERENCES `ads_option` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `advertise` */

/*Table structure for table `blog` */

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detail` longtext COLLATE utf8_unicode_ci,
  `keywords` text COLLATE utf8_unicode_ci,
  `status` enum('public','member','disabled') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `blog_category_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `allow_comment` enum('public','member','disabled') COLLATE utf8_unicode_ci DEFAULT NULL,
  `edit_time` text COLLATE utf8_unicode_ci,
  `views` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_blog_blog_category_idx` (`blog_category_id`),
  KEY `fk_blog_user1_idx` (`user_id`),
  CONSTRAINT `fk_blog_blog_category` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_blog_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog` */

/*Table structure for table `blog_category` */

DROP TABLE IF EXISTS `blog_category`;

CREATE TABLE `blog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `keywords` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog_category` */

/*Table structure for table `blog_comment` */

DROP TABLE IF EXISTS `blog_comment`;

CREATE TABLE `blog_comment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `comment` text COLLATE utf8_unicode_ci,
  `created` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blog_id` int(11) NOT NULL,
  `member_comment` bigint(20) DEFAULT NULL,
  `user_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_blog_comment_blog1_idx` (`blog_id`),
  CONSTRAINT `fk_blog_comment_blog1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog_comment` */

/*Table structure for table `blog_rating` */

DROP TABLE IF EXISTS `blog_rating`;

CREATE TABLE `blog_rating` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `score` int(2) DEFAULT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_blog_rating_blog1_idx` (`blog_id`),
  KEY `fk_blog_rating_user1_idx` (`user_id`),
  CONSTRAINT `fk_blog_rating_blog1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_blog_rating_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog_rating` */

/*Table structure for table `board` */

DROP TABLE IF EXISTS `board`;

CREATE TABLE `board` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('public','member','disabled') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `board` */

/*Table structure for table `invoid` */

DROP TABLE IF EXISTS `invoid`;

CREATE TABLE `invoid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoid_code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `expire` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `invoid` */

/*Table structure for table `news` */

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `status` enum('public','member','disabled') COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_news_user1_idx` (`user_id`),
  CONSTRAINT `fk_news_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `news` */

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoid_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_invoid1_idx` (`invoid_id`),
  CONSTRAINT `fk_payment_invoid1` FOREIGN KEY (`invoid_id`) REFERENCES `invoid` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `payment` */

/*Table structure for table `private_message` */

DROP TABLE IF EXISTS `private_message`;

CREATE TABLE `private_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to_user` bigint(20) DEFAULT NULL,
  `to_group` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_private_message_user1_idx` (`user_id`),
  CONSTRAINT `fk_private_message_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `private_message` */

/*Table structure for table `reply` */

DROP TABLE IF EXISTS `reply`;

CREATE TABLE `reply` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `comment` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `member_comment` bigint(20) DEFAULT NULL,
  `user_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `topic_id` bigint(20) NOT NULL,
  `best_reply` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reply_topic1_idx` (`topic_id`),
  CONSTRAINT `fk_reply_topic1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `reply` */

/*Table structure for table `reply_rating` */

DROP TABLE IF EXISTS `reply_rating`;

CREATE TABLE `reply_rating` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `score` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reply_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reply_rating_reply1_idx` (`reply_id`),
  KEY `fk_reply_rating_user1_idx` (`user_id`),
  CONSTRAINT `fk_reply_rating_reply1` FOREIGN KEY (`reply_id`) REFERENCES `reply` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reply_rating_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `reply_rating` */

/*Table structure for table `topic` */

DROP TABLE IF EXISTS `topic`;

CREATE TABLE `topic` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8_unicode_ci,
  `ctreated` datetime DEFAULT NULL,
  `status` enum('public','member','disabled') COLLATE utf8_unicode_ci DEFAULT NULL,
  `allow_comment` enum('public','member') COLLATE utf8_unicode_ci DEFAULT NULL,
  `edit_time` text COLLATE utf8_unicode_ci,
  `keywords` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `boardcol` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `allow_see` enum('public','member') COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_major` tinyint(1) DEFAULT NULL,
  `board_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `views` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_topic_board1_idx` (`board_id`),
  KEY `fk_topic_user1_idx` (`user_id`),
  CONSTRAINT `fk_topic_board1` FOREIGN KEY (`board_id`) REFERENCES `board` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_topic_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `topic` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `display_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` enum('active','ban','disable') COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `is_editor` tinyint(1) DEFAULT NULL,
  `is_blogger` tinyint(1) DEFAULT NULL,
  `is_member` tinyint(1) DEFAULT NULL,
  `last_log` datetime DEFAULT NULL,
  `identifier` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `score` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
