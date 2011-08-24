$(document).ready(function() {

$('a#add_link').text('Add album');

// add photos and attendee
$('#EventAjaxAddAlbumForm').submit(function() {
	form_values = $(this).serialize();
	$.ajax({
		type:"POST",
		url:'/events/ajax_add_album',
		data: form_values, //"ajax=true&"+form_values,
		success: function(msg){
			alert("added");
			}
			
		});
	return false;
});

});