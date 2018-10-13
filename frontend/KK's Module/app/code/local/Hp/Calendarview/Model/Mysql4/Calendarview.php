<?php

class Hp_Calendarview_Model_Mysql4_Calendarview extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        $this->_init('calendarview/calendarview', 'calendarview_id');
    }
} 