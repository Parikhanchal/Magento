<?php
namespace Cp\User\Controller\Adminhtml\CustomerForm;

class Index extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;
	const ADMIN_RESOURCE = 'Cp_User::customer_details';

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
		$resultPage->setActiveMenu('Cp_User::manage_customer');
        $resultPage->getConfig()->getTitle()->prepend(__('Customer'));

		return $resultPage;
	}
}
