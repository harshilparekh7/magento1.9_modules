<?php

namespace Oye\Deliverydate\Block\Adminhtml\Holiday\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;

/**
 * Class Info
 * @package Oye\Deliverydate\Block\Adminhtml\Holiday\Edit\Tab
 */
class Info extends Generic implements TabInterface
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Config $wysiwygConfig
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form fields
     *
     * @return \Magento\Backend\Block\Widget\Form
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('oyeconfigwizard_holiday');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('holiday_');
        $form->setFieldNameSuffix('holiday');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General')]
        );

        if ($model->getId()) {
            $fieldset->addField(
                'id',
                'hidden',
                ['name' => 'id']
            );
        }
        $fieldset->addField(
            'year',
            'select',
            [
                'name'        => 'year',
                'label'    => __('Year'),
                'required'     => true,
                'values' => $this->getYearOptions(),
                'class' => 'select'
            ]
        );
        $fieldset->addField(
            'month',
            'select',
            [
                'name'        => 'month',
                'label'    => __('Month'),
                'required'     => true,
                'values' => $this->getMonthOptions(),
                'class' => 'select'
            ]
        );

        $fieldset->addField(
            'day',
            'text',
            [
                'name'        => 'day',
                'label'    => __('Day'),
                'required'     => true,
            ]
        );

        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @return array
     */
    private function getYearOptions()
    {
        $options = array();
        $options['*'] = '*';
        $currentYear = date('Y');
        $options[$currentYear] = $currentYear;

        for($i = $currentYear; $i < $currentYear+5; $i++)
        {
            $options[$i] = $i;
        }
        return $options;
    }

    /**
     * @return array
     */
    private function getMonthOptions()
    {
        $options = array();
        for($i=1; $i<13; $i++)
        {
            $options[$i] = $i;
        }
        return $options;
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Hint Group Tab Label');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Hint Group Tab Title');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }
}