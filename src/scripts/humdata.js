(function($) {
	//handle video block events on home page
   	if ($('body').hasClass('home')) {
	   	$('.t-entry-visual.video').on('click', function(e){
	   		var vidContainer = $(this).find('.content.video');
	    	var vid = $(this).find('video')["0"];
	    	var btn = $(vidContainer).find('.btn');

	      	//video autplays on mute, first time pressing play unmutes and plays the video from the beginning
			if ($(vidContainer).hasClass('preview')){ 
				$(vidContainer).removeClass('preview');
				if (!vid.paused){
					vid.muted = false;
					vid.currentTime = 0;
					vid.play(); 
					$(btn).addClass('pause');
				}
			}
			else{
				if (vid.paused){
					vid.play(); 
					$(btn).addClass('pause');
				}
				else{
					vid.pause(); 
					$(btn).removeClass('pause');
				}
			}
	    });
	}

	//inject hamburger menu to navigation
	$('.menu-wrapper').append('<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>');

	//override parent theme forcing z-index
	$('.menu-wrapper .navbar-toggle').css('z-index', 1002);
	$('.hdc-overlay-menu').css('z-index', 1001);

	//handle hamburger menu events
	$('.menu-wrapper .navbar-toggle').on('click', function() {
		if ($(this).hasClass('collapsed')) {
			$(this).removeClass('collapsed').addClass('expanded');
			$('.hdc-overlay-menu').fadeIn();
		}
		else {
			$(this).removeClass('expanded').addClass('collapsed');
			$('.hdc-overlay-menu').fadeOut();
		}
		return false;
	});
})(jQuery);