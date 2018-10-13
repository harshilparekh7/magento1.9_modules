<?php

namespace Oye\Deliverydate\Ui\Component\Listing\Columns;


/**
 * Class Date
 * @package Oye\Deliverydate\Ui\Component\Listing\Columns
 */
class Date extends \Magento\Ui\Component\Listing\Columns\Column
{

    public $helper;

    /**
     * @param \Magento\Framework\View\Element\UiComponent\Context $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     * @param \Oye\Deliverydate\Helper\Data $helper
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\Context $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = [],
        \Oye\Deliverydate\Helper\Data $helper
    )
    {
        $this->helper = $helper;
        return parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as & $item) {
                $item['delivery_date'] = $this->helper->formatMySqlDateTime($item['delivery_date']);
            }
        }
        return $dataSource;
    }

}