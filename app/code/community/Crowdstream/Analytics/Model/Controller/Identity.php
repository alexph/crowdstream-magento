<?php
class Crowdstream_Analytics_Model_Controller_Identity extends Crowdstream_Analytics_Model_Controller_Base
{
    public function getBlock($block)
    {        
        $customer = $this->_getCustomer();

        if(!$customer->getId())
        {
            return false;
        }


        $block->setUserId($customer->getId())
            ->setCreated(date(DATE_ISO8601, strtotime($customer->getData()['created_at'])))
            ->setUpdated(date(DATE_ISO8601, strtotime($customer->getData()['updated_at'])))
            ->setName($customer->getName())
            ->setFullName($customer->getName())
            ->setEmail($customer->getEmail())        
            ->setFirstName($customer->getFirstname())
            ->setLastName($customer->getLastname());

        return $block;
    }
    
}