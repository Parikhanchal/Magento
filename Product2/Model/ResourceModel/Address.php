<?php

namespace Kitchen\Product\Model\ResourceModel;

class Address extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('kcustomer', 'entity_id');
        // $this->_init('kitchen_product', 'entity_id');
    }
}
