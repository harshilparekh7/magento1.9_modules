<?php

class Crud_Pro_Adminhtml_ProController extends Mage_Adminhtml_Controller_Action
 {

protected function _initAction()
 {
 $this->loadLayout()
 ->_setActiveMenu('pro/pro')
 ->_addBreadcrumb(Mage::helper('adminhtml')->__('Data Manager'), Mage::helper('adminhtml')->__('Data Manager'));
 return $this;
 }

public function indexAction() {
 $this->_initAction();
 $this->_addContent($this->getLayout()->createBlock('pro/adminhtml_pro'));
 $this->renderLayout();
 }

public function editAction()
 {
 $proId = $this->getRequest()->getParam('id');

$proModel = Mage::getModel('pro/pro')->load($proId);

if ($proModel->getId() || $proId == 0) {

Mage::register('pro_data', $proModel);

$this->loadLayout();
 $this->_setActiveMenu('pro/pro');

$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Student Information'), Mage::helper('adminhtml')->__('Studenet Information'));
 $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Data News'), Mage::helper('adminhtml')->__('Data News'));

$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

$this->_addContent($this->getLayout()->createBlock('pro/adminhtml_pro_edit'))
 ->_addLeft($this->getLayout()->createBlock('pro/adminhtml_pro_edit_tabs'));

$this->renderLayout();
 } else {
 Mage::getSingleton('adminhtml/session')->addError(Mage::helper('pro')->__('Item does not exist'));
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
 $proModel = Mage::getModel('pro/pro');

$proModel->setId($this->getRequest()->getParam('id'))
 ->setStdname($postData['stdname'])
 ->setEmail($postData['email'])
 ->setRollno($postData['rollno'])
 ->setStatus($postData['status'])
 ->save();

Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Data was successfully saved'));
 Mage::getSingleton('adminhtml/session')->setProData(false);

$this->_redirect('*/*/');
 return;
 } catch (Exception $e) {
 Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
 Mage::getSingleton('adminhtml/session')->setProData($this->getRequest()->getPost());
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
 $proModel = Mage::getModel('pro/pro');

$proModel->setId($this->getRequest()->getParam('id'))
 ->delete();

Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Data was successfully deleted'));
 $this->_redirect('*/*/');
 } catch (Exception $e) {
 Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
 $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
 }
 }
 $this->_redirect('*/*/');
 }
 /**
 * Product grid for AJAX request.
 * Sort and filter result for example.
 */
 public function gridAction()
 {
 $this->loadLayout();
 $this->getResponse()->setBody(
 $this->getLayout()->createBlock('pro/adminhtml_pro_grid')->toHtml()
 );
 }
 }