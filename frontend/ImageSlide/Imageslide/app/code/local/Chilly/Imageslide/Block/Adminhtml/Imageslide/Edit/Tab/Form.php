<?php
 
class Chilly_Imageslide_Block_Adminhtml_Imageslide_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('imageslide_form', array('legend'=>Mage::helper('imageslide')->__('Item information')));
       
        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('imageslide')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        ));
 
        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('imageslide')->__('Status'),
            'name'      => 'status',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('imageslide')->__('Active'),
                ),
 
                array(
                    'value'     => 0,
                    'label'     => Mage::helper('imageslide')->__('Inactive'),
                ),
            ),
        ));
       
        $fieldset->addField('c_id', 'text', array(
            'name'      => 'c_id',
            'label'     => Mage::helper('imageslide')->__('Category ID'),
            'title'     => Mage::helper('imageslide')->__('Category ID'),
            'required'  => true,
        ));
       
        if ( Mage::getSingleton('adminhtml/session')->getImageslideData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getImageslideData());
            Mage::getSingleton('adminhtml/session')->setImageslideData(null);
        } elseif ( Mage::registry('imageslide_data') ) {
            $form->setValues(Mage::registry('imageslide_data')->getData());
        }
        return parent::_prepareForm();
    }
}