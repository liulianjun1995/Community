/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : community

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-03-14 13:07:47
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('1', '1', '6', '<p>这是一条评论</p>', '2018-03-01 20:20:23', '2018-03-01 20:20:23');
INSERT INTO `comments` VALUES ('2', '1', '6', '<p>这是测试的评论<img src=\"http://twemoji.maxcdn.com/36x36/1f1ec-1f1e7.png\" title=\"twemoji-1f1ec-1f1e7\" alt=\"twemoji-1f1ec-1f1e7\" class=\"emoji twemoji\" /></p>', '2018-03-05 20:44:13', '2018-03-05 20:44:13');
INSERT INTO `comments` VALUES ('3', '1', '6', '<p>这是第二条评论<img src=\"http://twemoji.maxcdn.com/36x36/1f17e.png\" title=\"twemoji-1f17e\" alt=\"twemoji-1f17e\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f171.png\" title=\"twemoji-1f171\" alt=\"twemoji-1f171\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f170.png\" title=\"twemoji-1f170\" alt=\"twemoji-1f170\" class=\"emoji twemoji\" /></p>', '2018-03-06 19:31:33', '2018-03-06 19:31:33');
INSERT INTO `comments` VALUES ('4', '1', '7', '<p>厉害了我的哥！<img src=\"http://twemoji.maxcdn.com/36x36/1f44d.png\" title=\"twemoji-1f44d\" alt=\"twemoji-1f44d\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f44d.png\" title=\"twemoji-1f44d\" alt=\"twemoji-1f44d\" class=\"emoji twemoji\" /></p>', '2018-03-07 19:33:22', '2018-03-07 19:33:22');
INSERT INTO `comments` VALUES ('5', '1', '8', '<p>这是一条评论</p>', '2018-03-07 20:25:44', '2018-03-07 20:25:44');
INSERT INTO `comments` VALUES ('6', '1', '7', '<p>get到了<img src=\"http://twemoji.maxcdn.com/36x36/1f44c.png\" title=\"twemoji-1f44c\" alt=\"twemoji-1f44c\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f44c.png\" title=\"twemoji-1f44c\" alt=\"twemoji-1f44c\" class=\"emoji twemoji\" /></p>', '2018-03-09 17:23:26', '2018-03-09 17:23:26');
INSERT INTO `comments` VALUES ('7', '1', '7', '<p>学到了！！！</p>', '2018-03-09 17:25:13', '2018-03-09 17:25:13');
INSERT INTO `comments` VALUES ('8', '5', '7', '<p>这个可以的！！</p>', '2018-03-09 17:25:31', '2018-03-09 17:25:31');
INSERT INTO `comments` VALUES ('9', '5', '10', '<p><img src=\"/assets/editormd/plugins/emoji-dialog/emoji/joy.png\" class=\"emoji\" title=\"&#58;joy&#58;\" alt=\"&#58;joy&#58;\" /> <img src=\"/assets/editormd/plugins/emoji-dialog/emoji/joy.png\" class=\"emoji\" title=\"&#58;joy&#58;\" alt=\"&#58;joy&#58;\" /> <img src=\"/assets/editormd/plugins/emoji-dialog/emoji/joy.png\" class=\"emoji\" title=\"&#58;joy&#58;\" alt=\"&#58;joy&#58;\" /><img src=\"/assets/editormd/plugins/emoji-dialog/emoji/joy.png\" class=\"emoji\" title=\"&#58;joy&#58;\" alt=\"&#58;joy&#58;\" /> <img src=\"/assets/editormd/plugins/emoji-dialog/emoji/joy.png\" class=\"emoji\" title=\"&#58;joy&#58;\" alt=\"&#58;joy&#58;\" /></p>', '2018-03-10 20:17:23', '2018-03-10 20:17:23');

-- ----------------------------
-- Table structure for `laravel_sms`
-- ----------------------------
DROP TABLE IF EXISTS `laravel_sms`;
CREATE TABLE `laravel_sms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `temp_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `voice_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `fail_times` mediumint(9) NOT NULL DEFAULT '0',
  `last_fail_time` int(10) unsigned NOT NULL DEFAULT '0',
  `sent_time` int(10) unsigned NOT NULL DEFAULT '0',
  `result_info` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of laravel_sms
-- ----------------------------

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2018_02_25_103822_create_admins_table', '1');
INSERT INTO `migrations` VALUES ('2', '2018_02_26_063045_create_users_table', '2');
INSERT INTO `migrations` VALUES ('3', '2018_02_28_192027_create_posts_table', '3');
INSERT INTO `migrations` VALUES ('4', '2018_02_28_194703_create_posts_table', '4');
INSERT INTO `migrations` VALUES ('5', '2018_02_28_202631_create_categories_table', '5');
INSERT INTO `migrations` VALUES ('6', '2018_03_01_190829_create_comments_table', '6');
INSERT INTO `migrations` VALUES ('7', '2018_03_07_194503_create_zans_table', '7');
INSERT INTO `migrations` VALUES ('9', '2015_12_21_111514_create_sms_table', '8');

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
  `view_count` tinyint(4) NOT NULL DEFAULT '0' COMMENT '帖子浏览次数',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '帖子状态',
  `reward` tinyint(4) NOT NULL COMMENT '悬赏',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('1', '1', '1', '这是置顶贴', '这是测试贴的内容', '1', '0', '0', '27', '0', '20', '2018-02-28 19:50:34', '2018-03-10 19:34:17');
INSERT INTO `posts` VALUES ('2', '1', '2', '这是测试贴', '这是测试贴的内容', '1', '0', '0', '3', '0', '20', '2018-02-28 19:50:34', '2018-03-07 19:19:25');
INSERT INTO `posts` VALUES ('6', '1', '1', '这是我的第一个测试贴', '<p><img src=\"http://twemoji.maxcdn.com/36x36/1f1eb-1f1f7.png\" title=\"twemoji-1f1eb-1f1f7\" alt=\"twemoji-1f1eb-1f1f7\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f1ec-1f1e7.png\" title=\"twemoji-1f1ec-1f1e7\" alt=\"twemoji-1f1ec-1f1e7\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f202.png\" title=\"twemoji-1f202\" alt=\"twemoji-1f202\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f1ef-1f1f5.png\" title=\"twemoji-1f1ef-1f1f5\" alt=\"twemoji-1f1ef-1f1f5\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f303.png\" title=\"twemoji-1f303\" alt=\"twemoji-1f303\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f488.png\" title=\"twemoji-1f488\" alt=\"twemoji-1f488\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f49e.png\" title=\"twemoji-1f49e\" alt=\"twemoji-1f49e\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f4a1.png\" title=\"twemoji-1f4a1\" alt=\"twemoji-1f4a1\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f48f.png\" title=\"twemoji-1f48f\" alt=\"twemoji-1f48f\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f453.png\" title=\"twemoji-1f453\" alt=\"twemoji-1f453\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f43a.png\" title=\"twemoji-1f43a\" alt=\"twemoji-1f43a\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f461.png\" title=\"twemoji-1f461\" alt=\"twemoji-1f461\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f477.png\" title=\"twemoji-1f477\" alt=\"twemoji-1f477\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f439.png\" title=\"twemoji-1f439\" alt=\"twemoji-1f439\" class=\"emoji twemoji\" /> <img src=\"http://twemoji.maxcdn.com/36x36/1f479.png\" title=\"twemoji-1f479\" alt=\"twemoji-1f479\" class=\"emoji twemoji\" /><br>这是我的第一个测试贴</p>', '0', '0', '0', '87', '0', '20', '2018-03-01 17:56:44', '2018-03-10 20:28:47');
INSERT INTO `posts` VALUES ('7', '1', '3', 'Laravel Carbon::diffForHumans 切换中文', '<h6 id=\"h6--namespace-carbon-carbon-php\"><a name=\"搜索namespace Carbon下的 Carbon.php\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>搜索namespace Carbon下的 Carbon.php</h6><h6 id=\"h6--code-setlocale-39-en-39-code-code-setlocale-39-zh-39-code-\"><a name=\"将静态方法 <code>setLocale(&#39;en&#39;)</code> 改为 <code>setLocale(&#39;zh&#39;)</code>\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>将静态方法 <code>setLocale(&#39;en&#39;)</code> 改为 <code>setLocale(&#39;zh&#39;)</code></h6><h6 id=\"h6-u5373u53EFu5C06u539Fu6765u7684u82F1u6587u63D0u793Au6539u4E3Au4E2Du6587u63D0u793A\"><a name=\"即可将原来的英文提示改为中文提示\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>即可将原来的英文提示改为中文提示</h6><h6 id=\"h6--5-3-\"><a name=\"例如：5天前 3小时前 等等\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>例如：5天前 3小时前 等等</h6>', '0', '0', '0', '51', '0', '20', '2018-03-06 19:45:16', '2018-03-13 16:10:04');
INSERT INTO `posts` VALUES ('8', '1', '3', 'PHPer 面试指南-扩展阅读资源整理', '<h6 id=\"h6--github-https-github-com-todayqq-phperinterviewguide\"><a name=\"本书的 GitHub 地址：  https://github.com/todayqq/PHPerInterviewGuide\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>本书的 GitHub 地址：<a href=\"https://github.com/todayqq/PHPerInterviewGuide\">https://github.com/todayqq/PHPerInterviewGuide</a></h6><h4 id=\"h4-u524Du7AEFu7BC7\"><a name=\"前端篇\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>前端篇</h4><ul>\r\n<li><a href=\"https://github.com/qiu-deqing/FE-interview\" title=\"收集的前端面试题和答案\">收集的前端面试题和答案</a></li><li><a href=\"https://github.com/markyun/My-blog/tree/master/Front-end-Developer-Questions/Questions-and-Answers\" title=\"前端开发面试题\">前端开发面试题</a></li><li><a href=\"https://github.com/qiu-deqing/FE-interview\" title=\"史上最全的web前端面试题汇总及答案\">史上最全的web前端面试题汇总及答案</a></li><li><a href=\"https://leohxj.gitbooks.io/front-end-database/index.html\" title=\"前端工程师手册\">前端工程师手册</a></li><li><a href=\"http://blog.csdn.net/anndy_/article/details/77198883\" title=\"HTTP协议：工作原理\">HTTP协议：工作原理</a></li><li><a href=\"http://www.ruanyifeng.com/blog/2014/02/ssl_tls.html\" title=\"SSL/TLS协议运行机制的概述\">SSL/TLS协议运行机制的概述</a></li></ul>\r\n<h4 id=\"h4-u540Eu7AEFu7BC7\"><a name=\"后端篇\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>后端篇</h4><ul>\r\n<li><a href=\"http://coffeephp.com/articles/4?utm_source=laravel-china.org\" title=\"3年PHPer的面试总结\">3年PHPer的面试总结</a></li><li><a href=\"http://docs.php.net/manual/zh/features.gc.performance-considerations.php\" title=\"垃圾回收机制\">垃圾回收机制</a></li><li><a href=\"https://laravel-china.org/articles/4160/solid-object-oriented-design-and-programming-oodoop-notes?order_by=created_at&amp;\" title=\"S.O.L.I.D 面向对象设计\">S.O.L.I.D 面向对象设计</a></li><li><a href=\"http://www.cnblogs.com/DebugLZQ/archive/2013/06/05/3107957.html\" title=\"浅谈IOC--说清楚IOC是什么\">浅谈IOC—说清楚IOC是什么</a></li><li><a href=\"https://www.biaodianfu.com/redis-vs-memcached.html\" title=\"Redis和Memcached的区别\">Redis和Memcached的区别</a></li><li><a href=\"https://tech.meituan.com/mysql-index.html\" title=\"MySQL索引原理及慢查询优化\">MySQL索引原理及慢查询优化</a></li><li><a href=\"http://www.infoq.com/cn/articles/key-steps-and-likely-problems-of-split-table\" title=\"分库分表的几种常见形式\">分库分表的几种常见形式</a></li><li><a href=\"https://tech.meituan.com/dianping_order_db_sharding.html\" title=\"大众点评订单系统分库分表实践\">大众点评订单系统分库分表实践</a></li><li><a href=\"https://www.2cto.com/database/201511/449484.html\" title=\"MySQL死锁问题实例分析及解决方法\">MySQL死锁问题实例分析及解决方法</a></li></ul>\r\n<h4 id=\"h4-u7B97u6CD5u7BC7\"><a name=\"算法篇\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>算法篇</h4><ul>\r\n<li><a href=\"https://www.cnblogs.com/wgq123/p/6529450.html\" title=\"PHP 冒泡排序\">PHP 冒泡排序</a></li><li><a href=\"https://www.cnblogs.com/wangjingwangjing/p/5241486.html\" title=\"php实现快速排序\">php实现快速排序</a></li><li><a href=\"https://www.cnblogs.com/hellohell/p/5718175.html\" title=\"PHP实现各种经典算法\">PHP实现各种经典算法</a></li><li><a href=\"http://www.cnblogs.com/zswordsman/p/5824599.html\" title=\"PHP常见算法-面试篇\">PHP常见算法-面试篇</a></li><li><a href=\"https://www.cnblogs.com/wangjingwangjing/p/5206711.html\" title=\"php实现二分查找法\">php实现二分查找法</a></li></ul>\r\n<h4 id=\"h4-linux-git-\"><a name=\"Linux、Git 篇\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>Linux、Git 篇</h4><ul>\r\n<li><a href=\"http://blog.csdn.net/u010842515/article/details/72732106\" title=\"linux面试常问命令\">linux面试常问命令</a></li><li><a href=\"https://www.leolan.top/index.php/posts/36.html\" title=\"Linux常见面试题\">Linux常见面试题</a></li><li><a href=\"https://www.liaoxuefeng.com/wiki/0013739516305929606dd18361248578c67b8067c8c017b000\" title=\"Git教程\">Git教程</a></li><li><a href=\"https://laravel-china.org/articles/6318/gitflow-workflow\" title=\"Gitflow 工作流\">Gitflow 工作流</a></li></ul>\r\n<h4 id=\"h4-u5176u4ED6\"><a name=\"其他\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>其他</h4><ul>\r\n<li><a href=\"https://www.zhihu.com/question/25002833\" title=\"程序员简历应该怎么写？\">程序员简历应该怎么写？</a></li><li><a href=\"https://github.com/geekcompany/ResumeSample\" title=\"程序员简历模板\">程序员简历模板</a></li><li><a href=\"https://www.jianshu.com/p/7e68484a7811\" title=\"关于程序员生涯的思考，30 岁以后的码农们该何去何从？\">关于程序员生涯的思考，30 岁以后的码农们该何去何从？</a></li><li><a href=\"http://www.ruanyifeng.com/blog/2016/06/your-destiny-is-not-like-a-mule.html\" title=\"你的命运不是一头骡子\">你的命运不是一头骡子</a></li></ul>', '0', '0', '1', '16', '0', '20', '2018-03-06 20:09:15', '2018-03-10 10:59:46');
INSERT INTO `posts` VALUES ('9', '1', '3', 'Markdown编辑器editor.md的使用', '<p>分享链接：<a href=\"http://blog.csdn.net/lovejavaydj/article/details/73692917\">http://blog.csdn.net/lovejavaydj/article/details/73692917</a></p>', '0', '0', '0', '35', '0', '20', '2018-03-06 20:16:08', '2018-03-13 16:15:33');
INSERT INTO `posts` VALUES ('10', '1', '4', '社区的 GitHub仓库，欢迎Star', '<h4 id=\"h4-github-https-github-com-liulianjun1995-comunity\"><a name=\"GitHub：  https://github.com/liulianjun1995/Comunity\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>GitHub：<a href=\"https://github.com/liulianjun1995/Comunity\">https://github.com/liulianjun1995/Comunity</a></h4><h4 id=\"h4--\"><a name=\"没加星的，记得给它加个星星囖，提升下人气神马的\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>没加星的，记得给它加个星星囖，提升下人气神马的</h4>', '0', '0', '0', '5', '0', '20', '2018-03-10 11:24:19', '2018-03-10 20:23:36');
INSERT INTO `posts` VALUES ('11', '5', '3', '5 个让你的开发更加轻松的辅助函数', '<blockquote>\r\n<p>本文为翻译文章，原文章地址：<a href=\"5 Laravel Helpers to Make Your Life Easier\">5 Laravel Helpers to Make Your Life Easier</a><br>在Laravel框架中有许多的辅助函数来帮助开发者更加有效率的进行开发。在这篇文章中，我会列出我个人比较喜欢的5个辅助函数</p>\r\n</blockquote>\r\n<h4 id=\"h4-data_get-\"><a name=\"data_get()\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>data_get()</h4><p><code>data_get()</code>辅助方法能够让你使用[.]符号来获取数组或者对象中的值。’array_get()’方法也是同样的道理。如果数组或者对象的key不存在的话，这个方法第三个可选参数可以设置一个默认值。</p>\r\n<pre><code>$array = [&#39;albums&#39; =&gt; [&#39;rock&#39; =&gt; [&#39;count&#39; =&gt; 75 ]]];\r\n\r\n$count = data_get($array, &#39;albums.rock.count&#39;); // 75\r\n$avgCost = data_get($array, &#39;albums.rock.avg_cost&#39;, 0); // 0\r\n\r\n$object-&gt;albums-&gt;rock-&gt;count = 75;\r\n\r\n$count = data_get($object, &#39;albums.rock.count&#39;); // 75\r\n$avgCost = data_get($object, &#39;albums.rock.avg_cost&#39;, 0); // 0\r\n</code></pre><p>如果在点符号连接中使用通配符’*’将会返回一个数组。</p>\r\n<pre><code>$array = [&#39;albums&#39; =&gt; [&#39;rock&#39; =&gt; [&#39;count&#39; =&gt; 75], &#39;punk&#39; =&gt; [&#39;count&#39; =&gt; 12]]];\r\n$counts = data_get($array, &#39;albums.*.count&#39;); // [75, 12]\r\n</code></pre><p>‘data_get()’辅助方法能够让你轻松的再数组或者对象中使用相同的语法来查找数据。这样你就不必检查你之前使用的变量是什么类型了。</p>\r\n<h4 id=\"h4-str_plural-\"><a name=\"str_plural()\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>str_plural()</h4><p>‘str_plural()’是将字符串变成对应的复数形式，目前只对英文的单词有效，第二个可选的参数能够让开发者来自己决定返回单数还是复数形式。</p>\r\n<pre><code>str_plural(&#39;dog&#39;); // dogs\r\nstr_plural(&#39;cat&#39;); // cats\r\n\r\nstr_plural(&#39;dog&#39;, 2); // dogs\r\nstr_plural(&#39;cat&#39;, 1); // cat\r\n\r\nstr_plural(&#39;child&#39;); // children\r\nstr_plural(&#39;person&#39;); // people\r\nstr_plural(&#39;fish&#39;); // fish\r\nstr_plural(&#39;deer&#39;, 2); // deer\r\n</code></pre><p>这个辅助方法最主要的用处就是能够移除类似 {{ $count == 1 ? ‘dog’ : ‘dogs’ }} 这样的代码。与之相反的还有一个’str_singular()’的辅助方法。 如果你感兴趣这个方法的工作原理，那么可以看看<a href=\"https://github.com/doctrine/inflector/blob/master/lib/Doctrine/Common/Inflector/Inflector.php\" title=\"Doctrine’s Inflector Class\">Doctrine’s Inflector Class</a></p>\r\n<h4 id=\"h4-route-\"><a name=\"route()\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>route()</h4><p>‘route()’方法能够生成已经命名的路由，可选的第二个参数将会传递给路由的参数。</p>\r\n<pre><code>Route::get(&#39;burgers&#39;, &#39;BurgersController@index&#39;)-&gt;name(&#39;burgers&#39;);\r\nroute(&#39;burgers&#39;); // http://example.com/burgers\r\nroute(&#39;burgers&#39;, [&#39;order_by&#39; =&gt; &#39;price&#39;]); // http://example.com/burgers?order_by=price\r\n\r\nRoute::get(&#39;burgers/{id}&#39;, &#39;BurgersController@show&#39;)-&gt;name(&#39;burgers.show&#39;);\r\nroute(&#39;burgers.show&#39;, 1); // http://example.com/burgers/1\r\nroute(&#39;burgers.show&#39;, [&#39;id&#39; =&gt; 1]); // http://example.com/burgers/1\r\n\r\nRoute::get(&#39;employees/{id}/{name}&#39;, &#39;EmployeesController@show&#39;)-&gt;name(&#39;employees.show&#39;);\r\nroute(&#39;employees.show&#39;, [5, &#39;chris&#39;]); // http://example.com/employees/5/chris\r\nroute(&#39;employees.show&#39;, [&#39;id&#39; =&gt; 5, &#39;name&#39; =&gt; &#39;chris&#39;]); // http://example.com/employees/5/chris\r\nroute(&#39;employees.show&#39;, [&#39;id&#39; =&gt; 5, &#39;name&#39; =&gt; &#39;chris&#39;, &#39;hide&#39; =&gt; &#39;email&#39;]); // http://example.com/employees/5/chris?hide=email\r\n</code></pre><p>如果将第三个可选参数设为false的话，那么将会返回一个相对地址而不是一个绝对地址</p>\r\n<pre><code>&lt;?php\r\n    route(&#39;burgers.show&#39;, 1, false); // /burgers/1\r\n?&gt;\r\n</code></pre><p>设置了子域名的也是同样的道理， 并且你也可以将Eloquent模型传参给route()方法</p>\r\n<pre><code>Route::domain(&#39;{location}.example.com&#39;)-&gt;group(function () {\r\n    Route::get(&#39;employees/{id}/{name}&#39;, &#39;EmployeesController@show&#39;)-&gt;name(&#39;employees.show&#39;);\r\n});\r\n\r\nroute(&#39;employees.show&#39;, [&#39;location&#39; =&gt; &#39;raleigh&#39;, &#39;id&#39; =&gt; 5, &#39;name&#39; =&gt; &#39;chris&#39;]); \r\n\r\nroute(&#39;burgers.show&#39;, Burger::find(1)); // http://example.com/burgers/1\r\n</code></pre><h4 id=\"h4-abort_if-\"><a name=\"abort_if()\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>abort_if()</h4><p>这个辅助方法将会抛出一个异常如果符合满足的要求。第三个可选参数为抛出异常的消息，第四个为header数组。</p>\r\n<pre><code>abort_if(! Auth::user()-&gt;isAdmin(), 403);\r\nabort_if(! Auth::user()-&gt;isAdmin(), 403, &#39;Sorry, you are not an admin&#39;);\r\nabort_if(Auth::user()-&gt;isCustomer(), 403);\r\n</code></pre><p>这个方法最主要的用处就是精简类似下面的代码，通过使用 abort_if() 能够只用一行代码实现同样的功能。</p>\r\n<pre><code>// In &quot;admin&quot; specific controller\r\npublic function index()\r\n{\r\n    if (! Auth::user()-&gt;isAdmin()) {\r\n        abort(403, &#39;Sorry, you are not an admin&#39;);\r\n    }\r\n}\r\n\r\n// better!\r\npublic function index()\r\n{\r\n    abort_if(! Auth::user()-&gt;isAdmin(), 403);\r\n}\r\n</code></pre><h5 id=\"h5--strong-authorization-gates-abort-strong-\"><a name=\"<strong>注意 如果你是通过这个来控制权限的话，你应该了解一下 authorization gates。 这样你就可以省去很多的abort检查了。</strong>\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span><strong>注意 如果你是通过这个来控制权限的话，你应该了解一下 authorization gates。 这样你就可以省去很多的abort检查了。</strong></h5><h4 id=\"h4-optional-\"><a name=\"optional()\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>optional()</h4><p>这个方法允许你来获取对象的属性或者调用方法。如果该对象为null，那么属性或者方法也会返回null而不是引起一个错误</p>\r\n<pre><code>// User 1 exists, with account\r\n$user1 = User::find(1);\r\n$accountId = $user1-&gt;account-&gt;id; // 123\r\n\r\n// User 2 exists, without account\r\n$user2 = User::find(2);\r\n$accountId = $user2-&gt;account-&gt;id; // PHP Error: Trying to get property of non-object\r\n\r\n// Fix without optional()\r\n$accountId = $user2-&gt;account ? $user2-&gt;account-&gt;id : null; // null\r\n$accountId = $user2-&gt;account-&gt;id ?? null; // null\r\n\r\n// Fix with optional()\r\n$accountId = optional($user2-&gt;account)-&gt;id; // null\r\n</code></pre><p>那么，你们最喜欢的辅助函数是哪些呢？</p>', '0', '0', '0', '2', '0', '20', '2018-03-10 20:01:34', '2018-03-10 20:02:22');

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
  `reward` tinyint(4) unsigned DEFAULT '0',
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
INSERT INTO `users` VALUES ('1', '管理员', '$2y$10$Z0uEqZqw2.lVzPLBvLBztugvvNel.lgs.6Cs5vv6iX2fVkEL7pNdW', '750214261@qq.com', '郑州', '/upload/20180226/20180226130910.jpg', '男', '没事别找我谢谢合作！', '100', '0', null, null, '0', 'gkOadcUEciq1NioOGStiaATOVNcrHvB0MuCGtxRX5YUsje4AAYbcBlzS9C5e', '2018-02-26 07:18:40', '2018-03-10 19:24:51');
INSERT INTO `users` VALUES ('2', 'Prof. Donnie Thompson', '$2y$10$Z0uEqZqw2.lVzPLBvLBztugvvNel.lgs.6Cs5vv6iX2fVkEL7pNdW', 'jennings.franecki@example.com', null, null, '男', null, '0', '0', null, null, '0', '', '2018-02-26 07:18:40', '2018-02-26 07:18:40');
INSERT INTO `users` VALUES ('3', 'Serena Reichel', '$2y$10$Z0uEqZqw2.lVzPLBvLBztugvvNel.lgs.6Cs5vv6iX2fVkEL7pNdW', 'trantow.esther@example.com', null, null, '男', null, '0', '0', null, null, '0', '', '2018-02-26 07:18:40', '2018-02-26 07:18:40');
INSERT INTO `users` VALUES ('5', '榴莲君', '$2y$10$esXqTMVqzDpu41lDE1aLCO7n8dR6q6vIbjZW4OUPcnNFxDrhCOwZu', '123456789@qq.com', '郑州', '/upload/20180309/20180309161942.jpg', '女', null, '0', '0', null, null, '0', '3fnE3LILGS8tOLWjGETGAUr6mxMSQuQAdnCTM0m2XS7o22vzplCFnaWeBtGE', '2018-03-01 13:50:25', '2018-03-09 16:19:42');

-- ----------------------------
-- Table structure for `zans`
-- ----------------------------
DROP TABLE IF EXISTS `zans`;
CREATE TABLE `zans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` tinyint(4) NOT NULL COMMENT '点赞人',
  `comment_id` tinyint(4) NOT NULL COMMENT '点赞的评论',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of zans
-- ----------------------------
INSERT INTO `zans` VALUES ('7', '5', '1', '2018-03-07 21:19:59', '2018-03-07 21:19:59');
INSERT INTO `zans` VALUES ('8', '5', '2', '2018-03-07 21:20:04', '2018-03-07 21:20:04');
