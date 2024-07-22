<?php

namespace Kitchen\Shipping\Controller\Index;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Quote\Model\QuoteFactory;
use Magento\Quote\Api\CartManagementInterface;
use Magento\Quote\Model\QuoteRepository;

class SaveShippingOption extends Action
{
    protected $resultJsonFactory;
    protected $customerSession;
    protected $quoteFactory;
    protected $cartManagementInterface;
    protected $quoteRepository;
 
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        CustomerSession $customerSession,
        QuoteFactory $quoteFactory,
        CartManagementInterface $cartManagementInterface,
        QuoteRepository $quoteRepository
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->customerSession = $customerSession;
        $this->quoteFactory = $quoteFactory;
        $this->cartManagementInterface = $cartManagementInterface;
        $this->quoteRepository = $quoteRepository;
    }
 
    public function execute()
    {
        $result = $this->resultJsonFactory->create();

        $jsonData = $this->getRequest()->getContent();
        $data = json_decode($jsonData, true);

        $shipValue = '';
        if (isset($data['value'])) {
            $shipValue = $data['value'];
        }

        // for save data with email id(all data save(all filds))
        $customer = $this->customerSession->getCustomerDataObject();
        $customerId = $customer->getId();

        $quoteId = $this->cartManagementInterface->createEmptyCartForCustomer($customerId);
        $quote  = $this->quoteRepository->getActive($quoteId);

        $quote->setData('custom_shipping_type', $shipValue);
        $this->quoteRepository->save($quote);


        // for save datain data bse with out email and id

        // $quote= $this->quoteFactory->create();
        // // Set the custom_shipping_type
        // $quote->setCustomShippingType($shipValue);
        // // Save the quote
        // $quote->save();

        // Prepare JSON response
        $result->setData([
            'success' => true,
            'message' => 'Shipping type updated successfully.'
        ]);

        return $result;
    }
}
