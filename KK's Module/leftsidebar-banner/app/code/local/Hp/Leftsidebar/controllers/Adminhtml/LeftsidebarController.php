<?php

class Hp_Leftsidebar_Adminhtml_LeftsidebarController extends Mage_Adminhtml_Controller_action
{

    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('leftsidebar/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }    
    
    public function indexAction() {
        $this->_initAction();        
        $this->_addContent($this->getLayout()->createBlock('leftsidebar/adminhtml_leftsidebar'));
        $this->renderLayout();
    }

    public function editAction()
    {
        $leftsidebarId     = $this->getRequest()->getParam('id');
        $leftsidebarModel  = Mage::getModel('leftsidebar/leftsidebar')->load($leftsidebarId);

        if ($leftsidebarModel->getId() || $leftsidebarId == 0) {

            Mage::register('leftsidebar_data', $leftsidebarModel);

            $this->loadLayout();
            $this->_setActiveMenu('leftsidebar/items');
            
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
            
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            
            $this->_addContent($this->getLayout()->createBlock('leftsidebar/adminhtml_leftsidebar_edit'))
                 ->_addLeft($this->getLayout()->createBlock('leftsidebar/adminhtml_leftsidebar_edit_tabs'));
                
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('leftsidebar')->__('Item does not exist'));
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
                $leftsidebarModel = Mage::getModel('leftsidebar/leftsidebar');
                
                $leftsidebarModel->setId($this->getRequest()->getParam('id'))
                    ->setTitle($postData['title'])
                    ->setContent($postData['content'])
                    ->setInfo($postData['info'])
                    ->setLink($postData['link'])
                    ->setStatus($postData['status'])
                    ->setCreatedTime($postData['created_time'])
                    ->setUpdateTime($postData['update_time'])
                    ->save();
                
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setLeftsidebarData(false);

                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setLeftsidebarData($this->getRequest()->getPost());
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
                $leftsidebarModel = Mage::getModel('leftsidebar/leftsidebar');
                
                $leftsidebarModel->setId($this->getRequest()->getParam('id'))
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