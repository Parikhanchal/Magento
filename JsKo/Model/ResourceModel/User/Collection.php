<?php

namespace Task\JsKo\Model\ResourceModel\User;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected function _construct()
    {
        $this->_init(
            \Task\JsKo\Model\User::class,
            \Task\JsKo\Model\ResourceModel\User::class
        );
    }
}

