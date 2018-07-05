<?php

/**
* 
*/
class FME_Base_Block_System_Config_Form_Fme_Info extends Mage_Adminhtml_Block_System_Config_Form_Fieldset
{

	protected $_configFieldRenderer;
	

    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $html = $this->_getHeaderHtml($element);
        $allModules = array_keys((array)Mage::getConfig()->getNode('modules')->children());
        sort($allModules);

        foreach ($allModules as $module) {
            if (strstr($module, 'FME_') === false) {
                            continue;
            }

            if (in_array($module, array(
                'FME_Base'
            ))) {
                continue;
            }

            if ((string)Mage::getConfig()->getModuleConfig($module)->is_system == 'true')
                continue;
            
            $html.= $this->_getFieldHtml($element, $module);
        }
        $html .= $this->_getFooterHtml($element);

        return $html;
    }

    protected function _getFieldRenderer()
    {
    	if (empty($this->_configFieldRenderer)) {
    		$this->_configFieldRenderer = Mage::getBlockSingleton('adminhtml/system_config_form_field');
    	}
    	return $this->_configFieldRenderer;
    }
    protected function _getFooterHtml($element)
    {
        $html = parent::_getFooterHtml($element);
        $html .= Mage::helper('adminhtml/js')->getScript("
            $$('td.form-buttons')[0].update('');
            $('{$element->getHtmlId()}' + '-head').setStyle('background: none;');
            $('{$element->getHtmlId()}' + '-head').writeAttribute('onclick', 'return false;');
            $('{$element->getHtmlId()}').show();
        ");
        $html = '<h4>' . $this->__('Installed FME Extensions') . '</h4>' . $html;

        return $html;
    }

   

    protected function _getFieldHtml($fieldset, $module)
    {

    	$moduleConfig = Mage::getConfig()->getNode('modules/' . $module);
    	//var_dump($moduleConfig); exit();
    	$status= 'Output Enabled';
    	 if (Mage::getStoreConfig('advanced/modules_disable_output/' . $module)) {
           $status="Output Disabled";
        }
        $value= 'v-' . $moduleConfig->version .'  '.$status;
        // if ($moduleConfig->active) 
        // {
        // 	$value= 'Module Package is There but not installed';
        // }
    	
        $field = $fieldset->addField($module, 'label',
            array(
                'name'          => $module,
                'label'         => $moduleConfig->extension_name,
                'value'         => $value,
            ))->setRenderer($this->_getFieldRenderer());

		return $field->toHtml();
    }
}