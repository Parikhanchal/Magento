<?php

namespace Kitchen\Product\Plugin;

use Magento\Customer\Model\Session;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Customer\Model\Account\Redirect;

class CustomerPlugin
{
    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var CustomerFactory
     */
    protected $customerFactory;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * @var Redirect
     */
    protected $accountRedirect;

    public function __construct(
        Session $customerSession,
        CustomerFactory $customerFactory,
        ManagerInterface $messageManager,
        Redirect $accountRedirect
    ) {
        $this->customerSession = $customerSession;
        $this->customerFactory = $customerFactory;
        $this->messageManager = $messageManager;
        $this->accountRedirect = $accountRedirect;
    }

    public function aroundExecute(
        \Magento\Customer\Controller\Account\LoginPost $subject,
        callable $proceed
    ) {
        $customerData = $subject->getRequest()->getParams();
        $customerEmail = $customerData['login']['username'];
        $customer = $this->customerFactory->create()->setWebsiteId(1)->loadByEmail($customerEmail);
        $isApproved = $customer->getCustomerApproved();

        if (!$isApproved) {
            $this->messageManager->addErrorMessage(__('Your account is not approved. Please contact admin for assistance.'));
            return $this->accountRedirect->getRedirect();
        }

        return $proceed();
        return $this->accountRedirect->getRedirect();

    }
}
