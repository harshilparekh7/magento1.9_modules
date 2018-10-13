<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 29.12.2015
 * Time: 14:52
 */

namespace Oye\Deliverydate\Model\Sales\Order\Email;

use Magento\Sales\Model\Order\Email\Container\Template;

/**
 * Class SenderBuilderPlugin
 * @package Oye\Deliverydate\Model\Sales\Order\Email
 */
class SenderBuilderPlugin
{

    /**
     * @var Template
     */
    protected $templateContainer;

    /**
     * @param Template $templateContainer
     */
    public function __construct(
        Template $templateContainer
    ) {
        $this->templateContainer = $templateContainer;
    }


    /**
     * @param $subject
     * @param \Closure $proceed
     * @return mixed
     */
    public function aroundSend($subject, \Closure $proceed)
    {
        $vars = $this->templateContainer->getTemplateVars();
        $order = $vars['order'];
        $order->setAppendDeliveryDate(true);
        $returnValue = $proceed();
        $order->setAppendDeliveryDate(false);
        return $returnValue;
    }
}