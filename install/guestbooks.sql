-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-06-28 17:44:00
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
-- 表的结构 `gb_friend`
--

CREATE TABLE `gb_friend` (
  `gb_id` int(11) NOT NULL COMMENT 'id',
  `gb_touser` varchar(20) NOT NULL COMMENT '被添加的好友',
  `gb_fromuser` varchar(20) NOT NULL COMMENT '请求添加的人',
  `gb_content` varchar(200) NOT NULL COMMENT '请求信息',
  `gb_state` char(1) NOT NULL DEFAULT '0' COMMENT '验证状态',
  `gb_date` datetime NOT NULL COMMENT '添加好友日期'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `gb_friend`
--

INSERT INTO `gb_friend` (`gb_id`, `gb_touser`, `gb_fromuser`, `gb_content`, `gb_state`, `gb_date`) VALUES
(1, '香吉士', '路飞', '我们一起去航海吧', '0', '2017-06-28 17:26:26'),
(2, 'zbei', '路飞', '我是你的粉丝', '0', '2017-06-28 17:35:50'),
(3, '宁采臣', '路飞', '交个朋友吧。', '0', '2017-06-28 17:37:54'),
(4, 'zbei', '小倩', '你是我的偶像', '0', '2017-06-28 17:40:34'),
(5, 'zbei', '宁采臣', '来交个朋友吧', '0', '2017-06-28 17:41:33'),
(6, 'zbei', '紫霞', '你长的太帅了', '0', '2017-06-28 17:42:17'),
(7, 'zbei', '贾斯丁比伯', '交个朋友吧。', '0', '2017-06-28 17:42:53');

-- --------------------------------------------------------

--
-- 表的结构 `gb_manager`
--

CREATE TABLE `gb_manager` (
  `gb_id` mediumint(8) UNSIGNED NOT NULL COMMENT '用户自动编号',
  `gb_uniqid` char(40) NOT NULL COMMENT '验证登录唯一标识符',
  `gb_active` varchar(40) DEFAULT NULL COMMENT '激活用户注册唯一标识',
  `gb_username` varchar(20) NOT NULL COMMENT '用户名',
  `gb_password` char(40) NOT NULL COMMENT '用户密码',
  `gb_question` varchar(20) NOT NULL COMMENT '密码提问',
  `gb_answer` varchar(40) NOT NULL COMMENT '密码回答',
  `gb_email` varchar(255) DEFAULT NULL COMMENT '邮件',
  `gb_qq` varchar(255) DEFAULT NULL COMMENT 'QQ',
  `gb_url` varchar(255) DEFAULT NULL COMMENT '网址',
  `gb_sex` char(1) NOT NULL COMMENT '性别',
  `gb_face` char(12) NOT NULL COMMENT '用户头像',
  `gb_level` tinyint(1) NOT NULL DEFAULT '0' COMMENT '身份登记',
  `gb_reg_time` datetime NOT NULL COMMENT '注册时间',
  `gb_last_time` datetime NOT NULL COMMENT '用户最后登录时间',
  `gb_last_ip` char(20) NOT NULL COMMENT '最后登录的IP',
  `gb_login_count` smallint(4) NOT NULL DEFAULT '0' COMMENT '统计登录了几次'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `gb_manager`
--

INSERT INTO `gb_manager` (`gb_id`, `gb_uniqid`, `gb_active`, `gb_username`, `gb_password`, `gb_question`, `gb_answer`, `gb_email`, `gb_qq`, `gb_url`, `gb_sex`, `gb_face`, `gb_level`, `gb_reg_time`, `gb_last_time`, `gb_last_ip`, `gb_login_count`) VALUES
(7, '4ea4ce8ddd54ecbb9d5660a8c81ece72374a7d4f', 'cff5fa535e9287a27f21cf031c14a854b13e0a2e', '小白菜', '601f1889667efaebb33b8c12572835da3f027f78', '我的姓名', '40fa37ec00c761c7dbb6ebdee6d4a260b922f5f4', 'zzw_bei@163.com.cn', '447362429', 'http://baidu.com', '女', 'face/3.png', 0, '2017-06-07 15:12:56', '2017-06-07 15:12:56', '::1', 1),
(22, '7c91d083a4d72800686253be05757e11eb90c030', 'b8f90d80cccd255b52d47336892f9919cd6d57f0', '白兔', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的颜色', '2d80ae1cf92167425c756ae25dfb91b8305986d5', 'zzw_bei@163.com.cn', '1773849171', 'http://baidu.com', '女', 'face/13.png', 0, '2017-06-08 10:32:01', '2017-06-08 10:32:01', '::1', 1),
(55, '9a4bef2e01f1c33cd0dc494c7cf8dedc676b3fa4', NULL, '小新', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的爱犬', '9d50247338945ca2714b675a7149507790457ab6', 'xiaoxin@qq.com', '', '', '男', 'face/7.png', 0, '2017-06-14 16:54:33', '2017-06-27 09:32:16', '::1', 4),
(56, '7f26fb2caf6aaf251979c9c9560c58198b232ec4', NULL, '小红', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的名字', '60e4c9204129665c6085af440182d17fc7a1ae45', 'xiaohong@163.com', '', '', '女', 'face/8.png', 0, '2017-06-14 16:55:37', '2017-06-14 16:55:37', '::1', 1),
(57, '2d3efa29b8405107a9ad937786d23661f66632bb', NULL, '小李', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的名字', '982a97714608d757b3da6453267a986b4ab5952d', 'xiaoli@163.com', '', '', '男', 'face/6.png', 0, '2017-06-14 16:56:54', '2017-06-27 09:40:42', '::1', 2),
(58, '104f3026c54fac3c641e962e36221d0f856b4645', NULL, '鸣人', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的绝招', 'b2b228ad4270bab416cb58bd75036c8029f98fec', 'mingren@gmail.com', '85236987', 'http://mingren.com', '男', 'face/15.png', 0, '2017-06-14 16:58:04', '2017-06-27 09:32:53', '::1', 2),
(54, 'afe9097987ae01e9327d6d59ad2372ef76e26d7e', NULL, '小樱', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我喜欢谁', '6e2d6afc6595c661d7dc784a280265c06c06b90f', 'xiaoying@gmail.com', '96325874', 'http://xiaoying.com', '女', 'face/8.png', 0, '2017-06-14 15:28:31', '2017-06-14 15:28:31', '::1', 1),
(53, 'be30d677997f1a7acfa5a52e7595279bc3d78fed', NULL, '孙悟饭', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的名字是', '2b127279fb0157c83ecf0be0fe46e220242cef52', 'sunwufan@qq.com', '1235645', 'http://sunwufan.com.cn', '男', 'face/15.png', 0, '2017-06-14 15:26:03', '2017-06-14 15:26:03', '::1', 1),
(51, '95f1d0de39c33f4f26bb1ef67a0d68dbbc38752f', NULL, '张三', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的小弟', 'b7b286678338a2092572733e23236485d166c0df', 'xiaobaicai@163.com', '', '', '男', 'face/1.png', 0, '2017-06-12 22:10:38', '2017-06-12 22:10:38', '::1', 1),
(52, '7975162a7bb1d0aac8354fb0235503078788d3ed', NULL, '孙悟空', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的师傅', '69d727dbc94516078f3dcdf391344816c63624fe', 'sunwukong@163.com', '', '', '男', 'face/2.png', 0, '2017-06-14 15:10:40', '2017-06-14 15:10:40', '::1', 1),
(36, '7242c61cfcacecbfe4b129e9dd4dd8e89accdd03', NULL, '张飞', '2ea6201a068c5fa0eea5d81a3863321a87f8d533', '我的姓名', '29d2c1938dabf8bd73d0f6f1bfa2a666e14f6053', 'zhangfei@163.com', '', '', '男', 'face/1.png', 0, '2017-06-09 10:39:40', '2017-06-09 10:39:40', '::1', 1),
(65, 'b8eedf108f75e827ac8c21fbee8b7e00bd7bedee', NULL, '宁采臣', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我喜欢谁', 'bb537d6237db7322745eac4cb5460a73b651ac30', 'ningcaicheng@163.com', '741253925', 'http://ningcaicheng.com', '男', 'face/15.png', 0, '2017-06-14 17:14:04', '2017-06-28 17:40:49', '::1', 3),
(64, 'a5e2ecf7e544a6cc672e5c4752a1c2a24c175f8b', NULL, '小倩', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我喜欢谁', '4b6f096d39c3e428cc65469f6a797055ecdede71', 'xiaoqian@qq.com', '741258769', 'http://xiaoqian.com.cn', '女', 'face/8.png', 0, '2017-06-14 17:12:01', '2017-06-28 17:39:28', '::1', 3),
(63, '15165d196fb215667c205056fc71e2f2b6c39df7', NULL, '老毛桃', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的擅长', '71f0e59792ad8b9a38a513eb57ce313e77ab5428', 'laomaotao@163.com', '', '', '男', 'face/5.png', 0, '2017-06-14 17:10:52', '2017-06-14 17:10:52', '::1', 1),
(62, 'bdfa59c22fdd5afd0e0c533b3b1f9f18cafea640', NULL, '贾斯丁比伯', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是什么职业', '3c0adc266c6fa7c0909a4e4b4f3f9574298368eb', 'jiasidingbibo@163.com', '', '', '男', 'face/3.png', 0, '2017-06-14 17:03:19', '2017-06-28 17:42:39', '::1', 2),
(60, 'b4e1fd02efbac7c3233989d9fee4bd95ff99d9bb', NULL, '龟仙人', '7c4a8d09ca3762af61e59520943dc26494f8941b', '爱好是什么', 'd6076b48a36669c3579dd18fe9677fbc84f7d9ca', 'guixianren@163.com', '', '', '男', 'face/14.png', 0, '2017-06-14 17:00:02', '2017-06-27 09:35:48', '::1', 2),
(61, '748f926072a79bdd58ae5d407ef50ab52d1d335c', NULL, '紫霞', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我喜欢谁', '38cb71aa7661b9731813c568a20a5308bc9250b3', 'zixiaxianzi@163.com', '852369874', '', '女', 'face/10.png', 0, '2017-06-14 17:00:52', '2017-06-28 17:41:47', '::1', 3),
(59, '8b5f51118c2c77401346750dcb4284a79b56d484', NULL, '佐助', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的爱人', 'afce719e63aaf4f6d18b207a01d834f2a23ac158', 'zuozhu@gmail.com', '74123698', 'http://zuozhu.com.cn', '男', 'face/5.png', 0, '2017-06-14 16:59:07', '2017-06-27 09:38:09', '::1', 2),
(49, '6d1baa16a35ffd93cbfc31e657f7c805bec5dec0', NULL, 'My.wei', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我最喜欢谁', '90a04d325d5d4bf70ccf1479ad26a66ec223f155', 'zzw_bei@163.com.cn', '447362429', 'http://www.zhiwei.com', '男', 'face/15.png', 0, '2017-06-11 22:40:04', '2017-06-11 22:40:04', '::1', 1),
(47, 'c764e92788825f5c63a26201ac4872e050d58678', NULL, '王绍华', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我喜欢谁', '60b2915ff911335be10e2f8a663df670a54cdea4', 'wangshaohua@qq.com', '123456', 'http://wangshaohua.com.cn', '男', 'face/13.png', 0, '2017-06-11 22:34:27', '2017-06-11 22:34:27', '::1', 1),
(66, '855eb74e14fe106cab5b6da8d263e3f8fddcccd4', NULL, '路飞', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是谁', 'c94c1122e8f0d5fd76158fd29b4f959df4f9f033', 'lufei@163.com', '123456789', 'http://www.lufei.com', '男', 'face/1.png', 0, '2017-06-15 09:40:35', '2017-06-28 17:04:07', '::1', 16),
(67, '4dd9c49bb2c0f77ba50337c81a44f03f4705f5a6', NULL, '索隆', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是谁', '50a39626db5df513fd42612f4685459cca955b1a', 'suolong@163.com', '74128963', 'https://www.suolong.com', '男', 'face/5.png', 0, '2017-06-15 09:42:50', '2017-06-15 09:42:50', '::1', 1),
(68, 'cf4a2ef77ec6c3a966959143b9b5904148f91256', NULL, '香吉士', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我是谁', '691ed492e11d55b2396fe75658c4d92f8f7bb18d', 'xiangjishi@163.com', '78963225', 'http://www.xiangjishi.com.cn', '男', 'face/13.png', 0, '2017-06-15 09:43:52', '2017-06-27 09:31:40', '::1', 2),
(69, 'eb31183c6aa1585f5478a24a768419c0e31c957d', NULL, 'zbei', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我喜欢谁', '90a04d325d5d4bf70ccf1479ad26a66ec223f155', 'zzw_bei@163.com', '447362429', 'http://www.zbei.com', '男', 'face/3.png', 1, '2017-06-16 15:52:08', '2017-06-28 16:56:33', '::1', 27);

-- --------------------------------------------------------

--
-- 表的结构 `gb_message`
--

CREATE TABLE `gb_message` (
  `gb_id` mediumint(8) UNSIGNED NOT NULL COMMENT 'id',
  `gb_touser` varchar(20) NOT NULL COMMENT '收件人',
  `gb_fromuser` varchar(20) NOT NULL COMMENT '发件人',
  `gb_content` varchar(200) NOT NULL COMMENT '短信内容',
  `gb_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `gb_date` datetime NOT NULL COMMENT '发送时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `gb_message`
--

INSERT INTO `gb_message` (`gb_id`, `gb_touser`, `gb_fromuser`, `gb_content`, `gb_state`, `gb_date`) VALUES
(1, '路飞', 'zbei', '我想和你一起去航海旅行', 1, '2017-06-26 16:33:39'),
(2, '小倩', 'zbei', '宁采臣在哪里', 0, '2017-06-26 16:34:49'),
(3, '龟仙人', 'zbei', '我要和你学习龟派气功波', 0, '2017-06-26 16:35:34'),
(4, '香吉士', '路飞', '那里有美女', 0, '2017-06-26 16:37:00'),
(5, '贾斯丁比伯', '路飞', '你唱的歌真好听', 0, '2017-06-26 16:38:57'),
(6, '张三', 'zbei', '张三兄弟，你好呀', 0, '2017-06-26 17:01:02'),
(7, 'zbei', '路飞', '生活是一面镜子。你对它笑，它就对你笑；你对它哭，它也对你哭。', 0, '2017-06-27 09:31:19'),
(8, 'zbei', '香吉士', '人生是个圆，有的人走了一辈子也没有走出命运画出的圆圈，其实，圆上的每一个点都有一条腾飞的切线。', 0, '2017-06-27 09:31:56'),
(9, 'zbei', '小新', '我们心中的恐惧，永远比真正的危险巨大的多。', 1, '2017-06-27 09:32:23'),
(10, 'zbei', '鸣人', '命运掌握在自己手中。要么你驾驭生命，要么生命驾驭你，你的心态决定你是坐骑还是骑手。', 0, '2017-06-27 09:33:08'),
(11, 'zbei', '宁采臣', '不要拿小人的错误来惩罚自己，不要在这些微不足道的事情上折磨浪费自己的宝贵时间。', 0, '2017-06-27 09:34:12'),
(12, 'zbei', '小倩', '在实现理想的路途中，必须排除一切干扰，特别是要看清那些美丽的诱惑。', 0, '2017-06-27 09:34:40'),
(13, 'zbei', '紫霞', '人一生下就会哭，笑是后来才学会的。所以忧伤是一种低级的本能，而快乐是一种更高级的能力。', 0, '2017-06-27 09:35:14'),
(14, 'zbei', '龟仙人', '两个人共尝一个痛苦只有半个痛苦，两个人共享一个欢乐却有两个欢乐。', 0, '2017-06-27 09:35:55'),
(15, 'zbei', '龟仙人', '放弃该放弃的是无奈，放弃不该放弃的是无能，不放弃该放弃的是无知，不放弃不该放弃的是执著！', 1, '2017-06-27 09:36:06'),
(16, 'zbei', '路飞', '你把周围的人看作魔鬼，你就生活在地狱；你把周围的人看作天使，你就生活在天堂。', 1, '2017-06-27 09:36:38'),
(17, 'zbei', '路飞', '如果你不给自己烦恼，别人也永远不可能给你烦恼，烦恼都是自己内心制造的。', 1, '2017-06-27 09:36:50'),
(18, 'zbei', '路飞', '一杯清水因滴入一滴污水而变污浊，一杯污水却不会因一滴清水的存在而变清澈。', 1, '2017-06-27 09:37:01'),
(19, 'zbei', '佐助', '得之坦然，失之淡然，顺其自然，争其必然。', 1, '2017-06-27 09:38:21'),
(20, 'zbei', '佐助', '天道酬勤。也许你付出了不一定得到回报，但不付出一定得不到回报。', 1, '2017-06-27 09:38:31'),
(21, 'zbei', '佐助', '逆境是成长必经的过程，能勇于接受逆境的人，生命就会日渐的茁壮。', 1, '2017-06-27 09:38:41'),
(27, 'zbei', '小李', '大部分人往往对已经失去的机遇捶胸顿足，却对眼前的机遇熟视无睹。', 1, '2017-06-27 09:40:49'),
(28, 'zbei', '小李', '困难是一块顽石，对于弱者它是绊脚石，对于强者它是垫脚石。', 1, '2017-06-27 09:41:03'),
(30, 'zbei', 'zbei', 'wwwwww\r\n\r\n', 0, '2017-06-28 16:54:44'),
(31, '宁采臣', 'zbei', '你好，我是zbei', 0, '2017-06-28 16:55:15'),
(32, '老毛桃', 'zbei', '你做的启动盘，很厉害', 0, '2017-06-28 16:55:41'),
(33, '佐助', 'zbei', '小樱，她在哪里？？？', 0, '2017-06-28 16:57:13'),
(34, '鸣人', 'zbei', '我要和你学习螺旋丸', 0, '2017-06-28 17:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gb_friend`
--
ALTER TABLE `gb_friend`
  ADD PRIMARY KEY (`gb_id`);

--
-- Indexes for table `gb_manager`
--
ALTER TABLE `gb_manager`
  ADD PRIMARY KEY (`gb_id`,`gb_sex`);

--
-- Indexes for table `gb_message`
--
ALTER TABLE `gb_message`
  ADD PRIMARY KEY (`gb_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `gb_friend`
--
ALTER TABLE `gb_friend`
  MODIFY `gb_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `gb_manager`
--
ALTER TABLE `gb_manager`
  MODIFY `gb_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户自动编号', AUTO_INCREMENT=70;
--
-- 使用表AUTO_INCREMENT `gb_message`
--
ALTER TABLE `gb_message`
  MODIFY `gb_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
