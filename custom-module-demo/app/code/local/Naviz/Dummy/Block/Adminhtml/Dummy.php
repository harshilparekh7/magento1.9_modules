<?php


class Naviz_Dummy_Block_Adminhtml_Dummy extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_dummy";
	$this->_blockGroup = "dummy";
	$this->_headerText = Mage::helper("dummy")->__("Dummy Manager");
	$this->_addButtonLabel = Mage::helper("dummy")->__("Add New Item");
	parent::__construct();
	
	}

}