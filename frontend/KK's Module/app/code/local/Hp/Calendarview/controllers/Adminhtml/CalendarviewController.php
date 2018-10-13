<?php

class Hp_Calendarview_Adminhtml_CalendarviewController extends Mage_Adminhtml_Controller_action
{

    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('calendarview/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }    
    
    public function indexAction() {
        $this->_initAction();        
        $this->_addContent($this->getLayout()->createBlock('calendarview/adminhtml_calendarview'));
        $this->renderLayout();
    }

    public function editAction()
    {
        $calendarviewId     = $this->getRequest()->getParam('id');
        $calendarviewModel  = Mage::getModel('calendarview/calendarview')->load($calendarviewId);

        if ($calendarviewModel->getId() || $calendarviewId == 0) {

            Mage::register('calendarview_data', $calendarviewModel);

            $this->loadLayout();
            $this->_setActiveMenu('calendarview/items');
            
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
            
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            
            $this->_addContent($this->getLayout()->createBlock('calendarview/adminhtml_calendarview_edit'))
                 ->_addLeft($this->getLayout()->createBlock('calendarview/adminhtml_calendarview_edit_tabs'));
                
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('calendarview')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }
    
    public function newAction()
    {
        $this->_forward('edit');
    }
    
    public function saveAction()
    {
        if ( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
                $calendarviewModel = Mage::getModel('calendarview/calendarview');
                
                $calendarviewModel->setId($this->getRequest()->getParam('id'))
                    ->setTitle($postData['title'])
                    ->setContent($postData['date'])
                    ->setContent($postData['url'])
                    ->setStatus($postData['status'])
                    ->save();
                
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setCalendarviewData(false);

                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setCalendarviewData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }
    
    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $calendarviewModel = Mage::getModel('calendarview/calendarview');
                
                $calendarviewModel->setId($this->getRequest()->getParam('id'))
                    ->delete();
                    
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
}