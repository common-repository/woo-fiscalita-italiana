/* global wfiCheckout, jQuery */
'use strict';
function toggle_cfpiva_fields($element, hide, required) {
  if (hide === true) {
    $element.hide().find('input').removeAttr('required');
    if (required === true) {
      $element.find('.required').remove();
    }
    return;
  }

  $element.show().find('input').attr('required', 'required');
  if (required === true) {
    if ($element.find('.required').length <= 0) {
      $element.find('label').append(wfiCheckout.required);
    }
  }
}

function wfi_hide_fields() {
  var italy = (jQuery('.country_select :selected').val() === 'IT' || jQuery('.country_to_state').val() === 'IT' || jQuery('.country_select').length === 0);
  toggle_cfpiva_fields(jQuery('#cf_field, #piva_field'), true, '');
  if (wfiCheckout.vat !== '1' || wfiCheckout.vat === '1' && italy) {
    if (jQuery('input[name=pvtazd]:visible').length !== 0 || wfiCheckout.mandatory === '1') {
      if (jQuery('input[name=pvtazd]:checked').val() === 'azienda' && (jQuery('input[name=ask_invoice]:checked').length === 0 || jQuery('input[name=ask_invoice]:checked').val() === 'yes') || italy && jQuery('input[name=ask_invoice],input[name=pvtazd]').length === 0) {
        toggle_cfpiva_fields(jQuery('#piva_field'), false, '');
      }
    }
  }
  if (wfiCheckout.fc !== '1' || wfiCheckout.fc === '1' && italy) {
    if (jQuery('input[name=pvtazd]:visible').length !== 0 && jQuery('input[name=pvtazd]:checked').val() !== undefined || wfiCheckout.mandatory === '1') {
      toggle_cfpiva_fields(jQuery('#cf_field'), false, '');
    }
  }
}

function wfi_ask_data() {
  var fields = jQuery('.pvtazd, .cf, .piva');
  if (jQuery('input[name=ask_invoice]:checked').val() === 'no') {
    fields.hide();
  } else {
    fields.show();
    wfi_hide_fields();
  }
}

jQuery(document).ready(function () {
  wfi_hide_fields();

  jQuery('input[name=pvtazd], input[name=ask_invoice]').change(function () {
    wfi_hide_fields();
    jQuery(':input.country_to_state').change();
  });
  jQuery('#billing_country').change(function () {
    wfi_hide_fields();
  });

  wfi_ask_data();
  jQuery('input[name=ask_invoice]').change(function () {
    wfi_ask_data();
  });
});
