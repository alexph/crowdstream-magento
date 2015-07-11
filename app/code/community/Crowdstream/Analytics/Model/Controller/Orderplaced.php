<?php
class Crowdstream_Analytics_Model_Controller_Orderplaced extends Crowdstream_Analytics_Model_Controller_Base
{
    public function getBlock($block)
    {
        $params = $block->getParams();
        
        $info = Mage::getModel('sales/order_api')->info($params['increment_id']);

        $purchase = array();
        $purchase['order_id'] = (int) $params['increment_id'];
        $purchase['total']    = (float) $info['grand_total'];
        $purchase['shipping'] = (float) $info['shipping_amount'];
        // $purchase['tax']      = (float) $info['tax_amount'];
        $purchase['items']    = 0;
        $purchase['channel']  = Mage::helper('crowdstream_analytics')->getChannel();
        $purchase['currency'] = Mage::app()->getStore()->getCurrentCurrencyCode();
        
        $items = array();

        foreach($info['items'] as $item)
        {
            if(!$item['parent_item_id']) {
                $tmp = Mage::helper('crowdstream_analytics')->getNormalizedProductInformation($item['product_id']);
                $tmp['order_id'] = (int) $params['increment_id'];
                $tmp['quantity'] = (int) $item['qty_ordered'];

                $purchase['items'] += (int) $item['qty_ordered'];
                
                if(array_key_exists('product_options', $item)) {
                    $productOptions = unserialize($item['product_options']);
                    if(array_key_exists('attributes_info', $productOptions)) {
                        $options = array();

                        //
                        // We have attributes, build an array of values we can sort.
                        foreach($productOptions['attributes_info'] as $option) {
                            $options[$option['label']] = $option['value'];
                        }

                        //
                        // Attempt to keep options consistent 
                        ksort($options);

                        $variant = array();

                        //
                        // Combine labels with values in a format we can send.
                        foreach($options as $option => $label) {
                            $variant[] = $option . ': ' . $label;
                        }

                        if($variant) {
                            $tmp['variant'] = implode(', ', $variant);
                        }
                    }
                }
                $items[] = $tmp;
            }
        }

        $block->setPurchase($purchase);
        $block->setItems($items);
        
        return $block;
    }
}