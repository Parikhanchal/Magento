<?php

namespace Cp\User\Controller\Gallery;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Cp\User\Model\GalleryFactory;

class Delete extends Action
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
    $id = $this->getRequest()->getparam("deleteid");
    $del = $this->galleryFactory->create()->load($id);
    $del->delete();
    $this->message1->addSuccess(__('User data has been deleted.'));
    $this->_redirect('user1/index/index');
}
public function deletemassAction()
{
    //$id = $this->getRequest()->getParam('selected_user');
    $delall = $this->galleryFactory->create();
    $collection = $delall->getCollection();
   foreach ($collection as $row) {
    $delall->delete();
   }
}




}

