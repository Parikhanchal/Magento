<?php
 
namespace Ap\Grid\Controller\Adminhtml\Index;
 
class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Ap_Grid::name';
 
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
        $resultPage->setActiveMenu('Ap_Grid::name');
        $resultPage->addBreadcrumb(__('CMS'), __('CMS'));
        $resultPage->addBreadcrumb(__('Manage Pages'), __('anage Pages'));
        $resultPage->getConfig()->getTitle()->prepend(__('Custom User Grid'));
        return $resultPage;
    }
 
}