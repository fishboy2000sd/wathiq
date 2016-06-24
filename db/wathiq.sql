-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2016 at 10:54 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wathiq`
--
CREATE DATABASE IF NOT EXISTS `wathiq` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `wathiq`;

-- --------------------------------------------------------

--
-- Table structure for table `attachment_category`
--

CREATE TABLE IF NOT EXISTS `attachment_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `level` set('phase','subphase','delivery') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `attachment_category`
--

INSERT INTO `attachment_category` (`id`, `category`, `level`) VALUES
(1, 'خطاب تسليم مرحلة', 'phase'),
(2, 'خطاب قبول مرحلة', NULL),
(3, 'خطاب رفض مرحلة', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attachment_deliverable`
--

CREATE TABLE IF NOT EXISTS `attachment_deliverable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `attachment_type_id` int(11) NOT NULL,
  `attachment_category_id` int(11) NOT NULL,
  `project_subphase_deliverable_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_attachment_delivery_attachment_type1_idx` (`attachment_type_id`),
  KEY `fk_attachment_delivery_attachment_category1_idx` (`attachment_category_id`),
  KEY `fk_attachment_delivery_project_subphase_delivery1_idx` (`project_subphase_deliverable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attachment_phase`
--

CREATE TABLE IF NOT EXISTS `attachment_phase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `attachment_type_id` int(11) NOT NULL,
  `attachment_category_id` int(11) NOT NULL,
  `project_phase_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_attachment_attachment_type1_idx` (`attachment_type_id`),
  KEY `fk_attachment_attachment_category1_idx` (`attachment_category_id`),
  KEY `fk_attachment_phase_project_phase1_idx` (`project_phase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `attachment_phase`
--

INSERT INTO `attachment_phase` (`id`, `path`, `attachment_type_id`, `attachment_category_id`, `project_phase_id`) VALUES
(1, '/test/testme', 1, 1, 21),
(2, '01fd1-rs.txt', 1, 1, 22),
(3, '3fd05-rs.txt', 1, 1, 23),
(4, '1d18c-rs.txt', 1, 1, 24),
(5, '1c770-rs.txt', 1, 1, 25);

-- --------------------------------------------------------

--
-- Table structure for table `attachment_type`
--

CREATE TABLE IF NOT EXISTS `attachment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `attachment_type`
--

INSERT INTO `attachment_type` (`id`, `type`) VALUES
(1, 'CD'),
(2, 'نسخة ورقية'),
(3, 'نسخة الكترونية');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) DEFAULT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('dc4a0f9069c8f2a5f48b2ea279cb7375', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', 1466801502, 'a:5:{s:9:"user_data";s:0:"";s:9:"logged_in";b:1;s:8:"username";s:5:"admin";s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"1";}'),
('e7e10e7a31c40b1d56abcd342562974c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', 1466799511, '');

-- --------------------------------------------------------

--
-- Table structure for table `consultant`
--

CREATE TABLE IF NOT EXISTS `consultant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `consultant`
--

INSERT INTO `consultant` (`id`, `name`, `email`, `phone_no`) VALUES
(1, 'أحمد ميرغني', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contractor`
--

CREATE TABLE IF NOT EXISTS `contractor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contractor`
--

INSERT INTO `contractor` (`id`, `name`, `email`, `phone_no`) VALUES
(1, 'محمد صديق', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contract_category`
--

CREATE TABLE IF NOT EXISTS `contract_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `contract_phase_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_contract_category_contract_phase1_idx` (`contract_phase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contract_category`
--

INSERT INTO `contract_category` (`id`, `name`, `contract_phase_id`) VALUES
(1, 'الدراسات الأولية', 1),
(2, 'الدراسات التخطيطية', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contract_model`
--

CREATE TABLE IF NOT EXISTS `contract_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `duration` varchar(45) DEFAULT NULL,
  `contract_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contract_model_contract1_idx` (`contract_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contract_model`
--

INSERT INTO `contract_model` (`id`, `name`, `duration`, `contract_type_id`) VALUES
(1, 'testA', '100', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contract_phase`
--

CREATE TABLE IF NOT EXISTS `contract_phase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `phase_order` int(11) DEFAULT NULL,
  `contract_model_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contract_phase_contract_type1_idx` (`contract_model_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `contract_phase`
--

INSERT INTO `contract_phase` (`id`, `name`, `description`, `phase_order`, `contract_model_id`) VALUES
(1, 'التصميم الابتدائي', NULL, 1, 1),
(2, 'تطوير التصميم', NULL, 2, 1),
(3, 'التصميم النهائي', NULL, 3, 1),
(4, 'الوثائق التنفيذية النهائية', NULL, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contract_phase_category_list`
--

CREATE TABLE IF NOT EXISTS `contract_phase_category_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` tinytext,
  `percentage` int(11) DEFAULT NULL,
  `page_no` int(11) DEFAULT NULL,
  `done` tinyint(1) DEFAULT NULL,
  `contract_category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contract_phase_category_list_contract_category1_idx` (`contract_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contract_type`
--

CREATE TABLE IF NOT EXISTS `contract_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `contract_type`
--

INSERT INTO `contract_type` (`id`, `type`) VALUES
(1, 'a'),
(2, 'b'),
(3, 'c');

-- --------------------------------------------------------

--
-- Table structure for table `deliverable_status`
--

CREATE TABLE IF NOT EXISTS `deliverable_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `deliverable_status`
--

INSERT INTO `deliverable_status` (`id`, `name`) VALUES
(1, 'Accept'),
(2, 'Accept with notes'),
(3, 'Reject');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(45) DEFAULT NULL,
  `msg` text,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE IF NOT EXISTS `owner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `ref_no` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `attachment` varchar(100) DEFAULT NULL,
  `comment` text,
  `owner_type_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_owner_owner_type1_idx` (`owner_type_id`),
  KEY `fk_owner_site1_idx` (`site_id`),
  KEY `uk_owner` (`site_id`,`owner_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`id`, `name`, `ref_no`, `area`, `attachment`, `comment`, `owner_type_id`, `site_id`) VALUES
(16, NULL, NULL, NULL, NULL, NULL, 3, 15),
(17, NULL, NULL, NULL, NULL, NULL, 2, 15),
(18, NULL, NULL, NULL, NULL, NULL, 1, 15),
(19, '10/17/2015', '1231', '100', '', 'test1', 1, 15),
(20, '10/17/2015', '1232', '200', '', 'test2', 2, 15),
(21, '10/17/2015', '1233', '300', '', 'test3', 3, 15);

-- --------------------------------------------------------

--
-- Table structure for table `owner_type`
--

CREATE TABLE IF NOT EXISTS `owner_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `owner_type`
--

INSERT INTO `owner_type` (`id`, `name`) VALUES
(1, 'محضر التسليم'),
(2, 'قرار التخصيص'),
(3, 'الصك');

-- --------------------------------------------------------

--
-- Table structure for table `phase`
--

CREATE TABLE IF NOT EXISTS `phase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `phase`
--

INSERT INTO `phase` (`id`, `name`) VALUES
(1, 'الإنشاء'),
(2, 'التصميم'),
(3, 'الطرح'),
(4, 'الترسية'),
(5, 'التنفيذ'),
(6, 'الإغلاق');

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE IF NOT EXISTS `privilege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `name`, `code`) VALUES
(1, 'قراءة مشروع', 'read_project'),
(2, 'إضافة مشروع', 'create_project'),
(3, 'تحديث مشروع', 'update_project'),
(4, 'حذف مشروع', 'delete_project'),
(5, 'قراءة حالة مشروع', 'read_project_status'),
(6, 'إضافة حالة مشروع', 'create_project_status'),
(7, 'تحديث حالة مشروع', 'update_project_status'),
(8, 'حذف حالة مشروع', 'delete_project_status'),
(9, 'قراءة مرحلة مشروع', 'read_project_phase'),
(10, 'إضافة مرحلة مشروع', 'create_project_phase'),
(11, 'تحديث مرحلة مشروع', 'update_project_phase'),
(12, 'حذف مرحلة مشروع', 'delete_project_phase'),
(13, 'قراءة مرحلة فرعية لمشروع', 'read_project_subphase'),
(14, 'إضافة مرحلة فرعية لمشروع', 'create_project_subphase'),
(15, 'تحديث مرحلة فرعية لمشروع', 'update_project_subphase'),
(16, 'حذف مرحلة فرعية لمشروع', 'delete_project_subphase'),
(17, 'قراءة مرفقات', 'read_attachment'),
(18, 'إضافة مرفقات', 'create_attachment'),
(19, 'تحديث مرفقات', 'update_attachment'),
(20, 'حذف مرفقات', 'delete_attachment'),
(21, 'قراءة موقع', 'read_site'),
(22, 'إضافة موقع', 'create_site'),
(23, 'تحديث موقع', 'update_site'),
(24, 'حذف موقع', 'delete_site'),
(25, 'قراءة عقودات', 'read_contract'),
(26, 'إضافة عقودات', 'create_contract'),
(27, 'تحديث عقودات', 'update_contract'),
(28, 'حذف عقودات', 'delete_contract'),
(29, 'قراءة الإعدادات', 'read_setting'),
(30, 'قراءة التقارير', 'read_report'),
(31, 'قراءة التسليمات', 'read_deliverable'),
(32, 'تحديث التسليمات', 'update_deliverable'),
(33, 'إضافة التسليمات', 'create_deliverable'),
(34, 'حذف التسليمات', 'delete_deliverable'),
(35, 'إضافة مستخدم', 'create_user'),
(36, 'قراءة مستخدم', 'read_user'),
(37, 'تحديث مستخدم', 'update_user'),
(38, 'حذف مستخدم', 'delete_user'),
(39, 'قراءة دور', 'read_role'),
(40, 'إضافة دور', 'create_role'),
(41, 'تحديث دور', 'update_role'),
(42, 'حذف دور', 'delete_role'),
(43, 'قراءة مستشار', 'read_consultant'),
(44, 'إضافة مستشار', 'create_consultant'),
(45, 'تحديث مستشار', 'update_consultant'),
(46, 'حذف مستشار', 'delete_consultant'),
(47, 'فراءة مقاول', 'read_contractor'),
(48, 'إضافة مقاول', 'create_contractor'),
(49, 'تحدبث مقاول', 'update_contractor'),
(50, 'حذف مقاول', 'delete_contractor'),
(51, 'قراءة صلاحية', 'read_privilege'),
(52, 'إضافة صلاحية', 'create_privilege'),
(53, 'تحديث صلاحية', 'update_privilege'),
(54, 'حذف صلاحية', 'delete_privilege');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `started_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `close_date` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `site_id` int(11) NOT NULL,
  `project_status_id` int(11) DEFAULT '1',
  `contractor_id` int(11) DEFAULT NULL,
  `consultant_id` int(11) DEFAULT NULL,
  `contract_model_id` int(11) DEFAULT NULL,
  `phase_id` int(11) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `contract_phase_id` int(11) NOT NULL DEFAULT '1',
  `progress` double NOT NULL DEFAULT '0',
  `additional_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_project_site1_idx` (`site_id`),
  KEY `fk_project_project_status1_idx` (`project_status_id`),
  KEY `fk_project_contractor1_idx` (`contractor_id`),
  KEY `fk_project_consultant1_idx` (`consultant_id`),
  KEY `fk_project_contract_model1_idx` (`contract_model_id`),
  KEY `fk_project_project_phase1_idx` (`phase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `started_date`, `close_date`, `updated_at`, `site_id`, `project_status_id`, `contractor_id`, `consultant_id`, `contract_model_id`, `phase_id`, `file`, `contract_phase_id`, `progress`, `additional_time`) VALUES
(3, 'مشروع 1', '2015-10-03 13:44:44', NULL, '2015-10-03 13:44:44', 2, NULL, 1, 1, NULL, NULL, '', 0, 0, 0),
(6, 'aaaa', '2015-10-03 14:46:11', NULL, '2015-10-03 14:46:11', 2, NULL, 1, 1, NULL, NULL, '', 0, 0, 0),
(7, 'qq', '2015-10-03 14:46:28', NULL, '2015-10-03 14:46:28', 2, NULL, 1, 1, NULL, NULL, '', 0, 0, 0),
(8, 'تجريب', '2015-10-09 00:00:00', NULL, '2015-10-09 23:10:00', 2, NULL, NULL, 1, NULL, NULL, '', 0, 0, 0),
(12, 'asdf', '2015-10-20 00:00:00', NULL, '2015-10-10 00:33:34', 2, NULL, NULL, 1, NULL, NULL, '', 0, 0, 0),
(15, 'aaa', '2015-10-10 00:00:00', NULL, '2015-10-10 00:43:12', 2, NULL, NULL, 1, NULL, NULL, '', 0, 0, 0),
(16, 'bbb', '2015-10-10 00:00:00', NULL, '2015-10-10 00:50:50', 2, NULL, NULL, 1, NULL, NULL, '', 0, 0, 0),
(17, 'qq', '2015-10-18 00:00:00', NULL, '2015-10-10 10:54:50', 2, NULL, NULL, 1, NULL, NULL, '', 0, 0, 0),
(18, 'مشروع 1', '2015-10-24 00:00:00', NULL, '2015-10-10 11:02:19', 2, NULL, NULL, 1, NULL, NULL, '', 0, 0, 0),
(19, 'po', '2015-10-10 00:00:00', NULL, '2015-10-10 11:19:42', 2, NULL, NULL, 1, NULL, NULL, '', 0, 0, 0),
(20, 'مشروع 1', '2015-10-10 00:00:00', NULL, '2015-10-10 14:55:24', 2, NULL, NULL, 1, NULL, NULL, '', 0, 0, 0),
(21, 'الأول', '2015-10-26 00:00:00', NULL, '2015-10-10 15:07:36', 2, NULL, NULL, 1, NULL, NULL, '', 0, 0, 0),
(22, 'test', '2015-11-21 00:00:00', '2015-11-23 00:00:00', '2015-11-21 16:40:30', 3, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(23, 'tttt', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 16:57:58', 2, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(24, 'tttt', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 16:58:58', 2, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(25, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 17:00:12', 15, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(26, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 17:00:56', 15, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(27, 'مشروع 1', '2015-11-22 00:00:00', '2015-11-22 00:00:00', '2015-11-21 17:04:22', 15, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(28, 'مشروع 1', '2015-11-22 00:00:00', '2015-11-22 00:00:00', '2015-11-21 17:06:16', 15, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(29, 'مشروع 1', '2015-11-22 00:00:00', '2015-11-22 00:00:00', '2015-11-21 17:07:49', 15, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(30, 'مشروع 1', '2015-11-22 00:00:00', '2015-11-22 00:00:00', '2015-11-21 17:09:40', 15, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(31, 'مشروع 1', '2015-11-22 00:00:00', '2015-11-22 00:00:00', '2015-11-21 17:17:52', 15, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(32, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 17:19:03', 5, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(33, 'مشروع 1', '2015-11-22 00:00:00', '2015-11-22 00:00:00', '2015-11-21 17:35:21', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(34, 'مشروع 1', '2015-11-22 00:00:00', '2015-11-22 00:00:00', '2015-11-21 17:44:37', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(35, 'مشروع 1', '2015-11-22 00:00:00', '2015-11-22 00:00:00', '2015-11-21 17:44:46', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(36, 'مشروع 1', '2015-11-22 00:00:00', '2015-11-22 00:00:00', '2015-11-21 17:45:47', 3, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(37, 'مشروع 1', '2015-11-22 00:00:00', '2015-11-22 00:00:00', '2015-11-21 17:47:30', 3, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(38, 'مشروع 1', '2015-11-22 00:00:00', '2015-11-22 00:00:00', '2015-11-21 17:49:07', 3, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(39, 'مشروع 1', '2015-11-22 00:00:00', '2015-11-22 00:00:00', '2015-11-21 17:50:32', 3, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(40, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 17:52:30', 3, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(41, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 17:57:47', 3, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(42, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 18:07:05', 3, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(43, 'مشروع 1', '2015-11-22 00:00:00', '2015-11-23 00:00:00', '2015-11-21 18:15:34', 3, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(44, 'مشروع 1', '2015-11-22 00:00:00', '2015-11-23 00:00:00', '2015-11-21 18:17:22', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(45, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-23 00:00:00', '2015-11-21 18:18:38', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(46, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-23 00:00:00', '2015-11-21 18:41:07', 15, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(47, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 21:23:41', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(48, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 21:24:51', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(49, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 21:25:20', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(50, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 21:25:57', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(51, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 21:27:24', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(52, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 22:05:44', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(53, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 22:07:35', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(54, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 22:10:08', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(55, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 22:10:50', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(56, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 22:11:11', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(57, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 22:11:47', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(58, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 22:14:06', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(59, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 22:15:49', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(60, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 22:17:01', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(61, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 22:17:52', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(62, 'مشروع 1', '2015-11-22 00:00:00', '2015-11-24 00:00:00', '2015-11-21 22:19:17', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(63, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-22 00:00:00', '2015-11-21 22:23:41', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(64, 'مشروع 1', '2015-11-21 00:00:00', '2015-11-23 00:00:00', '2015-11-21 22:25:20', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(65, 'الترسية', '2015-11-21 22:27:26', '2015-11-23 00:00:00', '2015-11-21 22:27:32', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(66, 'مشروع 1', '2015-11-22 00:00:00', '2015-11-23 00:00:00', '2015-11-21 22:29:05', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(67, 'test', '2015-11-01 00:00:00', '2015-11-30 00:00:00', '2015-11-28 14:43:38', 8, NULL, NULL, 1, 1, NULL, '', 0, 0, 0),
(68, 'الإغلاق', '2015-11-28 00:00:00', '2015-11-30 00:00:00', '2015-11-28 17:13:51', 8, NULL, NULL, 1, 1, NULL, '/test/testme', 0, 0, 0),
(69, 'التنفيذ', '2015-11-28 00:00:00', '2015-11-30 00:00:00', '2015-11-28 17:15:34', 8, NULL, NULL, 1, 1, 5, '/test/testme', 0, 0, 0),
(70, 'الترسية', '2015-11-21 00:00:00', '2015-11-30 00:00:00', '2015-11-29 18:58:07', 7, NULL, NULL, 1, 1, 4, '01fd1-rs.txt', 0, 0, 0),
(71, 'الطرح', '2015-11-28 00:00:00', '2015-11-29 00:00:00', '2015-11-29 19:04:49', 8, NULL, NULL, 1, 1, 3, '3fd05-rs.txt', 0, 0, 0),
(72, 'التصميم', '2015-11-22 00:00:00', '2015-11-30 00:00:00', '2015-11-29 19:06:47', 15, NULL, NULL, 1, 1, 2, '1d18c-rs.txt', 1, 0, 0),
(73, 'إنشاء', '2015-11-01 00:00:00', '2015-11-02 00:00:00', '2015-11-29 20:21:31', 8, NULL, NULL, 1, 1, 5, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_phase`
--

CREATE TABLE IF NOT EXISTS `project_phase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `start_date` datetime DEFAULT NULL,
  `close_date` datetime DEFAULT NULL,
  `actual_start_date` datetime DEFAULT NULL,
  `actual_close_date` datetime DEFAULT NULL,
  `project_status_id` int(11) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `project_phase_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `project_phase_id` (`project_phase_id`),
  KEY `project_status_id` (`project_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `project_phase`
--

INSERT INTO `project_phase` (`id`, `name`, `description`, `start_date`, `close_date`, `actual_start_date`, `actual_close_date`, `project_status_id`, `project_id`, `project_phase_id`) VALUES
(21, NULL, NULL, '2015-11-28 12:00:00', NULL, NULL, NULL, NULL, 69, NULL),
(22, NULL, NULL, '2015-11-21 12:00:00', NULL, NULL, NULL, NULL, 70, NULL),
(23, NULL, NULL, '2015-11-28 12:00:00', NULL, NULL, NULL, NULL, 71, NULL),
(24, NULL, NULL, '2015-11-22 12:00:00', NULL, NULL, NULL, NULL, 72, NULL),
(25, NULL, NULL, '2015-11-01 12:00:00', NULL, NULL, NULL, NULL, 73, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_status`
--

CREATE TABLE IF NOT EXISTS `project_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `project_status`
--

INSERT INTO `project_status` (`id`, `name`) VALUES
(1, 'Accept'),
(2, 'Complete'),
(5, 'Failed'),
(3, 'Late'),
(4, 'Very Late');

-- --------------------------------------------------------

--
-- Table structure for table `project_subphase_deliverable`
--

CREATE TABLE IF NOT EXISTS `project_subphase_deliverable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inbox_date` datetime DEFAULT NULL,
  `outbox_date` datetime DEFAULT NULL,
  `inbox_no` int(11) DEFAULT NULL,
  `outbox_no` int(11) DEFAULT NULL,
  `revision_start_date` datetime DEFAULT NULL,
  `actual_revision_start_date` datetime DEFAULT NULL,
  `revision_finish_date` datetime DEFAULT NULL,
  `actual_revision_finish_date` datetime DEFAULT NULL,
  `close_date` datetime DEFAULT NULL,
  `actual_close_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `project_phase_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_project_subphase_delivery_project_subphase1_idx` (`project_phase_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `project_subphase_deliverable`
--

INSERT INTO `project_subphase_deliverable` (`id`, `inbox_date`, `outbox_date`, `inbox_no`, `outbox_no`, `revision_start_date`, `actual_revision_start_date`, `revision_finish_date`, `actual_revision_finish_date`, `close_date`, `actual_close_date`, `status`, `project_phase_id`) VALUES
(1, '2016-03-01 00:00:00', '2016-03-31 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sector_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_region_sector1_idx` (`sector_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `sector_id`, `name`) VALUES
(1, 1, 'منطقة 1');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(5, 'empty'),
(6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_privilege`
--

CREATE TABLE IF NOT EXISTS `role_privilege` (
  `privilege_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  KEY `fk_privilege_has_role_role1_idx` (`role_id`),
  KEY `fk_privilege_has_role_privilege1_idx` (`privilege_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_privilege`
--

INSERT INTO `role_privilege` (`privilege_id`, `role_id`, `priority`) VALUES
(6, 1, 26),
(26, 1, 27),
(14, 1, 28),
(10, 1, 29),
(18, 1, 30),
(2, 1, 31),
(22, 1, 32),
(7, 1, 33),
(27, 1, 34),
(15, 1, 35),
(11, 1, 36),
(19, 1, 37),
(3, 1, 38),
(23, 1, 39),
(8, 1, 40),
(28, 1, 41),
(16, 1, 42),
(12, 1, 43),
(20, 1, 44),
(4, 1, 45),
(24, 1, 46),
(29, 1, 47),
(17, 1, 48),
(30, 1, 49),
(5, 1, 50),
(25, 1, 51),
(13, 1, 52),
(9, 1, 53),
(21, 1, 25),
(1, 1, 24),
(1, 6, 0),
(1, 5, 0),
(33, 1, 0),
(40, 1, 1),
(52, 1, 2),
(35, 1, 3),
(44, 1, 4),
(48, 1, 5),
(49, 1, 6),
(32, 1, 7),
(41, 1, 8),
(53, 1, 9),
(37, 1, 10),
(45, 1, 11),
(34, 1, 12),
(42, 1, 13),
(54, 1, 14),
(38, 1, 15),
(46, 1, 16),
(50, 1, 17),
(47, 1, 18),
(31, 1, 19),
(39, 1, 20),
(51, 1, 21),
(36, 1, 22),
(43, 1, 23);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_section_department1_idx` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

CREATE TABLE IF NOT EXISTS `sector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`id`, `name`) VALUES
(1, 'قطاع 1');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE IF NOT EXISTS `site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) NOT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `site_type_id` int(11) NOT NULL,
  `latitute` float DEFAULT NULL,
  `longitute` float DEFAULT NULL,
  `map_link` varchar(255) DEFAULT NULL,
  `sketch` varchar(100) DEFAULT NULL,
  `consultant_area` float DEFAULT NULL,
  `site_area` float DEFAULT NULL,
  `expected_unit_num` int(11) DEFAULT NULL,
  `actual_unit_num` int(11) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `state_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  KEY `fk_site_site_type1_idx` (`site_type_id`),
  KEY `fk_site_state1_idx` (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `code`, `name_ar`, `name_en`, `site_type_id`, `latitute`, `longitute`, `map_link`, `sketch`, `consultant_area`, `site_area`, `expected_unit_num`, `actual_unit_num`, `updated_by`, `updated_at`, `state_id`) VALUES
(2, '123', 'عربيي', 'english', 1, 123, 123, NULL, NULL, NULL, 1000, 100, NULL, NULL, '2015-10-03 10:37:49', 1),
(3, 'asdasd', 'asdasd', 'asdasd', 1, 100, 100, NULL, NULL, NULL, 20, 20, NULL, NULL, '2015-10-11 19:37:19', 1),
(5, 'asdasdasd', 'asdasd', 'asdasd', 1, 100, 100, NULL, NULL, NULL, 20, 20, NULL, NULL, '2015-10-11 19:38:18', 1),
(7, 'asdasdasdasd', 'asdasd', 'asdasd', 1, 100, 100, NULL, NULL, NULL, 20, 20, NULL, NULL, '2015-10-11 19:40:09', 1),
(8, 'tesetme', 'ar', 'en', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-10-11 19:46:43', 1),
(15, '123456', 'ar', 'en', 1, 123, 123, NULL, NULL, NULL, 123, 123, NULL, NULL, '2015-10-16 21:11:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_type`
--

CREATE TABLE IF NOT EXISTS `site_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `site_type`
--

INSERT INTO `site_type` (`id`, `name`) VALUES
(1, 'type1');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_state_region1_idx` (`region_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `region_id`, `name`) VALUES
(1, 1, 'محافظة 1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(45) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `role_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`),
  KEY `fk_user_role1_idx` (`role_id`),
  KEY `fk_user_section1_idx` (`section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `name`, `email`, `status`, `created_at`, `role_id`, `section_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'مدير النظام', NULL, NULL, '2015-10-15 23:24:07', 1, NULL),
(2, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test', 'test', NULL, '2015-10-27 00:48:55', 5, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachment_deliverable`
--
ALTER TABLE `attachment_deliverable`
  ADD CONSTRAINT `fk_attachment_delivery_attachment_category1` FOREIGN KEY (`attachment_category_id`) REFERENCES `attachment_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_attachment_delivery_attachment_type1` FOREIGN KEY (`attachment_type_id`) REFERENCES `attachment_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_attachment_delivery_project_subphase_delivery1` FOREIGN KEY (`project_subphase_deliverable_id`) REFERENCES `project_subphase_deliverable` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `attachment_phase`
--
ALTER TABLE `attachment_phase`
  ADD CONSTRAINT `fk_attachment_attachment_category1` FOREIGN KEY (`attachment_category_id`) REFERENCES `attachment_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_attachment_attachment_type1` FOREIGN KEY (`attachment_type_id`) REFERENCES `attachment_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_attachment_phase_project_phase1` FOREIGN KEY (`project_phase_id`) REFERENCES `project_phase` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contract_category`
--
ALTER TABLE `contract_category`
  ADD CONSTRAINT `fk_contract_category_contract_phase1` FOREIGN KEY (`contract_phase_id`) REFERENCES `contract_phase` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contract_model`
--
ALTER TABLE `contract_model`
  ADD CONSTRAINT `fk_contract_model_contract1` FOREIGN KEY (`contract_type_id`) REFERENCES `contract_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contract_phase`
--
ALTER TABLE `contract_phase`
  ADD CONSTRAINT `contract_phase_ibfk_1` FOREIGN KEY (`contract_model_id`) REFERENCES `contract_model` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `contract_phase_category_list`
--
ALTER TABLE `contract_phase_category_list`
  ADD CONSTRAINT `fk_contract_phase_category_list_contract_category1` FOREIGN KEY (`contract_category_id`) REFERENCES `contract_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `owner`
--
ALTER TABLE `owner`
  ADD CONSTRAINT `fk_owner_owner_type1` FOREIGN KEY (`owner_type_id`) REFERENCES `owner_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_owner_site1` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `fk_project_consultant1` FOREIGN KEY (`consultant_id`) REFERENCES `consultant` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_contractor1` FOREIGN KEY (`contractor_id`) REFERENCES `contractor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_contract_model1` FOREIGN KEY (`contract_model_id`) REFERENCES `contract_model` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_project_status1` FOREIGN KEY (`project_status_id`) REFERENCES `project_status` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_site1` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project_phase`
--
ALTER TABLE `project_phase`
  ADD CONSTRAINT `project_phase_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_phase_ibfk_3` FOREIGN KEY (`project_phase_id`) REFERENCES `project_phase` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `project_phase_ibfk_4` FOREIGN KEY (`project_status_id`) REFERENCES `project_status` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `project_subphase_deliverable`
--
ALTER TABLE `project_subphase_deliverable`
  ADD CONSTRAINT `fk_project_subphase_delivery_project_subphase1` FOREIGN KEY (`project_phase_id`) REFERENCES `project_phase` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `project_subphase_deliverable_ibfk_1` FOREIGN KEY (`status`) REFERENCES `deliverable_status` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `fk_region_sector1` FOREIGN KEY (`sector_id`) REFERENCES `sector` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `role_privilege`
--
ALTER TABLE `role_privilege`
  ADD CONSTRAINT `fk_privilege_has_role_privilege1` FOREIGN KEY (`privilege_id`) REFERENCES `privilege` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_privilege_has_role_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `fk_section_department1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `fk_site_site_type1` FOREIGN KEY (`site_type_id`) REFERENCES `site_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_site_state1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `fk_state_region1` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_section1` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
