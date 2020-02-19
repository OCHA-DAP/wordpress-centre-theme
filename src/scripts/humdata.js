(function($) {
	$('.ocha-services').on('click', function() {
		$('.ocha-header .dropdown-menu').toggle();
	});

	//inject particle background to header
	$('#particles-js').prependTo('.header-wrapper .uncol');

	//override parent theme forcing z-index
	$('.slideshow-modal-overlay').css('z-index', 3001);
	$('nav').css('z-index', 1001);
	$('.mobile-nav-toggle').css('z-index', 1002);
	$('.ocha-header .dropdown-menu').css('z-index', 1003);
	$('.post-body .post-after .tmb .t-entry-visual .t-entry-visual-overlay').css('z-index', 4);
	$('.post-body .post-after .tmb .t-entry-visual .t-overlay-wrap').css('z-index', 5);

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
		setTimeout(function() {
 			$('.slick-slideshow').css('opacity', 1);
		}, 1500);
		

		var archiveBlock = $('.category-article, .category-case-study, .tag').find('.t-inside');
		var archiveBlockWidth = archiveBlock.width() + 'px';
		archiveBlock.css('height', archiveBlockWidth);
	}

	//reset search placeholder text
	//$('.search-container input').attr('placeholder', 'Press enter to search');

	//click event for latest press blocks on homepage
	$('.latest-press-module .content-block--inner').on('click', function() {
		window.open($(this).find('a').attr('href'), '_blank');
	})

	//click event for video blocks on homepage
	$('.latest-stories-module .video-title').on('click', function() {
		var vid = $(this).closest('.content-block').find('iframe').attr('src');
		vid = vid.replace('embed', 'watch');
		if (vid!=undefined) window.open(vid, '_blank');
		return false;
	})

	//wpDataTables -- clicking on entire table row triggers row expand
	$('.wpDataTable tr').on('click', function() {
		$(this).find('.responsiveExpander').click();
	})

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
        if (val!==undefined) {
	        tweetID = (tweetID==tweetArray.length-1) ? 0 : tweetID+1;
	        $('.tweet .tweet-text span').html(val.tweet);
	        $('.tweet .author').html(val.author);
	        $('.tweet a:not(.twitter-logo)').attr('href',val.link);
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
		if ($(this).scrollTop() > $('.ocha-header').height()) {
			$('nav').addClass('sticky');
			$('.ocha-header .dropdown-menu').css('display', 'none');
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
			var slideshowContainer = '';
			var slideshowCaption = {};

			if ($(this).context.classList.value.indexOf('t-entry')>-1) { //from category page
				if ($(this).context.classList.value.indexOf('slideshow-title')>-1) {
					slideshowContainer = $(this).parent().parent().find('.slideshow-container');
					slideshowCaption.title = $(this).find('.t-entry-title span').text();
					slideshowCaption.author = $(this).find('.author').text();
				}
				else {
					slideshowContainer = $(this).find('.slideshow-container');
					slideshowCaption.title = $(this).parent().find('.t-entry-text .t-entry-title span').text();
					slideshowCaption.author = $(this).parent().find('.t-entry-text .author').text();
				}
			}
			else { //from homepage
				if ($(this).context.classList.value.indexOf('slideshow-title')>-1) {
					slideshowContainer = $(this).parent().parent().find('.slideshow-container');
					slideshowCaption.title = $(this).find('.label').text();
					slideshowCaption.author = $(this).parent().find('.source').text();
				}
				else {
					slideshowContainer = $(this).find('.slideshow-container');
					slideshowCaption.title = $(this).parent().find('.content-block--content .slideshow-title .label').text();
					slideshowCaption.author = $(this).parent().find('.content-block--content .source').text();
				}
			}
			var slideshowID = slideshowContainer.attr('id');
			createSlideshowModal(slideshowContainer.children(), slideshowID, slideshowCaption);
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
		var slideshowContainer = $('#'+id);
		var slides = $(slideshowContainer).children();
		var slideshowContent = '';
		var slideshowCaption = {};
		if (url.indexOf('category') != -1) { //on category page
			slideshowContent = $(slideshowContainer).closest('.slideshow').parent().find('.t-entry-text');
			slideshowCaption = {title: $(slideshowContent).find('.t-entry-title').text(), author: $(slideshowContent).find('.author').text()};
		}
		else { //on homepage
			slideshowContent = $(slideshowContainer).closest('.slideshow').parent().find('.content-block--content');
			slideshowCaption = {title: $(slideshowContent).find('.label').text(), author: $(slideshowContent).find('.source').text()};
		}

		if (slides.length>0) {
			createSlideshowModal($('#'+id).children(), null, slideshowCaption);
		}
	}


	//*********** SLIDESHOW MODAL ***********//
	var slideIndex = 1;
	function createSlideshowModal(slides, id, caption) {
		$('.slideshow-modal-overlay').show();
		$('<div class="slideshow-caption"><div class="title">'+caption.title+'</div><div class="author">'+caption.author+'</div><div class="counter">1/'+slides.length+'</div></div>').prependTo('.slides');
		slides.clone().prependTo('.slides');
		
		$('.slides').find('img:nth-child(1)').show();
		slideIndex = 1;

		//update url with slideshow id
		addSlideshowID(id);
	}
	function showSlideModal(dir) {
		var slides = $('.slides > img');
		if (dir=='next')
			slideIndex = (slideIndex < slides.length) ? slideIndex+1 : 1;
		else
			slideIndex = (slideIndex <= 1) ? slides.length : slideIndex-1;
		$('.slides').find('img').hide();
		$('.slides').find('img:nth-child('+slideIndex+')').show();
		$('.slides').find('.counter').text(slideIndex+'/'+slides.length)
	}
	function addSlideshowID(id) {
		if (history.pushState && id!=undefined) {
			//var cat = (window.location.href.indexOf('ucat') > -1) ? '' : '&ucat=110';
			var urlAppend = (window.location.href.indexOf('?') > -1) ? '&' : '?';
			var newurl = window.location.href + urlAppend + 'slideshow=' + id;// + cat;
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
			//if (!slideshowClicked) newurl = newurl + '?ucat=110';
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


	//*********** SLICK SLIDESHOWS ***********//
	function initSlickSlideshow() {
	    $('.slick-slideshow').slick({
  			dots: true,
  			slidesToShow: 3,
  			slidesToScroll: 3,
			responsive: [
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						dots: true
					}
				}
			]
	    });
	}
	initSlickSlideshow();


	//*********** CAROUSEL YOUTUBE PLAYERS ***********//
	var playerDivs = document.querySelectorAll('.video');
	var playerDivsArr = [].slice.call(playerDivs);
	var players = new Array(playerDivsArr.length);

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

	function onYouTubeIframeAPIReady() {
	  	playerDivsArr.forEach(function(e, i) { 
		  	var iframeID = $(e).find('iframe').attr('id');
		  	if (iframeID!==null && iframeID!=='') {
			    players[i] = new YT.Player(iframeID, {
			      	events: {
				 		'onReady': onPlayerReady,
		      			'onStateChange': onPlayerStateChange
		      		}
			    })
			}
	  	});

	  	//stop all videos when slideshow is swiped
	    // $('.slick-slideshow').on('swipe', function() {		
		//   	playerDivsArr.forEach(function(e, i) { 
		// 	  	var iframeID = $(e).find('iframe').attr('id');
		// 	  	if (iframeID!==null && iframeID!=='') {
		// 		    players[i].stopVideo();
		// 		}
		//   	});
		// });
	}

	function onPlayerReady(event) {
		var link = $(event.target.a).parent().closest('.video').find('a');
		var slide = $(event.target.a).parent();
		var slideOverlay = $(slide).find('.slide-overlay');
		link.on('click', function(e) {
			e.preventDefault();
			event.target.playVideo();
		});
	}

	function onPlayerStateChange(event) {
		var slide = $(event.target.a).parent();
		var slideOverlay = $(slide).find('.slide-overlay');
		if (event.data===2) {
			$(slideOverlay).fadeIn();
		}
	}
  

})(jQuery);

