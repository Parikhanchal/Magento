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
    type: 'AllCustomerPayOffline',
    component: 'Kitchen/Payment/js/view/payment/method-renderer/AllCustomerPayOffline-method'
    }
    );
    /** Add view logic here if needed */
    return Component.extend({});
    }
    );