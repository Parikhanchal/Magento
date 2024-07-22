<?php
namespace Acp\Shipping\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Quote\Model\QuoteRepository;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\App\RequestInterface;

class Index extends Action
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
        // $quoteId = $this->checkoutSession->create()->getQuote()->getId();
        // echo $quoteId;
        
        $jsonData = $this->getRequest()->getContent();
        $data = json_decode($jsonData, true);
 
        $customData = NULL; // Initialize $customData to avoid "Undefined variable" error
        
        if (isset($data['value'])) {
            $customData = $data['value'];
        }
        
        $quote = $this->checkoutSession->getQuote();
        echo $quote->getId();
        if ($quote->getId()) {
            $quote->setData('custom_shipping', $customData);
            $this->quoteRepository->save($quote);
        } else {
           echo "Not Found Quote";
        }
        
    }
}
