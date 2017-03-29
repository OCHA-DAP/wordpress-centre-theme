(function($) {
    var util = window.util = {
        getRandomID: function(min, max){
            var rand = Math.floor((Math.random() * max) + min);
            return rand;
        },

        getRandomVal: function(arr){
            var rand = arr[Math.floor(Math.random() * arr.length)];
            return rand;
        },

        removeFromArray: function(id, arr){
            var tempArray = arr;
            var pos = jQuery.inArray( id, tempArray );
            if (pos > -1) {
                tempArray.splice(pos, 1);
            }
            return tempArray;
        },

        isMobile: function(){
            var isMob = false;
            // device detection
            if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMob = true;
            return isMob;
        }
    };
	//handle video block events on home page
   	if ($('body').hasClass('home')) {
	   	$('.t-entry-visual.video').on('click', function(e){
	   		var vidContainer = $(this).find('.content.video');
	    	var vid = $(this).find('video')["0"];
	    	var btn = $(vidContainer).find('.btn');

	    	//resize video player
			var blockHeight = $('.tmb-format-video').height();
			$('.content.video .mejs-video').attr('style','height:'+blockHeight+'px !important');
			$('.mejs-mediaelement video').attr('style','');

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
        "maxTweets": 5,
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