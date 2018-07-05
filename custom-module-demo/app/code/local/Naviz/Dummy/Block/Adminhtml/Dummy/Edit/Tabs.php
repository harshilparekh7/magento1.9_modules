<?php
class Naviz_Dummy_Block_Adminhtml_Dummy_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("dummy_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("dummy")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("dummy")->__("Item Information"),
				"title" => Mage::helper("dummy")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("dummy/adminhtml_dummy_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
