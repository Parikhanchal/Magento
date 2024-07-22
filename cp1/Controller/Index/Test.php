<?php

namespace Cp\User\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{

	public function execute()
	{
		$textDisplay = new \Magento\Framework\DataObject(array('text' => 'Yamin'));
		$this->_eventManager->dispatch('user_event_dispatch', ['user_text' => $textDisplay]);
		echo $textDisplay->getText();
		exit;
	}
}