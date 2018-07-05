<?php
/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition End User License Agreement
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magento.com/license/enterprise-edition
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Catalog
 * @copyright Copyright (c) 2006-2015 X.commerce, Inc. (http://www.magento.com)
 * @license http://www.magento.com/license/enterprise-edition
 */


/**
 * Product image attribute frontend
 *
 * @category   Mage
 * @package    Mage_Catalog
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_Catalog_Model_Product_Attribute_Frontend_Image extends Mage_Eav_Model_Entity_Attribute_Frontend_Abstract
{

    public function getUrl($object, $size=null)
    {
        $url = false;
        $image = $object->getData($this->getAttribute()->getAttributeCode());

        if( !is_null($size) && file_exists(Mage::getBaseDir('media').DS.'catalog'.DS.'product'.DS.$size.DS.$image) ) {
            # resized image is cached
            $url = Mage::app()->getStore($object->getStore())->getBaseUrl('media').'catalog/product/' . $size . '/' . $image;
        } elseif( !is_null($size) ) {
            # resized image is not cached
            $url = Mage::app()->getStore($object->getStore())->getBaseUrl().'catalog/product/image/size/' . $size . '/' . $image;
        } elseif ($image) {
            # using original image
            $url = Mage::app()->getStore($object->getStore())->getBaseUrl('media').'catalog/product/'.$image;
        }
        return $url;
    }

}
