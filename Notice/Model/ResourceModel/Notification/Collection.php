<?php

namespace Kitchen\Notice\Model\ResourceModel\Notification;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'notification_id';
    protected function _construct()
    {
        $this->_init(
            \Kitchen\Notice\Model\Notification::class,
            \Kitchen\Notice\Model\ResourceModel\Notification::class
        );
    }
}
