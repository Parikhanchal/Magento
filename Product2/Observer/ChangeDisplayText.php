<?php

namespace Kitchen\Product\Observer;

//<-- FOR EVENT Dispatch -->
class ChangeDisplayText implements \Magento\Framework\Event\ObserverInterface
{
	public function execute(\Magento\Framework\Event\Observer $observer)
	{
		$displayText = $observer->getData('try_text');
		echo $displayText->getText() . " - hello event </br>";
		$displayText->setText(' event successfully.');

		return $this;
	}
}