<?php

namespace Kitchen\Product\Cron;

use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;

class TestCron {
    /**
     * @var CollectionFactory
     */
    protected $customerCollectionFactory;
    protected $transportBuilder;
    protected $inlineTranslation;
    protected $scopeConfig;
    

    /**
     * Testcron constructor.
     * @param CollectionFactory $customerCollectionFactory
     */
    public function __construct(
        CollectionFactory $customerCollectionFactory,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder, 
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        ScopeConfigInterface $scopeConfig
        
    ) {
        $this->_transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->customerCollectionFactory = $customerCollectionFactory;
        $this->scopeConfig = $scopeConfig;

    }
// for after set email in system configration(admin)

//     public function execute() {

//         $templateOptions = array('area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => 1); 
//         $templateVars = []; 

//         $this->inlineTranslation->suspend(); 

//         // echo "<pre>";print_r($this->scopeConfig->getValue('Kitchen_Email/email/recipient_email', \Magento\Store\Model\ScopeInterface::SCOPE_STORE
//         // ));

//         $sender = $this->scopeConfig->getValue('kitchen_email/try_email/kitchen_send_email', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
       
//         $reciver = $this->scopeConfig->getValue('kitchen_email/try_email/kitchen_reciver_email', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

//         $template = $this->scopeConfig->getValue('kitchen_email/try_email/kitchen_email_template', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

//          $transport = $this->_transportBuilder->setTemplateIdentifier($template) 
//             ->setTemplateOptions($templateOptions) 
//             ->setTemplateVars($templateVars) 
//             ->setFrom([ 
//                 'name' => 'Test', 
//                 'email' => $reciver  
//             ]) 
//             // ->addTo(['parikhaanchal12@gmail.com']) 
//             ->addTo([$sender]) 


//             // ->addCc(['']) 
//             // ->addBcc(['bipin@kitchen365.com']) 
//             ->getTransport(); 
//         $transport->sendMessage(); 
//         $this->inlineTranslation->resume(); 
//     }
// }


// for send the email to all customers .... already in database

    public function execute() 
    {
        $customerCollection = $this->customerCollectionFactory->create();

        $templateOptions = array('area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => 1); 
        $templateVars = []; 

        $this->inlineTranslation->suspend(); 

        foreach ($customerCollection as $customer) 
        {
            $customerId = $customer->getId();
            $customerEmail = $customer->getEmail();
            print_r("customerId:" . $customerId  .  "Email:" . $customerEmail)."<br>";
            
            $template = $this->scopeConfig->getValue('kitchen_email/try_email/kitchen_email_template', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

            $transport = $this->_transportBuilder->setTemplateIdentifier($template) 
                ->setTemplateOptions($templateOptions) 
                ->setTemplateVars($templateVars) 
                ->setFrom([ 
                    'name' => 'Test', 
                    'email' => "parikhaanchal12@gmail.com"  
                ]) 
                ->addTo([$customerEmail]) 

                ->getTransport(); 
            $transport->sendMessage(); 
            $this->inlineTranslation->resume(); 
        }
        }
    }