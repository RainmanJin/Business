-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2014-11-05 10:33:05
-- 服务器版本： 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `unity`
--

-- --------------------------------------------------------

--
-- 表的结构 `un_users`
--

CREATE TABLE IF NOT EXISTS `un_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `realname` varchar(50) NOT NULL,
  `signtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `un_users`
--

INSERT INTO `un_users` (`id`, `username`, `password`, `email`, `nickname`, `realname`, `signtime`) VALUES
(1, 'admin', '21585c6859d78f6313421b0defd6e29b', '267109925@qq.com', '米克·艾格', '李沛新', '2014-11-01 00:00:00'),
(2, 'mingren', '5d0a01776f9b42dee2edcf71fec6a047', 'mingren@huoying.com', '鸣人', '', '2014-11-05 09:57:23'),
(3, 'yihu', '5d0a01776f9b42dee2edcf71fec6a047', 'yihu@sishen.com', '一护', '', '2014-11-05 16:52:53');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
