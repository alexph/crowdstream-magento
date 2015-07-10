<?php
class Crowdstream_Analytics_Model_Controller_Customerloggedin extends Crowdstream_Analytics_Model_Controller_Base
{
    public function getBlock($block)
    {
        $customer = $this->_getCustomer();
        $block->setUserId($customer->getId());
        
        $data = $block->getData();        
        $data = Mage::helper('crowdstream_analytics')->getNormalizedCustomerInformation($data);
        $block->setData($data);
        
        return $block;
    }
}