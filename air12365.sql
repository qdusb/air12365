-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-01-14 09:34:47
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `air12365`
--

-- --------------------------------------------------------

--
-- 表的结构 `active`
--

CREATE TABLE IF NOT EXISTS `active` (
  `id` int(10) unsigned NOT NULL,
  `sortnum` int(10) unsigned NOT NULL,
  `user_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `QQ` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `modify_time` datetime DEFAULT NULL,
  `state` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_id` (`product_id`),
  KEY `admin_id` (`phone`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `active`
--

INSERT INTO `active` (`id`, `sortnum`, `user_name`, `phone`, `QQ`, `city`, `area`, `class_id`, `product_name`, `product_id`, `create_time`, `modify_time`, `state`) VALUES
(1, 10, 'dd', 'dd', 'dd', 'dd', 'dd', NULL, NULL, NULL, '2013-08-16 10:01:00', NULL, 1),
(2, 20, 'dd', 'dd', 'dd', 'dd', 'dd', '107102,', '活动一', NULL, '2013-08-16 10:45:00', NULL, NULL),
(3, 30, 'dd', 'dd', 'dd', 'dd', 'dd', '107102', '活动一', NULL, '2013-08-16 10:02:00', NULL, NULL),
(4, 40, 'dd', 'dd', 'dd', 'dd', 'dd', '107102', '活动一', NULL, '2013-08-16 10:12:00', NULL, NULL),
(5, 50, 'dd', 'dd', 'dd', 'dd', 'dd', '107102', '活动一', NULL, '2013-08-16 10:15:00', NULL, NULL),
(6, 60, 'dd', 'dd', 'dd', 'dd', 'dd', '107102', '活动一', NULL, '2013-08-16 10:37:00', NULL, NULL),
(7, 70, 'ibw_xu256', '136556303465', '277484936', 'hefei', '合肥', '107102', '活动一', '7', '2013-08-16 10:15:00', NULL, 1),
(8, 80, 'ibw_xu256', '136556303465', '277484936', 'hefei', '合肥', '107102', '活动一', '8', '2013-08-16 10:32:00', NULL, 1),
(9, 90, 'ibw_xu256', '136556303465', '277484936', 'hefei', '合肥', '107102', '活动一', '1', '2013-08-16 10:17:00', NULL, NULL),
(10, 100, 'ibw_xu256', '136556303465', '277484936', 'hefei', '合肥', '107102', '活动一', '1', '2013-08-16 10:26:00', NULL, 1),
(11, 110, '第三方后水电费', '13566003322', '277484936', '巢湖', '东方新世界', '107102', '活动一', '5', '2013-08-16 10:49:00', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `realname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `grade` tinyint(1) unsigned NOT NULL,
  `state` tinyint(1) unsigned NOT NULL,
  `create_time` datetime NOT NULL,
  `modify_time` datetime NOT NULL,
  `login_count` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `name`, `pass`, `realname`, `grade`, `state`, `create_time`, `modify_time`, `login_count`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', '系统管理员', 8, 1, '2014-03-19 02:45:53', '2014-03-19 02:45:53', 5);

-- --------------------------------------------------------

--
-- 表的结构 `admin_advanced`
--

CREATE TABLE IF NOT EXISTS `admin_advanced` (
  `admin_id` int(10) unsigned NOT NULL,
  `advanced_id` int(10) unsigned NOT NULL,
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `admin_login`
--

CREATE TABLE IF NOT EXISTS `admin_login` (
  `admin_id` int(10) unsigned NOT NULL,
  `login_time` datetime NOT NULL,
  `login_ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `admin_login`
--

INSERT INTO `admin_login` (`admin_id`, `login_time`, `login_ip`) VALUES
(1, '2015-01-13 11:01:35', '127.0.0.1'),
(1, '2015-01-13 11:01:26', '127.0.0.1'),
(1, '2015-01-14 01:01:35', '127.0.0.1'),
(1, '2015-01-14 02:01:58', '127.0.0.1'),
(1, '2015-01-14 04:01:12', '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `admin_popedom`
--

CREATE TABLE IF NOT EXISTS `admin_popedom` (
  `admin_id` int(10) unsigned NOT NULL,
  `class_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `admin_popedom`
--

INSERT INTO `admin_popedom` (`admin_id`, `class_id`) VALUES
(1, '104'),
(1, '103'),
(1, '102'),
(1, '101'),
(2, '114'),
(2, '101'),
(1, '114');

-- --------------------------------------------------------

--
-- 表的结构 `advanced`
--

CREATE TABLE IF NOT EXISTS `advanced` (
  `id` int(10) unsigned NOT NULL,
  `sortnum` int(10) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `default_file` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `advanced`
--

INSERT INTO `advanced` (`id`, `sortnum`, `name`, `default_file`, `state`) VALUES
(2, 20, '广告管理', 'adver_list.php', 0),
(9, 90, '留言簿', 'message_list.php', 0),
(1, 10, '基本设置', 'config_base.php', 1),
(3, 30, '链接管理', 'link_list.php', 0),
(4, 40, '链接分类管理', 'link_class_list.php', 0),
(5, 50, 'Banner管理', 'banner_list.php', 0),
(6, 60, 'Banner分类管理', 'banner_class_list.php', 0),
(10, 180, '加入我们', 'joinus_list.php', 0),
(7, 70, '招聘职位', 'job_list.php', 0),
(8, 80, '应聘人员', 'job_apply_list.php', 0),
(11, 110, '个人会员管理', 'member_list.php', 1),
(12, 15, '一级分类管理', 'base_class_list.php', 0),
(13, 120, '企业会员管理', 'member_company_list.php', 1),
(14, 130, '电子杂志管理', 'album_class_list.php', 0),
(15, 140, '员工管理', 'staff_list.php', 0),
(16, 150, '资料批量转移', 'transfer.php', 0),
(17, 160, '董事长信箱', 'bossemail_list.php', 0),
(18, 190, '批量上传', 'batch_upload_list.php', 0);

-- --------------------------------------------------------

--
-- 表的结构 `adver`
--

CREATE TABLE IF NOT EXISTS `adver` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `width` int(10) unsigned NOT NULL,
  `height` int(10) unsigned NOT NULL,
  `time` int(11) NOT NULL,
  `pic` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `adver`
--

INSERT INTO `adver` (`id`, `title`, `mode`, `url`, `width`, `height`, `time`, `pic`, `state`) VALUES
(1, '广告', 'hangL', '', 142, 569, 0, '2014-04/139726799844345900.png', 0);

-- --------------------------------------------------------

--
-- 表的结构 `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(10) NOT NULL,
  `sortnum` int(8) DEFAULT NULL,
  `class_id` varchar(30) CHARACTER SET gbk NOT NULL,
  `pic` varchar(60) CHARACTER SET gbk NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` varchar(60) CHARACTER SET gbk NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `album_class`
--

CREATE TABLE IF NOT EXISTS `album_class` (
  `id` int(10) NOT NULL,
  `sortnum` int(10) DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pic` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(8) DEFAULT NULL,
  `create_time` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(10) NOT NULL,
  `class_id` int(10) NOT NULL,
  `sortnum` int(20) NOT NULL,
  `title` varchar(100) CHARACTER SET gbk NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `url` varchar(200) CHARACTER SET gbk NOT NULL,
  `pic` varchar(200) CHARACTER SET gbk NOT NULL,
  `pic2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `width` int(10) NOT NULL,
  `height` int(10) NOT NULL,
  `state` int(10) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `banner`
--

INSERT INTO `banner` (`id`, `class_id`, `sortnum`, `title`, `content`, `url`, `pic`, `pic2`, `width`, `height`, `state`) VALUES
(1, 1, 10, '图片1', '', '', '2014-03/139519447704288600.jpg', '', 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `banner_class`
--

CREATE TABLE IF NOT EXISTS `banner_class` (
  `id` int(10) NOT NULL,
  `sortnum` int(20) NOT NULL,
  `name` varchar(100) CHARACTER SET gbk NOT NULL,
  `add_deny` int(10) NOT NULL,
  `delete_deny` int(10) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `banner_class`
--

INSERT INTO `banner_class` (`id`, `sortnum`, `name`, `add_deny`, `delete_deny`) VALUES
(1, 10, '页面Banner', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(11) NOT NULL,
  `sortnum` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `house_type` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estate` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `budget` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `book_time` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `eduction` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` date DEFAULT NULL,
  `state` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `config_base`
--

CREATE TABLE IF NOT EXISTS `config_base` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `address2` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `icp` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `keyword` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `contact` text COLLATE utf8_unicode_ci,
  `javascript` text COLLATE utf8_unicode_ci,
  `views` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `config_base`
--

INSERT INTO `config_base` (`id`, `name`, `address`, `address2`, `title`, `icp`, `keyword`, `description`, `contact`, `javascript`, `views`) VALUES
(1, '信望餐饮', '<p>\r\n	信望餐饮\r\n</p>\r\n<p>\r\n	电话：021-5111-3643\r\n</p>\r\n<p>\r\n	传真：021-5111-3654\r\n</p>\r\n<p>\r\n	邮箱：isao.yoshida@ifst.com.cn\r\n</p>\r\n<p>\r\n	地址:上海市中山西路933号虹桥银城大厦26层2601-2608室(200051)\r\n</p>', '信望餐饮', '信望餐饮', '皖ICP备08000675号', '安振产业投资集团信望餐饮', '信望餐饮', '<p>\r\n	贵宾热线：0551-63411788 2014信望餐饮 版权所有 皖ICP备0908659号 免责声明 技术支持：安徽网新\r\n</p>', '', 173);

-- --------------------------------------------------------

--
-- 表的结构 `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `id` int(10) unsigned NOT NULL,
  `sortnum` int(10) unsigned NOT NULL,
  `sortnum2` int(10) unsigned DEFAULT '0',
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `admin_id` int(10) unsigned DEFAULT NULL,
  `class_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pic` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `annex` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `annex2` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `annex3` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keyword` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(800) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `files` text COLLATE utf8_unicode_ci,
  `views` int(10) unsigned DEFAULT NULL,
  `No` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `modify_time` datetime DEFAULT NULL,
  `state` tinyint(1) unsigned DEFAULT NULL,
  `series` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `classcol` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `share` int(1) DEFAULT NULL,
  `charac` text COLLATE utf8_unicode_ci,
  `parameter` text COLLATE utf8_unicode_ci,
  `details` text COLLATE utf8_unicode_ci,
  `imagelist` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `info`
--

INSERT INTO `info` (`id`, `sortnum`, `sortnum2`, `title`, `title2`, `level`, `admin_id`, `class_id`, `author`, `source`, `website`, `pic`, `annex`, `annex2`, `annex3`, `keyword`, `intro`, `content`, `files`, `views`, `No`, `create_time`, `modify_time`, `state`, `series`, `classcol`, `share`, `charac`, `parameter`, `details`, `imagelist`) VALUES
(1, 10, 0, '联系方式', '', 0, 0, '106101', '', '', '', '', '', NULL, NULL, '', '', '<p>\r\n	地址：上海市xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx\r\n</p>\r\n<p>\r\n	电话：+86 150 0089 9559\r\n</p>\r\n<p>\r\n	邮箱：Larry@pariscafe.com\r\n</p>\r\n<p>\r\n	网址：www.pariscafe.com\r\n</p>\r\n<p>\r\n	邮编：xxxxxxxxxx\r\n</p>', '', 0, '', '2014-06-16 09:01:23', '2014-06-16 09:01:35', 1, '', '', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `info_class`
--

CREATE TABLE IF NOT EXISTS `info_class` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sortnum` int(10) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `en_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pic` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `files` text COLLATE utf8_unicode_ci,
  `info_state` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `max_level` tinyint(1) unsigned NOT NULL,
  `has_sub` tinyint(1) unsigned NOT NULL,
  `sub_content` tinyint(1) unsigned NOT NULL,
  `sub_pic` tinyint(1) unsigned NOT NULL,
  `hasViews` tinyint(1) unsigned NOT NULL,
  `hasState` tinyint(1) unsigned NOT NULL,
  `hasPic` tinyint(1) unsigned NOT NULL,
  `hasAnnex` tinyint(1) unsigned NOT NULL,
  `hasIntro` tinyint(1) unsigned NOT NULL,
  `hasShare` int(8) DEFAULT NULL,
  `hasContent` tinyint(1) unsigned NOT NULL,
  `hasContent2` int(8) DEFAULT NULL,
  `hasWebsite` tinyint(1) unsigned NOT NULL,
  `hasAuthor` tinyint(1) unsigned NOT NULL,
  `hasSource` tinyint(1) unsigned NOT NULL,
  `hasKeyword` tinyint(1) unsigned NOT NULL,
  `hasLevel` int(8) DEFAULT NULL,
  `state` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sortnum` (`sortnum`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `id` int(10) unsigned NOT NULL,
  `sortnum` int(10) unsigned NOT NULL,
  `class_id` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `num` int(6) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `content` text,
  `content2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `showForm` tinyint(1) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `publishdate` varchar(50) DEFAULT NULL,
  `deadline` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `job`
--

INSERT INTO `job` (`id`, `sortnum`, `class_id`, `name`, `num`, `email`, `content`, `content2`, `showForm`, `state`, `publishdate`, `deadline`) VALUES
(1, 10, '', '程序员', 1, '', '', '', 1, 1, '2014/06/14', ''),
(2, 20, '', '美工', 1, '', '', '', 1, 1, '2014/06/14', '2014.08.14');

-- --------------------------------------------------------

--
-- 表的结构 `job_apply`
--

CREATE TABLE IF NOT EXISTS `job_apply` (
  `id` int(10) unsigned NOT NULL,
  `job_id` int(10) unsigned NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `sortnum` int(10) NOT NULL,
  `sex` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `age` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `major` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `graduate_time` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `college` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `resumes` text CHARACTER SET utf8,
  `appraise` text CHARACTER SET utf8,
  `create_time` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `state` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `joinus`
--

CREATE TABLE IF NOT EXISTS `joinus` (
  `id` int(11) NOT NULL,
  `sortnum` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tribe` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_post` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_intention` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `eduction` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` date DEFAULT NULL,
  `state` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='加入我们';

-- --------------------------------------------------------

--
-- 表的结构 `link`
--

CREATE TABLE IF NOT EXISTS `link` (
  `id` int(10) NOT NULL,
  `class_id` varchar(10) CHARACTER SET gbk NOT NULL,
  `sortnum` int(10) NOT NULL,
  `name` varchar(50) CHARACTER SET gbk NOT NULL,
  `url` varchar(200) CHARACTER SET gbk NOT NULL,
  `pic` varchar(200) CHARACTER SET gbk NOT NULL,
  `state` int(10) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `link`
--

INSERT INTO `link` (`id`, `class_id`, `sortnum`, `name`, `url`, `pic`, `state`) VALUES
(1, '1', 10, '中国银行', 'http://www.ibw.cn', '2014-06/140288545125279900.jpg', 1);

-- --------------------------------------------------------

--
-- 表的结构 `link_class`
--

CREATE TABLE IF NOT EXISTS `link_class` (
  `id` int(10) NOT NULL,
  `sortnum` int(10) NOT NULL,
  `name` varchar(50) CHARACTER SET gbk NOT NULL,
  `haspic` int(10) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `link_class`
--

INSERT INTO `link_class` (`id`, `sortnum`, `name`, `haspic`) VALUES
(1, 10, '首页链接', 1);

-- --------------------------------------------------------

--
-- 表的结构 `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sortnum` int(11) NOT NULL,
  `user` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `user_no` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` int(1) unsigned NOT NULL DEFAULT '0',
  `pass` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(1) unsigned NOT NULL DEFAULT '0',
  `docu_type` int(11) DEFAULT '0',
  `docu_no` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '公司电话',
  `admin_id` int(6) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  `update_time` datetime DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  `login_num` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `member`
--

INSERT INTO `member` (`id`, `sortnum`, `user`, `user_no`, `user_type`, `pass`, `name`, `level`, `docu_type`, `docu_no`, `phone`, `email`, `company`, `address`, `contact`, `tel`, `admin_id`, `create_time`, `update_time`, `login_time`, `login_num`) VALUES
(1, 10, 'cui', 'xc999000629', 0, 'e10adc3949ba59abbe56e057f20f883e', '崔云超', 0, 2, '342601198410270659', '13655603465', NULL, '万家热线', NULL, NULL, NULL, 0, '0000-00-00 00:00:00', '2015-01-14 02:12:24', NULL, NULL),
(2, 20, 'yangxiaoyan', 'xc999423453', 0, 'e10adc3949ba59abbe56e057f20f883e', '杨晓燕', 0, 0, '342601198410270659', '13655603465', NULL, '万家热线', NULL, NULL, NULL, 0, '2015-01-13 13:55:11', '2015-01-13 14:07:52', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sortnum` int(10) unsigned DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime NOT NULL,
  `reply` text COLLATE utf8_unicode_ci,
  `reply_time` datetime DEFAULT NULL,
  `ip` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='会员' AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`id`, `sortnum`, `name`, `tel`, `phone`, `email`, `fax`, `title`, `company`, `address`, `content`, `create_time`, `reply`, `reply_time`, `ip`, `state`) VALUES
(1, 10, '在线视频', NULL, '', '', '', NULL, '', NULL, '媒体中心|关于新凌|新凌团队|业务范围|服务中心|加入我们|\r\n\r\n贵宾热线：0551-63411788 2014安徽别格迪派标识系统有限公司', '2014-05-13 06:42:00', 'dddddddddddd', '2014-06-16 00:53:00', '', 2),
(2, 20, '在线视频', NULL, 'gfgh', '', '', NULL, '', NULL, 'hhhghg', '2014-05-13 06:39:00', 'dddddddddddddddd', '2014-06-16 00:52:57', '', 2),
(3, 30, '崔云超', NULL, '13655603465', 'qd_usb@163.com', '', NULL, '', NULL, 'sdasaaddas', '2014-05-14 03:42:00', 'ddddddddddddddddddd', '2014-06-16 00:52:53', '', 2),
(4, 40, 'dddd', NULL, '', '', '', NULL, '', NULL, 'ddddddd', '2014-06-16 08:47:13', 'dsaaaaaaaaaaaaaaaa', '2014-06-16 00:52:40', '', 2),
(5, 50, 'dddd', NULL, '', '', '', NULL, '', NULL, 'ddddddd', '2014-06-16 08:50:48', 'daddsadsaads', '2014-06-16 00:52:35', '', 2),
(6, 60, 'dddddd', NULL, '', '', '', NULL, '', NULL, 'dddddd', '2014-06-16 08:50:55', 'asddasasddsasdaadsadsdas', '2014-06-16 00:52:31', '', 2),
(7, 70, 'ddddddd', NULL, '', '', '', NULL, '', NULL, 'dsadasdsaadsdasdas', '2014-06-16 08:54:08', NULL, NULL, '', 0),
(8, 80, 'fffddsf', NULL, '', '', '', NULL, '', NULL, 'dffss肥嘟嘟啥方法的所发生的', '2014-06-16 08:56:16', NULL, NULL, '', 0),
(9, 90, 'ibw_xu256', NULL, '13655603465', '', '', NULL, '', NULL, 'uuyuy', '2014-06-16 16:35:18', NULL, NULL, '', 0),
(10, 100, 'ibw_xu256ddd', NULL, '13655603465', '', '', NULL, '', NULL, 'uuyuy叮叮叮', '2014-06-16 16:35:45', NULL, NULL, '', 0),
(11, 110, '叮叮叮', NULL, '18956564620', '', '', NULL, '', NULL, '叮叮叮', '2014-06-16 16:36:04', NULL, NULL, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `sms`
--

CREATE TABLE IF NOT EXISTS `sms` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `state` int(1) NOT NULL DEFAULT '1',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sms_log`
--

CREATE TABLE IF NOT EXISTS `sms_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sms_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
