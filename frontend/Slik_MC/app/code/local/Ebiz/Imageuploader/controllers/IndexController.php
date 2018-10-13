<?php
class Ebiz_Imageuploader_IndexController extends Mage_Core_Controller_Front_Action{
    public function IndexAction() {
      
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Image Uploader"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("image uploader", array(
                "label" => $this->__("Image Uploader"),
                "title" => $this->__("Image Uploader")
		   ));

      $this->renderLayout(); 
	  
    }
}