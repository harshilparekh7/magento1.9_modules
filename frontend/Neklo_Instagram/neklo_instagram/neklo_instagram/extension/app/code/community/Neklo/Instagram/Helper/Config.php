<?php
/*
NOTICE OF LICENSE

This source file is subject to the NekloEULA that is bundled with this package in the file ICENSE.txt.

It is also available through the world-wide-web at this URL: http://store.neklo.com/LICENSE.txt

Copyright (c)  Neklo (http://store.neklo.com/)
*/


class Neklo_Instagram_Helper_Config extends Mage_Core_Helper_Abstract
{
    const GENERAL_CACHE_LIFETIME = 'neklo_instagram/general/cache_lifetime';

    const API_ACCESS_TOKEN = 'neklo_instagram/api/access_token';
    const API_CLIENT_ID = 'neklo_instagram/api/client_id';
    const API_CLIENT_SECRET = 'neklo_instagram/api/client_secret';

    public function getCacheLifetime($store = null)
    {
        return (int)Mage::getStoreConfig(self::GENERAL_CACHE_LIFETIME, $store);
    }

    public function connect($accessToken)
    {
        $encryptedAccessToken = Mage::helper('core')->encrypt($accessToken);
        $this->_saveConfig(self::API_ACCESS_TOKEN, $encryptedAccessToken);

        // reinit configuration cache
        Mage::getConfig()->reinit();
    }

    public function disconnect()
    {
        $encryptedAccessToken = Mage::helper('core')->encrypt('');
        $this->_saveConfig(self::API_ACCESS_TOKEN, $encryptedAccessToken);

        // reinit configuration cache
        Mage::getConfig()->reinit();
    }

    public function isConnected()
    {
        return Mage::getStoreConfigFlag(self::API_ACCESS_TOKEN);
    }

    public function getAccessToken($store = null)
    {
        return Mage::helper('core')->decrypt(Mage::getStoreConfig(self::API_ACCESS_TOKEN, $store));
    }

    public function saveClientId($clientId)
    {
        $this->_saveConfig(self::API_CLIENT_ID, $clientId);

        // reinit configuration cache
        Mage::getConfig()->reinit();
    }

    public function getClientId($store = null)
    {
        return Mage::getStoreConfig(self::API_CLIENT_ID, $store);
    }

    public function saveClientSecret($clientSecret)
    {
        $this->_saveConfig(self::API_CLIENT_SECRET, $clientSecret);

        // reinit configuration cache
        Mage::getConfig()->reinit();
    }

    public function getClientSecret($store = null)
    {
        return Mage::getStoreConfig(self::API_CLIENT_SECRET, $store);
    }

    public function getRedirectUrl()
    {
        $isSecure = Mage::getStoreConfig('web/secure/use_in_frontend') * 1;
        $url = Mage::getUrl('/', array('_secure' => $isSecure));
        if ($i = strpos($url, '/index.php')) {
            $url = substr($url, 0, $i);
        }
        $last = substr($url, -1) == '/';
        $url .= ($last ? '' : '/').'index.php/' . 'neklo_instagram/api/connect';
        return $url;

    }

    protected function _saveConfig($path, $value, $scope = 'default', $scopeId = 0)
    {
        $configModel = Mage::getModel('core/config');
        $configModel->saveConfig($path, $value, $scope, $scopeId);
    }
}
