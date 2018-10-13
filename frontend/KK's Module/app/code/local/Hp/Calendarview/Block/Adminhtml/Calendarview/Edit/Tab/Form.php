<?php

class Hp_Calendarview_Block_Adminhtml_Calendarview_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('calendarview_form', array('legend'=>Mage::helper('calendarview')->__('Item information')));
        
        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('calendarview')->__('Event Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        )); 
		
		$fieldset->addField('date', 'text', array(
            'label'     => Mage::helper('calendarview')->__('Event Date'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'date',
        ));
		
		$fieldset->addField('url', 'text', array(
            'label'     => Mage::helper('calendarview')->__('Event URL'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'url',
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('calendarview>')->__('Status'),
            'name'      => 'status',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('calendarview')->__('Active'),
                ),

                array(
                    'value'     => 0,
                    'label'     => Mage::helper('calendarview')->__('Inactive'),
                ),
            ),
        ));
        
       /*  $fieldset->addField('content', 'editor', array(
            'name'      => 'content',
            'label'     => Mage::helper('calendarview')->__('Content'),
            'title'     => Mage::helper('calendarview')->__('Content'),
            'style'     => 'width:98%; height:400px;',
            'wysiwyg'   => false,
            'required'  => true,
        )); */
        
        if ( Mage::getSingleton('adminhtml/session')->getCalendarviewData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getCalendarviewData());
            Mage::getSingleton('adminhtml/session')->setCalendarviewData(null);
        } elseif ( Mage::registry('calendarview_data') ) {
            $form->setValues(Mage::registry('calendarview_data')->getData());
        }
        return parent::_prepareForm();
    }
}