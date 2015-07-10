<?php
class Crowdstream_Analytics_Model_Controller_Orderplaced extends Crowdstream_Analytics_Model_Controller_Base
{
    public function getBlock($block)
    {
        $params = $block->getParams();
        
        $info = Mage::getModel('sales/order_api')->info($params['increment_id']);

        Mage::log($info);
        
        $purchase = array();
        $purchase['order_id'] = (int) $params['increment_id'];
        $purchase['total']    = (float) $info['grand_total'];
        $purchase['shipping'] = (float) $info['shipping_amount'];
        // $purchase['tax']      = (float) $info['tax_amount'];
        $purchase['items']    = (int) count($info['items']);
        $purchase['channel']  = Mage::helper('crowdstream_analytics')->getChannel();
        $purchase['currency'] = Mage::app()->getStore()->getCurrentCurrencyCode();

        
        $items = array();

        foreach($info['items'] as $item)
        {
            $tmp = Mage::helper('crowdstream_analytics')->getNormalizedProductInformation($item);
            // $tmp['id']       = (int) $item['product_id'];            
            // $tmp['sku']      = $item['sku'];
            // $tmp['name']     = $item['name'];
            // $tmp['amount']    = (float) $item['price'];
            $tmp['quantity'] = (float) $item['qty_ordered'];
            // $purchase['channel']  = Mage::helper('crowdstream_analytics')->getChannel();
            // $purchase['currency'] = Mage::app()->getStore()->getCurrentCurrencyCode()
            if(array_key_exists('product_options', $item)) {
                if(array_key_exists('attributes_info', $item)) {
                    $options = unserialize($item['product_options']) {

                    }
                }
            }
            $options = array();

            //in case we ever add the boolean order items
            // $tmp = Mage::helper('crowdstream_analytics')->getDataCastAsBooleans($item);
            $items[] = $tmp;
        }

        $block->setPurchase($purchase);
        $block->setItems($items);

        // $params['purchase'] = $purchase;
        // $params['items'] = $items;

        //too much information?
        //$block->setParams($info);
        
        //the serialized information
        // $block->setParams($params);
        
        return $block;
    }
}