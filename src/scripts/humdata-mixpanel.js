(function($) {
	//global mixpanel event function to be called from individual templates
	var mpTrack = window.mpTrack = {
		RW_URL: '',

		pageView: function(pageTitle, pageType){
			var mixpanelTrackData = {
				'page title': pageTitle,
				'page type': pageType
			};
			mixpanel.track('page view', mixpanelTrackData);
			//console.log(mixpanelTrackData);
		}
	}

	//track main nav link clicks
	mixpanel.track_links('.main-nav a', 'link click', {
        'destionation url': $(this).attr('href'),
        'link type': 'main-nav',
        'page title': document.title
    });

    //track contact us module clicks
    mixpanel.track_links('.contact-module a', 'link click', {
        'destionation url': $(this).attr('href'),
        'link type': 'footer',
        'page title': document.title
    });

    //track footer link clicks
    mixpanel.track_links('.site-footer a', 'link click', {
        'destionation url': $(this).attr('href'),
        'link type': 'footer',
        'page title': document.title
    });

    //track slideshow views on category page
    $('.category .slideshow a, .slideshow-title a').on('click', function() {
    	var title = ($(this).parent().hasClass('t-entry-title')) ? $(this).find('span').text() : $(this).closest('.slideshow').parent().find('.t-entry .t-entry-title span').text();
    	mpTrack.pageView(title, 'slideshow');
    });

    //track dataviz views on category page
    $('.category .dataviz a, .dataviz-title a').on('click', function() {
    	var title = ($(this).parent().hasClass('t-entry-title')) ? $(this).find('span').text() : $(this).closest('.dataviz').parent().find('.t-entry .t-entry-title span').text();
		mpTrack.pageView(title, 'dataviz');
    });

    //track video views on category page
    var playerDivs = document.querySelectorAll('.category .video');
	var playerDivsArr = [].slice.call(playerDivs);
	var players = new Array(playerDivsArr.length);

	// create yt players
	onYouTubeIframeAPIReady();
	function onYouTubeIframeAPIReady() {
	  playerDivsArr.forEach(function(e, i) { 
	  	var iframeID = $(e).find('iframe').attr('id');
	  	if (iframeID!==null && iframeID!=='') {
		    players[i] = new YT.Player(iframeID, {
		      	events: {
	      			'onStateChange': onPlayerStateChange
	      		}
		    })
		}
	  });
	}

	function onPlayerStateChange(event) {
		var title = $(event.target.a).parent().closest('.video').parent().find('.t-entry .t-entry-title').text();
		if (event.data===1) {
			mpTrack.pageView(title, 'video');
		}
	}
})(jQuery);

