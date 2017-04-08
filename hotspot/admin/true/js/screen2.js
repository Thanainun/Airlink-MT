jQuery(document).ready(function($) {
	
	if(Modernizr.touch) {
    $('body').addClass('touch');
	}
	
	// Reload stylesheet on document ready if IE8
	if ($.browser.msie && 8 == parseInt($.browser.version)) {
    	$(function() {
        	var $ss = $('#f-sheet');
        	$ss[0].href = $ss[0].href;
    	});
	}
	
	//Twitter
	JQTWEET.loadTweets();
	
	$('#responsive-menu-button').sidr({
      		name: 'sidr-main',
      		source: '#navigation'
   		 });
	
		$( ".nav li a" ).click(function() {

			$.sidr('close', 'sidr-main');
			
		});
		
		
		$('a[href*=#]:not([href=#])').click(function() {
    
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
        		|| location.hostname == this.hostname) {

        		var target = $(this.hash);
        		target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
           		if (target.length) {
             		$('html,body').animate({
                 			scrollTop: target.offset().top
            			}, 1000);
            		return false;
        		}
    		}
		});
		
	
		$(".video-section").fitVids();
      
	  	$('.flexslider').flexslider({
        	animation: "fade"
        });
	  
	  	$('.flexslider2').flexslider({
        	animation: "fade"
        });

        $('.screenshots-section').magnificPopup({
          	delegate: 'a',
          	type: 'image',
          	tLoading: 'Loading image #%curr%...',
          	mainClass: 'mfp-img-mobile',
          	gallery: {
            	enabled: true,
            	navigateByImgClick: true,
            	preload: [0,1] // Will preload 0 - before current, and 1 after the current image
          	},
          	image: {
            	tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            	titleSrc: function(item) {
              	return item.el.attr('title');
            	}
          	}
        	});
		
});

