-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 03. April 2010 um 15:15
-- Server Version: 5.1.30
-- PHP-Version: 5.2.8

--
-- Datenbank: `reisebuero`
--
DROP DATABASE `reisebuero`;
CREATE DATABASE `reisebuero` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `reisebuero`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zielflughafen`
--

CREATE TABLE IF NOT EXISTS `zielflughafen` (
  `Zielflughafen` varchar(50) NOT NULL DEFAULT '',
  `Land` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Zielflughafen`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
