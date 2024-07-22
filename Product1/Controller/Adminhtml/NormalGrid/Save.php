<?php

namespace Kitchen\Product\Controller\Adminhtml\NormalGrid;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Kitchen\Product\Model\ProductFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var ProductFactory
     */
    private $productFactory;

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
     * @param ProductFactory $productFactory
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */

    public function __construct(
        Action\Context $context,
        ProductFactory $productFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->productFactory = $productFactory;
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
                   
                    $model = $this->productFactory->create()->load($data['entity_id']);
                } else {
                   
                    $model = $this->productFactory->create();
                }

                $model->setName($data['name']);
                $model->setPrice($data['price']);
                $model->setIsActive($data['is_active']);
                

                $model->save();
                $this->messageManager->addSuccessMessage(__('product has been saved.'));

                // Check if "Save and Continue" button is clicked
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('prod/*/edit', ['entity_id' => $model->getId(), '_current' => true]);
                    
                }
                return $resultRedirect->setPath('prod/NormalGrid/index');
            }
            
            catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the user data.'));
            }
     
            return $resultRedirect->setPath('prod/NormalGrid/index');
        }
     
        return $resultRedirect->setPath('prod/NormalGrid/index');
    }
}
