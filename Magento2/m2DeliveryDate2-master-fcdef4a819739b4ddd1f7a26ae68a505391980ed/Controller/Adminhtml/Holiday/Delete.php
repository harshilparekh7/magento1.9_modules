<?php

namespace Oye\Deliverydate\Controller\Adminhtml\Holiday;

/**
 * Class Delete
 * @package Oye\Deliverydate\Controller\Adminhtml\Holiday
 */
class Delete extends \Oye\Deliverydate\Controller\Adminhtml\Holiday
{
    /**
     * @return void
     */
    public function execute()
    {
        $holidayId = (int) $this->getRequest()->getParam('id');

        if ($holidayId) {
            $holidayModel = $this->_holidayFactory->create();
            $holidayModel->load($holidayId);

            // Check this news exists or not
            if (!$holidayModel->getId()) {
                $this->messageManager->addError(__('This holiday no longer exists.'));
            } else {
                try {
                    // Delete news
                    $holidayModel->delete();
                    $this->messageManager->addSuccess(__('The holiday has been deleted.'));

                    // Redirect to grid page
                    $this->_redirect('*/*/');
                    return;
                } catch (\Exception $e) {
                    $this->messageManager->addError($e->getMessage());
                    $this->_redirect('*/*/edit', ['id' => $holidayModel->getId()]);
                }
            }
        }
    }
}