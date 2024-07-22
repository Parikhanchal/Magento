<?php

namespace Kitchen\Product\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory)
	{
		$this->_pageFactory = $pageFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		// echo "hello world";
		return $this->_pageFactory->create();

		
	}

// 	public function show()
// 	{
// 		echo "eeeeeeeeeeeeee";
// 		return $this->galleryFactory>create()->getCollection();
// 	}
}
