define(["jquery", "Magento_Ui/js/modal/alert", "jquery/ui"], function (
  $,
  alert
) {
  "use strict";
  $.widget("mage.wktestrequire2", {
    _create: function () {
      $("#element").accordion({ active: [0, 1] });
      var self = this;
      console.log(self.options);
    },
  });
  return $.mage.wktestrequire2;
});
