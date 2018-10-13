<?php

class Neklo_Instagram_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function __()
    {
        $args = func_get_args();
        if ($args[0] == '{{connect_hint}}') {
            if ($this->_getConfig()->isConnected()) {
                return '';
            }
            $args[0] = 'Add <b>%s</b> to redirect urls for Instagram application';
            $args[1] = $this->_getConfig()->getRedirectUrl();
        }
        $expr = new Mage_Core_Model_Translate_Expr(array_shift($args), $this->_getModuleName());
        array_unshift($args, $expr);
        return Mage::app()->getTranslator()->translate($args);
    }

    /**
     * @return Neklo_Instagram_Helper_Config
     */
    protected function _getConfig()
    {
        return Mage::helper('neklo_instagram/config');
    }
}
