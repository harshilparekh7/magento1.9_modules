<?php

class Hp_Leftsidebar_Block_Adminhtml_Leftsidebar_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                
        $this->_objectId = 'id';
        $this->_blockGroup = 'leftsidebar';
        $this->_controller = 'adminhtml_leftsidebar';

        $this->_updateButton('save', 'label', Mage::helper('leftsidebar')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('leftsidebar')->__('Delete Item'));
    }

    public function getHeaderText()
    {
        if( Mage::registry('leftsidebar_data') && Mage::registry('leftsidebar_data')->getId() ) {
            return Mage::helper('leftsidebar')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('leftsidebar_data')->getTitle()));
        } else {
            return Mage::helper('leftsidebar')->__('Add Item');
        }
    }
}