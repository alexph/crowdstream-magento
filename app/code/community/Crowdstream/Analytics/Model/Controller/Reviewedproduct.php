<?php
class Crowdstream_Analytics_Model_Controller_Reviewedproduct extends Crowdstream_Analytics_Model_Controller_Base
{
    public function getBlock($block)
    {
        $review = $block->getReview();
        unset($review['customer_id']);
        unset($review['form_key']);
        $review = Mage::helper('crowdstream_analytics')->normalizeReviewwData($review);
        $block->setReview($review);
        return $block;
    }
}