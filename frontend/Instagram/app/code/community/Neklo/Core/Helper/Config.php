<?php

class Neklo_Core_Helper_Config extends Mage_Compiler_Helper_Data
{
    const NOTIFICATION_TYPE = 'neklo_core/notification/type';

    /**
     * @param null|int|Mage_Core_Model_Store $store
     *
     * @return array
     */
    public function getNotificationTypeList($store = null)
    {
        return explode(',', Mage::getStoreConfig(self::NOTIFICATION_TYPE, $store));
    }
}