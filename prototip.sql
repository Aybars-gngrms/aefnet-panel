 -- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 05 Nis 2023, 04:47:08
-- Sunucu sürümü: 10.4.25-MariaDB
-- PHP Sürümü: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `prototip`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `banned_users`
--

CREATE TABLE `banned_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `who_banned` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ban_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gamer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ban_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ban_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban_time` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ban_status` int(11) NOT NULL,
  `banned_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ban_types`
--

CREATE TABLE `ban_types` (
  `ban_type_id` bigint(20) UNSIGNED NOT NULL,
  `ban_type_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `ban_types`
--

INSERT INTO `ban_types` (`ban_type_id`, `ban_type_title`) VALUES
(1, 'Sohbet Banı'),
(2, 'Oyun Banı'),
(3, 'Oda Kurma Banı'),
(4, 'Server Banı');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `exceptionals`
--

CREATE TABLE `exceptionals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `exceptionals`
--

INSERT INTO `exceptionals` (`id`, `name`) VALUES
(1, 'İstisna'),
(2, 'Sınırsız İstisna'),
(3, 'İstisna yok');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `managers`
--

CREATE TABLE `managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `manager_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `managers`
--

INSERT INTO `managers` (`id`, `manager_name`) VALUES
(1, 'Yönetici'),
(2, 'Admin'),
(3, 'Moderatör\r\n');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '2:Okundu 1:Gönderildi',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2023_03_11_131825_exceptionals', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(3, '2023_03_11_131007_users', 3),
(11, '2023_03_16_135727_player_nick_history', 4),
(12, '2023_03_12_112101_message', 5),
(13, '2023_03_22_125712_banned_users', 6),
(14, '2023_03_22_125735_ban_types', 7),
(15, '2023_03_26_011937_settings', 8),
(17, '2023_03_26_093823_site_settings', 10),
(18, '2023_03_27_112003_system_authorities', 11),
(19, '2023_03_29_095842_managers', 12),
(20, '2023_04_03_210950_onlines', 13);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `onlines`
--

CREATE TABLE `onlines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `online_user_count` int(11) NOT NULL,
  `online_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `onlines`
--

INSERT INTO `onlines` (`id`, `online_user_count`, `online_date`) VALUES
(1, 2, '2023-04-03 23:21:53'),
(2, 5, '2023-04-03 23:21:53');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `settings_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `settings_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `settings_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `settings_name`, `settings_description`, `settings_status`) VALUES
(1, 'Oyun Bakım Modu', 'bsIO4RtabXs2enNLs3wj9Q', '2'),
(2, 'Server Bakım Modu', 'tV9sJQDLSjm-uKzH2gem-Q', '1'),
(3, 'Genel Duyuru', 'tV9sJQDLSjm-uKzH2gem-Q', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_panel_login_form_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `site_settings`
--

INSERT INTO `site_settings` (`id`, `title`, `logo`, `email`, `favicon`, `admin_panel_login_form_title`) VALUES
(1, 'j_fOQQcbtoRNH_XHoWuBwQ', 'uploads/site_settings/aefnet.png', 'O3ukbIrpIogIY4ti_I-CgFy9DuTX0Vou-tLQS3zr22g', 'uploads/site_settings/aefnetico', 'vkM96AH2SXz7qx9Vs7Nrr18tzODHBoojtkjLwO6XN1Y');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `system_authorities`
--

CREATE TABLE `system_authorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `security_question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authority_status` int(11) NOT NULL,
  `security_answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `system_authorities`
--

INSERT INTO `system_authorities` (`id`, `name`, `email`, `password`, `security_question`, `authority_status`, `security_answer`, `last_login_date`, `created_at`) VALUES
(17, '-1o1fpEhvE0D1pQ82mINDA', 'b89rteEIiSEJ1RmmZuQHOtXduYx9LJ32g6ugzCWNZos', '$2y$10$2YD5NsWfvPNEFDCCPvFgAumWw1ua2J6Gc1teyHL87rTZdLPzMOWYK', 'w2Wf9LfhAeyQHxQvSMcPQwyPbNtpf9AILndwinBRMVQ', 1, '-1o1fpEhvE0D1pQ82mINDA', NULL, '2023-04-04 20:26:37');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gamer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exceptional_id` bigint(20) UNSIGNED NOT NULL DEFAULT 3,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `player_nick` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `security_question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `security_answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `computer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `nick_update_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `last_login_date` timestamp NULL DEFAULT NULL,
  `pc_user_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_nick_historys`
--

CREATE TABLE `user_nick_historys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gamer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_player_nick` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `banned_users`
--
ALTER TABLE `banned_users`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ban_types`
--
ALTER TABLE `ban_types`
  ADD PRIMARY KEY (`ban_type_id`);

--
-- Tablo için indeksler `exceptionals`
--
ALTER TABLE `exceptionals`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `onlines`
--
ALTER TABLE `onlines`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Tablo için indeksler `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `system_authorities`
--
ALTER TABLE `system_authorities`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_exceptional_id_foreign` (`exceptional_id`);

--
-- Tablo için indeksler `user_nick_historys`
--
ALTER TABLE `user_nick_historys`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `banned_users`
--
ALTER TABLE `banned_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Tablo için AUTO_INCREMENT değeri `ban_types`
--
ALTER TABLE `ban_types`
  MODIFY `ban_type_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `exceptionals`
--
ALTER TABLE `exceptionals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `managers`
--
ALTER TABLE `managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `onlines`
--
ALTER TABLE `onlines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `system_authorities`
--
ALTER TABLE `system_authorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Tablo için AUTO_INCREMENT değeri `user_nick_historys`
--
ALTER TABLE `user_nick_historys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_exceptional_id_foreign` FOREIGN KEY (`exceptional_id`) REFERENCES `exceptionals` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
