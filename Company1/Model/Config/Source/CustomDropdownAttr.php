<?php
namespace Kitchen\Company\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class CustomDropdownAttr extends AbstractSource
{
    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        return [
            ['value' => 1, 'label' => __('Vegetarian')],
            ['value' => 2, 'label' => __('Non-Vegetarian')],
        ];
    }
}
?>

