<?php

namespace Oye\Deliverydate\Block;

/**
 * Class DatepickerInit
 * @package Oye\Deliverydate\Block
 */
class DatepickerInit extends \Magento\Framework\View\Element\Template
{

    /**
     * @var \Oye\Deliverydate\Model\ResourceModel\Holiday\CollectionFactory
     */
    public $collectionFactory;

    /**
     * @var \Oye\Deliverydate\Helper\Data
     */
    public $helper;

    /**
     * @var \Magento\Quote\Model\Quote
     */
    public $quote;

    /**
     * @param \Oye\Deliverydate\Model\ResourceModel\Holiday\CollectionFactory $collectionFactory
     * @param \Oye\Deliverydate\Helper\Data $helper
     * @param \Magento\Backend\Block\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Oye\Deliverydate\Model\ResourceModel\Holiday\CollectionFactory $collectionFactory,
        \Oye\Deliverydate\Helper\Data $helper,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Checkout\Model\Session $session,
        array $data = []

    )
    {
        $this->helper = $helper;
        $this->collectionFactory = $collectionFactory;
        $this->quote = $session->getQuote();
        parent::__construct($context, $data);
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        return parent::_toHtml();
    }

    /**
     * @return array
     */
    public function getHolidays()
    {
        $result = array();
        $collection = $this->collectionFactory->create();

        foreach ($collection as $holiday)
        {
            if($holiday->getYear() == '*')
            {
                $holiday->setYear(date('Y'));
                $result[] = $this->getHolidayDateString($holiday);
                $holiday->setYear(date('Y')+1);
                $result[] = $this->getHolidayDateString($holiday);
            }
            else
            {
                $result[] = $this->getHolidayDateString($holiday);
            }
        }
        return $result;
    }

    /**
     * @param $holiday
     * @return string
     */
    protected function getHolidayDateString($holiday)
    {
        $day = str_pad((string)$holiday->getDay(), 2, '0', STR_PAD_LEFT);
        $month = str_pad((string)$holiday->getMonth(), 2, '0', STR_PAD_LEFT);
        return sprintf('%s.%s.%s', $day, $month, $holiday->getYear());
    }

    /**
     * Matches each symbol of PHP date format standard
     * with jQuery equivalent codeword
     * @author Tristan Jahier
     * @param $php_format
     * @return string
     */
    public function convertDateFormatToJQueryUi($php_format)
    {
        $SYMBOLS_MATCHING = array(
            // Day
            'd' => 'dd',
            'D' => 'D',
            'j' => 'd',
            'l' => 'DD',
            'N' => '',
            'S' => '',
            'w' => '',
            'z' => 'o',
            // Week
            'W' => '',
            // Month
            'F' => 'MM',
            'm' => 'mm',
            'M' => 'M',
            'n' => 'm',
            't' => '',
            // Year
            'L' => '',
            'o' => '',
            'Y' => 'yy',
            'y' => 'y',
            // Time
            'a' => '',
            'A' => '',
            'B' => '',
            'g' => '',
            'G' => '',
            'h' => '',
            'H' => '',
            'i' => '',
            's' => '',
            'u' => ''
        );
        $jqueryui_format = "";
        $escaping = false;
        for($i = 0; $i < strlen($php_format); $i++)
        {
            $char = $php_format[$i];
            if($char === '\\') // PHP date format escaping character
            {
                $i++;
                if($escaping) $jqueryui_format .= $php_format[$i];
                else $jqueryui_format .= '\'' . $php_format[$i];
                $escaping = true;
            }
            else
            {
                if($escaping) { $jqueryui_format .= "'"; $escaping = false; }
                if(isset($SYMBOLS_MATCHING[$char]))
                    $jqueryui_format .= $SYMBOLS_MATCHING[$char];
                else
                    $jqueryui_format .= $char;
            }
        }
        return $jqueryui_format;
    }

}