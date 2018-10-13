<?php


namespace Oye\Deliverydate\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

/**
 * Class Holiday
 * @package Oye\Deliverydate\Block\Adminhtml
 */
class Holiday extends Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_holiday';
        $this->_blockGroup = 'Oye_Deliverydate';
        $this->_headerText = __('Manage Holiday');
        $this->_addButtonLabel = __('Add Holiday');

        $this->addButton('back_to_config',
            [
                'label' => __('Back to Module Configuration'),
                'onclick' => sprintf("setLocation('%s')", $this->getConfigUrl())
            ]
        );

        parent::_construct();
    }

    /**
     * @return string
     */
    public function getConfigUrl()
    {
        return $this->_urlBuilder->getUrl('adminhtml/system_config/edit', ['section' => 'delivery_date']);
    }
}