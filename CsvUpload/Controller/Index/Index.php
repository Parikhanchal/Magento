<?php
namespace Kitchen\CsvUpload\Controller\Index;
use Magento\Framework\UrlInterface;
class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_url;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		UrlInterface $url
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->_url = $url;
		return parent::__construct($context);
	}

	public function execute()
	{
		
        return $this->_pageFactory->create();
		
	}
}