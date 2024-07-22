<?php
namespace Acp\Shipping\Model\Carrier;
 
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Rate\Result;
use Magento\Checkout\Model\Session as CheckoutSession;
 
class NewShipping extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements \Magento\Shipping\Model\Carrier\CarrierInterface
{
    protected $_code = 'Newship';
    protected $_rateResultFactory;
    protected $_rateMethodFactory;
    protected $checkoutSession;
 
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        CheckoutSession $checkoutSession,
        array $data = []
    ) {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        $this->checkoutSession = $checkoutSession;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }
 
    public function getAllowedMethods()
    {
        return [$this->_code => $this->getConfigData('name')];
    }
 
    private function getShippingPrice()
    {
        $configPrice = $this->getConfigData('price');
        return $this->getFinalPriceWithHandlingFee($configPrice);
    }
 
    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }
 
        $result = $this->_rateResultFactory->create();
        $method = $this->_rateMethodFactory->create();
        
        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));
        $method->setMethod($this->_code);
        $method->setMethodTitle($this->getConfigData('name'));
 
        $amount = $this->getShippingPrice();
        $total = $this->getConfigData('applicable_price');
        
        $quote = $this->checkoutSession->getQuote();
        $customShipping = $quote->getData('custom_shipping');
 
        if ($customShipping == '1') {
            $amount *= 2;
        }
 
        // if ($request->getBaseSubtotalInclTax() > $total) {
        //     $amount = 0;
        // }
 
        $method->setPrice($amount);
        $method->setCost($amount);
 
        $result->append($method);
 
        return $result;
    }
}

// sale/delivery method