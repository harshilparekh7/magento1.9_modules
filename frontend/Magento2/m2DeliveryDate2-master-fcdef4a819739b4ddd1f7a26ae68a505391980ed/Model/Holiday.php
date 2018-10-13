<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 02.12.2015
 * Time: 13:28
 */

namespace Oye\Deliverydate\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Holiday
 * @package Oye\Deliverydate\Model
 */
class Holiday extends AbstractModel
{
    /**
     * Initialize holiday model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Oye\Deliverydate\Model\ResourceModel\Holiday');
    }
}