<?php
namespace Oye\Deliverydate\Model\System\Config;

/**
 * Class HolidayGridLink
 * @package Oye\Deliverydate\Model\System\Config
 */
class HolidayGridLink extends \Magento\Config\Block\System\Config\Form\Field
{

    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $url = $this->_urlBuilder->getUrl('oyedeliverydate/holiday/');
        $linkText = __('Add/Edit Holidays');

        $html = sprintf('<a href="%s">%s</a>',
            $url,
            $linkText
        );

        return $html;
    }
}