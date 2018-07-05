<?php

namespace Oye\Deliverydate\Model\Checkout;

/**
 * Class LayoutProcessorPlugin
 * @package Oye\Deliverydate\Model\Checkout
 */
class LayoutProcessorPlugin
{

    protected $_helper;

    /**
     * @param \Oye\Deliverydate\Helper\Data $helper
     */
    public function __construct(
        \Oye\Deliverydate\Helper\Data $helper
    )
    {
        $this->_helper = $helper;
    }

    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {
        if($this->_helper->getConfigDisplayArea() == \Oye\Deliverydate\Model\System\Config\Source\Area::AREA_SHIPPING_ADDRESS)
        {
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['shipping-address-fieldset']['children']['delivery_date'] = [
                'component' => 'Oye_Deliverydate/js/delivery-date',
                'config' => [
                    'customScope' => 'shippingAddress',
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'Oye_Deliverydate/deliverydate_init',
                    'options' => [],
                ],
                'dataScope' => 'shippingAddress.delivery_date',
                'label' => __($this->_helper->getConfigFieldLabel()),
                'provider' => 'checkoutProvider',
                'visible' => true,
                'validation' => false, //['required-entry' => $this->_helper->getConfigIsFieldRequired()],
                'sortOrder' => 200,
            ];
        }
        elseif ($this->_helper->getConfigDisplayArea() == \Oye\Deliverydate\Model\System\Config\Source\Area::AREA_SHIPPING_METHOD)
        {
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['shippingAdditional'] = [
                'component' => 'uiComponent',
                'displayArea' => 'shippingAdditional',
                'children' => [
                    'delivery_date' => [
                        'component' => 'Oye_Deliverydate/js/delivery-date',
                        'config' => [
                            'customScope' => 'shippingAddress',
                            'template' => 'ui/form/field',
                            'elementTmpl' => 'Oye_Deliverydate/deliverydate_init',
                            'options' => [],
                        ],
                        'dataScope' => 'shippingAddress.delivery_date',
                        'label' => __($this->_helper->getConfigFieldLabel()),
                        'provider' => 'checkoutProvider',
                        'visible' => true,
                        'validation' => false, //['required-entry' => $this->_helper->getConfigIsFieldRequired()],
                        'sortOrder' => 200,
                    ]
                ],
            ];
        }
        return $jsLayout;
    }
}