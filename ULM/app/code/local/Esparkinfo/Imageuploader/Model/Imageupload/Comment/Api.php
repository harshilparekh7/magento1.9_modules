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
 * Imageupload comment model
 *
 * @category    Esparkinfo
 * @package     Esparkinfo_Imageuploader
 * @author      Ultimate Module Creator
 */
class Esparkinfo_Imageuploader_Model_Imageupload_Comment_Api extends Mage_Api_Model_Resource_Abstract
{
    /**
     * get imageuploads comments
     *
     * @access public
     * @param mixed $filters
     * @return array
     * @author Ultimate Module Creator
     */
    public function items($filters = null)
    {
        $collection = Mage::getModel('esparkinfo_imageuploader/imageupload_comment')->getCollection();
        $apiHelper = Mage::helper('api');
        $filters = $apiHelper->parseFilters($filters);
        try {
            foreach ($filters as $field => $value) {
                $collection->addFieldToFilter($field, $value);
            }
        } catch (Mage_Core_Exception $e) {
            $this->_fault('filters_invalid', $e->getMessage());
        }
        $result = array();
        foreach ($collection as $imageupload) {
            $result[] = $imageupload->getData();
        }
        return $result;
    }

    /**
     * update comment status
     *
     * @access public
     * @param mixed $filters
     * @return bool
     * @author Ultimate Module Creator
     */
    public function updateStatus($commentId, $status)
    {
        $comment = Mage::getModel('esparkinfo_imageuploader/imageupload_comment')->load($commentId);
        if (!$comment->getId()) {
            $this->_fault('not_exists');
        }
        try {
            $comment->setStatus($status)->save();
        }
        catch (Mage_Core_Exception $e) {
            $this->_fault('data_invalid', $e->getMessage());
        }
        return true;
    }
}
