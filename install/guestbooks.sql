-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-06-07 17:44:50
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guestbooks`
--
CREATE DATABASE IF NOT EXISTS `guestbooks` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `guestbooks`;

-- --------------------------------------------------------

--
-- 表的结构 `gb_manager`
--

CREATE TABLE `gb_manager` (
  `gb_id` mediumint(8) UNSIGNED NOT NULL COMMENT '用户自动编号',
  `gb_uniqid` char(40) NOT NULL COMMENT '验证登录唯一标识符',
  `gb_active` varchar(40) NOT NULL COMMENT '激活用户注册唯一标识',
  `gb_username` varchar(20) NOT NULL COMMENT '用户名',
  `gb_password` char(40) NOT NULL COMMENT '用户密码',
  `gb_question` varchar(20) NOT NULL COMMENT '密码提问',
  `gb_answer` varchar(40) NOT NULL COMMENT '密码回答',
  `gb_email` varchar(255) DEFAULT NULL COMMENT '邮件',
  `gb_qq` varchar(255) DEFAULT NULL COMMENT 'QQ',
  `gb_url` varchar(255) DEFAULT NULL COMMENT '网址',
  `gb_sex` char(1) NOT NULL COMMENT '性别',
  `gb_face` char(12) NOT NULL COMMENT '用户头像',
  `gb_reg_time` datetime NOT NULL COMMENT '注册时间',
  `gb_last_time` datetime NOT NULL COMMENT '用户最后登录时间',
  `gb_last_id` char(20) NOT NULL COMMENT '最后登录的IP'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `gb_manager`
--

INSERT INTO `gb_manager` (`gb_id`, `gb_uniqid`, `gb_active`, `gb_username`, `gb_password`, `gb_question`, `gb_answer`, `gb_email`, `gb_qq`, `gb_url`, `gb_sex`, `gb_face`, `gb_reg_time`, `gb_last_time`, `gb_last_id`) VALUES
(7, '4ea4ce8ddd54ecbb9d5660a8c81ece72374a7d4f', 'cff5fa535e9287a27f21cf031c14a854b13e0a2e', '小白菜', '601f1889667efaebb33b8c12572835da3f027f78', '我的姓名', '40fa37ec00c761c7dbb6ebdee6d4a260b922f5f4', 'zzw_bei@163.com.cn', '447362429', 'http://baidu.com', '女', 'face/3.png', '2017-06-07 15:12:56', '2017-06-07 15:12:56', '::1'),
(10, 'cc082f400fed30f263e1263b4f968f4e1e01b4ae', '0b5a0042187461db9767d01101d6845586ed4ef5', '大白菜', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我家的狗狗', '4d5cf6a96cf8a438e3ae210bf7b2dac02b6fa1a4', 'zzw_bei@163.com.cn', '1773849171', 'http://baidu.com', '男', 'face/2.png', '2017-06-07 16:42:06', '2017-06-07 16:42:06', '::1'),
(14, '0b7f8af5ee0aa04ae686edcb0e820d2311f0a119', '1284f4075119278658d43b5078317c10c868fd06', '蜡笔小新', '1675f0843189a2dff0771ac8f0264845b0cdae91', '我喜欢的是', '34bb28945fd223b49e67f9b4bf6d2c12cb73f8f9', 'zzw_bei@163.com.cn', '1773849171', 'http://baidu.com', '男', 'face/13.png', '2017-06-07 17:02:10', '2017-06-07 17:02:10', '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gb_manager`
--
ALTER TABLE `gb_manager`
  ADD PRIMARY KEY (`gb_id`,`gb_sex`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `gb_manager`
--
ALTER TABLE `gb_manager`
  MODIFY `gb_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户自动编号', AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
