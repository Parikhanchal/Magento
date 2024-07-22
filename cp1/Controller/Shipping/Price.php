<?php
namespace Cp\User\Controller\Shipping;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Quote\Model\QuoteRepository;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\App\RequestInterface;

class Price extends Action
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
        $jsonData = $this->getRequest()->getContent();
        $data = json_decode($jsonData, true);
   
        $customData = null;

        if (isset($data['value'])) {
            $customData = $data['value']; 
        } 

        $quote = $this->checkoutSession->getQuote();


        if ($quote->getId())
         {
            $quote->setData('custom_shipping', $customData);
            $this->quoteRepository->save($quote);
        } 
        else 
        {
            echo "Not Found Quote";
        }
        
    }
}
