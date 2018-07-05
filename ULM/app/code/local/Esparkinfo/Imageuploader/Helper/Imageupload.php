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
 * Imageupload helper
 *
 * @category    Esparkinfo
 * @package     Esparkinfo_Imageuploader
 * @author      Ultimate Module Creator
 */
class Esparkinfo_Imageuploader_Helper_Imageupload extends Mage_Core_Helper_Abstract
{

    /**
     * get the url to the imageuploads list page
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getImageuploadsUrl()
    {
        if ($listKey = Mage::getStoreConfig('esparkinfo_imageuploader/imageupload/url_rewrite_list')) {
            return Mage::getUrl('', array('_direct'=>$listKey));
        }
        return Mage::getUrl('esparkinfo_imageuploader/imageupload/index');
    }

    /**
     * check if breadcrumbs can be used
     *
     * @access public
     * @return bool
     * @author Ultimate Module Creator
     */
    public function getUseBreadcrumbs()
    {
        return Mage::getStoreConfigFlag('esparkinfo_imageuploader/imageupload/breadcrumbs');
    }

    /**
     * check if the rss for imageupload is enabled
     *
     * @access public
     * @return bool
     * @author Ultimate Module Creator
     */
    public function isRssEnabled()
    {
        return  Mage::getStoreConfigFlag('rss/config/active') &&
            Mage::getStoreConfigFlag('esparkinfo_imageuploader/imageupload/rss');
    }

    /**
     * get the link to the imageupload rss list
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getRssUrl()
    {
        return Mage::getUrl('esparkinfo_imageuploader/imageupload/rss');
    }
}
