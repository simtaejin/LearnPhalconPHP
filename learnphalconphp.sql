-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 17-11-12 15:40
-- 서버 버전: 10.1.25-MariaDB
-- PHP 버전: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `learnphalconphp`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `project`
--

CREATE TABLE `project` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` enum('guest','user','admin') NOT NULL DEFAULT 'user',
  `deleted` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `role`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', 'test', 'admin', NULL, '2013-10-14 16:57:16', '2013-10-14 17:04:23'),
(7, 'user@user.com', '$2y$08$Q2dSMm9ORXNrbDN1clpTMOeMceNxvGJlTbwsN8vkAV83PstHieAUS', 'user', NULL, '2013-10-14 16:59:10', NULL),
(12, 'simtj53@nate.com', '$2y$08$cElHSHpHOVR1VGVPVkMzYeZrst10.ev/hSnc20qa6v59mMyM00Bkm', 'user', NULL, '2017-10-16 17:24:14', NULL),
(13, 'test@test.com', '$2y$08$bzdWUDNhYzRlWlYrQVNQT.PL1xcoCONxFbo1V644.9PAgWO7HM8fu', 'user', NULL, '2017-10-24 23:41:51', NULL);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__user` (`user_id`);

--
-- 테이블의 인덱스 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `project`
--
ALTER TABLE `project`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `FK__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
