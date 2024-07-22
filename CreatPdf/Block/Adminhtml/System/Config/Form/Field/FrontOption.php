<?php
declare(strict_types=1);

namespace Kitchen\CreatPdf\Block\Adminhtml\System\Config\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Kitchen\CreatPdf\Block\Adminhtml\System\Config\Form\Field;

class FrontOption extends AbstractFieldArray
{
    /**
     * @var DynamicColumn
     */
    private $dynamicRenderer;

    /**
     * Prepare rendering the new field by adding all the needed columns
     */
    protected function _prepareToRender()
    {
        $this->addColumn('from_qty', ['label' => __('SKU'), 'class' => 'required-entry']);
        $this->addColumn('to_qty', ['label' => __('Free Product SKU'), 'class' => 'required-entry']);
        $this->addColumn('price', ['label' => __('Sort Order'), 'class' => 'required-entry']);

        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    /**
     * Prepare existing row data object
     *
     * @param DataObject $row
     * @throws LocalizedException
     */
    protected function _prepareArrayRow(DataObject $row): void
    {
        $options = [];

        $dynamic = $row->getDynamic();
        if ($dynamic !== null) {
            $options['option_' . $this->getDynamicRenderer()->calcOptionHash($dynamic)] = 'selected="selected"';
        }

        $row->setData('option_extra_attrs', $options);
    }

    /**
     * Get dynamic renderer
     *
     * @return DynamicColumn
     * @throws LocalizedException
     */
    private function getDynamicRenderer()
    {
        if (!$this->dynamicRenderer) {
            $this->dynamicRenderer = $this->getLayout()->createBlock(
                DynamicColumn::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->dynamicRenderer;
    }
}
