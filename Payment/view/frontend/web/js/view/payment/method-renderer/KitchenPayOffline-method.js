define(
    [
        'Magento_Checkout/js/view/payment/default'
    ],
    function (Component) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Kitchen_Payment/payment/KitchenPayOffline'
            },
            /** Returns send check to info */
            getMailingAddress: function () {
                return window.checkoutConfig.payment.KitchenPayOffline.mailingAddress;
            },
            /** Returns payable to info */
            /*getPayableTo: function() {
            return window.checkoutConfig.payment.checkmo.payableTo;
            }*/
        });
    }
);
