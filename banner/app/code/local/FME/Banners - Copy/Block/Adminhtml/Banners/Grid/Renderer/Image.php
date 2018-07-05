<?php 
class FME_Banners_Block_Adminhtml_Banners_Grid_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        return $this->_getValue($row);
    } 
    protected function _getValue(Varien_Object $row)
    {       
        $val = $row->getData($this->getColumn()->getIndex());
        if ($val=='') 
        {
            $val =  "Banners/images/thumb/no-image-available.jpg";
        }
       // $val = str_replace("", "Banners/images/no-image-available.jpg", $val);
        $url = Mage::getBaseUrl('media') .  $val; 
        $out = "<img src=". $url ." width='100px'/>"; 
        return $out;
    }
}