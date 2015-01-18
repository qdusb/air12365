-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 01 月 18 日 14:39
-- 服务器版本: 5.6.12-log
-- PHP 版本: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `air12365`
--
CREATE DATABASE IF NOT EXISTS `air12365` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `air12365`;

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
(1, 'admin', '0192023a7bbd73250516f069df18b500', '系统管理员', 8, 1, '2014-03-19 02:45:53', '2014-03-19 02:45:53', 9),
(2, 'hd', '25d55ad283aa400af464c76d713c07ad', '华东分销区', 7, 1, '2015-01-14 14:29:27', '2015-01-14 14:29:27', 2),
(3, 'hb', '25d55ad283aa400af464c76d713c07ad', '华北分销区', 7, 1, '2015-01-14 14:33:46', '2015-01-14 14:33:46', 1);

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
(1, '2015-01-14 04:01:12', '127.0.0.1'),
(2, '2015-01-14 14:01:40', '127.0.0.1'),
(3, '2015-01-14 14:01:58', '127.0.0.1'),
(2, '2015-01-14 14:01:10', '127.0.0.1'),
(1, '2015-01-14 14:01:47', '127.0.0.1'),
(1, '2015-01-14 14:01:25', '127.0.0.1'),
(1, '2015-01-14 15:01:43', '127.0.0.1'),
(1, '2015-01-18 14:01:54', '127.0.0.1');

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
(9, 90, '留言簿', 'message_list.php', 0),
(1, 10, '基本设置', 'config_base.php', 1),
(3, 30, '链接管理', 'link_list.php', 0),
(4, 40, '链接分类管理', 'link_class_list.php', 0),
(5, 50, 'Banner管理', 'banner_list.php', 0),
(6, 60, 'Banner分类管理', 'banner_class_list.php', 0),
(10, 180, '加入我们', 'joinus_list.php', 0),
(7, 70, '个人登机记录', 'air_record_list.php', 1),
(8, 80, '应聘人员', 'job_apply_list.php', 0),
(11, 110, '个人会员管理', 'member_list.php', 0),
(12, 15, '一级分类管理', 'base_class_list.php', 0),
(13, 120, '企业会员管理', 'member_company_list.php', 0),
(14, 130, '电子杂志管理', 'album_class_list.php', 0),
(15, 140, '员工管理', 'staff_list.php', 0),
(16, 150, '资料批量转移', 'transfer.php', 0),
(19, 200, '短信管理', 'sms_list.php', 1),
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
-- 表的结构 `air_record`
--

CREATE TABLE IF NOT EXISTS `air_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sortnum` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `passenger` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fly_date` datetime DEFAULT NULL,
  `arrive_date` datetime DEFAULT NULL,
  `trip` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ticket_price` int(11) NOT NULL,
  `deposit` int(11) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `air_record`
--

INSERT INTO `air_record` (`id`, `sortnum`, `user_id`, `admin_id`, `passenger`, `fly_date`, `arrive_date`, `trip`, `ticket_price`, `deposit`, `create_time`, `update_time`) VALUES
(1, 10, 5, 0, '杨晓燕', '2014-12-15 16:36:00', '2014-12-15 22:36:00', '合肥-乌鲁木齐', 1060, 6000, '2015-01-18 21:41:31', '2015-01-18 13:53:38');

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`),
  UNIQUE KEY `user_no` (`user_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `member`
--

INSERT INTO `member` (`id`, `sortnum`, `user`, `user_no`, `user_type`, `pass`, `name`, `level`, `docu_type`, `docu_no`, `phone`, `email`, `company`, `address`, `contact`, `tel`, `admin_id`, `create_time`, `update_time`, `login_time`, `login_num`) VALUES
(1, 10, 'cui', 'xc999000796', 0, 'e10adc3949ba59abbe56e057f20f883e', '崔云超', 1, 2, '342601198410270659', '13655603465', NULL, '万家热线8888', NULL, NULL, NULL, 0, '0000-00-00 00:00:00', '2015-01-15 15:17:34', NULL, NULL),
(2, 20, 'yangxiaoyan', 'xc999423453', 0, 'e10adc3949ba59abbe56e057f20f883e', '杨晓燕', 0, 0, '342601198410270659', '13655603465', NULL, '万家热线6666', NULL, NULL, NULL, 0, '2015-01-13 13:55:11', '2015-01-15 15:17:29', NULL, NULL),
(3, 30, 'hd', 'xc999000793', 0, '25d55ad283aa400af464c76d713c07ad', '华东杨晓燕', 1, 0, '365656554', '13655603465', NULL, '万家热线333', NULL, NULL, NULL, 0, '2015-01-14 14:32:44', '2015-01-15 15:17:21', NULL, NULL),
(4, 10, 'wjrx', 'xc999678888', 1, '25d55ad283aa400af464c76d713c07ad', NULL, 0, 0, NULL, '15066668888', NULL, '万家热线', '安徽合肥原创动漫产业园7L', '葛星', '0551-65658989', 0, '2015-01-15 14:35:26', NULL, NULL, NULL),
(5, 40, 'hdcui', 'xc999000863', 0, '25d55ad283aa400af464c76d713c07ad', '崔云超', 1, 0, '342601198410270659', '13655603465', NULL, '万家热线333666', NULL, NULL, NULL, 0, '2015-01-15 15:18:00', '2015-01-15 15:19:38', NULL, NULL);

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
  `sortnum` int(10) NOT NULL,
  `title` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `state` int(1) NOT NULL DEFAULT '1',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `sms`
--

INSERT INTO `sms` (`id`, `sortnum`, `title`, `content`, `state`, `create_time`) VALUES
(1, 10, '新春贺卡dddhhhhgggg', '新年好dddffff', 1, '2015-01-14 23:07:00'),
(2, 20, '端午节短信', '端午节到了', 1, '2015-01-15 15:12:30'),
(3, 30, '重阳节短信', '重阳节短信个重阳节短信个重阳节短信个重阳节短信个重阳节短信个重阳节短信个重阳节短信个重阳节短信个', 0, '2015-01-15 15:14:11');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `sms_log`
--

INSERT INTO `sms_log` (`id`, `sms_id`, `member_id`, `create_time`) VALUES
(1, 1, 4, '2015-01-15 22:37:02'),
(2, 1, 5, '2015-01-15 23:21:51'),
(3, 1, 3, '2015-01-15 23:21:51'),
(4, 1, 2, '2015-01-15 23:21:51'),
(5, 1, 1, '2015-01-15 23:21:51'),
(6, 3, 5, '2015-01-15 23:22:31'),
(7, 3, 3, '2015-01-15 23:22:31'),
(8, 3, 2, '2015-01-15 23:22:31'),
(9, 3, 1, '2015-01-15 23:22:31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
