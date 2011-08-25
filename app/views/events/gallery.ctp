<?php
/**
 * file: app/views/events/gallery.ctp
 *
 * Events Gallery View
 */
//echo('<pre>');
//print_r($event);
//print_r($this->data);
//echo('</pre>');

?>

<script type="text/javascript" src="/js/gallery.js"></script>


<style>
div#imageList {
	padding-top: 10px;
	padding-bottom: 50px;
	border-color: #000;
}

div.button_border {
	text-align:left;
	padding-top: 0px;
	padding-bottom: 5px;
}

div.gallery_border {
	height:20px;
	background: #000;
	position:relative;
}

div.gallery_border.bottom {
	margin-top:60px;
}

div#left_pane {
	padding-top:20px;
	height: 100%;
	z-index: -50;
	margin-right: 0px;
	background: #EEE;
	margin-top:5px;
}

div#right_pane {
	background: #FFF;
	margin-top: 5px;
	border-left: #CCC 1px solid;
	padding-left: 10px;
}

div.omega {
	background: #FFF;
}

.left_pane_links {
	cursor:pointer;
}

a.people_link {
	color: #3366FF;
	text-decoration: none;
}

div#AttendeeList p {
	color: #666666;
	margin: 0px;
	font-size: 13px;
}

.stack_title {
	margin-bottom:5px;
	margin-left: 10px;
	vertical-align: center;
	margin-top: 0px;
}

.greybox {
	background: #F0F0F0;
	width: 100%;
	border-top: solid 1px #CCCCCC;
	margin-top: 10px;
}

.button_border{
	padding-left:10px;
}

.button_border:hover {
	background:#CCC;
}

</style>
	

<!-- left nav -->
<div class="clear"></div>
<div id='left_pane' class='grid_3 alpha'>


<!-- left hand links -->
<div class="left_pane_links">	
   <div class="button_border"><a id="gallery_link">Event Gallery</a></div>
</div>
<div class="left_pane_links">	
   <div class="button_border"><a id="add_link">Add album</a></div>
</div>
<div id='fb_login_status' class = "grid_13" style="visibility:<?php if($me) {echo("visible");} else {echo("hidden");} ?>;">
	(Debug:&nbsp;<a href='<?php echo $logoutUrl; ?>'>Log out</a>&nbsp;)
</div>


</div>
<!-- end left nav -->

<!-- content pane -->
<div id='right_pane' class='grid_13 omega'>
	<div class = 'greybox'>
	<h2 class="stack_title"><?php echo $event['Event']['name']; ?> (January 1st-3rd, 2011)</h2>
	</div>

<!-- contributor list -->	
<div id="AttendeeList" class='grid_13'>
	<p>
		Stack started by <a class="people_link">Frank October</a> on January 1st, 2011<br />
		Last addition by <a class="people_link">Susan November</a> on February 2nd, 2011<br />
		Contributors:&nbsp;
		<?php foreach($event['Attendee'] as $attendee) : ?>
			<a class="people_link" href='http://facebook.com/profile.php?id=<?php echo($attendee['external_id']) ?>' target='#'><?php echo($attendee['name']) ?></a> (10)				
		<?php endforeach ?>
	</p>
</div>
<div class="clear"></div>

<div class="clear"></div>

<!-- end contributor list -->


<!-- image gallery -->	
<div id="gallery_content"></div>
<!-- end image gallery -->	

<!-- Facebook login button to view locked photos -->
<div class ='fb_login_button grid_13' style="visibility:<?php if($me) {echo("hidden");} else {echo("visible");} ?>;">
	Log into Facebook to view locked photos.                                 	
	<fb:login-button perms="publish_stream, user_photos"></fb:login-button>
</div>
<!-- end Facebook login button to view locked photos -->

<?php echo $form->input('form_event_id',
   			array('label'=>'form_event_id', 'type'=>'hidden', 'value'=>$event['Event']['id'])); ?>

<!-- end content page -->

</div>


