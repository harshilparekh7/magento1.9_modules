<?php

class Ebiz_Testmodule_Block_Adminhtml_Testmodule_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('testmoduleGrid');
        // This is the primary key of the database
        $this->setDefaultSort('testmodule_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('testmodule/testmodule')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('testmodule_id', array(
            'header'    => Mage::helper('testmodule')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'testmodule_id',
        ));

        $this->addColumn('title', array(
            'header'    => Mage::helper('testmodule')->__('Title'),
            'align'     =>'left',
            'index'     => 'title',
        ));

        /*
        $this->addColumn('content', array(
            'header'    => Mage::helper('testmodule')->__('Item Content'),
            'width'     => '150px',
            'index'     => 'content',
        ));
        */

        $this->addColumn('created_time', array(
            'header'    => Mage::helper('testmodule')->__('Creation Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'created_time',
        ));

        $this->addColumn('update_time', array(
            'header'    => Mage::helper('testmodule')->__('Update Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'update_time',
        ));    


        $this->addColumn('status', array(

            'header'    => Mage::helper('testmodule')->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                1 => 'Active',
                0 => 'Inactive',
            ),
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }


}
