/*
 Navicat Premium Data Transfer

 Source Server         : 2018_本地
 Source Server Type    : MySQL
 Source Server Version : 50717
 Source Host           : localhost:3306
 Source Schema         : qy_vueadmin

 Target Server Type    : MySQL
 Target Server Version : 50717
 File Encoding         : 65001

 Date: 07/07/2020 10:08:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for kj_admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `kj_admin_menu`;
CREATE TABLE `kj_admin_menu`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(11) UNSIGNED DEFAULT 0 COMMENT '上级菜单id',
  `module` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '模块名称',
  `title` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '菜单标题',
  `icon` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '菜单图标',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `component` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `url_value` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '链接地址',
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `create_time` int(11) UNSIGNED DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) UNSIGNED DEFAULT 0 COMMENT '更新时间',
  `sort` int(11) DEFAULT 100 COMMENT '排序',
  `system_menu` tinyint(4) UNSIGNED DEFAULT 0 COMMENT '是否为系统菜单，系统菜单不可删除',
  `status` tinyint(2) DEFAULT 1 COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '后台菜单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_admin_menu
-- ----------------------------
INSERT INTO `kj_admin_menu` VALUES (1, 0, 'admin', '首页', 'home', 'index', 'admin/index', 'admin/index/auth_list', '/', 1593417925, 1593573991, 0, 1, 1);
INSERT INTO `kj_admin_menu` VALUES (2, 0, 'admin', '权限管理', 'grip-horizontal', 'AdminAuth', 'Layout', 'admin/role/index', '/admin', 1593420172, 1594087147, 1, 1, 1);
INSERT INTO `kj_admin_menu` VALUES (20, 5, '0', '编辑', '0', '0', '0', 'admin/menu/edit', '0', 1593573430, 1593574049, 2, 0, 1);
INSERT INTO `kj_admin_menu` VALUES (5, 2, 'admin', '菜单管理', 'grip-horizontal', 'AdminAuthMenu', 'admin/auth/menu', 'admin/menu/index', 'AdminAuthMenu', 1593420460, 1593586978, 10, 1, 1);
INSERT INTO `kj_admin_menu` VALUES (6, 2, 'admin', '用户管理', 'user-alt', 'AdminAuthUser', 'admin/auth/user', 'admin/user/index', 'AdminAuthUser', 1593420460, 1593574139, 10, 1, 1);
INSERT INTO `kj_admin_menu` VALUES (7, 2, 'admin', '角色管理', 'hammer', 'AdminAuthRole', 'admin/auth/role', 'admin/role/index', 'AdminAuthRole', 1593420460, 1593586942, 2, 1, 1);
INSERT INTO `kj_admin_menu` VALUES (21, 5, '0', '删除', '0', '0', '0', 'admin/menu/delete', '0', 1593573611, 1593574066, 3, 0, 1);
INSERT INTO `kj_admin_menu` VALUES (22, 6, '00', '编辑', '0', '00', '0', 'admin/user/edit', '00', 1593573647, 1593574164, 2, 0, 1);
INSERT INTO `kj_admin_menu` VALUES (23, 6, '0', '删除', '0', '0', '0', 'admin/user/delete', '0', 1593573659, 1593574172, 3, 0, 1);
INSERT INTO `kj_admin_menu` VALUES (24, 7, '0', '编辑', '0', '0', '0', 'admin/role/edit', '0', 1593573675, 1593574114, 2, 0, 1);
INSERT INTO `kj_admin_menu` VALUES (25, 7, '0', '删除', '0', '0', '0', 'admin/role/delete', '0', 1593573693, 1593574122, 3, 0, 1);
INSERT INTO `kj_admin_menu` VALUES (26, 5, '0', '列表', '0', '0', '0', 'admin/menu/index', '0', 1593573797, 1593574033, 1, 0, 1);
INSERT INTO `kj_admin_menu` VALUES (27, 6, '0', '列表', '0', '0', '0', 'admin/user/index', '0', 1593573815, 1593574151, 1, 0, 1);
INSERT INTO `kj_admin_menu` VALUES (28, 7, '0', '列表', '0', '0', '0', 'admin/role/index', '0', 1593573830, 1593574104, 1, 0, 1);
INSERT INTO `kj_admin_menu` VALUES (29, 7, '0', '查找', '0', '0', '0', 'admin/role/find', '0', 1593580132, 1593580162, 0, 0, 1);

-- ----------------------------
-- Table structure for kj_admin_module
-- ----------------------------
DROP TABLE IF EXISTS `kj_admin_module`;
CREATE TABLE `kj_admin_module`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模块名称（标识）',
  `title` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模块标题',
  `icon` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图标',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '描述',
  `author` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '作者',
  `author_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '作者主页',
  `config` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '配置信息',
  `access` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '授权配置',
  `version` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '版本号',
  `identifier` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模块唯一标识符',
  `system_module` tinyint(4) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否为系统模块',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  `sort` int(11) NOT NULL DEFAULT 100 COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '模块表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_admin_module
-- ----------------------------
INSERT INTO `kj_admin_module` VALUES (1, 'admin', '系统', 'fa fa-fw fa-gear', '系统模块QYPHP的核心模块', 'QYPHP', 'http://www.dolphinphp.com', '', '', '1.0.0', 'admin.dolphinphp.module', 1, 1468204902, 1468204902, 100, 1);
INSERT INTO `kj_admin_module` VALUES (2, 'user', '用户', 'fa fa-fw fa-user', '用户模块，QYPHP自带模块', 'QYPHP', 'http://www.dolphinphp.com', '', '', '1.0.0', 'user.dolphinphp.module', 1, 1468204902, 1468204902, 100, 1);

-- ----------------------------
-- Table structure for kj_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `kj_admin_role`;
CREATE TABLE `kj_admin_role`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `pid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级角色',
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '角色描述',
  `menu_auth` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '菜单权限',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '状态',
  `access` tinyint(4) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否可登录后台',
  `default_module` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '默认访问模块',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 29 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '角色表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_admin_role
-- ----------------------------
INSERT INTO `kj_admin_role` VALUES (1, 0, '超级管理员', '系统默认创建的角色，拥有最高权限', '', 0, 1476270000, 1468117612, 1, 1, 0);
INSERT INTO `kj_admin_role` VALUES (27, 0, '游客', '游客', '[1,2,5,7,26,28,29]', 0, 1593579128, 1593580205, 1, 0, 0);
INSERT INTO `kj_admin_role` VALUES (28, 0, '客服', '客服', '[1,2,7,29,28,5,26,6,27]', 0, 1593580953, 1593580953, 1, 0, 0);

-- ----------------------------
-- Table structure for kj_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `kj_admin_user`;
CREATE TABLE `kj_admin_user`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `access_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '用户名',
  `nickname` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '昵称',
  `password` varchar(96) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '密码',
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '邮箱地址',
  `email_bind` tinyint(1) UNSIGNED DEFAULT 0 COMMENT '是否绑定邮箱地址',
  `mobile` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '手机号码',
  `mobile_bind` tinyint(1) UNSIGNED DEFAULT 0 COMMENT '是否绑定手机号码',
  `avatar` int(11) UNSIGNED DEFAULT 0 COMMENT '头像',
  `money` decimal(11, 2) UNSIGNED DEFAULT 0.00 COMMENT '余额',
  `score` int(11) UNSIGNED DEFAULT 0 COMMENT '积分',
  `role` int(11) UNSIGNED DEFAULT 0 COMMENT '角色ID',
  `group` int(11) UNSIGNED DEFAULT 0 COMMENT '部门id',
  `signup_ip` bigint(20) UNSIGNED DEFAULT 0 COMMENT '注册ip',
  `last_login_time` int(11) UNSIGNED DEFAULT 0 COMMENT '最后一次登录时间',
  `last_login_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0' COMMENT '登录ip',
  `sort` int(11) DEFAULT 100 COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '状态：0禁用，1启用',
  `is_delete` smallint(1) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kj_admin_user
-- ----------------------------
INSERT INTO `kj_admin_user` VALUES (1, '9b99e9ffeafd6919f2af8f16f4abbc2697be', 'admin', '超级管理员', 'f6fdffe48c908deb0f4c3bd36c032e72', '', 0, '', 0, 2, 0.00, 0, 1, 0, 0, 1593575070, '192.168.1.16', 100, 0, 0);
INSERT INTO `kj_admin_user` VALUES (19, 'ffbb6fb3543b7be16e07471feb68b0a9f27d6c2b', 'demo', '游客', 'e10adc3949ba59abbe56e057f20f883e', '', 0, '', 0, 0, 0.00, 0, 27, 0, 0, 1593587320, '192.168.1.16', 100, 0, 0);
INSERT INTO `kj_admin_user` VALUES (21, '9b99e9ffeafd6919f2af8f16f4abbc2697be', 'AA', '超级管理员', '3b98e2dffc6cb06a89dcb0d5c60a0206', '', 0, '', 0, 0, 0.00, 0, 1, 0, 0, 0, '0', 100, 0, 0);
INSERT INTO `kj_admin_user` VALUES (20, '3ccfef1a6624198d0f4de51e8069a69f37686abd', 'kefu', '客服', 'e10adc3949ba59abbe56e057f20f883e', '', 0, '', 0, 0, 0.00, 0, 28, 0, 0, 1593581027, '192.168.1.16', 100, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
