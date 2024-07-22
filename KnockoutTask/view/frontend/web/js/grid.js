define([
    'jquery',
    'ko',
    'uiComponent'
], function ($, ko, Component) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Kitchen_KnockoutTask/grid'
        },
        initialize: function () {
            this._super();
            this.gridData = ko.observableArray([]);
            this.loadData();
            return this;
        },
        loadData: function () {
            // Fetch data via AJAX or from Magento backend
            var data = [
                { column1: 'Data 1', column2: 'Data A' },
                { column1: 'Data 2', column2: 'Data B' },
                // Add more data as needed
            ];
            this.gridData(data);
        }
    });
});
