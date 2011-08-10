<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title_for_layout?></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<!-- Include external files and scripts here (See HTML helper for more info.) -->
<?php echo $scripts_for_layout ?>
<link rel="stylesheet" href="/css/reset.css" />
<link rel="stylesheet" href="/css/text.css" /> 
<link rel="stylesheet" href="/css/960_16_col.css" />
<link rel="stylesheet" href="/css/header_footer_layout.css" />
<!--<link rel="stylesheet" href="/css/cake.generic.css" /> -->
<link rel="stylesheet" href="/css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> 
<script src="/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
<script src="/js/scroll.js"></script>

<script type="text/javascript">
window.fbAsyncInit = function() {
  // whenever the user logs in, we refresh the image box and add album box
  FB.Event.subscribe('auth.login', function() {

	//	alert('login happened');

		$('#form_event_id').ready(function() { 
			var event_id = document.getElementById('form_event_id').value;
		//	$('#imageList').load("/photos/photo_gallery?event_id="+event_id);
			$('#add_album_box').load('/events/add_album_box?event_id='+event_id);
			$('.fb_login_button').css('visibility', 'hidden');
			$('#fb_login_status').css('visibility', 'visible');
		});

		FB.Event.unsubscribe('auth.login');
		});

   // whenever the user logs out, we refresh the image box and add album box
	FB.Event.subscribe('auth.logout', function() {

	//	alert('logout happened');

		$('#form_event_id').ready(function() { 
			var event_id = document.getElementById('form_event_id').value;
		//	$('#imageList').load("/photos/photo_gallery?event_id="+event_id);
			$('#add_album_box').load('/events/add_album_box?event_id='+event_id);
			$('.fb_login_button').css('visibility', 'visible');
			$('#fb_login_status').css('visibility', 'hidden');
		});

		FB.Event.unsubscribe('auth.logout');
		});
	};

</script>

</head>
<body>




<!-- If you'd like some sort of menu to 
show up on all of your views, include it here -->
<div id="header">
	<img src="/img/Camera_2.png" />
</div>

<div id="main_content">
	<!-- 16 col 960gs start -->
	<div class="container_16">
		<!-- Here's where I want my views to be displayed -->
		<?php echo $content_for_layout ?>
		<!-- 16 col 960gs end -->
	</div>
</div>

<!-- Add a footer to each displayed page -->
<!--<div id="footer">...</div> -->




</body>
</html>
