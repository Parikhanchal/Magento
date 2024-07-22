<?php
 
namespace Kitchen\Product\Controller\Index;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Kitchen\Product\Model\GalleryFactory;
 
class Deleteall extends Action
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
        $deleteall = $this->galleryFactory->create();
        $collection = $deleteall->getCollection();
 
        foreach ($collection as $row) {
            $row->delete();
            $this->messageManager->addSuccess(__("Delete All successfully"));
        }
        $this->_redirect('pro/index/index');
    }
}
 
 
 