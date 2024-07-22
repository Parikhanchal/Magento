<?php

declare(strict_types=1);
namespace Kitchen\CreatPdf\Plugin;

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
            // echo 1 ; exit;
            $order = $context->getOrder();
        }

        if ($order) {
        	$url = $context->getUrl('cpdf/index/export');
            
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