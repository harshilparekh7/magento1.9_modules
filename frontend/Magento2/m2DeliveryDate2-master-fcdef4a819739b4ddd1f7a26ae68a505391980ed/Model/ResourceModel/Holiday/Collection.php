<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 11.12.2015
 * Time: 15:58
 */

namespace Oye\Deliverydate\Model\ResourceModel\Holiday;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Oye\Deliverydate\Model\ResourceModel\Holiday
 */
class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Oye\Deliverydate\Model\Holiday',
            'Oye\Deliverydate\Model\ResourceModel\Holiday'
        );
    }
}