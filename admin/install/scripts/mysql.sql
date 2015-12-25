-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-12-25 22:06:58
-- 服务器版本： 5.5.28
-- PHP Version: 5.4.35

--
-- Database: `here`
--

-- --------------------------------------------------------

--
-- 表的结构 `h_users`
--

CREATE TABLE IF NOT EXISTS `h_users` (
  `uid` smallint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `url` varchar(64) NOT NULL,
  `status` smallint(8) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `name` (`name`,`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 插入之前先把表清空（truncate） `h_users`
--

TRUNCATE TABLE `h_users`;