<?php

namespace Kitchen\Notice\Model;

class Notification extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Kitchen\Notice\Model\ResourceModel\Notification::class);
    }
}
