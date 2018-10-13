<?php

class Hp_Leftsidebar_Block_Adminhtml_Leftsidebar_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('leftsidebarGrid');
        // This is the primary key of the database
        $this->setDefaultSort('leftsidebar_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('leftsidebar/leftsidebar')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('leftsidebar_id', array(
            'header'    => Mage::helper('leftsidebar')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'leftsidebar_id',
        ));

        $this->addColumn('title', array(
            'header'    => Mage::helper('leftsidebar')->__('Title'),
            'align'     =>'left',
            'index'     => 'title',
        ));

        
        $this->addColumn('content', array(
            'header'    => Mage::helper('leftsidebar')->__('Item Content'),
            'width'     => '150px',
            'index'     => 'content',
        ));
        
		$this->addColumn('info', array(
            'header'    => Mage::helper('leftsidebar')->__('Information'),
            'align'     =>'left',
            'index'     => 'info',
        ));
		
		$this->addColumn('link', array(
            'header'    => Mage::helper('leftsidebar')->__('Link'),
            'align'     =>'left',
            'index'     => 'link',
        ));


        $this->addColumn('created_time', array(
            'header'    => Mage::helper('leftsidebar')->__('Creation Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'created_time',
        ));

        $this->addColumn('update_time', array(
            'header'    => Mage::helper('leftsidebar')->__('Update Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'update_time',
        ));    


        $this->addColumn('status', array(

            'header'    => Mage::helper('leftsidebar')->__('Status'),
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
