<?php
class Crowdstream_Analytics_Model_Controller_Viewedproduct extends Crowdstream_Analytics_Model_Controller_Base
{
    public function getBlock($block)
    {
        $params = $block->getParams();
        // $product = Mage::getModel('catalog/product_api')->info($params['id']);

        $product   = Mage::helper('crowdstream_analytics')
        ->getNormalizedProductInformation($params['id']);   
                
        $block->setParams($product);
        return $block;
    }
}