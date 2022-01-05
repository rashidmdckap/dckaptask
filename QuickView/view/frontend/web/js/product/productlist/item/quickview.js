define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    'mage/loader',
    'Magento_Customer/js/customer-data'
], function ($, modal, loader, customerData) {
    'use strict';

    return function(config, node) {

        var product_id = jQuery(node).data('id');
        var product_url = jQuery(node).data('url');

        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: false,
            title: $.mage.__('Quick View'),
            buttons: [{
                text: $.mage.__('Close'),
                class: 'close-modal',
                click: function () {
                    this.closeModal();
                    location.reload();
                }
            }]
        };

        var popup = modal(options, $('#quickViewContainer' + product_id));

        $("#quickViewButton" + product_id).on("click", function () {
            openQuickViewModal();
        });

        var openQuickViewModal = function () {
            var modalContainer = $("#quickViewContainer" + product_id);
            modalContainer.html(createIframe());

            var iframe_selector = "#iFrame" + product_id;

            $(iframe_selector).on("load", function () {
                modalContainer.addClass("product-quickview");
                modalContainer.modal('openModal');
                this.style.height = this.contentWindow.document.body.scrollHeight+10 + 'px';
                this.style.border = '0';
                this.style.width = '100%';
            });
        };

        $( ".action-close" ).click(function() {
            window.location.reload();
        });

        //var observeAddToCart = function (iframe) {

            //var doc = iframe.contentWindow.document;

            //$(doc).contents().find('#product_addtocart_form').submit(function(e) {
                //location.reload();
              //  e.preventDefault();
                // $.ajax({
                //     data: $(this).serialize(),
                //     type: $(this).attr('method'),
                //     url: $(this).attr('action'),
                //     success: function(response) {
                 //       return $.DCKAP.QuickView;

                        //customerData.reload("cart");
                        //customerData.reload("messages");
              //          $(".close-modal").trigger("click");
                        //location.reload(true);

                       // $('[data-block="minicart"]').find('[data-role="dropdownDialog"]').dropdownDialog("open");
                //     }
                // });
                //window.location.href=window.location.href;
            //});
        //     window.location.href=window.location.href;
        // };

        var createIframe = function () {
            return $('<iframe />', {
                id: 'iFrame' + product_id,
                src: product_url + "?iframe=1"
            });
        }
    };
});
