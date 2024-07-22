<?php

namespace Kitchen\Product\Observer;

class Eventtest implements \Magento\Framework\Event\ObserverInterface {
    
    protected $request;

    public function __construct(
        \Magento\Framework\App\Request\Http $request
    ) {
        $this->request = $request;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) {
    //    echo "<pre>";
    //    print_r(get_class_methods($this->request));
    //    echo "</pre>";

       // echo ($this->request->getRouteName() . "_" . $this->request->getControllerName() . "_" . $this->request->getActionName());
    }
}
