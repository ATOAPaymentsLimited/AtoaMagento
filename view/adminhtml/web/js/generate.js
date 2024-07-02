define([
    'ko',
    'uiComponent',
    'jquery'
], function (ko, Component, $) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Atoa_AtoaPayment/generate-button',
            errorMessage: 'Something when wrong while generate webhook URL.',
            emptyAccessTokenMessage: 'Please fill the "Access Token" field for a generate Webhook URL',
            accessToken: 'groups[atoa][fields][access_token][value]',
            url: '',
            success: true,
            message: '',
            visible: false
        },

        /**
         * Init observable variables
         * @return {Object}
         */
        initObservable: function () {
            this._super().observe([
                'success',
                'message',
                'visible'
            ]);

            return this;
        },

        /**
         * @override
         */
        initialize: function () {
            this._super();
            this.messageClass = ko.computed(function () {
                return 'message-validation message message-' + (this.success() ? 'success' : 'error');
            }, this);

            if (!this.success()) {
                this.showMessage(false, this.errorMessage);
            }
        },

        /**
         * @param {bool} success
         * @param {String} message
         */
        showMessage: function (success, message) {
            this.message(message);
            this.success(success);
            this.visible(true);
        },

        /**
         * Send request to server to test connection to Adobe Stock API and display the result
         */
        generate: function () {
            let accessToken = document.getElementsByName(this.accessToken)[0].value;

            if (accessToken.length === 0) {
                this.showMessage(false, this.emptyAccessTokenMessage);

                return;
            }
            this.visible(false);

            $.ajax({
                type: 'POST',
                url: this.url,
                dataType: 'json',
                data: {
                    'access_token': accessToken
                },
                success: function (response) {
                    if (response.success === true) {
                        document.getElementById('webhook_url').value = response.url;
                    }
                    this.showMessage(response.success === true, response.message);
                }.bind(this),
                error: function () {
                    this.showMessage(false, this.errorMessage);
                }.bind(this)
            });
        }
    });
});
