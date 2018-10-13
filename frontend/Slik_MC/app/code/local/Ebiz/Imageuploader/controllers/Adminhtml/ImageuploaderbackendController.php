<?php
class Ebiz_Imageuploader_Adminhtml_ImageuploaderbackendController extends Mage_Adminhtml_Controller_Action
{

	protected function _isAllowed()
	{
		//return Mage::getSingleton('admin/session')->isAllowed('imageuploader/imageuploaderbackend');
		return true;
	}

	public function indexAction()
    {
       $this->loadLayout();
	   $this->_title($this->__("Image Uploader"));
	   $this->renderLayout();
    }
}