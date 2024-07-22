<?php

namespace Kitchen\Shipping\Plugin;

class DefaultConfigProviderPlugin
{
  protected $checkoutSession;
  public function __construct(
    \Magento\Checkout\Model\Session $checkoutSession
  ) {
    $this->checkoutSession   = $checkoutSession;
  }
  public function afterGetConfig(
    \Magento\Checkout\Model\DefaultConfigProvider $subject,
    $output
  ) 
  {
        $quote = $this->checkoutSession->getQuote();
 
        $shipping = $quote->getCustomShippingType();
        $output['custom_shipping_type'] = $shipping;

        $output['residential'] = (int) $quote->getCustomResidential();
        $output['liftgate'] = (int) $quote->getCustomLiftgate();
        $output['delivery'] = (int) $quote->getCustomDelivery();

        return $output;
  }  
}

