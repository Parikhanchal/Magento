define([
    'jquery',
    'underscore',
    'Magento_Ui/js/form/form',
    'ko',
    'Magento_Customer/js/model/customer',
    'Magento_Customer/js/model/address-list',
    'Magento_Checkout/js/model/address-converter',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/action/create-shipping-address',
    'Magento_Checkout/js/action/select-shipping-address',
    'Magento_Checkout/js/model/shipping-rates-validator',
    'Magento_Checkout/js/model/shipping-address/form-popup-state',
    'Magento_Checkout/js/model/shipping-service',
    'Magento_Checkout/js/action/select-shipping-method',
    'Magento_Checkout/js/model/shipping-rate-registry',
    'Magento_Checkout/js/action/set-shipping-information',
    'Magento_Checkout/js/model/step-navigator',
    'Magento_Ui/js/modal/modal',
    'Magento_Checkout/js/model/checkout-data-resolver',
    'Magento_Checkout/js/checkout-data',
    'uiRegistry',
    'mage/translate',
    'mage/storage',
    'Magento_Checkout/js/model/shipping-rate-service'
], function (
    $,
    _,
    Component,
    ko,
    customer,
    addressList,
    addressConverter,
    quote,
    createShippingAddress,
    selectShippingAddress,
    shippingRatesValidator,
    formPopUpState,
    shippingService,
    selectShippingMethodAction,
    rateRegistry,
    setShippingInformationAction,
    stepNavigator,
    modal,
    checkoutDataResolver,
    checkoutData,
    registry,
    $t,
    storage
) {
    'use strict';

    var popUp = null;

    return Component.extend({
        defaults: {
            template: 'Magento_Checkout/shipping',
            shippingFormTemplate: 'Magento_Checkout/shipping-address/form',
            shippingMethodListTemplate: 'Magento_Checkout/shipping-address/shipping-method-list',
            shippingMethodItemTemplate: 'Magento_Checkout/shipping-address/shipping-method-item',
            imports: {
                countryOptions: '${ $.parentName }.shippingAddress.shipping-address-fieldset.country_id:indexedOptions'
            }
        },
        visible: ko.observable(!quote.isVirtual()),
        errorValidationMessage: ko.observable(false),
        isCustomerLoggedIn: customer.isLoggedIn,
        isFormPopUpVisible: formPopUpState.isVisible,
        isFormInline: addressList().length === 0,
        isNewAddressAdded: ko.observable(false),
        saveInAddressBook: 1,
        quoteIsVirtual: quote.isVirtual(),

        initialize: function () {
            var self = this;
            this._super();

            if (!quote.isVirtual()) {
                stepNavigator.registerStep(
                    'shipping',
                    '',
                    $t('Shipping'),
                    this.visible,
                    _.bind(this.navigate, this),
                    this.sortOrder
                );
            }
            checkoutDataResolver.resolveShippingAddress();

            this.isNewAddressAdded(addressList.some(function (address) {
                return address.getType() === 'new-customer-address';
            }));

            this.isFormPopUpVisible.subscribe(function (value) {
                if (value) {
                    self.getPopUp().openModal();
                }
            });

            quote.shippingMethod.subscribe(function () {
                self.errorValidationMessage(false);
            });

            registry.async('checkoutProvider')(function (checkoutProvider) {
                var shippingAddressData = checkoutData.getShippingAddressFromData();

                if (shippingAddressData) {
                    checkoutProvider.set(
                        'shippingAddress',
                        $.extend(true, {}, checkoutProvider.get('shippingAddress'), shippingAddressData)
                    );
                }
                checkoutProvider.on('shippingAddress', function (shippingAddrsData, changes) {
                    var isStreetAddressDeleted, isStreetAddressNotEmpty;

                    isStreetAddressDeleted = function () {
                        var change;

                        if (!changes || changes.length === 0) {
                            return false;
                        }

                        change = changes.pop();

                        if (_.isUndefined(change.value) || _.isUndefined(change.oldValue)) {
                            return false;
                        }

                        if (!change.path.startsWith('shippingAddress.street')) {
                            return false;
                        }

                        return change.value.length === 0 && change.oldValue.length > 0;
                    };

                    isStreetAddressNotEmpty = shippingAddrsData.street && !_.isEmpty(shippingAddrsData.street[0]);

                    if (isStreetAddressNotEmpty || isStreetAddressDeleted()) {
                        checkoutData.setShippingAddressFromData(shippingAddrsData);
                    }
                });
                shippingRatesValidator.initFields('checkout.steps.shipping-step.shippingAddress.shipping-address-fieldset');
            });

            return this;
        },

        navigate: function (step) {
            step && step.isVisible(true);
        },

        getPopUp: function () {
            var self = this,
                buttons;

            if (!popUp) {
                buttons = this.popUpForm.options.buttons;
                this.popUpForm.options.buttons = [
                    {
                        text: buttons.save.text ? buttons.save.text : $t('Save Address'),
                        class: buttons.save.class ? buttons.save.class : 'action primary action-save-address',
                        click: self.saveNewAddress.bind(self)
                    },
                    {
                        text: buttons.cancel.text ? buttons.cancel.text : $t('Cancel'),
                        class: buttons.cancel.class ? buttons.cancel.class : 'action secondary action-hide-popup',
                        click: this.onClosePopUp.bind(this)
                    }
                ];

                this.popUpForm.options.closed = function () {
                    self.isFormPopUpVisible(false);
                };

                this.popUpForm.options.modalCloseBtnHandler = this.onClosePopUp.bind(this);
                this.popUpForm.options.keyEventHandlers = {
                    escapeKey: this.onClosePopUp.bind(this)
                };

                this.popUpForm.options.opened = function () {
                    self.temporaryAddress = $.extend(true, {}, checkoutData.getShippingAddressFromData());
                };
                popUp = modal(this.popUpForm.options, $(this.popUpForm.element));
            }

            return popUp;
        },

        onClosePopUp: function () {
            checkoutData.setShippingAddressFromData($.extend(true, {}, this.temporaryAddress));
            this.getPopUp().closeModal();
        },

        showFormPopUp: function () {
            this.isFormPopUpVisible(true);
        },

        saveNewAddress: function () {
            var addressData,
                newShippingAddress;

            this.source.set('params.invalid', false);
            this.triggerShippingDataValidateEvent();

            if (!this.source.get('params.invalid')) {
                addressData = this.source.get('shippingAddress');
                addressData.save_in_address_book = this.saveInAddressBook ? 1 : 0;

                newShippingAddress = createShippingAddress(addressData);
                selectShippingAddress(newShippingAddress);
                checkoutData.setSelectedShippingAddress(newShippingAddress.getKey());
                checkoutData.setNewCustomerShippingAddress($.extend(true, {}, addressData));
                this.getPopUp().closeModal();
                this.isNewAddressAdded(true);
            }
        },

        rates: shippingService.getShippingRates(),
        isLoading: shippingService.isLoading,
        isSelected: ko.computed(function () {
            return quote.shippingMethod() ?
                quote.shippingMethod().carrier_code + '_' + quote.shippingMethod().method_code :
                null;
        }),

        selectShippingMethod: function (shippingMethod) {
            selectShippingMethodAction(shippingMethod);
            checkoutData.setSelectedShippingRate(shippingMethod.carrier_code + '_' + shippingMethod.method_code);
            return true;
        },

        setShippingInformation: function () {
            if (this.validateShippingInformation()) {
                quote.billingAddress(null);
                checkoutDataResolver.resolveBillingAddress();
                registry.async('checkoutProvider')(function (checkoutProvider) {
                    var shippingAddressData = checkoutData.getShippingAddressFromData();

                    if (shippingAddressData) {
                        checkoutProvider.set(
                            'shippingAddress',
                            $.extend(true, {}, checkoutProvider.get('shippingAddress'), shippingAddressData)
                        );
                    }
                });
                setShippingInformationAction().done(
                    function () {
                        stepNavigator.next();
                    }
                );
            }
        },

        validateShippingInformation: function () {
            var shippingAddress,
                addressData,
                loginFormSelector = 'form[data-role=email-with-possible-login]',
                emailValidationResult = customer.isLoggedIn(),
                field,
                option = _.isObject(this.countryOptions) && this.countryOptions[quote.shippingAddress().countryId],
                messageContainer = registry.get('checkout.errors').messageContainer;

            if (!quote.shippingMethod()) {
                this.errorValidationMessage($t('The shipping method is missing. Select the shipping method and try again.'));
                return false;
            }

            if (!customer.isLoggedIn()) {
                $(loginFormSelector).validation();
                emailValidationResult = Boolean($(loginFormSelector + ' input[name=username]').valid());
            }

            if (this.isFormInline) {
                this.source.set('params.invalid', false);
                this.triggerShippingDataValidateEvent();

                if (!quote.shippingMethod().method_code || !quote.shippingMethod().carrier_code) {
                    this.errorValidationMessage($t('The shipping method is missing. Select the shipping method and try again.'));
                }

                if (emailValidationResult && this.source.get('params.invalid')) {
                    this.focusInvalid();
                    return false;
                }

                shippingAddress = quote.shippingAddress();
                addressData = addressConverter.formAddressDataToQuoteAddress(this.source.get('shippingAddress'));

                for (field in addressData) {
                    if (addressData.hasOwnProperty(field) &&
                        shippingAddress.hasOwnProperty(field) &&
                        typeof addressData[field] !== 'function' &&
                        _.isEqual(shippingAddress[field], addressData[field])
                    ) {
                        shippingAddress[field] = addressData[field];
                    } else if (typeof addressData[field] !== 'function' &&
                        !_.isEqual(shippingAddress[field], addressData[field])
                    ) {
                        shippingAddress = addressData;
                        break;
                    }
                }

                if (customer.isLoggedIn()) {
                    shippingAddress.save_in_address_book = 1;
                }
                selectShippingAddress(shippingAddress);
            } else if (customer.isLoggedIn() && option && option.is_region_required && !quote.shippingAddress().region) {
                messageContainer.addErrorMessage({ message: $t('Please specify a regionId in shipping address.') });
                return false;
            }

            if (!emailValidationResult) {
                $(loginFormSelector + ' input[name=username]').trigger('focus');
                return false;
            }

            return true;
        },

        triggerShippingDataValidateEvent: function () {
            this.source.trigger('shippingAddress.data.validate');

            if (this.source.get('shippingAddress.custom_attributes')) {
                this.source.trigger('shippingAddress.custom_attributes.data.validate');
            }
        },

        customOptionChange: function() {
            var selectElement = document.getElementById('kitchen_shipping_method');
            var selectedValue = selectElement.value;
            alert(selectedValue);

            storage.post(
               'ship/index/index',
               JSON.stringify({
               "field":"custom_shipping",
               "value":selectedValue
           }),
               true
           ).done(
               function (response) {
                   /** Do your code here */
                   alert('Success');
                  
               }
           ).fail(
               function (response) {
                   alert('Fail');
               }
           );        
       }
    });
});
// customOptionChange: function() {
//     var selectElement = document.getElementById('kitchen_shipping_method');
//     var selectedValue = selectElement.value;

//     // Send AJAX request to save the selected custom shipping option value to the database
//     $.ajax({
//         url: '/ship/index/index',
//         type: 'POST',
//         data: {
//             'field': 'custom_shipping',
//             'value': selectedValue
//         },
//         success: function(response) {
//             console.log('Custom shipping option value saved to database:', selectedValue);
//         },
//         error: function(xhr, status, error) {
//             console.error('Error saving custom shipping option value to database:', error);
//         }
//     });
// }