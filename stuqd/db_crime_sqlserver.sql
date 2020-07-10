
-- IF EXISTS(SELECT * from sys.databases WHERE name='db_crime')
-- BEGIN
--     DROP DATABASE db_crime;
-- END

-- CREATE DATABASE db_crime;
USE db_crime;

/*Table structure for table `admin` */

-- 判断要创建的表名是否存在
IF EXISTS(select * from dbo.sysobjects where id = object_id(N'db_crime.dbo.admin') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
-- 删除表
DROP TABLE db_crime.dbo.admin
GO
CREATE TABLE admin (
  id int PRIMARY KEY NOT NULL IDENTITY(1,1),
  username varchar(50) DEFAULT NULL,
  password varchar(50),
  realname varchar(50),
  sex varchar(50),
  age varchar(50),
  address varchar(50),
  tel varchar(50),
  addtime varchar(50),
  sf varchar(50)
);

/*Data for the table admin */

insert  into admin(username,password,realname,sex,age,address,tel,addtime,sf) values ('admin','1111','陈道明','男','25','成都市金牛区','13900000000','0000','管理员');

/*Table structure for table tb_crime */

IF EXISTS(select * from dbo.sysobjects where id = object_id(N'db_crime.dbo.tb_crime') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
DROP TABLE db_crime.dbo.tb_crime
GO
CREATE TABLE tb_crime (
  id int PRIMARY KEY NOT NULL IDENTITY(1,1),
  crime_type varchar(50),
  crime_name varchar(50),
  level varchar(50),
  create_time varchar(20)
);

/*Data for the table tb_crime */

insert  into tb_crime(crime_type,crime_name,level,create_time) values ('罪加一等','不知名','四级','2020-06-25 16:25:43');

/*Table structure for table tb_criminal */

IF EXISTS(select * from dbo.sysobjects where id = object_id(N'db_crime.dbo.tb_criminal') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
DROP TABLE db_crime.dbo.tb_criminal
GO
CREATE TABLE tb_criminal (
  id int PRIMARY KEY NOT NULL IDENTITY(1,1),
  username varchar(50),
  realname varchar(50),
  sex varchar(50),
  card varchar(20),
  address varchar(50),
  phone varchar(50),
  crimtime varchar(50),
  prison_id int
);

/*Data for the table tb_criminal */

insert  into tb_criminal(username,realname,sex,card,address,phone,crimtime,prison_id) values ('张三','张三','男','487788188812547845','咸阳务农镇','15555555555','2019-03-06 17:36:17',1),('李四','李四','男','487788188812547845','咸阳务农镇','15555555555','2020-06-23 11:13:34',1),('王五','王五','男','487788188812547845','咸阳务农镇','15555555555','2020-06-12 14:03:43',1);

/*Table structure for table tb_criminal_crime */

IF EXISTS(select * from dbo.sysobjects where id = object_id(N'db_crime.dbo.tb_criminal_crime') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
DROP TABLE db_crime.dbo.tb_criminal_crime
GO
CREATE TABLE tb_criminal_crime (
  id int PRIMARY KEY NOT NULL IDENTITY(1,1),
  criminal_id int,
  crime_id int,
);

/*Data for the table tb_criminal_crime */

/*Table structure for table tb_factory */

IF EXISTS(select * from dbo.sysobjects where id = object_id(N'db_crime.dbo.tb_factory') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
DROP TABLE db_crime.dbo.tb_factory
GO
CREATE TABLE tb_factory (
  id int PRIMARY KEY NOT NULL IDENTITY(1,1),
  address varchar(200),
  phone varchar(20)
);

/*Data for the table tb_factory */

insert  into tb_factory(address,phone) values ('北京昌平一区','18888888888'),('北京丰台角门西','15575757575');

/*Table structure for table tb_goods */

IF EXISTS(select * from dbo.sysobjects where id = object_id(N'db_crime.dbo.tb_goods') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
DROP TABLE db_crime.dbo.tb_goods
GO
CREATE TABLE tb_goods (
  id int PRIMARY KEY NOT NULL IDENTITY(1,1),
  goods_name varchar(50),
  goods_class varchar(20),
  stock int
);

/*Data for the table tb_goods */

insert  into tb_goods(goods_name,goods_class,stock) values ('杜蕾斯','测试',10),('真空鸭脖','卤',100);

/*Table structure for table tb_prison */

IF EXISTS(select * from dbo.sysobjects where id = object_id(N'db_crime.dbo.tb_prison') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
DROP TABLE db_crime.dbo.tb_prison
GO
CREATE TABLE tb_prison (
  id int PRIMARY KEY NOT NULL IDENTITY(1,1),
  prison_max int,
  prison_city varchar(50),
  prison_name varchar(50)
);

/*Data for the table tb_prison */

insert  into tb_prison(prison_max,prison_city,prison_name) values (140000,'泾阳道','特斯拉监狱');

/*Table structure for table tb_shop */

DROP TABLE IF EXISTS tb_shop;

CREATE TABLE tb_shop (
  id int PRIMARY KEY NOT NULL IDENTITY(1,1),
  shop_name varchar(50),
  phone varchar(20)
);

/*Data for the table tb_shop */

insert  into tb_shop(shop_name,phone) values ('京东618店铺','15565656566'),('淘宝双11电灯泡','15585859596');

