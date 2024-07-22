<?php

namespace Kitchen\Notice\Block;

use Kitchen\Notice\Model\NotificationFactory;
use Kitchen\Notice\Model\NotifyFactory;


use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Customer\Model\Session as CustomerSession;

class Popup extends \Magento\Framework\View\Element\Template
{
    protected $notificationFactory;
    protected $notifyFactory;

    protected $urlBuilder;
    protected $scopeConfig;

    private $notification;

    protected $customerSession;
    public function __construct(
        Context $context,
        NotificationFactory $notificationFactory,
        NotifyFactory $notifyFactory,
        CustomerSession $customerSession,

        UrlInterface $urlBuilder,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->notificationFactory = $notificationFactory;
        $this->notifyFactory = $notifyFactory;
        $this->customerSession = $customerSession;
        
        $this->urlBuilder = $urlBuilder;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }
    public function checkCustomer()
    { 
        return $this->customerSession->isLoggedIn();
    }
    public function getFilteredNotifications()
    {
        
        $customerGroupId = $this->customerSession->getCustomerGroupId();

        return $customerGroupId;
    }

    public function sayHello()
    {
        return __('Hello World');
    }

    public function getTitles()
    {
        $collection =   $this->notifyFactory->create()->getCollection()->addFieldToFilter('customer_group',$this->getFilteredNotifications());
        foreach ($collection as $item) {
            echo "<td>".$item->getTitle()."</td>";

        }
    }

    public function getDescriptions()
    {
        $collection =   $this->notifyFactory->create()->getCollection()->addFieldToFilter('customer_group', $this->getFilteredNotifications());
        foreach ($collection as $item) {
            echo "<td>".$item->getDescription()."</td>";

        }
    }
      public function isMarked()
        {
            $customerId = $this->customerSession->getCustomerId();
            if (!$customerId) {
                return false;
            }

            $notification = $this->notificationFactory->create()->getCollection()
                ->addFieldToFilter('customer_id', $customerId)
                ->addFieldToFilter('notice', 1)  
                ->getFirstItem();

            return (bool) $notification->getId();  
        }

    
   
}
