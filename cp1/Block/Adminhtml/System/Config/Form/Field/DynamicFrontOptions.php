<?php

namespace Cp\User\Block\Adminhtml\System\Config\Form\Field;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Registry;

class DynamicFrontOptions extends AbstractFieldArray
{
    private $holidaysRenderer;
    private $dateRenderer;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        array $data = []
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    protected function _prepareToRender()
    {

        $this->addColumn(
            'select_date',
            [
                'label' => __('Date'),
                'id' => 'select_date',
                'class' => 'daterecuring',
                'style' => 'width:200px'
            ]
        );

        $this->addColumn(
            'date_title',
            [
                'label' => __('Content'),
                'class' => 'required-entry',
                'style' => 'width:300px',
            ]
        );

        $this->_addAfter = false;
        $this->_addButtonLabel = __('MoreAdd');
    }

    protected function _prepareArrayRow(DataObject $row): void
    {
        $options = [];
        $row->setData('option_extra_attrs', $options);
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $html = parent::_getElementHtml($element);

        $script = '<script type="text/javascript">
                require(["jquery", "jquery/ui", "mage/calendar"], function (jq) {
                    jq(function(){
                        function bindDatePicker() {
                            setTimeout(function() {
                                jq(".daterecuring").datepicker( { dateFormat: "mm/dd/yy" } );
                            }, 50);
                        }
                        bindDatePicker();
                        jq("button.action-add").on("click", function(e) {
                            bindDatePicker();
                        });
                    });
                });
            </script>';
        $html .= $script;
        return $html;
    }
}