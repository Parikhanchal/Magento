<?php

namespace Kitchen\Shipping\Controller\Checkbox;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Checkout\Model\Session as CheckoutSession;

class Delivery extends Action
{
    protected $resultJsonFactory;
    protected $checkoutSession;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        CheckoutSession $checkoutSession
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
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

            $delivery = $data['value'];

            $quote = $this->checkoutSession->getQuote();
            $quote->setData('custom_delivery', $delivery);
            $quote->save();

            return $result->setData(['success' => true, 'message' => 'Delivery shipping updated.']);
        } catch (\Exception $e) {
            return $result->setData(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
