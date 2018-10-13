<?php

class Hp_Headerimage_Model_Headerimage extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('headerimage/headerimage');
    }
}