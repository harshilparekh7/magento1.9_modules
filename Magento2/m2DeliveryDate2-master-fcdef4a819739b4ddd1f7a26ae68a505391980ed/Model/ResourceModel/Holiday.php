<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 02.12.2015
 * Time: 13:28
 */

namespace Oye\Deliverydate\Model\ResourceModel;

/**
 * Class Holiday
 * @package Oye\Deliverydate\Model\ResourceModel
 */
class Holiday extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define main table
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('oye_deliverydate_holiday', 'id');
    }

}