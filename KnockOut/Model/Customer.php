<?php

namespace Kitchen\KnockOut\Model;

class Customer extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Kitchen\KnockOut\Model\ResourceModel\Customer::class);
    }
}
