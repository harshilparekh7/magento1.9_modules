<?php

namespace Oye\Deliverydate\Block\Adminhtml;

/**
 * Class DateField
 * @package Oye\Deliverydate\Block\Adminhtml
 */
class DateField extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Quote\Model\Quote
     */
    public $quote;
    /**
     * @var \Oye\Deliverydate\Helper\Data
     */
    public $helper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     * @param \Magento\Backend\Model\Session\Quote $quoteSession
     * @param \Oye\Deliverydate\Helper\Data $helper
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = [],
        \Magento\Backend\Model\Session\Quote $quoteSession,
        \Oye\Deliverydate\Helper\Data $helper
    )
    {
        $this->helper = $helper;
        $this->quote = $quoteSession->getQuote();
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getStoredDeliveryDate()
    {
        return $this->helper->formatMySqlDateTime(
            $this->quote->getDeliveryDate()
        );
    }

}