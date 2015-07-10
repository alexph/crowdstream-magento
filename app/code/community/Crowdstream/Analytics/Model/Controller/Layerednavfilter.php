<?php
class Crowdstream_Analytics_Model_Controller_Layerednavfilter extends Crowdstream_Analytics_Model_Controller_Base
{
    public function getBlock($block)
    {
        $params = $block->getParams();
        
        $params['category'] = Mage::helper('crowdstream_analytics')
        ->getCategoryNamesFromIds($params['request']['id']);
        $block->setParams($params);
        
        return $block;
    }
}