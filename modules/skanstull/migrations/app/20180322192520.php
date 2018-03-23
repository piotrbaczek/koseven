<?php defined('SYSPATH') OR die('No direct script access.');

class Migration_App_20180322192520 extends Minion_Migration_Base
{

    /**
     * Run queries needed to apply this migration
     *
     * @param Kohana_Database $db Database connection
     */
    public function up(Kohana_Database $db)
    {
        $db->query(NULL, 'CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `options` varchar(50) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings.name.unique` (`name`),
  KEY `settings.name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    /**
     * Run queries needed to remove this migration
     *
     * @param Kohana_Database $db Database connection
     */
    public function down(Kohana_Database $db)
    {
        $db->query(NULL, 'DROP TABLE `settings`');
    }

}
