<?php

namespace Kitchen\Company\Block;

use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $customerFactory;
    protected $urlBuilder;
    protected $timezoneInterface;
	
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        CustomerFactory $customerFactory,
        UrlInterface $urlBuilder,
        TimezoneInterface $timezoneInterface
    ) {
        $this->customerFactory = $customerFactory;
        $this->urlBuilder = $urlBuilder;
        $this->timezoneInterface = $timezoneInterface;
        parent::__construct($context);
    }
 
    public function display()
    {
        // $userStatus = $this->getRequest()->getParam('user_status');
        // $sorting = $this->getRequest()->getParam('sorting');

        $model = $this->customerFactory->create();
        $collection = $model->getCollection();

        foreach ($collection as $item) {
            echo "<tr>";
            echo "<td>".$item->getParentId()."</td>";
            echo "<td>".$item->getEntityId()."</td>";
            echo "<td>".$item->getFirstname()."</td>";
            echo "<td>".$item->getLastname()."</td>";
            echo "<td>".$item->getEmail()."</td>";

            echo "<td><a href='".$this->urlBuilder->getUrl('user/staff/newpage', ['entity_id' => $item->getEntityId()])."'>Edit</a></td>";
            echo "<td><a href='".$this->urlBuilder->getUrl('user/staff/delete', ['entity_id' => $item->getEntityId()])."'>Delete</a></td>";
            echo "</tr>";
        }
    }

}