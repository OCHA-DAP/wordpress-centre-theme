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

	//track ocha header link clicks
	$('.ocha-services-menu a').on('click', function(event) {
		trackLink($(this), 'ocha-header', 'blank');
    });

	//track main nav link clicks
	$('.main-nav a').on('click', function(event) {
		trackLink($(this), 'main nav');
    });

	//track footer link clicks
	$('.contact-module a, .site-footer a').on('click', function(event) {
		trackLink($(this), 'footer');
    });

    //track blog links to pdf files
	$('.single-post a').on('click', function(event) {
		// var fileType = destURL.substr(destURL.lastIndexOf(".")+1)
		// if (fileType=='pdf') trackLink($(this), 'blog', target);
		var destURL = $(this).attr('href');
		mixpanel.track('link click', { 'destionation url': destURL, 'link type': 'blog', 'page title': document.title });
    });

    function trackLink(link, type) {
    	var destURL = $(link).attr('href');
    	mixpanel.track('link click', { 'destionation url': destURL, 'link type': type, 'page title': document.title });
        
        //var cb = generate_callback($(link), target);
        //mixpanel.track('link click', { 'destionation url': destURL, 'link type': type, 'page title': document.title }, cb);
        //setTimeout(cb, 500);
    }

    function generate_callback(a, target) {
        return function() {
        	if (target=='blank') {
        		window.open(a.attr('href'));
        	}
        	else {
           		window.location = a.attr('href');
        	}
        }
    }

    //track content block views on home page
    $('.home .content-block a').on('click', function() {
    	var title = ($(this).hasClass('title')) ? $(this).find('.label').text() : $(this).parent().parent().find('.label').text();
    	var category = ($(this).hasClass('title')) ? $(this).parent().parent().find('.category-tag').text() : $(this).parent().find('div[class*=category]').text();
    	mpTrack.pageView(title, category.toLowerCase());
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

    //track dataviz views on category page
    $('.category .announcement a, .announcement-title a').on('click', function() {
    	var title = ($(this).parent().hasClass('t-entry-title')) ? $(this).find('span').text() : $(this).closest('.announcement').parent().find('.t-entry .t-entry-title span').text();
		mpTrack.pageView(title, 'announcement');
    });

    //track article views on category page
    $('.category .article-title a').on('click', function() {
    	var title = $(this).find('.label').text();
		mpTrack.pageView(title, 'article');
    });

    //track article views on category page
    $('.category .casestudy-title a').on('click', function() {
    	var title = $(this).find('.label').text();
		mpTrack.pageView(title, 'casestudy');
    });

    //track video views on category page
    var playerDivs = document.querySelectorAll('.video');
	var playerDivsArr = [].slice.call(playerDivs);
	var players = new Array(playerDivsArr.length);

	// create yt players
	readyYoutube()
	function readyYoutube(){
	    if ((typeof YT !== "undefined") && YT && YT.Player){
	        onYouTubeIframeAPIReady();
	    }
	    else {
	        setTimeout(readyYoutube, 100);
	    }
	}
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
		title = (title!=='') ? title : $(event.target.a).closest('.content-block').find('.label').text();
		if (event.data===1) {
			mpTrack.pageView(title, 'video');
		}
	}
})(jQuery);

