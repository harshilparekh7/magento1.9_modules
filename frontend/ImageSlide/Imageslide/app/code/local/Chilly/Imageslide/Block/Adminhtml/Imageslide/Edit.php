<?php
 
class Chilly_Imageslide_Block_Adminhtml_Imageslide_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
               
        $this->_objectId = 'id';
        $this->_blockGroup = 'imageslide';
        $this->_controller = 'adminhtml_imageslide';
 
        $this->_updateButton('save', 'label', Mage::helper('imageslide')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('imageslide')->__('Delete Item'));
    }
 
    public function getHeaderText()
    {
        if( Mage::registry('imageslide_data') && Mage::registry('imageslide_data')->getId() ) {
            return Mage::helper('imageslide')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('imageslide_data')->getTitle()));
        } else {
            return Mage::helper('imageslide')->__('Add Item');
        }
    }
}