<?php
class Crowdstream_Analytics_Model_Controller_Customerregistered extends Crowdstream_Analytics_Model_Controller_Base
{
    public function getBlock($block)
    {    
        $data = $block->getData();        
        $data = Mage::helper('crowdstream_analytics')->getNormalizedCustomerInformation($data);
        $block->setData($data);    
        return $block;
    }
}