-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2019 年 12 月 04 日 07:25
-- サーバのバージョン： 5.7.26
-- PHP のバージョン: 7.3.8

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
SET time_zone
= "+00:00";

--
-- データベース: `beauty`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `user_id`
--

CREATE TABLE `user_id`
(
  `id` int
(12) NOT NULL,
  `name` varchar
(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar
(255) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar
(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON
UPDATE CURRENT_TIMESTAMP,
  `staff_flg
` int
(1) DEFAULT NULL,
  `salon` varchar
(120) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_id`
--

INSERT INTO `user_id` (`
id`,
`name
`, `email`, `lpw`, `date`, `update_date`, `staff_flg`, `salon`) VALUES
(10, 'test', 'test@test.com', '$2y$10$y3Hg.5DcFmtHnBFRN1jnBu5Amxq5xVkk91CbDq6wyKIqImgLMzjba', '2019-11-27 16:35:57', '2019-11-27 07:35:57', 0, ''),
(12, 'test', 'test1@test.com', '$2y$10$0j97uRav6Z4AZLOgOXn.feQDh2VpZV/YlntvlBvhasJyqaOssnSW.', '2019-11-27 23:21:09', '2019-11-27 14:21:09', 0, ''),
(17, 'test111', 'test1111@test.com', '$2y$10$UtkrR.qoai3t0J0UN9sHi.R3c6cFD.x8KCfqvVj3L1H7QsZw/eqCi', '2019-11-29 17:45:08', '2019-11-29 08:45:08', 0, ''),
(18, 'test', 'test123@test.com', '$2y$10$rdB7WdP4vD/XbiZc3iW..OIwhLfavcsGPLhEy14e94DINGlNDTqcu', '2019-12-01 12:43:48', '2019-12-04 05:33:49', 0, 'KATE');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `user_id`
--
ALTER TABLE `user_id`
ADD PRIMARY KEY
(`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `user_id`
--
ALTER TABLE `user_id`
  MODIFY `id` int
(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
