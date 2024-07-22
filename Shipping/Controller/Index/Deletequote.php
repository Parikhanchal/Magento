<?php

namespace Kitchen\Shipping\Controller\Index;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Quote\Model\QuoteFactory;
 
class Deletequote extends Action
{
    protected $resultJsonFactory;
    protected $checkoutSession;
 
    protected $quoteFactory;
 
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        CheckoutSession $checkoutSession,
        QuoteFactory $quoteFactory,
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->quoteFactory = $quoteFactory;
        $this->checkoutSession = $checkoutSession;
    }
 
    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $quote = $this->checkoutSession->getQuote();
        $quoteId = $quote->getId();
 
        $model = $this->quoteFactory->create();
        $model->load($quoteId);
        $model->setIsActive(0);
        $model->save();
    }
}
 