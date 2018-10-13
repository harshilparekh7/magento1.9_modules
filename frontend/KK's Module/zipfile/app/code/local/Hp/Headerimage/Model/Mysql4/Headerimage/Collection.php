<?php

class Hp_Headerimage_Model_Mysql4_Headerimage_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('headerimage/headerimage');
    }
} 