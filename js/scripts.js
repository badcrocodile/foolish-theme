(function ($) {
	$(document).ready(function () {
		paginatePosts();
	});

	function paginatePosts() {
		let link = $('.company-details button.page-link');

		$(link).on('click', function () {
			let page = $(this).text();
			let companyTicker = $(this).data('companyticker');

			// Remove active class from other buttons
			$(link).each(function () {
				$(this).removeClass('current');
			});

			// Add class to clicked button
			$(this).addClass('current');

			$.ajax({
				type: 'POST',
				url: ajax_var.url,
				data: {
					dataType: 'json',
					'action': 'fool_paginate_custom_query',
					'page': page,
					'company_ticker': companyTicker,
					'nonce': ajax_var.nonce
				},
				success: function (data) {
					$('.other-coverage-wrap').fadeOut('slow', function () {
						$(this).empty().append(data).stop().fadeIn('slow');
					});
				}
			});
		});
	}
})(jQuery);
