<?php
declare(strict_types=1);

namespace Kitchen\Notice\Controller\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Kitchen\Notice\Model\NotificationFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Controller\Result\JsonFactory;


class Save extends Action implements HttpPostActionInterface
{
    
    private $notificationFactory;
    protected $resultJsonFactory;


    /**
     * @param Action\Context $context
     * @param NotificationFactory $notificationFactory
     */
    public function __construct(
        Action\Context $context,
        NotificationFactory $notificationFactory,
        JsonFactory $resultJsonFactory,

    ) {
        parent::__construct($context);
        $this->notificationFactory = $notificationFactory;
        $this->resultJsonFactory = $resultJsonFactory;

    }

    /**
     * Save action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $result = $this->resultJsonFactory->create();

        $jsonData = $this->getRequest()->getContent();
        $data = json_decode($jsonData, true);

        if ($data) {
            try {
                $model = $this->notificationFactory->create();
                $model->setNotice($data['value']);            
                $model->save();

                $this->messageManager->addSuccessMessage(__('Notice data has been saved.'));
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the user data.'));
            }

            $this->_getSession()->setFormData($data);
        }
        $result->setData([
            'success' => true,
            'message' => 'Save successfully.'
        ]);
        
    }
}
