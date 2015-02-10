-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-02-10 05:38:43
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
(3, '2015-01-14 14:01:58', '127.0.0.1'),
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
(1, 10, '基本设置', 'config_base.php', 1),
(3, 30, '链接管理', 'link_list.php', 1),
(4, 40, '链接分类管理', 'link_class_list.php', 0),
(5, 50, 'Banner管理', 'banner_list.php', 1),
(6, 60, 'Banner分类管理', 'banner_class_list.php', 0),
(7, 70, '个人登机记录', 'air_record_list.php', 0),
(11, 110, '个人会员管理', 'member_list.php', 0),
(12, 15, '一级分类管理', 'base_class_list.php', 0),
(13, 120, '企业会员管理', 'member_company_list.php', 0),
(19, 200, '短信管理', 'sms_list.php', 1);

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
  `type` int(10) unsigned NOT NULL,
  `user_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `passenger` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fly_date` datetime DEFAULT NULL,
  `arrive_date` datetime DEFAULT NULL,
  `trip` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ticket_price` int(11) NOT NULL,
  `deposit` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `air_record`
--

INSERT INTO `air_record` (`id`, `sortnum`, `type`, `user_id`, `admin_id`, `passenger`, `fly_date`, `arrive_date`, `trip`, `ticket_price`, `deposit`, `create_time`, `update_time`) VALUES
(10, 10, 1, 8, 0, '桃子', '2015-01-18 09:40:00', '2015-01-18 16:30:00', '合肥-武汉', 600, 600, '2015-02-03 06:02:04', NULL),
(11, 10, 0, 5, 0, '崔云超', '2015-02-12 00:00:00', '2015-02-12 00:00:00', '合肥-成都', 1200, 1200, '2015-02-08 22:41:12', NULL),
(12, 20, 0, 6, 0, '崔云超', '2015-02-12 00:00:00', '2015-02-12 00:00:00', '合肥-成都', 1200, 1200, '2015-02-08 22:50:40', NULL),
(13, 50, 1, 13, 0, '崔云超', '2015-02-12 00:00:00', '2015-02-12 00:00:00', '合肥-成都', 1200, 1200, '2015-02-09 00:47:50', NULL),
(14, 50, 1, 13, 0, '崔云超', '2015-02-09 09:00:13', '2015-02-09 09:00:15', '合肥-成都', 1200, 1800, '2015-02-09 01:00:24', NULL),
(15, 70, 0, 16, 0, '崔云超', '2015-02-10 11:08:10', '2015-02-10 11:08:12', '合肥-成都', 1200, 1200, '2015-02-10 03:08:21', NULL),
(16, 10, 0, 5, 0, '崔云超', '2015-02-17 11:09:59', '2015-02-10 11:10:07', '合肥-成都', 1200, 1200, '2015-02-10 03:10:13', NULL),
(17, 50, 1, 13, 0, '崔云超', '2015-02-09 09:00:13', '2015-02-12 12:26:34', '合肥-成都', 900, 900, '2015-02-10 04:26:45', NULL);

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
(1, 1, 10, '图片1', '', '', '2015-02/142303083865791100.jpg', '', 0, 0, 1),
(2, 1, 20, '图片2', '', '', '2015-02/142303085803314500.jpg', '', 0, 0, 1);

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
(1, 10, '首页Banner', 0, 0);

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
(1, '合肥晨飞网络', '', '合肥晨飞网络', '合肥晨飞网络', '皖ICP备08000675号', '合肥晨飞网络', '合肥晨飞网络', '安徽旭驰票务代理有限公司@2015版权所有 &nbsp;客服热线：0551-65151513　　　设计策划：合肥晨飞网络_一站式网络整合营销服务商！', '', 173);

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
(1, 10, 0, '联系方式', '', 0, 0, '106101', '', '', '', '', '', NULL, NULL, '', '', '<p>\r\n	地址：上海市xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx\r\n</p>\r\n<p>\r\n	电话：+86 150 0089 9559\r\n</p>\r\n<p>\r\n	邮箱：Larry@pariscafe.com\r\n</p>\r\n<p>\r\n	网址：www.pariscafe.com\r\n</p>\r\n<p>\r\n	邮编：xxxxxxxxxx\r\n</p>', '', 0, '', '2014-06-16 09:01:23', '2014-06-16 09:01:35', 1, '', '', 0, NULL, NULL, NULL, NULL),
(2, 10, 0, '预订', '', 0, 0, '102101', '', '', '', '', '', NULL, NULL, '', '', '<p>　　网新科技有限公司成立于2001年，是集网站设计、网页制作、技术研发、产品销售于一体的综合性网络服务公司，公司专业从事网站建设方面的综合服务，以网站设计与网络推广为主导，同时包括企业邮局、域名注册、虚拟主机等方面的服务。</p>\r\n				<p>&nbsp;</p>\r\n				<p>　　多年来，公司一直奉行&ldquo;客户至上，用心服务&rdquo;的宗旨，想客户之所想，急客户之所急，为政府机关、上市公司、高等院校、旅游集团、工矿企业、房地产开发等多个部门与行业提供网站建设服务，得到了广大客户的认可，目前，公司客户遍布全国多个城市与地区，为客户的网络宣传、电子商务、网络营销提供了切实有效的服务与积极的作用，创造了良好的经济和社会效益。</p>\r\n				<p>&nbsp;</p>\r\n				<p>　　网新科技专注于企事业单位的互联网应用服务，已经成为安徽最优秀的互联网服务企业，是全球最大中文搜索引擎百度(Baidu)安徽地区唯一授权代理服务中心，新浪企业邮局(Sina)安徽地区金牌代理商，中国万网安徽地区核心代理商。</p>\r\n				<p>&nbsp;</p>\r\n				<p>　　网新科技拥有一支经验丰富、创意独到、自信尽职、团结协作的网络营销顾问、设计师、系统分析员构成的专业服务团队。专注于企业级互联网应用开发与网络营销服务，帮助各行业用户利用互联网创造价值，领先于竞争对手，并成为用户长期的业务伙伴。</p>\r\n				<p>&nbsp;</p>\r\n				<p>　　公司组织架构健全，现设技术部、设计部、客服部、研发部、市场部、销售部、综合部，员工共90人，平均年龄26岁。目前公司下设芜湖分公司和蚌埠分公司。公司用人原则是吸纳优秀人才，&ldquo;以人为本&rdquo;，员工关系融洽，内部凝聚力强，能同时承担多个大型服务项目。</p>\r\n				<p>&nbsp;</p>\r\n				<p>　　网新科技作为安徽最优秀的网络服务企业，愿与广大用户、各位同行紧密联系，共同探讨，为提高我国的网站建设与网络营销水平而努力奋斗。</p>', '', 0, '', '2015-02-09 07:00:22', '2015-02-09 07:00:33', 1, '', '', 0, NULL, NULL, NULL, NULL);

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

--
-- 转存表中的数据 `info_class`
--

INSERT INTO `info_class` (`id`, `sortnum`, `name`, `en_name`, `pic`, `content`, `files`, `info_state`, `max_level`, `has_sub`, `sub_content`, `sub_pic`, `hasViews`, `hasState`, `hasPic`, `hasAnnex`, `hasIntro`, `hasShare`, `hasContent`, `hasContent2`, `hasWebsite`, `hasAuthor`, `hasSource`, `hasKeyword`, `hasLevel`, `state`) VALUES
('101', 10, '会员登陆', '', NULL, '', '', 'custom', 2, 1, 0, 0, 1, 1, 1, 0, 0, 0, 1, NULL, 0, 0, 0, 0, 0, 1),
('102', 20, '机票预订', 'Book', NULL, '', '', 'custom', 2, 1, 0, 0, 1, 1, 1, 0, 0, 0, 1, NULL, 0, 0, 0, 0, 0, 1),
('103', 30, '积分规则', '', NULL, '', '', 'custom', 2, 1, 0, 0, 1, 1, 1, 0, 0, 0, 1, NULL, 0, 0, 0, 0, 0, 1),
('104', 40, '积分兑换', '', NULL, '', '', 'custom', 2, 1, 0, 0, 1, 1, 1, 0, 0, 0, 1, NULL, 0, 0, 0, 0, 0, 1),
('105', 50, '公司介绍', '', NULL, '', '', 'custom', 2, 1, 0, 0, 1, 1, 1, 0, 0, 0, 1, NULL, 0, 0, 0, 0, 0, 1),
('106', 60, '联系我们', '', NULL, '', '', 'custom', 2, 1, 0, 0, 1, 1, 1, 0, 0, 0, 1, NULL, 0, 0, 0, 0, 0, 1),
('102101', 10, '机票预订', '', '', '', '', 'content', 0, 0, 0, 0, 1, 1, 1, 0, 0, NULL, 1, NULL, 0, 0, 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `integral_log`
--

CREATE TABLE IF NOT EXISTS `integral_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `operation` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `integral` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
(1, '1', 10, '中国银行', 'http://www.ibw.cn', '2015-02/142303091650204800.jpg', 1),
(2, '1', 20, '民生银行', '', '2015-02/142303092317885900.jpg', 1);

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
  `payment` decimal(8,2) NOT NULL DEFAULT '0.00',
  `integral` int(11) NOT NULL DEFAULT '0',
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
  `intro` text COLLATE utf8_unicode_ci,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  `login_num` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`),
  UNIQUE KEY `user_no` (`user_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `member`
--

INSERT INTO `member` (`id`, `sortnum`, `user`, `payment`, `integral`, `user_no`, `user_type`, `pass`, `name`, `level`, `docu_type`, `docu_no`, `phone`, `email`, `company`, `address`, `contact`, `tel`, `admin_id`, `intro`, `create_time`, `update_time`, `login_time`, `login_num`) VALUES
(5, 10, 'cui01', '0.00', 2500, 'xc999292364', 0, '25d55ad283aa400af464c76d713c07ad', '崔云超', 0, 0, '342601198410270659', '13655603465', 'qd_usb@163.cc', '万家热线', NULL, NULL, NULL, 0, '342601198410270659顶顶顶冻豆腐', '2015-02-05 11:37:34', '2015-02-10 04:21:09', '2015-02-09 14:01:58', 2),
(6, 20, 'cui002', '0.00', 1200, 'xc999994377', 0, '25d55ad283aa400af464c76d713c07ad', '崔云超', 0, 0, '1说的456', '13655603465', 'qd_usb@163.cc', NULL, NULL, NULL, NULL, 0, '', '2015-02-07 01:14:39', NULL, '2015-02-07 09:14:39', 1),
(7, 30, 'cui003', '0.00', 0, 'xc999091468', 0, '25d55ad283aa400af464c76d713c07ad', '', 0, 0, '356485', '18956564620', 'qd_usb@163.cc', NULL, NULL, NULL, NULL, 0, '事实上', '2015-02-07 01:45:23', NULL, '2015-02-07 09:45:23', 1),
(8, 40, 'cui004', '0.00', 0, 'xc999832513', 0, '25d55ad283aa400af464c76d713c07ad', '崔云超', 0, 0, '1233', '18956564620', 'qd_usb@163.cc', NULL, NULL, NULL, NULL, 0, '', '2015-02-07 01:48:12', NULL, '2015-02-09 14:06:05', 6),
(9, 10, 'cui005', '0.00', 0, 'xc999733888', 1, '25d55ad283aa400af464c76d713c07ad', NULL, 0, 0, NULL, '18956564620', 'qd_usb@163.cc', '万家热线', '111', NULL, NULL, 0, '', '2015-02-07 01:57:53', NULL, '2015-02-07 09:57:53', 1),
(10, 20, 'cui006', '0.00', 0, 'xc999944888', 1, '25d55ad283aa400af464c76d713c07ad', NULL, 0, 0, NULL, '18956564620', 'qd_usb@163.cc', '万家热线', '111', NULL, NULL, 0, '', '2015-02-07 01:58:03', NULL, '2015-02-07 09:58:03', 1),
(11, 30, 'cui008', '0.00', 0, 'xc999745888', 1, '25d55ad283aa400af464c76d713c07ad', NULL, 0, 0, NULL, '18956564620', 'qd_usb@163.cc', '万家热线', '111', NULL, NULL, 0, '', '2015-02-07 02:00:57', NULL, '2015-02-07 10:00:57', 1),
(12, 40, 'cui009', '0.00', 0, 'xc999523888', 1, '25d55ad283aa400af464c76d713c07ad', NULL, 0, 0, NULL, '18956564620', 'qd_usb@163.cc', '万家热线', '11111', NULL, NULL, 0, '1111', '2015-02-07 02:01:48', NULL, '2015-02-07 10:01:48', 1),
(13, 50, 'cui010', '0.00', 3900, 'xc999645888', 1, '4428c6c474502e61151877825bb41961', NULL, 0, 0, NULL, '13655603465', 'qd_usb@163.cc', '万家热线', '0', '崔云超', '', 0, '', '2015-02-07 02:03:07', '2015-02-09 01:47:34', '2015-02-09 10:39:23', 9),
(14, 50, 'cui011', '0.00', 0, 'xc999406256', 0, '25d55ad283aa400af464c76d713c07ad', '', 0, 0, '11111111', '13514993600', 'qd_usb@163.cc', NULL, NULL, NULL, NULL, 0, '', '2015-02-07 02:08:19', NULL, '2015-02-07 10:08:19', 1),
(15, 60, 'cui012', '0.00', 1200, 'xc999768195', 0, '25d55ad283aa400af464c76d713c07ad', '', 0, 0, '11111111', '13514993600', 'qd_usb@163.cc', '', NULL, NULL, NULL, 0, '', '2015-02-07 02:09:45', '2015-02-10 05:29:06', '2015-02-07 10:09:45', 1),
(16, 70, 'cui013', '2000.00', 3600, 'xc999610608', 0, '25d55ad283aa400af464c76d713c07ad', '', 0, 0, '11111111', '13514993600', 'qd_usb@163.cc', '万家热线', NULL, NULL, NULL, 0, '', '2015-02-07 02:14:22', '2015-02-10 05:28:51', '2015-02-07 10:14:22', 1);

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
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `sms`
--

INSERT INTO `sms` (`id`, `sortnum`, `title`, `content`, `state`, `create_time`) VALUES
(1, 10, '新春贺卡dddhhhhgggg', '新年好dddffff', 1, '2015-01-14 15:07:00'),
(2, 20, '端午节短信', '端午节到了', 1, '2015-01-15 07:12:30'),
(3, 30, '重阳节短信', '重阳节短信个重阳节短信个重阳节短信个重阳节短信个重阳节短信个重阳节短信个重阳节短信个重阳节短信个', 0, '2015-01-15 07:14:11');

-- --------------------------------------------------------

--
-- 表的结构 `sms_log`
--

CREATE TABLE IF NOT EXISTS `sms_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sms_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `create_time` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `sms_log`
--

INSERT INTO `sms_log` (`id`, `sms_id`, `member_id`, `create_time`) VALUES
(1, 1, 4, '2015-01-15 14:37:02'),
(2, 1, 5, '2015-01-15 15:21:51'),
(3, 1, 3, '2015-01-15 15:21:51'),
(4, 1, 2, '2015-01-15 15:21:51'),
(5, 1, 1, '2015-01-15 15:21:51'),
(6, 3, 5, '2015-01-15 15:22:31'),
(7, 3, 3, '2015-01-15 15:22:31'),
(8, 3, 2, '2015-01-15 15:22:31'),
(9, 3, 1, '2015-01-15 15:22:31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
