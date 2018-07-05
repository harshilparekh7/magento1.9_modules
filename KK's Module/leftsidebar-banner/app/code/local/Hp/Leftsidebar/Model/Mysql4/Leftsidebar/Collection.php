<?php

class Hp_Leftsidebar_Model_Mysql4_Leftsidebar_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('leftsidebar/leftsidebar');
    }
} 