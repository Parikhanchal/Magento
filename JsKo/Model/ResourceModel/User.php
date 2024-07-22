<?php

namespace Task\JsKo\Model\ResourceModel;

class User extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('user_ko_registration', 'entity_id');
    }
}
