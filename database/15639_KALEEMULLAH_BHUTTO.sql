/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.4.19-MariaDB : Database - 15639_kaleemullah_bhutto
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`learning_management_system` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `learning_management_system`;

/*Table structure for table `batch_course` */

DROP TABLE IF EXISTS `batch_course`;

CREATE TABLE `batch_course` (
  `batch_course_id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT 1,
  `number_of_topics` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`batch_course_id`),
  KEY `batch_id` (`batch_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `batch_course_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`batch_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `batch_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

/*Data for the table `batch_course` */

insert  into `batch_course`(`batch_course_id`,`batch_id`,`course_id`,`status_id`,`number_of_topics`,`created_at`,`updated_at`) values 
(17,3,1,6,2,'2021-10-19 00:42:12','2021-10-27 00:26:26'),
(21,6,6,6,3,'2021-10-25 22:33:39','2021-10-27 00:26:23');

/*Table structure for table `batch_course_topic` */

DROP TABLE IF EXISTS `batch_course_topic`;

CREATE TABLE `batch_course_topic` (
  `batch_course_topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_course_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT 1,
  `topic_priority` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`batch_course_topic_id`),
  KEY `batch_course_id` (`batch_course_id`),
  KEY `topic_id` (`topic_id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `batch_course_topic_ibfk_1` FOREIGN KEY (`batch_course_id`) REFERENCES `batch_course` (`batch_course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `batch_course_topic_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `batch_course_topic_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

/*Data for the table `batch_course_topic` */

insert  into `batch_course_topic`(`batch_course_topic_id`,`batch_course_id`,`topic_id`,`status_id`,`topic_priority`,`created_at`,`updated_at`) values 
(9,17,3,1,1,'2021-10-19 00:42:25',NULL),
(10,17,1,1,5,'2021-10-19 00:42:25',NULL),
(27,21,13,1,2,'2021-10-25 22:34:32',NULL),
(28,21,1,1,3,'2021-10-25 22:34:32',NULL),
(29,21,3,1,1,'2021-10-25 22:34:32',NULL);

/*Table structure for table `batches` */

DROP TABLE IF EXISTS `batches`;

CREATE TABLE `batches` (
  `batch_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) DEFAULT 6,
  `batch_title` varchar(100) DEFAULT NULL,
  `batch_description` text DEFAULT NULL,
  `batch_start_date` date DEFAULT NULL,
  `batch_end_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`batch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `batches` */

insert  into `batches`(`batch_id`,`status_id`,`batch_title`,`batch_description`,`batch_start_date`,`batch_end_date`,`created_at`,`updated_at`) values 
(2,2,'2K21','2K21 FEB-MAY','2021-02-01','2021-05-31','2021-10-10 00:45:00','2021-10-26 21:42:23'),
(3,1,'2K20','2K20 JAN-APR','2020-01-01','2020-04-30','2021-10-10 11:50:06','2021-10-26 21:49:09'),
(4,1,'2K22','2K22 FEB-MAY','2022-02-01','2022-05-31','0000-00-00 00:00:00','2021-10-26 21:49:12'),
(5,2,'2K21','2K21 JUN-SEP','2021-06-01','2021-09-30','2021-10-18 22:29:19','2021-10-26 21:49:15'),
(6,2,'2K19','2K19-JUN-SEP','2019-06-01','2019-09-30','2021-10-26 01:45:03','2021-10-26 21:49:06');

/*Table structure for table `courses` */

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) DEFAULT 1,
  `course_title` varchar(100) DEFAULT NULL,
  `course_description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`course_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `courses` */

insert  into `courses`(`course_id`,`status_id`,`course_title`,`course_description`,`created_at`,`updated_at`) values 
(1,2,'PHP BASIC ','PHP-BASIC(LEVEL)','2021-10-26 21:49:50','2021-10-26 21:49:50'),
(2,2,'PHP ADVANCE','PHP ADVANCE(LEVEL)','2021-10-14 21:53:53','2021-10-14 19:38:52'),
(3,1,'JAVASCRIPT','JAVASCRIPT BASIC (LEVEL)','2021-10-18 22:56:54','2021-10-14 19:38:46'),
(4,2,'JAVASCRIPT','JAVASCRIPT ADVANCE (LEVEL)','2021-10-26 21:49:46','2021-10-26 21:49:46'),
(6,2,'JAVA ','JAVA BASIC(LEVEL)','2021-10-26 21:49:43','2021-10-26 21:49:43');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) DEFAULT NULL,
  `role_type` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`role_id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `roles` */

insert  into `roles`(`role_id`,`status_id`,`role_type`,`created_at`,`updated_at`) values 
(1,1,'admin',NULL,NULL),
(2,1,'teacher',NULL,NULL),
(3,1,'student',NULL,NULL);

/*Table structure for table `status` */

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('Active','InActive','Enrolled','Disenrolled','InProcess','Completed','Terminated') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `status` */

insert  into `status`(`status_id`,`status`,`created_at`,`updated_at`) values 
(1,'Active','2021-10-10 12:49:17',NULL),
(2,'InActive','2021-10-10 12:49:25',NULL),
(3,'Completed','2021-10-10 12:49:28',NULL),
(4,'Enrolled','2021-10-10 12:49:34',NULL),
(5,'Disenrolled','2021-10-10 12:49:38',NULL),
(6,'InProcess','2021-10-10 12:49:41',NULL),
(7,'Terminated','2021-10-21 21:57:23',NULL);

/*Table structure for table `topic_file` */

DROP TABLE IF EXISTS `topic_file`;

CREATE TABLE `topic_file` (
  `topic_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `file_type` enum('doc','ppt','pdf','png','jpg','jpeg','pptx') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`topic_file_id`),
  KEY `topic_id` (`topic_id`),
  CONSTRAINT `topic_file_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `topic_file` */

insert  into `topic_file`(`topic_file_id`,`topic_id`,`status_id`,`file_name`,`file_path`,`file_type`,`created_at`,`updated_at`) values 
(1,2,1,'Internship Program Policies and Procedures.doc','files','doc','2021-10-22 22:52:52',NULL),
(2,2,1,'Filling (Day-3).ppt','files','ppt','2021-10-22 23:41:51',NULL),
(3,1,1,'image(5).jpg','files','jpg','2021-10-23 00:44:10',NULL),
(4,3,1,'Filling (Day-3).ppt','files','ppt','2021-10-23 00:44:24',NULL),
(5,3,1,'Internship Program Policies and Procedures.doc','files','doc','2021-10-23 00:45:43',NULL),
(10,2,1,'filing.jpg','files','jpg','2021-10-24 22:15:13',NULL),
(11,3,1,'Arrays-in-PHP-final.png','files','png','2021-10-24 22:48:19',NULL),
(12,1,1,'java-do-while-loop-1.png','files','png','2021-10-24 22:49:08',NULL),
(13,7,1,'doc.pdf','files','pdf','2021-10-25 22:37:06',NULL),
(15,1,1,'Internship Program Policies and Procedures.doc','files','doc','2021-10-27 00:08:08',NULL);

/*Table structure for table `topics` */

DROP TABLE IF EXISTS `topics`;

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) DEFAULT 2,
  `topic_title` varchar(100) DEFAULT NULL,
  `topic_description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`topic_id`),
  UNIQUE KEY `topic_title` (`topic_title`,`topic_description`) USING HASH,
  UNIQUE KEY `topic_description` (`topic_description`) USING HASH,
  KEY `status_id` (`status_id`),
  CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

/*Data for the table `topics` */

insert  into `topics`(`topic_id`,`status_id`,`topic_title`,`topic_description`,`created_at`,`updated_at`) values 
(1,2,'Looping and branching','Loops and Conditional statements','0000-00-00 00:00:00','2021-10-26 21:50:19'),
(2,2,'Session','Session Techniques','2021-10-14 22:56:29','2021-10-26 21:50:15'),
(3,1,'Array','Array techniques','2021-10-15 00:17:30','2021-10-15 00:18:34'),
(7,2,'String Manipulation','String Manipulation techniques','2021-10-21 22:48:23',NULL),
(13,1,'Filling','Filling techniques','2021-10-26 01:43:52','2021-10-25 22:34:02');

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_role_id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_role` */

insert  into `user_role`(`user_role_id`,`user_id`,`role_id`,`status_id`,`created_at`,`updated_at`) values 
(1,1,1,1,NULL,NULL),
(12,1,2,1,'0000-00-00 00:00:00',NULL),
(17,4,2,1,'2021-10-17 14:29:57',NULL),
(38,11,3,NULL,'2021-10-20 22:57:51',NULL),
(46,16,2,NULL,'2021-10-25 22:18:19',NULL),
(47,10,3,NULL,'2021-10-26 22:30:28',NULL),
(50,1,3,NULL,'2021-10-26 22:51:45',NULL);

/*Table structure for table `user_role_batch_course_enrollment` */

DROP TABLE IF EXISTS `user_role_batch_course_enrollment`;

CREATE TABLE `user_role_batch_course_enrollment` (
  `enrollment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_id` int(11) DEFAULT NULL,
  `batch_course_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`enrollment_id`),
  KEY `user_role_id` (`user_role_id`),
  KEY `batch_course_id` (`batch_course_id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `user_role_batch_course_enrollment_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`user_role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_role_batch_course_enrollment_ibfk_2` FOREIGN KEY (`batch_course_id`) REFERENCES `batch_course` (`batch_course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_role_batch_course_enrollment_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_role_batch_course_enrollment` */

insert  into `user_role_batch_course_enrollment`(`enrollment_id`,`user_role_id`,`batch_course_id`,`status_id`,`created_at`,`updated_at`) values 
(7,17,21,4,'2021-10-22 23:00:45',NULL),
(19,50,21,4,'2021-10-26 22:52:23',NULL),
(20,12,17,4,'2021-10-26 23:41:31',NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `approved_by` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT 2,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `image` blob DEFAULT NULL,
  `home_town` text DEFAULT NULL,
  `is_approve` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `approved_by` (`approved_by`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`approved_by`) REFERENCES `user_role` (`user_role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`user_id`,`approved_by`,`status_id`,`first_name`,`last_name`,`email`,`password`,`gender`,`date_of_birth`,`image`,`home_town`,`is_approve`,`created_at`,`updated_at`) values 
(1,1,1,'Admin','','Admin12@gmail.com','123456','Male','1997-01-06','image.jpg','Jamshoro','Approved',NULL,'2021-10-26 00:35:24'),
(4,1,1,'Awais','Ali ','Awais12@gmail.com','12345','Male','1995-03-01','dummypic3.jpg','Jamshoro','Approved','2021-10-08 01:03:58','0000-00-00 00:00:00'),
(10,1,1,'Ghulam ','Hussain','Ghulamhussain12@gmail.com','12345','Male','1996-01-05','image(4).jpg','Jamshoro','Approved','2021-10-20 22:09:53','0000-00-00 00:00:00'),
(11,1,1,'Hammad','','Hammad12@gmail.com','1234','Male','2004-11-25','018cwxjHcVMwiaDIpTnZJ8H-23..1570842461.jpg','Sukkur','Approved','2021-10-20 22:05:13','2021-10-26 01:14:33'),
(16,1,2,'Asad','Mari','Asadmari@gmail.com','1234','Male','1996-01-02','dummypic6.jpg','Jacobabad','Approved','2021-10-25 22:18:19',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
