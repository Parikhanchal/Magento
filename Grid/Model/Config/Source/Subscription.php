<?php

namespace Ap\Grid\Model\Config\Source;

use Ap\Grid\Model\CustomerFactory;

class Subscription implements \Magento\Framework\Option\ArrayInterface
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
            ['value' => '1', 'label' => 'yes'],
            ['value' => '0', 'label' => 'no']
        ];
    }
}