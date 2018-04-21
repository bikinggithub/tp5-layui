/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tp5

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-04-21 22:24:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(255) NOT NULL COMMENT '账号',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `roleid` int(11) NOT NULL DEFAULT '0' COMMENT '用户角色',
  `nickname` varchar(255) NOT NULL COMMENT '昵称',
  `head_img` varchar(255) NOT NULL COMMENT '头像',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '用户状态 1正常 2禁用',
  `create_at` datetime NOT NULL COMMENT '创建时间',
  `update_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', '61b3151941bb43fad57005524d1a967c', '1', 'admin', 'http://localtp5.com\\static\\admin\\images\\headimg.jpg', '1', '2018-04-11 11:39:22', '2018-04-11 11:39:22');
INSERT INTO `users` VALUES ('5', 'tom', 'a6c118213855e2cf2e39b1fed199ef38', '1', 'tom', 'http://localtp5.com\\uploads\\20180412\\4f007fffc1b9f57830a4d1c4f7af3884.jpg', '1', '2018-04-11 11:39:22', '2018-04-12 21:18:24');
INSERT INTO `users` VALUES ('6', 'blucks', '84a4d80510236aa29c7be34ebffd54b5', '0', 'blucks', 'http://localtp5.com\\uploads\\20180412\\965e46ebbe802e4d8cd9dc6a2f42d275.jpg', '1', '2018-04-11 11:39:22', '2018-04-12 21:18:21');
INSERT INTO `users` VALUES ('8', 'lijun', '61b3151941bb43fad57005524d1a967c', '2', 'lijun', 'http://localtp5.com\\uploads\\20180412\\de733238f526ca07cce2f22145307812.png', '1', '2018-04-12 16:10:35', '2018-04-12 22:43:47');
SET FOREIGN_KEY_CHECKS=1;
