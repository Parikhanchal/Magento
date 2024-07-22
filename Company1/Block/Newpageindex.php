<?php
namespace Kitchen\Company\Block;

class Newpageindex extends \Magento\Framework\View\Element\Template
{
	protected $customerSession;

	public function __construct(\Magento\Framework\View\Element\Template\Context $context,
	\Magento\Customer\Model\Session $customerSession)
	{
		parent::__construct($context);
		$this->customerSession = $customerSession;
	}

	public function sayHello()
	{
		return __('Hello World');
	}
	public function getIds()
	{
		
		$customer = $this->customerSession->getCustomer()->getId();
		return $customer;
	}
}