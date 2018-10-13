<?php

class Neklo_Core_Block_System_Contact_Header extends Mage_Adminhtml_Block_Template
{
    const STORE_URL = 'http://store.neklo.com/';
    const STORE_LABEL = 'store.neklo.com';

    public function getStoreUrl()
    {
        return self::STORE_URL;
    }

    public function getStoreLabel()
    {
        return self::STORE_LABEL;
    }
}