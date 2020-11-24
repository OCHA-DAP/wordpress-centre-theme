(function($) {
	$('.button-read-more').on('click', function() {
		$(this).toggleClass('expand');
		$(this).closest('section').find('.content-drawer').slideToggle('fast');
		if ($(this).hasClass('expand')) {
			$(this).html('Close');
		}
		else {
			$(this).html('Read More');
		}
	});
})(jQuery);

