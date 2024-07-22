<?php

namespace Kitchen\Product\Controller\Adminhtml\Index;

// class Index extends \Magento\Backend\App\Action
// {
//     /**
//      * Hello test controller page.
//      *
//      * @return \Magento\Backend\Model\View\Result\Page
//      */
//     public function execute()
//     {
//         echo __('Hello world');
//     }

//     /**
//      * Check Permission.
//      *
//      * @return bool
//      */
    // protected function _isAllowed()
    // {
    //     return $this->_authorization->isAllowed('Kitchen_Product::page');
    // }
// }


class Index extends \Magento\Backend\App\Action
{

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
         $resultPage->setActiveMenu('Kitchen_Product::name');
         $resultPage->addBreadcrumb(__('review'), __('review'));
         $resultPage->addBreadcrumb(__('my rating'), __('my rating'));

		 return $resultPage;
	}




    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Kitchen_Product::page');
    }
}
