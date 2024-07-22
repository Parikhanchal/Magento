define(
    [
    'uiComponent',
    'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
    Component,
    rendererList
    ) {
    'use strict';
    rendererList.push(
    {
    type: 'KitchenPayOffline',
    component: 'Kitchen_Payment/js/view/payment/method-renderer/KitchenPayOffline-method'
    }
    );
    /** Add view logic here if needed */
    return Component.extend({});
    }
    );