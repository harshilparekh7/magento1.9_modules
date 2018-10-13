<?php

class Hp_Headerimage_Model_Mysql4_Headerimage extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        $this->_init('headerimage/headerimage', 'headerimage_id');
    }
} 