$(document).ready(function() {

// add photos and attendee
$('#EventAjaxAddAlbumForm').submit(function() {
	form_values = $(this).serialize();
	$.ajax({
		type:"POST",
		url:'/events/ajax_add_album',
		data: form_values, //"ajax=true&"+form_values,
		success: function(msg){
			$('#ajax_album_photo_display').html(msg);
			ajax_loading_image('#successful_add');
			initPaginator();
			
			//toggle add album box
			$("#add_button").toggle();
			$("#cancel_button").toggle();
			$(".add_album_item").toggle();
			$("#add_album_cradle").toggle('slow');
			$("#add_album_cradle").animate({height:"300px"});
			//end toggle add album box
			
			var event_id = document.getElementById('form_event_id').value;
			$('#imageList').load("/photos/photo_gallery?event_id="+event_id);
			$('#add_album_box').load('/events/add_album_box?event_id='+event_id);
			$('#AttendeeList').load('/events/event_attendees?event_id='+event_id);			
			
			ajax_remove_loading_image('#successful_add');
			
			}
			
		});
	return false;
});

// set a loading page
function ajax_loading_image(div) {
	$(div).html('<img src ="/img/ajax_loading.gif" height=159 width=159 />');
}

//remove loading image
function ajax_remove_loading_image(div) {
	$(div).html('');
}	
	function call_up_album() {
			var external_album_id = $('#EventExternalAlbumId').val();	
			ajax_loading_image('#ajax_album_photo_display');
			//ajax
			$.ajax({
				type:"POST",
				url:'/photos/ajax_get_album_photos',
				data: "ajax=true&external_album_id="+external_album_id,
				success: function(msg){
					//console.log(msg);
					ajax_remove_loading_image('#ajax_album_photo_display');
					$('#ajax_album_photo_display').html(msg);
				}
			});
	
	}

	// call up album picker
	$('#EventExternalAlbumId').change(function() {
		call_up_album();
		return false;
	});
	
/*	$('#EventExternalAlbumId').ready(function() {
		call_up_album();
		return false;
	}); */
});