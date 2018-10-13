<?php
 
class Chilly_Imageslide_Block_Adminhtml_Imageslide_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
 
    public function __construct()
    {
        parent::__construct();
        $this->setId('imageslide_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('imageslide')->__('News Information'));
    }
 
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('imageslide')->__('Item Information'),
            'title'     => Mage::helper('imageslide')->__('Item Information'),
            'content'   => $this->getLayout()->createBlock('imageslide/adminhtml_imageslide_edit_tab_form')->toHtml(),
        ));
      /* $this->addTab('form_section1', array(
            'label'     => Mage::helper('imageslide')->__('Select Products'),
            'title'     => Mage::helper('imageslide')->__('Select Products'),
            'content'   => $this->getLayout()->createBlock('imageslide/adminhtml_imageslide_edit_tab_productform')->toHtml(),
        ));*/
		$this->addTab('form_section2', array(
         'label'     => Mage::helper('imageslide')->__('Select Products'),
         'title'     => Mage::helper('imageslide')->__('Select Products'),
         'url'       => $this->getUrl('*/*/product', array('_current' => true)),
         'class'     => 'ajax',
      ));
        return parent::_beforeToHtml();
    }
}