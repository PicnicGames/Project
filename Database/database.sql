CREATE TABLE `game` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(255),
  `player` varchar(255),
  `place` varchar(255),
  `vertical_img` varchar(255),
  `horizontal_img` varchar(255),
  `video` varchar(255),
  `description` varchar(255),
  `content` text,
  `favourite` integer
);

CREATE TABLE `favourite` (
  `id_user` integer,
  `id_game` integer
);

CREATE TABLE `user` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(255),
  `email` varchar(255),
  `password` varchar(255)
);

CREATE TABLE `blog` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(255),
  `img` varchar(255),
  `content` text,
  `created_at` timestamp
);

CREATE TABLE `contact` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(255),
  `last_name` varchar(255),
  `email` varchar(255),
  `content` text
);

ALTER TABLE `favourite` ADD FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

ALTER TABLE `favourite` ADD FOREIGN KEY (`id_game`) REFERENCES `game` (`id`);

ALTER TABLE `user` ADD UNIQUE(`username`);
ALTER TABLE `user` ADD UNIQUE(`email`);
ALTER TABLE `contact` ADD UNIQUE(`email`);
