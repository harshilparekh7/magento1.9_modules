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
class Esparkinfo_Imageuploader_Model_Imageupload_Api_V2 extends Esparkinfo_Imageuploader_Model_Imageupload_Api
{
    /**
     * Imageupload info
     *
     * @access public
     * @param int $imageuploadId
     * @return object
     * @author Ultimate Module Creator
     */
    public function info($imageuploadId)
    {
        $result = parent::info($imageuploadId);
        $result = Mage::helper('api')->wsiArrayPacker($result);
        return $result;
    }
}
