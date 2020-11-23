(function($) {
	$('.button-read-more').on('click', function() {
		$(this).toggleClass('expand');
		$(this).closest('section').find('.content-drawer').slideToggle('fast');
	});
})(jQuery);

