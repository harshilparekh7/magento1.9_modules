<?php

class Naviz_Dummy_Block_Adminhtml_Dummy_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("dummyGrid");
				$this->setDefaultSort("dummy_id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("dummy/dummy")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("dummy_id", array(
				"header" => Mage::helper("dummy")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "dummy_id",
				));
                
				$this->addColumn("title", array(
				"header" => Mage::helper("dummy")->__("Title"),
				"index" => "title",
				));
						$this->addColumn('status', array(
						'header' => Mage::helper('dummy')->__('Status'),
						'index' => 'status',
						'type' => 'options',
						'options'=>Naviz_Dummy_Block_Adminhtml_Dummy_Grid::getOptionArray2(),				
						));
						
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('dummy_id');
			$this->getMassactionBlock()->setFormFieldName('dummy_ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_dummy', array(
					 'label'=> Mage::helper('dummy')->__('Remove Dummy'),
					 'url'  => $this->getUrl('*/adminhtml_dummy/massRemove'),
					 'confirm' => Mage::helper('dummy')->__('Are you sure?')
				));
			return $this;
		}
			
		static public function getOptionArray2()
		{
            $data_array=array(); 
			$data_array[0]='Yes';
			$data_array[1]='No';
            return($data_array);
		}
		static public function getValueArray2()
		{
            $data_array=array();
			foreach(Naviz_Dummy_Block_Adminhtml_Dummy_Grid::getOptionArray2() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		

}