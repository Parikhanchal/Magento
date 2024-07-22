<?php
 
namespace Kitchen\Product\Controller\Index;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Kitchen\Product\Model\GalleryFactory;
 
class Delete extends Action
{
    protected $galleryFactory;
    protected $messageManager;
 
    public function __construct(
        Context $context,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        GalleryFactory $galleryFactory
    ) {
        $this->galleryFactory = $galleryFactory;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }
 
    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        $varModel = $this->galleryFactory->create();
 
        if ($id) {
            $varModel->load($id);
            if ($varModel->getEntityId()) {
                $varModel->delete();
                $this->messageManager->addSuccess(__("Deleted Successfully."));
            }
        }
        else {
            $this->messageManager->addWarning(__("Wrong ID"));
        }
        $this->_redirect('pro/index/index');
    }
}
 
 
