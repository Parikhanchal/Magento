<?php
 
namespace Kitchen\Notice\Controller\Index;
 
use Kitchen\Notice\Model\NotificationFactory;
use Magento\Customer\Model\Session as CustomerSession;

 
class CheckboxSave extends \Magento\Framework\App\Action\Action
{
    protected $resultJsonFactory;
    protected $quoteFactory;
    protected $checkoutSession;
    protected $notificationFactory;
    protected $customerSession;

 
    public function __construct(
        NotificationFactory $notificationFactory,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        CustomerSession $customerSession,

    ) {
        parent::__construct($context);
 
        $this->notificationFactory = $notificationFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->customerSession = $customerSession;

    }
 
    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $jsonData = $this->getRequest()->getContent();
        $data = json_decode($jsonData, true);
 
        $checks =$data['value'];
        $customerId = $this->customerSession->getCustomerId();
  
        $getNotice = $this->notificationFactory->create();
        $getNotice->setNotice($checks);
        $getNotice->setCustomerId($customerId);
        $getNotice->save();
 
        return $result->setData([
            'checkbox' => $checks,
            'message' => 'checks exists'
        ]);
    }
}
 