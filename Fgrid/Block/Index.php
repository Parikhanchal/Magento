<?php

namespace Ap\Fgrid\Block;

use Magento\Framework\UrlInterface;
use Ap\Grid\Model\CustomerFactory;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $customerFactory;
    protected $urlBuilder;
 
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        CustomerFactory $customerFactory,
        UrlInterface $urlBuilder
    ) {
        $this->customerFactory = $customerFactory;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context);
    }
 
    public function display()
    {
        $userStatus = $this->getRequest()->getParam('user_status');
        $sorting = $this->getRequest()->getParam('sorting');

        $model = $this->customerFactory->create();
        $collection = $model->getCollection();

        if ($userStatus !== null && $userStatus !== 'all') {
            $collection->addFieldToFilter('is_active', $userStatus);
        }

        if ($sorting !== null && ($sorting === 'ASC' || $sorting === 'DESC')) {
            $collection->setOrder('entity_id', $sorting);
        }

        foreach ($collection as $item) {
            echo "<tr>";
            echo "<td>".$item->getEntityId()."</td>";
            echo "<td>".$item->getName()."</td>";
            echo "<td>".$item->getEmail()."</td>";
            echo "<td>".$item->getGender()."</td>";
            echo "<td>".$item->getBirthDate()."</td>";
            echo "<td>".$item->getIsActive()."</td>";
            // echo "<td><a href='".$this->urlBuilder->getUrl('user1/index/index', ['entity_id' => $item->getEntityId()])."'>Edit</a></td>";
            // echo "<td><a href='".$this->urlBuilder->getUrl('user1/index/delete', ['entity_id' => $item->getEntityId()])."'>Delete</a></td>";
            echo "</tr>";
        }
    }

}