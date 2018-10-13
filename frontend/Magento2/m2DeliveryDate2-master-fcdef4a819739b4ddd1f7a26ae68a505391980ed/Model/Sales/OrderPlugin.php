<?php

namespace Oye\Deliverydate\Model\Sales;

/**
 * Class OrderPlugin
 * @package Oye\Deliverydate\Model\Sales
 */
class OrderPlugin
{

    public $helper;
    public $request;

    /**
     * @param \Oye\Deliverydate\Helper\Data $helper
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Oye\Deliverydate\Helper\Data $helper,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->helper = $helper;
        $this->request = $request;
    }

    /**
     * we append delivery date to order shipping description string for pdf, emails and frontend order view
     * $order->setAppendDeliveryDate(true) is done in
     * Oye\Deliverydate\Model\Sales\Order\Email\SenderBuilderPlugin and Oye\Deliverydate\Model\Sales\Order\Pdf\InvoicePlugin
     *
     * @param $order
     * @param $result
     * @return string
     */
    public function afterGetShippingDescription($order, $result)
    {
        $isFrontOrderView =
            $this->helper->isRequestAdmin()
            && $this->request->getActionName() == 'view'
            && $this->request->getModuleName() == 'sales';

        if( ($order->getAppendDeliveryDate() && $order->getDeliveryDate())
                || $isFrontOrderView
        )
        {
            return  $result .
                    ", " . __('Delivery date - ') .
                    $this->helper->formatMySqlDateTime($order->getDeliveryDate());
        }
        return $result;
    }



}