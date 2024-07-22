<?php

namespace Ap\Grid\Model\ResourceModel\Customer;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected function _construct()
    {
        $this->_init(
            \Ap\Grid\Model\Customer::class,
            \Ap\Grid\Model\ResourceModel\Customer::class
        );
    }
}

