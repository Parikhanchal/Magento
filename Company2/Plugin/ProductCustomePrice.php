<?php

namespace Kitchen\Company\Plugin;

class ProductCustomePrice
{
//     protected $productRepository;

//     public function __construct(
//         \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
//     ) {
//         $this->productRepository = $productRepository;
//     }

//     public function afterGetFinalPrice(\Magento\Catalog\Model\Product $subject, $result)
//     {
//         $productId = $subject->getId();
//         $product = $this->productRepository->getById($productId);

//         $priceType = $product->getCustomPriceType();
//         $customPrice = $product->getData('custom_price_field');

//         $defaultPrice = $result;

//         if ($priceType == 0) {
//             $newPrice = $defaultPrice + $customPrice;
//         } elseif ($priceType == 1) {
//             $price = $defaultPrice * $customPrice / 100;
//             $newPrice = $defaultPrice - $price;
//         } else {
//             $newPrice = $defaultPrice;
//         }

//         return $newPrice;
//     }
}
