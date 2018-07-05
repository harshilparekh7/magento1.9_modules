<?php

class Ebiz_Testmodule_Block_Adminhtml_Testmodule extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_testmodule';
        $this->_blockGroup = 'testmodule';
        $this->_headerText = Mage::helper('testmodule')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('testmodule')->__('Add Item');
        parent::__construct();
    }
}
