<?php

class Hp_Headerimage_Adminhtml_HeaderimageController extends Mage_Adminhtml_Controller_action
{

    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('headerimage/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }    
    
    public function indexAction() {
        $this->_initAction();        
        $this->_addContent($this->getLayout()->createBlock('headerimage/adminhtml_headerimage'));
        $this->renderLayout();
    }

    public function editAction()
    {
        $headerimageId     = $this->getRequest()->getParam('id');
        $headerimageModel  = Mage::getModel('headerimage/headerimage')->load($headerimageId);

        if ($headerimageModel->getId() || $headerimageId == 0) {

            Mage::register('headerimage_data', $headerimageModel);

            $this->loadLayout();
            $this->_setActiveMenu('headerimage/items');
            
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
            
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            
            $this->_addContent($this->getLayout()->createBlock('headerimage/adminhtml_headerimage_edit'))
                 ->_addLeft($this->getLayout()->createBlock('headerimage/adminhtml_headerimage_edit_tabs'));
                
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('headerimage')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }
    
    public function newAction()
    {
        $this->_forward('edit');
    }
    
    /* public function saveAction()
    {
        if ( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
                $headerimageModel = Mage::getModel('headerimage/headerimage');
                
                $headerimageModel->setId($this->getRequest()->getParam('id'))
                    ->setTitle($postData['title'])
                    ->setCategoryName($postData['category_name'])
                    ->setStatus($postData['status'])
                    ->setCreatedTime(now())
                    ->setUpdateTime(now())
                    ->save();
                
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setHeaderimageData(false);

                $this->_redirect('');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setHeaderimageData($this->getRequest()->getPost());
                $this->_redirect('edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('* /');
    } */

    public function saveAction()
    {
        $post_data = $this->getRequest()->getPost();
        if ($post_data) {
			//print_r($post_data);exit;
            try {
                //Featured save image
               
				try {
                    if ((bool) $post_data['image']['delete'] == 1) {
                        $post_data['image'] = '';
                    } else {
                        unset($post_data['image']);
                        if (isset($_FILES)) {
                            if ($_FILES['image']['name']) {
                                if ($this->getRequest()->getParam("id")) {
                                    $model = Mage::getModel("headerimage/headerimage")->load($this->getRequest()->getParam("id"));
                                    if ($model->getData('image')) {
                                        $io = new Varien_Io_File();
                                        $io->rm(Mage::getBaseDir('media') . DS . implode(DS, explode('/', $model->getData('image'))));
                                    }
                                }
                                $path = Mage::getBaseDir('media') . DS . 'headerimage' . DS . 'headerimage' . DS;
                                $uploader = new Varien_File_Uploader('image');
                                $uploader->setAllowedExtensions(array('jpg', 'png', 'gif'));
                                $uploader->setAllowRenameFiles(true);
                                $uploader->setFilesDispersion(false);
                                $destFile = $path . $_FILES['image']['name'];
                                $filename = $uploader->getNewFileName($destFile);
                                $uploader->save($path, $filename);

                                $post_data['image'] = 'headerimage/headerimage/' . $filename;
                            }
                        }
                    }
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                    return;
                }
				
                $model = Mage::getModel("headerimage/headerimage")
                        ->addData($post_data)
                        ->setId($this->getRequest()->getParam("id"))
                        ->save();
						
                Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Header Image was successfully saved"));
                Mage::getSingleton("adminhtml/session")->setServiceData(false);

                if ($this->getRequest()->getParam("back")) {
                    $this->_redirect("*/*/edit", array("id" => $model->getId()));
                    return;
                }
                $this->_redirect("*/*/");
                return;
            } catch (Exception $e) {
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                Mage::getSingleton("adminhtml/session")->setServiceData($this->getRequest()->getPost());
                $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
                return;
            }
        }
        $this->_redirect("*/*/");
		
				
    }
    
    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $headerimageModel = Mage::getModel('headerimage/headerimage');
                
                $headerimageModel->setId($this->getRequest()->getParam('id'))
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