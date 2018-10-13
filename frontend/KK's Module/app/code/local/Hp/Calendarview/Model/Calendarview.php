<?php

class Hp_Calendarview_Model_Calendarview extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('calendarview/calendarview');
    }
}