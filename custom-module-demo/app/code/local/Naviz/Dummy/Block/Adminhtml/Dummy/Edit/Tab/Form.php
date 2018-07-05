<?php
class Naviz_Dummy_Block_Adminhtml_Dummy_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("dummy_form", array("legend"=>Mage::helper("dummy")->__("Item information")));

				
						$fieldset->addField("title", "text", array(
						"label" => Mage::helper("dummy")->__("Title"),
						"name" => "title",
						));
					
						$fieldset->addField("content", "textarea", array(
						"label" => Mage::helper("dummy")->__("Content"),
						"name" => "content",
						));
									
						 $fieldset->addField('status', 'select', array(
						'label'     => Mage::helper('dummy')->__('Status'),
						'values'   => Naviz_Dummy_Block_Adminhtml_Dummy_Grid::getValueArray2(),
						'name' => 'status',
						));

				if (Mage::getSingleton("adminhtml/session")->getDummyData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getDummyData());
					Mage::getSingleton("adminhtml/session")->setDummyData(null);
				} 
				elseif(Mage::registry("dummy_data")) {
				    $form->setValues(Mage::registry("dummy_data")->getData());
				}
				return parent::_prepareForm();
		}
}
