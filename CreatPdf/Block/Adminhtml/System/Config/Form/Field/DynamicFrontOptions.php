<?php

namespace Kitchen\CreatPdf\Block\Adminhtml\System\Config\Form\Field;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Registry;

class DynamicFrontOptions extends AbstractFieldArray
{
    private $coreRegistry;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        array $data = []
    ) {
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    protected function _prepareToRender()
    {
        $this->addColumn(
            'sku',
            [
                'label' => __('SKU'),
                'class' => 'required-entry',
                'style' => 'width:200px'
            ]
        );

        $this->addColumn(
            'free_product',
            [
                'label' => __('Free Product SKU'),
                'class' => 'required-entry',
                'style' => 'width:300px',
            ]
        );

        $this->addColumn(
            'sort_order',
            [
                'label' => __('Sort Order'),
                'class' => 'required-entry',
                'style' => 'width:100px',
            ]
        );

        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add More');
    }

    protected function _prepareArrayRow(DataObject $row): void
    {
        $options = [];
        $row->setData('option_extra_attrs', $options);
    }
}
