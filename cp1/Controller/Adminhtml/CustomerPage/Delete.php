<?php

namespace Cp\User\Controller\Adminhtml\CustomerPage;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Cp\User\Model\CustomerFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    protected $customerFactory;

    public function __construct(
        Context $context,
        CustomerFactory $customerFactory
    ) {
        parent::__construct($context);
        $this->customerFactory = $customerFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('customer_id');
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        if ($id) {
            try {
                $model = $this->customerFactory->create();
                $model->load($id);
                $model->delete();
                
                $this->messageManager->addSuccessMessage(__('The User has been deleted.'));

                return $resultRedirect->setPath('user2/customerpage/index');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        
        $this->messageManager->addErrorMessage(__('We can\'t find a User to delete.'));
        
        return $resultRedirect->setPath('*/*/');
    }
}
