<?php

namespace Oye\Deliverydate\Controller\Adminhtml\Holiday;

/**
 * Class NewAction
 * @package Oye\Deliverydate\Controller\Adminhtml\Holiday
 */
class NewAction extends \Oye\Deliverydate\Controller\Adminhtml\Holiday
{

    /**
     * @return $this
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Forward $resultForward */
        $resultForward = $this->_resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}