<?php

namespace Kitchen\Shipping\Controller\Index;

class Edit extends \Magento\Framework\App\Action\Action
{
    protected $resultJsonFactory;
    protected $checkoutSession;
 
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Checkout\Model\Session $checkoutSession
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->checkoutSession = $checkoutSession;
    }
 
    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $getQuote = $this->checkoutSession->getQuote();
        $editOption = $getQuote->getCustomShippingType();
        
        $quoteId = $getQuote->getId();
 
        return $result->setData([
            'ID:' => $quoteId,
            'editOption' => $editOption
        ]);
    }
}
 