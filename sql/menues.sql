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

/*Table structure for table `menues` */

DROP TABLE IF EXISTS `menues`;

CREATE TABLE `menues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级菜单id',
  `name` varchar(255) NOT NULL COMMENT '菜单名称',
  `link_url` varchar(255) NOT NULL COMMENT 'url地址',
  `sortnum` int(11) NOT NULL COMMENT '排序',
  `is_show` tinyint(2) NOT NULL DEFAULT '2' COMMENT '是否显示 1是 2否',
  `module_name` varchar(255) NOT NULL DEFAULT 'admin' COMMENT '模块名称',
  `control_name` varchar(255) NOT NULL COMMENT '控制器名称',
  `method_name` varchar(255) NOT NULL COMMENT '操作方法',
  `menues_status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '菜单状态 1、正常 2、禁用',
  `markid` varchar(255) NOT NULL COMMENT '菜单标识',
  `gradenum` tinyint(2) NOT NULL DEFAULT '1' COMMENT '菜单等级',
  `create_at` datetime NOT NULL COMMENT '创建时间',
  `update_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `menues` */

insert  into `menues`(`id`,`pid`,`name`,`link_url`,`sortnum`,`is_show`,`module_name`,`control_name`,`method_name`,`menues_status`,`markid`,`gradenum`,`create_at`,`update_at`) values (1,0,'首页','/admin/Index/index',100,1,'admin','Index','index',1,'homepage',1,'2018-04-10 20:15:13','2018-04-10 20:15:15'),(2,1,'首页欢迎页','/admin/Index/index',10,1,'admin','Index','index',1,'homepage',2,'2018-04-10 20:15:13','2018-04-10 20:15:13'),(3,0,'系统管理','/admin/Usermanage/userlist',10,1,'admin','Usermanage','userlist',1,'usermanage',1,'2018-04-10 20:15:13','2018-04-10 20:15:13'),(4,3,'用户管理','/admin/Usermanage/index',20,1,'admin','Usermanage','index',1,'userindex',2,'2018-04-10 20:15:13','2018-04-10 20:15:13'),(5,4,'用户列表','/admin/Usermanage/userlist',10,1,'admin','Usermanage','userlist',1,'usermanage',3,'2018-04-10 20:15:13','2018-04-10 20:15:13'),(6,3,'权限管理','/admin/Powermanage/index',10,1,'admin','Powermanage','index',1,'powerindex',2,'2018-04-10 20:15:13','2018-04-10 20:15:13'),(7,6,'角色列表','/admin/Powermanage/rolelist',10,1,'admin','Powermanage','rolelist',1,'rolelist',3,'2018-04-10 20:15:13','2018-04-10 20:15:13'),(8,6,'节点列表','/admin/Powermanage/nodelist',20,1,'admin','Powermanage','nodelist',1,'nodelist',3,'2018-04-10 20:15:13','2018-04-10 20:15:13'),(9,6,'角色权限','/admin/Powermanage/rolenodelist',30,1,'admin','Powermanage','rolenodelist',1,'rolenodelist',3,'2018-04-10 20:15:13','2018-04-10 20:15:13'),(10,4,'用户新增','/admin/Usermanage/add',20,2,'admin','Usermanage','add',1,'useradd',3,'2018-04-10 20:15:13','2018-04-10 20:15:13'),(11,4,'用户编辑','/admin/Usermanage/edit',30,2,'admin','Usermanage','edit',1,'useredit',3,'2018-04-10 20:15:13','2018-04-10 20:15:13'),(12,4,'用户删除','/admin/Usermanage/delete',40,2,'admin','Usermanage','delete',1,'userdelete',3,'2018-04-10 20:15:13','2018-04-10 20:15:13');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
