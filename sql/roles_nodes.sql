/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tp5

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-05-26 15:41:11
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
) ENGINE=MyISAM AUTO_INCREMENT=145 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of roles_nodes
-- ----------------------------
INSERT INTO `roles_nodes` VALUES ('144', '2', '7');
INSERT INTO `roles_nodes` VALUES ('143', '2', '6');
INSERT INTO `roles_nodes` VALUES ('142', '2', '5');
INSERT INTO `roles_nodes` VALUES ('141', '2', '4');
INSERT INTO `roles_nodes` VALUES ('140', '2', '3');
INSERT INTO `roles_nodes` VALUES ('139', '2', '2');
INSERT INTO `roles_nodes` VALUES ('138', '2', '1');
SET FOREIGN_KEY_CHECKS=1;
