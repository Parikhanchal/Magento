<?php

namespace Acp\TryEmail\Controller\Mail;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $transportBuilder;
    protected $storeManager;
    protected $inlineTranslation;
    protected $_pageFactory;
 
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    )
    {
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $inlineTranslation;
        $this->_pageFactory = $pageFactory;
 
        parent::__construct($context);
    }
 
    public function execute()
    {
        $templateOptions = ['area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => $this->storeManager->getStore()->getId()];
        $templateVars = [
            'store' => $this->storeManager->getStore(),
            'customer_name' => 'aanchal',
            'message' => 'test email template!!.'
        ];
        $from = ['email' => 'test@g.com', 'name' => 'enni'];
        $this->inlineTranslation->suspend();
        $to = ['aanchal@g.com'];
        $transport = $this->transportBuilder->setTemplateIdentifier('Test_Email_template')
            ->setTemplateOptions($templateOptions)
            ->setTemplateVars($templateVars)
            ->setFrom($from)
            ->addTo($to)
            ->getTransport();
        $transport->sendMessage();
        $this->inlineTranslation->resume();
        
        return $this->_pageFactory->create();
    }
}
 