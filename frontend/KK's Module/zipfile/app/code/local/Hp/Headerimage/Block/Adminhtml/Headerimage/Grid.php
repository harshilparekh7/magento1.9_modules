<?php

class Hp_Headerimage_Block_Adminhtml_Headerimage_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('headerimageGrid');
        // This is the primary key of the database
        $this->setDefaultSort('headerimage_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('headerimage/headerimage')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('headerimage_id', array(
            'header'    => Mage::helper('headerimage')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'headerimage_id',
        ));

        $this->addColumn('title', array(
            'header'    => Mage::helper('headerimage')->__('Title'),
            'align'     =>'left',
            'index'     => 'title',
        ));
		
		$this->addColumn('image', array(
            'header'    => Mage::helper('headerimage')->__('Image'),
            'align'     =>'left',
            'index'     => 'image',
        )); 

		$this->addColumn('category_name', array(
            'header'    => Mage::helper('headerimage')->__('Category Name'),
            'align'     =>'left',
            'index'     => 'category_name',
        ));

        /*
        $this->addColumn('content', array(
            'header'    => Mage::helper('headerimage')->__('Item Content'),
            'width'     => '150px',
            'index'     => 'content',
        ));
        */

        $this->addColumn('created_time', array(
            'header'    => Mage::helper('headerimage')->__('Creation Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'created_time',
        ));

        $this->addColumn('update_time', array(
            'header'    => Mage::helper('headerimage')->__('Update Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'update_time',
        ));    


        $this->addColumn('status', array(

            'header'    => Mage::helper('headerimage')->__('Status'),
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
