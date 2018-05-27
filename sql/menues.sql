/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tp5

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-05-28 00:33:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for menues
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of menues
-- ----------------------------
INSERT INTO `menues` VALUES ('1', '0', '首页', '/admin/Index/index', '100', '1', 'admin', 'Index', 'index', '1', 'homepage', '1', '2018-04-10 20:15:13', '2018-04-10 20:15:15');
INSERT INTO `menues` VALUES ('2', '1', '首页欢迎页', '/admin/Index/index', '10', '1', 'admin', 'Index', 'index', '1', 'homepage', '2', '2018-04-10 20:15:13', '2018-04-10 20:15:13');
INSERT INTO `menues` VALUES ('3', '0', '系统管理', '/admin/Usermanage/userlist', '10', '1', 'admin', 'Usermanage', 'userlist', '1', 'usermanage', '1', '2018-04-10 20:15:13', '2018-04-10 20:15:13');
INSERT INTO `menues` VALUES ('4', '3', '用户管理', '/admin/Usermanage/index', '20', '1', 'admin', 'Usermanage', 'index', '1', 'userindex', '2', '2018-04-10 20:15:13', '2018-04-10 20:15:13');
INSERT INTO `menues` VALUES ('5', '4', '用户列表', '/admin/Usermanage/userlist', '10', '1', 'admin', 'Usermanage', 'userlist', '1', 'usermanage', '3', '2018-04-10 20:15:13', '2018-04-10 20:15:13');
INSERT INTO `menues` VALUES ('6', '3', '权限管理', '/admin/Powermanage/index', '30', '1', 'admin', 'Powermanage', 'index', '1', 'powerindex', '2', '2018-04-10 20:15:13', '2018-04-21 19:49:05');
INSERT INTO `menues` VALUES ('7', '6', '角色列表', '/admin/Powermanage/rolelist', '10', '1', 'admin', 'Powermanage', 'rolelist', '1', 'rolelist', '3', '2018-04-10 20:15:13', '2018-04-10 20:15:13');
INSERT INTO `menues` VALUES ('8', '6', '节点列表', '/admin/Powermanage/nodelist', '20', '1', 'admin', 'Powermanage', 'nodelist', '1', 'nodelist', '3', '2018-04-10 20:15:13', '2018-04-10 20:15:13');
INSERT INTO `menues` VALUES ('9', '3', '系统设置', '/admin/Sysmanage/index', '30', '1', 'admin', 'Sysmanage', 'index', '1', 'systemindex', '2', '2018-04-10 20:15:13', '2018-04-10 20:15:13');
INSERT INTO `menues` VALUES ('10', '4', '用户新增', '/admin/Usermanage/add', '20', '2', 'admin', 'Usermanage', 'add', '1', 'useradd', '3', '2018-04-10 20:15:13', '2018-04-10 20:15:13');
INSERT INTO `menues` VALUES ('11', '4', '用户编辑', '/admin/Usermanage/edit', '30', '2', 'admin', 'Usermanage', 'edit', '1', 'useredit', '3', '2018-04-10 20:15:13', '2018-04-10 20:15:13');
INSERT INTO `menues` VALUES ('12', '4', '用户删除', '/admin/Usermanage/delete', '40', '2', 'admin', 'Usermanage', 'delete', '1', 'userdelete', '3', '2018-04-10 20:15:13', '2018-04-10 20:15:13');
INSERT INTO `menues` VALUES ('18', '6', '节点新增', '/admin/Powermanage/add', '21', '2', 'admin', 'Powermanage', 'add', '1', 'nodeadd', '3', '2018-04-21 19:58:48', '2018-04-21 19:58:51');
INSERT INTO `menues` VALUES ('19', '6', '节点编辑', '/admin/Powermanage/edit', '23', '2', 'admin', 'Powermanage', 'edit', '1', 'nodeedit', '3', '2018-04-21 20:00:56', '2018-04-21 20:00:59');
INSERT INTO `menues` VALUES ('20', '6', '节点删除', '/admin/Powermanage/delete', '25', '2', 'admin', 'Powermanage', 'delete', '1', 'nodedelete', '3', '2018-04-21 20:00:56', '2018-04-21 20:00:56');
INSERT INTO `menues` VALUES ('21', '6', '角色新增', '/admin/Powermanage/roleadd', '11', '2', 'admin', 'Powermanage', 'roleadd', '1', 'roleadd', '3', '2018-04-21 20:00:56', '2018-04-21 20:00:56');
INSERT INTO `menues` VALUES ('22', '6', '角色编辑', '/admin/Powermanage/roleedit', '13', '2', 'admin', 'Powermanage', 'roleedit', '1', 'roleedit', '3', '2018-04-21 20:00:56', '2018-04-21 20:00:56');
INSERT INTO `menues` VALUES ('23', '6', '角色删除', '/admin/Powermanage/roledelete', '15', '2', 'admin', 'Powermanage', 'roledelete', '1', 'roledelete', '3', '2018-04-21 20:00:56', '2018-04-21 20:00:56');
INSERT INTO `menues` VALUES ('24', '6', '角色成员查看', '/admin/Powermanage/roleusers', '16', '2', 'admin', 'Powermanage', 'roleusers', '1', 'roleusers', '3', '2018-04-21 22:06:10', '2018-04-21 22:06:10');
INSERT INTO `menues` VALUES ('25', '6', '取消角色授权', '/admin/Powermanage/deluserrole', '17', '2', 'admin', 'Powermanage', 'deluserrole', '1', 'deluserrole', '3', '2018-04-21 22:08:22', '2018-04-21 22:08:22');
INSERT INTO `menues` VALUES ('26', '9', '系统变量新增', '/admin/Sysmanage/add', '10', '2', 'admin', 'Sysmanage', 'add', '1', 'varadd', '3', '2018-04-25 00:57:06', '2018-04-25 01:00:15');
INSERT INTO `menues` VALUES ('27', '9', '系统变量编辑', '/admin/Sysmanage/edit', '20', '2', 'admin', 'Sysmanage', 'edit', '1', 'varedit', '3', '2018-04-25 00:57:57', '2018-04-25 01:00:25');
INSERT INTO `menues` VALUES ('28', '9', '系统变量删除', '/admin/Sysmanage/delete', '30', '2', 'admin', 'Sysmanage', 'delete', '1', 'vardelete', '3', '2018-04-25 00:58:39', '2018-04-25 01:00:36');
INSERT INTO `menues` VALUES ('29', '6', '权限查看编辑', '/admin/Powermanage/rolenodes', '18', '2', 'admin', 'Powermanage', 'rolenodes', '1', 'rolenodes', '3', '2018-05-05 21:39:57', '2018-05-05 21:39:57');
INSERT INTO `menues` VALUES ('30', '9', '邮件功能测试', '/admin/Sysmanage/checkEmailFunc', '40', '2', 'admin', 'Sysmanage', 'checkEmailFunc', '1', 'checkEmailFunc', '3', '2018-05-19 17:44:27', '2018-05-19 17:44:27');
INSERT INTO `menues` VALUES ('31', '1', '图表统计', '/admin/Index/chartstatistic', '10', '1', 'admin', 'Index', 'chartstatistic', '1', 'chartstatistic', '2', '2018-05-26 10:53:14', '2018-05-26 10:53:14');
INSERT INTO `menues` VALUES ('32', '4', '用户导入', '/admin/usermanage/importuser', '10', '2', 'admin', 'usermanage', 'importuser', '1', 'importuser', '3', '2018-05-28 00:32:29', '2018-05-28 00:32:29');
SET FOREIGN_KEY_CHECKS=1;
