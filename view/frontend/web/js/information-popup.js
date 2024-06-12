define([
    'jquery',
    'Magento_Ui/js/modal/modal'
], function ($, modal) {
    let options = {
        modalClass: 'atoa-information-modal-popup',
        type: 'popup',
        responsive: true,
        innerScroll: true,
        buttons: []
    };

    let popup = modal(options, $('#atoa-information-modal'));
    $('a[data-popup-trigger="atoa-information-trigger"]').on('click', function () {
        $('#atoa-information-modal').modal('openModal');
    });
});
