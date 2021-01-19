(function($) {
	// create yt players
	readyYoutube();
	function readyYoutube(){
		if ((typeof YT !== "undefined") && YT && YT.Player){
			onYouTubeIframeAPIReady();
		}
		else {
			setTimeout(readyYoutube, 100);
		}
	}
	var player;
	function onYouTubeIframeAPIReady() {
		player = new YT.Player('overviewFeatureVideo', {
			events: {
				//'onReady': onPlayerReady,
				'onStateChange': onPlayerStateChange
			}
		});
	}

	function onPlayerStateChange(e) {
		if (e.data == YT.PlayerState.PLAYING) {
			playing = true;
			$('.feature-media-caption').fadeOut();
		}
		else if (e.data == YT.PlayerState.PAUSED || e.data == YT.PlayerState.ENDED) {
			playing = false;
			$('.feature-media-caption').fadeIn();
		}
	}

	$('.button-read-more').on('click', function(e) {
		e.preventDefault();
		$(this).toggleClass('expand');
		$(this).closest('section').find('.content-drawer').slideToggle('fast');
		if ($(this).hasClass('expand')) {
			$(this).html('Close');
		}
		else {
			$(this).html('Read More');
		}
	});

	//sticky nav
	// $(window).on('scroll', function() {
	// 	var h = $('.learning-path-navigation').outerHeight() + $('.feature-content').outerHeight();
	// 	if ($(this).scrollTop() > h) {
	// 		console.log($('.column-container').position(), $('.column-container').scrollTop(), $(this).scrollTop())
	// 		//$('.jump-menu').addClass('sticky');
	// 		//$('.ocha-header .dropdown-menu').css('display', 'none');
	// 	}
	// 	else {
	// 		//$('.jump-menu').removeClass('sticky');
	// 	}
	// });

})(jQuery);

