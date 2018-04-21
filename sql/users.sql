/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.5.53 : Database - test
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`test` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `test`;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(255) NOT NULL COMMENT '账号',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `nickname` varchar(255) NOT NULL COMMENT '昵称',
  `head_img` varchar(255) NOT NULL COMMENT '头像',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '用户状态 1正常 2禁用',
  `create_at` datetime NOT NULL COMMENT '创建时间',
  `update_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`account`,`password`,`nickname`,`head_img`,`status`,`create_at`,`update_at`) values (1,'admin','61b3151941bb43fad57005524d1a967c','admin','http://localtp5.com\\static\\admin\\images\\headimg.jpg',1,'2018-04-11 11:39:22','2018-04-11 11:39:22'),(5,'tom','a6c118213855e2cf2e39b1fed199ef38','tom','http://localtp5.com\\uploads\\20180412\\4f007fffc1b9f57830a4d1c4f7af3884.jpg',1,'2018-04-11 11:39:22','2018-04-12 21:18:24'),(6,'blucks','84a4d80510236aa29c7be34ebffd54b5','blucks','http://localtp5.com\\uploads\\20180412\\965e46ebbe802e4d8cd9dc6a2f42d275.jpg',1,'2018-04-11 11:39:22','2018-04-12 21:18:21'),(8,'lijun','61b3151941bb43fad57005524d1a967c','lijun','http://localtp5.com\\uploads\\20180412\\de733238f526ca07cce2f22145307812.png',1,'2018-04-12 16:10:35','2018-04-12 22:43:47');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
