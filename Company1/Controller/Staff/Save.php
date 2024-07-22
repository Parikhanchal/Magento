<?php

namespace Kitchen\Company\Controller\Staff;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\CustomerFactory;

class Save extends Action
{
    protected $customerFactory;
    protected $message;

    public function __construct(
        Context $context,
        CustomerFactory $customerFactory,
\Magento\Framework\Message\ManagerInterface $messageManager

    ) {
        $this->customerFactory = $customerFactory;
        $this->message = $messageManager;
        parent::__construct($context);
    }

    public function execute()
{
    $data = $this->getRequest()->getPostValue();
    $model = $this->customerFactory->create();
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
    // die();
   // $collection= $model->getCollection();
   
    if (empty($data['firstname']) || empty($data['lastname']) || empty($data['email']) || empty($data['password'])) {
        $this->messageManager->addErrorMessage(__('Please fill in all required fields.'));
        $this->_redirect('company/staff/create'); 
        return;
    }
    
if ($data) {
            try{
                if (!empty($data['entity_id'])) {
                    // echo "<pre>";
                    // print_r($data);
                    // echo "</pre>";
                    // die;
                    $model->load($data['entity_id']);
                    $model->setFirstname($data['firstname']);
                    $model->setLastname($data['lastname']);
                    $model->setEmail($data['email']);
                    $model->setPasswordHash($data['password']);
                    $model->save();
                    $this->messageManager->addSuccessMessage(__('Staff data has been Updated.'));
                
                    $this->_redirect('user/staff/index');
                } else {
                    $model->setFirstname($data['firstname']);
                    $model->setLastname($data['lastname']);
                    $model->setEmail($data['email']);
                    $model->setPasswordHash($data['password']);
                    $model->setParentId($data['parent_id']);
                    
                    $model->save();
                    $this->messageManager->addSuccessMessage(__('Staff data has been saved.'));
                    $this->_redirect('user/staff/index');
                 }
                }
            catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the user data.'));
            }
}

}



}


 