<?php
namespace Kitchen\Company\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class CustomRadioAttr extends AbstractSource
{
    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        return [
            ['value' => 1, 'label' => __('Italian')],
            ['value' => 2, 'label' => __('Mexican')],
            ['value' => 3, 'label' => __('Chinese')],
        ];
    }
}
?>

