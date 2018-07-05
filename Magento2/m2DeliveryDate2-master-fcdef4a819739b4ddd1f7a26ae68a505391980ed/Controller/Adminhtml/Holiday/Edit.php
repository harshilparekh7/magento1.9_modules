<?php

namespace Oye\Deliverydate\Controller\Adminhtml\Holiday;

/**
 * Class Edit
 * @package Oye\Deliverydate\Controller\Adminhtml\Holiday
 */
class Edit extends \Oye\Deliverydate\Controller\Adminhtml\Holiday
{

    /**
     * @return \Magento\Backend\Model\View\Result\Page|void
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $model = $this->_holidayFactory->create();

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This holiday no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        // Restore previously entered form data from session
        $data = $this->_session->getNewsData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('oyeconfigwizard_holiday', $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();

        $resultPage->getConfig()->getTitle()->prepend(__('Holiday'));

        return $resultPage;
    }
}