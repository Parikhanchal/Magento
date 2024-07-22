<?php
namespace Kitchen\Product\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Kitchen\Product\Model\AddressFactory;
use Magento\Framework\App\RequestInterface;

class SaveCustomer implements ObserverInterface
{
    protected $customerRepository;
    protected $cpaddressFactory;
    protected $request;

    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        AddressFactory $cpaddressFactory,
        RequestInterface $request
    ) {
        $this->customerRepository = $customerRepository;
        $this->cpaddressFactory = $cpaddressFactory;
        $this->request = $request;
    }

    public function execute(Observer $observer)
    {
        
        $kstreet = $this->request->getParam('kstreet');
        $kcity = $this->request->getParam('kcity');
        $kregion = $this->request->getParam('kregion');
        $kpostcode = $this->request->getParam('kpostcode');
        $kcountry = $this->request->getParam('kcountry');
        $customer = $observer->getEvent()->getCustomer();
        $customerID = $customer->getId();

        
        $this->saveToCustomTable($kstreet, $kcity, $kregion, $kpostcode, $kcountry , $customerID);
    }

    protected function saveToCustomTable($kstreet, $kcity, $kregion, $kpostcode, $kcountry , $customerID)
    {
        $addressModel = $this->cpaddressFactory->create();
        $addressModel->setStreet($kstreet);
        $addressModel->setCity($kcity);
        $addressModel->setRegion($kregion);
        $addressModel->setPostcode($kpostcode);
        $addressModel->setCountry($kcountry);
        $addressModel->setCustomerId($customerID);
        $addressModel->save();
    }
}

// Customer id save in observer: 
//  $customer = $observer->getEvent()->getCustomer();
//  $customerID = $customer->getId();
 
// $customerRecord->setCustomerId($customerID);