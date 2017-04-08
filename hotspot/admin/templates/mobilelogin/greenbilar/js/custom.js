/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
/*//////////////////// Variables Start                                                                                    */
/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
var $ = jQuery.noConflict();
/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
/*//////////////////// Variables End                                                                                      */
/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/



/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
/*//////////////////// Document Ready Function Starts                                                                     */
/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
jQuery(document).ready(function($){
			
	
	
	// initial settings start
	var mainMenuStatus = 'closed';
	var mainMenuAnimation = 'complete';
	var headerHeight = $('.headerOuterWrap').height();
	var mainMenuHeight = $('.mainMenuWrap').height();
	
	$('.mainMenuWrap').css('margin-top', -mainMenuHeight);
	
	var windowWidth = $(window).width() - 48;
		
	var lightboxInitialWidth = windowWidth;
	var lightboxInitialHeight = 220;
	// initial settings end


     
	// main menu functions start
	$('.mainMenuButton').click(function(){
		
		mainMenuHeight =  $('.mainMenuWrap').height();
		
		if(mainMenuStatus == 'closed' && mainMenuAnimation == 'complete'){
			
			mainMenuAnimation = 'incomplete';
			$('.mainMenuWrap').css('display', 'block');
			$('.mainMenuWrap').stop(true, true).animate({"margin-top": 0}, 500, 'easeOutQuart', function(){mainMenuStatus = 'open'; mainMenuAnimation = 'complete'});
			
		}else if(mainMenuStatus == 'open' && mainMenuAnimation == 'complete'){
			
			mainMenuAnimation = 'incomplete';
			$('.mainMenuWrap').stop(true, true).animate({"margin-top": -mainMenuHeight}, 500, 'easeInQuart', function(){mainMenuStatus = 'closed'; mainMenuAnimation = 'complete'; $('.mainMenuWrap').css('display', 'none'); });
		
		};
		
		return false;
	});	
	// main menu functions end	
	
	
	
	// adapt portfolio functions start
	function adaptPortfolio(){
		
		$('.portfolioTwoWrap').css('width', $('.portfolioTwoPageWrap').width() - 12);
		$('.portfolioTwoFilterableWrap .portfolioFilterableItemsWrap').css('width', $('.portfolioTwoFilterablePageWrap').width() - 12);
		$('.recentProjects').css('width', $('.recentProjectsOuterWrap').width() - 12);
		
		var portfolioTwoItemWidth = ($('.portfolioTwoPageWrap').width() - 48 - 36)/2;
		var portfolioTwoFilterableItemWidth = ($('.portfolioTwoFilterablePageWrap').width() - 48 - 36)/2;
		var recentProjectItemWidth = ($('.recentProjectsOuterWrap').width() - 48 - 36)/2;
		
		$('.portfolioTwoItemWrap').css('width', portfolioTwoItemWidth);
		$('.portfolioTwoFilterableWrap .portfolioFilterableItemWrap').css('width', portfolioTwoFilterableItemWidth);
		$('.recentProject').css('width', recentProjectItemWidth);
		
	};
	
	adaptPortfolio();
	// adapt portfolio function end
	
	
	
	// filterable portfolio functions start
	$('#portfolioMenuWrap > li > a').click(function(){
		
		var filterVal = $(this).attr('data-type');
		
		if(filterVal != 'all'){
			
			$('.currentPortfolioFilter').removeClass('currentPortfolioFilter');
			
			$(this).addClass('currentPortfolioFilter');
			
			$('.portfolioFilterableItemWrap').each(function(){
	            
				var itemCategories = $(this).attr("data-type").split(",");
				  
				if($.inArray(filterVal, itemCategories) > -1){
					
					$(this).addClass('filteredPortfolioItem');
					
					$('.filteredPortfolioItem').stop(true, true).animate({opacity:1}, 300, 'easeOutCubic');
					
				}else{
						
					$(this).removeClass('filteredPortfolioItem');
					
					if(!$(this).hasClass('filteredPortfolioItem')){
						
						$(this).stop(true, true).animate({opacity:0.3}, 300, 'easeOutCubic');
					
					};
					
				};
					
			});
		
		}else{
			
			$('.currentPortfolioFilter').removeClass('currentPortfolioFilter');
			
			$(this).addClass('currentPortfolioFilter');
			
			$('.filteredPortfolioItem').removeClass('filteredPortfolioItem');
			
			$('.portfolioFilterableItemWrap').stop(true, true).animate({opacity:1}, 300, 'easeOutCubic');
			
		}
			
		return false;
	
	});
	// filterable portfolio functions end
	
	
	
	// alert box widget function starts
	$('.alertBoxButton').click(function(){
		
		$(this).parent().fadeOut(300, function(){$(this).remove();});
		
		return false;
		
	});
	// alert box widget function endss
	
	
	
	// accordion widget function starts
	$('.accordionButton').click(function(e){
		 
		if($(this).hasClass('currentAccordion')){
			
			 $(this).parent().find('.accordionContentWrap').stop(true, true).animate({height:'hide'},300,'easeOutCubic', function(){ $(this).parent().find('.accordionButton').removeClass('currentAccordion');});
			 
		}else{
			 
			$(this).parent().find('.accordionContentWrap').stop(true, true).animate({height:'show'},300,'easeOutCubic', function(){ $(this).parent().find('.accordionButton').addClass('currentAccordion');});
		 
        };
		 
		return false;
		
	});
	// accordion widget function ends

	
	
	// back to top function starts
	$('.backToTopButton').click(function(){
								   
	    $('body, html').stop(true, true).animate({scrollTop:0}, 1000,'easeOutCubic'); 
		
		return false;
	
    });
	// back to top function ends 
	
	
	
	//window resize functions start
	$(window).resize(function(){
		
		windowWidth = $(window).width() - 48;
		
		lightboxInitialWidth = windowWidth;
		
		lightbox();
					
		adaptPortfolio();
				
	});
	// window resize functions end
	
	
	
	// nivo slider functions start
	$('#mainSlider').nivoSlider({
		
		controlNav: false,
		prevText: '',
        nextText: '' 
		
	});
	// nivo slider functions end
	
	
	
	// lightbox functions start
	function lightbox(){
		
		$('.portfolioOneExpandButton, .portfolioFilterableExpandButton, .singleProjectExpandButton').colorbox({
		
			maxWidth: windowWidth,
			initialWidth: lightboxInitialWidth,
			initialHeight: lightboxInitialHeight
			
		});
		
	};
	
	lightbox();
	// lightbox functions end



});
/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
/*//////////////////// Document Ready Function Ends                                                                       */
/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/