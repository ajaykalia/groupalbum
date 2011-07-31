<?php
/**
 * file: app/views/events/add_album_box.ctp
 *
 * Events Add Album Box code
 */
//echo('<pre>');
//print_r($event);
//print_r($this->data);
//echo('</pre>');

?>
<style>
div#ajax_album_photo_display.add_album_item {
}

div#ajax_album_photo_display {
	height:159px;
}



</style>

<script type="text/javascript" src="/js/add_album_box.js"></script>


<div class="add_album_item"><?php if($me) : ?>You are currently logged into Facebook as <?php print_r($me['name']); ?>.<?php endif ?></div>

<!-- add album field -->
<?php echo $form->create('Event', array('action'=>'ajax_add_album'));?>	

    <fieldset id="add_album_form" class="add_album_item">
	
<!-- if user is logged into Facebook -->	
	<?php if ($me): ?>
					
		<?php

			/*$albums = $facebook->api('me/albums'); <-- should get from controller now*/			
		    $album_names = array();

			foreach($albums["data"] as $album) {
				$album_id_key = $album['id'];
				$album_names[$album_id_key] = $album["name"];
				}
		?>
		
		<!-- form fields -->						
		<?php
			// which album?
			echo $form->input('external_album_id', array('label'=>'Pick an album', 'options'=>$album_names));
			
			// info to pass along
			echo $form->input('event_id',
               			array('label'=>'event_id', 'type'=>'hidden', 'value'=>$event_id));			
			echo $form->input('external_user_id', array('label'=>'name', 'value'=>$me['id'], 'type'=>'hidden'));
			echo $form->input('fb_session_token', array('label'=>'fb_session_token', 'value' => $session['access_token'], 'type'=>'hidden'));
			echo $form->input('attendee_name',
                    			array('label'=>'attendee_name', 'type'=>'hidden', 'value'=>$me['name']));
		?>
		<!-- end form fields -->						
		
		<!-- display album photos -->
		<div class='grid_10'>	
			<div id='ajax_album_photo_display' class="add_album_item"></div>
		</div>
		<!-- end display album photos -->
		
		
		<div class = "clear"> </div>
			
		<!-- display visibility settings box -->
		<div class="grid_10">	
	
			<div id='visibility_box'  class="add_album_item">
				<?php	
			// set visibility (0 = public, 1 = Facebook friends only)
			echo $form->input('privacy', array('label'=>'Visibility settings', 'type'=>'radio','options' => (array('0'=>'Share these photos with everyone', '1'=>'Only visible to Facebook friends')), 'default'=>'1'));
				?>	
			</div>
		</div>
		<!-- end visibility settings box -->
		
		<div class = "clear"> </div>
			
		<div class="grid_10">	
			<div id='successful_add'>
			 	<?php echo $form->end('Add');?>
			</div>
		</div>
		<div class = "clear"> </div>
		
	
	</fieldset>
			
		<?php else : ?>
<!-- end add album field displayed when user is logged into Facebook -->
	 	<?php endif ?>

</div>
<!-- end add album field -->