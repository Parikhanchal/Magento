<?php

namespace Kitchen\KnockOut\Model\ResourceModel\Customer;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'customer_id';
    protected function _construct()
    {
        $this->_init(
            \Kitchen\KnockOut\Model\Customer::class,
            \Kitchen\KnockOut\Model\ResourceModel\Customer::class
        );
    }
}

