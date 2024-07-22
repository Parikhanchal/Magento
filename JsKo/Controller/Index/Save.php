<?php

namespace Task\JsKo\Controller\Index;
 
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Task\JsKo\Model\UserFactory;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
 
class Save extends \Magento\Framework\App\Action\Action
{
    protected $_jsonFactory;
    protected $_userFactory;
    protected $_transportBuilder;
    protected $_inlineTranslation;
    protected $_scopeConfig;
 
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        UserFactory $userFactory,
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->_userFactory = $userFactory;
        $this->_jsonFactory = $jsonFactory;
        $this->_transportBuilder = $transportBuilder;
        $this->_inlineTranslation = $inlineTranslation;
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context);
    }
 
    public function execute()
    {
        $result = $this->_jsonFactory->create();
            
        try {
            $jsonData = $this->getRequest()->getContent();
            $data = json_decode($jsonData, true);
 
            // Validate the required fields
            if (!isset($data['name']) || !isset($data['email'])) {
                throw new \InvalidArgumentException('Name and Email are required fields.');
            }
 
            $name = $data['name'];
            $gender = isset($data['gender']) ? $data['gender'] : '';
            $email = $data['email'];
            $image = isset($data['image']) ? $data['image'] : '';
            $status = isset($data['status']) ? $data['status'] : '';
 
            $user = $this->_userFactory->create();
            $user->setName($name);
            $user->setEmail($email);
            $user->setGender($gender);
            $user->setImage($image);
            $user->setStatus($status);
            $user->save();
 
            // Send email
            $this->sendEmail($name, $email, $gender);
 
            return $result->setData([
                'success' => true,
                'data' => $user->getData()
            ]);
        } catch (\Exception $e) {
            return $result->setData([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
 
    private function sendEmail($name, $email, $gender)
    {
        $sender = [
            'name' => $this->_scopeConfig->getValue('trans_email/ident_general/name', ScopeInterface::SCOPE_STORE),
            'email' => $this->_scopeConfig->getValue('trans_email/ident_general/email', ScopeInterface::SCOPE_STORE),
        ];
 
        $templateVars = [
            'name' => $name,
            'email' => $email,
            'gen' => $gender,
            
        ];
        $templateOptions = ['area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID];
 
        $transport = $this->_transportBuilder
            ->setTemplateIdentifier('Test_Email_template') // Specify your email template identifier here
            ->setTemplateOptions($templateOptions)
            ->setTemplateVars($templateVars)
            ->setFrom($sender)
            ->addTo($email)
            ->getTransport();
 
        $transport->sendMessage();
    }
}
 