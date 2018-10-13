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
 * Imageupload comment list block
 *
 * @category    Esparkinfo
 * @package     Esparkinfo_Imageuploader
 * @author      Ultimate Module Creator
 */
class Esparkinfo_Imageuploader_Block_Imageupload_Comment_List extends Mage_Core_Block_Template
{
    /**
     * initialize
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $imageupload = $this->getImageupload();
        $comments = Mage::getResourceModel('esparkinfo_imageuploader/imageupload_comment_collection')
            ->addFieldToFilter('imageupload_id', $imageupload->getId())
            ->addStoreFilter(Mage::app()->getStore())
             ->addFieldToFilter('status', 1);
        $comments->setOrder('created_at', 'asc');
        $this->setComments($comments);
    }

    /**
     * prepare the layout
     *
     * @access protected
     * @return Esparkinfo_Imageuploader_Block_Imageupload_Comment_List
     * @author Ultimate Module Creator
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock(
            'page/html_pager',
            'esparkinfo_imageuploader.imageupload.html.pager'
        )
        ->setCollection($this->getComments());
        $this->setChild('pager', $pager);
        $this->getComments()->load();
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
    /**
     * get the current imageupload
     *
     * @access protected
     * @return Esparkinfo_Imageuploader_Model_Imageupload
     * @author Ultimate Module Creator
     */
    public function getImageupload()
    {
        return Mage::registry('current_imageupload');
    }
}
