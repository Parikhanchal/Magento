<?php
namespace Kitchen\CsvUpload\Block\Index;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $customerSession;
  protected $checkoutSession;


    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,

        
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        $this->checkoutSession   = $checkoutSession;

        parent::__construct($context, $data);
    }

    public function getCustomerId()
    {
        
        return $this->customerSession->getId();
    }
    public function getShipping()
    {
        return $this->checkoutSession->getQuote()->getShippingType();
        
    }
}