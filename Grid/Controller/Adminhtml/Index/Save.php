<?php

namespace Ap\Grid\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Ap\Grid\Model\CustomerFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var CustomerFactory
     */
    private $customerFactory;

    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $filesystem;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param Action\Context $context
     * @param CustomerFactory $customerFactory
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */

    public function __construct(
        Action\Context $context,
        CustomerFactory $customerFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->customerFactory = $customerFactory;
        $this->filesystem = $filesystem;
        $this->storeManager = $storeManager;
    }
    /**
     * Save action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        // echo "<pre>";
        // print_r($data);
        // die;
        
        if ($data) {

            try {
               
                if (!empty($data['entity_id'])) {
                   
                    $model = $this->customerFactory->create()->load($data['entity_id']);
                } else {
                   
                    $model = $this->customerFactory->create();
                }

                $model->setName($data['name']);
                $model->setEmail($data['email']);
                $model->setGender($data['gender']);
                $model->setBirthDate($data['birth_date']);
                $model->setAddress($data['address']);

                $hobbies = implode(', ', $data['hobbies']);
                $model->setHobbies($hobbies);

                $sub = implode(', ', $data['subscription']);
                $model->setSubscription($sub);

                $model->setIsActive($data['is_active']);
                $model->setCity($data['city']);
                // $model->setRegion($data['region']);
                $model->setCountry($data['country']);
                $model->setPostcode($data['postcode']);
                $model->setCustomerGroup($data['customer_group']);
                

                if (!empty($data['profile_image'][0]['name'])) { 
                    $profileImageName = $data['profile_image'][0]['name']; 
                    $model->setProfileImage($profileImageName); 
                }

                $model->save();
                $this->messageManager->addSuccessMessage(__('Customer has been saved.'));
            }
            
            catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the user data.'));
            }
     
            // Redirect back to the customer page
            return $resultRedirect->setPath('grid1/index/index');
        }
     
        // If no data is available, redirect back to the customer page
        return $resultRedirect->setPath('grid1/index/index');
    }
}