<?php

namespace Kitchen\KnockoutTask\Block;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Kitchen\KnockoutTask\Model\CustomerFactory;

class Custom extends \Magento\Framework\View\Element\Template implements ArgumentInterface
{
	public function __construct(\Magento\Framework\View\Element\Template\Context $context,
	CustomerFactory $customerFactory
    )
	{
		parent::__construct($context);
		$this->customerFactory = $customerFactory;
	}

	public function custom()
	{
		
		$model = $this->customerFactory->create();
        $collection = $model->getCollection();
		foreach ($collection as $item) {
            echo "<tr>";
            echo '<td>'. $item->getCustomerId(). '</td>';
            echo '<td>'. $item->getFirstName(). '</td>';
            echo '<td>'. $item->getLastName(). '</td>';
            echo '<td>'. $item->getEmail(). '</td>';
            echo '<td>'. $item->getGender(). '</td>';
            echo "</tr>";
        }

	}

}
