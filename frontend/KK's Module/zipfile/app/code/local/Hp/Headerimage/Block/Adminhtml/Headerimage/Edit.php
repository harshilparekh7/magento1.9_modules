<?php

class Hp_Headerimage_Block_Adminhtml_Headerimage_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                
        $this->_objectId = 'id';
        $this->_blockGroup = 'headerimage';
        $this->_controller = 'adminhtml_headerimage';

        $this->_updateButton('save', 'label', Mage::helper('headerimage')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('headerimage')->__('Delete Item'));
    }

    public function getHeaderText()
    {
        if( Mage::registry('headerimage_data') && Mage::registry('headerimage_data')->getId() ) {
            return Mage::helper('headerimage')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('headerimage_data')->getTitle()));
        } else {
            return Mage::helper('headerimage')->__('Add Item');
        }
    }
}