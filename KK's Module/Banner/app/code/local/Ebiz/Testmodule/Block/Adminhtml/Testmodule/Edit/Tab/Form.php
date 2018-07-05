<?php

class Ebiz_Testmodule_Block_Adminhtml_Testmodule_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('testmodule_form', array('legend'=>Mage::helper('testmodule')->__('Item information')));
        
        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('testmodule')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('testmodule')->__('Status'),
            'name'      => 'status',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('testmodule')->__('Active'),
                ),

                array(
                    'value'     => 0,
                    'label'     => Mage::helper('testmodule')->__('Inactive'),
                ),
            ),
        ));
        
        $fieldset->addField('content', 'editor', array(
            'name'      => 'content',
            'label'     => Mage::helper('testmodule')->__('Content'),
            'title'     => Mage::helper('testmodule')->__('Content'),
            'style'     => 'width:98%; height:400px;',
            'wysiwyg'   => false,
            'required'  => true,
        ));
        
        if ( Mage::getSingleton('adminhtml/session')->gettestmoduleData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getTestmoduleData());
            Mage::getSingleton('adminhtml/session')->setTestmoduleData(null);
        } elseif ( Mage::registry('testmodule_data') ) {
            $form->setValues(Mage::registry('testmodule_data')->getData());
        }
        return parent::_prepareForm();
    }
}