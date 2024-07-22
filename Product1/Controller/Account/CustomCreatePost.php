<?php
// namespace Kitchen\Product\Controller\Account;

// use Magento\Framework\App\Action\Context;
// use Magento\Framework\Event\ManagerInterface;
// use Magento\Customer\Controller\Account\CreatePost;
// use Magento\Customer\Model\Account\Redirect as AccountRedirect;
// use Magento\Customer\Model\Session;
// use Magento\Customer\Api\Data\CustomerInterface;

// class CustomCreatePost extends CreatePost
// {
//     protected $eventManager;

//     public function __construct(
//         Context $context,
//         Session $customerSession,
//         AccountRedirect $accountRedirect,
//         CustomerInterface $customerDataObject,
//         ManagerInterface $eventManager
//     ) {
//         parent::__construct($context, $customerSession, $accountRedirect, $customerDataObject);
//         $this->eventManager = $eventManager;
//     }

//     public function execute()
//     {

//         // Call parent execute method to handle default registration process
//         parent::execute();

//         // Trigger customer_register_success event
//         $this->eventManager->dispatch('customer_register_success', ['customer' => $this->customerDataObject]);
//     }
// }
