<?php

class Hp_Calendarview_Block_Adminhtml_Calendarview_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('calendarviewGrid');
        // This is the primary key of the database
        $this->setDefaultSort('calendarview_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('calendarview/calendarview')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('calendarview_id', array(
            'header'    => Mage::helper('calendarview')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'calendarview_id',
        ));

        $this->addColumn('title', array(
            'header'    => Mage::helper('calendarview')->__('Event Title'),
            'align'     =>'left',
            'index'     => 'title',
        ));
 
		
		$this->addColumn('date', array(
            'header'    => Mage::helper('calendarview')->__('Event Date'),
            'align'     =>'left',
            'index'     => 'date',
        ));
		
		$this->addColumn('url', array(
            'header'    => Mage::helper('calendarview')->__('Event URL'),
            'align'     =>'left',
            'index'     => 'url',
        ));

        /*
        $this->addColumn('content', array(
            'header'    => Mage::helper('<module>')->__('Item Content'),
            'width'     => '150px',
            'index'     => 'content',
        ));
        */

        $this->addColumn('created_time', array(
            'header'    => Mage::helper('calendarview')->__('Creation Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'created_time',
        ));

        $this->addColumn('update_time', array(
            'header'    => Mage::helper('calendarview')->__('Update Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'update_time',
        ));    


        $this->addColumn('status', array(

            'header'    => Mage::helper('calendarview')->__('Status'),
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
