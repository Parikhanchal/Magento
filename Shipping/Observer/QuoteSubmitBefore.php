<?php

namespace Kitchen\Shipping\Observer;

use Magento\Framework\DataObject\Copy;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote;
use Magento\Sales\Model\Order;


class QuoteSubmitBefore implements ObserverInterface
{
  protected $objectCopyService;
  public function __construct(

    Copy $objectCopyService

  ) {

    $this->objectCopyService = $objectCopyService;

  }

  public function execute(Observer $observer)

  {

    $order = $observer->getEvent()->getData('order');

    $quote = $observer->getEvent()->getData('quote');

    $this->objectCopyService->copyFieldsetToTarget('sales_convert_quote', 'to_order', $quote, $order);

    return $this;

  }

}