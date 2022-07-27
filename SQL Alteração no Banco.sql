ALTER TABLE usuarios
ADD COLUMN Senha varchar(30) AFTER ID;

ALTER TABLE usuarios
ADD COLUMN Countpts bool;

DROP TABLE IF EXISTS `avaliacao`;
CREATE TABLE IF NOT EXISTS `avaliacao` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Usuario` int(11) NOT NULL,
  `ID_Noticia` int(11) NOT NULL,
  `Avalia` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
