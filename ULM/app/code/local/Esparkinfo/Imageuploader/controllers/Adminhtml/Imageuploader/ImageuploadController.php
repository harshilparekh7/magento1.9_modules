<?php
/**
 * {{Esparkinfo}}_{{Imageuploader}} extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       {{Esparkinfo}}
 * @package        {{Esparkinfo}}_{{Imageuploader}}
 * @copyright      Copyright (c) 2018
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Imageupload admin controller
 *
 * @category    Esparkinfo
 * @package     Esparkinfo_Imageuploader
 * @author      Ultimate Module Creator
 */
class Esparkinfo_Imageuploader_Adminhtml_Imageuploader_ImageuploadController extends Esparkinfo_Imageuploader_Controller_Adminhtml_Imageuploader
{
    /**
     * init the imageupload
     *
     * @access protected
     * @return Esparkinfo_Imageuploader_Model_Imageupload
     */
    protected function _initImageupload()
    {
        $imageuploadId  = (int) $this->getRequest()->getParam('id');
        $imageupload    = Mage::getModel('esparkinfo_imageuploader/imageupload');
        if ($imageuploadId) {
            $imageupload->load($imageuploadId);
        }
        Mage::register('current_imageupload', $imageupload);
        return $imageupload;
    }

    /**
     * default action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->_title(Mage::helper('esparkinfo_imageuploader')->__('Esparkinfo'))
             ->_title(Mage::helper('esparkinfo_imageuploader')->__('Imageuploads'));
        $this->renderLayout();
    }

    /**
     * grid action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function gridAction()
    {
        $this->loadLayout()->renderLayout();
    }

    /**
     * edit imageupload - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function editAction()
    {
        $imageuploadId    = $this->getRequest()->getParam('id');
        $imageupload      = $this->_initImageupload();
        if ($imageuploadId && !$imageupload->getId()) {
            $this->_getSession()->addError(
                Mage::helper('esparkinfo_imageuploader')->__('This imageupload no longer exists.')
            );
            $this->_redirect('*/*/');
            return;
        }
        $data = Mage::getSingleton('adminhtml/session')->getImageuploadData(true);
        if (!empty($data)) {
            $imageupload->setData($data);
        }
        Mage::register('imageupload_data', $imageupload);
        $this->loadLayout();
        $this->_title(Mage::helper('esparkinfo_imageuploader')->__('Esparkinfo'))
             ->_title(Mage::helper('esparkinfo_imageuploader')->__('Imageuploads'));
        if ($imageupload->getId()) {
            $this->_title($imageupload->getImageupload());
        } else {
            $this->_title(Mage::helper('esparkinfo_imageuploader')->__('Add imageupload'));
        }
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }

    /**
     * new imageupload action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * save imageupload - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost('imageupload')) {
            try {
                $imageupload = $this->_initImageupload();
                $imageupload->addData($data);
                $imageupload->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('esparkinfo_imageuploader')->__('Imageupload was successfully saved')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $imageupload->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setImageuploadData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('esparkinfo_imageuploader')->__('There was a problem saving the imageupload.')
                );
                Mage::getSingleton('adminhtml/session')->setImageuploadData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('esparkinfo_imageuploader')->__('Unable to find imageupload to save.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * delete imageupload - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function deleteAction()
    {
        if ( $this->getRequest()->getParam('id') > 0) {
            try {
                $imageupload = Mage::getModel('esparkinfo_imageuploader/imageupload');
                $imageupload->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('esparkinfo_imageuploader')->__('Imageupload was successfully deleted.')
                );
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('esparkinfo_imageuploader')->__('There was an error deleting imageupload.')
                );
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                Mage::logException($e);
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('esparkinfo_imageuploader')->__('Could not find imageupload to delete.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * mass delete imageupload - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massDeleteAction()
    {
        $imageuploadIds = $this->getRequest()->getParam('imageupload');
        if (!is_array($imageuploadIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('esparkinfo_imageuploader')->__('Please select imageuploads to delete.')
            );
        } else {
            try {
                foreach ($imageuploadIds as $imageuploadId) {
                    $imageupload = Mage::getModel('esparkinfo_imageuploader/imageupload');
                    $imageupload->setId($imageuploadId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('esparkinfo_imageuploader')->__('Total of %d imageuploads were successfully deleted.', count($imageuploadIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('esparkinfo_imageuploader')->__('There was an error deleting imageuploads.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * mass status change - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massStatusAction()
    {
        $imageuploadIds = $this->getRequest()->getParam('imageupload');
        if (!is_array($imageuploadIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('esparkinfo_imageuploader')->__('Please select imageuploads.')
            );
        } else {
            try {
                foreach ($imageuploadIds as $imageuploadId) {
                $imageupload = Mage::getSingleton('esparkinfo_imageuploader/imageupload')->load($imageuploadId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d imageuploads were successfully updated.', count($imageuploadIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('esparkinfo_imageuploader')->__('There was an error updating imageuploads.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * export as csv - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportCsvAction()
    {
        $fileName   = 'imageupload.csv';
        $content    = $this->getLayout()->createBlock('esparkinfo_imageuploader/adminhtml_imageupload_grid')
            ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as MsExcel - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportExcelAction()
    {
        $fileName   = 'imageupload.xls';
        $content    = $this->getLayout()->createBlock('esparkinfo_imageuploader/adminhtml_imageupload_grid')
            ->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as xml - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportXmlAction()
    {
        $fileName   = 'imageupload.xml';
        $content    = $this->getLayout()->createBlock('esparkinfo_imageuploader/adminhtml_imageupload_grid')
            ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Check if admin has permissions to visit related pages
     *
     * @access protected
     * @return boolean
     * @author Ultimate Module Creator
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('esparkinfo_imageuploader/imageupload');
    }
}
