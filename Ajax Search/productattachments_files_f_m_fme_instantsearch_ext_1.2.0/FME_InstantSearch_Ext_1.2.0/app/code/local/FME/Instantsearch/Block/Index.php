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
class FME_Instantsearch_Block_Index extends Mage_Core_Block_Template{   

	public function searchQuery()
	{ //return result for search


			$limit=Mage::getStoreConfig('instantsearch/catalog/searchproductlimit');

			if($this->getRequest()->getPost('id')!="")
			{ //if the user click on small product thumbnail
				$products = Mage::getModel('catalog/product')->load($this->getRequest()->getPost('id'));
			               
				return $products;
			}
			if($this->getRequest()->getPost('q')=="")
			{  //if the search query is null
				$products = "";
			               
				return $products;
			}
			$storeId    = Mage::app()->getStore()->getId();

			$pid1=array();
			$proids=array();
			$query = $this->getRequest()->getPost('q');
		 	$attrib4="";

		   	$searchfilter=$this->getFilter($query);// get the setting for search for name,short description and description.
		    $tagid=$this->getProductTagid();//get all the product tags id. 

		   if($tagid=="" && count($searchfilter)==0) {
				$products = "";
				               
				return $products;
		   	}else {

			   	if($tagid!="")
			   	{    //getting all the product tag data. 
					$products1 = Mage::getModel('catalog/product')->getCollection()
						->addAttributeToSelect('*')
						->setStoreId($storeId)
						->addStoreFilter($storeId)
						->addFieldToFilter("status",1)
						->addFieldToFilter('visibility', Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH);	
					//only get the taged products.	
						$products1->getSelect()->joinright(
		    		array('relation' => $products1->getTable('tag/relation')),
		    			"relation.product_id = e.entity_id AND ($tagid)"
						);
						$proid="";
						$pid1=$products1->getAllIds();//set the result products id for merging.

				

				}	
				if(count($searchfilter)!=0){
						$products = Mage::getModel('catalog/product')->getCollection()
							->addAttributeToSelect('*')
							->setStoreId($storeId)
							->addStoreFilter($storeId)
							->addFieldToFilter("status",1)
							->addFieldToFilter('visibility', Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH);	
						
					
				
					
						if(count($searchfilter)) {
							$a=1;
							foreach($searchfilter as $search)
							{
								if($a==1){
								$attrb1=array('attribute' => $search, 'like' => '%'.$query.'%');
				 				} 
				 				elseif ($a==2) {
				 						$attrb2=array('attribute' => $search, 'like' => '%'.$query.'%');

				 				}	else {
				 					$attrb3=array('attribute' => $search, 'like' => '%'.$query.'%');
				 				}
							
							
							$a++;}	
						}
			           if(count($searchfilter)==1) {
							$products->addFieldToFilter(array($attrb1,));
						}	
						else if(count($searchfilter)==2) {
							$products->addFieldToFilter(array($attrb1,$attrb2,));
						}
						else {
							$products->addFieldToFilter(array($attrb1,$attrb2,$attrb3,));
						}
					
					
					
						$products ->setPageSize($limit)
									->setCurPage(1)
									->setOrder('entity_id','ASC');
						foreach($products as $pro)
						{			
		            		$proids[]=$pro->getid();//set the result products id for merging.
		            	}
		        }

	        	//checking if product tag and (name or short description or  detail description)  search are enabled
		        if($tagid!="" && count($searchfilter)!=0) { 

		        	//merging the product tag result and other search result

		        	 $collection=array_unique(array_merge($pid1,$proids));
		        	} 

		        	//checking if only product tag search are enabled
		        	else if($tagid!="")
		        	{ 
		        		$collection=array_unique($pid1);
		        	}
		        	else { //if only product name.short description and detail description search are enabled
		        		$collection=array_unique($proids);
		        	}
	        //slice the array if it exceed the limit	
	       $collection=array_slice($collection,0,$limit);
	       //return the result...
			return $collection;
			
		}
	}
		 public function checkk()
		 {  //checking if the request for product detail.
					 	if($this->getRequest()->getPost('id'))
					{ 
					    return 1;
					} else { 
						return 0;
					 }
		}
		public function getThumb()
		{ //getting the thumb width
			return Mage::getStoreConfig('instantsearch/catalog/searchproductthumb');
		}
		public function getFilter()
		{ //setting  for filter search
					$arr=array();;
					$name=Mage::getStoreConfig('instantsearch/catalog/searchname');
					if($name==1)
					{
					   $arr[0]='name';
					}
						$searcshortdescription=Mage::getStoreConfig('instantsearch/catalog/searcshortdescription');
					if($searcshortdescription==1)
					{
						$arr[1]='short_description';
					  
					}	
						$searchdetaildescription=Mage::getStoreConfig('instantsearch/catalog/searchdetaildescription');
					if($searchdetaildescription==1)
					{
						$arr[2]='description';
					   
					}	
						

					return $arr;
		}
		public function getProductTagid()
		{ //getting  the tags ids if it is enable from amdin
			$tagid="";
			$producttag=Mage::getStoreConfig('instantsearch/catalog/searchproducttag');
			if($producttag==1)
				{   
					$storeId    = Mage::app()->getStore()->getId();
					$query = $this->getRequest()->getPost('q');
					$tagmodel = Mage::getModel('tag/tag');
				            $collection = $tagmodel->getResourceCollection()
				                ->addPopularity()
				                ->addStatusFilter($tagmodel->getApprovedStatus())
								->addFieldToFilter("name",array('like'=>'%'. $query.'%'))	
				                ->addStoreFilter($storeId)
				                ->setActiveFilter()
				                ->load();
			                $a=1;
			              
			                foreach($collection as $tag)
							{
								if($a==1){
									//setting the condition for search product
			                     $tagid .="relation.tag_id='".$tag->getId()."'";
								}else{
								 $tagid .=" OR relation.tag_id='".$tag->getId()."'";	
								}
					
							$a++;}	
			}

			return $tagid;
		}


}