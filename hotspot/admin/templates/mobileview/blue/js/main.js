/*!
Intelligent auto-scrolling to hide the mobile device address bar
Optic Swerve, opticswerve.com
Documented at http://menacingcloud.com/?c=iPhoneAddressBar
*/

var bodyTag;
var executionTime = new Date().getTime(); // JavaScript execution time
var aMenuClicked = false;

// Document ready
//----------------
documentReady(function() {
	// Don't hide address bar after a distracting amount of time
	var readyTime = new Date().getTime()
	if((readyTime - executionTime) < 3000) hideAddressBar(true);
	
	
	// -------- Search box hover active state end ------ //
	
	// Toggle script
	
	$(".container").hide();

	$(".toggle").click(function(){
		$(this).toggleClass("active").next().slideToggle(350);
			return false;
	});	
	
	// -------- Toggle script end ------ //
	
	$("#submenu-1").hide();
	
	if("ontouchstart" in document.documentElement)
	{	
		
			$('#a-menu').bind('touchstart touchon', function(event){
					if(aMenuClicked)
					{
						$('#content-wrapper').removeClass('moved');
						$('.menu').removeClass('activeState');
						aMenuClicked = false;
					}
					else
					{
						$('#content-wrapper').addClass('moved');
						$('.menu').addClass('activeState');

						aMenuClicked = true;
					}
			});
			
			$('#a-submenu-1').bind('touchstart touchon', function(event){
				$('#submenu-1').toggle(250);
			});
		}
		else
		{
			
			$('#a-menu').bind('click', function(event){
					if(aMenuClicked)
					{
						$('.menu').removeClass('activeState');
						$('#content-wrapper').removeClass('moved');
						aMenuClicked = false;
					}
					else
					{
						$('.menu').addClass('activeState');
						$('#content-wrapper').addClass('moved');
						aMenuClicked = true;
					}
			});
			
			$('#a-submenu-1').bind('click', function(event){
				$('#submenu-1').toggle(250);
			});
			
	}
	

});

// Run specified function when document is ready (HTML5)
//------------------------------------------------------
function documentReady(readyFunction) {
	document.addEventListener('DOMContentLoaded', function() {
		document.removeEventListener('DOMContentLoaded', arguments.callee, false);
		readyFunction();

	}, false);

}

// Hide address bar on devices like the iPhone
//---------------------------------------------
function hideAddressBar(bPad) {
	// Big screen. Fixed chrome likely.
	if(screen.width > 980 || screen.height > 980) return;

	// Standalone (full screen webapp) mode
	if(window.navigator.standalone === true) return;

	// Page zoom or vertical scrollbars
	if(window.innerWidth !== document.documentElement.clientWidth) {
		// Sometimes one pixel too much. Compensate.
		if((window.innerWidth - 1) !== document.documentElement.clientWidth) return;

	}

	// Pad content if necessary.
	if(bPad === true && (document.documentElement.scrollHeight <= document.documentElement.clientHeight)) {
		// Extend body height to overflow and cause scrolling
		bodyTag = document.getElementsByTagName('body')[0];

		// Viewport height at fullscreen
		bodyTag.style.height = document.documentElement.clientWidth / screen.width * screen.height + 'px';

	}

	setTimeout(function() {
		// Already scrolled?
		if(window.pageYOffset !== 0) return;

		// Perform autoscroll
		window.scrollTo(0, 1);

		// Reset body height and scroll
		if(bodyTag !== undefined) bodyTag.style.height = window.innerHeight + 'px';
		window.scrollTo(0, 0);

	}, 1000);

}

// Quick address bar hide on devices like the iPhone
//---------------------------------------------------
function quickHideAddressBar() {
	setTimeout(function() {
		if(window.pageYOffset !== 0) return;
		window.scrollTo(0, window.pageYOffset + 1);

	}, 1000);

}