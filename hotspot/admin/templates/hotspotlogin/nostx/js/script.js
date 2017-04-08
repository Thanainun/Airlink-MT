// JavaScript Document

// Smooth Scrolling */
$(function() {
    $('nav a').bind('click',function(event){
        var $anchor = $(this);
 
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500,'easeInOutExpo');
        event.preventDefault();
    });
	
});

// Scroll Timeline

$(window).scroll(function() {
		var scroll = $(window).scrollTop();
		var windowH = $(window).height();
		var section2H = windowH*1;
		var section3H = windowH*2;
		
		// Go
		if ( scroll <= section2H-50) {
			$('nav').removeClass('green');
		}
		if ( scroll >= section2H-49) {
			$('nav').addClass('green');
		}
		
		if ( scroll <= section3H-50) {
			$('nav').removeClass('black');
		}
		if ( scroll >= section3H-49) {
			$('nav').removeClass('green');
			$('nav').addClass('black');
		}

});