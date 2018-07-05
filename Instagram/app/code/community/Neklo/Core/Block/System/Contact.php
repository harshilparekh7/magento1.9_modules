<?php

class Neklo_Core_Block_System_Contact extends Mage_Adminhtml_Block_System_Config_Form_Fieldset
{
    protected function _getHeaderHtml($element)
    {
        return parent::_getHeaderHtml($element) . $this->_getAfterHeaderHtml();
    }

    protected function _getAfterHeaderHtml()
    {
        $subscribeButton = $this->getLayout()->createBlock('neklo_core/system_contact_header', 'neklo_core_contact_header');
        $subscribeButton->setTemplate('neklo/core/system/contact/header.phtml');
        return $subscribeButton->toHtml();
    }
}