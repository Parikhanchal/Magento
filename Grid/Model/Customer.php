<?php

namespace Ap\Grid\Model;

class Customer extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Ap\Grid\Model\ResourceModel\Customer::class);
    }
}
