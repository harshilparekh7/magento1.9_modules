<?php

/**
* 
*/
class FME_Base_Block_System_Config_Form_Fme_Social extends Mage_Adminhtml_Block_System_Config_Form_Fieldset
{

	 

  
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
    	$facebookImg = $this->getSkinUrl('images/fme/footer_facebook.png');
    	$twitterImg = $this->getSkinUrl('images/fme/footer_twitter.png');
    	$fmeImg = $this->getSkinUrl('images/fme/footer_logo.png');
    	$plusImg = $this->getSkinUrl('images/fme/footer_google_plus.png');
    	$linkedImg = $this->getSkinUrl('images/fme/footer_linkedin.png');
        

        return '<div class="links">
<ul>

<li><a href="https://www.facebook.com/FMEMagentoExtensions" target="_blank"><img width="26" height="26" class="icon" alt="FME Facebook" src="'.$facebookImg.'"></a></li>
<li><a href="https://twitter.com/fmeextension" target="_blank"><img width="26" height="26" class="icon" alt="FME Twitter" src="'.$twitterImg.'"></a></li>
<li><a href="https://www.fmeextensions.com/" target="_blank"><img style="height:74px"; width="81" height="74" class="logo" alt="FME Magento Extensions" src="'.$fmeImg.'"></a></li>
<li><a href="https://plus.google.com/+Fmeextensions" target="_blank"><img width="26" height="26" class="icon" alt="FME Google Plus" src="'.$plusImg.'"></a></li>
<li><a href="#" target="_blank"><img width="26" height="26" class="icon" alt="FME Linkedin" src="'.$linkedImg.'"></a></li>

</ul>
</div>';
    }
 	
 	
}