<?php
$this->startSetup();

$instagramHashtagAttr = Mage::getModel('catalog/product')->getResource()->getAttribute('instagram_hashtag');
if (!$instagramHashtagAttr || !$instagramHashtagAttr->getId()) {
    Mage::getResourceModel('catalog/setup', 'catalog_setup')->addAttribute(
        Mage_Catalog_Model_Product::ENTITY, 'instagram_hashtag',
        array(
            'group'            => 'General',
            'type'             => 'varchar',
            'backend'          => '',
            'frontend'         => '',
            'label'            => 'Instagram Hashtag: #',
            'input'            => 'text',
            'class'            => '',
            'source'           => '',
            'global'           => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
            'visible'          => true,
            'required'         => false,
            'user_defined'     => true,
            'default'          => '',
            'searchable'       => true,
            'filterable'       => false,
            'comparable'       => false,
            'visible_on_front' => false,
            'unique'           => false,
            'apply_to'         => '',
            'is_configurable'  => false,
        )
    );
}

$this->endSetup();