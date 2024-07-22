<?php
namespace Kitchen\Shipping\Observer;
 
// use Magento\Framework\Event\Observer;
// use Magento\Framework\Event\ObserverInterface;
// use Magento\Framework\App\RequestInterface;
// use Magento\Framework\App\ResponseInterface;
// use Magento\Framework\App\Response\RedirectInterface;
// use Magento\Framework\Message\ManagerInterface;
// use Magento\Quote\Model\QuoteFactory;
// use Magento\Framework\UrlInterface;
// use Magento\Checkout\Model\Session as CheckoutSession;
 
// class Event implements ObserverInterface
// {
//     protected $request;
//     protected $response;
//     protected $messageManager;
//     protected $quoteFactory;
//     protected $checkoutSession;
//     protected $url;
 
//     public function __construct(
//         RequestInterface $request,
//         ResponseInterface $response,
//         ManagerInterface $messageManager,
//         QuoteFactory $quoteFactory,
//         CheckoutSession $checkoutSession,
//         UrlInterface $url
//     ) {
//         $this->request = $request;
//         $this->response = $response;
//         $this->messageManager = $messageManager;
//         $this->quoteFactory = $quoteFactory;
//         $this->checkoutSession = $checkoutSession;
//         $this->url = $url;
//     }
 
//     public function execute(Observer $observer)
//     {
//         $quote = $this->checkoutSession->getQuote();
//         $ShippingTypes = $quote->getCustomShippingType();
 
//         // check
//         //  if shipping method is selected
//         if (!$ShippingTypes) {
//             $this->response->setRedirect($this->url->getUrl('checkout/cart'));
//         }
//     }
// }

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Quote\Model\QuoteFactory;
use Magento\Framework\UrlInterface;
use Magento\Checkout\Model\Session as CheckoutSession;
 
class Event implements ObserverInterface
{
    protected $request;
    protected $response;
    protected $messageManager;
    protected $quoteFactory;
    protected $checkoutSession;
    protected $url;
 
    public function __construct(
        RequestInterface $request,
        ResponseInterface $response,
        ManagerInterface $messageManager,
        QuoteFactory $quoteFactory,
        CheckoutSession $checkoutSession,
        UrlInterface $url
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->messageManager = $messageManager;
        $this->quoteFactory = $quoteFactory;
        $this->checkoutSession = $checkoutSession;
        $this->url = $url;
    }
 
    public function execute(Observer $observer)
    {
        $quote = $this->checkoutSession->getQuote();
        $shipType = $quote->getCustomShippingType();
 
        if (!$shipType) {
            // echo "<pre>";
            // print_r(get_class_methods($this->messageManager));
            // die;
            $this->messageManager->addWarning('Please select a shipping type.');
            $redirectUrl = $this->url->getUrl('checkout/cart');
 
            $this->response->setRedirect($redirectUrl)->send();
            return;  
        }
    }
}