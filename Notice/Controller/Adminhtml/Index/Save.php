<?php

namespace Kitchen\Notice\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Kitchen\Notice\Model\NotifyFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var notifyFactory
     */ 
    private $notifyFactory;

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
     * @param NotifyFactory $notifyFactory
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */

    public function __construct(
        Action\Context $context,
        NotifyFactory $notifyFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->notifyFactory = $notifyFactory;
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
               
                if (!empty($data['notice_id'])) {
                   
                    $model = $this->notifyFactory->create()->load($data['notice_id']);
                } else {
                   
                    $model = $this->notifyFactory->create();
                }

                $model->setTitle($data['title']);
                $model->setDescription($data['description']);
                $model->setCustomerGroup($data['customer_group'][0]);
                $model->setStatus($data['status']);

                $model->save();
                $this->messageManager->addSuccessMessage(__('data has been saved.'));
            }
            
            catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the user data.'));
            }
     
            // Redirect back to the customer page
            return $resultRedirect->setPath('notice1/index/index');
        }
     
        // If no data is available, redirect back to the customer page
        return $resultRedirect->setPath('notice1/index/index');
    }
} 