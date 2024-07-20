CREATE DATABASE IF NOT EXISTS `users`
USE `users`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `auth_key` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `login`, `password`, `auth_key`) VALUES
	(1, '1111', '1111', '19bc916108fc6938f52cb96f7e087941'),
	(2, '2222', '2222', 'c45147dee729311ef5b5c3003946c48f'),
	(3, '3333', '3333', 'a4a042cf4fd6bfb47701cbc8a1653ada'),
	(4, '4444', '4444', 'eddea82ad2755b24c4e168c5fc2ebd40'),
	(5, '5555', '5555', 'e2ef524fbf3d9fe611d5a8e90fefdc9c'),
	(6, '6666', '6666', 'cf004fdc76fa1a4f25f62e0eb5261ca3'),
	(7, '7777', '7777', '8b6dd7db9af49e67306feb59a8bdc52c'),
	(8, '8888', '8888', '303ed4c69846ab36c2904d3ba8573050'),
	(9, '9999', '9999', '8d317bdcf4aafcfc22149d77babee96d');
