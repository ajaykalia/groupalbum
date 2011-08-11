$(document).ready(function () {
	
	
	var event_id = document.getElementById('form_event_id').value;
	$('#gallery_content').load("/photos/photo_gallery/1?event_id="+event_id);
			
	$('a#add_link').click(function () {
		$('#gallery_content').load('/events/add_album_box?event_id='+event_id);
		return false;
	});
	
	$('a#gallery_link').click(function () {
		$('#gallery_content').load('/photos/photo_gallery/1?event_id='+event_id);
		return false;
	});
	


});