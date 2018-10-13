<?php

namespace Oye\Deliverydate\Model\System\Config\Source;

/**
 * Class Area
 * @package Oye\Deliverydate\Model\System\Config\Source
 */
class Area implements \Magento\Framework\Option\ArrayInterface
{

    const AREA_SHIPPING_METHOD = 0;
    const AREA_SHIPPING_ADDRESS = 1;

    /**
     * Options array
     *
     * @var array
     */
    protected $_options;

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            self::AREA_SHIPPING_METHOD => __('Shipping Method'),
            self::AREA_SHIPPING_ADDRESS => __('Shipping Address'),
        );
    }
}
