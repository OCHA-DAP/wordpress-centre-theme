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

})(jQuery);