-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2019-01-21 12:38:00
-- 服务器版本: 5.5.53
-- PHP 版本: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `129wuye`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `type` varchar(30) DEFAULT '管理员',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `type`) VALUES
(1, 'admin', 'admin', '超级管理员'),
(2, '333', '333', '管理员'),
(3, '444', '444', '管理员');

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'id自然编号',
  `title` varchar(60) NOT NULL COMMENT '分类名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
(2, '2号楼'),
(1, '1号楼'),
(3, '3号楼'),
(4, '4号楼'),
(5, '5号楼'),
(6, '6号楼'),
(7, '7号楼'),
(8, '8号楼');

-- --------------------------------------------------------

--
-- 表的结构 `chewei`
--

CREATE TABLE IF NOT EXISTS `chewei` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `content` varchar(200) NOT NULL,
  `addtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `chewei`
--

INSERT INTO `chewei` (`id`, `userid`, `content`, `addtime`, `title`) VALUES
(2, 2, '备注', '2018-11-08 12:39:36', 'a524'),
(3, 2, '备注111', '2018-11-08 12:39:36', 'a5423'),
(4, 3, 'dfsdfsdf', '2018-11-08 12:39:36', 'a252'),
(9, 5, '备注', '2019-01-20 13:43:57', '2085'),
(6, 3, '', '2018-11-08 12:39:36', 'a33'),
(8, 4, 'dsafsf', '2018-11-15 02:46:56', 'a4521');

-- --------------------------------------------------------

--
-- 表的结构 `danyuan`
--

CREATE TABLE IF NOT EXISTS `danyuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT '0' COMMENT '名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- 转存表中的数据 `danyuan`
--

INSERT INTO `danyuan` (`id`, `title`) VALUES
(26, '一单元'),
(30, '三单元'),
(28, '二单元'),
(31, '四单元');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) NOT NULL COMMENT '姓名',
  `categoryid` int(11) NOT NULL DEFAULT '0' COMMENT '楼号',
  `danyuanid` int(11) DEFAULT '0' COMMENT '单元',
  `addtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `img` varchar(50) DEFAULT 'avatar.png' COMMENT '头像',
  `number1` varchar(50) DEFAULT NULL COMMENT '房号',
  `tel` varchar(50) DEFAULT NULL COMMENT '电话',
  `chaoxiang` varchar(50) DEFAULT NULL,
  `mianji` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `nickname`, `categoryid`, `danyuanid`, `addtime`, `img`, `number1`, `tel`, `chaoxiang`, `mianji`) VALUES
(1, '李明', 1, 26, '2018-11-08 12:39:36', 'avatar.png', '201', '15236222222', NULL, NULL),
(2, '张三', 2, 31, '2018-11-08 12:39:36', '8904476.jpg', '301', '15236222222', '南', '98'),
(3, '李明', 5, 30, '2018-11-08 12:39:36', '87881.jpg', '201', '15236222222', '南', '180'),
(4, '李明', 1, 30, '2018-11-15 02:46:23', '9873853.jpg', '2605', '15236222222', '南', '135'),
(5, '夺要', 1, 28, '2019-01-20 13:43:30', '2465090.jpg', '3025', '15236222222', '南', '135');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
