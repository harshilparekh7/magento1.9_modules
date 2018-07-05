<?php

namespace Oye\Deliverydate\Model\System\Config\Source;

/**
 * Class Time
 * @package Oye\Deliverydate\Model\System\Config\Source
 */
class Time implements \Magento\Framework\Option\ArrayInterface
{
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
        $options = array();
        for ($i = 0; $i < 24; $i++)
        {
            if($i<10)
            {
                $time1 = sprintf('0%s:00', $i);
                $time2 = sprintf('0%s:30', $i);
                $options[$time1] = $time1;
                $options[$time2] = $time2;
            }
            else
            {
                $time1 = sprintf('%s:00', $i);
                $time2 = sprintf('%s:30', $i);
                $options[$time1] = $time1;
                $options[$time2] = $time2;
            }
        }

        return $options;
    }
}
