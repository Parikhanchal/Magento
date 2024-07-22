<?php

namespace Ap\Grid\Model\Config\Source;

use Ap\Grid\Model\CustomerFactory;

class Gender implements \Magento\Framework\Option\ArrayInterface
{
    protected $CustomerFactory;

    public function __construct(
        CustomerFactory $CustomerFactory
    ) {
        $this->CustomerFactory = $CustomerFactory;
    }

    public function toOptionArray()
    {
        return [
            ['value' => 'Male', 'label' => 'Male'],
            ['value' => 'Female', 'label' => 'Female'],
        ];
    }
}