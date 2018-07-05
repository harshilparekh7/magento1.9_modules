<?php

namespace Oye\Deliverydate\Controller\Adminhtml\Holiday;

/**
 * Class Grid
 * @package Oye\Deliverydate\Controller\Adminhtml\Holiday
 */
class Grid extends \Oye\Deliverydate\Controller\Adminhtml\Holiday
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->_resultPageFactory->create();
    }
}
