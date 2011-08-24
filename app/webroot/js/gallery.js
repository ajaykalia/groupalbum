$(document).ready(function () {
	
	
	var event_id = document.getElementById('form_event_id').value;
	$('#gallery_content').load("/photos/photo_gallery/1?event_id="+event_id);
			
	$('a#add_link').click(function () {
		$('a#add_link').text('Loading...');
		$('#gallery_content').load('/photos/display_albums?eid='+event_id);
		return false;
		
	});
	
	$('a#gallery_link').click(function () {
		$('a#gallery_link').text('Loading...');
		$('#gallery_content').load('/photos/photo_gallery/1?event_id='+event_id);
		return false;
	});
	


});