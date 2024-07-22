define([
    'jquery',
    'ko',
    'uiComponent',
    'Kitchen_KnockOut/js/view/grid/price'
], function ($, ko, component, priceRender) {
    "use strict";
    
    return component.extend({
        items: ko.observableArray([]),
        columns: ko.observableArray([]),
        defaults: {
            template: 'Kitchen_KnockOut/grid',
        },
        initialize: function () {
            this._super();
            this._render();
        },
        _render: function() {
            this._prepareColumns();
            this._prepareItems();                     
        },
        _prepareItems: function () {      
        //    var data = window.grid_data;
            this.addItems(window.grid_data);
        },
        _prepareColumns: function () {
            this.addColumn({headerText: "ID", rowText: "entity_id", renderer: ''});
            this.addColumn({headerText: "First Name", rowText: "name", renderer: ''});
            this.addColumn({headerText: "Last Name", rowText: "sku", renderer: ''});
            this.addColumn({headerText: "Email", rowText: "price", renderer: ''});
            this.addColumn({headerText: "Gender", rowText: "sort_order", renderer: ''});
            this.addColumn({headerText: "Birth Date", rowText: "creation_time", renderer: ''});
            this.addColumn({headerText: "Profile Image", rowText: "update_time", renderer: ''});
        },
        addItem: function (item) {
            item.columns = this.columns;
            this.items.push(item);
        },
        addItems: function (items) {
            for (var i in items) {
                this.addItem(items[i]);
            }
        },
        addColumn: function (column) {
            this.columns.push(column);
        }
    });
});
