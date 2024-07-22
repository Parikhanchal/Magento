<?php
namespace Cp\User\Controller\Adminhtml\UserGrid;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Cp\User\Model\GalleryFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Delete extends Action 
{
    protected $galleryFactory;

    public function __construct(
        Context $context,
        GalleryFactory $galleryFactory
    ) {
        parent::__construct($context);
        $this->galleryFactory = $galleryFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('user_id');
        if ($id) {
            try {
                $model = $this->galleryFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('User has been deleted successfully.'));
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('An error occurred while deleting the User.'));
            }
        } else {
            $this->messageManager->addErrorMessage(__('Unable to find the User to delete.'));
        }
 
        // Redirect back to grid
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('user2/usergrid/index');
    }
 
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Cp_User::manage_user');
    }
    }

