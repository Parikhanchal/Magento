<?php
declare(strict_types=1);

namespace Cp\User\Controller\Adminhtml\CustomerForm;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Cp\User\Model\CustomerFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var CustomerFactory
     */
    private $customerFactory;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @param Action\Context $context
     * @param CustomerFactory $customerFactory
     * @param StoreManagerInterface $storeManager
     * @param Filesystem $filesystem
     */
    public function __construct(
        Action\Context $context,
        CustomerFactory $customerFactory,
        StoreManagerInterface $storeManager,
        Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->customerFactory = $customerFactory;
        $this->storeManager = $storeManager;
        $this->filesystem = $filesystem;
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
        // echo "</pre>";

        // die();
        if ($data) {
            try {
                $customerId = !empty($data['customer_id']) ? (int)$data['customer_id'] : null;

                $model = $this->customerFactory->create();
                if ($customerId) {
                    $model->load($customerId);
                }

                $model->setFirstName($data['first_name'])
                      ->setLastName($data['last_name'])
                      ->setEmail($data['email'])
                      ->setGender($data['gender'])
                      ->setBirthDate($data['birth_date'])
                      ->setAddress($data['address'])
                      ->setIsActive($data['is_active'])
                      ->setNewsletterSubscription(implode(',', $data['newsletter_subscription']))
                      ->setHobbies(implode(',', $data['hobbies']));

                if (!empty($data['profile_image'][0]['name'])) {
                   
                    $profileImageName = $data['profile_image'][0]['name'];

                    $model->setProfileImage($profileImageName);
                  
                }

                $model->save();
                $this->messageManager->addSuccessMessage(__('User data has been saved.'));
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the user data.'));
            }
        }

        return $resultRedirect->setPath('user2/customerpage/index');
    }
}