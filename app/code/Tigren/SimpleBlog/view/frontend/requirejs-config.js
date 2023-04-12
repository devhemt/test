var config = {
  map: {
    "*": {
      wktestrequire: "Tigren_SimpleBlog/js/codechallenge1",
      wktestrequire2: "Tigren_SimpleBlog/js/codechallenge2",
      wktestrequire3: "Tigren_SimpleBlog/js/codechallenge3",
    },
  },
  config: {
    mixins: {
      "Magento_Checkout/js/action/set-shipping-information": {
        "Tigren_SimpleBlog/js/codechallenge3": true,
      },
    },
  },
  deps: ["Tigren_SimpleBlog/js/codechallenge1"],
  shim: {
    "Tigren_SimpleBlog/js/codechallenge1": {
      deps: ["jquery"],
    },
  },
};
