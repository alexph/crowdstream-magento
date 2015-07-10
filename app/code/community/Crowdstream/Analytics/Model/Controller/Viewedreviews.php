<?php
class Crowdstream_Analytics_Model_Controller_Viewedreviews extends Crowdstream_Analytics_Model_Controller_Base
{
    public function getBlock($block)
    {
        $params = $block->getParams();
        
        $info = Mage::getModel('catalog/product_api')
            ->info($params['id']);
        
        $params = Mage::helper('crowdstream_analytics')
            ->getNormalizedProductInformation($info); 
                
        $block->setParams($params);
        
        return $block;
    }
}