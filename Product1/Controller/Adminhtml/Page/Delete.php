<?php
namespace Kitchen\Product\Controller\Adminhtml\Page;
 
use Magento\Framework\App\Action\HttpPostActionInterface;
use Kitchen\Product\Model\GalleryFactory;
 
class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    //const ADMIN_RESOURCE = 'Magento_Cms::page_delete';
 
    protected $galleryFactory;
 
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        GalleryFactory $galleryFactory,
    ) {
        parent::__construct($context);
        $this->galleryFactory = $galleryFactory;
    }
 
    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
       // $resultRedirect = $this->resultRedirectFactory->create();
        
        if ($id) {
            try {
                
                $pageModel = $this->galleryFactory->create()->load($id);
                $pageModel->delete();
                
                $this->messageManager->addSuccessMessage(__('The page has been deleted.'));
               // return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                //return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
            }
        }
        
        // $this->messageManager->addErrorMessage(__('We can\'t find a page to delete.'));
       // return $resultRedirect->setPath('*/*/');
       $this->_redirect('prod/index/index');

    }
}