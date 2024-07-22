<?php
namespace Kitchen\Company\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class CustomCheckboxAttr extends AbstractSource
{
    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        return [
            ['value' => 1, 'label' => __('Mushrooms')],
            ['value' => 2, 'label' => __('Cheese')],
            ['value' => 3, 'label' => __('Tomatoes')],
            ['value' => 4, 'label' => __('Olives')],
        ];
    }
}
?>

