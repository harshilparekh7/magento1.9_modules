<?php

namespace Oye\Deliverydate\Helper;


/**
 * Class Data
 * @package Oye\Deliverydate\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    const CONFIG_PATH_MIN_DELAY         = 'delivery_date/general/min_delay';
    const CONFIG_PATH_MAX_DELAY         = 'delivery_date/general/max_delay';
    const CONFIG_PATH_EXCLUDE_WEEKDAYS  = 'delivery_date/general/exclude_weekdays';
    const CONFIG_PATH_SAMEDAY_TIME      = 'delivery_date/general/disable_after_same_day_time';
    const CONFIG_PATH_DATE_FORMAT       = 'delivery_date/general/date_format';
    const CONFIG_PATH_DISPLAY_AREA      = 'delivery_date/general/display_area';
    const CONFIG_PATH_FIELD_LABEL       = 'delivery_date/general/field_label';
    const CONFIG_PATH_FIELD_REQUIRED    = 'delivery_date/general/required';

    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    public $timeZone;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    public $storeManager;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timeZone
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timeZone,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->timeZone = $timeZone;
        $this->storeManager = $storeManager;
        return parent::__construct($context);
    }

    /**
     * take mysql datetime string and convert it to given format
     *
     * @param $dateString
     * @param string|false $format
     * @param \Magento\Store\Model\Store|false $store
     * @return string
     */
    public function formatMySqlDateTime($dateString, $format = false, $store = false)
    {
        if($dateString == '0000-00-00 00:00:00')
        {
            $result = 'N/A';
            return $result;
        }
        $format = $format ? $format : $this->getConfigDateFormat();
        $store = $store ? $store : $this->storeManager->getStore();
        return $this->timeZone
            ->scopeDate($store, $dateString, true)
            ->format($format);
    }

    /**
     * @return bool
     */
    public function isDisableAfterSameDayTime()
    {
        if ($this->getConfigDisableAfterSameDayTime() &&
            strtotime($this->getConfigDisableAfterSameDayTime()) > strtotime($this->timeZone->date()->format('H:i'))
        )
        {
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    public function isRequestAdmin()
    {
        return strpos($this->_request->getPathInfo(), 'admin') === false;
    }

    /**
     * @return mixed
     */
    public function getConfigMinDelayDays()
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_MIN_DELAY, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return mixed
     */
    public function getConfigMaxDelayDays()
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_MAX_DELAY, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return mixed
     */
    public function getConfigExcludedWeekdays()
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_EXCLUDE_WEEKDAYS, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return mixed
     */
    public function getConfigDisableAfterSameDayTime()
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_SAMEDAY_TIME, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return mixed
     */
    public function getConfigDateFormat()
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_DATE_FORMAT, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return mixed
     */
    public function getConfigDisplayArea()
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_DISPLAY_AREA, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getConfigFieldLabel()
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_FIELD_LABEL, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return bool
     */
    public function getConfigIsFieldRequired()
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_FIELD_REQUIRED, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }


}