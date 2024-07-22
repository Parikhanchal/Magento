<?php

namespace Kitchen\KnockoutTask\Model\ResourceModel\Customer;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'customer_id';
    protected function _construct()
    {
        $this->_init(
            \Kitchen\KnockoutTask\Model\Customer::class,
            \Kitchen\KnockoutTask\Model\ResourceModel\Customer::class
        );
    }
}

