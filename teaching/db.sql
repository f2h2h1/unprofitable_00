/*
SQLyog Community Edition- MySQL GUI v6.54
MySQL - 5.5.25a : Database - teaching
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`teaching` /*!40100 DEFAULT CHARACTER SET gb2312 */;

USE `teaching`;
-- ----------------------------
-- Table structure for admin
-- ----------------------------
CREATE TABLE `admin` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(50) default NULL,
  `password` varchar(50) default NULL,
  `realname` varchar(50) default NULL,
  `sex` varchar(50) default NULL,
  `age` varchar(50) default NULL,
  `address` varchar(50) default NULL,
  `tel` varchar(50) default NULL,
  `addtime` varchar(50) default NULL,
  `sf` varchar(50) default '用户',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for jy
-- ----------------------------
CREATE TABLE `jy` (
  `id` int(11) NOT NULL auto_increment,
  `mc` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `bz` varchar(255) default NULL,
  `yh` varchar(50) default NULL,
  `tg` varchar(255) default NULL,
  `yj` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for kb
-- ----------------------------
CREATE TABLE `kb` (
  `id` int(11) NOT NULL auto_increment,
  `mc` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `bz` varchar(255) default NULL,
  `yh` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for rw
-- ----------------------------
CREATE TABLE `rw` (
  `id` int(11) NOT NULL auto_increment,
  `mc` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `bz` varchar(255) default NULL,
  `yh` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for rws
-- ----------------------------
CREATE TABLE `rws` (
  `id` int(11) NOT NULL auto_increment,
  `mc` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `bz` varchar(255) default NULL,
  `yh` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sc
-- ----------------------------
CREATE TABLE `sc` (
  `id` int(11) NOT NULL auto_increment,
  `mc` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `bz` varchar(255) default NULL,
  `yh` varchar(50) default NULL,
  `pf` varchar(255) default NULL,
  `py` varchar(255) default NULL,
  `js` varchar(50) default NULL,
  `zyid` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sk
-- ----------------------------
CREATE TABLE `sk` (
  `id` int(11) NOT NULL auto_increment,
  `mc` varchar(255) default NULL,
  `fs` varchar(255) default NULL,
  `xs` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `bz` varchar(255) default NULL,
  `yh` varchar(50) default NULL,
  `tg` varchar(255) default NULL,
  `yj` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for srw
-- ----------------------------
CREATE TABLE `srw` (
  `id` int(11) NOT NULL auto_increment,
  `mc` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `bz` varchar(255) default NULL,
  `yh` varchar(255) default NULL,
  `pf` varchar(255) default NULL,
  `py` varchar(255) default NULL,
  `js` varchar(50) default NULL,
  `rwid` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zy
-- ----------------------------
CREATE TABLE `zy` (
  `id` int(11) NOT NULL auto_increment,
  `mc` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `bz` varchar(255) default NULL,
  `yh` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '111', 'admin', 'man', '26', 'test', '13800000000', 'test', '系统管理员');
INSERT INTO `admin` VALUES ('2', 'js', '111', '阿诺', '高级教师', '硕士研究生', '信息系', '13800008888', '2017-02-17 11:21:10', '教师');
INSERT INTO `admin` VALUES ('3', 'jys', '111', '张小三', '讲师', '硕士研究生', '副主任', '18666667123', '2017-02-17', '教研室管理员');
INSERT INTO `admin` VALUES ('4', 'xs', '111', '刘泽', '副班长', '22', '测试班级', '13800008888', '2017-02-17', '学生');
INSERT INTO `admin` VALUES ('5', '888888', '888888', '测试员', '222 ', '22', '低', '13526532653', '2017-11-01', '学生');
INSERT INTO `jy` VALUES ('1', '讲义名称讲义名称', 'upfile/1.doc', '暂无', 'js', '未通过', '回去重写');
INSERT INTO `kb` VALUES ('1', '课表课表', 'upfile/1.doc', '课表课表课表课表', 'jys');
INSERT INTO `rw` VALUES ('1', '测试任务名称', 'upfile/1.doc', '测试说明', 'js');
INSERT INTO `rws` VALUES ('2', '测试任务书名称', 'upfile/1.doc', '测试说明', 'jys');
INSERT INTO `sc` VALUES ('1', '测试上交作业功能', 'upfile/1.doc', '测试说明内容', 'xs', '90', '写的不做继续努力', 'js', '1');
INSERT INTO `sk` VALUES ('1', '名称名称', '3节连上', '48学时', 'upfile/1.doc', '说明说明', 'js', '通过', '写的不错');
INSERT INTO `srw` VALUES ('1', '测试报告名称', 'upfile/1.doc', '报告说明报告说明报告说明', 'xs', '70', '下不为例', 'js', '1');
INSERT INTO `zy` VALUES ('1', '测试作业', 'upfile/1.doc', '说明说明说明说明', 'js');
