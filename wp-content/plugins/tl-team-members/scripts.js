$(function() {
    console.log( "ready!" );
    $('.team-member--read-more').on( "click", "button", function() {
    	$bio = $(this).parent().parent().find('.team-member--bio');
    	if ($bio.is(':visible')) {
    		$bio.slideUp();
    		var text = $(this).parent().find('.hid_read_more_text').val();
    		$(this).text(text);
    	} else {
    		$bio.slideDown();
    		var text = $(this).parent().find('.hid_read_less_text').val();
    		$(this).text(text);
    	}
    });
});