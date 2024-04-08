$(document).ready(function() {
  var phoneInputID = "#phone";
  var dial_code = "#country_dial_code";
  var input = document.querySelector(phoneInputID);
//   var dial_codes = document.querySelector(dial_code);

  // Initialize intlTelInput plugin
  var iti = window.intlTelInput(input, {
      formatOnDisplay: true,
      geoIpLookup: function(callback) {
          $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
              var countryCode = (resp && resp.country) ? resp.country : "";
              callback(countryCode);
          }).fail(function(jqXHR, textStatus, errorThrown) {
              console.error("Failed to fetch country code: " + textStatus);
          });
      },
      hiddenInput: "full_number",
      initialCountry: "auto",
      preferredCountries: ['ng', 'gb', 'us'],
      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"
  });

  // Event handler for country change
  $(phoneInputID).on("countrychange", function() {
      var selectedCountryData = iti.getSelectedCountryData();
      var newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL);
      iti.setNumber("");

      // Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
      var mask = newPlaceholder.replace(/[1-9]/g, "0");

      $(this).mask(mask);
    //    event.selectedCountryData;
      var detail_data=selectedCountryData.dialCode;
    //   dial_codes.val(detail_data) ;
      $(dial_code).val(detail_data);

    //   console.log(detail_data);
  });

  // Trigger country change event after plugin fully loads
  iti.promise.then(function() {
      $(phoneInputID).trigger("countrychange");
      $(phoneInputID).trigger("countrychange");
  }).catch(function(error) {
      console.error("Failed to initialize intlTelInput plugin: " + error);
  });
});
