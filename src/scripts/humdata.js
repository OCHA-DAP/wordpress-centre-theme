(function($) {
	//inject particle background to header
	$('#particles-js').prependTo('.header-wrapper .uncol');

	//inject hamburger menu to navigation
	$('.menu-wrapper').append('<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span></button>');

	//override parent theme forcing z-index
	$('.slideshow-modal-overlay').css('z-index', 3001);
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


	//*********** TWITTER CONTENT BLOCK ***********//
    var TWITTER_DURATION = 5000;

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
    }, TWITTER_DURATION);


   
	//*********** SLIDESHOW CONTENT BLOCK ***********//
    var SLIDESHOW_DURATION = 3000;

    function Slideshow(slider) {
	  	this.slider = slider;
	  	this.slides = slider.children();
		this.currSlideIndex = 0;
	}

	Slideshow.prototype.init = function(dur) {
		var duration = (dur!=undefined) ? dur : SLIDESHOW_DURATION;
	  	var self = this;
	  	$(this.slides[this.currSlideIndex]).removeClass('fadeIn');
        this.currSlideIndex++;
        if (this.currSlideIndex == this.slides.length) {
            this.currSlideIndex = 0;
        }
        $(this.slides[this.currSlideIndex]).addClass('fadeIn');

        setTimeout(function() {
            self.init();
        }, duration);
	}

	function initSlideshow() {
		var delay = 0;
		$('.slideshow-container').each(function(index) {
			var dur = SLIDESHOW_DURATION;
			if (!$(this).find('img').hasClass('fadeIn')) {
				var slide = new Slideshow($(this));
				dur += 300*index;
				slide.init(dur);
			}
		});

		//handle slideshow click, launch modal
		$('.slideshow').on('click', function(e) {
			var slideshowID = $(this).find('.slideshow-container').attr('id');
			createSlideshowModal($(this).find('.slideshow-container').children(), slideshowID);
			e.preventDefault();
		});
	}

	//initialize any slideshow elements on page load
	initSlideshow();

	//check for new slideshow elements after load more or filtering
	$(document).on( 'onLayout', initSlideshow);
	
	//detect if location is direct link to slideshow
	if (window.location.href.indexOf('&slideshow=') != -1) {
		var url = window.location.href;
		var id = url.split('&slideshow=')[1];
		var slides = $('#'+id).children();
		if (slides.length>0) {
			createSlideshowModal($('#'+id).children());
		}
	}


	//*********** SLIDESHOW MODAL ***********//
	var slideIndex = 1;
	function createSlideshowModal(slides, id) {
		$('.slideshow-modal-overlay').show();
		slides.clone().appendTo('.slides');
		$('.slides').find('img:nth-child(1)').show();
		slideIndex = 1;

		//update url with slideshow id
		addSlideshowID(id);
	}
	function showSlideModal(dir) {
		var slides = $('.slides').children();
		if (dir=='next')
			slideIndex = (slideIndex < slides.length) ? slideIndex+1 : 1;
		else
			slideIndex = (slideIndex <= 1) ? slides.length : slideIndex-1;
		$('.slides').find('img').hide();
		$('.slides').find('img:nth-child('+slideIndex+')').show();
	}
	function addSlideshowID(id) {
		removeSlideshowID();
		if (history.pushState && id!=undefined) {
			var cat = (window.location.href.indexOf('ucat') > -1) ? '' : '&ucat=110';
			var newurl = window.location.href + '&slideshow='+id+cat;
			window.history.pushState({path:newurl},'',newurl);
		}
	}
	function removeSlideshowID() {
		if (history.pushState && window.location.href.indexOf('&slideshow=') > -1) {
			var newurl = window.location.href;
			newurl = newurl.substring(0, newurl.indexOf('&slideshow='));
			window.history.pushState({path:newurl},'',newurl);
		}
	}

	$('.slideshow-modal-overlay .close').on('click', function(e) {
		//close the modal and remove the slides
		$('.slideshow-modal-overlay').hide();
		$('.slides').empty();

		removeSlideshowID();
	});
	$('.slideshow-modal-overlay .slideshow-btn').on('click', function(e) {
		//get next slide
		showSlideModal($(this).attr('data-dir'));
	});







})(jQuery);