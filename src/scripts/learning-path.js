(function($) {
	//faq events
	$('.accordion').find('.btn').on('click', function () {
		var isOpen = ($(this).parent().hasClass('open')) ? true : false;
		var acc = $(this).closest('.accordion');
		acc.find('[data-toggle="collapse"]').parent().removeClass('open');
		if (!isOpen) $(this).parent().addClass('open');
  		var items = $('.collapse');

  		for (var i=0; i<items.length; i++) {
  			var target = $(this).attr('data-target').split('#')[1];
  			if (items[i].id!=target) {
  				$(items[i]).removeClass('in');
  			}
  		}
  	})

	// modal events
	$('.request-support').on('click', function(e) {
		e.preventDefault();
		$('.modal-support-form').show();
	});
	$('.close-btn').on('click', function(e) {
		e.preventDefault();
		$('.modal-support-form').hide();
	});

	//methodology read more content drawer events
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
})(jQuery);

