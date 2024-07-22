<?php
namespace Cp\User\Block\Adminhtml\UserGrid;

class IsActiveFilter extends \Magento\Backend\Block\Widget\Grid\Column\Filter\Select
{
    protected function _getOptions()
    {
        return [
            ['value' => '1', 'label' => __('Yes')],
            ['value' => '0', 'label' => __('No')]
        ];
    }
}
