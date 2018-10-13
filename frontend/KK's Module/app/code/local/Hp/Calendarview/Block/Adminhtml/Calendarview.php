<?php

class Hp_Calendarview_Block_Adminhtml_Calendarview extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_calendarview';
        $this->_blockGroup = 'calendarview';
        $this->_headerText = Mage::helper('calendarview')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('calendarview')->__('Add Item');
        parent::__construct();
    }
}
