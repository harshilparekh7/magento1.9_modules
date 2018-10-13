<?php

class Crud_Pro_Block_Adminhtml_Pro_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
 {
 public function __construct()
 {
 parent::__construct();
 $this->_objectId = 'id';
 $this->_blockGroup = 'pro';
 $this->_controller = 'adminhtml_pro';

$this->_updateButton('save', 'label', Mage::helper('pro')->__('Save Data'));
 $this->_updateButton('delete', 'label', Mage::helper('pro')->__('Delete Item'));
 }

public function getHeaderText()
 {
 if( Mage::registry('pro_data') && Mage::registry('pro_data')->getId() ) {
 return Mage::helper('pro')->__("View Student Data '%s'", $this->htmlEscape(Mage::registry('pro_data')->getTitle()));
 } else {
 return Mage::helper('pro')->__('Student Information');
 }
 }
 }