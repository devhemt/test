define([
  "jquery",
  "mage/utils/wrapper",
  "Magento_Checkout/js/model/quote",
], function ($, wrapper, quote) {
  "use strict";
  return function (setShippingInformationAction) {
    return wrapper.wrap(
      setShippingInformationAction,
      function (originalAction) {
        var shippingAddress = quote.shippingAddress();
        console.log(shippingAddress["middlename"]);
        if (shippingAddress["middlename"] === null) {
          shippingAddress["middlename"] = "middlename";
        }
        console.log(shippingAddress);

        return originalAction(); // it is returning the flow to original action
      }
    );
  };
});
