<?php

namespace Ap\EventPlugin\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Checkout\Model\Session as CheckoutSession;

class Event implements ObserverInterface
{
    protected $redirect;
    protected $messageManager;
    protected $checkoutSession;

    public function __construct(
        RedirectInterface $redirect,
        ManagerInterface $messageManager,
        CheckoutSession $checkoutSession
    ) {
        $this->redirect = $redirect;
        $this->messageManager = $messageManager;
        $this->checkoutSession = $checkoutSession;
    }

    public function execute(Observer $observer)
    {
        // $cartTotal = $this->checkoutSession->getQuote()->getGrandTotal();
        $cart = $this->checkoutSession->getQuote();
        $cartTotal = $cart->getGrandTotal();

        if ($cartTotal < 1000) {
            $this->messageManager->addErrorMessage(__('Your cart total at least $1000 to proceed to checkout.'));
            // $this->redirect->redirect($this->checkoutSession->getQuote()->getResponse(), 'checkout/cart/index');
            $this->redirect->redirect($observer->getControllerAction()->getResponse(), 'checkout/cart');
        }
    }
}
