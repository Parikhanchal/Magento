<?php

namespace Cp\User\Controller\Adminhtml\CustomerPage;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Cp\User\Model\CustomerFactory;

class InlineEdit extends \Magento\Backend\App\Action
{
    protected $jsonFactory;
    private $customerFactory;
 

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        CustomerFactory $customerFactory,
      
    )
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->customerFactory = $customerFactory;
     
    }

    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax'))
        {
            $postItems = $this->getRequest()->getParam('items', []);
            
            if (!count($postItems))
            {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            }
            else
            {
                foreach ($postItems as $id => $data)
                {
                    $model = $this->customerFactory->create();
                    $model = $model->load($id);
                    $model->setData($data);
                    $model->save();
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }  
}
