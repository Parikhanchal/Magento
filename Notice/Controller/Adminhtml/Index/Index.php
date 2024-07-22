<?php

namespace Kitchen\Notice\Controller\Adminhtml\Index;


class Index extends \Magento\Backend\App\Action
{
	const ADMIN_RESOURCE = 'Kitchen_Notice::page';

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
         $resultPage->getConfig()->getTitle()->prepend((__('Notice Grid')));
         $resultPage->setActiveMenu('Kitchen_Notice::page');
         $resultPage->addBreadcrumb(__('review'), __('review'));
         $resultPage->addBreadcrumb(__('my rating'), __('my rating'));
		 

		 return $resultPage;
	}
}
