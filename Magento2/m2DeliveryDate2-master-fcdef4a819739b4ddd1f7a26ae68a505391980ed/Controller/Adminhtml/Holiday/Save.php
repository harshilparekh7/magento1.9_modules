<?php

namespace Oye\Deliverydate\Controller\Adminhtml\Holiday;

/**
 * Class Save
 * @package Oye\Deliverydate\Controller\Adminhtml\Holiday
 */
class Save extends \Oye\Deliverydate\Controller\Adminhtml\Holiday
{
    /**
     * @return void
     */
    public function execute()
    {
        $isPost = $this->getRequest()->getPost();

        if ($isPost) {
            $holidayModel = $this->_holidayFactory->create();
            $holidayId = $this->getRequest()->getParam('id');

            if ($holidayId) {
                $holidayModel->load($holidayId);
            }
            $formData = $this->getRequest()->getParam('holiday');
            $holidayModel->setData($formData);

            try {
                // Save holiday
                $holidayModel->save();

                // Display success message
                $this->messageManager->addSuccess(__('The holiday has been saved.'));

                // Check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', ['id' => $holidayModel->getId(), '_current' => true]);
                    return;
                }

                // Go to grid page
                $this->_redirect('*/*/');
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }

            $this->_getSession()->setFormData($formData);
            $this->_redirect('*/*/edit', ['id' => $holidayId]);
        }
    }
}