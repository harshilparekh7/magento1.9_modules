<?php
 
class Chilly_Imageslide_Block_Adminhtml_Imageslide extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_imageslide';
        $this->_blockGroup = 'imageslide';
        $this->_headerText = Mage::helper('imageslide')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('imageslide')->__('Add Item');
        parent::__construct();
    }
}