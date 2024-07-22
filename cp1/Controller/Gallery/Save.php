<?php

namespace Cp\User\Controller\Gallery;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Cp\User\Model\GalleryFactory;

class Save extends Action
{
    protected $galleryFactory;
    protected $message;

    public function __construct(
        Context $context,
        GalleryFactory $galleryFactory,
\Magento\Framework\Message\ManagerInterface $messageManager

    ) {
        $this->galleryFactory = $galleryFactory;
        $this->message = $messageManager;
        parent::__construct($context);
    }

    public function execute()
{
    $data = $this->getRequest()->getPostValue();
    $model = $this->galleryFactory->create();
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
    // die();
   // $collection= $model->getCollection();
   
    if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
        $this->message->addError(__('Please fill in all required fields.'));
        $this->_redirect('user1/index/index'); 
        return;
    }

   if (!empty($data['user_id'])) {
    $model->load($data['user_id']);
    $model->setName($data["name"]);
        $model->setEmail($data["email"]);
        $model->setPassword($data['password']);
        $model->save();
        $this->message->addSuccess(__('User data has been updated.'));
        $this->_redirect('user1/index/index');
} else {
        $model->setName($data['name']);
        $model->setEmail($data['email']);
        $model->setPassword($data['password']);
        $model->save();
        $this->message->addSuccess(__('User data has been Added.'));
        $this->_redirect('user1/index/index');
    }    

}


}

