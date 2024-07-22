<?php
namespace Kitchen\Company\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\AddressFactory;
use Magento\Framework\App\RequestInterface;

class SaveCustomer implements ObserverInterface
{
    protected $customerRepository;
    protected $addressFactory;
    protected $request;

    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        AddressFactory $addressFactory,
        RequestInterface $request
    ) {
        $this->customerRepository = $customerRepository;
        $this->addressFactory = $addressFactory;
        $this->request = $request;
    }

    public function execute(Observer $observer)
    {
        
        $firstname = $this->request->getParam('firstname');
        $lastname = $this->request->getParam('lastname');
        $prefix = $this->request->getParam('prefix');
        $suffix = $this->request->getParam('suffix');
        $initial = $this->request->getParam('initial');
        $company = $this->request->getParam('company');
        $street = $this->request->getParam('street');
        // $country = $this->request->getParam('country');
        // $region = $this->request->getParam('region');
        $country = $this->request->getParam('country_id');
        if($this->request->getParam('region_id'))
        {
            $state = $this->request->getParam('region_id');    
        }
        else
        {
            $state = $this->request->getParam('region');
        }
        $city = $this->request->getParam('city');
        $pincode = $this->request->getParam('pincode');
        $telephone = $this->request->getParam('telephone');
        $vat = $this->request->getParam('vat');
        
        $customer = $observer->getEvent()->getCustomer();
        $customerID = $customer->getId();
        $customerType = $this->request->getParam('new_customer_attribute');

        if($customerType == 1)
        {
            $this->saveToCustomTable($firstname,$lastname, $prefix, $suffix, $initial, $company, $street ,$country ,$state ,$city ,$pincode ,$telephone ,$vat , $customerID);
        }
    }

    protected function saveToCustomTable($firstname, $lastname, $prefix, $suffix, $initial, $company, $street ,$country ,$state ,$city ,$pincode ,$telephone ,$vat , $customerID)
    {
        $addressModel = $this->addressFactory->create();
        $addressModel->setFirstname($firstname);
        $addressModel->setLastname($lastname);
        $addressModel->setPrefix($prefix);
        $addressModel->setSuffix($suffix);
        $addressModel->setMiddlename($initial);
        $addressModel->setCompany($company);
        $addressModel->setStreet($street);
        $addressModel->setCountryId($country);
        $addressModel->setRegion($state);
        $addressModel->setCity($city);
        $addressModel->setPostcode($pincode);
        $addressModel->setTelephone($telephone);
        $addressModel->setVatId($vat);

        $addressModel->setCustomerId($customerID);
        $addressModel->save();
    }
}
