(function($) {
	$('figure.wp-caption.aligncenter').removeAttr('style');
	$('img.aligncenter').wrap('<figure class="centered-image" />');
	$(document).ready(function() {
		$('.stories > a').on({
			mouseenter: function() {
		    	$(this).find('figcaption').removeClass('text-off').addClass('text-on');
			}, mouseleave: function() {
				$(this).find('figcaption').removeClass('text-on').addClass('text-off');
			}
		});
	});
}) (jQuery);