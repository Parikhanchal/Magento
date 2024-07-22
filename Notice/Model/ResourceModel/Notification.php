<?php

namespace Kitchen\Notice\Model\ResourceModel;

class Notification extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('Kitchen_notification', 'notification_id');
    }
}
