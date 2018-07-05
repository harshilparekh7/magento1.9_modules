<?php

$installer = $this;

$installer->startSetup();

$installer->run("
				
 DROP TABLE IF EXISTS {$this->getTable('banners')};
CREATE TABLE {$this->getTable('banners')} (
  `banners_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `bannerimage` varchar(255) NOT NULL DEFAULT '',
  `filethumbgrid` text,
  `link` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `textblend` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `sort_order` int(11) DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`banners_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

insert  into {$this->getTable('banners')}(`banners_id`,`title`,`bannerimage`,`filethumbgrid`,`link`,`target`,`textblend`,`content`,`sort_order`,`status`,`created_time`,`update_time`) values (12,'Magento Customization','Banners/images/customization.png','Banners/images/thumb/customization.png','https://www.fmeextensions.com/magento-custom-development.html','_blank','yes','Magento Customization, FME Extensions specializes in Magento Custom Development, ',1,1,'2016-02-23 10:47:12','2016-02-23 10:47:12');
insert  into {$this->getTable('banners')}(`banners_id`,`title`,`bannerimage`,`filethumbgrid`,`link`,`target`,`textblend`,`content`,`sort_order`,`status`,`created_time`,`update_time`) values (13,'Magento Speed Optimization','Banners/images/optimization.png','Banners/images/thumb/optimization.png','https://www.fmeextensions.com/magento-speed-performance-optimization.html','_blank','yes','Magento Speed Optimization, Magento store speed determines the success of any web store',2,1,'2016-02-23 10:48:32','2016-02-23 10:48:32');
insert  into {$this->getTable('banners')}(`banners_id`,`title`,`bannerimage`,`filethumbgrid`,`link`,`target`,`textblend`,`content`,`sort_order`,`status`,`created_time`,`update_time`) values (14,'Magento Store Design','Banners/images/design.png','Banners/images/thumb/design.png','https://www.fmeextensions.com/magento-e-commerce-store-design.html','_blank','yes','Magento Store Design, Our expert designers can create a Custom Magento Store Design for you,',3,1,'2016-02-23 10:48:44','2016-02-23 10:48:44');


");


$installer->setConfigData('advanced/modules_disable_output/FME_Banners','0');
$installer->setConfigData('banners/general/addonhome','1');
$installer->setConfigData('banners/general/banner_width','100');
$installer->setConfigData('banners/general/banner_height','400');
$installer->setConfigData('banners/general/banner_backgroundcolor','FFFFFF');
$installer->setConfigData('banners/textsettings/text_size','12');
$installer->setConfigData('banners/textsettings/text_color','');
$installer->setConfigData('banners/textsettings/text_area_width','200');
$installer->setConfigData('banners/textsettings/text_line_spacing','0');
$installer->setConfigData('banners/textsettings/text_margin_left','12');
$installer->setConfigData('banners/textsettings/text_letter_spacing','-0.5');
$installer->setConfigData('banners/textsettings/text_margin_bottom','5');
$installer->setConfigData('banners/textsettings/text_background_blur','1');
$installer->setConfigData('banners/textsettings/text_background_transparency','30');
$installer->setConfigData('banners/textsettings/text_background_color','333333');
$installer->setConfigData('banners/transition/transition_type','4');
$installer->setConfigData('banners/transition/transition_blur','1');
$installer->setConfigData('banners/transition/transition_speed','10');
$installer->setConfigData('banners/transition/transition_delay_time_fixed','10');
$installer->setConfigData('banners/transition/transition_random_effects','0');
$installer->setConfigData('banners/transition/transition_delay_time_per_word','.5');
$installer->setConfigData('banners/showhide/show_timer_clock','1');
$installer->setConfigData('banners/showhide/show_next_button','1');
$installer->setConfigData('banners/showhide/show_back_button','1');
$installer->setConfigData('banners/showhide/show_number_buttons','1');
$installer->setConfigData('banners/showhide/show_number_buttons_always','1');
$installer->setConfigData('banners/showhide/show_number_buttons_horizontal','1');
$installer->setConfigData('banners/showhide/show_number_buttons_ascending','1');
$installer->setConfigData('banners/showhide/show_play_pause_on_timer','1');
$installer->setConfigData('banners/showhide/align_buttons_left','0');
$installer->setConfigData('banners/showhide/align_text_top','0');
$installer->setConfigData('banners/showhide/auto_play','0');
$installer->setConfigData('banners/general/auto_play','1');
$installer->setConfigData('banners/general/image_resize_to_fit','1');
$installer->setConfigData('banners/general/image_randomize_order','0');

$installer->endSetup(); 

