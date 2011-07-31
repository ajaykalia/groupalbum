$(document).ready(function () {
	
	$("#cancel_button").toggle();
	$(".add_album_item").toggle();
	$("#add_album_cradle").toggle();
	
	var event_id = document.getElementById('form_event_id').value;
	$('#imageList').load("/photos/photo_gallery?event_id="+event_id);
	$('#add_album_box').load('/events/add_album_box?event_id='+event_id);
		
	$("a[rel^='prettyPhoto']").prettyPhoto();
	
	$('a.ShowBox').click(function () {
		//toggle add album box
		$("#add_button").toggle();
		$("#cancel_button").toggle();
		$(".add_album_item").toggle();
		$("#add_album_cradle").toggle('slow');
		$("#add_album_cradle").animate({height:"340px"});
		//end toggle add album box

		return false;
	});


});