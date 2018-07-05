<?php

class Ebiz_Testmodule_Model_Testmodule extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('testmodule/testmodule');
    }
}