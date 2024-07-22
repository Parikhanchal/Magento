<?php

namespace Ap\EventPlugin\Plugin;

use Magento\Framework\Message\ManagerInterface;
use Magento\Checkout\Model\Session;
use Magento\Framework\App\Response\RedirectInterface;

class CustomerPlugin
{
    /**
     * @var Session
     */
    protected $checkoutSession;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * @var RedirectInterface
     */
    protected $redirect;

    public function __construct(
        Session $checkoutSession,
        ManagerInterface $messageManager,
        RedirectInterface $redirect
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->messageManager = $messageManager;
        $this->redirect = $redirect;
    }

    public function beforeExecute(
        \Magento\Checkout\Controller\Index\Index $subject
    ) {
        $cartTotal = $this->checkoutSession->getQuote()->getGrandTotal();

        if ($cartTotal < 20000) {
            $this->messageManager->addErrorMessage(__('Your cart total at least $2000 to proceed to checkout.'));
            return $this->redirect->redirect($subject->getResponse(), 'checkout/cart/index');
        }

        return $proceed();
    }
}
