<?php

class Neklo_Core_Block_System_Newsletter_Subscribe extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $element->setScope(false);
        $element->setCanUseWebsiteValue(false);
        $element->setCanUseDefaultValue(false);
        return parent::render($element);
    }

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $subscribeButton = $this->getLayout()->createBlock('neklo_core/system_newsletter_subscribe_button', 'neklo_core_subscribe');
        $subscribeButton->setTemplate('neklo/core/system/subscribe/button.phtml');
        $subscribeButton->setContainerId($element->getContainer()->getHtmlId());
        return $subscribeButton->toHtml();
    }
}