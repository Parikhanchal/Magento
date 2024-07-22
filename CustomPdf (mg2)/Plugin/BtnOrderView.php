<?php

declare(strict_types=1);
namespace Kitchen\CustomPdf\Plugin;

use Magento\Sales\Block\Adminhtml\Order\Create;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Backend\Block\Widget\Button\ButtonList;
use Magento\Backend\Block\Widget\Button\Toolbar as ToolbarContext;

class BtnOrderView
{
    /**
     * @param ToolbarContext $toolbar
     * @param AbstractBlock $context
     * @param ButtonList $buttonList
     * @return array
     */
    public function beforePushButtons(
        ToolbarContext $toolbar,
        AbstractBlock $context,
        ButtonList $buttonList
    ): array {
        $order = false;
        $nameInLayout = $context->getNameInLayout();
        if ('sales_order_edit' == $nameInLayout) {
            $order = $context->getOrder();
        }

        if ($order) {
        	$url = $context->getUrl('cpdf/index/export');
            // $url = $context->getUrl('custompdf/index/export', ['order_id' => $order->getId()]);
	        $buttonList->add(
	            'order_pickpacklist',
	            [
	                'label' => __('Pick Pack List'),
	            	'on_click' => sprintf("location.href = '%s';", $url),
	                'id' => 'order_pickpacklist'
	            ]
	        );
        }

        return [$context, $buttonList];        
    }
}