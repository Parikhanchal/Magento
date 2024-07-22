<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Cp\User\Controller\Adminhtml\UserGrid;

/**
 * New Record Form Controller
 */
class NewAction extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @param \Magento\Backend\App\Action\Context               $context
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     * 
     *
     * @return \Magento\Backend\Model\View\Result\ForwardFactory
     */
    public function execute()
    {
        // $resultForward = $this->resultForwardFactory->create();
        // return $resultForward->forward('edit');
        $resultRedirect = $this->resultRedirectFactory->create();
return $resultRedirect->setPath('user2/usergrid/edit'); 

    }

    /**
     * @return boolean
     */
    protected function _isAllowed()
    {
        return true;
    }
}