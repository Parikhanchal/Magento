<?php

namespace Kitchen\Product\Controller\Adminhtml\NormalGrid;
 
use Magento\Framework\App\Action\HttpPostActionInterface;
use Kitchen\Product\Model\ProductFactory;
 
class Delete extends \Magento\Backend\App\Action 
{
 
    protected $productFactory;
 
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        ProductFactory $productFactory,
    ) {
        parent::__construct($context);
        $this->productFactory = $productFactory;
    }
 
    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
       // $resultRedirect = $this->resultRedirectFactory->create();
        
        if ($id) {
            try {
                
                $pageModel = $this->productFactory->create()->load($id);
                $pageModel->delete();
                
                $this->messageManager->addSuccessMessage(__('The page has been deleted.'));
               // return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                //return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
            }
        }
        
        // $this->messageManager->addErrorMessage(__('We can\'t find a page to delete.'));
       // return $resultRedirect->setPath('*/*/');
       $this->_redirect('prod/NormalGrid/index');

    }
}
