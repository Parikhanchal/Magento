<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Kitchen\Product\Controller\Adminhtml\Customer\Cpage;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Kitchen\Product\Model\CustomerFactory;
use Kitchen\Product\Model\ResourceModel\Customer as CustomerResourceModel;
 
class InlineEdit extends \Magento\Backend\App\Action
{
    protected $jsonFactory;
    private $CustomerFactory;
    private $CustomerResourceModel;
 
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        CustomerFactory $CustomerFactory,
        CustomerResourceModel $CustomerResourceModel
    )
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->CustomerFactory = $CustomerFactory;
        $this->CustomerResourceModel = $CustomerResourceModel;
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
                foreach (array_keys($postItems) as $modelid)
                {
                    $model = $this->CustomerFactory->create();
                    $this->CustomerResourceModel->load($model, $modelid);
                    $model->setData(array_merge($model->getData(), $postItems[$modelid]));
                    $this->CustomerResourceModel->save($model);
                }
            }
        }
 
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }  
}
