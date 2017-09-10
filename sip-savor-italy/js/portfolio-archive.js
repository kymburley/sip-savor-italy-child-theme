jQuery(function( $ ){

	$( ".portfolio-content .entry a.link-hover" ).hover(function() {
		$( this ).find( ".item-hover" ).fadeToggle();
	})

});
