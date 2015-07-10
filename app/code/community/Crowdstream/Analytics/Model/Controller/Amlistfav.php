<?php
class Crowdstream_Analytics_Model_Controller_Amlistfav extends Crowdstream_Analytics_Model_Controller_Base
{
    public function getBlock($block)
    {        
        $info   = Mage::getModel('catalog/product_api')->info($block->getProductId());
        $info   = Mage::helper('crowdstream_analytics')
        ->getNormalizedProductInformation($info);        
        $block->setParams($info);
        return $block;
    }
}