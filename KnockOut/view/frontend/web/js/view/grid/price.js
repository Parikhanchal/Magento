define(['jquery', 'ko', 'uiComponent'], function ($, ko, component) {
    "use strict";
    return component.extend({
        render: function (item) {
            return "$" + item.price.toFixed(2);
        }
    });
});