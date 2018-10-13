<?php
 
class Chilly_Imageslide_Model_Imageslide extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('imageslide/imageslide');
    }
}