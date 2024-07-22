<?php

namespace Kitchen\Notice\Model\ResourceModel\Notify;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'notice_id';
    protected function _construct()
    {
        $this->_init(
            \Kitchen\Notice\Model\Notify::class,
            \Kitchen\Notice\Model\ResourceModel\Notify::class
        );
    }
}

