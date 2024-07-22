<?php

namespace Kitchen\Notice\Model\ResourceModel;

class Notify extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('Kitchen_notice', 'notice_id');
    }
}
