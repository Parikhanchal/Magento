<?php
namespace Kitchen\Company\Block;

class Newproduct extends \Magento\Framework\View\Element\Template
{
	protected $customerSession;
	protected $productFactory;

	public function __construct(\Magento\Framework\View\Element\Template\Context $context,
	\Magento\Customer\Model\Session $customerSession,
	\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productFactory,
        array $data = []
	)
	{
		parent::__construct($context, $data);
		$this->customerSession = $customerSession;
		$this->productFactory = $productFactory;
		
	}

	public function sayHello()
	{
		return __('Hello World');
	}
	public function getIds()
	{
		
		$customer = $this->customerSession->getCustomer()->getId();
		return $customer;
	}
	

    // public function getProductCollection()
    // {
    //     $collection = $this->productFactory->create();
    //     $collection->addAttributeToFilter('status', \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
    //     $collection->addAttributeToFilter('visibility', \Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH);

    //     return $collection;
    }
// }

