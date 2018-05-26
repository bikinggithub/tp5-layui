/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tp5

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-05-26 15:41:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sys_config
-- ----------------------------
DROP TABLE IF EXISTS `sys_config`;
CREATE TABLE `sys_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '变量名称',
  `v_code` varchar(255) NOT NULL COMMENT '变量标识',
  `v_value` text COMMENT '变量值',
  `is_sys` tinyint(2) NOT NULL DEFAULT '2' COMMENT '是否系统变量',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态 1可用 2禁用',
  `create_at` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_config
-- ----------------------------
INSERT INTO `sys_config` VALUES ('1', '邮箱配置', 'email_smtp_conf', '{\"smtpserver\":\"smtp.163.com\",\"port\":25,\"usermail\":\"13066971007@163.com\",\"smtpuser\":\"13066971007\",\"smtppass\":\"HbqZc2017\"}', '1', '系统邮箱配置', '1', '2018-04-30 09:48:40');
SET FOREIGN_KEY_CHECKS=1;
