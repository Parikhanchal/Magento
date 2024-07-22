<?php

namespace Kitchen\Notice\Model;

class Notify extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Kitchen\Notice\Model\ResourceModel\Notify::class);
    }
}
