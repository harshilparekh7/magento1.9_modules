<?php
/*
NOTICE OF LICENSE

This source file is subject to the NekloEULA that is bundled with this package in the file ICENSE.txt.

It is also available through the world-wide-web at this URL: http://store.neklo.com/LICENSE.txt

Copyright (c)  Neklo (http://store.neklo.com/)
*/


class Neklo_Instagram_Adminhtml_Neklo_Instagram_ConfigController extends Mage_Adminhtml_Controller_Action
{
    protected $_api = null;
    
    public function saveAction()
    {
        $result = array(
            'success'   => true,
            'login_url' => null,
        );
        $clientId = $this->getRequest()->getParam('client_id', null);
        $clientSecret = $this->getRequest()->getParam('client_secret', null);

        $clientId = trim($clientId);
        $clientSecret = trim($clientSecret);

        try {
            $this->_getConfig()->saveClientId($clientId);
            $this->_getConfig()->saveClientSecret($clientSecret);
        } catch (Exception $e) {
            $result['success'] = false;
        }

        $result['login_url'] = $this->_getApi()->getLoginUrl(
            array('basic', 'public_content')
        );

        $this->getResponse()->setBody(
            Zend_Json::encode($result)
        );
    }

    /**
     * @return Neklo_Instagram_Model_Instagram_Api
     */
    protected function _getApi()
    {
        if ($this->_api === null) {
            $this->_api = $this->_api = Mage::getModel(
                'neklo_instagram/instagram_api',
                array(
                    'apiKey'      => $this->_getConfig()->getClientId(),
                    'apiSecret'   => $this->_getConfig()->getClientSecret(),
                    'apiCallback' => $this->_getConfig()->getRedirectUrl(),
                )
            );
        }
        return $this->_api;
    }

    /**
     * @return Neklo_Instagram_Helper_Config
     */
    protected function _getConfig()
    {
        return Mage::helper('neklo_instagram/config');
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('system/config/neklo_instagram');
    }
}