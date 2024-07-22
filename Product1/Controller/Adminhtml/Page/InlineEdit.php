<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Kitchen\Product\Controller\Adminhtml\Page;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Kitchen\Product\Model\GalleryFactory;
use Kitchen\Product\Model\ResourceModel\Gallery as GalleryResourceModel;
 
class InlineEdit extends \Magento\Backend\App\Action
{
    protected $jsonFactory;
    private $galleryFactory;
    private $galleryResourceModel;
 
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        GalleryFactory $galleryFactory,
        GalleryResourceModel $galleryResourceModel
    )
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->galleryFactory = $galleryFactory;
        $this->galleryResourceModel = $galleryResourceModel;
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
                    $model = $this->galleryFactory->create();
                    $this->galleryResourceModel->load($model, $modelid);
                    $model->setData(array_merge($model->getData(), $postItems[$modelid]));
                    $this->galleryResourceModel->save($model);
                }
            }
        }
 
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }  
}
