<?php
/**
 * {{Esparkinfo}}_{{Imageuploader}} extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       {{Esparkinfo}}
 * @package        {{Esparkinfo}}_{{Imageuploader}}
 * @copyright      Copyright (c) 2018
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Imageupload comments admin grid block
 *
 * @category    Esparkinfo
 * @package     Esparkinfo_Imageuploader
 * @author      Ultimate Module Creator
 */
class Esparkinfo_Imageuploader_Block_Adminhtml_Imageupload_Comment_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * constructor
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('imageuploadCommentGrid');
        $this->setDefaultSort('ct_comment_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * prepare collection
     *
     * @access protected
     * @return Esparkinfo_Imageuploader_Block_Adminhtml_Imageupload_Comment_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('esparkinfo_imageuploader/imageupload_comment_imageupload_collection');
        $collection->addStoreData();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * prepare grid collection
     *
     * @access protected
     * @return Esparkinfo_Imageuploader_Block_Adminhtml_Imageupload_Comment_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'ct_comment_id',
            array(
                'header'        => Mage::helper('esparkinfo_imageuploader')->__('Id'),
                'index'         => 'ct_comment_id',
                'type'          => 'number',
                'filter_index'  => 'ct.comment_id',
            )
        );
        $this->addColumn(
            'imageupload',
            array(
                'header'        => Mage::helper('esparkinfo_imageuploader')->__('imageupload'),
                'index'         => 'imageupload',
                'filter_index'  => 'main_table.imageupload',
            )
        );
        $this->addColumn(
            'ct_title',
            array(
                'header'        => Mage::helper('esparkinfo_imageuploader')->__('Comment Title'),
                'index'         => 'ct_title',
                'filter_index'  => 'ct.title',
            )
        );
        $this->addColumn(
            'ct_name',
            array(
                'header'        => Mage::helper('esparkinfo_imageuploader')->__('Poster name'),
                'index'         => 'ct_name',
                'filter_index'  => 'ct.name',
            )
        );
        $this->addColumn(
            'ct_email',
            array(
                'header'        => Mage::helper('esparkinfo_imageuploader')->__('Poster email'),
                'index'         => 'ct_email',
                'filter_index'  => 'ct.email',
            )
        );
        $this->addColumn(
            'ct_status',
            array(
                'header'        => Mage::helper('esparkinfo_imageuploader')->__('Status'),
                'index'         => 'ct_status',
                'filter_index'  => 'ct.status',
                'type'          => 'options',
                'options'       => array(
                    Esparkinfo_Imageuploader_Model_Imageupload_Comment::STATUS_PENDING  =>
                        Mage::helper('esparkinfo_imageuploader')->__('Pending'),
                    Esparkinfo_Imageuploader_Model_Imageupload_Comment::STATUS_APPROVED =>
                        Mage::helper('esparkinfo_imageuploader')->__('Approved'),
                    Esparkinfo_Imageuploader_Model_Imageupload_Comment::STATUS_REJECTED =>
                        Mage::helper('esparkinfo_imageuploader')->__('Rejected'),
                )
            )
        );
        $this->addColumn(
            'ct_created_at',
            array(
                'header'        => Mage::helper('esparkinfo_imageuploader')->__('Created at'),
                'index'         => 'ct_created_at',
                'width'         => '120px',
                'type'          => 'datetime',
                'filter_index'  => 'ct.created_at',
            )
        );
        $this->addColumn(
            'ct_updated_at',
            array(
                'header'        => Mage::helper('esparkinfo_imageuploader')->__('Updated at'),
                'index'         => 'ct_updated_at',
                'width'         => '120px',
                'type'          => 'datetime',
                'filter_index'  => 'ct.updated_at',
            )
        );
        if (!Mage::app()->isSingleStoreMode() && !$this->_isExport) {
            $this->addColumn(
                'stores',
                array(
                    'header'     => Mage::helper('esparkinfo_imageuploader')->__('Store Views'),
                    'index'      => 'stores',
                    'type'       => 'store',
                    'store_all'  => true,
                    'store_view' => true,
                    'sortable'   => false,
                    'filter_condition_callback' => array($this, '_filterStoreCondition'),
                )
            );
        }
        $this->addColumn(
            'action',
            array(
                'header'  => Mage::helper('esparkinfo_imageuploader')->__('Action'),
                'width'   => '100',
                'type'    => 'action',
                'getter'  => 'getCtCommentId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('esparkinfo_imageuploader')->__('Edit'),
                        'url'     => array('base'=> '*/*/edit'),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'is_system' => true,
                'sortable'  => false,
            )
        );
        $this->addExportType('*/*/exportCsv', Mage::helper('esparkinfo_imageuploader')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('esparkinfo_imageuploader')->__('Excel'));
        $this->addExportType('*/*/exportXml', Mage::helper('esparkinfo_imageuploader')->__('XML'));
        return parent::_prepareColumns();
    }

    /**
     * prepare mass action
     *
     * @access protected
     * @return Esparkinfo_Imageuploader_Block_Adminhtml_Imageupload_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('ct_comment_id');
        $this->setMassactionIdFilter('ct.comment_id');
        $this->setMassactionIdFieldOnlyIndexValue(true);
        $this->getMassactionBlock()->setFormFieldName('comment');
        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label'=> Mage::helper('esparkinfo_imageuploader')->__('Delete'),
                'url'  => $this->getUrl('*/*/massDelete'),
                'confirm'  => Mage::helper('esparkinfo_imageuploader')->__('Are you sure?')
            )
        );
        $this->getMassactionBlock()->addItem(
            'status',
            array(
                'label' => Mage::helper('esparkinfo_imageuploader')->__('Change status'),
                'url'   => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                'additional' => array(
                    'status' => array(
                            'name' => 'status',
                            'type' => 'select',
                            'class' => 'required-entry',
                            'label' => Mage::helper('esparkinfo_imageuploader')->__('Status'),
                            'values' => array(
                                Esparkinfo_Imageuploader_Model_Imageupload_Comment::STATUS_PENDING  =>
                                    Mage::helper('esparkinfo_imageuploader')->__('Pending'),
                                Esparkinfo_Imageuploader_Model_Imageupload_Comment::STATUS_APPROVED =>
                                    Mage::helper('esparkinfo_imageuploader')->__('Approved'),
                                Esparkinfo_Imageuploader_Model_Imageupload_Comment::STATUS_REJECTED =>
                                    Mage::helper('esparkinfo_imageuploader')->__('Rejected'),
                            )
                    )
                )
            )
        );
        return $this;
    }

    /**
     * get the row url
     *
     * @access public
     * @param Esparkinfo_Imageuploader_Model_Imageupload_Comment
     * @return string
     * @author Ultimate Module Creator
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getCtCommentId()));
    }

    /**
     * get the grid url
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    /**
     * filter store column
     *
     * @access protected
     * @param Esparkinfo_Imageuploader_Model_Resource_Imageupload_Comment_Collection $collection
     * @param Mage_Adminhtml_Block_Widget_Grid_Column $column
     * @return Esparkinfo_Imageuploader_Block_Adminhtml_Imageupload_Comment_Grid
     * @author Ultimate Module Creator
     */
    protected function _filterStoreCondition($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }
        $collection->setStoreFilter($value);
        return $this;
    }
}
