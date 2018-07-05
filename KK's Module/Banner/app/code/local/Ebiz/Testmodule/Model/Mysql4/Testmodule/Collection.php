<?php

class Ebiz_Testmodule_Model_Mysql4_Testmodule_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('testmodule/testmodule');
    }
} 