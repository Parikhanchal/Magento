<?php

namespace Cp\User\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;

class CustomConfig extends Template
{
    protected $scopeConfig;

    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getGridViewValue()
    {
        return $this->scopeConfig->getValue(
            'custom_fields/custom_field_general/grid_view',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getMultiSelectValue()
    {
        return $this->scopeConfig->getValue(
            'custom_fields/custom_field_general/category_multiselect',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getCustomButtonValue()
    {
        return $this->scopeConfig->getValue(
            'custom_fields/custom_field_general/listbutton',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getOptionsValue()
    {
        return $this->scopeConfig->getValue(
            'custom_fields/custom_field_general/dynamic_options',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getCutOffTimeValue()
    {
        return $this->scopeConfig->getValue(
            'custom_fields/custom_field_general/cutofftime',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
