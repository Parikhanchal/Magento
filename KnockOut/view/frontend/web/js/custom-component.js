define(['jquery', 'uiComponent', 'ko'], function ($, Component, ko) {
    'use strict';
    
    return Component.extend({
        defaults: {
            template: 'Kitchen_KnockOut/knockout-test'
        },
        
        initialize: function () {
            this.customerName = ko.observableArray([]);
            this.customerData = ko.observable('');
            this._super();
        },
 
        removeCustomer: function() {
            this.customerName.pop();
        },
 
        addNewCustomer: function () {
            this.customerName.push({name:this.customerData()});
            this.customerData('');
        },
        
        removeCustomerAtIndex: function(index) {
            if (index >= 0 && index < this.customerName().length) {
                this.customerName.splice(index, 1);
            }
        }
    });
});
