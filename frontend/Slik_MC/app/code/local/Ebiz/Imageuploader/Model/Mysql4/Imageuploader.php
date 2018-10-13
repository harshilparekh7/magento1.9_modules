<?php
class Ebiz_Imageuploader_Model_Mysql4_Imageuploader extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("imageuploader/imageuploader", "imageuploader_id");
    }
}