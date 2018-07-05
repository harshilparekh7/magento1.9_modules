<?php

class Ebiz_Testmodule_Model_Mysql4_Testmodule extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        $this->_init('testmoduletestmodule/testmodule', 'testmodule_id');
    }
} 