<?php

namespace Oye\Deliverydate\Model\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;


/**
 * Class AddHtmlToOrderShippingViewObserver
 * @package Oye\Deliverydate\Model\Observer
 */
class AddHtmlToOrderShippingViewObserver implements ObserverInterface
{

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_helper;

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_block;

    /**
     * @param \Oye\Deliverydate\Helper\Data $helper
     * @param \Magento\Framework\View\Element\Template $block
     */
    public function __construct(
        \Oye\Deliverydate\Helper\Data $helper,
        \Magento\Framework\View\Element\Template $block
    )
    {
        $this->_helper = $helper;
        $this->_block = $block;
    }

    /**
     * @param EventObserver $observer
     */
    public function execute(EventObserver $observer)
    {
        if($observer->getElementName() == 'order_shipping_view')
        {
            $orderShippingViewBlock = $observer->getLayout()->getBlock($observer->getElementName());
            $order = $orderShippingViewBlock->getOrder();

            $formattedDate = $this->_helper->formatMySqlDateTime($order->getDeliveryDate());

            $deliveryDateBlock = $this->_block;
            $deliveryDateBlock->setDeliveryDate($formattedDate);
            $deliveryDateBlock->setTemplate('Oye_Deliverydate::order_info_shipping_info.phtml');

            $html = $observer->getTransport()->getOutput() . $deliveryDateBlock->toHtml();
            $observer->getTransport()->setOutput($html);
        }
    }
}