<?php
 class Crud_Pro_Block_Adminhtml_Pro extends Mage_Adminhtml_Block_Widget_Grid_Container
 {
 public function __construct()
 {
 $this->_controller = 'adminhtml_pro';
 $this->_blockGroup = 'pro';
 $this->_headerText = Mage::helper('pro')->__('View Data');
 $this->_addButtonLabel = Mage::helper('pro')->__('Edit Status');
 parent::__construct();
 }
 }