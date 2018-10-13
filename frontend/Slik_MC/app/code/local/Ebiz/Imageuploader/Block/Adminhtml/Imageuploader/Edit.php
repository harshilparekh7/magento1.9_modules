<?php
	
class Ebiz_Imageuploader_Block_Adminhtml_Imageuploader_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "imageuploader_id";
				$this->_blockGroup = "imageuploader";
				$this->_controller = "adminhtml_imageuploader";
				$this->_updateButton("save", "label", Mage::helper("imageuploader")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("imageuploader")->__("Delete Item"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("imageuploader")->__("Save And Continue Edit"),
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
				if( Mage::registry("imageuploader_data") && Mage::registry("imageuploader_data")->getId() ){

				    return Mage::helper("imageuploader")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("imageuploader_data")->getId()));

				} 
				else{

				     return Mage::helper("imageuploader")->__("Add Item");

				}
		}
}