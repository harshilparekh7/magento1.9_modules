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
 * Frontend observer
 *
 * @category    Esparkinfo
 * @package     Esparkinfo_Imageuploader
 * @author      Ultimate Module Creator
 */
class Esparkinfo_Imageuploader_Model_Observer
{
    /**
     * add items to main menu
     *
     * @access public
     * @param Varien_Event_Observer $observer
     * @return array()
     * @author Ultimate Module Creator
     */
    public function addItemsToTopmenuItems($observer)
    {
        $menu = $observer->getMenu();
        $tree = $menu->getTree();
        $action = Mage::app()->getFrontController()->getAction()->getFullActionName();
        $imageuploadNodeId = 'imageupload';
        $data = array(
            'name' => Mage::helper('esparkinfo_imageuploader')->__('Imageuploads'),
            'id' => $imageuploadNodeId,
            'url' => Mage::helper('esparkinfo_imageuploader/imageupload')->getImageuploadsUrl(),
            'is_active' => ($action == 'esparkinfo_imageuploader_imageupload_index' || $action == 'esparkinfo_imageuploader_imageupload_view')
        );
        $imageuploadNode = new Varien_Data_Tree_Node($data, 'id', $tree, $menu);
        $menu->addChild($imageuploadNode);
        return $this;
    }
}
