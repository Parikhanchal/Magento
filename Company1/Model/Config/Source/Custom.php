<?php
namespace Kitchen\Company\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Custom extends AbstractSource
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
            ['label' => 'Individual', 'value' => __('Option 1')],
            ['label' => 'Company', 'value' => __('Option 2')],
        ];
    }
}
