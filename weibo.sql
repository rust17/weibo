/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50631
Source Host           : localhost:3306
Source Database       : weibo

Target Server Type    : MYSQL
Target Server Version : 50631
File Encoding         : 65001

Date: 2016-12-10 14:12:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for weibo_approve
-- ----------------------------
DROP TABLE IF EXISTS `weibo_approve`;
CREATE TABLE `weibo_approve` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `name` varchar(20) NOT NULL COMMENT '认证名称',
  `info` varchar(255) NOT NULL COMMENT '认证信息',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '认证状态',
  `create` int(10) NOT NULL COMMENT '申请时间',
  `uid` int(10) unsigned NOT NULL COMMENT '用户登录的ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weibo_approve
-- ----------------------------

-- ----------------------------
-- Table structure for weibo_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `weibo_auth_group`;
CREATE TABLE `weibo_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weibo_auth_group
-- ----------------------------
INSERT INTO `weibo_auth_group` VALUES ('1', '超级管理员', '1', '1,2,3,4,5,6');
INSERT INTO `weibo_auth_group` VALUES ('2', '普通管理员', '1', '2,3,4,5');
INSERT INTO `weibo_auth_group` VALUES ('3', '认证专员', '1', '3');
INSERT INTO `weibo_auth_group` VALUES ('4', '会员专员', '1', '2');
INSERT INTO `weibo_auth_group` VALUES ('5', '审核专员', '1', '3');

-- ----------------------------
-- Table structure for weibo_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `weibo_auth_group_access`;
CREATE TABLE `weibo_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weibo_auth_group_access
-- ----------------------------
INSERT INTO `weibo_auth_group_access` VALUES ('1', '1');
INSERT INTO `weibo_auth_group_access` VALUES ('2', '2');
INSERT INTO `weibo_auth_group_access` VALUES ('3', '3');

-- ----------------------------
-- Table structure for weibo_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `weibo_auth_rule`;
CREATE TABLE `weibo_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weibo_auth_rule
-- ----------------------------
INSERT INTO `weibo_auth_rule` VALUES ('1', 'Admin/Manage/', '管理员管理', '1', '1', '');
INSERT INTO `weibo_auth_rule` VALUES ('2', 'Admin/User/', '会员列表', '1', '1', '');
INSERT INTO `weibo_auth_rule` VALUES ('3', 'Admin/Approve/', '认证审核', '1', '1', '');
INSERT INTO `weibo_auth_rule` VALUES ('4', 'Admin/Topic/', '微博管理', '1', '1', '');
INSERT INTO `weibo_auth_rule` VALUES ('5', 'Admin/Comment/', '评论管理', '1', '1', '');
INSERT INTO `weibo_auth_rule` VALUES ('6', 'Admin/AuthGroup/', '权限控制', '1', '1', '');

-- ----------------------------
-- Table structure for weibo_comment
-- ----------------------------
DROP TABLE IF EXISTS `weibo_comment`;
CREATE TABLE `weibo_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '微博评论',
  `content` char(255) NOT NULL COMMENT '评论内容',
  `create` int(10) unsigned NOT NULL COMMENT '评论时间',
  `ip` int(10) unsigned NOT NULL COMMENT '评论者的ip',
  `tid` int(10) unsigned NOT NULL COMMENT '微博的ID',
  `uid` int(10) unsigned DEFAULT NULL COMMENT '用户ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `tid` (`tid`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weibo_comment
-- ----------------------------
INSERT INTO `weibo_comment` VALUES ('4', '第二次评论', '1472477103', '0', '43', '18');
INSERT INTO `weibo_comment` VALUES ('5', '第一次评论转发', '1472477122', '0', '37', '18');
INSERT INTO `weibo_comment` VALUES ('3', '第一次评论', '1472477088', '0', '43', '18');
INSERT INTO `weibo_comment` VALUES ('6', '第二次评论转发', '1472477135', '0', '37', '18');
INSERT INTO `weibo_comment` VALUES ('7', 'afafdsf', '1472555362', '0', '37', '18');

-- ----------------------------
-- Table structure for weibo_image
-- ----------------------------
DROP TABLE IF EXISTS `weibo_image`;
CREATE TABLE `weibo_image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `data` char(200) NOT NULL COMMENT '微博配图URL的JSON格式',
  `tid` int(10) unsigned NOT NULL COMMENT '配图绑定微博的ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weibo_image
-- ----------------------------
INSERT INTO `weibo_image` VALUES ('1', '{\"thumb\":\".\\/Uploads\\/2016-08-21\\/180_57b96db30fee8.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-21\\/550_57b96db30fee8.jpg\",\"source\":\".\\/Uploads\\/2016-08-21\\/57b96db30fee8.jpg\"}', '18');
INSERT INTO `weibo_image` VALUES ('2', '{\"thumb\":\".\\/Uploads\\/2016-08-21\\/180_57b96db4338d2.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-21\\/550_57b96db4338d2.jpg\",\"source\":\".\\/Uploads\\/2016-08-21\\/57b96db4338d2.jpg\"}', '18');
INSERT INTO `weibo_image` VALUES ('3', '{\"thumb\":\".\\/Uploads\\/2016-08-21\\/180_57b96db547fd4.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-21\\/550_57b96db547fd4.jpg\",\"source\":\".\\/Uploads\\/2016-08-21\\/57b96db547fd4.jpg\"}', '18');
INSERT INTO `weibo_image` VALUES ('4', '{\"thumb\":\".\\/Uploads\\/2016-08-21\\/180_57b96db665c04.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-21\\/550_57b96db665c04.jpg\",\"source\":\".\\/Uploads\\/2016-08-21\\/57b96db665c04.jpg\"}', '18');
INSERT INTO `weibo_image` VALUES ('5', '{\"thumb\":\".\\/Uploads\\/2016-08-21\\/180_57b96db7856a5.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-21\\/550_57b96db7856a5.jpg\",\"source\":\".\\/Uploads\\/2016-08-21\\/57b96db7856a5.jpg\"}', '18');
INSERT INTO `weibo_image` VALUES ('6', '{\"thumb\":\".\\/Uploads\\/2016-08-21\\/180_57b96db8a1af7.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-21\\/550_57b96db8a1af7.jpg\",\"source\":\".\\/Uploads\\/2016-08-21\\/57b96db8a1af7.jpg\"}', '18');
INSERT INTO `weibo_image` VALUES ('7', '{\"thumb\":\".\\/Uploads\\/2016-08-21\\/180_57b96db9c1a6f.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-21\\/550_57b96db9c1a6f.jpg\",\"source\":\".\\/Uploads\\/2016-08-21\\/57b96db9c1a6f.jpg\"}', '18');
INSERT INTO `weibo_image` VALUES ('8', '{\"thumb\":\".\\/Uploads\\/2016-08-21\\/180_57b96dbadeadd.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-21\\/550_57b96dbadeadd.jpg\",\"source\":\".\\/Uploads\\/2016-08-21\\/57b96dbadeadd.jpg\"}', '18');
INSERT INTO `weibo_image` VALUES ('9', '{\"thumb\":\".\\/Uploads\\/2016-08-21\\/180_57b96e5d59296.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-21\\/550_57b96e5d59296.jpg\",\"source\":\".\\/Uploads\\/2016-08-21\\/57b96e5d59296.jpg\"}', '19');
INSERT INTO `weibo_image` VALUES ('10', '{\"thumb\":\".\\/Uploads\\/2016-08-21\\/180_57b96e73b26be.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-21\\/550_57b96e73b26be.jpg\",\"source\":\".\\/Uploads\\/2016-08-21\\/57b96e73b26be.jpg\"}', '20');
INSERT INTO `weibo_image` VALUES ('11', '{\"thumb\":\".\\/Uploads\\/2016-08-21\\/180_57b9b2d228354.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-21\\/550_57b9b2d228354.jpg\",\"source\":\".\\/Uploads\\/2016-08-21\\/57b9b2d228354.jpg\"}', '21');
INSERT INTO `weibo_image` VALUES ('12', '{\"thumb\":\".\\/Uploads\\/2016-08-22\\/180_57bafd41a4057.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-22\\/550_57bafd41a4057.jpg\",\"source\":\".\\/Uploads\\/2016-08-22\\/57bafd41a4057.jpg\"}', '22');
INSERT INTO `weibo_image` VALUES ('13', '{\"thumb\":\".\\/Uploads\\/2016-08-22\\/180_57bafd42cbd40.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-22\\/550_57bafd42cbd40.jpg\",\"source\":\".\\/Uploads\\/2016-08-22\\/57bafd42cbd40.jpg\"}', '22');
INSERT INTO `weibo_image` VALUES ('14', '{\"thumb\":\".\\/Uploads\\/2016-08-23\\/180_57bb8461d84b9.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-23\\/550_57bb8461d84b9.jpg\",\"source\":\".\\/Uploads\\/2016-08-23\\/57bb8461d84b9.jpg\"}', '25');
INSERT INTO `weibo_image` VALUES ('15', '{\"thumb\":\".\\/Uploads\\/2016-08-23\\/180_57bb852f584cb.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-23\\/550_57bb852f584cb.jpg\",\"source\":\".\\/Uploads\\/2016-08-23\\/57bb852f584cb.jpg\"}', '26');
INSERT INTO `weibo_image` VALUES ('16', '{\"thumb\":\".\\/Uploads\\/2016-08-23\\/180_57bc4fad8c6f9.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-23\\/550_57bc4fad8c6f9.jpg\",\"source\":\".\\/Uploads\\/2016-08-23\\/57bc4fad8c6f9.jpg\"}', '28');
INSERT INTO `weibo_image` VALUES ('17', '{\"thumb\":\".\\/Uploads\\/2016-08-23\\/180_57bc4faeb5bf8.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-23\\/550_57bc4faeb5bf8.jpg\",\"source\":\".\\/Uploads\\/2016-08-23\\/57bc4faeb5bf8.jpg\"}', '28');
INSERT INTO `weibo_image` VALUES ('18', '{\"thumb\":\".\\/Uploads\\/2016-08-23\\/180_57bc4fafca6a5.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-23\\/550_57bc4fafca6a5.jpg\",\"source\":\".\\/Uploads\\/2016-08-23\\/57bc4fafca6a5.jpg\"}', '28');
INSERT INTO `weibo_image` VALUES ('19', '{\"thumb\":\".\\/Uploads\\/2016-08-23\\/180_57bc4fb0ebda6.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-23\\/550_57bc4fb0ebda6.jpg\",\"source\":\".\\/Uploads\\/2016-08-23\\/57bc4fb0ebda6.jpg\"}', '28');
INSERT INTO `weibo_image` VALUES ('20', '{\"thumb\":\".\\/Uploads\\/2016-08-23\\/180_57bc4fb21373a.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-23\\/550_57bc4fb21373a.jpg\",\"source\":\".\\/Uploads\\/2016-08-23\\/57bc4fb21373a.jpg\"}', '28');
INSERT INTO `weibo_image` VALUES ('21', '{\"thumb\":\".\\/Uploads\\/2016-08-23\\/180_57bc4fb333e6a.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-23\\/550_57bc4fb333e6a.jpg\",\"source\":\".\\/Uploads\\/2016-08-23\\/57bc4fb333e6a.jpg\"}', '28');
INSERT INTO `weibo_image` VALUES ('22', '{\"thumb\":\".\\/Uploads\\/2016-08-23\\/180_57bc4fb4502d5.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-23\\/550_57bc4fb4502d5.jpg\",\"source\":\".\\/Uploads\\/2016-08-23\\/57bc4fb4502d5.jpg\"}', '28');
INSERT INTO `weibo_image` VALUES ('23', '{\"thumb\":\".\\/Uploads\\/2016-08-23\\/180_57bc4fb570604.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-23\\/550_57bc4fb570604.jpg\",\"source\":\".\\/Uploads\\/2016-08-23\\/57bc4fb570604.jpg\"}', '28');
INSERT INTO `weibo_image` VALUES ('24', '{\"thumb\":\".\\/Uploads\\/2016-08-24\\/180_57bd9ef6e168a.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-24\\/550_57bd9ef6e168a.jpg\",\"source\":\".\\/Uploads\\/2016-08-24\\/57bd9ef6e168a.jpg\"}', '30');
INSERT INTO `weibo_image` VALUES ('25', '{\"thumb\":\".\\/Uploads\\/2016-08-28\\/180_57c2d9f6c41de.jpg\",\"unfold\":\".\\/Uploads\\/2016-08-28\\/550_57c2d9f6c41de.jpg\",\"source\":\".\\/Uploads\\/2016-08-28\\/57c2d9f6c41de.jpg\"}', '43');

-- ----------------------------
-- Table structure for weibo_manage
-- ----------------------------
DROP TABLE IF EXISTS `weibo_manage`;
CREATE TABLE `weibo_manage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `manager` char(20) NOT NULL COMMENT '管理员账号',
  `password` char(40) NOT NULL COMMENT '管理员密码',
  `create` int(10) NOT NULL COMMENT '创建的时间',
  `last_login` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录的时间',
  `last_ip` int(10) NOT NULL DEFAULT '0' COMMENT '最后登录的ip',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weibo_manage
-- ----------------------------
INSERT INTO `weibo_manage` VALUES ('1', 'admin', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '1471095099', '1473777820', '0');

-- ----------------------------
-- Table structure for weibo_nav
-- ----------------------------
DROP TABLE IF EXISTS `weibo_nav`;
CREATE TABLE `weibo_nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `text` char(20) NOT NULL COMMENT '菜单名称',
  `state` char(10) NOT NULL COMMENT '菜单状态',
  `nid` int(10) unsigned NOT NULL COMMENT '菜单层次',
  `url` char(20) DEFAULT '' COMMENT '模块链接',
  `iconCls` char(20) NOT NULL COMMENT '图标',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weibo_nav
-- ----------------------------
INSERT INTO `weibo_nav` VALUES ('1', '系统管理', 'closed', '0', '', 'icon-system');
INSERT INTO `weibo_nav` VALUES ('2', '权限控制', 'open', '1', 'AuthGroup/index', 'icon-key');
INSERT INTO `weibo_nav` VALUES ('3', '管理员管理', 'open', '1', 'Manage/index', 'icon-manager');
INSERT INTO `weibo_nav` VALUES ('4', '会员管理', 'closed', '0', '', 'icon-user');
INSERT INTO `weibo_nav` VALUES ('5', '会员列表', 'open', '4', 'User/index', 'icon-group');
INSERT INTO `weibo_nav` VALUES ('6', '认证审核', 'open', '4', 'Approve/index', 'icon-award');
INSERT INTO `weibo_nav` VALUES ('7', '内存管理', 'closed', '0', '', 'icon-folder');
INSERT INTO `weibo_nav` VALUES ('8', '微博管理', 'open', '7', 'Topic/index', 'icon-report');
INSERT INTO `weibo_nav` VALUES ('9', '评论管理', 'open', '7', 'Comment/index', 'icon-smile');

-- ----------------------------
-- Table structure for weibo_refer
-- ----------------------------
DROP TABLE IF EXISTS `weibo_refer`;
CREATE TABLE `weibo_refer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `tid` int(10) unsigned NOT NULL COMMENT '提醒微博',
  `uid` int(10) unsigned NOT NULL COMMENT '被@的用户',
  `read` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否阅读',
  `create` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `tid` (`tid`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weibo_refer
-- ----------------------------
INSERT INTO `weibo_refer` VALUES ('1', '48', '16', '0', '1472565904');
INSERT INTO `weibo_refer` VALUES ('2', '48', '17', '0', '1472565904');
INSERT INTO `weibo_refer` VALUES ('3', '49', '18', '0', '1472565933');

-- ----------------------------
-- Table structure for weibo_topic
-- ----------------------------
DROP TABLE IF EXISTS `weibo_topic`;
CREATE TABLE `weibo_topic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `content` char(255) NOT NULL COMMENT '微博内容',
  `content_over` char(25) DEFAULT NULL COMMENT '微博溢出的内容',
  `reid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '转发的原微博ID',
  `comcount` tinyint(1) unsigned zerofill NOT NULL COMMENT '评论次数',
  `recount` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '转发次数',
  `ip` int(10) NOT NULL COMMENT 'IP',
  `create` int(10) NOT NULL,
  `uid` int(10) NOT NULL COMMENT '发表用户',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weibo_topic
-- ----------------------------
INSERT INTO `weibo_topic` VALUES ('18', '分享图片', null, '0', '0', '0', '0', '1471770045', '18');
INSERT INTO `weibo_topic` VALUES ('19', '人活得虚伪容易，活得真实难。活得虚伪累，活得真实轻松；生活需要炼打，人生更需要顿悟。芝兰生于幽谷，不因无人问津而不劳，梅花开于墙隅，不因阳光不照而不香，流水绕石而过，不因山石之阻而纷争，这是一种淡定的宁静；高山无语，深水无波更是绚烂至极归于素净质朴，宁静深沉的境界。', null, '0', '0', '0', '0', '1471770206', '18');
INSERT INTO `weibo_topic` VALUES ('20', '面对这复杂、无情、冷漠、危险又有些温暖、简单、矛盾的世界，作为父亲我不知道能不能教好你去面对它。在你的翅膀没有长硬之前，我能不能给你足够的保护；我害怕你受到伤害，却不敢给太多的束缚，以致你无法展翅高飞；十分忐忑地害怕无法让你真实地看懂这世界，在懂得拥抱他人的同时也懂得保护自己。', null, '0', '0', '0', '0', '1471770228', '18');
INSERT INTO `weibo_topic` VALUES ('21', '测试刚刚发布', null, '0', '0', '0', '0', '1471787731', '18');
INSERT INTO `weibo_topic` VALUES ('22', '拉伸填充测试', null, '0', '0', '0', '0', '1471872326', '18');
INSERT INTO `weibo_topic` VALUES ('23', 'jkl', null, '0', '0', '0', '0', '1471874620', '18');
INSERT INTO `weibo_topic` VALUES ('24', '无配图', null, '0', '0', '0', '0', '1471875120', '18');
INSERT INTO `weibo_topic` VALUES ('25', '分享图片', null, '0', '0', '0', '0', '1471906915', '18');
INSERT INTO `weibo_topic` VALUES ('26', '分享图片', null, '0', '0', '0', '0', '1471907120', '18');
INSERT INTO `weibo_topic` VALUES ('27', '[a_0]', null, '0', '0', '0', '0', '1471958923', '18');
INSERT INTO `weibo_topic` VALUES ('28', '分享图片', null, '0', '0', '0', '0', '1471958967', '18');
INSERT INTO `weibo_topic` VALUES ('29', '[a_0]', null, '0', '0', '0', '0', '1471959581', '18');
INSERT INTO `weibo_topic` VALUES ('30', ' 测试', null, '0', '0', '0', '0', '1472044792', '18');
INSERT INTO `weibo_topic` VALUES ('31', '222', null, '0', '0', '0', '0', '1472044803', '18');
INSERT INTO `weibo_topic` VALUES ('32', '烦烦烦', null, '0', '0', '0', '0', '1472044811', '18');
INSERT INTO `weibo_topic` VALUES ('33', '顶顶顶', null, '0', '0', '0', '0', '1472044816', '18');
INSERT INTO `weibo_topic` VALUES ('34', '发发发', null, '0', '0', '0', '0', '1472044823', '18');
INSERT INTO `weibo_topic` VALUES ('35', '[a_4]', null, '0', '0', '0', '0', '1472046713', '18');
INSERT INTO `weibo_topic` VALUES ('36', '测试及时性', null, '0', '0', '0', '0', '1472297310', '18');
INSERT INTO `weibo_topic` VALUES ('37', '测试及时发布', null, '0', '3', '4', '0', '1472297344', '18');
INSERT INTO `weibo_topic` VALUES ('38', '测试', null, '0', '0', '0', '0', '1472298599', '17');
INSERT INTO `weibo_topic` VALUES ('39', '测试个性域名', null, '0', '0', '0', '0', '1472352847', '16');
INSERT INTO `weibo_topic` VALUES ('40', '@路飞1 您好', null, '0', '0', '0', '0', '1472364157', '16');
INSERT INTO `weibo_topic` VALUES ('41', '@炎日', null, '0', '0', '0', '0', '1472366274', '16');
INSERT INTO `weibo_topic` VALUES ('42', '测试转发微博', null, '37', '0', '0', '0', '1472381999', '16');
INSERT INTO `weibo_topic` VALUES ('43', '分享图片', null, '0', '2', '1', '0', '1472387579', '16');
INSERT INTO `weibo_topic` VALUES ('44', '转发有图微博', null, '43', '0', '0', '0', '1472387600', '16');
INSERT INTO `weibo_topic` VALUES ('45', '测试文本微博转发', null, '37', '0', '0', '0', '1472388343', '16');
INSERT INTO `weibo_topic` VALUES ('46', '转发测试', null, '37', '0', '0', '0', '1472391016', '16');
INSERT INTO `weibo_topic` VALUES ('47', ' 第二次转发|| @炎日: 转发测试', null, '37', '0', '0', '0', '1472471671', '18');
INSERT INTO `weibo_topic` VALUES ('48', '@炎日 @山治 @路飞1', null, '0', '0', '0', '0', '1472565904', '18');
INSERT INTO `weibo_topic` VALUES ('49', '@路飞1', null, '0', '0', '0', '0', '1472565933', '18');

-- ----------------------------
-- Table structure for weibo_user
-- ----------------------------
DROP TABLE IF EXISTS `weibo_user`;
CREATE TABLE `weibo_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `username` char(20) NOT NULL COMMENT '用户名',
  `password` char(40) NOT NULL COMMENT '密码',
  `face` char(200) DEFAULT NULL COMMENT '个人头像',
  `domain` char(10) DEFAULT NULL COMMENT '个性域名',
  `email` char(50) NOT NULL COMMENT '电子邮件',
  `create` int(10) unsigned NOT NULL COMMENT '注册时间',
  `last_login` int(10) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_ip` int(10) NOT NULL DEFAULT '0' COMMENT '最后登录  ip',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE,
  UNIQUE KEY `domain` (`domain`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weibo_user
-- ----------------------------
INSERT INTO `weibo_user` VALUES ('1', '路飞', '111111', null, null, 'lufei@163.com', '1471046398', '0', '0');
INSERT INTO `weibo_user` VALUES ('4', '樱桃小丸子', '111111', null, null, 'yingtao@163.com', '1471046564', '0', '0');
INSERT INTO `weibo_user` VALUES ('6', '黑崎一护', '111111', null, null, 'yihu@163.com', '0', '0', '0');
INSERT INTO `weibo_user` VALUES ('7', '夏天', '111111', null, null, 'xiatian@163.com', '0', '0', '0');
INSERT INTO `weibo_user` VALUES ('9', '娜美', '111111', null, null, 'namei@163.com', '0', '0', '0');
INSERT INTO `weibo_user` VALUES ('16', '炎日', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', null, 'yanri', '', '1471066475', '1472354611', '0');
INSERT INTO `weibo_user` VALUES ('17', '山治', '7c4a8d09ca3762af61e59520943dc26494f8941b', null, 'shanzhi', 'shanzhi@163.com', '1471093558', '1472298587', '0');
INSERT INTO `weibo_user` VALUES ('18', '路飞1', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '{\"big\":\".\\/Uploads\\/face\\/18.jpg\",\"small\":\".\\/Uploads\\/face\\/18_small.jpg\"}', 'lufei1', 'lufei1@163.com', '1471095099', '1480729925', '0');
INSERT INTO `weibo_user` VALUES ('19', 'bdagag', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', null, null, 'afaf@163.com', '1473690366', '0', '0');

-- ----------------------------
-- Table structure for weibo_user_extend
-- ----------------------------
DROP TABLE IF EXISTS `weibo_user_extend`;
CREATE TABLE `weibo_user_extend` (
  `intro` varchar(255) DEFAULT NULL COMMENT '用户简介',
  `uid` int(10) unsigned NOT NULL COMMENT '关联用户ID',
  UNIQUE KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weibo_user_extend
-- ----------------------------
INSERT INTO `weibo_user_extend` VALUES (null, '16');
INSERT INTO `weibo_user_extend` VALUES (null, '17');
INSERT INTO `weibo_user_extend` VALUES ('我是路飞，多多指教', '18');
INSERT INTO `weibo_user_extend` VALUES ('', '19');
SET FOREIGN_KEY_CHECKS=1;
