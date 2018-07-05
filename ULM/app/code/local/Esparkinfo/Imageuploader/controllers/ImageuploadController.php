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
 * Imageupload front contrller
 *
 * @category    Esparkinfo
 * @package     Esparkinfo_Imageuploader
 * @author      Ultimate Module Creator
 */
class Esparkinfo_Imageuploader_ImageuploadController extends Mage_Core_Controller_Front_Action
{

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
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if (Mage::helper('esparkinfo_imageuploader/imageupload')->getUseBreadcrumbs()) {
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb(
                    'home',
                    array(
                        'label' => Mage::helper('esparkinfo_imageuploader')->__('Home'),
                        'link'  => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'imageuploads',
                    array(
                        'label' => Mage::helper('esparkinfo_imageuploader')->__('Imageuploads'),
                        'link'  => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->addLinkRel('canonical', Mage::helper('esparkinfo_imageuploader/imageupload')->getImageuploadsUrl());
        }
        if ($headBlock) {
            $headBlock->setTitle(Mage::getStoreConfig('esparkinfo_imageuploader/imageupload/meta_title'));
            $headBlock->setKeywords(Mage::getStoreConfig('esparkinfo_imageuploader/imageupload/meta_keywords'));
            $headBlock->setDescription(Mage::getStoreConfig('esparkinfo_imageuploader/imageupload/meta_description'));
        }
        $this->renderLayout();
    }

    /**
     * init Imageupload
     *
     * @access protected
     * @return Esparkinfo_Imageuploader_Model_Imageupload
     * @author Ultimate Module Creator
     */
    protected function _initImageupload()
    {
        $imageuploadId   = $this->getRequest()->getParam('id', 0);
        $imageupload     = Mage::getModel('esparkinfo_imageuploader/imageupload')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load($imageuploadId);
        if (!$imageupload->getId()) {
            return false;
        } elseif (!$imageupload->getStatus()) {
            return false;
        }
        return $imageupload;
    }

    /**
     * view imageupload action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function viewAction()
    {
        $imageupload = $this->_initImageupload();
        if (!$imageupload) {
            $this->_forward('no-route');
            return;
        }
        Mage::register('current_imageupload', $imageupload);
        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if ($root = $this->getLayout()->getBlock('root')) {
            $root->addBodyClass('imageuploader-imageupload imageuploader-imageupload' . $imageupload->getId());
        }
        if (Mage::helper('esparkinfo_imageuploader/imageupload')->getUseBreadcrumbs()) {
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb(
                    'home',
                    array(
                        'label'    => Mage::helper('esparkinfo_imageuploader')->__('Home'),
                        'link'     => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'imageuploads',
                    array(
                        'label' => Mage::helper('esparkinfo_imageuploader')->__('Imageuploads'),
                        'link'  => Mage::helper('esparkinfo_imageuploader/imageupload')->getImageuploadsUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'imageupload',
                    array(
                        'label' => $imageupload->getImageupload(),
                        'link'  => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->addLinkRel('canonical', $imageupload->getImageuploadUrl());
        }
        if ($headBlock) {
            if ($imageupload->getMetaTitle()) {
                $headBlock->setTitle($imageupload->getMetaTitle());
            } else {
                $headBlock->setTitle($imageupload->getImageupload());
            }
            $headBlock->setKeywords($imageupload->getMetaKeywords());
            $headBlock->setDescription($imageupload->getMetaDescription());
        }
        $this->renderLayout();
    }

    /**
     * imageuploads rss list action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function rssAction()
    {
        if (Mage::helper('esparkinfo_imageuploader/imageupload')->isRssEnabled()) {
            $this->getResponse()->setHeader('Content-type', 'text/xml; charset=UTF-8');
            $this->loadLayout(false);
            $this->renderLayout();
        } else {
            $this->getResponse()->setHeader('HTTP/1.1', '404 Not Found');
            $this->getResponse()->setHeader('Status', '404 File not found');
            $this->_forward('nofeed', 'index', 'rss');
        }
    }

    /**
     * Submit new comment action
     * @access public
     * @author Ultimate Module Creator
     */
    public function commentpostAction()
    {
        $data   = $this->getRequest()->getPost();
        $imageupload = $this->_initImageupload();
        $session    = Mage::getSingleton('core/session');
        if ($imageupload) {
            if ($imageupload->getAllowComments()) {
                if ((Mage::getSingleton('customer/session')->isLoggedIn() ||
                    Mage::getStoreConfigFlag('esparkinfo_imageuploader/imageupload/allow_guest_comment'))) {
                    $comment  = Mage::getModel('esparkinfo_imageuploader/imageupload_comment')->setData($data);
                    $validate = $comment->validate();
                    if ($validate === true) {
                        try {
                            $comment->setImageuploadId($imageupload->getId())
                                ->setStatus(Esparkinfo_Imageuploader_Model_Imageupload_Comment::STATUS_PENDING)
                                ->setCustomerId(Mage::getSingleton('customer/session')->getCustomerId())
                                ->setStores(array(Mage::app()->getStore()->getId()))
                                ->save();
                            $session->addSuccess($this->__('Your comment has been accepted for moderation.'));
                        } catch (Exception $e) {
                            $session->setImageuploadCommentData($data);
                            $session->addError($this->__('Unable to post the comment.'));
                        }
                    } else {
                        $session->setImageuploadCommentData($data);
                        if (is_array($validate)) {
                            foreach ($validate as $errorMessage) {
                                $session->addError($errorMessage);
                            }
                        } else {
                            $session->addError($this->__('Unable to post the comment.'));
                        }
                    }
                } else {
                    $session->addError($this->__('Guest comments are not allowed'));
                }
            } else {
                $session->addError($this->__('This imageupload does not allow comments'));
            }
        }
        $this->_redirectReferer();
    }
}
