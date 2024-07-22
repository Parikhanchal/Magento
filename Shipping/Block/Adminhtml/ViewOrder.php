<?php

namespace Kitchen\Shipping\Block\Adminhtml;

/**
 * Adminhtml order abstract block
 *
 * @api
 * @author      Magento Core Team <core@magentocommerce.com>
 * @since 100.0.2
 */
class ViewOrder extends \Magento\Sales\Block\Adminhtml\Order\AbstractOrder 
{
    
    public function getShippingType()
    {
        $order = $this->getOrder();
        if ($order) {
            return $order->getCustomShippingType();
        }
        return null;
    
    }

    public function getResidential()
    {
        $order = $this->getOrder();
        if ($order) {
            return $order->getCustomResidential();
        }
        return null;
    
    }
    public function getLiftgate()
    {
        $order = $this->getOrder();
        if ($order) {
            return $order->getCustomLiftgate();
        }
        return null;
    
    }
    public function getDelivery()
    {
        $order = $this->getOrder();
        if ($order) {
            return $order->getCustomDelivery();
        }
        return null;
    
    }
}
