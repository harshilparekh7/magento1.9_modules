<?php

class Hp_Leftsidebar_Block_Adminhtml_Leftsidebar_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('leftsidebar_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('leftsidebar')->__('News Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('leftsidebar')->__('Item Information'),
            'title'     => Mage::helper('leftsidebar')->__('Item Information'),
            'content'   => $this->getLayout()->createBlock('leftsidebar/adminhtml_leftsidebar_edit_tab_form')->toHtml(),
        ));
        
        return parent::_beforeToHtml();
    }
}