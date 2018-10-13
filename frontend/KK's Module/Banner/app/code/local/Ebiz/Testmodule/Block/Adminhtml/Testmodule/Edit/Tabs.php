<?php

class Ebiz_Testmodule_Block_Adminhtml_Testmodule_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('testmodule_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('testmodule')->__('News Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('testmodule')->__('Item Information'),
            'title'     => Mage::helper('testmodule')->__('Item Information'),
            'content'   => $this->getLayout()->createBlock('testmodule/adminhtml_testmodule_edit_tab_form')->toHtml(),
        ));
        
        return parent::_beforeToHtml();
    }
}