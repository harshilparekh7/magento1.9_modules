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
 * Admin search model
 *
 * @category    Esparkinfo
 * @package     Esparkinfo_Imageuploader
 * @author      Ultimate Module Creator
 */
class Esparkinfo_Imageuploader_Model_Adminhtml_Search_Imageupload extends Varien_Object
{
    /**
     * Load search results
     *
     * @access public
     * @return Esparkinfo_Imageuploader_Model_Adminhtml_Search_Imageupload
     * @author Ultimate Module Creator
     */
    public function load()
    {
        $arr = array();
        if (!$this->hasStart() || !$this->hasLimit() || !$this->hasQuery()) {
            $this->setResults($arr);
            return $this;
        }
        $collection = Mage::getResourceModel('esparkinfo_imageuploader/imageupload_collection')
            ->addFieldToFilter('imageupload', array('like' => $this->getQuery().'%'))
            ->setCurPage($this->getStart())
            ->setPageSize($this->getLimit())
            ->load();
        foreach ($collection->getItems() as $imageupload) {
            $arr[] = array(
                'id'          => 'imageupload/1/'.$imageupload->getId(),
                'type'        => Mage::helper('esparkinfo_imageuploader')->__('Imageupload'),
                'name'        => $imageupload->getImageupload(),
                'description' => $imageupload->getImageupload(),
                'url' => Mage::helper('adminhtml')->getUrl(
                    '*/imageuploader_imageupload/edit',
                    array('id'=>$imageupload->getId())
                ),
            );
        }
        $this->setResults($arr);
        return $this;
    }
}
