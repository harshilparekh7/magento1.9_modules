<?php
 
class Chilly_Imageslide_Adminhtml_ImageslideController extends Mage_Adminhtml_Controller_Action
{
 
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('imageslide/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }   
   
    public function indexAction() {
        $this->_initAction();       
        $this->_addContent($this->getLayout()->createBlock('imageslide/adminhtml_imageslide'));
        $this->renderLayout();
    }
 public function productAction(){
	    
        $this->loadLayout();
        $this->getLayout()->getBlock('product.grid')
        ->setProducts($this->getRequest()->getPost('products', null));
        $this->renderLayout();
    }
	 public function productGridAction()
    {
      
        $this->loadLayout();
        $this->getLayout()->getBlock('product.grid')
            ->setProducts($this->getRequest()->getPost('products', null));
        $this->renderLayout();
    }

	
    public function editAction()
    {
        $imageslideId     = $this->getRequest()->getParam('id');
        $imageslideModel  = Mage::getModel('imageslide/imageslide')->load($imageslideId);
 
        if ($imageslideModel->getId() || $imageslideId == 0) {
 
            Mage::register('imageslide_data', $imageslideModel);
 
            $this->loadLayout();
            $this->_setActiveMenu('imageslide/items');
           
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
           
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
           
            $this->_addContent($this->getLayout()->createBlock('imageslide/adminhtml_imageslide_edit'))
                 ->_addLeft($this->getLayout()->createBlock('imageslide/adminhtml_imageslide_edit_tabs'));
               
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('imageslide')->__('Item does not exist'));
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
				if(isset($postData['links'])){
                    $products = Mage::helper('adminhtml/js')->decodeGridSerializedInput($data['links']['products']); //Save the array to your database
                }
				//exit;
                $imageslideModel = Mage::getModel('imageslide/imageslide');
               
                $imageslideModel->setId($this->getRequest()->getParam('id'))
                    ->setTitle($postData['title'])
                    ->setCId($postData['c_id'])
                    ->setStatus($postData['status'])
                    ->save();
               var_dump($products);
			   var_dump($postData);exit;
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setimageslideData(false);
 
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setimageslideData($this->getRequest()->getPost());
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
                $imageslideModel = Mage::getModel('imageslide/imageslide');
               
                $imageslideModel->setId($this->getRequest()->getParam('id'))
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
    /**
     * Product grid for AJAX request.
     * Sort and filter result for example.
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('imageslide/adminhtml_imageslide_grid')->toHtml()
        );
    }
}