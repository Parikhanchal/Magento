<?php
namespace Kitchen\Company\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class CustomPriceType extends AbstractSource
{
    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        // Your custom logic to fetch options
        return [
            ['value' => 1, 'label' => __('Fixed')],
            ['value' => 2, 'label' => __('Percentage')],
        ];
    }
}
