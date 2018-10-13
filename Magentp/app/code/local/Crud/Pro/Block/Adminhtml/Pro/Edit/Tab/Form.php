<?php

class Crud_Pro_Block_Adminhtml_Pro_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
 {
	
 protected function _prepareForm()
 {
	 
 $form = new Varien_Data_Form();
 $this->setForm($form);
 $fieldset = $form->addFieldset('pro_form', array('legend'=>Mage::helper('pro')->__('Student information')));

$fieldset->addField('stdname', 'text', array(
 'label' => Mage::helper('pro')->__('Name'),
 'class' => 'required-entry',
 //'required' => true,
 //'readonly' => true,
 'name' => 'stdname',
 ));

$fieldset->addField('email', 'text', array(
 'label' => Mage::helper('pro')->__('Email'),
 'class' => 'required-entry',
 //'required' => true,
 'name' => 'email',
 //'readonly' => true,
 ));

$fieldset->addField('rollno', 'text', array(
 'label' => Mage::helper('pro')->__('Roll Number'),
 'class' => 'required-entry',
 //'required' => true,
 'name' => 'rollno',
 //'readonly' => true,
 ));

$fieldset->addField('status', 'select', array(
 'label' => Mage::helper('pro')->__('Status'),
 'name' => 'status',
 'values' => array(
 array(
 'value' => 0,
 'label' => Mage::helper('pro')->__('Active'),
 ),

array(
 'value' => 1,
 'label' => Mage::helper('pro')->__('Inactive'),
 ),
 ),
 ));

if ( Mage::getSingleton('adminhtml/session')->getProData() )
 {
 $form->setValues(Mage::getSingleton('adminhtml/session')->getProData());
 Mage::getSingleton('adminhtml/session')->setProData(null);
 } elseif ( Mage::registry('pro_data') ) {
 $form->setValues(Mage::registry('pro_data')->getData());
 }
 return parent::_prepareForm();
 }
 }