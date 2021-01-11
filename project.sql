-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-01-11 15:11:56
-- 服务器版本： 5.6.49-log
-- PHP 版本： 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
--
-- 数据库： `project`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_log`
--

CREATE TABLE `admin_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `m` varchar(15) NOT NULL,
  `c` varchar(20) NOT NULL,
  `a` varchar(20) NOT NULL,
  `querystring` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `ip` int(10) NOT NULL,
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin_log`
--

INSERT INTO `admin_log` (`id`, `m`, `c`, `a`, `querystring`, `username`, `ip`, `time`) VALUES
(1, 'admin', 'Main', 'index', '', 'worker', 1931204597, 1609917149),
(2, 'admin', 'Main', 'index', '', 'worker', 1931204597, 1609917189),
(3, 'admin', 'Admin', 'goodmanage', '', 'worker', 1931204597, 1609917192),
(4, 'admin', 'Admin', 'goodchange', '?goodid=1', 'worker', 1931204597, 1609917258),
(5, 'admin', 'Admin', 'goodchanging', '?goodid=1&name=&price=&volumn=101&maxbuy=', 'worker', 1931204597, 1609917262),
(6, 'admin', 'Admin', 'goodmanage', '', 'worker', 1931204597, 1609917264),
(7, 'admin', 'Admin', 'goodmanage', '', 'worker', 1931204597, 1609917417),
(8, 'admin', 'Main', 'index', '', 'worker', 1931204597, 1609917722),
(9, 'admin', 'Main', 'index', '', 'admin', 1931204597, 1609917732),
(10, 'admin', 'Admin', 'ordermanage', '', 'admin', 1931204597, 1609917749),
(11, 'admin', 'Admin', 'goodmanage', '', 'admin', 1931204597, 1609917755),
(12, 'admin', 'Admin', 'usermanage', '', 'admin', 1931204597, 1609917762),
(13, 'admin', 'Main', 'index', '', 'admin', 1931204597, 1610161311),
(14, 'admin', 'Main', 'index', '', 'admin', 1931204597, 1610161320),
(15, 'admin', 'Main', 'index', '', 'admin', 1931204597, 1610161320),
(16, 'admin', 'Main', 'index', '', 'admin', 1931204597, 1610161323),
(17, 'admin', 'Admin', 'usermanage', '', 'admin', 1931204597, 1610161326),
(18, 'admin', 'Admin', 'goodmanage', '', 'admin', 1931204597, 1610161327),
(19, 'admin', 'Admin', 'ordermanage', '', 'admin', 1931204597, 1610161328),
(20, 'admin', 'Admin', 'usermanage', '', 'admin', 1931204597, 1610161329),
(21, 'admin', 'Admin', 'goodmanage', '', 'admin', 1931204597, 1610161330),
(22, 'admin', 'Main', 'index', '', 'admin', 1931204597, 1610178424),
(23, 'admin', 'Main', 'index', '', 'admin', 1931204597, 1610178444),
(24, 'admin', 'Main', 'index', '', 'admin', 1931204597, 1610178956),
(25, 'admin', 'Main', 'index', '', 'admin', 1931204597, 1610179522),
(26, 'admin', 'Main', 'index', '', 'admin', 1931204597, 1610179617),
(27, 'admin', 'Admin', 'managermanage', '', 'admin', 1931204597, 1610179618),
(28, 'admin', 'Admin', 'managerchange', '?changemanager=student1&changerole=1', 'admin', 1931204597, 1610179638),
(29, 'admin', 'Main', 'index', '', 'admin', 1931204597, 1610179639),
(30, 'admin', 'Admin', 'managermanage', '', 'admin', 1931204597, 1610179640),
(31, 'admin', 'Admin', 'managerchange', '?changemanager=student1&changerole=2', 'admin', 1931204597, 1610179644),
(32, 'admin', 'Main', 'index', '', 'admin', 1931204597, 1610179645),
(33, 'admin', 'Admin', 'managermanage', '', 'admin', 1931204597, 1610179646),
(34, 'admin', 'Admin', 'managerchange', '?changemanager=admin&changerole=1', 'admin', 1931204597, 1610179654),
(35, 'admin', 'Main', 'index', '', 'admin', 1931204597, 1610179655),
(36, 'admin', 'Main', 'index', '', 'admin', 1931204597, 1610179664),
(37, 'admin', 'Main', 'index', '', 'admin', 1931204597, 1610179686),
(38, 'admin', 'Admin', 'managermanage', '', 'admin', 1931204597, 1610179687),
(39, 'admin', 'Admin', 'ordermanage', '', 'admin', 1931204597, 1610179687),
(40, 'admin', 'Admin', 'ordermanage', '', 'admin', 1931204597, 1610180081),
(41, 'admin', 'Admin', 'usermanage', '', 'admin', 1931204597, 1610180091),
(42, 'admin', 'Admin', 'userdel', '?deluser=666', 'admin', 1931204597, 1610180097),
(43, 'admin', 'Admin', 'usermanage', '', 'admin', 1931204597, 1610180098),
(44, 'admin', 'Admin', 'userdel', '?deluser=4396', 'admin', 1931204597, 1610180101),
(45, 'admin', 'Admin', 'usermanage', '', 'admin', 1931204597, 1610180102),
(46, 'admin', 'Admin', 'usermanage', '', 'admin', 1931204597, 1610180215),
(47, 'admin', 'Admin', 'usermanage', '', 'admin', 1931204597, 1610180216),
(48, 'admin', 'Admin', 'log', '', 'admin', 1931204597, 1610180217),
(49, 'admin', 'Admin', 'log', '', 'admin', 1931204597, 1610180239),
(50, 'admin', 'Admin', 'goodmanage', '', 'admin', 1931204597, 1610180258),
(51, 'admin', 'Admin', 'managermanage', '', 'admin', 1931204597, 1610180681),
(52, 'admin', 'Admin', 'ordermanage', '', 'admin', 1931204597, 1610181834),
(53, 'admin', 'Admin', 'usermanage', '', 'admin', 1931204597, 1610181873),
(54, 'admin', 'Admin', 'goodmanage', '', 'admin', 1931204597, 1610181881),
(55, 'admin', 'Admin', 'managermanage', '', 'admin', 1931204597, 1610181882),
(56, 'admin', 'Admin', 'ordermanage', '', 'admin', 1931204597, 1610183017),
(57, 'admin', 'Admin', 'goodmanage', '', 'admin', 1931204597, 1610183504),
(58, 'admin', 'Admin', 'goodmanage', '', 'admin', 1931204597, 1610183504),
(59, 'admin', 'Admin', 'goodchange', '?goodid=1', 'admin', 1931204597, 1610183590),
(60, 'admin', 'Admin', 'changepassword', '', 'admin', 1931204597, 1610183840),
(61, 'admin', 'Admin', 'log', '', 'admin', 1931204597, 1610183906),
(62, 'admin', 'Main', 'index', '', 'admin', 1931204597, 1610347980),
(63, 'admin', 'Admin', 'ordermanage', '', 'admin', 1931204597, 1610347981),
(64, 'admin', 'Admin', 'goodmanage', '', 'admin', 1931204597, 1610347981),
(65, 'admin', 'Admin', 'goodchange', '?goodid=1', 'admin', 1931204597, 1610347982),
(66, 'admin', 'Admin', 'goodchanging', '?goodid=1&name=&price=&volumn=50&maxbuy=', 'admin', 1931204597, 1610347985),
(67, 'admin', 'Admin', 'goodmanage', '', 'admin', 1931204597, 1610347986);

-- --------------------------------------------------------

--
-- 表的结构 `admin_nodes`
--

CREATE TABLE `admin_nodes` (
  `nodeid` int(20) NOT NULL,
  `nodename` varchar(20) NOT NULL,
  `nodeurl` varchar(50) NOT NULL,
  `noderole` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `admin_nodes`
--

INSERT INTO `admin_nodes` (`nodeid`, `nodename`, `nodeurl`, `noderole`) VALUES
(1, '用户管理', '../admin/usermanage', 1),
(2, '后台用户管理', '../admin/managermanage', 1),
(3, '订单管理', '../admin/ordermanage', 1),
(4, '商品管理', '../admin/goodmanage', 2),
(5, '修改密码', '../admin/changepassword', 3),
(6, '查看日志', '../admin/log.html', 1),
(7, '主页', '../main/index', 4);

-- --------------------------------------------------------

--
-- 表的结构 `admin_user`
--

CREATE TABLE `admin_user` (
  `userid` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `admin_user`
--

INSERT INTO `admin_user` (`userid`, `username`, `password`, `role`) VALUES
(1, 'admin', 'a09abd42f0d7f99284a47eaaafa907fa', 0),
(2, 'worker', 'a09abd42f0d7f99284a47eaaafa907fa', 1),
(3, 'user', 'a09abd42f0d7f99284a47eaaafa907fa', 2);

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

CREATE TABLE `goods` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(20) NOT NULL,
  `volumn` int(20) NOT NULL,
  `maxbuy` int(20) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `goods`
--

INSERT INTO `goods` (`id`, `name`, `price`, `volumn`, `maxbuy`) VALUES
(1, 'RTX3090', 6299, 48, 2);

-- --------------------------------------------------------

--
-- 表的结构 `md5psw`
--

CREATE TABLE `md5psw` (
  `userid` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `md5psw`
--

INSERT INTO `md5psw` (`userid`, `username`, `password`) VALUES
(1, 'mhy', 'a406e852b25e9e29c244eb5958bf3f10'),
(2, 'user1', '24c9e15e52afc47c225b757e7bee1f9d'),
(3, 'gcj', 'afbdb6b350739a9fbe68f957a6f1ce1f'),
(5, 'user4', 'a09abd42f0d7f99284a47eaaafa907fa'),
(6, 'zhouwei', '8b3c92d7b3ce856639048d99af7ddfee');

-- --------------------------------------------------------

--
-- 表的结构 `ordering`
--

CREATE TABLE `ordering` (
  `orderid` int(11) NOT NULL,
  `userid` int(20) NOT NULL,
  `goodid` int(20) NOT NULL,
  `buynum` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ordering`
--

INSERT INTO `ordering` (`orderid`, `userid`, `goodid`, `buynum`) VALUES
(3, 1, 1, 2),
(47, 1, 1, 1),
(48, 1, 1, 2),
(49, 1, 1, 1),
(50, 1, 1, 1),
(51, 2, 1, 2),
(52, 2, 1, 1),
(53, 2, 1, 2),
(54, 5, 1, 2);

--
-- 转储表的索引
--

--
-- 表的索引 `admin_log`
--
ALTER TABLE `admin_log`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `admin_nodes`
--
ALTER TABLE `admin_nodes`
  ADD UNIQUE KEY `nodeid` (`nodeid`);

--
-- 表的索引 `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`userid`);

--
-- 表的索引 `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `md5psw`
--
ALTER TABLE `md5psw`
  ADD PRIMARY KEY (`userid`);

--
-- 表的索引 `ordering`
--
ALTER TABLE `ordering`
  ADD PRIMARY KEY (`orderid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin_log`
--
ALTER TABLE `admin_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- 使用表AUTO_INCREMENT `ordering`
--
ALTER TABLE `ordering`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
