/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : blog

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 21/03/2019 19:47:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admins_nickname_unique`(`nickname`) USING BTREE,
  INDEX `admins_email_index`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, 'chidungplus@gmail.com', '', 'chidungplus', 'Nguyễn Chí Dũng', 1, NULL, NULL);
INSERT INTO `admins` VALUES (2, '', '', 'inxizel', 'Phạm Ngọc Nam', 0, NULL, NULL);

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` tinyint(4) DEFAULT NULL COMMENT 'chứa id category parent',
  `thumbnail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `categories_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2019_03_12_094031_create_admins_table', 2);
INSERT INTO `migrations` VALUES (3, '2019_03_19_074949_create_posts_table', 3);
INSERT INTO `migrations` VALUES (4, '2019_03_19_080009_create_tags_table', 3);
INSERT INTO `migrations` VALUES (5, '2019_03_19_080314_create_post_tags_table​​​​', 3);
INSERT INTO `migrations` VALUES (6, '2019_03_19_080526_create_categories_table', 3);

-- ----------------------------
-- Table structure for post_tags
-- ----------------------------
DROP TABLE IF EXISTS `post_tags`;
CREATE TABLE `post_tags`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `posts_slug_unique`(`slug`) USING BTREE,
  INDEX `posts_title_index`(`title`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `tags_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `email_verified_at` timestamp(0) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Nguyễn Chí Dũng', 'chidungplus@gmail.com', '0965346910', 1, NULL, '$2y$10$LOeNTFM2gDW70haWpdLNBeQx2lumasLu1Kg/qUlijfBHUPs6jQ6yK', 'IERu0NhOGq482ZN9D6rOUGP1Ghu8nBCxzXwbCaBq3CGdv2my3p5Bt5vTbHsW', 'on', '2019-03-16 00:26:39', '2019-03-16 00:26:39');
INSERT INTO `users` VALUES (2, 'Phạm Ngọc Long', 'inxizel@gmail.com', '0987467382', 1, NULL, '$2y$10$y0Zs9w6NWmgp2oHmJ8NumeMl7WnaJw1QzKv9uHmI7MZfKiyzmGyTe', NULL, 'on', '2019-03-16 01:51:03', '2019-03-16 01:51:03');
INSERT INTO `users` VALUES (3, 'Lương Thu Hiền', 'cuongnguyen@gmail.com', '0967364716', 0, NULL, '$2y$10$IyCMWJy0jAKRMyN6pDhygerv476Uo94TrsZKAJ6zLWhQrYtJ1X.wO', NULL, 'on', '2019-03-16 06:20:37', '2019-03-16 06:20:37');
INSERT INTO `users` VALUES (4, 'Vũ Bắc Long', 'longvu@gmail.com', '0964573764', 1, NULL, '$2y$10$6/T/xa3DZd3ccV36cRCLPOW1xuSNo6AteUkGj1XgxLRzM6ykrpD9G', NULL, 'on', '2019-03-16 06:21:27', '2019-03-16 06:21:27');
INSERT INTO `users` VALUES (5, 'Vũ Thị Phương', 'longnhi@gmail.com', '0936243273', 0, NULL, '$2y$10$Ze2tf9FvBkroK/7gRFPOiu6BWOn2MX64w31wDj/K4.IFVFtxjBaDW', NULL, 'off', '2019-03-16 06:35:59', '2019-03-16 06:35:59');
INSERT INTO `users` VALUES (21, 'Phạm Vũ Phong', 'vuphonglee@gmail.com', '098574875', 1, NULL, '$2y$10$HVYKjNPBAo.WVZyLMpwLNea2l7iykOIrax7OQAZBbaZ5DmUlZQxOa', NULL, 'on', '2019-03-16 16:18:30', '2019-03-16 16:18:30');
INSERT INTO `users` VALUES (22, 'Phạm Tuấn Cường', 'cuongpham@gmail.com', '0975643657', 1, NULL, '$2y$10$7Pd.HF2K0.kpTJZnJtRHZ.plgN0migOWf45pKCLvYvc0eX1OBh/W2', NULL, 'on', '2019-03-19 07:35:37', '2019-03-19 07:35:37');

SET FOREIGN_KEY_CHECKS = 1;
