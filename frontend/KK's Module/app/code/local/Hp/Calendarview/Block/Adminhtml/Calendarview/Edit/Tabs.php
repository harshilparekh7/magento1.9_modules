<?php

class Hp_Calendarview_Block_Adminhtml_Calendarview_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('calendarview_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('calendarview')->__('News Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('calendarview')->__('Item Information'),
            'title'     => Mage::helper('calendarview')->__('Item Information'),
            'content'   => $this->getLayout()->createBlock('calendarview/adminhtml_calendarview_edit_tab_form')->toHtml(),
        ));
        
        return parent::_beforeToHtml();
    }
}