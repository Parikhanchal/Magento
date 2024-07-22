<?php

namespace Ap\Grid\Model\Config\Source;

use Ap\Grid\Model\CustomerFactory;

class Promo implements \Magento\Framework\Option\ArrayInterface
{
    protected $customerFactory;

    public function __construct(
        CustomerFactory $customerFactory
    ) {
        $this->customerFactory = $customerFactory;
    }

    public function toOptionArray()
    {
        return [
            ['value' => '0', 'label' => 'Not Active'],
            ['value' => '1', 'label' => 'Active'],
        ];
    }
}