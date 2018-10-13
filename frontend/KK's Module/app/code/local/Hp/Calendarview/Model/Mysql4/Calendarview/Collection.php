<?php

class Hp_Calendarview_Model_Mysql4_Calendarview_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('calendarview/calendarview');
    }
} 