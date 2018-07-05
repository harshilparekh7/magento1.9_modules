<?php

namespace Oye\Deliverydate\Model\Sales\Order\Pdf;

/**
 * Class InvoicePlugin
 * @package Oye\Deliverydate\Model\Sales\Order\Pdf
 */
class ShipmentPlugin
{
    /**
     * @param $subject
     * @param \Closure $proceed
     * @param $invoices
     * @return mixed
     */
    public function aroundGetPdf($subject, \Closure $proceed, $invoices)
    {
        foreach($invoices as $invoice)
        {
            $invoice->getOrder()->setAppendDeliveryDate(true);
        }
        $returnValue = $proceed($invoices);

        return $returnValue;
    }

}