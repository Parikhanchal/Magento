<?php

namespace Ap\Grid\Model\Config\Source;

class Hobbies implements \Magento\Framework\Option\ArrayInterface
{
    
    public function toOptionArray()
    {
        return [
            ['value' => 'Drawing', 'label' => __('Drawing')],
            ['value' => 'Camping', 'label' => __('Camping')],
            ['value' => 'Game', 'label' => __('Game')],
            ['value' => 'Dance', 'label' => __('Dance')],
            
           
        ];
    }
}
