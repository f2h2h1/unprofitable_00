/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.7.21-log : Database - db_crime
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_crime` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `db_crime`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '管理员信息表ID',
  `username` varchar(50) DEFAULT NULL COMMENT '账号',
  `password` varchar(50) DEFAULT NULL COMMENT '密码',
  `realname` varchar(50) DEFAULT NULL COMMENT '姓名',
  `sex` varchar(50) DEFAULT NULL COMMENT '性别',
  `age` varchar(50) DEFAULT NULL COMMENT '年龄',
  `address` varchar(50) DEFAULT NULL COMMENT '地址',
  `tel` varchar(50) DEFAULT NULL COMMENT '电话',
  `addtime` varchar(50) DEFAULT NULL COMMENT '时间',
  `sf` varchar(50) DEFAULT NULL COMMENT '身份',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=gb2312 COMMENT='管理人';

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`password`,`realname`,`sex`,`age`,`address`,`tel`,`addtime`,`sf`) values (1,'admin','1111','陈道明','男','25','成都市金牛区','13900000000','0000','管理员');

/*Table structure for table `tb_crime` */

DROP TABLE IF EXISTS `tb_crime`;

CREATE TABLE `tb_crime` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `crime_type` varchar(50) DEFAULT NULL COMMENT '种类',
  `crime_name` varchar(50) DEFAULT NULL COMMENT '名称',
  `level` varchar(50) DEFAULT NULL COMMENT '级别',
  `create_time` varchar(20) DEFAULT NULL COMMENT '成立时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='犯罪信息表';

/*Data for the table `tb_crime` */

insert  into `tb_crime`(`id`,`crime_type`,`crime_name`,`level`,`create_time`) values (2,'罪加一等','不知名','四级','2020-06-25 16:25:43');

/*Table structure for table `tb_criminal` */

DROP TABLE IF EXISTS `tb_criminal`;

CREATE TABLE `tb_criminal` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `username` varchar(50) DEFAULT NULL COMMENT '姓名',
  `realname` varchar(50) DEFAULT NULL COMMENT '昵称',
  `sex` varchar(50) DEFAULT NULL COMMENT '性别',
  `card` varchar(20) DEFAULT NULL COMMENT '身份证',
  `address` varchar(50) DEFAULT NULL COMMENT '家庭住址',
  `phone` varchar(50) DEFAULT NULL COMMENT '联系电话',
  `crimtime` varchar(50) DEFAULT NULL COMMENT '犯错时间',
  `prison_id` int(11) DEFAULT NULL COMMENT '所在监狱',
  UNIQUE KEY `id` (`id`),
  KEY `fk_prison_id` (`prison_id`),
  CONSTRAINT `fk_prison_id` FOREIGN KEY (`prison_id`) REFERENCES `tb_prison` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=gb2312;

/*Data for the table `tb_criminal` */

insert  into `tb_criminal`(`id`,`username`,`realname`,`sex`,`card`,`address`,`phone`,`crimtime`,`prison_id`) values (11,'张三','张三','男','487788188812547845','咸阳务农镇','15555555555','2019-03-06 17:36:17',1),(12,'李四','李四','男','487788188812547845','咸阳务农镇','15555555555','2020-06-23 11:13:34',1),(13,'王五','王五','男','487788188812547845','咸阳务农镇','15555555555','2020-06-12 14:03:43',1);

/*Table structure for table `tb_criminal_crime` */

DROP TABLE IF EXISTS `tb_criminal_crime`;

CREATE TABLE `tb_criminal_crime` (
  `id` int(11) NOT NULL COMMENT '编号',
  `criminal_id` int(11) DEFAULT NULL COMMENT '嫌疑人id',
  `crime_id` int(11) DEFAULT NULL COMMENT '罪行id',
  PRIMARY KEY (`id`),
  KEY `fk_criminal_id` (`criminal_id`),
  KEY `fk_crime_id` (`crime_id`),
  CONSTRAINT `fk_crime_id` FOREIGN KEY (`crime_id`) REFERENCES `tb_crime` (`id`),
  CONSTRAINT `fk_criminal_id` FOREIGN KEY (`criminal_id`) REFERENCES `tb_criminal` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='犯罪人与所犯罪行关系表';

/*Data for the table `tb_criminal_crime` */

/*Table structure for table `tb_factory` */

DROP TABLE IF EXISTS `tb_factory`;

CREATE TABLE `tb_factory` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '厂家编号',
  `address` varchar(200) DEFAULT NULL COMMENT '联系地址',
  `phone` varchar(20) DEFAULT NULL COMMENT '联系电话',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10003 DEFAULT CHARSET=utf8;

/*Data for the table `tb_factory` */

insert  into `tb_factory`(`id`,`address`,`phone`) values (10001,'北京昌平一区','18888888888'),(10002,'北京丰台角门西','15575757575');

/*Table structure for table `tb_goods` */

DROP TABLE IF EXISTS `tb_goods`;

CREATE TABLE `tb_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品编号',
  `goods_name` varchar(50) DEFAULT NULL COMMENT '商品名称',
  `goods_class` varchar(20) DEFAULT NULL COMMENT '商品分类',
  `stock` int(11) DEFAULT NULL COMMENT '库存',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1102 DEFAULT CHARSET=utf8;

/*Data for the table `tb_goods` */

insert  into `tb_goods`(`id`,`goods_name`,`goods_class`,`stock`) values (1100,'杜蕾斯','测试',10),(1101,'真空鸭脖','卤',100);

/*Table structure for table `tb_prison` */

DROP TABLE IF EXISTS `tb_prison`;

CREATE TABLE `tb_prison` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `prison_max` int(11) DEFAULT NULL COMMENT '最大容量',
  `prison_city` varchar(50) DEFAULT NULL COMMENT '所在城市',
  `prison_name` varchar(50) DEFAULT NULL COMMENT '名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='监狱信息表';

/*Data for the table `tb_prison` */

insert  into `tb_prison`(`id`,`prison_max`,`prison_city`,`prison_name`) values (1,140000,'泾阳道','特斯拉监狱');

/*Table structure for table `tb_shop` */

DROP TABLE IF EXISTS `tb_shop`;

CREATE TABLE `tb_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商店编号',
  `shop_name` varchar(50) DEFAULT NULL COMMENT '商店名称',
  `phone` varchar(20) DEFAULT NULL COMMENT '联系电话',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10022 DEFAULT CHARSET=utf8;

/*Data for the table `tb_shop` */

insert  into `tb_shop`(`id`,`shop_name`,`phone`) values (10020,'京东618店铺','15565656566'),(10021,'淘宝双11电灯泡','15585859596');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
