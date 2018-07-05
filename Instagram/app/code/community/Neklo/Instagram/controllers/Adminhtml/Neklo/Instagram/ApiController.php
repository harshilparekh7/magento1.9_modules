<?php

class Neklo_Instagram_Adminhtml_Neklo_Instagram_ApiController extends Mage_Adminhtml_Controller_Action
{
    protected $_api = null;

    public function disconnectAction()
    {
        $this->_getConfig()->disconnect();
        $this->_getSession()->addSuccess(Mage::helper('neklo_instagram')->__('Instagram disconnect is successful.'));
        return $this->_redirect('adminhtml/system_config/edit', array('section' => 'neklo_instagram'));
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