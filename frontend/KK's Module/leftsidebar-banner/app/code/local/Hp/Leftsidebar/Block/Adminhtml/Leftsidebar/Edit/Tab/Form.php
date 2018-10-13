<?php

class Hp_Leftsidebar_Block_Adminhtml_Leftsidebar_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('leftsidebar_form', array('legend'=>Mage::helper('leftsidebar')->__('Item information')));
        
        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('leftsidebar')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('leftsidebar')->__('Status'),
            'name'      => 'status',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('leftsidebar')->__('Active'),
                ),

                array(
                    'value'     => 0,
                    'label'     => Mage::helper('leftsidebar')->__('Inactive'),
                ),
            ),
        ));
		
        $fieldset->addField('content', 'editor', array(
            'name'      => 'content',
            'label'     => Mage::helper('leftsidebar')->__('Content'),
            'title'     => Mage::helper('leftsidebar')->__('Content'),
            'style'     => 'width:98%; height:400px;',
            'wysiwyg'   => false,
            'required'  => true,
        ));
        
		$fieldset->addField('info', 'text', array(
            'label'     => Mage::helper('leftsidebar')->__('Information'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'info',
        ));
		
		$fieldset->addField('link', 'text', array(
            'label'     => Mage::helper('leftsidebar')->__('Link'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'link',
        ));
		
        if ( Mage::getSingleton('adminhtml/session')->getLeftsidebarData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getLeftsidebarData());
            Mage::getSingleton('adminhtml/session')->setLeftsidebarData(null);
        } elseif ( Mage::registry('leftsidebar_data') ) {
            $form->setValues(Mage::registry('leftsidebar_data')->getData());
        }
        return parent::_prepareForm();
    }
}