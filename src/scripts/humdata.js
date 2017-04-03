(function($) {
   
	//handle video block events on home page
   	if ($('body').hasClass('home')) {
	   	$('.t-entry-visual.video').on('click', function(e){
	   		var vidContainer = $(this).find('.videoplayer');
	    	var vid = $(this).find('video')["0"];
	    	var btn = $(vidContainer).find('.btn');

	    	//resize video player
			var blockHeight = $('.tmb-format-video').height();
			$(vidContainer).find('.mejs-video').attr('style','height:'+blockHeight+'px !important');
			$(vidContainer).find('.mejs-mediaelement video').attr('style','');

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

		//resize video player once grid is built
		setTimeout(function(){ 
			var blockHeight = $('.tmb-format-video').height();
			var vid = $('.mejs-mediaelement video');
			vid.attr('style','height:'+blockHeight+'px !important');
		}, 1000);
	}

	//inject hamburger menu to navigation
	$('.menu-wrapper').append('<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span></button>');

	//override parent theme forcing z-index
	$('.menu-wrapper .navbar-toggle').css('z-index', 2001);
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

	function twitterDataReady(data){
		//console.log(data);
		var processedTweets = [];
		for (var i = 0; i < data.length; i++){
			var dataTweet = data[i];
			processedTweets.push({
				"tweet": dataTweet.tweet,
				"tid": dataTweet.tid,
				"link": dataTweet.permalinkURL,
				"author": dataTweet.author
			});
		}
        $(document).trigger("tweetReady", { "tweets": processedTweets });
	}

	var tweetArray = [];
	var tweetID;
    var configList = {
        "profile": {"screenName": 'humdata'},
        // "domId": 'exampleList',
        "maxTweets": 10,
        "enableLinks": false,
        "showUser": true,
        "showTime": true,
        "showImages": true,
		"customCallback": twitterDataReady,
		"dataOnly": true
    };
    twitterFetcher.fetch(configList);

    //build tweet display
    $(document).on( 'tweetReady', function(e, data) {
        tweetArray = data.tweets;
        tweetID = util.getRandomID(0, tweetArray.length-1);
        getTweet();
    });

    function getTweet(){
        var val = tweetArray[tweetID];
        tweetID = (tweetID==tweetArray.length-1) ? 0 : tweetID+1;
        $('.tweet .tweet-text').html(val.tweet);
        $('.tweet .author').html(val.author);
        $('.tweet a').attr('href',val.link);
    }

    setInterval(function(){
        $.when($('.tweet .t-overlay-content').animate({
            'opacity': '0',
            'marginTop': '+40px'
        }, 750)).done(function(){
            getTweet();
            $('.tweet .t-overlay-content').css('marginTop', '-40px');
            $('.tweet .t-overlay-content').animate({
                'opacity': '1',
                'marginTop': '0'
            }, 600)
        });
    }, 5000);
})(jQuery);