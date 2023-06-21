-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2023 年 6 月 21 日 17:29
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `sllev_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `answers_table`
--

CREATE TABLE `answers_table` (
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `categories_table`
--

CREATE TABLE `categories_table` (
  `category_id` int(11) NOT NULL,
  `basic_op` varchar(128) NOT NULL,
  `f_adomin` varchar(128) NOT NULL,
  `adomin` varchar(128) NOT NULL,
  `life` varchar(128) NOT NULL,
  `dis_security` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `children_table`
--

CREATE TABLE `children_table` (
  `child_id` int(11) NOT NULL,
  `under15` varchar(128) NOT NULL,
  `no` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `options_table`
--

CREATE TABLE `options_table` (
  `option_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_text` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `questions_table`
--

CREATE TABLE `questions_table` (
  `questions_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `question_text` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `rank_table`
--

CREATE TABLE `rank_table` (
  `rank_id` int(11) NOT NULL,
  `rank_name` varchar(128) NOT NULL,
  `rank_html` varchar(128) NOT NULL,
  `recommendation` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `residences_table`
--

CREATE TABLE `residences_table` (
  `residences_id` int(11) NOT NULL,
  `fukuoka_city` varchar(128) NOT NULL,
  `not_fukuoka` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `results_table`
--

CREATE TABLE `results_table` (
  `result_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL,
  `score` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `scores_table`
--

CREATE TABLE `scores_table` (
  `score_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `score` varchar(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `users_table`
--

CREATE TABLE `users_table` (
  `user_id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_αt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `answers_table`
--
ALTER TABLE `answers_table`
  ADD PRIMARY KEY (`answer_id`);

--
-- テーブルのインデックス `categories_table`
--
ALTER TABLE `categories_table`
  ADD PRIMARY KEY (`category_id`);

--
-- テーブルのインデックス `children_table`
--
ALTER TABLE `children_table`
  ADD PRIMARY KEY (`child_id`);

--
-- テーブルのインデックス `options_table`
--
ALTER TABLE `options_table`
  ADD PRIMARY KEY (`option_id`);

--
-- テーブルのインデックス `questions_table`
--
ALTER TABLE `questions_table`
  ADD PRIMARY KEY (`questions_id`);

--
-- テーブルのインデックス `rank_table`
--
ALTER TABLE `rank_table`
  ADD PRIMARY KEY (`rank_id`);

--
-- テーブルのインデックス `residences_table`
--
ALTER TABLE `residences_table`
  ADD PRIMARY KEY (`residences_id`);

--
-- テーブルのインデックス `results_table`
--
ALTER TABLE `results_table`
  ADD PRIMARY KEY (`result_id`);

--
-- テーブルのインデックス `scores_table`
--
ALTER TABLE `scores_table`
  ADD PRIMARY KEY (`score_id`);

--
-- テーブルのインデックス `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`user_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `answers_table`
--
ALTER TABLE `answers_table`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `categories_table`
--
ALTER TABLE `categories_table`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `children_table`
--
ALTER TABLE `children_table`
  MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `options_table`
--
ALTER TABLE `options_table`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `questions_table`
--
ALTER TABLE `questions_table`
  MODIFY `questions_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `rank_table`
--
ALTER TABLE `rank_table`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `residences_table`
--
ALTER TABLE `residences_table`
  MODIFY `residences_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `results_table`
--
ALTER TABLE `results_table`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `scores_table`
--
ALTER TABLE `scores_table`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
