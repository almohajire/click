-- Click Master System Database Schema
-- MySQL Database Creation Script
-- Compatible with Laravel 9

-- إنشاء قاعدة البيانات
CREATE DATABASE IF NOT EXISTS `click_master` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `click_master`;

-- جدول المستخدمين
CREATE TABLE IF NOT EXISTS `users` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL UNIQUE,
    `password` varchar(255) NOT NULL,
    `number_click` int(10) unsigned NOT NULL DEFAULT '0',
    `points` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
    `number_clicked` int(10) unsigned NOT NULL DEFAULT '0',
    `in_need` tinyint(1) NOT NULL DEFAULT '0',
    `role` tinyint(3) unsigned NOT NULL DEFAULT '0',
    `color` tinyint(3) unsigned NOT NULL DEFAULT '0',
    `shorten_open` tinyint(1) NOT NULL DEFAULT '0',
    `shorten_url` varchar(255) NOT NULL DEFAULT 'https://bitly.com',
    `credit_add` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
    `remember_token` varchar(100) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `users_number_click_index` (`number_click`),
    KEY `users_points_index` (`points`),
    KEY `users_number_clicked_index` (`number_clicked`),
    KEY `users_in_need_index` (`in_need`),
    KEY `users_role_index` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- جدول الروابط
CREATE TABLE IF NOT EXISTS `links` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `link` varchar(255) NOT NULL UNIQUE,
    `clicked` int(11) NOT NULL DEFAULT '0',
    `confirmed` tinyint(1) NOT NULL DEFAULT '0',
    `hash` varchar(255) NOT NULL UNIQUE,
    `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
    `user_id` int(10) unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `links_clicked_index` (`clicked`),
    KEY `links_confirmed_index` (`confirmed`),
    KEY `links_level_index` (`level`),
    KEY `links_user_id_index` (`user_id`),
    KEY `links_user_id_confirmed_index` (`user_id`, `confirmed`),
    KEY `links_level_confirmed_index` (`level`, `confirmed`),
    CONSTRAINT `links_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- جدول إعادة تعيين كلمات المرور
CREATE TABLE IF NOT EXISTS `password_resets` (
    `email` varchar(255) NOT NULL,
    `token` varchar(255) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- جدول التقارير
CREATE TABLE IF NOT EXISTS `reports` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int(10) unsigned NOT NULL,
    `link_id` int(10) unsigned NOT NULL,
    `reason` text NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `reports_user_id_index` (`user_id`),
    KEY `reports_link_id_index` (`link_id`),
    CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `reports_link_id_foreign` FOREIGN KEY (`link_id`) REFERENCES `links` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- جدول الإعلانات
CREATE TABLE IF NOT EXISTS `ads` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `content` text NOT NULL,
    `image` varchar(255) DEFAULT NULL,
    `active` tinyint(1) NOT NULL DEFAULT '1',
    `user_id` int(10) unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `ads_user_id_index` (`user_id`),
    KEY `ads_active_index` (`active`),
    CONSTRAINT `ads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- جدول الإعدادات
CREATE TABLE IF NOT EXISTS `configs` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `key` varchar(255) NOT NULL UNIQUE,
    `value` text NOT NULL,
    `description` text,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `configs_key_index` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- جدول السجلات
CREATE TABLE IF NOT EXISTS `catchers` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int(10) unsigned NOT NULL,
    `action` varchar(255) NOT NULL,
    `details` text,
    `ip_address` varchar(45) DEFAULT NULL,
    `user_agent` text,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `catchers_user_id_index` (`user_id`),
    KEY `catchers_action_index` (`action`),
    KEY `catchers_created_at_index` (`created_at`),
    CONSTRAINT `catchers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- جدول الجلسات
CREATE TABLE IF NOT EXISTS `sessions` (
    `id` varchar(255) NOT NULL,
    `user_id` bigint(20) unsigned DEFAULT NULL,
    `ip_address` varchar(45) DEFAULT NULL,
    `user_agent` text,
    `payload` text NOT NULL,
    `last_activity` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `sessions_user_id_index` (`user_id`),
    KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- جدول العلاقة بين المستخدمين والروابط
CREATE TABLE IF NOT EXISTS `link_user` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int(10) unsigned NOT NULL,
    `link_id` int(10) unsigned NOT NULL,
    `codegen` varchar(255) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `link_user_user_id_index` (`user_id`),
    KEY `link_user_link_id_index` (`link_id`),
    CONSTRAINT `link_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `link_user_link_id_foreign` FOREIGN KEY (`link_id`) REFERENCES `links` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- إدراج بيانات أولية
INSERT INTO `configs` (`key`, `value`, `description`, `created_at`, `updated_at`) VALUES
('site_name', 'Click Master System', 'اسم الموقع', NOW(), NOW()),
('site_description', 'نظام إدارة الروابط والنقاط', 'وصف الموقع', NOW(), NOW()),
('points_per_click', '1', 'النقاط لكل نقرة', NOW(), NOW()),
('min_points_exchange', '100', 'الحد الأدنى لتبادل النقاط', NOW(), NOW()),
('max_links_per_user', '50', 'الحد الأقصى للروابط لكل مستخدم', NOW(), NOW()),
('auto_confirm_links', '0', 'تأكيد الروابط تلقائياً', NOW(), NOW()),
('maintenance_mode', '0', 'وضع الصيانة', NOW(), NOW());

-- إنشاء مستخدم مشرف افتراضي (كلمة المرور: admin123)
INSERT INTO `users` (`name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
('المدير', 'admin@clickmaster.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, NOW(), NOW());

-- إنشاء فهارس إضافية للأداء
CREATE INDEX `idx_users_email_role` ON `users` (`email`, `role`);
CREATE INDEX `idx_links_hash_confirmed` ON `links` (`hash`, `confirmed`);
CREATE INDEX `idx_reports_created_at` ON `reports` (`created_at`);
CREATE INDEX `idx_ads_active_created` ON `ads` (`active`, `created_at`);
CREATE INDEX `idx_catchers_user_action` ON `catchers` (`user_id`, `action`);

-- تعليقات على الجداول
ALTER TABLE `users` COMMENT = 'جدول المستخدمين';
ALTER TABLE `links` COMMENT = 'جدول الروابط';
ALTER TABLE `reports` COMMENT = 'جدول التقارير';
ALTER TABLE `ads` COMMENT = 'جدول الإعلانات';
ALTER TABLE `configs` COMMENT = 'جدول الإعدادات';
ALTER TABLE `catchers` COMMENT = 'جدول سجلات النظام';
ALTER TABLE `sessions` COMMENT = 'جدول الجلسات';
ALTER TABLE `link_user` COMMENT = 'جدول العلاقة بين المستخدمين والروابط';
