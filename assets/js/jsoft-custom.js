$(document).ready(function() {
	$("a.image-lightbox").fancybox();

	$("a.image-lightbox").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false
	});
});