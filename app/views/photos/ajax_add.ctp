<?php
/**
 * file: app/views/photos/index.ctp
 *
 * Photos Index View
 */
echo('<pre>');
print_r($this->data);
echo('</pre>');
?>

	<?php
	
		// Get Facebook Photo URLs for album
		require $_SERVER['DOCUMENT_ROOT'].'files/config.php';     	$session = $facebook->getSession();

		$albums = $facebook->api('me/albums');

		// curl photos from album
		$facebook_album_id = $this->data['Photo']["external_album_id"];
		
		$ch = curl_init();
			$my_album_photos = 'https://graph.facebook.com/'.$facebook_album_id.'/photos?access_token='.$session['access_token'];
			curl_setopt($ch, CURLOPT_URL, $my_album_photos); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			$photos = curl_exec ($ch);
		curl_close ($ch);
		
		$photos = json_decode($photos, true);
		// end curl
		
		// curl album link
		
		$ch = curl_init();
			$my_album = 'https://graph.facebook.com/'.$facebook_album_id.'?access_token='.$session['access_token'];
			curl_setopt($ch, CURLOPT_URL, $my_album); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			$album = curl_exec ($ch);
		curl_close ($ch);
		
		$album = json_decode($album, true);

			

	?>


<div>
    <?php 
		// set variables that will be passed back into the add controller
        $event_id = $this->data['Photo']['event_id'];
        $event_slug = $this->data['Photo']['event_slug'];
        $attendee_id = $this->data['Photo']['attendee_id'];
		$external_album_id = $this->data['Photo']['external_album_id'];
    
	?>

    
    <?php
		// start the form
		echo $form->create('Photo', array('action'=>'add'));?>
     
   	<fieldset>
        <legend>Add Your Photos </legend>

		<?php
		// Display Facebook album pix
			foreach($photos["data"] as $photo) {
				echo("<a href = ".$photo['source']."><img src =".$photo['picture']." alt='' / ></a>");
			}
		// end display
		?>

           

			<?php
            // which attendee and event owns the photo
            echo $form->input('attendee_id', array('label'=>'event_id', 'type'=>'hidden', 'value'=>$attendee_id));
            echo $form->input('event_id', array('label'=>'event_id', 'type'=>'hidden', 'value'=>$event_id));
            
            // pass external_album_id and link
            echo $form->input('external_album_id', array('label'=>'external_album_id','type'=>'hidden', 'value'=>$external_album_id));
		//	echo $form->input('external_album_link', array('label'=>'external_album_link','type'=>'hidden', 'value'=>$external_album_link));
        
			// pass Facebook session token
			echo $form->input('fb_session_token', array('label'=>'fb_session_token','type'=>'hidden', 'value'=>$session['access_token']));
			
            // for the controller redirect
            echo $form->input('event_slug', array('label'=>'event_slug', 'type'=>'hidden', 'value'=>$event_slug)); 

			// set privacy (0 = public, 1 = Facebook friends only)
			echo $form->input('privacy', array('label'=>'Privacy settings', 'type'=>'radio','options' => (array('0'=>'Open - Anyone viewing the album see these photos', '1'=>'Private - Only you and your Facebook friends can see these photos'))));

			// confirm that user has added photos
			echo $form->input('user_added_photos', array('label'=>'user_added_photos', 'type'=>'hidden', 'value'=>'yes'));
			
            ?>
         
         </fieldset>
    <?php echo $form->end('Add');?>


</div>

 ?>