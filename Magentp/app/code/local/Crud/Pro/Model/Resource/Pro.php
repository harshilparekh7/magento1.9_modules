<?php
class Crud_Pro_Model_Resource_Pro extends Mage_Core_Model_Resource_Db_Abstract
{   
    protected function _construct()
    {      
        $this->_init('pro/pro','std_id');
    }
}