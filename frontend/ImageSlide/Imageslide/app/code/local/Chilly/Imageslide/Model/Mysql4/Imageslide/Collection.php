<?php
 
class Chilly_Imageslide_Model_Mysql4_Imageslide_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('imageslide/imageslide');
    }
}