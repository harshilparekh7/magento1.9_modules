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
 * Imageupload edit form tab
 *
 * @category    Esparkinfo
 * @package     Esparkinfo_Imageuploader
 * @author      Ultimate Module Creator
 */
class Esparkinfo_Imageuploader_Block_Adminhtml_Imageupload_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * prepare the form
     *
     * @access protected
     * @return Esparkinfo_Imageuploader_Block_Adminhtml_Imageupload_Edit_Tab_Form
     * @author Ultimate Module Creator
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('imageupload_');
        $form->setFieldNameSuffix('imageupload');
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'imageupload_form',
            array('legend' => Mage::helper('esparkinfo_imageuploader')->__('Imageupload'))
        );

        $fieldset->addField(
            'imageupload',
            'text',
            array(
                'label' => Mage::helper('esparkinfo_imageuploader')->__('imageupload'),
                'name'  => 'imageupload',

           )
        );
        $fieldset->addField(
            'url_key',
            'text',
            array(
                'label' => Mage::helper('esparkinfo_imageuploader')->__('Url key'),
                'name'  => 'url_key',
                'note'  => Mage::helper('esparkinfo_imageuploader')->__('Relative to Website Base URL')
            )
        );
        $fieldset->addField(
            'status',
            'select',
            array(
                'label'  => Mage::helper('esparkinfo_imageuploader')->__('Status'),
                'name'   => 'status',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('esparkinfo_imageuploader')->__('Enabled'),
                    ),
                    array(
                        'value' => 0,
                        'label' => Mage::helper('esparkinfo_imageuploader')->__('Disabled'),
                    ),
                ),
            )
        );
        $fieldset->addField(
            'in_rss',
            'select',
            array(
                'label'  => Mage::helper('esparkinfo_imageuploader')->__('Show in rss'),
                'name'   => 'in_rss',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('esparkinfo_imageuploader')->__('Yes'),
                    ),
                    array(
                        'value' => 0,
                        'label' => Mage::helper('esparkinfo_imageuploader')->__('No'),
                    ),
                ),
            )
        );
        if (Mage::app()->isSingleStoreMode()) {
            $fieldset->addField(
                'store_id',
                'hidden',
                array(
                    'name'      => 'stores[]',
                    'value'     => Mage::app()->getStore(true)->getId()
                )
            );
            Mage::registry('current_imageupload')->setStoreId(Mage::app()->getStore(true)->getId());
        }
        $fieldset->addField(
            'allow_comment',
            'select',
            array(
                'label' => Mage::helper('esparkinfo_imageuploader')->__('Allow Comments'),
                'name'  => 'allow_comment',
                'values'=> Mage::getModel('esparkinfo_imageuploader/adminhtml_source_yesnodefault')->toOptionArray()
            )
        );
        $formValues = Mage::registry('current_imageupload')->getDefaultValues();
        if (!is_array($formValues)) {
            $formValues = array();
        }
        if (Mage::getSingleton('adminhtml/session')->getImageuploadData()) {
            $formValues = array_merge($formValues, Mage::getSingleton('adminhtml/session')->getImageuploadData());
            Mage::getSingleton('adminhtml/session')->setImageuploadData(null);
        } elseif (Mage::registry('current_imageupload')) {
            $formValues = array_merge($formValues, Mage::registry('current_imageupload')->getData());
        }
        $form->setValues($formValues);
        return parent::_prepareForm();
    }
}
