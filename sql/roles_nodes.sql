/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tp5

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-04-22 03:09:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for roles_nodes
-- ----------------------------
DROP TABLE IF EXISTS `roles_nodes`;
CREATE TABLE `roles_nodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `node_id` int(11) NOT NULL COMMENT '节点id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of roles_nodes
-- ----------------------------
SET FOREIGN_KEY_CHECKS=1;
