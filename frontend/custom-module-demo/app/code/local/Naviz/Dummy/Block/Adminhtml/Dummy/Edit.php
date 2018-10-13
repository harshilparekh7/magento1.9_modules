<?php
	
class Naviz_Dummy_Block_Adminhtml_Dummy_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "dummy_id";
				$this->_blockGroup = "dummy";
				$this->_controller = "adminhtml_dummy";
				$this->_updateButton("save", "label", Mage::helper("dummy")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("dummy")->__("Delete Item"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("dummy")->__("Save And Continue Edit"),
					"onclick"   => "saveAndContinueEdit()",
					"class"     => "save",
				), -100);



				$this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
		}

		public function getHeaderText()
		{
				if( Mage::registry("dummy_data") && Mage::registry("dummy_data")->getId() ){

				    return Mage::helper("dummy")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("dummy_data")->getId()));

				} 
				else{

				     return Mage::helper("dummy")->__("Add Item");

				}
		}
}