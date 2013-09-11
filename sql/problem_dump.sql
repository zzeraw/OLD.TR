-- phpMyAdmin SQL Dump
-- version 3.4.10.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost:3306
-- Время создания: Сен 11 2013 г., 13:21
-- Версия сервера: 5.1.66
-- Версия PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `u5149395_trazumova`
--

-- --------------------------------------------------------

--
-- Структура таблицы `backgrounds`
--

DROP TABLE IF EXISTS `backgrounds`;
CREATE TABLE IF NOT EXISTS `backgrounds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `backgrounds`
--

INSERT INTO `backgrounds` (`id`, `filename`, `title`, `order`) VALUES
(1, '90232b361882c0a00e322bf5b5f4446d32d84c05.jpg', 'Фото1', NULL),
(2, 'f5e90c93177fb532a21c5283da296165b29d1e3f.jpg', 'Фото2', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `banners`
--

INSERT INTO `banners` (`id`, `filename`, `link`, `title`, `order`) VALUES
(1, 'e24ad40579124d419dda7898c37775109c069561.jpg', 'www.banner1.ru', 'Баннер 1', NULL),
(2, 'c6ec711d187fdbd94b7f1eaff8824eaa46cc2ab0.jpg', 'www.banner2.ru', 'Баннер 2', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('1787128e6dbc819347ee9d5543458b89', '31.148.71.163', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36', 1371273658, 'a:5:{s:9:"user_data";s:0:"";s:12:"recent_items";a:7:{i:0;s:2:"22";i:1;s:11:"favicon.ico";i:2;s:2:"11";i:3;s:1:"8";i:4;s:2:"21";i:5;s:2:"12";i:6;s:2:"23";}s:8:"username";s:5:"admin";s:2:"id";s:1:"3";s:8:"loggedin";b:1;}');

-- --------------------------------------------------------

--
-- Структура таблицы `colors`
--

DROP TABLE IF EXISTS `colors`;
CREATE TABLE IF NOT EXISTS `colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `colors`
--

INSERT INTO `colors` (`id`, `filename`, `title`, `order`) VALUES
(1, '0001.png', 'Черный', 1),
(2, '0002.png', 'Красный', 2),
(3, '0003.png', 'Зеленый', 3),
(4, '0004.png', 'Синий', 4),
(5, '0005.png', 'Желтый', 5),
(6, '0006.png', 'Голубой', 6),
(7, '0007.png', 'Оранжевый', 7),
(8, '0008.png', 'Серый', 8),
(9, '0009.png', 'Белый', 9),
(10, '0010.png', 'Пурпурный', 10),
(12, 'becb3de4f939868829ffb4ca3e9a4fce2a85fe8d.jpg', 'Цветы13', 11),
(13, 'a5b13e0f4b97a55f2882e6b442242f807be3447e.jpg', 'Цветы', 12),
(14, '224470f39803c80c402aa466aff69f0d711c1fd0.jpg', 'Савана', 13),
(15, '47bee904da9f649db2237a97bf429386e2b3cb06.jpg', 'Цветы', 14);

-- --------------------------------------------------------

--
-- Структура таблицы `c_collections`
--

DROP TABLE IF EXISTS `c_collections`;
CREATE TABLE IF NOT EXISTS `c_collections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(128) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `body` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `meta_title` varchar(256) DEFAULT NULL,
  `meta_keywords` varchar(256) DEFAULT NULL,
  `meta_description` varchar(256) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='Категории товаров в рамках одной секции' AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `c_collections`
--

INSERT INTO `c_collections` (`id`, `slug`, `title`, `body`, `order`, `meta_title`, `meta_keywords`, `meta_description`, `created`, `modified`) VALUES
(3, 'vesna-leto-2013', 'Весна-лето 2013', '', NULL, 'Весна-лето 2013', '', '', '2013-03-01 15:58:50', '2013-05-06 13:13:56');

-- --------------------------------------------------------

--
-- Структура таблицы `c_collections_links`
--

DROP TABLE IF EXISTS `c_collections_links`;
CREATE TABLE IF NOT EXISTS `c_collections_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) DEFAULT NULL,
  `id_collection` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='Связи между группами товаров и товарами' AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `c_collections_links`
--

INSERT INTO `c_collections_links` (`id`, `id_item`, `id_collection`) VALUES
(2, 8, 3),
(3, 9, 3),
(4, 10, 3),
(5, 11, 3),
(6, 13, 3),
(8, 15, 3),
(9, 16, 3),
(10, 17, 3),
(11, 18, 3),
(12, 19, 3),
(13, 20, 3),
(14, 21, 3),
(15, 22, 3),
(16, 23, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `c_colors`
--

DROP TABLE IF EXISTS `c_colors`;
CREATE TABLE IF NOT EXISTS `c_colors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_color` int(10) DEFAULT NULL,
  `id_c_item` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

--
-- Дамп данных таблицы `c_colors`
--

INSERT INTO `c_colors` (`id`, `id_color`, `id_c_item`) VALUES
(46, 3, 8),
(47, 4, 9),
(48, 1, 10),
(49, 2, 11),
(50, 15, 12),
(51, 3, 13),
(52, 1, 14),
(53, 1, 15),
(54, 9, 16),
(55, 12, 17),
(56, 14, 18),
(57, 1, 19),
(58, 13, 20),
(59, 4, 21),
(66, 10, 21),
(67, 1, 21),
(68, 3, 21),
(69, 6, 21),
(70, 1, 9),
(71, 3, 9),
(72, 2, 9),
(73, 4, 11),
(74, 3, 11),
(75, 1, 11),
(76, 10, 11),
(77, 9, 11),
(78, 7, 22),
(79, 12, 23),
(80, 7, 23);

-- --------------------------------------------------------

--
-- Структура таблицы `c_groups`
--

DROP TABLE IF EXISTS `c_groups`;
CREATE TABLE IF NOT EXISTS `c_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(128) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `body` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `meta_title` varchar(256) DEFAULT NULL,
  `meta_keywords` varchar(256) DEFAULT NULL,
  `meta_description` varchar(256) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Категории товаров в рамках одной секции' AUTO_INCREMENT=27 ;

--
-- Дамп данных таблицы `c_groups`
--

INSERT INTO `c_groups` (`id`, `slug`, `title`, `body`, `order`, `meta_title`, `meta_keywords`, `meta_description`, `created`, `modified`) VALUES
(6, 'platiya', 'Платья', '', 1, 'Платья', '', '', '2013-03-01 15:56:24', '2013-05-06 13:07:05'),
(7, 'blyzki-topi', 'Блузки, топы', '', 3, 'Блузки, топы', '', '', '2013-03-01 15:56:37', '2013-03-15 19:56:34'),
(8, 'detskie-platya', 'Детские платья', '', 4, 'Детские платья', '', '', '2013-03-01 15:56:53', NULL),
(9, 'aksessuary', 'Аксессуары', '', 5, 'Аксессуары', '', '', '2013-03-01 15:57:05', NULL),
(10, 'ubki', 'Юбки', '', 2, 'Юбки', '', '', '2013-03-15 19:57:57', '2013-03-15 20:00:48');

-- --------------------------------------------------------

--
-- Структура таблицы `c_groups_links`
--

DROP TABLE IF EXISTS `c_groups_links`;
CREATE TABLE IF NOT EXISTS `c_groups_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) DEFAULT NULL,
  `id_group` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Связи между группами товаров и товарами' AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `c_groups_links`
--

INSERT INTO `c_groups_links` (`id`, `id_item`, `id_group`) VALUES
(2, 21, 10),
(3, 9, 6),
(4, 8, 6),
(5, 20, 6),
(6, 19, 6),
(7, 18, 6),
(8, 17, 6),
(9, 16, 6),
(10, 15, 6),
(11, 13, 6),
(12, 12, 6),
(13, 11, 6),
(14, 10, 6),
(15, 10, 10),
(16, 22, 6),
(17, 23, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `c_images`
--

DROP TABLE IF EXISTS `c_images`;
CREATE TABLE IF NOT EXISTS `c_images` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_c_color` int(10) DEFAULT NULL,
  `id_c_item` int(10) DEFAULT NULL,
  `filename` varchar(128) DEFAULT NULL,
  `thumb` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=287 ;

--
-- Дамп данных таблицы `c_images`
--

INSERT INTO `c_images` (`id`, `id_c_color`, `id_c_item`, `filename`, `thumb`) VALUES
(93, 46, 8, 'catalog_8_46_1.jpg', 'catalog_8_46_1_thumb.jpg'),
(94, 46, 8, 'catalog_8_46_2.jpg', 'catalog_8_46_2_thumb.jpg'),
(100, 48, 10, 'catalog_10_48_1.jpg', 'catalog_10_48_1_thumb.jpg'),
(101, 48, 10, 'catalog_10_48_2.jpg', 'catalog_10_48_2_thumb.jpg'),
(102, 49, 11, 'catalog_11_49_1.jpg', 'catalog_11_49_1_thumb.jpg'),
(103, 49, 11, 'catalog_11_49_2.jpg', 'catalog_11_49_2_thumb.jpg'),
(104, 49, 11, 'catalog_11_49_3.jpg', 'catalog_11_49_3_thumb.jpg'),
(105, 50, 12, 'catalog_12_50_1.jpg', 'catalog_12_50_1_thumb.jpg'),
(106, 50, 12, 'catalog_12_50_2.jpg', 'catalog_12_50_2_thumb.jpg'),
(107, 51, 13, 'catalog_13_51_1.jpg', 'catalog_13_51_1_thumb.jpg'),
(108, 51, 13, 'catalog_13_51_2.jpg', 'catalog_13_51_2_thumb.jpg'),
(109, 52, 14, 'catalog_14_52_1.jpg', 'catalog_14_52_1_thumb.jpg'),
(110, 52, 14, 'catalog_14_52_2.jpg', 'catalog_14_52_2_thumb.jpg'),
(114, 54, 16, 'catalog_16_54_1.jpg', 'catalog_16_54_1_thumb.jpg'),
(115, 54, 16, 'catalog_16_54_2.jpg', 'catalog_16_54_2_thumb.jpg'),
(116, 55, 17, 'catalog_17_55_1.jpg', 'catalog_17_55_1_thumb.jpg'),
(117, 55, 17, 'catalog_17_55_2.jpg', 'catalog_17_55_2_thumb.jpg'),
(118, 56, 18, 'catalog_18_56_1.jpg', 'catalog_18_56_1_thumb.jpg'),
(119, 56, 18, 'catalog_18_56_2.jpg', 'catalog_18_56_2_thumb.jpg'),
(120, 57, 19, 'catalog_19_57_1.jpg', 'catalog_19_57_1_thumb.jpg'),
(121, 57, 19, 'catalog_19_57_2.jpg', 'catalog_19_57_2_thumb.jpg'),
(122, 57, 19, 'catalog_19_57_3.jpg', 'catalog_19_57_3_thumb.jpg'),
(123, 58, 20, 'catalog_20_58_1.jpg', 'catalog_20_58_1_thumb.jpg'),
(124, 58, 20, 'catalog_20_58_2.jpg', 'catalog_20_58_2_thumb.jpg'),
(151, 66, 21, 'catalog_21_66_2.jpg', 'catalog_21_66_2_thumb.jpg'),
(152, 67, 21, 'catalog_21_67_3.jpg', 'catalog_21_67_3_thumb.jpg'),
(153, 68, 21, 'catalog_21_68_4.jpg', 'catalog_21_68_4_thumb.jpg'),
(154, 69, 21, 'catalog_21_69_5.jpg', 'catalog_21_69_5_thumb.jpg'),
(160, 47, 9, 'catalog_9_47_2.jpg', 'catalog_9_47_2_thumb.jpg'),
(163, 59, 21, 'catalog_21_59_5.JPG', 'catalog_21_59_5_thumb.JPG'),
(164, 59, 21, 'catalog_21_59_6.JPG', 'catalog_21_59_6_thumb.JPG'),
(167, 47, 9, 'catalog_9_47_4.jpg', 'catalog_9_47_4_thumb.jpg'),
(179, 71, 9, 'catalog_9_71_5.jpg', 'catalog_9_71_5_thumb.jpg'),
(180, 70, 9, 'catalog_9_70_6.jpg', 'catalog_9_70_6_thumb.jpg'),
(181, 72, 9, 'catalog_9_72_6.jpg', 'catalog_9_72_6_thumb.jpg'),
(182, 53, 15, 'catalog_15_53_1.JPG', 'catalog_15_53_1_thumb.JPG'),
(183, 53, 15, 'catalog_15_53_2.JPG', 'catalog_15_53_2_thumb.JPG'),
(184, 53, 15, 'catalog_15_53_3.JPG', 'catalog_15_53_3_thumb.JPG'),
(185, 53, 15, 'catalog_15_53_4.JPG', 'catalog_15_53_4_thumb.JPG'),
(186, 53, 15, 'catalog_15_53_5.JPG', 'catalog_15_53_5_thumb.JPG'),
(187, 73, 11, 'catalog_11_73_1.jpg', 'catalog_11_73_1_thumb.jpg'),
(188, 74, 11, 'catalog_11_74_1.jpg', 'catalog_11_74_1_thumb.jpg'),
(189, 75, 11, 'catalog_11_75_1.jpg', 'catalog_11_75_1_thumb.jpg'),
(190, 76, 11, 'catalog_11_76_1.jpg', 'catalog_11_76_1_thumb.jpg'),
(191, 77, 11, 'catalog_11_77_1.jpg', 'catalog_11_77_1_thumb.jpg'),
(279, NULL, NULL, 'catalog_48__0.jpg', 'catalog_48__0_thumb.jpg'),
(280, NULL, NULL, 'catalog_48__1.jpg', 'catalog_48__1_thumb.jpg'),
(281, 78, 22, 'catalog_22_78_0.jpg', 'catalog_22_78_0_thumb.jpg'),
(282, 79, 23, 'catalog_23_79_0.jpg', 'catalog_23_79_0_thumb.jpg'),
(283, 79, 23, 'catalog_23_79_1.jpg', 'catalog_23_79_1_thumb.jpg'),
(284, 79, 23, 'catalog_23_79_2.jpg', 'catalog_23_79_2_thumb.jpg'),
(285, 80, 23, 'catalog_23_80_0.jpg', 'catalog_23_80_0_thumb.jpg'),
(286, 80, 23, 'catalog_23_80_1.jpg', 'catalog_23_80_1_thumb.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `c_items`
--

DROP TABLE IF EXISTS `c_items`;
CREATE TABLE IF NOT EXISTS `c_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(128) DEFAULT NULL,
  `article` varchar(32) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `price` varchar(32) DEFAULT NULL,
  `composition` varchar(128) DEFAULT NULL,
  `body` mediumtext,
  `meta_title` varchar(256) DEFAULT NULL,
  `meta_keywords` varchar(256) DEFAULT NULL,
  `meta_description` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица для хранения информации о товаре' AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `c_items`
--

INSERT INTO `c_items` (`id`, `slug`, `article`, `title`, `price`, `composition`, `body`, `meta_title`, `meta_keywords`, `meta_description`, `order`, `created`, `modified`) VALUES
(8, '', '', 'Платье', '4300', 'Шифон, трикотаж', '<p><span style="color: rgb(0, 0, 0); font-family: tahoma, arial, verdana, sans-serif, ''Lucida Sans''; font-size: 10.909090995788574px; line-height: 17.27272605895996px;">Шикарное платье два в одном отличающееся особой красотой и изысканностью. Верхнее платье выполнено из легкого струящегося шелка-шифона, которое прекрасно удлиняет и стройнит фигуру, создавая ореол загадочности и нежности. Нижнее платье из трикотажа подчеркивает стройность фигуры, которое можно носить отдельно.</span></p>\n', 'Платье', '', '', 2, '2013-03-01 16:21:08', '2013-03-15 23:40:08'),
(9, '', '', 'Платье', '4000', 'Трикотаж', '<p>Прекрасное платье из трикотажа. Надев его, Вы продемонстрируете свой утонченный вкус и индивидуальность. В нем Вы будете выглядеть шикарно в любой обстановке.</p>', 'Платье', '', '', 3, '2013-03-01 16:22:41', '2013-03-25 16:15:17'),
(10, '', '', 'Платье', '3800', '', '<p>Восхитительное платье сделает Вас звездой любой вечеринки. Платье из трикотажа &quot;Кристалл&quot; эффектно подчеркивает достоинства фигуры, а глубокий вырез прикрытый шифоном придает образу соблазнительную пикантность.</p>\n', 'Платье', '', '', 4, '2013-03-01 15:32:27', '2013-03-15 23:53:25'),
(11, '', '', 'Платье', '4000', '', '<p>Очень привлекательное платье из трикотажа &quot;Кристалл&quot;. Благодаря эффектному дизайну и открытой спинке изделие смотрится соблазнительно и женственно. В таком платье Вы будете заметны и изящны.</p>\n', 'Платье', '', '', 1, '2013-03-01 15:34:20', '2013-03-15 23:51:37'),
(12, '', '', 'Платье', '6800', '', '<p>Легкое, воздушное платье с принтом из натурального шелка, непременно привлечет к вам восторженные взгляды окружающих. Идеальный вариант для любой фигуры.</p>\n', 'Платье', '', '', 5, '2013-03-01 15:36:45', '2013-03-28 10:01:13'),
(13, '', '', 'Платье', '4200', '', '<p>Длинное сексуальное платье с запахом из бархата подчеркнет в Вас женственность и изящество. Вы будите неповторимой и чуть-чуть загадочной.</p>\n', 'Платье', '', '', 6, '2013-03-01 15:42:13', '2013-03-15 23:48:48'),
(15, '', '', 'Платье', '7800', 'Шифон-шелк', '<p><span style="color: rgb(0, 0, 0); font-family: tahoma, arial, verdana, sans-serif, ''Lucida Sans''; font-size: 10.909090995788574px; line-height: 17.27272605895996px;">Очаровательное изысканное платье, достойное занять почетное место в гардеробе яркой, уверенной в себе женщины, которая обладает тонким вкусом и великолепным чувством стиля! Платье состоит из двух частей &ndash; платье и шифоновая блузка, каждое из которых можно носить отдельно, создавая новые стили&hellip;Платье состоит из утягивающего корсета на шнуровке, что делает фигуру более утонченной. Корсет украшен черными стразами.</span></p>\n', 'Платье', '', '', 7, '2013-03-01 15:47:59', '2013-03-15 23:48:02'),
(16, '', '', 'Платье', '7600', 'Кружево', '<p>Очень нежное кружевное корсетное платье. Цвет подкладочной ткани в тон кожи. Платье состоит из утягивающего корсета на шнуровке, что дает возможность подчеркнуть, вашу тонкую талию.</p>\n', 'Платье', '', '', 8, '2013-03-01 15:50:35', '2013-03-15 23:46:11'),
(17, '', '', 'Платье', '9800', 'Натуральный шелк', '<p>Потрясающее платье насыщенной расцветки достойно внимания элегантных и изысканных леди. Лиф выполнен со съемными лямками. Платье сзади на молнии.</p>\n', 'Платье', '', '', 9, '2013-03-01 15:52:26', '2013-03-28 09:56:52'),
(18, '', '', 'Платье', '4700', 'Натуральный шелк', '<p><span style="color: rgb(0, 0, 0); font-family: tahoma, arial, verdana, sans-serif, ''Lucida Sans''; font-size: 10.909090995788574px; line-height: 17.27272605895996px;">Чудесное платье maxi, отличающееся особой красотой и изысканностью. Модель выполнена из легкой струящейся ткани, которая прекрасно удлиняет и стройнит фигуру. Изделие эффектной расцветки. Платье с завышенной талией на резинке, подчеркнет Вашу женственность и элегантный стиль. Отличный вариант на каждый день для истинных модниц.</span></p>\n', 'Платье', '', '', 10, '2013-03-01 15:53:46', '2013-03-28 10:00:38'),
(19, '', '', 'Платье', '6400', 'Бархат', '<p><span style="color: rgb(0, 0, 0); font-family: tahoma, arial, verdana, sans-serif, ''Lucida Sans''; font-size: 10.909090995788574px; line-height: 17.27272605895996px;">Великолепная и шикарная модель для тех, кто ценит стиль и качество. Оригинальное бархатное платье с длинными рукавами и круглым воротником. Манжеты и воротник вручную расшиты бисером, бусинами и стразами. Идеальный вариант для создания эффектного образа.</span></p>\n', 'Платье', '', '', 11, '2013-03-01 15:55:21', '2013-03-15 23:44:49'),
(20, '', '', 'Платье', '4700', 'Натуральный шелк', '<p><span style="color: rgb(0, 0, 0); font-family: tahoma, arial, verdana, sans-serif, ''Lucida Sans''; font-size: 10.909090995788574px; line-height: 17.27272605895996px;">Модель выполнена из легкой струящейся ткани, которая прекрасно удлиняет и стройнит фигуру. Изделие эффектной расцветки. Платье с завышенной талией на резинке, подчеркнет Вашу женственность и элегантный стиль. Отличный вариант на каждый день для истинных модниц.</span></p>\n', 'Платье', '', '', 12, '2013-03-01 15:56:42', '2013-03-28 09:58:19'),
(21, '', '', 'Юбка', '1700', ' Шифон', '<p><span style="color: rgb(0, 0, 0); font-family: tahoma, arial, verdana, sans-serif, ''Lucida Sans''; font-size: 10.909090995788574px; line-height: 17.27272605895996px;">Стильная юбка макси-длины смотрится невероятно женственно и эффектно. Модель насыщенного оттенка оригинально сочетается с предметами Вашего гардероба.</span></p>\n', 'Юбка', '', '', 13, '2013-03-03 12:20:26', '2013-03-15 23:40:54'),
(22, NULL, '3ergre', 'fghfgh', '2322', '554ger', '<p>dfgdgdr</p>', '', '', '', 0, NULL, NULL),
(23, NULL, 'екрек', 'мппарвап', '5643', 'екекрк', '<p>парапраераер</p>', '', '', '', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `c_sizes`
--

DROP TABLE IF EXISTS `c_sizes`;
CREATE TABLE IF NOT EXISTS `c_sizes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_c_item` int(10) DEFAULT NULL,
  `id_c_color` int(10) DEFAULT NULL,
  `size` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1338 ;

--
-- Дамп данных таблицы `c_sizes`
--

INSERT INTO `c_sizes` (`id`, `id_c_item`, `id_c_color`, `size`) VALUES
(154, 8, 46, 40),
(155, 8, 46, 42),
(156, 8, 46, 44),
(157, 8, 46, 46),
(158, 8, 46, 48),
(164, 10, 48, 40),
(165, 10, 48, 42),
(166, 10, 48, 44),
(167, 10, 48, 46),
(168, 10, 48, 48),
(170, 11, 49, 42),
(171, 11, 49, 44),
(172, 11, 49, 46),
(173, 11, 49, 48),
(174, 12, 50, 40),
(175, 12, 50, 42),
(176, 12, 50, 44),
(177, 12, 50, 46),
(178, 12, 50, 48),
(179, 13, 51, 40),
(180, 13, 51, 42),
(181, 13, 51, 44),
(182, 13, 51, 46),
(183, 13, 51, 48),
(184, 14, 52, 40),
(185, 14, 52, 42),
(186, 14, 52, 44),
(187, 14, 52, 46),
(188, 14, 52, 48),
(189, 15, 53, 40),
(190, 15, 53, 42),
(191, 15, 53, 44),
(192, 15, 53, 46),
(193, 15, 53, 48),
(194, 16, 54, 40),
(195, 16, 54, 42),
(196, 16, 54, 44),
(197, 16, 54, 46),
(198, 16, 54, 48),
(199, 17, 55, 40),
(200, 17, 55, 42),
(201, 17, 55, 44),
(202, 17, 55, 46),
(203, 17, 55, 48),
(204, 18, 56, 40),
(205, 18, 56, 42),
(206, 18, 56, 44),
(207, 18, 56, 46),
(208, 18, 56, 48),
(209, 19, 57, 40),
(210, 19, 57, 42),
(211, 19, 57, 44),
(212, 19, 57, 46),
(213, 19, 57, 48),
(214, 20, 58, 40),
(215, 20, 58, 42),
(216, 20, 58, 44),
(217, 20, 58, 46),
(218, 20, 58, 48),
(219, 21, 59, 40),
(220, 21, 59, 42),
(221, 21, 59, 44),
(222, 21, 59, 46),
(223, 21, 59, 48),
(254, 21, 66, 40),
(255, 21, 66, 42),
(256, 21, 66, 44),
(257, 21, 66, 46),
(258, 21, 66, 48),
(259, 21, 67, 40),
(260, 21, 67, 42),
(261, 21, 67, 44),
(262, 21, 67, 46),
(263, 21, 67, 48),
(264, 21, 68, 40),
(265, 21, 68, 42),
(266, 21, 68, 44),
(267, 21, 68, 46),
(268, 21, 68, 48),
(269, 21, 69, 40),
(270, 21, 69, 42),
(271, 21, 69, 44),
(272, 21, 69, 46),
(273, 21, 69, 48),
(289, 11, 73, 40),
(290, 11, 73, 42),
(291, 11, 73, 44),
(292, 11, 73, 46),
(293, 11, 73, 48),
(294, 11, 74, 40),
(295, 11, 74, 42),
(296, 11, 74, 44),
(297, 11, 74, 46),
(298, 11, 74, 48),
(299, 11, 75, 40),
(300, 11, 75, 42),
(301, 11, 75, 44),
(302, 11, 75, 46),
(303, 11, 75, 48),
(304, 11, 76, 40),
(305, 11, 76, 42),
(306, 11, 76, 44),
(307, 11, 76, 46),
(308, 11, 76, 48),
(309, 11, 77, 40),
(310, 11, 77, 42),
(311, 11, 77, 44),
(312, 11, 77, 46),
(313, 11, 77, 48),
(1299, 9, 47, 40),
(1300, 9, 47, 42),
(1301, 9, 47, 44),
(1302, 9, 47, 46),
(1303, 9, 47, 48),
(1304, 9, 70, 40),
(1305, 9, 70, 42),
(1306, 9, 70, 44),
(1307, 9, 70, 46),
(1308, 9, 70, 48),
(1309, 9, 71, 40),
(1310, 9, 71, 42),
(1311, 9, 71, 44),
(1312, 9, 71, 46),
(1313, 9, 71, 48),
(1314, 9, 72, 40),
(1315, 9, 72, 42),
(1316, 9, 72, 44),
(1317, 9, 72, 46),
(1318, 9, 72, 48),
(1324, 22, 78, 40),
(1325, 22, 78, 42),
(1326, 22, 78, 44),
(1327, 22, 78, 46),
(1328, 22, 78, 48),
(1329, 23, 79, 40),
(1330, 23, 79, 42),
(1331, 23, 79, 44),
(1332, 23, 79, 46),
(1333, 23, 79, 48),
(1334, 23, 80, 40),
(1335, 23, 80, 42),
(1336, 23, 80, 43),
(1337, 23, 80, 44);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL DEFAULT '',
  `phone` varchar(32) NOT NULL DEFAULT '',
  `fio` varchar(128) NOT NULL DEFAULT '',
  `comment` text,
  `item` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `color` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `ip` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Структура таблицы `sections`
--

DROP TABLE IF EXISTS `sections`;
CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `body` text,
  `meta_title` varchar(256) DEFAULT NULL,
  `meta_keywords` varchar(256) DEFAULT NULL,
  `meta_description` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `sections`
--

INSERT INTO `sections` (`id`, `title`, `slug`, `body`, `meta_title`, `meta_keywords`, `meta_description`, `order`, `created`, `modified`) VALUES
(1, 'Главная', 'homepage', '<p>Наше ателье - это творческая мастерская, в которой трудятся талантливые и любящие свою работу мастера, готовые к креативу и смелым экспериментам.</p>\r\n<p>Любой пошив СВАДЕБНОГО, ВЕЧЕРНЕГО, ВЫПУСКНОГО, ДЕТСКОГО и др. платьев они превращают в искусство.</p>\r\n<p>Только со вкусом одетая женщина чувствует себя прекрасной и уверенной, а значит - счастливой и успешной,</p>', 'Ателье Татьяны Разумовой', 'Ателье, Татьяна Разумова, пошив, платья, детские платья, вечерние платья, аксессуары, Чебоксары, заказ', 'Ателье Татьяны Разумовой. Пошив свадебных, вечерних, выпускных и детских платьев на заказ в городе Чебоксары.', NULL, NULL, '2013-06-14 22:00:50'),
(2, 'Индивидуальный заказ', 'individualnii-zakaz', '', 'Индивидуальный заказ', 'Ателье, Чебоксары, пошив на заказ, платья', 'Ателье Татьяны Разумовой предоставляет услуги по индивидуальному пошиву эксклюзивной женской одежды.', NULL, NULL, NULL),
(3, 'Доставка/Оплата', 'dostavka-oplata', '<p>Доставка:</p>\r\n\r\n<p>Доставка посылки осуществляется ФГУП &laquo;Почта России&raquo; по всей территории России в указанное отделение почты.</p>\r\n\r\n<p>Срок доставки зависит от удаленности региона и составляет, как правило, 6 недель. Срок доставки может быть увеличен в случаях, предусмотренных правилами работы Почты России.Почтовые отправления хранятся в отделении почтовой связи в течение 30 дней. Обращаем Ваше внимание, что операторами почтовой связи может взиматься плата за хранение почтового отправления.</p>\r\n\r\n<p>Срок бесплатного хранения и размер платы за хранение отправлений определяется в соответствии с правилами и тарифами, устанавливаемыми операторами почтовой связи, и в настоящее время составляет 5 дней бесплатного хранения. Начиная с 6 дня, плата за хранение посылки составляет 15 рублей в день. В связи с тем, что указанный тариф может меняться ФГУП &laquo;Почта России&raquo; в одностороннем порядке, ЗАО &laquo;Майл Ордер Сервис&raquo; не несет ответственность за достоверность данной информации&raquo;.</p>\r\n', '', '', '', NULL, NULL, NULL),
(4, 'Контакты', 'contacts', '<p><strong>Адрес:</strong> город Чебоксары, Приволжский бульвар, дом 4, корпус 1, офис 6.</p>\r\n\r\n<p><strong>Телефоны:</strong> +7(8352)446858, +7 903 358 68 58</p>\r\n\r\n<p><strong>Email:</strong>&nbsp;<a href="mailto:tatiana_razumova@mail.ru">tatiana_razumova@mail.ru</a></p>\r\n\r\n<div><!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (начало) -->\r\n<div id="ymaps-map-id_136263195810090765098" style="width: 450px; height: 350px;">&nbsp;</div>\r\n\r\n<div style="width: 450px; text-align: right;"><a href="http://api.yandex.ru/maps/tools/constructor/index.xml" style="color: #1A3DC1; font: 13px Arial, Helvetica, sans-serif;" target="_blank">Создано с помощью инструментов Яндекс.Карт</a></div>\r\n<script type="text/javascript">function fid_136263195810090765098(ymaps) {var map = new ymaps.Map("ymaps-map-id_136263195810090765098", {center: [47.195105685180636, 56.15314869632054], zoom: 16, type: "yandex#map"});map.controls.add("zoomControl").add("mapTools").add(new ymaps.control.TypeSelector(["yandex#map", "yandex#satellite", "yandex#hybrid", "yandex#publicMap"]));map.geoObjects.add(new ymaps.Placemark([47.19456924337751, 56.15245406032687], {balloonContent: "Ателье Татьяны Разумовой<br/>Приволжский бульвар дом 4, корпус 1, офис 6"}, {preset: "twirl#lightblueDotIcon"}));};</script><script type="text/javascript" src="http://api-maps.yandex.ru/2.0-stable/?lang=ru-RU&coordorder=longlat&load=package.full&wizard=constructor&onload=fid_136263195810090765098"></script><!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (конец) --></div>\r\n', 'Контактная информация', 'Ателье, Чебоксары, пошив на заказ, платья', 'Ателье Татьяны Разумовой предоставляет услуги по индивидуальному пошиву эксклюзивной женской одежды.', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'joost@codeigniter.tv', 'f4010782d5b056f8505d13a6ec1a3a722839fcf23ce28567e02398922a8d8bb3a7fdbc357b4e059898045b4e660007ecc05446b65b3351dcb4a362efe546032d'),
(2, 'chuck@tutsplus.com', 'f4010782d5b056f8505d13a6ec1a3a722839fcf23ce28567e02398922a8d8bb3a7fdbc357b4e059898045b4e660007ecc05446b65b3351dcb4a362efe546032d'),
(3, 'admin', '7a199ea9a05888ceff8931166d39d3bfff10d1d60b0e712e0970bdbbb8ce2ce9bf9d0e8ad58389c6b30d53954dce4b7afcb27adcfc8827ca7b68f36bf4fb7e99');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
