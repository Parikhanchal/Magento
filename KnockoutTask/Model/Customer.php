<?php

namespace Kitchen\KnockoutTask\Model;

class Customer extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Kitchen\KnockoutTask\Model\ResourceModel\Customer::class);
    }
}
