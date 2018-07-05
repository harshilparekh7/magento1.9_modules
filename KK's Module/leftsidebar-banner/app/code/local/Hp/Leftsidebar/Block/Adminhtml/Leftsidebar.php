<?php

class Hp_Leftsidebar_Block_Adminhtml_Leftsidebar extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_leftsidebar';
        $this->_blockGroup = 'leftsidebar';
        $this->_headerText = Mage::helper('leftsidebar')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('leftsidebar')->__('Add Item');
        parent::__construct();
    }
}
