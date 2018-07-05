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
 * Imageupload widget block
 *
 * @category    Esparkinfo
 * @package     Esparkinfo_Imageuploader
 * @author      Ultimate Module Creator
 */
class Esparkinfo_Imageuploader_Block_Imageupload_Widget_View extends Mage_Core_Block_Template implements
    Mage_Widget_Block_Interface
{
    protected $_htmlTemplate = 'esparkinfo_imageuploader/imageupload/widget/view.phtml';

    /**
     * Prepare a for widget
     *
     * @access protected
     * @return Esparkinfo_Imageuploader_Block_Imageupload_Widget_View
     * @author Ultimate Module Creator
     */
    protected function _beforeToHtml()
    {
        parent::_beforeToHtml();
        $imageuploadId = $this->getData('imageupload_id');
        if ($imageuploadId) {
            $imageupload = Mage::getModel('esparkinfo_imageuploader/imageupload')
                ->setStoreId(Mage::app()->getStore()->getId())
                ->load($imageuploadId);
            if ($imageupload->getStatus()) {
                $this->setCurrentImageupload($imageupload);
                $this->setTemplate($this->_htmlTemplate);
            }
        }
        return $this;
    }
}
