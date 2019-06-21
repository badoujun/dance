/*
SQLyog Enterprise v12.08 (64 bit)
MySQL - 5.6.43 : Database - dance
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dance` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

/*Table structure for table `message_team` */

DROP TABLE IF EXISTS `message_team`;

CREATE TABLE `message_team` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sender` bigint(20) DEFAULT NULL COMMENT '发送者用户ID',
  `receiver` bigint(20) DEFAULT NULL COMMENT '接收者用户ID',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '消息内容',
  `createTime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `state` int(11) DEFAULT '1' COMMENT '状态,1-正常,2-禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='团队交流表';

/*Table structure for table `message_user` */

DROP TABLE IF EXISTS `message_user`;

CREATE TABLE `message_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sender` bigint(20) DEFAULT NULL COMMENT '发送者用户ID',
  `receiver` bigint(20) DEFAULT NULL COMMENT '接收者用户ID',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '消息内容',
  `createTime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `state` int(11) DEFAULT '1' COMMENT '状态,1-正常,2-禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户交流表';

/*Table structure for table `team` */

DROP TABLE IF EXISTS `team`;

CREATE TABLE `team` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) DEFAULT NULL COMMENT '用户ID(创建人)',
  `teamName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '团队名',
  `head` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '头像URL',
  `atlas` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '轮播图URL',
  `detail` text COLLATE utf8mb4_unicode_ci COMMENT '团队说明',
  `cityCode` char(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '团队城市code',
  `longitude` decimal(7,4) DEFAULT NULL COMMENT '经度',
  `latitude` decimal(7,4) DEFAULT NULL COMMENT '纬度',
  `state` int(11) DEFAULT '1' COMMENT '状态,1-正常,2-禁用',
  `personNum` int(11) DEFAULT '0' COMMENT '团队人数',
  `likeNum` int(11) DEFAULT '0' COMMENT '点赞数',
  `followNum` int(11) DEFAULT '0' COMMENT '关注人数',
  `createTime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='团队表';

/*Table structure for table `team_grade` */

DROP TABLE IF EXISTS `team_grade`;

CREATE TABLE `team_grade` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `teamId` bigint(20) DEFAULT NULL COMMENT '团队ID',
  `gradeName` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '等级名',
  `serial` int(11) DEFAULT '1' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='团队-等级关系表';

/*Table structure for table `team_grade_power` */

DROP TABLE IF EXISTS `team_grade_power`;

CREATE TABLE `team_grade_power` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `gradeId` bigint(20) DEFAULT NULL COMMENT '等级ID',
  `powerId` bigint(20) DEFAULT NULL COMMENT '权限ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='团队-等级-权限中间表';

/*Table structure for table `team_like` */

DROP TABLE IF EXISTS `team_like`;

CREATE TABLE `team_like` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `teamId` bigint(20) DEFAULT NULL COMMENT '团队ID',
  `userId` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `state` int(11) DEFAULT '1' COMMENT '状态',
  `createTime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='团队-点赞记录表';

/*Table structure for table `team_power` */

DROP TABLE IF EXISTS `team_power`;

CREATE TABLE `team_power` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `powerName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '权限名',
  `powerEnum` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '权限枚举',
  `state` int(11) DEFAULT '1' COMMENT '状态,1-正常,2-禁用',
  `serial` int(11) DEFAULT '1' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='团队-权限表';

/*Table structure for table `team_user` */

DROP TABLE IF EXISTS `team_user`;

CREATE TABLE `team_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `teamId` bigint(20) DEFAULT NULL COMMENT '团队ID',
  `nickname` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '昵称',
  `gradeId` bigint(20) DEFAULT NULL COMMENT '等级ID',
  `state` int(11) DEFAULT '1' COMMENT '状态,1-正常,2-禁用',
  `createTime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='团队-用户关系表';

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户名',
  `pwd` char(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '密码',
  `phone` char(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '手机号',
  `nickname` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '昵称',
  `cityCode` char(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '定居城市code',
  `headImg` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '头像URL',
  `SignUpChannel` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '注册渠道',
  `phoneCode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '手机设备号',
  `state` int(11) DEFAULT '1' COMMENT '状态,1-正常,2-禁用',
  `SignUpTime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户表';

/*Table structure for table `user_follow` */

DROP TABLE IF EXISTS `user_follow`;

CREATE TABLE `user_follow` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `followType` int(11) DEFAULT '1' COMMENT '关注类型,1-用户,2-团队',
  `followId` bigint(20) DEFAULT NULL COMMENT '用户ID或团队ID',
  `state` int(11) DEFAULT '1' COMMENT '状态,1-使用,2-禁用',
  `createTime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户关注表';

/*Table structure for table `user_sign_log` */

DROP TABLE IF EXISTS `user_sign_log`;

CREATE TABLE `user_sign_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `SignInChannel` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '登录渠道',
  `SignInIp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '登录IP',
  `phoneCode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '手机设备号',
  `SignInTime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='登录记录表';

/*Table structure for table `video` */

DROP TABLE IF EXISTS `video`;

CREATE TABLE `video` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `teamId` bigint(20) DEFAULT NULL COMMENT '团队ID',
  `videoUrl` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '视频地址',
  `coverUrl` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '封面地址',
  `createTime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `duration` int(11) DEFAULT '0' COMMENT '时长,秒',
  `views` int(11) DEFAULT '0' COMMENT '播放量',
  `commentNum` int(11) DEFAULT '0' COMMENT '评论数',
  `likeNum` int(11) DEFAULT '0' COMMENT '点赞数',
  `state` int(11) DEFAULT '1' COMMENT '状态,1-正常,2-禁用',
  `cityCode` char(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '城市code',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='视频表';

/*Table structure for table `video_comment` */

DROP TABLE IF EXISTS `video_comment`;

CREATE TABLE `video_comment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `videoId` bigint(20) DEFAULT NULL COMMENT '视频ID',
  `replyId` bigint(20) DEFAULT NULL COMMENT '回复的评论ID',
  `comment` text COLLATE utf8mb4_unicode_ci COMMENT '评论内容',
  `createTime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `likeNum` int(11) DEFAULT '0' COMMENT '点赞数',
  `state` int(11) DEFAULT '1' COMMENT '状态,1-正常,2-禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='视频评论表';

/*Table structure for table `video_comment_like` */

DROP TABLE IF EXISTS `video_comment_like`;

CREATE TABLE `video_comment_like` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `commentId` bigint(20) DEFAULT NULL COMMENT '评论ID',
  `userId` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `state` int(11) DEFAULT '1' COMMENT '状态,1-正常,2-禁用',
  `createTime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='评论-点赞记录表';

/*Table structure for table `video_like` */

DROP TABLE IF EXISTS `video_like`;

CREATE TABLE `video_like` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `videoId` bigint(20) DEFAULT NULL COMMENT '视频ID',
  `userId` bigint(20) DEFAULT NULL COMMENT '用户ID',
  `state` int(11) DEFAULT '1' COMMENT '状态,1-正常,2-禁用',
  `createTime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='视频-点赞记录表';

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
