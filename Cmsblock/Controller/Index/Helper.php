<?php

namespace Ap\Cmsblock\Controller\Index;

class Helper extends \Magento\Framework\App\Action\Action
{

    protected $helperData;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Ap\Cmsblock\Helper\HelpData $helperData
    ) {
        $this->helperData = $helperData;
        parent::__construct($context);
    }

    public function execute()
    {
        echo $this->helperData->data(); 
        return;
    }
}
