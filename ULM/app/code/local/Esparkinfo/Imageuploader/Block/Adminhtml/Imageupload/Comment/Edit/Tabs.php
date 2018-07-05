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
 * Imageupload comment admin edit tabs
 *
 * @category    Esparkinfo
 * @package     Esparkinfo_Imageuploader
 * @author      Ultimate Module Creator
 */
class Esparkinfo_Imageuploader_Block_Adminhtml_Imageupload_Comment_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Initialize Tabs
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('imageupload_comment_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('esparkinfo_imageuploader')->__('Imageupload Comment'));
    }

    /**
     * before render html
     *
     * @access protected
     * @return Esparkinfo_Imageuploader_Block_Adminhtml_Imageupload_Edit_Tabs
     * @author Ultimate Module Creator
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_imageupload_comment',
            array(
                'label'   => Mage::helper('esparkinfo_imageuploader')->__('Imageupload comment'),
                'title'   => Mage::helper('esparkinfo_imageuploader')->__('Imageupload comment'),
                'content' => $this->getLayout()->createBlock(
                    'esparkinfo_imageuploader/adminhtml_imageupload_comment_edit_tab_form'
                )
                ->toHtml(),
            )
        );
        if (!Mage::app()->isSingleStoreMode()) {
            $this->addTab(
                'form_store_imageupload_comment',
                array(
                    'label'   => Mage::helper('esparkinfo_imageuploader')->__('Store views'),
                    'title'   => Mage::helper('esparkinfo_imageuploader')->__('Store views'),
                    'content' => $this->getLayout()->createBlock(
                        'esparkinfo_imageuploader/adminhtml_imageupload_comment_edit_tab_stores'
                    )
                    ->toHtml(),
                )
            );
        }
        return parent::_beforeToHtml();
    }

    /**
     * Retrieve comment
     *
     * @access public
     * @return Esparkinfo_Imageuploader_Model_Imageupload_Comment
     * @author Ultimate Module Creator
     */
    public function getComment()
    {
        return Mage::registry('current_comment');
    }
}
