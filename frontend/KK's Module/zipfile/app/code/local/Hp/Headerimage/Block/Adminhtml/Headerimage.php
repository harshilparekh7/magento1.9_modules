<?php

class Hp_Headerimage_Block_Adminhtml_Headerimage extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_headerimage';
        $this->_blockGroup = 'headerimage';
        $this->_headerText = Mage::helper('headerimage')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('headerimage')->__('Add Item');
        parent::__construct();
    }
}
