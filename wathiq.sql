-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2015 at 04:35 PM
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
('3a39ca245657b412a9edcd6f3f5b3a00', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0', 1431802701, ''),
('96186180f5b11b0c872bb0e1436199ac', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0', 1431810035, ''),
('e977a6301678b6b562c0b3014e4bc139', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', 1432319168, ''),
('fbd9a065d81dd02a6920c75d092c41d9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', 1433158695, '');

-- --------------------------------------------------------

--
-- Table structure for table `contract_category`
--

CREATE TABLE IF NOT EXISTS `contract_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `contract_category`
--

INSERT INTO `contract_category` (`id`, `name`) VALUES
(4, 'أعمال البنية التحتية'),
(3, 'الأعمال المعمارية والمدنية'),
(1, 'الدراسات الأولية'),
(2, 'الدراسات التخطيطية');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `contract_model`
--

INSERT INTO `contract_model` (`id`, `name`, `duration`, `contract_type_id`) VALUES
(1, 'A250', '250', 1),
(2, 'A200', '200', 1),
(3, 'A300', '300', 1),
(4, 'B250', '250', 3);

-- --------------------------------------------------------

--
-- Table structure for table `contract_phase`
--

CREATE TABLE IF NOT EXISTS `contract_phase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `percentage` varchar(45) DEFAULT NULL,
  `page_number` int(11) DEFAULT NULL,
  `contract_category_id` int(11) NOT NULL,
  `contract_model_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contract_model_details_category1_idx` (`contract_category_id`),
  KEY `fk_contract_model_details_contract_model1_idx` (`contract_model_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contract_phase`
--

INSERT INTO `contract_phase` (`id`, `description`, `percentage`, `page_number`, `contract_category_id`, `contract_model_id`) VALUES
(1, '<p>\r\n دي مرحلة بتعمل كذا</p>\r\n', '10%', 12, 4, 1),
(2, '<p>\r\n سيبشسبي</p>\r\n', '20%', 3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `contract_status`
--

CREATE TABLE IF NOT EXISTS `contract_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contract_type`
--

CREATE TABLE IF NOT EXISTS `contract_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `contract_type`
--

INSERT INTO `contract_type` (`id`, `name`) VALUES
(1, 'A'),
(3, 'B'),
(4, 'C');

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
  UNIQUE KEY `owner_type_id` (`owner_type_id`,`site_id`),
  KEY `fk_owner_owner_type1_idx` (`owner_type_id`),
  KEY `fk_owner_site1_idx` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(1, 'delivery_minutes'),
(2, 'resolution_customization'),
(3, 'instrument');

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE IF NOT EXISTS `privilege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `name`) VALUES
(1, 'create_project'),
(2, 'manage_people');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `site_id` int(11) NOT NULL,
  `project_status_id` int(11) NOT NULL,
  `consultant_id` int(11) DEFAULT NULL,
  `contractor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_project_site1_idx` (`site_id`),
  KEY `fk_project_project_status1_idx` (`project_status_id`),
  KEY `fk_project_user1_idx` (`consultant_id`),
  KEY `fk_project_user2_idx` (`contractor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_contract_model`
--

CREATE TABLE IF NOT EXISTS `project_contract_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `contract_model_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_project_contract_model_project1_idx` (`project_id`),
  KEY `fk_project_contract_model_contract_model1_idx` (`contract_model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_status`
--

CREATE TABLE IF NOT EXISTS `project_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'project_manager');

-- --------------------------------------------------------

--
-- Table structure for table `role_privilege`
--

CREATE TABLE IF NOT EXISTS `role_privilege` (
  `privilege_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `priority` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`privilege_id`,`role_id`),
  KEY `fk_privilege_has_role_role1_idx` (`role_id`),
  KEY `fk_privilege_has_role_privilege1_idx` (`privilege_id`),
  KEY `priority` (`priority`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `role_privilege`
--

INSERT INTO `role_privilege` (`privilege_id`, `role_id`, `priority`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

CREATE TABLE IF NOT EXISTS `sector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `site_type`
--

CREATE TABLE IF NOT EXISTS `site_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `site_type`
--

INSERT INTO `site_type` (`id`, `name`) VALUES
(3, '2'),
(4, '5'),
(1, 'خام');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`),
  KEY `fk_user_role1_idx` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `name`, `email`, `status`, `created_at`, `role_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'أحمد ميرغني', 'fishboy2000sd@hotmail.com', NULL, '2015-05-08 23:55:24', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contract_model`
--
ALTER TABLE `contract_model`
  ADD CONSTRAINT `fk_contract_model_contract1` FOREIGN KEY (`contract_type_id`) REFERENCES `contract_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contract_phase`
--
ALTER TABLE `contract_phase`
  ADD CONSTRAINT `fk_contract_model_details_category1` FOREIGN KEY (`contract_category_id`) REFERENCES `contract_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contract_model_details_contract_model1` FOREIGN KEY (`contract_model_id`) REFERENCES `contract_model` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_project_project_status1` FOREIGN KEY (`project_status_id`) REFERENCES `project_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_site1` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_user1` FOREIGN KEY (`consultant_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_user2` FOREIGN KEY (`contractor_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project_contract_model`
--
ALTER TABLE `project_contract_model`
  ADD CONSTRAINT `fk_project_contract_model_contract_model1` FOREIGN KEY (`contract_model_id`) REFERENCES `contract_model` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_contract_model_project1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_user_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
