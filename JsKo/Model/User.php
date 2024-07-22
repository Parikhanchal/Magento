<?php

namespace Task\JsKo\Model;

class User extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Task\JsKo\Model\ResourceModel\User::class);
    }
}
