<?php
namespace Kitchen\Product\Controller\Adminhtml\Customer\Cpage;
 
use Magento\Framework\App\Action\HttpPostActionInterface;
use Kitchen\Product\Model\CustomerFactory;
 
class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
 
    protected $CustomerFactory;
 
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        CustomerFactory $CustomerFactory,
    ) {
        parent::__construct($context);
        $this->CustomerFactory = $CustomerFactory;
    }
 
    public function execute()
    {
        $id = $this->getRequest()->getParam('customer_id');
       // $resultRedirect = $this->resultRedirectFactory->create();
        
        if ($id) {
            try {
                
                $pageModel = $this->CustomerFactory->create()->load($id);
                $pageModel->delete();
                
                $this->messageManager->addSuccessMessage(__('The page has been deleted.'));
               // return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                //return $resultRedirect->setPath('*/*/edit', ['customer_id' => $id]);
            }
        }
        
        // $this->messageManager->addErrorMessage(__('We can\'t find a page to delete.'));
       // return $resultRedirect->setPath('*/*/');
       $this->_redirect('prod/customer/index');

    }
}