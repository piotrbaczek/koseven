<?php defined('SYSPATH') OR die('No direct script access.');

class Migration_App_20180322192723 extends Minion_Migration_Base
{

    /**
     * Run queries needed to apply this migration
     *
     * @param Kohana_Database $db Database connection
     */
    public function up(Kohana_Database $db)
    {
        $db->query(NULL, 'CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8');

        $db->query(Database::INSERT, 'INSERT INTO `roles` (`id`, `name`, `description`) VALUES
	(1, \'login\', \'Login privileges, granted after account confirmation\'),
	(2, \'admin\', \'Administrative user, has access to everything.\');');
    }

    /**
     * Run queries needed to remove this migration
     *
     * @param Kohana_Database $db Database connection
     */
    public function down(Kohana_Database $db)
    {
        $db->query(NULL, 'DROP TABLE `roles`');
    }

}
