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
 * Imageupload abstract REST API handler model
 *
 * @category    Esparkinfo
 * @package     Esparkinfo_Imageuploader
 * @author      Ultimate Module Creator
 */
abstract class Esparkinfo_Imageuploader_Model_Api2_Imageupload_Rest extends Esparkinfo_Imageuploader_Model_Api2_Imageupload
{
    /**
     * current imageupload
     */
    protected $_imageupload;

    /**
     * retrieve entity
     *
     * @access protected
     * @return array|mixed
     * @author Ultimate Module Creator
     */
    protected function _retrieve() {
        $imageupload = $this->_getImageupload();
        $this->_prepareImageuploadForResponse($imageupload);
        return $imageupload->getData();
    }

    /**
     * get collection
     *
     * @access protected
     * @return array
     * @author Ultimate Module Creator
     */
    protected function _retrieveCollection() {
        $collection = Mage::getResourceModel('esparkinfo_imageuploader/imageupload_collection');
        $entityOnlyAttributes = $this->getEntityOnlyAttributes(
            $this->getUserType(),
            Mage_Api2_Model_Resource::OPERATION_ATTRIBUTE_READ
        );
        $availableAttributes = array_keys($this->getAvailableAttributes(
            $this->getUserType(),
            Mage_Api2_Model_Resource::OPERATION_ATTRIBUTE_READ)
        );
        $collection->addFieldToFilter('status', array('eq' => 1));
        $store = $this->_getStore();
        $collection->addStoreFilter($store->getId());
        $this->_applyCollectionModifiers($collection);
        $imageuploads = $collection->load();
        $imageuploads->walk('afterLoad');
        foreach ($imageuploads as $imageupload) {
            $this->_setImageupload($imageupload);
            $this->_prepareImageuploadForResponse($imageupload);
        }
        $imageuploadsArray = $imageuploads->toArray();
        $imageuploadsArray = $imageuploadsArray['items'];

        return $imageuploadsArray;
    }

    /**
     * prepare imageupload for response
     *
     * @access protected
     * @param Esparkinfo_Imageuploader_Model_Imageupload $imageupload
     * @author Ultimate Module Creator
     */
    protected function _prepareImageuploadForResponse(Esparkinfo_Imageuploader_Model_Imageupload $imageupload) {
        $imageuploadData = $imageupload->getData();
        if ($this->getActionType() == self::ACTION_TYPE_ENTITY) {
            $imageuploadData['url'] = $imageupload->getImageuploadUrl();
        }
    }

    /**
     * create imageupload
     *
     * @access protected
     * @param array $data
     * @return string|void
     * @author Ultimate Module Creator
     */
    protected function _create(array $data) {
        $this->_critical(self::RESOURCE_METHOD_NOT_ALLOWED);
    }

    /**
     * update imageupload
     *
     * @access protected
     * @param array $data
     * @author Ultimate Module Creator
     */
    protected function _update(array $data) {
        $this->_critical(self::RESOURCE_METHOD_NOT_ALLOWED);
    }

    /**
     * delete imageupload
     *
     * @access protected
     * @author Ultimate Module Creator
     */
    protected function _delete() {
        $this->_critical(self::RESOURCE_METHOD_NOT_ALLOWED);
    }

    /**
     * delete current imageupload
     *
     * @access protected
     * @param Esparkinfo_Imageuploader_Model_Imageupload $imageupload
     * @author Ultimate Module Creator
     */
    protected function _setImageupload(Esparkinfo_Imageuploader_Model_Imageupload $imageupload) {
        $this->_imageupload = $imageupload;
    }

    /**
     * get current imageupload
     *
     * @access protected
     * @return Esparkinfo_Imageuploader_Model_Imageupload
     * @author Ultimate Module Creator
     */
    protected function _getImageupload() {
        if (is_null($this->_imageupload)) {
            $imageuploadId = $this->getRequest()->getParam('id');
            $imageupload = Mage::getModel('esparkinfo_imageuploader/imageupload');
            $imageupload->load($imageuploadId);
            if (!($imageupload->getId())) {
                $this->_critical(self::RESOURCE_NOT_FOUND);
            }
            if ($this->_getStore()->getId()) {
                $isValidStore = count(array_intersect(array(0, $this->_getStore()->getId()), $imageupload->getStoreId()));
                if (!$isValidStore) {
                    $this->_critical(self::RESOURCE_NOT_FOUND);
                }
            }
            $this->_imageupload = $imageupload;
        }
        return $this->_imageupload;
    }
}
