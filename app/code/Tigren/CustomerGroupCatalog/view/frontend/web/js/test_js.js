define(["jquery", "Magento_Ui/js/modal/alert", "jquery/ui"], function (
    $,
    alert
) {
    "use strict";
    $.widget("mage.test_js", {
        options: {
            confirmMsg: "this is test js",
        },
        _create: function () {
            var self = this;
            $("#testBtn").click(function () {
                alert({
                    content: self.options.confirmMsg,
                });
            });
        },
    });
    return $.mage.test_js;
});
