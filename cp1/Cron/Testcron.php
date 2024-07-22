<?php

namespace Cp\User\Cron;

use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;


use \Cp\User\Helper\EmailHelper;


class TestCron {

    /**
     * Testcron constructor.
     * @param CollectionFactory $customerCollectionFactory
     */
    public function __construct(
        EmailHelper $helper

    ) {
        $this->helper = $helper;

    }

    /**
     * Retrieve customer collection and do something with it
     *
     * @return void
     */
    public function execute() {
        
        $this->helper->getData();

        // $toEmail= $this->scopeConfig->getValue('cp_email/email_group/cp_recipient_email', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        // $fromEmail= $this->scopeConfig->getValue('cp_email/email_group/cp_from_email', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        // $template= $this->scopeConfig->getValue('cp_email/email_group/cp_email_template', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        
         
              


          }
      
        }
    
    

