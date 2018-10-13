<?php
/**
 * FME Instant Search
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   FME
 * @package    Instant Search
 * @author     Muhammad Qaisar Satti <shumail123@gmail.com>
 *         
 * @copyright  Copyright 2015 © www.fmeextensions.com All right reserved
 */
class FME_Instantsearch_IndexController extends Mage_Core_Controller_Front_Action{
    public function IndexAction() {
      //setting the template.
    	if($this->getRequest()->getPost('q')!="" OR $this->getRequest()->getPost('id')!=""){
    		//if the query is not null then set the layout 
	 		echo $this->getLayout()->createBlock('instantsearch/index')->setTemplate('instantsearch/view.phtml')->toHtml();
    	}
	  	
    }
}