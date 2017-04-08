var n_backs = 4;
var rand = Math.ceil(Math.random()*n_backs);

/** Hide Toolbar on iPhone **/
var ua = navigator.userAgent.toLowerCase();
if (ua.indexOf('iphone') != -1) {
	window.addEventListener('load', function(){
		setTimeout(scrollTo, 0, 0, 1);
	}, false);
}

$(function(){
	
	/** Random background **/
	$('body').addClass('bg'+rand);
		
});

