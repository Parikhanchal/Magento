<?php

namespace Kitchen\CsvUpload\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Checkout\Model\Cart;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Exception\LocalizedException;

class AddToCart extends Action
{
    protected $cart;
    protected $productRepository;
    protected $resultJsonFactory;
    protected $messageManager;

    public function __construct(
        Context $context,
        Cart $cart,
        ProductRepository $productRepository,
        JsonFactory $resultJsonFactory,
        ManagerInterface $messageManager
    ) {
        parent::__construct($context);
        $this->cart = $cart;
        $this->productRepository = $productRepository;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->messageManager = $messageManager;
    }

    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();

        try {
            $items = json_decode($this->getRequest()->getContent(), true)['items'];
            if($items){

                foreach ($items as $item) {
                    $sku = $item['sku'];
                    $qty = $item['qty'];

                    $product = $this->productRepository->get($sku);

                    $params = [
                        'product' => $product->getId(),
                        'qty' => $qty
                    ];

                    $this->cart->addProduct($product, $params);
                }
            $this->cart->save();
            $this->messageManager->addSuccessMessage(__('Products successfully added to cart.'));
            return $resultJson->setData(['success' => true, 'message' => __('Products added to cart.')]);
            }
            $this->messageManager->addErrorMessage(__('We can\'t add these items to your shopping cart right now.'));
            return $resultJson->setData(['success' => false, 'message' => __('We can\'t add these items to your shopping cart right now.')]);
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $resultJson->setData(['success' => false, 'message' => $e->getMessage()]);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('We can\'t add these items to your shopping cart right now.'));
            return $resultJson->setData(['success' => false, 'message' => __('We can\'t add these items to your shopping cart right now.')]);
        }
    }
}
