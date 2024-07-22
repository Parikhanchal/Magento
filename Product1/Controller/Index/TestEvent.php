<?php
  
namespace Kitchen\Product\Controller\Index;
        
class TestEvent extends \Magento\Framework\App\Action\Action
{
        
    public function execute()
    {
        $textDisplay = new \Magento\Framework\DataObject(array('text' => 'welcome'));
        $this->_eventManager->dispatch('kitchen_product_display_text', ['try_text' => $textDisplay]);
        echo $textDisplay->getText();
        exit;
    }
}


