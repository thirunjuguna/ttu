// Start bxSliders
// (Actually uses fade transition rather than slide)
$(document).ready(function(){
	$('div.bxSlider').bxSlider({
		mode: 'fade',  			
		adaptiveHeight: false,
		speed: 2000,
		slideSelector: 'div.bxSliderItem',
		controls: false,
		autoControls: false,
		auto: true,
		pause: 12000,
		pager: false,
		autoHover: true, 
		maxSlides: 1, 	  			
		minSlides: 1,		
	});
});
