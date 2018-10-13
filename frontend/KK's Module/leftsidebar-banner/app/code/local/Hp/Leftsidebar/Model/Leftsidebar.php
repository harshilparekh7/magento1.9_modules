<?php

class Hp_Leftsidebar_Model_Leftsidebar extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('leftsidebar/leftsidebar');
    }
}