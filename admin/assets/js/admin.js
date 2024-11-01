(function ($) {
	'use strict';
	$(function () {
	jQuery("#check-system-alert").click(function () {
		jQuery("[aria-controls='tabs-check'] a").trigger("click");
		setTimeout(function () {
		window.scrollTo(0, 0);
		}, 10);
	});
	$("#tabs").tabs();
	$('.woocommerce-help-tip').tipTip({
		'attribute': 'data-tip',
		'activation': 'hover',
		'fadeIn': 50,
		'fadeOut': 50,
		'delay': 0
	}).focus();
	});
})(jQuery);
