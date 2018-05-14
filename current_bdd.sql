-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 14, 2018 at 06:14 PM
-- Server version: 5.6.38
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `my-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `media_id`, `title`, `content`, `created_at`) VALUES
(2, 12, '8 Inspiring Ways to Wear Dresses in the Winter', '<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce eget dictum tortor. Donec dictum vitae sapien eu varius</p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><strong>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce eget dictum tortor. Donec dictum vitae sapien eu varius</strong></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce eget dictum tortor. Donec dictum vitae sapien eu varius</p>', '2018-05-08 17:34:23'),
(3, 13, 'The Great Big List of Men’s Gifts for the Holidays', 'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce eget dictum tortor. Donec dictum vitae sapien eu varius\r\n\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce eget dictum tortor. Donec dictum vitae sapien eu varius\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce eget dictum tortor. Donec dictum vitae sapien eu varius', '2018-05-09 17:35:53'),
(4, 14, '5 Winter-to-Spring Fashion Trends to Try Now', 'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce eget dictum tortor. Donec dictum vitae sapien eu varius\r\n\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce eget dictum tortor. Donec dictum vitae sapien eu varius\r\n\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce eget dictum tortor. Donec dictum vitae sapien eu varius', '2018-05-09 17:36:41'),
(5, 15, 'test', '<p>test test v test test test test test test test test test test test test test test test</p>\r\n<p>&nbsp;</p>\r\n<p>test test v test test test test test test test test test test test test test test test test test v test test test test test test test test test test test test test test test test test v test test test test test test test test test test test test test test test test test v test test test test test test test test test test test test test test test test test v test test test test test test test test test test test test test test test test test v test test test test test test test test test test test test test test test</p>', '2018-05-10 01:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `blog_tags`
--

CREATE TABLE `blog_tags` (
  `blog_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_tags`
--

INSERT INTO `blog_tags` (`blog_id`, `tag_id`) VALUES
(2, 1),
(2, 2),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(4, 3),
(5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`id`, `name`, `media_id`) VALUES
(1, 'Collier', 2),
(2, 'Bague', 3),
(3, 'Bracelet', 4),
(4, 'Boucle d\'oreille', 5),
(5, 'Broche', 6);

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `id` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`id`, `media_id`, `name`, `created_at`) VALUES
(1, 8, 'Collection 1', '2018-05-03 11:57:30'),
(2, 6, 'test', '2018-05-10 18:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `name`) VALUES
(1, 'Labradorite'),
(2, 'Pierre de lune'),
(3, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `media__gallery`
--

CREATE TABLE `media__gallery` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `context` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media__gallery`
--

INSERT INTO `media__gallery` (`id`, `name`, `context`, `default_format`, `enabled`, `updated_at`, `created_at`) VALUES
(1, 'Eclipse', 'default', 'reference', 1, '2018-05-10 18:11:28', '2018-05-03 17:22:39'),
(2, 'Phase de Lune', 'default', 'reference', 1, '2018-05-10 17:51:52', '2018-05-10 17:51:52'),
(3, 'Moon', 'default', 'reference', 1, '2018-05-10 18:16:59', '2018-05-10 18:16:59'),
(4, 'test', 'default', 'reference', 1, '2018-05-11 03:01:20', '2018-05-11 03:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `media__gallery_media`
--

CREATE TABLE `media__gallery_media` (
  `id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media__gallery_media`
--

INSERT INTO `media__gallery_media` (`id`, `position`, `enabled`, `updated_at`, `created_at`, `gallery_id`, `media_id`) VALUES
(3, 1, 0, '2018-05-10 17:51:52', '2018-05-10 17:51:52', 2, 18),
(4, 2, 0, '2018-05-10 17:51:52', '2018-05-10 17:51:52', 2, 19),
(5, 3, 0, '2018-05-10 17:51:52', '2018-05-10 17:51:52', 2, 20),
(6, 1, 0, '2018-05-10 18:11:28', '2018-05-10 18:11:28', 1, 21),
(7, 2, 0, '2018-05-10 18:11:28', '2018-05-10 18:11:28', 1, 22),
(8, 3, 0, '2018-05-10 18:11:28', '2018-05-10 18:11:28', 1, 23),
(9, 1, 0, '2018-05-10 18:16:59', '2018-05-10 18:16:59', 3, 24),
(10, 2, 0, '2018-05-10 18:16:59', '2018-05-10 18:16:59', 3, 25),
(11, 3, 0, '2018-05-10 18:16:59', '2018-05-10 18:16:59', 3, 26),
(12, 1, 0, '2018-05-11 03:01:20', '2018-05-11 03:01:20', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `media__media`
--

CREATE TABLE `media__media` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `enabled` tinyint(1) NOT NULL,
  `provider_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_status` int(11) NOT NULL,
  `provider_reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_metadata` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:json)',
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `length` decimal(10,0) DEFAULT NULL,
  `content_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_size` int(11) DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `context` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cdn_is_flushable` tinyint(1) DEFAULT NULL,
  `cdn_flush_identifier` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cdn_flush_at` datetime DEFAULT NULL,
  `cdn_status` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media__media`
--

INSERT INTO `media__media` (`id`, `name`, `description`, `enabled`, `provider_name`, `provider_status`, `provider_reference`, `provider_metadata`, `width`, `height`, `length`, `content_type`, `content_size`, `copyright`, `author_name`, `context`, `cdn_is_flushable`, `cdn_flush_identifier`, `cdn_flush_at`, `cdn_status`, `updated_at`, `created_at`) VALUES
(1, 'NH-Hotel-Group.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'a1fdb19874a3d0895a43906a5c6b07a9be1f3935.jpeg', '{\"filename\":\"NH-Hotel-Group.jpg\"}', 765, 495, NULL, 'image/jpeg', 101071, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-02 17:47:06', '2018-05-02 17:47:06'),
(2, 'collier.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'ce1b08e093a640e146dcb24f9dc73656528ff704.jpeg', '{\"filename\":\"collier.jpg\"}', 680, 540, NULL, 'image/jpeg', 110986, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-03 11:15:27', '2018-05-03 11:15:27'),
(3, 'bague.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'd14a43e4fc4f4ab31e3a6764acd76d451af0df76.jpeg', '{\"filename\":\"bague.jpg\"}', 340, 270, NULL, 'image/jpeg', 33853, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-03 11:28:31', '2018-05-03 11:28:31'),
(4, 'bracelet.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'd0ce60ee77f25f0d14c6c3cfa62a9902978b1bef.jpeg', '{\"filename\":\"bracelet.jpg\"}', 570, 855, NULL, 'image/jpeg', 131275, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-03 11:28:59', '2018-05-03 11:28:59'),
(5, 'Boucle.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'c83558bdd0127244c86211c740c0aa8e3d37eb37.jpeg', '{\"filename\":\"Boucle.jpg\"}', 570, 855, NULL, 'image/jpeg', 143657, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-03 11:29:22', '2018-05-03 11:29:22'),
(6, 'broche.jpg', NULL, 0, 'sonata.media.provider.image', 1, '851e87859d261712ffd6b208d2f664223c9f7fca.jpeg', '{\"filename\":\"broche.jpg\"}', 570, 855, NULL, 'image/jpeg', 184502, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-03 11:29:57', '2018-05-03 11:29:57'),
(7, 'ras-de-coup.jpg', NULL, 0, 'sonata.media.provider.image', 1, '2be907ae163daf0720799da8dcfafc7c697e10fe.jpeg', '{\"filename\":\"ras-de-coup.jpg\"}', 570, 855, NULL, 'image/jpeg', 135414, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-03 11:30:18', '2018-05-03 11:30:18'),
(8, 'broche.jpg', NULL, 0, 'sonata.media.provider.image', 1, '99ed061995fd1373a802ab5185c694efa1039f88.jpeg', '{\"filename\":\"broche.jpg\"}', 570, 855, NULL, 'image/jpeg', 184502, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-03 11:57:27', '2018-05-03 11:57:27'),
(9, 'Eclipse1.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'af90f650714554eeafbc808b7727bdb839525321.jpeg', '{\"filename\":\"Eclipse1.jpg\"}', 570, 855, NULL, 'image/jpeg', 157878, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-03 17:21:55', '2018-05-03 17:21:55'),
(10, 'Eclipse2.jpg', NULL, 0, 'sonata.media.provider.image', 1, '36a129daaf2beeeee06d8b01787230c86b80c9bf.jpeg', '{\"filename\":\"Eclipse2.jpg\"}', 570, 855, NULL, 'image/jpeg', 154533, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-03 17:22:11', '2018-05-03 17:22:11'),
(11, 'Eclipse3.jpg', NULL, 0, 'sonata.media.provider.image', 1, '08778336ce0b25b6608d07b4923322f764a50f58.jpeg', '{\"filename\":\"Eclipse3.jpg\"}', 570, 855, NULL, 'image/jpeg', 121814, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-03 17:22:24', '2018-05-03 17:22:24'),
(12, 'blog-01.jpg', NULL, 0, 'sonata.media.provider.image', 1, '33cfded7b77b83204d2176deea63b95732a1d080.jpeg', '{\"filename\":\"blog-01.jpg\"}', 1200, 837, NULL, 'image/jpeg', 153571, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-09 17:31:28', '2018-05-09 17:31:28'),
(13, 'blog-02.jpg', NULL, 0, 'sonata.media.provider.image', 1, '468db28bd7ddfa5d97384583488dccc7811088cd.jpeg', '{\"filename\":\"blog-02.jpg\"}', 1200, 837, NULL, 'image/jpeg', 153478, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-09 17:35:50', '2018-05-09 17:35:50'),
(14, 'blog-03.jpg', NULL, 0, 'sonata.media.provider.image', 1, '4f13deebc045ef5150b60e90eefc8f5feb8d4511.jpeg', '{\"filename\":\"blog-03.jpg\"}', 1200, 837, NULL, 'image/jpeg', 130191, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-09 17:36:39', '2018-05-09 17:36:39'),
(15, 'gallery-02.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'f1d823421157b17e7ea211877044de59b107330f.jpeg', '{\"filename\":\"gallery-02.jpg\"}', 720, 720, NULL, 'image/jpeg', 97217, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-10 01:53:13', '2018-05-10 01:53:13'),
(16, 'item-cart-01.jpg', NULL, 0, 'sonata.media.provider.image', 1, '5b679095e78a97d4fddbe1548530c38fa0e2e467.jpeg', '{\"filename\":\"item-cart-01.jpg\"}', 60, 80, NULL, 'image/jpeg', 2812, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-10 17:35:28', '2018-05-10 17:35:28'),
(17, 'product-01.jpg', NULL, 0, 'sonata.media.provider.image', 1, '9a3c7d617a817eee20ec71a4c93874c42491f171.jpeg', '{\"filename\":\"product-01.jpg\"}', 1200, 1486, NULL, 'image/jpeg', 137393, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-10 17:35:51', '2018-05-10 17:35:51'),
(18, 'Phase de lune1.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'd2f1a0784b2e4408e5270ad458b1c8c19b63814b.jpeg', '{\"filename\":\"Phase de lune1.jpg\"}', 570, 855, NULL, 'image/jpeg', 77118, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-10 17:51:21', '2018-05-10 17:51:21'),
(19, 'Phase de lune2.jpg', NULL, 0, 'sonata.media.provider.image', 1, '1fe734fe366941faca8ebaa0884b0f248495350a.jpeg', '{\"filename\":\"Phase de lune2.jpg\"}', 570, 855, NULL, 'image/jpeg', 135414, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-10 17:51:32', '2018-05-10 17:51:32'),
(20, 'Phase de lune3.jpg', NULL, 0, 'sonata.media.provider.image', 1, '17b38a2af99301b17ea6e8f12ec0e6ed17f3c04b.jpeg', '{\"filename\":\"Phase de lune3.jpg\"}', 570, 855, NULL, 'image/jpeg', 135507, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-10 17:51:45', '2018-05-10 17:51:45'),
(21, 'Eclipse1.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'c1d82206af4bf0d5022f103ad7f2a250b9452b9a.jpeg', '{\"filename\":\"Eclipse1.jpg\"}', 570, 855, NULL, 'image/jpeg', 121814, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-10 18:10:58', '2018-05-10 18:10:58'),
(22, 'Eclipse2.jpg', NULL, 0, 'sonata.media.provider.image', 1, '51e7320cfdcf1714deed70d2a3c3fe5a1fb82cc7.jpeg', '{\"filename\":\"Eclipse2.jpg\"}', 570, 855, NULL, 'image/jpeg', 157878, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-10 18:11:10', '2018-05-10 18:11:10'),
(23, 'Eclipse3.jpg', NULL, 0, 'sonata.media.provider.image', 1, '2dfdfbc4cf8d13f7cdc55decc9619d6e6c556803.jpeg', '{\"filename\":\"Eclipse3.jpg\"}', 570, 855, NULL, 'image/jpeg', 154533, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-10 18:11:24', '2018-05-10 18:11:24'),
(24, 'Moon1.jpg', NULL, 0, 'sonata.media.provider.image', 1, '3a008443567f9e9dd0a2e9e522b0414b81c42239.jpeg', '{\"filename\":\"Moon1.jpg\"}', 570, 855, NULL, 'image/jpeg', 96038, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-10 18:16:34', '2018-05-10 18:16:34'),
(25, 'Moon2.jpg', NULL, 0, 'sonata.media.provider.image', 1, '30e5038fddbe2b705ce44e625f59279779e48580.jpeg', '{\"filename\":\"Moon2.jpg\"}', 570, 855, NULL, 'image/jpeg', 173836, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-10 18:16:44', '2018-05-10 18:16:44'),
(26, 'Moon3.jpg', NULL, 0, 'sonata.media.provider.image', 1, '226e19adb2106de65fb26ca42d4886c7bf330f7c.jpeg', '{\"filename\":\"Moon3.jpg\"}', 570, 784, NULL, 'image/jpeg', 169682, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-10 18:16:55', '2018-05-10 18:16:55'),
(27, 'slide-07.jpg', NULL, 0, 'sonata.media.provider.image', 1, '4802ed7c97966070f776997ea92a35a842f8d677.jpeg', '{\"filename\":\"slide-07.jpg\"}', 1920, 930, NULL, 'image/jpeg', 170390, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-11 00:35:20', '2018-05-11 00:35:20'),
(28, 'slide-06.jpg', NULL, 0, 'sonata.media.provider.image', 1, '3450f3f04d1b7b3d68adb04293366614942c769e.jpeg', '{\"filename\":\"slide-06.jpg\"}', 1920, 930, NULL, 'image/jpeg', 134806, NULL, NULL, 'default', NULL, NULL, NULL, NULL, '2018-05-11 00:36:00', '2018-05-11 00:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `shape_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `product_id`, `size_id`, `material_id`, `shape_id`, `user_id`, `created_at`, `quantity`) VALUES
(1, 3, NULL, NULL, NULL, NULL, '2018-05-14 13:36:39', 0),
(2, 1, NULL, NULL, NULL, NULL, '2018-05-14 13:39:06', 0),
(3, 1, NULL, NULL, NULL, NULL, '2018-05-14 13:54:53', NULL),
(4, 1, NULL, NULL, NULL, NULL, '2018-05-14 13:55:53', NULL),
(5, 1, NULL, NULL, NULL, NULL, '2018-05-14 14:04:35', NULL),
(6, 1, NULL, NULL, NULL, NULL, '2018-05-14 14:06:03', NULL),
(7, 1, NULL, NULL, NULL, NULL, '2018-05-14 14:07:46', NULL),
(8, 1, NULL, NULL, NULL, NULL, '2018-05-14 14:18:26', NULL),
(9, 1, NULL, NULL, NULL, NULL, '2018-05-14 14:18:48', NULL),
(10, 1, NULL, NULL, NULL, NULL, '2018-05-14 14:18:59', NULL),
(11, 1, NULL, NULL, NULL, NULL, '2018-05-14 14:19:37', NULL),
(12, 1, NULL, NULL, NULL, NULL, '2018-05-14 14:29:04', NULL),
(13, 4, NULL, NULL, NULL, NULL, '2018-05-14 16:51:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `collection_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `shape_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `collection_id`, `price`, `description`, `name`, `gallery_id`, `shape_id`, `created_at`) VALUES
(1, 2, 1, 35, '<p>La bague &laquo; Eclispe &raquo; est faite &agrave; partir de :</p>\r\n<ul>\r\n<li>Croissant de Plexiglass noir mate</li>\r\n<li>Pierre naturelle ronde : Pierre de lune ou Labradorite</li>\r\n<li>Rayons de soleil en acier</li>\r\n<li>Bague en plaqu&eacute; laito', 'Eclipse', 1, 1, '2018-05-10 00:00:00'),
(3, 1, 1, 65, '<p><span style=\"color: #444444; font-family: \'Graphik Webfont\', -apple-system, system-ui, Roboto, \'Droid Sans\', \'Segoe UI\', Helvetica, Arial, sans-serif; font-size: 14px;\">&laquo;&nbsp;Phase de lune&nbsp;&raquo; est un Collier ras du cou en plexiglas, vel', 'Phase de lune', 2, 1, '2018-05-10 17:54:19'),
(4, 5, 1, 15, '<p><span style=\"color: #444444; font-family: \'Graphik Webfont\', -apple-system, system-ui, Roboto, \'Droid Sans\', \'Segoe UI\', Helvetica, Arial, sans-serif; font-size: 14px;\">Les broches \"Moon &amp; Moone Crater\" sont disponibles en deux tailles:</span><br s', 'Moon', 3, 1, '2018-05-10 19:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `product_materials`
--

CREATE TABLE `product_materials` (
  `product_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_materials`
--

INSERT INTO `product_materials` (`product_id`, `material_id`) VALUES
(3, 1),
(3, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`product_id`, `size_id`) VALUES
(1, 1),
(1, 2),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `shape`
--

CREATE TABLE `shape` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shape`
--

INSERT INTO `shape` (`id`, `name`) VALUES
(1, 'Oval'),
(2, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `category_id`, `name`) VALUES
(1, 2, '4'),
(2, 2, '5'),
(3, 2, '6'),
(4, 5, '4 cm');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `product_id`, `media_id`, `title`) VALUES
(1, 1, 22, 'New Product !'),
(2, 3, 19, 'New Necklace  !');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'Fashion'),
(2, 'Life'),
(3, 'Jewelry'),
(4, 'Couple');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'admin', 'admin', 'admin@admin.fr', 'admin@admin.fr', 1, NULL, '$2y$13$25f4Pp.jJqKlslK07KwIKuCpm.P90DbaNv8B.CAIE4CMfiILABXq2', '2018-05-14 17:41:07', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C0155143EA9FDD75` (`media_id`);

--
-- Indexes for table `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD PRIMARY KEY (`blog_id`,`tag_id`),
  ADD KEY `IDX_8F6C18B6DAE07E97` (`blog_id`),
  ADD KEY `IDX_8F6C18B6BAD26311` (`tag_id`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_149244D3EA9FDD75` (`media_id`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_FC4D6532EA9FDD75` (`media_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media__gallery`
--
ALTER TABLE `media__gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media__gallery_media`
--
ALTER TABLE `media__gallery_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_80D4C5414E7AF8F` (`gallery_id`),
  ADD KEY `IDX_80D4C541EA9FDD75` (`media_id`);

--
-- Indexes for table `media__media`
--
ALTER TABLE `media__media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2530ADE64584665A` (`product_id`),
  ADD KEY `IDX_2530ADE6498DA827` (`size_id`),
  ADD KEY `IDX_2530ADE6E308AC6F` (`material_id`),
  ADD KEY `IDX_2530ADE650266CBB` (`shape_id`),
  ADD KEY `IDX_2530ADE6A76ED395` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D34A04AD4E7AF8F` (`gallery_id`),
  ADD KEY `IDX_D34A04AD12469DE2` (`category_id`),
  ADD KEY `IDX_D34A04AD514956FD` (`collection_id`),
  ADD KEY `IDX_D34A04AD50266CBB` (`shape_id`);

--
-- Indexes for table `product_materials`
--
ALTER TABLE `product_materials`
  ADD PRIMARY KEY (`product_id`,`material_id`),
  ADD KEY `IDX_F5B7A0384584665A` (`product_id`),
  ADD KEY `IDX_F5B7A038E308AC6F` (`material_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`product_id`,`size_id`),
  ADD KEY `IDX_17C2FC354584665A` (`product_id`),
  ADD KEY `IDX_17C2FC35498DA827` (`size_id`);

--
-- Indexes for table `shape`
--
ALTER TABLE `shape`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F7C0246A12469DE2` (`category_id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_72EFEE624584665A` (`product_id`),
  ADD UNIQUE KEY `UNIQ_72EFEE62EA9FDD75` (`media_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `media__gallery`
--
ALTER TABLE `media__gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `media__gallery_media`
--
ALTER TABLE `media__gallery_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `media__media`
--
ALTER TABLE `media__media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shape`
--
ALTER TABLE `shape`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `FK_C0155143EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`);

--
-- Constraints for table `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD CONSTRAINT `FK_8F6C18B6BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8F6C18B6DAE07E97` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `FK_149244D3EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`);

--
-- Constraints for table `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `FK_FC4D6532EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`);

--
-- Constraints for table `media__gallery_media`
--
ALTER TABLE `media__gallery_media`
  ADD CONSTRAINT `FK_80D4C5414E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `media__gallery` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_80D4C541EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `FK_2530ADE64584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2530ADE6498DA827` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`),
  ADD CONSTRAINT `FK_2530ADE650266CBB` FOREIGN KEY (`shape_id`) REFERENCES `shape` (`id`),
  ADD CONSTRAINT `FK_2530ADE6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_2530ADE6E308AC6F` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category_product` (`id`),
  ADD CONSTRAINT `FK_D34A04AD4E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `media__gallery` (`id`),
  ADD CONSTRAINT `FK_D34A04AD50266CBB` FOREIGN KEY (`shape_id`) REFERENCES `shape` (`id`),
  ADD CONSTRAINT `FK_D34A04AD514956FD` FOREIGN KEY (`collection_id`) REFERENCES `collection` (`id`);

--
-- Constraints for table `product_materials`
--
ALTER TABLE `product_materials`
  ADD CONSTRAINT `FK_F5B7A0384584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F5B7A038E308AC6F` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `FK_17C2FC354584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_17C2FC35498DA827` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `size`
--
ALTER TABLE `size`
  ADD CONSTRAINT `FK_F7C0246A12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category_product` (`id`);

--
-- Constraints for table `slide`
--
ALTER TABLE `slide`
  ADD CONSTRAINT `FK_72EFEE624584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_72EFEE62EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`);
