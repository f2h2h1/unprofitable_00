-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-01-02 09:38:18
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ershoushu`
--

-- --------------------------------------------------------

--
-- 表的结构 `tblbook`
--

CREATE TABLE IF NOT EXISTS `tblbook` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `description` longtext,
  `edition` int(11) DEFAULT NULL,
  `publisher` varchar(50) DEFAULT NULL,
  `yearOfPublish` year(4) DEFAULT NULL,
  `format` enum('hardpack','paperpack') DEFAULT NULL,
  `ISBN` varchar(30) DEFAULT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  `tag` varchar(20) DEFAULT NULL,
  `inStock` int(11) DEFAULT NULL,
  `meid` int(11) DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  PRIMARY KEY (`bid`),
  KEY `sender_idx` (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `tblbook`
--

INSERT INTO `tblbook` (`bid`, `title`, `author`, `description`, `edition`, `publisher`, `yearOfPublish`, `format`, `ISBN`, `price`, `tag`, `inStock`, `meid`, `sid`) VALUES
(1, 'Microsoft SharePoint 2013 Developer Reference', 'Paolo Pialorsi', 'Develop your business collaboration solutions quickly and effectively with the rich set of tools, classes, libraries,\n and controls available in Microsoft SharePoint 2013. With this practical reference, enterprise-development expert Paolo\n Pialorsi shows you how to extend and customize the SharePoint environment�and helps you sharpen your development skills. \n Ideal for ASP.NET developers with Microsoft .NET and C# knowledge,Discover how to:Create custom SharePoint apps and publish\n them in the Office StoreOrchestrate your workflows with the new Workflow Manager 1.0Access and manage your SharePoint data \n with the REST APIsFederate SharePoint with Windows Azure Access Control ServicesCustomize your SharePoint 2013 UI for a better\n user experienceGain a thorough understanding of authentication and authorization', NULL, 'Apress', 2013, 'paperpack', '978-0-7356-7071-6', '12.59', 'c', 3, NULL, 1),
(2, 'c++ How to Program', 'Paul Deitel & Harvey M. Deitel', 'For Introduction to Programming (CS1) and other more intermediate courses covering programming in C++.\n Also appropriate as a supplement for upper-level courses where the instructor uses a book as a reference for the C++ language. \n This best-selling comprehensive text is aimed at readers with little or no programming experience. It teaches programming by \n presenting the concepts in the context of full working programs and takes an early-objects approach. The authors emphasize \n achieving program clarity through structured and object-oriented programming, software reuse and component-oriented software \n construction. The Seventh Edition encourages students to connect computers to the community, using the Internet to solve problems \n and make a difference in our world. All content has been carefully fine-tuned in response to a team of distinguished academic and \n industry reviewers.', 7, 'Prentice Hall', 2009, 'paperpack', NULL, '20.33', 'c', 1, NULL, 2),
(3, 'HTML and CSS: Design and Build Websites', 'Jon Duckett', 'A full-color introduction to the basics of \n HTML and CSS from the publishers of Wrox!Every day, more and more people want to learn some HTML and CSS. Joining the professional \n web designers and programmers are new audiences who need to know a little bit of code at work (update a content management system or \n e-commerce store) and those who want to make their personal blogs more attractive. Many books teaching HTML and CSS are dry and only \n written for those who want to become programmers, which is why this book takes an entirely new approach.Introduces HTML and CSS in a way \n that makes them accessible to everyone�hobbyists, students, and professionals�and it�s full-color throughoutUtilizes information graphics \n and lifestyle photography to explain the topics in a simple way that is engagingBoasts a unique structure that allows you to progress through\n the chapters from beginning to end or just dip into topics of particular interest at your leisureThis educational book is one that you will \n enjoy picking up, reading, then referring back to. It will make you wish other technical topics were presented in such a simple, attractive \n and engaging way!', NULL, 'Wiley Publishing', 2011, 'paperpack', '978-1118008188', '20.80', 'c', 5, NULL, 3),
(4, 'Beginning HTML and CSS', 'Rob', 'Everything you need to build websites with the newest versions of HTML and CSS If \n you develop websites, you know that the goal posts keep moving, especially now that your website must work on not only traditional desktops, but \n also on an ever-changing range of smartphones and tablets. This step-by-step book efficiently guides you through the thicket. Teaching you the \n very latest best practices and techniques, this practical reference walks you through how to use HTML5 and CSS3 to develop attractive, modern \n websites for today�s multiple devices. From handling text, forms, and video, to implementing powerful JavaScript functionality, this book covers it \n all.Serves as the ultimate beginners guide for anyone who wants to build websites with HTML5 and CSS3, whether as a hobbyist or aspiring \n professional developer Covers the basics, including the different versions of HTML and CSS and how modern websites use structure and semantics to \n describe their contents Explains core processes, such as marking up text, images, lists, tables, forms, audio, and video Delves into CSS3, teaching\n you how to control or change the way your pages look and offer tips on how to create attractive designs Explores the jQuery library and how to \n implement powerful JavaScript features, such as tabbed content, image carousels, and moreGet up to speed on HTML5, CSS3, and today�s website \n design with this practical guide. Then, keep it on your desk as a reference!', NULL, 'Wrox Press', 2013, 'paperpack', '1118340183', '32.20', 'c', 3, NULL, 4),
(5, '金瓶梅', '古代某人', '不知道', 0, '小明', 2019, NULL, '452345-4524-524', '51.11', 'l', 1, 5, 9),
(6, 'English book', 'hi', NULL, 5, 'wjos', 2015, NULL, '4524-435-7-737-73', '40.58', 'e', 4, 1, 9),
(7, '本草纲目', '李时珍', NULL, NULL, '人民卫生出版社出版', 1977, NULL, '9787200066999', '19.00', 'y', 1, NULL, 9),
(13, '解读中国经济(增订版) ', '林毅夫', NULL, NULL, '北京大学出版社', 2014, NULL, '7301248490, 9787301248492', '40.00', 'j', 1, NULL, 5),
(14, '解读中国经济(增订版) ', '林毅夫', NULL, NULL, '北京大学出版社', 2014, NULL, '7301248490, 9787301248492', '40.00', 'j', 1, NULL, 9),
(15, '托福词汇10000', '张洪伟 ‎ 戴云 ', NULL, NULL, '浙江教育出版社', 2015, NULL, 'B01NCDYJQG', '16.69', 'e', 5, NULL, 9),
(16, '中医诊断学', '宋一同，杨亚平，梁广河', NULL, NULL, '中国纺织出版社', 2014, NULL, 'B00LP7TVVG', '39.78', 'y', 2, NULL, 9);

-- --------------------------------------------------------

--
-- 表的结构 `tblbookimage`
--

CREATE TABLE IF NOT EXISTS `tblbookimage` (
  `sourcePath` varchar(100) NOT NULL,
  `bid` int(11) DEFAULT NULL,
  PRIMARY KEY (`sourcePath`),
  KEY `bid_idx` (`bid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tblbookimage`
--

INSERT INTO `tblbookimage` (`sourcePath`, `bid`) VALUES
('img/1.jpg', 1),
('img/2.jpg', 2),
('img/3.jpg', 3),
('img/4.jpg', 4),
('img/2015091105435345.jpg', 5),
('img/English.png', 6),
('img/b.jpg', 7),
('img/ll.png', 14),
('img/2018-01-02 12_57_38-托福词汇10000 (English Edition)-Kindle商店-亚马逊中国.png', 15),
('img/zyvf.png', 16);

-- --------------------------------------------------------

--
-- 表的结构 `tblcontact`
--

CREATE TABLE IF NOT EXISTS `tblcontact` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `tblcontact`
--

INSERT INTO `tblcontact` (`cid`, `sid`, `phone`, `email`) VALUES
(1, 1, '07712346781', '1234@hotmail.com'),
(2, 2, '07789453100', '234@hotmail.com'),
(3, 3, '09876544412', 'jfoe@hotmail.com'),
(9, 9, '13066312388', '542999277@qq.com');

-- --------------------------------------------------------

--
-- 表的结构 `tbllogin`
--

CREATE TABLE IF NOT EXISTS `tbllogin` (
  `email` varchar(30) NOT NULL,
  `sid` int(11) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`email`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tbllogin`
--

INSERT INTO `tbllogin` (`email`, `sid`, `password`) VALUES
('1234@hotmail.com', 1, 'a9bdfa76aa6d76f7bde66e470cf98553'),
('234@hotmail.com', 2, 'bb110a454fadd9b811fcb54b061619c9'),
('542999277@qq.com', 9, 'e69dc2c09e8da6259422d987ccbe95b5'),
('jfoe@hotmail.com', 3, 'aa9f3975e1ac31d104905da5d2fa2d79');

-- --------------------------------------------------------

--
-- 表的结构 `tblstudent`
--

CREATE TABLE IF NOT EXISTS `tblstudent` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) DEFAULT NULL,
  `surname` varchar(20) DEFAULT NULL,
  `qualification` enum('undergraduate','postgraduate') DEFAULT NULL,
  `courseyear` varchar(50) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `tblstudent`
--

INSERT INTO `tblstudent` (`sid`, `firstname`, `surname`, `qualification`, `courseyear`, `cid`) VALUES
(1, 'Sandara', 'Park', 'undergraduate', 'BScWeb and Mobile Computing 2013', 1),
(2, 'Boom', 'Park', 'postgraduate', 'MSc Computer Science 2012', 1),
(3, 'Minzy', 'Kong', 'undergraduate', 'BSc Information System 2011', 2),
(4, 'CaiLing', 'Park', 'undergraduate', 'Business System 2013', 3),
(5, '陈', '同学', '', '2017', NULL),
(6, '陈', '同学', '', '2017', NULL),
(7, '陈', '同学', '', '2017', NULL),
(8, '陈', '同学', '', '2017', NULL),
(9, '陈', '同学', '', '2017', NULL);

--
-- 限制导出的表
--

--
-- 限制表 `tblbook`
--
ALTER TABLE `tblbook`
  ADD CONSTRAINT `sid` FOREIGN KEY (`sid`) REFERENCES `tblstudent` (`sid`) ON UPDATE CASCADE;

--
-- 限制表 `tblbookimage`
--
ALTER TABLE `tblbookimage`
  ADD CONSTRAINT `bid` FOREIGN KEY (`bid`) REFERENCES `tblbook` (`bid`),
  ADD CONSTRAINT `tblbookimage_ibfk_1` FOREIGN KEY (`bid`) REFERENCES `tblbook` (`bid`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
