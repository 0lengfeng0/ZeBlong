/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : blong

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2017-11-24 17:12:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ze_category
-- ----------------------------
DROP TABLE IF EXISTS `ze_category`;
CREATE TABLE `ze_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '分类名',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(0-否,1-是)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ze_category
-- ----------------------------
INSERT INTO `ze_category` VALUES ('1', 'PHP', '1510208146', '1');
INSERT INTO `ze_category` VALUES ('2', 'DB', '1510208141', '0');
INSERT INTO `ze_category` VALUES ('3', 'asqwe', '1510210196', '0');
INSERT INTO `ze_category` VALUES ('4', 'asd', '1510210295', '0');
INSERT INTO `ze_category` VALUES ('5', 'aaaaaaaaaa', '1510210370', '0');
INSERT INTO `ze_category` VALUES ('6', 'qweqw', '1510210411', '0');
INSERT INTO `ze_category` VALUES ('7', 'asdasdsd', '1510210485', '0');
INSERT INTO `ze_category` VALUES ('8', 'wqewq', '1510911433', '0');
INSERT INTO `ze_category` VALUES ('9', '12312', '1510911436', '0');
INSERT INTO `ze_category` VALUES ('10', '312312', '1510911439', '0');
INSERT INTO `ze_category` VALUES ('11', 'dasdasd', '1510911497', '1');

-- ----------------------------
-- Table structure for ze_comment
-- ----------------------------
DROP TABLE IF EXISTS `ze_comment`;
CREATE TABLE `ze_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL COMMENT '评论内容',
  `create_time` int(11) NOT NULL COMMENT '评论时间',
  `is_anonymous` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否匿名(0-否，1-是)',
  `ip` varchar(255) NOT NULL DEFAULT '0,0,0,0' COMMENT '评论人IP地址',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '评论人id',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(0-否，1-是)',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '所回复的评论id',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '评论类型（1-网站留言，2-博文评论）',
  `cid` int(11) NOT NULL DEFAULT '0' COMMENT '博文评论相关评论id',
  `floor` int(255) NOT NULL DEFAULT '0' COMMENT '楼层数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ze_comment
-- ----------------------------
INSERT INTO `ze_comment` VALUES ('1', '一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十', '12', '1', '192.168.1.82', '0', '0', '0', '1', '0', '1');
INSERT INTO `ze_comment` VALUES ('2', '评论2', '131', '1', '192.168.2.2', '0', '0', '0', '1', '0', '2');
INSERT INTO `ze_comment` VALUES ('3', '评论3', '989', '1', '192.168.3.2', '0', '0', '0', '1', '0', '3');

-- ----------------------------
-- Table structure for ze_content
-- ----------------------------
DROP TABLE IF EXISTS `ze_content`;
CREATE TABLE `ze_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '文章标题',
  `abstract` varchar(255) DEFAULT '' COMMENT '文章摘要',
  `category_id` int(11) NOT NULL COMMENT '分类id',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否被删除(0-否，1-是)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ze_content
-- ----------------------------
INSERT INTO `ze_content` VALUES ('1', '测试', '123', '1', '1', '1', '0');
INSERT INTO `ze_content` VALUES ('2', '测试2', '阿萨德', '2', '12312312', '3', '0');
INSERT INTO `ze_content` VALUES ('8', '测试3', '', '8', '1511322363', '1511322363', '0');
INSERT INTO `ze_content` VALUES ('9', '测试4', '', '2', '1511322421', '1511322421', '0');
INSERT INTO `ze_content` VALUES ('10', '测试5', '', '2', '1511328110', '1511329486', '0');
INSERT INTO `ze_content` VALUES ('11', 'ceshi1', '', '2', '1511332507', '1511332507', '0');

-- ----------------------------
-- Table structure for ze_content_detail
-- ----------------------------
DROP TABLE IF EXISTS `ze_content_detail`;
CREATE TABLE `ze_content_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL COMMENT '所属文章id',
  `content` text COMMENT '文章内容',
  `read_num` int(11) DEFAULT '0' COMMENT '浏览量',
  `author` varchar(255) DEFAULT '' COMMENT '作者[暂空/备用字段]',
  `comment_num` int(11) DEFAULT '0' COMMENT '评论数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ze_content_detail
-- ----------------------------
INSERT INTO `ze_content_detail` VALUES ('1', '1', '1231231', '0', 'Zeee', '0');
INSERT INTO `ze_content_detail` VALUES ('2', '2', '213阿萨德', '0', 'Zeee', '0');
INSERT INTO `ze_content_detail` VALUES ('3', '8', '#按时大大\nassdasd\nasdd\nasdsds\nd\nda\nsda\nsd\nasd\ns\nda\nsda\nsd\nsd\nasd\ns\nd', '0', 'z', '0');
INSERT INTO `ze_content_detail` VALUES ('4', '9', '#按时大大\nassdasd\nasdd\nasdsds\nd\nda\nsda\nsd\nasd\ns\nda\nsda\nsd\nsd\nasd\ns\nd', '0', 'zjkk', '0');
INSERT INTO `ze_content_detail` VALUES ('5', '10', '#asaasdad\n// asdasdaa asda...按时大大撒所大所多', '0', 'zyz', '0');
INSERT INTO `ze_content_detail` VALUES ('6', '11', '#ssasasdads\n```\nasdasd\n<a>asdasdasdadad</a>\n```\n- 1213132123\n- 123213\nfdsdfgfd dfg sdf sdf    dfsgdf \n\nsadasdasssssssssssssssssss\ndasdas\nasd\ndas\ndas\nda\nsd\nasd', '0', 'asasas', '0');

-- ----------------------------
-- Table structure for ze_member
-- ----------------------------
DROP TABLE IF EXISTS `ze_member`;
CREATE TABLE `ze_member` (
  `id` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL COMMENT '昵称',
  `phone` varchar(255) DEFAULT '' COMMENT '电话',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `head_pic` varchar(255) DEFAULT '' COMMENT '头像',
  `qq_id` varchar(255) DEFAULT NULL COMMENT 'qqid',
  `sina_id` varchar(255) DEFAULT NULL COMMENT 'sinaid',
  `wx_id` varchar(255) DEFAULT NULL COMMENT 'wxid',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ze_member
-- ----------------------------

-- ----------------------------
-- Table structure for ze_pic
-- ----------------------------
DROP TABLE IF EXISTS `ze_pic`;
CREATE TABLE `ze_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL COMMENT '图片路径',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '图片类型(1-文章，2-头像，3-博主头像)',
  `relation_id` int(11) DEFAULT '0' COMMENT '关联id(文章id,用户id)',
  `create_time` int(11) DEFAULT '0' COMMENT '上传时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ze_pic
-- ----------------------------
INSERT INTO `ze_pic` VALUES ('1', '\\uploads\\20171114\\a83f3897af575f90225b529234c59d9f.png', '3', '0', '1510629273');
INSERT INTO `ze_pic` VALUES ('2', '\\uploads\\20171114\\f2c1bb3f4f2e1248158250f63f607151.png', '3', '0', '1510629335');
INSERT INTO `ze_pic` VALUES ('3', '\\uploads\\20171114\\322e20146c0f1fafe6f2429c870896d8.jpg', '3', '0', '1510630839');
INSERT INTO `ze_pic` VALUES ('4', '\\uploads\\20171114\\c2f45320e66cfa97c38a77960847f797.png', '3', '0', '1510635993');
INSERT INTO `ze_pic` VALUES ('5', '\\uploads\\20171114\\db6c404a70e77a6cf1d70f3d334a042c.png', '3', '0', '1510636096');
INSERT INTO `ze_pic` VALUES ('6', '\\uploads\\20171114\\057d04c97c83c4e2a69482c29ea5ead1.jpg', '3', '0', '1510636178');
INSERT INTO `ze_pic` VALUES ('7', '\\uploads\\20171114\\52b4efb79648c755ffdc7f96087096e0.png', '3', '0', '1510636220');
INSERT INTO `ze_pic` VALUES ('8', '\\uploads\\20171114\\a3e584d4a14b6eb3e4784600c72fde02.png', '3', '0', '1510636222');
INSERT INTO `ze_pic` VALUES ('9', '\\uploads\\20171114\\06dcf5b84577fdd1d34e0d4d10c8b4cb.png', '3', '0', '1510636225');
INSERT INTO `ze_pic` VALUES ('10', '\\uploads\\20171114\\1276d03b6b3bb7c1d31380ddbe89ee35.png', '3', '0', '1510636369');
INSERT INTO `ze_pic` VALUES ('11', '\\uploads\\20171114\\0ecee6474da86796683c738e6efaabf2.jpg', '3', '0', '1510636371');
INSERT INTO `ze_pic` VALUES ('12', '\\uploads\\20171114\\18c4a04faeee50598723d7c7827a7c57.jpg', '3', '0', '1510636443');
INSERT INTO `ze_pic` VALUES ('13', '\\uploads\\20171114\\f7217b858b79df64b5bc9be63f93872c.png', '3', '0', '1510636449');
INSERT INTO `ze_pic` VALUES ('14', '\\uploads\\20171114\\91f7daea788b4012442d28563171bd49.jpg', '3', '0', '1510636469');
INSERT INTO `ze_pic` VALUES ('15', '\\uploads\\20171114\\e4df706dde4e71f18b0b753ff40a7d2f.png', '3', '0', '1510636473');
INSERT INTO `ze_pic` VALUES ('16', '\\uploads\\20171114\\b5e07ccc112c55c4cfa4c213ae475316.jpg', '3', '0', '1510636514');
INSERT INTO `ze_pic` VALUES ('17', '\\uploads\\20171114\\0d3cc1294497925df23d939cc4d2088e.jpg', '3', '0', '1510636709');
INSERT INTO `ze_pic` VALUES ('18', '\\uploads\\20171114\\6208aaaf1858eebf3bafeeeddfadd9ed.png', '3', '0', '1510636715');
INSERT INTO `ze_pic` VALUES ('19', '\\uploads\\20171114\\e6ce512b255472bd5f79ceeac6488756.jpg', '3', '0', '1510637161');
INSERT INTO `ze_pic` VALUES ('20', '\\uploads\\20171114\\3f9b081ec931f1b1e00e3295f09dd49d.png', '3', '0', '1510637471');
INSERT INTO `ze_pic` VALUES ('21', '\\uploads\\20171114\\a4291ec2f68f9b56712a2013ed15eecc.jpg', '3', '0', '1510637474');
INSERT INTO `ze_pic` VALUES ('22', '\\uploads\\20171114\\ff0fdf199cb77eadd1751a7d1812f601.jpg', '3', '0', '1510637497');
INSERT INTO `ze_pic` VALUES ('23', '\\uploads\\20171114\\4f8c7e9c1786ccebc26da6004a213a62.jpg', '3', '0', '1510647196');
INSERT INTO `ze_pic` VALUES ('24', '\\uploads\\20171114\\628f2f4d4af2d93992b1fa3d5bfd3b3c.png', '3', '0', '1510647264');
INSERT INTO `ze_pic` VALUES ('25', '\\uploads\\20171114\\0ff6b9912cd3665fde0aaac78ad58288.png', '3', '0', '1510647281');
INSERT INTO `ze_pic` VALUES ('26', '\\uploads\\20171114\\09802b576b7f2e38890fb3933f55b6fb.jpg', '3', '0', '1510647342');
INSERT INTO `ze_pic` VALUES ('27', '\\uploads\\20171114\\7566c1debe6baacbd6a678377f92cb72.png', '3', '0', '1510647368');
INSERT INTO `ze_pic` VALUES ('28', '\\uploads\\20171114\\8120ac57a6c0b701035fd4728c6a3afd.jpg', '3', '0', '1510647606');
INSERT INTO `ze_pic` VALUES ('29', '\\uploads\\20171114\\703c879c62ca8d7feebff3ac9b9b802c.jpg', '3', '0', '1510647847');
INSERT INTO `ze_pic` VALUES ('30', '\\uploads\\20171114\\a5cbab917a0b7a1e8b866c7ef0c8a12a.png', '3', '0', '1510647934');
INSERT INTO `ze_pic` VALUES ('31', '\\uploads\\20171114\\cefea8d5fb7c964adb27562ccd476a0f.png', '3', '0', '1510647945');
INSERT INTO `ze_pic` VALUES ('32', '\\uploads\\20171114\\d2b49c1d0d7e6c2f25158c9c86c0c82f.png', '3', '0', '1510651499');
INSERT INTO `ze_pic` VALUES ('33', '\\uploads\\20171114\\8581c3f8e9851d7f790cc0ebb15f0ef3.jpg', '3', '0', '1510651501');
INSERT INTO `ze_pic` VALUES ('34', '\\uploads\\20171114\\8a579b01460aad1c58372d1c22d98354.jpg', '3', '0', '1510651884');
INSERT INTO `ze_pic` VALUES ('35', '\\uploads\\20171114\\e6e02a11743bfdaa99d2e6ab42baf9af.jpg', '3', '0', '1510651885');
INSERT INTO `ze_pic` VALUES ('36', '\\uploads\\20171115\\e445c6ac57a1075ff21ba6ece59c5d21.png', '3', '0', '1510708335');
INSERT INTO `ze_pic` VALUES ('37', '\\uploads\\20171115\\17e344520c1b54a44242c4e2976c458e.jpg', '3', '0', '1510708337');
INSERT INTO `ze_pic` VALUES ('38', '\\uploads\\20171115\\d290c74fc0a454e73542e440d859dc0e.png', '3', '0', '1510711012');
INSERT INTO `ze_pic` VALUES ('39', '\\uploads\\20171115\\9556fbfcae82c8a01dd5ad833ec2a899.JPG', '3', '0', '1510712082');
INSERT INTO `ze_pic` VALUES ('40', '\\uploads\\20171115\\8c09b3bca19a2d9b7c958917494b855c.png', '3', '0', '1510714211');
INSERT INTO `ze_pic` VALUES ('41', '\\uploads\\20171115\\1fb0471775b384010cebc248c35333e9.png', '3', '0', '1510714740');
INSERT INTO `ze_pic` VALUES ('42', '\\uploads\\20171115\\b59fb03285ddca870fbd18fba072ce27.png', '3', '0', '1510714744');
INSERT INTO `ze_pic` VALUES ('43', '\\uploads\\20171115\\0156ee97652bf42e76d378b8cc421076.jpg', '3', '0', '1510715242');
INSERT INTO `ze_pic` VALUES ('44', '\\uploads\\20171115\\ac77a8aa4cc944d539f6fd25254fc1f5.png', '3', '0', '1510715245');
INSERT INTO `ze_pic` VALUES ('45', '\\uploads\\20171115\\698b204c4b288b30cfead507d1d70a6f.png', '3', '0', '1510715250');
INSERT INTO `ze_pic` VALUES ('46', '\\uploads\\20171115\\3a22a4ac412f0992651298e3ebc280ce.png', '3', '0', '1510715456');
INSERT INTO `ze_pic` VALUES ('47', '\\uploads\\20171115\\19ac9166bf9517ccb23b1bb264b09b4f.png', '3', '0', '1510715459');
INSERT INTO `ze_pic` VALUES ('48', '\\uploads\\20171115\\80fdfb035667872f1a58adfee21ce7ee.jpg', '3', '0', '1510716026');
INSERT INTO `ze_pic` VALUES ('49', '\\uploads\\20171115\\607c1779734ae17dc8c8de7851e5a252.png', '3', '0', '1510716029');
INSERT INTO `ze_pic` VALUES ('50', '\\uploads\\20171115\\ecb048969b6b64fe294aa005df90852f.jpg', '3', '0', '1510716388');
INSERT INTO `ze_pic` VALUES ('51', '\\uploads\\20171115\\0f9e76dfc1c0b8e45116c1f46825397c.png', '3', '0', '1510716391');
INSERT INTO `ze_pic` VALUES ('52', '\\uploads\\20171115\\57306092a960c281cbbca1ff5e1e9b0a.png', '3', '0', '1510716400');
INSERT INTO `ze_pic` VALUES ('53', '\\uploads\\20171115\\d8a4cba8630924c3728398130a26039f.png', '3', '0', '1510716438');
INSERT INTO `ze_pic` VALUES ('54', '\\uploads\\20171115\\6f692be43bdf05e50bcce3ce83098f10.png', '3', '0', '1510716441');
INSERT INTO `ze_pic` VALUES ('55', '\\uploads\\20171115\\3b9cf216440e7dd524a2991b09aa795a.jpg', '3', '0', '1510716845');
INSERT INTO `ze_pic` VALUES ('56', '\\uploads\\20171115\\52eeaed44df2c32f3eed3cab857e0638.png', '3', '0', '1510717402');
INSERT INTO `ze_pic` VALUES ('57', '\\uploads\\20171115\\ddd54fae691b638b2e535dce12cb019b.jpg', '3', '0', '1510717405');
INSERT INTO `ze_pic` VALUES ('58', '\\uploads\\20171115\\c2b4fd854f8c52647831f2ba8671f822.jpg', '3', '0', '1510717501');
INSERT INTO `ze_pic` VALUES ('59', '\\uploads\\20171115\\3566beb6a7a15748ef44cb3b8b2d8e6a.jpg', '3', '0', '1510717527');
INSERT INTO `ze_pic` VALUES ('60', '\\uploads\\20171115\\7daaa908a9e7ccfa2668c336969a54f5.png', '3', '0', '1510717532');
INSERT INTO `ze_pic` VALUES ('61', '\\uploads\\20171115\\63a1250bd4a830c634d518bd5c114489.jpg', '3', '0', '1510717680');
INSERT INTO `ze_pic` VALUES ('62', '\\uploads\\20171115\\ea557fdec3e7b8279d07355d411f0d78.jpg', '3', '0', '1510717843');
INSERT INTO `ze_pic` VALUES ('63', '\\uploads\\20171115\\4cde20f2f018f8186bac2e0f1b3eae07.jpg', '3', '0', '1510718271');
INSERT INTO `ze_pic` VALUES ('64', '\\uploads\\20171115\\9e769021e863cd3f531de0a3c0319a5a.png', '3', '0', '1510718278');
INSERT INTO `ze_pic` VALUES ('65', '\\uploads\\20171115\\253d6bdbd241c67fd10e087e3230249a.jpg', '3', '0', '1510729126');

-- ----------------------------
-- Table structure for ze_setting
-- ----------------------------
DROP TABLE IF EXISTS `ze_setting`;
CREATE TABLE `ze_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `varkey` varchar(255) NOT NULL COMMENT '设置项',
  `vardata` varchar(500) DEFAULT '' COMMENT '设置值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ze_setting
-- ----------------------------
INSERT INTO `ze_setting` VALUES ('1', 'basic', 'a:6:{s:7:\"zh_name\";s:6:\"博客\";s:7:\"en_name\";s:7:\"ZeBlong\";s:8:\"head_pic\";s:54:\"\\uploads\\20171115\\19ac9166bf9517ccb23b1bb264b09b4f.png\";s:7:\"sina_wb\";s:26:\"http://weibo.com/nbmanisme\";s:7:\"wx_code\";s:54:\"\\uploads\\20171115\\8c09b3bca19a2d9b7c958917494b855c.png\";s:4:\"sign\";s:168:\"这是一段介绍！这是一段介绍！这是一段介绍！这是一段介绍！这是一段介绍！这是一段介绍！这是一段介绍！这是一段介绍！\";}');

-- ----------------------------
-- Table structure for ze_user
-- ----------------------------
DROP TABLE IF EXISTS `ze_user`;
CREATE TABLE `ze_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '系统用户ID',
  `name` varchar(50) DEFAULT NULL COMMENT '用户名',
  `pwd` char(32) DEFAULT NULL COMMENT '密码',
  `salt` varchar(10) DEFAULT '',
  `is_admin` tinyint(1) DEFAULT '0' COMMENT '是否为超级管理员(1-是，2-不是)',
  `create_time` int(10) DEFAULT '0' COMMENT '建立时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态：1正常，2禁用',
  `log_time` int(11) DEFAULT '0' COMMENT '最后登录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='系统用户';

-- ----------------------------
-- Records of ze_user
-- ----------------------------
INSERT INTO `ze_user` VALUES ('1', 'admin', 'eed468307a86dd67c1e8c3c06cb725f3', '&#1234156', '1', '0', '1', '1511514539');
