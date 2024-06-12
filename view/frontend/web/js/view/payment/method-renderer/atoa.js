define(
    [
        'jquery',
        'ko',
        'Magento_Checkout/js/view/payment/default',
        'Magento_Checkout/js/action/place-order',
        'Magento_Customer/js/model/customer',
        'Magento_Checkout/js/model/payment/additional-validators',
        'mage/url',
        'Magento_Checkout/js/model/url-builder',
        'Magento_Checkout/js/model/error-processor',
        'Magento_Checkout/js/model/full-screen-loader',
        'Magento_Checkout/js/action/redirect-on-success',
        'mage/storage'
    ],
    function (
        $,
        ko,
        Component,
        placeOrderAction,
        customer,
        additionalValidators,
        url,
        urlBuilder,
        errorProcessor,
        fullScreenLoader,
        redirectOnSuccessAction,
        storage
    ) {
        'use strict';
        return Component.extend({
            redirectAfterPlaceOrder: true,
            defaults: {
                template: 'Atoa_AtoaPayment/payment/atoa'
            },
            placeOrder: function (data, event) {
                let self = this;
                if (event) {
                    event.preventDefault();
                }

                self.startPerformingPlaceOrderAction();

                let emailValidationResult = customer.isLoggedIn(),
                    loginFormSelector = 'form[data-role=email-with-possible-login]',
                    paymentOptionSelected = 'input[name=atoa]:checked';
                if (!customer.isLoggedIn()) {
                    $(loginFormSelector).validation();
                    emailValidationResult = Boolean($(loginFormSelector + ' input[name=username]').valid());
                }
                if ($(paymentOptionSelected).val() === undefined) {
                    self.stopPerformingPlaceOrderAction();
                    self.messageContainer.addErrorMessage({
                        message: 'Please choose payment option'
                    });
                }
                if (emailValidationResult && this.validate() && additionalValidators.validate() &&
                    $(paymentOptionSelected).val() !== undefined) {
                    this.isPlaceOrderActionAllowed(false);
                    self.getPlaceOrderDeferredObject().fail(
                        function (response) {
                            errorProcessor.process(response, self.messageContainer);
                            fullScreenLoader.stopLoader();
                            self.isPlaceOrderActionAllowed(true);
                        }
                    ).done(
                        function (response) {
                            let serviceUrl = urlBuilder.createUrl(
                                '/atoa/:orderId/redirect',
                                {
                                    orderId: response
                                }
                            );
                            storage.post(serviceUrl).fail(
                                function (response) {
                                    errorProcessor.process(response, self.messageContainer);
                                    fullScreenLoader.stopLoader();
                                    self.isPlaceOrderActionAllowed(true);
                                }
                            ).done(
                                function (response) {
                                    if (response) {
                                        $.mage.redirect(response.redirect_url);
                                    } else {
                                        errorProcessor.process(response, self.messageContainer);
                                        fullScreenLoader.stopLoader();
                                        self.isPlaceOrderActionAllowed(true);
                                    }
                                }
                            );

                        }
                    );
                    return true;
                }
                fullScreenLoader.stopLoader();
                self.isPlaceOrderActionAllowed(true);
                return false;
            },

            /**
             * Start performing place order action,
             * by disable a place order button and show full screen loader component.
             */
            startPerformingPlaceOrderAction: function () {
                this.isPlaceOrderActionAllowed(false);
                fullScreenLoader.startLoader();
            },

            /**
             * Stop performing place order action,
             * by disable a place order button and show full screen loader component.
             */
            stopPerformingPlaceOrderAction: function () {
                fullScreenLoader.stopLoader();
                this.isPlaceOrderActionAllowed(true);
            },

            /**
             * @return {*}
             */
            getPlaceOrderDeferredObject: function () {
                return $.when(
                    placeOrderAction(this.getData(), this.messageContainer)
                );
            },

            getLogoMarkupSrc: function () {
                return window.checkoutConfig.payment.atoa.logoMarkHref;
            },

            getBankLogosSrc: function () {
                return window.checkoutConfig.payment.atoa.bankLogosHref;
            },

            getMobileBankLogosSrc: function () {
                return window.checkoutConfig.payment.atoa.mobileBankLogosHref;
            },

            getBannerCheckoutText: function () {
                return window.checkoutConfig.payment.atoa.bannerCheckoutText;
            },

            getStyle: function () {
                return 'atoa-payment-checkout style' + window.checkoutConfig.payment.atoa.style;
            }
        });
    }
);
