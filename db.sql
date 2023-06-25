-- Adminer 4.8.0 MySQL 5.7.34 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `chats` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_conversation` bigint(20) NOT NULL,
  `tanggal` datetime NOT NULL,
  `user` varchar(255) NOT NULL,
  `chat` longtext NOT NULL,
  `is_processed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_conversation` (`id_conversation`),
  CONSTRAINT `chats_ibfk_1` FOREIGN KEY (`id_conversation`) REFERENCES `conversations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `conversations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user1` varchar(255) NOT NULL,
  `user2` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `detail_pesanan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_pesanan` bigint(20) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `menu` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pesanan` (`id_pesanan`),
  CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `pesanan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `sales` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tgl_penjualan` datetime NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `quantity` int(4) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `total` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `tickets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `user` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `attachment` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2023-06-25 04:25:24
