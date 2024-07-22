<?php

namespace Kitchen\CsvUpload\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Checkout\Model\Cart;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Message\ManagerInterface;


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

    //     $resultJson = $this->resultJsonFactory->create();
    //     $sku = $this->getRequest()->getParam('sku');
    //     $qty = $this->getRequest()->getParam('qty', 1);

    //     try {
    //         $product = $this->productRepository->get($sku);

    //         $params = [
    //             'product' => $product->getId(),
    //             'qty' => $qty,
    //         ];

    //         $this->cart->addProduct($product, $params);
    //         $this->cart->save();
    //         $this->messageManager->addSuccessMessage("$sku successfully added to cart.");


    //         return $resultJson->setData(['success' => true, 'message' => __('Product added to cart.')]);
    //     } 
    //     catch (LocalizedException $e) {
    //         return $resultJson->setData(['success' => false, 'message' => $e->getMessage()]);
    //     } 
    //     catch (\Exception $e) {
    //         return $resultJson->setData(['success' => false, 'message' => __('Cannot add the item to shopping cart.')]);
    //     }
    // }
    
        $resultJson = $this->resultJsonFactory->create();
        $selectedSkus = $this->getRequest()->getParam('skus', []);

        try {
            foreach ($selectedSkus as $selectedSku) {
                // Assuming $selectedSku is in the format 'category-sku'
                list($categoryLabel, $sku) = explode('-', $selectedSku);
    
                // Retrieve product by SKU
                $product = $this->productRepository->get($sku);
    
                // Prepare params for adding to cart
                $params = [
                    'product' => $product->getId(),
                    'qty' => 1, // Default quantity, adjust as necessary
                ];
    
                // Add product to cart
                $this->cart->addProduct($product, $params);
            }

            // Save cart after all products are added
            $this->cart->save();

            // Add success message
            $this->messageManager->addSuccessMessage(__('Products successfully added to cart.'));

            return $resultJson->setData(['success' => true, 'message' => __('Products added to cart.')]);
        } catch (LocalizedException $e) {
            return $resultJson->setData(['success' => false, 'message' => $e->getMessage()]);
        } catch (\Exception $e) {
            return $resultJson->setData(['success' => false, 'message' => __('Cannot add products to shopping cart.')]);
        }
    }
}
               