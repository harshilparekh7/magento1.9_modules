<?php

class Ebiz_Testmodule_Block_Adminhtml_Testmodule_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                
        $this->_objectId = 'id';
        $this->_blockGroup = 'testmodule';
        $this->_controller = 'adminhtml_testmodule';

        $this->_updateButton('save', 'label', Mage::helper('testmodule')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('testmodule')->__('Delete Item'));
    }

    public function getHeaderText()
    {
        if( Mage::registry('testmodule_data') && Mage::registry('testmodule_data')->getId() ) {
            return Mage::helper('testmodule')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('testmodule_data')->getTitle()));
        } else {
            return Mage::helper('testmodule')->__('Add Item');
        }
    }
}