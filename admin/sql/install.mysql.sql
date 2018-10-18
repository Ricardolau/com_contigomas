CREATE TABLE IF NOT EXISTS `#__contigomas` (
  `id` integer(10) UNSIGNED NOT NULL auto_increment,
  `codigo`  varchar(15) NOT NULL DEFAULT '',
  `nombre`  varchar(100) NOT NULL DEFAULT '',
  `apellido1`  varchar(50) NOT NULL DEFAULT '',
  `apellido2`  varchar(50) NOT NULL DEFAULT '',
  `telefono` int(9) unsigned NOT NULL default '0',
  `email` varchar(100) default NULL,
  `calle` varchar(100) default NULL,
  `numero` varchar(100) default NULL,
  `piso` varchar(100) default NULL,
  `codigopostal` varchar(6) default NULL,
  `municipio` varchar(100) default NULL,
  `provincia` varchar(100) default NULL,
  `terminos` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `base` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `regalo` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL default '0',
  `created_by_alias` varchar(255) NOT NULL default '',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL default '0',
 
  PRIMARY KEY  (`id`),
  KEY `idx_createdby` (`created_by`)

)  DEFAULT CHARSET=utf8;

