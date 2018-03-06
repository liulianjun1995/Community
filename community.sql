/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : community

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-03-06 18:46:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admins`
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', 'Dale Hirthe', '$2y$10$7dTFTcyiZHvt6VMw.AkuNuhAbSrYpxBjLUL4X.hN8ikrTKBYZVeIa', '2018-02-25 10:57:23', '2018-02-25 10:57:23');
INSERT INTO `admins` VALUES ('2', 'Dr. Tremaine Boehm', '$2y$10$7dTFTcyiZHvt6VMw.AkuNuhAbSrYpxBjLUL4X.hN8ikrTKBYZVeIa', '2018-02-25 10:57:23', '2018-02-25 10:57:23');
INSERT INTO `admins` VALUES ('3', 'Tony Jakubowski', '$2y$10$7dTFTcyiZHvt6VMw.AkuNuhAbSrYpxBjLUL4X.hN8ikrTKBYZVeIa', '2018-02-25 10:57:23', '2018-02-25 10:57:23');

-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '版块名称',
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `describe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '版块描述',
  `style` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip_style` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '状态:启用|未启用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', '灌水', '/assets/images/guanshui.png', '这里是聊天灌水的地方，不必拘于什么，但是心里要有数', 'color:#30668c;font-size: 15px', 'color: #fff;background: #30668c', '1');
INSERT INTO `categories` VALUES ('2', '问答', '/assets/images/wenda.jpg', '这里可以提问，大家一起来解决问题', 'color:orangered;font-size: 15px', 'color: #fff;background: #d21e12', '1');
INSERT INTO `categories` VALUES ('3', '技术', '/assets/images/jishu.png', '这里可以交流技术上方面的知识', 'color:#01AAED;font-size: 15px', 'color: #fff;background:#01AAED', '1');
INSERT INTO `categories` VALUES ('4', '公告', '/assets/images/gonggao.png', '管理大大的一些通知', 'color:mediumspringgreen;font-size: 15px', 'color: #fff;background:#2bd047', '1');

-- ----------------------------
-- Table structure for `comments`
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` tinyint(4) NOT NULL COMMENT '评论人',
  `post_id` tinyint(4) NOT NULL COMMENT '评论的文章',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '评论的内容',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('1', '1', '6', '<p>这是一条评论</p>', '2018-03-01 20:20:23', '2018-03-01 20:20:23');
INSERT INTO `comments` VALUES ('2', '1', '6', '<p>这是测试的评论<img src=\"http://twemoji.maxcdn.com/36x36/1f1ec-1f1e7.png\" title=\"twemoji-1f1ec-1f1e7\" alt=\"twemoji-1f1ec-1f1e7\" class=\"emoji twemoji\" /></p>', '2018-03-05 20:44:13', '2018-03-05 20:44:13');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2018_02_25_103822_create_admins_table', '1');
INSERT INTO `migrations` VALUES ('2', '2018_02_26_063045_create_users_table', '2');
INSERT INTO `migrations` VALUES ('3', '2018_02_28_192027_create_posts_table', '3');
INSERT INTO `migrations` VALUES ('4', '2018_02_28_194703_create_posts_table', '4');
INSERT INTO `migrations` VALUES ('5', '2018_02_28_202631_create_categories_table', '5');
INSERT INTO `migrations` VALUES ('6', '2018_03_01_190829_create_comments_table', '6');

-- ----------------------------
-- Table structure for `posts`
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` tinyint(4) NOT NULL COMMENT '帖子所属人',
  `category_id` tinyint(4) NOT NULL COMMENT '帖子所属板块',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '帖子标题',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '帖子内容',
  `is_top` tinyint(4) NOT NULL DEFAULT '0',
  `is_closed` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否结贴',
  `is_sticky` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否加精',
  `renqi` tinyint(4) NOT NULL DEFAULT '0' COMMENT '帖子人气',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '帖子状态',
  `reward` tinyint(4) NOT NULL COMMENT '悬赏',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('1', '1', '1', '这是测试贴', '这是测试贴的内容', '1', '0', '0', '9', '0', '20', '2018-02-28 19:50:34', '2018-03-05 21:57:31');
INSERT INTO `posts` VALUES ('2', '1', '2', '这是测试贴', '这是测试贴的内容', '1', '0', '0', '0', '0', '20', '2018-02-28 19:50:34', '2018-02-28 19:50:34');
INSERT INTO `posts` VALUES ('3', '1', '1', '这是测试贴', '这是测试贴的内容', '0', '0', '0', '0', '0', '20', '2018-02-28 19:50:34', '2018-02-28 19:50:34');
INSERT INTO `posts` VALUES ('4', '1', '1', '这是测试贴', '这是测试贴的内容', '0', '0', '0', '0', '0', '20', '2018-02-28 19:50:34', '2018-02-28 19:50:34');
INSERT INTO `posts` VALUES ('5', '1', '1', '这是测试贴', '这是测试贴的内容', '0', '0', '0', '0', '0', '20', '2018-02-28 19:50:34', '2018-02-28 19:50:34');
INSERT INTO `posts` VALUES ('6', '1', '1', '这是我的第一个测试贴', '<p><img src=\"http://twemoji.maxcdn.com/36x36/1f1eb-1f1f7.png\" title=\"twemoji-1f1eb-1f1f7\" alt=\"twemoji-1f1eb-1f1f7\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f1ec-1f1e7.png\" title=\"twemoji-1f1ec-1f1e7\" alt=\"twemoji-1f1ec-1f1e7\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f202.png\" title=\"twemoji-1f202\" alt=\"twemoji-1f202\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f1ef-1f1f5.png\" title=\"twemoji-1f1ef-1f1f5\" alt=\"twemoji-1f1ef-1f1f5\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f303.png\" title=\"twemoji-1f303\" alt=\"twemoji-1f303\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f488.png\" title=\"twemoji-1f488\" alt=\"twemoji-1f488\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f49e.png\" title=\"twemoji-1f49e\" alt=\"twemoji-1f49e\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f4a1.png\" title=\"twemoji-1f4a1\" alt=\"twemoji-1f4a1\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f48f.png\" title=\"twemoji-1f48f\" alt=\"twemoji-1f48f\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f453.png\" title=\"twemoji-1f453\" alt=\"twemoji-1f453\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f43a.png\" title=\"twemoji-1f43a\" alt=\"twemoji-1f43a\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f461.png\" title=\"twemoji-1f461\" alt=\"twemoji-1f461\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f477.png\" title=\"twemoji-1f477\" alt=\"twemoji-1f477\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f439.png\" title=\"twemoji-1f439\" alt=\"twemoji-1f439\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f479.png\" title=\"twemoji-1f479\" alt=\"twemoji-1f479\" class=\"emoji twemoji\" /><br>这是我的第一个测试贴</p>', '0', '0', '0', '3', '0', '20', '2018-03-01 17:56:44', '2018-03-05 21:59:18');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '城市',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '/assets/images/default_avatar.png' COMMENT '头像',
  `sex` enum('男','女') COLLATE utf8mb4_unicode_ci DEFAULT '男',
  `sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '个人签名',
  `is_signed` char(255) COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '是否已签到',
  `last_sing_time` time DEFAULT NULL COMMENT '上次签到时间',
  `sing_time` time DEFAULT NULL COMMENT '签到时间',
  `sing_day` tinyint(4) DEFAULT '0' COMMENT '累计签到天数',
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '管理员', '$2y$10$Z0uEqZqw2.lVzPLBvLBztugvvNel.lgs.6Cs5vv6iX2fVkEL7pNdW', '750214261@qq.com', '东莞', '/upload/20180226/20180226130910.jpg', '男', '没事别找我谢谢合作！', '0', null, null, '0', 'X8813htR8Pm8tZ50E1wOdn1UR92VK6jCpL4ze7n2Ur5kTDSod6IZSkYdnU0k', '2018-02-26 07:18:40', '2018-03-03 21:41:36');
INSERT INTO `users` VALUES ('2', 'Prof. Donnie Thompson', '$2y$10$Z0uEqZqw2.lVzPLBvLBztugvvNel.lgs.6Cs5vv6iX2fVkEL7pNdW', 'jennings.franecki@example.com', null, null, '男', null, '0', null, null, '0', '', '2018-02-26 07:18:40', '2018-02-26 07:18:40');
INSERT INTO `users` VALUES ('3', 'Serena Reichel', '$2y$10$Z0uEqZqw2.lVzPLBvLBztugvvNel.lgs.6Cs5vv6iX2fVkEL7pNdW', 'trantow.esther@example.com', null, null, '男', null, '0', null, null, '0', '', '2018-02-26 07:18:40', '2018-02-26 07:18:40');
INSERT INTO `users` VALUES ('5', '榴莲君', '$2y$10$esXqTMVqzDpu41lDE1aLCO7n8dR6q6vIbjZW4OUPcnNFxDrhCOwZu', '123456789@qq.com', null, '/assets/images/default_avatar.png', '男', '', '0', null, null, '0', null, '2018-03-01 13:50:25', '2018-03-01 13:50:25');
