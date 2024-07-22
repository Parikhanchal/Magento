<?php
declare(strict_types=1);

namespace Kitchen\Product\Controller\Adminhtml\Page;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Kitchen\Product\Model\GalleryFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var GalleryFactory
     */
    private $galleryFactory;

    /**
     * @param Action\Context $context
     * @param GalleryFactory $galleryFactory
     */
    public function __construct(
        Action\Context $context,
        GalleryFactory $galleryFactory
    ) {
        parent::__construct($context);
        $this->galleryFactory = $galleryFactory;
    }

    /**
     * Save action
     *
     * @return ResultInterface
     */


    // public function execute()
    // {
    //     $resultRedirect = $this->resultRedirectFactory->create();
    //     $data = $this->getRequest()->getPostValue();
        
    //     if ($data) {
    //             $model = $this->galleryFactory->create();
    //             $model->setAId($data['a_id']);
    //             $model->setAId($data['entry_id']);
    //             $model->setCatName($data['name']);
    //             $model->setAId($data['price']);
    //             $model->setAId($data['sku']);
                // $model->setSortOrder($data['sort_order']);
    //             $model->setIsActive($data['is_active']);
                
    //             $model->save();
    //             $this->messageManager->addSuccessMessage(__('Product has been saved.'));
    //         } 
    //         else {
    //             $this->messageManager->addErrorMessage(__('Something went wrong while saving the data.'));
    //         }

    //         $this->_getSession()->setFormData($data);
    //         return $resultRedirect->setPath('prod/customer/index');
    //     }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        
        if ($data) {
            try {
                $model = $this->galleryFactory->create();
                $model->setName($data['name']);
                $model->setSortOrder($data['sort_order']);
                $model->setIsActive($data['is_active']);
                $model->setAId($data['a_id']);
 
                $model->save();
 
                $this->messageManager->addSuccessMessage(__('User data has been saved.'));
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the user data.'));
            }
 
            $this->_getSession()->setFormData($data);
        }
        
        return $resultRedirect->setPath('prod/customer/index');
    }
}

