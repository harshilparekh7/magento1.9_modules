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
class Esparkinfo_Imageuploader_Model_Imageupload_Api extends Mage_Api_Model_Resource_Abstract
{


    /**
     * init imageupload
     *
     * @access protected
     * @param $imageuploadId
     * @return Esparkinfo_Imageuploader_Model_Imageupload
     * @author Ultimate Module Creator
     */
    protected function _initImageupload($imageuploadId)
    {
        $imageupload = Mage::getModel('esparkinfo_imageuploader/imageupload')->load($imageuploadId);
        if (!$imageupload->getId()) {
            $this->_fault('imageupload_not_exists');
        }
        return $imageupload;
    }

    /**
     * get imageuploads
     *
     * @access public
     * @param mixed $filters
     * @return array
     * @author Ultimate Module Creator
     */
    public function items($filters = null)
    {
        $collection = Mage::getModel('esparkinfo_imageuploader/imageupload')->getCollection();
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
            $result[] = $this->_getApiData($imageupload);
        }
        return $result;
    }

    /**
     * Add imageupload
     *
     * @access public
     * @param array $data
     * @return array
     * @author Ultimate Module Creator
     */
    public function add($data)
    {
        try {
            if (is_null($data)) {
                throw new Exception(Mage::helper('esparkinfo_imageuploader')->__("Data cannot be null"));
            }
            $data = (array)$data;
            $imageupload = Mage::getModel('esparkinfo_imageuploader/imageupload')
                ->setData((array)$data)
                ->save();
        } catch (Mage_Core_Exception $e) {
            $this->_fault('data_invalid', $e->getMessage());
        } catch (Exception $e) {
            $this->_fault('data_invalid', $e->getMessage());
        }
        return $imageupload->getId();
    }

    /**
     * Change existing imageupload information
     *
     * @access public
     * @param int $imageuploadId
     * @param array $data
     * @return bool
     * @author Ultimate Module Creator
     */
    public function update($imageuploadId, $data)
    {
        $imageupload = $this->_initImageupload($imageuploadId);
        try {
            $data = (array)$data;
            $imageupload->addData($data);
            $imageupload->save();
        }
        catch (Mage_Core_Exception $e) {
            $this->_fault('save_error', $e->getMessage());
        }

        return true;
    }

    /**
     * remove imageupload
     *
     * @access public
     * @param int $imageuploadId
     * @return bool
     * @author Ultimate Module Creator
     */
    public function remove($imageuploadId)
    {
        $imageupload = $this->_initImageupload($imageuploadId);
        try {
            $imageupload->delete();
        } catch (Mage_Core_Exception $e) {
            $this->_fault('remove_error', $e->getMessage());
        }
        return true;
    }

    /**
     * get info
     *
     * @access public
     * @param int $imageuploadId
     * @return array
     * @author Ultimate Module Creator
     */
    public function info($imageuploadId)
    {
        $result = array();
        $imageupload = $this->_initImageupload($imageuploadId);
        $result = $this->_getApiData($imageupload);
        return $result;
    }

    /**
     * get data for api
     *
     * @access protected
     * @param Esparkinfo_Imageuploader_Model_Imageupload $imageupload
     * @return array()
     * @author Ultimate Module Creator
     */
    protected function _getApiData(Esparkinfo_Imageuploader_Model_Imageupload $imageupload)
    {
        return $imageupload->getData();
    }
}
