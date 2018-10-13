<?php
class Naviz_Dummy_Model_Mysql4_Dummy extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("dummy/dummy", "dummy_id");
    }
}