<?php

class Hp_Calendarview_Block_Adminhtml_Calendarview_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                
        $this->_objectId = 'id';
        $this->_blockGroup = 'calendarview';
        $this->_controller = 'adminhtml_calendarview';

        $this->_updateButton('save', 'label', Mage::helper('calendarview')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('calendarview')->__('Delete Item'));
    }

    public function getHeaderText()
    {
        if( Mage::registry('calendarview_data') && Mage::registry('calendarview_data')->getId() ) {
            return Mage::helper('calendarview')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('calendarview_data')->getTitle()));
        } else {
            return Mage::helper('calendarview')->__('Add Item');
        }
    }
}