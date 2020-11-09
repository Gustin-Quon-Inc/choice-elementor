jQuery(document).ready(function($) {

	if ( window.elementorFrontend ) {
			$(".inherit-child-href").click(function() {
		  		window.location = $(this).find("a").attr("href"); 
		  		return false;
			});
			$('.inherit-child-href').css('cursor', 'pointer');
	}
	
	var $toggleButton = $('.toggle-button'),
		$toggleButtonText = $('.toggle-button-text'),
        $menuWrap = $('.menu-wrap .elementor-widget-container');


  		
  	$toggleButton.on('click', function() {
    	$(this).toggleClass('button-open');
    	$toggleButtonText.toggleClass('menu-show');
    	$menuWrap.toggleClass('menu-show');
  	});

})
