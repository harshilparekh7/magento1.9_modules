<?php

class Ebiz_Imageuploader_Block_Adminhtml_Imageuploader_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("imageuploaderGrid");
				$this->setDefaultSort("imageuploader_id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("imageuploader/imageuploader")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("imageuploader_id", array(
				"header" => Mage::helper("imageuploader")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "imageuploader_id",
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
			$this->setMassactionIdField('imageuploader_id');
			$this->getMassactionBlock()->setFormFieldName('imageuploader_ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_imageuploader', array(
					 'label'=> Mage::helper('imageuploader')->__('Remove Imageuploader'),
					 'url'  => $this->getUrl('*/adminhtml_imageuploader/massRemove'),
					 'confirm' => Mage::helper('imageuploader')->__('Are you sure?')
				));
			return $this;
		}
			

}