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
 * Imageupload admin edit form
 *
 * @category    Esparkinfo
 * @package     Esparkinfo_Imageuploader
 * @author      Ultimate Module Creator
 */
class Esparkinfo_Imageuploader_Block_Adminhtml_Imageupload_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * constructor
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'esparkinfo_imageuploader';
        $this->_controller = 'adminhtml_imageupload';
        $this->_updateButton(
            'save',
            'label',
            Mage::helper('esparkinfo_imageuploader')->__('Save Imageupload')
        );
        $this->_updateButton(
            'delete',
            'label',
            Mage::helper('esparkinfo_imageuploader')->__('Delete Imageupload')
        );
        $this->_addButton(
            'saveandcontinue',
            array(
                'label'   => Mage::helper('esparkinfo_imageuploader')->__('Save And Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class'   => 'save',
            ),
            -100
        );
        $this->_formScripts[] = "
            function saveAndContinueEdit() {
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * get the edit form header
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getHeaderText()
    {
        if (Mage::registry('current_imageupload') && Mage::registry('current_imageupload')->getId()) {
            return Mage::helper('esparkinfo_imageuploader')->__(
                "Edit Imageupload '%s'",
                $this->escapeHtml(Mage::registry('current_imageupload')->getImageupload())
            );
        } else {
            return Mage::helper('esparkinfo_imageuploader')->__('Add Imageupload');
        }
    }
}
