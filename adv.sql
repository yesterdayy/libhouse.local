-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.23 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных adv
CREATE DATABASE IF NOT EXISTS `adv` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `adv`;

-- Дамп структуры для таблица adv.announcements
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.announcements: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` (`id`, `user_id`, `content`, `active`, `created_at`, `updated_at`) VALUES
	(1, 1, 'test', 0, '2019-06-26 21:58:58', '2019-06-26 21:58:58'),
	(2, 1, 'tet', 0, '2019-06-26 22:00:14', '2019-06-26 22:00:14'),
	(5, 1, 'test', 0, '2019-06-26 22:01:58', '2019-06-26 22:01:58');
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;

-- Дамп структуры для таблица adv.attachments
CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint(20) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `alt` text COLLATE utf8mb4_unicode_ci,
  `hash` text COLLATE utf8mb4_unicode_ci,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=419 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.attachments: ~183 rows (приблизительно)
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
INSERT INTO `attachments` (`id`, `name`, `original_name`, `mime`, `extension`, `size`, `sort`, `path`, `description`, `alt`, `hash`, `disk`, `user_id`, `group`, `created_at`, `updated_at`) VALUES
	(212, 'e127329303648e310e6aa39cd5c34ac405cec813', 'zhivotnye_sobaka_ochki_7238.jpg', 'image/jpeg', 'jpg', 72257, 0, '2019/05/07\\', NULL, NULL, '77b4bfb7a26e5a21e22b4fd62bcf0a0b2512a3ee', 'public', 1, NULL, '2019-05-07 16:33:23', '2019-05-07 16:33:23'),
	(213, 'e127329303648e310e6aa39cd5c34ac405cec813', 'zhivotnye_sobaka_ochki_7238.jpg', 'image/jpeg', 'jpg', 72257, 0, '2019/05/07\\', NULL, NULL, '77b4bfb7a26e5a21e22b4fd62bcf0a0b2512a3ee', 'public', 1, NULL, '2019-05-07 16:33:35', '2019-05-07 16:33:35'),
	(214, '2b84f2b5ed4f8a3eafb3257166bf4ddf0f5dbdad', 'blob', 'image/png', 'png', 8178137, 0, '2019/05/07\\', NULL, NULL, '5664d44521ecb266079ed3e3562a1010d13a2987', 'public', 1, NULL, '2019-05-07 16:35:56', '2019-05-07 16:35:56'),
	(215, 'dea180b2c3ab76c1aad10e509844124ea941985b', 'blob', 'image/jpeg', 'jpg', 707072, 0, '2019/05/07\\', NULL, NULL, '907d20f1d20db7c4690cb75c04ad4906deaa666b', 'public', 1, NULL, '2019-05-07 16:36:13', '2019-05-07 16:36:13'),
	(216, 'e127329303648e310e6aa39cd5c34ac405cec813', 'zhivotnye_sobaka_ochki_7238.jpg', 'image/jpeg', 'jpg', 72257, 0, '2019/05/07\\', NULL, NULL, '77b4bfb7a26e5a21e22b4fd62bcf0a0b2512a3ee', 'public', 1, NULL, '2019-05-07 16:36:27', '2019-05-07 16:36:27'),
	(217, 'e127329303648e310e6aa39cd5c34ac405cec813', 'zhivotnye_sobaka_ochki_7238.jpg', 'image/jpeg', 'jpg', 72257, 0, '2019/05/07\\', NULL, NULL, '77b4bfb7a26e5a21e22b4fd62bcf0a0b2512a3ee', 'public', 1, NULL, '2019-05-07 16:36:53', '2019-05-07 16:36:53'),
	(218, 'e127329303648e310e6aa39cd5c34ac405cec813', 'zhivotnye_sobaka_ochki_7238.jpg', 'image/jpeg', 'jpg', 72257, 0, '2019/05/07\\', NULL, NULL, '77b4bfb7a26e5a21e22b4fd62bcf0a0b2512a3ee', 'public', 1, NULL, '2019-05-07 16:38:26', '2019-05-07 16:38:26'),
	(219, 'e127329303648e310e6aa39cd5c34ac405cec813', 'zhivotnye_sobaka_ochki_7238.jpg', 'image/jpeg', 'jpg', 72257, 0, '2019/05/07\\', NULL, NULL, '77b4bfb7a26e5a21e22b4fd62bcf0a0b2512a3ee', 'public', 1, NULL, '2019-05-07 16:38:51', '2019-05-07 16:38:51'),
	(220, 'e127329303648e310e6aa39cd5c34ac405cec813', 'zhivotnye_sobaka_ochki_7238.jpg', 'image/jpeg', 'jpg', 72257, 0, '2019/05/07\\', NULL, NULL, '77b4bfb7a26e5a21e22b4fd62bcf0a0b2512a3ee', 'public', 1, NULL, '2019-05-07 16:38:58', '2019-05-07 16:38:58'),
	(221, 'e127329303648e310e6aa39cd5c34ac405cec813', 'zhivotnye_sobaka_ochki_7238.jpg', 'image/jpeg', 'jpg', 72257, 0, '2019/05/07\\', NULL, NULL, '77b4bfb7a26e5a21e22b4fd62bcf0a0b2512a3ee', 'public', 1, NULL, '2019-05-07 16:39:30', '2019-05-07 16:39:30'),
	(222, 'e127329303648e310e6aa39cd5c34ac405cec813', 'zhivotnye_sobaka_ochki_7238.jpg', 'image/jpeg', 'jpg', 72257, 0, '2019/05/07\\', NULL, NULL, '77b4bfb7a26e5a21e22b4fd62bcf0a0b2512a3ee', 'public', 1, NULL, '2019-05-07 16:40:25', '2019-05-07 16:40:25'),
	(223, 'dea180b2c3ab76c1aad10e509844124ea941985b', 'blob', 'image/jpeg', 'jpg', 707072, 0, '2019/05/07\\', NULL, NULL, '907d20f1d20db7c4690cb75c04ad4906deaa666b', 'public', 1, NULL, '2019-05-07 17:23:36', '2019-05-07 17:23:36'),
	(224, '2b84f2b5ed4f8a3eafb3257166bf4ddf0f5dbdad', 'blob', 'image/png', 'png', 8178137, 0, '2019/05/07\\', NULL, NULL, '5664d44521ecb266079ed3e3562a1010d13a2987', 'public', 1, NULL, '2019-05-07 17:24:28', '2019-05-07 17:24:28'),
	(225, 'e127329303648e310e6aa39cd5c34ac405cec813', 'zhivotnye_sobaka_ochki_7238.jpg', 'image/jpeg', 'jpg', 72257, 0, '2019/05/07\\', NULL, NULL, '77b4bfb7a26e5a21e22b4fd62bcf0a0b2512a3ee', 'public', 1, NULL, '2019-05-07 17:25:55', '2019-05-07 17:25:55'),
	(226, '2b84f2b5ed4f8a3eafb3257166bf4ddf0f5dbdad', 'blob', 'image/png', 'png', 8178137, 0, '2019/05/07\\', NULL, NULL, '5664d44521ecb266079ed3e3562a1010d13a2987', 'public', 1, NULL, '2019-05-07 17:26:11', '2019-05-07 17:26:11'),
	(227, 'e58dfe0313a3a5769922df4ffcaac357e3f61be1', 'blob', 'image/jpeg', 'jpg', 398547, 0, '2019/05/07\\', NULL, NULL, '905a95cde4a2569bf172ea68c5367f66074af3e4', 'public', 1, NULL, '2019-05-07 17:44:29', '2019-05-07 17:44:29'),
	(228, 'e127329303648e310e6aa39cd5c34ac405cec813', 'zhivotnye_sobaka_ochki_7238.jpg', 'image/jpeg', 'jpg', 72257, 0, '2019/05/07\\', NULL, NULL, '77b4bfb7a26e5a21e22b4fd62bcf0a0b2512a3ee', 'public', 1, NULL, '2019-05-07 17:44:43', '2019-05-07 17:44:43'),
	(229, 'dea180b2c3ab76c1aad10e509844124ea941985b', 'blob', 'image/jpeg', 'jpg', 707072, 0, '2019/05/07\\', NULL, NULL, '907d20f1d20db7c4690cb75c04ad4906deaa666b', 'public', 1, NULL, '2019-05-07 17:46:06', '2019-05-07 17:46:06'),
	(230, 'e127329303648e310e6aa39cd5c34ac405cec813', 'zhivotnye_sobaka_ochki_7238.jpg', 'image/jpeg', 'jpg', 72257, 0, '2019/05/07\\', NULL, NULL, '77b4bfb7a26e5a21e22b4fd62bcf0a0b2512a3ee', 'public', 1, NULL, '2019-05-07 17:47:05', '2019-05-07 17:47:05'),
	(231, 'e127329303648e310e6aa39cd5c34ac405cec813', 'zhivotnye_sobaka_ochki_7238.jpg', 'image/jpeg', 'jpg', 72257, 0, '2019/05/07\\', NULL, NULL, '77b4bfb7a26e5a21e22b4fd62bcf0a0b2512a3ee', 'public', 1, NULL, '2019-05-07 17:48:12', '2019-07-16 20:50:07'),
	(232, 'e127329303648e310e6aa39cd5c34ac405cec813', 'zhivotnye_sobaka_ochki_7238.jpg', 'image/jpeg', 'jpg', 72257, 0, '2019/05/07\\', NULL, NULL, '77b4bfb7a26e5a21e22b4fd62bcf0a0b2512a3ee', 'public', 1, NULL, '2019-05-07 22:53:22', '2019-05-07 22:53:22'),
	(233, '3093c24c7c8a9519d7f181d6b8b8e9cd04499220', 'blob', 'image/jpeg', 'jpg', 70218, 0, '2019/06/26\\', NULL, NULL, '44720ae1dbd9a2946ce2685b836535203e638db3', 'public', 1, NULL, '2019-06-26 21:43:41', '2019-06-26 21:43:41'),
	(234, '93a55e1ef3cf0d0e2a7ffef50ffbb96ecc25347d', 'blob', 'image/jpeg', 'jpg', 73776, 0, '2019/06/26\\', NULL, NULL, 'f7308692c0cc5664ea40e1f06e2afb01a4ea42fa', 'public', 1, NULL, '2019-06-26 21:43:47', '2019-06-26 21:43:47'),
	(235, '037d95b52ed180fa2c8d35b2ad0eb2ca04a0d0a1', '9S5PIhuyxyE.jpg', 'image/jpeg', 'jpg', 56586, 0, '2019/06/26\\', NULL, NULL, 'da5c7c2e61d2f5230da38e1533d273f597e99618', 'public', 1, NULL, '2019-06-26 21:55:06', '2019-06-26 21:55:06'),
	(236, 'c73e560e3150440aea727571564cef4a266348e5', 'blob', 'image/jpeg', 'jpg', 371612, 0, '2019/06/30\\', NULL, NULL, '39f01103dbceb18a7e6d465cd21b4ee3ef8636cc', 'public', 1, NULL, '2019-06-30 20:36:36', '2019-06-30 20:36:36'),
	(237, '25b1c1d99cde6314c6cdaaed809bb52a8cdc851a', '__sendai_kantai_collection_drawn_by_morigami_morigami_no_yashiro__ce5a7243a3f34be50d1492163532cfff.png', 'image/png', 'png', 852357, 0, '2019/07/16\\', NULL, NULL, '7b141ee0b01973e86f1ed4cd98f0bf9424477061', 'public', 1, NULL, '2019-07-16 20:50:43', '2019-07-18 20:11:51'),
	(238, '77a9907279c974d8de8a9e92a422e5b8686a188a', 'blob', 'image/jpeg', 'jpg', 310353, 0, '2019/07/18\\', NULL, NULL, 'c55e895ce84caefe7ff52ff401347c2751019a04', 'public', 1, NULL, '2019-07-18 21:27:59', '2019-07-18 21:27:59'),
	(239, '517c341d37d1fe842c5a152ba93857b0a5bb2033', 'blob', 'image/jpeg', 'jpg', 1450257, 0, '2019/07/18\\', NULL, NULL, '33baa850c38d67faf08085a857ac9189a4abcae5', 'public', 1, NULL, '2019-07-18 21:29:01', '2019-07-18 21:29:01'),
	(240, '517c341d37d1fe842c5a152ba93857b0a5bb2033', 'blob', 'image/jpeg', 'jpg', 1450257, 0, '2019/07/18\\', NULL, NULL, '33baa850c38d67faf08085a857ac9189a4abcae5', 'public', 1, NULL, '2019-07-18 22:01:11', '2019-07-18 22:01:11'),
	(241, '26e52c57d3e692d0648455b296dee41400cd23bf', 'ApQBUKlKAM1cgr4qiHPBc8IuAseqe6xReMdR8uKY.jpeg', 'image/jpeg', 'jpeg', 200042, 0, '2019/07/20\\', NULL, NULL, 'c82d1cfeecf8af0027096bcc838e0b1cb793b4a7', 'public', 1, NULL, '2019-07-20 21:13:24', '2019-07-20 21:13:24'),
	(242, '26e52c57d3e692d0648455b296dee41400cd23bf', 'ApQBUKlKAM1cgr4qiHPBc8IuAseqe6xReMdR8uKY.jpeg', 'image/jpeg', 'jpeg', 200042, 0, '2019/07/20\\', NULL, NULL, 'c82d1cfeecf8af0027096bcc838e0b1cb793b4a7', 'public', 1, NULL, '2019-07-20 22:03:38', '2019-07-20 22:03:38'),
	(243, '26e52c57d3e692d0648455b296dee41400cd23bf', 'ApQBUKlKAM1cgr4qiHPBc8IuAseqe6xReMdR8uKY.jpeg', 'image/jpeg', 'jpeg', 200042, 0, '2019/07/20\\', NULL, NULL, 'c82d1cfeecf8af0027096bcc838e0b1cb793b4a7', 'public', 1, NULL, '2019-07-20 22:06:00', '2019-07-20 22:06:00'),
	(244, '26e52c57d3e692d0648455b296dee41400cd23bf', 'ApQBUKlKAM1cgr4qiHPBc8IuAseqe6xReMdR8uKY.jpeg', 'image/jpeg', 'jpeg', 200042, 0, '2019/07/20\\', NULL, NULL, 'c82d1cfeecf8af0027096bcc838e0b1cb793b4a7', 'public', 1, NULL, '2019-07-20 22:06:49', '2019-07-20 22:06:49'),
	(245, '26e52c57d3e692d0648455b296dee41400cd23bf', 'ApQBUKlKAM1cgr4qiHPBc8IuAseqe6xReMdR8uKY.jpeg', 'image/jpeg', 'jpeg', 200042, 0, '2019/07/20\\', NULL, NULL, 'c82d1cfeecf8af0027096bcc838e0b1cb793b4a7', 'public', 1, NULL, '2019-07-20 22:09:13', '2019-07-20 22:09:13'),
	(246, '26e52c57d3e692d0648455b296dee41400cd23bf', 'ApQBUKlKAM1cgr4qiHPBc8IuAseqe6xReMdR8uKY.jpeg', 'image/jpeg', 'jpeg', 200042, 0, '2019/07/20\\', NULL, NULL, 'c82d1cfeecf8af0027096bcc838e0b1cb793b4a7', 'public', 1, NULL, '2019-07-20 22:09:49', '2019-07-20 22:09:49'),
	(247, 'b80144d8ec4f2bab02b32eb93fc29fe779bb70b9', 'e127329303648e310e6aa39cd5c34ac405cec813 (2).jpg', 'image/jpeg', 'jpg', 5578, 0, '2019/07/23\\', NULL, NULL, '8402be7ea62184d5fbb4d68fc69d760d406d15c6', 'public', 1, NULL, '2019-07-23 12:38:42', '2019-07-23 12:38:42'),
	(248, '26e52c57d3e692d0648455b296dee41400cd23bf', 'ApQBUKlKAM1cgr4qiHPBc8IuAseqe6xReMdR8uKY.jpeg', 'image/jpeg', 'jpeg', 200042, 0, '2019/07/20\\', NULL, NULL, 'c82d1cfeecf8af0027096bcc838e0b1cb793b4a7', 'public', 1, NULL, '2019-07-23 12:39:29', '2019-07-23 12:39:29'),
	(249, '26e52c57d3e692d0648455b296dee41400cd23bf', 'ApQBUKlKAM1cgr4qiHPBc8IuAseqe6xReMdR8uKY.jpeg', 'image/jpeg', 'jpeg', 200042, 0, '2019/07/20\\', NULL, NULL, 'c82d1cfeecf8af0027096bcc838e0b1cb793b4a7', 'public', 1, NULL, '2019-07-23 12:41:43', '2019-07-23 12:41:43'),
	(250, '26e52c57d3e692d0648455b296dee41400cd23bf', 'ApQBUKlKAM1cgr4qiHPBc8IuAseqe6xReMdR8uKY.jpeg', 'image/jpeg', 'jpeg', 200042, 0, '2019/07/20\\', NULL, NULL, 'c82d1cfeecf8af0027096bcc838e0b1cb793b4a7', 'public', 1, NULL, '2019-07-23 12:43:10', '2019-07-23 12:43:10'),
	(251, '26e52c57d3e692d0648455b296dee41400cd23bf', 'ApQBUKlKAM1cgr4qiHPBc8IuAseqe6xReMdR8uKY.jpeg', 'image/jpeg', 'jpeg', 200042, 0, '2019/07/20\\', NULL, NULL, 'c82d1cfeecf8af0027096bcc838e0b1cb793b4a7', 'public', 1, NULL, '2019-07-23 12:43:37', '2019-07-23 12:43:37'),
	(252, '26e52c57d3e692d0648455b296dee41400cd23bf', 'ApQBUKlKAM1cgr4qiHPBc8IuAseqe6xReMdR8uKY.jpeg', 'image/jpeg', 'jpeg', 200042, 0, '2019/07/20\\', NULL, NULL, 'c82d1cfeecf8af0027096bcc838e0b1cb793b4a7', 'public', 1, NULL, '2019-07-23 12:44:23', '2019-07-23 12:44:23'),
	(253, '26e52c57d3e692d0648455b296dee41400cd23bf', 'ApQBUKlKAM1cgr4qiHPBc8IuAseqe6xReMdR8uKY.jpeg', 'image/jpeg', 'jpeg', 200042, 0, '2019/07/20\\', NULL, NULL, 'c82d1cfeecf8af0027096bcc838e0b1cb793b4a7', 'public', 1, NULL, '2019-07-23 12:45:17', '2019-07-23 12:45:17'),
	(254, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:00:21', '2019-08-13 20:00:21'),
	(255, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:01:43', '2019-08-13 20:01:43'),
	(256, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:15:35', '2019-08-13 20:15:35'),
	(257, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:16:12', '2019-08-13 20:16:12'),
	(258, '0095f67412feba31a39217cd1c8d03c04838e78e', '2e1e1bf6e0113da584cd60d0fbaf5ae7.png', 'image/png', 'png', 553247, 0, '2019/08/13\\', NULL, NULL, 'b1b70790890ce6ba1f44a4ca690c1611b2897fdf', 'public', NULL, NULL, '2019-08-13 20:18:16', '2019-08-13 20:18:16'),
	(259, '704ad2d049747b71aba81b67d9b31aaed34de32f', '1cf4de03b1a6b710cbe2f03ff1056323.jpeg', 'image/jpeg', 'jpeg', 467245, 0, '2019/08/13\\', NULL, NULL, '092ef67699a44762579f8260a0fd28b6ae2bd783', 'public', NULL, NULL, '2019-08-13 20:19:04', '2019-08-13 20:19:04'),
	(260, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:22:06', '2019-08-13 20:22:06'),
	(261, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:23:01', '2019-08-13 20:23:01'),
	(262, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:23:09', '2019-08-13 20:23:09'),
	(263, '704ad2d049747b71aba81b67d9b31aaed34de32f', '1cf4de03b1a6b710cbe2f03ff1056323.jpeg', 'image/jpeg', 'jpeg', 467245, 0, '2019/08/13\\', NULL, NULL, '092ef67699a44762579f8260a0fd28b6ae2bd783', 'public', NULL, NULL, '2019-08-13 20:24:25', '2019-08-13 20:24:25'),
	(264, 'd1b4ceaaf95379ba859fa271e8f8c718b178f57b', '1ae3ec1b012bcf9eae5564c0916f4124.png', 'image/png', 'png', 1253485, 0, '2019/08/13\\', NULL, NULL, 'bab0f50ce123da00d23289e29239bbca6d589fb7', 'public', NULL, NULL, '2019-08-13 20:25:36', '2019-08-13 20:25:36'),
	(265, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:27:11', '2019-08-13 20:27:11'),
	(266, '704ad2d049747b71aba81b67d9b31aaed34de32f', '1cf4de03b1a6b710cbe2f03ff1056323.jpeg', 'image/jpeg', 'jpeg', 467245, 0, '2019/08/13\\', NULL, NULL, '092ef67699a44762579f8260a0fd28b6ae2bd783', 'public', NULL, NULL, '2019-08-13 20:27:30', '2019-08-13 20:27:30'),
	(267, '704ad2d049747b71aba81b67d9b31aaed34de32f', '1cf4de03b1a6b710cbe2f03ff1056323.jpeg', 'image/jpeg', 'jpeg', 467245, 0, '2019/08/13\\', NULL, NULL, '092ef67699a44762579f8260a0fd28b6ae2bd783', 'public', NULL, NULL, '2019-08-13 20:30:11', '2019-08-13 20:30:11'),
	(268, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:30:43', '2019-08-13 20:30:43'),
	(269, '0095f67412feba31a39217cd1c8d03c04838e78e', '2e1e1bf6e0113da584cd60d0fbaf5ae7.png', 'image/png', 'png', 553247, 0, '2019/08/13\\', NULL, NULL, 'b1b70790890ce6ba1f44a4ca690c1611b2897fdf', 'public', NULL, NULL, '2019-08-13 20:31:40', '2019-08-13 20:31:40'),
	(270, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:32:05', '2019-08-13 20:32:05'),
	(271, '704ad2d049747b71aba81b67d9b31aaed34de32f', '1cf4de03b1a6b710cbe2f03ff1056323.jpeg', 'image/jpeg', 'jpeg', 467245, 0, '2019/08/13\\', NULL, NULL, '092ef67699a44762579f8260a0fd28b6ae2bd783', 'public', NULL, NULL, '2019-08-13 20:33:06', '2019-08-13 20:33:06'),
	(272, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:34:15', '2019-08-13 20:34:15'),
	(273, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:34:59', '2019-08-13 20:34:59'),
	(274, '704ad2d049747b71aba81b67d9b31aaed34de32f', '1cf4de03b1a6b710cbe2f03ff1056323.jpeg', 'image/jpeg', 'jpeg', 467245, 0, '2019/08/13\\', NULL, NULL, '092ef67699a44762579f8260a0fd28b6ae2bd783', 'public', NULL, NULL, '2019-08-13 20:35:08', '2019-08-13 20:35:08'),
	(275, '704ad2d049747b71aba81b67d9b31aaed34de32f', '1cf4de03b1a6b710cbe2f03ff1056323.jpeg', 'image/jpeg', 'jpeg', 467245, 0, '2019/08/13\\', NULL, NULL, '092ef67699a44762579f8260a0fd28b6ae2bd783', 'public', NULL, NULL, '2019-08-13 20:36:43', '2019-08-13 20:36:43'),
	(276, '704ad2d049747b71aba81b67d9b31aaed34de32f', '1cf4de03b1a6b710cbe2f03ff1056323.jpeg', 'image/jpeg', 'jpeg', 467245, 0, '2019/08/13\\', NULL, NULL, '092ef67699a44762579f8260a0fd28b6ae2bd783', 'public', NULL, NULL, '2019-08-13 20:37:16', '2019-08-13 20:37:16'),
	(277, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:40:49', '2019-08-13 20:40:49'),
	(278, 'd1b4ceaaf95379ba859fa271e8f8c718b178f57b', '1ae3ec1b012bcf9eae5564c0916f4124.png', 'image/png', 'png', 1253485, 0, '2019/08/13\\', NULL, NULL, 'bab0f50ce123da00d23289e29239bbca6d589fb7', 'public', NULL, NULL, '2019-08-13 20:44:43', '2019-08-13 20:44:43'),
	(279, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:47:36', '2019-08-13 20:47:36'),
	(280, '0095f67412feba31a39217cd1c8d03c04838e78e', '2e1e1bf6e0113da584cd60d0fbaf5ae7.png', 'image/png', 'png', 553247, 0, '2019/08/13\\', NULL, NULL, 'b1b70790890ce6ba1f44a4ca690c1611b2897fdf', 'public', NULL, NULL, '2019-08-13 20:47:44', '2019-08-13 20:47:44'),
	(281, '704ad2d049747b71aba81b67d9b31aaed34de32f', '1cf4de03b1a6b710cbe2f03ff1056323.jpeg', 'image/jpeg', 'jpeg', 467245, 0, '2019/08/13\\', NULL, NULL, '092ef67699a44762579f8260a0fd28b6ae2bd783', 'public', NULL, NULL, '2019-08-13 20:48:08', '2019-08-13 20:48:08'),
	(282, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:48:08', '2019-08-13 20:48:08'),
	(283, '0095f67412feba31a39217cd1c8d03c04838e78e', '2e1e1bf6e0113da584cd60d0fbaf5ae7.png', 'image/png', 'png', 553247, 0, '2019/08/13\\', NULL, NULL, 'b1b70790890ce6ba1f44a4ca690c1611b2897fdf', 'public', NULL, NULL, '2019-08-13 20:48:11', '2019-08-13 20:48:11'),
	(284, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:49:23', '2019-08-13 20:49:23'),
	(285, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:52:26', '2019-08-13 20:52:26'),
	(286, '704ad2d049747b71aba81b67d9b31aaed34de32f', '1cf4de03b1a6b710cbe2f03ff1056323.jpeg', 'image/jpeg', 'jpeg', 467245, 0, '2019/08/13\\', NULL, NULL, '092ef67699a44762579f8260a0fd28b6ae2bd783', 'public', NULL, NULL, '2019-08-13 20:56:13', '2019-08-13 20:56:13'),
	(287, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:56:21', '2019-08-13 20:56:21'),
	(288, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:58:42', '2019-08-13 20:58:42'),
	(289, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-13 20:59:33', '2019-08-13 20:59:33'),
	(290, '9469c633bdb06c6a5f8c42db75532e5c99a005f8', '4b043db3a0bb6758d0621eb1d6b99bc6-sample.jpg', 'image/jpeg', 'jpg', 64281, 0, '2019/08/14\\', NULL, NULL, '1520e7c61db14eb3805f54cf3f2a7abd7e4207f4', 'public', NULL, NULL, '2019-08-14 20:37:54', '2019-08-14 20:37:54'),
	(291, '6800bda0c66134b8eadf04bed54688abbc1f7f13', '4d9adee8dfa70ca9e42c7347f8e1bbc9.jpg', 'image/jpeg', 'jpg', 284952, 0, '2019/08/14\\', NULL, NULL, 'f95cbeeb576eac6738674bc756f0658044f8be0f', 'public', NULL, NULL, '2019-08-14 20:38:55', '2019-08-14 20:38:55'),
	(292, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-14 20:39:09', '2019-08-14 20:39:09'),
	(293, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-14 20:39:27', '2019-08-14 20:39:27'),
	(294, '0d65889f5144d31fc63c8f8d0c7457f57941804a', '70dfe7a07c6b84362817825db547ec63.jpg', 'image/jpeg', 'jpg', 229760, 0, '2019/08/14\\', NULL, NULL, 'b5872c017d863b208cfa3298314ef4d09ed5768b', 'public', NULL, NULL, '2019-08-14 20:39:47', '2019-08-14 20:39:47'),
	(295, '706ac559546efe4f3cbf8b3f98f64e3661490f4a', '4f6b86a3fc9b572e0273ba3774a64b21-sample.jpg', 'image/jpeg', 'jpg', 100826, 0, '2019/08/14\\', NULL, NULL, '0db07161f8520c9b83606c776ab9acb762d64b17', 'public', NULL, NULL, '2019-08-14 20:41:14', '2019-08-14 20:41:14'),
	(296, 'fed28111e3e7c09c1a6415dd1cdb3c4c27e01fe2', 'b6376cc7f413626dd969bea755f89025.jpg', 'image/jpeg', 'jpg', 97511, 0, '2019/08/17\\', NULL, NULL, '67298af423b98cbef56102577b0f1db5a3b98149', 'public', NULL, NULL, '2019-08-17 09:51:10', '2019-08-17 09:51:10'),
	(297, 'd1b4ceaaf95379ba859fa271e8f8c718b178f57b', '1ae3ec1b012bcf9eae5564c0916f4124.png', 'image/png', 'png', 1253485, 0, '2019/08/13\\', NULL, NULL, 'bab0f50ce123da00d23289e29239bbca6d589fb7', 'public', NULL, NULL, '2019-08-17 09:57:23', '2019-08-17 09:57:23'),
	(298, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-17 10:09:53', '2019-08-17 10:09:53'),
	(299, 'dd12207d7da2d80dc25f3101c622d9855f533ce8', '2f6a49dba43e995c1c77ea49de803ca5.png', 'image/png', 'png', 959330, 0, '2019/08/17\\', NULL, NULL, '90437e94682c844087f6b56317f6a1d86f2e5ff5', 'public', NULL, NULL, '2019-08-17 10:15:23', '2019-08-17 10:15:23'),
	(300, '0095f67412feba31a39217cd1c8d03c04838e78e', '2e1e1bf6e0113da584cd60d0fbaf5ae7.png', 'image/png', 'png', 553247, 0, '2019/08/13\\', NULL, NULL, 'b1b70790890ce6ba1f44a4ca690c1611b2897fdf', 'public', NULL, NULL, '2019-08-17 10:15:26', '2019-08-17 10:15:26'),
	(301, '6c7c0d133cff9d5f28cb9ac8678da72283f8ec4f', '4a523f797da6cd19efa02c467970361d-sample.jpg', 'image/jpeg', 'jpg', 119580, 0, '2019/08/17\\', NULL, NULL, '14ede4f2020a599e2e4242b808a34b91fdc9aaa0', 'public', NULL, NULL, '2019-08-17 10:41:57', '2019-08-17 10:41:57'),
	(302, '9469c633bdb06c6a5f8c42db75532e5c99a005f8', '4b043db3a0bb6758d0621eb1d6b99bc6-sample.jpg', 'image/jpeg', 'jpg', 64281, 0, '2019/08/14\\', NULL, NULL, '1520e7c61db14eb3805f54cf3f2a7abd7e4207f4', 'public', NULL, NULL, '2019-08-17 10:42:02', '2019-08-17 10:42:02'),
	(303, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-17 10:44:47', '2019-08-17 10:44:47'),
	(304, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-17 10:45:59', '2019-08-17 10:45:59'),
	(305, 'd1b4ceaaf95379ba859fa271e8f8c718b178f57b', '1ae3ec1b012bcf9eae5564c0916f4124.png', 'image/png', 'png', 1253485, 0, '2019/08/13\\', NULL, NULL, 'bab0f50ce123da00d23289e29239bbca6d589fb7', 'public', NULL, NULL, '2019-08-17 10:46:34', '2019-08-17 10:46:34'),
	(306, 'd1b4ceaaf95379ba859fa271e8f8c718b178f57b', '1ae3ec1b012bcf9eae5564c0916f4124.png', 'image/png', 'png', 1253485, 0, '2019/08/13\\', NULL, NULL, 'bab0f50ce123da00d23289e29239bbca6d589fb7', 'public', NULL, NULL, '2019-08-17 10:47:42', '2019-08-17 10:47:42'),
	(307, '704ad2d049747b71aba81b67d9b31aaed34de32f', '1cf4de03b1a6b710cbe2f03ff1056323.jpeg', 'image/jpeg', 'jpeg', 467245, 0, '2019/08/13\\', NULL, NULL, '092ef67699a44762579f8260a0fd28b6ae2bd783', 'public', NULL, NULL, '2019-08-17 10:48:50', '2019-08-17 10:48:50'),
	(308, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-17 10:50:01', '2019-08-17 10:50:01'),
	(309, 'd1b4ceaaf95379ba859fa271e8f8c718b178f57b', '1ae3ec1b012bcf9eae5564c0916f4124.png', 'image/png', 'png', 1253485, 0, '2019/08/13\\', NULL, NULL, 'bab0f50ce123da00d23289e29239bbca6d589fb7', 'public', NULL, NULL, '2019-08-17 10:50:18', '2019-08-17 10:50:18'),
	(310, 'dd12207d7da2d80dc25f3101c622d9855f533ce8', '2f6a49dba43e995c1c77ea49de803ca5.png', 'image/png', 'png', 959330, 0, '2019/08/17\\', NULL, NULL, '90437e94682c844087f6b56317f6a1d86f2e5ff5', 'public', NULL, NULL, '2019-08-17 10:50:32', '2019-08-17 10:50:32'),
	(311, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', NULL, NULL, '2019-08-17 10:52:05', '2019-08-17 10:52:05'),
	(312, '9469c633bdb06c6a5f8c42db75532e5c99a005f8', '4b043db3a0bb6758d0621eb1d6b99bc6-sample.jpg', 'image/jpeg', 'jpg', 64281, 0, '2019/08/14\\', NULL, NULL, '1520e7c61db14eb3805f54cf3f2a7abd7e4207f4', 'public', NULL, NULL, '2019-08-17 10:52:17', '2019-08-17 10:52:17'),
	(313, 'd1b4ceaaf95379ba859fa271e8f8c718b178f57b', '1ae3ec1b012bcf9eae5564c0916f4124.png', 'image/png', 'png', 1253485, 0, '2019/08/13\\', NULL, NULL, 'bab0f50ce123da00d23289e29239bbca6d589fb7', 'public', NULL, NULL, '2019-08-17 10:53:21', '2019-08-17 10:53:21'),
	(314, '6c7c0d133cff9d5f28cb9ac8678da72283f8ec4f', '4a523f797da6cd19efa02c467970361d-sample.jpg', 'image/jpeg', 'jpg', 119580, 0, '2019/08/17\\', NULL, NULL, '14ede4f2020a599e2e4242b808a34b91fdc9aaa0', 'public', NULL, NULL, '2019-08-17 10:53:30', '2019-08-17 10:53:30'),
	(315, 'dd12207d7da2d80dc25f3101c622d9855f533ce8', '2f6a49dba43e995c1c77ea49de803ca5.png', 'image/png', 'png', 959330, 0, '2019/08/17\\', NULL, NULL, '90437e94682c844087f6b56317f6a1d86f2e5ff5', 'public', NULL, NULL, '2019-08-28 21:10:53', '2019-08-28 21:10:53'),
	(316, '6fc1b6865d4ff6b5905a8bfae91ad848c49bec97', '0cbe108caaf76daf14cf0368039759a3.png', 'image/png', 'png', 859139, 0, '2019/08/28\\', NULL, NULL, 'fccb8d6ee754eeab3b7d5e74671f1c0bf69e5d7c', 'public', NULL, NULL, '2019-08-28 21:10:53', '2019-08-28 21:10:53'),
	(317, '22ff666b772b33716bb4f37b34279d4281f584c2', '51d1f7c8aa2d2fb99a07d4744a1f1737.png', 'image/png', 'png', 372268, 0, '2019/08/28\\', NULL, NULL, 'b979ec371101233278a1cc35d9d295adb4f66c21', 'public', 1, NULL, '2019-08-28 21:11:50', '2019-08-28 21:11:50'),
	(318, 'e222988ea3e14bc073ac8920a293456aabe5d6cd', '37c678bdc86dfcf0e7df3b00e7be62fd.png', 'image/png', 'png', 407836, 0, '2019/08/28\\', NULL, NULL, 'bd043d5de5abffff31868fe9799fb33630f5118e', 'public', 1, NULL, '2019-08-28 21:11:50', '2019-08-28 21:11:50'),
	(319, '6fc1b6865d4ff6b5905a8bfae91ad848c49bec97', '0cbe108caaf76daf14cf0368039759a3.png', 'image/png', 'png', 859139, 0, '2019/08/28\\', NULL, NULL, 'fccb8d6ee754eeab3b7d5e74671f1c0bf69e5d7c', 'public', 1, NULL, '2019-08-28 21:13:37', '2019-08-28 21:13:37'),
	(320, '31ecc176918f76f5d41a5e680d7376446793e254', '2c8e4fca9679a29e059ddd3b6cc4a7df.jpg', 'image/jpeg', 'jpg', 479985, 0, '2019/08/13\\', NULL, NULL, '37ed6bc9f5b44264cfda0d6a575743cbddd99a67', 'public', 1, NULL, '2019-08-28 21:13:37', '2019-08-28 21:13:37'),
	(321, 'ff1bf932076b3d76640063efda0e0ea06f6a129a', '0b301a30f9120a807e69d034f8b7977a.jpg', 'image/jpeg', 'jpg', 1666491, 0, '2019/09/05\\', NULL, NULL, '6d36c16ced17b35923e1f77b07f177f31427d5bd', 'public', 1, NULL, '2019-09-05 00:13:54', '2019-09-05 00:13:54'),
	(322, 'ff1bf932076b3d76640063efda0e0ea06f6a129a', '0b301a30f9120a807e69d034f8b7977a.jpg', 'image/jpeg', 'jpg', 1666491, 0, '2019/09/05\\', NULL, NULL, '6d36c16ced17b35923e1f77b07f177f31427d5bd', 'public', 1, NULL, '2019-09-05 00:15:25', '2019-09-05 00:15:25'),
	(323, 'ff1bf932076b3d76640063efda0e0ea06f6a129a', '0b301a30f9120a807e69d034f8b7977a.jpg', 'image/jpeg', 'jpg', 1666491, 0, '2019/09/05\\', NULL, NULL, '6d36c16ced17b35923e1f77b07f177f31427d5bd', 'public', 1, NULL, '2019-09-06 00:14:22', '2019-09-06 00:14:22'),
	(324, 'b0e0fc4050401f46c35bd21eaa73b03eeb9664fc', 'IMG_20191015_185658.jpg', 'image/jpeg', 'jpg', 481364, 0, '2019/10/27\\', NULL, NULL, 'b56c60d42d53d27e5fac22f39da3bec3bb50afae', 'public', NULL, NULL, '2019-10-27 21:07:58', '2019-10-27 21:07:58'),
	(325, '87bbc3973fe99ea95b9c56fe7c4100be27a5d1c8', 'roFaLDocSPc.jpg', 'image/jpeg', 'jpg', 116716, 0, '2019/10/27\\', NULL, NULL, '16c3bea7257cc0ca8780377dac031f06d052f4c8', 'public', NULL, NULL, '2019-10-27 22:53:47', '2019-10-27 22:53:47'),
	(326, '92f53676bc987987658a9f8dfe011d3eb5ac26e8', '6aaddeed5d51d30bc490ca2f6c31dd71.jpg', 'image/jpeg', 'jpg', 241111, 0, '2019/10/27\\', NULL, NULL, '0e48a4e68c94aaa0633b38096678ef7c20988ce4', 'public', NULL, NULL, '2019-10-27 22:53:47', '2019-10-27 22:53:47'),
	(327, '95cf879b045aaa86a6691398bbc7b903e50de1f9', 'W4Cf86bBCPQ.jpg', 'image/jpeg', 'jpg', 118629, 0, '2019/10/27\\', NULL, NULL, '2a80d9218b84edc80aae6ebaaaa48bba54766427', 'public', NULL, NULL, '2019-10-27 22:54:54', '2019-10-27 22:54:54'),
	(328, '7d12893ce5f08194503138df6c8a7bef890a9281', 'illust_77410170_20191022_005617.png', 'image/png', 'png', 1100266, 0, '2019/10/27\\', NULL, NULL, '83630425e6b426103597612803fabfb950bd51b2', 'public', NULL, NULL, '2019-10-27 22:54:54', '2019-10-27 22:54:54'),
	(329, '95cf879b045aaa86a6691398bbc7b903e50de1f9', 'W4Cf86bBCPQ.jpg', 'image/jpeg', 'jpg', 118629, 0, '2019/10/27\\', NULL, NULL, '2a80d9218b84edc80aae6ebaaaa48bba54766427', 'public', NULL, NULL, '2019-10-27 23:04:50', '2019-10-27 23:04:50'),
	(330, 'debf6ffed00d69bb866ee7227c041aa83ddda254', 'illust_77293110_20191014_201120.jpg', 'image/jpeg', 'jpg', 614395, 0, '2019/10/27\\', NULL, NULL, '61c91ff3ff4f2878400554a4cd81693b8e36cff4', 'public', NULL, NULL, '2019-10-27 23:04:50', '2019-10-27 23:04:50'),
	(331, '87bbc3973fe99ea95b9c56fe7c4100be27a5d1c8', 'roFaLDocSPc.jpg', 'image/jpeg', 'jpg', 116716, 0, '2019/10/27\\', NULL, NULL, '16c3bea7257cc0ca8780377dac031f06d052f4c8', 'public', NULL, NULL, '2019-10-28 01:01:32', '2019-10-28 01:01:32'),
	(332, '92f53676bc987987658a9f8dfe011d3eb5ac26e8', '6aaddeed5d51d30bc490ca2f6c31dd71.jpg', 'image/jpeg', 'jpg', 241111, 0, '2019/10/27\\', NULL, NULL, '0e48a4e68c94aaa0633b38096678ef7c20988ce4', 'public', NULL, NULL, '2019-10-28 01:01:32', '2019-10-28 01:01:32'),
	(333, '95cf879b045aaa86a6691398bbc7b903e50de1f9', 'W4Cf86bBCPQ.jpg', 'image/jpeg', 'jpg', 118629, 0, '2019/10/27\\', NULL, NULL, '2a80d9218b84edc80aae6ebaaaa48bba54766427', 'public', NULL, NULL, '2019-10-28 01:05:55', '2019-10-28 01:05:55'),
	(334, '7d12893ce5f08194503138df6c8a7bef890a9281', 'illust_77410170_20191022_005617.png', 'image/png', 'png', 1100266, 0, '2019/10/27\\', NULL, NULL, '83630425e6b426103597612803fabfb950bd51b2', 'public', NULL, NULL, '2019-10-28 01:05:55', '2019-10-28 01:05:55'),
	(335, '95cf879b045aaa86a6691398bbc7b903e50de1f9', 'W4Cf86bBCPQ.jpg', 'image/jpeg', 'jpg', 118629, 0, '2019/10/27\\', NULL, NULL, '2a80d9218b84edc80aae6ebaaaa48bba54766427', 'public', NULL, NULL, '2019-10-28 01:07:25', '2019-10-28 01:07:25'),
	(336, '7d12893ce5f08194503138df6c8a7bef890a9281', 'illust_77410170_20191022_005617.png', 'image/png', 'png', 1100266, 0, '2019/10/27\\', NULL, NULL, '83630425e6b426103597612803fabfb950bd51b2', 'public', NULL, NULL, '2019-10-28 01:07:25', '2019-10-28 01:07:25'),
	(337, '7d12893ce5f08194503138df6c8a7bef890a9281', 'illust_77410170_20191022_005617.png', 'image/png', 'png', 1100266, 0, '2019/10/27\\', NULL, NULL, '83630425e6b426103597612803fabfb950bd51b2', 'public', NULL, NULL, '2019-10-28 01:07:35', '2019-10-28 01:07:35'),
	(338, '7d12893ce5f08194503138df6c8a7bef890a9281', 'illust_77410170_20191022_005617.png', 'image/png', 'png', 1100266, 0, '2019/10/27\\', NULL, NULL, '83630425e6b426103597612803fabfb950bd51b2', 'public', NULL, NULL, '2019-10-28 01:09:16', '2019-10-28 01:09:16'),
	(339, '7d12893ce5f08194503138df6c8a7bef890a9281', 'illust_77410170_20191022_005617.png', 'image/png', 'png', 1100266, 0, '2019/10/27\\', NULL, NULL, '83630425e6b426103597612803fabfb950bd51b2', 'public', NULL, NULL, '2019-10-28 01:09:32', '2019-10-28 01:09:32'),
	(340, '7d12893ce5f08194503138df6c8a7bef890a9281', 'illust_77410170_20191022_005617.png', 'image/png', 'png', 1100266, 0, '2019/10/27\\', NULL, NULL, '83630425e6b426103597612803fabfb950bd51b2', 'public', NULL, NULL, '2019-10-28 01:10:01', '2019-10-28 01:10:01'),
	(341, '95cf879b045aaa86a6691398bbc7b903e50de1f9', 'W4Cf86bBCPQ.jpg', 'image/jpeg', 'jpg', 118629, 0, '2019/10/27\\', NULL, NULL, '2a80d9218b84edc80aae6ebaaaa48bba54766427', 'public', NULL, NULL, '2019-10-28 01:10:44', '2019-10-28 01:10:44'),
	(342, '7d12893ce5f08194503138df6c8a7bef890a9281', 'illust_77410170_20191022_005617.png', 'image/png', 'png', 1100266, 0, '2019/10/27\\', NULL, NULL, '83630425e6b426103597612803fabfb950bd51b2', 'public', NULL, NULL, '2019-10-28 01:10:44', '2019-10-28 01:10:44'),
	(343, '95cf879b045aaa86a6691398bbc7b903e50de1f9', 'W4Cf86bBCPQ.jpg', 'image/jpeg', 'jpg', 118629, 0, '2019/10/27\\', NULL, NULL, '2a80d9218b84edc80aae6ebaaaa48bba54766427', 'public', NULL, NULL, '2019-10-28 01:19:50', '2019-10-28 01:19:50'),
	(344, '7d12893ce5f08194503138df6c8a7bef890a9281', 'illust_77410170_20191022_005617.png', 'image/png', 'png', 1100266, 0, '2019/10/27\\', NULL, NULL, '83630425e6b426103597612803fabfb950bd51b2', 'public', NULL, NULL, '2019-10-28 01:19:50', '2019-10-28 01:19:50'),
	(345, 'debf6ffed00d69bb866ee7227c041aa83ddda254', 'illust_77293110_20191014_201120.jpg', 'image/jpeg', 'jpg', 614395, 0, '2019/10/27\\', NULL, NULL, '61c91ff3ff4f2878400554a4cd81693b8e36cff4', 'public', NULL, NULL, '2019-10-28 01:19:54', '2019-10-28 01:19:54'),
	(346, '95cf879b045aaa86a6691398bbc7b903e50de1f9', 'W4Cf86bBCPQ.jpg', 'image/jpeg', 'jpg', 118629, 0, '2019/10/27\\', NULL, NULL, '2a80d9218b84edc80aae6ebaaaa48bba54766427', 'public', NULL, NULL, '2019-10-28 01:24:30', '2019-10-28 01:24:30'),
	(347, '7d12893ce5f08194503138df6c8a7bef890a9281', 'illust_77410170_20191022_005617.png', 'image/png', 'png', 1100266, 0, '2019/10/27\\', NULL, NULL, '83630425e6b426103597612803fabfb950bd51b2', 'public', NULL, NULL, '2019-10-28 01:24:30', '2019-10-28 01:24:30'),
	(348, '95cf879b045aaa86a6691398bbc7b903e50de1f9', 'W4Cf86bBCPQ.jpg', 'image/jpeg', 'jpg', 118629, 0, '2019/10/27\\', NULL, NULL, '2a80d9218b84edc80aae6ebaaaa48bba54766427', 'public', NULL, NULL, '2019-10-28 01:25:14', '2019-10-28 01:25:14'),
	(349, '7d12893ce5f08194503138df6c8a7bef890a9281', 'illust_77410170_20191022_005617.png', 'image/png', 'png', 1100266, 0, '2019/10/27\\', NULL, NULL, '83630425e6b426103597612803fabfb950bd51b2', 'public', NULL, NULL, '2019-10-28 01:25:14', '2019-10-28 01:25:14'),
	(350, '87bbc3973fe99ea95b9c56fe7c4100be27a5d1c8', 'roFaLDocSPc.jpg', 'image/jpeg', 'jpg', 116716, 0, '2019/10/27\\', NULL, NULL, '16c3bea7257cc0ca8780377dac031f06d052f4c8', 'public', NULL, NULL, '2019-10-28 01:25:23', '2019-10-28 01:25:23'),
	(351, '1167a5917ccefa6e4d1fc88796ad38d5854f4f57', '7g1yeqwiAys.jpg', 'image/jpeg', 'jpg', 79779, 0, '2019/10/28\\', NULL, NULL, 'd588fdb2e64a516de9805f34ba36b1a122c100f5', 'public', NULL, NULL, '2019-10-28 01:25:23', '2019-10-28 01:25:23'),
	(352, '92f53676bc987987658a9f8dfe011d3eb5ac26e8', '6aaddeed5d51d30bc490ca2f6c31dd71.jpg', 'image/jpeg', 'jpg', 241111, 0, '2019/10/27\\', NULL, NULL, '0e48a4e68c94aaa0633b38096678ef7c20988ce4', 'public', NULL, NULL, '2019-10-28 01:25:26', '2019-10-28 01:25:26'),
	(353, '1cf2610a20ced1e68ecb716ed9c58f4c01b9cf43', 'sample-861fd8d1b6fd02cc502a6f688f95f41e.jpg', 'image/jpeg', 'jpg', 150700, 0, '2019/10/28\\', NULL, NULL, 'ed2aaabc330cec332faec08df96bb677b56154fc', 'public', NULL, NULL, '2019-10-28 01:25:27', '2019-10-28 01:25:27'),
	(354, '95cf879b045aaa86a6691398bbc7b903e50de1f9', 'W4Cf86bBCPQ.jpg', 'image/jpeg', 'jpg', 118629, 0, '2019/10/27\\', NULL, NULL, '2a80d9218b84edc80aae6ebaaaa48bba54766427', 'public', NULL, NULL, '2019-10-28 01:27:09', '2019-10-28 01:27:09'),
	(355, '7d12893ce5f08194503138df6c8a7bef890a9281', 'illust_77410170_20191022_005617.png', 'image/png', 'png', 1100266, 0, '2019/10/27\\', NULL, NULL, '83630425e6b426103597612803fabfb950bd51b2', 'public', NULL, NULL, '2019-10-28 01:27:09', '2019-10-28 01:27:09'),
	(356, 'debf6ffed00d69bb866ee7227c041aa83ddda254', 'illust_77293110_20191014_201120.jpg', 'image/jpeg', 'jpg', 614395, 0, '2019/10/27\\', NULL, NULL, '61c91ff3ff4f2878400554a4cd81693b8e36cff4', 'public', NULL, NULL, '2019-10-28 01:27:12', '2019-10-28 01:27:12'),
	(357, '5468334fd7679cb88844ff5ba9e51efb28a47df6', 'DNQE3rqztB4.jpg', 'image/jpeg', 'jpg', 200208, 0, '2019/10/28\\', NULL, NULL, '0b8f380ca5f2f10728b9276d27bb00b8aa00fb61', 'public', NULL, NULL, '2019-10-28 01:27:13', '2019-10-28 01:27:13'),
	(358, '9c723d6239bb2b9bce6af77a229767a6c933e376', 'WGRk7MXjAU8.jpg', 'image/jpeg', 'jpg', 143595, 0, '2019/10/28\\', NULL, NULL, '21886c2d683995f9398dc0f06079e2df804402db', 'public', NULL, NULL, '2019-10-28 01:27:16', '2019-10-28 01:27:16'),
	(359, '7d12893ce5f08194503138df6c8a7bef890a9281', 'illust_77410170_20191022_005617.png', 'image/png', 'png', 1100266, 0, '2019/10/27\\', NULL, NULL, '83630425e6b426103597612803fabfb950bd51b2', 'public', NULL, NULL, '2019-10-28 01:27:47', '2019-10-28 01:27:47'),
	(360, '95cf879b045aaa86a6691398bbc7b903e50de1f9', 'W4Cf86bBCPQ.jpg', 'image/jpeg', 'jpg', 118629, 0, '2019/10/27\\', NULL, NULL, '2a80d9218b84edc80aae6ebaaaa48bba54766427', 'public', NULL, NULL, '2019-10-28 01:27:47', '2019-10-28 01:27:47'),
	(361, 'debf6ffed00d69bb866ee7227c041aa83ddda254', 'illust_77293110_20191014_201120.jpg', 'image/jpeg', 'jpg', 614395, 0, '2019/10/27\\', NULL, NULL, '61c91ff3ff4f2878400554a4cd81693b8e36cff4', 'public', NULL, NULL, '2019-10-28 01:27:51', '2019-10-28 01:27:51'),
	(362, '5468334fd7679cb88844ff5ba9e51efb28a47df6', 'DNQE3rqztB4.jpg', 'image/jpeg', 'jpg', 200208, 0, '2019/10/28\\', NULL, NULL, '0b8f380ca5f2f10728b9276d27bb00b8aa00fb61', 'public', NULL, NULL, '2019-10-28 01:27:52', '2019-10-28 01:27:52'),
	(363, '9c723d6239bb2b9bce6af77a229767a6c933e376', 'WGRk7MXjAU8.jpg', 'image/jpeg', 'jpg', 143595, 0, '2019/10/28\\', NULL, NULL, '21886c2d683995f9398dc0f06079e2df804402db', 'public', NULL, NULL, '2019-10-28 01:27:54', '2019-10-28 01:27:54'),
	(364, '95cf879b045aaa86a6691398bbc7b903e50de1f9', 'W4Cf86bBCPQ.jpg', 'image/jpeg', 'jpg', 118629, 0, '2019/10/27\\', NULL, NULL, '2a80d9218b84edc80aae6ebaaaa48bba54766427', 'public', NULL, NULL, '2019-10-28 01:29:00', '2019-10-28 01:29:00'),
	(365, '7d12893ce5f08194503138df6c8a7bef890a9281', 'illust_77410170_20191022_005617.png', 'image/png', 'png', 1100266, 0, '2019/10/27\\', NULL, NULL, '83630425e6b426103597612803fabfb950bd51b2', 'public', NULL, NULL, '2019-10-28 01:29:00', '2019-10-28 01:29:00'),
	(366, 'debf6ffed00d69bb866ee7227c041aa83ddda254', 'illust_77293110_20191014_201120.jpg', 'image/jpeg', 'jpg', 614395, 0, '2019/10/27\\', NULL, NULL, '61c91ff3ff4f2878400554a4cd81693b8e36cff4', 'public', NULL, NULL, '2019-10-28 01:29:03', '2019-10-28 01:29:03'),
	(367, '5468334fd7679cb88844ff5ba9e51efb28a47df6', 'DNQE3rqztB4.jpg', 'image/jpeg', 'jpg', 200208, 0, '2019/10/28\\', NULL, NULL, '0b8f380ca5f2f10728b9276d27bb00b8aa00fb61', 'public', NULL, NULL, '2019-10-28 01:29:04', '2019-10-28 01:29:04'),
	(368, '9c723d6239bb2b9bce6af77a229767a6c933e376', 'WGRk7MXjAU8.jpg', 'image/jpeg', 'jpg', 143595, 0, '2019/10/28\\', NULL, NULL, '21886c2d683995f9398dc0f06079e2df804402db', 'public', NULL, NULL, '2019-10-28 01:29:07', '2019-10-28 01:29:07'),
	(369, '6e9551f54a34620bb6823fd784f9602267a59f3b', '1vv7Gpg8WPc.jpg', 'image/jpeg', 'jpg', 104543, 0, '2019/10/28\\', NULL, NULL, '8c9fdd23031d78f7175eaf1ef5087e3b3216c89d', 'public', NULL, NULL, '2019-10-28 01:30:54', '2019-10-28 01:30:54'),
	(370, 'debf6ffed00d69bb866ee7227c041aa83ddda254', 'illust_77293110_20191014_201120.jpg', 'image/jpeg', 'jpg', 614395, 0, '2019/10/27\\', NULL, NULL, '61c91ff3ff4f2878400554a4cd81693b8e36cff4', 'public', NULL, NULL, '2019-10-28 01:33:25', '2019-10-28 01:33:25'),
	(371, '1167a5917ccefa6e4d1fc88796ad38d5854f4f57', '7g1yeqwiAys.jpg', 'image/jpeg', 'jpg', 79779, 0, '2019/10/28\\', NULL, NULL, 'd588fdb2e64a516de9805f34ba36b1a122c100f5', 'public', NULL, NULL, '2019-10-28 01:33:33', '2019-10-28 01:33:33'),
	(372, '87bbc3973fe99ea95b9c56fe7c4100be27a5d1c8', 'roFaLDocSPc.jpg', 'image/jpeg', 'jpg', 116716, 0, '2019/10/27\\', NULL, NULL, '16c3bea7257cc0ca8780377dac031f06d052f4c8', 'public', NULL, NULL, '2019-10-28 01:33:33', '2019-10-28 01:33:33'),
	(373, '92f53676bc987987658a9f8dfe011d3eb5ac26e8', '6aaddeed5d51d30bc490ca2f6c31dd71.jpg', 'image/jpeg', 'jpg', 241111, 0, '2019/10/27\\', NULL, NULL, '0e48a4e68c94aaa0633b38096678ef7c20988ce4', 'public', NULL, NULL, '2019-10-28 01:33:36', '2019-10-28 01:33:36'),
	(374, '1cf2610a20ced1e68ecb716ed9c58f4c01b9cf43', 'sample-861fd8d1b6fd02cc502a6f688f95f41e.jpg', 'image/jpeg', 'jpg', 150700, 0, '2019/10/28\\', NULL, NULL, 'ed2aaabc330cec332faec08df96bb677b56154fc', 'public', NULL, NULL, '2019-10-28 01:33:37', '2019-10-28 01:33:37'),
	(375, '2ad309fd48d11c637834ef1dbd1b80318f8bfdff', '79e0b5fe9b9ff60af7cf0c4734bd8d02.jpg', 'image/jpeg', 'jpg', 991853, 0, '2019/10/28\\', NULL, NULL, '48af2d90d36f834133a165fa3c8f725b54a3d7b8', 'public', NULL, NULL, '2019-10-28 01:33:41', '2019-10-28 01:33:41'),
	(376, '5468334fd7679cb88844ff5ba9e51efb28a47df6', 'DNQE3rqztB4.jpg', 'image/jpeg', 'jpg', 200208, 0, '2019/10/28\\', NULL, NULL, '0b8f380ca5f2f10728b9276d27bb00b8aa00fb61', 'public', NULL, NULL, '2019-10-28 01:33:45', '2019-10-28 01:33:45'),
	(377, '793d213aac375ada265cdc4637d11b802643c8fb', 'n2YqmQ8bmdE.jpg', 'image/jpeg', 'jpg', 397685, 0, '2019/10/28\\', NULL, NULL, '1b4ca20316b4455eb36d5243a44357ee8d0691b9', 'public', NULL, NULL, '2019-10-28 01:33:55', '2019-10-28 01:33:55'),
	(378, '3e9ebdc89ac8706f2047a9e92b9953cb3b65283d', 'KZ7uPo1mCTM.jpg', 'image/jpeg', 'jpg', 275252, 0, '2019/10/28\\', NULL, NULL, '14f5f09653cce83560cab81f74d62dc099ed0e41', 'public', NULL, NULL, '2019-10-28 01:33:55', '2019-10-28 01:33:55'),
	(379, 'c831b8351494e563cfcdcf73cb9b651bfc7dd87b', '0Jb-rV0fimg.jpg', 'image/jpeg', 'jpg', 173450, 0, '2019/10/28\\', NULL, NULL, 'e0d973b61ea238d71d9d6446e66842079432797a', 'public', NULL, NULL, '2019-10-28 01:33:59', '2019-10-28 01:33:59'),
	(380, 'd86f7cf6a77912785b6f7d3d65f1957459df0092', 'thTcC7JmWog.jpg', 'image/jpeg', 'jpg', 182418, 0, '2019/10/28\\', NULL, NULL, '2fdd0c371ef451cc2302aa829c98f6aafb8a6bfc', 'public', NULL, NULL, '2019-10-28 01:34:01', '2019-10-28 01:34:01'),
	(381, '7492abaab72bea06971515678a9f05ef7cceb97b', 'vKT1vuoL2wc.jpg', 'image/jpeg', 'jpg', 334720, 0, '2019/10/28\\', NULL, NULL, 'ac018c57ff552ab3ce9fc981d799153a5e17055a', 'public', NULL, NULL, '2019-10-28 01:34:03', '2019-10-28 01:34:03'),
	(382, '43ed7e1525409965a6caa831f3c59cb2bf2cef2f', 'Zrojtmw8F7s.jpg', 'image/jpeg', 'jpg', 692393, 0, '2019/10/28\\', NULL, NULL, '47b26128f3839c0d2d82798aed9b770d1c5c05f0', 'public', NULL, NULL, '2019-10-28 01:34:09', '2019-10-28 01:34:09'),
	(383, '74260b543931b8a48ed6f55e0b612a715a0520b7', 'ab698986bb64d01f5de4af2e303f9b1b.jpg', 'image/jpeg', 'jpg', 711637, 0, '2019/10/28\\', NULL, NULL, '633d53c965470f0c142a292f40a5cf56c11f2dd5', 'public', NULL, NULL, '2019-10-28 01:34:13', '2019-10-28 01:34:13'),
	(384, 'a23ba46f565c0daa65f4503c92889dd258b92186', '30824f63ec629b8f562c2f6c63e37aa3.jpg', 'image/jpeg', 'jpg', 255303, 0, '2019/10/28\\', NULL, NULL, 'baf8e0407d6b73cdf6dac861f2cd3cd1faec2119', 'public', NULL, NULL, '2019-10-28 01:34:18', '2019-10-28 01:34:18'),
	(385, '95cf879b045aaa86a6691398bbc7b903e50de1f9', 'W4Cf86bBCPQ.jpg', 'image/jpeg', 'jpg', 118629, 0, '2019/10/27\\', NULL, NULL, '2a80d9218b84edc80aae6ebaaaa48bba54766427', 'public', NULL, NULL, '2019-10-28 01:37:08', '2019-10-28 01:37:08'),
	(386, '7d12893ce5f08194503138df6c8a7bef890a9281', 'illust_77410170_20191022_005617.png', 'image/png', 'png', 1100266, 0, '2019/10/27\\', NULL, NULL, '83630425e6b426103597612803fabfb950bd51b2', 'public', NULL, NULL, '2019-10-28 01:37:08', '2019-10-28 01:37:08'),
	(387, 'debf6ffed00d69bb866ee7227c041aa83ddda254', 'illust_77293110_20191014_201120.jpg', 'image/jpeg', 'jpg', 614395, 0, '2019/10/27\\', NULL, NULL, '61c91ff3ff4f2878400554a4cd81693b8e36cff4', 'public', NULL, NULL, '2019-10-28 01:37:12', '2019-10-28 01:37:12'),
	(388, '5468334fd7679cb88844ff5ba9e51efb28a47df6', 'DNQE3rqztB4.jpg', 'image/jpeg', 'jpg', 200208, 0, '2019/10/28\\', NULL, NULL, '0b8f380ca5f2f10728b9276d27bb00b8aa00fb61', 'public', NULL, NULL, '2019-10-28 01:37:13', '2019-10-28 01:37:13'),
	(389, '9c723d6239bb2b9bce6af77a229767a6c933e376', 'WGRk7MXjAU8.jpg', 'image/jpeg', 'jpg', 143595, 0, '2019/10/28\\', NULL, NULL, '21886c2d683995f9398dc0f06079e2df804402db', 'public', NULL, NULL, '2019-10-28 01:37:17', '2019-10-28 01:37:17'),
	(390, '1167a5917ccefa6e4d1fc88796ad38d5854f4f57', '7g1yeqwiAys.jpg', 'image/jpeg', 'jpg', 79779, 0, '2019/10/28\\', NULL, NULL, 'd588fdb2e64a516de9805f34ba36b1a122c100f5', 'public', NULL, NULL, '2019-10-28 01:37:18', '2019-10-28 01:37:18'),
	(391, '87bbc3973fe99ea95b9c56fe7c4100be27a5d1c8', 'roFaLDocSPc.jpg', 'image/jpeg', 'jpg', 116716, 0, '2019/10/27\\', NULL, NULL, '16c3bea7257cc0ca8780377dac031f06d052f4c8', 'public', NULL, NULL, '2019-10-28 01:37:20', '2019-10-28 01:37:20'),
	(392, '92f53676bc987987658a9f8dfe011d3eb5ac26e8', '6aaddeed5d51d30bc490ca2f6c31dd71.jpg', 'image/jpeg', 'jpg', 241111, 0, '2019/10/27\\', NULL, NULL, '0e48a4e68c94aaa0633b38096678ef7c20988ce4', 'public', NULL, NULL, '2019-10-28 01:37:21', '2019-10-28 01:37:21'),
	(393, '1cf2610a20ced1e68ecb716ed9c58f4c01b9cf43', 'sample-861fd8d1b6fd02cc502a6f688f95f41e.jpg', 'image/jpeg', 'jpg', 150700, 0, '2019/10/28\\', NULL, NULL, 'ed2aaabc330cec332faec08df96bb677b56154fc', 'public', NULL, NULL, '2019-10-28 01:37:24', '2019-10-28 01:37:24'),
	(394, '2ad309fd48d11c637834ef1dbd1b80318f8bfdff', '79e0b5fe9b9ff60af7cf0c4734bd8d02.jpg', 'image/jpeg', 'jpg', 991853, 0, '2019/10/28\\', NULL, NULL, '48af2d90d36f834133a165fa3c8f725b54a3d7b8', 'public', NULL, NULL, '2019-10-28 01:37:28', '2019-10-28 01:37:28'),
	(395, '31dfc23a26311286f4ae995c681d00f2820f91b3', 'sample-27ec43647faf573a8809971f2a7de05c.jpg', 'image/jpeg', 'jpg', 158743, 0, '2019/10/28\\', NULL, NULL, 'ddc4a83bde04ae8282e06a196dfd601b2b529fd0', 'public', NULL, NULL, '2019-10-28 01:37:28', '2019-10-28 01:37:28'),
	(396, 'fc6a8dfac2486b59c7b6c9e3c6725470c0067dca', 'FiVODhjNTt4.jpg', 'image/jpeg', 'jpg', 255044, 0, '2019/10/28\\', NULL, NULL, '5aec122cc91ce5924d48c47c6b1ae07e991ae282', 'public', NULL, NULL, '2019-10-28 01:37:31', '2019-10-28 01:37:31'),
	(397, 'd22f14639b4f282126a9e7180890b258830ef884', 'Rx_gnqYojuc.jpg', 'image/jpeg', 'jpg', 81586, 0, '2019/10/28\\', NULL, NULL, '39526ccbd9e52d86006b66aacfe1dcd88e9bc338', 'public', NULL, NULL, '2019-10-28 01:37:35', '2019-10-28 01:37:35'),
	(398, '0baa0bd1d87e1e6475d9d7f01becdf0b872ce464', 'DJLCzEdHWnU.jpg', 'image/jpeg', 'jpg', 611496, 0, '2019/10/28\\', NULL, NULL, '3f7fecb20a87a1479b49736f1c2b7e7cc534d37c', 'public', NULL, NULL, '2019-10-28 01:37:39', '2019-10-28 01:37:39'),
	(399, 'fbff6fb2dbc5e693c42ad1726bd1500327fbe97c', 'bk1hioiKQgU.jpg', 'image/jpeg', 'jpg', 430918, 0, '2019/10/28\\', NULL, NULL, '39fffe294954259ffea7c3b999bd5b6df11eacc0', 'public', NULL, NULL, '2019-10-28 01:37:50', '2019-10-28 01:37:50'),
	(400, '3e9ebdc89ac8706f2047a9e92b9953cb3b65283d', 'KZ7uPo1mCTM.jpg', 'image/jpeg', 'jpg', 275252, 0, '2019/10/28\\', NULL, NULL, '14f5f09653cce83560cab81f74d62dc099ed0e41', 'public', NULL, NULL, '2019-10-28 01:37:50', '2019-10-28 01:37:50'),
	(401, 'bb6fc02b6bddf684f1369f941886450a7b5615bc', '73775533cef1ad884f8bfe525666546c.jpeg', 'image/jpeg', 'jpeg', 125023, 0, '2019/10/28\\', NULL, NULL, '7f8be20d3512f9fa36bde0153403f2b391b538cc', 'public', NULL, NULL, '2019-10-28 01:38:31', '2019-10-28 01:38:31'),
	(402, '65ac65b88bbb3b936eec376658a2a26396a2e4d3', 'f5f22f8882c48d83290219698033a65f.png', 'image/png', 'png', 3585731, 0, '2019/10/28\\', NULL, NULL, 'd5cb947f5c600711ae959a98b7d8db8a061cdc81', 'public', NULL, NULL, '2019-10-28 01:38:31', '2019-10-28 01:38:31'),
	(403, 'a87fef50fd3dd19833757ccf01cdc06ddb229fd9', 'SYdcOvwWMxM.jpg', 'image/jpeg', 'jpg', 1110201, 0, '2019/11/03\\', NULL, NULL, 'f41c2b8410010f9ae530fe33157728d6a6d9f74a', 'public', 1, NULL, '2019-11-03 18:45:33', '2019-11-03 18:45:33'),
	(404, '35bf54113be2117b68f434af7e40afe19f529def', 'V23Rb2E7mS4.jpg', 'image/jpeg', 'jpg', 1150046, 0, '2019/11/03\\', NULL, NULL, 'bfe5fe1d2a837b6ae67f5a3454c052be35931009', 'public', 1, NULL, '2019-11-03 18:45:33', '2019-11-03 18:45:33'),
	(405, 'b6a278dc036932a3f970065d1dfc1a7a5bb78a5f', 'rwvKpg4pSlU.jpg', 'image/jpeg', 'jpg', 1229463, 0, '2019/11/03\\', NULL, NULL, '0f6156b94734f2f242764b36c78fa1d36fa50f58', 'public', 1, NULL, '2019-11-03 18:45:38', '2019-11-03 18:45:38'),
	(406, 'e876755748ed201f5351e7fd7937430ac57f1dac', 'VVzY5oXZ7Y0.jpg', 'image/jpeg', 'jpg', 1118011, 0, '2019/11/03\\', NULL, NULL, '749335e1e73c123c8b77c199d1f0b940774672a7', 'public', 1, NULL, '2019-11-03 18:45:38', '2019-11-03 18:45:38'),
	(407, 'b13e13d01fb29c6f5802707f4f7a7f2337604838', 'yPr76TN8yQI.jpg', 'image/jpeg', 'jpg', 1572724, 0, '2019/11/03\\', NULL, NULL, '11de756fdb1bd0df833878a8084a6e23e7c46741', 'public', 1, NULL, '2019-11-03 18:45:42', '2019-11-03 18:45:42'),
	(408, '35bf54113be2117b68f434af7e40afe19f529def', 'V23Rb2E7mS4.jpg', 'image/jpeg', 'jpg', 1150046, 0, '2019/11/03\\', NULL, NULL, 'bfe5fe1d2a837b6ae67f5a3454c052be35931009', 'public', 1, NULL, '2019-11-03 19:09:01', '2019-11-03 19:09:01'),
	(409, 'a87fef50fd3dd19833757ccf01cdc06ddb229fd9', 'SYdcOvwWMxM.jpg', 'image/jpeg', 'jpg', 1110201, 0, '2019/11/03\\', NULL, NULL, 'f41c2b8410010f9ae530fe33157728d6a6d9f74a', 'public', 1, NULL, '2019-11-03 19:09:01', '2019-11-03 19:09:01'),
	(410, 'e876755748ed201f5351e7fd7937430ac57f1dac', 'VVzY5oXZ7Y0.jpg', 'image/jpeg', 'jpg', 1118011, 0, '2019/11/03\\', NULL, NULL, '749335e1e73c123c8b77c199d1f0b940774672a7', 'public', 1, NULL, '2019-11-03 19:09:06', '2019-11-03 19:09:06'),
	(411, 'b6a278dc036932a3f970065d1dfc1a7a5bb78a5f', 'rwvKpg4pSlU.jpg', 'image/jpeg', 'jpg', 1229463, 0, '2019/11/03\\', NULL, NULL, '0f6156b94734f2f242764b36c78fa1d36fa50f58', 'public', 1, NULL, '2019-11-03 19:09:06', '2019-11-03 19:09:06'),
	(412, 'b13e13d01fb29c6f5802707f4f7a7f2337604838', 'yPr76TN8yQI.jpg', 'image/jpeg', 'jpg', 1572724, 0, '2019/11/03\\', NULL, NULL, '11de756fdb1bd0df833878a8084a6e23e7c46741', 'public', 1, NULL, '2019-11-03 19:09:11', '2019-11-03 19:09:11'),
	(413, 'd34f523563d3e565687b6326df69f75e1243b21c', 'le-ItIhff-8.jpg', 'image/jpeg', 'jpg', 53045, 0, '2019/11/05\\', NULL, NULL, '8a7ee503332c4f86dc990f048edc1efcf1d196a7', 'public', 1, NULL, '2019-11-05 00:32:06', '2019-11-05 00:32:06'),
	(414, 'b9a536e25c0c58405b6383f27f415cd0eb3c3fd3', 'ZM7IfxXpeQw.jpg', 'image/jpeg', 'jpg', 53394, 0, '2019/11/05\\', NULL, NULL, 'ce60cf0a5d9092b2faa2acd4653185b4e6423a08', 'public', 1, NULL, '2019-11-05 00:32:06', '2019-11-05 00:32:06'),
	(415, 'd34f523563d3e565687b6326df69f75e1243b21c', 'le-ItIhff-8.jpg', 'image/jpeg', 'jpg', 53045, 0, '2019/11/05\\', NULL, NULL, '8a7ee503332c4f86dc990f048edc1efcf1d196a7', 'public', 1, NULL, '2019-11-05 00:38:55', '2019-11-05 00:38:55'),
	(416, '76970910c096661f9778a1ff90123c155f91d486', 'HOFk4D1v0aA.jpg', 'image/jpeg', 'jpg', 243169, 0, '2019/11/05\\', NULL, NULL, '34ce0371e6778f9c800138846fa072110c663162', 'public', 1, NULL, '2019-11-05 00:38:55', '2019-11-05 00:38:55'),
	(417, '00afd62c1454f0725316dc7168811b0842e405ce', 'GJ5fwbRW104.jpg', 'image/jpeg', 'jpg', 431163, 0, '2019/11/05\\', NULL, NULL, '0eb4fd0f9e811286aa2203f351433b43f422a278', 'public', 1, NULL, '2019-11-05 00:39:54', '2019-11-05 00:39:54'),
	(418, 'b9a536e25c0c58405b6383f27f415cd0eb3c3fd3', 'ZM7IfxXpeQw.jpg', 'image/jpeg', 'jpg', 53394, 0, '2019/11/05\\', NULL, NULL, 'ce60cf0a5d9092b2faa2acd4653185b4e6423a08', 'public', 1, NULL, '2019-11-05 00:39:54', '2019-11-05 00:39:54');
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;

-- Дамп структуры для таблица adv.blog_cats
CREATE TABLE IF NOT EXISTS `blog_cats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('post','page','advertisement') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_cats_status_parent_id_index` (`status`,`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.blog_cats: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `blog_cats` DISABLE KEYS */;
INSERT INTO `blog_cats` (`id`, `type`, `name`, `slug`, `parent_id`, `status`, `created_at`, `updated_at`) VALUES
	(0, 'advertisement', 'Без категории', 'uncatigorized', NULL, 1, '2019-02-12 23:14:47', '2019-04-28 22:51:13'),
	(1, 'advertisement', 'Маркетинг в бизнесе', 'marketing_in_business', NULL, 1, '2019-02-12 23:14:47', '2019-04-28 22:51:13'),
	(2, 'advertisement', 'Идеальный клиент', 'ideal_customer', NULL, 1, '2019-02-27 23:14:47', '2019-06-26 21:57:48');
/*!40000 ALTER TABLE `blog_cats` ENABLE KEYS */;

-- Дамп структуры для таблица adv.blog_entry
CREATE TABLE IF NOT EXISTS `blog_entry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('published','draft','protected','trash','history') COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `publicated_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_entry_title_type_index` (`title`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.blog_entry: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `blog_entry` DISABLE KEYS */;
INSERT INTO `blog_entry` (`id`, `title`, `content`, `type`, `status`, `slug`, `author_id`, `publicated_at`, `expired_at`, `created_at`, `updated_at`) VALUES
	(1, 'Бл<i class="icon-smile-cool"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>г - Татьяны Деркач', '<p>[cats-list data-filter="blog-posts" data-multiple="true"]</p>\r\n<p>[post-list data-id="blog-posts" sort-buttons="true"]</p>', 'page', 'published', 'blog', 1, '2019-04-29 22:37:00', NULL, '2019-02-11 21:01:59', '2019-07-11 21:12:57'),
	(4, '4 - Работай-меньше, успевай-больше, или что такое "Тайм - менеджмент"', '<p style="text-align: left;">Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам увеличение количества Ваших продаж. Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам&nbsp;увеличение количества Ваших продаж.</p>\r\n<figure class="image align-left"><a href="http://biz.derkach/storage/2019/07/20\\26e52c57d3e692d0648455b296dee41400cd23bf.jpeg#253" data-toggle="lightbox"><img src="http://biz.derkach/storage/2019/07/20\\26e52c57d3e692d0648455b296dee41400cd23bf.jpeg#253" alt="" width="333" height="591" /></a>\r\n<figcaption>Caption</figcaption>\r\n</figure>\r\n<p style="text-align: left;">&nbsp;</p>\r\n<p>Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам увеличение количества Ваших продаж. Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам увеличение количества Ваших продаж.</p>\r\n<p style="text-align: left;">Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам увеличение количества Ваших продаж. Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам увеличение количества Ваших продаж.</p>\r\n<p style="text-align: left;">Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам увеличение количества Ваших продаж. Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам увеличение количества Ваших продаж.</p>\r\n<p style="text-align: left;">Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам увеличение количества Ваших продаж. Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам увеличение количества Ваших продаж.</p>\r\n<p style="text-align: left;">Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам увеличение количества Ваших продаж. Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам увеличение количества Ваших продаж.</p>\r\n<p style="text-align: left;">Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам увеличение количества Ваших продаж. Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам увеличение количества Ваших продаж.</p>', 'post', 'published', 'blog/rabotay-menshe-uspevay-bolshe-ili-chto-takoe-taym-menedzhment', 1, '2019-07-16 20:50:00', NULL, '2019-04-28 21:38:00', '2019-07-23 12:45:28'),
	(5, 'ПРОГРАММА «БИЗНЕС»', '<ul class="info">\r\n<li>Выбор целевой аудитории</li>\r\n<li>Оформление страниц в социальных сетях</li>\r\n<li>Составление уникального контента для ЦА</li>\r\n<li>Копирайтинг</li>\r\n<li>Обратная связь в группе</li>\r\n<li>Создание воронки</li>\r\n<li>Онлайн-сессии с ответами на вопросы</li>\r\n<li>Безлимитный доступ к платформе</li>\r\n</ul>\r\n<p>[form id="3"]</p>\r\n<div class="pay-links">\r\n<p><a href="#">Нет удобного способа оплаты ?</a></p>\r\n<p><a href="#">Не получается прислать чек ?</a></p>\r\n<p><a href="#">Остались вопросы ?</a></p>\r\n</div>', 'business_card', 'published', NULL, 1, '2019-05-01 00:14:33', NULL, '2019-05-01 00:14:33', '2019-06-10 20:59:05'),
	(7, 'ИНДИВИДУАЛЬНЫЙ ПАКЕТ', '<ul class="dash">\r\n<li>Личное собеседование и разбор основных проблем</li>\r\n<li>Составление плана обучения именно для Вас и для решения Ваших проблем в бизнесе</li>\r\n<li>8 часовых занятий, за время которых Вы эти проблемы решите</li>\r\n<li>Доведу до результата</li>\r\n</ul>\r\n<p>[form id="2"]</p>', 'business_card', 'published', NULL, 1, '2019-05-01 00:25:19', NULL, '2019-05-01 00:25:19', '2019-06-25 22:36:01'),
	(11, '11 - Работай-меньше, успевай-больше, или что такое "Тайм - менеджмент"', '<p>Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам увеличение количества Ваших продаж. Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам увеличение количества Ваших продаж.</p>', 'post', 'history', NULL, 1, '2019-04-29 22:25:00', NULL, '2019-04-28 21:38:00', '2019-05-28 22:04:53'),
	(17, 'Работай-меньше, успевай-больше, или что такое', '<p>Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам увеличение количества Ваших продаж. Время - это невосполнимый ресурс, и по этому оно ограничено. Если Вы не можете организовывать себя, то Вы точно не сможете организовывать других. Только грамотное распределение и управление своим временем, временем своей команды, своих потенциальных клиентов может гарантировать Вам увеличение количества Ваших продаж.</p>', 'post', 'published', 'blog/anime-post', 1, '2019-06-30 20:44:00', NULL, '2019-05-28 22:10:56', '2019-07-18 22:01:49'),
	(18, 'Главная страница', '<p>[landing-page]</p>', 'page', 'published', NULL, NULL, '2019-07-10 21:37:00', NULL, '2019-07-07 21:42:44', '2019-07-11 21:13:09');
/*!40000 ALTER TABLE `blog_entry` ENABLE KEYS */;

-- Дамп структуры для таблица adv.blog_entry_attachments
CREATE TABLE IF NOT EXISTS `blog_entry_attachments` (
  `entry_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment_id` int(10) unsigned DEFAULT NULL,
  KEY `blog_attachment_entry_id_type_index` (`entry_id`),
  KEY `blog_attachment_attachment_id_type_index` (`attachment_id`),
  CONSTRAINT `blog_entry_attachment_attachment_id_foreign` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `blog_entry_attachment_entry_id_foreign` FOREIGN KEY (`entry_id`) REFERENCES `blog_entry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.blog_entry_attachments: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `blog_entry_attachments` DISABLE KEYS */;
INSERT INTO `blog_entry_attachments` (`entry_id`, `type`, `attachment_id`) VALUES
	(11, 'cover', 214),
	(17, 'cover', 240);
/*!40000 ALTER TABLE `blog_entry_attachments` ENABLE KEYS */;

-- Дамп структуры для таблица adv.blog_entry_cats
CREATE TABLE IF NOT EXISTS `blog_entry_cats` (
  `entry_id` int(10) unsigned DEFAULT NULL,
  `cat_id` int(10) unsigned DEFAULT NULL,
  KEY `blog_entry_cats_cat_id_foreign` (`cat_id`),
  KEY `blog_entry_cats_entry_id_foreign` (`entry_id`),
  CONSTRAINT `blog_entry_cats_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `blog_cats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `blog_entry_cats_entry_id_foreign` FOREIGN KEY (`entry_id`) REFERENCES `blog_entry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.blog_entry_cats: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `blog_entry_cats` DISABLE KEYS */;
INSERT INTO `blog_entry_cats` (`entry_id`, `cat_id`) VALUES
	(4, 1),
	(17, 1),
	(11, 0);
/*!40000 ALTER TABLE `blog_entry_cats` ENABLE KEYS */;

-- Дамп структуры для таблица adv.blog_entry_meta
CREATE TABLE IF NOT EXISTS `blog_entry_meta` (
  `meta_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entry_id` int(10) unsigned DEFAULT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `field` (`field`),
  KEY `blog_entry_meta_entry_id_foreign` (`entry_id`),
  CONSTRAINT `blog_entry_meta_entry_id_foreign` FOREIGN KEY (`entry_id`) REFERENCES `blog_entry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=395 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.blog_entry_meta: ~22 rows (приблизительно)
/*!40000 ALTER TABLE `blog_entry_meta` DISABLE KEYS */;
INSERT INTO `blog_entry_meta` (`meta_id`, `entry_id`, `field`, `value`) VALUES
	(4, 4, 'thumb_type', 'thumb-wide'),
	(8, 4, 'counter', '869'),
	(9, 4, 'likes', '14'),
	(120, 11, 'counter', '140'),
	(121, 11, 'likes', '38'),
	(273, 17, 'post_parent', '16'),
	(274, 17, 'counter', '106'),
	(275, 17, 'likes', '1'),
	(276, 5, 'cost', '19'),
	(277, 5, 'card_position', 'left'),
	(279, 7, 'card_position', 'right'),
	(290, 1, 'counter', '113'),
	(317, 5, 'counter', '1'),
	(339, 1, 'template', 'simple'),
	(340, 1, 'subtitle', 'Подписывайся на новости и получи в подарок книгу  «Как создать свой БРЕНД»'),
	(341, 1, 'page_type', 'blog_page'),
	(342, 18, 'meta_description', 'test1'),
	(343, 18, 'meta_keywords', 'test2'),
	(344, 18, 'page_type', 'main_page'),
	(393, 4, 'template', 'wide'),
	(394, 4, 'color', 'violet');
/*!40000 ALTER TABLE `blog_entry_meta` ENABLE KEYS */;

-- Дамп структуры для таблица adv.blog_entry_tags
CREATE TABLE IF NOT EXISTS `blog_entry_tags` (
  `entry_id` int(10) unsigned DEFAULT NULL,
  `tag_id` int(10) unsigned DEFAULT NULL,
  KEY `blog_entry_tags_entry_id_foreign` (`entry_id`),
  KEY `blog_entry_tags_tag_id_foreign` (`tag_id`),
  CONSTRAINT `blog_entry_tags_entry_id_foreign` FOREIGN KEY (`entry_id`) REFERENCES `blog_entry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `blog_entry_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `blog_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.blog_entry_tags: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `blog_entry_tags` DISABLE KEYS */;
INSERT INTO `blog_entry_tags` (`entry_id`, `tag_id`) VALUES
	(4, 13),
	(4, 14),
	(4, 15),
	(17, 16),
	(17, 12);
/*!40000 ALTER TABLE `blog_entry_tags` ENABLE KEYS */;

-- Дамп структуры для таблица adv.blog_menu
CREATE TABLE IF NOT EXISTS `blog_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_menu_type_index` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.blog_menu: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `blog_menu` DISABLE KEYS */;
INSERT INTO `blog_menu` (`id`, `name`, `alias`) VALUES
	(1, 'Шапка', 'header'),
	(2, 'Нижнее меню', 'footer');
/*!40000 ALTER TABLE `blog_menu` ENABLE KEYS */;

-- Дамп структуры для таблица adv.blog_menu_list
CREATE TABLE IF NOT EXISTS `blog_menu_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` tinyint(4) DEFAULT '0',
  `menu_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_menu_list_menu_id_foreign` (`menu_id`),
  CONSTRAINT `blog_menu_list_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `blog_menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.blog_menu_list: ~8 rows (приблизительно)
/*!40000 ALTER TABLE `blog_menu_list` DISABLE KEYS */;
INSERT INTO `blog_menu_list` (`id`, `title`, `icon`, `link`, `class`, `order`, `menu_id`) VALUES
	(19, 'Аренда', NULL, 'blog/anime-post', NULL, 0, 1),
	(20, 'Обмен', NULL, NULL, NULL, 1, 1),
	(21, 'Продажа', NULL, NULL, NULL, 2, 1),
	(22, 'Услуги', NULL, 'blog', 'active', 3, 1),
	(23, 'Статьи и новости', NULL, NULL, 'active', 4, 1),
	(24, 'Политика конфиденциальности', NULL, NULL, NULL, 0, 2),
	(25, 'Блог', NULL, '/blog', NULL, 1, 2),
	(26, 'Интервью', NULL, NULL, NULL, 2, 2),
	(27, 'Поиск по карте', 'lh-icon lh-icon-map', NULL, 'active', 4, 1);
/*!40000 ALTER TABLE `blog_menu_list` ENABLE KEYS */;

-- Дамп структуры для таблица adv.blog_popular_index
CREATE TABLE IF NOT EXISTS `blog_popular_index` (
  `entry_id` int(10) unsigned DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `index` float unsigned DEFAULT NULL,
  UNIQUE KEY `entry_id_uniq` (`entry_id`),
  KEY `entry_id` (`entry_id`),
  KEY `date` (`date`),
  KEY `index` (`index`),
  CONSTRAINT `blog_popular_index_entry_id_foreign` FOREIGN KEY (`entry_id`) REFERENCES `blog_entry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы adv.blog_popular_index: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `blog_popular_index` DISABLE KEYS */;
INSERT INTO `blog_popular_index` (`entry_id`, `date`, `index`) VALUES
	(4, '201918', 61.6),
	(11, '201918', 29.12);
/*!40000 ALTER TABLE `blog_popular_index` ENABLE KEYS */;

-- Дамп структуры для таблица adv.blog_tags
CREATE TABLE IF NOT EXISTS `blog_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.blog_tags: ~10 rows (приблизительно)
/*!40000 ALTER TABLE `blog_tags` DISABLE KEYS */;
INSERT INTO `blog_tags` (`id`, `name`, `slug`) VALUES
	(1, 'Клиенты', 'clients'),
	(2, 'База', 'base'),
	(3, 'Реклама', 'reklama'),
	(7, 'Машка', 'mashka'),
	(9, 'mashka', 'mashka'),
	(12, 'testec', 'testec'),
	(13, 'курча', 'kurcha'),
	(14, 'Клие', 'klie'),
	(15, 'Клиент', 'klient'),
	(16, 'te', 'te');
/*!40000 ALTER TABLE `blog_tags` ENABLE KEYS */;

-- Дамп структуры для таблица adv.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entry_id` int(10) unsigned DEFAULT NULL,
  `type` enum('post','advertisement','page') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `root_parent_id` int(11) DEFAULT NULL,
  `rating` int(2) DEFAULT '0',
  `is_moderated` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_comments_entry_id_parent_id_index` (`entry_id`,`parent_id`),
  KEY `blog_comments_user_id_foreign` (`user_id`),
  CONSTRAINT `blog_comments_entry_id_foreign` FOREIGN KEY (`entry_id`) REFERENCES `blog_entry` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.comments: ~61 rows (приблизительно)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `entry_id`, `type`, `message`, `user_id`, `parent_id`, `root_parent_id`, `rating`, `is_moderated`, `created_at`, `updated_at`) VALUES
	(1, 4, 'post', 'Спасибо. Годно', 0, NULL, NULL, 0, 0, '2019-02-15 00:30:20', '2019-02-15 00:30:20'),
	(2, 4, 'post', 'Багодарю за отзыв', 1, 1, 1, 0, 0, '2019-02-15 00:30:20', '2019-02-15 00:30:20'),
	(3, 4, 'post', 'Топ новость!', 0, NULL, NULL, 0, 0, '2019-02-15 00:30:20', '2019-02-15 00:30:20'),
	(4, 4, 'post', 'test', 1, NULL, NULL, 0, 0, '2019-06-04 20:57:33', '2019-06-04 20:57:33'),
	(5, 4, 'post', 'test', 1, NULL, NULL, 0, 0, '2019-06-04 20:57:39', '2019-06-04 20:57:39'),
	(6, 4, 'post', 'ага)', 1, 3, 3, 0, 0, '2019-06-04 21:00:55', '2019-06-04 21:00:55'),
	(7, 4, 'post', 'согласен)', 1, 6, 3, 0, 0, '2019-06-04 21:01:08', '2019-06-04 21:01:08'),
	(9, 4, 'post', 'Не то слово)', 1, 3, 3, 0, 0, '2019-06-04 21:01:17', '2019-06-04 21:01:17'),
	(30, 4, 'post', 'кайф', 1, 9, 3, 0, 0, '2019-06-05 20:50:28', '2019-06-05 20:50:28'),
	(31, 4, 'post', 'test', 1, 30, 3, 0, 0, '2019-06-05 20:53:02', '2019-06-05 20:53:02'),
	(32, 4, 'post', 'test', 1, 31, 3, 0, 0, '2019-06-05 20:55:17', '2019-06-05 20:55:17'),
	(33, 4, 'post', 'test', 1, 32, 3, 0, 0, '2019-06-05 20:55:40', '2019-06-05 20:55:40'),
	(34, 4, 'post', 'привет как дела', 1, 33, 3, 0, 0, '2019-06-05 20:59:37', '2019-06-05 20:59:37'),
	(35, 4, 'post', 'как погода азазаз?', 1, 34, 3, 0, 0, '2019-06-05 20:59:59', '2019-06-05 20:59:59'),
	(36, 4, 'post', 'хай всем', 1, NULL, NULL, 0, 0, '2019-06-05 21:00:03', '2019-06-05 21:00:03'),
	(37, 4, 'post', 'хаюшки', 1, NULL, NULL, 0, 0, '2019-06-05 21:01:13', '2019-06-05 21:01:13'),
	(38, 4, 'post', 'мур', 1, NULL, NULL, 0, 0, '2019-06-05 21:01:41', '2019-06-05 21:01:41'),
	(39, 4, 'post', 'кур', 1, 38, NULL, 0, 0, '2019-06-05 21:01:46', '2019-06-05 21:01:46'),
	(40, 4, 'post', 'куря', 1, NULL, NULL, 0, 0, '2019-06-05 21:02:44', '2019-06-05 21:02:44'),
	(41, 4, 'post', 'муря', 1, 40, 40, 0, 0, '2019-06-05 21:02:49', '2019-06-05 21:02:49'),
	(42, 4, 'post', 'киска', 1, 41, 40, 0, 0, '2019-06-05 21:02:56', '2019-06-05 21:02:56'),
	(43, 4, 'post', 'киска', 1, 41, 40, 0, 0, '2019-06-05 21:02:56', '2019-06-05 21:02:56'),
	(44, 4, 'post', 'test', 1, NULL, NULL, 0, 0, '2019-06-05 21:07:03', '2019-06-05 21:07:03'),
	(45, 4, 'post', 'test', 1, NULL, NULL, 0, 0, '2019-06-05 21:07:17', '2019-06-05 21:07:17'),
	(46, 4, 'post', 'dsadas', 1, NULL, NULL, 0, 0, '2019-06-05 21:07:39', '2019-06-05 21:07:39'),
	(47, 4, 'post', '123\r\nqwe', 1, NULL, NULL, 0, 0, '2019-06-05 21:08:08', '2019-06-05 21:08:08'),
	(48, 4, 'post', 'tet\r\n123', 1, NULL, NULL, 0, 0, '2019-06-05 21:08:53', '2019-06-05 21:08:53'),
	(49, 4, 'post', 'rer', 1, 1, 1, 0, 0, '2019-06-05 21:09:50', '2019-06-05 21:09:50'),
	(50, 4, 'post', 'test', 1, 1, 1, 0, 0, '2019-06-06 20:34:32', '2019-06-06 20:34:32'),
	(51, 4, 'post', 'tt', 1, 1, 1, 0, 0, '2019-06-06 20:34:40', '2019-06-06 20:34:40'),
	(52, 4, 'post', '123wqe', 1, 48, 48, 0, 0, '2019-06-06 20:34:49', '2019-06-06 20:34:49'),
	(53, 4, 'post', '321', 1, 52, 48, 0, 0, '2019-06-06 20:34:53', '2019-06-06 20:34:53'),
	(54, 4, 'post', '33', 1, 48, 48, 0, 0, '2019-06-06 20:34:58', '2019-06-06 20:34:58'),
	(55, 4, 'post', 'test', 1, 48, 48, 0, 0, '2019-06-06 20:41:15', '2019-06-06 20:41:15'),
	(56, 4, 'post', 'tt', 1, 48, 48, 0, 0, '2019-06-06 20:41:22', '2019-06-06 20:41:22'),
	(57, 4, 'post', '123qwe', 1, 48, 48, 0, 0, '2019-06-06 20:41:36', '2019-06-06 20:41:36'),
	(58, 4, 'post', 'my bubble', 1, 48, 48, 0, 0, '2019-06-06 20:41:44', '2019-06-06 20:41:44'),
	(59, 4, 'post', 'terrra', 1, 48, 48, 0, 0, '2019-06-06 20:42:20', '2019-06-06 20:42:20'),
	(60, 4, 'post', 'sssssss', 1, 48, 48, 0, 0, '2019-06-06 20:43:15', '2019-06-06 20:43:15'),
	(61, 4, 'post', '123', 1, 60, 48, 0, 0, '2019-06-06 20:43:54', '2019-06-06 20:43:54'),
	(62, 4, 'post', '321', 1, 48, 48, 0, 0, '2019-06-06 20:43:58', '2019-06-06 20:43:58'),
	(63, 4, 'post', '333', 1, 48, 48, 0, 0, '2019-06-06 20:44:04', '2019-06-06 20:44:04'),
	(64, 4, 'post', 'dasdasdasd', 1, NULL, NULL, 0, 0, '2019-06-06 20:44:11', '2019-06-06 20:44:11'),
	(65, 4, 'post', 'aa', 1, 64, 64, 0, 0, '2019-06-06 20:44:16', '2019-06-06 20:44:16'),
	(66, 4, 'post', 'dasd', 1, 65, 64, 0, 0, '2019-06-06 20:46:01', '2019-06-06 20:46:01'),
	(67, 4, 'post', 'das', 1, 66, 64, 0, 0, '2019-06-06 20:46:16', '2019-06-06 20:46:16'),
	(68, 4, 'post', 'dasd', 1, 67, 64, 0, 0, '2019-06-06 20:46:36', '2019-06-06 20:46:36'),
	(69, 4, 'post', 'dad', 1, 68, 64, 0, 0, '2019-06-06 20:47:57', '2019-06-06 20:47:57'),
	(70, 4, 'post', 'sadsa', 1, 69, 64, 0, 0, '2019-06-06 20:48:27', '2019-06-06 20:48:27'),
	(71, 4, 'post', 'das', 1, 70, 64, 0, 0, '2019-06-06 20:48:44', '2019-06-06 20:48:44'),
	(72, 4, 'post', 'das', 1, 64, 64, 0, 0, '2019-06-06 20:48:47', '2019-06-06 20:48:47'),
	(73, 4, 'post', 'fsdd', 1, 72, 64, 0, 0, '2019-06-06 20:50:12', '2019-06-06 20:50:12'),
	(74, 4, 'post', 'ff', 1, 48, 48, 0, 0, '2019-06-06 20:50:16', '2019-06-06 20:50:16'),
	(75, 4, 'post', 'kurka', 1, 48, 48, 0, 0, '2019-06-06 20:50:22', '2019-06-06 20:50:22'),
	(76, 4, 'post', 'dasd', 1, NULL, NULL, 0, 0, '2019-06-06 20:50:28', '2019-06-06 20:50:28'),
	(77, 4, 'post', 'dasd', 1, 76, 76, 0, 0, '2019-06-06 20:50:47', '2019-06-06 20:50:47'),
	(78, 4, 'post', 'das', 1, NULL, NULL, 0, 0, '2019-06-06 20:51:02', '2019-06-06 20:51:02'),
	(79, 4, 'post', 'test', 1, NULL, NULL, 0, 0, '2019-09-02 22:00:12', '2019-09-02 22:00:12'),
	(80, 4, 'post', 'tt', 1, NULL, NULL, 0, 0, '2019-09-02 22:00:32', '2019-09-02 22:00:32'),
	(81, 1, 'advertisement', 'tesst', 1, NULL, NULL, 0, 0, '2019-09-02 22:07:50', '2019-09-02 22:07:50'),
	(82, 1, 'advertisement', 'ничоси!', 1, 81, 81, 0, 0, '2019-09-02 22:08:10', '2019-09-02 22:08:10'),
	(83, 1, 'advertisement', 'плохой отзыв', 1, NULL, NULL, 1, 0, '2019-09-03 00:00:35', '2019-09-03 00:00:35'),
	(84, 1, 'advertisement', 'нейтральный отзыв', 1, NULL, NULL, 1, 0, '2019-09-03 00:00:41', '2019-09-03 00:00:41'),
	(85, 1, 'advertisement', 'хороший отзыв', 1, NULL, NULL, 1, 0, '2019-09-03 00:00:47', '2019-09-03 00:00:47'),
	(86, 1, 'advertisement', 'хороший отзыв', 1, NULL, NULL, 1, 0, '2019-09-03 00:00:54', '2019-09-03 00:00:54'),
	(87, 1, 'advertisement', 'плохой отзыв', 1, NULL, NULL, -1, 0, '2019-09-03 00:01:35', '2019-09-03 00:01:35'),
	(88, 1, 'advertisement', 'средний отзыв', 1, NULL, NULL, 0, 0, '2019-09-03 00:01:46', '2019-09-03 00:01:46'),
	(89, 1, 'advertisement', 'крутой отзыв', 1, NULL, NULL, 1, 0, '2019-09-03 00:01:53', '2019-09-03 00:01:53');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Дамп структуры для таблица adv.email_subscribtion
CREATE TABLE IF NOT EXISTS `email_subscribtion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.email_subscribtion: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `email_subscribtion` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_subscribtion` ENABLE KEYS */;

-- Дамп структуры для таблица adv.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.failed_jobs: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Дамп структуры для таблица adv.favorite
CREATE TABLE IF NOT EXISTS `favorite` (
  `id` int(10) unsigned NOT NULL,
  `type` enum('advertisement','post','page') DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы adv.favorite: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `favorite` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorite` ENABLE KEYS */;

-- Дамп структуры для таблица adv.forms
CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `div_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `div_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_personal` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.forms: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
INSERT INTO `forms` (`id`, `name`, `div_class`, `div_id`, `is_personal`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Свяжитесь со мной', 'contact-form', NULL, 1, 1, '2018-10-16 23:00:52', '2018-10-16 20:10:43'),
	(2, 'Индивидуальный пакет', NULL, NULL, 1, 1, '2018-10-16 23:00:52', '2018-10-16 20:10:43'),
	(3, 'Программа Бизнес', 'send_immediatly', NULL, 0, 1, '2018-11-18 20:13:48', '2018-11-18 20:13:48'),
	(4, 'Скачать (Блог)', 'blog-download-form', NULL, 1, 1, '2018-11-18 20:13:48', '2018-11-18 20:13:48'),
	(5, 'Заказать обратный звонок', NULL, NULL, 0, 1, '2019-05-07 00:58:48', '2019-05-07 00:58:48');
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;

-- Дамп структуры для таблица adv.form_clients
CREATE TABLE IF NOT EXISTS `form_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `form_clients_form_id_foreign` (`form_id`),
  CONSTRAINT `form_clients_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.form_clients: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `form_clients` DISABLE KEYS */;
INSERT INTO `form_clients` (`id`, `email`, `form_id`, `created_at`, `updated_at`) VALUES
	(5, 'yesterdayy@ya.ru', 2, '2019-06-10 21:51:51', '2019-06-10 21:51:51');
/*!40000 ALTER TABLE `form_clients` ENABLE KEYS */;

-- Дамп структуры для таблица adv.form_clients_info
CREATE TABLE IF NOT EXISTS `form_clients_info` (
  `client_id` int(10) unsigned NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `field` (`field`),
  KEY `client_id` (`client_id`),
  FULLTEXT KEY `value` (`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.form_clients_info: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `form_clients_info` DISABLE KEYS */;
INSERT INTO `form_clients_info` (`client_id`, `field`, `value`) VALUES
	(5, 'fio', 'Юрий Нечаев'),
	(5, 'email', 'yesterdayy@ya.ru'),
	(5, 'message', 'Тест');
/*!40000 ALTER TABLE `form_clients_info` ENABLE KEYS */;

-- Дамп структуры для таблица adv.form_fields
CREATE TABLE IF NOT EXISTS `form_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placeholder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_required` tinyint(4) NOT NULL DEFAULT '0',
  `div_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `div_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `form_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `form_fields_form_id_foreign` (`form_id`),
  CONSTRAINT `form_fields_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.form_fields: ~11 rows (приблизительно)
/*!40000 ALTER TABLE `form_fields` DISABLE KEYS */;
INSERT INTO `form_fields` (`id`, `type`, `name`, `placeholder`, `value`, `label`, `is_required`, `div_id`, `div_class`, `order`, `form_id`) VALUES
	(1, 'contact-btn', NULL, NULL, NULL, 'Выберите удобный способ связи:', 1, NULL, NULL, 0, 1),
	(2, 'submit', NULL, NULL, 'СВЯЖИТЕСЬ СО МНОЙ', NULL, 0, NULL, NULL, 1, 1),
	(3, 'text', 'fio', 'ФИО', NULL, 'Введите Ваше ФИО', 1, NULL, NULL, 0, 2),
	(4, 'contact-btn', NULL, NULL, NULL, 'Выберите удобный способ связи:', 1, NULL, NULL, 1, 2),
	(5, 'textarea', 'message', 'Я не могу понять какая ниша мне подходит', NULL, 'Опишите кратко что Вас беспокоит', 1, NULL, NULL, 2, 2),
	(6, 'submit', NULL, NULL, 'СВЯЖИТЕСЬ СО МНОЙ', NULL, 0, NULL, NULL, 3, 2),
	(7, 'pay-btn', NULL, NULL, NULL, 'Выберите удобный способ оплаты:', 1, NULL, NULL, 0, 3),
	(8, 'email', 'email', 'SPARROW@MAIL.RU', NULL, NULL, 1, NULL, NULL, 0, 4),
	(9, 'submit', NULL, NULL, 'СКАЧАТЬ', NULL, 0, NULL, NULL, 1, 4),
	(10, 'text', 'phone', NULL, NULL, 'Введите номер телефона', 1, NULL, NULL, 0, 5),
	(11, 'submit', NULL, NULL, 'ПОЗВОНИТЬ МНЕ', NULL, 0, NULL, NULL, 1, 5);
/*!40000 ALTER TABLE `form_fields` ENABLE KEYS */;

-- Дамп структуры для таблица adv.form_templates
CREATE TABLE IF NOT EXISTS `form_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `email_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_reply_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modal_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modal_content` text COLLATE utf8mb4_unicode_ci,
  `modal_buttons` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.form_templates: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `form_templates` DISABLE KEYS */;
INSERT INTO `form_templates` (`id`, `form_id`, `email_from`, `email_reply_to`, `email_template`, `modal_title`, `modal_content`, `modal_buttons`) VALUES
	(1, 1, 'yesterdayy33@gmail.com', NULL, NULL, 'Спасибо. Заявка отправлена', '<p>Спасибо. Я свяжусь с Вами в течении 48 часов.</p>\r\n                <p>А пока Вы можете подписаться на Блог если Вы этого еще не сделали :)</p>', '[{"text":"Подписаться на блог","class":"btn-primary btn-rounded center","onclick":"blog_subscribe_button()"}]'),
	(2, 5, 'yesterdayy33@gmail.com', NULL, NULL, 'Спасибо. Заявка отправлена', '<p>Спасибо. Я свяжусь с Вами в течении 48 часов.</p>\r\n                <p>А пока Вы можете подписаться на Блог если Вы этого еще не сделали :)</p>', '[{"text":"Подписаться на блог","class":"btn-primary btn-rounded center","onclick":"blog_subscribe_button()"}]');
/*!40000 ALTER TABLE `form_templates` ENABLE KEYS */;

-- Дамп структуры для таблица adv.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.jobs: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

-- Дамп структуры для таблица adv.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `robot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `style` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth` tinyint(1) NOT NULL DEFAULT '0',
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.menu: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Дамп структуры для таблица adv.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.migrations: ~41 rows (приблизительно)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(77, '2018_10_04_182658_blog_settings', 1),
	(130, '2018_10_08_183925_foreigns', 2),
	(208, '2014_10_12_000000_create_users_table', 3),
	(209, '2014_10_12_100000_create_password_resets_table', 3),
	(210, '2018_10_04_162750_blog_prices_cats', 3),
	(211, '2018_10_04_182211_blog_menu', 3),
	(212, '2018_10_04_182319_blog_tags', 3),
	(213, '2018_10_04_182439_blog_email_subscribtion', 3),
	(214, '2018_10_04_182658_settings', 3),
	(215, '2018_10_04_182829_blog_prices', 3),
	(216, '2018_10_04_182957_blog_attachment', 3),
	(217, '2018_10_04_183546_blog_cats', 3),
	(218, '2018_10_04_190721_blog_reviews_source', 3),
	(219, '2018_10_04_190725_blog_reviews', 3),
	(220, '2018_10_07_162610_blog_prices_list', 3),
	(221, '2018_10_07_165833_blog_entry', 3),
	(222, '2018_10_07_170152_blog_menu_list', 3),
	(223, '2018_10_07_170321_roles', 3),
	(224, '2018_10_07_170759_groups', 3),
	(225, '2018_10_07_170780_user_groups', 3),
	(226, '2018_10_07_170819_group_roles', 3),
	(227, '2018_10_07_182840_blog_comments', 3),
	(228, '2018_10_07_182842_blog_entry_tags', 3),
	(229, '2018_10_07_182845_blog_entry_cats', 3),
	(230, '2018_10_08_183757_blog_entry_counters', 3),
	(231, '2018_10_16_174658_forms', 3),
	(232, '2018_10_16_174859_forms_fields', 3),
	(233, '2018_10_16_175311_forms_clients', 3),
	(234, '2018_10_16_183925_foreigns', 3),
	(235, '2019_03_14_221656_form_tempaltes', 4),
	(236, '2015_04_12_000000_create_orchid_users_table', 5),
	(237, '2015_04_15_102754_create_orchid_tags_table', 5),
	(238, '2015_04_15_105754_create_orchid_menu_table', 6),
	(239, '2015_10_19_214424_create_orchid_roles_table', 7),
	(240, '2015_10_19_214425_create_orchid_role_users_table', 8),
	(241, '2015_12_02_181214_create_table_settings', 9),
	(242, '2016_08_07_125128_create_orchid_attachmentstable_table', 10),
	(243, '2017_09_17_125801_create_notifications_table', 10),
	(244, '2018_09_16_190756_create_orchid_announcements_table', 10),
	(245, '2019_05_07_230701_create_jobs_table', 11),
	(246, '2019_05_08_175437_create_failed_jobs_table', 12);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Дамп структуры для таблица adv.modals
CREATE TABLE IF NOT EXISTS `modals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `selector` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trigger` enum('click','change') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'click',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `author_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.modals: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `modals` DISABLE KEYS */;
INSERT INTO `modals` (`id`, `title`, `content`, `selector`, `trigger`, `status`, `author_id`, `created_at`, `updated_at`) VALUES
	(1, 'Заказать обратный звонок', '[form id=\'5\']', '.feedback_call', 'click', 1, 1, '2019-08-29 00:20:10', '2019-08-29 00:20:10');
/*!40000 ALTER TABLE `modals` ENABLE KEYS */;

-- Дамп структуры для таблица adv.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.notifications: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
	('65ae4c86-416e-4a85-aafb-270076894f42', 'Orchid\\Platform\\Notifications\\DashboardNotification', 'Orchid\\Platform\\Models\\User', 2, '{"title":"Welcome admin","message":"You can find the latest news of the project on the website","action":"https:\\/\\/orchid.software\\/","type":"text-info","time":"2019-04-01T18:42:18.471473Z"}', NULL, '2019-04-01 18:42:18', '2019-04-01 18:42:18'),
	('d707a1ac-2e84-4675-9358-58f5e060f8fd', 'Orchid\\Platform\\Notifications\\DashboardNotification', 'Orchid\\Platform\\Models\\User', 3, '{"title":"Welcome admin","message":"You can find the latest news of the project on the website","action":"https:\\/\\/orchid.software\\/","type":"text-info","time":"2019-04-01T18:47:23.866397Z"}', NULL, '2019-04-01 18:47:23', '2019-04-01 18:47:23');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Дамп структуры для таблица adv.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.password_resets: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Дамп структуры для таблица adv.price_cards
CREATE TABLE IF NOT EXISTS `price_cards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(535) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` int(10) unsigned DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `order` int(10) unsigned DEFAULT '0',
  `status` tinyint(3) unsigned DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.price_cards: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `price_cards` DISABLE KEYS */;
INSERT INTO `price_cards` (`id`, `title`, `cost`, `content`, `order`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'ПРОГРАММА «БИЗНЕС»', 19, '<ul class="info">\r\n        <li>Выбор целевой аудитории</li>\r\n        <li>Оформление страниц в социальных сетях</li>\r\n        <li>Составление уникального контента для ЦА</li>\r\n        <li>Копирайтинг</li>\r\n        <li>Обратная связь в группе</li>\r\n        <li>Создание воронки</li>\r\n        <li>Онлайн-сессии с ответами на вопросы</li>\r\n        <li>Безлимитный доступ к платформе</li>\r\n    </ul>\r\n    <p>[form id="3"]</p>', 0, 1, '2018-11-05 20:50:32', '2018-11-05 20:50:32'),
	(2, 'ИНДИВИДУАЛЬНЫЙ ПАКЕТ', NULL, '<ul class="dash">\r\n        <li>Личное собеседование и разбор основных проблем</li>\r\n        <li>Составление плана обучения именно для Вас и для решения Ваших проблем в бизнесе</li>\r\n        <li>8 часовых занятий, за время которых Вы эти проблемы решите</li>\r\n        <li>Доведу до результата</li>\r\n    </ul>\r\n    <p>[form id="2"]</p>', 1, 1, '2018-11-05 20:50:32', '2018-11-05 20:50:32');
/*!40000 ALTER TABLE `price_cards` ENABLE KEYS */;

-- Дамп структуры для таблица adv.realty_comfort
CREATE TABLE IF NOT EXISTS `realty_comfort` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `cat_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`),
  CONSTRAINT `FK_realty_comfort_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `realty_comfort` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы adv.realty_comfort: ~13 rows (приблизительно)
/*!40000 ALTER TABLE `realty_comfort` DISABLE KEYS */;
INSERT INTO `realty_comfort` (`id`, `name`, `cat_id`) VALUES
	(1, 'Кондиционер', 1),
	(2, 'Камин', 1),
	(3, 'Балкон/Лоджия', 1),
	(4, 'Парковочное место', 1),
	(5, 'Wi-Fi', 2),
	(6, 'Телевизор', 2),
	(7, 'Кабельно/цифровое ТВ', 2),
	(8, 'Плита', 3),
	(9, 'Микроволновка', 3),
	(10, 'Холодильник', 3),
	(11, 'Стиральная машина', 3),
	(12, 'Можно с питомцами', 4),
	(13, 'Можно с детьми', 4);
/*!40000 ALTER TABLE `realty_comfort` ENABLE KEYS */;

-- Дамп структуры для таблица adv.realty_comfort_cat
CREATE TABLE IF NOT EXISTS `realty_comfort_cat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы adv.realty_comfort_cat: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `realty_comfort_cat` DISABLE KEYS */;
INSERT INTO `realty_comfort_cat` (`id`, `name`) VALUES
	(1, 'Комфорт'),
	(2, 'Мультимедиа'),
	(3, 'Бытовая техника'),
	(4, 'Дополнительно');
/*!40000 ALTER TABLE `realty_comfort_cat` ENABLE KEYS */;

-- Дамп структуры для таблица adv.realty_comments_rating
CREATE TABLE IF NOT EXISTS `realty_comments_rating` (
  `author_id` int(10) unsigned NOT NULL,
  `rating` float DEFAULT '0',
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы adv.realty_comments_rating: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `realty_comments_rating` DISABLE KEYS */;
INSERT INTO `realty_comments_rating` (`author_id`, `rating`) VALUES
	(1, 0.44),
	(3, 0);
/*!40000 ALTER TABLE `realty_comments_rating` ENABLE KEYS */;

-- Дамп структуры для таблица adv.realty_dop_type
CREATE TABLE IF NOT EXISTS `realty_dop_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.realty_dop_type: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `realty_dop_type` DISABLE KEYS */;
INSERT INTO `realty_dop_type` (`id`, `name`) VALUES
	(1, 'Новостройка'),
	(2, 'Вторичка');
/*!40000 ALTER TABLE `realty_dop_type` ENABLE KEYS */;

-- Дамп структуры для таблица adv.realty_entry
CREATE TABLE IF NOT EXISTS `realty_entry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `dop_type_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `trade_type_id` int(11) NOT NULL,
  `rent_duration_id` int(11) NOT NULL,
  `city` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `status` enum('published','blocked','trash') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_moderated` tinyint(1) DEFAULT '0',
  `expired_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.realty_entry: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `realty_entry` DISABLE KEYS */;
INSERT INTO `realty_entry` (`id`, `title`, `type_id`, `dop_type_id`, `room_type_id`, `trade_type_id`, `rent_duration_id`, `city`, `street`, `content`, `price`, `slug`, `author_id`, `status`, `is_moderated`, `expired_at`, `created_at`, `updated_at`) VALUES
	(1, 'Хата в киеве', 1, 0, 1, 0, 1, '', '', 'Сдаю хату недорого, для девушек!!', 3200, 'objava-d382jf8x', 1, 'published', 1, '2019-09-30 00:15:29', '2019-08-23 00:05:28', '2019-09-24 23:34:11'),
	(3, 'Новая хата сдаю Киев', 1, 0, 1, 0, 1, '', '', 'Найс хата же)', 15000, 'novaya-khata-sdayu-YnNYce', 1, 'published', 0, NULL, '2019-08-27 21:21:49', '2019-09-06 00:18:13'),
	(5, 'jkl', 2, 0, 2, 0, 2, '', '', '', 11, 'jkl', 1, 'published', 0, NULL, '2019-08-27 21:30:40', '2019-08-27 21:30:40'),
	(9, 'yuiy', 3, 0, 3, 0, 2, '', '', '', 11, 'yuiy', 1, 'published', 0, NULL, '2019-08-28 21:15:35', '2019-08-28 21:15:35'),
	(10, 'Сдаю 1 к.кв, ул. Симферопольская, \n7/16 этаж', 3, 0, 5, 0, 2, '', '', '', 15000, 'yuiy', 1, 'published', 0, NULL, '2019-08-28 21:29:08', '2019-08-28 21:29:08'),
	(14, '2 на 2 9 91000007000007400', 9, 9, 3, 2, 2, '9100000700000', '91000007000007400', 'Тестовое объявление.', 12000, '2-na-2-9-91000007000007400-jq5ade', 1, 'published', 0, NULL, '2019-11-03 19:13:05', '2019-11-03 19:13:05');
/*!40000 ALTER TABLE `realty_entry` ENABLE KEYS */;

-- Дамп структуры для таблица adv.realty_entry_attachments
CREATE TABLE IF NOT EXISTS `realty_entry_attachments` (
  `entry_id` int(10) unsigned DEFAULT NULL,
  `type` enum('photo') COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment_id` int(10) unsigned,
  `sort` int(10) DEFAULT '0',
  KEY `realty_attachment_entry_id_type_index` (`entry_id`),
  KEY `realty_attachment_attachment_id_type_index` (`attachment_id`),
  KEY `type` (`type`),
  CONSTRAINT `realty_entry_attachment_attachment_id_foreign` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `realty_entry_attachment_entry_id_foreign` FOREIGN KEY (`entry_id`) REFERENCES `realty_entry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.realty_entry_attachments: ~13 rows (приблизительно)
/*!40000 ALTER TABLE `realty_entry_attachments` DISABLE KEYS */;
INSERT INTO `realty_entry_attachments` (`entry_id`, `type`, `attachment_id`, `sort`) VALUES
	(1, 'photo', 241, 0),
	(1, 'photo', 242, 1),
	(1, 'photo', 244, 2),
	(1, 'photo', 243, 3),
	(1, 'photo', 245, 4),
	(1, 'photo', 249, 7),
	(1, 'photo', 249, 5),
	(1, 'photo', 250, 6),
	(14, 'photo', 409, 0),
	(14, 'photo', 408, 0),
	(14, 'photo', 410, 0),
	(14, 'photo', 411, 0),
	(14, 'photo', 412, 0);
/*!40000 ALTER TABLE `realty_entry_attachments` ENABLE KEYS */;

-- Дамп структуры для таблица adv.realty_entry_comfort
CREATE TABLE IF NOT EXISTS `realty_entry_comfort` (
  `realty_id` int(10) unsigned DEFAULT NULL,
  `comfort_id` int(10) unsigned DEFAULT NULL,
  KEY `adv_id_comfort_id` (`realty_id`,`comfort_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы adv.realty_entry_comfort: ~38 rows (приблизительно)
/*!40000 ALTER TABLE `realty_entry_comfort` DISABLE KEYS */;
INSERT INTO `realty_entry_comfort` (`realty_id`, `comfort_id`) VALUES
	(1, 1),
	(1, 1),
	(1, 1),
	(1, 3),
	(1, 3),
	(1, 3),
	(3, 2),
	(3, 2),
	(3, 2),
	(3, 2),
	(3, 2),
	(3, 2),
	(3, 2),
	(3, 2),
	(3, 3),
	(3, 3),
	(3, 3),
	(3, 3),
	(3, 3),
	(3, 3),
	(3, 3),
	(3, 3),
	(11, 1),
	(11, 5),
	(11, 6),
	(11, 12),
	(12, 1),
	(12, 5),
	(12, 6),
	(12, 12),
	(13, 1),
	(13, 5),
	(13, 6),
	(13, 12),
	(14, 1),
	(14, 5),
	(14, 6),
	(14, 12);
/*!40000 ALTER TABLE `realty_entry_comfort` ENABLE KEYS */;

-- Дамп структуры для таблица adv.realty_entry_info
CREATE TABLE IF NOT EXISTS `realty_entry_info` (
  `realty_id` int(10) unsigned NOT NULL,
  `field` enum('region','city','street','house','apartment','metro','square_common','square_living','square_kitchen','persons','owners','rooms','house_type','floor','floors','construction_year','commission','youtube','with_communal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `adv_id_field` (`realty_id`,`field`),
  KEY `adv_id_field_value` (`realty_id`,`field`,`value`),
  KEY `adv_id` (`realty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.realty_entry_info: ~70 rows (приблизительно)
/*!40000 ALTER TABLE `realty_entry_info` DISABLE KEYS */;
INSERT INTO `realty_entry_info` (`realty_id`, `field`, `value`) VALUES
	(1, 'city', '9100000700000'),
	(1, 'rooms', '5'),
	(3, 'city', '9100000700000'),
	(3, 'street', '91000007000007400'),
	(3, 'house', '35'),
	(3, 'apartment', '102'),
	(3, 'square_common', '55'),
	(3, 'square_living', '33'),
	(3, 'square_kitchen', '22'),
	(3, 'owners', '2'),
	(3, 'rooms', '2'),
	(3, 'house_type', 'кирпичный'),
	(3, 'floor', '7'),
	(3, 'floors', '12'),
	(3, 'construction_year', '1987'),
	(3, 'commission', '3000'),
	(3, 'with_communal', '1'),
	(5, 'region', 'jk'),
	(5, 'city', 'jkl'),
	(5, 'street', 'jlk'),
	(5, 'house', 'jlkkj'),
	(5, 'apartment', 'kj'),
	(5, 'metro', 'kj'),
	(5, 'square_common', 'jkl'),
	(5, 'square_living', 'jkl'),
	(5, 'square_kitchen', 'jlkj'),
	(5, 'rooms', '12'),
	(5, 'house_type', 'klj'),
	(5, 'floor', 'lkjkl'),
	(5, 'floors', 'jkkjl'),
	(5, 'construction_year', 'jjj'),
	(5, 'with_communal', '1'),
	(6, 'region', 'iuui'),
	(6, 'city', 'yiu'),
	(6, 'street', 'ui'),
	(6, 'house', 'yui'),
	(6, 'apartment', 'yuiyu'),
	(6, 'metro', 'iyui'),
	(6, 'owners', 'yui'),
	(6, 'youtube', 'youtube video'),
	(7, 'region', 'iuui'),
	(7, 'city', 'yiu'),
	(7, 'street', 'ui'),
	(7, 'house', 'yui'),
	(7, 'apartment', 'yuiyu'),
	(7, 'metro', 'iyui'),
	(7, 'owners', 'yui'),
	(7, 'youtube', 'youtube video'),
	(8, 'region', 'iuui'),
	(8, 'city', 'yiu'),
	(8, 'street', 'ui'),
	(8, 'house', 'yui'),
	(8, 'apartment', 'yuiyu'),
	(8, 'metro', 'iyui'),
	(8, 'owners', 'yui'),
	(8, 'youtube', 'youtube video'),
	(9, 'region', 'iuui'),
	(9, 'city', 'yiu'),
	(9, 'street', 'ui'),
	(9, 'house', 'yui'),
	(9, 'apartment', 'yuiyu'),
	(9, 'metro', 'iyui'),
	(9, 'owners', 'yui'),
	(9, 'youtube', 'youtube video'),
	(10, 'region', 'iuui'),
	(10, 'city', 'yiu'),
	(10, 'street', 'ui'),
	(10, 'house', 'yui'),
	(10, 'apartment', 'yuiyu'),
	(10, 'metro', 'iyui'),
	(10, 'owners', 'yui'),
	(10, 'youtube', 'youtube video');
/*!40000 ALTER TABLE `realty_entry_info` ENABLE KEYS */;

-- Дамп структуры для таблица adv.realty_rent_duration
CREATE TABLE IF NOT EXISTS `realty_rent_duration` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.realty_rent_duration: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `realty_rent_duration` DISABLE KEYS */;
INSERT INTO `realty_rent_duration` (`id`, `name`) VALUES
	(0, 'Навсегда'),
	(1, 'Длительно'),
	(2, 'Несколько месяцев'),
	(3, 'Посуточно');
/*!40000 ALTER TABLE `realty_rent_duration` ENABLE KEYS */;

-- Дамп структуры для таблица adv.realty_room_type
CREATE TABLE IF NOT EXISTS `realty_room_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.realty_room_type: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `realty_room_type` DISABLE KEYS */;
INSERT INTO `realty_room_type` (`id`, `name`, `slug`) VALUES
	(1, 'Студия', 'studiya'),
	(2, '1-комнатная', '1-komnatnaya'),
	(3, '2-комнатная', '2-komnatnaya'),
	(4, '3-комнатная', '3-komnatnaya'),
	(5, '4-комнатная', '4-komnatnaya'),
	(6, '5-комнатная +', '5-komnatnaya'),
	(7, 'Свободная планировка', 'svobodnaya-planirovka');
/*!40000 ALTER TABLE `realty_room_type` ENABLE KEYS */;

-- Дамп структуры для таблица adv.realty_trade_type
CREATE TABLE IF NOT EXISTS `realty_trade_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.realty_trade_type: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `realty_trade_type` DISABLE KEYS */;
INSERT INTO `realty_trade_type` (`id`, `name`, `slug`) VALUES
	(1, 'Аренда', 'arenda'),
	(2, 'Продажа', 'prodazha');
/*!40000 ALTER TABLE `realty_trade_type` ENABLE KEYS */;

-- Дамп структуры для таблица adv.realty_type
CREATE TABLE IF NOT EXISTS `realty_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commercy` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.realty_type: ~13 rows (приблизительно)
/*!40000 ALTER TABLE `realty_type` DISABLE KEYS */;
INSERT INTO `realty_type` (`id`, `name`, `slug`, `commercy`) VALUES
	(1, 'Квартира', 'kvartira', 0),
	(2, 'Комната', 'komnata', 0),
	(3, 'Доля', 'dolya', 0),
	(4, 'Дом', 'dom', 0),
	(5, 'Часть дома', 'chast-doma', 0),
	(6, 'Таунхаус', 'taunkhaus', 0),
	(7, 'Участок', 'uchastok', 0),
	(8, 'Офис', 'ofis', 1),
	(9, 'Торговая площадь', 'torgovaya-ploshchad\r\n', 1),
	(10, 'Склад', 'sklad', 1),
	(11, 'Общепит', 'obshchepit', 1),
	(12, 'Гараж', 'garazh', 1),
	(13, 'Готовый бизнес', 'gotovyy-biznes', 1);
/*!40000 ALTER TABLE `realty_type` ENABLE KEYS */;

-- Дамп структуры для таблица adv.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.roles: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Дамп структуры для таблица adv.role_users
CREATE TABLE IF NOT EXISTS `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.role_users: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;

-- Дамп структуры для таблица adv.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_field_unique` (`field`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.settings: ~9 rows (приблизительно)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `field`, `value`) VALUES
	(1, 'title', 'BIZDERKACH.RU'),
	(2, 'title_header', '<span class="BIZDERKACH-RU"><span class="text-biz">BIZ</span>DERKACH<span class="text-biz point">.</span><span class="bold">RU</span></span>'),
	(3, 'phone', '+ 7 (978) 710-08-22'),
	(4, 'blog_title', 'Бл<i class="icon icon-smile-cool"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>г - Татьяны Деркач'),
	(5, 'blog_subtitle', 'Подписывайся на новости и получи в подарок книгу  «Как создать свой БРЕНД» <i class="icon icon-flame"><span class="path1"></span><span class="path2"></span></i>'),
	(6, 'thumbnails_size', 'a:4:{s:5:"thumb";a:3:{s:4:"name";s:18:"Миниатюра";s:4:"slug";s:5:"thumb";s:5:"value";a:2:{i:0;s:3:"360";i:1;s:3:"240";}}s:10:"thumb-wide";a:3:{s:4:"name";s:33:"Широкая миниатюра";s:4:"slug";s:10:"thumb-wide";s:5:"value";a:2:{i:0;s:3:"740";i:1;s:3:"240";}}s:9:"post-wide";a:3:{s:4:"name";s:42:"Широкая картинка поста";s:4:"slug";s:9:"post-wide";s:5:"value";a:2:{i:0;s:4:"1280";i:1;s:3:"500";}}s:9:"thumb_200";a:3:{s:4:"name";s:41:"Стандартная миниатюра";s:4:"slug";s:9:"thumb_200";s:5:"value";a:2:{i:0;s:3:"200";i:1;s:3:"200";}}}'),
	(7, 'payment_details', 'a:4:{s:12:"yandex-money";s:18:"123456789123456789";s:4:"qiwi";s:18:"qiwi56789123456789";s:8:"webmoney";s:18:"web456789123456789";s:4:"rnkb";s:18:"rnkb56789123456789";}'),
	(8, 'admin_link', 'https://google.com'),
	(9, 'comments_moderation', '0');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Дамп структуры для таблица adv.site_reviews
CREATE TABLE IF NOT EXISTS `site_reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_ava` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_source_id` int(10) unsigned DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_reviews_customer_source_id_foreign` (`customer_source_id`),
  CONSTRAINT `blog_reviews_customer_source_id_foreign` FOREIGN KEY (`customer_source_id`) REFERENCES `site_reviews_source` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.site_reviews: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `site_reviews` DISABLE KEYS */;
INSERT INTO `site_reviews` (`id`, `customer_name`, `customer_ava`, `customer_source_id`, `message`, `created_at`, `updated_at`) VALUES
	(1, 'София Трофименко', 'ava1.png', 3, 'Очень рада что наткнулась на этот сайт, заполнила быстро форму, и через минут 5 мне сразу перезвонила Татьяна, быстро подстроилась под мою проблему и мы начали вместе решать и выдвигать варианты.', '2018-12-05 20:01:23', '2018-12-05 20:01:26'),
	(2, 'Юлия Абдуллаева', 'ava2.png', 3, 'Очень рада что наткнулась на этот сайт, заполнила быстро форму, и через минут 5 мне сразу перезвонила Татьяна, быстро подстроилась под мою проблему и мы начали вместе решать и выдвигать варианты.', '2018-12-05 20:01:28', '2018-12-05 20:01:29'),
	(3, 'Валерия Литвиненко', 'ava3.png', 3, 'Очень рада что наткнулась на этот сайт, заполнила быстро форму, и через минут 5 мне сразу перезвонила Татьяна, быстро подстроилась под мою проблему и мы начали вместе решать и выдвигать варианты.', '2018-12-05 20:01:30', '2018-12-05 20:01:31');
/*!40000 ALTER TABLE `site_reviews` ENABLE KEYS */;

-- Дамп структуры для таблица adv.site_reviews_source
CREATE TABLE IF NOT EXISTS `site_reviews_source` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `blog_reviews_source_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.site_reviews_source: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `site_reviews_source` DISABLE KEYS */;
INSERT INTO `site_reviews_source` (`id`, `name`, `status`) VALUES
	(1, 'ВКОНТАКТЕ', 1),
	(2, 'INSTAGRAM', 1),
	(3, 'ТВИТЕР', 1);
/*!40000 ALTER TABLE `site_reviews_source` ENABLE KEYS */;

-- Дамп структуры для таблица adv.tagged
CREATE TABLE IF NOT EXISTS `tagged` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `taggable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taggable_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tagged_taggable_type_taggable_id_index` (`taggable_type`,`taggable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.tagged: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `tagged` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagged` ENABLE KEYS */;

-- Дамп структуры для таблица adv.tags
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `namespace` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.tags: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;

-- Дамп структуры для таблица adv.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `realty_type` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `permissions` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `advertisement_type` (`realty_type`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.users: ~25 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `realty_type`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `last_login`, `permissions`) VALUES
	(1, 2, 'Нечаев Юрий', 'yesterdayy33@gmail.com', NULL, '$2y$10$Wjpm/CbvDd8spXHsyZTmeeDlv9v1jzQQJu/QdzJ14QaaCDyarDihu', 'JEMt27lbJ2kBHy9UYkfE5vz04kZpghliXSnADfxHUMFn9BODSk8YGaCHU9yx', '2018-10-16 18:11:31', '2019-11-03 19:10:08', '2019-05-07 21:51:19', '{"platform.index": true, "platform.systems": true, "platform.systems.menu": true, "platform.systems.index": true, "platform.systems.roles": true, "platform.systems.users": true, "platform.systems.category": true, "platform.systems.comments": true, "platform.systems.attachment": true, "platform.systems.announcement": true, "platform.entities.type.example-page": true, "platform.entities.type.example-post": true}'),
	(3, 0, 'admin', 'admin@gmail.com', NULL, '$2y$10$V77odDMUOpbsrKB6kQXfFeRGlCPoyRynPbZw7xImYunoPvnXGCLUa', NULL, '2019-04-01 18:47:23', '2019-04-01 18:47:23', NULL, '{"platform.index": true, "platform.systems": true, "platform.systems.menu": true, "platform.systems.index": true, "platform.systems.roles": true, "platform.systems.users": true, "platform.systems.category": true, "platform.systems.comments": true, "platform.systems.attachment": true, "platform.systems.announcement": true, "platform.entities.type.example-page": true, "platform.entities.type.example-post": true}'),
	(5, 0, 'yes', 'yes@ya.ru', NULL, '$2y$10$PvAiVLbSjvm5EnCU1nJQNu6KE24mEU7PHrp86OZYicmEQDT1OoeqS', NULL, '2019-07-30 21:43:54', '2019-07-30 21:43:54', NULL, NULL),
	(6, 0, 'Юрко', 'yesterdayy33s@gmail.com', NULL, '$2y$10$4c/4BEaR/FldriT4eAldP.Kk9oq..NCZk3cJYElUu2AFUj6bkNK.6', NULL, '2019-08-15 20:19:35', '2019-08-15 20:19:35', NULL, NULL),
	(7, 0, 'Юрко', 'yesterdayy33ss@gmail.com', NULL, '$2y$10$a1HsisZ1rFG18D9ZQHWjp.I39BjeenH0repa44sSN5lB/.1IVedui', NULL, '2019-08-15 20:20:52', '2019-08-15 20:20:52', NULL, NULL),
	(8, 0, 'Юрко', 'yesterdayy@gmail.com', NULL, '$2y$10$iRqATgtIVC4APmSd38IjlOq4oahuOV1oJ.CPhy1BqKUU6l6SQCUMS', NULL, '2019-08-15 20:21:56', '2019-08-15 20:21:56', NULL, NULL),
	(9, 0, 'Юрко', 'yesterdayy3@gmail.com', NULL, '$2y$10$R5hXhlK2M4YUL5TQzyRn2u/RtgtLnrC7Qj9GCou4S6gHIA0fxdWOO', NULL, '2019-08-15 20:27:23', '2019-08-15 20:27:23', NULL, NULL),
	(10, 0, 'Юрко', 'yesterdayys3@gmail.com', NULL, '$2y$10$L0pDQSWz5t30PWv67G40Iegj6sRDrEB4j5OmUltGFlVBQ0HjvCaoS', NULL, '2019-08-15 20:27:54', '2019-08-15 20:27:54', NULL, NULL),
	(11, 0, 'Юрко', 'yesterdayyss3@gmail.com', NULL, '$2y$10$8p8aTEpV0C6J1.vgNL0aKeYxWKWfZXK9UfOZsTxkTiDMO9N7zbdNS', NULL, '2019-08-15 20:28:38', '2019-08-15 20:28:38', NULL, NULL),
	(12, 0, 'Юрко', 'yesterdayysss3@gmail.com', NULL, '$2y$10$o1uUVXfddoMSkOkFJ1RKPudQNPEoYsJaejmKnHB257TiOci5IMMuC', NULL, '2019-08-15 20:30:32', '2019-08-15 20:30:32', NULL, NULL),
	(49, 0, 'Нечаев Юрий', 'yesterdayy228@gmail.com', NULL, '$2y$10$h3P1z0Cln4ZS5WGJmKqvP.O4wnwjevByi07LHZizqQliYI3TPzITO', NULL, '2019-08-17 10:45:03', '2019-08-17 10:45:03', NULL, NULL),
	(51, 0, 'dadas', 'dadas@ya.ri', NULL, '$2y$10$vqT4YTZXtC/x.U4bj8QB4OjBzqhfiDjhJ6FNErxELWc.f3v0SDFFC', NULL, '2019-08-17 10:47:03', '2019-08-17 10:47:03', NULL, NULL),
	(54, 0, 'dadas', 'dadas@ya.ri2', NULL, '$2y$10$JbvTz6/IRhlstmWRBQxx4uNy8jIF3kqYA.d1bpxIcZB9g9dBRDUzy', NULL, '2019-08-17 10:48:31', '2019-08-17 10:48:31', NULL, NULL),
	(56, 0, 'dadas', 'dadas@ya.ri22', NULL, '$2y$10$1gDC56tZhQPIqxC.3UBaIehq3HfEyDQ9ffpyaaf2gDeUk8V0ihX3C', NULL, '2019-08-17 10:51:27', '2019-08-17 10:51:27', NULL, NULL),
	(57, 0, 'ewqeqw', 'dadas@ya.test', NULL, '$2y$10$vJYwAWrtCPn6qnW9kRPKuekCvUxGEplVAkbi5CR7TyfREoZ3TKwcO', NULL, '2019-08-17 10:52:52', '2019-08-17 10:52:52', NULL, NULL),
	(64, 0, 'ewqeqw', 'tet@ya.ru', NULL, '$2y$10$rk/XUUT6RqC.SgLekuICnegFgzR4t95YPNFs8myG13w8HQVR2yaHC', NULL, '2019-08-17 10:57:22', '2019-08-17 10:57:22', NULL, NULL),
	(65, 0, 'ewqeqw', 'tesst@ya.ru', NULL, '$2y$10$Av1ao5Kb4YOD2eNeTwcsve0.q7Ec9/90k60kCFONLjWwMBNDgUYvu', NULL, '2019-08-17 10:59:13', '2019-08-17 10:59:13', NULL, NULL),
	(66, 0, 'TEST', 'ss@ya.ru', NULL, '$2y$10$ws64xLyffLRNFrYfmDe/3.xIzgc5eH2m9InkyMr4YAj4XV8ef8Lpa', NULL, '2019-08-17 11:00:05', '2019-08-17 11:00:05', NULL, NULL),
	(67, 0, 'dad', 'das@ya.ru', NULL, '$2y$10$YanYEz2ThzEC.f08FInGu.v4y5oRcjo4rzmGQUX5XIs11FLUypvym', NULL, '2019-08-20 20:21:47', '2019-08-20 20:21:47', NULL, NULL),
	(68, 0, 'dad', 'dass@ya.ru', NULL, '$2y$10$Ub2zRXhPTHKJmbHd2BQuie6CIGphxXmEmnYCyx0vg6qO8hA8bpMN.', NULL, '2019-08-20 20:22:16', '2019-08-20 20:22:16', NULL, NULL),
	(69, 0, 'dad', 'dasss@ya.ru', NULL, '$2y$10$QjVUL.1movI29CdOvNr0I.f5R3X1NLkmfGS9mUfnw1RCAXN1enqIO', NULL, '2019-08-20 20:24:14', '2019-08-20 20:24:14', NULL, NULL),
	(70, 0, 'dad', 'dassss@ya.ru', NULL, '$2y$10$dqUKZWT9kkWdR4yZQBEFBeVQ9puwacHeQumOzONAwPUNIICy.Q4Hu', NULL, '2019-08-20 20:24:49', '2019-08-20 20:24:49', NULL, NULL),
	(71, 0, 'dad', 'sadsdasda@ya.ru', NULL, '$2y$10$woMgOX4aknNQHvJ6J0Nfh.0nLX3fDX/uirOaNOJbHwtgKteq.J0z2', NULL, '2019-09-27 00:29:09', '2019-09-27 00:29:09', NULL, NULL),
	(72, 0, 'dad', 'sadsdasdsda@ya.ru', NULL, '$2y$10$gt1uULdPTE0L8tO2agDgxOGk7/eRwXhNDdanv.vekerb9UYNnv4wS', NULL, '2019-09-27 00:30:12', '2019-09-27 00:30:12', NULL, NULL),
	(73, 0, 'dada', 'das@ta.ru', NULL, '$2y$10$ELa3OIo9UakR22cQyzd7AeQ9aBP5O76koxobQNCybPZQ8J018brVS', NULL, '2019-09-27 00:30:47', '2019-09-27 00:30:47', NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Дамп структуры для таблица adv.users_company
CREATE TABLE IF NOT EXISTS `users_company` (
  `user_id` int(10) unsigned DEFAULT NULL,
  `company_id` int(10) unsigned DEFAULT NULL,
  KEY `users_company_user_id_foreign` (`user_id`),
  KEY `users_company_company_id_foreign` (`company_id`),
  CONSTRAINT `users_company_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы adv.users_company: ~17 rows (приблизительно)
/*!40000 ALTER TABLE `users_company` DISABLE KEYS */;
INSERT INTO `users_company` (`user_id`, `company_id`) VALUES
	(1, 1),
	(NULL, 2),
	(51, 3),
	(NULL, 4),
	(NULL, 5),
	(54, 6),
	(NULL, 7),
	(56, 8),
	(57, 9),
	(NULL, 10),
	(NULL, 11),
	(NULL, 12),
	(NULL, 13),
	(NULL, 14),
	(NULL, 15),
	(64, 16),
	(65, 17),
	(66, 18),
	(70, 19);
/*!40000 ALTER TABLE `users_company` ENABLE KEYS */;

-- Дамп структуры для таблица adv.users_company_attachments
CREATE TABLE IF NOT EXISTS `users_company_attachments` (
  `company_id` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `attachment_id` int(11) DEFAULT NULL,
  `is_moderated` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы adv.users_company_attachments: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `users_company_attachments` DISABLE KEYS */;
INSERT INTO `users_company_attachments` (`company_id`, `type`, `attachment_id`, `is_moderated`) VALUES
	(1, 'photo', 303, 1),
	(16, 'photo', 313, 1),
	(16, 'document', 314, 0);
/*!40000 ALTER TABLE `users_company_attachments` ENABLE KEYS */;

-- Дамп структуры для таблица adv.users_company_info
CREATE TABLE IF NOT EXISTS `users_company_info` (
  `id` int(10) unsigned NOT NULL,
  `field` enum('type','address','company_name','phone','email','vk','facebook','ok','work_time') DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  KEY `field` (`field`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы adv.users_company_info: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `users_company_info` DISABLE KEYS */;
INSERT INTO `users_company_info` (`id`, `field`, `value`) VALUES
	(1, 'address', 'ул. Демышева 136, 41'),
	(1, 'company_name', 'Zalupka228'),
	(1, 'phone', '0681541260'),
	(1, 'work_time', '10:00 - 20:00'),
	(1, 'email', 'company@gmail.com'),
	(1, 'vk', 'https://vk.com/yesterdayyy');
/*!40000 ALTER TABLE `users_company_info` ENABLE KEYS */;

-- Дамп структуры для таблица adv.users_info
CREATE TABLE IF NOT EXISTS `users_info` (
  `user_id` int(10) unsigned NOT NULL,
  `field` enum('phone','address','vk','facebook','ok') DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  KEY `field` (`field`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы adv.users_info: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `users_info` DISABLE KEYS */;
INSERT INTO `users_info` (`user_id`, `field`, `value`) VALUES
	(70, 'phone', 'test phone');
/*!40000 ALTER TABLE `users_info` ENABLE KEYS */;

-- Дамп структуры для таблица adv.users_realty_type
CREATE TABLE IF NOT EXISTS `users_realty_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы adv.users_realty_type: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `users_realty_type` DISABLE KEYS */;
INSERT INTO `users_realty_type` (`id`, `name`, `status`) VALUES
	(0, 'Неизвестно', 0),
	(1, 'Собственник', 1),
	(2, 'Риелтор', 1),
	(3, 'Застройщик', 0);
/*!40000 ALTER TABLE `users_realty_type` ENABLE KEYS */;

-- Дамп структуры для таблица adv.user_groups
CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_groups_group_id_foreign` (`group_id`),
  CONSTRAINT `user_groups_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы adv.user_groups: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
