<?php
 
$installer = $this;
 
$installer->startSetup();
 
$installer->run("
 
CREATE TABLE IF NOT EXISTS `imageslide` (
  `imageslide_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `c_id` int(9) unsigned NOT NULL,
  `status` int(11) unsigned NOT NULL,
  PRIMARY KEY (`imageslide_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ; 
    ");
 
$installer->endSetup();