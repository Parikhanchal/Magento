<?php

namespace Kitchen\Product\Model\ResourceModel\Cron;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'schedule_id';
    protected function _construct()
    {
        $this->_init(
            \Kitchen\Product\Model\Cron::class,
            \Kitchen\Product\Model\ResourceModel\Cron::class
        );
    }
}

