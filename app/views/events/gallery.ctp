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

<style>
div#imageList {
	height:370px;
	border-style:solid;
	border-width:1px;
	padding-top: 10px;
	padding-bottom: 10px;
	border-color: #000;


}

div#add_album_border {
	border-style:solid;
	border-width:1px;
	border-color: #000;
	height: 340px;
}

div.button_border {
	border-style:solid;
	border-width:1px;
	border-color: #000;
	text-align:center;
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


</style>	

<!-- header -->
<!--<div class = "gallery_border grid_16"></div> -->
<div class="clear"></div>
<div class='grid_16'>
	<h2>Photo Gallery: <?php echo $event['Event']['name']; ?> </h2>

</div>
<!-- end header -->

<!-- contributor list -->	
<div id="AttendeeList" class='grid_16'>
	<p>Contributors:&nbsp;
		<?php foreach($event['Attendee'] as $attendee) : ?>
				<a href='http://facebook.com/profile.php?id=<?php echo($attendee['external_id']) ?>' target='#'><?php echo($attendee['name']) ?></a>				
		<?php endforeach ?>
	</p>
</div>
<div class="clear"></div>

<div id='fb_login_status' class = "grid_16" style="visibility:<?php if($me) {echo("visible");} else {echo("hidden");} ?>;">
	(Debug:&nbsp;<a href='<?php echo $logoutUrl; ?>'>Log out</a>&nbsp;)
</div>
<div class="clear"></div>

<!-- end contributor list -->

<!-- Facebook login button to view locked photos -->
<div class ='fb_login_button grid_16' style="visibility:<?php if($me) {echo("hidden");} else {echo("visible");} ?>;">
	Log into Facebook to view locked photos.                                 	
	<fb:login-button perms="publish_stream, user_photos"></fb:login-button>
</div>
<!-- end Facebook login button to view locked photos -->

<!-- image gallery -->	
<div id="imageList" class='grid_16'></div>
<!-- end image gallery -->	

<!-- add album button -->
<div id = "add_button" class='grid_4 prefix_12'>	
   <div class="button_border"><img src="/img/expand.png" class="ShowBox"><a class="ShowBox" target="#"><u>Add photos</u></a></div>
</div>
<div id = "cancel_button" class='grid_4 prefix_12'>	
   <div class='button_border'><img src="/img/collapse.png" class="ShowBox"><a class="ShowBox" target="#"><u>Cancel</u></a></div>
</div>
<div class"clear"></div>
<!-- end add album button -->

<?php echo $form->input('form_event_id',
   			array('label'=>'form_event_id', 'type'=>'hidden', 'value'=>$event['Event']['id'])); ?>

<!-- start add album cradle -->
<div id= "add_album_cradle" class = "grid_10 prefix_6">
	<div id = "add_album_border">

		<!-- Facebook status or login -->
		<div class ='fb_login_button' style="visibility:<?php if($me) {echo("hidden");} else {echo("visible");} ?>;">
			Start by connecting your Facebook account:                                 	
			<fb:login-button perms="publish_stream, user_photos"></fb:login-button>
		</div>

		<!-- end Facebook status or login -->


		<!-- add album box (loads add_album_box.ctp) -->
		<div class="clear"></div>
		<div id = "add_album_box"></div>
		<!-- end add album box -->
	</div>
</div>
<!-- end add album cradle -->

<div class="gallery_border bottom grid_16"></div>


