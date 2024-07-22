<?php

namespace Ap\Fgrid\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Ap\Grid\Model\CustomerFactory;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action
{
    protected $customerFactory;
    protected $messageManager;

    public function __construct(
        Context $context,
        CustomerFactory $customerFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->customerFactory = $customerFactory;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            // Get the posted data
            $data = $this->getRequest()->getPostValue();
            

            // Ensure data is not empty
            if (empty($data)) {
                throw new LocalizedException(__('No data received.'));
            }
            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
            // die;
            // Create a new customer model
            $model = $this->customerFactory->create();
            
            
            // Set values from the form
            $model->setName($data['name']);
            $model->setEmail($data['email']);
            $model->setGender($data['gender']); 
            $model->setBirthDate($data['birth_date']); 
            // $model->setProfileImage($data['profile_image']); 
            $model->setAddress($data['address']); 
            $model->setHobbies($data['hobbies']); 
            $model->setCity($data['city']); 
            $model->setSubscription($data['subscription']); 
            $model->setCountry($data['country_id']); 
            $model->setPostcode($data['postcode']); 
            $model->setIsActive($data['is_active']); 
            $model->setCustomerGroup($data['customer_group']); 
            
            // Save the model
            $model->save();

            // Add success message
            $this->messageManager->addSuccessMessage(__('User data has been saved.'));
            
            // Redirect to index page
            $this->_redirect('user1/index/index');
        } catch (LocalizedException $e) {
            // Add error message if there's a localized exception
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            // Add generic error message for other exceptions
            $this->messageManager->addErrorMessage(__('Something went wrong while saving the user data.'));
        }
    }
}
