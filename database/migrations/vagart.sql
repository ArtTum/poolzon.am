-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2020 at 08:49 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vagart`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `order_number` tinyint(5) DEFAULT NULL,
  `appointmen_status` tinyint(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_has_lang`
--

CREATE TABLE `appointment_has_lang` (
  `appointmen_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `appointmen_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `banner_url` varchar(255) NOT NULL,
  `order_number` tinyint(1) NOT NULL,
  `banner_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `brand_image` varchar(255) NOT NULL,
  `order_number` tinyint(5) DEFAULT NULL,
  `brand_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `brands_has_lang`
--

CREATE TABLE `brands_has_lang` (
  `brand_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keys` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `order_number` tinyint(5) DEFAULT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `category_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories_has_lang`
--

CREATE TABLE `categories_has_lang` (
  `category_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keys` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `color_status` tinyint(1) DEFAULT 0,
  `order_number` tinyint(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `colors_has_lang`
--

CREATE TABLE `colors_has_lang` (
  `color_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `color_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE `lang` (
  `id` int(11) NOT NULL,
  `lang_name` varchar(255) NOT NULL,
  `iso` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `order_number` tinyint(5) DEFAULT NULL,
  `page_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pages_has_lang`
--

CREATE TABLE `pages_has_lang` (
  `page_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `page_description` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keys` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `sale` tinyint(5) DEFAULT NULL,
  `bestseller` tinyint(1) DEFAULT 0,
  `number_mounting_holes` tinyint(5) DEFAULT NULL,
  `product_code` varchar(45) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `types_id` int(11) DEFAULT NULL,
  `appointmen_id` int(11) DEFAULT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products_has_colors`
--

CREATE TABLE `products_has_colors` (
  `products_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products_has_lang`
--

CREATE TABLE `products_has_lang` (
  `product_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `advantages` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keys` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `order_number` tinyint(5) DEFAULT NULL,
  `slider_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sliders_has_lang`
--

CREATE TABLE `sliders_has_lang` (
  `slider_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `slider_name` varchar(255) NOT NULL,
  `slider_description` text DEFAULT NULL,
  `slider_button` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `translate`
--

CREATE TABLE `translate` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translate_lang`
--

CREATE TABLE `translate_lang` (
  `translate_id` int(10) UNSIGNED NOT NULL,
  `lang_id` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `type_status` tinyint(1) DEFAULT 0,
  `order_number` tinyint(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `types_has_lang`
--

CREATE TABLE `types_has_lang` (
  `type_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment_has_lang`
--
ALTER TABLE `appointment_has_lang`
  ADD PRIMARY KEY (`appointmen_id`,`lang_id`),
  ADD KEY `fk_appointment_has_lang_lang1_idx` (`lang_id`),
  ADD KEY `fk_appointment_has_lang_appointment1_idx` (`appointmen_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands_has_lang`
--
ALTER TABLE `brands_has_lang`
  ADD PRIMARY KEY (`brand_id`,`lang_id`),
  ADD KEY `fk_brands_has_lang_lang1_idx` (`lang_id`),
  ADD KEY `fk_brands_has_lang_brands1_idx` (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories_has_lang`
--
ALTER TABLE `categories_has_lang`
  ADD PRIMARY KEY (`category_id`,`lang_id`),
  ADD KEY `fk_categories_has_lang_lang1_idx` (`lang_id`),
  ADD KEY `fk_categories_has_lang_categories1_idx` (`category_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors_has_lang`
--
ALTER TABLE `colors_has_lang`
  ADD PRIMARY KEY (`color_id`,`lang_id`),
  ADD KEY `fk_colors_has_lang_lang1_idx` (`lang_id`),
  ADD KEY `fk_colors_has_lang_colors1_idx` (`color_id`);

--
-- Indexes for table `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages_has_lang`
--
ALTER TABLE `pages_has_lang`
  ADD PRIMARY KEY (`page_id`,`lang_id`),
  ADD KEY `fk_pages_has_lang_lang1_idx` (`lang_id`),
  ADD KEY `fk_pages_has_lang_pages1_idx` (`page_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`,`category_id`,`brand_id`),
  ADD KEY `fk_products_categories_idx` (`category_id`),
  ADD KEY `fk_products_types1_idx` (`types_id`),
  ADD KEY `fk_products_appointment1_idx` (`appointmen_id`),
  ADD KEY `fk_products_brand1_idx` (`brand_id`);

--
-- Indexes for table `products_has_colors`
--
ALTER TABLE `products_has_colors`
  ADD PRIMARY KEY (`products_id`,`color_id`),
  ADD KEY `fk_products_has_colors_colors1_idx` (`color_id`),
  ADD KEY `fk_products_has_colors_products1_idx` (`products_id`);

--
-- Indexes for table `products_has_lang`
--
ALTER TABLE `products_has_lang`
  ADD PRIMARY KEY (`product_id`,`lang_id`),
  ADD KEY `fk_products_has_lang_lang1_idx` (`lang_id`),
  ADD KEY `fk_products_has_lang_products1_idx` (`product_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders_has_lang`
--
ALTER TABLE `sliders_has_lang`
  ADD PRIMARY KEY (`slider_id`,`lang_id`),
  ADD KEY `fk_sliders_has_lang_lang1_idx` (`lang_id`),
  ADD KEY `fk_sliders_has_lang_sliders1_idx` (`slider_id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translate`
--
ALTER TABLE `translate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translate_lang`
--
ALTER TABLE `translate_lang`
  ADD PRIMARY KEY (`translate_id`,`lang_id`),
  ADD KEY `fk_translate_has_lang_lang1_idx` (`lang_id`),
  ADD KEY `fk_translate_has_lang_translate1_idx` (`translate_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types_has_lang`
--
ALTER TABLE `types_has_lang`
  ADD PRIMARY KEY (`type_id`,`lang_id`),
  ADD KEY `fk_types_has_lang_lang1_idx` (`lang_id`),
  ADD KEY `fk_types_has_lang_types1_idx` (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translate`
--
ALTER TABLE `translate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment_has_lang`
--
ALTER TABLE `appointment_has_lang`
  ADD CONSTRAINT `fk_appointment_has_lang_appointment1` FOREIGN KEY (`appointmen_id`) REFERENCES `appointment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_appointment_has_lang_lang1` FOREIGN KEY (`lang_id`) REFERENCES `lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brands_has_lang`
--
ALTER TABLE `brands_has_lang`
  ADD CONSTRAINT `fk_brands_has_lang_brands1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_brands_has_lang_lang1` FOREIGN KEY (`lang_id`) REFERENCES `lang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `categories_has_lang`
--
ALTER TABLE `categories_has_lang`
  ADD CONSTRAINT `fk_categories_has_lang_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_categories_has_lang_lang1` FOREIGN KEY (`lang_id`) REFERENCES `lang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `colors_has_lang`
--
ALTER TABLE `colors_has_lang`
  ADD CONSTRAINT `fk_colors_has_lang_colors1` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_colors_has_lang_lang1` FOREIGN KEY (`lang_id`) REFERENCES `lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pages_has_lang`
--
ALTER TABLE `pages_has_lang`
  ADD CONSTRAINT `fk_pages_has_lang_lang1` FOREIGN KEY (`lang_id`) REFERENCES `lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pages_has_lang_pages1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_appointment1` FOREIGN KEY (`appointmen_id`) REFERENCES `appointment` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_products_brand1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_products_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_products_types1` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `products_has_colors`
--
ALTER TABLE `products_has_colors`
  ADD CONSTRAINT `fk_products_has_colors_colors1` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_products_has_colors_products1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_has_lang`
--
ALTER TABLE `products_has_lang`
  ADD CONSTRAINT `fk_products_has_lang_lang1` FOREIGN KEY (`lang_id`) REFERENCES `lang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_products_has_lang_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sliders_has_lang`
--
ALTER TABLE `sliders_has_lang`
  ADD CONSTRAINT `fk_sliders_has_lang_lang1` FOREIGN KEY (`lang_id`) REFERENCES `lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sliders_has_lang_sliders1` FOREIGN KEY (`slider_id`) REFERENCES `sliders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `translate_lang`
--
ALTER TABLE `translate_lang`
  ADD CONSTRAINT `fk_translate_has_lang_lang1` FOREIGN KEY (`lang_id`) REFERENCES `lang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_translate_has_lang_translate1` FOREIGN KEY (`translate_id`) REFERENCES `translate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `types_has_lang`
--
ALTER TABLE `types_has_lang`
  ADD CONSTRAINT `fk_types_has_lang_lang1` FOREIGN KEY (`lang_id`) REFERENCES `lang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_types_has_lang_types1` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
