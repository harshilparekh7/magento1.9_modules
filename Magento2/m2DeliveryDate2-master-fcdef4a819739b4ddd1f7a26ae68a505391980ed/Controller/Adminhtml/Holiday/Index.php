<?php

namespace Oye\Deliverydate\Controller\Adminhtml\Holiday;

/**
 * Class Index
 * @package Oye\Deliverydate\Controller\Adminhtml\Holiday
 */
class Index extends \Oye\Deliverydate\Controller\Adminhtml\Holiday
{

    /**
     * @return \Magento\Backend\Model\View\Result\Page|void
     */
    public function execute()
    {
        if ($this->getRequest()->getQuery('ajax')) {
            $this->_forward('grid');
            return;
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        //$resultPage->setActiveMenu('Oye_Deliverydate::main');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Holidays'));

        return $resultPage;
    }
    /**
     * will not load without ACL checks
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Oye_Deliverydate::main');
    }

}