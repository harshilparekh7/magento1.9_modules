<?php

class Crud_Pro_Block_Adminhtml_Pro_Grid extends Mage_Adminhtml_Block_Widget_Grid
 {
 public function __construct()
 {
 parent::__construct();
 $this->setId('proGrid');
 $this->setDefaultSort('std_id'); // This is the primary key of the database
 $this->setDefaultDir('ASC');
 $this->setSaveParametersInSession(true);
 $this->setUseAjax(true);
 }

protected function _prepareCollection()
 {
 $collection = Mage::getModel('pro/pro')->getCollection();
 $this->setCollection($collection);
 return parent::_prepareCollection();
 }

protected function _prepareColumns()
 {
 $this->addColumn('std_id', array(
 'header' => Mage::helper('pro')->__('ID'),
 'align' =>'right',
 'width' => '50px',
 'index' => 'std_id',
 ));

$this->addColumn('stdname', array(
 'header' => Mage::helper('pro')->__('Student Name'),
 'align' =>'left',
 'index' => 'stdname',
 ));

$this->addColumn('email', array(
 'header' => Mage::helper('pro')->__('Email Id'),
 'align' =>'left',
 'index' => 'email',
 ));

$this->addColumn('rollno', array(
 'header' => Mage::helper('pro')->__('Roll_NO'),
 'align' =>'left',
 'index' => 'rollno',
 ));

$this->addColumn('status', array(

'header' => Mage::helper('pro')->__('Status'),
 'align' => 'left',
 'width' => '80px',
 'index' => 'status',
 'type' => 'options',
 'options' => array(
 0 => 'Active',
 1 => 'Inactive',
 ),
 ));

return parent::_prepareColumns();
 }

public function getRowUrl($row)
 {
 return $this->getUrl('*/*/edit', array('id' => $row->getId()));
 }

public function getGridUrl()
 {
 return $this->getUrl('*/*/grid', array('_current'=>true));
 }
 }