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
 * Imageupload list block
 *
 * @category    Esparkinfo
 * @package     Esparkinfo_Imageuploader
 * @author      Ultimate Module Creator
 */
class Esparkinfo_Imageuploader_Block_Imageupload_List extends Mage_Core_Block_Template
{
    /**
     * initialize
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function _construct()
    {
        parent::_construct();
        $imageuploads = Mage::getResourceModel('esparkinfo_imageuploader/imageupload_collection')
                         ->addStoreFilter(Mage::app()->getStore())
                         ->addFieldToFilter('status', 1);
        $imageuploads->setOrder('imageupload', 'asc');
        $this->setImageuploads($imageuploads);
    }

    /**
     * prepare the layout
     *
     * @access protected
     * @return Esparkinfo_Imageuploader_Block_Imageupload_List
     * @author Ultimate Module Creator
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock(
            'page/html_pager',
            'esparkinfo_imageuploader.imageupload.html.pager'
        )
        ->setCollection($this->getImageuploads());
        $this->setChild('pager', $pager);
        $this->getImageuploads()->load();
        return $this;
    }

    /**
     * get the pager html
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}
