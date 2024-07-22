<?php
namespace Cp\User\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Json\EncoderInterface;
use Magento\Framework\Json\DecoderInterface;
use Magento\Framework\Controller\Result\JsonFactory;

class Hello extends \Magento\Framework\App\Action\Action
{
    protected $jsonEncoder;
    protected $jsonDecoder;
    protected $jsonFactory;

    public function __construct(
        Context $context,
        EncoderInterface $jsonEncoder,
        DecoderInterface $jsonDecoder,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->jsonEncoder = $jsonEncoder;
        $this->jsonDecoder = $jsonDecoder;
        $this->jsonFactory = $jsonFactory;
    }

    public function execute()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'age' => 30,
            'is_active' => true,
            'address' => [
                'street' => '123 Main St',
                'city' => 'Anytown',
                'country' => 'USA'
            ]
        ];

        $jsonString = $this->jsonEncoder->encode($data);
		print_r($jsonString);
		// die;
        $decodedData = $this->jsonDecoder->decode($jsonString);
		print_r($decodedData);
		die;
        // Returning JSON response with decoded data
       // $resultJson = $this->jsonFactory->create();
        
		return $resultJson->setData($decodedData);
    }
}
