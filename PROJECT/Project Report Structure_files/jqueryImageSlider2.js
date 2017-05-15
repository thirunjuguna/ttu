/*
* vertical image slider
* Graham Knight
*/

/* Assign the $ to jQuery throughout this code in order to avoid 
conflicting use of '$'*/
(function($){

	var tempOffset = 0;

// Add sliderInit to the jQuery prototype 
$.fn.sliderInit = function(options) {
	var defaults = {
		speed: 700,
		pause: 4000,
		mousePause: true,
		isPaused: false,
	};

	var options = $.extend(defaults, options);
	var sliderWindow;
	var thumbWindow;
	var sliderHeight;
//	var tempOffset = 0;
	
	$(window).resize(function() {
		$('.CSSlider').updateSliderHeight();
	});
	
	return this.each(function() {
		var interval;
//		console.log("init returning");
		sliderWindow = $(this).children('.sliderWindow');
		thumbWindow = $(this).children('.thumbWindow');
		sliderHeight = sliderWindow.find('.sliderImage').height();		

    sliderWindow.css('height', sliderHeight+'px');
    thumbWindow.css('height', sliderHeight+'px');
    
		sliderWindow.css({overflow: 'hidden', position: 'relative'})
			.children('.sliderBlockSet').css({margin: 0, padding: 0, position: 'absolute'})
			.children('.sliderBlock').addClass('sliderBlockJS');

		thumbWindow.css({overflow: 'hidden', position: 'relative'})
			.children('.sliderBlockSet').css({margin: 0, padding: 0, position: 'absolute'})
			.children('.sliderBlock').addClass('sliderBlockJS').click(function(event){
				event.preventDefault();
				var currentThumb = $(this);
				var classes = currentThumb.attr('class');
				var pattern = new RegExp("item[0-9]+");
				var item = pattern.exec(classes);
				console.log('item: '+item);
				var slider = currentThumb.parents('.CSSlider');
				// console.log('slider: '+slider);
				var targetBlock = slider.find('.sliderWindow .'+item);
				// console.log('targetBlock: '+targetBlock);
				var position = targetBlock.position();
				tempOffset = position.left;
				var sliderBlockSet = targetBlock.parent();
				sliderBlockSet.css('left', -tempOffset+'px');
    });
		
		// Advance thumbnails by 1
		var sliderBlockSet = thumbWindow.children('.sliderBlockSet');
		var clone = sliderBlockSet.children('.sliderBlock:first').clone(true);
		sliderBlockSet.children('.sliderBlock:first').remove();
		// thumb.children('.sliderBlockSet').css('top', '0px');
		clone.appendTo(sliderBlockSet);
		
    var interval = setInterval(function(){ 
				$('.CSSlider').moveSliders(options);
		}, options.pause);
		
		if(options.mousePause)
		{
			$(this).bind("mouseenter",function(){
				clearInterval(interval);
			}).bind("mouseleave",function(){
			  interval = setInterval(function(){ 
						$('.CSSlider').moveSliders(options);
					}, options.pause);
			});
		}
	});
};
// end of sliderInit

// Add updateSliderHeight to jQuery prototype 
$.fn.updateSliderHeight = function() {
	return this.each(function() {
		var sliderWindow = $(this).children('.sliderWindow');
		var thumbWindow = $(this).children('.thumbWindow');
		var sliderHeight = sliderWindow.find('.sliderImage').height();		
//		console.log('sliderHeight: '+sliderHeight);

    sliderWindow.css('height', sliderHeight+'px');
    thumbWindow.css('height', sliderHeight+'px');
	});
};
// end of updateSliderHeight

// Add moveSliders to jQuery prototype 
$.fn.moveSliders = function(options) {
	return this.each(function() {
		var thumbWindow;
		var sliderWindow;
		var sliderBlockSet;
		var clone;
		
		// Move thumb-nails up by 1 
		thumbWindow = $(this).children('.thumbWindow');
		sliderBlockSet = thumbWindow.children('.sliderBlockSet');		
		clone = sliderBlockSet.children('.sliderBlock:first').clone(true);
		
		// Append top to bottom
		clone.appendTo(sliderBlockSet);
		
		// Make the move then remove old top item		
		sliderBlockSet.animate({top: '-=' + thumbWindow.height()/3 + 'px'}, options.speed, function(){
			$(this).children('.sliderBlock:first').remove();
			$(this).css('top', '0px');
		});

		// Move slider left (normally) by 1
		sliderWindow = $(this).children('.sliderWindow');
		sliderBlockSet = sliderWindow.children('.sliderBlockSet');		
		clone = sliderBlockSet.children('.sliderBlock:first').clone(true);
		
		// Append first to last
		clone.appendTo(sliderBlockSet);
		
		// Calculate shift. May be abnormal if thumbnail has been clicked
		var leftShift = sliderWindow.width() - tempOffset;
		
		// console.log('tempOffset: '+tempOffset);
		
		// Make the move then remove old first item
		sliderBlockSet.animate({left: '-=' + leftShift + 'px'}, options.speed, function() {
				$(this).children('.sliderBlock:first').remove();
				$(this).css('left', '0px');
				tempOffset = 0;
		});
	});
};

})(jQuery);
/* End of $ = jQuery assignment */

$(document).ready(function(){
//	console.log("ready");
	$('.CSSlider').sliderInit({
		speed: 1000,
		pause: 15000,
		mousePause: true,
	});
});
