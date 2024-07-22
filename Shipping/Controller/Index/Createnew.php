<?php

namespace Kitchen\Shipping\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Quote\Model\QuoteRepository;
use Magento\Checkout\Model\Session as CheckoutSession;

class Createnew extends Action
{
    protected $quoteRepository;
    protected $resultJsonFactory;
    protected $checkoutSession;
 
    public function __construct(
        Context $context,
        QuoteRepository $quoteRepository,
        JsonFactory $resultJsonFactory,
        CheckoutSession $checkoutSession
    ) {
        parent::__construct($context);
        $this->quoteRepository = $quoteRepository;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->checkoutSession = $checkoutSession;
    }

    public function execute()
    {
        // for find quote id 
        $quote = $this->checkoutSession->getQuote();
        $quoteId = $quote->getId();
		$quoteActive = $quoteId ? true : false;
        
        // Check if quote ID exists
        if ($quoteId) {
            echo "Quote ID: " . $quoteId;
        } else {
            echo "No active quote found.";
        }

        // Prepare response
        $response = [
            'quote_active' => $quoteActive
        ];

        $result = $this->resultJsonFactory->create();
        return $result->setData($response);

    }
}

