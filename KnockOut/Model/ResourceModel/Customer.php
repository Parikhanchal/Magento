<?php

namespace Kitchen\KnockOut\Model\ResourceModel;

class Customer extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('customer', 'customer_id');
        // $this->_init('kitchen_product', 'entity_id');
    }
}
