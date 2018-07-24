(function($) {
	//inject particle background to header
	$('#particles-js').prependTo('.header-wrapper .uncol');

	//override parent theme forcing z-index
	$('.slideshow-modal-overlay').css('z-index', 3001);
	$('.mobile-nav-toggle').css('z-index', 1002);
	$('nav').css('z-index', 1001);

	//capture search term
	var searchTerm = window.location.href.split('s=')[1];
	if (searchTerm!=undefined) {
		searchTerm = searchTerm.split('&')[0];
		//searchTerm = searchTerm.replace('+',' ');
		searchTerm = searchTerm.replace(/\+/g,' ');
		$('.header-main-container .search-container .search-field').val(decodeURIComponent(searchTerm));
	}

	//set height of content blocks on homepage
	setContentBlockHeight();
	$(window).resize(function() {
		setContentBlockHeight();
	});

	$(document).on('onLayout', function() {
		setContentBlockHeight();
	});

	function setContentBlockHeight() {
		var block = $('.home').find('.content-block--inner');
		var blockSize = block.width();
		block.css('height', blockSize);

		var archiveBlock = $('.category-article, .category-case-study').find('.t-inside');
		var archiveBlockWidth = archiveBlock.width() + 'px';
		archiveBlock.css('height', archiveBlockWidth);
	}

	//handle anchor links
	// $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
	// 	// On-page links
	// 	if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
	// 		//find element to scroll to
	// 		var target = $(this.hash);
	// 		target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
	// 		//make sure target exists
	// 		if (target.length) {
	// 			event.preventDefault();
	// 			$('html, body').animate({
	// 				scrollTop: target.offset().top - $('nav').height()
	// 			}, 500);
	// 		}
	// 	}
	// });

	//reset search placeholder text
	//$('.search-container input').attr('placeholder', 'Press enter to search');

	//*********** TWITTER CONTENT BLOCK ***********//
    var TWITTER_DURATION = 1000000;

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
        if (val!==undefined) {
	        tweetID = (tweetID==tweetArray.length-1) ? 0 : tweetID+1;
	        $('.tweet .tweet-text span').html(val.tweet);
	        //console.log(val.tweet, val.tweet.length)
	        $('.tweet .author').html(val.author);
	        $('.tweet a').attr('href',val.link);
        }
    }

    setInterval(function(){
        $.when($('.tweet .tweet-content').animate({
            'opacity': '0',
            'marginTop': '+40px'
        }, 750)).done(function(){
            getTweet();
            $('.tweet .tweet-content').css('marginTop', '-40px');
            $('.tweet .tweet-content').animate({
                'opacity': '1',
                'marginTop': '0'
            }, 600)
        });
    }, TWITTER_DURATION);


	//*********** MAIN NAVIGATION EVENTS ***********//
	//sticky nav
	$(window).on('scroll', function() {
		if ($(this).scrollTop() > $('nav').height()) {
			$('nav').addClass('sticky');
		}
		else {
			$('nav').removeClass('sticky');
		}
	});

	//show nav drawer
    $('.main-nav > .item').on('mouseover', function() {
		$('nav').addClass('active');
	});

    //hide nav drawer
    $('nav').on('mouseleave', function() {
		$('nav').removeClass('active');
	});

    //toggle mobile nav
	$('.mobile-nav-toggle').on('click', function() {
		if ($('nav').hasClass('active')) {
			$('nav').removeClass('active');
			$('.mobile-nav-toggle').removeClass('expanded');
  			$('body').removeClass('mobile-nav-open');
		}
		else {
			$('nav').addClass('active');
			$('.mobile-nav-toggle').addClass('expanded');
  			$('body').addClass('mobile-nav-open');
		}
	});

   
	//*********** SLIDESHOW CONTENT BLOCK ***********//
    var SLIDESHOW_DURATION = 3000;
	var slideshowClicked = false;

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
		$('.slideshow, .slideshow-title').unbind('click').click(function(e) {
			slideshowClicked = true;
			var slideshowContainer = ($(this).context.classList.value.indexOf('slideshow-title')>-1) ? $(this).parent().parent().find('.slideshow-container') : $(this).find('.slideshow-container');
			var slideshowID = slideshowContainer.attr('id');
			createSlideshowModal(slideshowContainer.children(), slideshowID);
			e.preventDefault();
		});
		$('.search .slideshow + .t-entry-text').unbind('click').click(function(e) {
			slideshowClicked = true;
			var slideshowID = $(this).parent().find('.slideshow-container').attr('id');
			createSlideshowModal($(this).parent().find('.slideshow-container').children(), slideshowID);
			e.preventDefault();
		});
	}

	//initialize any slideshow elements on page load
	initSlideshow();

	//check for new slideshow elements after load more or filtering
	$(document).on( 'onLayout', initSlideshow);
	
	//detect if location is direct link to slideshow
	if (window.location.href.indexOf('slideshow=') != -1) {
		var url = window.location.href;
		var id = url.split('slideshow=')[1];
		id = id.split('&')[0];
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
		if (history.pushState && id!=undefined) {
			var cat = (window.location.href.indexOf('ucat') > -1) ? '' : '&ucat=110';
			var urlAppend = (window.location.href.indexOf('?') > -1) ? '&' : '?';
			var newurl = window.location.href + urlAppend + 'slideshow=' + id + cat;
			window.history.pushState({path:newurl},'',newurl);
		}
	}
	function removeSlideshowID() {
		if (history.pushState && window.location.href.indexOf('&slideshow=') > -1) {
			var newurl = window.location.href;
			newurl = newurl.substring(0, newurl.indexOf('&slideshow='));
			window.history.pushState({path:newurl},'',newurl);
		}
		if (history.pushState && window.location.href.indexOf('?slideshow=') > -1) {
			var newurl = window.location.href;
			newurl = newurl.substring(0, newurl.indexOf('?slideshow='));
			if (!slideshowClicked) newurl = newurl + '?ucat=110';
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

   
	//*********** IMPACT VISUALS GALLERY ***********//
	$('.visuals-gallery .gallery-btn').on('click', function(e) {
		var totalSlides = $('.visuals-gallery .visual').length;
		var currSlide = $('.visuals-gallery .visual.active');
		var nextSlide;
		if ($(this).hasClass('next-btn')) {
			nextSlide = (currSlide.index()<totalSlides-1) ? currSlide.next() : nextSlide = $('.visuals-gallery .visual:first-child');
		}
		else {
			nextSlide = (currSlide.index()==0) ? nextSlide = $('.visuals-gallery .visual:last-child') : currSlide.prev();
		}
		$('.visuals-gallery .visual').removeClass('active').fadeOut();
		nextSlide.addClass('active').fadeIn();

		var nextID = nextSlide.index()+1;
		$('.visuals-gallery .dot').removeClass('active');
		$('.visuals-gallery .dot:nth-child('+nextID+')').addClass('active');
	});

	$('.visuals-gallery .dot-indicator .dot').on('click', function(e) {
		var currID = $('.visuals-gallery .visual.active').index();
		var nextID = $(this).index() + 1;
		$('.visuals-gallery .visual').removeClass('active').fadeOut();
		$('.visuals-gallery .visual:nth-child('+nextID+')').addClass('active').fadeIn();
		$('.visuals-gallery .dot').removeClass('active');
		$('.visuals-gallery .dot:nth-child('+nextID+')').addClass('active');
	});


	//*********** CAROUSEL YOUTUBE PLAYERS ***********//
	// var playerDivs = document.querySelectorAll('.video');
	// var playerDivsArr = [].slice.call(playerDivs);
	// var players = new Array(playerDivsArr.length);

	// // create yt players
	// onYouTubeIframeAPIReady();

	// function onYouTubeIframeAPIReady() {
	//   playerDivsArr.forEach(function(e, i) { 
	//   	var iframeID = $(e).find('iframe').attr('id');
	//   	if (iframeID!==null && iframeID!=='') {
	// 	    players[i] = new YT.Player(iframeID, {
	// 	      	events: {
	// 		 		'onReady': onPlayerReady,
	//       			'onStateChange': onPlayerStateChange
	//       		}
	// 	    })
	// 	}
	//   });
	// }

	// function onPlayerReady(event) {
	// 	var slide = $(event.target.a).parent();
	// 	var slideOverlay = $(slide).find('.slide-overlay');
	// 	slideOverlay.on('click', function() {
	// 		$('.latest-carousel').slick('slickPause');
	// 		$(slideOverlay).fadeOut();
	// 		$(slide).find('.title').fadeOut();
	// 		event.target.playVideo();
	// 	});
	// }

	// function onPlayerStateChange(event) {
	// 	var slide = $(event.target.a).parent();
	// 	var slideOverlay = $(slide).find('.slide-overlay');
	// 	if (event.data===2) {
	// 		$(slideOverlay).fadeIn();
	// 		$(slide).find('.title').fadeIn();
	// 	}
	// }
  

})(jQuery);

