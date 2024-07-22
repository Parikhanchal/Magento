<?php

namespace Kitchen\Product\Controller\Adminhtml\Customer;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Kitchen\Product\Model\CustomerFactory;
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
               
                if (!empty($data['customer_id'])) {
                   
                    $model = $this->customerFactory->create()->load($data['customer_id']);
                } else {
                   
                    $model = $this->customerFactory->create();
                }

                $model->setFirstName($data['first_name']);
                $model->setLastName($data['last_name']);
                $model->setEmail($data['email']);
                $model->setGender($data['gender']);
                $model->setBirthDate($data['birth_date']);
                // $model->setProfileImage($data['profile_image']);
                $model->setAddress($data['address']);

                $hobbies = implode(', ', $data['hobbies']);
                $model->setHobbies($hobbies);

                $model->setNewsletterSubscription($data['newsletter_subscription']);
                $model->setIsActive($data['is_active']);
                

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
            return $resultRedirect->setPath('prod/Customer/index');
        }
     
        // If no data is available, redirect back to the customer page
        return $resultRedirect->setPath('prod/Customer/index');
    }
}

//     /**
//      * Save image and return the path
//      *
//      * @param string $imageName
//      * @param string $imageUrl
//      * @return string|null
//      */
//     private function saveImageAndGetPath($imageName, $imageUrl)
//     {
//         $mediaDirectory = $this->filesystem->getDirectoryWrite(DirectoryList::MEDIA);
//         $mediaPath = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
 
//         $uniqueFilename = md5(microtime()) . '_' . $imageName;
 
//         $targetPath = 'Kitchen/Product/';
 
//         try {
            
//             $mediaDirectory->create($targetPath);
 
           
//             $mediaDirectory->writeFile($targetPath . $uniqueFilename, file_get_contents($imageUrl));
 
//             return $mediaPath . $targetPath . $uniqueFilename;
//         } catch (\Exception $e) {
           
//             return null;
//         }
//     }
// }


 
// // namespace Kitchen\News\Controller\Adminhtml\Customer;
 
// use Magento\Framework\App\Action\Action;
// use Magento\Framework\App\Action\Context;
// // use Kitchen\News\Model\CustomerFactory;
 
// class Save extends Action
// {
//     protected $customerFactory;
 
//     public function __construct(
//         Context $context,
//         CustomerFactory $customerFactory
//     ) {
//         $this->customerFactory = $customerFactory;
//         parent::__construct($context);
//     }
 
//     public function execute()
//     {
//         $varOne = $this->getRequest()->getPostValue();
 
//         if (!$varOne) {
//             $this->messageManager->addErrorMessage(__('Invalid data. Please try again.'));
//             $this->_redirect('prod/customer/index');
//         }
 
//         $varModel = $this->customerFactory->create();
//         $varModel->setFirstName($varOne['first_name'])
//             ->setLastName($varOne['last_name'])
//             ->setEmail($varOne['email'])
//             ->setGender($varOne['gender'])
//             ->setBirthDate($varOne['birth_date'])
//             ->setProfileImage($varOne['profile_image'])
//             ->setAddress($varOne['address'])
//             ->setIsActive($varOne['is_active'])
//             ->setHobbies($varOne['hobbies'])
//             ->setNewsletterSubscription($varOne['newsletter_subscription']);
        
//         try {
//             $varModel->save();
//             $this->messageManager->addSuccessMessage(__('data has been saved.'));
//         } catch (\Exception $e) {
//             $this->messageManager->addErrorMessage(__('Something went wrong while saving the user data.'));
//             $this->_getSession()->setFormData($varOne);
//             $this->_redirect('prod/customer/index');
//         }
//         $this->_redirect('prod/customer/index');
//     }
// }