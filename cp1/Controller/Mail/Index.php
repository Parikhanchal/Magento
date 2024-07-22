<?php
namespace Cp\User\Controller\Mail;
use Magento\Framework\UrlInterface;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Mail\Template\TransportBuilder; 
class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_url;
	protected $inlineTranslation;
    protected $_transportBuilder; 

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		UrlInterface $url,
		StateInterface $inlineTranslation, // Inject InlineTranslation
        TransportBuilder $transportBuilder 
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->_url = $url;
		$this->inlineTranslation = $inlineTranslation; 
        $this->_transportBuilder = $transportBuilder; 
		return parent::__construct($context);
	}

	public function execute()
	{
		$templateOptions = array('area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => 1); 
		$templateVars = [];  
		$this->inlineTranslation->suspend(); 
		$transport = $this->_transportBuilder->setTemplateIdentifier('cp_email_email_group_cp_email_template') 
			->setTemplateOptions($templateOptions) 
			->setTemplateVars($templateVars) 
			->setFrom([ 
				'name' => 'Test', 
				'email' => 'Mohammed.yamin@kitchen365.com' 
			]) 
		->addTo(['pradipsinh.jadeja@kitchen365.com']) 
			->getTransport(); 
		$transport->sendMessage(); 
		$this->inlineTranslation->resume(); 		
	}
}