define(["jquery", "Magento_Ui/js/modal/modal"], function ($, modal) {
    "use strict";
    var options = {
        type: "popup",
        responsive: true,
        innerScroll: true,
        title: "Example Modal",
        buttons: [
            {
                text: $.mage.__("Cancel"),
                class: "",
                click: function () {
                    this.closeModal();
                },
            },
            {
                text: $.mage.__("Accept"),
                class: "",
                click: function () {
                    this.closeModal();
                    alert("success");
                },
            },
        ],
    };
    modal(options, $("#modal-content"));
    $("#modal-btn").on("click", function () {
        $("#modal-content").modal("openModal");
    });
});
