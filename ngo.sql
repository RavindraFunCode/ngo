-- NGO Website Database Schema
-- Engine: InnoDB, Charset: utf8mb4

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- NOTE:
-- - This file does NOT include the Spatie roles/permissions tables.
--   Install spatie/laravel-permission and run its migrations separately.

--------------------------------------------------
-- 1. USERS
--------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(191) NOT NULL,
  `email` VARCHAR(191) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `avatar` VARCHAR(255) DEFAULT NULL,
  `status` ENUM('active','inactive','banned') NOT NULL DEFAULT 'active',
  `remember_token` VARCHAR(100) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--------------------------------------------------
-- 2. LANGUAGES
--------------------------------------------------
CREATE TABLE IF NOT EXISTS `languages` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(10) NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  `is_default` TINYINT(1) NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `languages_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--------------------------------------------------
-- 3. SETTINGS (GENERIC KEY-VALUE)
--------------------------------------------------
CREATE TABLE IF NOT EXISTS `settings` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `group` VARCHAR(50) NOT NULL,
  `key` VARCHAR(100) NOT NULL,
  `value` TEXT NULL,
  `type` VARCHAR(50) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_group_key_unique` (`group`, `key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--------------------------------------------------
-- 4. MENUS & MENU ITEMS
--------------------------------------------------
CREATE TABLE IF NOT EXISTS `menus` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `identifier` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_identifier_unique` (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_id` BIGINT UNSIGNED NOT NULL,
  `parent_id` BIGINT UNSIGNED DEFAULT NULL,
  `type` ENUM('internal_page','external_url','route') NOT NULL,
  `reference_id` BIGINT UNSIGNED DEFAULT NULL,
  `url` VARCHAR(255) DEFAULT NULL,
  `route_name` VARCHAR(191) DEFAULT NULL,
  `icon` VARCHAR(100) DEFAULT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_index` (`menu_id`),
  KEY `menu_items_parent_id_index` (`parent_id`),
  CONSTRAINT `menu_items_menu_id_fk` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menu_items_parent_id_fk` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `menu_item_translations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_item_id` BIGINT UNSIGNED NOT NULL,
  `language_id` BIGINT UNSIGNED NOT NULL,
  `label` VARCHAR(191) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_item_translations_item_lang_unique` (`menu_item_id`, `language_id`),
  KEY `menu_item_translations_language_id_index` (`language_id`),
  CONSTRAINT `menu_item_translations_item_fk` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menu_item_translations_language_fk` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--------------------------------------------------
-- 5. PAGES & TRANSLATIONS
--------------------------------------------------
CREATE TABLE IF NOT EXISTS `pages` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(191) NOT NULL,
  `key` VARCHAR(100) DEFAULT NULL,
  `type` ENUM('static','system','custom') NOT NULL DEFAULT 'custom',
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `show_in_sitemap` TINYINT(1) NOT NULL DEFAULT 1,
  `created_by` BIGINT UNSIGNED DEFAULT NULL,
  `updated_by` BIGINT UNSIGNED DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`),
  KEY `pages_type_index` (`type`),
  KEY `pages_key_index` (`key`),
  KEY `pages_created_by_index` (`created_by`),
  KEY `pages_updated_by_index` (`updated_by`),
  CONSTRAINT `pages_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `pages_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `page_translations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_id` BIGINT UNSIGNED NOT NULL,
  `language_id` BIGINT UNSIGNED NOT NULL,
  `title` VARCHAR(191) NOT NULL,
  `slug` VARCHAR(191) NOT NULL,
  `excerpt` TEXT DEFAULT NULL,
  `content` LONGTEXT DEFAULT NULL,
  `meta_title` VARCHAR(191) DEFAULT NULL,
  `meta_description` TEXT DEFAULT NULL,
  `meta_keywords` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_translations_page_language_unique` (`page_id`, `language_id`),
  UNIQUE KEY `page_translations_lang_slug_unique` (`language_id`, `slug`),
  KEY `page_translations_page_id_index` (`page_id`),
  KEY `page_translations_language_id_index` (`language_id`),
  CONSTRAINT `page_translations_page_fk` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `page_translations_language_fk` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--------------------------------------------------
-- 6. CAMPAIGNS & DONATIONS
--------------------------------------------------
CREATE TABLE IF NOT EXISTS `campaigns` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(191) NOT NULL,
  `status` ENUM('draft','published','archived') NOT NULL DEFAULT 'draft',
  `target_amount` DECIMAL(12,2) DEFAULT NULL,
  `raised_amount` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `currency` VARCHAR(3) NOT NULL DEFAULT 'INR',
  `start_date` DATE DEFAULT NULL,
  `end_date` DATE DEFAULT NULL,
  `featured_image` VARCHAR(255) DEFAULT NULL,
  `is_featured` TINYINT(1) NOT NULL DEFAULT 0,
  `created_by` BIGINT UNSIGNED DEFAULT NULL,
  `updated_by` BIGINT UNSIGNED DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `campaigns_slug_unique` (`slug`),
  KEY `campaigns_status_index` (`status`),
  KEY `campaigns_is_featured_index` (`is_featured`),
  KEY `campaigns_created_by_index` (`created_by`),
  KEY `campaigns_updated_by_index` (`updated_by`),
  CONSTRAINT `campaigns_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `campaigns_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `campaign_translations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `campaign_id` BIGINT UNSIGNED NOT NULL,
  `language_id` BIGINT UNSIGNED NOT NULL,
  `title` VARCHAR(191) NOT NULL,
  `slug` VARCHAR(191) NOT NULL,
  `short_description` TEXT DEFAULT NULL,
  `full_description` LONGTEXT DEFAULT NULL,
  `meta_title` VARCHAR(191) DEFAULT NULL,
  `meta_description` TEXT DEFAULT NULL,
  `meta_keywords` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `campaign_translations_campaign_language_unique` (`campaign_id`, `language_id`),
  UNIQUE KEY `campaign_translations_lang_slug_unique` (`language_id`, `slug`),
  KEY `campaign_translations_campaign_id_index` (`campaign_id`),
  KEY `campaign_translations_language_id_index` (`language_id`),
  CONSTRAINT `campaign_translations_campaign_fk` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE,
  CONSTRAINT `campaign_translations_language_fk` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `donations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `campaign_id` BIGINT UNSIGNED DEFAULT NULL,
  `user_id` BIGINT UNSIGNED DEFAULT NULL,
  `amount` DECIMAL(12,2) NOT NULL,
  `currency` VARCHAR(3) NOT NULL,
  `status` ENUM('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  `payment_gateway` VARCHAR(50) NOT NULL,
  `transaction_id` VARCHAR(191) DEFAULT NULL,
  `payment_reference` VARCHAR(191) DEFAULT NULL,
  `payment_details` JSON DEFAULT NULL,
  `donor_name` VARCHAR(191) NOT NULL,
  `donor_email` VARCHAR(191) DEFAULT NULL,
  `donor_phone` VARCHAR(50) DEFAULT NULL,
  `donor_address` TEXT DEFAULT NULL,
  `is_anonymous` TINYINT(1) NOT NULL DEFAULT 0,
  `paid_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `donations_campaign_id_index` (`campaign_id`),
  KEY `donations_user_id_index` (`user_id`),
  KEY `donations_status_index` (`status`),
  KEY `donations_payment_gateway_index` (`payment_gateway`),
  KEY `donations_transaction_id_index` (`transaction_id`),
  CONSTRAINT `donations_campaign_fk` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE SET NULL,
  CONSTRAINT `donations_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--------------------------------------------------
-- 7. VOLUNTEERS & CONTACT SUBMISSIONS
--------------------------------------------------
CREATE TABLE IF NOT EXISTS `volunteers` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(191) NOT NULL,
  `email` VARCHAR(191) NOT NULL,
  `phone` VARCHAR(50) DEFAULT NULL,
  `address` TEXT DEFAULT NULL,
  `interest_areas` JSON DEFAULT NULL,
  `experience` TEXT DEFAULT NULL,
  `availability` VARCHAR(191) DEFAULT NULL,
  `notes` TEXT DEFAULT NULL,
  `status` ENUM('new','in_review','approved','rejected') NOT NULL DEFAULT 'new',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `volunteers_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `contact_submissions` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(191) NOT NULL,
  `email` VARCHAR(191) NOT NULL,
  `phone` VARCHAR(50) DEFAULT NULL,
  `subject` VARCHAR(191) DEFAULT NULL,
  `message` TEXT NOT NULL,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `user_agent` TEXT DEFAULT NULL,
  `handled_by` BIGINT UNSIGNED DEFAULT NULL,
  `handled_at` TIMESTAMP NULL DEFAULT NULL,
  `status` ENUM('new','in_progress','closed') NOT NULL DEFAULT 'new',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_submissions_status_index` (`status`),
  KEY `contact_submissions_handled_by_index` (`handled_by`),
  CONSTRAINT `contact_submissions_handled_by_fk` FOREIGN KEY (`handled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--------------------------------------------------
-- 8. BLOG / NEWS
--------------------------------------------------
CREATE TABLE IF NOT EXISTS `post_categories` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(191) NOT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `post_category_translations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` BIGINT UNSIGNED NOT NULL,
  `language_id` BIGINT UNSIGNED NOT NULL,
  `name` VARCHAR(191) NOT NULL,
  `slug` VARCHAR(191) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_cat_trans_cat_lang_unique` (`category_id`, `language_id`),
  UNIQUE KEY `post_cat_trans_lang_slug_unique` (`language_id`, `slug`),
  KEY `post_cat_trans_category_id_index` (`category_id`),
  KEY `post_cat_trans_language_id_index` (`language_id`),
  CONSTRAINT `post_cat_trans_category_fk` FOREIGN KEY (`category_id`) REFERENCES `post_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_cat_trans_language_fk` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `posts` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(191) NOT NULL,
  `category_id` BIGINT UNSIGNED DEFAULT NULL,
  `status` ENUM('draft','published') NOT NULL DEFAULT 'draft',
  `featured_image` VARCHAR(255) DEFAULT NULL,
  `author_id` BIGINT UNSIGNED DEFAULT NULL,
  `published_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_status_index` (`status`),
  KEY `posts_category_id_index` (`category_id`),
  KEY `posts_published_at_index` (`published_at`),
  KEY `posts_author_id_index` (`author_id`),
  CONSTRAINT `posts_category_fk` FOREIGN KEY (`category_id`) REFERENCES `post_categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `posts_author_fk` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `post_translations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` BIGINT UNSIGNED NOT NULL,
  `language_id` BIGINT UNSIGNED NOT NULL,
  `title` VARCHAR(191) NOT NULL,
  `slug` VARCHAR(191) NOT NULL,
  `excerpt` TEXT DEFAULT NULL,
  `content` LONGTEXT NOT NULL,
  `meta_title` VARCHAR(191) DEFAULT NULL,
  `meta_description` TEXT DEFAULT NULL,
  `meta_keywords` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_translations_post_language_unique` (`post_id`, `language_id`),
  UNIQUE KEY `post_translations_lang_slug_unique` (`language_id`, `slug`),
  KEY `post_translations_post_id_index` (`post_id`),
  KEY `post_translations_language_id_index` (`language_id`),
  CONSTRAINT `post_translations_post_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_translations_language_fk` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- OPTIONAL TAGS (IF YOU WANT TAGGING)
CREATE TABLE IF NOT EXISTS `tags` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(191) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `tag_translations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tag_id` BIGINT UNSIGNED NOT NULL,
  `language_id` BIGINT UNSIGNED NOT NULL,
  `name` VARCHAR(191) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_trans_tag_lang_unique` (`tag_id`, `language_id`),
  KEY `tag_trans_language_id_index` (`language_id`),
  CONSTRAINT `tag_trans_tag_fk` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tag_trans_language_fk` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `post_tag` (
  `post_id` BIGINT UNSIGNED NOT NULL,
  `tag_id` BIGINT UNSIGNED NOT NULL,
  PRIMARY KEY (`post_id`, `tag_id`),
  KEY `post_tag_tag_id_index` (`tag_id`),
  CONSTRAINT `post_tag_post_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_tag_tag_fk` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--------------------------------------------------
-- 9. MEDIA LIBRARY
--------------------------------------------------
CREATE TABLE IF NOT EXISTS `media` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `file_name` VARCHAR(191) NOT NULL,
  `original_name` VARCHAR(191) DEFAULT NULL,
  `disk` VARCHAR(50) NOT NULL DEFAULT 'public',
  `path` VARCHAR(255) NOT NULL,
  `mime_type` VARCHAR(100) DEFAULT NULL,
  `size` BIGINT DEFAULT NULL,
  `alt_text` VARCHAR(191) DEFAULT NULL,
  `uploaded_by` BIGINT UNSIGNED DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_disk_index` (`disk`),
  KEY `media_uploaded_by_index` (`uploaded_by`),
  CONSTRAINT `media_uploaded_by_fk` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--------------------------------------------------
-- 10. EMAIL TEMPLATES
--------------------------------------------------
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `subject` VARCHAR(191) NOT NULL,
  `body` LONGTEXT NOT NULL,
  `description` TEXT DEFAULT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_templates_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--------------------------------------------------
-- 11. ANALYTICS & ACTIVITY LOGS
--------------------------------------------------
CREATE TABLE IF NOT EXISTS `visit_logs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_id` VARCHAR(191) DEFAULT NULL,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `user_id` BIGINT UNSIGNED DEFAULT NULL,
  `url` VARCHAR(255) NOT NULL,
  `referrer` VARCHAR(255) DEFAULT NULL,
  `user_agent` TEXT DEFAULT NULL,
  `visited_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `visit_logs_visited_at_index` (`visited_at`),
  KEY `visit_logs_url_index` (`url`),
  KEY `visit_logs_user_id_index` (`user_id`),
  CONSTRAINT `visit_logs_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `activity_logs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT UNSIGNED DEFAULT NULL,
  `action` VARCHAR(100) NOT NULL,
  `model_type` VARCHAR(191) DEFAULT NULL,
  `model_id` BIGINT UNSIGNED DEFAULT NULL,
  `properties` JSON DEFAULT NULL,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_user_id_index` (`user_id`),
  KEY `activity_logs_model_index` (`model_type`, `model_id`),
  CONSTRAINT `activity_logs_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
