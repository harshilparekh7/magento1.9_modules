<?php
 
class Chilly_Imageslide_Block_Adminhtml_Imageslide_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('imageslideGrid');
        // This is the primary key of the database
        $this->setDefaultSort('imageslide_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('imageslide/imageslide')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    {
        $this->addColumn('imageslide_id', array(
            'header'    => Mage::helper('imageslide')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'imageslide_id',
        ));
 
        $this->addColumn('title', array(
            'header'    => Mage::helper('imageslide')->__('Title'),
            'align'     =>'left',
            'index'     => 'title',
        ));
 
        /*
        $this->addColumn('content', array(
            'header'    => Mage::helper('<module>')->__('Item Content'),
            'width'     => '150px',
            'index'     => 'content',
        ));
        */
 
        $this->addColumn('c_id', array(
            'header'    => Mage::helper('imageslide')->__('Category ID'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'int',
			'index'     => 'c_id',
             
        ));
		$this->addColumn('status', array(
            'header'    => Mage::helper('imageslide')->__('Status'),
            'align'     => 'left',
            'width'     => '120px',
			'index'     => 'status',
             
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