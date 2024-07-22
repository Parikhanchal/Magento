<?php
   
    namespace Kitchen\Company\Observer;
 
    use Magento\Framework\Event\ObserverInterface;
    use Magento\Framework\App\RequestInterface;
 
    // class CustomPrice implements ObserverInterface
    // {
    //     public function execute(\Magento\Framework\Event\Observer $observer) 
    //     {
    //         $item = $observer->getEvent()->getData('quote_item');         
    //         $item = ( $item->getParentItem() ? $item->getParentItem() : $item );

    //         $product = $item->getProduct();
    //         $priceType = $product->getData('custome_price_type_attribute');
    //         $originalPrice = $product->getPrice();
            
    //         if ($priceType == 1) { // Fixed price
    //             $customPrice = $product->getData('custome_price_attribute');
    //         } elseif ($priceType == 2) { // Percentage price
    //             $percentage = $product->getData('custome_price_attribute');
    //             $customPrice = $originalPrice + ($originalPrice * $percentage / 100);
    //         } else {
    //             // Default to original price if no custom price type is set
    //             $customPrice = $originalPrice;
    //         }
            
    //         $item->setCustomPrice($customPrice);
    //         $item->setOriginalCustomPrice($customPrice);
    //         $item->getProduct()->setIsSuperMode(true);
    //     }
 
    // }
    
    class CustomPrice implements ObserverInterface
    {
        protected $productRepository;
    
        public function __construct(
            \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
        ) {
            $this->productRepository = $productRepository;
        }
    
        public function execute(\Magento\Framework\Event\Observer $observer)
        {
            $item = $observer->getEvent()->getData('quote_item');
            $productId = $item->getProductId();
            
            try 
            {
                $product = $this->productRepository->getById($productId);
            } 
            catch (\Magento\Framework\Exception\NoSuchEntityException $e) 
            {
                return;
            }
            
            $priceType = $product->getData('custome_price_type_attribute');
            $customPrice = $product->getData('custome_price_attribute');
            
            $defaultPrice = $product->getFinalPrice();
            
            if ($priceType == 1) {
                $newPrice = $defaultPrice + $customPrice;
            } elseif ($priceType == 2) {
                $price = $defaultPrice * $customPrice / 100;
                $newPrice = $defaultPrice - $price;
            } else {
                $newPrice = $defaultPrice;
            }
    
            $item->setCustomPrice($newPrice);
            $item->setOriginalCustomPrice($newPrice);
            $item->getProduct()->setIsSuperMode(true);
        }
    }
    