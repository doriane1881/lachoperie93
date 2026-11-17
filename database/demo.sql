-- La Choperie 93 : structure et donnees de demonstration uniquement.
-- Importer dans une base VIDE choisie separement. Aucun compte utilisateur.
SET NAMES utf8mb4;

CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `category_id` int NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('client','vendeur') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name`) VALUES ('1', 'Lunettes de Soleil');
INSERT INTO `categories` (`id`, `name`) VALUES ('2', 'Gilets');
INSERT INTO `categories` (`id`, `name`) VALUES ('3', 'Écouteurs');

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `image_path`) VALUES ('1', 'Cartier Sunglasses Model 5', 'Lunettes à verres clairs rectangulaires sans contour, avec pont et branches de couleur dorée et embouts noirs.', '299.99', '1', 'assets/demo/glasses-1.svg');
INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `image_path`) VALUES ('2', 'Cartier Sunglasses Model 4', 'Stylish Cartier aviators.', '349.99', '1', 'assets/demo/glasses-2.svg');
INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `image_path`) VALUES ('3', 'Cartier Sunglasses Model 3', 'Classic Cartier round sunglasses.', '399.99', '1', 'assets/demo/glasses-3.svg');
INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `image_path`) VALUES ('4', 'Cartier Sunglasses Model 2', 'Lunettes à verres clairs, avec monture de couleur dorée, double pont et embouts de branches noirs.', '279.99', '1', 'assets/demo/glasses-4.svg');
INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `image_path`) VALUES ('5', 'Cartier Sunglasses Model 1', 'Lunettes rectangulaires à verres teintés vert clair.', '459.99', '1', 'assets/demo/glasses-5.svg');

