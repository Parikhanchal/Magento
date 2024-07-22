<?php

namespace Kitchen\Product\Model;

class Customer extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Kitchen\Product\Model\ResourceModel\Customer::class);
    }
}
