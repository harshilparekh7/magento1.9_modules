<?php

class Hp_Headerimage_Block_Adminhtml_Headerimage_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('headerimage_form', array('legend'=>Mage::helper('headerimage')->__('Item information')));
        
        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('headerimage')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        )); 

		$fieldset->addField('image', 'image', array(
            'label'     => Mage::helper('headerimage')->__('Header Image'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'image',
        )); 

		$fieldset->addField('category_name', 'text', array(
            'label'     => Mage::helper('headerimage')->__('Category Name'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'category_name',
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('headerimage')->__('Status'),
            'name'      => 'status',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('headerimage')->__('Active'),
                ),

                array(
                    'value'     => 0,
                    'label'     => Mage::helper('headerimage')->__('Inactive'),
                ),
            ),
        ));
        
     /*    $fieldset->addField('content', 'editor', array(
            'name'      => 'content',
            'label'     => Mage::helper('headerimage')->__('Content'),
            'title'     => Mage::helper('headerimage')->__('Content'),
            'style'     => 'width:98%; height:400px;',
            'wysiwyg'   => false,
            'required'  => true,
        )); */
        
        if ( Mage::getSingleton('adminhtml/session')->getHeaderimageData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getHeaderimageData());
            Mage::getSingleton('adminhtml/session')->setHeaderimageData(null);
        } elseif ( Mage::registry('headerimage_data') ) {
            $form->setValues(Mage::registry('headerimage_data')->getData());
        }
        return parent::_prepareForm();
    }
}