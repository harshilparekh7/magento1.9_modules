<?php
 
class Chilly_Imageslide_Model_Mysql4_Imageslide extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {   
        $this->_init('imageslide/imageslide', 'imageslide_id');
    }
}