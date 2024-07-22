<?php

namespace Kitchen\Product\Controller\Index;

use Magento\Framework\App\Action\Context;
use Kitchen\Product\Model\GalleryFactory;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $galleryFactory;
    protected $messageManager;

    public function __construct(
        Context $context,
        GalleryFactory $galleryFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ){
        $this->galleryFactory = $galleryFactory;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $model = $this->galleryFactory->create();

        if (empty($data['name']) || empty($data['sku']) || empty($data['price']) || empty($data['sort_order'])) {
            $this->messageManager->addError(__('Please fill in all required fields.'));
            $this->_redirect('pro/index/index');
            return;
        }

        if (!empty($data['entity_id'])) {
            $model->load($data['entity_id']);
        }

        $model->setName($data['name'])
            ->setSku($data['sku'])
            ->setPrice($data['price'])
            ->setSortOrder($data['sort_order'])
            ->setIsActive($data['is_active'])
            ->setAId($data['a_id'])
            ->save();

        if (!empty($data['entity_id'])) {
            $this->messageManager->addSuccess(__('User data has been updated.'));
        } else {
            $this->messageManager->addSuccess(__('User data has been added.'));
        }
        
        $this->_redirect('pro/index/index');
    }
}