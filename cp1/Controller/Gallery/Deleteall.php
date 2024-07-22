<?php

namespace Cp\User\Controller\Gallery;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Cp\User\Model\GalleryFactory;

class Deleteall extends Action
{
    protected $galleryFactory;
    protected $message1;
    public function __construct(
        Context $context,
        GalleryFactory $galleryFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->galleryFactory = $galleryFactory;
        $this->message1= $messageManager;
        parent::__construct($context);
    }
    

    public function execute()
{
    
    $delall = $this->galleryFactory->create();
    $collection = $delall->getCollection();
    
   foreach ($collection as $row) {
    $row->delete();
   }
    $this->message1->addSuccess(__('User all data has been deleted.'));
    $this->_redirect('user1/index/index');
}



}

