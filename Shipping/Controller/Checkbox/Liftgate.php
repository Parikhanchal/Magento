<?php

namespace Kitchen\Shipping\Controller\Checkbox;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Quote\Model\QuoteFactory;

class Liftgate extends Action
{
    protected $resultJsonFactory;
    protected $checkoutSession;
 
    protected $quoteFactory;
 
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        CheckoutSession $checkoutSession,
        QuoteFactory $quoteFactory,
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->quoteFactory = $quoteFactory;
        $this->checkoutSession = $checkoutSession;
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();

        try {
            $jsonData = $this->getRequest()->getContent();
            $data = json_decode($jsonData, true);

            if (!isset($data['value'])) {
                throw new LocalizedException(__('Required parameter "value" is missing.'));
            }

            $liftgate = $data['value'];

            $quote = $this->checkoutSession->getQuote();
            $quote->setData('custom_liftgate', $liftgate);
            $quote->save();

            return $result->setData(['success' => true, 'message' => 'Liftgate shipping updated.']);
        } catch (\Exception $e) {
            return $result->setData(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
