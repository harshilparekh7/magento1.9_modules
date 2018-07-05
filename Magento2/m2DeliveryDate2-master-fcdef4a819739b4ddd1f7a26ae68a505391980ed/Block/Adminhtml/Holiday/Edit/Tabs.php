<?php

namespace Oye\Deliverydate\Block\Adminhtml\Holiday\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

/**
 * Class Tabs
 * @package Oye\Deliverydate\Block\Adminhtml\Holiday\Edit
 */
class Tabs extends WidgetTabs
{
    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('holiday_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Holiday'));
    }

    /**
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'hint_info',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock(
                    'Oye\Deliverydate\Block\Adminhtml\Holiday\Edit\Tab\Info'
                )->toHtml(),
                'active' => true
            ]
        );

        return parent::_beforeToHtml();
    }
}