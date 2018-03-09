-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-03-09 12:03:25
-- 服务器版本： 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `community`
--

-- --------------------------------------------------------

--
-- 表的结构 `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Dale Hirthe', '$2y$10$7dTFTcyiZHvt6VMw.AkuNuhAbSrYpxBjLUL4X.hN8ikrTKBYZVeIa', '2018-02-25 02:57:23', '2018-02-25 02:57:23'),
(2, 'Dr. Tremaine Boehm', '$2y$10$7dTFTcyiZHvt6VMw.AkuNuhAbSrYpxBjLUL4X.hN8ikrTKBYZVeIa', '2018-02-25 02:57:23', '2018-02-25 02:57:23'),
(3, 'Tony Jakubowski', '$2y$10$7dTFTcyiZHvt6VMw.AkuNuhAbSrYpxBjLUL4X.hN8ikrTKBYZVeIa', '2018-02-25 02:57:23', '2018-02-25 02:57:23');

-- --------------------------------------------------------

--
-- 表的结构 `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '版块名称',
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `describe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '版块描述',
  `style` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip_style` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '状态:启用|未启用'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `categories`
--

INSERT INTO `categories` (`id`, `name`, `img`, `describe`, `style`, `tip_style`, `status`) VALUES
(1, '灌水', '/assets/images/guanshui.png', '这里是聊天灌水的地方，不必拘于什么，但是心里要有数', 'color:#30668c;font-size: 15px', 'color: #fff;background: #30668c', 1),
(2, '问答', '/assets/images/wenda.jpg', '这里可以提问，大家一起来解决问题', 'color:orangered;font-size: 15px', 'color: #fff;background: #d21e12', 1),
(3, '技术', '/assets/images/jishu.png', '这里可以交流技术上方面的知识', 'color:#01AAED;font-size: 15px', 'color: #fff;background:#01AAED', 1),
(4, '公告', '/assets/images/gonggao.png', '管理大大的一些通知', 'color:mediumspringgreen;font-size: 15px', 'color: #fff;background:#2bd047', 1);

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` tinyint(4) NOT NULL COMMENT '评论人',
  `post_id` tinyint(4) NOT NULL COMMENT '评论的文章',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '评论的内容',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 6, '<p>这是一条评论</p>', '2018-03-01 12:20:23', '2018-03-01 12:20:23'),
(2, 1, 6, '<p>这是测试的评论<img src=\"http://twemoji.maxcdn.com/36x36/1f1ec-1f1e7.png\" title=\"twemoji-1f1ec-1f1e7\" alt=\"twemoji-1f1ec-1f1e7\" class=\"emoji twemoji\" /></p>', '2018-03-05 12:44:13', '2018-03-05 12:44:13'),
(3, 1, 6, '<p>这是第二条评论<img src=\"http://twemoji.maxcdn.com/36x36/1f17e.png\" title=\"twemoji-1f17e\" alt=\"twemoji-1f17e\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f171.png\" title=\"twemoji-1f171\" alt=\"twemoji-1f171\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f170.png\" title=\"twemoji-1f170\" alt=\"twemoji-1f170\" class=\"emoji twemoji\" /></p>', '2018-03-06 11:31:33', '2018-03-06 11:31:33'),
(4, 1, 7, '<p>厉害了我的哥！<img src=\"http://twemoji.maxcdn.com/36x36/1f44d.png\" title=\"twemoji-1f44d\" alt=\"twemoji-1f44d\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f44d.png\" title=\"twemoji-1f44d\" alt=\"twemoji-1f44d\" class=\"emoji twemoji\" /></p>', '2018-03-07 11:33:22', '2018-03-07 11:33:22'),
(5, 1, 8, '<p>这是一条评论</p>', '2018-03-07 12:25:44', '2018-03-07 12:25:44'),
(6, 1, 7, '<p>get到了<img src=\"http://twemoji.maxcdn.com/36x36/1f44c.png\" title=\"twemoji-1f44c\" alt=\"twemoji-1f44c\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f44c.png\" title=\"twemoji-1f44c\" alt=\"twemoji-1f44c\" class=\"emoji twemoji\" /></p>', '2018-03-09 09:23:26', '2018-03-09 09:23:26'),
(7, 1, 7, '<p>学到了！！！</p>', '2018-03-09 09:25:13', '2018-03-09 09:25:13'),
(8, 5, 7, '<p>这个可以的！！</p>', '2018-03-09 09:25:31', '2018-03-09 09:25:31');

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_02_25_103822_create_admins_table', 1),
(2, '2018_02_26_063045_create_users_table', 2),
(3, '2018_02_28_192027_create_posts_table', 3),
(4, '2018_02_28_194703_create_posts_table', 4),
(5, '2018_02_28_202631_create_categories_table', 5),
(6, '2018_03_01_190829_create_comments_table', 6),
(7, '2018_03_07_194503_create_zans_table', 7);

-- --------------------------------------------------------

--
-- 表的结构 `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `content`, `is_top`, `is_closed`, `is_sticky`, `renqi`, `status`, `reward`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '这是置顶贴', '这是测试贴的内容', 1, 0, 0, 21, 0, 20, '2018-02-28 11:50:34', '2018-03-09 08:27:09'),
(2, 1, 2, '这是测试贴', '这是测试贴的内容', 1, 0, 0, 3, 0, 20, '2018-02-28 11:50:34', '2018-03-07 11:19:25'),
(6, 1, 1, '这是我的第一个测试贴', '<p><img src=\"http://twemoji.maxcdn.com/36x36/1f1eb-1f1f7.png\" title=\"twemoji-1f1eb-1f1f7\" alt=\"twemoji-1f1eb-1f1f7\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f1ec-1f1e7.png\" title=\"twemoji-1f1ec-1f1e7\" alt=\"twemoji-1f1ec-1f1e7\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f202.png\" title=\"twemoji-1f202\" alt=\"twemoji-1f202\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f1ef-1f1f5.png\" title=\"twemoji-1f1ef-1f1f5\" alt=\"twemoji-1f1ef-1f1f5\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f303.png\" title=\"twemoji-1f303\" alt=\"twemoji-1f303\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f488.png\" title=\"twemoji-1f488\" alt=\"twemoji-1f488\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f49e.png\" title=\"twemoji-1f49e\" alt=\"twemoji-1f49e\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f4a1.png\" title=\"twemoji-1f4a1\" alt=\"twemoji-1f4a1\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f48f.png\" title=\"twemoji-1f48f\" alt=\"twemoji-1f48f\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f453.png\" title=\"twemoji-1f453\" alt=\"twemoji-1f453\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f43a.png\" title=\"twemoji-1f43a\" alt=\"twemoji-1f43a\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f461.png\" title=\"twemoji-1f461\" alt=\"twemoji-1f461\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f477.png\" title=\"twemoji-1f477\" alt=\"twemoji-1f477\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f439.png\" title=\"twemoji-1f439\" alt=\"twemoji-1f439\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f479.png\" title=\"twemoji-1f479\" alt=\"twemoji-1f479\" class=\"emoji twemoji\" /><br>这是我的第一个测试贴</p>', 0, 0, 0, 79, 0, 20, '2018-03-01 09:56:44', '2018-03-09 09:47:55'),
(7, 1, 3, 'Laravel Carbon::diffForHumans 切换中文', '<h6 id=\"h6--namespace-carbon-carbon-php\"><a name=\"搜索namespace Carbon下的 Carbon.php\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>搜索namespace Carbon下的 Carbon.php</h6><h6 id=\"h6--code-setlocale-39-en-39-code-code-setlocale-39-zh-39-code-\"><a name=\"将静态方法 <code>setLocale(&#39;en&#39;)</code> 改为 <code>setLocale(&#39;zh&#39;)</code>\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>将静态方法 <code>setLocale(&#39;en&#39;)</code> 改为 <code>setLocale(&#39;zh&#39;)</code></h6><h6 id=\"h6-u5373u53EFu5C06u539Fu6765u7684u82F1u6587u63D0u793Au6539u4E3Au4E2Du6587u63D0u793A\"><a name=\"即可将原来的英文提示改为中文提示\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>即可将原来的英文提示改为中文提示</h6><h6 id=\"h6--5-3-\"><a name=\"例如：5天前 3小时前 等等\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>例如：5天前 3小时前 等等</h6>', 0, 0, 0, 33, 0, 20, '2018-03-06 11:45:16', '2018-03-09 09:47:50'),
(8, 1, 3, 'PHPer 面试指南-扩展阅读资源整理', '<h6 id=\"h6--github-https-github-com-todayqq-phperinterviewguide\"><a name=\"本书的 GitHub 地址：  https://github.com/todayqq/PHPerInterviewGuide\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>本书的 GitHub 地址：<a href=\"https://github.com/todayqq/PHPerInterviewGuide\">https://github.com/todayqq/PHPerInterviewGuide</a></h6><h4 id=\"h4-u524Du7AEFu7BC7\"><a name=\"前端篇\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>前端篇</h4><ul>\r\n<li><a href=\"https://github.com/qiu-deqing/FE-interview\" title=\"收集的前端面试题和答案\">收集的前端面试题和答案</a></li><li><a href=\"https://github.com/markyun/My-blog/tree/master/Front-end-Developer-Questions/Questions-and-Answers\" title=\"前端开发面试题\">前端开发面试题</a></li><li><a href=\"https://github.com/qiu-deqing/FE-interview\" title=\"史上最全的web前端面试题汇总及答案\">史上最全的web前端面试题汇总及答案</a></li><li><a href=\"https://leohxj.gitbooks.io/front-end-database/index.html\" title=\"前端工程师手册\">前端工程师手册</a></li><li><a href=\"http://blog.csdn.net/anndy_/article/details/77198883\" title=\"HTTP协议：工作原理\">HTTP协议：工作原理</a></li><li><a href=\"http://www.ruanyifeng.com/blog/2014/02/ssl_tls.html\" title=\"SSL/TLS协议运行机制的概述\">SSL/TLS协议运行机制的概述</a></li></ul>\r\n<h4 id=\"h4-u540Eu7AEFu7BC7\"><a name=\"后端篇\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>后端篇</h4><ul>\r\n<li><a href=\"http://coffeephp.com/articles/4?utm_source=laravel-china.org\" title=\"3年PHPer的面试总结\">3年PHPer的面试总结</a></li><li><a href=\"http://docs.php.net/manual/zh/features.gc.performance-considerations.php\" title=\"垃圾回收机制\">垃圾回收机制</a></li><li><a href=\"https://laravel-china.org/articles/4160/solid-object-oriented-design-and-programming-oodoop-notes?order_by=created_at&amp;\" title=\"S.O.L.I.D 面向对象设计\">S.O.L.I.D 面向对象设计</a></li><li><a href=\"http://www.cnblogs.com/DebugLZQ/archive/2013/06/05/3107957.html\" title=\"浅谈IOC--说清楚IOC是什么\">浅谈IOC—说清楚IOC是什么</a></li><li><a href=\"https://www.biaodianfu.com/redis-vs-memcached.html\" title=\"Redis和Memcached的区别\">Redis和Memcached的区别</a></li><li><a href=\"https://tech.meituan.com/mysql-index.html\" title=\"MySQL索引原理及慢查询优化\">MySQL索引原理及慢查询优化</a></li><li><a href=\"http://www.infoq.com/cn/articles/key-steps-and-likely-problems-of-split-table\" title=\"分库分表的几种常见形式\">分库分表的几种常见形式</a></li><li><a href=\"https://tech.meituan.com/dianping_order_db_sharding.html\" title=\"大众点评订单系统分库分表实践\">大众点评订单系统分库分表实践</a></li><li><a href=\"https://www.2cto.com/database/201511/449484.html\" title=\"MySQL死锁问题实例分析及解决方法\">MySQL死锁问题实例分析及解决方法</a></li></ul>\r\n<h4 id=\"h4-u7B97u6CD5u7BC7\"><a name=\"算法篇\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>算法篇</h4><ul>\r\n<li><a href=\"https://www.cnblogs.com/wgq123/p/6529450.html\" title=\"PHP 冒泡排序\">PHP 冒泡排序</a></li><li><a href=\"https://www.cnblogs.com/wangjingwangjing/p/5241486.html\" title=\"php实现快速排序\">php实现快速排序</a></li><li><a href=\"https://www.cnblogs.com/hellohell/p/5718175.html\" title=\"PHP实现各种经典算法\">PHP实现各种经典算法</a></li><li><a href=\"http://www.cnblogs.com/zswordsman/p/5824599.html\" title=\"PHP常见算法-面试篇\">PHP常见算法-面试篇</a></li><li><a href=\"https://www.cnblogs.com/wangjingwangjing/p/5206711.html\" title=\"php实现二分查找法\">php实现二分查找法</a></li></ul>\r\n<h4 id=\"h4-linux-git-\"><a name=\"Linux、Git 篇\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>Linux、Git 篇</h4><ul>\r\n<li><a href=\"http://blog.csdn.net/u010842515/article/details/72732106\" title=\"linux面试常问命令\">linux面试常问命令</a></li><li><a href=\"https://www.leolan.top/index.php/posts/36.html\" title=\"Linux常见面试题\">Linux常见面试题</a></li><li><a href=\"https://www.liaoxuefeng.com/wiki/0013739516305929606dd18361248578c67b8067c8c017b000\" title=\"Git教程\">Git教程</a></li><li><a href=\"https://laravel-china.org/articles/6318/gitflow-workflow\" title=\"Gitflow 工作流\">Gitflow 工作流</a></li></ul>\r\n<h4 id=\"h4-u5176u4ED6\"><a name=\"其他\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>其他</h4><ul>\r\n<li><a href=\"https://www.zhihu.com/question/25002833\" title=\"程序员简历应该怎么写？\">程序员简历应该怎么写？</a></li><li><a href=\"https://github.com/geekcompany/ResumeSample\" title=\"程序员简历模板\">程序员简历模板</a></li><li><a href=\"https://www.jianshu.com/p/7e68484a7811\" title=\"关于程序员生涯的思考，30 岁以后的码农们该何去何从？\">关于程序员生涯的思考，30 岁以后的码农们该何去何从？</a></li><li><a href=\"http://www.ruanyifeng.com/blog/2016/06/your-destiny-is-not-like-a-mule.html\" title=\"你的命运不是一头骡子\">你的命运不是一头骡子</a></li></ul>', 0, 0, 1, 14, 0, 20, '2018-03-06 12:09:15', '2018-03-09 09:54:53'),
(9, 1, 3, 'Markdown编辑器editor.md的使用', '<p>分享链接：<a href=\"http://blog.csdn.net/lovejavaydj/article/details/73692917\">http://blog.csdn.net/lovejavaydj/article/details/73692917</a></p>', 0, 0, 0, 31, 0, 20, '2018-03-06 12:16:08', '2018-03-09 07:59:15');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '城市',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '/assets/images/default_avatar.png' COMMENT '头像',
  `sex` enum('男','女') COLLATE utf8mb4_unicode_ci DEFAULT '男',
  `sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '个人签名',
  `reward` tinyint(4) UNSIGNED DEFAULT '0',
  `is_signed` char(255) COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '是否已签到',
  `last_sing_time` time DEFAULT NULL COMMENT '上次签到时间',
  `sing_time` time DEFAULT NULL COMMENT '签到时间',
  `sing_day` tinyint(4) DEFAULT '0' COMMENT '累计签到天数',
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `city`, `avatar`, `sex`, `sign`, `reward`, `is_signed`, `last_sing_time`, `sing_time`, `sing_day`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '管理员', '$2y$10$Z0uEqZqw2.lVzPLBvLBztugvvNel.lgs.6Cs5vv6iX2fVkEL7pNdW', '750214261@qq.com', '东莞', '/upload/20180226/20180226130910.jpg', '男', '没事别找我谢谢合作！', 100, '0', NULL, NULL, 0, 'GWnUmcgGdQYE9F6Gmh4fg3tmNdKjCgkY9OzlngGIF0em05xNgGtHzk8V4mpc', '2018-02-25 23:18:40', '2018-03-03 13:41:36'),
(2, 'Prof. Donnie Thompson', '$2y$10$Z0uEqZqw2.lVzPLBvLBztugvvNel.lgs.6Cs5vv6iX2fVkEL7pNdW', 'jennings.franecki@example.com', NULL, NULL, '男', NULL, 0, '0', NULL, NULL, 0, '', '2018-02-25 23:18:40', '2018-02-25 23:18:40'),
(3, 'Serena Reichel', '$2y$10$Z0uEqZqw2.lVzPLBvLBztugvvNel.lgs.6Cs5vv6iX2fVkEL7pNdW', 'trantow.esther@example.com', NULL, NULL, '男', NULL, 0, '0', NULL, NULL, 0, '', '2018-02-25 23:18:40', '2018-02-25 23:18:40'),
(5, '榴莲君', '$2y$10$esXqTMVqzDpu41lDE1aLCO7n8dR6q6vIbjZW4OUPcnNFxDrhCOwZu', '123456789@qq.com', '郑州', '/upload/20180309/20180309161942.jpg', '女', NULL, 0, '0', NULL, NULL, 0, NULL, '2018-03-01 05:50:25', '2018-03-09 08:19:42');

-- --------------------------------------------------------

--
-- 表的结构 `zans`
--

CREATE TABLE `zans` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` tinyint(4) NOT NULL COMMENT '点赞人',
  `comment_id` tinyint(4) NOT NULL COMMENT '点赞的评论',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `zans`
--

INSERT INTO `zans` (`id`, `user_id`, `comment_id`, `created_at`, `updated_at`) VALUES
(7, 5, 1, '2018-03-07 13:19:59', '2018-03-07 13:19:59'),
(8, 5, 2, '2018-03-07 13:20:04', '2018-03-07 13:20:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zans`
--
ALTER TABLE `zans`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `zans`
--
ALTER TABLE `zans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
