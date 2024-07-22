<?php

namespace Kitchen\Product\Controller\Adminhtml\Customer;


class Index extends \Magento\Backend\App\Action
{
	const ADMIN_RESOURCE = 'Kitchen_Product::customer_page';

	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		 $resultPage = $this->resultPageFactory->create();
         $resultPage->getConfig()->getTitle()->prepend((__('Posts')));
         $resultPage->setActiveMenu('Kitchen_Product::customer_page');
         $resultPage->addBreadcrumb(__('review'), __('review'));
         $resultPage->addBreadcrumb(__('my rating'), __('my rating'));
		 

		 return $resultPage;
	}
}
