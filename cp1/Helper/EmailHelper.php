<?php

namespace Cp\User\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Mail\Template\TransportBuilder; // Add this use statement

class EmailHelper extends AbstractHelper
{
    protected $customerCollectionFactory;
    protected $inlineTranslation;
    protected $_transportBuilder; // Declare the property for TransportBuilder

    public function __construct(
        Context $context,
        CollectionFactory $customerCollectionFactory,
        StateInterface $inlineTranslation, // Inject InlineTranslation
        TransportBuilder $transportBuilder // Inject TransportBuilder
    )
    {
        $this->customerCollectionFactory = $customerCollectionFactory;
        $this->inlineTranslation = $inlineTranslation; // Assign InlineTranslation
        $this->_transportBuilder = $transportBuilder; // Assign TransportBuilder
        parent::__construct($context);
    }

    public function getData()
    {
        $customerCollection = $this->customerCollectionFactory->create();
        $templateOptions = array('area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => 1);
        

        $fromEmail= $this->scopeConfig->getValue('cp_email/email_group/cp_from_email', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $template= $this->scopeConfig->getValue('cp_email/email_group/cp_email_template', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        $this->inlineTranslation->suspend();

        foreach ($customerCollection as $customer) {
            $customerId = $customer->getId();
            $customerName = $customer->getName();
            $customerEmail = $customer->getEmail();
            print_r("Customer Id:" . $customerId . "= " . $customerEmail) . "<br>";
            $transport = $this->_transportBuilder->setTemplateIdentifier($template)
                ->setTemplateOptions($templateOptions)
                ->setTemplateVars([
                    'name' => $customerName,
                    'email' => $customerEmail,
                    'cpLogo'=>'<img src="{{media url="wysiwyg/email.jpg"}}" alt="" />'
                ])
                ->setFrom([
                    'name' => 'Test',
                    'email' => $fromEmail
                ])
                ->addTo([$customerEmail])
                ->addCc(['customerone@gmail.com'])

                // ->addBcc(['parikhaanchal12@gmail.com'])
                ->getTransport();
            $transport->sendMessage();
        }

        $this->inlineTranslation->resume(); // Move this outside the loop
    }
}
