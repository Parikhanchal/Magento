<?php

namespace Ap\Cron\Cron;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;

class TestCron
{
    private $resourceConnection;
    private $adapter;
    private $dateTime;

    public function __construct(ResourceConnection $resourceConnection, AdapterInterface $adapter, DateTime $dateTime)
    {
        $this->resourceConnection = $resourceConnection;
        $this->adapter = $adapter;
        $this->dateTime = $dateTime;
    }

    public function execute()
    {
        $tableName = $this->resourceConnection->getTableName('kitchen_cron');
        $data = ['created_at' => $this->dateTime->gmtDate()];
        $this->adapter->insert($tableName, $data);
    }
}
