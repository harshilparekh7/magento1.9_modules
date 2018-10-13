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
 * Imageupload view block
 *
 * @category    Esparkinfo
 * @package     Esparkinfo_Imageuploader
 * @author      Ultimate Module Creator
 */
class Esparkinfo_Imageuploader_Block_Imageupload_View extends Mage_Core_Block_Template
{
    /**
     * get the current imageupload
     *
     * @access public
     * @return mixed (Esparkinfo_Imageuploader_Model_Imageupload|null)
     * @author Ultimate Module Creator
     */
    public function getCurrentImageupload()
    {
        return Mage::registry('current_imageupload');
    }
}
