<?php
 
namespace Cp\User\Controller\Adminhtml\UserGrid;
 
use Magento\Backend\App\Action;
use Magento\Backend\Model\Auth\Session;
 
class Save extends \Magento\Backend\App\Action
{
 
    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $_adminSession;
 
   
    protected $GalleryFactory;
 
   
    public function __construct(
        Action\Context $context,
        \Magento\Backend\Model\Auth\Session $adminSession,
        \Cp\User\Model\GalleryFactory $galleryFactory
    ) {
        parent::__construct($context);
        $this->_adminSession = $adminSession;
        $this->galleryFactory = $galleryFactory;
    }
 
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        // echo "<pre>";
        // print_r($data);
        //  die;
 
        if ($data) {
            try {
                if (!empty($data['user_id'])) {
                    $model = $this->galleryFactory->create()->load($data['user_id']);
                } else {
                    $model = $this->galleryFactory->create();
                }
 
                $model->setName($data['name']);
                $model->setEmail($data['email']);
                $model->setAId($data['a_id']);
 
                $model->setIsActive($data['is_active']);
                
 
                $model->save();
                                
$this->_getSession()->setFormData($data);
            
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('user2/*/edit', ['user_id' => $model->getId(), '_current' => true]);
                    
                }
                return $resultRedirect->setPath('user2/usergrid/index');
                // $this->messageManager->addSuccessMessage(__('User data has been saved.'));
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the user data.'));
            }
            return $resultRedirect->setPath('user2/usergrid/index');
        }
        return $resultRedirect->setPath('user2/usergrid/index');
    }
}
 