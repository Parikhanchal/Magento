<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Kitchen\Product\Controller\Adminhtml\NormalGrid;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Kitchen\Product\Model\ResourceModel\Product\CollectionFactory;

/**
 * Class MassDelete
 */
class MassDelete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    // const ADMIN_RESOURCE = 'Kitchen_Product::name';

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    // public function execute()
    // {
    //     $collection = $this->filter->getCollection($this->collectionFactory->create());
    //     $collectionSize = $collection->getSize();

    //     foreach ($collection as $page) {
    //         $page->delete();
    //     }

    //     $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));

    //     /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
    //     $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        
    //     // return $resultRedirect->setPath('*/*/');
    //    $this->_redirect('prod/NormalGrid/index');

    // }
    public function execute()
    {
        $ids = $this->getRequest()->getParam('product');
        if (!is_array($ids)) {
            $this->messageManager->addErrorMessage(__('Please select user(s).'));
        } else {
            try {
                $collection = $this->collectionFactory->create();
                $collection->addFieldToFilter('entity_id', ['in' => $ids]);
                $collectionSize = $collection->getSize();

                foreach ($collection as $page) {
                    $page->delete();
                }
                $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));

    } catch (\Exception $e) {
        $this->messageManager->addExceptionMessage(
            $e,
            __('Something went wrong while deleting these records.')
        );
    }
}
$this->_redirect('prod/NormalGrid/index');
}

}
