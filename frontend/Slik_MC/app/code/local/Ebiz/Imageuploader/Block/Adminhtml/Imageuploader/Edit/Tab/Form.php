<?php
class Ebiz_Imageuploader_Block_Adminhtml_Imageuploader_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("imageuploader_form", array("legend"=>Mage::helper("imageuploader")->__("Item information")));

								
						$fieldset->addField('image', 'image', array(
						'label' => Mage::helper('imageuploader')->__('Image'),
						'name' => 'image',
						'note' => '(*.jpg, *.png, *.gif)',
						));

				if (Mage::getSingleton("adminhtml/session")->getImageuploaderData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getImageuploaderData());
					Mage::getSingleton("adminhtml/session")->setImageuploaderData(null);
				} 
				elseif(Mage::registry("imageuploader_data")) {
				    $form->setValues(Mage::registry("imageuploader_data")->getData());
				}
				return parent::_prepareForm();
		}
}
