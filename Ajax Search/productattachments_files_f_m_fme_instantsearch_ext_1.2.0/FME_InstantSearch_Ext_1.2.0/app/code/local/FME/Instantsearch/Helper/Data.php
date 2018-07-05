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
class FME_Instantsearch_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getsearchurl()
	{
		return $search=Mage::getStoreConfig('instantsearch/catalog/searchenabled');
		
	}
}
	 