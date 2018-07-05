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
$installer = $this;

$installer->startSetup(); 
$installer->setConfigData('instantsearch/catalog/searchenabled','0');
$installer->setConfigData('instantsearch/catalog/searchname','1');
$installer->setConfigData('instantsearch/catalog/searcshortdescription','1');
$installer->setConfigData('instantsearch/catalog/searchdetaildescription','1');
$installer->setConfigData('instantsearch/catalog/searchproducttag','1');
$installer->setConfigData('instantsearch/catalog/searchproductlimit','6');
$installer->setConfigData('instantsearch/catalog/searchproductthumb','100');
$installer->endSetup(); 
