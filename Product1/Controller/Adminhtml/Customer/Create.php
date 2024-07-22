<?php

namespace Kitchen\Product\Controller\Adminhtml\Customer;

class Create extends \Magento\Backend\App\Action
{
	//const ADMIN_RESOURCE = 'Kitchen_Product::customer_page';

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
        $resultPage->setActiveMenu('Kitchen_Product::customer_page');
        $resultPage->addBreadcrumb(__('CMS'), __('CMS'));
        $resultPage->addBreadcrumb(__('Manage Pages'), __('anage Pages'));
        $resultPage->getConfig()->getTitle()->prepend(__('Product Add'));
		return $resultPage;
	}

}
