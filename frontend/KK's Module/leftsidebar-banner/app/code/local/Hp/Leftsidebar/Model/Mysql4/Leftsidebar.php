<?php

class Hp_Leftsidebar_Model_Mysql4_Leftsidebar extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        $this->_init('leftsidebar/leftsidebar', 'leftsidebar_id');
    }
} 